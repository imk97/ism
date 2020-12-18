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
class modVisitorHelper
{
    /**
     * Retrieves the visitor amount
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getVisitor()
    {
        // return 'Hello, World!';

        // Obtain a database connection
        $db = JFactory::getDbo();

        // Retrieve the total user
        $query = $db->getQuery(true)
                    ->select('*')
                    ->from($db->quoteName('#__Visitor'));
        $db->setQuery($query);
        $db->execute();
        $total = $db->getNumRows();


        date_default_timezone_set("Asia/Kuala_Lumpur");
        $query = $db->getQuery(true)
                    ->select('*')
                    ->from($db->quoteName('#__Visitor'))
                    ->where($db->quoteName('date') . "=" . $db->quote(date("Y-m-d")));
        $db->setQuery($query);
        $db->execute();
        $daily = $db->getNumRows();

        $test1 = $db->getQuery(true)
                    ->select('month(date) as month')
                    ->from($db->quoteName('#__Visitor'));
        $db->setQuery($test1);
        $test = $db->loadColumn();
        // print_r($test);
        $month = 0;
        for ($i=0; $i < count($test); $i++) { 
            if ($test[$i] == date("m")) {
                $month = $month + 1;
            }
        }
        // print_r($count);

        $result = array();

        array_push($result, $total, $daily, $month);

        return $result;
    }

}