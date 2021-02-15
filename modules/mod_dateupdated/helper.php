<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModDateUpdated
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getDate($params)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')->from($db->quoteName('#__dateupdate'));
        $db->setQuery($query);
        $db->execute();
        $row = $db->getNumRows();
        if ($row == 0) {
            $data = new stdClass();
            $data->date = date(" d M Y ");
            JFactory::getDbo()->insertObject('#__dateupdate', $data);
        } else {
            $data = new stdClass();
            $data->id = 1;
            $data->date = date(" d M Y ");
            JFactory::getDbo()->updateObject('#__dateupdate', $data, 'id');
        }
        //echo $params;
        

        

        //print_r($data);
        
        //$result = JFactory::getDbo()->insertObject('#__dateupdate', $data);

        return $params;
        // $db = JFactory::getDbo();

        // $query = $db->getQuery(true);

        // $query
        //     ->insert($db->quoteName('#__dateupdate'))
        //     ->colums($db->quoteName('date'))
        //     ->values($db->quote($params));

        // $db->setQuery($query);
        // $result = $db->execute();
    }
}