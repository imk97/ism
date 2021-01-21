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
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
require_once JPATH_ROOT.'/components/com_eventgallery/config.php';


class EventgalleryLibraryFolderS3 extends EventgalleryLibraryFolderLocal
{
    const ID = 3;

    protected static $_maindir = NULL;

    public function __construct($object)
    {
        parent::__construct($object);
    }

    /**
     * syncs a local folder
     *
     * @param string $foldername
     * @return array
     */
    public static function syncFolder($foldername, $use_htacces_to_protect_original_files) {

        $db = JFactory::getDbo();
        $user = self::helpToGetUser();

        $s3 = EventgalleryLibraryCommonS3client::getInstance();
        if  (!$s3->isActive()) {
            return ["status"=>EventgalleryLibraryManagerFolder::$SYNC_STATUS_NOSYNC];
        }
        $s3Files = $s3->getObjects($s3->getBucketForOriginalImages(), $foldername.'/');

        $imageFileNames = array();
        $quotedImageFileNames = array();
        $etags = array();

        foreach ($s3Files as $s3File) {
            $key = $s3File->getKey();
            $imageFileName = basename($key);
            if ($imageFileName != $foldername && substr_count($key, '/')==1) {
                array_push($imageFileNames, $imageFileName);
                array_push($quotedImageFileNames, $db->q($imageFileName));
                // the etag is something like "foobar".. strange....
                $etags[$imageFileName] = $s3File->getCleanETag();
            }
        }


        // delete the folder if it does not exist.
        if (empty($imageFileNames)) {
            self::deleteFolder($foldername);
            return ['status' => EventgalleryLibraryManagerFolder::$SYNC_STATUS_DELTED];
        }


        // remove deleted files fromes from the database
        $query = $db->getQuery(true);
        $query->delete('#__eventgallery_file')
            ->where('folder='.$db->quote($foldername))
            ->where('file not in ('.implode(',',$quotedImageFileNames).')');
        $db->setQuery($query);
        $db->execute();

        $query = $db->getQuery(true);
        $query->select('id, file, s3_etag')
            ->from($db->quoteName('#__eventgallery_file'))
            ->where('folder='.$db->quote($foldername));
        $db->setQuery($query);
        $currentfiles = $db->loadObjectList();

        $updatedFiles = array();
        $fileToUpdate = array();

        // update the files we already know.
        foreach($currentfiles as $dbfile)
        {
            if ($dbfile->s3_etag != $etags[$dbfile->file]) {
                array_push($fileToUpdate, $dbfile->file);
            }
            array_push($updatedFiles, $dbfile->file);
        }

        # add all new files of a directory to the database
        foreach(array_diff($imageFileNames, $updatedFiles) as $filename)
        {
            if (EventgalleryLibraryCommonSecurity::isProtectionFile($filename)) {
                continue;
            }

            $created = date('Y-m-d H:i:s');

            $query = $db->getQuery(true);
            $query->insert($db->quoteName('#__eventgallery_file'))
                ->columns(
                    'folder,file,published,'
                    .'userid,created,modified,ordering'
                    )
                ->values(implode(',',array(
                    $db->quote($foldername),
                    $db->quote($filename),
                    '1',
                    $db->quote($user==null?'':$user->id),
                    $db->quote($created),
                    'now()',
                    0
                    )));
            $db->setQuery($query);
            $db->execute();

            array_push($fileToUpdate, $filename);
        }
        $db->transactionCommit();

        return ["status" => EventgalleryLibraryManagerFolder::$SYNC_STATUS_SYNC, "files" => $fileToUpdate];
    }

