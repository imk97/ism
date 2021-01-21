<?php
/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport( 'joomla.application.component.controllerform' );

require_once(__DIR__.'/../controller.php');

class EventgalleryControllerCache extends JControllerForm
{

    /**
     * The root folder for the physical images
     *
     * @var string
     */

    protected $default_view = 'cache';

	public function getModel($name = 'Cache', $prefix ='EventgalleryModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    /**
     * just cancels this view
     * @param null $key
     * @return bool|void
     */
	public function cancel($key = NULL) {
		$this->setRedirect( 'index.php?option=com_eventgallery&view=eventgallery');
	}

    /**
     * starts the deletion.
     *
     * @param bool $cachable
     * @param array $urlparams
     */
    public function process(/** @noinspection PhpUnusedParameterInspection */$cachable = false, $urlparams = array()) {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $folder = trim($this->input->getString('images',''));
        $googlephotos = $this->input->getString('googlephotos', '');
        $flickr = $this->input->getString('flickr', '');
        $general = $this->input->getString('general', '');

        if (strlen($folder)>0) {
            $this->getModel()->clearImageCacheFolder($folder);
        }

        if (strlen($googlephotos)>0) {
            $this->getModel()->clearGooglePhotosCacheFolder();
        }

        if (strlen($flickr)>0) {
            $this->getModel()->clearFlickrCacheFolder();
        }

        if (strlen($general)>0) {
            $this->getModel()->clearGeneralCacheFolder();
        }

    }


}
