<?php
/**
 * @package Nicepage Website Builder
 * @author Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

namespace NP\Utility;

defined('_JEXEC') or die;

use \JFactory;

class Utility
{
    /**
     * Defines site is ssl
     *
     * @return bool
     */
    public static function isSSL()
    {
        $isSSL = false;

        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $_SERVER['HTTPS'] = 'on';
        }

        if (isset($_SERVER['HTTPS'])) {
            if ('on' == strtolower($_SERVER['HTTPS'])) {
                $isSSL = true;
            }
            if ('1' == $_SERVER['HTTPS']) {
                $isSSL = true;
            }
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            $isSSL = true;
        }
        return $isSSL;
    }

    /**
     * Defines site is localhost
     *
     * @return bool
     */
    public static function isLocalhost()
    {
        $whitelist = array(
            // IPv4 address
            '127.0.0.1',
            // IPv6 address
            '::1'
        );

        if (filter_has_var(INPUT_SERVER, 'REMOTE_ADDR')) {
            $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
        } else if (filter_has_var(INPUT_ENV, 'REMOTE_ADDR')) {
            $ip = filter_input(INPUT_ENV, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        } else {
            $ip = null;
        }
        return $ip && in_array($ip, $whitelist);
    }

    /**
     * Defines site is https and localhost
     *
     * @return bool
     */
    public static function siteIsSecureAndLocalhost() {
        return self::isSSL() && self::isLocalhost();
    }

    /**
     * Option value to bytes value
     *
     * @param string $str Option value
     *
     * @return int
     */
    public static function toBytes($str)
    {
        $str = strtolower(trim($str));
        $size = intval($str);
        if ($str && strlen($size) !== strlen($str)) {
            $unit = $str[strlen($str) - 1];
            $size = substr($str, 0, -1);
            switch ($unit) {
            case 'g':
                $size *= 1024;
            case 'm':
                $size *= 1024;
            case 'k':
                $size *= 1024;
            }
        }
        return $size;
    }

    /**
     * Get max request size
     *
     * @return mixed
     */
    public static function getMaxRequestSize()
    {
        $postSize = self::toBytes(ini_get('post_max_size'));
        $uploadSize = self::toBytes(ini_get('upload_max_filesize'));
        $memorySize = self::toBytes(ini_get('memory_limit'));

        return min($postSize, $uploadSize, $memorySize);
    }

    /**
     * Get name of default template style
     *
     * @return string
     */
    public static function getActiveTemplate()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__template_styles');
        $query->where('client_id = 0');
        $query->where('home=\'1\'');
        $db->setQuery($query);
        $ret = $db->loadObject();
        return $ret ? $ret->template : '';
    }
}