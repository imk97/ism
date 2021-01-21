<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class EventgalleryLibraryCommonUsergroups
{

    /**
     * Validates if at least one user group in userUserGroups is in $defaultUserGroups or $overrideUserGroups.
     * If $overrideUserGroups is provided, it will be used instead of $defaultUserGroups
     *
     * @param $defaultUserGroups
     * @param $overrideUserGroups
     * @param $userUserGroups
     * @return bool
     */
    static function validateWithOverride($defaultUserGroups, $overrideUserGroups, $userUserGroups) {

        // remove empty values
        if (is_array($overrideUserGroups)) {
            $overrideUserGroups = array_filter($overrideUserGroups);
        }

        if (empty($overrideUserGroups)) {
            return self::validate($defaultUserGroups, $userUserGroups);
        }

        return self::validate($overrideUserGroups, $userUserGroups);
    }

    /**
     * Checks if at least one group of $userUserGroups is in $allowedUserGroups. If $allowedUserGroups contains only 1, access is granted anyway.
     *
     * @param $allowedUserGroups array
     * @param $userUserGroups array
     * @return bool
     */
    static function validate($allowedUserGroups, $userUserGroups) {

        // remove empty values
        if(is_array($allowedUserGroups)) {
            $allowedUserGroups = array_filter($allowedUserGroups);
        }

        if (empty($allowedUserGroups)) {
            return true;
        }

        // if the public user group is part of the folder user groups
        if (in_array(1, $allowedUserGroups)) {
            return true;
        }

        foreach($userUserGroups as $userUserGroup) {

            if (count(array_intersect(EventgalleryHelpersUsergroups::getGroupPath($userUserGroup), $allowedUserGroups))>0 ) {
                return true;
            }
        }

        return false;
    }
}