<section class="u-clearfix u-section-1" id="sec-84ef">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-cart u-cart-1">
      <div class="u-cart-products-table u-table u-table-responsive">
        <?php $tableHeaders = $cart->getProductListHeaders(); ?><table class="u-table-entity">
          <colgroup>
            <col width="65%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
          </colgroup>
          <thead class="u-table-header">
            <tr>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php echo $tableHeaders[0]; ?></th>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php echo $tableHeaders[1]; ?></th>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php echo $tableHeaders[2]; ?></th>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php echo $tableHeaders[3]; ?></th>
            </tr>
          </thead>
          <tbody class="u-table-body">
            <?php $productItems = $cart->getProductItems(); foreach($productItems as $itemIndex => $productItem): ?>
                    <?php if ($itemIndex % 2 === 0) : ?>
                    <tr>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell"><span class="u-cart-remove-item u-icon u-icon-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 52 52" x="0px" y="0px" style="width: 1em; height: 1em;"><g><path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
		S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"></path><path d="M35.707,16.293c-0.391-0.391-1.023-0.391-1.414,0L26,24.586l-8.293-8.293c-0.391-0.391-1.023-0.391-1.414,0
		s-0.391,1.023,0,1.414L24.586,26l-8.293,8.293c-0.391,0.391-0.391,1.023,0,1.414C16.488,35.902,16.744,36,17,36
		s0.512-0.098,0.707-0.293L26,27.414l8.293,8.293C34.488,35.902,34.744,36,35,36s0.512-0.098,0.707-0.293
		c0.391-0.391,0.391-1.023,0-1.414L27.414,26l8.293-8.293C36.098,17.316,36.098,16.684,35.707,16.293z"></path>
</g></svg><img></span><?php echo $productItem['delete-button'] . $productItem['update-button'] . $productItem['position']; ?>
                <img class="u-cart-product-image u-image u-image-default u-product-control" src="<?php echo $productItem['image']; ?>">
                <h2 class="u-cart-product-title u-product-control u-text u-text-1">
                  <a class="u-product-title-link" href="<?php echo $productItem['name-url']; ?>"><?php echo $productItem['name']; ?></a>
                </h2>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-price u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price"><?php echo $productItem['prices']; ?></div>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-quantity u-product-control u-product-quantity u-product-quantity-1">
                  <div class="u-hidden u-quantity-label"> Quantity </div>
                  <div class="u-border-1 u-border-grey-25 u-quantity-input">
                    <a class="disabled minus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                    <?php 
                        $newQuantityInputHtml = str_replace('js-recalculate', 'js-recalculate u-border-grey-30 u-input', $productItem['quantity']);
                        $newQuantityInputHtml = str_replace('quantity-input', '', $newQuantityInputHtml);
                        echo $newQuantityInputHtml;
                        ?>
                    <a class="plus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8 M 8 4 v 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-subtotal u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price u-subtotal-price" style="font-weight: 700;"><?php echo $productItem['total-prices']; ?></div>
                  </div>
                </div>
              </td>
            </tr>
                    <?php else: ?>
            
            <tr>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell"><span class="u-cart-remove-item u-icon u-icon-3"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 52 52" x="0px" y="0px" style="width: 1em; height: 1em;"><g><path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
		S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"></path><path d="M35.707,16.293c-0.391-0.391-1.023-0.391-1.414,0L26,24.586l-8.293-8.293c-0.391-0.391-1.023-0.391-1.414,0
		s-0.391,1.023,0,1.414L24.586,26l-8.293,8.293c-0.391,0.391-0.391,1.023,0,1.414C16.488,35.902,16.744,36,17,36
		s0.512-0.098,0.707-0.293L26,27.414l8.293,8.293C34.488,35.902,34.744,36,35,36s0.512-0.098,0.707-0.293
		c0.391-0.391,0.391-1.023,0-1.414L27.414,26l8.293-8.293C36.098,17.316,36.098,16.684,35.707,16.293z"></path>
