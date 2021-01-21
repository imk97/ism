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
IF ($this->config->getEventsList()->doEventPaging()): ?>

<form method="post" name="adminForm">
    <?php IF (version_compare(JVERSION, '4.0', '<' ) == 1): ?>
        <div class="pagination">
            <div class="counter pull-right"><?php echo $this->pageNav->getPagesCounter(); ?></div>
            <div class="float_left"><?php echo $this->pageNav->getPagesLinks(); ?></div>
            <div class="clear"></div>
        </div>
    <?php ELSE: ?>
        <div class="com-content-category__navigation w-100">

            <p class="com-content-category__counter counter float-right pt-3 pr-2">
                <?php echo $this->pageNav->getPagesCounter(); ?>
            </p>

            <div class="com-content-category__pagination">
                <?php echo $this->pageNav->getPagesLinks(); ?>
            </div>
        </div>
    <?php ENDIF ?>
</form>

<?php ENDIF ?>


