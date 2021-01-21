<?php
/**
 * @package Nicepage Website Builder
 * @author Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

namespace NP\Editor;

defined('_JEXEC') or die;

use \JLoader, \JURI, \JFactory, \JTable, \JHtml, \JText;
use \JComponentHelper, \JFolder, \JPath, \JRegistry;
use \NicepageHelpersNicepage;
use NP\Utility\Utility;

JLoader::register('NicepageModelActions', JPATH_ADMINISTRATOR . '/components/com_nicepage/models/actions.php');

/**
 * Class Editor
 */
class Editor
{
    private $_adminUrl = '';
    private $_domain = '';

    private $_scriptsPhpVars = array();

    private $_article = null;
    private $_sections = null;
    private $_isConvertRequired = null;

    private $_dataBridgeScripts = '';

    private $_editorPageTypes = array(
        'default' => 'theme-template',
        'landing' => 'np-template-header-footer-from-plugin',
        'landing_with_header_footer' => 'np-template-header-footer-from-theme'
    );

    /**
     * NicepageEditor constructor.
     */
    public function __construct()
    {
        $this->setAdminUrl();
        $this->setDomain();

        $aid = JFactory::getApplication()->input->get('id', '');

        $page = NicepageHelpersNicepage::getSectionsTable();
        if ($page->load(array('page_id' => $aid))) {
            NicepageHelpersNicepage::clearPreview($page);
            $this->_sections = $page;
        }

        $this->_componentConfig = NicepageHelpersNicepage::getConfig();
        $this->_article = JTable::getInstance("content");
        $this->_article->load($aid);

        $this->_isConvertRequired = !$this->_sections && ($this->_article->introtext . $this->_article->fulltext);
    }
    /**
     * Add common scripts
     */
    public function addCommonScript()
    {
        $domain = $this->getDomain();
        $input = JFactory::getApplication()->input;
        $aid = $input->get('id', '');
        $element = $input->get('element', '');
        $view = $input->input->get('view', '');

        // start nicepage from edit article page
        if ($this->_sections) {
            $parts = '/#/builder/1/page/' . $aid;
        } else if ($view === 'theme') {
            $parts = '/#/builder/1/theme' . ($element ? '/' . $element : '');
        } else {
            $parts = '/#/landing';
        }
        $currentUrl = $this->getAdminUrl() . '/index.php?option=com_nicepage&view=display&ver=' . urlencode('1607432772669')  . ($domain ? '&domain=' . $domain : '') . $parts;

        $this->_scriptsPhpVars = array_merge(
            $this->_scriptsPhpVars,
            array(
                'editorUrl' => $currentUrl,
                'adminUrl'  => $this->getAdminUrl(),
            )
        );
    }

    /**
     * Get allowed file extensions
     *
     * @return array
     */
    public function getAllowedExtensions() {
        $params = JComponentHelper::getParams('com_media');
        $exts = $params->get('upload_extensions', 'pdf');
        return explode(',', $exts);
    }

    /**
     * Get local storage key
     *
     * @return |null
     */
    public function getLocalStorageKey() {
        if (isset($this->_componentConfig['localStorageKey']) && $this->_componentConfig['localStorageKey']) {
            return $this->_componentConfig['localStorageKey'];
        }
        return null;
    }

    /**
     * Get video files
     *
     * @return array
     */
    public function getVideoFiles() {
        $files = $this->getMediaFiles('mp4|ogg|ogv|webm');
        $result = array();
        foreach ($files as $file) {
            array_push($result, array ('fileName' => $file['title'], 'id'    => $file['title'], 'publicUrl' => $file['url']));
        }
        return $result;
    }

