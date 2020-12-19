<?php
/**
 * @package Nicepage Website Builder
 * @author Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

use NP\Models\ContentModelCustomArticles;
use NP\Models\ContentModelCustomProducts;
use NP\Processor\ProductsProcessor;
use NP\Utility\ReCaptcha;

JLoader::register('Nicepage_Data_Mappers', JPATH_ADMINISTRATOR . '/components/com_nicepage/tables/mappers.php');
JLoader::register('NicepageHelpersNicepage', JPATH_ADMINISTRATOR . '/components/com_nicepage/helpers/nicepage.php');

/**
 * Class NicepageController
 */
class NicepageController extends JControllerLegacy
{
    /**
     * Default display view
     *
     * @param bool $cachable
     * @param bool $urlparams
     *
     * @return mixed
     */
    public function display($cachable = false, $urlparams = false)
    {
        $input = JFactory::getApplication()->input;
        $uid = $input->get('uid', '');
        if ($uid) {
            $session = JFactory::getSession();
            $user = new JUser((int) $uid);
            $session->set('user', $user);
            exit(json_encode(array('result' => 'ok')));
        }

        return parent::display($cachable, $urlparams);
    }

    /**
     * Get product content
     */
    public function product() {
        $input = JFactory::getApplication()->input;
        $pageId = $input->get('pageId', 0);
        $productId = $input->get('virtuemart_product_id', 0);
        $dynamic = $input->get('dynamic', '0');

        if ($dynamic == '1') {
            $page = NicepageHelpersNicepage::getSectionsTable();
            if (!$page->load(array('page_id' => $pageId))) {
                exit(1);
            }

            $publishHtml = isset($page->props['publishHtml']) ? $page->props['publishHtml'] : '';
            if (!$publishHtml) {
                exit(1);
            }

            $productHtml = '';
            if (preg_match('/<\!--product-->([\s\S]+?)<\!--\/product-->/', $publishHtml, $productMatches)) {
                $productHtml = $productMatches[0];
                $jsonRe = '/<\!--product_options_json--><\!--([\s\S]+?)--><\!--\/product_options_json-->/';
                if (preg_match($jsonRe, $productMatches[1], $optionsMatches)) {
                    $productOptions = json_decode($optionsMatches[1], true);
                    $productOptions['source'] = $productId;
                    $productHtml = str_replace($optionsMatches[1], json_encode($productOptions), $productHtml);
                }
            }

            if ($productHtml) {
                $products = new ProductsProcessor($pageId);
                $productHtml = $products->process($productHtml);
                exit($productHtml);
            }
        }
        exit(1);
    }

    /**
     *  Get products
     */
    public function products() {
        $source = JFactory::getApplication()->input->get('category', '', 'RAW');
        if (preg_match('/^productId:/', $source)) {
            $productId = str_replace('productId:', '', $source);
            $result = array(
                'productId' => $productId,
                'id' => null,
                'products' => array(),
            );
            $products = new ContentModelCustomProducts(array('productId' => $productId));
            $result['products'] = $products->getProducts();
        } else {
            $categoryName = $source;
            $result = array(
                'category' => $categoryName,
                'id' => -1,
                'products' => array(),
            );
            if ($categoryName) {
                $products = new ContentModelCustomProducts(array('categoryName' => $categoryName));
                $result['products'] = $products->getProducts();
            }
        }
        exit(
            json_encode(
                array(
                    'result' => 'done',
                    'products' => $result,
                )
            )
        );
    }

    /**
     *  Get posts
     */
    public function posts() {
        $source = JFactory::getApplication()->input->get('category', '', 'RAW');
        if (preg_match('/^tags:/', $source)) {
            $tags = str_replace('tags:', '', $source);
            $result = array(
                'tags' => $tags,
                'id' => null,
                'posts' => array(),
            );
            $blogModel = new ContentModelCustomArticles(array('tags' => $tags));
            $result['posts'] = $blogModel->getPosts();
        } else {
            $categoryName = $source;
            $result = array(
                'category' => $categoryName,
                'id' => -1,
                'posts' => array(),
            );
            if ($categoryName) {
                $categoryObject = Nicepage_Data_Mappers::get('category');
                $categoryList = $categoryObject->find(array('title' => $categoryName));
                if (count($categoryList) > 0) {
                    $categoryId = $categoryList[0]->id;
                    $blogModel = new ContentModelCustomArticles(array('category_id' => $categoryId));
                    $posts = $blogModel->getPosts();
                    $result['id'] = $categoryId;
                    $result['posts'] = $posts;
                }
            }
        }
        exit(
            json_encode(
                array(
                    'result' => 'done',
                    'blog' => $result,
                )
            )
        );
    }

