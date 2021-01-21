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

require_once('method.php');

class EventgalleryModelShippingmethod extends EventgalleryModelMethod
{
    protected $table_type = 'shippingmethod';
    protected $table_name = '#__eventgallery_shippingmethod';
    protected $form_name = 'com_eventgallery.shippingmethod';
    protected $form_source ='shippingmethod';

    public function __construct($config = array(), \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null, \Joomla\CMS\Form\FormFactoryInterface $formFactory = null)
    {
        parent::__construct($config, $factory, $formFactory);
        $this->methodFactory =  EventgalleryLibraryFactoryShippingmethod::getInstance();
    }
}
