<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');
?>

<album-selector label="<?php echo JText::_('COM_EVENTGALLERY_OPTIONS_COMMON_GOOGLE_PHOTOS_API_ALBUM_SELECTOR_LOADING');?>"
                label_empty="<?php echo JText::_('COM_EVENTGALLERY_OPTIONS_COMMON_GOOGLE_PHOTOS_API_ALBUM_SELECTOR_EMPTY');?>"
                url="<?php echo JRoute::_('index.php?option=com_eventgallery&task=googlephotos.getAlbums', false);?>"></album-selector>
