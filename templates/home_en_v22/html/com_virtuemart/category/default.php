<?php
defined ('_JEXEC') or die('Restricted access');

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'functions.php';

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

Core::load("Core_Content");
$component = new CoreContent($this);

if (count($this->products) > 0 && array_key_exists(0, $this->products)) {
    $p = $this->products;
    $this->products = array();
    $this->products[0] = $p;
}

foreach ($this->products as $type => $products) {
    if (count($products) < 1) continue;
    ?>
    <section class="u-align-center u-clearfix u-section-1" id="sec-d2ea">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><!--products--><!--products_options_json--><!--{"type":"Recent","source":"","tags":"","count":6}--><!--/products_options_json-->
    <div class="u-expanded-width u-products u-repeater u-repeater-1">
    <?php
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
        include dirname(dirname(dirname(dirname(__FILE__)))) . '/views/productsTemplate_0.php';
    }
    ?>
    
    </div><!--/products-->
  </div>
</section>
    <?php
}
include dirname(dirname(dirname(dirname(__FILE__)))) . '/views/productsTemplate_1.php';
?>

