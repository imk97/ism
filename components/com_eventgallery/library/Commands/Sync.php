<?php
namespace Joomla\Component\Eventgallery\Site\Library\Commands;

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

if (version_compare(JVERSION, '4.0', '<' ) == 1) {
    return;
}

class Sync extends \Joomla\Console\Command\AbstractCommand
{
    protected static $defaultName = 'eventgallery:sync';


    public function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $symfonyStyle = new \Symfony\Component\Console\Style\SymfonyStyle($input, $output);

        define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/com_eventgallery');
        define('JPATH_COMPONENT_SITE', JPATH_SITE . '/components/com_eventgallery');
        $language = Factory::getLanguage();
        $language->load('com_eventgallery' , JPATH_COMPONENT_ADMINISTRATOR, $language->getTag(), true);

        //JLoader::registerPrefix('Eventgallery', JPATH_COMPONENT_ADMINISTRATOR);
        \JLoader::registerPrefix('Eventgallery', JPATH_COMPONENT_SITE);

        $config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance();
        $use_htacces_to_protect_original_files = $config->getImage()->doUseHtaccessToProtectOriginalFiles();

        require_once(JPATH_COMPONENT_ADMINISTRATOR.'/models/sync.php');
        $syncModel = \JModelLegacy::getInstance('EventgalleryModelSync', '', array('ignore_request' => true));

        $symfonyStyle->title("Adding new Folders");

        /**
         * @var EventgalleryLibraryManagerFolder $folderMgr
         * @var EventgalleryLibraryFactoryFile $fileFactory
         */
        $folderMgr = \EventgalleryLibraryManagerFolder::getInstance();
        $fileFactory = \EventgalleryLibraryFactoryFile::getInstance();

        $addResults = $folderMgr->addNewFolders();
        foreach($addResults as $addResult) {
            /**
             * @var EventgalleryLibraryFolderAddresult $addResult
             */
            if ($addResult->getError() != null) {
                $symfonyStyle->error("ERROR: " . $addResult->getError() . "\n");
            } else {
                $symfonyStyle->write("Added: " . $addResult->getFolderName() . "\n");
            }
        }

        $folders = $syncModel->getFolders();

        $symfonyStyle->title("Synchronizing " . count($folders) . " folders");

        foreach($folders as $folder) {

            $result = $syncModel->syncFolder($folder->getFolderName(), null, $use_htacces_to_protect_original_files);

            if (isset($result['files'])) {
                $files = $result['files'];

                $symfonyStyle->write("Sync $folder with " . count($files) . " files\n\n");
                /**
                 * @var EventgalleryLibraryFile $file
                 */
                foreach ($files as $filename) {
                    $symfonyStyle->write("    (Memory usage: ".memory_get_usage().") $folder - $filename \n");
                    $file = $fileFactory->getFile($folder->getFolderName(), $filename);
                    $file->syncFile();
                }
            }

            $symfonyStyle->write("\n\n");
        }

        $symfonyStyle->success("Sync finished.");

        return 0;
    }

    protected function configure(): void
    {
        $this->setDescription('Sync filesystem with database');
        $this->setHelp(
            <<<EOF
Event Gallery - Sync
#######################

This script adds/removes/updates the data stored in the database for your local/S3 files. Usually you run this because you modified files without using the backoffice.

EOF
        );
    }
}