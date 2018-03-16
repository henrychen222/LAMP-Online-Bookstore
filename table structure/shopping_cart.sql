
-- Table "shopping_cart" DDL

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL auto_increment,
  `customerId` int(11) NOT NULL,
  `bookId` varchar(50) NOT NULL,
  `bookPrice` float(13,1) NOT NULL,
  `bookNum` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;