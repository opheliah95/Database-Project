#defines the database
DROP DATABASE IF EXISTS VehicleDB;
CREATE DATABASE VehicleDB;
SET NAMES utf8;
USE VehicleDB;

# offence table
CREATE TABLE Offence (
  Offence_ID INT NOT NULL AUTO_INCREMENT,
  Offence_Description VARCHAR(50) NOT NULL,
  Offence_MaxFine INT NOT NULL,
  Offence_MaxPoints INT NOT NULL,
  CONSTRAINT pk_Offence PRIMARY KEY(Offence_ID)
);

# People table
CREATE TABLE People (
  People_ID INT NOT NULL AUTO_INCREMENT,
  People_Name VARCHAR(50) NOT NULL,
  People_Address VARCHAR(50) DEFAULT NULL,
  People_Licence VARCHAR(50) DEFAULT NULL,
  CONSTRAINT pk_People PRIMARY KEY(People_ID)
);

# Vehicle table
CREATE TABLE Vehicle (
  Vehicle_ID INT NOT NULL AUTO_INCREMENT,
  Vehicle_Type VARCHAR(20) NOT NULL,
  Vehicle_Colour VARCHAR(20) NOT NULL,
  Vehicle_Licence VARCHAR(7) DEFAULT NULL,
  CONSTRAINT pk_Vehicle PRIMARY KEY(Vehicle_ID)
);

# Vehicle ownership relation
CREATE TABLE Ownership (
  People_ID INT NOT NULL,
  Vehicle_ID INT NOT NULL,
  CONSTRAINT fk_People FOREIGN KEY(People_ID)
  REFERENCES People (People_ID),
  CONSTRAINT fk_Vehicle FOREIGN KEY(Vehicle_ID)
  REFERENCES Vehicle (Vehicle_ID)
);

CREATE TABLE Officer (
Officer_ID INT NOT NULL AUTO_INCREMENT,
Officer_Username VARCHAR(50) NOT NULL,
Officer_Role VARCHAR(20) NOT NULL,
Officer_Password VARCHAR(40) NOT NULL,
CONSTRAINT pk_Office PRIMARY KEY(Officer_ID),
CONSTRAINT ck_Unique UNIQUE(Officer_Username)
);

CREATE TABLE Incident (
  Incident_ID INT NOT NULL AUTO_INCREMENT,
  Vehicle_ID INT DEFAULT NULL,
  People_ID INT DEFAULT NULL,
  Incident_Date DATE NOT NULL,
  Incident_Report VARCHAR(500) NOT NULL,
  Offence_ID INT DEFAULT NULL,
  Officer_ID INT NOT NULL,
  CONSTRAINT pk_Incident PRIMARY KEY(Incident_ID),
  CONSTRAINT fk_Vehicle02 FOREIGN KEY (Vehicle_ID)
  REFERENCES Vehicle (Vehicle_ID),
  CONSTRAINT fk_People02 FOREIGN KEY (People_ID)
  REFERENCES People (People_ID),
  CONSTRAINT fk_Officer FOREIGN KEY (Officer_ID)
  REFERENCES Officer (Officer_ID)
);

ALTER TABLE Incident
  ADD Incident_Time Time NULL;

CREATE TABLE Fines (
  Fines_ID INT NOT NULL AUTO_INCREMENT,
  Fines_Amount INT NOT NULL,
  Fines_Points INT NOT NULL,
  Incident_ID INT NOT NULL,
  CONSTRAINT pk_Fine PRIMARY KEY(Fines_ID),
  CONSTRAINT fk_Incident FOREIGN KEY (Incident_ID)
  REFERENCES Incident (Incident_ID)
);


# Alter auto_increment values as in example database

ALTER TABLE Fines
AUTO_INCREMENT = 4;

ALTER TABLE Offence
AUTO_INCREMENT = 14;

ALTER TABLE People
AUTO_INCREMENT = 16;

ALTER TABLE Vehicle
AUTO_INCREMENT = 24;

ALTER TABLE Incident
AUTO_INCREMENT = 6;

ALTER TABLE Officer
AUTO_INCREMENT = 26;