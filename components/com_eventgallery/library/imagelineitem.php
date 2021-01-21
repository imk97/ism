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


class EventgalleryLibraryImagelineitem extends EventgalleryLibraryLineitem
{

    /**
     * @var EventgalleryLibraryFile
     */
    protected $_file = null;
    /**
     * @var EventgalleryLibraryImagetype
     */
    protected $_imagetype = null;

    /**
     * @var string
     */
    protected $_lineitem_table = 'Imagelineitem';

    protected $_ls_caption = NULL;

    protected $_ls_title = NULL;

    /**
     * creates the lineitem object. The given $lineitem can be an stdClass object or a id of a line item.
     * This is necessary since a lineitemcontainer can already preload it's line items with a single query.
     *
     * @param $lineitem
     */
    function __construct($lineitem)
    {
        parent::__construct($lineitem);

        $this->_ls_title = new EventgalleryLibraryDatabaseLocalizablestring($this->_lineitem->original_filetitle);
        $this->_ls_caption = new EventgalleryLibraryDatabaseLocalizablestring($this->_lineitem->original_filecaption);
    }


    /**
     * @return string
     */
    public function getMiniCartThumb()
    {
        return $this->getFile()->getMiniCartThumb($this);
    }

    /**
 * @return string
 */
    public function getCartThumb()
    {
        if ($this->getFile() != null) {
            return $this->getFile()->getCartThumb($this);
        }

        return "";
    }

    /**
     * @return string
     */
    public function getOrderThumb()
    {
        if ($this->getFile() != null) {
            return $this->getFile()->getOrderThumb($this);
        }

        return "";
    }

    /**
     * @return string
     */
    public function getMailThumbUrl()
    {
        if ($this->getFile() != null) {
            return $this->getFile()->getMailThumbUrl($this);
        }

        return "";
    }

    /**
     * @return EventgalleryLibraryFile|null
     */
    public function getFile()
    {
        if ($this->_file == null) {
            /**
             * @var EventgalleryLibraryFactoryFile $fileFactory
             */
            $fileFactory = EventgalleryLibraryFactoryFile::getInstance();
            $this->_file = $fileFactory->getFile($this->_lineitem->folder, $this->_lineitem->file);
        }
        return $this->_file;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->_lineitem->file;
    }

    /**
     * @return string
     */
    public function getFolderName()
    {
        return $this->_lineitem->folder;
    }

    /**
     * @return EventgalleryLibraryImagetype|null
     */
    public function getImageType()
    {
        /**
         * @var EventgalleryLibraryFactoryImagetype $imagetypeMgr
         */
        $imagetypeMgr = EventgalleryLibraryFactoryImagetype::getInstance();

        if ($this->_imagetype == null) {
            $this->_imagetype = $imagetypeMgr->getImagetypeById($this->_lineitem->imagetypeid);
        }

        return $this->_imagetype;
    }

    /**
     * @return string
     */
    public function getBuyerNote()
    {
        return $this->_lineitem->buyernote;
    }

    /**
     * @param string $note
     */
    public function setBuyerNote($note)
    {
        $this->_lineitem->buyernote = $note;
        $this->_store();
    }

    /**
     * @return string
     */
    public function getSellerNote()
    {
        return $this->_lineitem->sellernote;
    }

    /**
     * @param int $imagetypeid
     *
     * @throws Exception
     */
    public function setImageType($imagetypeid)
    {
        $newImageType = $this->getFile()->getFolder()->getImageTypeSet()->getImageType($imagetypeid);
        /* @var $newImageType EventgalleryLibraryImagetype */
        if ($newImageType == null) {
            $newImageType = $this->getFile()->getFolder()->getImageTypeSet()->getDefaultImageType();
        }

        $this->_lineitem->imagetypeid = $newImageType->getId();
        $this->_lineitem->singleprice = $newImageType->getPrice()->getAmount();
        $this->_lineitem->currency = $newImageType->getPrice()->getCurrency();
        $this->_store();
        $this->_imagetype = null;
    }

    public function getOriginalFilename() {
        return $this->_lineitem->original_filename;
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
     * Return true if the price of that item is included in the price of another line item.
     *
     * @return bool
     */
    public function isPriceIncluded() {
        return $this->_lineitem->priceincluded == 1;
    }

    /**
     * @param $isIncluded bool
     */
    public function setPriceIncluded($isIncluded) {
        $isIncluded?$this->_lineitem->priceincluded=1:$this->_lineitem->priceincluded=0;
        $this->_store();
    }
}
