-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cellbook
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cellbook
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cellbook` DEFAULT CHARACTER SET utf8 ;
USE `cellbook` ;

-- -----------------------------------------------------
-- Table `cellbook`.`Contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`Contact` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(65) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `photo` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NULL,
  `neighborhood` VARCHAR(45) NULL,
  `notes` LONGTEXT NULL,
  `User_email` VARCHAR(75) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Contact_User1_idx` (`User_email` ASC),
  CONSTRAINT `fk_Contact_User1`
    FOREIGN KEY (`User_email`)
    REFERENCES `cellbook`.`User` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cellbook`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`User` (
  `email` VARCHAR(75) NOT NULL,
  `name` VARCHAR(65) NOT NULL,
  `gender` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `photo` VARCHAR(45) NOT NULL,
  `Contact_id` INT NOT NULL,
  PRIMARY KEY (`email`),
  INDEX `fk_User_Contact1_idx` (`Contact_id` ASC),
  CONSTRAINT `fk_User_Contact1`
    FOREIGN KEY (`Contact_id`)
    REFERENCES `cellbook`.`Contact` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cellbook`.`phone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`phone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `phoneNumber` VARCHAR(15) NOT NULL,
  `Contact_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_phone_Contact_idx` (`Contact_id` ASC),
  CONSTRAINT `fk_phone_Contact`
    FOREIGN KEY (`Contact_id`)
    REFERENCES `cellbook`.`Contact` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cellbook`.`User_has_User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`User_has_User` (
  `User_email` VARCHAR(75) NOT NULL,
  `User_email1` VARCHAR(75) NOT NULL,
  PRIMARY KEY (`User_email`, `User_email1`),
  INDEX `fk_User_has_User_User2_idx` (`User_email1` ASC),
  INDEX `fk_User_has_User_User1_idx` (`User_email` ASC),
  CONSTRAINT `fk_User_has_User_User1`
    FOREIGN KEY (`User_email`)
    REFERENCES `cellbook`.`User` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_User_User2`
    FOREIGN KEY (`User_email1`)
    REFERENCES `cellbook`.`User` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
