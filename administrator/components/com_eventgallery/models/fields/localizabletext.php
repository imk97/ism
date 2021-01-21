<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');
require_once JPATH_ADMINISTRATOR . '/components/com_eventgallery/helpers/backendmedialoader.php';

// The class name must always be the same as the filename (in camel case)

class JFormFieldlocalizabletext extends JFormField
{

    //The field class must know its own type through the variable $type.
    protected $type = 'localizabletext';


    public function getInput()
    {

        EventgalleryHelpersBackendmedialoader::load();

        $name = (string)$this->element['name'];
        $inputtype=(string)$this->element['inputtype'];
        $class = $this->element['class'] ? ' class="form-control lc_'.$this->id.' ' . (string) $this->element['class'] . '"' : ' class="form-control lc_'.$this->id.'" ';
        $rows = $this->element['rows'] ? $this->element['rows'] : 4;
        $required = $this->required ? ' required="required" aria-required="true"' : '';

        $langs = \Joomla\CMS\Language\LanguageHelper::getKnownLanguages();

        $defaultLanguageTag = JComponentHelper::getParams('com_languages')->get('site');
        $defaultLanguage = $langs[$defaultLanguageTag];
        if ($defaultLanguage != null) {
            unset($langs[$defaultLanguageTag]);
            $langs = array_merge(array($defaultLanguageTag => $defaultLanguage), $langs);
        }

        $result = "";

        $lt = json_decode($this->value);

        if ($lt == null) {
            $lt = new stdClass();
            // added fallback logic in case the current value is not in JSON format
            // this might be because in older versions there where no multilanguage fields.
            if (!empty($this->value) && json_last_error() == JSON_ERROR_SYNTAX) {
                foreach($langs as $tag=>$lang) {
                    $lt->$tag = $this->value;
                }
            }
        }
        foreach($langs as $tag=>$lang) {
            $defaultLangMarker = $tag == $defaultLanguageTag? " *": "";
            $result .= '<div class="input-prepend" style="display:block; margin-bottom:10px;">';
            $result .= '<span class="add-on">'.$tag . $defaultLangMarker .'</span>';
            $value = htmlspecialchars(isset($lt->$tag)===true?$lt->$tag:'', ENT_COMPAT, 'UTF-8');
            if ($inputtype == 'textarea'){
                $result .= '<textarea data-tag="'.$tag.'" rows="'.$rows.'" type="text" '.$class.'>'.$value.'</textarea>';
            } else {
                $result .= '<input data-tag="'.$tag.'" type="text" value="'.$value.'" '.$class.'>';
            }
            $result .= '</div>';
        }

        $hiddenField =  '<input type="hidden" data-localizabletext="true" name="' . $this->name . '" id="' . $this->id . '" value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' . $required . '/>';

        return '<span class="localizabletext">'.$result.$hiddenField."</span>";
    }
}
