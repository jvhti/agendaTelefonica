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
-- Table `cellbook`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`User` (
  `email` VARCHAR(75) NOT NULL,
  `name` VARCHAR(65) NOT NULL,
  `gender` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `photo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cellbook`.`Contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`Contact` (
  `idContact` INT NOT NULL,
  `name` VARCHAR(65) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `User_email` VARCHAR(75) NOT NULL,
  PRIMARY KEY (`idContact`),
  INDEX `fk_Contact_User1_idx` (`User_email` ASC),
  CONSTRAINT `fk_Contact_User1`
    FOREIGN KEY (`User_email`)
    REFERENCES `cellbook`.`User` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cellbook`.`phone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cellbook`.`phone` (
  `idPhone` INT NOT NULL,
  `phoneNumber` VARCHAR(15) NOT NULL,
  `Contact_idContact` INT NOT NULL,
  PRIMARY KEY (`idPhone`),
  INDEX `fk_phone_Contact_idx` (`Contact_idContact` ASC),
  CONSTRAINT `fk_phone_Contact`
    FOREIGN KEY (`Contact_idContact`)
    REFERENCES `cellbook`.`Contact` (`idContact`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
