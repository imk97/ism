<?php ob_start(); ?>
<section class="u-align-center u-clearfix u-section-1" id="sec-4c37">
  <div class="u-clearfix u-sheet u-valign-middle-sm u-valign-top-lg u-valign-top-xl u-sheet-1"><!--product--><!--product_options_json--><!--{"source":""}--><!--/product_options_json--><!--product_item-->
    <div class="u-container-style u-expanded-width u-product product u-product-1">
      <div class="u-container-layout u-container-layout-1"><!--product_gallery-->
        <?php if (count($galleryImages) < 1): ?><style>
                    .u-gallery-1 *{
                        display: none !important;
                    }
                    </style><?php endif; ?><div class="u-carousel u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-gallery u-layout-thumbnails u-lightbox u-no-transition u-product-control u-show-text-none u-thumbnails-position-left u-gallery-1" data-interval="5000" data-u-ride="carousel" id="carousel-6bc7">
          <div class="u-carousel-inner u-gallery-inner" role="listbox"><!--product_gallery_item-->
            <?php foreach($galleryImages as $index => $galleryImage): ?><div class=" u-carousel-item u-gallery-item<?php echo ($index === 0 ? " u-active": ""); ?>">
              <div class="u-back-slide">
                <img class="u-back-image u-expanded" src="<?php echo $galleryImage; ?>">
              </div>
              <div class="u-over-slide u-over-slide-1">
                <h3 class="u-gallery-heading">Sample Title</h3>
                <p class="u-gallery-text">Sample Text</p>
              </div>
            </div><?php endforeach; ?><!--/product_gallery_item--><!--product_gallery_item-->
            <!--/product_gallery_item-->
          </div>
          <a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-icon-rectangle u-opacity u-opacity-70 u-spacing-10 u-text-hover-grey-80 u-white u-carousel-control-1" href="#carousel-6bc7" role="button" data-u-slide="prev">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
          </a>
          <a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-icon-rectangle u-opacity u-opacity-70 u-spacing-10 u-text-hover-grey-80 u-white u-carousel-control-2" href="#carousel-6bc7" role="button" data-u-slide="next">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
          </a>
          <ol class="u-carousel-thumbnails u-hidden-sm u-hidden-xs u-spacing-15 u-vertical-spacing u-carousel-thumbnails-1"><!--product_gallery_thumbnail-->
            <?php foreach($galleryImages as $key => $galleryImage): ?><li class="u-active u-carousel-thumbnail" data-u-target="#carousel-6bc7" data-u-slide-to="<?php echo $key; ?>" style="width: 100px; height: 100px;">
              <img class="u-carousel-thumbnail-image u-image" src="<?php echo $galleryImage; ?>">
            </li><?php endforeach; ?><!--/product_gallery_thumbnail--><!--product_gallery_thumbnail-->
            <!--/product_gallery_thumbnail-->
          </ol>
        </div><!--/product_gallery-->
        <div class="u-align-center-lg u-align-center-sm u-align-center-xl u-align-center-xs u-align-left-md u-container-style u-expanded-width-sm u-expanded-width-xs u-group u-shape-rectangle u-group-1">
          <div class="u-container-layout u-valign-middle u-container-layout-2"><!--product_title-->
            <?php if ($title0): ?><h2 class="u-product-control u-text u-text-1">
              <?php if ($titleLink0): ?><a class="u-product-title-link" href="<?php echo $titleLink0; ?>"><?php endif; ?><?php echo $title0; ?><?php if ($titleLink0): ?></a><?php endif; ?>
            </h2><?php endif; ?><!--/product_title--><!--product_price-->
            <div class="u-product-control u-product-price u-product-price-1">
              <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
                <?php if ($productOldPrice0): ?><div class="u-hide-price u-old-price" style="text-decoration: line-through !important;"><?php echo $productOldPrice0; ?></div><?php endif; ?><!--/product_old_price--><!--product_regular_price-->
                <?php if ($productRegularPrice0): ?><div class="u-price u-text-palette-2-base" style="font-size: 1.875rem; font-weight: 700;"><?php echo $productRegularPrice0; ?></div><?php endif; ?><!--/product_regular_price-->
              </div>
            </div><!--/product_price--><!--product_button--><!--options_json--><!--{"clickType":"add-to-cart","content":""}--><!--/options_json-->
            <?php if ($productButtonText0): ?><?php if ($productButtonHtml0): ?>
                        <?php ob_start(); ?>
                        <a href="<?php echo $productButtonLink0; ?>" class="u-border-2 u-border-black u-btn u-button-style u-hover-black u-none u-product-control u-text-black u-text-hover-white u-btn-1"><?php echo $productButtonText0; ?></a>
                        <?php $buttonHtml = ob_get_clean(); ?>
                        <?php 
                            $buttonHtml = str_replace('[[button]]', $buttonHtml, $productButtonHtml0);
                            $buttonHtml = str_replace('<a', '<a name="addtocart"', $buttonHtml); 
                            echo $buttonHtml;
                        ?>
                        <?php else: ?>
                    <a href="<?php echo $productButtonLink0; ?>" class="u-border-2 u-border-black u-btn u-button-style u-hover-black u-none u-product-control u-text-black u-text-hover-white u-btn-1"><?php echo $productButtonText0; ?></a><?php endif; ?><?php endif; ?><!--/product_button-->
          </div>
        </div>
      </div>
    </div><!--/product_item--><!--/product-->
  </div>
</section>
<?php $tmpl = ob_get_clean(); ?>
<?php  
            $tmpl = str_replace('[[dynamic_quantity]]', '<input type="hidden" class="quantity-input js-recalculate" name="quantity[]" value="1">', $tmpl);
            echo $tmpl; 
            ?>
