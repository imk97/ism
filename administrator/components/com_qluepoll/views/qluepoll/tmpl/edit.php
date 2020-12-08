<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>

<form action="<?php echo JRoute::_('index.php?option=com_qluepoll&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo 'Details'; ?></legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php 
                        foreach($this->form->getFieldset() as $field) {
                            echo $field->renderField();        
                        }
                    ?>
                </div>
            </div>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="qluepoll.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
