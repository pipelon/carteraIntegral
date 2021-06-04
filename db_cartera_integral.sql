/*
SQLyog Community v8.71 
MySQL - 5.5.5-10.4.10-MariaDB : Database - db_cartera_integral
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cartera_integral` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_cartera_integral`;

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('SuperAdministrador','6',1621801416);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1621800748,1621800748),('/admin/*',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/assignment/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/assignment/assign',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/index',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/revoke',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/view',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/default/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/default/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/create',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/delete',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/update',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/view',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/assign',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/create',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/delete',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/get-users',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/remove',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/update',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/view',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/role/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/assign',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/delete',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/get-users',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/role/remove',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/update',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/view',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/assign',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/index',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/refresh',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/remove',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/delete',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/index',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/update',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/view',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/user/*',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/activate',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/change-password',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/delete',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/index',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/login',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/logout',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/reset-password',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/signup',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/view',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/*',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/default/*',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/db-explain',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/download-mail',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/index',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/toolbar',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/view',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/user/*',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/user/reset-identity',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/user/set-identity',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/*',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/*',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/action',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/diff',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/index',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/preview',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/view',2,NULL,NULL,NULL,1621800747,1621800747),('/gridview/*',2,NULL,NULL,NULL,1622834672,1622834672),('/gridview/export/*',2,NULL,NULL,NULL,1622834672,1622834672),('/gridview/export/download',2,NULL,NULL,NULL,1622834672,1622834672),('/process-types/*',2,NULL,NULL,NULL,1622832194,1622832194),('/process-types/create',2,NULL,NULL,NULL,1622832194,1622832194),('/process-types/delete',2,NULL,NULL,NULL,1622832194,1622832194),('/process-types/index',2,NULL,NULL,NULL,1622832194,1622832194),('/process-types/update',2,NULL,NULL,NULL,1622832194,1622832194),('/process-types/view',2,NULL,NULL,NULL,1622832194,1622832194),('/report-temp/*',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/create',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/delete',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/index',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/update',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/view',2,NULL,NULL,NULL,1622833076,1622833076),('/site/*',2,NULL,NULL,NULL,1621800748,1621800748),('/site/about',2,NULL,NULL,NULL,1621800748,1621800748),('/site/captcha',2,NULL,NULL,NULL,1621800747,1621800747),('/site/contact',2,NULL,NULL,NULL,1621800748,1621800748),('/site/error',2,NULL,NULL,NULL,1621800747,1621800747),('/site/index',2,NULL,NULL,NULL,1621800747,1621800747),('/site/login',2,NULL,NULL,NULL,1621800747,1621800747),('/site/logout',2,NULL,NULL,NULL,1621800747,1621800747),('/users/*',2,NULL,NULL,NULL,1621802631,1621802631),('/users/create',2,NULL,NULL,NULL,1621802631,1621802631),('/users/delete',2,NULL,NULL,NULL,1621802631,1621802631),('/users/index',2,NULL,NULL,NULL,1621802631,1621802631),('/users/update',2,NULL,NULL,NULL,1621802631,1621802631),('/users/view',2,NULL,NULL,NULL,1621802631,1621802631),('fullPermission',2,'Todos los permisos asignados',NULL,NULL,1621800859,1621800859),('SuperAdministrador',1,'Super Administrador con acceso a todas las rutas',NULL,NULL,1621801114,1621801128);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('fullPermission','/*'),('fullPermission','/admin/*'),('fullPermission','/admin/assignment/*'),('fullPermission','/admin/assignment/assign'),('fullPermission','/admin/assignment/index'),('fullPermission','/admin/assignment/revoke'),('fullPermission','/admin/assignment/view'),('fullPermission','/admin/default/*'),('fullPermission','/admin/default/index'),('fullPermission','/admin/menu/*'),('fullPermission','/admin/menu/create'),('fullPermission','/admin/menu/delete'),('fullPermission','/admin/menu/index'),('fullPermission','/admin/menu/update'),('fullPermission','/admin/menu/view'),('fullPermission','/admin/permission/*'),('fullPermission','/admin/permission/assign'),('fullPermission','/admin/permission/create'),('fullPermission','/admin/permission/delete'),('fullPermission','/admin/permission/get-users'),('fullPermission','/admin/permission/index'),('fullPermission','/admin/permission/remove'),('fullPermission','/admin/permission/update'),('fullPermission','/admin/permission/view'),('fullPermission','/admin/role/*'),('fullPermission','/admin/role/assign'),('fullPermission','/admin/role/create'),('fullPermission','/admin/role/delete'),('fullPermission','/admin/role/get-users'),('fullPermission','/admin/role/index'),('fullPermission','/admin/role/remove'),('fullPermission','/admin/role/update'),('fullPermission','/admin/role/view'),('fullPermission','/admin/route/*'),('fullPermission','/admin/route/assign'),('fullPermission','/admin/route/create'),('fullPermission','/admin/route/index'),('fullPermission','/admin/route/refresh'),('fullPermission','/admin/route/remove'),('fullPermission','/admin/rule/*'),('fullPermission','/admin/rule/create'),('fullPermission','/admin/rule/delete'),('fullPermission','/admin/rule/index'),('fullPermission','/admin/rule/update'),('fullPermission','/admin/rule/view'),('fullPermission','/admin/user/*'),('fullPermission','/admin/user/activate'),('fullPermission','/admin/user/change-password'),('fullPermission','/admin/user/delete'),('fullPermission','/admin/user/index'),('fullPermission','/admin/user/login'),('fullPermission','/admin/user/logout'),('fullPermission','/admin/user/request-password-reset'),('fullPermission','/admin/user/reset-password'),('fullPermission','/admin/user/signup'),('fullPermission','/admin/user/view'),('fullPermission','/debug/*'),('fullPermission','/debug/default/*'),('fullPermission','/debug/default/db-explain'),('fullPermission','/debug/default/download-mail'),('fullPermission','/debug/default/index'),('fullPermission','/debug/default/toolbar'),('fullPermission','/debug/default/view'),('fullPermission','/debug/user/*'),('fullPermission','/debug/user/reset-identity'),('fullPermission','/debug/user/set-identity'),('fullPermission','/gii/*'),('fullPermission','/gii/default/*'),('fullPermission','/gii/default/action'),('fullPermission','/gii/default/diff'),('fullPermission','/gii/default/index'),('fullPermission','/gii/default/preview'),('fullPermission','/gii/default/view'),('fullPermission','/site/*'),('fullPermission','/site/about'),('fullPermission','/site/captcha'),('fullPermission','/site/contact'),('fullPermission','/site/error'),('fullPermission','/site/index'),('fullPermission','/site/login'),('fullPermission','/site/logout'),('SuperAdministrador','fullPermission');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values (1,'Configuración',NULL,NULL,3,' flaticon-cogwheel'),(2,'Asignaciones',1,'/admin/assignment/index',2,' flaticon-user-ok'),(3,'Usuarios',1,'/users/index',1,' flaticon-users'),(4,'Maestros',NULL,NULL,2,NULL),(5,'Tipos de procesos',4,'/process-types/index',1,NULL),(6,'Informes',NULL,NULL,1,NULL),(7,'Informe',6,'/report-temp/index',1,NULL);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1621799116),('m140506_102106_rbac_init',1621799261),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1621799261),('m180523_151638_rbac_updates_indexes_without_prefix',1621799262),('m200409_110543_rbac_update_mssql_trigger',1621799262),('m140602_111327_create_menu_table',1621799900),('m160312_050000_create_user',1621799900);

/*Table structure for table `process_types` */