    /**
     * Get data info
     */
    public function getInfoData() {
        $menuData = $this->getMenu();
        $blogData = $this->getBlog();
        $productsData = $this->getProducts();
        exit(
            json_encode(
                array(
                    'result' => array(
                        'menuItems' => $menuData['menuItems'],
                        'menuOptions' => $menuData['menuOptions'],
                        'blogInfo' => $blogData,
                        'productsInfo' => $productsData,
                    )
                )
            )
        );
    }

    /**
     * Get products
     *
     * @return array
     */
    public function getProducts() {
        $result = array();

        $recentProducts = new ContentModelCustomProducts(array('categoryName' => 'Recent products'));
        array_push($result, array('category' => 'Recent products', 'id' => '', 'products' => $recentProducts->getProducts()));

        $featureProducts = new ContentModelCustomProducts(array('categoryName' => 'Featured products'));
        array_push($result, array('category' => 'Featured products', 'id' => '', 'products' => $featureProducts->getProducts()));

        $pageId = JFactory::getApplication()->input->get('id', '');
        $page = NicepageHelpersNicepage::getSectionsTable();
        if (!$page->load(array('page_id' => $pageId))) {
            return $result;
        }

        $publishHtml = isset($page->props['publishHtml']) ? $page->props['publishHtml'] : '';
        if (!$publishHtml) {
            return $result;
        }

        $sources = array();
        if (preg_match_all('/<\!--products-->([\s\S]+?)<\!--\/products-->/', $publishHtml, $productsMatches, PREG_SET_ORDER)) {
            foreach ($productsMatches as $productsMatch) {
                if (preg_match('/<\!--products_options_json--><\!--([\s\S]+?)--><\!--\/products_options_json-->/', $productsMatch[1], $optionsMatches)) {
                    $productsOptions = json_decode($optionsMatches[1], true);
                    if (isset($productsOptions['source']) && $productsOptions['source']) {
                        array_push($sources, $productsOptions['source']);
                    }
                }
            }
        }
        foreach ($sources as $source) {
            $products = new ContentModelCustomProducts(array('categoryName' => $source));
            array_push($result, array('category' => $source, 'id' => $source, 'products' => $products->getProducts()));
        }

        $productSources = array();
        if (preg_match_all('/<\!--product-->([\s\S]+?)<\!--\/product-->/', $publishHtml, $productMatches, PREG_SET_ORDER)) {
            foreach ($productMatches as $productMatch) {
                if (preg_match('/<\!--product_options_json--><\!--([\s\S]+?)--><\!--\/product_options_json-->/', $productMatch[1], $optionsMatches)) {
                    $productOptions = json_decode($optionsMatches[1], true);
                    if (isset($productOptions['source']) && $productOptions['source']) {
                        array_push($productSources, $productOptions['source']);
                    }
                }
            }
        }
        foreach ($productSources as $source) {
            $products = new ContentModelCustomProducts(array('productId' => $source));
            array_push($result, array('productId' => $source, 'id' => $source, 'products' => $products->getProducts()));
        }
        return $result;
    }

    /**
     * Get blogs
     */
    public function getBlog() {
        $result = array();

        // add recent articles to result for empty category name
        $blogModel = new ContentModelCustomArticles();
        array_push($result, array('category' => 'Recent posts', 'id' => '', 'posts' => $blogModel->getPosts()));

        $pageId = JFactory::getApplication()->input->get('id', '');
        $page = NicepageHelpersNicepage::getSectionsTable();
        if (!$page->load(array('page_id' => $pageId))) {
            return $result;
        }

        $publishHtml = isset($page->props['publishHtml']) ? $page->props['publishHtml'] : '';
        if (!$publishHtml) {
            return $result;
        }
        $sources = array();
        if (preg_match_all('/<\!--blog-->([\s\S]+?)<\!--\/blog-->/', $publishHtml, $blogMatches, PREG_SET_ORDER)) {
            foreach ($blogMatches as $blogMatch) {
                if (preg_match('/<\!--blog_options_json--><\!--([\s\S]+?)--><\!--\/blog_options_json-->/', $blogMatch[1], $optionsMatches)) {
                    $blogOptions = json_decode($optionsMatches[1], true);
                    $blogSourceType = isset($blogOptions['type']) ? $blogOptions['type'] : '';
                    if ($blogSourceType === 'Tags') {
                        $blogSource = 'tags:' . (isset($blogOptions['tags']) && $blogOptions['tags'] ? $blogOptions['tags'] : '');
                    } else {
                        $blogSource = isset($blogOptions['source']) && $blogOptions['source'] ? $blogOptions['source'] : '';
                    }
                    if ($blogSource) {
                        array_push($sources, $blogSource);
                    }
                }
            }
        }
        foreach ($sources as $key => $source) {
            $categoryId = '';
            $tags = '';
            $isTags = false;
            if (preg_match('/^tags:/', $source)) {
                $tags = str_replace('tags:', '', $source);
                $isTags = true;
            } else {
                $categoryObject = Nicepage_Data_Mappers::get('category');
                $categoryList = $categoryObject->find(array('title' => $source));
                if (count($categoryList) < 1) {
                    array_push($result, array('category' => $source, 'id' => '', 'posts' => array()));
                    continue;
                }
                $categoryId = $categoryList[0]->id;
            }
            $blogModel = new ContentModelCustomArticles(array('category_id' => $categoryId, 'tags' => $tags));
            if ($isTags) {
                array_push($result, array('tags' => $tags, 'id' => null, 'posts' => $blogModel->getPosts()));
            } else {
                array_push($result, array('category' => $source, 'id' => $categoryId, 'posts' => $blogModel->getPosts()));
            }
        }
        return $result;
    }

