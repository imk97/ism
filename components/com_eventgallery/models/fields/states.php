<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

// The class name must always be the same as the filename (in camel case)
class JFormFieldstates extends JFormField
{

    //The field class must know its own type through the variable $type.
    protected $type = 'states';


    public function getInput()
    {

        $attribs = ['class' => 'form-control input-xlarge'];
        $data = array();
        $data['N/A'] = ['id'=>$this->buildOptGroupId('nocountry'), 'text'=>'N/A', 'items'=>[JHtml::_('select.option', '', 'N/A')]];

        foreach(EventgalleryLibraryCommonGeoobjects::getStates(true) as $countryCode=>$states) {
            $countryName = EventgalleryLibraryCommonGeoobjects::getCountryName($countryCode);
            $data[$countryName] = 	[
                'id' => $this->buildOptGroupId($countryCode),
				'text' => $countryName,
				'items' => []
            ];

            foreach($states as $state) {
                $data[$countryName]['items'][] = JHtml::_('select.option', $state->statecode, $state->statename);
            }
        }

        $html = JHtml::_('select.groupedlist', $data, $this->id, [
            'id' =>$this->id,
            'group.id' => 'id',
            'list.attr' => $attribs,
            'list.select' => $this->value
        ]);


        return $html;
    }

    private function buildOptGroupId($id) {
        return $this->id . '_' . $id;
    }
}