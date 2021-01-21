<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

$version =  new JVersion();

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');



$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$sortFields = $this->getSortFields();


$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
    $saveOrderingUrl = 'index.php?option=com_eventgallery&task=events.saveOrderAjax&tmpl=component';
}

?>

<style>
    .foldername {
        display: block;
        max-width: 350px;
        word-wrap: break-word;
    }
</style>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function()  {
        Joomla.orderTable = function()
        {
            table = document.getElementById("sortTable");
            direction = document.getElementById("directionTable");
            order = table.options[table.selectedIndex].value;
            if (order != '<?php echo $listOrder; ?>')
            {
                dirn = 'desc';
            }
            else
            {
                dirn = direction.options[direction.selectedIndex].value;
            }
            Joomla.tableOrdering(order, dirn, '');
        }
    });
</script>
<form method="post" id="adminForm" name="adminForm">
        <?php if (version_compare(JVERSION, '4.0', '<' ) == 1): ?>
	        <div id="j-sidebar-container">
	            <?php echo $this->sidebar; ?>
	        </div>
    	<?php ENDIF;?>
        <div id="j-main-container">
            <div class="btn-toolbar eg-filter-bar input-group">
                <?php foreach (JHtmlSidebar::getFilters() as $filter) : ?>
                    <div class="filter-search btn-group pull-left">
                        <label for="<?php echo $filter['name']; ?>" class="sr-only"><?php echo $filter['label']; ?></label>
                        <select name="<?php echo $filter['name']; ?>" id="<?php echo $filter['name']; ?>" class="custom-select" onchange="this.form.submit()">
                            <?php if (!$filter['noDefault']) : ?>
                                <option value=""><?php echo $filter['label']; ?></option>
                            <?php endif; ?>
                            <?php echo $filter['options']; ?>
                        </select>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"> </div>
            </div>

            <div id="filter-bar" class="btn-toolbar eg-search-bar">
                <div class="filter-search btn-group pull-left">
                    <label for="filter_search" class="element-invisible"><?php echo JText::_('COM_EVENTGALLERY_EVENT_SEARCH_LABEL');?></label>
                    <input class="form-control" type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('COM_EVENTGALLERY_EVENT_SEARCH_PLACEHOLDER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_EVENTGALLERY_ORDERS_SEARCH_DESC'); ?>" />
                </div>
                <div class="btn-group pull-left">
                    <button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
                    <button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.getElementById('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>
                </div>
                <div class="btn-group pull-right hidden-phone">
                    <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
                    <?php echo $this->pagination->getLimitBox(); ?>
                </div>
                <div class="btn-group pull-right hidden-phone">
                    <label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC');?></label>
                    <select name="directionTable" id="directionTable" class="form-control input-medium" onchange="Joomla.orderTable()">
                        <option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?></option>
                        <option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('COM_EVENTGALLERY_ORDER_ASCENDING');?></option>
                        <option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('COM_EVENTGALLERY_ORDER_DESCENDING');?></option>
                    </select>
                </div>
                <div class="btn-group pull-right">
                    <label for="sortTable" class="element-invisible"><?php echo JText::_('COM_EVENTGALLERY_SORT_BY');?></label>
                    <select name="sortTable" id="sortTable" class="form-control input-medium" onchange="Joomla.orderTable()">
                        <option value=""><?php echo JText::_('COM_EVENTGALLERY_SORT_BY');?></option>
                        <?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
                    </select>
                </div>

            </div>
            <div class="clearfix"> </div>


        <table class="adminlist table table-striped wrap-table" id="eventsList">
            <thead>
                <tr>
                    <th width="1%" class="nowrap center hidden-phone">

                    </th>
                    <th width="20">
                        <!--<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />-->
                        <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                    </th>
                    <th class="nowrap" width="1%">

                    </th>
                    <th>
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_FOLDERNAME' ); ?>
                    </th>

                    <th>
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_ORDER' ); ?>
                        <?php echo (new JLayoutFile('eventgallery.orderingsave'))->render(['task'=>'events.saveorder']); ?>
                    </th>
                    <th>
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_DISPLAYNAME' ); ?>
                    </th>
                    <th class="nowrap">
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_EVENT_DATE' ); ?>
                    </th>
                    <th>
                        &nbsp;
                    </th>
                    <th class="nowrap">
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_MODIFIED_BY' ); ?>
                    </th>

                </tr>
            </thead>
            <?php

            for ($i=0, $n=count( $this->items ); $i < $n; $i++)
            {
            $item = $this->items[$i];
            $item->tags = new JHelperTags;
            $tags = $item->tags->getItemTags('com_eventgallery.event', $item->id);
            $checked = JHtml::_('grid.id', $i, $item->id);
            $editLink = JRoute::_('index.php?option=com_eventgallery&task=event.edit&id=' . $item->id);
            $uploadLink = JRoute::_('index.php?option=com_eventgallery&view=upload&folderid=' . $item->id);
            $filesLink = JRoute::_('index.php?option=com_eventgallery&view=files&folderid=' . $item->id);

            /**
             * @var EventgalleryLibraryFactoryFolder $folderFactory
             */
            $folderFactory = EventgalleryLibraryFactoryFolder::getInstance();
            $folder = $folderFactory->getFolder($item->folder);

            if (!isset($folder)) {
                continue;
            }

            ?>
            <tr class="">
                <td>

                    <?php
                    $iconClass = '';
                    if (!$saveOrder) {
                        $iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
                    }
                    ?>
                    <!--<span class="sortable-handler<?php echo $iconClass ?>">
                            <i class="icon-menu"></i>
                        </span>-->
                    <?php if ($saveOrder) : ?>
                        <!--<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />-->
                    <?php endif; ?>

                </td>
                <td>
                    <?php echo $checked; ?>
                </td>
                <td>
                    <div class="btn-group">


                        <?php IF ($item->published == 1): ?>
                            <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_PUBLISHED_DESC'); ?>"
                               style="color: green" class="btn btn-micro active" href="javascript:void(0);"
                               onclick="return Joomla.listItemTask('cb<?php echo $i; ?>','events.unpublish')">
                                <span class="state"><i class="icon-publish"></i></span>
                            </a>
                        <?php ELSE: ?>
                            <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_UNPUBLISHED_DESC'); ?>"
                               style="color: red" class="btn btn-micro" href="javascript:void(0);"
                               onclick="return Joomla.listItemTask('cb<?php echo $i; ?>','events.publish')">
                                <span class="state"><i class="icon-unpublish"></i></span>
                            </a>
                        <?php ENDIF ?>


                        <?php IF ($item->cartable == 1): ?>
                            <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_CARTABLE_DESC'); ?>"
                               style="color: green" class="btn btn-micro active" href="javascript:void(0);"
                               onclick="return Joomla.listItemTask('cb<?php echo $i; ?>','events.notcartable')">
                                <span class="state"><i class="icon-cart"></i></span>
                            </a>
                        <?php ELSE: ?>
                            <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_UNCARTABLE_DESC'); ?>"
                               style="color: red" class="btn btn-micro" href="javascript:void(0);"
                               onclick="return Joomla.listItemTask('cb<?php echo $i; ?>','events.cartable')">
                                <span class="state"><i class="icon-cart"></i></span>
                            </a>
                        <?php ENDIF ?>

                        <?php IF ($folder->supportsFileUpload() == true) : ?>
                            <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_UPLOAD_DESC'); ?>"
                               href="<?php echo $uploadLink; ?>" id="upload_<?php echo $item->id ?>"
                               class="btn btn-micro">
                                <span class="state "><i class="icon-upload"></i>	<span class="text"></span></span>
                            </a>
                        <?php ENDIF; ?>
                        <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_FILES_DESC'); ?>"
                           href="<?php echo $filesLink; ?>" id="files_<?php echo $item->id ?>" class="btn btn-micro">
                            <span class="state"><i class="icon-folder-2"></i>	<span class="text"></span></span>
                        </a>

                        <a title="<?php echo JText::_('COM_EVENTGALLERY_BUTTON_EDIT_DESC'); ?>"
                           href="<?php echo $editLink; ?>" id="files_<?php echo $item->id ?>" class="btn btn-micro">
                            <span class="state"><i class="icon-edit"></i>	<span class="text"></span></span>
                        </a>

                    </div>
                </td>
                <td class="wrap">

                        <span class="foldername">
                            <?php if ($folder->getFolderType()->getId() == EventgalleryLibraryFolderGooglephotos::ID && !empty($folder->getGooglePhotosTitle())) {
                                /**
                                 * @var EventgalleryLibraryFolderGooglephotos $folder
                                 */

                                    echo $folder->getGooglePhotosTitle();
                                    echo "<br><small>" . $folder->getFolderName() . "</small>";
                            }
                            else  {
                                echo $folder->getFolderName();
                            }?>
                        </span>

                        <small>
                            <?php echo $folder->getFileCount();?> <?php echo JText::_('COM_EVENTGALLERY_EVENTS_FILECOUNT_FILES'); ?>,
                            <?php echo $folder->getHits();?> <?php echo JText::_('COM_EVENTGALLERY_EVENTS_HITS'); ?>
                        </small><br>


                        <?php
                            if ( null != $folder->getWatermark() ) {
                                echo '<small><strong>'.JText::_( 'COM_EVENTGALLERY_EVENTS_WATERMARK' ).'</strong>';
                                echo '<br/>'.$folder->getWatermark()->getName().'</small><br>';
                            }
                            if (null != $folder->getImageTypeSet()) {
                                echo '<small><strong>'.JText::_( 'COM_EVENTGALLERY_EVENTS_IMAGETYPESET' ).'</strong>';
                                echo '<br/>'.$folder->getImageTypeSet()->getName().'</small><br>';
                            }
                        ?>
                    </td>

                    <td class="order nowrap">

                        <?php echo (new JLayoutFile('eventgallery.orderingcontrolls'))->render(['reverseSorting'=>true, 'currentIndex' => $i, 'numberOfItems'=>$n, 'value'=>$item->ordering, 'pagination'=>$this->pagination, 'taskPrefix'=>'events']); ?>
                    </td>

                    <td>
                        <?php echo $folder->getDisplayName();?>
                    </td>
                    <td class="nowrap">
                        <?php echo JHtml::date($item->date, JText::_('DATE_FORMAT_LC3')); ?><br>
                    </td>
                    <td>
                        <small>
                            <?php IF (strlen($item->category_title)>0): ?>
                                <strong><?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_CATEGORY' ); ?></strong><br>
                                <?php echo $item->category_title; ?><br>
                            <?php ENDIF ?>
                            <?php IF (count($tags)>0): ?>
                                <strong><?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_TAGS' ); ?></strong><br>
                                <?php
                                    $tempTags = array();
                                    foreach($tags as $tag) {
                                        array_push($tempTags, $tag->title);
                                    }
                                    echo implode(', ', $tempTags);
                                ?><br>
                            <?php ENDIF ?>
                            <?php IF (strlen($item->picasakey)>0): ?>
                                <strong> <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_PICASA_KEY' ); ?></strong><br>
                                <?php echo $item->picasakey; ?><br>
                            <?php ENDIF ?>
                            <?php IF (strlen($item->password)>0): ?>
                                <strong><?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_PASSWORD' ); ?></strong><br>
                                <?php echo $item->password; ?><br>
                            <?php ENDIF ?>
                            <?php IF (strlen($item->usergroupids)>0 && $item->usergroupids!='1'): ?>
                                <strong><?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_USERGROUPS' ); ?></strong><br>
                                <?php
                                    $usergroupids = explode(',',$item->usergroupids);
                                    $groups = array();
                                    foreach($usergroupids as $usergroupid) {
                                        $groups[] = EventgalleryHelpersUsergroups::getUserGroupName($usergroupid);
                                    }
                                    echo implode(',', $groups);
                                ?><br>
                            <?php ENDIF ?>
                            <?php IF (strlen($item->attribs)>0): $attibs = json_decode($item->attribs);?>
                                <?php IF (isset ($attibs->download_original_images_usergroupids) && $attibs->download_original_images_usergroupids[0] != '1'): ?>
                                    <strong><?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_DOWNLOAD_ORIGINALIMAGES_USERGROUPS' ); ?></strong><br>
                                    <?php
                                    $usergroupids = $attibs->download_original_images_usergroupids;
                                    $groups = array();
                                    foreach($usergroupids as $usergroupid) {
                                        $groups[] = EventgalleryHelpersUsergroups::getUserGroupName($usergroupid);
                                    }
                                    echo implode(',', $groups);
                                    ?><br>
                                <?php ENDIF ?>
                            <?php ENDIF ?>
                        </small>
                    </td>
                    <td><small>
                        <?php $user = JFactory::getUser($item->userid); echo $user->name;?><br />
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENT_CREATED' ); ?> <?php echo JHtml::date($item->created,JText::_('DATE_FORMAT_LC4')) ?><br>
                        <?php echo JText::_( 'COM_EVENTGALLERY_EVENT_MODIFIED' ); ?> <?php echo JHtml::date($item->modified,JText::_('DATE_FORMAT_LC4')) ?><br>
                        </small>
                    </td>

                </tr>
                <?php

            }
            ?>
            </table>
            <div class="pagination pagination-toolbar">
                <?php echo $this->pagination->getPagesLinks(); ?>
            </div>
        </div>


    <?php //Load the batch processing form. ?>
    <?php echo $this->loadTemplate('batch'); ?>

	<?php echo JHtml::_('form.token'); ?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="limitstart" value="<?php echo $this->pagination->limitstart; ?>" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	<input type="hidden" name="option" value="com_eventgallery" />

</form>
