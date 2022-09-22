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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `locations` */

insert  into `locations`(`id`,`name`,`name_address`,`location_date`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'ที่อยู่ ตรอ. สาขาหนึ่งในเชียงใหม่ (edit)','123 เมือง เชียงใหม่ (edit)','2022-09-22','2022-09-22 23:02:20','2022-09-22 23:08:17',NULL);

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
(1,5),
(2,5),
(3,5),
(4,5),
(5,5),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`title`,`created_at`,`updated_at`) values 
(1,'user_management_access','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(2,'user_management_create','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(3,'user_management_edit','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(4,'user_management_view','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(5,'user_management_delete','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(6,'permission_access','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(7,'permission_create','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(8,'permission_edit','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(9,'permission_view','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(10,'permission_delete','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(11,'role_access','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(12,'role_create','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(13,'role_edit','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(14,'role_view','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(15,'role_delete','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(16,'user_access','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(17,'user_create','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(18,'user_edit','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(19,'user_view','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(20,'user_delete','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(21,'location_access','2022-09-22 18:50:29','2022-09-22 18:50:29'),
(22,'location_create','2022-09-22 18:50:29','2022-09-22 18:50:29'),
(23,'location_edit','2022-09-22 18:50:29','2022-09-22 18:50:29'),
(24,'location_view','2022-09-22 18:50:29','2022-09-22 18:50:29'),
(25,'location_delete','2022-09-22 18:50:29','2022-09-15 18:50:29');

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
(1,1),
(5,2),
(5,3);

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
(1,'Administrator (can create other users)','2022-09-15 18:50:29','2022-09-15 18:50:29'),
(5,'NormalUser','2022-09-15 18:50:29','2022-09-15 18:50:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`location_id`,`created_at`,`updated_at`) values 
(1,'AdminName','admin@admin.com','$2y$10$6diajKl0fipkMF1VQwwideDzWulYH4Nyv0R7kcbvI4pyTyjTWCM5W','Kowmz9is6LwIMMwCxofxYoSr5C7H6utfiaHHUnbpMRmQYroqoc7ox7tqvb7y',41,'2022-09-15 18:50:29','2022-09-20 20:55:42'),
(2,'user','user@gmail.com','$2y$10$plDw9HhCnYj1fhzBcGedYeqFxt1vYS4D8k6Oryv0xHhdWeCkVMKPa','yhUdeL7OpOcAhKetD39oM05IhWOoR6jJtIJRCfGqm4EQNyZgbY3BwD9XymXd',NULL,'2022-09-20 21:06:43','2022-09-20 21:06:43'),
(3,'me','gkwon8891@gmail.com','$2y$10$P3ylPZ7oRyldrmZnw/F7q.xGrYdpdwnd3jdJhJnay6VnpPPqkCyoi','eVvEBBDEVI6Ppaj3Pa92libnGpC3gaHwTotahBrMSSqHVTef7QVr14Seiv9M',NULL,'2022-09-20 21:07:31','2022-09-22 23:15:54');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