    /**
     * Get media library files without image files
     *
     * @param string $mask Extenetions mask
     *
     * @return array
     */
    public function getMediaFiles($mask = '') {
        $result = array();
        $params = JComponentHelper::getParams('com_media');
        if (!$mask) {
            $mask = $params->get('upload_extensions', 'pdf');
            $mask = preg_replace('/(bmp|gif|png|jpg|jpeg|ico|BMP|GIF|ICO|JPG|JPEG)\,/', '', $mask); // exlude all image files
        }
        $root = str_replace(DIRECTORY_SEPARATOR, '/', JPATH_ROOT);
        $filesPath = $root . '/' . $params->get('image_path', 'images');
        if (file_exists($filesPath)) {
            jimport('joomla.filesystem.folder');
            $extsParts = '\.' . implode('|\.', explode(',', $mask));
            $fileList = JFolder::files($filesPath, $extsParts, true, true);
            foreach ($fileList as $key => $file) {
                $fileName = basename($file);
                $encodedFileName = htmlentities($fileName);
                $path = str_replace(DIRECTORY_SEPARATOR, '/', JPath::clean($file));
                $fileLink = str_replace($root, dirname($this->getAdminUrl()), $path);
                $fileLink = str_replace($fileName, $encodedFileName, $fileLink);
                array_push($result, array('url' => $fileLink, 'title' => $encodedFileName));
            }
        }
        return $result;
    }

    /**
     * Add joomla link dialog script
     */
    public function addLinkDialogScript()
    {
        $mediaFiles = json_encode($this->getMediaFiles());
        $allowedExtensions = json_encode($this->getAllowedExtensions());
        $maxRequestSize = Utility::getMaxRequestSize();
        $editLinkUrl = $this->getAdminUrl() . '/index.php?option=com_content&view=articles&layout=modal&tmpl=component';
        $uploadFileLink = $this->getAdminUrl() . '/index.php?option=com_nicepage&task=actions.uploadFile';
        $customUrlOptions = <<<HTML
<style>
.custom-url-options {
    width:100%;
}
.custom-url-options label{
    width: 55px;
    display: inline-block;
}
.custom-url-options input[type=text]{
    width: 350px;
}
.custom-url-options:after {
    content: "";
    clear: both;
    display: table;
}
.link-destination,
.target-option {
    margin-left: 70px;
}
.link-destination {
    margin-top: 4px;
}
.link-destination input,
.target-option input {
    margin-right: 10px;
    margin-top: 0px;
}
.link-destination .link-destination-label {
    width: auto;
    display: inline-block;
    vertical-align: top;
    margin-left: -80px;
    margin-top: 4px;
    width: 76px;
}
.link-destination ul {
    list-style-type: none;
    margin-left: 0px;
    margin-top: 4px;
    display: inline-block;
}

.link-destination label {
    width: 120px;
}

.list-container {
    background-color: #F5F5F5;
    border: 1px solid #BFBFBF;
    padding: 4px 6px 4px 10px;
    margin: 10px auto auto 0px;
    height: 300px;
    overflow: auto;
}

.anchors-list, .files-list, .dialogs-list {
    list-style-type: none;
}

.anchors-list li, .files-list li, .dialogs-list li {
    cursor: pointer;
}

.anchors-list li:hover, .files-list li:hover, .dialogs-list li:hover,
.anchors-list li.selected, .files-list li.selected, .dialogs-list li.selected {
    background-color: #e5f2ff;
}

.anchors-list li a, .files-list li a, .dialogs-list li a {
    color: #666;
}

#upload-btn {
    text-decoration: none;
}

a.disabled {
    pointer-events: none;
    color: #999999;
}

/* Dropdown Button */

.page-option {
    margin-top: 10px;
}
.dropbtn {
  /*background-color: #4CAF50;
  color: white;
  font-size: 16px;*/
  background-color: transparent;
  padding: 10px;
  border: none;
  cursor: pointer;
  outline: none;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  /*background-color: #3e8e41;*/
}

.dropbtn-caret {
    margin-left: 5px;
    margin-top: -1px;
    border-top-color: #898989;
    display: inline-block;
    width: 0;
    height: 0;
    vertical-align: middle;
    border-top: 4px dashed;
    border-top: 4px solid \9;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
}

/* The search field */
#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  /*font-size: 16px;*/
  padding: 14px 20px 12px 15px;
  border: none;
  border-bottom: 1px solid #ddd;
}

