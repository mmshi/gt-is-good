CREATE DATABASE `gtisgood`;

CREATE TABLE `gtisgood`.`user`
(
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR( 255 ) ,
  PRIMARY KEY (  `id` ),
  INDEX (`username`)
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
