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

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1621800748,1621800748),('/admin/*',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/assignment/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/assignment/assign',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/index',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/revoke',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/assignment/view',2,NULL,NULL,NULL,1621800743,1621800743),('/admin/default/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/default/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/create',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/delete',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/update',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/menu/view',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/*',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/assign',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/create',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/delete',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/get-users',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/remove',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/update',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/permission/view',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/role/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/assign',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/delete',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/get-users',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/index',2,NULL,NULL,NULL,1621800744,1621800744),('/admin/role/remove',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/update',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/role/view',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/assign',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/index',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/refresh',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/route/remove',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/*',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/create',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/delete',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/index',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/update',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/rule/view',2,NULL,NULL,NULL,1621800745,1621800745),('/admin/user/*',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/activate',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/change-password',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/delete',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/index',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/login',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/logout',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/reset-password',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/signup',2,NULL,NULL,NULL,1621800746,1621800746),('/admin/user/view',2,NULL,NULL,NULL,1621800746,1621800746),('/bienes/*',2,NULL,NULL,NULL,1627144231,1627144231),('/bienes/create',2,NULL,NULL,NULL,1627144231,1627144231),('/bienes/delete',2,NULL,NULL,NULL,1627144231,1627144231),('/bienes/index',2,NULL,NULL,NULL,1627144230,1627144230),('/bienes/update',2,NULL,NULL,NULL,1627144231,1627144231),('/bienes/view',2,NULL,NULL,NULL,1627144231,1627144231),('/clientes/*',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/create',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/delete',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/getclientes',2,NULL,NULL,NULL,1626791328,1626791328),('/clientes/index',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/update',2,NULL,NULL,NULL,1626185079,1626185079),('/clientes/view',2,NULL,NULL,NULL,1626185079,1626185079),('/debug/*',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/default/*',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/db-explain',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/download-mail',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/index',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/toolbar',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/default/view',2,NULL,NULL,NULL,1621800746,1621800746),('/debug/user/*',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/user/reset-identity',2,NULL,NULL,NULL,1621800747,1621800747),('/debug/user/set-identity',2,NULL,NULL,NULL,1621800747,1621800747),('/deudores/*',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/create',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/delete',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/getdeudores',2,NULL,NULL,NULL,1626791328,1626791328),('/deudores/index',2,NULL,NULL,NULL,1626193986,1626193986),('/deudores/update',2,NULL,NULL,NULL,1626193987,1626193987),('/deudores/view',2,NULL,NULL,NULL,1626193987,1626193987),('/documentos-activacion/*',2,NULL,NULL,NULL,1627498729,1627498729),('/documentos-activacion/create',2,NULL,NULL,NULL,1627498729,1627498729),('/documentos-activacion/delete',2,NULL,NULL,NULL,1627498729,1627498729),('/documentos-activacion/index',2,NULL,NULL,NULL,1627498729,1627498729),('/documentos-activacion/update',2,NULL,NULL,NULL,1627498729,1627498729),('/documentos-activacion/view',2,NULL,NULL,NULL,1627498729,1627498729),('/gii/*',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/*',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/action',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/diff',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/index',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/preview',2,NULL,NULL,NULL,1621800747,1621800747),('/gii/default/view',2,NULL,NULL,NULL,1621800747,1621800747),('/gridview/*',2,NULL,NULL,NULL,1622834672,1622834672),('/gridview/export/*',2,NULL,NULL,NULL,1622834672,1622834672),('/gridview/export/download',2,NULL,NULL,NULL,1622834672,1622834672),('/procesos/*',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/create',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/delete',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/index',2,NULL,NULL,NULL,1626288718,1626288718),('/procesos/update',2,NULL,NULL,NULL,1626288719,1626288719),('/procesos/view',2,NULL,NULL,NULL,1626288719,1626288719),('/site/*',2,NULL,NULL,NULL,1621800748,1621800748),('/site/about',2,NULL,NULL,NULL,1621800748,1621800748),('/site/captcha',2,NULL,NULL,NULL,1621800747,1621800747),('/site/contact',2,NULL,NULL,NULL,1621800748,1621800748),('/site/error',2,NULL,NULL,NULL,1621800747,1621800747),('/site/index',2,NULL,NULL,NULL,1621800747,1621800747),('/site/login',2,NULL,NULL,NULL,1621800747,1621800747),('/site/logout',2,NULL,NULL,NULL,1621800747,1621800747),('/tipo-casos/*',2,NULL,NULL,NULL,1626791328,1626791328),('/tipo-casos/create',2,NULL,NULL,NULL,1626791328,1626791328),('/tipo-casos/delete',2,NULL,NULL,NULL,1626791328,1626791328),('/tipo-casos/index',2,NULL,NULL,NULL,1626791328,1626791328),('/tipo-casos/update',2,NULL,NULL,NULL,1626791328,1626791328),('/tipo-casos/view',2,NULL,NULL,NULL,1626791328,1626791328),('/tipo-procesos/*',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/create',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/delete',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/index',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/update',2,NULL,NULL,NULL,1624631252,1624631252),('/tipo-procesos/view',2,NULL,NULL,NULL,1624631252,1624631252),('/users/*',2,NULL,NULL,NULL,1621802631,1621802631),('/users/create',2,NULL,NULL,NULL,1621802631,1621802631),('/users/delete',2,NULL,NULL,NULL,1621802631,1621802631),('/users/index',2,NULL,NULL,NULL,1621802631,1621802631),('/users/update',2,NULL,NULL,NULL,1621802631,1621802631),('/users/view',2,NULL,NULL,NULL,1621802631,1621802631),('Colaboradores',1,'A este rol pertenecen todos los colaboradores, analistas, abogados, etc.',NULL,NULL,1626290880,1626290880),('fullPermission',2,'Todos los permisos asignados',NULL,NULL,1621800859,1621800859),('permisosColaboradores',2,'A este rol pertenecen todos los colaboradores, analistas, abogados, etc.',NULL,NULL,1626290816,1626290872),('SuperAdministrador',1,'Super Administrador con acceso a todas las rutas',NULL,NULL,1621801114,1621801128);

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

insert  into `auth_item_child`(`parent`,`child`) values ('Colaboradores','permisosColaboradores'),('fullPermission','/*'),('fullPermission','/admin/*'),('fullPermission','/admin/assignment/*'),('fullPermission','/admin/assignment/assign'),('fullPermission','/admin/assignment/index'),('fullPermission','/admin/assignment/revoke'),('fullPermission','/admin/assignment/view'),('fullPermission','/admin/default/*'),('fullPermission','/admin/default/index'),('fullPermission','/admin/menu/*'),('fullPermission','/admin/menu/create'),('fullPermission','/admin/menu/delete'),('fullPermission','/admin/menu/index'),('fullPermission','/admin/menu/update'),('fullPermission','/admin/menu/view'),('fullPermission','/admin/permission/*'),('fullPermission','/admin/permission/assign'),('fullPermission','/admin/permission/create'),('fullPermission','/admin/permission/delete'),('fullPermission','/admin/permission/get-users'),('fullPermission','/admin/permission/index'),('fullPermission','/admin/permission/remove'),('fullPermission','/admin/permission/update'),('fullPermission','/admin/permission/view'),('fullPermission','/admin/role/*'),('fullPermission','/admin/role/assign'),('fullPermission','/admin/role/create'),('fullPermission','/admin/role/delete'),('fullPermission','/admin/role/get-users'),('fullPermission','/admin/role/index'),('fullPermission','/admin/role/remove'),('fullPermission','/admin/role/update'),('fullPermission','/admin/role/view'),('fullPermission','/admin/route/*'),('fullPermission','/admin/route/assign'),('fullPermission','/admin/route/create'),('fullPermission','/admin/route/index'),('fullPermission','/admin/route/refresh'),('fullPermission','/admin/route/remove'),('fullPermission','/admin/rule/*'),('fullPermission','/admin/rule/create'),('fullPermission','/admin/rule/delete'),('fullPermission','/admin/rule/index'),('fullPermission','/admin/rule/update'),('fullPermission','/admin/rule/view'),('fullPermission','/admin/user/*'),('fullPermission','/admin/user/activate'),('fullPermission','/admin/user/change-password'),('fullPermission','/admin/user/delete'),('fullPermission','/admin/user/index'),('fullPermission','/admin/user/login'),('fullPermission','/admin/user/logout'),('fullPermission','/admin/user/request-password-reset'),('fullPermission','/admin/user/reset-password'),('fullPermission','/admin/user/signup'),('fullPermission','/admin/user/view'),('fullPermission','/bienes/*'),('fullPermission','/bienes/create'),('fullPermission','/bienes/delete'),('fullPermission','/bienes/index'),('fullPermission','/bienes/update'),('fullPermission','/bienes/view'),('fullPermission','/clientes/*'),('fullPermission','/clientes/create'),('fullPermission','/clientes/delete'),('fullPermission','/clientes/getclientes'),('fullPermission','/clientes/index'),('fullPermission','/clientes/update'),('fullPermission','/clientes/view'),('fullPermission','/debug/*'),('fullPermission','/debug/default/*'),('fullPermission','/debug/default/db-explain'),('fullPermission','/debug/default/download-mail'),('fullPermission','/debug/default/index'),('fullPermission','/debug/default/toolbar'),('fullPermission','/debug/default/view'),('fullPermission','/debug/user/*'),('fullPermission','/debug/user/reset-identity'),('fullPermission','/debug/user/set-identity'),('fullPermission','/deudores/*'),('fullPermission','/deudores/create'),('fullPermission','/deudores/delete'),('fullPermission','/deudores/getdeudores'),('fullPermission','/deudores/index'),('fullPermission','/deudores/update'),('fullPermission','/deudores/view'),('fullPermission','/gii/*'),('fullPermission','/gii/default/*'),('fullPermission','/gii/default/action'),('fullPermission','/gii/default/diff'),('fullPermission','/gii/default/index'),('fullPermission','/gii/default/preview'),('fullPermission','/gii/default/view'),('fullPermission','/gridview/*'),('fullPermission','/gridview/export/*'),('fullPermission','/gridview/export/download'),('fullPermission','/procesos/*'),('fullPermission','/procesos/create'),('fullPermission','/procesos/delete'),('fullPermission','/procesos/index'),('fullPermission','/procesos/update'),('fullPermission','/procesos/view'),('fullPermission','/site/*'),('fullPermission','/site/about'),('fullPermission','/site/captcha'),('fullPermission','/site/contact'),('fullPermission','/site/error'),('fullPermission','/site/index'),('fullPermission','/site/login'),('fullPermission','/site/logout'),('fullPermission','/tipo-casos/*'),('fullPermission','/tipo-casos/create'),('fullPermission','/tipo-casos/delete'),('fullPermission','/tipo-casos/index'),('fullPermission','/tipo-casos/update'),('fullPermission','/tipo-casos/view'),('fullPermission','/tipo-procesos/*'),('fullPermission','/tipo-procesos/create'),('fullPermission','/tipo-procesos/delete'),('fullPermission','/tipo-procesos/index'),('fullPermission','/tipo-procesos/update'),('fullPermission','/tipo-procesos/view'),('fullPermission','/users/*'),('fullPermission','/users/create'),('fullPermission','/users/delete'),('fullPermission','/users/index'),('fullPermission','/users/update'),('fullPermission','/users/view'),('permisosColaboradores','/clientes/create'),('permisosColaboradores','/clientes/getclientes'),('permisosColaboradores','/clientes/index'),('permisosColaboradores','/clientes/update'),('permisosColaboradores','/clientes/view'),('permisosColaboradores','/deudores/create'),('permisosColaboradores','/deudores/getdeudores'),('permisosColaboradores','/deudores/index'),('permisosColaboradores','/deudores/update'),('permisosColaboradores','/deudores/view'),('permisosColaboradores','/procesos/create'),('permisosColaboradores','/procesos/index'),('permisosColaboradores','/procesos/update'),('permisosColaboradores','/procesos/view'),('permisosColaboradores','/site/*'),('permisosColaboradores','/site/about'),('permisosColaboradores','/site/captcha'),('permisosColaboradores','/site/contact'),('permisosColaboradores','/site/error'),('permisosColaboradores','/site/index'),('permisosColaboradores','/site/login'),('permisosColaboradores','/site/logout'),('permisosColaboradores','/users/update'),('permisosColaboradores','/users/view'),('SuperAdministrador','fullPermission');

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

/*Table structure for table `bienes` */

DROP TABLE IF EXISTS `bienes`;

CREATE TABLE `bienes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre',
  `activo` tinyint(1) NOT NULL COMMENT 'Activo',
  `delete` tinyint(1) DEFAULT 0 COMMENT 'Borrado',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  `deleted` datetime DEFAULT NULL COMMENT 'Borrado',
  `deleted_by` varchar(45) DEFAULT NULL COMMENT 'Borrado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `bienes` */

insert  into `bienes`(`id`,`nombre`,`activo`,`delete`,`created`,`created_by`,`modified`,`modified_by`,`deleted`,`deleted_by`) values (1,'INMUEBLES',1,0,'2021-07-24 11:40:37','admin','2021-07-24 11:42:13','admin','2021-07-24 11:42:13','admin'),(2,'VEHICULOS',1,0,'2021-07-24 11:43:05','admin','2021-07-24 11:43:05','admin',NULL,NULL),(3,'CREDITOS A FAVOR',1,0,'2021-07-24 11:43:13','admin','2021-07-24 11:43:13','admin',NULL,NULL),(4,'BIENES MAQUINARIA',1,0,'2021-07-24 11:43:22','admin','2021-07-24 11:43:25','admin',NULL,NULL),(5,'PRODUCTOS FINANCIEROS',1,0,'2021-07-24 11:43:34','admin','2021-07-24 11:43:34','admin',NULL,NULL),(6,' ESTABLECIMIENTOS DE COMERCIO',1,0,'2021-07-24 11:43:43','admin','2021-07-24 11:43:43','admin',NULL,NULL);

/*Table structure for table `bienes_x_proceso` */

DROP TABLE IF EXISTS `bienes_x_proceso`;

CREATE TABLE `bienes_x_proceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `proceso_id` int(11) NOT NULL COMMENT 'Proceso ID',
  `bien_id` int(11) NOT NULL COMMENT 'Bien ID',
  `comentario` text DEFAULT NULL COMMENT 'Comentario',
  PRIMARY KEY (`id`),
  KEY `fk_bienes_x_proceso_procesos_idx` (`proceso_id`),
  KEY `fk_bienes_x_proceso_bienes_idx` (`bien_id`),
  CONSTRAINT `fk_bienes_x_proceso_bienes` FOREIGN KEY (`bien_id`) REFERENCES `bienes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bienes_x_proceso_procesos` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

/*Data for the table `bienes_x_proceso` */

insert  into `bienes_x_proceso`(`id`,`proceso_id`,`bien_id`,`comentario`) values (20,4,1,'Inmuebles'),(21,4,4,'Comentario 22222'),(22,4,5,'Comentario 33333'),(23,5,1,'Inmueble 1'),(24,5,6,'Establecimiento 1'),(25,6,1,'Inmueble 1'),(26,6,6,'Establecimiento 1'),(27,7,1,'Inmueble 1'),(28,7,6,'Establecimiento 1'),(29,8,1,'Inmueble 1'),(30,8,6,'Establecimiento 1'),(61,9,1,'Inmueble 13'),(62,9,6,'Establecimiento 14'),(96,11,1,'Comentario inmueble'),(97,11,3,'Comentario creditos a favor'),(98,11,4,'Comentario bienes maquinaria');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre',
  `tipo_documento` char(5) NOT NULL COMMENT 'Tipo de documento',
  `documento` varchar(20) NOT NULL COMMENT 'Documento',
  `direccion` varchar(100) NOT NULL COMMENT 'Dirección física',
  `nombre_representante_legal` varchar(45) NOT NULL COMMENT 'Nombres',
  `telefono_representante_legal` varchar(45) NOT NULL COMMENT 'Teléfonos',
  `email_representante_legal` varchar(45) NOT NULL COMMENT 'Correo electrónico',
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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`nombre`,`tipo_documento`,`documento`,`direccion`,`nombre_representante_legal`,`telefono_representante_legal`,`email_representante_legal`,`nombre_persona_contacto_1`,`telefono_persona_contacto_1`,`email_persona_contacto_1`,`cargo_persona_contacto_1`,`nombre_persona_contacto_2`,`telefono_persona_contacto_2`,`email_persona_contacto_2`,`cargo_persona_contacto_2`,`nombre_persona_contacto_3`,`telefono_persona_contacto_3`,`email_persona_contacto_3`,`cargo_persona_contacto_3`,`created`,`created_by`,`modified`,`modified_by`) values (1,'CLIENTE PRUEBA 12','NIT','98766496','CALLE 40 A SUR # 24 B - 105','FULANITO','123','FULANIT@GMIAL.COM','FELIPE ECHEVERRI','12345','PIPE.ECHEVERRI.1@GMAIL.COM','ANALISTA','DIEGO CASTAñO','54321','DIEGO@GMAIL.COM','ANALISTA 2','PEDRO PEREZ','324324','PEDRO@GMAIL.COM','CARGO PEDRO','2021-07-13 10:37:55','admin','2021-07-22 16:07:53','admin'),(93,'CLIENTE PRUEBA 1','NIT','123456','1234','','','','ASDASD','ASDASD','2@2.COM','ASDASD','','','','','','','','','2021-07-18 09:30:21','admin','2021-07-18 09:30:21','admin');