/* The search field when it gets focus/clicked on */
#myInput:focus {
/*outline: 3px solid #ddd;*/
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  border: 1px solid #ddd;
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 6px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a.selected {
  background:#d4d2d2;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}

.a-list {
  max-height:180px;
  overflow-y: auto;
}

.page-dropdown {
    display: inline-block;
}
</style>
<div class="custom-url-options">
    <div style="float:left;width:90%">
        <div style="float:left;width:65%">
            <div class="caption-option"><label for="caption">{{caption}}</label><input type="text" name="caption" value="" /></div>
            
            <div class="url-option"><label for="url">{{url}}</label><input type="text" name="url" value="" /></div>
            <div class="target-option"><input type="checkbox" name="target" />{{target}}</div>
         
            <div class="page-option">
                <label for="url">Page</label>
                <div class="page-dropdown">
                    <button class="dropbtn"><span class="dropbtn-value">[Current page]</span><span class="dropbtn-caret"></span></button>
                    <div id="myDropdown" class="dropdown-content">
                        <input type="text" autocomplete="off" placeholder="Search.." id="myInput">
                        <div class="a-list">
                            <a href="#" class="selected">[Current page]</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="phone-option"><label for="phone">{{phoneLink}}</label><input type="tel" name="phone" value="" /></div>
            
            <div class="email-option"><label for="phone">{{emailLink}}</label><input type="email" name="email" value="" /></div>
            <div class="email-subject-option"><label for="phone">{{emailSubject}}</label><input type="text" name="subject" value="" /></div>
        </div>
        
        <div style="float:left;width:35%">
            <div class="link-destination hidden">
            <div class="link-destination-label">{{Destination}}</div>
                <ul>
                    <li><input type="radio" name="link-destination" id="page-link" value="page"/><label for='page-link'>{{pageLink}}</lable></li>
                    <li><input type="radio" name="link-destination" id="anchor-link" value="section"/><label for='anchor-link'>{{anchorLink}}</lable></li>
                    <li>
                        <input type="radio" name="link-destination" id="file-link" value="file"/><label for='file-link'>{{fileLink}}</lable>
                        <input type="file" name="file" id="file-field" multiple="true" style="display: none"/>
                        <a href="#" id="upload-btn">{{upload}}</a>
                    </li>
                    <li><input type="radio" name="link-destination" id="phone-link" value="phone"/><label for='phone-link'>{{phoneLink}}</lable></li>
                    <li><input type="radio" name="link-destination" id="email-link" value="email"/><label for='email-link'>{{emailLink}}</lable></li>
                    <li><input type="radio" name="link-destination" id="dialog-link" value="dialog"/><label for='dialog-link'>{{dialogLink}}</lable></li>
                </ul>
            </div>      
        </div>
    </div>
    <div style="float:right">
        <button type="button" class="btn btn-success" id="save-options">Save</button>
    </div>
</div>
<div class="list-container hidden">
    <ul class="anchors-list hidden" id="anchors-list"></ul>
    <ul class="files-list hidden" id="files-list"></ul>
    <ul class="dialogs-list hidden" id="dialogs-list"></ul>
</div>
HTML;
        $customUrlOptions = call_user_func('base' . '64_encode', $customUrlOptions);
        $script1 = <<<EOF
        <script>
            window.phpVars = {
                'editLinkUrl': '$editLinkUrl',
                'customUrlOptions': '$customUrlOptions', 
                'maxRequestSize': $maxRequestSize,
                'uploadFileLink': '$uploadFileLink',
                'mediaFiles': $mediaFiles,
                'allowedExtensions': $allowedExtensions,
            } 
        </script>   
EOF;
        $script2 = '<script src="' . $this->getAdminUrl() . '/components/com_nicepage/assets/js/link-dialog.js"></script>';
        JFactory::getDocument()->addCustomTag($script1 . $script2);
    }

    /**
     * Add script for making data for editor
     */
    public function addDataBridgeScript()
    {
        $app = JFactory::getApplication();
        $input = $app->input;
        $aid = $this->_article->id;
        $start = $input->get('start', '0');
        $autostart = $input->get('autostart', '0');
        $domain = $this->getDomain();
        $prettyCode =  array_key_exists('JSON_PRETTY_PRINT', get_defined_constants()) ? JSON_PRETTY_PRINT : 0;

        $editorSettings = NicepageHelpersNicepage::getEditorSettings();
        if ($aid) {
            $editorSettings['pageId'] = $this->_isConvertRequired ? '' : $aid;
            $editorSettings['startPageId'] = $aid;
        }

        $cmsSettings = NicepageHelpersNicepage::getCmsSettings();
        $cmsSettings['isFirstStart'] = $start == '1' ? true : false;
        $cmsSettings['disableAutosave'] = $this->getDisableAutoSave();

        $editorSettingsJson = json_encode($editorSettings, $prettyCode);
        $cmsSettingsJson = json_encode($cmsSettings, $prettyCode);

        $modelActions = new \NicepageModelActions();
        $site = $modelActions->getSite();
        $isNewPage = $this->_article->state == '2' && ($start == '1' || $autostart == '1');
        if ($isNewPage) {
            $site['items'][] = array(
                'siteId' => '1',
                'title' => $this->_article->title,
                'id' => (int) $aid,
                'order' => 0,
                'status' => 2,
                'editorUrl' => $this->getAdminUrl() . '/index.php?option=com_nicepage&task=nicepage.autostart&postid=' . $aid . ($domain ? '&domain=' . $domain : ''),
                'htmlUrl' => $this->getAdminUrl() . '/index.php?option=com_nicepage&task=actions.getPageHtml&pageId=' . $aid
            );
        }

        $keys = array('header', 'footer');
        foreach ($keys as $key) {
            $keyJson = '';
            if (isset($this->_componentConfig[$key . ':autosave']) && $this->_componentConfig[$key . ':autosave']) {
                $keyJson = $this->_componentConfig[$key . ':autosave'];
            } else if (isset($this->_componentConfig[$key]) && $this->_componentConfig[$key]) {
                $keyJson = $this->_componentConfig[$key];
            }
            if ($keyJson) {
                $item = json_decode(str_replace('[[site_path_editor]]', dirname($this->getAdminUrl()), $keyJson), true);
                $site[$key] = $item['html'];
            }
        }

        $info = array(
            'productsExists' => $this->vmEnabled(),
            'newPageUrl' => $this->getAdminUrl() . '/index.php?option=com_nicepage&task=nicepage.start' . ($domain ? '&domain=' . $domain : ''),
            'forceModified' => $this->forceModified(),
            'generalSettingsUrl' => $this->getAdminUrl() . '/index.php?option=com_config#page-server',
            'typographyPageHtmlUrl' => $this->getFrontendUrl(),
            'siteIsSecureAndLocalhost' => Utility::siteIsSecureAndLocalhost(),
            'newPageTitle' => $isNewPage ? $this->_article->title : '',
            'fontsInfo' => $this->getFontsInfo(),
            'videoFiles' => $this->getVideoFiles(),
            'localStorageKey' => $this->getLocalStorageKey(),
        );

        $themeEditorSettings = $this->getEditorSettingsFromDefaultTheme();
        if ($themeEditorSettings) {
            $info['themeTypography'] = $themeEditorSettings['typography'];
            $info['themeFontScheme'] = $themeEditorSettings['fontScheme'];
            $info['themeColorScheme'] = $themeEditorSettings['colorScheme'];
        }

        $pageHtml = $this->getSectionHtml();
        $pageHtml = str_replace('[[site_path_editor]]', dirname($this->getAdminUrl()), $pageHtml);
        $pageHtml = $this->_restoreSeoOptions($pageHtml);
        $pageHtml = $this->_restorePageType($pageHtml);
        $pageHtml = call_user_func('base' . '64_encode', $pageHtml);

        $data = json_encode(
            array (
                'site' => $site,
                'pageHtml' => $pageHtml,
                'startTerm' => $this->_isConvertRequired ? 'site:joomla:' . $aid : '',
                'defaultPageType' => $this->getDefaultPageType(true),
                'info' => $info,
                'nicePageCss' => $this->getDynamicNicepageCss(),
                'downloadedFonts' => $this->getDownloadedFonts(),
            ),
            $prettyCode
        );

        $this->_dataBridgeScripts .= <<<EOF
var dataBridgeData = $data;
window.dataBridge = {
    getSite: function () {
        return dataBridgeData.site;
    },
    setSite: function (site) {
        dataBridgeData.site = site;
    },
    getPageHtml: function () {
        return decodeURIComponent(Array.prototype.map.call(atob(dataBridgeData.pageHtml), function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
        }).join(''))
    },
    getStartTerm: function () {
        return dataBridgeData.startTerm;
    },
    getDefaultPageType: function () {
        return dataBridgeData.defaultPageType;
    },
    getInfo: function getInfo() {
        return dataBridgeData.info;
    },
    getNPCss: function getNPCss() {
        return dataBridgeData.nicePageCss;
    },
    getDownloadedFonts: function getDownloadedFonts() {
        return dataBridgeData.downloadedFonts;
    },
    setDownloadedFonts: function setDownloadedFonts(downloadedFonts) {
        dataBridgeData.downloadedFonts = downloadedFonts;
    },
    settings: $editorSettingsJson,
    cmsSettings: $cmsSettingsJson
};
EOF;
    }

    /**
     * Get raw html
     *
     * @return mixed|string
     */
    public function getSectionHtml()
    {
        $html = '';
        if ($this->_sections) {
            $props = $this->_sections->autosave_props ? $this->_sections->autosave_props : $this->_sections->props;
            $html = isset($props['html']) ? $props['html'] : '';
            $html = NicepageHelpersNicepage::processSectionsHtml($html, false);
        }
        return $html;
    }

    /**
     * Get fonts info
     *
     * @return array
     */
    public function getFontsInfo() {
        jimport('joomla.filesystem.path');
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');

        $info = array(
            'path' => '',
            'canSave' => true,
        );
        $assets = dirname(JPATH_ADMINISTRATOR) . '/components/com_nicepage/assets/css';
        if (JFolder::exists($assets)) {
            $error = $this->checkWritable($assets);
            if (count($error) > 0) {
                return array_merge($info, $error);
            }
            $fonts = $assets . '/fonts';
            if (!JFolder::exists($fonts)) {
                if (!JFolder::create($fonts)) {
                    return array_merge($info, array('path' => $fonts, 'canSave' => false));
                }
            } else {
                $error = $this->checkWritable($fonts);
                if (count($error) > 0) {
                    return array_merge($info, $error);
                }
            }
        }
        return $info;
    }

    /**
     * Check path writable
     *
     * @param string $path Path
     *
     * @return string
     */
    public function checkWritable($path) {
        $user = get_current_user();
        chown($path, $user);
        JPath::setPermissions($path, '0777');
        $result = array();
        if (!is_writable($path)) {
            $result = array(
                'path' => $path,
                'canSave' => false,
            );
        }
        return $result;
    }

    /**
     * Add main script
     */
    public function addMainScript()
    {
        $input = JFactory::getApplication()->input;

        $cookie = $input->cookie;
        $themeTypographyCacheForceRefresh = '0';
        $cachedDefaultTheme = $cookie ? $cookie->get('DEFAULT_THEME', '') : '';
        if (!$cachedDefaultTheme || $cachedDefaultTheme !== Utility::getActiveTemplate()) {
            setcookie('DEFAULT_THEME', Utility::getActiveTemplate(), time() + 31536000); // will expire after year
            $themeTypographyCacheForceRefresh = '1';
        }

        $this->_scriptsPhpVars = array_merge(
            $this->_scriptsPhpVars,
            array(
                'jEditor' => JFactory::getConfig()->get('editor'),
                'forceRefresh' => $themeTypographyCacheForceRefresh,
                'infoDataUrl'  => dirname($this->getAdminUrl()) . '/index.php?option=com_nicepage&task=getInfoData',
                'pageId'  => $this->_article->id ? $this->_article->id : -1,
                'startParam'  => $input->get('start', '0'),
                'autoStartParam'  => $input->get('autostart', '0'),
                'viewParam'  => $input->get('view', ''),
            )
        );

        $aid = $this->_article->id;
        if ($aid) {
            $pageView = $this->getDefaultPageType();
            if ($this->_sections) {
                $props = $this->_getPageProps($this->_sections, true);
                $pageView = isset($props['pageView']) ? $props['pageView'] : $pageView;
            }

            switch($pageView) {
            case 'landing':
                $templateOptions = JText::sprintf('PLG_EDITORS-XTD_TEMPLATE_OPTIONS', '', 'selected', '');
                break;
            case 'landing_with_header_footer':
                $templateOptions = JText::sprintf('PLG_EDITORS-XTD_TEMPLATE_OPTIONS', '', '', 'selected');
                break;
            default:
                $templateOptions = JText::sprintf('PLG_EDITORS-XTD_TEMPLATE_OPTIONS', 'selected', '', '');
            }

            $this->_scriptsPhpVars = array_merge(
                $this->_scriptsPhpVars,
                array(
                    'npButtonText'      => $this->_isConvertRequired ? JText::_('PLG_EDITORS-XTD_TURN_TO_NICEPAGE_BUTTON_TEXT') : JText::_('PLG_EDITORS-XTD_EDIT_WITH_NICEPAGE_BUTTON_TEXT'),
                    'buttonAreaClass'   => $this->_isConvertRequired ? '' : 'nicepage-select-template-area',
                    'duplicatePageUrl'  => $this->getAdminUrl() . '/index.php?option=com_nicepage&task=actions.duplicatePage',
                    'templateOptions'   => $templateOptions,
                    'savePageTypeUrl'   => $this->getAdminUrl() . '/index.php?option=com_nicepage&task=actions.savePageType',
                    'autoSaveMsg'       => $this->_autoSaveChangesExists($this->_sections) ? JText::sprintf('PLG_EDITORS-XTD_AUTOSAVE_CHANGES') : '',
                    'frontUrl'          => dirname($this->getAdminUrl()) . '/index.php?option=com_nicepage',
                    'userId'            => JFactory::getUser()->id,
                    'previewPageUrl'    => dirname($this->getAdminUrl()) . '/index.php?option=com_content&view=article&id=' . $aid,
                )
            );
        }
    }

    /**
     * Include all scripts to page document
     */
    public function includeScripts()
    {
        JHtml::_('behavior.modal'); // for SqueezeBox

        $doc = JFactory::getDocument();
        $doc->addCustomTag(
            '<script src="' . $this->getAdminUrl() . '/components/com_nicepage/assets/js/typography-parser.js"></script>' .
            '<script> window.cmsVars = ' . json_encode($this->_scriptsPhpVars) . '</script>' .
            '<script src="' . $this->getAdminUrl() . '/components/com_nicepage/assets/js/cms.js"></script>'
        );
        $doc->addCustomTag('<!--np_databridge_script--><script>' . $this->_dataBridgeScripts . '</script><!--/np_databridge_script-->');
    }

    /**
     * Get default page type
     *
     * @param bool $forEditor
     *
     * @return mixed|string
     */
    public function getDefaultPageType($forEditor = false) {
        $type = isset($this->_componentConfig['pageType']) ? $this->_componentConfig['pageType'] : 'landing';
        if ($forEditor) {
            $type = $this->_editorPageTypes[$type];
        }
        return $type;
    }

    /**
     * Get downloaded fonts
     *
     * @return false|string
     */
    public function getDownloadedFonts() {
        $downloadedFontsFile = dirname(JPATH_ADMINISTRATOR) . '/components/com_nicepage/assets/css/fonts/downloadedFonts.json';
        return file_exists($downloadedFontsFile) ? file_get_contents($downloadedFontsFile) : '';
    }

    /**
     * Get disable auto save value
     *
     * @return string
     */
    public function getDisableAutoSave() {
        $disableAutosave = isset($this->_componentConfig['siteStyleCssParts']) ? true : false; // autosave disable for new user
        if (isset($this->_componentConfig['disableAutosave'])) {
            $disableAutosave = $this->_componentConfig['disableAutosave'] == '1' ? true : false;
        }
        return $disableAutosave;
    }

    /**
     * Restore seo props for page from joomla original props
     *
     * @param string $pageHtml Html of page
     *
     * @return mixed
     */
    private function _restoreSeoOptions($pageHtml) {
        $titleInBrowser = '';
        $keywords = '';
        $description = '';
        if ($this->_sections) {
            $props = $this->_getPageProps($this->_sections);
            $titleInBrowser = isset($props['titleInBrowser']) ? $props['titleInBrowser'] : '';
            $keywords = isset($props['keywords']) ? $props['keywords'] : '';
            $description = isset($props['description']) ? $props['description'] : '';
        }

        if ($this->_article->metakey && $keywords) {
            $pageHtml = str_replace('<meta name="keywords" content="' . $keywords . '">', '<meta name="keywords" content="' . $this->_article->metakey . '">', $pageHtml);
        }
        if ($this->_article->metadesc && $description) {
            $pageHtml = str_replace('<meta name="description" content="' . $description . '">', '<meta name="description" content="' . $this->_article->metadesc . '">', $pageHtml);
        }
        if ($this->_article->attribs) {
            $registry = new JRegistry();
            $registry->loadString($this->_article->attribs);
            $attribs = $registry->toArray();
            if (isset($attribs['article_page_title']) && $attribs['article_page_title'] && $titleInBrowser) {
                $pageHtml = str_replace('<title>' . $titleInBrowser . '</title>', '<title>' . $attribs['article_page_title'] . '</title>', $pageHtml);
            }
        }
        return $pageHtml;
    }

    /**
     * Restore page type for editor
     *
     * @param string $pageHtml Page html
     *
     * @return mixed
     */
    private function _restorePageType($pageHtml) {
        if ($this->_sections) {
            $props = $this->_getPageProps($this->_sections);
            $pageView = isset($props['pageView']) ? $props['pageView'] : $this->getDefaultPageType();
            $rePageType = '/<meta name="page_type" content="[^"]+?">/';
            if (preg_match($rePageType, $pageHtml)) {
                $pageHtml = preg_replace($rePageType, '<meta name="page_type" content="' . $this->_editorPageTypes[$pageView] . '">', $pageHtml);
            } else {
                $pageHtml = str_replace('<head>', '<head><meta name="page_type" content="' . $this->_editorPageTypes[$pageView] . '">', $pageHtml);
            }
        }
        return $pageHtml;
    }

    /**
     * Get page properties
     *
     * @param object $page     Page entity
     * @param bool   $allProps Get all props
     *
     * @return mixed
     */
    private function _getPageProps($page, $allProps = false)
    {
        return (!$allProps && $page->autosave_props) ? $page->autosave_props : $page->props;
    }

    /**
     * Autosave changes exists
     *
     * @param object $page Page entity
     *
     * @return bool
     */
    private function _autoSaveChangesExists($page) {
        if (!$page) {
            return false;
        }
        return !!$page->autosave_props;
    }

    /**
     * Check the existence of Virtuemart
     *
     * @return bool
     */
    public function vmEnabled()
    {
        if (!file_exists(dirname(JPATH_ADMINISTRATOR) . '/components/com_virtuemart/')) {
            return false;
        }

        if (!JComponentHelper::getComponent('com_virtuemart', true)->enabled) {
            return false;
        }
        return true;
    }

    /**
     * Check force saving or not
     */
    public function forceModified()
    {
        if ($this->_sections) {
            $props = $this->_getPageProps($this->_sections);
            return isset($props['pageCssUsedIds']) ? false : true;
        }
        return true;
    }

    /**
     * Get frontend site url
     *
     * @return string
     */
    public function getFrontendUrl()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from($db->quoteName('#__content'))
            ->where($db->quoteName('state') . ' = 1');
        $db->setQuery($query);
        $ret = $db->loadObject();

        if ($ret !== null) {
            return dirname($this->getAdminUrl()) . '/' . 'index.php?option=com_content&view=article&id=' . $ret->id . '&toEdit=1';
        } else {
            $frontEndUri = new JUri(dirname(dirname((JURI::current()))) . '/');
            $frontEndUri->setVar('toEdit', '1');
            return $frontEndUri->toString();
        }
    }

    /**
     * Get editor settings from default theme
     *
     * @return mixed|null
     */
    public function getEditorSettingsFromDefaultTheme()
    {
        $template = Utility::getActiveTemplate();
        if ($template) {
            $funcsFilePath = dirname(dirname(JPATH_THEMES)) . '/templates/' . $template . '/template.json';
            if (file_exists($funcsFilePath)) {
                ob_start();
                include_once $funcsFilePath;
                return json_decode(ob_get_clean(), true);
            }
        }
        return null;
    }

    /**
     * Get content from nicepage-dynamic.css
     *
     * @return string
     */
    public function getDynamicNicepageCss()
    {
        $assets = dirname(JPATH_PLUGINS) . '/administrator/components/com_nicepage/assets';
        ob_start();
        include $assets . '/css/nicepage-dynamic.css';
        return ob_get_clean();
    }

    /**
     * Set domain property
     */
    public function setDomain()
    {
        $this->_domain = JFactory::getApplication()->input->get('domain', (defined('NICEPAGE_DOMAIN') ? NICEPAGE_DOMAIN : ''), 'RAW');
    }

    /**
     * Get domain property
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Set admin url
     */
    public function setAdminUrl()
    {
        $current = dirname(dirname((JURI::current())));
        $this->_adminUrl = $current . '/administrator';
    }

    /**
     * Get admin url
     *
     * @return string
     */
    public function getAdminUrl()
    {
        return $this->_adminUrl;
    }
}