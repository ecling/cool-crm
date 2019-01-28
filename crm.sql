/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.19-log : Database - crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crm` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`title`,`price`) values (1,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (2,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (3,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (4,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (5,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (6,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (7,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (8,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (9,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (10,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (11,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (12,'Foo bar','19.99');
insert  into `books`(`id`,`title`,`price`) values (13,'test','19.36');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) NOT NULL,
  `purchase_price` decimal(12,2) NOT NULL,
  `shipping_cost` decimal(12,2) NOT NULL,
  `weight` decimal(12,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `addition_images` varchar(255) DEFAULT NULL,
  `category_ids` varchar(255) DEFAULT NULL,
  `category2_ids` varchar(255) DEFAULT NULL,
  `website_ids` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (1,'sku001','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M sku001 +++','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.</p>\n<p>&nbsp;</p>\n<p>sku001</p>','1,3','1,2','2019/01/23/5c481820e00ab.jpg','2019/01/23/5c4817406fc6c.jpg,2019/01/23/5c48176f2635b.jpg','4,5','4,6','1,2',1,'2019-01-19 15:12:53');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (15,'sku001','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M sku001','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.</p>\n<p>&nbsp;</p>\n<p>sku001</p>','1,3','1,2','2019/01/23/5c4834a0ab612.jpg','2019/01/23/5c4834a7db54d.jpg,2019/01/23/5c4834a8218b3.jpg','4,5','4,6','1,2',1,'2019-01-23 02:49:04');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (4,'sku002','36.36','364.36','0.23',100,'test title sku002  +++','<p>test test test s</p>\n<p>sku002</p>','1,2','3,6',NULL,NULL,'6,7','5,8','1,2',1,'2018-10-12 12:12:12');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (5,'sku002','36.36','364.36','0.23',100,'test test ','test test test','1,2','3,6','ad/test.jpg,abc/abd.jpg','a.jpg,b.jpg','6,7','5,8','1,2',1,'2018-10-12 12:12:12');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (3,'sku002','36.36','364.36','0.23',100,'test test ','test test test','1,2','3,6','ad/test.jpg,abc/abd.jpg','a.jpg,b.jpg','6,7','5,8','1,2',1,'2018-10-12 12:12:12');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (6,'sku006','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M','Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette.\r\nClothing Style: Sweatshirt \r\nSleeve Type: Drop Shoulder \r\nLength: Short \r\nSleeves Length: Full \r\nMaterial: Polyester \r\nPattern Style: Plaid \r\nDecoration: Zipper \r\nWeight: 0.5200kg \r\nPackage: 1 x Sweatshirt\r\nPlease Note:\r\nDue to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received.\r\nStyle and Fit Disclaimer:\r\nWe can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc.\r\nInstruction:\r\nThere may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.','1,3','1,2',NULL,NULL,'4,5','4,6','1,2',1,'2019-01-22 09:09:11');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (7,'sku007','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M 007','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.&nbsp;</p>\n<p>007</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>','1,3,7','1',NULL,NULL,'4,5','4,6','1',1,'2019-01-22 09:09:49');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (8,'sku009','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M 009','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.&nbsp;</p>\n<p>009</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>','1,3,9','5',NULL,NULL,'4,6','4,5','3',1,'2019-01-22 09:20:35');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (9,'test','23.69','63.00','2.36',666,'asdfasdfasdfasdf asdf','<p>fasdfasdfasd fsd fasdf</p>','7','3',NULL,NULL,'4,5','4,5','2',1,'2019-01-23 02:09:08');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (10,'sku009','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M','Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette.\r\nClothing Style: Sweatshirt \r\nSleeve Type: Drop Shoulder \r\nLength: Short \r\nSleeves Length: Full \r\nMaterial: Polyester \r\nPattern Style: Plaid \r\nDecoration: Zipper \r\nWeight: 0.5200kg \r\nPackage: 1 x Sweatshirt\r\nPlease Note:\r\nDue to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received.\r\nStyle and Fit Disclaimer:\r\nWe can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc.\r\nInstruction:\r\nThere may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.','1,3','1,2',NULL,NULL,'4,5','4,6','1,2',1,'2019-01-23 02:21:12');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (11,'sku0010','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M sku0010','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.</p>\n<p>&nbsp;</p>\n<p>sku0010</p>','1,3','1,2',NULL,NULL,'4,5','4,6','1,2',1,'2019-01-23 02:25:28');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (12,'sku011','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M sku011','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.</p>\n<p>&nbsp;</p>\n<p>sku011</p>','1,3','1,2',NULL,NULL,'4,5','4,6','1,2',1,'2019-01-23 02:29:25');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (13,'sku0112','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M sku0112','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.</p>\n<p>&nbsp;</p>\n<p>sku0112</p>','1,3','1,2',NULL,NULL,'4,5','4,6','1,2',1,'2019-01-23 02:30:25');
insert  into `product`(`product_id`,`sku`,`purchase_price`,`shipping_cost`,`weight`,`qty`,`name`,`description`,`color`,`size`,`main_image`,`addition_images`,`category_ids`,`category2_ids`,`website_ids`,`status`,`created_at`) values (14,'sku0014','65.32','11.63','0.26',999,'Plaid Crop Faux Fur Sweatshirt - Multi M sku0014 ==','<p>Drown in this plaid faux fur sweatshirt. With common drop-shoulder design, it emphasizes a half-zip closure at the front, trendy cropped length, and a comfy loose-fitting silhouette. Clothing Style: Sweatshirt Sleeve Type: Drop Shoulder Length: Short Sleeves Length: Full Material: Polyester Pattern Style: Plaid Decoration: Zipper Weight: 0.5200kg Package: 1 x Sweatshirt Please Note: Due to possible physical differences between different monitors (e.g. models, settings, color gamut, panel type, screen glare, etc), the product photography is illustrative only and may not precisely reflect the actual color of the item received. Style and Fit Disclaimer: We can guarantee that the overall style displayed in the photography is accurate, however there may be differences in how the style appears during wear. This depends on other physical variables, e.g. personal body size, body shape, limb proportion, height, etc. Instruction: There may be 1 - 3cm differ due to manual measurement. Please choose the right one according to your actual situation.</p>\n<p>&nbsp;</p>\n<p>sku0014</p>','1,3','1,2',NULL,NULL,'4,5','4,6','1,2',1,'2019-01-23 02:36:49');

/*Table structure for table `product_category` */

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  PRIMARY KEY (`category_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_category` */

/*Table structure for table `product_lang` */

DROP TABLE IF EXISTS `product_lang`;

CREATE TABLE `product_lang` (
  `product_id` int(11) NOT NULL,
  `name_it` varchar(255) DEFAULT NULL,
  `name_nl` varchar(255) DEFAULT NULL,
  `name_pt` varchar(255) DEFAULT NULL,
  `name_au` varchar(255) DEFAULT NULL,
  `name_de` varchar(255) DEFAULT NULL,
  `name_es` varchar(255) DEFAULT NULL,
  `name_fr` varchar(255) DEFAULT NULL,
  `description_it` text,
  `description_nl` text,
  `description_pt` text,
  `description_au` text,
  `description_de` text,
  `description_es` text,
  `description_fr` text,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_lang` */

