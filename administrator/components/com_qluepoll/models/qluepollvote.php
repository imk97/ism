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

use Joomla\Utilities\ArrayHelper;

class QluePollModelQluePollVote extends JModelList {

    /**
	 *  Constructor
	 * 
	 * @param array $config An optional associative array of configuration settings
	 * 
	 * @return QluePollVote
	 * @since 0.0.5
	 * @see JModelList
	 */
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'ip', 'a.ip' 
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
		$input = JFactory::getApplication()->input;
		$poll_id = $input->get('id', 1);
		
		if($poll_id == null) $poll_id = 0;
		
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->poll_id = $input->get('id');

		// Create the base select statement.
		$query->select($db->quoteName(array('v.id', 'v.poll_id', 'v.awnser_id', 'v.user_id', 'v.ip', 'v.voted_at', 'u.username')))
				->from($db->quoteName('#__qluepoll_votes', 'v'))
                ->join('INNER', $db->quoteName('#__users', 'u') . ' ON ' . $db->quoteName('v.user_id') . ' = ' . $db->quoteName('u.id'))
				->where($db->quoteName('v.poll_id') . ' = ' . (1));

		$search = $this->getState('filter.search');

		if (!empty($search)) //TODO and
		{
			$like = ("%$search%");
		
			$nameCondition = $db->quoteName('u.username') . ' LIKE ' . $db->quote($like) ;
			$ipCondition =  $db->quoteName('v.ip') . ' LIKE ' . $db->quote($like);
			$query->andWhere('( ' . $nameCondition . ' OR ' . $ipCondition . ' )');
			
            //or match ip... todo
        }
        
		return $query;
	}
}