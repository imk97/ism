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


class EventgalleryViewOrder extends EventgalleryLibraryCommonView
{
    /**
     * @var \Joomla\Component\Eventgallery\Site\Library\Configuration\Main
     */
    protected $config;
    protected $state;
    protected $item;

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
        $this->item = $this->get('Item');
        $this->config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance($app->getParams());


        $user = JFactory::getUser();
        if ($user->guest) {
            $app->redirect(
                JRoute::_('index.php?option=com_eventgallery&view=trackorder', false)
            );
        }

        /**
         * @var JPathway $pathway
         */
        $pathway = $app->getPathWay();
        $pathway->addItem(JText::_('COM_EVENTGALLERY_ORDERS_PATH'), JRoute::_('index.php?option=com_eventgallery&view=orders'));

        $pathway = $app->getPathWay();
        $pathway->addItem(JText::_('COM_EVENTGALLERY_ORDER_PATH').' '.$this->item->getDocumentNumber());

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

        $title .= " - " . JText::_('COM_EVENTGALLERY_TRACKORDER_PATH');


        // Check for empty title and add site name if param is set
        if (empty($title)) {
            $title = $app->get('sitename');
        } elseif ($app->get('sitename_pagetitles', 0) == 1) {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        } elseif ($app->get('sitename_pagetitles', 0) == 2) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }


        if ($this->document) {

            $this->document->setTitle($title);

        }
    }

}
