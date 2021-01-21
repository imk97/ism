<?php 

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access'); 
?>


<form class="form-validate" action="<?php echo JRoute::_('index.php?option=com_eventgallery&layout=edit&id='.(int) $this->item->id); ?>" method="POST" name="adminForm" id="adminForm">


    <?php echo $this->loadSnippet('formfields'); ?>

    <h2><?php JText::_('COM_EVENTGALLERY_EMAILTEMPLATE_PREVIEW_LABEL'); ?></h2>
    <div class="well preview" id="preview"></div>
    <h2><?php JText::_('COM_EVENTGALLERY_EMAILTEMPLATE_DEMODATA_LABEL'); ?></h2>
    <pre><?php echo $this->escape(print_r($this->item->demodata, true)); ?></pre>


    <?php echo JHtml::_('form.token'); ?>
    <input type="hidden" name="option" value="com_eventgallery" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="task" value="" />
</form>
<script type="text/javascript">

    (function() {
        var oReq = new XMLHttpRequest();

        function fillPreview () {
            var preview = document.getElementById('preview');
            preview.innerHTML = oReq.response;
        }

        oReq.addEventListener("load", fillPreview);
        oReq.open("GET", '<?php echo JRoute::_('index.php?option=com_eventgallery&format=raw&view=emailtemplate&layout=preview&id='.$this->item->id, false);?>');
        oReq.send();
    })();


</script>