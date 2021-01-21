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

$metaGeneratorContent = 'Nicepage 3.3.3, nicepage.com';
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
    /*ul > li.parent > div.u-nav-popup > ul > li.parent {
      content: "\25bc";
    }*/
      
    nav > div > ul > li.u-nav-item.parent > a::after {
      content: "\25bc"; 
      font-size: 10px;
      justify-content: center;
      float: right;
    }

	nav > div > ul > li.u-nav-item.parent > div.u-nav-popup > ul > li.u-nav-item.parent > a::after {
      content: " \25B6";
      font-size: 10px;
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
      .col-content-1 {width: 8.33%; }
      .col-content-2 {width: 16.66%;}
      .col-content-3 {width: 25%;}
      .col-content-4 {width: 33.33%;}
      .col-content-5 {width: 41.66%;}
      .col-content-6 {width: 50%;}
      .col-content-7 {width: 58.33%;}
      .col-content-8 {width: 66.66%;}
      .col-content-9 {width: 75%;}
      .col-content-10 {width: 83.33%;}
      .col-content-11 {width: 91.66%;}
      .col-content-12 {width: 100%; }
    }

	.container-content {
      margin: auto;
      max-width: 58%;
      font-size: 14px;
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
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
$(document).ready( function() {
    var currentSize = document.querySelector('.u-body') //body
    var size = document.querySelector('.u-custom-font') //custom-font
    var style = getComputedStyle(currentSize)
    //var style2 = getComputedStyle(size)
    console.log(style.fontSize)
    //console.log(style2.fontSize)
    $('#inc').click( function() {
      
      console.log("increase")
      console.log(style.fontSize)
      //console.log(parseInt(style.fontSize)+2)
      //console.log($('.u-body').css('font-size', parseInt(style.fontSize)+2))
      //var inc = $('.u-body').css('font-size', parseInt(style.fontSize) + 2)
      var inc = parseInt(style.fontSize) + 2
      //var inc2 = parseInt(style2.fontSize) + 2
      if(inc <= 20) {
        $("ul, .u-body, .custom").css('font-size', inc)
        // $(".u-group-3").setAttribute('font-size', inc)
          console.log("success")
      }
      
    })

    $('#dec').click( function() {

      var dec = parseInt(style.fontSize) - 2
      if(dec >= 12) {
        $("ul, .u-body, .custom").css('font-size', dec)
        console.log("decrease")
      }

    })

    $('#default').click(function () {
      console.log("default")
        $("ul, .u-body, .custom").css('font-size', 16)
        //$("u-custom-font").css('font-size', 12)
    })

    // Blue
    $('#blue').click( function () {
      console.log("blue")
      //$(".u-header, u-custom-font").css('color', '#39B0EB')
      $('.u-header, .u-footer, .content').css('background-image', 'linear-gradient(to right, white, #39B0EB)')
      $('.color_custom, .header-change, .footer-change').css('background-color', '#d1d8d8')
    })

    // Grey
    $('#grey').click( function () {
      console.log("grey")
		//$(".u-header, header").css('color', '#d1d8d8')
      $('.u-header, .u-footer, .content').css('background-image', 'linear-gradient(to right, white, #d1d8d8)')
      $('.color_custom, .header-change, .footer-change, .content').css('background-color', '#AF601A')
    })

    // Mint Green
    $('#mintgreen').click( function () {
      console.log("mint green")
      //$('.u-header, header').css('color', '#98ff98')
      $('.u-header, .u-footer, .content').css('background-image', 'linear-gradient(to right, white, #98ff98)')
      $('.color_custom, .header-change, .footer-change, .content').css('background-color', '#d1d8d8')
    })
      
    // Black
    $('#black').click( function() {
      //$('.u-header, header').css('color', '#000000')
      $('.u-header, .u-footer').css('background-image', 'linear-gradient(to right, white, #ebac05)')
      $('.color_custom, .header-change, .footer-change').css('background-color', '#ebac05')
      $('.content').css({'background-color':'#ebac05', 'background-image': ''})
    })

})
</script>
</html>
