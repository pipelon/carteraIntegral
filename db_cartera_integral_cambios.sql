SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `db_cartera_integral`.`clientes` 
CHANGE COLUMN `tipo_documento` `tipo_documento` VARCHAR(30) NOT NULL COMMENT 'Tipo de documento';

ALTER TABLE `db_cartera_integral`.`deudores` 
ADD COLUMN `tipo_documento` VARCHAR(30) NOT NULL COMMENT 'Tido de documento' AFTER `id`,
ADD COLUMN `documento` VARCHAR(20) NOT NULL COMMENT 'Documento' AFTER `tipo_documento`,
ADD COLUMN `ciudad` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Ciudad' AFTER `direccion`;

ALTER TABLE `db_cartera_integral`.`procesos` 
DROP FOREIGN KEY `fk_procesos_plataformas`;

ALTER TABLE `db_cartera_integral`.`procesos` 
CHANGE COLUMN `plataforma_id` `plataforma_id` INT(11) NULL DEFAULT NULL COMMENT 'Plataforma' ;

ALTER TABLE `db_cartera_integral`.`procesos` 
ADD CONSTRAINT `fk_procesos_plataformas`
  FOREIGN KEY (`plataforma_id`)
  REFERENCES `db_cartera_integral`.`plataformas` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `db_cartera_integral`.`deudores` 
ADD COLUMN `carpeta` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Carpeta Google Drive' AFTER `comentarios`;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
