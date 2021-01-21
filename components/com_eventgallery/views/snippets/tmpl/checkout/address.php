<?php // no direct access

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');
/**
 * @var \Joomla\Component\Eventgallery\Site\Library\Configuration\Main $config;
 */
$config = $this->config;
/**
 * @var EventgalleryLibraryAddress $address
 */
$address = $this->address;

/**
* PARAMS: 
* - address
*/


/*
US Format

Name
Street Address or PO Box
City, State, Zip

EU Format

Name
Street address
Zip, City
State
*/
?>

<?php IF (strlen($address->getCompanyName())>0):?>
    <?php echo $this->escape($address->getCompanyName()); ?><br/>
<?php ENDIF; ?>
<?php echo $this->escape($address->getFirstName()); ?> <?php echo $this->escape($address->getLastName()) ?> <br/>
<?php echo $this->escape($address->getAddress1()); ?><br/>
<?php IF (strlen($address->getAddress2())>0):?>
    <?php echo $this->escape($address->getAddress2()); ?><br/>
<?php ENDIF; ?>
<?php IF (strlen($address->getAddress3())>0):?>
    <?php echo $this->escape($address->getAddress3()); ?><br/>
<?php ENDIF; ?>

<?php IF ($config->getCheckout()->getAddressFormat() == 'us'): ?>
    <?php echo $this->escape($address->getCity()); ?>,
    <?php IF (strlen($address->getState())>0):?>
        <?php echo $this->escape(EventgalleryLibraryCommonGeoobjects::getStateID($address->getState())); ?>,
    <?php ENDIF; ?>
    <?php echo $this->escape($address->getZip()); ?>

    <?php IF (strlen($address->getCountry())>0):?>
        <br/><?php echo $this->escape(EventgalleryLibraryCommonGeoobjects::getCountryName($address->getCountry())); ?>
    <?php ENDIF; ?>
<?PHP ELSE: ?>
    <?php echo $this->escape($address->getZip()); ?> <?php echo $this->escape($address->getCity()); ?>
    <?php IF (strlen($address->getState())>0):?>
        <br/><?php echo $this->escape(EventgalleryLibraryCommonGeoobjects::getStateName($address->getState())); ?>
    <?php ENDIF; ?>
    <?php IF (strlen($address->getCountry())>0):?>
        <br/><?php echo $this->escape(EventgalleryLibraryCommonGeoobjects::getCountryName($address->getCountry())); ?>
    <?php ENDIF; ?>
<?PHP ENDIF; ?>

<?php IF (isset($this->edit) && $this->edit == true) :?>
    <br/>
    <a href="<?php echo JRoute::_(
        "index.php?option=com_eventgallery&view=checkout&task=change"
    ) ?>">(<?php echo JText::_('COM_EVENTGALLERY_CART_CHECKOUT_REVIEW_FORM_CHANGE') ?>)</a>
<?php ENDIF ?>