    /**
     * Get active menu
     */
    public function getMenu()
    {
        JLoader::register('Nicepage_Data_Mappers', JPATH_ADMINISTRATOR . '/components/com_nicepage/tables/mappers.php');
        JLoader::register('ModMenuHelper', dirname(JPATH_ADMINISTRATOR) . '/modules/mod_menu/helper.php');

        $menuItemsMapper = Nicepage_Data_Mappers::get('menuItem');

        $home = array();
        $langTag = JLanguageMultilang::isEnabled() ? JFactory::getLanguage()->getTag() : '';
        if ($langTag) {
            $home = $menuItemsMapper->find(array('home' => 1, 'language' => $langTag));
        }

        // if not exists language menu, then get default menu
        if (count($home) < 1) {
            $home = $menuItemsMapper->find(array('home' => 1));
        }

        if (count($home) < 1) {
            exit(json_encode(array('result' => null)));
        }

        $params = array(
            'menutype' => $home[0]->menutype,
            'startLevel' => '1',
            'endLevel' => '0',
            'showAllChildren' => '1',
            'tag_id' => '',
            'class_sfx' => '',
            'window_open' => '',
            'layout' => '_:default',
            'moduleclass_sfx' => '',
            'cache' => '1',
            'cache_time' => '900',
            'cachemode' => 'itemid'
        );
        $registry = new JRegistry();
        $registry->loadArray($params);
        $list = ModMenuHelper::getList($registry);

        if (count($list) < 1) {
            exit(json_encode(array('result' => null)));
        }

        $result = array();
        $maxMenuItems = 20;
        $menuIds = array();
        foreach ($list as $i => $item) {
            if ($i >= $maxMenuItems && $item->level == 1) {
                break;
            }
            $itemOptions = array (
                'title' => $item->title,
                'id'   => $this->_getPageId($item),
                'publishUrl' => isset($item->link) ? $item->link : '',
            );
            if ($item->level == 1) {
                $result[] = $itemOptions;
            } else {
                $lastIndex = count($result) - 1;
                $element = $result[$lastIndex];
                $result[$lastIndex] = $this->_addItemToResult($element, $item, $item->level);
            }
            array_push($menuIds, $item->id);
        }
        return array(
            'menuItems' => $result,
            'menuOptions' => array(
                'siteMenuId' => $home[0]->menutype,
                'menuIds' => $menuIds,
            ),
        );
    }

    /**
     * Build nested structure
     *
     * @param array  $element Element
     * @param object $item    Menu Item
     * @param int    $level   Level
     *
     * @return mixed
     */
    private function _addItemToResult($element, $item, $level) {
        if ($level > 2) {
            $subel = end($element['items']);
            $element['items'][count($element['items']) - 1] = $this->_addItemToResult($subel, $item, --$level);
        } else {
            if (!isset($element['items'])) {
                $element['items'] = array();
            }
            $element['items'][] = array(
                'title' => $item->title,
                'id'   => $this->_getPageId($item),
                'publishUrl' => isset($item->link) ? $item->link : '',
            );
        }
        return $element;
    }

    /**
     * Get page id
     *
     * @param object $item Menu item
     *
     * @return int|string
     */
    private function _getPageId($item) {
        if (preg_match('/index.php\?option=com_content&view=article&id=(\d+)/', $item->link, $matches)) {
            $page = NicepageHelpersNicepage::getSectionsTable();
            $id = $matches[1];
            return $page->load(array('page_id' => $id)) ? (int) $id : '';
        } else {
            return '';
        }
    }

