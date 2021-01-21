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
 * @var \de\svenbluege\joomla\eventgallery\ObjectWithConfiguration $this
 */
?>

<script type="text/javascript">
    /* <![CDATA[ */

    var myGallery;

    (function(jQuery){

        /* start the eventgallery*/
        jQuery( document ).ready(function() {

	        /* Method to bring the thumb rel attribute to the right size */
	        var adjustImageSize = function () {
	            var sizeCalculator = new Eventgallery.SizeCalculator();
	            var width = jQuery('#bigimageContainer').width();

	            jQuery('#thumbs .ajax-thumbnail').each(function (index) {
	                var item = jQuery(this),
						originalwidth = item.data('width'),
						originalheight =  item.data('height'),
	                	ratio = originalwidth / originalheight,
	                	height = Math.round(width / ratio),
						secret = item.data('secret');
					
					if (secret !== undefined) {
						var secret_o = item.data('secret_o'),
							secret_h = item.data('secret_h'),
							secret_k = item.data('secret_k'),
							farm = item.data('farm'),
							server = item.data('server'),
							id = item.data('file');

						var imageUrl = sizeCalculator.getFlickrURL(farm, server, secret, secret_h, secret_k, secret_o, id, width, height, originalwidth, originalheight);
						item.attr('rel', imageUrl);
					} else {
						var googleWidth = sizeCalculator.getSize(width, height, ratio);
						item.attr('rel', sizeCalculator.adjustImageURL(item.attr('rel'), googleWidth));
					}
	            });
			},
			$pageContainer = jQuery('#pageContainer'),
			adjustWidth,
			eventgalleryAjaxResizeTimer,
			resizePage;

            adjustImageSize();

            myGallery = new Eventgallery.JSGallery2(jQuery('.ajax-thumbnail-container'), jQuery('#bigImage'), $pageContainer,
                {   'prevHandle'            : jQuery('#prev'),
                    'nextHandle'            : jQuery('#next'),
                    'countHandle'           : jQuery('#count'),                    
                    'titleTarget'           : '#bigImageDescription',
                    'showSocialMediaButton' : <?php echo ($this->config->getSocial()->doUseSocialSharingButton()  && $this->folder->isShareable())?'true':'false'?>,
                    'showCartButton'        : <?php echo $this->folder->isCartable()?'true':'false'; ?>,
                    'showCartConnector'     : <?php echo $this->config->getCart()->doShowCartConnector() && $this->folder->isCartable()==1?'true':'false'; ?>,
                    'cartConnectorLinkRel'  : '<?php echo $this->config->getCart()->getCartConnectorLinkRel()?>',
                    'lightboxRel'           : 'gallery'
                });

			// adjust the size of the pages to fit the current page width
			adjustWidth = function() {
				var width = jQuery('.ajaxpaging .navigation').last().width();
				jQuery('.navigation .page').css('width', width + 2);
			};

			adjustWidth();

			/* Method which handles the case the window got resized */
	        resizePage = function () {

	            window.clearTimeout(eventgalleryAjaxResizeTimer);

	            eventgalleryAjaxResizeTimer = setTimeout(function () {
	               adjustWidth();
	                if (myGallery != undefined) {
	                    adjustImageSize();
	                    myGallery.resetThumbs();
	                    myGallery.gotoPage(myGallery.currentPageNumber);
	                }
	            }, 500);
	        };

            window.addEventListener('load', resizePage);
            window.addEventListener('resize', resizePage);
        });
    })(eventgallery.jQuery);
    /* ]]> */
</script>
