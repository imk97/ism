<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');
/**
 * @var \de\svenbluege\joomla\eventgallery\ObjectWithConfiguration $this
 */

$app = JFactory::getApplication();

?>

<?php
	/**
	* adjust the image path
	*/
	$_image_script_path = 'components/com_eventgallery/helpers/image.php';

	if ($this->config->getImage()->doUseLegacyImageRendering()) {
		$_image_script_path = "index.php";
	}

    /**
     * @var EventgalleryLibraryFolder $folder
     */
    $folder = $this->folder;

	$listOrder	= $folder->getSortAttribute();
	$listDirn	= $folder->getSortDirection();

	if (empty($listOrder)) {
		$listOrder = $this->config->getEventsList()->getSortFilesByColumn();
	}
	if (empty($listDirn)) {
		$listDirn = $this->config->getEventsList()->getSortFilesByDirection();
	}


	$saveOrder	= $listOrder == 'ordering';


?>


<form method="POST" name="adminForm" id="adminForm">

    <div id="filter-bar" class="btn-toolbar">
        <div class="btn-group pull-right hidden-phone">
            <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
            <?php echo $this->pagination->getLimitBox(); ?>
        </div>
    </div>
    <div class="clearfix"> </div>

    <input type="hidden" name="option" value="com_eventgallery" />
    <input type="hidden" name="id" value="<?php echo $this->folder->getId(); ?>" />
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>

    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="folderid" value="<?php echo $this->folder->getId(); ?>" />

    <p>
    <?php echo JText::sprintf('COM_EVENTGALLERY_FILES_ORDER_HELP', $listOrder, $listDirn); ?>
    </p>

    <?php if (!EVENTGALLERY_EXTENDED && $folder->getFolderType()->getId() == EventgalleryLibraryFolderGooglephotos::ID): ?>
        <p class="well">
            <strong>
                <?php echo JText::_('COM_EVENTGALLERY_GOOGLEPHOTOS_LIMITATIONS_HINT'); ?>
            </strong>
        </p>
    <?php ENDIF; ?>



    <table class="table table-striped adminlist">
    <thead>
        <tr>

            <th width="20">
                <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
            </th>
            <th width="110">
                <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_FILENAME' ); ?>
            </th>
            <th width="130">
                <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_ORDER' ); ?>
                <?php IF ($folder->isSortable() && $saveOrder):?>
                    <?php echo (new JLayoutFile('eventgallery.orderingsave'))->render(['task'=>'files.saveorder']); ?>
                <?php ENDIF; ?>
            </th>
            <th>
                <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_OPTIONS' ); ?>
            </th>

            <th>
                <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_DISPLAYNAME' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'COM_EVENTGALLERY_EVENTS_MODIFIED_BY' ); ?>
            </th>

        </tr>
    </thead>
    <?php

    for ($i=0, $n=count( $this->items ); $i < $n; $i++)
    {
        $row = $this->items[$i];

        /**
         * @var EventgalleryLibraryFactoryFile $fileFactory
         * @var EventgalleryLibraryFile $file
         */

        $fileFactory = EventgalleryLibraryFactoryFile::getInstance();
        $file = $fileFactory->getFile($row->folder, $row->file);

        $editLink = JRoute::_('index.php?option=com_eventgallery&view=file&layout=edit&id='.$row->id);
        $editLinkAjax = $editLink . '&tmpl=component&format=raw';
        $checked 	= JHtml::_('grid.id',   $i, $row->id );
        // TODO: remove due to strange issues with at least on joomla installation $published =  JHtml::_('jgrid.published', $row->published, $i );

        $this->row = $row;
        $this->file = $file;
        $this->editLink = $editLink;
        $this->editLinkAjax = $editLinkAjax;
        ?>

        <tr>
            <td>
                <?php echo $checked; ?>
            </td>
            <td>
                <img class="img-thumbnail thumbnail" title="<?php echo $row->id; ?>" src="<?php echo $this->file->getThumbUrl(104); ?>" />
            </td>
            <td class="order">
                <?php IF ($file->getFolder()->isSortable() && $saveOrder): ?>
                    <?php echo (new JLayoutFile('eventgallery.orderingcontrolls'))->render(['reverseOrder'=>strtoupper($listDirn) == 'DESC','currentIndex' => $i, 'numberOfItems'=>$n, 'value'=>$row->ordering, 'pagination'=>$this->pagination, 'taskPrefix'=>'files']); ?>
                <?php ENDIF; ?>
                <div style="word-wrap: break-word; width: 120px">
                    <small style="word-wrap:break-word">
                        <?php echo $file->getFileName()?>
                        <br><?php $date = $file->getCreationDate(); echo $date==null?"":$date->format(JText::_('DATE_FORMAT_LC2'))?>

                    <?php IF ($file->getFolder()->supportsImageDataEditing()):?>
                        <br><a href="<?php echo $this->editLink;?>"><?php echo JText::_('COM_EVENTGALLERY_EVENT_FILE_EDIT'); ?></a>
                    <?php ENDIF; ?>
                    </small>

                </div>

            </td>
            <td>
                <div class="btn-group">
                    <?php IF ($file->getFolder()->supportsImageDataEditing()):?>
                        <a title="<?php echo JText::_( 'COM_EVENTGALLERY_EVENT_IMAGE_ACTION_PUBLISH' ); ?>"
                            onClick="return Joomla.listItemTask('cb<?php echo $i; ?>','<?php echo $row->published==0?"files.publish":"files.unpublish"; ?>')"
                            class="<?php echo $row->published==1? "btn btn-micro active" : "btn btn-micro";?>">
                            <i class="eg-icon-published"></i>
                        </a>

                        <a title="<?php echo JText::_( 'COM_EVENTGALLERY_EVENT_IMAGE_ACTION_MAINIMAGE' ); ?>" onClick="document.location.href='<?php echo JRoute::_("index.php?option=com_eventgallery&view=files&task=".($row->ismainimage==0?"files.ismainimage":"files.isnotmainimage")."&folderid=".$this->folder->getId()."&cid[]=".$row->id."&limitstart=".$app->input->getInt('limitstart', '0')) ?>'"
                            class="<?php echo $row->ismainimage==1? "btn btn-micro active" : "btn btn-micro";?>">
                            <i class="eg-icon-mainimage"></i>
                        </a>

                        <a title="<?php echo JText::_( 'COM_EVENTGALLERY_EVENT_IMAGE_ACTION_MAINIMAGEONLY' ); ?>" onClick="document.location.href='<?php echo JRoute::_("index.php?option=com_eventgallery&view=files&task=".($row->ismainimageonly==0?"files.ismainimageonly":"files.isnotmainimageonly")."&folderid=".$this->folder->getId()."&cid[]=".$row->id."&limitstart=".$app->input->getInt('limitstart', '0')) ?>'"
                            class="<?php echo $row->ismainimageonly==0? "btn btn-micro active" : "btn btn-micro";?>">
                            <i class="eg-icon-mainimageonly"></i>
                        </a>

                    <?php ENDIF; ?>
                </div>
            </td>
            <td>
                <div class="row-fluid" data-id="<?php echo $this->file->getId(); ?>" data-editlink="<?php echo $this->editLinkAjax; ?>">
                    <?php echo $this->loadTemplate('content'); ?>
                </div>
            </td>
            <td>
                <small>
                    <?php $user = JFactory::getUser($row->userid); echo $user->name;?>, <br>
                    <?php echo JText::_( 'COM_EVENTGALLERY_EVENT_FILE_CREATED' ); ?><?php echo JHtml::date($row->created,JText::_('DATE_FORMAT_LC4')) ?>, <br>
                    <?php echo JText::_( 'COM_EVENTGALLERY_EVENT_FILE_MODIFIED' ); ?><?php echo JHtml::date($row->modified,JText::_('DATE_FORMAT_LC4')) ?>
                </small>
            </td>

        </tr>
        <?php
    }
    ?>
    </table>
    <input type="hidden" name="limitstart" value="<?php echo $this->pagination->limitstart; ?>" />
    <div class="pagination pagination-toolbar">
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>

</form>
