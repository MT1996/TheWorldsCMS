CREATE TABLE IF NOT EXISTS `theworldscms_rolle`
(
  `ID`          INTEGER      NOT NULL,
  `Name`        VARCHAR(255) NOT NULL,
  `Privilegien` INTEGER      NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE IF NOT EXISTS `theworldscms_project`
(
  `ID`               INTEGER      NOT NULL AUTO_INCREMENT,
  `Name`             varchar(255) NOT NULL,
  `Erstellungsdatum` DATE         NOT NULL,
  PRIMARY KEY(`ID`)
);

CREATE TABLE IF NOT EXISTS `theworldscms_user`
(
  `ID`               INTEGER      NOT NULL AUTO_INCREMENT,
  `Vorname`          varchar(255) NOT NULL,
  `Nachname`         VARCHAR(255) NOT NULL,
  `Email`            VARCHAR(255) NOT NULL,
  `Passwort`         varchar(255) NOt null,
  `AuthorizationKey` varchar(255) NOT NULL,
  `RollenNamen`      INTEGER      not null,
  PRIMARY KEY(`ID`),
  FOREIGN KEY(`RollenNamen`) REFERENCES theworldscms_rolle(`ID`)
);

CREATE TABLE IF NOT EXISTS `theworldscms_projekt_has_user`
(
  `ProjektID` INTEGER,
  `UserID`    INTEGER,
  PRIMARY KEY(`ProjektID`,`UserID`),
  FOREIGN KEY(`ProjektID`) REFERENCES theworldscms_project(`ID`),
  FOREIGN KEY(`UserID`) REFERENCES theworldscms_user(`ID`)
);

CREATE TABLE IF NOT EXISTS `theworldscms_session` (
  `ID`               INTEGER      NOT NULL AUTO_INCREMENT,
  `Erstellungsdatum` DATETIME     NOT NULL,
  `SessionID`        VARCHAR(255) NOT NULL,
  `UserID`           INTEGER      NOT NULL,
  PRIMARY KEY(`ID`),
  FOREIGN KEY(`UserID`) REFERENCES theworldscms_user(`ID`)
);

SELECT NOT EXISTS(SELECT * FROM theworldscms_user);

SELECT NOT EXISTS(SELECT * FROM theworldscms_rolle);

SELECT NOT EXISTS(SELECT * FROM theworldscms_project);

SELECT NOT EXISTS(SELECT * FROM theworldscms_projekt_has_user);

SELECT NOT EXISTS(SELECT * FROM theworldscms_session);