/*Table structure for table `product_option_vale` */

DROP TABLE IF EXISTS `product_option_vale`;

CREATE TABLE `product_option_vale` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_code` varchar(255) DEFAULT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `product_option_vale` */

insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (1,'size','Size','S');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (2,'size','Size','M');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (3,'size','Size','L');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (4,'size','Size','XL');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (5,'size','Size','XXL');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (6,'color','Color','Black');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (7,'color','Color','Blue');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (8,'color','Color','Red');
insert  into `product_option_vale`(`value_id`,`option_code`,`option_name`,`value`) values (9,'color','Color','Green');

/*Table structure for table `product_website` */

DROP TABLE IF EXISTS `product_website`;

CREATE TABLE `product_website` (
  `website_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `online_id` int(11) DEFAULT NULL,
  `online_stauts` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`website_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_website` */

/*Table structure for table `sys_category` */

DROP TABLE IF EXISTS `sys_category`;

CREATE TABLE `sys_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `sys_category` */

insert  into `sys_category`(`category_id`,`name`,`parent_id`,`status`) values (4,'Dress',3,1);
insert  into `sys_category`(`category_id`,`name`,`parent_id`,`status`) values (5,'Dresses 2018',4,1);
insert  into `sys_category`(`category_id`,`name`,`parent_id`,`status`) values (6,'Dresses 2019',4,1);
insert  into `sys_category`(`category_id`,`name`,`parent_id`,`status`) values (10,'Top',3,1);
insert  into `sys_category`(`category_id`,`name`,`parent_id`,`status`) values (11,'Top 2018',10,1);
insert  into `sys_category`(`category_id`,`name`,`parent_id`,`status`) values (12,'Top 2019',10,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`is_active`) values (1,'johndoe','$2y$13$GJFcCqPzPdlWhPPTEKwsA.ErK1d00x.3M8.uQHOvEVLMsJtDsT4MW',1);

/*Table structure for table `web_category` */

DROP TABLE IF EXISTS `web_category`;

CREATE TABLE `web_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `web_category` */

/*Table structure for table `website` */

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `website_id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(255) NOT NULL,
  `api_url` varchar(255) NOT NULL,
  `api_user` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  PRIMARY KEY (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `website` */

insert  into `website`(`website_id`,`website_name`,`api_url`,`api_user`,`api_key`) values (1,'Bellecat','a','a','a');
insert  into `website`(`website_id`,`website_name`,`api_url`,`api_user`,`api_key`) values (2,'Babears','a','a','a');
insert  into `website`(`website_id`,`website_name`,`api_url`,`api_user`,`api_key`) values (3,'Rosalla','a','a','a');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
