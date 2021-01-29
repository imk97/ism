<?php
defined('_JEXEC') or die;

ob_start();
?>
	<nav class="u-align-left u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-menu-1">
              <div class="menu-collapse u-custom-font u-font-oswald" style="font-weight: 700;">
                <a class="u-button-style u-nav-link u-text-active-palette-3-base u-text-hover-palette-3-base u-text-white" href="#" style="padding: 4px 30px; font-size: calc(1em + 8px);">
                  <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-5c50"></use></svg>
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-5c50" x="0px" y="0px" viewBox="0 0 302 302" style="enable-background:new 0 0 302 302;" xml:space="preserve" class="u-svg-content"><g><rect y="36" width="302" height="30"></rect><rect y="236" width="302" height="30"></rect><rect y="136" width="302" height="30"></rect>
</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                </a>
              </div>
              <div class="u-custom-menu u-nav-container">
                [[menu]]
              </div>
              <div class="u-custom-menu u-nav-container-collapse">
                <div class="u-align-center u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
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
		'container_class' => 'u-align-left u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-menu-1',
		'menu_class' => 'u-custom-font u-font-oswald u-nav u-unstyled u-nav-1',
		'item_class' => 'u-nav-item',
		'link_class' => 'u-button-style u-nav-link u-text-active-palette-3-base u-text-hover-palette-3-base u-text-white',
        'link_style' => 'padding: 14px 32px;',
		'submenu_class' => 'u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-nav-2',
		'submenu_item_class' => 'u-nav-item',
		'submenu_link_class' => 'u-black u-button-style u-nav-link u-text-active-custom-color-1 u-text-hover-custom-color-1',
        'submenu_link_style' => ''
	)
);

$resp_menu = buildMenu($list, $default_id, $active_id, $path, array(
		'container_class' => 'u-align-left u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-menu-1',
		'menu_class' => 'u-align-center u-nav u-popupmenu-items u-unstyled u-nav-3',
		'item_class' => 'u-nav-item',
		'link_class' => 'u-button-style u-nav-link',
        'link_style' => 'padding: 14px 32px;',
		'submenu_class' => 'u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-nav-4',
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
