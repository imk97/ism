<?php
defined ('_JEXEC') or die('Restricted access');

$themePath = dirname(dirname(dirname(dirname(__FILE__))));
require_once $themePath . DIRECTORY_SEPARATOR . 'functions.php';

$styles = dirname(__FILE__) . '/products_styles.php';
if (file_exists($styles)) {
    ob_start();
    include_once dirname(__FILE__) . '/products_styles.php';
    JFactory::getDocument()->addCustomTag(ob_get_clean());
}

$document = JFactory::getDocument();

$document->bodyClass = 'u-body';
$document->bodyStyle = "";
$document->localFontsFile = "";
$document->backToTop=<<<BACKTOTOP

BACKTOTOP;
$document->popupDialogs=<<<DIALOGS

DIALOGS;

$funcsInfo = array(
   array('repeatable' => false, 'name' => 'productsTemplate_0', 'itemsExists' => true),
   array('repeatable' => false, 'name' => 'productsTemplate_1', 'itemsExists' => false),

);

$funcsStaticInfo = array(

);


Core::load("Core_Content");
$component = new CoreContent($this);

if (count($this->products) > 0 && array_key_exists(0, $this->products)) {
    $p = $this->products;
    $this->products = array();
    $this->products[0] = $p;
}

if (count($funcsInfo)) {
    foreach ($funcsInfo as $funcInfo) {
        if (!$funcInfo['itemsExists']) {
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
            continue;
        }
        foreach ($this->products as $type => $products) {
            if (count($products) < 1) continue;
            if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_start.php')) {
                include $themePath . '/views/' . $funcInfo['name'] . '_start.php';
            }
            foreach ($products as $product) {
                $product = $component->product('productdetails', $product);
                $index = 0;
                ${'title' . $index} = $product->title;
                ${'titleLink' . $index} = $product->titleLink;
                ${'content' . $index} = $product->shortDesc;
                ${'image' . $index} = $product->getImage();

                ${'productRegularPrice' . $index} = $product->regularPrice;
                ${'productOldPrice' . $index} = $product->oldPrice;

                $btnProps = $product->getButtonProps();
                ${'productButtonText' . $index} = $btnProps['text'];
                ${'productButtonLink' . $index} = $btnProps['link'];
                ${'productButtonHtml' . $index} = $btnProps['html'];
                $product->includeScripts();
                include $themePath . '/views/' . $funcInfo['name'] . '.php';
            }
            if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_end.php')) {
                include $themePath . '/views/' . $funcInfo['name'] . '_end.php';
            }
        }
    }
}

if (count($funcsStaticInfo)) {
    for ($i = 0; $i < count($funcsStaticInfo); $i++) {
        include_once $themePath . '/views/' . $funcsStaticInfo[$i]['name'] . '.php';
    }
}

?>

