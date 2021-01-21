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

class EventgalleryLibraryFactoryFile extends EventgalleryLibraryFactoryFactory
{

    protected $_folders = Array();

    /**
     * Returns a file
     *
     * @param $foldername string
     * @param $filename string
     * @return EventgalleryLibraryFile
     */
    public function getFile($foldername, $filename) {

        if (!is_string($foldername) || !is_string($filename)) {
            throw new InvalidArgumentException("Can't create a file object with an object. Use plain Strings instead.");
        }

        if (!isset($this->_folders[$foldername][$filename])) {

            /**
             * @var EventgalleryLibraryFactoryFolder $folderFactory
             */
            $folderFactory = EventgalleryLibraryFactoryFolder::getInstance();
            $folder = $folderFactory->getFolder($foldername);

            if ($folder == null) {
                $this->_folders[$foldername][$filename] = null;
            } else {
                $fileFactory = $folder->getFileFactory();
                $this->_folders[$foldername][$filename] = $fileFactory->getFile($foldername, $filename);
            }

        }

        return $this->_folders[$foldername][$filename];
    }

    /**
     * @param $id int
     * @return EventgalleryLibraryFile|null
     */
    public function getFileById($id) {

        $query = $this->db->getQuery(true)
            ->select('folder, file')
            ->from($this->db->quoteName('#__eventgallery_file'))
            ->where('id=' . $this->db->quote((int)$id));
        $this->db->setQuery( $query );
        $data = $this->db->loadObject();

        if ($data === null) {
            return null;
        }
        return $this->getFile($data->folder, $data->file);
    }

    /**
     * @param $user
     * @param string $foldername
     * @param string $filename
     */
    public function createFile($user, string $foldername, string $filename)
    {
        $query = $this->db->getQuery(True)
            ->select('count(1)')
            ->from($this->db->quoteName('#__eventgallery_file'))
            ->where('folder=' . $this->db->quote($foldername))
            ->where('file=' . $this->db->quote($filename));
        $this->db->setQuery($query);

        if ($this->db->loadResult() == 0) {
            $query = $this->db->getQuery(true)
                ->insert($this->db->quoteName('#__eventgallery_file'))
                ->columns('folder,file,userid,created,modified,ordering')
                ->values(
                    $this->db->quote($foldername) . ',' .
                    $this->db->quote($filename) . ',' .
                    $this->db->quote($user->id) . ',' .
                    'now(),now(),0');
        } else {
            $query = $this->db->getQuery(true)
                ->update($this->db->quoteName('#__eventgallery_file'))
                ->set('userid=' . $this->db->quote($user->id))
                ->set('created=now()')
                ->set('modified=now()')
                ->where('folder=' . $this->db->quote($foldername))
                ->where('file=' . $this->db->quote($filename));
        }

        $this->db->setQuery($query);
        $this->db->execute();

        $this->clearCache($foldername, $filename);
    }

    public function clearCache($foldername, $filename) {
        unset($this->_folders[$foldername][$filename]);
    }


}
