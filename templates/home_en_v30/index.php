<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';

JHtml::_('bootstrap.framework');

$app = JFactory::getApplication();
$config = JFactory::getConfig();

$defaultLogo = getLogoInfo(array('src' => "/images/jatanegara.png"));

// Create alias for $this object reference:
$document = $this;

if ($app::getRouter()->getMode() == JROUTER_MODE_SEF)
{
	$document->setBase(JUri::getInstance()->toString());
}

$metaGeneratorContent = 'Nicepage 3.4.1, nicepage.com';
if ($metaGeneratorContent) {
    $document->setMetaData('generator', $metaGeneratorContent);
}

$templateUrl = $document->baseurl . '/templates/' . $document->template;
$faviconPath = "" ? $templateUrl . '/images/' . "" : '';

Core::load("Core_Page");
// Initialize $view:
$this->view = new CorePage($this);
$bodyClass = 'class="' . (isset($this->bodyClass) ? $this->bodyClass : 'u-body') . '"';
$bodyStyle = isset($this->bodyStyle) && $this->bodyStyle ? ' style="' . $this->bodyStyle . '"' : '';
$backToTop = isset($this->backToTop) && $this->backToTop ? $this->backToTop : '';
$indexDir = dirname(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <?php if ($faviconPath) : ?>
        <link href="<?php echo $faviconPath; ?>" rel="icon" type="image/x-icon" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <?php echo CoreStatements::head(); ?>
    <meta name="theme-color" content="#478ac9">
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/default.css" media="screen" type="text/css" />
    <?php if($this->view->isFrontEditing()) : ?>
        <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/frontediting.css" media="screen" type="text/css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/media.css" id="theme-media-css" media="screen" type="text/css" />
    <link id="u-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Oswald:200,300,400,500,600,700">
    <?php include_once "$indexDir/styles.php"; ?>
    <?php if ($this->params->get('jquery', '0') == '1') : ?>
        <script src="<?php echo $templateUrl; ?>/scripts/jquery.js"></script>
    <?php endif; ?>
    <script src="<?php echo $templateUrl; ?>/scripts/script.js"></script>
    <?php if ($this->params->get('jsonld', '0') == '1') : ?>
    <script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "Organization",
	"name": "<?php echo $config->get('sitename'); ?>",
	"sameAs": [
		"https://facebook.com/institut.sosial.malaysia/",
		"https://twitter.com/ISM_HQ",
		"https://www.instagram.com/ism_hq/",
		"https://youtube.com/channel/UCUyvsSf8-qcXkdSlcbQ8uxA?view_as=subscriber"
	],
	"url": "<?php echo JUri::getInstance()->toString(); ?>",
	"logo": "<?php echo $defaultLogo['src']; ?>"
}
</script>
    <?php
    if (JUri::getInstance()->toString() == JUri::base()) {
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "<?php echo $config->get('sitename'); ?>",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "<?php echo JUri::base() . 'index.php?searchword={query' . '}&option=com_search'; ?>",
        "query-input": "required name=query"
      },
      "url": "<?php echo JUri::getInstance()->toString(); ?>"
    }
    </script>
    <?php } ?>
    <?php endif; ?>
    <?php if ($this->params->get('metatags', '0') == '1') : ?>
    <?php
    renderSeoTags($document->seoTags);
    ?>
    <?php endif; ?>
    
    <style>
      
    .u-dropdown-icon .u-nav-container .u-nav-popup .u-nav-link:first-child:nth-last-child(2):after {
      content: " \25B8";
      margin-top: 0.5rem;
      margin-bottom: -0.5rem;
      font-weight: 900;
    }
    .row::after {
      content: "";
      clear: both;
      display: table;
      padding: 0px;
      margin: 0px;
    }

    [class*="col-content-"] {
      float: left;
      padding: 5px 15px;
    }

    /* For mobile phones: */
    [class*="col-content-"] {
      width: 100%;
    }

    @media only screen and (min-width: 600px) {
      /* For tablets: */
      .col-s-1 {width: 8.33%;}
      .col-s-2 {width: 16.66%;}
      .col-s-3 {width: 25%;}
      .col-s-4 {width: 33.33%;}
      .col-s-5 {width: 41.66%;}
      .col-s-6 {width: 50%;}
      .col-s-7 {width: 58.33%;}
      .col-s-8 {width: 66.66%;}
      .col-s-9 {width: 75%;}
      .col-s-10 {width: 83.33%;}
      .col-s-11 {width: 91.66%;}
      .col-s-12 {width: 100%; }
    }
    @media only screen and (min-width: 768px) {
      /* For desktop: */
      .col-content-1 {width: 8.33%; padding-left: 5px; }
      .col-content-2 {width: 16.66%; padding-left: 5px; }
      .col-content-3 {width: 25%; padding-left: 5px; }
      .col-content-4 {width: 33.33%; padding-left: 5px; }
      .col-content-5 {width: 41.66%; padding-left: 5px; }
      .col-content-6 {width: 50%; padding-left: 5px; }
      .col-content-7 {width: 58.33%; padding-left: 5px; }
      .col-content-8 {width: 66.66%; padding-left: 5px; }
      .col-content-9 {width: 75%; padding-left: 5px; }
      .col-content-10 {width: 83.33%; padding-left: 5px; }
      .col-content-11 {width: 91.66%; padding-left: 5px; }
      .col-content-12 {width: 100%; padding-left: 5px; }
    }

	.container-content {
      margin: auto;
      max-width: 58%;
      font-size: 14px;
      //padding-right: 15px;
      //padding-left: 15px;
      //margin-right: auto;
      //margin-left: auto;
    }

    </style>
    
</head>
<body <?php echo $bodyClass . $bodyStyle; ?>>
<?php $this->view->renderHeader($indexDir, $this->params); ?>
<div class="container-content">
    <div class="row">
    	<div class="col-content-12 col-s-12">
 			<br>
    		<jdoc:include type="modules" name="position-2" />
    	</div>
    </div>
    <?php $positionName = 'submenu'; if ($positionName && CoreStatements::containsModules($positionName)) : ?>
    <div class="row">
      <div class="col-content-2 col-s-12">
          <jdoc:include type="modules" name="submenu" />
      </div>
      <div class="col-content-8 col-s-12">
          <?php $this->view->renderLayout(); ?>
      </div>
    <?php else: ?>
      	<?php $this->view->renderLayout(); ?>
    <?php endif; ?>
	</div>
</div>
<?php $this->view->renderFooter($indexDir, $this->params); ?>


<?php echo $backToTop; ?>
</body>
</html>
