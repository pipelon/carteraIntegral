SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- ALTER TABLE `db_cartera_integral`.`clientes` 
-- CHANGE COLUMN `tipo_documento` `tipo_documento` VARCHAR(30) NOT NULL COMMENT 'Tipo de documento';

-- ALTER TABLE `db_cartera_integral`.`deudores` 
-- ADD COLUMN `tipo_documento` VARCHAR(30) NOT NULL COMMENT 'Tido de documento' AFTER `id`,
-- ADD COLUMN `documento` VARCHAR(20) NOT NULL COMMENT 'Documento' AFTER `tipo_documento`,
-- ADD COLUMN `ciudad` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Ciudad' AFTER `direccion`;

-- ALTER TABLE `db_cartera_integral`.`procesos` 
-- DROP FOREIGN KEY `fk_procesos_plataformas`;

-- ALTER TABLE `db_cartera_integral`.`procesos` 
-- CHANGE COLUMN `plataforma_id` `plataforma_id` INT(11) NULL DEFAULT NULL COMMENT 'Plataforma' ;

-- ALTER TABLE `db_cartera_integral`.`procesos` 
-- ADD CONSTRAINT `fk_procesos_plataformas`
  -- FOREIGN KEY (`plataforma_id`)
  -- REFERENCES `db_cartera_integral`.`plataformas` (`id`)
  -- ON DELETE NO ACTION
  -- ON UPDATE NO ACTION;
  
-- ALTER TABLE `db_cartera_integral`.`deudores` 
-- ADD COLUMN `carpeta` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Carpeta Google Drive' AFTER `comentarios`;

-- ALTER TABLE `procesos` ADD `prejur_fecha_no_acuerdo_pago` DATE NULL COMMENT 'Fecha de marcación de que no hubo acuerdo de pago' AFTER `prejur_acuerdo_pago`;

-- ALTER TABLE `procesos` ADD `prejur_resultado_estudio_bienes` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'SIN DEFINIR' COMMENT 'Resultado del estudio de bienes' AFTER `prejur_fecha_no_acuerdo_pago`;

-- ALTER TABLE `procesos` ADD `prejur_fecha_estudio_bienes` DATE NULL DEFAULT NULL COMMENT 'Fecha de certificación del resultado del estudio de bienes' AFTER `prejur_estudio_bienes`;

-- ALTER TABLE `procesos` ADD `prejur_informe_castigo_enviado` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'NO' COMMENT '¿Se envía informe de inviabilidad o castigo?' AFTER `prejur_fecha_estudio_bienes`;

-- ALTER TABLE `procesos` ADD `prejur_carta_castigo_enviada` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'NO' COMMENT '¿Se envía carta de inviabilidad o castigo?' AFTER `prejur_informe_castigo_enviado`;

-- alter table `db_cartera_integral`.`consolidado_pagos_prejuridicos` 
   -- change `fecha_pago_realizado` `fecha_pago_realizado` date NULL  comment 'Pago realizado'
   
-- ALTER TABLE `alertas` ADD `pausada` VARCHAR(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT 'La alerta esta pausada o no' AFTER `descripcion_alerta`;

-- ALTER TABLE `alertas` ADD `fecha_pausada` DATETIME NOT NULL COMMENT 'Fecha en que fue pausada' AFTER `pausada`;

/*CREATE TABLE IF NOT EXISTS `db_cartera_integral`.`gestiones_juridicas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `proceso_id` INT(11) NOT NULL COMMENT 'Proceso ID',
  `fecha_gestion` DATETIME NOT NULL COMMENT 'Fecha de gestión',
  `usuario_gestion` VARCHAR(100) NOT NULL COMMENT 'Usuario de gestión',
  `descripcion_gestion` TEXT NOT NULL COMMENT 'Descripción gestión',
  PRIMARY KEY (`id`),
  INDEX `fk_gestiones_juridicas_procesos_idx` (`proceso_id` ASC) VISIBLE,
  CONSTRAINT `fk_gestiones_juridicas_procesos`
    FOREIGN KEY (`proceso_id`)
    REFERENCES `db_cartera_integral`.`procesos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8*/

CREATE TABLE IF NOT EXISTS `db_cartera_integral`.`demandados_x_proceso` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `proceso_id` INT(11) NOT NULL COMMENT 'Proceso ID',
  `demandado_id` VARCHAR(100) NOT NULL COMMENT 'Demandado',
  `nombre` VARCHAR(255) NOT NULL COMMENT 'Nombre',
  PRIMARY KEY (`id`),
  INDEX `fk_demandados_x_proceso_procesos_idx` (`proceso_id` ASC),
  CONSTRAINT `fk_demandados_x_proceso_procesos`
    FOREIGN KEY (`proceso_id`)
    REFERENCES `db_cartera_integral`.`procesos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB
DEFAULT CHARACTER SET = utf8;

alter table `db_cartera_integral`.`documentos_activacion` 
   change `delete` `delete` tinyint(1) default '0' NULL  comment 'Borrado';

ALTER TABLE `db_cartera_integral`.`departamentos` 
   ADD COLUMN `codigo_departamento` CHAR(3) NOT NULL COMMENT 'Código departamento' AFTER `nombre`;

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre',
  `codigo_departamento` char(3) NOT NULL COMMENT 'Código departamento',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  `delete` tinyint(1) DEFAULT 0 COMMENT 'Borrado',
  `deleted` datetime DEFAULT NULL COMMENT 'Borrado',
  `deleted_by` varchar(45) DEFAULT NULL COMMENT 'Borrado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `departamentos` */

insert  into `departamentos`(`id`,`nombre`,`codigo_departamento`,`created`,`created_by`,`modified`,`modified_by`,`delete`,`deleted`,`deleted_by`) values (1,'AMAZONAS','91','2021-08-31 16:00:00','admin','2022-01-29 16:28:13','admin',0,NULL,NULL),(2,'ANTIOQUIA','05','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(3,'ARAUCA','81','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(4,'ARCH S. AND PROV Y SC','88','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(5,'ATLÁNTICO','08','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(6,'BOGOTÁ D.C','11','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(7,'BOLÍVAR','13','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(8,'BOYACÁ','15','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(9,'CALDAS','17','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(10,'CAQUETÁ','18','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(11,'CASANARE','85','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(12,'CAUCA','19','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(13,'CESAR','20','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(14,'CHOCÓ','27','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(15,'CÓRDOBA','23','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(16,'CUNDINAMARCA','25','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(17,'GUAINÍA','94','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(18,'GUAVIARE','95','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(19,'HUILA','41','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(20,'LA GUAJIRA','44','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(21,'MAGDALENA','47','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(22,'META','50','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(23,'NARIÑO','52','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(24,'NORTE DE SANTANDER','54','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(25,'PUTUMAYO','86','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(26,'QUINDIO','63','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(27,'RISARALDA','66','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(28,'SANTANDER','68','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(29,'SUCRE','70','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(30,'TOLIMA','73','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(31,'VALLE DEL CAUCA','76','2021-08-31 16:00:00','admin','2021-08-31 16:00:00','admin',0,NULL,NULL),(32,'VAUPÉS','97','2021-08-31 16:00:00','admin','2021-09-24 15:10:51','admin',0,'2021-09-24 15:10:51','admin');


alter table `db_cartera_integral`.`procesos` 
   add column `jur_radicado` varchar(45) NULL COMMENT 'Radicado' after `jur_juzgado`;

alter table `db_cartera_integral`.`procesos` 
   add column `jur_fecha_etapa_procesal` date NULL COMMENT 'Fecha etapa procesal' after jur_etapas_procesal_id

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