    public static function findNewFolders()
    {
        $addResults = Array();
        $s3 = EventgalleryLibraryCommonS3client::getInstance();
        if (!$s3->isActive()) {
            return $addResults;
        }

        $s3Files = $s3->getObjects($s3->getBucketForOriginalImages(), '');

        $folders = Array();

        foreach ($s3Files as $s3File) {
            $dirname = dirname($s3File->getKey());
            if ($dirname != '.' && strpos($dirname, '/')==false) {
                array_push($folders, dirname($s3File->getKey()));
            }
        }

        $folders = array_unique($folders);

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('folder')
            ->from($db->quoteName('#__eventgallery_folder'));
        $db->setQuery($query);
        $currentfolders = $db->loadAssocList(null, 'folder');

        # Füge Verzeichnisse in die DB ein
        foreach(array_diff($folders, $currentfolders) as $folder)
        {
            $addResult = new EventgalleryLibraryFolderAddresult();
            $addResult->setFolderName($folder);
            $addResult->setFoldertype(self::ID);
            array_push($addResults, $addResult);

            #Versuchen wir, ein paar Infos zu erraten
            if (strcmp($folder,JFolder::makeSafe($folder))!=0) {
                $addResult->setError(JText::sprintf('COM_EVENTGALLERY_SYNC_DATABASE_SYNC_ERROR_FOLDERNAME',$folder, JFolder::makeSafe($folder)));
                continue;
            }


            $break = false;
            foreach($currentfolders as $currentfolder) {
                if(strcasecmp($folder, $currentfolder) == 0 ) {
                    $addResult->setError(JText::sprintf('COM_EVENTGALLERY_SYNC_DATABASE_SYNC_ERROR_DUPLICATE_FOLDERNAME', $folder, $currentfolder));
                    $break = true;
                }
            }

            if ($break) {
                continue;
            }

        }

        return $addResults;
    }



