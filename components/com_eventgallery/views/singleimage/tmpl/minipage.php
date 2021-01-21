<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
/**
 * @var \de\svenbluege\joomla\eventgallery\ObjectWithConfiguration $this
 * @var EventgalleryLibraryFile $file
 */

$file = $this->model->file;

$this->document->setMetaData("og:url", JRoute::_( 'index.php?option=com_eventgallery&view=singleimage&layout=minipage&folder='.$file->getFolderName().'&file='.$file->getFileName(), false, -1), "property");
$linkLabel = JText::_('COM_EVENTGALLERY_SINGLEIMAGE_MINIPAGE_OPEN_EVENT');
$targetUrl = JRoute::_('index.php?option=com_eventgallery&view=event&folder='.$file->getFolderName());

if ($this->config->getSocial()->doShareArticleLinks()) {
    // get and clean the article url to ensure we don't redirect to external sites.
    $app = \Joomla\CMS\Factory::getApplication();
    $articleUrl = $app->input->getString('articleurl', null);
    $uri = new \Joomla\CMS\Uri\Uri($articleUrl);
    $cleanedArticleUrl = $uri->render(\Joomla\CMS\Uri\Uri::PATH | \Joomla\CMS\Uri\Uri::QUERY);

    if (strlen($cleanedArticleUrl) > 0) {
        $targetUrl = $cleanedArticleUrl;
        $linkLabel = JText::_('COM_EVENTGALLERY_SINGLEIMAGE_MINIPAGE_OPEN_ARTICLE');
    }
}

?>
<?php IF ($this->config->getSocial()->getSharingLinkType() == 'singleimage_to_event'): ?>
    <script type="text/javascript">
        window.location = "<?php echo $targetUrl?>";
    </script>
<?php ENDIF; ?>

<?php IF ($file->hasTitle($this->config->getEvent()->doShowImageFilename(), $this->config->getEvent()->doShowExif(), $this->config->getEvent()->doShowImageTitle(), $this->config->getEvent()->doShowImageCaption())): ?>
    <?php $this->document->setTitle(strip_tags($file->getFileTitle()));?>
    <div class="well displayname"><?php echo $file->getTitle($this->config->getEvent()->doShowImageFilename(), $this->config->getEvent()->doShowExif(), $this->config->getEvent()->doShowImageTitle(), $this->config->getEvent()->doShowImageCaption()); ?></div>
<?php ELSEIF ($this->config->getEvent()->doShowImageFilename()): ?>
    <div class="well displayname"><div class="img-id"><?php echo JText::_('COM_EVENTGALLERY_IMAGE_ID'); ?> <?php echo $file->getFileName() ?></div></div>
<?php ENDIF ?>

<p>
    <a style="display: block;" href="<?php echo $targetUrl?>">
    <img style="display: block; margin: auto;" src="<?php echo  $file->getImageUrl(600, 600, false) ?>">
    </a>
</p>

<p>
    <a href="<?php echo JRoute::_('index.php?option=com_eventgallery&view=event&folder='.$file->getFolderName())?>"><?php echo $linkLabel;?></a>
</p>
