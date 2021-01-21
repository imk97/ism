<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\Application\Event\ApplicationEvent;
use Joomla\CMS\Console\Loader\WritableLoaderInterface;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;
use Joomla\CMS\Factory;
use Joomla\DI\Container;
use Joomla\Component\Eventgallery\Site\Library\Commands;

// no direct access
defined('_JEXEC') or die;


if (version_compare(JVERSION, '4.0', '<' ) == 1) {
    return;
}

/**
 * Adds commands to the Joomla console
 *
 * @package     Joomla.Plugin
 * @since       2.5
 */
class Plgsystemeventgalleryconsole extends CMSPlugin implements SubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        if (version_compare(JVERSION, '4.0', '<' ) == 1) {
            return [];
        }

        return [
            \Joomla\Application\ApplicationEvents::BEFORE_EXECUTE => 'registerCommand',
        ];
    }

    public function registerCommand(ApplicationEvent $event): void
    {
        $serviceId = 'eventgallery.create-local-thumbnails';

        Factory::getContainer()->share(
            $serviceId,
            function (Container $container) {
                // do stuff to create command class and return it
                return new Commands\CreateLocalThumbnails();
            },
            true
        );

        Factory::getContainer()->get(WritableLoaderInterface::class)->add(Commands\CreateLocalThumbnails::getDefaultName(), $serviceId);

        $serviceId = 'eventgallery.create-s3-thumbnails';

        Factory::getContainer()->share(
            $serviceId,
            function (Container $container) {
                // do stuff to create command class and return it
                return new Commands\CreateS3Thumbnails();
            },
            true
        );

        Factory::getContainer()->get(WritableLoaderInterface::class)->add(Commands\CreateS3Thumbnails::getDefaultName(), $serviceId);

        $serviceId = 'eventgallery.sync';

        Factory::getContainer()->share(
            $serviceId,
            function (Container $container) {
                // do stuff to create command class and return it
                return new Commands\Sync();
            },
            true
        );

        Factory::getContainer()->get(WritableLoaderInterface::class)->add(Commands\Sync::getDefaultName(), $serviceId);
    }

}



