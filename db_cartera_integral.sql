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

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('Colaboradores','10',1626291347),('Colaboradores','7',1626290934),('Colaboradores','8',1626290925),('Colaboradores','9',1626290913),('SuperAdministrador','6',1621801416);

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

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1621800748,1621800748),('/admin/*',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/assignment/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/assignment/assign',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/index',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/revoke',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/view',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/default/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/default/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/create',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/delete',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/update',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/view',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/assign',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/create',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/delete',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/get-users',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/remove',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/update',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/view',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/role/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/assign',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/delete',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/get-users',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/role/remove',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/update',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/view',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/assign',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/index',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/refresh',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/remove',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/delete',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/index',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/update',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/view',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/user/*',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/activate',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/change-password',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/delete',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/index',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/login',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/logout',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/reset-password',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/signup',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/view',2,NULL,NULL,NULL,1621800746,1621800746),('/clientes/*',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/create',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/delete',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/index',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/update',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/view',2,NULL,NULL,NULL,1626185079,1626185079),('/debug/*',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/default/*',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/db-explain',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/download-mail',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/index',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/toolbar',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/view',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/user/*',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/user/reset-identity',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/user/set-identity',2,NULL,NULL,NULL,1621800747,1621800747),('/deudores/*',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/create',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/delete',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/index',2,NULL,NULL,NULL,1626193986,1626193986),('/deudores/update',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/view',2,NULL,NULL,NULL,1626193987,1626193987),('/gii/*',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/*',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/action',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/diff',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/index',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/preview',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/view',2,NULL,NULL,NULL,1621800747,1621800747),('/gridview/*',2,NULL,NULL,NULL,1622834672,1622834672),('/gridview/export/*',2,NULL,NULL,NULL,1622834672,1622834672),('/gridview/export/download',2,NULL,NULL,NULL,1622834672,1622834672),('/procesos/*',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/create',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/delete',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/index',2,NULL,NULL,NULL,1626288718,1626288718),('/procesos/update',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/view',2,NULL,NULL,NULL,1626288719,1626288719),('/report-temp/*',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/create',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/delete',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/index',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/update',2,NULL,NULL,NULL,1622833076,1622833076),('/report-temp/view',2,NULL,NULL,NULL,1622833076,1622833076),('/site/*',2,NULL,NULL,NULL,1621800748,1621800748),('/site/about',2,NULL,NULL,NULL,1621800748,1621800748),('/site/captcha',2,NULL,NULL,NULL,1621800747,1621800747),('/site/contact',2,NULL,NULL,NULL,1621800748,1621800748),('/site/error',2,NULL,NULL,NULL,1621800747,1621800747),('/site/index',2,NULL,NULL,NULL,1621800747,1621800747),('/site/login',2,NULL,NULL,NULL,1621800747,1621800747),('/site/logout',2,NULL,NULL,NULL,1621800747,1621800747),('/tipo-procesos/*',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/create',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/delete',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/index',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/update',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/view',2,NULL,NULL,NULL,1624631252,1624631252),('/users/*',2,NULL,NULL,NULL,1621802631,1621802631),('/users/create',2,NULL,NULL,NULL,1621802631,1621802631),('/users/delete',2,NULL,NULL,NULL,1621802631,1621802631),('/users/index',2,NULL,NULL,NULL,1621802631,1621802631),('/users/update',2,NULL,NULL,NULL,1621802631,1621802631),('/users/view',2,NULL,NULL,NULL,1621802631,1621802631),('Colaboradores',1,'A este rol pertenecen todos los colaboradores, analistas, abogados, etc.',NULL,NULL,1626290880,1626290880),('fullPermission',2,'Todos los permisos asignados',NULL,NULL,1621800859,1621800859),('permisosColaboradores',2,'A este rol pertenecen todos los colaboradores, analistas, abogados, etc.',NULL,NULL,1626290816,1626290872),('SuperAdministrador',1,'Super Administrador con acceso a todas las rutas',NULL,NULL,1621801114,1621801128);

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

insert  into `auth_item_child`(`parent`,`child`) values ('Colaboradores','permisosColaboradores'),('fullPermission','/*'),('fullPermission','/admin/*'),('fullPermission','/admin/assignment/*'),('fullPermission','/admin/assignment/assign'),('fullPermission','/admin/assignment/index'),('fullPermission','/admin/assignment/revoke'),('fullPermission','/admin/assignment/view'),('fullPermission','/admin/default/*'),('fullPermission','/admin/default/index'),('fullPermission','/admin/menu/*'),('fullPermission','/admin/menu/create'),('fullPermission','/admin/menu/delete'),('fullPermission','/admin/menu/index'),('fullPermission','/admin/menu/update'),('fullPermission','/admin/menu/view'),('fullPermission','/admin/permission/*'),('fullPermission','/admin/permission/assign'),('fullPermission','/admin/permission/create'),('fullPermission','/admin/permission/delete'),('fullPermission','/admin/permission/get-users'),('fullPermission','/admin/permission/index'),('fullPermission','/admin/permission/remove'),('fullPermission','/admin/permission/update'),('fullPermission','/admin/permission/view'),('fullPermission','/admin/role/*'),('fullPermission','/admin/role/assign'),('fullPermission','/admin/role/create'),('fullPermission','/admin/role/delete'),('fullPermission','/admin/role/get-users'),('fullPermission','/admin/role/index'),('fullPermission','/admin/role/remove'),('fullPermission','/admin/role/update'),('fullPermission','/admin/role/view'),('fullPermission','/admin/route/*'),('fullPermission','/admin/route/assign'),('fullPermission','/admin/route/create'),('fullPermission','/admin/route/index'),('fullPermission','/admin/route/refresh'),('fullPermission','/admin/route/remove'),('fullPermission','/admin/rule/*'),('fullPermission','/admin/rule/create'),('fullPermission','/admin/rule/delete'),('fullPermission','/admin/rule/index'),('fullPermission','/admin/rule/update'),('fullPermission','/admin/rule/view'),('fullPermission','/admin/user/*'),('fullPermission','/admin/user/activate'),('fullPermission','/admin/user/change-password'),('fullPermission','/admin/user/delete'),('fullPermission','/admin/user/index'),('fullPermission','/admin/user/login'),('fullPermission','/admin/user/logout'),('fullPermission','/admin/user/request-password-reset'),('fullPermission','/admin/user/reset-password'),('fullPermission','/admin/user/signup'),('fullPermission','/admin/user/view'),('fullPermission','/clientes/*'),('fullPermission','/clientes/create'),('fullPermission','/clientes/delete'),('fullPermission','/clientes/index'),('fullPermission','/clientes/update'),('fullPermission','/clientes/view'),('fullPermission','/debug/*'),('fullPermission','/debug/default/*'),('fullPermission','/debug/default/db-explain'),('fullPermission','/debug/default/download-mail'),('fullPermission','/debug/default/index'),('fullPermission','/debug/default/toolbar'),('fullPermission','/debug/default/view'),('fullPermission','/debug/user/*'),('fullPermission','/debug/user/reset-identity'),('fullPermission','/debug/user/set-identity'),('fullPermission','/deudores/*'),('fullPermission','/deudores/create'),('fullPermission','/deudores/delete'),('fullPermission','/deudores/index'),('fullPermission','/deudores/update'),('fullPermission','/deudores/view'),('fullPermission','/gii/*'),('fullPermission','/gii/default/*'),('fullPermission','/gii/default/action'),('fullPermission','/gii/default/diff'),('fullPermission','/gii/default/index'),('fullPermission','/gii/default/preview'),('fullPermission','/gii/default/view'),('fullPermission','/gridview/*'),('fullPermission','/gridview/export/*'),('fullPermission','/gridview/export/download'),('fullPermission','/procesos/*'),('fullPermission','/procesos/create'),('fullPermission','/procesos/delete'),('fullPermission','/procesos/index'),('fullPermission','/procesos/update'),('fullPermission','/procesos/view'),('fullPermission','/report-temp/*'),('fullPermission','/report-temp/create'),('fullPermission','/report-temp/delete'),('fullPermission','/report-temp/index'),('fullPermission','/report-temp/update'),('fullPermission','/report-temp/view'),('fullPermission','/site/*'),('fullPermission','/site/about'),('fullPermission','/site/captcha'),('fullPermission','/site/contact'),('fullPermission','/site/error'),('fullPermission','/site/index'),('fullPermission','/site/login'),('fullPermission','/site/logout'),('fullPermission','/tipo-procesos/*'),('fullPermission','/tipo-procesos/create'),('fullPermission','/tipo-procesos/delete'),('fullPermission','/tipo-procesos/index'),('fullPermission','/tipo-procesos/update'),('fullPermission','/tipo-procesos/view'),('fullPermission','/users/*'),('fullPermission','/users/create'),('fullPermission','/users/delete'),('fullPermission','/users/index'),('fullPermission','/users/update'),('fullPermission','/users/view'),('permisosColaboradores','/procesos/*'),('permisosColaboradores','/procesos/create'),('permisosColaboradores','/procesos/delete'),('permisosColaboradores','/procesos/index'),('permisosColaboradores','/procesos/update'),('permisosColaboradores','/procesos/view'),('permisosColaboradores','/site/*'),('permisosColaboradores','/site/about'),('permisosColaboradores','/site/captcha'),('permisosColaboradores','/site/contact'),('permisosColaboradores','/site/error'),('permisosColaboradores','/site/index'),('permisosColaboradores','/site/login'),('permisosColaboradores','/site/logout'),('permisosColaboradores','/users/update'),('permisosColaboradores','/users/view'),('SuperAdministrador','fullPermission');

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

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre',
  `tipo_documento` char(5) NOT NULL COMMENT 'Tipo de documento',
  `documento` varchar(20) NOT NULL COMMENT 'Documento',
  `direccion` varchar(100) NOT NULL COMMENT 'Dirección física',
  `nombre_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Nombres',
  `telefono_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Teléfonos',
  `email_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Correo electrónico',
  `cargo_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Cargo',
  `nombre_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Nombres',
  `telefono_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Teléfonos',
  `email_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Correo electrónico',
  `cargo_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Cargo',
  `nombre_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Nombres',
  `telefono_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Teléfonos',
  `email_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Correo electrónico',
  `cargo_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Cargo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`nombre`,`tipo_documento`,`documento`,`direccion`,`nombre_persona_contacto_1`,`telefono_persona_contacto_1`,`email_persona_contacto_1`,`cargo_persona_contacto_1`,`nombre_persona_contacto_2`,`telefono_persona_contacto_2`,`email_persona_contacto_2`,`cargo_persona_contacto_2`,`nombre_persona_contacto_3`,`telefono_persona_contacto_3`,`email_persona_contacto_3`,`cargo_persona_contacto_3`,`created`,`created_by`,`modified`,`modified_by`) values (1,'CLIENTE PRUEBA 1','NIT','98766496','CALLE 40 A SUR # 24 B - 105','FELIPE ECHEVERRI','12345','PIPE.ECHEVERRI.1@GMAIL.COM','ANALISTA','DIEGO CASTAñO','54321','DIEGO@GMAIL.COM','ANALISTA 2','PEDRO PEREZ','324324','PEDRO@GMAIL.COM','CARGO PEDRO','2021-07-13 10:37:55','admin','2021-07-15 13:20:34','admin');

/*Table structure for table `deudores` */

DROP TABLE IF EXISTS `deudores`;

CREATE TABLE `deudores` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombres',
  `marca` varchar(45) NOT NULL COMMENT 'Marca',
  `direccion` varchar(100) NOT NULL COMMENT 'Dirección física',
  `nombre_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Nombres',
  `telefono_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Teléfonos',
  `email_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Correo electrónico',
  `cargo_persona_contacto_1` varchar(45) NOT NULL COMMENT 'Cargo',
  `nombre_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Nombre',
  `telefono_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Teléfonos',
  `email_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Correo electrónico',
  `cargo_persona_contacto_2` varchar(45) DEFAULT NULL COMMENT 'Cargo',
  `nombre_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Nombres',
  `telefono_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Teléfonos',
  `email_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Correo electrónico',
  `cargo_persona_contacto_3` varchar(45) DEFAULT NULL COMMENT 'Cargo',
  `nombre_codeudor_1` varchar(45) NOT NULL COMMENT 'Nombres',
  `documento_codeudor_1` varchar(45) NOT NULL COMMENT 'Documento',
  `direccion_codeudor_1` varchar(45) NOT NULL COMMENT 'Dirección física',
  `email_codeudor_1` varchar(45) NOT NULL COMMENT 'Correo electrónico',
  `telefono_codeudor_1` varchar(45) NOT NULL COMMENT 'Teléfonos',
  `nombre_codeudor_2` varchar(45) DEFAULT NULL COMMENT 'Nombres',
  `documento_codeudor_2` varchar(45) DEFAULT NULL COMMENT 'Documento',
  `direccion_codeudor_2` varchar(45) DEFAULT NULL COMMENT 'Dirección física',
  `email_codeudor_2` varchar(45) DEFAULT NULL COMMENT 'Correo electrónico',
  `telefonol_codeudor_2` varchar(45) DEFAULT NULL COMMENT 'Teléfonos',
  `comentarios` text DEFAULT NULL COMMENT 'Comentarios',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `deudores` */

insert  into `deudores`(`id`,`nombre`,`marca`,`direccion`,`nombre_persona_contacto_1`,`telefono_persona_contacto_1`,`email_persona_contacto_1`,`cargo_persona_contacto_1`,`nombre_persona_contacto_2`,`telefono_persona_contacto_2`,`email_persona_contacto_2`,`cargo_persona_contacto_2`,`nombre_persona_contacto_3`,`telefono_persona_contacto_3`,`email_persona_contacto_3`,`cargo_persona_contacto_3`,`nombre_codeudor_1`,`documento_codeudor_1`,`direccion_codeudor_1`,`email_codeudor_1`,`telefono_codeudor_1`,`nombre_codeudor_2`,`documento_codeudor_2`,`direccion_codeudor_2`,`email_codeudor_2`,`telefonol_codeudor_2`,`comentarios`,`created`,`created_by`,`modified`,`modified_by`) values (1,'1','2','3','4','5','6@6.com','7','8','9','|0@10.com','11','12','13','14@14.com','15','16','17','18','19@19.com','20','21','22','23','24@24.com','25','26','2021-07-13 13:55:15','admin','2021-07-13 13:55:15','admin'),(2,'NOMBRESN','MARCA',' DIRECCIóN FíSICA ','NOMBRES','1234','CORREO1@GMAIL.COM','CARGO','NOMBRE','12345','CORREO2@GMAIL.COM','CARGO','NOMBRES','4331','CORREO3@GMAIL.COM','CARGO','NOMBRES','1234567','DIRECCIóN FíSICA','CORREO4@GMAIL.COM','1234','NOMBRES','1242','DIRECCIóN FíSICA','CORREO5@GMAIL.COM','12343','COEMNTARIOS EN GENERAL','2021-07-14 14:18:50','admin','2021-07-14 14:18:50','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values (1,'Configuración',NULL,NULL,3,' flaticon-cogwheel'),(2,'Asignaciones',1,'/admin/assignment/index',2,' flaticon-user-ok'),(3,'Usuarios',1,'/users/index',1,' flaticon-users'),(4,'General',NULL,NULL,2,' flaticon-add'),(5,'Tipos de procesos',4,'/tipo-procesos/index',4,' flaticon-squares-2'),(6,'Informes',NULL,NULL,1,' flaticon-statistics'),(7,'Informe',6,'/report-temp/index',1,' flaticon-interface-6'),(9,'Clientes',4,'/clientes/index',1,' flaticon-users'),(10,'Deudores',4,'/deudores/index',2,' flaticon-coins'),(11,'Procesos',NULL,'/procesos/index',1,' flaticon-list-2');

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1621799116),('m140506_102106_rbac_init',1621799261),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1621799261),('m180523_151638_rbac_updates_indexes_without_prefix',1621799262),('m200409_110543_rbac_update_mssql_trigger',1621799262),('m140602_111327_create_menu_table',1621799900),('m160312_050000_create_user',1621799900);

/*Table structure for table `procesos` */

DROP TABLE IF EXISTS `procesos`;

CREATE TABLE `procesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL COMMENT 'Cliente',
  `deudor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_procesos_clientes_idx` (`cliente_id`),
  KEY `fk_procesos_deudores_idx` (`deudor_id`),
  CONSTRAINT `fk_procesos_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_procesos_deudores` FOREIGN KEY (`deudor_id`) REFERENCES `deudores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `procesos` */

insert  into `procesos`(`id`,`cliente_id`,`deudor_id`) values (2,1,2);

/*Table structure for table `procesos_x_colaboradores` */

DROP TABLE IF EXISTS `procesos_x_colaboradores`;

CREATE TABLE `procesos_x_colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proceso_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_procesos_x_colaboradores_proceso_idx` (`proceso_id`),
  KEY `fk_procesos_x_colaboradores_user_idx` (`user_id`),
  CONSTRAINT `fk_procesos_x_colaboradores_procesos` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_procesos_x_colaboradores_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `procesos_x_colaboradores` */

insert  into `procesos_x_colaboradores`(`id`,`proceso_id`,`user_id`) values (18,2,7),(19,2,8),(20,2,10);

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

insert  into `report_temp`(`id`,`col1`,`col2`,`col3`,`col4`,`col5`,`col6`,`col7`,`col8`,`col9`,`col10`,`col11`,`col12`,`col13`,`col14`,`col15`,`col16`,`col17`) values (1,'21/01/2016','GUATAPURÍ\r\n','Marca 1','900258465\r\n','$15,000,000','$15,000,000',NULL,'Ejecutivo','2 PEQUEÑAS Y COMPETENCIA MULTIPLE VALLEDUPAR\r','MEDELLIN\r\n','123456','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','Negociacion','50%','Se solicitan las siguientes medidas','PABLO LOPERA'),(2,'15/11/2018\r\n','GUATAPURÍ\r\n','Marca 3','900265964\r\n','$83,120,000\r\n','$83,120,000\r\n',NULL,'Tipo 2','37 CVIL MUNICIPAL\r\n','BOGOTÁ\r\n','6765','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A',NULL,'25%','Se solicitan las siguientes medidas','SILVIA ORTIZ'),(3,NULL,'GUATAPURÍ\r\n','Marca 2','70215489\r\n','$6,565,000\r\n','$6,565,000\r\n',NULL,'Ejecutivo','37 CVIL MUNICIPAL\r\n','CALI\r\n','3465546','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','Negociacion','50%','Se solicitan las siguientes medidas','JAIRO PALACIO'),(4,'30/01/2020','ALCARAVAN YOPAL\r\n','Marca 2','71532988\r\n','$18,000,000\r\n','$18,000,000\r\n',NULL,'Ejecutivo','37 CVIL MUNICIPAL\r\n','CALI\r\n','234234','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','Negociacion','50%','Se solicitan las siguientes medidas','WILLIAM SERNA'),(5,'30/01/2020\r\n','ALCARAVAN YOPAL\r\n','Marca 2','43960567\r\n','$13,000,000\r\n','$13,000,000\r\n',NULL,'Tipo 2','03 CIVIL MUNICIPAL\r\n','CALI','234324324','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','No Negociacion','25%','Se solicitan las siguientes medidas','LUZ DARY MONSALVE'),(6,'30/01/2020\r\n','ALCARAVAN YOPAL\r\n','Marca 2','42875658\r\n','$20,000,000\r\n','$20,000,000\r\n',NULL,'Ejecutivo','03 CIVIL MUNICIPAL\r\n','CALI\r\n','46576587668','JURÍDICO: 15-02-16 Radicación de proceso, Juz','No renueva desde el año 2015. Pendiente respu','NO Negociacion','50%','Se solicitan las siguientes medidas','BEATRIZ CARMONA'),(7,NULL,'ALCARAVAN YOPAL\r\n','Marca 1','900258465\r\n','$15,000,000','$15,000,000',NULL,'Ejecutivo','02 CIVIL MUNICIPAL\r\n','MEDELLIN\r\n','12323242324','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A','Negociacion','25%','Se solicitan las siguientes medidas','JAIME BETANCUR'),(8,'14/11/2019','ALCARAVAN YOPAL\r\n','Marca 1','70858456\r\n','$13,000,000\r\n','$13,000,000\r\n',NULL,'Ejecutivo','07 CIVIL MUNICIPAL\r\n','MEDELLIN\r\n','8658746','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A','Negociacion','75%','Se solicitan las siguientes medidas','GONZALO ARANGO'),(9,'31/03/2019\r\n','ALCARAVAN YOPAL\r\n','Marca 1','43564266\r\n','$20,000,000\r\n','$20,000,000\r\n',NULL,'Ejecutivo','02 CIVIL MUNICIPAL\r\n','MEDELLIN\r\n','5434543','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A','Negociacion','50%','Se solicitan las siguientes medidas','INDUSTRIAS LA CASITA'),(10,'5/02/2016\r\n','ALCARAVAN YOPAL\r\n','Marca 3','890362745\r\n','$16,898,755\r\n','$16,898,755\r\n',NULL,'Tipo 2','37 CVIL MUNICIPAL\r\n','BOGOTÁ\r\n','768786','JURÍDICO: 15-02-16 Radicación de proceso, Juz','A',NULL,'50%','Se solicitan las siguientes medidas','FERRETERIA EL GANCHO');

/*Table structure for table `tipo_procesos` */

DROP TABLE IF EXISTS `tipo_procesos`;

CREATE TABLE `tipo_procesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(15) NOT NULL COMMENT 'Nombre',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_procesos` */

insert  into `tipo_procesos`(`id`,`nombre`,`activo`,`created`,`created_by`,`modified`,`modified_by`) values (1,'ASDASDSADASD',1,'2021-07-14 14:14:43','admin','2021-07-14 14:14:53','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`mail`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (6,'Super Administrador','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.com',1,'2021-05-23 00:00:00','admin','2021-05-23 00:00:00','admin'),(7,'ALEJANDRO MONTOYA','amontoya','f5f66eefb5eafff121da19ba5b837476','AMONTOYA@CARTERAINTEGRAL.COM.CO',1,'2021-07-14 11:11:06','admin','2021-07-14 14:32:41','admin'),(8,'ELKIN PéREZ','eperez','e5a329b2dace4a58fe4fc5a3c4623ee9','EPEREZ@CARTERAINTEGRAL.COM.CO',1,'2021-07-14 11:11:53','admin','2021-07-14 14:32:29','admin'),(10,'JUAN FELIPE MONTIEL','jmontiel','4193a73f80161b1275489ebba0b6bf96','JMONTIEL@CARTERAINTEGRAL.COM.CO',1,'2021-07-14 14:34:09','admin','2021-07-14 14:34:09','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
