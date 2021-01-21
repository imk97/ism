<?php 
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;


class EventgalleryViewGdpr extends EventgalleryLibraryCommonView
{
    /**
     * Display the view
     * @param null $tpl
     * @return bool|mixed
     */
    public function display($tpl = null)
    {
        $this->addToolbar();
        EventgalleryHelpersEventgallery::addSubmenu('gdpr');
        $this->sidebar = JHtmlSidebar::render();
        return parent::display($tpl);
    }

    protected function addToolbar() {
        JToolbarHelper::title(   JText::_( 'COM_EVENTGALLERY_GDPR' ), 'generic.png' );

    }

}
