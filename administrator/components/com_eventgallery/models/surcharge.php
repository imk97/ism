<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.modellist');

require_once('method.php');

class EventgalleryModelSurcharge extends EventgalleryModelMethod
{
    protected $table_type = 'surcharge';
    protected $table_name = '#__eventgallery_surcharge';
    protected $form_name = 'com_eventgallery.surcharge';
    protected $form_source ='surcharge';

    public function __construct($config = array(), \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null, \Joomla\CMS\Form\FormFactoryInterface $formFactory = null)
    {
        parent::__construct($config, $factory, $formFactory);
        $this->methodFactory =  EventgalleryLibraryFactorySurcharge::getInstance();
    }

}
