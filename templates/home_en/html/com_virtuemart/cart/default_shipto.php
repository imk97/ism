<div class="output-shipto">
    <?php
    if($this->cart->user->virtuemart_user_id==0){

        echo vmText::_ ('COM_VIRTUEMART_USER_FORM_ST_SAME_AS_BT');
        echo VmHtml::checkbox ('STsameAsBT', $this->cart->STsameAsBT,1,0,'id="STsameAsBTjs" data-dynamic-update=1') . '<br />';
    } else if(!empty($this->cart->lists['shipTo'])){
        echo $this->cart->lists['shipTo'];
    }

    if(empty($this->cart->STsameAsBT) and !empty($this->cart->ST) and !empty($this->cart->STaddress['fields'])){ ?>
        <div id="output-shipto-display">
            <?php
            foreach ($this->cart->STaddress['fields'] as $item) {

                if($item['name']=='shipto_address_type_name') continue;
                if (!empty($item['value'])) {
                    ?>
                    <!-- <span class="titles"><?php echo $item['title'] ?></span> -->
                    <?php
                    if ($item['name'] == 'first_name' || $item['name'] == 'middle_name' || $item['name'] == 'zip') {
                        ?>
                        <span class="values<?php echo '-' . $item['name'] ?>"><?php echo $item['value'] ?></span>
                    <?php } else { ?>
                        <span class="values"><?php echo $item['value'] ?></span>
                        <br class="clear"/>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <?php
    }
    ?>
    <div class="clear"></div>
</div>
<?php if (!isset($this->cart->lists['current_id'])) {
    $this->cart->lists['current_id'] = 0;

} ?>
<a class="details" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=ST&virtuemart_user_id[]=' . $this->cart->lists['current_id'], $this->useXHTML, $this->useSSL) ?>" rel="nofollow">
    <?php echo vmText::_ ('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL'); ?>
</a>