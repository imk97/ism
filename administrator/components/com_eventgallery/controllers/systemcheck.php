<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport( 'joomla.application.component.controllerform' );

class EventgalleryControllerSystemcheck extends JControllerForm
{

    protected $default_view = 'systemcheck';

    public function fixdbversion()
    {

        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $db = \Joomla\CMS\Factory::getDbo();

        $query = "insert into #__schemas (extension_id, version_id) ";
        $query .= "select extension_id, " . $db->quote(EVENTGALLERY_DATABASE_VERSION). " ";
        $query .= "from #__extensions ";
        $query .= "where element = 'com_eventgallery'";

        $db->setQuery($query);
        $db->execute();

        $this->setRedirect( 'index.php?option=com_eventgallery&view='.$this->default_view);


    }


}
