<?php
/**
 * @name		Maximenu CK params
 * @package		com_maximenuck
 * @copyright	Copyright (C) 2014. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */

defined('_JEXEC') or die;
$prefix = 'level3menustyles';
?>
<div class="ckheading"><?php echo JText::_('CK_TEXT_LABEL'); ?></div>
<div class="ckrow">
	<label for="<?php echo $prefix; ?>textgfont"><?php echo JText::_('CK_FONTSTYLE_LABEL'); ?></label>
	<img class="ckicon" src="<?php echo $this->imagespath ?>/font_add.png" />
	<input type="text" id="<?php echo $prefix; ?>textgfont" name="<?php echo $prefix; ?>textgfont" class="<?php echo $prefix; ?> cktip gfonturl" onchange="ckCleanGfontName(this);" title="<?php echo JText::_('CK_GFONT_DESC'); ?>" style="max-width:none;width:250px;" />
	<input type="hidden" id="<?php echo $prefix; ?>textisgfont" name="<?php echo $prefix; ?>textisgfont" class="isgfont <?php echo $prefix; ?>" />
</div>
<div class="ckrow">
	<label for="">&nbsp;</label><img class="ckicon" src="<?php echo $this->imagespath ?>/font.png" />
	<div class="ckbutton-group">
		<input class="<?php echo $prefix; ?>" type="radio" value="left" id="<?php echo $prefix; ?>textalignleft" name="<?php echo $prefix; ?>textalign" />
		<label class="ckbutton first" for="<?php echo $prefix; ?>textalignleft"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_align_left.png" />
		</label><input class="<?php echo $prefix; ?>" type="radio" value="center" id="<?php echo $prefix; ?>textaligncenter" name="<?php echo $prefix; ?>textalign" />
		<label class="ckbutton"  for="<?php echo $prefix; ?>textaligncenter"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_align_center.png" />
		</label><input class="<?php echo $prefix; ?>" type="radio" value="right" id="<?php echo $prefix; ?>textalignright" name="<?php echo $prefix; ?>textalign" />
		<label class="ckbutton last"  for="<?php echo $prefix; ?>textalignright"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_align_right.png" /></label>
	</div>
	<div class="ckbutton-group">
		<input class="<?php echo $prefix; ?>" type="radio" value="lowercase" id="<?php echo $prefix; ?>texttransformlowercase" name="<?php echo $prefix; ?>texttransform" />
		<label class="ckbutton first cktip" title="<?php echo JText::_('CK_LOWERCASE'); ?>" for="<?php echo $prefix; ?>texttransformlowercase"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_lowercase.png" />
		</label><input class="<?php echo $prefix; ?>" type="radio" value="uppercase" id="<?php echo $prefix; ?>texttransformuppercase" name="<?php echo $prefix; ?>texttransform" />
		<label class="ckbutton cktip" title="<?php echo JText::_('CK_UPPERCASE'); ?>" for="<?php echo $prefix; ?>texttransformuppercase"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_uppercase.png" />
		</label><input class="<?php echo $prefix; ?>" type="radio" value="capitalize" id="<?php echo $prefix; ?>texttransformcapitalize" name="<?php echo $prefix; ?>texttransform" />
		<label class="ckbutton cktip" title="<?php echo JText::_('CK_CAPITALIZE'); ?>" for="<?php echo $prefix; ?>texttransformcapitalize"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_capitalize.png" />
		</label><input class="<?php echo $prefix; ?>" type="radio" value="default" id="<?php echo $prefix; ?>texttransformdefault" name="<?php echo $prefix; ?>texttransform" />
		<label class="ckbutton cktip" title="<?php echo JText::_('CK_DEFAULT'); ?>" for="<?php echo $prefix; ?>texttransformdefault"><img class="ckicon" src="<?php echo $this->imagespath ?>/text_default.png" />
		</label>
	</div>
