<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

class QluePollViewQluePoll extends JViewLegacy {
    protected $item;
    protected $form;
    protected $state;

    public $awnsers;
    public $poll;    
    public $votes;    

    public function display($tpl = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        if(count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }

        $this->addToolBar();
        
        parent::display($tpl);
    }

    public function addToolBar() {
        $input = JFactory::getApplication()->input;

        $input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);

        if($isNew) {
            $title = 'New';
        } else {
            $title = 'Edit';
        }

        if($this->getLayout() != 'votes') {
            JToolbarHelper::title($title, 'help');
            JToolbarHelper::apply('qluepoll.apply');
            JToolbarHelper::save('qluepoll.save');
            JToolbarHelper::cancel('qluepoll.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        } else {
            JToolbarHelper::title('Poll Information', 'help');
            JToolbarHelper::cancel('qluepoll.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        }
    }
}