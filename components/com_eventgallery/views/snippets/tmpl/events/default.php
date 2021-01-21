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

?>

<div id="events">

    <div class="eventgallery-events-gridlist" <?php echo $this->config->getSlider()->getJavaScriptConfigurationString('.item-container');?>>
        <?php foreach($this->entries as $entry) :?>
            <?php $this->entry = $entry; ?>
            <?php echo $this->loadSnippet('events/default_event'); ?>
        <?php endforeach?>

        <div style="clear:both"></div>
    </div>

    <?php echo $this->loadSnippet('events/inc/paging_bottom'); ?>

</div>
