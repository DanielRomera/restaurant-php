CREATE TABLE `Tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `Dishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,0) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE TABLE `Orders` (
  `id_table` int(11) NOT NULL,
  `id_dish` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_table`,`id_dish`),
  KEY `OrderDishRelationship` (`id_dish`),
  CONSTRAINT `OrderDishRelationship` FOREIGN KEY (`id_dish`) REFERENCES `Dishes` (`id`),
  CONSTRAINT `OrderTableRelationship` FOREIGN KEY (`id_table`) REFERENCES `Tables` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into `Dishes`(`id`,`price`,`image`,`name`,`description`) values (1,6,'Caesar_salad.jpg','Caesar Salad','Crisp romaine, pepper-and-butter croutons, and grated Parmesan are tossed with traditional Caesar dressing. The croutons are best made no more than half an hour before assembling the salad.');
insert into `Dishes`(`id`,`price`,`image`,`name`,`description`) values (2,4,'Sirloin.jpg','Center-Cut Sirloin','From now on, every Sirloin here is a Center-Cut Sirloin. The most tender cut of all. And, it''s an Outback Sirloin, so it''s always expertly aged, seasoned and cooked to juicy perfection. Sirloin at its best.');
insert into `Dishes`(`id`,`price`,`image`,`name`,`description`) values (3,10,'coconut-swordfish-curry.jpeg','Coconut Swordfish Curry','Swordfish with its slightly sweet flavour and meaty texture is the perfect fish for this creamy curry.');
insert into `Dishes`(`id`,`price`,`image`,`name`,`description`) values (4,7,'bacon-cheddar-burger.jpg','Bacon Cheddar Burguer','This is the classic recipe for Bacon Cheddar Burgers, and one that gets its special flavor from a bit of Worcestershire sauce mixed right in the ground beef. That''s the secret to the zesty taste to these hearty burgers.');
insert into `Dishes`(`id`,`price`,`image`,`name`,`description`) values (5,5,'sushi.jpg','Sushi','Cold cooked rice dressed with vinegar that is shaped into pieces and topped with raw or cooked fish, or formed into a roll with fish, egg, or vegetables and often wrapped in seaweed.');
insert into `Dishes`(`id`,`price`,`image`,`name`,`description`) values (6,7,'japanese.jpg','Japanese-Style Swiss Chard and Sesame Salad','Turn tough chard leaves tender by giving them a light pounding, then dress them in this light sesame-flavored vinaigrette. It''s the perfect side to Amy Thielen''s Japan-meets-Midwest tonkatsu burger.');
insert into `Tables`(`id`,`number`) values (1,'Table 1');
insert into `Tables`(`id`,`number`) values (2,'Table 2');
insert into `Tables`(`id`,`number`) values (3,'Sun Table');
insert into `Tables`(`id`,`number`) values (4,'Moon Table');