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

class CreateLocalThumbnails extends \Joomla\Console\Command\AbstractCommand
{
    protected static $defaultName = 'eventgallery:create-local-thumbnails';


    public function doExecute(InputInterface $input, OutputInterface $output): int
    {

        $symfonyStyle = new \Symfony\Component\Console\Style\SymfonyStyle($input, $output);

        $doCalculateMissingThumbnails = boolval($input->getOption('calcthumbnails'));



        define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/com_eventgallery');
        define('JPATH_COMPONENT_SITE', JPATH_SITE . '/components/com_eventgallery');

        $language = Factory::getLanguage();
        $language->load('com_eventgallery' , JPATH_COMPONENT_ADMINISTRATOR, $language->getTag(), true);

        \JLoader::registerPrefix('Eventgallery', JPATH_COMPONENT_SITE);

        require_once(JPATH_COMPONENT_ADMINISTRATOR.'/models/thumbnailgenerator.php');
        $localModel = \JModelLegacy::getInstance('EventgalleryModelThumbnailgenerator', '', array('ignore_request' => true));

        /**

         * @var EventgalleryLibraryFactoryFile $fileFactory
         * @var EventgalleryLibraryFileLocal $fileObject
         * @var EventgalleryModelThumbnailcreator $localModel
         */

        $fileFactory = \EventgalleryLibraryFactoryFile::getInstance();

        $folders = $localModel->getFolders([\EventgalleryLibraryFolderLocal::ID]);

        $symfonyStyle->title("Doing thumbnail creation for " . count($folders) . " folders");

        foreach($folders as $folder) {

            $files = $localModel->getFilesToSync($folder->getFolderName());
            $symfonyStyle->write("Folder \"$folder\" needs thumbnails for " . count($files) . " files\n\n");

            if ($doCalculateMissingThumbnails) {
                foreach ($files as $file) {
                    $symfonyStyle->write( "    (Memory usage: " . memory_get_usage() . ") $folder - $file \n");
                    $file->createThumbnails();
                }
            }

            $symfonyStyle->writeln('');
        }

        $symfonyStyle->success("Thumbnail creation finished.");

        return 0;
    }

    protected function configure(): void
    {
        $this->addOption('calcthumbnails', 'c', \Symfony\Component\Console\Input\InputArgument::OPTIONAL, '', false);
        $this->setDescription('Creates all missing local thumbnails.');
        $this->setHelp(
            <<<EOF
Event Gallery - Local Thumbnail Creator
#######################

This script calculates the thumbnails for your local images

    Command line options
        <info>--calcthumbnails=[true|false]</info> or <info>-c=true</info> 
            use this to perform the thumbnail calculation. By default this command will do a dry run. 
            
            Default: false
            
        Example php joomla.php eventgallery:create-local-thumbnails --calcthumbnails=true



EOF
        );
    }
}