<?php
/**
 * @package Nicepage Website Builder
 * @author Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

use NP\Uploader\FileUploader;
use NP\Uploader\Chunk;
use NP\Editor\SitePostsBuilder;
use NP\Editor\MenuItemsSaver;

/**
 * Class NicepageModelActions
 */
class NicepageModelActions extends JModelAdmin
{
    /**
     * NicepageModelActions constructor.
     */
    public function __construct()
    {
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');

        $adminComponentPath = JPATH_ADMINISTRATOR . '/components/com_nicepage';
        JLoader::register('Nicepage_Data_Mappers', $adminComponentPath . '/tables/mappers.php');
        JLoader::register('Nicepage_Data_Loader', $adminComponentPath . '/helpers/import.php');

        parent::__construct();
    }

    /**
     * Method to get the record form.
     *
     * @param array   $data     Data for the form. [optional]
     * @param boolean $loadData True if the form is to load its own data (default case), false if not. [optional]
     *
     * @return JForm|boolean A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_nicepage.page', 'page', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    /**
     * Get data
     *
     * @param array $data Data parameters
     *
     * @return array|JInput|string
     */
    private function _getRequestData($data) {
        $saveType = $data->get('saveType', '');
        switch ($saveType) {
        case 'base64':
            return new JInput(json_decode(base64_decode($data->get('data', '', 'RAW')), true));
            break;
        case 'chunks':
            $chunk = new Chunk();
            $ret = $chunk->save($data);
            if (is_array($ret)) {
                return array($ret);
            }
            if ($chunk->last()) {
                $result = $chunk->complete();
                if ($result['status'] === 'done') {
                    return new JInput(json_decode(base64_decode($result['data']), true));
                } else {
                    $result['result'] = 'error';
                    return array($result);
                }
            } else {
                return 'processed';
            }
            break;
        default:
        }
        return $data;
    }

    /**
     * Get service worker
     */
    public function getSw() {
        $sw = JPATH_ADMINISTRATOR . '/components/com_nicepage/assets/app/sw.js';
        if (file_exists($sw)) {
            $content = file_get_contents($sw);
            header('Content-Type: application/javascript');
            exit($content);
        }
    }

    /**
     * @param array $data Data parameters
     *
     * @return mixed|string
     */
    public function getPage($data)
    {
        $contentMapper = Nicepage_Data_Mappers::get('content');
        $list = $contentMapper->find(array('id' => $data['pageId']));
        if (count($list) > 0) {
            $item = $list[0];

            if ($item->state == 2) {
                // change article status to publish from draft
                $item->state = 1;
            }

            $titleItem = $contentMapper->find(array('title' => $data['pageTitle']));
            $checkTitle = true;
            if (count($titleItem) == 0 || count($titleItem) == 1 && $titleItem[0]->id == $item->id) {
                $checkTitle = false;
            }

            $aliasItem = $contentMapper->find(array('alias' => $item->alias));
            $checkAlias = count($aliasItem) == 1 ? false : true;

            list($title, $alias) = $this->_generateNewTitle($item->catid, array('title' => $data['pageTitle'], 'alias' => $item->alias), $checkTitle, $checkAlias);
            $item->title = $title;
            $item->alias = $alias;

            $contentMapper->save($item);

            $result = $this->_getPageData($item);
        }
        return $this->_response(
            array(
                'result' => 'done',
                'data' => $result,
            )
        );
    }

    /**
     * Main Action - Get pseudo posts to build new page
     *
     * @param JInput $data Data parameters
     *
     * @return mixed|string
     */
    public function getSitePosts($data) {
        $builder = new SitePostsBuilder();
        return $this->_response(
            array(
                'result' => 'done',
                'data' => $builder->getSitePosts($data),
            )
        );
    }

    /**
     * Save local storage key
     *
     * @param JInput $data Data parameters
     *
     * @return mixed|string
     */
    public function saveLocalStorageKey($data) {
        $data = $this->_getRequestData($data);
        if (is_string($data) || (is_array($data) && isset($data['status']) && $data['status'] === 'error')) {
            return $this->_response($data);
        }
        $json = $data->get('json', array(), 'RAW');
        $this->saveConfig(array('localStorageKey' => $json));
        return $this->_response(
            array(
                'result' => 'done',
                'data' => $json,
            )
        );
    }


