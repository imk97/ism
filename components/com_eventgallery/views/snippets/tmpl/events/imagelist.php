<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * @var \de\svenbluege\joomla\eventgallery\ObjectWithConfiguration $this
 */

?>

<div id="events">

    <div class="eventgallery-thumbnails eventgallery-imagelist eventgallery-events-imagelist thumbnails"
         data-rowheight="<?php echo $this->config->getEventsImagelist()->getThumbnailHeight(); ?>"
         data-rowheightjitter="<?php echo $this->config->getEventsImagelist()->getThumbnailJitter(); ?>"
         data-firstimagerowheight="<?php echo $this->config->getEventsImagelist()->getFirstItemRowHeight(); ?>"
         data-dofilllastrow="<?php echo (isset($this->dofilllastrow) && $this->dofilllastrow==true)?"true":"false"; ?>">
        <?php foreach ($this->entries as $entry) : /** @var EventgalleryLibraryFolder $entry */ ?>

            <div class="thumbnail-container">
                <?php $this->showContent=true; $this->entry=$entry->getFiles(0,1,1)[0]; $this->cssClass="   thumbnail"; echo $this->loadSnippet('event/inc/thumb_event'); ?>
            </div>

        <?php endforeach ?>
        <div style="clear: both"></div>
    </div>





    <?php echo $this->loadSnippet('events/inc/paging_bottom'); ?>

</div>
