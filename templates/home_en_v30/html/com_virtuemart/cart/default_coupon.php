<?php
defined('_JEXEC') or die;
?>
<input type="text" name="coupon_code" size="20" maxlength="50" class="coupon" alt="<?php echo $this->coupon_text ?>" placeholder="<?php echo $this->coupon_text ?>" value="<?php //echo $this->coupon_text; ?>" onblur="if(this.value=='') this.value='<?php echo $this->coupon_text; ?>';" onfocus="if(this.value=='<?php echo $this->coupon_text; ?>') this.value='';" />
<br />
<input class="details-button" type="submit" name="setcoupon" title="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>"/>