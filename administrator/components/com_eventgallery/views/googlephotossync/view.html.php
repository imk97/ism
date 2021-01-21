<?php 
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view');
jimport( 'joomla.html.pagination');
jimport( 'joomla.html.html');


/** @noinspection PhpUndefinedClassInspection */
class EventgalleryViewGooglephotossync extends EventgalleryLibraryCommonView
{
    protected $item;

	function display($tpl = null)
	{
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar() {
        JFactory::getApplication()->input->set('hidemainmenu', true);
		JToolbarHelper::title(  JText::_('COM_EVENTGALLERY_GOOGLEPHOTOSSYNC') );
		JToolbarHelper::cancel( 'googlephotossync.cancel', 'Close' );
	}
}