/*Table structure for table `consolidado_pagos_juridicos` */

DROP TABLE IF EXISTS `consolidado_pagos_juridicos`;

CREATE TABLE `consolidado_pagos_juridicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `proceso_id` int(11) NOT NULL,
  `valor` decimal(10,0) NOT NULL COMMENT 'Valor',
  `fecha` datetime NOT NULL COMMENT 'Fecha de pago',
  PRIMARY KEY (`id`),
  KEY `fk_consolidado_pagos_procesos_idx` (`proceso_id`),
  CONSTRAINT `fk_consolidado_pagos_procesos` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `consolidado_pagos_juridicos` */

/*Table structure for table `deudores` */

DROP TABLE IF EXISTS `deudores`;

CREATE TABLE `deudores` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombres',
  `marca` varchar(45) NOT NULL COMMENT 'Marca',
  `direccion` varchar(100) NOT NULL COMMENT 'Dirección física',
  `nombre_representante_legal` varchar(45) NOT NULL COMMENT 'Nombres',
  `telefono_representante_legal` varchar(45) NOT NULL COMMENT 'Teléfonos',
  `email_representante_legal` varchar(45) NOT NULL COMMENT 'Correo electrónico',
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
  `nombre_codeudor_1` varchar(45) DEFAULT NULL COMMENT 'Nombres',
  `documento_codeudor_1` varchar(45) DEFAULT NULL COMMENT 'Documento',
  `direccion_codeudor_1` varchar(45) DEFAULT NULL COMMENT 'Dirección física',
  `email_codeudor_1` varchar(45) DEFAULT NULL COMMENT 'Correo electrónico',
  `telefono_codeudor_1` varchar(45) DEFAULT NULL COMMENT 'Teléfonos',
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `deudores` */

insert  into `deudores`(`id`,`nombre`,`marca`,`direccion`,`nombre_representante_legal`,`telefono_representante_legal`,`email_representante_legal`,`nombre_persona_contacto_1`,`telefono_persona_contacto_1`,`email_persona_contacto_1`,`cargo_persona_contacto_1`,`nombre_persona_contacto_2`,`telefono_persona_contacto_2`,`email_persona_contacto_2`,`cargo_persona_contacto_2`,`nombre_persona_contacto_3`,`telefono_persona_contacto_3`,`email_persona_contacto_3`,`cargo_persona_contacto_3`,`nombre_codeudor_1`,`documento_codeudor_1`,`direccion_codeudor_1`,`email_codeudor_1`,`telefono_codeudor_1`,`nombre_codeudor_2`,`documento_codeudor_2`,`direccion_codeudor_2`,`email_codeudor_2`,`telefonol_codeudor_2`,`comentarios`,`created`,`created_by`,`modified`,`modified_by`) values (2,'NOMBRESN','MARCA',' DIRECCIóN FíSICA ','FULANITO2','1234','FULANITO@GMAIL.COM','NOMBRES','1234','CORREO1@GMAIL.COM','CARGO','NOMBRE','12345','CORREO2@GMAIL.COM','CARGO','NOMBRES','4331','CORREO3@GMAIL.COM','CARGO','NOMBRES','1234567','DIRECCIóN FíSICA','CORREO4@GMAIL.COM','1234','NOMBRES','1242','DIRECCIóN FíSICA','CORREO5@GMAIL.COM','12343','COEMNTARIOS EN GENERAL','2021-07-14 14:18:50','admin','2021-07-22 16:16:45','admin'),(3,'DEUDOR PRUEBA','MARCA PRUEBA','ASDAD','','','','SADSAD','ASD','6@6.COM','ASDASD','','','','','','','','','SADSAD','ASDASD','ASDAS','19@19.COM','ASDSADAS','','','','','','','2021-07-18 09:31:19','admin','2021-07-18 09:31:19','admin');

/*Table structure for table `docactivacion_x_proceso` */

DROP TABLE IF EXISTS `docactivacion_x_proceso`;

CREATE TABLE `docactivacion_x_proceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `proceso_id` int(11) NOT NULL,
  `documento_activacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_docactivacion_x_proceso_procesos_idx` (`proceso_id`),
  KEY `fk_docactivacion_x_proceso_documentos_activacion_idx` (`documento_activacion_id`),
  CONSTRAINT `fk_docactivacion_x_proceso_documentos_activacion` FOREIGN KEY (`documento_activacion_id`) REFERENCES `documentos_activacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_docactivacion_x_proceso_procesos` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `docactivacion_x_proceso` */

