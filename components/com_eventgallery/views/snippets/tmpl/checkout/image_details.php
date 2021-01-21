<?php // no direct access

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

$config = $this->config;
$lineitem = $this->lineitem;
?>
<?php IF($config->getCheckout()->doShowFileDetails($lineitem->getFileTitle(), $lineitem->getFileCaption())): ?>
    <div class="image-details">

        <?php IF($config->getCheckout()->doShowFileTitle($lineitem->getFileTitle())): ?>
            <span class="eg-file-title">
                <?php echo $lineitem->getFileTitle()?>
            </span>
        <?php ENDIF; ?>

        <?php IF($config->getCheckout()->doShowFileCaption($lineitem->getFileCaption())): ?>
            <span class="eg-file-caption">
                <?php echo $lineitem->getFileCaption()?>
            </span>
        <?php ENDIF; ?>

    </div>
<?php ENDIF; ?>