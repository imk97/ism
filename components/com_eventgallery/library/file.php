<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


abstract class EventgalleryLibraryFile implements EventgalleryLibraryInterfaceImage
{

    /**
     * @var \Joomla\Component\Eventgallery\Site\Library\Configuration\Main
     */
    protected $config;

    /**
     * @var \components\com_eventgallery\site\library\Data\Exif
     */
    protected $exif;

    public $_blank_script_path = 'media/com_eventgallery/frontend/images/blank.gif';

    /**
     * @var string
     */
    protected $_filename = NULL;

    /**
     * @var string
     */
    protected $_foldername = NULL;

    /**
     * @var EventgalleryTableFile
     */
    protected $_file = NULL;

    /**
     * @var EventgalleryLibraryFolder
     */
    protected $_folder = NULL;

    protected $_ls_caption = NULL;

    protected $_ls_title = NULL;

    protected $sizeCalculator = NULL;

    protected $_doLazyLoading = true;

    /**
     * creates the lineitem object. $dblineitem is the database object of this line item
     *
     * @param $object object
     */
    function __construct($object)
    {

        if (!is_object($object)) {
            throw new InvalidArgumentException("Can't create File Object without a valid data object.");
        }

        $this->_file = $object;
        $this->_foldername = $object->folder;
        $this->_filename = $object->file;

        $this->exif = new \components\com_eventgallery\site\library\Data\Exif($this->_file->exif);

        /**
         * @var EventgalleryLibraryFactoryFolder $folderFactory
         */
        $folderFactory = EventgalleryLibraryFactoryFolder::getInstance();

        $this->_folder = $folderFactory->getFolder($object->folder);

        $this->_ls_title = new EventgalleryLibraryDatabaseLocalizablestring($this->_file->title);
        $this->_ls_caption = new EventgalleryLibraryDatabaseLocalizablestring($this->_file->caption);

        $this->config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance();
        $this->_doLazyLoading = $this->config->getImage()->doUseLazyLoadingForImages();

        if ($this->getWidth() && $this->getHeight()) {
            $this->sizeCalculator = new EventgalleryHelpersSizecalculator($this->getWidth(), $this->getHeight(), COM_EVENTGALLERY_IMAGE_ORIGINAL_MAX_WIDTH, false);
        } else {
            $this->sizeCalculator = new EventgalleryHelpersSizecalculator(1,1,1,false);
        }

    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->_filename;
    }

    /**
     * @return string
     */
    public function getFolderName() {
        return $this->_foldername;
    }

    /**
     * @return EventgalleryLibraryFolder
     */
    public function getFolder() {
        return $this->_folder;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->getFolder()->isPublished() == 1 && $this->_file->published == 1;
    }

    /**
     * checks if the image has a title to show.
     * @param $showImageID
     * @param $showExif
     * @param $showImageTitle
     * @param $showImageCaption
     * @return bool
     */
    public function hasTitle($showImageID, $showExif, $showImageTitle, $showImageCaption)
    {
        if (strlen($this->getTitle($showImageID, $showExif, $showImageTitle, $showImageCaption)) > 0) {
            return true;
        }

        return false;
    }

    /**
     * returns the title of an image.
     * @param bool $showImageID
     * @param bool $showExif
     * @param $showImageTitle
     * @param $showImageCaption
     * @return string
     */
    public function getTitle($showImageID, $showExif, $showImageTitle, $showImageCaption)
    {
        return $this->getLightBoxTitle($showImageID, $showExif, $showImageTitle, $showImageCaption);
    }

    public function getHeight() {
        return $this->_file->height;
    }

    public function getWidth() {
        return $this->_file->width;
    }

    /**
     * @return int
     */
    public function getLightboxImageWidth() {
        $width = $this->sizeCalculator->getWidth();
        if ($this->getWidth() < $width) {
            return $this->getWidth();
        }
        return $width;
    }

    /**
     * @return int
     */
    public function  getLightboxImageHeight() {
        // just in case I'll forget: use the same logic for the height as for the width to avoid any issues.
        $width = $this->sizeCalculator->getWidth();
        if ($this->getWidth() < $width) {
            return $this->getHeight();
        }
        return $this->sizeCalculator->getHeight();
    }