insert  into `docactivacion_x_proceso`(`id`,`proceso_id`,`documento_activacion_id`) values (19,11,1),(20,11,2),(21,11,8);

/*Table structure for table `documentos_activacion` */

DROP TABLE IF EXISTS `documentos_activacion`;

CREATE TABLE `documentos_activacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre',
  `activo` tinyint(1) NOT NULL COMMENT 'Activo',
  `delete` tinyint(1) DEFAULT NULL COMMENT 'Borrado',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  `deleted` datetime DEFAULT NULL COMMENT 'Borrado',
  `deleted_by` varchar(45) DEFAULT NULL COMMENT 'Borrado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `documentos_activacion` */

insert  into `documentos_activacion`(`id`,`nombre`,`activo`,`delete`,`created`,`created_by`,`modified`,`modified_by`,`deleted`,`deleted_by`) values (1,'PODER',1,NULL,'2021-07-28 14:10:54','admin','2021-07-28 14:10:54','admin',NULL,NULL),(2,'TITULOS',1,NULL,'2021-07-28 14:18:35','admin','2021-07-28 14:18:35','admin',NULL,NULL),(3,'FACTURAS',1,NULL,'2021-07-28 14:11:35','admin','2021-07-28 14:11:35','admin',NULL,NULL),(4,'PAGARÉ',1,NULL,'2021-07-28 14:11:44','admin','2021-07-28 14:11:44','admin',NULL,NULL),(5,'ACUERDO DE PAGO',1,NULL,'2021-07-28 14:11:53','admin','2021-07-28 14:11:53','admin',NULL,NULL),(6,'CONTRATO',1,NULL,'2021-07-28 14:11:58','admin','2021-07-28 14:11:58','admin',NULL,NULL),(7,'ACTA DE CONCILIACIÓN',1,NULL,'2021-07-28 14:12:10','admin','2021-07-28 14:12:10','admin',NULL,NULL),(8,'CERTIFICADOS - DEMANDANTE',1,NULL,'2021-07-28 14:12:19','admin','2021-07-28 14:12:19','admin',NULL,NULL),(9,'CERTIFICADOS - DEMANDADO',1,NULL,'2021-07-28 14:12:25','admin','2021-07-28 14:12:25','admin',NULL,NULL),(10,'OTROS',1,NULL,'2021-07-28 14:12:32','admin','2021-07-28 14:12:32','admin',NULL,NULL);

/*Table structure for table `gestiones_prejuridicas` */

DROP TABLE IF EXISTS `gestiones_prejuridicas`;

CREATE TABLE `gestiones_prejuridicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `proceso_id` int(11) NOT NULL COMMENT 'Proceso',
  `fecha_gestion` datetime NOT NULL COMMENT 'Fecha de gestión',
  `usuario_gestion` varchar(100) NOT NULL COMMENT 'Usuario de gestión',
  `descripcion_gestion` text NOT NULL COMMENT 'Descripción gestión',
  PRIMARY KEY (`id`),
  KEY `fk_gestiones_prejuridicas_procesos_idx` (`proceso_id`),
  CONSTRAINT `fk_gestiones_prejuridicas_procesos` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `gestiones_prejuridicas` */