    /**
     * Send mail to site owner.
     */
    public function form()
    {
        $input = JFactory::getApplication()->input;
        $formId = $input->get('formId', '');
        $pageId = $input->get('id', '');
        if (!$formId || !$pageId) {
            exit(json_encode(array('error' => 'Form id or page id not found')));
        }
        $formsData = null;
        if ($pageId == 'header' || $pageId == 'footer') {
            $config = NicepageHelpersNicepage::getConfig();
            if (isset($config[$pageId]) && $config[$pageId]) {
                $item = json_decode($config[$pageId], true);
                $formsData = isset($item['formsData']) ? json_decode($item['formsData'], true) : array();
            }
        } else {
            $page = NicepageHelpersNicepage::getSectionsTable();
            if ($page->load(array('page_id' => $pageId))) {
                $formsData = isset($page->props['formsData']) ? json_decode($page->props['formsData'], true) : array();
            }
        }

        if ($formsData) {
            $foundForm = null;
            for ($i = 0; $i < count($formsData); $i++) {
                $form = $formsData[$i];
                $str = json_encode($form);
                if (strpos($str, 'form-' . $formId) !== false) {
                    $foundForm = $form;
                    break;
                }
            }
            if ($foundForm) {
                $convertedForm = array(
                    'subject' => $foundForm['subject'],
                    'email_message' => $foundForm['emailMsg'],
                    'success_redirect' => '',
                    'email' => array(
                        'from' => $foundForm['emailfrom'],
                        'to' => $foundForm['emailto']
                    ),
                    'fields' => array(),
                );
                for ($j = 0; $j < count($foundForm['fields']); $j++) {
                    $field = $foundForm['fields'][$j];
                    $convertedForm['fields'][$field['name']] = array(
                        'order' => $field['order'],
                        'type' => $field['type'],
                        'label' => $field['label'],
                        'required' => $field['required'],
                        'errors' => array(
                            'required' => 'Field \'' . $field['label'] . '\' is required.'
                        )
                    );
                }

                $formsDir = dirname(JPATH_PLUGINS) . '/administrator/components/com_nicepage/helpers/forms/';
                JLoader::register('FormProcessor', $formsDir . '/FormProcessor.php');
                $processor = new FormProcessor();
                $processor->process($convertedForm);
                exit;
            }
        }
    }

    /**
     * Send mail to site owner.
     */
    public function sendmail()
    {
        $config = JFactory::getConfig();

        $recipient = $config->get('mailfrom');

        $input = JFactory::getApplication()->input->post;

        if ($input->exists('recaptchaResponse')) {
            $response = $input->get('recaptchaResponse', '', 'RAW');
            $config = NicepageHelpersNicepage::getConfig();
            if (isset($config['siteSettings'])) {
                $settings = json_decode($config['siteSettings'], true);
                if (isset($settings['captchaSecretKey']) && $settings['captchaSecretKey']) {
                    $recaptcha = new ReCaptcha($settings['captchaSecretKey']);
                    $result = $recaptcha->verifyResponse($response);
                    if (!$result->success) {
                        // Not verified - show form error
                        $error = is_array($result->errorCodes) ? implode(' ', $result->errorCodes) : $result->errorCodes;
                        echo json_encode(array('error' => $error));
                        exit;
                    }
                }
            }
        }

        $data = $input->getArray();

        if (count($data) < 1) {
            echo json_encode(array('error' => 'Form data not found'));
            exit;
        }

        $subject = '';
        $body = '';
        $excludeKeys = array('recaptchaResponse', 'Itemid', 'redirect', 'siteId', 'pageId');
        foreach ($data as $key => $value) {
            if (array_search($key, $excludeKeys) === false && $data[$key]) {
                if (!$subject && ($key == 'name' || strpos($key, 'name') !== false)) {
                    $subject = $data[$key];
                }
                $returnValues = '';
                if (is_array($data[$key])) {
                    foreach ($data[$key] as $k => $v) {
                        $returnValues .= $v;
                        if ($k !== count($data[$key]) - 1) {
                            $returnValues .= ', ';
                        }
                    }
                } else {
                    $returnValues = $data[$key];
                }
                $body .= ucfirst($key) . ": " . $returnValues . "\n";
            }
        }
        if (!$subject) {
            $subject = 'Mail subject';
        }

        $redirect = $input->get('redirect', '', 'string');

        $mail = JFactory::getMailer();
        $mail->setSubject($subject);
        $mail->setBody($body);

        if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            $mail->addRecipient($recipient);
        }

        $ret = $mail->Send();

        if ($redirect) {
            JFactory::getApplication()->redirect($redirect);
        } else {
            header('Content-Type: application/json');
            $data = array();
            if ($ret) {
                $data['success'] = true;
            } else {
                $data['error'] = $ret;
            }
            echo json_encode($data);
            exit;
        }
    }
}