    /**
     *  returns a title with the following format:
     *
     *   <span class="img-caption img-caption-part1">Foo</span>[<span class="img-caption img-caption-part1">Bar</span>][<span class="img-exif">EXIF</span>]
     *
     * @param bool $showImageID
     * @param bool $showExif
     * @param $showImageTitle
     * @param $showImageCaption
     * @return string
     */
    public function getLightBoxTitle($showImageID, $showExif, $showImageTitle, $showImageCaption)
    {

        $lightBoxTitle = "";

        $fileTitle = $this->getFileTitle();

        if ($showImageTitle && isset($fileTitle) && strlen($fileTitle) > 0) {
            $lightBoxTitle .= '<span class="img-caption img-caption-part1">' . $fileTitle . '</span>';
        }

        $fileCaption = $this->getFileCaption();

        if ($showImageCaption && isset($fileCaption) && strlen($fileCaption) > 0) {
            $lightBoxTitle .= '<span class="img-caption img-caption-part2">' . $fileCaption . '</span>';
        }

        if ($showExif) {
            $exif = '<span class="img-exif">';

            $exifdata = [];
            if (isset($this->getExif()->model) && strlen($this->getExif()->model)>0) $exifdata[] = $this->getExif()->model;
            if (isset($this->getExif()->focallength) && strlen($this->getExif()->focallength)>0) $exifdata[] = $this->getExif()->focallength. "mm";
            if (isset($this->getExif()->fstop) && strlen($this->getExif()->fstop)>0) $exifdata[] = "f/" . $this->getExif()->fstop;
            if (isset($this->getExif()->exposuretime) && strlen($this->getExif()->exposuretime)>0) $exifdata[] = $this->getExif()->exposuretime;
            if (isset($this->getExif()->iso) && strlen($this->getExif()->iso)>0) $exifdata[] = "ISO " . $this->getExif()->iso;

            $exif.= implode(', ', $exifdata);
            $exif .= "</span>";

            if (count($exifdata)>0) {
                $lightBoxTitle .= $exif;
            }
        }

        if ($showImageID) {
            $lightBoxTitle .=  '<span class="img-id">'.JText::_('COM_EVENTGALLERY_IMAGE_ID').' '.$this->getFileName().'</span>';

        }


        return $lightBoxTitle;
    }

    /**
     * @param int $width
     * @param int $height
     * @param $showImageTitle
     * @param $showImageCaption
     * @return string
     */
    public function getFullImgTag($width, $height, $showImageTitle, $showImageCaption) {

        return '<img class="eg-img" src="'.JUri::root().$this->_blank_script_path.'" '.
        'style="width: '.$width.'px; '.
        'height: '.$height.'px; '.
        'background-image:url(\''.htmlspecialchars($this->getThumbUrl($width,$height,false), ENT_NOQUOTES, "UTF-8").'\'); '.
        '" '.
        'alt="'.$this->getAltContent($showImageTitle, $showImageCaption).'" />';

    }

    public function getThumbImgTag($width,  $height, $cssClass, $crop, $alternateThumbUrl, $showImageTitle, $showImageCaption) {
        $newWidth = $width;
        $newHeight = $height;

        if ($crop === false) {
            $newHeight = $this->getHeight()/$this->getWidth() * $width;
        }

        return '<img class="eg-img '.$cssClass.'" src="'.JUri::root().$this->_blank_script_path.'" '.
            'style="width: '.$newWidth.'px; '.
            'height: '.$newHeight.'px; '.
            'background-image:url(\''.htmlspecialchars($alternateThumbUrl == null ? $this->getThumbUrl($width,$height, true) : $alternateThumbUrl, ENT_NOQUOTES, "UTF-8")  .'\'); '.
            '" '.
            'alt="'.$this->getAltContent($showImageTitle, $showImageCaption).'" '.
            '/>';
    }

