<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');
jimport('joomla.application.pathway');
jimport('joomla.html.pagination');


class EventgalleryViewPassword extends EventgalleryLibraryCommonView
{
    /**
     * @var \Joomla\Component\Eventgallery\Site\Library\Configuration\Main
     */
    protected $config;
    protected $state;

    /**
     * @var EventgalleryLibraryFile
     */
    protected $file;

    /**
     * @var EventgalleryLibraryFolder
     */
    protected $folder;
    protected $formaction;

    /**
     * @var JDocument
     */
    public $document;


    function display($tpl = NULL)
    {
        /**
         * @var \Joomla\CMS\Application\CMSApplicationInterface $app
         */
        $app = JFactory::getApplication();
        $this->state = $this->get('State');
        $this->config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance($app->getParams());

        $file = $app->input->getString('file', '');
        $folder = $app->input->getString('folder', '');

        /**
         * @var EventgalleryLibraryFactoryFolder $folderFactory
         */
        $folderFactory = EventgalleryLibraryFactoryFolder::getInstance();
        $folder = $folderFactory->getFolder($folder);

        if (!is_object($folder)) {
            $app->redirect(JRoute::_("index.php?", false));
        }

        $formAction = JRoute::_("index.php?option=com_eventgallery&view=event&folder=" . $folder->getFolderName());

        $this->folder = $folder;
        $this->file = $file;
        $this->formaction = $formAction;

        $this->_prepareDocument();

        parent::display($tpl);
    }

    /**
     * Prepares the document
     */
    protected function _prepareDocument()
    {
        $app = JFactory::getApplication();
        $menus = $app->getMenu();

        $title = NULL;

        // Because the application sets a default page title,
        // we need to get it from the menu item itself
        $menu = $menus->getActive();
        if ($menu) {
            $this->config->set('page_heading', $this->config->getMenuItem()->getPageTitle());
        }


        $title = $this->config->getMenuItem()->getPageTitle();

        if ($this->folder->getDisplayName()) {
            $title = $this->folder->getDisplayName();
        }


        // Check for empty title and add site name if param is set
        if (empty($title)) {
            $title = $app->get('sitename');
        } elseif ($app->get('sitename_pagetitles', 0) == 1) {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        } elseif ($app->get('sitename_pagetitles', 0) == 2) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }
        if (empty($title)) {
            $title = $this->folder->getDisplayName();
        }
        $this->document->setTitle($title);

        if ($this->folder->getText()) {
            $this->document->setDescription($this->folder->getText());
        } elseif (!$this->folder->getText() && $this->config->getMenuItem()->getMetaDescription()) {
            $this->document->setDescription($this->config->getMenuItem()->getMetaDescription());
        }
    }
}


