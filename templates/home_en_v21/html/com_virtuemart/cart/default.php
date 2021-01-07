<?php
defined('_JEXEC') or die;

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'functions.php';

$document = JFactory::getDocument();

$document->bodyClass = '';
$document->bodyStyle = "";
$document->localFontsFile = "";
$document->backToTop=<<<BACKTOTOP

BACKTOTOP;
$document->popupDialogs=<<<DIALOGS

DIALOGS;

$currentDir = dirname(__FILE__);
Core::load("Core_Content");
$component = new CoreContent($this);

$cart = $component->cart($this->cart);
$cart->includeStyles($currentDir);
$cart->beginCheckoutForm();
include_once dirname(dirname(dirname($currentDir))) . '/views/cartTemplate_0.php';
$cart->endCheckoutForm();
$cart->includeScripts();