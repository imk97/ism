<?php
defined('_JEXEC') or die;

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'functions.php';

/* Let's see if we found the product */
if (empty($this->product)) {
    echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
    echo '<br /><br />  ' . $this->continue_link_html;
    return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));

$styles = dirname(__FILE__) . '/default_styles.php';
if (file_exists($styles)) {
    ob_start();
    include_once dirname(__FILE__) . '/default_styles.php';
    JFactory::getDocument()->addCustomTag(ob_get_clean());
}

$document = JFactory::getDocument();

$document->bodyClass = '';
$document->bodyStyle = "";
$document->localFontsFile = "";
$document->backToTop=<<<BACKTOTOP

BACKTOTOP;
$document->popupDialogs=<<<DIALOGS

DIALOGS;

Core::load("Core_Content");

$component = new CoreContent($this);
$product = $component->product('productdetails', $this->product);

$index = 0;
${'title' . $index} = $product->title;
${'titleLink' . $index} = $product->titleLink;
${'content' . $index} = $product->shortDesc;
${'image' . $index} = $product->getImage();

${'productRegularPrice' . $index} = $product->regularPrice;
${'productOldPrice' . $index} = $product->oldPrice;

$quantityProps = $product->getQuantityProps();
${'productQuantityNotify' . $index} = $quantityProps['notify'];
${'productQuantityLabel' . $index} = $quantityProps['label'];
${'productQuantityHtml' . $index} = $quantityProps['html'];

$btnProps = $product->getButtonProps(true);
${'productButtonText' . $index} = $btnProps['text'];
${'productButtonLink' . $index} = $btnProps['link'];
${'productButtonHtml' . $index} = $btnProps['html'];

$galleryImages = $product->getGallery();
$variations = $product->getVariations();
$tabs = $product->getTabs();
$product->includeScripts();

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '/views/productTemplate_0.php';