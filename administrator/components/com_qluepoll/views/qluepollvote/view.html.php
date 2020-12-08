<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Qlue polls view
 * 
 * @since  0.0.1
 */
class QluePollViewQluePollVote extends JViewLegacy
{
	/**
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 */
	function display($tpl = null)
	{

		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}
		$input = JFactory::getApplication()->input;
		$this->poll_id = $input->get('id', 0);
		
		$awnsers = $this->getAwnsers($this->poll_id);
		foreach($awnsers as $awnser) {
			$this->awnsers[$awnser->id] = $awnser->name; 
		}

		// $this->users = array();


		// $awnsersArray = array();
		// foreach($this->awnsers as $awnser) {
		// 	$awnsersArray[$awnser->name] = 0;
		// }

		// foreach($this->items as $i => $item) {
		// 	$this->users[$item->user_id] = array('name' => $item->username, 'votes' => 0,
		// 									'id' => $item->user_id, 'awnsers' => $awnsersArray);

		// 	foreach($this->awnsers as $awnser) {
		// 		if($item->awnser_id == $awnser->id) {
		// 			$this->users[$item->user_id]['awnsers'][$awnser->name] = $this->users[$item->user_id]['awnsers'][$awnser->name] + 1;
		// 			$this->users[$item->user_id]['votes'] = $this->users[$item->user_id]['votes']+ 1;
		// 		}
		// 	}

		// }

		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

    /**
     * Get awnsers for a poll, optiaonally passed a poll,
     * falls back to $input->get('id'); 
     */
    public function getAwnsers($id = -1) {

        $input = JFactory::getApplication()->input; 
        $poll_id = $input->get('id');

        if($id != -1) $poll_id = $id;

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('name', 'id')));
        $query->from($db->quoteName('#__qluepoll_answer'));
        $query->where($db->quoteName('poll_id') . '=' . $poll_id);
        $db->setQuery($query);
        $results = $db->loadObjectList();

        return $results;
    }

	protected function addToolBar() {
		JToolbarHelper::title('User Votes');
		JToolbarHelper::cancel('qluepoll.cancel', 'JTOOLBAR_CLOSE');
		// JToolBarHelper::deleteList('Are you sure you want to delete these votes?', 'qluepollvote.delete');
		JToolBarHelper::preferences('com_qluepoll');
	}
}