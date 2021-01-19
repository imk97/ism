<?php
    $document = JFactory::getDocument();
?>
    <header class="u-clearfix u-gradient u-header u-header" id="sec-594e">
  <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
    <div class="u-gutter-0 u-layout">
      <div class="u-layout-row">
        <div class="u-container-style u-layout-cell u-size-30-xl u-size-32-lg u-size-32-md u-size-32-sm u-size-32-xs u-layout-cell-1">
          <div class="u-container-layout u-container-layout-1">
            <div class="u-container-style u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-group-1">
              <div class="u-container-layout u-container-layout-2">
                <?php $logoInfo = getLogoInfo(array(
            'src' => "/images/jatanegara.png",
            'href' => "/ism/index.php/ms/",
            'default_width' => '99'
        ), true); ?><a href="<?php echo $logoInfo['href']; ?>" class="u-image u-logo u-image-1" data-image-width="1010" data-image-height="791" title="Logo Jata Negara">
                  <img src="<?php echo $logoInfo['src']; ?>" class="u-logo-image u-logo-image-1" data-image-width="99">
                </a>
                <p class="u-custom-font u-font-arial u-text u-text-1">SELAMAT DATANG KE LAMAN WEB RASMI</p>
                <p class="u-custom-font u-font-oswald u-text u-text-2">INSTITUT SOSIAL MALAYSIA</p>
                <p class="u-custom-font u-font-arial u-text u-text-3">KEMENTERIAN PEMBANGUNAN WANITA KELUARGA & MASYARAKAT </p>
              </div>
            </div>
          </div>
        </div>
        <div class="u-container-style u-layout-cell u-size-28-lg u-size-28-md u-size-28-sm u-size-28-xs u-size-30-xl u-layout-cell-2">
          <div class="u-container-layout u-container-layout-3">
            <div class="u-container-style u-group u-group-2">
              <div class="u-container-layout u-container-layout-4">
                <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/Color__1_-removebg-preview-removebg-preview.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-2" data-image-width="40" data-image-height="40" id="grey">
                <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/Color__2_-removebg-preview.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-3" data-image-width="40" data-image-height="40" id="mintgreen">
                <div alt="" class="u-image u-image-circle u-preserve-proportions u-image-4" data-image-width="40" data-image-height="40" data-href="#" style="background-image: url('<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/TEXT.jpg');" id="inc"></div>
                <div alt="" class="u-image u-image-circle u-preserve-proportions u-image-5" data-image-width="40" data-image-height="40" data-href="#" style="background-image: url('<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/TEXT1.jpg');" id="default"></div>
                <div alt="" class="u-image u-image-circle u-preserve-proportions u-image-6" data-image-width="40" data-image-height="40" data-href="#" style="background-image: url('<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/TEXT-.jpg');" id="dec"></div>
                <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/Color-removebg-preview.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-7" data-image-width="40" data-image-height="40" id="blue">
                <div alt="" class="u-image u-image-circle u-preserve-proportions u-image-8" data-image-width="40" data-image-height="40" style="background-image: url('<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/Color.jpg');" id="black"></div><!--position-->
                <?php $positionName = 'language-switcher'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="language-switcher" class="u-position u-position-1"><!--block-->
                  <?php echo CoreStatements::position('language-switcher', 'block%block_1', 'block_1'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
              </div>
            </div>
            <form action="<?php echo JRoute::_('index.php'); ?>" class="u-active-palette-1-base u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-expanded-width-xs u-grey-5 u-hover-palette-1-base u-search u-search-left u-search-1" method="post">
              <button class="u-search-button" type="submit">
                <span class="u-search-icon u-spacing-10">
                  <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 56.966 56.966" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-0092"></use></svg>
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-0092" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" class="u-svg-content"><path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                </span>
              </button>
              <input class="u-search-input" type="search" name="searchword" value="" placeholder="<?php JFactory::getLanguage()->load('mod_search', JPATH_SITE); echo htmlspecialchars(JText::_('MOD_SEARCH_SEARCHBOX_TEXT'), ENT_COMPAT, 'UTF-8'); ?>"><input type="hidden" name="task" value="search">
<input type="hidden" name="option" value="com_search">

            </form>
            <div class="u-align-left u-container-style u-group u-group-3">
              <div class="u-container-layout u-container-layout-5">
                <div class="u-container-style u-group u-shape-rectangle u-group-4">
                  <div class="u-container-layout u-container-layout-6">
                    <a href="/ism/index.php/ms/korporat/soalan-lazim" class="u-btn u-button-style u-none u-btn-1">
                    <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/faq.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-9" data-image-width="74" data-image-height="64">Soalan Lazim</a>
                  </div>
                </div>
                <div class="u-container-style u-group u-shape-rectangle u-group-5">
                  <div class="u-container-layout u-container-layout-7">
                    <a href="/ism/index.php/ms/hubungi-kami" class="u-btn u-button-style u-none u-btn-2">
                    <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/hubungi.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-10" data-image-width="58" data-image-height="52">Hubungi Kami</a>
                  </div>
                </div>
                <div class="u-container-style u-group u-shape-rectangle u-group-6">
                  <div class="u-container-layout u-valign-top u-container-layout-8">
                    <a href="/ism/index.php/ms/peta-laman" class="u-btn u-button-style u-none u-btn-3"><img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/peta.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-11" data-image-width="70" data-image-height="63">Peta Laman</a>
                  </div>
                </div>
                <div class="u-container-style u-group u-shape-rectangle u-group-7">
                  <div class="u-container-layout u-container-layout-9">
                    <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/maklumbalas.png" alt="" class="u-image u-image-default u-preserve-proportions u-image-12" data-image-width="74" data-image-height="63" data-href="#">
                    <a href="#" class="u-btn u-button-style u-expanded-width u-none u-btn-4">Aduan &amp;&nbsp;Maklumbalas</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="u-align-left u-border-6 u-border-palette-3-base u-expanded-width u-line u-line-horizontal u-line-1"></div>
  <div class="u-black u-container-style u-expanded-width u-group u-shape-rectangle u-group-8">
    <div class="u-container-layout u-valign-top-xs u-container-layout-10"></div>
  </div>
  <div class="u-clearfix u-layout-wrap u-layout-wrap-2">
    <div class="u-gutter-0 u-layout">
      <div class="u-layout-row">
        <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-3">
          <div class="u-container-layout u-valign-bottom-xl u-valign-middle-md u-container-layout-11">
            <?php echo CoreStatements::position('hmenu', '', 1, 'hmenu'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
    