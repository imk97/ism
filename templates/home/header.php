<?php
    $document = JFactory::getDocument();
?>
    <header class="u-clearfix u-header u-sticky u-white u-header" id="sec-c33b">
  <?php $logoInfo = getLogoInfo(array(
            'src' => "/images/c9558a31-7723-4558-9fee-f69baca119ff.png",
            'href' => "https://nicepage.com",
            'default_width' => '84'
        ), true); ?><a href="<?php echo $logoInfo['href']; ?>" class="u-image u-logo u-image-1">
    <img src="<?php echo $logoInfo['src']; ?>" class="u-logo-image u-logo-image-1" data-image-width="84.48">
  </a>
  <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/1-contact.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-2" data-image-width="31" data-image-height="29">
  <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/1-aduan.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-3" data-image-width="31" data-image-height="29">
  <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/1-FAQ.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-4" data-image-width="31" data-image-height="29">
  <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/1-sitemap.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-5" data-image-width="31" data-image-height="29">
  <form action="<?php echo JRoute::_('index.php'); ?>" class="u-border-1 u-border-grey-30 u-search u-search-left u-white u-search-1" method="post">
    <button class="u-search-button" type="submit">
      <span class="u-search-icon u-spacing-10">
        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 56.966 56.966"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-611a"></use></svg>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-611a" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" class="u-svg-content"><path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path></svg>
      </span>
    </button>
    <input class="u-search-input" type="search" name="searchword" value="" placeholder="<?php JFactory::getLanguage()->load('mod_search', JPATH_SITE); echo htmlspecialchars(JText::_('MOD_SEARCH_SEARCHBOX_TEXT'), ENT_COMPAT, 'UTF-8'); ?>"><input type="hidden" name="task" value="search">
<input type="hidden" name="option" value="com_search">

  </form>
  <h1 class="u-custom-font u-font-oswald u-text u-text-1">INSTITUT SOSIAL MALAYSIA</h1>
  <p class="u-text u-text-2">Portal Rasmi</p>
  <div class="u-align-left u-black u-container-style u-expanded-width u-group u-shape-rectangle u-group-1">
    <div class="u-container-layout u-valign-bottom u-container-layout-1">
      <div class="u-border-8 u-border-custom-color-1 u-expanded-width u-line u-line-horizontal u-line-1"></div>
      <?php echo CoreStatements::position('hmenu', '', 1, 'hmenu'); ?>
    </div>
  </div>
</header>
    