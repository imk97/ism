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
 * HelloWorldList Model
 *
 * @since  0.0.1
 */
class QluePollModelQluePolls extends JModelList
{

	/**
	 *  Constructor
	 * 
	 * @param array $config An optional associative array of configuration settings
	 * 
	 * @return QluePolls
	 * @since 0.0.5
	 * @see JModelList
	 */
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'question', 'a.question' 
			);
		}

		return parent::__construct($config);
	}

	/**
	 * Method to build an SQL query to get polls,
	 * taking into account search filters
	 *
	 * @return      string  An SQL query
	 */
	public function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
				->from($db->quoteName('#__qluepoll'));		
				
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('title LIKE ' . $like);
		}

		return $query;
	}


}
