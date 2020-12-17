<?php
defined('_JEXEC') or die;
?>
<div class="output-billto">
    <?php
    $cartfieldNames = array();
    foreach ( $this->userFieldsCart['fields'] as $fields) {
        $cartfieldNames[] = $fields['name'];
    }

    foreach ($this->cart->BTaddress['fields'] as $item) {
        if(in_array($item['name'],$cartfieldNames)) {
            continue;
        }
        if (!empty($item['value'])) {
            if ($item['name'] === 'agreed') {
                $item['value'] = ($item['value'] === 0) ? vmText::_ ('COM_VIRTUEMART_USER_FORM_BILLTO_TOS_NO') : vmText::_ ('COM_VIRTUEMART_USER_FORM_BILLTO_TOS_YES');
            }
            ?><!-- span class="titles"><?php echo $item['title'] ?></span -->
            <span class="values vm2<?php echo '-' . $item['name'] ?>"><?php echo $item['value'] ?></span>
            <?php if ($item['name'] != 'title' and $item['name'] != 'first_name' and $item['name'] != 'middle_name' and $item['name'] != 'zip') { ?>
                <br class="clear"/>
                <?php
            }
        }
    } ?>
    <div class="clear"></div>
</div>

<?php
if($this->pointAddress){
    $this->pointAddress = 'required invalid';
}

?>
<a class="details <?php echo $this->pointAddress ?>" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT', $this->useXHTML, $this->useSSL) ?>" rel="nofollow">
    <?php echo vmText::_ ('COM_VIRTUEMART_USER_FORM_EDIT_BILLTO_LBL'); ?>
</a>

<input type="hidden" name="billto" value="<?php echo $this->cart->lists['billTo']; ?>"/>
