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
<form action="<?php echo JRoute::_('index.php?option=com_eventgallery&view=imagetypes'); ?>"
      method="post" name="adminForm" id="adminForm">

    <?php if (version_compare(JVERSION, '4.0', '<' ) == 1): ?>
        <div id="j-sidebar-container" class="col-md-2">
            <?php echo $this->sidebar; ?>
        </div>
    <?php ENDIF;?>
    <div id="j-main-container">
        <div id="filter-bar" class="btn-toolbar">
            <div class="btn-group pull-right hidden-phone">
                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>
        </div>
        <div class="clearfix"> </div>
        <p>
            <img src="<?php echo JUri::root()?>/media/com_eventgallery/backend/img/imagetype_diagramm.png">
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th width="20">
                        <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                    </th>
                    <th class="nowrap" width="1%">

                    </th>
                    <th>
                        <?php echo JText::_( 'COM_EVENTGALLERY_IMAGETYPESET_NAME' ); ?>
                    </th>

                    <th>
                        <?php echo JText::_( 'COM_EVENTGALLERY_IMAGETYPESET_PRICING' ); ?>
                    </th>
                </tr>
            </thead>


            <tbody>
            <?php foreach ($this->items as $i => $item) :
            /**
             * @var EventgalleryLibraryImagetype $item;
             */
            ?>

                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $item->getId()); ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?php IF ($item->isPublished()): ?>
                                <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_PUBLISHED_DESC'); ?>" style="color: green" class="btn btn-micro active jgrid" href="javascript:void(0);"
                                    onclick="return Joomla.listItemTask('cb<?php echo $i;?>','imagetypes.unpublish')">
                                    <span class="state"><i class="icon-publish"></i></span>
                                </a>
                            <?php ELSE:?>
                                <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_UNPUBLISHED_DESC'); ?>" style="color: red" class="btn btn-micro jgrid" href="javascript:void(0);"
                                    onclick="return Joomla.listItemTask('cb<?php echo $i;?>','imagetypes.publish')">
                                    <span class="state"><i class="icon-unpublish"></i></span>
                                </a>
                            <?php ENDIF ?>

                            <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_EDIT_DESC'); ?>" class="btn btn-micro" href="<?php echo
                                JRoute::_('index.php?option=com_eventgallery&task=imagetype.edit&id='.$item->getId()); ?>">
                            <i class="icon-edit"></i></a>
                        </div>
                    </td>
                    <td>
                            <?php echo $this->escape($item->getName()) ?>  <?php IF ($item->isDigital()): ?><i class="icon-mail"></i><?php ENDIF ?> <br>
                            <small><?php echo $this->escape($item->getNote()) ?></small><br>
                            <small><strong><?php echo JText::_('COM_EVENTGALLERY_IMAGETYPE_GROUP') ?>:</strong> <?php echo $item->getImageTypeGroup()!=null?$this->escape($item->getImageTypeGroup()->getName()):JText::_('JNONE') ?></small>
                    </td>
                    <td>
                         <?php echo $this->escape($item->getPrice()) ?>
                         <br>
                        <small><?php echo JText::_('COM_EVENTGALLERY_TAXRATE') ?>:<?php echo $this->escape($item->getTaxrate()) ?>%</small>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination pagination-toolbar">
            <?php echo $this->pagination->getPagesLinks(); ?>
        </div>
    </div>

    <?php echo JHtml::_('form.token'); ?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="limitstart" value="<?php echo $this->pagination->limitstart; ?>" />

</form>
