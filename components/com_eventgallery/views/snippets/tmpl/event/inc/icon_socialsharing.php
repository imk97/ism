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
IF ($this->entry->isShareable() && $this->config->getSocial()->doUseSocialSharingButton()):
// we do not use JRoute for this link to optimize performance
$currentItemid = $this->currentItemid;

if ($this->currentItemid == null) {

    $menuItem = EventgalleryHelpersRoute::getMenuItemidForEvent(null, null, null, $this->entry->getFolderName(), null);
    if ($menuItem != null) {
        $currentItemid = $menuItem->id;
    }
}

$overlayContentLink = JRoute::_('index.php?option=com_eventgallery&view=singleimage&layout=share&folder='.$this->entry->getFolderName().'&file='.$this->entry->getFileName()."&Itemid=".$currentItemid.'&format=raw');

$app = \Joomla\CMS\Factory::getApplication();
$option = $app->input->getString('option', null);
if ($option == 'com_content') {
    $overlayContentLink .= "&articleurl=". rawurlencode(\Joomla\CMS\Uri\Uri::getInstance()->toString());
}

?><span data-link="<?php echo $overlayContentLink ?>" class="social-share-button social-share-button-open" title="<?php echo JText::_('COM_EVENTGALLERY_SOCIAL_SHARE')?>" ><i class="egfa egfa-2x egfa-share-alt"></i></span><?php
ENDIF;
