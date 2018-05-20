CREATE TABLE IF NOT EXISTS `#__joomly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` varchar(100) NOT NULL,
  `captions` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`), UNIQUE (`form`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
