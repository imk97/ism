<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

$task = $displayData['task'];
?>

<span class="icon-save" style="cursor: pointer" onclick="document.querySelectorAll('input[name=\'cid[]\']').forEach((cb)=>{cb.checked='checked'});  Joomla.submitform('<?php echo $task?>>.saveorder'); return false;" aria-hidden="true"></span>