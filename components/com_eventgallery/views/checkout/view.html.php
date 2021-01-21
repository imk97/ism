<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


jimport('joomla.application.component.view');


class EventgalleryViewCheckout extends EventgalleryLibraryCommonView
{

    /**
     * @var JDocument
     */
    public $document;

    /**
     * @var \Joomla\CMS\Form\Form
     */
    protected $billingform;
    /**
     * @var EventgalleryLibraryCart
     */
    protected $cart;
    /**
     * @var \Joomla\Component\Eventgallery\Site\Library\Configuration\Main
     */
    protected $config;

    /**
     * @var \Joomla\CMS\Form\Form
     */
    protected $shippingform;

    /**
     * @var JForm
     */
    protected $loginform;

    protected $state;

    /**
     * @var JForm
     */
    protected $userdataform;

    /**
     * @var JForm
     */
    protected $userdataformwithname;


    function display($tpl = null)
    {
        /**
         * @var \Joomla\CMS\Application\CMSApplicationInterface $app
         */
        $app = JFactory::getApplication();
        $this->state = $this->get('State');
        $this->config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance($app->getParams());
        /**
         * @var EventgalleryModelCheckout $model
         */
        $model = $this->getModel('checkout');

        /* @var EventgalleryLibraryManagerCart $cartMgr */
        $cartMgr = EventgalleryLibraryManagerCart::getInstance();
        $this->cart = $cartMgr->getCart();

        if ($this->cart->getShippingMethod() != null && !$this->cart->getShippingMethod()->needsAddressData()) {
            $skipAddressForms = true;
        } else {
            $skipAddressForms = false;
        }

        // set the default view
        if ($this->getLayout() == 'default') {
            $this->setLayout('review');
        }


        // if the current layout is not confirm and some details are missing, display the change page.
        // if there are no items in the cart, go the the cart page.
        if ($this->getLayout() != 'confirm') {

            if ($this->cart->getLineItemsCount()==0) {
                $app->redirect(
                    JRoute::_("index.php?option=com_eventgallery&view=cart", false)
                );
            }

            if ($this->cart->getShippingMethodServiceLineItem() == null
                || $this->cart->getPaymentMethodServiceLineItem() == null
                || ($this->cart->getShippingAddress() == null && !$skipAddressForms)
                || ($this->cart->getBillingAddress() == null && !$skipAddressForms)
            ) {

                $this->setLayout('change');

            }

        }

        if ($this->getLayout() == 'change') {

            $this->userdataform = $model->getUserDataForm();

            $this->userdataform->reset();
            $this->userdataform->bind(
                array(
                    'message' => $this->cart->getMessage(),
                    'email' => $this->cart->getEMail(),
                    'phone' => $this->cart->getPhone()
                )
            );
            $this->userdataform->bind($app->input->post->getArray());

            $this->userdataformwithname = $model->getUserDataFormWithoutAddress();
            $this->userdataformwithname->reset();
            $this->userdataformwithname->bind(
                array(
                    'firstname' => $this->cart->getFirstname(),
                    'lastname' => $this->cart->getLastname(),
                    'message' => $this->cart->getMessage(),
                    'email' => $this->cart->getEMail(),
                    'phone' => $this->cart->getPhone()
                )
            );
            $this->userdataformwithname->bind($app->input->post->getArray());

            $this->billingform = $model->getBillingAddressForm();

            $this->billingform->reset();

            if ($this->cart->getBillingAddress() != null) {
                $this->billingform->bind($this->cart->getBillingAddress()->_getData('billing_'));
            }
            $this->billingform->bind($app->input->post->getArray());


            $this->shippingform = $model->getShippingAddressForm();


            if ($this->cart->getShippingAddress() != null) {
                $this->shippingform->bind($this->cart->getShippingAddress()->_getData('shipping_'));
            }
            $this->shippingform->bind($app->input->post->getArray());

            // Get the form.
            // Joomla 4 FIX TODO: Delete if not supporting Joomla 3 any longer
            JForm::addFormPath(JPATH_BASE . '/components/com_users/models/forms');
            JForm::addFieldPath(JPATH_BASE . '/components/com_users/models/fields');

            JForm::addFormPath(JPATH_BASE . '/components/com_users/forms');

            $this->loginform = JForm::getInstance('com_users.login', 'login');


        }

        $pathway = $app->getPathWay();
        $pathway->addItem(JText::_('COM_EVENTGALLERY_CART_CHECKOUT_PATH'));

        $this->_prepareDocument();

        parent::display($tpl);
    }

    /**
     * Prepares the document
     */
    protected function _prepareDocument()
    {
        $app = JFactory::getApplication();
        $title = null;

        $title = $this->config->getMenuItem()->getPageTitle();

        $title .= " - " . JText::_('COM_EVENTGALLERY_CART_CHECKOUT_PATH');


        // Check for empty title and add site name if param is set
        if (empty($title)) {
            $title = $app->get('sitename');
        } elseif ($app->get('sitename_pagetitles', 0) == 1) {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        } elseif ($app->get('sitename_pagetitles', 0) == 2) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }


        if ($this->document) {

            $this->document->setTitle($title);

        }
    }

}
