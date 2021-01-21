drop table IF EXISTS `#__eventgallery_comment`;
drop table IF EXISTS `#__eventgallery_file`;
drop table IF EXISTS `#__eventgallery_foldertype`;
drop table IF EXISTS `#__eventgallery_folder`;
drop table IF EXISTS `#__eventgallery_token`;
DROP TABLE IF EXISTS `#__eventgallery_sequence`;
DROP TABLE IF EXISTS `#__eventgallery_imagelineitem`;
DROP TABLE IF EXISTS `#__eventgallery_servicelineitem`;
DROP TABLE IF EXISTS `#__eventgallery_imagetypeset`;
DROP TABLE IF EXISTS `#__eventgallery_useraddress`;
DROP TABLE IF EXISTS `#__eventgallery_staticaddress`;
DROP TABLE IF EXISTS `#__eventgallery_imagetypeset_imagetype`;
DROP TABLE IF EXISTS `#__eventgallery_imagetypeset_imagetype_assignment`;
DROP TABLE IF EXISTS `#__eventgallery_imagetype`;
DROP TABLE IF EXISTS `#__eventgallery_cart`;
DROP TABLE IF EXISTS `#__eventgallery_order`;
DROP TABLE IF EXISTS `#__eventgallery_orderstatus`;
DROP TABLE IF EXISTS `#__eventgallery_paymentmethod`;
DROP TABLE IF EXISTS `#__eventgallery_shippingmethod`;
DROP TABLE IF EXISTS `#__eventgallery_surcharge`;
DROP TABLE IF EXISTS `#__eventgallery_watermark`;
DROP TABLE IF EXISTS `#__eventgallery_emailtemplate`;
DROP TABLE IF EXISTS `#__eventgallery_auth_token`;
DROP TABLE IF EXISTS `#__eventgallery_state`;

DELETE FROM `#__ucm_base` WHERE ucm_type_id in
	(select type_id from `#__content_types` WHERE type_alias in ('com_eventgallery.event','com_eventgallery.category'));
DELETE FROM `#__ucm_content` WHERE core_type_alias in ('com_eventgallery.event','com_eventgallery.category');
DELETE FROM `#__contentitem_tag_map`WHERE type_alias in ('com_eventgallery.event','com_eventgallery.category');
DELETE FROM `#__content_types` WHERE type_alias in ('com_eventgallery.event','com_eventgallery.category');

