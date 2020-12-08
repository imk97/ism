<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
require_once dirname(__FILE__) . '/helper.php';

$user = JFactory::getUser();

$loggedIn = '0';
if($user->id != 0) $loggedIn = '1';

$items = json_decode($module->params);
$id = $module->id;

$poll_id = $params->get('question', '1');
$poll = ModQluePollHelper::getPoll($poll_id);

$input = JFactory::getApplication()->input;
$ip = $input->server->get('REMOTE_ADDR');
$allowed = var_export(ModQluePollHelper::checkIfAllowed($poll, $ip), true);

$requireAuth = $params->get('requireAuth');
$mid = $user->id;
$rua = $requireAuth;

$showBorder = $params->get('showBorder');
$width = $params->get('width');
$height = $params->get('height');
$borderRadius = $params->get('borderRadius');
$borderColour = $params->get('borderColour');
$backgroundColour = $params->get('backgroundColour');
$textColour = $params->get('textColour');

$graphFillColour = $params->get('graphFillColour');
$graphTooltip = $params->get('graphTooltip');

$tableRadius = $params->get('tableRadius');
$tableBackground = $params->get('tableBackground');
$tableBackground2 = $params->get('tableBackground2');

$hideCount = ($params->get('hidecount', '1') == '1');
if($hideCount == null) $hideCount = 0;
$displayType = $params->get('displaytype', 'table');
$displayFigure = $params->get('displayfigure', 'percentage');
$displayCaptcha = $params->get('displaycaptcha', '0');

$poll->displayCaptcha = $displayCaptcha;

jimport('joomla.application.component.helper');
$params = JComponentHelper::getParams('com_qluepoll');
$captchaKey = $params->get('recaptureSite');

// $input = new JInput;
// $post = $input->getArray($_POST);

// if(array_key_exists('submit', $post)) {
//     $awnser = $input->get('poll');

//     if(!$awnser) {
//         return false;
//     }

//     ModQluePollHelper::submit($poll, $awnser);
// }

// $poll = ModQluePollHelper::getPoll($poll_id);

require JModuleHelper::getLayoutPath('mod_qluepoll', $params->get('layout', 'default'));

