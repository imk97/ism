<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

jimport('joomla.application.categories');

class EventgalleryHelpersRoute
{
    /**
     * creates a link based on a category id
     * @param $catid
     * @param null $itemid
     * @throws Exception
     * @return string
     */
    public static function createCategoryRoute($catid, $itemid = null) {

        if ($itemid == null) {
            $app = JFactory::getApplication();
            $menus = $app->getMenu('site');
            /**
             * @var JLanguage $lang
             */
            $lang = \Joomla\CMS\Factory::getApplication()->getLanguage();
            $language = $lang->getTag();


            $component = JComponentHelper::getComponent('com_eventgallery');

            $attributes = array('component_id');
            $values = array($component->id);

            // take the current lang into account
            $attributes[] = 'language';
            $values[] = array($language, '*');


            $items = $menus->getItems($attributes, $values);
            $itemid = NULL;
            $foundViewType = NULL;
            $options = array();
            $categories = JCategories::getInstance('Eventgallery', $options);

            foreach ($items as $item) {
                if (isset($item->query) && isset($item->query['view'])) {
                    $view = $item->query['view'];

                    if ($view == 'categories') {

                        // check the category reference
                        // the categories view uses the catid as query parameter, the events view as param
                        if (isset($item->query['catid'])) {
                            $menuItemCatid = $item->query['catid'];
                        } else {
                            $menuItemCatid = 0;
                        }
                        // if no category id is defined, this menu item would work
                        if ( null==$catid || $menuItemCatid  == 0) {
                            $itemMatches = true;
                        } else {

                            /**
                             * @var JCategoryNode $category
                             */

                            // get the category and the path for the current folder
                            $category = $categories->get($catid);
                            $path = $category->getPath();
                            $categoryMatches = false;

                            // search the path for
                            foreach($path as $pathItem) {
                                $temp = explode(':', $pathItem);
                                $currentCatId = $temp[0];
                                if ($menuItemCatid == $currentCatId) {
                                    $categoryMatches = true;
                                    break;
                                }
                            }

                            $itemMatches = $categoryMatches;
                        }

                        // set the necessary parameters if the current item is valid
                        if ($itemMatches) {
                            $itemid = $item->id;
                        }
                    }



                }

                if ($itemid != NULL) {
                    break;
                }
            }
        }


        $url = 'index.php?option=com_eventgallery&view=categories&catid='.$catid;

        // if not found, return language specific home link
        if ($itemid != NULL) {
            $url .= '&Itemid=' . $itemid;
        }

        return $url;
    }

    /**
     * create the route for a ucm link like from the tag component.
     *
     * @param $id
     * @param int $catid
     * @param int $language
     */
    public static function getEventRoute($id, $catid = 0, $language = 0) {

        $temp = explode(':', $id);
        $id  = $temp[0];

        $db    = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('folder')
            ->from('#__eventgallery_folder')
            ->where('id=' . $db->quote($id));

        $db->setQuery($query);
        $row = $db->loadObject();

        return self::createEventRoute($row->folder, null, null, null);
    }

    /**
     * creates a link to an event
     * @param $foldername
     * @param array $tags
     * @param $catid
     * @param null $itemid
     * @params String $targetLanguageCode
     * @throws Exception
     * @return string
     */
    public static function createEventRoute($foldername, $tags, $catid, $itemid = null, $targetLanguageCode = null)
    {

        $foundViewType = NULL;

        if ($itemid == null) {
            $menuItem = self::getMenuItemidForEvent($targetLanguageCode, $tags, $catid, $foldername, $itemid);
            if ($menuItem != null) {
                $itemid = $menuItem->id;
                $foundViewType = $menuItem->query['view'];
            } else {
                echo "";
            }
        }

        $url = 'index.php?option=com_eventgallery&view=event&folder=' . $foldername ;

        // if not found, return language specific home link
        if ($itemid != NULL) {
            // if this is an event view we don't need to specific additional data.
            if ($foundViewType == 'event') {
                return 'index.php?Itemid=' . $itemid;
            }
            $url .= '&Itemid=' . $itemid;
        }




        return $url;
    }

