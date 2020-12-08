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
class QluePollViewQluePolls extends JViewLegacy
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

		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	protected function addToolBar() {
		JToolbarHelper::title('Qlue Poll');
		JToolbarHelper::addNew('qluepoll.add');
		JToolbarHelper::editList('qluepoll.edit');
		JToolBarHelper::deleteList('Are you sure you want to delete this poll?', 'qluepolls.delete');
		JToolBarHelper::preferences('com_qluepoll');
	}
}