<?php
defined('_JEXEC') or die;

require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'functions.php';
$menuType = isset($attribs['variation']) ? $attribs['variation'] : '';
$modPath = dirname(__FILE__) . '/';
$tagId = ($params->get('tag_id') != NULL) ? ' id="' . $params->get('tag_id') . '"' : '';
if ('' !== $menuType && file_exists($modPath . '/hmenu/default_hmenu_' . $attribs['id'] . '.php')) {
    include($modPath . '/hmenu/default_hmenu_' . $attribs['id'] . '.php');
} else {
    $menutype = 'default';
    ?>
    <ul class="nav menu<?php echo $class_sfx; ?>"<?php echo $tagId; ?>>
    <?php foreach ($list as $i => &$item)
    {
    	$class = 'item-' . $item->id;

    	if ($item->id == $default_id)
    	{
    		$class .= ' default';
    	}


    	if (($item->id == $active_id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active_id))
    	{
    		$class .= ' current';
    	}

    	if (in_array($item->id, $path))
    	{
    		$class .= ' active';
    	}
    	elseif ($item->type == 'alias')
    	{
    		$aliasToId = $item->params->get('aliasoptions');

    		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
    		{
    			$class .= ' active';
    		}
    		elseif (in_array($aliasToId, $path))
    		{
    			$class .= ' alias-parent-active';
    		}
    	}

    	if ($item->type == 'separator')
    	{
    		$class .= ' divider';
    	}

    	if ($item->deeper)
    	{
    		$class .= ' deeper';
    	}

    	if ($item->parent)
    	{
    		$class .= ' parent';
    	}

    	echo '<li class="' . $class . '">';

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
    	if ($item->deeper)
    	{
    		echo '<ul class="nav-child unstyled small" style="margin-top: 1px; margin-bottom: 1px;>';
    	}
    	// The next item is shallower.
    	elseif ($item->shallower)
    	{
    		echo '</li>';
    		echo str_repeat('</ul></li>', $item->level_diff);
    	}
    	// The next item is on the same level.
    	else
    	{
    		echo '</li>';
    	}
    }
    ?></ul>
    <?php
}
?>