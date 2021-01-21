<?php 
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

class EventgalleryViewThumbnailgenerator extends EventgalleryLibraryCommonView
{
    public $config;

	function display($tpl = null)
	{
        $this->config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance();
        $this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar() {
        JFactory::getApplication()->input->set('hidemainmenu', true);
		$bar = JToolbar::getInstance('toolbar');
		JToolbarHelper::title(   JText::_('COM_EVENTGALLERY_SUBMENU_THUMBNAILGENERATOR') );
		JToolbarHelper::cancel( 'thumbnailgenerator.cancel', 'Close' );
		$bar->appendButton('Link', 'checkin', 'COM_EVENTGALLERY_SUBMENU_SYNC_DATABASE',  JRoute::_('index.php?option=com_eventgallery&view=sync'), false);
	}
}

