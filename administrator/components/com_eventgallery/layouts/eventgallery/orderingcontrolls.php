<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

$currentIndex = $displayData['currentIndex'];
$value = $displayData['value'];
$numberOfItems = $displayData['numberOfItems'];
$pagination = $displayData['pagination'];
$taskPrefix = $displayData['taskPrefix'];
$reverseSorting = isset($displayData['reverseSorting']);
?>

<div class="input-group input-group-sm" style="min-width: 130px">
    <input title="<?php echo JText::_('COM_EVENTGALLERY_COMMON_ORDERING')?>" class="width-40 text-area-order form-control" type="text" name="order[]" value="<?php echo $value; ?>" />
    <div class="input-group-append input-append">
        <?php IF ($reverseSorting): ?>
            <span class="add-on"><?php echo $pagination->orderUpIcon( $currentIndex, true, $taskPrefix.'.orderdown', 'JLIB_HTML_MOVE_UP', true); ?></span>
            <span class="add-on"><?php echo $pagination->orderDownIcon( $currentIndex, $numberOfItems, true, $taskPrefix.'.orderup', 'JLIB_HTML_MOVE_DOWN', true ); ?></span>
        <?php ELSE: ?>
            <span class="add-on"><?php echo $pagination->orderUpIcon( $currentIndex, true, $taskPrefix.'.orderup', 'JLIB_HTML_MOVE_UP', true); ?></span>
            <span class="add-on"><?php echo $pagination->orderDownIcon( $currentIndex, $numberOfItems, true, $taskPrefix.'.orderdown', 'JLIB_HTML_MOVE_DOWN', true ); ?></span>
        <?php ENDIF ?>
    </div>
</div>