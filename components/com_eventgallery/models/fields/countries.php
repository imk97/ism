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
class JFormFieldcountries extends JFormField
{

    //The field class must know its own type through the variable $type.
    protected $type = 'countries';


    public function getInput()
    {

        $config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance();
        $preselectedCountry = $config->getCheckout()->getCheckoutPreselectedCountry();


        $data = array();

        $selectedValue = $this->value;

        if (strlen($selectedValue) == 0) {
            $selectedValue = $preselectedCountry;
        }

        foreach(EventgalleryLibraryCommonGeoobjects::getCountries() as $countryCode=>$countryName) {

            $data[$countryName] = 	[
                'value' => $countryCode,
				'text' => $countryName,
                'selected' => $selectedValue == $countryCode
            ];
        }

        $html = array();
        $attr = '';

        // Initialize some field attributes.
        $attr .= !empty($this->class) ? ' class="' . $this->class . '"' : '';
        $attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
        $attr .= $this->required ? ' required aria-required="true"' : '';

        // Initialize JavaScript field attributes.
        $attr .= $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

        // Get the field options.
        $options = $data;


        $html[] = JHtml::_('select.genericlist', $options, $this->name, trim($attr), 'value', 'text', $selectedValue, $this->id);

        $document = \Joomla\CMS\Factory::getDocument();
        // trigger an event so something can happen. Do this onChange and initially.
        $script = <<<EOC
  document.addEventListener('DOMContentLoaded', (event) => {
      var countryField = document.getElementById("{$this->id}");
      var triggerEvent = function() {
        countryField.dispatchEvent(new CustomEvent('checkout-address-country-changed', {bubbles: true}));
      }
      countryField.addEventListener('change', triggerEvent);
      triggerEvent();
  });
EOC;


        $document->addScriptDeclaration($script);

        return implode($html);

    }
}