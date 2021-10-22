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

alter table `db_cartera_integral`.`consolidado_pagos_prejuridicos` 
   change `fecha_pago_realizado` `fecha_pago_realizado` date NULL  comment 'Pago realizado'

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
