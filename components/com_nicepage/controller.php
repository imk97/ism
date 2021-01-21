<?php
/**
 * @package Nicepage Website Builder
 * @author Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

use NP\Processor\ProductsProcessor;

JLoader::register('NicepageHelpersNicepage', JPATH_ADMINISTRATOR . '/components/com_nicepage/helpers/nicepage.php');
JLoader::register('NicepageHelper', JPATH_COMPONENT . '/helpers/nicepage.php');

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
        exit(
            json_encode(
                array(
                    'result' => 'done',
                    'products' => NicepageHelper::getProductsBySource($source),
                )
            )
        );
    }

    /**
     *  Get posts
     */
    public function posts() {
        $source = JFactory::getApplication()->input->get('category', '', 'RAW');
        exit(
            json_encode(
                array(
                    'result' => 'done',
                    'blog' => NicepageHelper::getPostsBySource($source),
                )
            )
        );
    }

    /**
     * Get data info
     */
    public function getInfoData() {
        $menuData = NicepageHelper::getMenuInfoData();
        exit(
            json_encode(
                array(
                    'result' => array(
                        'menuItems' => $menuData['menuItems'],
                        'menuOptions' => $menuData['menuOptions'],
                        'blogInfo' => NicepageHelper::getBlogInfoData(),
                        'productsInfo' => NicepageHelper::getProductsInfoData(),
                    )
                )
            )
        );
    }

    /**
     * Submit form with custom code.
     */
    public function form()
    {
        exit(NicepageHelper::customSendMail());
    }

    /**
     * Submit form with joomla
     */
    public function sendmail()
    {
        exit(NicepageHelper::joomlaSendMail());
    }
}
