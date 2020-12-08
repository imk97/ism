<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

class ModQluePollHelper
{
    public static $displayCaptcha;

    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getPoll($id)
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('*')
                ->from($db->quoteName('#__qluepoll'))
                ->where('id =' . $db->Quote($id));				

        $db->setQuery($query);

        $poll = new stdClass();
        $poll->poll = $db->loadObject();

        $query = $db->getQuery(true);
        $query->select('*')
            ->from($db->quoteName('#__qluepoll_answer'))
            ->where('poll_id = ' . $db->quote($id));

        $db->setQuery($query);

        $poll->awnsers = $db->loadObjectList();

        return $poll; 
    }

    public static function submit($poll, $awnser, $user = 0) {
        $awnser_id = $awnser;

        $input = JFactory::getApplication()->input;
        $ip = $input->server->get('REMOTE_ADDR');

        $time = date("Y-m-d H:i:s");

        //record vote in database
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->insert($db->quoteName('#__qluepoll_votes'))
              ->columns($db->quoteName(array('awnser_id', 'poll_id', 'ip', 'user_id', 'voted_at')))
              ->values(implode(',', array($db->quote($awnser_id), $db->quote($poll->poll->id), $db->quote($ip), $db->quote($user), $db->quote($time))));
        $db->setQuery($query);
        $db->execute();

        //update vote count for poll
        $poll = ModQluePollHelper::getPoll($poll->poll->id);

        $query = $db->getQuery(true);
        $query->update($db->quoteName('#__qluepoll'))
              ->set(($db->quoteName('votes') . ' = ' . $db->quote($poll->poll->votes + 1)))
              ->where(($db->quoteName('id') . ' = ' . $poll->poll->id));
        
        $db->setQuery($query);
        $db->execute();
    }

    /**
     * handles form submission, voting and returning vote data
     */
    public static function getAjax() {
        $input = new JInput;
        $post = $input->getArray($_POST);
        $captchaToken = $input->get("captcha");
        
        $poll = ModQluePollHelper::getPoll($input->get("poll_id"));

        $awnser = $input->get("awnser");
        $mid = $input->get("mid");
        if(ModQluePollHelper::checkIfAllowed($poll, $input->server->get('REMOTE_ADDR')) &&
            ModQluePollHelper::checkCaptcha($captchaToken)) {
            ModQluePollHelper::submit($poll, $awnser, $mid);
        }

        //get all awnsers where poll_id matches
        $awnsers = ModQluePollHelper::getAwnsers($input->get("poll_id"));
        $results = array();

        //foreach awnser get votes where awnser_id matches
        foreach($awnsers as $awnser) {
            $result = new stdClass();
            $result->awnser = $awnser["name"];
            $result->votes = ModQluePollHelper::getNoVotesForAwnser($awnser["id"]);
            array_push($results, $result);
        }

        $response = array();
        $response["data"] = $results;

        return ($response);
    }

    public static function checkCaptcha($token) {
        if(!self::$displayCaptcha) return true;

        jimport('joomla.application.component.helper');
        $params = JComponentHelper::getParams('com_qluepoll');
        $secret = $params->get('recaptureSecret');

        $result = ModQluePollHelper::postRequest(
            "https://www.google.com/recaptcha/api/siteverify",
            [
                "secret" => $secret,
                "response" => $token
            ]
        );

        var_dump($result);
        die();
    }

    /**
     * returns all awnsers for a poll
     */
    public static function getAwnsers($poll_id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id', 'name')))
              ->from($db->quoteName('#__qluepoll_answer'))
              ->where($db->quoteName('poll_id') . '=' . $db->quote($poll_id));

        $db->setQuery($query);
        $results = $db->loadAssocList();

        return $results;
    }

    /**
     * returns number of votes for an awnser
     */
    public static function getNoVotesForAwnser($awnser_id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName('id'))
              ->from($db->quoteName('#__qluepoll_votes'))
              ->where($db->quoteName('awnser_id') . '=' . $db->quote($awnser_id));

        $db->setQuery($query);
        $column = $db->loadColumn();

        return count($column);
    }

    /**
     * checks if the vote is allowed
     */
    public static function checkIfAllowed($poll, $user_ip) {

        //if poll allows multiple votes return true
        if($poll->poll->allow_multiple == 1 || $poll->poll->allow_multiple == '1') return true;

        //else check if they have already voted
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName('ip'))
              ->from($db->quoteName('#__qluepoll_votes'))
              ->where($db->quoteName('poll_id') . '=' . $db->quote($poll->poll->id));

        $db->setQuery($query);
        $column = $db->loadColumn();

        foreach($column as $ip) {
            if($user_ip == $ip) {
                return false;
            }
        }

        return true;
    }

    //Send a post request
    public static function postRequest($url, $params) {
        $fields_string = "";

        foreach($params as $key=>$value) { 
            $fields_string .= $key.'='.$value.'&'; 
        }

        rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($params));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}

    // public static function postRequest($sec, $res) {
    //     $data = array(
    //         'secret' => $sec,
    //         'response' => $res
    //     );

    //     $verify = curl_init();
    //     curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    //     curl_setopt($verify, CURLOPT_POST, true);
    //     curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    //     curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($verify);

    //     return $response;
    // }