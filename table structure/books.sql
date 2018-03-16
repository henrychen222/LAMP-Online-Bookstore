-- Table "books" DDL
CREATE TABLE `books` (
  `id` int(10) NOT NULL auto_increment,
  `ISBN` varchar(128) default NULL,
  `title` char(128) default NULL,
  `price` char(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


