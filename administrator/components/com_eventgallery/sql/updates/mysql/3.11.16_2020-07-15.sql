UPDATE `#__eventgallery_folder` set date = '1970-01-01 00:00:01' where CAST(date AS CHAR(20)) = '0000-00-00 00:00:00';
ALTER TABLE `#__eventgallery_folder` MODIFY `description` text NOT NULL DEFAULT '';
