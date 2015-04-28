SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `fixometer` ;
CREATE SCHEMA IF NOT EXISTS `fixometer` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `fixometer` ;

-- -----------------------------------------------------
-- Table `fixometer`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`roles` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`roles` (
  `idroles` INT NOT NULL AUTO_INCREMENT ,
  `role` VARCHAR(45) NOT NULL COMMENT 'Needed to assign blocks of permissions to groups of users. 1 = Admin; 2 = Hosts; 3 = Volunteer' ,
  PRIMARY KEY (`idroles`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fixometer`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`groups` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`groups` (
  `idgroups` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `location` VARCHAR(255) NULL ,
  `latitude` FLOAT NULL ,
  `longitude` FLOAT NULL ,
  `area` INT NOT NULL ,
  `frequency` INT NULL ,
  PRIMARY KEY (`idgroups`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `fixometer`.`groups` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `fixometer`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`users` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(60) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `role` INT NOT NULL DEFAULT 3 ,
  `group` INT NULL ,
  PRIMARY KEY (`idusers`) ,
  CONSTRAINT `fkUserRole`
    FOREIGN KEY (`role` )
    REFERENCES `fixometer`.`roles` (`idroles` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkUserGroup`
    FOREIGN KEY (`group` )
    REFERENCES `fixometer`.`groups` (`idgroups` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `fixometer`.`users` (`email` ASC) ;

CREATE INDEX `idxUserRole` ON `fixometer`.`users` (`role` ASC) ;

CREATE INDEX `idxUserGroup` ON `fixometer`.`users` (`group` ASC) ;


-- -----------------------------------------------------
-- Table `fixometer`.`permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`permissions` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`permissions` (
  `idpermissions` INT NOT NULL AUTO_INCREMENT ,
  `permission` INT NOT NULL COMMENT 'Manage Users; Manage Restart Party; Manage devices' ,
  PRIMARY KEY (`idpermissions`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fixometer`.`roles_permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`roles_permissions` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`roles_permissions` (
  `idroles_permissions` INT NOT NULL AUTO_INCREMENT ,
  `role` INT NOT NULL ,
  `permission` INT NOT NULL ,
  PRIMARY KEY (`idroles_permissions`) ,
  CONSTRAINT `fkRolePermissionRole`
    FOREIGN KEY (`role` )
    REFERENCES `fixometer`.`roles` (`idroles` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkRolePermissionPermission`
    FOREIGN KEY (`permission` )
    REFERENCES `fixometer`.`permissions` (`idpermissions` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `idxRolePermissionRole` ON `fixometer`.`roles_permissions` (`role` ASC) ;

CREATE INDEX `idxRolePermissionPermission` ON `fixometer`.`roles_permissions` (`permission` ASC) ;


-- -----------------------------------------------------
-- Table `fixometer`.`events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`events` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`events` (
  `idevents` INT NOT NULL AUTO_INCREMENT ,
  `group` INT NOT NULL ,
  `start` DATETIME NOT NULL ,
  `end` DATETIME NOT NULL ,
  `location` VARCHAR(255) NOT NULL ,
  `latitude` FLOAT NOT NULL ,
  `longitude` FLOAT NOT NULL ,
  `pax` INT NULL ,
  PRIMARY KEY (`idevents`) ,
  CONSTRAINT `fkEventsGroups`
    FOREIGN KEY (`group` )
    REFERENCES `fixometer`.`groups` (`idgroups` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `idxEventsGroups` ON `fixometer`.`events` (`group` ASC) ;


-- -----------------------------------------------------
-- Table `fixometer`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`categories` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`categories` (
  `idcategories` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `weight` FLOAT NULL ,
  `footprint` FLOAT NULL ,
  `footprint_reliability` INT NULL ,
  `lifecycle` INT NULL ,
  `lifecycle_reliability` INT NULL ,
  `extendend_lifecycle` INT NULL ,
  `extendend_lifecycle_reliability` INT NULL ,
  PRIMARY KEY (`idcategories`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fixometer`.`devices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fixometer`.`devices` ;

CREATE  TABLE IF NOT EXISTS `fixometer`.`devices` (
  `iddevices` INT NOT NULL AUTO_INCREMENT ,
  `event` INT NOT NULL ,
  `category` INT NOT NULL ,
  `problem` TEXT NULL ,
  `spare_parts` TINYINT(1) NOT NULL DEFAULT FALSE ,
  `repair_status` INT NOT NULL ,
  PRIMARY KEY (`iddevices`) ,
  CONSTRAINT `fkDeviceEvent`
    FOREIGN KEY (`event` )
    REFERENCES `fixometer`.`events` (`idevents` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkDeviceCategory`
    FOREIGN KEY (`category` )
    REFERENCES `fixometer`.`categories` (`idcategories` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `idxDeviceEvent` ON `fixometer`.`devices` (`event` ASC) ;

CREATE INDEX `idxDeviceCategory` ON `fixometer`.`devices` (`category` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `fixometer`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `fixometer`;
INSERT INTO `fixometer`.`roles` (`idroles`, `role`) VALUES (1, 'Root');
INSERT INTO `fixometer`.`roles` (`idroles`, `role`) VALUES (2, 'Administrator');
INSERT INTO `fixometer`.`roles` (`idroles`, `role`) VALUES (3, 'Host');
INSERT INTO `fixometer`.`roles` (`idroles`, `role`) VALUES (4, 'Guest');

COMMIT;

-- -----------------------------------------------------
-- Data for table `fixometer`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `fixometer`;
INSERT INTO `fixometer`.`users` (`idusers`, `email`, `password`, `name`, `role`, `group`) VALUES (1, 'tech@alanzard.com', '$1$37d0565f$P0zN4TAXOSr2v8OoLdmd1/', 'Root', 1, NULL);

COMMIT;
