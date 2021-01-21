<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

$published = $this->state->get('filter.published');
?>
<div style="display:none" class="joomla-modal modal fade show" id="collapseModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <?php if (version_compare(JVERSION, '4.0', '<' ) == 1): ?>
                    <button type="button" class="close" data-dismiss="modal">&#215;</button>
                    <h3 class="modal-title"><?php echo JText::_('COM_EVENTGALLERY_BATCH_OPTIONS');?></h3>
                <?php ELSE: ?>
                    <h3 class="modal-title"><?php echo JText::_('COM_EVENTGALLERY_BATCH_OPTIONS');?></h3>
                    <button type="button" class="close" data-dismiss="modal">&#215;</button>
                <?php ENDIF;?>

            </div>
            <div class="modal-body eg-modal-body">
                <p><?php echo JText::_('COM_EVENTGALLERY_BATCH_TIP'); ?></p>
                <div class="container">
                    <div class="row">
                        <div class="form-group control-group span6 col-md-6">
                            <div class="controls">
                                <?php echo JHtml::_('EventgalleryBatch.watermark'); ?>
                            </div>
                        </div>
                        <div class="form-group control-group span6 col-md-6">
                            <div class="controls">
                                <?php echo JHtml::_('EventgalleryBatch.imagetypeset'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group control-group span6 col-md-6">
                            <div class="controls">
                                <?php echo JHtml::_('EventgalleryBatch.usergroup'); ?>
                            </div>
                        </div>
                        <div class="form-group control-group span6 col-md-6">
                            <div class="controls">
                                <?php echo JHtml::_('EventgalleryBatch.password'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group control-group span6 col-md-6">
                            <div class="controls">
                                <?php echo JHtml::_('EventgalleryBatch.tags'); ?>
                            </div>
                        </div>
                        <?php if ($published >= 0) : ?>
                            <div class="form-group control-group span6 col-md-6">
                                <div class="controls">
                                    <?php echo JHtml::_('EventgalleryBatch.categories'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" type="button" data-dismiss="modal">
                    <?php echo JText::_('JCANCEL'); ?>
                </button>
                <button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('event.batch');">
                    <?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
