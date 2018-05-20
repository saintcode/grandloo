CREATE TABLE IF NOT EXISTS `#__joomly_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
 `created_at` datetime,
 `page` varchar(100) NOT NULL,
 `ip` varchar(100) NOT NULL,
 `read` int(1) NOT NULL,
 `input1` text(1000) NOT NULL, `input2` text(1000) NOT NULL, `input3` text(1000) NOT NULL, `input4` text(1000) NOT NULL, `textarea1` text(1000) NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;INSERT into `#__joomly` (`form`,`captions`) values ('booking','["Имя","Email","Телефон","Количество человек","Дополнительная информация"]') ON DUPLICATE KEY UPDATE `captions`=VALUES(`captions`);