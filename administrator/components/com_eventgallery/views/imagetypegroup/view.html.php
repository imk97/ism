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


class EventgalleryViewImagetypegroup extends EventgalleryLibraryCommonView
{
	protected $state;

	protected $item;

	protected $form;

    /**
     * Display the view
     * @param null $tpl
     * @return bool|mixed
     */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$this->addToolbar();
		return parent::display($tpl);
	}

	private function addToolbar() {
        JFactory::getApplication()->input->set('hidemainmenu', true);
		$isNew		= ($this->item->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolbarHelper::title(   JText::_( 'COM_EVENTGALLERY_IMAGETYPEGROUP' ).': <small>[ ' . $text.' ]</small>' );

		JToolbarHelper::apply('imagetypegroup.apply');
		JToolbarHelper::save('imagetypegroup.save');
		if ($isNew)  {
			JToolbarHelper::cancel( 'imagetypegroup.cancel' );
		} else {
			JToolbarHelper::save2copy('imagetypegroup.save2copy');
			JToolbarHelper::cancel( 'imagetypegroup.cancel', JText::_( 'JTOOLBAR_CLOSE' ) );
		}

	}

}