    /**
     * Get site object by page id
     *
     * @return array
     */
    public function getSite()
    {
        $config = NicepageHelpersNicepage::getConfig();
        $siteSettings = isset($config['siteSettings']) ? $config['siteSettings'] : '{}';
        $site = array(
            'id' => '1',
            'isFullLoaded' => true,
            'items' => array(),
            'order' => 0,
            'publicUrl' => $this->getHomeUrl(),
            'status' => 2,
            'title' => JFactory::getConfig()->get('sitename', 'My Site'),
            'settings' => $siteSettings
        );

        $pages = array();
        $sectionsPageIds = NicepageHelpersNicepage::getSectionsTable()->getAllPageIds();
        if (count($sectionsPageIds) > 0) {
            $db = JFactory::getDBO();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__content');
            $query->where('(state = 1 or state = 0)');
            $query->where('id in (' . implode(',', $sectionsPageIds) . ')');
            $query->order('created', 'desc');
            $db->setQuery($query);
            $list = $db->loadObjectList();

            foreach ($list as $key => $item) {
                $pages[] = $this->_getPageData($item);
            }
        }
        $site['items'] = $pages;
        return $site;
    }

    /**
     *
     * @return string
     */
    public function getPageHtml()
    {
        $html = '';
        $pageId = JFactory::getApplication()->input->get('pageId', -1);
        $page = NicepageHelpersNicepage::getSectionsTable();
        if ($page->load(array('page_id' => $pageId))) {
            $props = $page->autosave_props ? $page->autosave_props : $page->props;
            $html = isset($props['html']) ? $props['html'] : '';
            $html = NicepageHelpersNicepage::processSectionsHtml($html, false);
        }
        return $html;
    }

    /**
     * @param object $postObject Cms post object
     *
     * @return array
     */
    private function _getPageData($postObject)
    {
        $head = null;
        $page = NicepageHelpersNicepage::getSectionsTable();
        if ($page->load(array('page_id' => $postObject->id))) {
            $head = isset($page->props['head']) ? $page->props['head'] : '';
        }
        $domain = JFactory::getApplication()->input->get('domain', '', 'RAW');
        $current = dirname(dirname((JURI::current())));
        $adminPanelUrl = $current . '/administrator';
        return array(
            'siteId' => '1',
            'title' => $postObject->title,
            'publicUrl' => $this->getArticleUrlById($postObject->id),
            'publishUrl' => $this->getArticleUrlById($postObject->id),
            'canShare' => false,
            'html' => null,
            'head' => $head,
            'keywords' => null,
            'imagesUrl' => array(),
            'id' => (int) $postObject->id,
            'order' => 0,
            'status' => 2,
            'editorUrl' => $adminPanelUrl . '/index.php?option=com_nicepage&task=nicepage.autostart&postid=' . $postObject->id . ($domain ? '&domain=' . $domain : ''),
            'htmlUrl' => $adminPanelUrl . '/index.php?option=com_nicepage&task=actions.getPageHtml&pageId=' . $postObject->id
        );
    }

    /**
     * Main Action - Upload new image
     *
     * @param JInput $data Data parameters
     *
     * @return bool|mixed|string
     */
    public function uploadImage($data)
    {
        $files = JFactory::getApplication()->input->files;
        if (!$files) {
            JFactory::getApplication()->enqueueMessage(JText::_('File not found'), 'error');
            return false;
        }

        $file = $files->get('async-upload');

        $imagesPaths = $this->getImagesPaths();
        $name = $file['name'];
        $file['filepath'] = $imagesPaths['realpath'] . '/' . $name;

        if (file_exists($file['filepath'])) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $name = md5($file['name'] . microtime()) . '.' . $ext;
            $file['filepath'] = $imagesPaths['realpath'] . '/' . $name;
        }

        $objectFile = new JObject($file);
        if (!JFile::upload($objectFile->tmp_name, $objectFile->filepath)) {
            JFactory::getApplication()->enqueueMessage(JText::_('Unable to upload file'), 'error');
            return false;
        }

