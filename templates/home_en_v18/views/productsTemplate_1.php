<?php if(!empty($this->orderByList)) : ?><section class="u-clearfix u-section-2" id="sec-b02b">
  <div class="u-clearfix u-sheet u-sheet-1">
    <?php 
$GLOBALS['theme_pagination_styles'] = array(
    'ul' => 'style="" class="responsive-style1 u-pagination u-unstyled u-pagination-1"',
    'li' => 'style="" class="u-nav-item u-pagination-item"',
    'link' => 'style="padding: 16px 28px;" class="u-button-style u-nav-link"'
);
?><?php if (property_exists($this, 'vmPagination')) { echo $this->vmPagination->getPagesLinks();  }  ?>
  </div>
</section><?php endif; ?>