    /**
     * @param int $width
     * @param int $height
     * @param string $cssClass
     * @param bool|false $crop
     * @param string $customDataAttributes a string like "data-flickr-farm"
     * @param $showImageTitle
     * @param $showImageCaption
     * @return string
     */
    public function getLazyThumbImgTag($width,  $height, $cssClass, $crop, $customDataAttributes, $showImageTitle, $showImageCaption) {
        $cssClass .= ' eg-img';
        $imgTag = '<img '.
            'data-width="'.$this->getLightboxImageWidth().'" '.
            'data-height="'.$this->getLightboxImageHeight().'" '.
            $customDataAttributes.
            'data-src="' . htmlspecialchars($this->getThumbUrl($width, $height, true), ENT_NOQUOTES, "UTF-8") . '" ' .
            'src="' . JUri::root() . $this->_blank_script_path . '" ';

        if ($this->_doLazyLoading === true) {
            $imgTag .= 'class="eventgallery-lazyme '.$cssClass.'" ';
        } else {
            $imgTag .= 'class="'.$cssClass.'" ';
        }

        $imgTag.=
            'style=" width: '.$width.'px; '.
            'height: '.$height.'px; '.
            ($this->_doLazyLoading === false ? 'background-image: url(' . htmlspecialchars($this->getThumbUrl($width, $height, true), ENT_NOQUOTES, "UTF-8") . '); ' : '') .
            '" ' .
            'alt="'.$this->getAltContent($showImageTitle, $showImageCaption).'" '.
            '/>';
        return $imgTag;
    }

    public function getCartThumb($lineitem)
    {
        return '<a class="img-thumbnail thumbnail"
    						href="' . $this->getImageUrl(NULL, NULL, true) . '"
    						title="' . htmlentities($lineitem->getImageType()!=null?$lineitem->getImageType()->getDisplayName():"n/a", ENT_QUOTES, "UTF-8") . '"
    						data-title="' . htmlentities($lineitem->getImageType()!=null?$lineitem->getImageType()->getDisplayName():"n/a", ENT_QUOTES, "UTF-8") . '"
    						data-pid="'.$this->getId().'" data-width="'.$this->getLightboxImageWidth().'" data-height="'.$this->getLightboxImageHeight().'"
    						data-gid="cart"
    						data-lineitem-id="' . $lineitem->getId() . '"
    						data-eg-lightbox="cart"> ' . $this->getThumbImgTag(COM_EVENTGALLERY_IMAGE_THUMBNAIL_IN_CART_WIDTH, COM_EVENTGALLERY_IMAGE_THUMBNAIL_IN_CART_WIDTH, null, true, null, true, true) . '</a>';
    }

    /**
     * @param $lineitem EventgalleryLibraryImagelineitem
     */
    public function getMailThumbUrl($lineitem) {

        $config = JFactory::getConfig();
        $sslmode = $config->get('force_ssl', 0) == 2 ? 1 : (2);
        /**
         * @var $orderMgr EventgalleryLibraryManagerOrder
         */
        $orderMgr = EventgalleryLibraryManagerOrder::getInstance();
        $order = $orderMgr->getOrderById($lineitem->getLineItemContainerId());
        // do not use JRoute::_() here to avoid issues with protected frontend pages. 
        $url = str_replace("/administrator", "", \Joomla\CMS\Uri\Uri::base() . "index.php?option=com_eventgallery&view=download&task=mailthumb&orderid=" . $order->getId() . "&lineitemid=" . $lineitem->getId() . "&token=" . $order->getToken());

        return $url;
    }

    /**
     * @param $lineitem EventgalleryLibraryImagelineitem
     */
    public function getOrderThumb($lineitem) {

        $url = $this->getMailThumbUrl($lineitem);
        return $this->getThumbImgTag(COM_EVENTGALLERY_IMAGE_THUMBNAIL_IN_CART_WIDTH, COM_EVENTGALLERY_IMAGE_THUMBNAIL_IN_CART_WIDTH, "", true, $url ,true, true);
    }



    public function getMiniCartThumb($lineitem)
    {
        return '<a class="img-thumbnail thumbnail"
    						href="' . $this->getImageUrl(NULL, NULL, true) . '"
    						title="' . htmlentities($lineitem->getImageType()!=null?$lineitem->getImageType()->getDisplayName():"n/a", ENT_QUOTES, "UTF-8") . '"
    						data-title="' . htmlentities($lineitem->getImageType()!=null?$lineitem->getImageType()->getDisplayName():"n/a", ENT_QUOTES, "UTF-8") . '"
    						data-pid="'.$this->getId().'" data-width="'.$this->getLightboxImageWidth().'" data-height="'.$this->getLightboxImageHeight().'"
    						data-gid="cart"
    						data-lineitem-id="' . $lineitem->getId() . '"
    						data-eg-lightbox="cart"> ' . $this->getThumbImgTag(COM_EVENTGALLERY_IMAGE_THUMBNAIL_IN_MINICART_WIDTH, COM_EVENTGALLERY_IMAGE_THUMBNAIL_IN_MINICART_WIDTH, null, true, null, true, true) . '</a>';
    }

