<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

$groups = [];
$groups[] = ['displayname' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_FOLDER_GOOGLE_PHOTOS_API'), 'name'=>'googlephotos'];
$groups[] = ['displayname' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_FOLDER_FLICKR'), 'name'=>'flickr'];
$groups[] = ['displayname' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_FOLDER_GENERAL'), 'name'=>'general'];
$groups[] = ['displayname' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_FOLDER_IMAGES'), 'name'=>'images'];

$elements = [];
$elements[] = ['group'=>'googlephotos', 'name' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_CACHED_CONTENT'), 'value'=>'googlephotos', 'count' => $this->folders['googlephotos']['count'], 'size' => $this->folders['googlephotos']['size'], 'checked' => false];
$elements[] = ['group'=>'flickr',       'name' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_CACHED_CONTENT'), 'value'=>'flickr', 'count' => $this->folders['flickr']['count'], 'size' => $this->folders['flickr']['size'],'checked' => false];
$elements[] = ['group'=>'general',      'name' => JText::_('COM_EVENTGALLERY_CLEAR_CACHE_CACHED_CONTENT'), 'value'=>'general', 'count' => $this->folders['general']['count'], 'size' => $this->folders['general']['size'],'checked' => false];

foreach($this->folders['images'] as $foldername=>$data) {
    $elements[] = ['group'=>'images', 'name' => $foldername, 'value' => $foldername, 'count' => $data['count'], 'size' => $data['size'], 'checked' => false];
}

?>

<div id="cacheclear"
     data-csrf-token="<?php echo JSession::getFormToken()?>"
     data-cache-clear-url="<?php echo JRoute::_('index.php?option=com_eventgallery&format=raw&task=cache.process&', false);?>"
     data-i18n-COM_EVENTGALLERY_CLEAR_CACHE_CHECK_ALL="<?php echo JText::_( 'COM_EVENTGALLERY_CLEAR_CACHE_CHECK_ALL' ); ?>"
     data-i18n-COM_EVENTGALLERY_CLEAR_CACHE_CHECK_NONE="<?php echo JText::_( 'COM_EVENTGALLERY_CLEAR_CACHE_CHECK_NONE' ); ?>"
     data-i18n-COM_EVENTGALLERY_CLEAR_CACHE_STOP_QUEUE="<?php echo JText::_( 'COM_EVENTGALLERY_CLEAR_CACHE_STOP_QUEUE' ); ?>"
     data-i18n-COM_EVENTGALLERY_CLEAR_CACHE_START="<?php echo JText::_( 'COM_EVENTGALLERY_CLEAR_CACHE_START' ); ?>"
     data-i18n-COM_EVENTGALLERY_CLEAR_CACHE_START_DESC="<?php echo JText::_( 'COM_EVENTGALLERY_CLEAR_CACHE_START_DESC' ); ?>"
     data-elements-json="<?php echo htmlspecialchars(json_encode($elements), ENT_QUOTES, 'UTF-8'); ?>"
     data-groups-json="<?php echo htmlspecialchars(json_encode($groups), ENT_QUOTES, 'UTF-8'); ?>"
></div>



<form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm" id="adminForm">
<input type="hidden" name="option" value="com_eventgallery" />
<input type="hidden" name="task" value="cache.display" />
<?php echo JHtml::_('form.token'); ?>
</form>