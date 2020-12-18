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
                        // ->where('id = '. $db->Qoute($params));
        $db->setQuery($query);
        $db->execute();
        $total = $db->getNumRows();
        // $total = $db->loadRow();
        // print_r($total);

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $query = $db->getQuery(true)
                    ->select('*')
                    ->from($db->quoteName('#__Visitor'))
                    ->where($db->quoteName('date') . "=" . $db->quote(date("Y-m-d")));
        $db->setQuery($query);
        $db->execute();
        $daily = $db->getNumRows();

        $test1 = $db->getQuery(true)
                    ->select('date')
                    ->from($db->quoteName('#__Visitor'));
        $db->setQuery($test1);
        $test = $db->loadRow();
        print_r($test);
        // print_r($daily);

        // echo $db->getDateFormat();
        // $query = $db->getQuery(true)
        //             ->select('*')
        //             ->from($db->quoteName('#__Visitor'))
        //             ->where(
        //                 $test = $db->getQuery(true)
        //                 ->select('month(date) as month')
        //                 ->from($db->quoteName('#__Visitor'));
        //                 $db->setQuery($test) . "=" . $db->quote(date("m")));
        // $db->setQuery($query);
        // $db->execute();
        // $month = $db->getNumRows();
        // $month = $db->loadRow();
        // print_r($month);

        $result = array();

        array_push($result, $total, $daily);
        // print_r('Harian : ' . $result[0]. '<br>');
        // print_r('Bulanan : ' .$result[1]. '<br>');
        // print_r('Jumlah : ' . $result[2]. '<br>');
        // print_r('Kemaskini Terkini : ' . $result[3]);
        // print_r('Jumlah : ' . $result[2]);
        return $result;
    }

    // function getDaily() {
    //     $query = $db->getQuery(true)
    //                 ->select('COUNT(*)')
    //                 ->from($db->quoteName('#__Visitor'))
    //                 ->where($db->qouteName('date') . "=" . date("Y-m-d"));
    //     $db->setQuery($query);
    //     return $result = $db->loadRow();
    // }
}