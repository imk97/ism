<!--product_item-->
      <div class="u-align-center u-container-style u-products-item product u-repeater-item u-white u-repeater-item-1">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1"><!--product_image-->
          <?php if ($image0) : ?><img <?php $link = $titleLink0 ? $titleLink0 : ''; if($link): ?>data-product-control="<?php echo $link; ?>"<?php endif; ?> alt="" class="u-expanded-width u-image u-image-default u-product-control u-image-1" src="<?php echo $image0; ?>"><?php else: ?><div class="hidden-image"></div><?php endif; ?><!--/product_image--><!--product_title-->
          <?php if ($title0): ?><h4 class="u-product-control u-text u-text-1">
            <?php if ($titleLink0): ?><a class="u-product-title-link" href="<?php echo $titleLink0; ?>"><?php endif; ?><?php echo $title0; ?><?php if ($titleLink0): ?></a><?php endif; ?>
          </h4><?php endif; ?><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-1">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <?php if ($productOldPrice0): ?><div class="u-hide-price u-old-price"><?php echo $productOldPrice0; ?></div><?php endif; ?><!--/product_old_price--><!--product_regular_price-->
              <?php if ($productRegularPrice0): ?><div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php echo $productRegularPrice0; ?></div><?php endif; ?><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><!--product_button--><!--options_json--><!--{"clickType":"add-to-cart"}--><!--/options_json-->
          <?php if ($productButtonText0): ?><?php if ($productButtonHtml0): ?>
                        <?php ob_start(); ?>
                        <a href="<?php echo $productButtonLink0; ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-1"><?php echo $productButtonText0; ?></a>
                        <?php $buttonHtml = ob_get_clean(); ?>
                        <?php 
                            $buttonHtml = str_replace('[[button]]', $buttonHtml, $productButtonHtml0);
                            $buttonHtml = str_replace('<a', '<a name="addtocart"', $buttonHtml); 
                            echo $buttonHtml;
                        ?>
                        <?php else: ?>
                    <a href="<?php echo $productButtonLink0; ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-1"><?php echo $productButtonText0; ?></a><?php endif; ?><?php endif; ?><!--/product_button-->
        </div>
      </div><!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item-->