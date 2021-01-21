<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

defined('_JEXEC') or die();

class EventgalleryModelCheckout extends JModelLegacy
{

    private $config;
    private $xmlPath = JPATH_SITE . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_eventgallery' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR;

    public function __construct($config = array(), MVCFactoryInterface $factory = null)
    {
        parent::__construct($config, $factory);
        $this->config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance();
    }

    /**
     * @return \Joomla\CMS\Form\Form
     */
    public function getUserDataForm() {
        $form = JForm::getInstance('userdata', $this->xmlPath . 'userdata.xml');

        if ($this->config->getCheckout()->isAddressFieldPhonenumberMandatory()) {
            $form->setFieldAttribute('phone','required', 'true');
        }

        return $form;
    }

    /**
     * @return \Joomla\CMS\Form\Form
     */
    public function getUserDataFormWithoutAddress() {
        $form = JForm::getInstance('userdata_withname', $this->xmlPath . 'userdata_withname.xml');

        if ($this->config->getCheckout()->isAddressFieldPhonenumberMandatory()) {
            $form->setFieldAttribute('phone','required', 'true');
        }

        return $form;
    }

    /**
     * @return \Joomla\CMS\Form\Form
     */
    public function getBillingAddressForm() {
        $form = $this->getAddressForm('billing');
        if (!$this->config->getCheckout()->doEnableBusinessCustomerData()) {
            $form->removeField('billing_taxid');
        }
        return $form;
    }

    /**
     * @return \Joomla\CMS\Form\Form
     */
    public function getShippingAddressForm() {
        return $this->getAddressForm('shipping');
    }

    /**
     * @return \Joomla\CMS\Form\Form
     */
    private function getAddressForm(string $formtype) {
        $form = JForm::getInstance($formtype, $this->xmlPath . $formtype.'address.xml');

        if (!$this->config->getCheckout()->doEnableBusinessCustomerData()) {
            $form->removeField($formtype.'_companyname');
        }

        if ($this->config->getCheckout()->isAddressFieldCountryMandatory()) {
            $form->setFieldAttribute($formtype.'_country','required', 'true');
        }

        if ($this->config->getCheckout()->isAddressFieldStateMandatory()) {
            $form->setFieldAttribute($formtype.'_state','required', 'true');
        }

        if (!$this->config->getCheckout()->doUseAddressFieldState()) {
            $form->removeField($formtype.'_state');
        }

        if (!$this->config->getCheckout()->doUseAddressFieldCountry()) {
            $form->removeField($formtype.'_country');
        }

        return $form;
    }
}