DROP TABLE IF EXISTS `process_types`;

CREATE TABLE `process_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(15) NOT NULL COMMENT 'Nombre',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `process_types` */

insert  into `process_types`(`id`,`name`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Ejecutivo',1,'2021-06-04 13:54:01','admin','2021-06-04 13:54:15','admin');

/*Table structure for table `report_temp` */

DROP TABLE IF EXISTS `report_temp`;

CREATE TABLE `report_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `col1` varchar(45) DEFAULT NULL COMMENT 'Fecha entrega',
  `col2` varchar(45) DEFAULT NULL COMMENT 'Patrimonio autónomo',
  `col3` varchar(45) DEFAULT NULL COMMENT 'Deudor',
  `col4` varchar(45) DEFAULT NULL COMMENT 'Marca',
  `col5` varchar(45) DEFAULT NULL COMMENT 'Cédula o NIT',
  `col6` varchar(45) DEFAULT NULL COMMENT 'Valor capital entregado',
  `col7` varchar(45) DEFAULT NULL COMMENT 'Saldo actual',
  `col8` varchar(45) DEFAULT NULL COMMENT 'Consolidado pagos',
  `col9` varchar(45) DEFAULT NULL COMMENT 'Tipo de proceso',
  `col10` varchar(45) DEFAULT NULL COMMENT 'Juzgado',
  `col11` varchar(45) DEFAULT NULL COMMENT 'Ciudad',
  `col12` varchar(45) DEFAULT NULL COMMENT 'Radicado',
  `col13` varchar(45) DEFAULT NULL COMMENT 'Comentario jurídico',
  `col14` varchar(45) DEFAULT NULL COMMENT 'Comentario Viabilidad',
  `col15` varchar(45) DEFAULT NULL COMMENT 'Comentario PRE jurídico',
  `col16` varchar(45) DEFAULT NULL COMMENT 'Probabilidad de recuperación',
  `col17` varchar(45) DEFAULT NULL COMMENT 'Medidad cautelares - garantías',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `report_temp` */

