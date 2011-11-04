CREATE DATABASE `gtisgood`;

CREATE TABLE `gtisgood`.`user`
(
  `userID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR( 255 ) ,
  `email` VARCHAR( 255 ) ,
  PRIMARY KEY (  `userID` ),
  INDEX (`email`)
);

CREATE TABLE  `gtisgood`.`schedule` (
  `schID` INT NOT NULL AUTO_INCREMENT,
  `createrID` INT NOT NULL,
  `alias` VARCHAR( 255 ) NOT NULL,
  PRIMARY KEY ( `schID` ),
  INDEX ( `createrID` )
);

CREATE TABLE `gtisgood`.`grid`
(
  `gridID` INT NOT NULL AUTO_INCREMENT,
  `data` MEDIUMTEXT NOT NULL ,
  PRIMARY KEY (  `gridID` )
);

CREATE TABLE `gtisgood`.`linktable`
(
  `schID` INT NOT NULL ,
  `gridID` INT NOT NULL ,
  `userID` INT NOT NULL ,
  INDEX (`schID`, `gridID`, `userID` )
);