    /**
     * returns the title of an image.
     */
    public function getPlainTextTitle($showImageTitle, $showImageCaption)
    {

        if ($showImageTitle && strlen($this->getFileTitle()) > 0) {
            return strip_tags($this->getFileTitle());
        }

        if ($showImageCaption && strlen($this->getFileCaption()) > 0) {
            return strip_tags($this->getFileCaption());
        }

        return "";
    }


    /**
     * counts a hit on this file.
     */
    public function countHit() {
        return;
    }

    /**
     * returns the number of hits for this file
     *
     * @return int
     */
    public function getHitCount() {
        if (isset($this->_file->hits)) {
            return $this->_file->hits;
        }
        return 0;
    }

    /**
     * returns the content for the alt attribute of an img tag.
     * @return string
     */
    public function getAltContent($showImageTitle, $showImageCaption) {
        $content = "";

        $folderDisplayName = $this->getFolder()->getDisplayName();
        $title = $this->getPlainTextTitle($showImageTitle, $showImageCaption);

        if (strlen($folderDisplayName)>0) {
            $content .= $folderDisplayName;
        }

        if (strlen($content)>0 && strlen($title)>0) {
            $content .= ' - ';
        }

        $content .= $title;

        return htmlentities(strip_tags($content), ENT_QUOTES, "UTF-8");
    }

    /**
     * Returns the title of the image
     *
     * @param string $languageTag
     * @return string
     */
    public function getFileTitle($languageTag = null) {
        if (null == $this->_ls_title) {
            return "";
        }
        return $this->_ls_title->get($languageTag);
    }

    /**
     * Return the raw title without any language decoding magic.
     *
     * @return string
     */
    public function getRawFileTitle() {
        return $this->_file->title;
    }

    /**
     * Returns the title of the image
     *
     * @param string $languageTag
     * @return string
     */
    public function getFileCaption($languageTag = null) {
        if ($this->_ls_caption == null) {
            return "";
        }
        return $this->_ls_caption->get($languageTag);
    }

    /**
     * Return the raw caption without any language decoding magic.
     *
     * @return string
     */
    public function getRawFileCaption() {
        return $this->_file->caption;
    }

    /**
     * returns the id of the file
     * @return int
     */
    public function getId() {
        return $this->_file->id;
    }

    /**
     * Checks of the file has an url
     *
     * @return bool
     */
    public function hasUrl() {
        if (isset($this->_file->url) && strlen($this->_file->url)>0) {
            return true;
        }

        return false;
    }

    /**
     * return the url for this file
     *
     * @return string
     */
    public function getUrl() {
        if (!$this->hasUrl()) {
            return null;
        }
        return $this->_file->url;
    }

    /**
     * returns the creation date as a string with the format YYYYmmddHHiiss
     *
     * @return String
     */
    public function getCreationDateString() {
        return $this->_file->creation_date;
    }

    /**
     * @return DateTime|null
     */
    public function getCreationDate() {

        $dateStr = $this->getCreationDateString();
        if (empty($dateStr)) {
            return null;
        }

        $date = DateTime::createFromFormat('YmdHis', $dateStr);

        return $date;
    }

    /**
     * returns the ordering number of this file
     * @return int
     */
    public function getOrdering() {
        return $this->_file->ordering;
    }

    /**
     * Syncs this file with the database for example.
     */
    public function syncFile() {
        return EventgalleryLibraryManagerFolder::$SYNC_STATUS_NOSYNC;
    }

    /**
     *
     * @return boolean
     */
    public function isMainImage() {
        return $this->_file->ismainimage;
    }

    public function getOriginalFile()
    {
        return file_get_contents($this->getOriginalImageUrl());
    }

    public function isCartable() {
        return $this->getFolder()->isCartable();
    }

    public function isShareable() {
        return $this->getFolder()->isShareable();
    }

    public function getOriginalFilename() {
        return $this->getFileName();
    }

    public function getExif()
    {
        return $this->exif;
    }

    public function __toString() {
        return $this->getId() . ' ' . $this->getFolderName() . "/" . $this->getFileName();
    }

    public function deleteImageFile() {
        throw new InvalidArgumentException('unsupported method');
    }
}
