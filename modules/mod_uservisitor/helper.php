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

        // Retrieve the shout
        $query = $db->getQuery(true)
                    ->select($db->quoteName(array('daily', 'monthly', 'total', 'latest_update')))
                    ->from($db->quoteName('#__Visitor'));
                    // ->where('id = '. $db->Qoute($params));
        
        $db->setQuery($query);
        $result = $db->loadRow();
        print_r('Harian : ' . $result[0]. '<br>');
        print_r('Bulanan : ' .$result[1]. '<br>');
        print_r('Jumlah : ' . $result[2]. '<br>');
        print_r('Kemaskini Terkini : ' . $result[3]);
        // return $result;
    }
}