SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `skywoddmaindb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `skywoddmaindb` ;

-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Group` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Group` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(255) NOT NULL ,
  `Brief` VARCHAR(255) NULL DEFAULT '' ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`User` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`User` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Nickname` VARCHAR(255) NOT NULL ,
  `DisplayName` VARCHAR(255) NULL DEFAULT '' ,
  `Email` VARCHAR(255) NOT NULL ,
  `PasswordHash` CHAR(64) NOT NULL ,
  `InscriptionDate` DATE NOT NULL ,
  `LastSeenDate` DATETIME NOT NULL ,
  `WarningCount` TINYINT UNSIGNED NULL DEFAULT 0 ,
  `Gender` TINYINT UNSIGNED NOT NULL ,
  `Location` VARCHAR(255) NULL DEFAULT '' ,
  `Status` TINYINT UNSIGNED NOT NULL ,
  `Slogan` VARCHAR(255) NULL DEFAULT '' ,
  `Website` VARCHAR(255) NULL DEFAULT '' ,
  `GroupeID` INTEGER NOT NULL ,
  `TimezoneOffset` TINYINT NULL DEFAULT 0 ,
  `PasswordSalt` CHAR(13) NOT NULL ,
  `HideEmail` TINYINT(1) NULL DEFAULT TRUE ,
  `ShowOnline` TINYINT(1) NULL DEFAULT TRUE ,
  `LastLoginIP` VARCHAR(39) NULL DEFAULT '' ,
  `FailedLoginCount` TINYINT UNSIGNED NULL DEFAULT 0 ,
  `LoginLockedUntil` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Nickname_UNIQUE` (`Nickname` ASC) ,
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC) ,
  INDEX `GroupID_FK_idx` (`GroupeID` ASC) ,
  CONSTRAINT `GroupID_FK`
    FOREIGN KEY (`GroupeID` )
    REFERENCES `skywoddmaindb`.`Group` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Permission` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Permission` (
  `GroupID` INTEGER NOT NULL ,
  `Type` SMALLINT UNSIGNED NOT NULL ,
  `Value` TINYINT(1) NULL DEFAULT FALSE ,
  PRIMARY KEY (`GroupID`, `Type`) ,
  INDEX `GroupID_FK_idx` (`GroupID` ASC) ,
  CONSTRAINT `GroupID_FK`
    FOREIGN KEY (`GroupID` )
    REFERENCES `skywoddmaindb`.`Group` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`UserWarning`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`UserWarning` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`UserWarning` (
  `UserID` INTEGER NOT NULL ,
  `WarningDate` DATETIME NOT NULL ,
  `FromUserID` INTEGER NOT NULL ,
  `Reason` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`UserID`, `WarningDate`) ,
  INDEX `UserID_FK_idx` (`UserID` ASC) ,
  INDEX `FromUserID_FK_idx` (`FromUserID` ASC) ,
  CONSTRAINT `UserID_FK`
    FOREIGN KEY (`UserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FromUserID_FK`
    FOREIGN KEY (`FromUserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`UserBan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`UserBan` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`UserBan` (
  `UserID` INTEGER NOT NULL ,
  `BanDate` DATETIME NOT NULL ,
  `FromUserID` INTEGER NOT NULL ,
  `Reason` VARCHAR(255) NOT NULL ,
  `PermanentBan` TINYINT(1) NULL DEFAULT FALSE ,
  `ExpireDate` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`UserID`, `BanDate`) ,
  INDEX `FromUserID_idx` (`FromUserID` ASC) ,
  INDEX `UserID_idx` (`UserID` ASC) ,
  CONSTRAINT `UserID_FK`
    FOREIGN KEY (`UserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FromUserID_FK`
    FOREIGN KEY (`FromUserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`LoginLog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`LoginLog` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`LoginLog` (
  `UserID` INTEGER NOT NULL ,
  `LogDate` DATETIME NOT NULL ,
  `FromAddress` VARCHAR(39) NOT NULL ,
  `LoginSuccess` TINYINT(1) NOT NULL ,
  `LoginMethod` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`UserID`, `LogDate`) ,
  INDEX `UserID_FK_idx` (`UserID` ASC) ,
  CONSTRAINT `UserID_FK`
    FOREIGN KEY (`UserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`ForbiddenString`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`ForbiddenString` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`ForbiddenString` (
  `Value` VARCHAR(255) NOT NULL ,
  `Type` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`Value`, `Type`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`License`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`License` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`License` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Title` VARCHAR(255) NOT NULL ,
  `Brief` TEXT NULL DEFAULT '' ,
  `Url` VARCHAR(255) NULL DEFAULT '' ,
  `Usage` TEXT NULL DEFAULT '' ,
  `ThumbnailUrl` VARCHAR(255) NULL DEFAULT '' ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Title_UNIQUE` (`Title` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Keyword`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Keyword` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Keyword` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Keyword` VARCHAR(255) NOT NULL ,
  `UsedCount` INTEGER UNSIGNED NULL DEFAULT 0 ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Keyword_UNIQUE` (`Keyword` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Category` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Category` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Title` VARCHAR(255) NOT NULL ,
  `Brief` TEXT NULL DEFAULT '' ,
  `ParentID` INTEGER NULL DEFAULT -1 ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Title_UNIQUE` (`Title` ASC) ,
  INDEX `ParentID_FK_idx` (`ParentID` ASC) ,
  CONSTRAINT `ParentID_FK`
    FOREIGN KEY (`ParentID` )
    REFERENCES `skywoddmaindb`.`Category` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Publication` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Publication` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Title` VARCHAR(255) NOT NULL ,
  `Permalink` VARCHAR(255) NOT NULL ,
  `PublishDate` DATETIME NOT NULL ,
  `AuthorID` INTEGER NOT NULL ,
  `LicenseID` INTEGER NOT NULL ,
  `Brief` VARCHAR(255) NULL DEFAULT '' ,
  `Status` TINYINT NOT NULL ,
  `Type` TINYINT NOT NULL ,
  `LockedByUserID` INTEGER NULL DEFAULT -1 ,
  `LockedFromDate` DATETIME NULL DEFAULT NULL ,
  `CommentAllowed` TINYINT(1) NULL DEFAULT TRUE ,
  `PingAllowed` TINYINT(1) NULL DEFAULT TRUE ,
  `Password` VARCHAR(255) NULL DEFAULT '' ,
  `Sticky` TINYINT(1) NULL DEFAULT FALSE ,
  `CommentCount` INTEGER NULL DEFAULT 0 ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Permalink_UNIQUE` (`Permalink` ASC) ,
  INDEX `AuthorID_FK_idx` (`AuthorID` ASC) ,
  INDEX `LicenseID_FK_idx` (`LicenseID` ASC) ,
  INDEX `LockedByUserID_FK_idx` (`LockedByUserID` ASC) ,
  UNIQUE INDEX `Title_UNIQUE` (`Title` ASC) ,
  CONSTRAINT `AuthorID_FK`
    FOREIGN KEY (`AuthorID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `LicenseID_FK`
    FOREIGN KEY (`LicenseID` )
    REFERENCES `skywoddmaindb`.`License` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `LockedByUserID_FK`
    FOREIGN KEY (`LockedByUserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`KeywordAssocation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`KeywordAssocation` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`KeywordAssocation` (
  `PublicationID` INTEGER NOT NULL ,
  `KeywordID` INTEGER NOT NULL ,
  PRIMARY KEY (`PublicationID`, `KeywordID`) ,
  INDEX `KeywordID_FK_idx` (`KeywordID` ASC) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `KeywordID_FK`
    FOREIGN KEY (`KeywordID` )
    REFERENCES `skywoddmaindb`.`Keyword` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`CategoryAssocation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`CategoryAssocation` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`CategoryAssocation` (
  `PublicationID` INTEGER NOT NULL ,
  `CategoryID` INTEGER NOT NULL ,
  PRIMARY KEY (`PublicationID`, `CategoryID`) ,
  INDEX `CategoryID_FK_idx` (`CategoryID` ASC) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `CategoryID_FK`
    FOREIGN KEY (`CategoryID` )
    REFERENCES `skywoddmaindb`.`Category` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Revision`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Revision` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Revision` (
  `PublicationID` INTEGER NOT NULL ,
  `RevisionNumber` INTEGER NOT NULL ,
  `RevisionDate` DATETIME NOT NULL ,
  `AuthorID` INTEGER NOT NULL ,
  `RevisionMessage` VARCHAR(255) NULL DEFAULT '' ,
  `MinorChange` TINYINT(1) NULL DEFAULT FALSE ,
  `Content` LONGTEXT NOT NULL ,
  PRIMARY KEY (`PublicationID`, `RevisionNumber`) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  INDEX `AuthorID_FK_idx` (`AuthorID` ASC) ,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `AuthorID_FK`
    FOREIGN KEY (`AuthorID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`ConfirmationKey`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`ConfirmationKey` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`ConfirmationKey` (
  `UserID` INTEGER NOT NULL ,
  `Action` TINYINT UNSIGNED NOT NULL ,
  `GenerationDate` DATETIME NOT NULL ,
  `Key` CHAR(23) NOT NULL ,
  PRIMARY KEY (`UserID`, `Action`) ,
  INDEX `UserID_FK_idx` (`UserID` ASC) ,
  CONSTRAINT `UserID_FK`
    FOREIGN KEY (`UserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Comment` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Comment` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `PublicationID` INTEGER NOT NULL ,
  `AuthorID` INTEGER NOT NULL ,
  `IpAddress` VARCHAR(39) NOT NULL ,
  `CommentDate` DATETIME NOT NULL ,
  `Status` TINYINT UNSIGNED NOT NULL ,
  `ParentID` INTEGER NULL DEFAULT -1 ,
  `ParentTreeCount` TINYINT NULL DEFAULT 0 ,
  `Content` LONGTEXT NOT NULL ,
  PRIMARY KEY (`ID`) ,
  INDEX `ParentID_FK_idx` (`ParentID` ASC) ,
  INDEX `AuthorID_FK_idx` (`AuthorID` ASC) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `AuthorID_FK`
    FOREIGN KEY (`AuthorID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ParentID_FK`
    FOREIGN KEY (`ParentID` )
    REFERENCES `skywoddmaindb`.`Comment` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`PublicationBundle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`PublicationBundle` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`PublicationBundle` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Title` VARCHAR(255) NOT NULL ,
  `Permalink` VARCHAR(255) NOT NULL ,
  `Brief` TEXT NULL DEFAULT '' ,
  `PublishDate` DATETIME NOT NULL ,
  `Status` TINYINT UNSIGNED NOT NULL ,
  `Sticky` TINYINT(1) NULL DEFAULT FALSE ,
  `PageCount` INTEGER NULL DEFAULT 0 ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Permalink_UNIQUE` (`Permalink` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`BundleAssociation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`BundleAssociation` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`BundleAssociation` (
  `BundleID` INTEGER NOT NULL ,
  `PublicationID` INTEGER NOT NULL ,
  `PageNumber` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`BundleID`, `PublicationID`) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  INDEX `BundleID_FK_idx` (`BundleID` ASC) ,
  CONSTRAINT `BundleID_FK`
    FOREIGN KEY (`BundleID` )
    REFERENCES `skywoddmaindb`.`PublicationBundle` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`Mimetype`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`Mimetype` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`Mimetype` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `Mimetype` VARCHAR(255) NULL ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Mimetype_UNIQUE` (`Mimetype` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`FileAttachment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`FileAttachment` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`FileAttachment` (
  `ID` INTEGER NOT NULL AUTO_INCREMENT ,
  `RealName` VARCHAR(255) NOT NULL ,
  `Extension` VARCHAR(255) NOT NULL ,
  `Mimetype` INTEGER NOT NULL ,
  `AnonymiseFilename` TINYINT(1) NULL DEFAULT FALSE ,
  `FileSize` INTEGER UNSIGNED NOT NULL ,
  `UploadDate` DATETIME NOT NULL ,
  `UploadByUserID` INTEGER NOT NULL ,
  `Password` VARCHAR(255) NULL DEFAULT '' ,
  `Brief` TEXT NULL DEFAULT '' ,
  `LicenseID` INTEGER NOT NULL ,
  `Permalink` VARCHAR(255) NOT NULL ,
  `Status` TINYINT UNSIGNED NULL DEFAULT 0 ,
  `DownloadCount` INTEGER UNSIGNED NULL DEFAULT 0 ,
  PRIMARY KEY (`ID`) ,
  UNIQUE INDEX `Permalink_UNIQUE` (`Permalink` ASC) ,
  INDEX `MimetypeID_FK_idx` (`Mimetype` ASC) ,
  INDEX `UploadByUserID_FK_idx` (`UploadByUserID` ASC) ,
  INDEX `LicenseID_FK_idx` (`LicenseID` ASC) ,
  CONSTRAINT `MimetypeID_FK`
    FOREIGN KEY (`Mimetype` )
    REFERENCES `skywoddmaindb`.`Mimetype` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `UploadByUserID_FK`
    FOREIGN KEY (`UploadByUserID` )
    REFERENCES `skywoddmaindb`.`User` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `LicenseID_FK`
    FOREIGN KEY (`LicenseID` )
    REFERENCES `skywoddmaindb`.`License` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`ImageAttachment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`ImageAttachment` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`ImageAttachment` (
  `AttachmentID` INTEGER NOT NULL ,
  `Type` TINYINT UNSIGNED NOT NULL ,
  `Legend` VARCHAR(255) NULL DEFAULT '' ,
  `AltBrief` VARCHAR(255) NULL DEFAULT '' ,
  `Height` INT(11) NOT NULL ,
  `Width` INT(11) NOT NULL ,
  PRIMARY KEY (`AttachmentID`, `Type`) ,
  INDEX `AttachmentID_FK_idx` (`AttachmentID` ASC) ,
  CONSTRAINT `AttachmentID_FK`
    FOREIGN KEY (`AttachmentID` )
    REFERENCES `skywoddmaindb`.`FileAttachment` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`SkyduinoConversion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`SkyduinoConversion` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`SkyduinoConversion` (
  `OldPermalink` VARCHAR(255) NOT NULL ,
  `PublicationID` INTEGER NOT NULL ,
  `Status` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`OldPermalink`) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skywoddmaindb`.`PublicationMeta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skywoddmaindb`.`PublicationMeta` ;

CREATE  TABLE IF NOT EXISTS `skywoddmaindb`.`PublicationMeta` (
  `PublicationID` INTEGER NOT NULL ,
  `MetaType` TINYINT NOT NULL ,
  `SerializedValue` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`PublicationID`, `MetaType`) ,
  INDEX `PublicationID_FK_idx` (`PublicationID` ASC) ,
  CONSTRAINT `PublicationID_FK`
    FOREIGN KEY (`PublicationID` )
    REFERENCES `skywoddmaindb`.`Publication` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `skywoddmaindb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