insert  into `report_temp`(`id`,`col1`,`col2`,`col3`,`col4`,`col5`,`col6`,`col7`,`col8`,`col9`,`col10`,`col11`,`col12`,`col13`,`col14`,`col15`,`col16`,`col17`) values (1,'21/01/2016','GUATAPURÍ\r\n','Marca 1','900258465\r\n','$15,000,000','$15,000,000',NULL,'Ejecutivo','2 PEQUEÑAS Y COMPETENCIA MULTIPLE VALLEDUPAR\r','MEDELLIN\r\n','123456','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','Negociacion','50%','Se solicitan las siguientes medidas',NULL),(2,'15/11/2018\r\n','GUATAPURÍ\r\n','Marca 3','900265964\r\n','$83,120,000\r\n','$83,120,000\r\n',NULL,'Tipo 2','37 CVIL MUNICIPAL\r\n','BOGOTÁ\r\n','6765','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A',NULL,'25%','Se solicitan las siguientes medidas',NULL),(3,NULL,'GUATAPURÍ\r\n','Marca 2','70215489\r\n','$6,565,000\r\n','$6,565,000\r\n',NULL,'Ejecutivo','37 CVIL MUNICIPAL\r\n','CALI\r\n','3465546','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','Negociacion','50%','Se solicitan las siguientes medidas',NULL),(4,'30/01/2020','ALCARAVAN YOPAL\r\n','Marca 2','71532988\r\n','$18,000,000\r\n','$18,000,000\r\n',NULL,'Ejecutivo','37 CVIL MUNICIPAL\r\n','CALI\r\n','234234','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','Negociacion','50%','Se solicitan las siguientes medidas',NULL),(5,'30/01/2020\r\n','ALCARAVAN YOPAL\r\n','Marca 2','43960567\r\n','$13,000,000\r\n','$13,000,000\r\n',NULL,'Tipo 2','03 CIVIL MUNICIPAL\r\n','CALI','234324324','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','No Negociacion','25%','Se solicitan las siguientes medidas',NULL),(6,'30/01/2020\r\n','ALCARAVAN YOPAL\r\n','Marca 2','42875658\r\n','$20,000,000\r\n','$20,000,000\r\n',NULL,'Ejecutivo','03 CIVIL MUNICIPAL\r\n','CALI\r\n','46576587668','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','NO Negociacion','50%','Se solicitan las siguientes medidas',NULL),(7,NULL,'ALCARAVAN YOPAL\r\n','Marca 1','900258465\r\n','$15,000,000','$15,000,000',NULL,'Ejecutivo','02 CIVIL MUNICIPAL\r\n','MEDELLIN\r\n','12323242324','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A','Negociacion','25%','Se solicitan las siguientes medidas',NULL),(8,'14/11/2019','ALCARAVAN YOPAL\r\n','Marca 1','70858456\r\n','$13,000,000\r\n','$13,000,000\r\n',NULL,'Ejecutivo','07 CIVIL MUNICIPAL\r\n','MEDELLIN\r\n','8658746','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A','Negociacion','75%','Se solicitan las siguientes medidas',NULL),(9,'31/03/2019\r\n','ALCARAVAN YOPAL\r\n','Marca 1','43564266\r\n','$20,000,000\r\n','$20,000,000\r\n',NULL,'Ejecutivo','02 CIVIL MUNICIPAL\r\n','MEDELLIN\r\n','5434543','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A','Negociacion','50%','Se solicitan las siguientes medidas',NULL),(10,'5/02/2016\r\n','ALCARAVAN YOPAL\r\n','Marca 3','890362745\r\n','$16,898,755\r\n','$16,898,755\r\n',NULL,'Tipo 2','37 CVIL MUNICIPAL\r\n','BOGOTÁ\r\n','768786','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A',NULL,'50%','Se solicitan las siguientes medidas',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombres y Apellidos',
  `username` varchar(45) NOT NULL COMMENT 'Nombre de usuario',
  `password` varchar(100) NOT NULL COMMENT 'Contraseña',
  `mail` varchar(45) NOT NULL COMMENT 'Correo Electrónico',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(150) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(150) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`mail`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (6,'Super Administrador','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.com',1,'2021-05-23 00:00:00','admin','2021-05-23 00:00:00','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
