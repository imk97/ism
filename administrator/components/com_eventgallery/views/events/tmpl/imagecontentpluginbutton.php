<?php

/**
 * @package     Sven.Bluege
 * @subpackage  com_eventgallery
 *
 * @copyright   Copyright (C) 2005 - 2019 Sven Bluege All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();


/**
 * @var \Joomla\CMS\Form\Form $form
 */
$form = $this->get('ImageContentPluginButtonForm');
$config = \Joomla\Component\Eventgallery\Site\Library\Configuration\Main::getInstance();

$form->setFieldAttribute('image_crop', 'default', $config->getContentplugin()->getImageContentPluginImageCrop()?'true' : 'false');
$form->setFieldAttribute('image_mode', 'default', $config->getContentplugin()->getImageContentPluginMode());
$form->setFieldAttribute('image_width', 'default', $config->getContentplugin()->getImageContentPluginImageWidth());
$form->setFieldAttribute('cssclass', 'default', $config->getContentplugin()->getImageContentPluginCssClass());
$form->setFieldAttribute('use_cart', 'default', $config->getContentplugin()->getImageContentPluginUseCart()?'1' : '0');


function xmlToArray($xml, $options = array()) {
    $defaults = array(
        'namespaceSeparator' => ':',//you may want this to be something other than a colon
        'attributePrefix' => '',   //to distinguish between attributes and nodes with the same name
        'alwaysArray' => array(),   //array of xml tag names which should always become arrays
        'autoArray' => true,        //only create arrays for tags which appear more than once
        'textContent' => 'text',       //key used for the text content of elements
        'autoText' => true,         //skip textContent key if node has no attributes or child nodes
        'keySearch' => false,       //optional search and replace on tag and attribute names
        'keyReplace' => false       //replace values for above search values (as passed to str_replace())
    );
    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; //add base (empty) namespace

    //get attributes from all namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            //replace characters in attribute name
            if ($options['keySearch']) $attributeName =
                str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix']
                . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                . $attributeName;
            $attributesArray[$attributeKey] = (string)$attribute;
        }
    }

    //get child nodes from all namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->children($namespace) as $childXml) {
            //recurse into child nodes
            $childArray = xmlToArray($childXml, $options);
            list($childTagName, $childProperties) = [key($childArray), current($childArray)]  ;

            //replace characters in tag name
            if ($options['keySearch']) $childTagName =
                str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            //add namespace prefix, if any
            if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

            if (!isset($tagsArray[$childTagName])) {
                //only entry with this key
                //test if tags of this type should always be arrays, no matter the element count
                $tagsArray[$childTagName] =
                    in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                        ? array($childProperties) : $childProperties;
            } elseif (
                is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                === range(0, count($tagsArray[$childTagName]) - 1)
            ) {
                //key already exists and is integer indexed array
                $tagsArray[$childTagName][] = $childProperties;
            } else {
                //key exists so convert to integer indexed array with previous value in position 0
                $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
            }
        }
    }

    //get text content of node
    $textContentArray = array();
    $plainText = trim((string)$xml);
    if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

    //stick it all together
    $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
        ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

    //return node as array
    return array(
        $xml->getName() => $propertiesArray
    );
}

/**
 * @param $el array
 */
function translate(&$el)  {

    foreach($el as $key=>&$value) {
        if (is_array($value)) {
            translate($el[$key]);
        } else {
            $el[$key] = JText::_($value);
        }
    }
}


$data = xmlToArray($form->getXml());
translate($data);

?>

<div id="imagecontentpluginform"
     data-editor-name="<?php echo $this->escape($app->input->getString('e_name'))?>"
     data-load-folders-url="<?php echo JRoute::_('index.php?option=com_eventgallery&task=rest.folders&format=raw', false); ?>"
     data-load-files-url="<?php echo JRoute::_('index.php?option=com_eventgallery&task=rest.files&format=raw', false);?>"
     data-form-id="contentform"
     data-form-definition-json="<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');  ?>"
     data-i18n-COM_EVENTGALLERY_CONTENTPLUGINBUTTON_BUTTON_INSERT="<?php echo JText::_('COM_EVENTGALLERY_CONTENTPLUGINBUTTON_BUTTON_INSERT')?>"
></div>

