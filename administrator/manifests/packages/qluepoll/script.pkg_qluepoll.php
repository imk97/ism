<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_qluetwitter
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

class pkg_qluepollInstallerScript {

function postflight($type, $parent) {
?>
<div style="text-align:left; margin:auto" class="row">
    <div class="span4">
        <img style="" src="https://qlue.uk/images/extensions/poll.jpg"></img>
    </div>
    <div class="span5 well">
        <h1>Thanks for installing Qlue Poll Pro!</h1>
        <p>This package allows you to create polls and display them using a module.
        <!-- For a quick start guide <a>click here</a>, or follow <a>this link</a> for full documentation.</p> -->
        </p>
        <h3>Features</h3>
        <ul>
            <span class="qlue-listitem qlue-feature">Presets and custom styles</span>
            <span class="qlue-listitem qlue-feature">Ability to prevent multiple votes</span>
            <span class="qlue-listitem qlue-feature">Ability to only let logged in user votes</span>
            <span class="qlue-listitem qlue-feature">Use Recaptcha to prevent bots from voting.</span>
            <span class="qlue-listitem qlue-feature">Display votes as different charts or as a table</span>
            <span class="qlue-listitem qlue-feature">Display votes as amounts or percentages</span>
        </ul>
        <h3>Changelog <small style="color:black;">V2.0.1</small></h3>
        <ul>
            <span class="qlue-listitem"><span class="badge badge-success">Added</span> Require Login to vote option</span>
            <span class="qlue-listitem"><span class="badge badge-success">Added</span> User votes menu.</span>
            <span class="qlue-listitem"><span class="badge badge-success">Added</span> Backend graphs, including geo graph.</span>
            <span class="qlue-listitem"><span class="badge badge-success">Added</span> Front end graph options.</span>
            <span class="qlue-listitem"><span class="badge badge-success">Added</span> Ability to customise module styles.</span>
            <span class="qlue-listitem"><span class="badge badge-warning">Fixed</span> Issue with changing poll awnsers.</span>
            <span class="qlue-listitem"><span class="badge badge-danger">Removed</span> Redundant title field.</span>
        </ul>
    </div>
<div>

<style>
    /* span {
        display: block;
    } */

    .qlue-listitem {
        margin-bottom: 5px;
        display: block;
    }

    .qlue-feature {
        margin-left: 25px;
    }

    img {
        margin-bottom: 5px;
    }
</style>
<?php 
    }
} 
?>