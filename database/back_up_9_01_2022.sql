/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - carmanagement
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`carmanagement` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `carmanagement`;

/*Table structure for table `checks` */

DROP TABLE IF EXISTS `checks`;

CREATE TABLE `checks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_no` varchar(255) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_surname` varchar(255) DEFAULT NULL,
  `customer_tel` varchar(255) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `rateCcs` int(11) DEFAULT NULL,
  `rateWeights` int(11) DEFAULT NULL,
  `legalEntity` varchar(10) DEFAULT NULL,
  `ngvcng` varchar(10) DEFAULT NULL,
  `hybrid` varchar(10) DEFAULT NULL,
  `israte` varchar(10) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `ispercen_discount` varchar(10) DEFAULT NULL,
  `percen_discount_amount` float DEFAULT NULL,
  `percen_discount` int(11) DEFAULT NULL,
  `ispercen_late` varchar(10) DEFAULT NULL,
  `percen_late_month` int(11) DEFAULT NULL,
  `percen_late` int(11) DEFAULT NULL,
  `isinspection` varchar(10) DEFAULT NULL,
  `inspection` float DEFAULT NULL,
  `istax_car_service` varchar(10) DEFAULT NULL,
  `tax_car_service` float DEFAULT NULL,
  `isother_service` varchar(10) DEFAULT NULL,
  `isother_service2` varchar(10) DEFAULT NULL,
  `isother_service3` varchar(10) DEFAULT NULL,
  `other_service` float DEFAULT NULL,
  `other_service2` float DEFAULT NULL,
  `other_service3` float DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `remark2` varchar(255) DEFAULT NULL,
  `remark3` varchar(255) DEFAULT NULL,
  `totalNet` float DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `productvmi_id` int(11) DEFAULT NULL,
  `paytype` varchar(255) DEFAULT NULL,
  `car_register_date` date DEFAULT NULL,
  `body_number` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `check_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `iscmi_service` varchar(10) DEFAULT NULL,
  `cmi_service` float DEFAULT NULL,
  `month_rate_1` int(10) DEFAULT NULL,
  `month_rate_1_total` float DEFAULT NULL,
  `month_rate_1_more` float DEFAULT NULL,
  `month_rate_2` int(10) DEFAULT NULL,
  `month_rate_2_total` float DEFAULT NULL,
  `month_rate_2_more` float DEFAULT NULL,
  `month_rate_3` int(10) DEFAULT NULL,
  `month_rate_3_total` float DEFAULT NULL,
  `month_rate_3_more` float DEFAULT NULL,
  `type_text` varchar(255) DEFAULT NULL,
  `is_product_cmi` varchar(10) DEFAULT NULL,
  `txt_product_cmi` float DEFAULT NULL,
  `is_product_vmi` varchar(10) DEFAULT NULL,
  `txt_product_vmi` float DEFAULT NULL,
  `dlt_total_net` float DEFAULT NULL,
  `dlt_extra_money` float DEFAULT NULL,
  `dlt_money_refund` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `normal_remark` text DEFAULT NULL,
  `isCopyBook` varchar(10) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7939 DEFAULT CHARSET=utf8;

/*Data for the table `checks` */

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `locations` */