</div>
<div class="ckrow">
	<label for="<?php echo $prefix; ?>fontweightbold"></label>
	<img class="ckicon" src="<?php echo $this->imagespath ?>/text_bold.png" />
	<div class="ckbutton-group">
		<input class="<?php echo $prefix; ?>" type="radio" value="bold" id="<?php echo $prefix; ?>fontweightbold" name="<?php echo $prefix; ?>fontweight" />
		<label class="ckbutton first cktip" title="" for="<?php echo $prefix; ?>fontweightbold" style="width:auto;"><?php echo JText::_('CK_BOLD'); ?>
		</label><input class="<?php echo $prefix; ?>" type="radio" value="normal" id="<?php echo $prefix; ?>fontweightnormal" name="<?php echo $prefix; ?>fontweight" />
		<label class="ckbutton cktip" title="" for="<?php echo $prefix; ?>fontweightnormal" style="width:auto;"><?php echo JText::_('CK_NORMAL'); ?>
		</label>
	</div>
	<img class="ckicon" src="<?php echo $this->imagespath ?>/text_underline.png" />
	<div class="ckbutton-group">
		<input class="<?php echo $prefix; ?>" type="radio" value="underline" id="<?php echo $prefix; ?>fontunderlineunderline" name="<?php echo $prefix; ?>fontunderline" />
		<label class="ckbutton first cktip" title="" for="<?php echo $prefix; ?>fontunderlineunderline" style="width:auto;"><?php echo ucfirst(JText::_('CK_UNDERLINE')); ?>
		</label><input class="<?php echo $prefix; ?>" type="radio" value="none" id="<?php echo $prefix; ?>fontunderlinenone" name="<?php echo $prefix; ?>fontunderline" />
		<label class="ckbutton cktip" title="" for="<?php echo $prefix; ?>fontunderlinenone" style="width:auto;"><?php echo JText::_('CK_NORMAL'); ?>
		</label>
	</div>
</div>

<div class="ckrow">
	<label for="level3itemnormalstylesfontsize"><?php echo JText::_('CK_TITLEFONTSTYLES_LABEL'); ?></label>
	<img class="ckicon" src="<?php echo $this->imagespath ?>/style.png" />
	<input type="text" id="level3itemnormalstylesfontsize" name="level3itemnormalstylesfontsize" class="level3itemnormalstyles cktip" style="width:45px;" title="<?php echo JText::_('CK_FONTSIZE_DESC'); ?>" />
	<img class="ckicon" src="<?php echo $this->imagespath ?>/color.png" />
	<span><?php echo JText::_('CK_NORMAL'); ?></span>
	<input type="text" id="level3itemnormalstylescolor" name="level3itemnormalstylescolor" class="level3itemnormalstyles cktip <?php echo $this->colorpicker_class; ?>" title="<?php echo JText::_('CK_FONTCOLOR_DESC'); ?>" />

	<img class="ckicon" src="<?php echo $this->imagespath ?>/color.png" />
	<span><?php echo JText::_('CK_HOVER'); ?></span>
	<input type="text" id="level3itemhoverstylescolor" name="level3itemhoverstylescolor" class="level3itemhoverstyles cktip <?php echo $this->colorpicker_class; ?>" title="<?php echo JText::_('CK_FONTHOVERCOLOR_DESC'); ?>" />
</div>
<div class="ckrow">
	<label for="level3itemnormalstylesdescfontsize"><?php echo JText::_('CK_DESCFONTSTYLES_LABEL'); ?></label>
	<img class="ckicon" src="<?php echo $this->imagespath ?>/style.png" />
	<input type="text" id="level3itemnormalstylesdescfontsize" name="level3itemnormalstylesdescfontsize" class="level3itemnormalstyles cktip" style="width:45px;" title="<?php echo JText::_('CK_FONTSIZE_DESC'); ?>" />
	<img class="ckicon" src="<?php echo $this->imagespath ?>/color.png" />
	<span><?php echo JText::_('CK_NORMAL'); ?></span>
	<input type="text" id="level3itemnormalstylesdesccolor" name="level3itemnormalstylesdesccolor" class="level3itemnormalstyles cktip <?php echo $this->colorpicker_class; ?>" title="<?php echo JText::_('CK_FONTCOLOR_DESC'); ?>" />
	<img class="ckicon" src="<?php echo $this->imagespath ?>/color.png" />
	<span><?php echo JText::_('CK_HOVER'); ?></span>
	<input type="text" id="level3itemhoverstylesdesccolor" name="level3itemhoverstylesdesccolor" class="level3itemhoverstyles cktip <?php echo $this->colorpicker_class; ?>" title="<?php echo JText::_('CK_FONTHOVERCOLOR_DESC'); ?>" />
</div>