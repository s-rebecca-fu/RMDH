-- Cherry RobotFactory Database
-- Host: localhost


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- --------------------------------------------------------
DROP DATABASE IF EXISTS RobotFactory;
CREATE DATABASE RobotFactory;
USE RobotFactory;

DROP TABLE IF EXISTS token;
CREATE TABLE token (
	id int(8) NOT NULL PRIMARY KEY,
	tokenCode VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO token VALUES(1,"25d875");


--
-- Table structure for table `robots`
--

DROP TABLE IF EXISTS Robots;
CREATE TABLE Robots (
  id int(8) NOT NULL PRIMARY KEY auto_increment,
  top varchar(10) DEFAULT NULL,
  torso varchar(10) DEFAULT NULL,
  bottom varchar(10) DEFAULT NULL,
  toppic varchar(10) DEFAULT NULL,
  torsopic varchar(10) DEFAULT NULL,
  bottompic varchar(10) DEFAULT NULL,
  date date DEFAULT NULL,
  price int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `robots`
--


-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS Parts;
CREATE TABLE Parts (
  id int(8) NOT NULL PRIMARY KEY auto_increment,
  ca varchar(10) NOT NULL,
  pic varchar(10) DEFAULT NULL,
  plant varchar(20) DEFAULT NULL,
  date date DEFAULT NULL,
  unitprice int(10) DEFAULT NULL,
  type varchar(20) DEFAULT NULL,
  line varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS Histories;
CREATE TABLE Histories (
  id int NOT NULL PRIMARY KEY auto_increment,
  type varchar(20) DEFAULT NULL,
  partstype varchar(1024) DEFAULT NULL,
  date varchar(40) DEFAULT NULL,
  price int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
