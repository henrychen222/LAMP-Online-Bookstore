-- Table "shopping_history" DDL

CREATE TABLE `shopping_history` (
  `id` int(11) NOT NULL auto_increment,
  `customerId` int(11) NOT NULL,
  `bookId`  varchar(50) default NULL,
  `quentity` int default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


