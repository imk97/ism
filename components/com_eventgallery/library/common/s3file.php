<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Class EventgalleryLibraryCommonS3file
 *
 * a tiny helper class to access the key and the etag of an S3Object.
 */

defined('_JEXEC') or die;

class EventgalleryLibraryCommonS3file
{
    private $ETag;
    private $key;

    public function __construct($key, $etag)
    {
        $this->ETag = $etag;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getETag()
    {
        return $this->ETag;
    }

    /**
     * @return string
     */
    public function getKey() {
         return $this->key;
    }

    /**
     * remove double quoutes at the beginning and the end of an etag
     *
     * @param $etag
     * @return String
     */
    public function getCleanETag() {
        return str_replace("\"", "", $this->getETag());
    }

}