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


class EventgalleryLibraryFilePicasa extends EventgalleryLibraryFile
{

    /**
     * @var EventgalleryLibraryFolderPicasa
     */
    protected $_folder;

    /**
     * creates the lineitem object. The foldername can either be a string or a file data object
     *
     * @param object $object
     */
    /** @noinspection PhpMissingParentConstructorInspection */
    function __construct($object)
    {
        if (!is_object($object)) {
            throw new InvalidArgumentException("Can't create File Object without a valid data object.");
        }
        $this->_foldername = $object->folder;

        if (isset($object->file)) {
            $this->_filename = $object->file;
        }

        /**
         * @var EventgalleryLibraryFactoryFolder $folderFactory
         */
        $folderFactory = EventgalleryLibraryFactoryFolder::getInstance();

        $this->_folder = $folderFactory->getFolder($object->folder);
        $this->_file = $object;

        if (isset($this->_file->height)) {
            $this->imageRatio = $this->_file->width / $this->_file->height;
        } else {
            $this->imageRatio = 1;
        }

        $this->exif = new \components\com_eventgallery\site\library\Data\Exif($this->_file->exif);

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
     * @return EventgalleryLibraryFolderPicasa
     */
    public function getFolder() {
        return $this->_folder;
    }

    public function getFullImgTag($width, $height, $showImageTitle, $showImageCaption)
    {


        if ($this->imageRatio >= 1) {
            $height = round($width / $this->imageRatio);
        } else {
            $width = round($height * $this->imageRatio);
        }
        // css verschiebung berechnen

        return parent::getFullImgTag($width, $height, $showImageTitle, $showImageCaption);
    }

    public function getImageUrl($width, $height, $fullsize, $larger = false)
    {
        $url = "";

        if ($this->_file == null) {
            return $url;
        }

        if ($fullsize) {
            $url =  $this->_file->picasa_url_image;
        } else {
            if ($this->imageRatio < 1) {
                $url = $this->getThumbUrl($height * $this->imageRatio, $height, $larger);
            } else {
                $url =  $this->getThumbUrl($width, $width / $this->imageRatio, $larger);
            }
        }

        $url = str_replace('http://', 'https://', $url);

        return $url;
    }

    public function getThumbUrl($width = 104, $height = 104, $larger = true)
    {

        if ($this->_file == null) {
            return "";
        }

        if ($width == 0) {
            $width = 104;
        }
        if ($height == 0) {
            $height = 104;
        }


        if ($this->_file->width > $this->_file->height) {
            // querformat
            $googlewidth = $width;
            $resultingHeight = $googlewidth / $this->imageRatio;
            if ($resultingHeight < $height) {
                $googlewidth = round($height * $this->imageRatio);
            }
        } else {
            //hochformat
            $googlewidth = $height;
            $resultingWidth = $googlewidth * $this->imageRatio;
            if ($resultingWidth < $width) {
                $googlewidth = round($height / $this->imageRatio);
            }
        }


        $sizeSet = new EventgalleryHelpersSizeset();
        $saveAsSize = $sizeSet->getMatchingSize($googlewidth);

        // modify google image url. Be aware that even a normal thumb might contain a '-c'. This
        // is the case for album icons for example.
        $picasa_url_thumbnail = $this->_file->picasa_url_thumbnail;
        if (strpos($picasa_url_thumbnail, '/s104/')>0) {
            $winner = str_replace('/s104/', "/s$saveAsSize/", $picasa_url_thumbnail);
        } else {
            $winner = str_replace('/s104-c/', "/s$saveAsSize-c/", $picasa_url_thumbnail);
        }

        // let this work with HTTPS only to remove unsecure content issues
        $winner = str_replace('http://', 'https://', $winner);

        return $winner;
    }

    public function getOriginalImageUrl() {
        $url = $this->_file->picasa_url_originalimage;
        return $url;
    }

    public function getSharingImageUrl() {
        return $this->getOriginalImageUrl();
    }

}
