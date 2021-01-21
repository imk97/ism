<?php // no direct access

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

?>



<div class="cart-items">
    <table class="table table-hover">

        <?php foreach ($this->lineitemcontainer->getLineItems() as $lineitem) :
            /** @var EventgalleryLibraryImagelineitem $lineitem */
            ?>
            <tr class="cart-item">
                <td>
                    <div class="lineitem-container">
                        <div class="image">
                            <?php echo $lineitem->getOrderThumb(); ?>
                        </div>

                        <div class="information">
                            <span class="quantity"><?php echo JText::_('COM_EVENTGALLERY_LINEITEM_QUANTITY') ?>: <?php echo $lineitem->getQuantity() ?></span>
                            <?php $this->lineitem = $lineitem; echo $this->loadSnippet('/checkout/image_details'); ?>
                            <?php IF (strlen($lineitem->getBuyerNote())>0): ?>
                                <p class="buyernote"><blockquote><?php echo nl2br($this->escape($lineitem->getBuyerNote())); ?></blockquote></p>
                            <?php ENDIF; ?>
                            <p class="imagetype-details">
                                <?php IF($lineitem->getImageType() != null): ?>
                                    <span class="displayname"><?php echo $lineitem->getImageType()->getDisplayName() ?></span>
                                    <span class="description"><?php echo $lineitem->getImageType()->getDescription() ?></span>
                                    <span class="filename"><?php echo \Joomla\CMS\Language\Text::_('COM_EVENTGALLERY_IMAGE_ID'). $lineitem->getFolderName().'/'.$lineitem->getFileName() ?></span>
                                    <span class="singleprice"><?php echo JText::sprintf('COM_EVENTGALLERY_LINEITEM_PRICE_PER_ITEM_WITH_PLACEHOLDER', $lineitem->getSinglePrice()) ?></span>
                                <?php ENDIF; ?>
                            </p>
                        </div>

                        <div class="price">
                            <?php echo $lineitem->isPriceIncluded()? JText::_("COM_EVENTGALLERY_LINEITEM_PRICE_INCLUDED") : $lineitem->getPrice(); ?>
                        </div>
                    </div>

                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
