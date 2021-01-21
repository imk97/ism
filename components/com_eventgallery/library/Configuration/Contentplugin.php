<?php

namespace Joomla\Component\Eventgallery\Site\Library\Configuration;

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class Contentplugin extends Configuration
{
    public function getImageContentPluginImageWidth() {
        return (int)$this->get('image_content_plugin_image_width', 50);
    }

    public function getImageContentPluginImageCrop() {
        return $this->get('image_content_plugin_image_crop', 1) == 1;
    }

    public function getImageContentPluginMode() {
        return $this->get('image_content_plugin_image_mode', 'link');
    }

    public function getImageContentPluginCssClass() {
        return $this->get('image_content_plugin_cssclass', '');
    }

    public function getImageContentPluginUseCart() {
        return $this->get('image_content_plugin_use_cart', 0) == 1;
    }

}
