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

jimport( 'joomla.application.component.model' );
jimport('joomla.html.pagination');
require_once('files.php');

class EventgalleryModelUpload extends EventgalleryModelFiles
{
    /**
     * @param string $folderStr
     * @throws Exception
     */
  public function upload($folderStr) {
      $user = JFactory::getUser();

      $canUpload = $user->authorise('core.edit','com_eventgallery');
      if (!$canUpload) {
          echo JText::_('COM_EVENTGALLERY_EVENT_UPLOAD_NO_PERMISSION');
          die();
      }

      $foldername=JFolder::makeSafe($folderStr);

      /**
       * @var EventgalleryLibraryFactoryFolder $folderFactory
       */
      $folderFactory = EventgalleryLibraryFactoryFolder::getInstance();
      $folder = $folderFactory->getFolder($foldername);

      if ($folder == null) {
          throw new Exception("Folder does not exist");
      }

      $file = null;

      $uploadedFile = \Joomla\CMS\Factory::getApplication()->input->files->get('file');
      if (!empty($uploadedFile)) {

          $filename = filter_var($uploadedFile["name"], FILTER_SANITIZE_STRING);
          $tmpFilename = $uploadedFile["tmp_name"];

          if (!in_array(strtolower(pathinfo($filename, PATHINFO_EXTENSION)), COM_EVENTGALLERY_ALLOWED_FILE_EXTENSIONS)) {
              $extension = pathinfo($filename, PATHINFO_EXTENSION);
              throw new EventgalleryLibraryExceptionUnsupportedfileextensionexception("Extension $extension not in in allowed extension list " . print_r(COM_EVENTGALLERY_ALLOWED_FILE_EXTENSIONS, true));
          }

          $file = $folder->uploadImageFile($tmpFilename, $filename, $user);

      }

      if ($file === null) {
          echo "upload failed";
          die();
      }


      echo $filename . ' done. <img alt="Done '.$filename.'" class="img-thumbnail thumbnail" src="'.$file->getThumbUrl(240).'" />';
  }

}