insert  into `gestiones_prejuridicas`(`id`,`proceso_id`,`fecha_gestion`,`usuario_gestion`,`descripcion_gestion`) values (1,8,'2021-07-24 13:57:08','ALEJANDRO MONTOYA','PRIMERA  GESTIóN PRE JURíDICA'),(2,9,'2021-07-24 13:57:17','ELKIN PéREZ','PRIMERA  GESTIóN PRE JURíDICA'),(3,9,'2021-07-24 14:13:16','ALEJANDRO MONTOYA',' LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS. DONEC HENDRERIT DIGNISSIM MOLESTIE. NULLA UT ERAT ELIT. FUSCE AT LUCTUS EX. DONEC VEL NIBH DIAM. FUSCE DAPIBUS VOLUTPAT MOLLIS.\r\n\r\nDONEC VENENATIS FEUGIAT LAOREET. DONEC TRISTIQUE BIBENDUM LOREM, ID SCELERISQUE URNA SODALES EGET. QUISQUE SEMPER, TELLUS NON SOLLICITUDIN MAXIMUS, ODIO ERAT VENENATIS LOREM, RHONCUS ACCUMSAN FELIS LIBERO VEL LECTUS. PELLENTESQUE EU LOREM ID JUSTO MATTIS DAPIBUS. NUNC SED EST JUSTO. PELLENTESQUE CONDIMENTUM PELLENTESQUE DOLOR PORTTITOR ACCUMSAN. MORBI PORTA LACUS NON HENDRERIT TEMPOR. VIVAMUS VENENATIS MALESUADA LIGULA, ID SUSCIPIT LEO EGESTAS AT. DUIS SEMPER ULLAMCORPER NEQUE IN ACCUMSAN. PRAESENT UT DOLOR EGESTAS, LUCTUS AUGUE VITAE, VULPUTATE ENIM. SUSPENDISSE QUIS TORTOR IN NIBH RUTRUM VARIUS. CURABITUR CONDIMENTUM, MAURIS EGET ALIQUAM VENENATIS, PURUS NEQUE CONDIMENTUM EX, MATTIS POSUERE EROS NISL VEL FELIS. ETIAM SED LUCTUS SAPIEN. '),(4,9,'2021-07-24 14:14:03','JUAN FELIPE MONTIEL',' LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS. DONEC HENDRERIT DIGNISSIM MOLESTIE. NULLA UT ERAT ELIT. FUSCE AT LUCTUS EX. DONEC VEL NIBH DIAM. FUSCE DAPIBUS VOLUTPAT MOLLIS.\r\n\r\n\r\nDONEC VENENATIS FEUGIAT LAOREET. DONEC TRISTIQUE BIBENDUM LOREM, ID SCELERISQUE URNA SODALES EGET. QUISQUE SEMPER, TELLUS NON SOLLICITUDIN MAXIMUS, ODIO ERAT VENENATIS LOREM, RHONCUS ACCUMSAN FELIS LIBERO VEL LECTUS. PELLENTESQUE EU LOREM ID JUSTO MATTIS DAPIBUS. NUNC SED EST JUSTO. PELLENTESQUE CONDIMENTUM PELLENTESQUE DOLOR PORTTITOR ACCUMSAN. MORBI PORTA LACUS NON HENDRERIT TEMPOR. VIVAMUS VENENATIS MALESUADA LIGULA, ID SUSCIPIT LEO EGESTAS AT. DUIS SEMPER ULLAMCORPER NEQUE IN ACCUMSAN. PRAESENT UT DOLOR EGESTAS, LUCTUS AUGUE VITAE, VULPUTATE ENIM. SUSPENDISSE QUIS TORTOR IN NIBH RUTRUM VARIUS. CURABITUR CONDIMENTUM, MAURIS EGET ALIQUAM VENENATIS, PURUS NEQUE CONDIMENTUM EX, MATTIS POSUERE EROS NISL VEL FELIS. ETIAM SED LUCTUS SAPIEN. '),(5,9,'2021-07-24 14:16:43','ELKIN PéREZ',' LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS. DONEC HENDRERIT DIGNISSIM MOLESTIE. NULLA UT ERAT ELIT. FUSCE AT LUCTUS EX. DONEC VEL NIBH DIAM. FUSCE DAPIBUS VOLUTPAT MOLLIS.\r\n\r\nDONEC VENENATIS FEUGIAT LAOREET. DONEC TRISTIQUE BIBENDUM LOREM, ID SCELERISQUE URNA SODALES EGET. QUISQUE SEMPER, TELLUS NON SOLLICITUDIN MAXIMUS, ODIO ERAT VENENATIS LOREM, RHONCUS ACCUMSAN FELIS LIBERO VEL LECTUS. PELLENTESQUE EU LOREM ID JUSTO MATTIS DAPIBUS. NUNC SED EST JUSTO. PELLENTESQUE CONDIMENTUM PELLENTESQUE DOLOR PORTTITOR ACCUMSAN. MORBI PORTA LACUS NON HENDRERIT TEMPOR. VIVAMUS VENENATIS MALESUADA LIGULA, ID SUSCIPIT LEO EGESTAS AT. DUIS SEMPER ULLAMCORPER NEQUE IN ACCUMSAN. PRAESENT UT DOLOR EGESTAS, LUCTUS AUGUE VITAE, VULPUTATE ENIM. SUSPENDISSE QUIS TORTOR IN NIBH RUTRUM VARIUS. CURABITUR CONDIMENTUM, MAURIS EGET ALIQUAM VENENATIS, PURUS NEQUE CONDIMENTUM EX, MATTIS POSUERE EROS NISL VEL FELIS. ETIAM SED LUCTUS SAPIEN. '),(6,9,'2021-07-24 14:17:11','ALEJANDRO MONTOYA','HOLA\r\nSI\r\n\r\nMUY BIEN\r\n\r\nY TU\r\nBIEN?'),(7,11,'2021-07-25 10:36:54','SUPER ADMINISTRADOR','GESTIóN PRE JURíDICA 1'),(8,11,'2021-07-25 10:37:21','JUAN FELIPE MONTIEL','GESTIóN PRE JURíDICA 2');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values (1,'Configuración',NULL,NULL,3,' flaticon-cogwheel'),(2,'Asignaciones',1,'/admin/assignment/index',2,' flaticon-user-ok'),(3,'Usuarios',1,'/users/index',1,' flaticon-users'),(4,'General',NULL,NULL,2,' flaticon-add'),(5,'Tipos de procesos',4,'/tipo-procesos/index',4,' flaticon-squares-2'),(9,'Clientes',4,'/clientes/index',1,' flaticon-users'),(10,'Deudores',4,'/deudores/index',2,' flaticon-coins'),(11,'Procesos',NULL,'/procesos/index',1,' flaticon-list-2'),(12,'Tipo de casos',4,'/tipo-casos/index',5,' flaticon-squares-2'),(13,'Bienes',4,'/bienes/index',6,' flaticon-list-3'),(14,'Doc. activación',4,'/documentos-activacion/index',7,' flaticon-list-3');

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
  `deudor_id` int(11) NOT NULL COMMENT 'Deudor',
  `prejur_fecha_recepcion` date DEFAULT NULL COMMENT 'Fecha recepción',
  `prejur_tipo_caso` int(11) DEFAULT NULL COMMENT 'Tipo de caso',
  `prejur_consulta_rama_judicial` text DEFAULT NULL COMMENT 'Consulta rama judicial',
  `prejur_consulta_entidad_reguladora` text DEFAULT NULL COMMENT 'Consulta entidad reguladora',
  `prejur_concepto_viabilidad` text DEFAULT NULL COMMENT 'Concepto  viabilidad',
  `prejur_otros` text DEFAULT NULL COMMENT 'Otros',
  `jur_fecha_recepcion` date DEFAULT NULL COMMENT 'Fecha activación',
  `jur_valor_activacion` decimal(10,0) DEFAULT NULL COMMENT 'Valor activación',
  `jur_saldo_actual` decimal(10,0) DEFAULT NULL COMMENT 'Saldo actual',
  PRIMARY KEY (`id`),
  KEY `fk_procesos_clientes_idx` (`cliente_id`),
  KEY `fk_procesos_deudores_idx` (`deudor_id`),
  KEY `fk_procesos_tipo_casos_idx` (`prejur_tipo_caso`),
  CONSTRAINT `fk_procesos_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_procesos_deudores` FOREIGN KEY (`deudor_id`) REFERENCES `deudores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_procesos_tipo_casos` FOREIGN KEY (`prejur_tipo_caso`) REFERENCES `tipo_casos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `procesos` */

insert  into `procesos`(`id`,`cliente_id`,`deudor_id`,`prejur_fecha_recepcion`,`prejur_tipo_caso`,`prejur_consulta_rama_judicial`,`prejur_consulta_entidad_reguladora`,`prejur_concepto_viabilidad`,`prejur_otros`,`jur_fecha_recepcion`,`jur_valor_activacion`,`jur_saldo_actual`) values (2,1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,93,3,'2021-07-15',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,3,NULL,NULL,'','','','',NULL,NULL,NULL),(5,93,3,NULL,NULL,'','','','',NULL,NULL,NULL),(6,93,3,NULL,NULL,'','','','',NULL,NULL,NULL),(7,93,3,NULL,NULL,'','','','',NULL,NULL,NULL),(8,93,3,NULL,NULL,'','','','',NULL,NULL,NULL),(9,1,3,'2021-07-25',1,'1LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.\r\n\r\nLOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.','2LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.\r\n\r\nLOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.','5LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.\r\n\r\nLOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.','6LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM EGET QUAM TELLUS. QUISQUE EU IPSUM MATTIS, COMMODO EX EU, VENENATIS EROS.',NULL,NULL,NULL),(10,1,3,NULL,NULL,'','','','',NULL,NULL,NULL),(11,1,3,'2021-07-25',6,'Consulta rama judicial','Consulta entidad reguladora','Concepto viabilidad','Otros','2021-07-28',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

/*Data for the table `procesos_x_colaboradores` */

insert  into `procesos_x_colaboradores`(`id`,`proceso_id`,`user_id`) values (18,2,7),(19,2,8),(20,2,10),(37,3,7),(38,3,8),(39,3,10),(61,4,7),(62,4,8),(63,4,10),(64,5,7),(65,5,8),(66,5,10),(67,6,7),(68,6,8),(69,6,10),(70,7,7),(71,7,8),(72,7,10),(73,8,7),(74,8,8),(75,8,10),(115,10,7),(116,10,8),(117,10,10),(133,9,7),(134,9,8),(135,9,10),(152,11,7);

/*Table structure for table `tipo_casos` */

DROP TABLE IF EXISTS `tipo_casos`;

CREATE TABLE `tipo_casos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL,
  `activo` tinyint(1) NOT NULL COMMENT 'Activo',
  `delete` tinyint(1) DEFAULT 0,
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  `deleted` datetime DEFAULT NULL COMMENT 'Borrado',
  `deleted_by` varchar(45) DEFAULT NULL COMMENT 'Borrado  por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_casos` */

