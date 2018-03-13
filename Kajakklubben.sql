-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema kajakklubben
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema kajakklubben
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kajakklubben` DEFAULT CHARACTER SET utf8 ;
USE `kajakklubben` ;

-- -----------------------------------------------------
-- Table `kajakklubben`.`roletypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`roletypes` (
  `roleTypeId` INT(11) NOT NULL AUTO_INCREMENT,
  `roleTypeName` VARCHAR(64) NOT NULL,
  `roleTypeInt` INT(11) NOT NULL,
  PRIMARY KEY (`roleTypeId`))
ENGINE = InnoDB
AUTO_INCREMENT = 88
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kajakklubben`.`userroles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`userroles` (
  `roleId` INT(11) NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`roleId`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kajakklubben`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`roles` (
  `roleId` INT(11) NOT NULL AUTO_INCREMENT,
  `fkUserRole` INT(11) NOT NULL,
  `fkRoleType` INT(11) NOT NULL,
  PRIMARY KEY (`roleId`),
  INDEX `fk_userRole_idx` (`fkUserRole` ASC),
  INDEX `fk_roleType_idx` (`fkRoleType` ASC),
  CONSTRAINT `fk_roleType`
    FOREIGN KEY (`fkRoleType`)
    REFERENCES `kajakklubben`.`roletypes` (`roleTypeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_userRole`
    FOREIGN KEY (`fkUserRole`)
    REFERENCES `kajakklubben`.`userroles` (`roleId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kajakklubben`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`media` (
  `mediaId` INT NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(96) NOT NULL,
  `filepath` VARCHAR(45) NOT NULL,
  `mime` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`mediaId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`users` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(25) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fullname` VARCHAR(45) NOT NULL,
  `userRole` INT(11) NOT NULL,
  `userEmail` VARCHAR(64) NOT NULL,
  `avatar` INT NULL,
  `userKm` INT NULL DEFAULT 0,
  PRIMARY KEY (`userId`),
  INDEX `fkUserRole_idx` (`userRole` ASC),
  INDEX `fkUserAvatar_idx` (`avatar` ASC),
  CONSTRAINT `fkUserRole`
    FOREIGN KEY (`userRole`)
    REFERENCES `kajakklubben`.`userroles` (`roleId`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fkUserAvatar`
    FOREIGN KEY (`avatar`)
    REFERENCES `kajakklubben`.`media` (`mediaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kajakklubben`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`events` (
  `eventsId` INT NOT NULL AUTO_INCREMENT,
  `eventTitle` VARCHAR(25) NOT NULL,
  `eventStartDate` DATE NOT NULL,
  `eventDescription` TEXT NOT NULL,
  `eventCover` INT NULL,
  PRIMARY KEY (`eventsId`),
  INDEX `fkEventCoverMedia_idx` (`eventCover` ASC),
  CONSTRAINT `fkEventCoverMedia`
    FOREIGN KEY (`eventCover`)
    REFERENCES `kajakklubben`.`media` (`mediaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`gallery`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`gallery` (
  `galleryId` INT NOT NULL AUTO_INCREMENT,
  `fkGalleryEventId` INT NOT NULL,
  `fkGalleryMediaId` INT NOT NULL,
  PRIMARY KEY (`galleryId`),
  INDEX `fkEventGalleryId_idx` (`fkGalleryEventId` ASC),
  INDEX `fkMediaGalleryId_idx` (`fkGalleryMediaId` ASC),
  CONSTRAINT `fkEventGalleryId`
    FOREIGN KEY (`fkGalleryEventId`)
    REFERENCES `kajakklubben`.`events` (`eventsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkMediaGalleryId`
    FOREIGN KEY (`fkGalleryMediaId`)
    REFERENCES `kajakklubben`.`media` (`mediaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`userlevels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`userlevels` (
  `userLevelId` INT NOT NULL AUTO_INCREMENT,
  `userLevelName` VARCHAR(25) NOT NULL,
  `userLevelReqKm` INT NOT NULL,
  PRIMARY KEY (`userLevelId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`news` (
  `newsId` INT NOT NULL AUTO_INCREMENT,
  `newsTitle` VARCHAR(25) NOT NULL,
  `newsContent` TEXT NOT NULL,
  `newsCreatedDate` DATE NOT NULL,
  PRIMARY KEY (`newsId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`newsLetterSubscribers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`newsLetterSubscribers` (
  `newsLetterSubscribersId` INT NOT NULL AUTO_INCREMENT,
  `fkNewslettersUserId` INT NOT NULL,
  PRIMARY KEY (`newsLetterSubscribersId`),
  INDEX `fkNewsletterSubUserId_idx` (`fkNewslettersUserId` ASC),
  CONSTRAINT `fkNewsletterSubUserId`
    FOREIGN KEY (`fkNewslettersUserId`)
    REFERENCES `kajakklubben`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`eventSubscribers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`eventSubscribers` (
  `eventSubscriberId` INT NOT NULL AUTO_INCREMENT,
  `fkEventSubUserId` INT NOT NULL,
  `fkEventId` INT NOT NULL,
  PRIMARY KEY (`eventSubscriberId`),
  INDEX `fkSubEventId_idx` (`fkEventId` ASC),
  INDEX `fkUserSuEventbId_idx` (`fkEventSubUserId` ASC),
  CONSTRAINT `fkSubEventId`
    FOREIGN KEY (`fkEventId`)
    REFERENCES `kajakklubben`.`events` (`eventsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkUserSuEventbId`
    FOREIGN KEY (`fkEventSubUserId`)
    REFERENCES `kajakklubben`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`kajakTypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`kajakTypes` (
  `kajakTypeId` INT NOT NULL AUTO_INCREMENT,
  `kajakTypeName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`kajakTypeId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`kajaks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`kajaks` (
  `kajakId` INT NOT NULL AUTO_INCREMENT,
  `kajakName` VARCHAR(52) NOT NULL,
  `kajakStock` INT NOT NULL,
  `kajakLevel` INT(2) NOT NULL,
  `fkKajakType` INT NOT NULL,
  `fkKajakMedia` INT NOT NULL,
  PRIMARY KEY (`kajakId`),
  INDEX `fkTypeKajak_idx` (`fkKajakType` ASC),
  INDEX `fkMediaKajak_idx` (`fkKajakMedia` ASC),
  CONSTRAINT `fkTypeKajak`
    FOREIGN KEY (`fkKajakType`)
    REFERENCES `kajakklubben`.`kajakTypes` (`kajakTypeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkMediaKajak`
    FOREIGN KEY (`fkKajakMedia`)
    REFERENCES `kajakklubben`.`media` (`mediaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`sales` (
  `salesId` INT NOT NULL AUTO_INCREMENT,
  `salesKajakId` INT NOT NULL,
  `salesPrice` INT NOT NULL,
  PRIMARY KEY (`salesId`),
  INDEX `fkKajakSalesId_idx` (`salesKajakId` ASC),
  CONSTRAINT `fkKajakSalesId`
    FOREIGN KEY (`salesKajakId`)
    REFERENCES `kajakklubben`.`kajaks` (`kajakId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kajakklubben`.`contacs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kajakklubben`.`contacs` (
  `contactId` INT NOT NULL AUTO_INCREMENT,
  `contactName` VARCHAR(45) NOT NULL,
  `contactEmail` VARCHAR(128) NOT NULL,
  `contactMobile` INT(8) NULL,
  `contactMessage` TEXT NOT NULL,
  PRIMARY KEY (`contactId`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
