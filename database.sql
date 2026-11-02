-- database.sql
-- Import this in phpMyAdmin (Import tab) or run it in the SQL tab.

CREATE DATABASE IF NOT EXISTS phpcrud
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE phpcrud;

CREATE TABLE IF NOT EXISTS tblusers (
  ID           INT(10)      NOT NULL AUTO_INCREMENT,
  FirstName    VARCHAR(200) NOT NULL,
  LastName     VARCHAR(200) NOT NULL,
  MobileNumber BIGINT(10)   NOT NULL,
  Email        VARCHAR(200) NOT NULL,
  Address      MEDIUMTEXT   NOT NULL,
  CreationDate TIMESTAMP    NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