insert  into `tipo_casos`(`id`,`nombre`,`activo`,`delete`,`created`,`created_by`,`modified`,`modified_by`,`deleted`,`deleted_by`) values (1,'PREJURíDICO',1,0,'2021-07-20 09:34:12','admin','2021-07-20 09:34:12','admin',NULL,NULL),(2,'DEMANDA',1,0,'2021-07-20 09:34:27','admin','2021-07-20 09:34:27','admin',NULL,NULL),(3,'CONCILIACIÓN',1,0,'2021-07-20 09:34:41','admin','2021-07-20 09:34:41','admin',NULL,NULL),(4,'LEY 1116',1,0,'2021-07-20 09:34:50','admin','2021-07-20 09:34:50','admin',NULL,NULL),(5,'LIQUIDACIÓN',1,0,'2021-07-20 09:34:59','admin','2021-07-20 09:35:35','admin',NULL,NULL),(6,'CARTERA CORRIENTE',1,0,'2021-07-20 09:35:07','admin','2021-07-20 09:35:07','admin',NULL,NULL),(7,'OTROS',1,0,'2021-07-20 09:35:12','admin','2021-07-20 09:35:12','admin',NULL,NULL),(8,'SADASDASD',1,1,'2021-07-23 12:29:11','admin','2021-07-23 13:54:16','admin','2021-07-23 13:54:16','admin'),(9,'SADASD',1,1,'2021-07-23 12:29:23','admin','2021-07-23 12:37:38','admin','2021-07-23 12:37:38','admin');

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