    /**
     * adds new folder to the database and returns an array of EventgalleryLibraryFolderAddresult
     * @return array
     */
    public static function addNewFolder($foldername) {

        $user = self::helpToGetUser();
        $s3 = EventgalleryLibraryCommonS3client::getInstance();
        if (!$s3->isActive()) {
            return;
        }

        $date = "";
        $temp = array();
        $created = date('Y-m-d H:i:s');

        if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$foldername, $temp))
        {
            $date = $temp[0];
            $description = str_replace($temp[0],'',$foldername);
        }
        else {
            $description = $foldername;
        }

        $db = JFactory::getDbo();
        $db->setQuery('SELECT MAX(ordering) FROM #__eventgallery_folder');
        $max = $db->loadResult();

        $description = trim(str_replace("_", " ", $description));

        /**
         * @var EventgalleryTableFolder $table
         */
        $table = JTable::getInstance('Folder', 'EventgalleryTable');

        $table->folder = $foldername;
        $table->published = 0;
        $table->date = $date;
        $table->description = $description;
        $table->userid = $user==null?null:$user->id;
        $table->created = $created;
        $table->modified = date('Y-m-d H:i:s');
        $table->ordering = $max + 1;
        $table->foldertypeid = 3;

        $table->store();

    }

    /**
     * Calculates all Files which have missing thumbnails. To avoid calculating thumbnails
     * twice we can take over the ETags of the thumbnails
     *
     * @param bool $saveETagOfThumbnailsToDatabase
     * @return EventgalleryLibraryFile[]
     */
    public function getFilesToSync($saveETagOfThumbnailsToDatabase = false) {

        $db = JFactory::getDbo();
        $s3client = EventgalleryLibraryCommonS3client::getInstance();
        $bucket = $s3client->getBucketForThumbnails();
        $s3Files = $s3client->getObjects($bucket, $this->getFolderName().'/');

        $thumbnails = array();
        $etags = array();

        foreach ($s3Files as $s3File) {
            $key = $s3File->getKey();
            array_push($thumbnails, $key);
            $etags[$key] = $s3File->getCleanETag();
        }

        if ($saveETagOfThumbnailsToDatabase) {
            $this->updateETagsForThumbnails($etags);
        }

        $query = $db->getQuery(true);
        $query->select('id, file, s3_etag, s3_etag_thumbnails')
            ->from($db->quoteName('#__eventgallery_file'))
            ->where('folder='.$db->quote($this->getFolderName()));
        $db->setQuery($query);
        $files = $db->loadObjectList();


        $sizeSet = new EventgalleryHelpersSizeset();
        $availableSizes = $sizeSet->availableSizes;

        $result = array();

        /**
         * @var EventgalleryLibraryFactoryFile $fileFactory
         * @var EventgalleryLibraryFileS3 $fileObject
         */
        $fileFactory = EventgalleryLibraryFactoryFile::getInstance();

        foreach($files as $dbfile) {
            $fileObject = $fileFactory->getFile($this->getFolderName(), $dbfile->file);
            $thumbnail_etags = $fileObject->getETagForThumbnails();

            foreach($availableSizes as $size) {
                $cachedfilename = $fileObject->calculateS3Key($size);
                if (!in_array($cachedfilename, $thumbnails)) {
                    array_push($result, $fileObject);
                }

                if (!isset($thumbnail_etags[$cachedfilename]) || !isset($etags[$cachedfilename]) || $thumbnail_etags[$cachedfilename] != $etags[$cachedfilename] ) {
                    array_push($result, $fileObject);
                }
            }
        }
        return array_values(array_unique($result));
    }

    private function updateETagsForThumbnails($etags) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, file, s3_etag, s3_etag_thumbnails')
            ->from($db->quoteName('#__eventgallery_file'))
            ->where('folder='.$db->quote($this->getFolderName()));
        $db->setQuery($query);
        $files = $db->loadObjectList();

        foreach($files as $file) {

            $fileETags = array();
            foreach($etags as $key=>$etag) {
                if (basename($key) == $file->file) {
                    $fileETags[$key] = $etag;
                }
            }
            $db = JFactory::getDbo();
            // update the etag since it has changed.
            $query = $db->getQuery(true);
            $query->update('#__eventgallery_file')
                ->set('s3_etag_thumbnails=' . $db->quote(json_encode($fileETags)))
                ->where('id=' . $db->quote($file->id));
            $db->setQuery($query);
            $db->execute();
        }

    }

    public static function getFileFactory() {
        return EventgalleryLibraryFactoryFileS3::getInstance();
    }

    public function isSortable() {
        return true;
    }

    public function supportsFileUpload() {
        return true;
    }

    public function supportsFileDeletion() {
        return true;
    }

    public function supportsImageDataEditing() {
        return true;
    }

    public function uploadImageFile($tmpFilename, $usFilename, $user) {
        $filename = basename($usFilename);
        $filename=JFile::makeSafe($filename);

        if (!in_array(strtolower( pathinfo ( $filename , PATHINFO_EXTENSION) ), COM_EVENTGALLERY_ALLOWED_FILE_EXTENSIONS) ) {
            return null;
        }

        $s3client = EventgalleryLibraryCommonS3client::getInstance();
        $s3File = $s3client->putObjectFile($s3client->getBucketForOriginalImages(), $this->getFolderName().'/'.$filename, $tmpFilename, EventgalleryLibraryCommonS3client::ACL_PRIVATE);

        if(!$s3File){
            return null;
        }

        /**
         * @var EventgalleryLibraryFactoryFile $fileFactory
         */
        $fileFactory = EventgalleryLibraryFactoryFile::getInstance();
        $fileFactory->createFile($user, $this->getFolderName(), $filename);

        /**
         * @var EventgalleryLibraryFileS3 $file
         */
        $file =  $fileFactory->getFile($this->_foldername, $filename);
        if ($file === null) {
            return null;
        }

        $file->syncFileData($s3File, $tmpFilename);

        // reload the file since it was changed by the steps before.
        $fileFactory->clearCache($this->getFolderName(), $filename);
        $file =  $fileFactory->getFile($this->_foldername, $filename);
        $file->createThumbnails();

        if (is_file($tmpFilename)) {
            unlink($tmpFilename);
        }

        return $file;
    }
}
