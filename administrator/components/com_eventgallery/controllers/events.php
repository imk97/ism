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

jimport( 'joomla.application.component.controlleradmin' );

class EventgalleryControllerEvents extends JControllerAdmin
{

    public function __construct($config = array(), \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null, ?\Joomla\CMS\Application\CMSApplication $app = null, ?\Joomla\Input\Input $input = null)
    {
        parent::__construct($config, $factory, $app, $input);
        $this->registerTask('notcartable', 'cartable');
        $this->registerTask('cartable', 'cartable');
    }

    /**
     * Proxy for getModel.
     * @param string $name
     * @param string $prefix
     * @param array $config
     * @return object
     */
    public function getModel($name = 'Event', $prefix ='EventgalleryModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function cartable() {
        $cid = JFactory::getApplication()->input->get('cid', array(), 'array');
        $data = array('cartable' => 1, 'notcartable' => 0);
        $task = $this->getTask();
        $value = Joomla\Utilities\ArrayHelper::getValue($data, $task, 0, 'int');
        if (!is_array($cid) || count($cid) < 1)
        {
            JLog::add(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), JLog::WARNING, 'jerror');
        }
        else
        {
            // Get the model.
            $model = $this->getModel();

            // Make sure the item ids are integers
            Joomla\Utilities\ArrayHelper::toInteger($cid);

            // Remove the items.
            if ($model->cartable($cid, $value))
            {
                if ($value == 1)
                {
                    $ntext = $this->text_prefix . '_N_ITEMS_CARTABLE';
                }
                else
                {
                    $ntext = $this->text_prefix . '_N_ITEMS_NOTCARTABLE';
                }
                $this->setMessage(JText::plural($ntext, count($cid)));
            }
            else
            {
                $this->setMessage($model->getError());
            }
        }
        $this->setRedirect(JRoute::_('index.php?option=com_eventgallery&view=events', false));
    }




}