</g></svg><img></span><?php echo $productItem['delete-button'] . $productItem['update-button'] . $productItem['position']; ?>
                <img class="u-cart-product-image u-image u-image-default u-product-control" src="<?php echo $productItem['image']; ?>">
                <h2 class="u-cart-product-title u-product-control u-text u-text-3">
                  <a class="u-product-title-link" href="<?php echo $productItem['name-url']; ?>"><?php echo $productItem['name']; ?></a>
                </h2>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-price u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price"><?php echo $productItem['prices']; ?></div>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-quantity u-product-control u-product-quantity u-product-quantity-3">
                  <div class="u-hidden u-quantity-label"> Quantity </div>
                  <div class="u-border-1 u-border-grey-25 u-quantity-input">
                    <a class="disabled minus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                    <?php 
                        $newQuantityInputHtml = str_replace('js-recalculate', 'js-recalculate u-border-grey-30 u-input', $productItem['quantity']);
                        $newQuantityInputHtml = str_replace('quantity-input', '', $newQuantityInputHtml);
                        echo $newQuantityInputHtml;
                        ?>
                    <a class="plus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8 M 8 4 v 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-subtotal u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price u-subtotal-price" style="font-weight: 700;"><?php echo $productItem['total-prices']; ?></div>
                  </div>
                </div>
              </td>
            </tr><?php endif; ?><?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="u-cart-button-container">
        <?php $continueLinkProps = $cart->continueShopping(); ?><a href="<?php echo $continueLinkProps['link']; ?>" class="u-active-none u-btn u-button-style u-cart-continue-shopping u-hover-none u-none u-text-body-color u-btn-1"><span class="u-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 443.52 443.52" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8    c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712    L143.492,221.863z"></path>
</g>
</g></svg><img></span>&nbsp;<?php echo $continueLinkProps['content']; ?> 
        </a>
        <a href="#" class="u-btn u-button-style u-cart-update u-grey-5">Update Cart</a>
      </div>
      <div class="u-cart-blocks-container">
        
                        <?php $controlOptions = array(
                            'inputClass' => 'u-border-1 u-border-grey-30 u-input u-input-rectangle',
                            'inputTemplate' => '<input type="text" placeholder="Coupon code" id="name-5861" name="coupon" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">',
                            'buttonClass' => 'u-btn u-btn-submit u-button-style',
                            'buttonTemplate' => '<a href="#" class="u-btn u-btn-submit u-button-style">Apply Coupon</a>',
                        ); ?>
                        <?php $cartBlocks = $cart->getCartBlocks($controlOptions); ?>
                        <?php foreach ($cartBlocks as $blockName => $cartBlock) : ?>
                        <?php if ($blockName !== 'cartTotals') : ?>
                        <div class="u-cart-block u-indent-30">
          <div class="u-cart-block-container u-clearfix">
            <h5 class="u-cart-block-header u-text"><?php echo $cartBlock['header']; ?></h5>
            <div class="u-cart-block-content u-text"><?php echo $cartBlock['content']; ?></div>
          </div>
        </div>
                        <?php else : ?>
                    
        <?php 
                        $cartTotals = $cartBlock['content']; ?>
                        <div class="u-cart-block u-cart-totals-block u-indent-30">
          <div class="u-cart-block-container u-clearfix">
            <h5 class="u-cart-block-header u-text"><?php echo $cartTotals['header']; ?></h5>
            <div class="u-align-right u-cart-block-content u-text">
              <div class="u-cart-totals-table u-table u-table-responsive">
                <table class="u-table-entity">
                  <colgroup>
                    <col width="50%">
                    <col width="50%">
                  </colgroup>
                  <tbody class="u-align-right u-table-body">
                    <tr>
                      <td class="u-align-left u-border-1 u-border-grey-dark-1 u-first-column u-table-cell u-table-cell-17"><?php echo $cartTotals['subtotalText']; ?></td>
                      <td class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php echo $cartTotals['subtotal']; ?></td>
                    </tr>
                    <tr>
                      <td class="u-align-left u-border-1 u-border-grey-dark-1 u-first-column u-table-cell u-table-cell-19"><?php echo $cartTotals['totalText']; ?></td>
                      <td class="u-border-1 u-border-grey-dark-1 u-table-cell u-table-cell-20"><?php echo $cartTotals['total']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <a href="#" class="u-btn u-button-style u-cart-checkout-btn u-btn-4"><?php echo $cartTotals['checkoutBtnText']; ?></a>
            </div>
          </div>
        </div>
                        <?php echo $cartTotals['checkoutBtn']; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        
      </div>
    </div>
  </div>
</section>
