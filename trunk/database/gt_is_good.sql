CREATE DATABASE `gtisgood`;

CREATE TABLE `gtisgood`.`user`
(
  `userID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR( 255 ) ,
  `email` VARCHAR( 255 ) ,
  `password` VARCHAR( 255 ),
  `fromTSquare` BOOL ,
  PRIMARY KEY (  `userID` ),
  INDEX (`email`)
);

CREATE TABLE  `gtisgood`.`schedule` (
  `schID` INT NOT NULL AUTO_INCREMENT,
  `startDate` DATETIME NOT NULL,
  `endDate` DATETIME NOT NULL,
  `createrID` INT NOT NULL,
  `alias` VARCHAR( 255 ) NOT NULL,
  `periodType` ENUM(  '30min',  '1hour',  '1day' ) NOT NULL,
  PRIMARY KEY ( `schID` ),
  INDEX ( `createrID` )
);

CREATE TABLE `gtisgood`.`grid`
(
  `gridID` INT NOT NULL AUTO_INCREMENT,
  `data` MEDIUMTEXT NOT NULL ,
  `comments` VARCHAR( 255 ) ,
  PRIMARY KEY (  `gridID` )
);

CREATE TABLE `gtisgood`.`linktable`
(
  `schID` INT NOT NULL ,
  `gridID` INT NOT NULL ,
  `userID` INT NOT NULL ,
  `type` ENUM(  'constraint',  'userSchedule' ) NOT NULL,
  INDEX (`schID`, `gridID`, `userID` )
);