insert  into `locations`(`id`,`name`,`name_address`,`location_date`,`created_at`,`updated_at`,`deleted_at`) values 
(41,'ทดสอบ ที่อยู่ ตรอ','ทดสอบ ที่อยู่ ตรอ','2022-08-13','2022-08-13 21:00:32','2022-09-01 21:27:50',NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_100000_create_password_resets_table',1),
(2,'2017_09_25_104052_create_1506325252_permissions_table',1),
(3,'2017_09_25_104054_create_1506325254_roles_table',1),
(4,'2017_09_25_104057_create_1506325257_users_table',1),
(5,'2017_09_25_104148_create_1506325308_events_table',1),
(6,'2017_09_25_104549_create_1506325548_invitations_table',1),
(7,'2017_09_25_104550_add_59c8b42e39169_relationships_to_invitation_table',1),
(8,'2017_09_25_171823_create_59c8b308a9095_permission_role_table',1),
(9,'2017_09_25_171826_create_59c8b30beaed6_role_user_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  KEY `fk_p_76488_76489_role_per_59c8b308a916d` (`permission_id`),
  KEY `fk_p_76489_76488_permissi_59c8b308a91e8` (`role_id`),
  CONSTRAINT `fk_p_76488_76489_role_per_59c8b308a916d` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_p_76489_76488_permissi_59c8b308a91e8` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values 
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(46,1),
(47,1),
(48,1),
(49,1),
(50,1),
(1,5),
(2,5),
(3,5),
(4,5),
(5,5),
(46,5),
(49,5),
(105,1),
(106,1),
(107,1),
(108,1),
(109,1),
(110,1),
(111,1),
(112,1),
(113,1),
(114,1),
(115,1),
(116,1);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`title`,`created_at`,`updated_at`) values 
(1,'user_management_access','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(2,'user_management_create','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(3,'user_management_edit','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(4,'user_management_view','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(5,'user_management_delete','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(6,'permission_access','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(7,'permission_create','2018-07-09 15:54:17','2018-07-09 15:54:17'),
(8,'permission_edit','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(9,'permission_view','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(10,'permission_delete','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(11,'role_access','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(12,'role_create','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(13,'role_edit','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(14,'role_view','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(15,'role_delete','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(16,'user_access','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(17,'user_create','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(18,'user_edit','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(19,'user_view','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(20,'user_delete','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(46,'location_access','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(47,'location_create','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(48,'location_edit','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(49,'location_view','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(50,'location_delete','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(105,'rateCc_access','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(106,'rateCc_create','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(107,'rateCc_edit','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(108,'rateCc_view','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(109,'rateCc_delete','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(110,'rateWeight_access','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(111,'rateWeight_create','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(112,'rateWeight_edit','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(113,'rateWeight_view','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(114,'rateWeight_delete','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(115,'check_access','2018-07-15 13:58:57','2018-07-15 13:58:57'),
(116,'check_create','2018-07-15 13:58:57','2018-07-15 13:58:57');

/*Table structure for table `rate_ccs` */

DROP TABLE IF EXISTS `rate_ccs`;

CREATE TABLE `rate_ccs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `legalEntity` int(11) DEFAULT NULL,
  `ngv_cng` int(11) DEFAULT NULL,
  `hybrid` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `percen_discount` int(11) DEFAULT NULL,
  `percen_late` int(11) DEFAULT NULL,
  `inspection` float DEFAULT NULL,
  `tax_car_service` float DEFAULT NULL,
  `other_service` float DEFAULT 100,
  `other_service2` float DEFAULT 150,
  `other_service3` float DEFAULT 200,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `rate_ccs` */

insert  into `rate_ccs`(`id`,`name`,`type`,`legalEntity`,`ngv_cng`,`hybrid`,`rate`,`percen_discount`,`percen_late`,`inspection`,`tax_car_service`,`other_service`,`other_service2`,`other_service3`,`remark`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'ไม่เกิน 5 ปี  cc น้อยกว่า 600','CC',2,50,25,0.5,0,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:50:15',NULL),
(2,'ไม่เกิน 5 ปี  cc 601 - 1,800','CC',2,50,25,1.5,0,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:50:23',NULL),
(3,'ไม่เกิน 5 ปี  cc เกิน 1,800','CC',2,50,25,4,0,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:50:34',NULL),
(5,'เป็นรถเก่าใช้งานมานานเกิน 6 ปี ให้ลดภาษี','CC',2,50,25,1,10,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:50:44',NULL),
(6,'เป็นรถเก่าใช้งานมานานเกิน 7 ปี ให้ลดภาษี','CC',2,50,25,1,20,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:50:51',NULL),
(7,'เป็นรถเก่าใช้งานมานานเกิน 8 ปี ให้ลดภาษี','CC',2,50,25,1,30,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:50:58',NULL),
(8,'เป็นรถเก่าใช้งานมานานเกิน 9 ปี ให้ลดภาษี','CC',2,50,25,1,40,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:51:08',NULL),
(9,'เป็นรถเก่าใช้งานมานานเกิน 10 ปี หรือปีต่อๆไป','CC',2,50,25,1,50,1,200,150,0,0,0,NULL,NULL,'2021-06-28 10:51:31',NULL),
(10,'รถจักรยานยนต์','FixRate',1,0,0,1,0,1,60,100,0,0,0,NULL,NULL,'2021-06-28 10:59:01',NULL);

/*Table structure for table `rate_weights` */

DROP TABLE IF EXISTS `rate_weights`;

CREATE TABLE `rate_weights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `start_weight` int(11) DEFAULT NULL,
  `end_weight` int(11) DEFAULT NULL,
  `car1` float DEFAULT NULL,
  `car2` float DEFAULT NULL,
  `car3` float DEFAULT NULL,
  `car4` float DEFAULT NULL,
  `legalEntity` int(11) DEFAULT NULL,
  `ngv_cng` int(11) DEFAULT NULL,
  `hybrid` int(11) DEFAULT NULL,
  `percen_late` int(11) DEFAULT NULL,
  `inspection` float DEFAULT NULL,
  `tax_car_service` float DEFAULT NULL,
  `other_service` float DEFAULT 100,
  `other_service2` float DEFAULT 150,
  `other_service3` float DEFAULT 200,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `rate_weights` */

insert  into `rate_weights`(`id`,`type`,`start_weight`,`end_weight`,`car1`,`car2`,`car3`,`car4`,`legalEntity`,`ngv_cng`,`hybrid`,`percen_late`,`inspection`,`tax_car_service`,`other_service`,`other_service2`,`other_service3`,`remark`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'ไม่เกิน 500',0,500,150,450,185,300,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(2,'501 - 750',501,750,300,750,340,450,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(3,'751 - 1,000',751,1000,450,1050,450,600,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(4,'1,001 - 1,250',1001,1250,800,1350,560,750,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(5,'1,251 - 1,500',1251,1500,1000,1650,685,900,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(6,'1,501 - 1,750',1501,1750,1050,2100,875,1050,1,50,25,1,200,150,0,0,0,NULL,NULL,'2021-06-26 14:14:13',NULL),
(7,'1,751 - 2,000',1751,2000,1600,2550,1060,1350,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(8,'2,001 - 2,500',2001,2500,1900,3000,1250,1650,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(9,'2,501 - 3,000',2501,3000,2200,3450,1435,1950,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(10,'3,001 - 3,500',3001,3500,2400,3900,1625,2250,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(11,'3,501 - 4,000',3501,4000,2600,4350,1810,2550,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(12,'4,001 - 4,500',4001,4500,2800,4850,2000,2850,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(13,'4,501 - 5,000',4501,5000,3000,5250,2185,3150,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(14,'5,001 - 6,000',5001,6000,3200,5750,2375,3450,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(15,'6,001 - 7,000',6001,7000,3400,6150,2560,3750,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL),
(16,'7,000 ขึ้นไป',7001,999999,3600,6600,2750,4050,1,50,25,1,200,150,0,0,0,'',NULL,NULL,NULL);

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `role_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  KEY `fk_p_76489_76490_user_rol_59c8b30beafc3` (`role_id`),
  KEY `fk_p_76490_76489_role_use_59c8b30beb03d` (`user_id`),
  CONSTRAINT `fk_p_76489_76490_user_rol_59c8b30beafc3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_p_76490_76489_role_use_59c8b30beb03d` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`role_id`,`user_id`) values 
(1,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`title`,`created_at`,`updated_at`) values 
(1,'Administrator (can create other users)','2018-07-09 15:54:18','2018-07-09 15:54:18'),
(5,'NormalUser','2018-07-09 15:54:18','2022-09-01 20:04:18');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`location_id`,`created_at`,`updated_at`) values 
(1,'Admin','admin@admin.com','$2y$10$8lQ1dR1JQJBPRxAZEetHIuGWxKwtecIaIKR5Qf1ytPpNaeGqkPKRC','9VUOvVyq29a0TaC4rwRI4rcU1V8o2UUjrK9xQWCV5oknefKFIPfodvaioayu',41,'2018-07-09 15:54:18','2022-08-13 21:00:43');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
