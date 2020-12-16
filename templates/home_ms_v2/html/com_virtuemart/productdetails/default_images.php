<?php
defined('_JEXEC') or die('Restricted access');

if (!empty($this->product->images)) {
    $image = $this->product->images[0];
    $width = VmConfig::get('img_width_full', 0);
    $height = VmConfig::get('img_height_full', 0);
    $imageHtml = '';
    if(!empty($width) or !empty($height)){
        $imageHtml = $image->displayMediaThumb("",true,"rel='vm-additional-images'", true, true, false, $width, $height);
    } else {
        $imageHtml = $image->displayMediaFull("",true,"rel='vm-additional-images'");
    }
    preg_match('/src=[\'"]([\s\S]+?)[\'"]/', $imageHtml, $matches);
    if (count($matches) > 1) {
        echo $matches[1];
    }
}