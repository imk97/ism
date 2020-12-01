<?php
defined('_JEXEC') or die;

ob_start();
?>
	<nav class="u-align-left u-menu u-menu-dropdown u-offcanvas u-menu-1">
        <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700;">
          <a class="u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-white u-text-hover-custom-color-1 u-text-white" href="#">
            <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</symbol>
</defs></svg>
          </a>
        </div>
        <div class="u-custom-menu u-nav-container">
          [[menu]]
        </div>
        <div class="u-custom-menu u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-sidenav-overflow">
              <div class="u-menu-close"></div>
              [[responsive_menu]]
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
<?php
$menuTemplate = processPositions(ob_get_clean());


if (!function_exists('buildMenu')) {
	function buildMenu($list, $default_id, $active_id, $path, $options)
	{
		ob_start();
		?>
		<ul class="<?php echo $options['menu_class']; ?>">
			<?php foreach ($list as $i => &$item) {

				$class = 'item-' . $item->id;

				if ($item->id == $default_id) {
					$class .= ' default';
				}

                $itemIsCurrent = false;
				if (($item->id == $active_id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active_id)) {
					$class .= ' current';
                    $itemIsCurrent = true;
				}

				if (in_array($item->id, $path)) {
					$class .= ' active';
				} elseif ($item->type == 'alias') {
					$aliasToId = $item->params->get('aliasoptions');

					if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
						$class .= ' active';
					} elseif (in_array($aliasToId, $path)) {
						$class .= ' alias-parent-active';
					}
				}

				if ($item->type == 'separator') {
					$class .= ' divider';
				}

				if ($item->deeper) {
					$class .= ' deeper';
				}

				if ($item->parent) {
					$class .= ' parent';
				}

				echo '<li class="' . ($item->level == 1 ? $options['item_class'] : $options['submenu_item_class']) . ' ' . $class . '">';
				$linkClassName = $item->level == 1 ? $options['link_class'] : $options['submenu_link_class'];
                $linkInlineStyles = $item->level == 1 ? $options['link_style'] : $options['submenu_link_style'];
				switch ($item->type) :
					case 'separator':
					case 'component':
					case 'heading':
					case 'url':
						require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
						break;

					default:
						require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
						break;
				endswitch;

				// The next item is deeper.
				if ($item->deeper) {
					echo '<div class="u-nav-popup"><ul class="' . $options['submenu_class'] . '">';
				} // The next item is shallower.
				elseif ($item->shallower) {
					echo '</li>';
					echo str_repeat('</ul></div></li>', $item->level_diff);
				} // The next item is on the same level.
				else {
					echo '</li>';
				}
			}
			?></ul>
		<?php
		return ob_get_clean();
	}
}

$menu_html = buildMenu($list, $default_id, $active_id, $path, array(
		'container_class' => 'u-align-left u-menu u-menu-dropdown u-offcanvas u-menu-1',
		'menu_class' => 'u-nav u-spacing-20 u-unstyled u-nav-1',
		'item_class' => 'u-nav-item',
		'link_class' => 'u-border-active-palette-1-base u-border-hover-palette-1-base u-button-style u-nav-link u-text-active-white u-text-hover-custom-color-1 u-text-white',
        'link_style' => 'padding: 10px 12px;',
		'submenu_class' => 'u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-block-d557-38',
		'submenu_item_class' => 'u-nav-item',
		'submenu_link_class' => 'u-button-style u-nav-link u-white',
        'submenu_link_style' => ''
	)
);

$resp_menu = buildMenu($list, $default_id, $active_id, $path, array(
		'container_class' => 'u-align-left u-menu u-menu-dropdown u-offcanvas u-menu-1',
		'menu_class' => 'u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2',
		'item_class' => 'u-nav-item',
		'link_class' => 'u-button-style u-nav-link',
        'link_style' => 'padding: 10px 12px;',
		'submenu_class' => 'u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-block-d557-39',
		'submenu_item_class' => 'u-nav-item',
		'submenu_link_class' => 'u-button-style u-nav-link',
        'submenu_link_style' => ''
	)
);

if (preg_match('#<ul[\s\S]*ul>#', $resp_menu, $m)) {
	$responsive_nav = $m[0];
	if (preg_match('#<ul[\s\S]*ul>#', $menu_html, $m)) {
		$regular_nav = $m[0];
		$menu_html = strtr($menuTemplate, array('[[menu]]' => $regular_nav, '[[responsive_menu]]' => $responsive_nav));
		$menu_html = preg_replace('#<\/li>\s+<li#', '</li><li', $menu_html); // remove spaces
		echo $menu_html;
	}
}
