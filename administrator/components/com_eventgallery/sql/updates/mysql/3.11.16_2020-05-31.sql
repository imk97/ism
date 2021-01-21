ALTER TABLE `#__eventgallery_folder` MODIFY `password` VARCHAR( 250 ) DEFAULT NULL;
ALTER TABLE `#__eventgallery_folder` MODIFY `date` datetime DEFAULT NULL;
ALTER TABLE `#__eventgallery_imagetype` MODIFY `currency` varchar(3) DEFAULT NULL;
ALTER TABLE `#__eventgallery_paymentmethod` MODIFY `currency` varchar(3) DEFAULT NULL;
ALTER TABLE `#__eventgallery_shippingmethod` MODIFY `currency` varchar(3) DEFAULT NULL;
ALTER TABLE `#__eventgallery_surcharge` MODIFY `currency` varchar(3) DEFAULT NULL;