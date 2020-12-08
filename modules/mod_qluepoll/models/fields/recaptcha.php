<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// require_once JPATH_LIBRARIES . '/joomla/form/fields/radio.php';
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('radio');

class JFormFieldRecaptcha extends JFormFieldRadio {
    protected $type = "Recaptcha";

    public function getInput() {
        jimport('joomla.application.component.helper');
        $params = JComponentHelper::getParams('com_qluepoll');
        $recaptchaSite = self::cleanKey($params->get('recaptureSite'));
        $recaptchaSecret = self::cleanKey($params->get('recaptureSecret'));

        if(self::checkKeys($recaptchaSite, $recaptchaSecret)) { //TODO load http resource to check recapture key validity
            return parent::getInput();
        } else {
            return '<p>In order to use a captcha to prevent bots from voting please update the component configuation, with the correct recapture v2 keys.</p>';
        }
    }

    private static function cleanKey($key) {
        $key = str_replace(' ', '', $key);
        return $key;
    }

    private static function checkKeys($site, $secret) {
        if($site == null || $secret == null) return false;
        if(strlen($site) != 40 || strlen($secret) != 40) return false;
        if(substr($site, 0, 4) != subStr($secret, 0, 4)) return false;

        return true;
    }
}