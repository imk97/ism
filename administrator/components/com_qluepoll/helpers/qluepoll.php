<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_QluePoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


class QluePollHelper {

    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject();

        $actions = array(
            'core.admin', 'core.manage'
        );

        foreach($actions as $action) {
            $result->set($action, $user->authorise($action, 'com_qluepoll'));
        }

        return $result;
    }

}