        $info = @getimagesize($file['filepath']);
        $imagesUrl = str_replace(JPATH_ROOT, $this->getHomeUrl(), $file['filepath']);
        $imagesUrl = str_replace('\\', '/', $imagesUrl);
        return $this->_response(
            array(
                'status' => 'done',
                'image' => array(
                    'sizes' => array(
                        array(
                            'height' => @$info[1],
                            'url' => $imagesUrl,
                            'width' => @$info[0],
                        )
                    ),
                    'type' => 'image',
                    'id' => $name
                )
            )
        );
    }

    /**
     * Main Action - Save new template type of page
     *
     * @param JInput $data Data parameters
     */
    public function savePageType($data) {
        $id   = $data->get('pageId', '');
        $type = $data->get('pageType', '');
        if ($id && $type) {
            $page = NicepageHelpersNicepage::getSectionsTable();
            if ($page->load(array('page_id' => $id))) {
                $props = $page->props;
                $props['pageView'] = $type;
                $page->save(array('props' => $props));
            }
        }
    }

    /**
     * @param JInput $data     Data parameters
     * @param bool   $savePage Page save
     *
     * @return mixed|string
     */
    public function saveSiteSettings($data, $savePage = false)
    {
        if (!$savePage) {
            $data = $this->_getRequestData($data);
            if (is_string($data) || (is_array($data) && isset($data['status']) && $data['status'] === 'error')) {
                return $this->_response($data);
            }
        }

        $settings = $data->get('settings', '', 'RAW');
        if ($settings) {
            if (is_string($settings)) {
                $settings = json_decode($settings, true);
            }
            $saveAndPublish = isset($settings['saveAndPublish']) && ($settings['saveAndPublish'] == 'true' || $settings['saveAndPublish']  == '1') ? true : false;
            if (!$savePage) {
                $publishHeaderFooter = $this->saveHeaderFooter(new JInput($settings), $saveAndPublish);
            }
            $toSave = array();

            $publishCookiesSection = '';
            if (isset($settings['cookiesConsent']) && $settings['cookiesConsent']) {
                $toSave['cookiesConsent'] = json_encode($settings['cookiesConsent']);
                $publishCookiesSection = $settings['cookiesConsent']['publishCookiesSection'];
            } else {
                if (isset($settings['cookies']) && isset($settings['cookieConfirmCode'])) {
                    $currentConfig = NicepageHelpersNicepage::getConfig();
                    $defaultCookiesSection = $settings['cookiesSection'];
                    $cookiesConsent = isset($currentConfig['cookiesConsent']) ? json_decode($currentConfig['cookiesConsent'], true) : array();
                    $publishCookiesSection = isset($cookiesConsent['publishCookiesSection']) ? $cookiesConsent['publishCookiesSection'] : $defaultCookiesSection;
                    $cookiesConsent = array(
                        'hideCookies' => $settings['cookies'] == 'false' ? 'true' : 'false',
                        'cookieConfirmCode' => $settings['cookieConfirmCode'],
                        'publishCookiesSection' => $publishCookiesSection,
                    );
                    $toSave['cookiesConsent'] = json_encode($cookiesConsent);
                }
            }

            if ($saveAndPublish && !$savePage && isset($settings['publishNicePageCss']) && $settings['publishNicePageCss']) {
                list($siteStyleCssParts, $pageCssUsedIds, $headerFooterCssUsedIds, $cookiesCssUsedIds) = NicepageHelpersNicepage::processAllColors($settings['publishNicePageCss'], '', $publishHeaderFooter, $publishCookiesSection);
                $toSave['siteStyleCssParts'] = $siteStyleCssParts;
                $toSave['siteStyleCss'] = '';
                $toSave['headerFooterCssUsedIds'] = $headerFooterCssUsedIds;
                $toSave['cookiesCssUsedIds'] = $cookiesCssUsedIds;
            }

            if (isset($settings['showBrand'])) {
                $toSave['hideBacklink'] = $settings['showBrand'] === 'true' ? false : true;
            }
            if (isset($settings['backToTop'])) {
                $toSave['backToTop'] = $settings['backToTop'];
            }
            $toSave['siteSettings'] = json_encode($settings);
            $this->saveConfig($toSave);
        }
        return $this->_response(
            array(
                'result' => 'done'
            )
        );
    }

    /**
     * @param JInput $data Data parameters
     *
     * @return mixed|string
     */
    public function savePreferences($data)
    {
        $data = $this->_getRequestData($data);
        if (is_string($data) || (is_array($data) && isset($data['status']) && $data['status'] === 'error')) {
            return $this->_response($data);
        }

        $settings = $data->get('settings', '', 'RAW');
        if ($settings) {
            if (is_string($settings)) {
                $settings = json_decode($settings, true);
            }
            $disableAutoSave = isset($settings['disableAutosave']) ? $settings['disableAutosave'] : '1';
            $toSave = array('disableAutosave' => $disableAutoSave);
            $this->saveConfig($toSave);
        }
        return $this->_response(
            array(
                'result' => 'done'
            )
        );
    }

    /**
     * @param JInput $data Data parameters
     *
     * @return mixed|string
     */
    public function saveMenuItems($data)
    {
        $menuData = $data->get('menuData', '', 'RAW');
        $menuItemsSaver = new MenuItemsSaver($menuData);
        $result = $menuItemsSaver->save();
        return $this->_response($result);
    }

    /**
     * Main Action - New Save or Update page
     *
     * @param JInput $data Data parameters
     *
     * @return mixed|string
     */
    public function savePage($data)
    {
        $data = $this->_getRequestData($data);
        if (is_string($data) || (is_array($data) && isset($data['status']) && $data['status'] === 'error')) {
            return $this->_response($data);
        }

        $id = $data->get('id', '');
        $opt = $data->get('data', '', 'RAW');

        if (!$id || !$opt) {
            return $this->_response(
                array(
                    'status' => 'error',
                    'message' => 'post parameter missing',
                )
            );
        }

        $publishDialogs = $data->get('publishDialogs', '', 'RAW');
        if ($publishDialogs) {
            $this->saveConfig(array('publishDialogs' => json_encode($publishDialogs)));
        }

        $saveAndPublish = ($data->get('saveAndPublish', '') == 'true' || $data->get('saveAndPublish', '')  == '1') ? true : false;
        $isPreview = ($data->get('isPreview', '') == 'true' || $data->get('isPreview', '')  == '1') ? true : false;
        $isAutoSave = !$saveAndPublish ? true : false;

        $publishHeaderFooter = $this->saveHeaderFooter($data, $saveAndPublish, $isPreview);
        $this->saveSiteSettings($data, true);

        // properties
        $publishHtml    = isset($opt['publishHtml']) ? $opt['publishHtml'] : '';
        $publishNicePageCss = isset($opt['publishNicePageCss']) ? $opt['publishNicePageCss'] : '';

        $pageCssUsedIds = '';
        if ($saveAndPublish) {
            list($siteStyleCssParts, $pageCssUsedIds, $headerFooterCssUsedIds) = NicepageHelpersNicepage::processAllColors($publishNicePageCss, $publishHtml, $publishHeaderFooter);
            $this->saveConfig(array('siteStyleCssParts' => $siteStyleCssParts, 'headerFooterCssUsedIds' => $headerFooterCssUsedIds, 'siteStyleCss' => ''/*old property*/));
        }

        $pageId = $id;
        $pageTitle = $data->get('title', '', 'RAW');
        $pageIntro = $data->get('introHtml', '', 'RAW');

        // seo options
        $titleInBrowser = $data->get('titleInBrowser', '', 'RAW');
        $keywords       = $data->get('keywords', '', 'RAW');
        $description    = $data->get('description', '', 'RAW');
        $metaGeneratorContent = $data->get('metaGeneratorContent', '', 'RAW');
        $canonical = $data->get('canonical', '', 'RAW');

        $article = null;
        if ($pageId == '-1') {
            $article = $this->createPost(
                array(
                    'title' => $pageTitle,
                    'intro' => $pageIntro,
                    'full' => $publishHtml,
                    'seoOptions' => array(
                        'title' => $titleInBrowser,
                        'keywords' => $keywords,
                        'description' => $description
                    )
                )
            );
            $pageId = $article->id;

            $session = JFactory::getSession();
            $registry = $session->get('registry');
            $registry->set('com_content.edit.article.id', $article->id);
        } else {
            $contentMapper = Nicepage_Data_Mappers::get('content');
            $res = $contentMapper->find(array('id' => $pageId));
            if (count($res) > 0) {
                $article = $res[0];
                $article->introtext = $pageIntro;
                $article->fulltext = $publishHtml;
                $attribs = $this->_stringToParams($article->attribs ? $article->attribs : '{}');
                $attribs['article_page_title'] = $titleInBrowser;
                $article->attribs = $this->_paramsToString($attribs);

                $article->metakey = $keywords;
                $article->metadesc = $description;

                $this->_setTags($article);

                $contentMapper->save($article);
            }
        }

        // Convert base64 to html, because some servers reject requests with tags - body, meta and etc.
        $html           = isset($opt['html']) ? $opt['html'] : '';
        $head           = isset($opt['head']) ? $opt['head'] : '';
        $bodyClass      = isset($opt['bodyClass']) ? $opt['bodyClass'] : '';
        $bodyStyle      = isset($opt['bodyStyle']) ? $opt['bodyStyle'] : '';

        $fonts          = isset($opt['fonts']) ? $opt['fonts'] : '';
        if ($fonts) {
            $fonts = preg_replace('/[\"\']fonts.css[\"\']/',  '[[site_path_live]]components/com_nicepage/assets/css/fonts/fonts.css', $fonts);
            $fonts = preg_replace('/[\"\']page-fonts.css[\"\']/', '[[site_path_live]]components/com_nicepage/assets/css/fonts/page-' . $pageId . '-fonts.css', $fonts);
            $fonts = preg_replace('/[\"\']header-footer-fonts.css[\"\']/', '[[site_path_live]]components/com_nicepage/assets/css/fonts/header-footer-fonts.css', $fonts);
        }
        $this->saveLocalGoogleFonts($data->get('fontsData', '', 'RAW'), $pageId);

        $backlink       = isset($opt['backlink']) ? $opt['backlink'] : '';
        $hideHeader     = isset($opt['hideHeader']) ? filter_var($opt['hideHeader'], FILTER_VALIDATE_BOOLEAN) : false;
        $hideFooter     = isset($opt['hideFooter']) ? filter_var($opt['hideFooter'], FILTER_VALIDATE_BOOLEAN) : false;
        $hideBackToTop     = isset($opt['hideBackToTop']) ? filter_var($opt['hideBackToTop'], FILTER_VALIDATE_BOOLEAN) : false;

        $siteStyleCss   = $data->get('siteStyleCss', '', 'RAW');
        $metaTags       = $data->get('metaTags', '', 'RAW');
        $customHeadHtml = $data->get('customHeadHtml', '', 'RAW');

        $pageFormsData = $data->get('pageFormsData', '', 'RAW');
        $dialogs = $data->get('dialogs', '', 'RAW');

        $introImgStruct = str_replace($this->getHomeUrl() . '/', '[[site_path_live]]', isset($opt['introImgStruct']) ? $opt['introImgStruct'] : '');

        $html = str_replace($this->getHomeUrl(), '[[site_path_editor]]', $html);
        $publishPageParts = str_replace(
            $this->getHomeUrl() . '/',
            '[[site_path_live]]',
            array(
                'publishHtml'   => $publishHtml,
                'head'          => $head,
                'bodyStyle'     => $bodyStyle
            )
        );

        $props = array(
            'html' => $html,
            'publishHtml' => $publishPageParts['publishHtml'],
            'pageCssUsedIds' => $pageCssUsedIds,
            'backlink' => $backlink,
            'metaGeneratorContent' => $metaGeneratorContent,
            'canonical' => $canonical,
            'head' => $publishPageParts['head'],
            'bodyClass' => $bodyClass,
            'bodyStyle' => $publishPageParts['bodyStyle'],
            'fonts' => $fonts,
            'siteStyleCss' => $siteStyleCss,
            'keywords' => $keywords,
            'description' => $description,
            'metaTags' => $metaTags,
            'customHeadHtml' => $customHeadHtml,
            'titleInBrowser' => $titleInBrowser,
            'introImgStruct' => $introImgStruct,
            'hideHeader' => $hideHeader,
            'hideFooter' => $hideFooter,
            'hideBackToTop' => $hideBackToTop,
            'formsData' => $pageFormsData,
            'dialogs' => $dialogs,
        );

        $getCmsValue = array(
            'theme-template' => 'default',
            'np-template-header-footer-from-plugin' => 'landing',
            'np-template-header-footer-from-theme' => 'landing_with_header_footer'
        );
        $pageType = $getCmsValue[$data->get('pageType', 'np-template-header-footer-from-plugin', 'RAW')];
        $props['pageView'] = $pageType;

        $newData = array(
            'preview_props' => $isPreview ? $props : '',
            'autosave_props' => $isAutoSave ? $props : '',
        );
        $page = NicepageHelpersNicepage::getSectionsTable();
        if ($page->load(array('page_id' => $pageId))) {
            if (!$isPreview && !$isAutoSave) {
                $newData['props'] = $props;
            }
        } else {
            $newData[$page->getKeyName()] = null; //create new record
            $newData = array(
                'page_id' => $pageId,
                'props'   => $props,
            );
        }
        $page->save($newData);

        return $this->getPage(array('pageId' => $pageId, 'pageTitle' => $pageTitle, 'isPreview' => $isPreview));
    }

    /**
     * Save local google fonts
     *
     * @param JInput $fontsData Data parameters
     * @param string $pageId    Page id
     *
     * @return array|void
     */
    public function saveLocalGoogleFonts($fontsData, $pageId) {
        if (!$fontsData) {
            return;
        }

        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');

        $fontsFolder = dirname(JPATH_ADMINISTRATOR) . '/components/com_nicepage/assets/css/fonts';
        if (!JFolder::exists($fontsFolder)) {
            if (!JFolder::create($fontsFolder)) {
                return;
            }
        }

        $fontsFiles = isset($fontsData['files']) ? $fontsData['files'] : array();
        foreach ($fontsFiles as $fontFile) {
            $fontData = json_decode($fontFile, true);
            if (!$fontData) {
                continue;
            }
            switch($fontData['fileName']) {
            case 'fonts.css':
                JFile::write($fontsFolder . '/fonts.css', str_replace('fonts/', '', $fontData['content']));
                break;
            case 'page-fonts.css':
                JFile::write($fontsFolder . '/page-' . $pageId .'-fonts.css', str_replace('fonts/', '', $fontData['content']));
                JFile::write($fontsFolder . '/header-footer-fonts.css', str_replace('fonts/', '', $fontData['content']));
                break;
            case 'downloadedFonts.json':
                JFile::write($fontsFolder . '/downloadedFonts.json', $fontData['content']);
                break;
            default:
                $content = '';
                $bytes = $fontData['content'];
                foreach ($bytes as $chr) {
                    $content .= chr($chr);
                }
                JFile::write($fontsFolder . '/' . $fontData['fileName'], $content);
            }
        }
    }

    /**
     * Clear chunk by id
     *
     * @param JInput $data Clear chunks
     */
    public function clearChunks($data) {
        $id = $data->get('id', '', 'RAW');
        Chunk::clearChunksById($id);
        return $this->_response(
            array(
                'result' => 'done'
            )
        );
    }

    /**
     * Save header and footer content
     *
     * @param JInput $data           Data parameters
     * @param bool   $saveAndPublish Save and Publish flag
     * @param bool   $isPreview      Preview flag
     */
    public function saveHeaderFooter($data, $saveAndPublish = true, $isPreview = false)
    {
        $result = array();
        $keys = array('header', 'footer');
        $publishHeaderFooter = '';
        $currentConfig = NicepageHelpersNicepage::getConfig($isPreview);
        foreach ($keys as $key) {
            $html = $data->get($key, '', 'RAW');
            $htmlCss = $data->get($key . 'Css', '', 'RAW');
            $htmlPhp = $data->get('publish' . ucfirst($key), '', 'RAW');
            $formsData = $data->get($key . 'FormsData', '', 'RAW');
            $dialogs  = $data->get($key . 'Dialogs', '', 'RAW');
            if (!$html) {
                if (isset($currentConfig[$key])) {
                    $item = json_decode($currentConfig[$key], true);
                    $publishHeaderFooter .= $item && isset($item['php']) ? $item['php'] : '';
                }
            } else {
                $publishHeaderFooter .= $htmlPhp;
            }

            if (!$html) {
                continue;
            }

            $html = str_replace($this->getHomeUrl(), '[[site_path_editor]]', $html);
            $publishParts = str_replace(
                $this->getHomeUrl() . '/',
                '[[site_path_live]]',
                array(
                    'Css'   => $htmlCss,
                    'Php'   => $htmlPhp,
                )
            );

            if ($saveAndPublish) {
                $result[$key . ':autosave'] = '';
                $result[$key . ':preview'] = '';
            }

            if ($isPreview) {
                $key .= ':preview';
            } else if (!$saveAndPublish) {
                $key .= ':autosave';
            }

            $result[$key] = json_encode(
                array(
                    'html' => $html,
                    'php' => $publishParts['Php'],
                    'styles' => $publishParts['Css'],
                    'formsData' => $formsData,
                    'dialogs'  => $dialogs,
                )
            );
        }
        // Save header and footer content data
        $this->saveConfig($result);

        return $publishHeaderFooter;
    }
    /**
     * Main Action - Duplicate page
     *
     * @param JInput $data Array of data
     *
     * @return mixed|string
     */
    public function duplicatePage($data)
    {
        $postId = $data->get('postId', '');
        $error = array('status' => 'error');
        $succes = array('result' => 'ok');

        if (!$postId) {
            return $this->_response($error);
        }

        $page = NicepageHelpersNicepage::getSectionsTable();
        if (!$page->load(array('page_id' => $postId))) {
            return $this->_response($error);
        }

        $newPage = NicepageHelpersNicepage::getSectionsTable();
        $pageData = array(
            'page_id'               => 1000000,
            'props'                 => $page->props,
            $newPage->getKeyName()  => null
        );
        if (!$newPage->save($pageData)) {
            return $this->_response($error);
        }

        return $this->_response($succes);
    }

    /**
     * @param string $name Category name
     *
     * @return mixed
     */
    private function _getCategoryByName($name)
    {
        $categoryMapper = Nicepage_Data_Mappers::get('category');
        $res = $categoryMapper->find(array('title' => $name, 'extension' => 'com_content'));

        if (count($res) > 0) {
            return $res[0]->id;
        }

        $categoryObj = $categoryMapper->create();
        $categoryObj->title = $name;
        $categoryObj->extension = 'com_content';
        $categoryObj->metadata = $this->_paramsToString(array('robots' => '', 'author' => '', 'tags' => ''));
        $status = $categoryMapper->save($categoryObj);
        if (is_string($status)) {
            trigger_error($status, E_USER_ERROR);
        }
        return $categoryObj->id;
    }

    /**
     * @param array $data Data parameters
     *
     * @return mixed
     */
    public function createPost($data = array())
    {
        $content = isset($data['intro']) ? $data['intro'] : '';
        $fulltext = isset($data['full']) ? $data['full'] : '';
        $defaultSeoOptions = array(
            'title' => '',
            'keywords' => '',
            'description' => ''
        );
        $seoOptions = isset($data['seoOptions']) ? array_merge($defaultSeoOptions, $data['seoOptions']) : $defaultSeoOptions;

        $images = '';
        if (isset($data['images'])) {
            foreach ($data['images'] as $img) {
                $images .= '<img src="' . $img .'">' . PHP_EOL;
            }
        }
        $content = $images . $content;

        $contentMapper = Nicepage_Data_Mappers::get('content');
        $article = $contentMapper->create();
        $article->catid = $this->_getCategoryByName('Uncategorised');

        list($title, $alias) = $this->_generateNewTitle($article->catid, $data);

        $article->title = $title;
        $article->alias = $alias;
        $article->introtext = $content;
        $article->fulltext = $fulltext;
        if (isset($data['state'])) {
            $article->state = $data['state'];
        }
        $article->attribs = $this->_paramsToString(
            array (
                'show_title' => '',
                'link_titles' => '',
                'show_intro' => '',
                'show_category' => '',
                'link_category' => '',
                'show_parent_category' => '',
                'link_parent_category' => '',
                'show_author' => '',
                'link_author' => '',
                'show_create_date' => '',
                'show_modify_date' => '',
                'show_publish_date' => '',
                'show_item_navigation' => '',
                'show_icons' => '',
                'show_print_icon' => '',
                'show_email_icon' => '',
                'show_vote' => '',
                'show_hits' => '',
                'show_noauth' => '',
                'alternative_readmore' => '',
                'article_layout' => '',
                'article_page_title' => $seoOptions['title']
            )
        );
        $article->metadata = $this->_paramsToString(array('robots' => '', 'author' => '', 'rights' => '', 'xreference' => '', 'tags' => ''));
        $article->metakey = $seoOptions['keywords'];
        $article->metadesc = $seoOptions['description'];
        $status = $contentMapper->save($article);
        if (is_string($status)) {
            trigger_error($status, E_USER_ERROR);
        }

        return $article;
    }

    /**
     * @param int   $catId      Category id
     * @param array $data       Data
     * @param bool  $checkTitle Validate title
     * @param bool  $checkAlias Validate title
     *
     * @return array
     */
    private function _generateNewTitle($catId, $data, $checkTitle = true, $checkAlias = true) {
        $title = isset($data['title']) && $data['title'] ? strip_tags($data['title']) : (isset($data['subpage']) ? 'SubPage' : 'Page');
        $alias = isset($data['alias']) && $data['alias'] ? $data['alias'] : '';

        $table = JTable::getInstance('Content');
        if ($checkTitle) {
            while ($table->load(array('title' => $title, 'catid' => $catId))) {
                $title = JString::increment($title);
            }
        }

        if (!$alias) {
            if (JFactory::getConfig()->get('unicodeslugs') == 1) {
                $alias = JFilterOutput::stringURLUnicodeSlug($title);
            } else {
                $alias = JFilterOutput::stringURLSafe($title);
            }
        }
        if ($checkAlias) {
            while ($table->load(array('alias' => $alias, 'catid' => $catId))) {
                $alias = JString::increment($alias, 'dash');
            }
        }
        if (!$alias) {
            $date = new JDate();
            $alias = $date->format('Y-m-d-H-i-s');
        }

        return array($title, $alias);
    }

    /**
     * @param string|array $result Result
     *
     * @return mixed|string
     */
    private function _response($result)
    {
        if (is_string($result)) {
            $result = array('result' => $result);
        }
        return json_encode($result);
    }

    /**
     * @param array $params Parameters
     *
     * @return mixed
     */
    private function _paramsToString($params)
    {
        $registry = new JRegistry();
        $registry->loadArray($params);
        return $registry->toString();
    }

    /**
     * @param string $string Parameters string
     *
     * @return mixed
     */
    private function _stringToParams($string)
    {
        $registry = new JRegistry();
        $registry->loadString($string);
        return $registry->toArray();
    }

    /**
     * @return array
     */
    public function getImagesPaths()
    {
        $imagesFolder = JPATH_ROOT . '/images';
        if (!file_exists($imagesFolder)) {
            JFolder::create($imagesFolder);
        }

        $nicepageContentFolder = JPath::clean(implode('/', array($imagesFolder, 'nicepage-images')));
        if (!file_exists($nicepageContentFolder)) {
            JFolder::create($nicepageContentFolder);
        }

        $nicepageContentFolderUrl = $this->getHomeUrl() . '/images/nicepage-images';

        return array('realpath' => $nicepageContentFolder, 'url' => $nicepageContentFolderUrl);
    }

    /**
     * @return string
     */
    public function getHomeUrl()
    {
        return dirname(dirname(JURI::current()));
    }

    /**
     * @param int $id Article id
     *
     * @return string
     */
    public function getArticleUrlById($id)
    {
        return $this->getHomeUrl() . '/index.php?option=com_content&view=article&id=' . $id;
    }

    /**
     * Main Action - Import data from plugin
     *
     * @param JInput $data Data parameters
     *
     * @return mixed|string
     * @throws Exception
     */
    public function importData($data)
    {
        $fileName   = $data->get('filename', '');
        $isLast     = $data->get('last', '');

        if ('' === $fileName) {
            throw new Exception("Empty filename");
        } else {
            $unzipHere = '';

            $tmp = JPATH_SITE . '/tmp';
            if (file_exists($tmp) && is_writable($tmp)) {
                $unzipHere = $tmp . '/' . $fileName;
            }

            $images = JPATH_SITE . '/images';
            if (!$unzipHere && file_exists($images) && is_writable($images)) {
                $unzipHere = $images . '/' . $fileName;
            }

            if (!$unzipHere) {
                throw new Exception("Upload dir don't writable");
            }
            $uploader = new FileUploader();
            $result = $uploader->upload($unzipHere, $isLast);
            if ($result['status'] == 'done') {
                $contentDir = $this->_contentUnZip($unzipHere);
                $loader = new Nicepage_Data_Loader();
                $loader->load($contentDir . '/content/content.json');
                $loader->execute(JFactory::getApplication()->input->getArray());
            }
        }
        return $this->_response(
            array(
                'result' => 'done'
            )
        );
    }

    /**
     * Upload file
     *
     * @param JInput $data File data
     *
     * @return mixed|string
     * @throws Exception
     */
    public function uploadFile($data)
    {
        $fileName   = $data->get('filename', '');
        $isLast     = $data->get('last', '');

        if ('' === $fileName) {
            throw new Exception("Empty filename");
        } else {
            $uploadHere = '';

            $params = JComponentHelper::getParams('com_media');
            $filesPath = JPATH_SITE . '/' . $params->get('image_path', 'images');
            if (file_exists($filesPath) && is_writable($filesPath)) {
                $uploadHere = $filesPath . '/' . $fileName;
            }

            if (!$uploadHere) {
                throw new Exception("Upload dir $uploadHere don't writable");
            }
            $uploader = new FileUploader();
            $result = $uploader->upload($uploadHere, $isLast);
            if ($result['status'] == 'done') {
                return $this->_response(
                    array(
                        'result' => 'done',
                        'url' => str_replace(JPATH_SITE, $this->getHomeUrl(), $result['path']),
                        'title' => $result['fileName'],
                    )
                );
            }
        }
        return $this->_response(
            array(
                'result' => 'done'
            )
        );
    }

    /**
     * Save custom settings for editor
     *
     * @param array|JInput $data Data parameters
     *
     * @return mixed|string
     */
    public function saveConfig($data)
    {
        if (!is_array($data)) {
            $data = $data->getArray();
        }
        NicepageHelpersNicepage::saveConfig($data);
        return $this->_response(
            array(
                'result' => 'done'
            )
        );
    }

    /**
     * @param string $zipPath Zip path
     *
     * @return string
     */
    private function _contentUnZip($zipPath)
    {
        $tmpdir = dirname($zipPath) . '/' . md5(round(microtime(true)));
        if (class_exists('ZipArchive')) {
            $this->_nativeUnzip($zipPath, $tmpdir);
        } else {
            $this->_joomlaUnzip($zipPath, $tmpdir);
        }
        JFile::delete($zipPath);
        return $tmpdir;
    }

    /**
     * Native unzip
     *
     * @param string $zipPath Zip path
     * @param string $tmpdir  Tmp path
     */
    private function _nativeUnzip($zipPath, $tmpdir)
    {
        $zip = new ZipArchive;

        if ($zip->open($zipPath) === true) {
            $zip->extractTo($tmpdir);
            $zip->close();
        }
    }

    /**
     * Joomla unzip
     *
     * @param string $zipPath Zip path
     * @param string $tmpdir  Tmp path
     */
    private function _joomlaUnzip($zipPath, $tmpdir)
    {
        try {
            JArchive::extract($zipPath, $tmpdir);
        } catch (Exception $e) {
            // to do
        }
    }

    /**
     * Set tags for article
     *
     * @param object $article Current article object
     */
    private function _setTags(&$article)
    {
        if (class_exists('JHelperTags')) {
            $article->tagsHelper = new JHelperTags;
            $article->tagsHelper->typeAlias = 'com_content.article';
            $article->tagsHelper->tags = explode(',', $article->tagsHelper->getTagIds($article->id, 'com_content.article'));
        }
    }

}