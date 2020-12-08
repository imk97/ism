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

class QluePollControllerQluePoll extends JControllerForm {

    public function votes() {
        //call display and pass layout

        $input = JFactory::getApplication()->input;
        $view = $this->getView( 'qluepoll', 'html' );
        $view->setLayout('votes');
        return $view->display();
        //return parent::display();
    }

    public function delete() {
        parent::delete();
        $this->setMessage('Polls pooped');
    }
}