    /**
     * @param $targetLanguageCode
     * @param array $tags
     * @param $catid
     * @param $foldername
     * @param $itemid
     * @return \Joomla\CMS\Menu\MenuItem
     */
    public static function getMenuItemidForEvent($targetLanguageCode, $tags, $catid, $foldername, $itemid)
    {
        $app = JFactory::getApplication();
        $menus = $app->getMenu('site');
        /**
         * @var JLanguage $lang
         */
        $lang = $app->getLanguage();

        $language = $lang->getTag();

        if ($targetLanguageCode != null) {
            $language = $targetLanguageCode;
        }

        $component = JComponentHelper::getComponent('com_eventgallery');

        $attributes = array('component_id');
        $values = array($component->id);

        // take the current lang into account
        $attributes[] = 'language';
        $values[] = array($language, '*');

        $foundMenuItem = null;
        $items = $menus->getItems($attributes, $values);
        $itemid = NULL;
        $options = array();
        $categories = JCategories::getInstance('Eventgallery', $options);

        foreach ($items as $item) {
            if (isset($item->query) && isset($item->query['view'])) {
                $view = $item->query['view'];

                if ($view == 'events' || $view == 'categories') {

                    // check the tags
                    if (count($item->getParams()->get('tags', array())) == 0) {
                        $itemMatches = true;
                    } else {
                        if (EventgalleryHelpersTags::checkTags($item->getParams()->get('tags', array()), $tags)) {
                            $itemMatches = true;
                        } else {
                            $itemMatches = false;
                        }
                    }

                    // check the category reference
                    // the categories view uses the catid as query parameter, the events view as param
                    if ($view == 'categories' && isset($item->query['catid'])) {
                        $menuItemCatid = $item->query['catid'];
                    } else {
                        $menuItemCatid = $item->getParams()->get('catid', 0);
                    }
                    // if no category id is defined, this menu item would work
                    if (null == $catid || $menuItemCatid == 0) {
                        $itemMatches = $itemMatches && true;
                    } else {

                        /**
                         * @var JCategoryNode $category
                         */

                        // get the category and the path for the current folder
                        $category = $categories->get($catid);
                        if ($category != null) {
                            $path = $category->getPath();
                            $categoryMatches = false;

                            // search the path for
                            foreach ($path as $pathItem) {
                                $temp = explode(':', $pathItem);
                                $currentCatId = $temp[0];
                                if ($menuItemCatid == $currentCatId) {
                                    $categoryMatches = true;
                                    break;
                                }
                            }

                            $itemMatches = $itemMatches && $categoryMatches;
                        }

                    }

                    // set the necessary parameters if the current item is valid
                    if ($itemMatches) {
                        $itemid = $item->id;
                        $foundViewType = $view;
                        $foundMenuItem = $item;
                    }
                }

                if ($view == 'event' && isset($item->query['folder']) && $item->query['folder'] == $foldername) {
                    $itemid = $item->id;
                    $foundViewType = $view;
                    $foundMenuItem = $item;
                }

            }

            if ($itemid != NULL) {
                break;
            }
        }
        return $foundMenuItem;
    }
}

abstract class EventgalleryHelperRoute
{
    public static function getCategoryRoute($catid, /** @noinspection PhpUnusedParameterInspection */$language = 0) {
        if ($catid instanceof JCategoryNode)
        {
            $id = $catid->id;
            $category = $catid;
        }
        else
        {
            $id = (int) $catid;
            $category = JCategories::getInstance('Eventgallery')->get($id);
        }

        if ($id < 1 || !($category instanceof JCategoryNode))
        {
            return '';
        }

        $link = EventgalleryHelpersRoute::createCategoryRoute($id);

        return $link;
    }

    public static function getEventRoute($id, $catid = 0, $language = 0, $layout = null)
    {
        return EventgalleryHelpersRoute::getEventRoute($id, $catid, $language);
    }
}
