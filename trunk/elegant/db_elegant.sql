/*
Navicat MySQL Data Transfer

Source Server         : qsr
Source Server Version : 50130
Source Host           : localhost:3306
Source Database       : db_elegant

Target Server Type    : MYSQL
Target Server Version : 50130
File Encoding         : 65001

Date: 2010-03-17 11:09:45
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `usename` varchar(200) DEFAULT NULL,
  `usepass` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for `cases`
-- ----------------------------
DROP TABLE IF EXISTS `cases`;
CREATE TABLE `cases` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `casetitle` varchar(200) DEFAULT NULL,
  `catid` bigint(20) DEFAULT NULL,
  `casepic` varchar(256) DEFAULT NULL,
  `casedesc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cases
-- ----------------------------

-- ----------------------------
-- Table structure for `casescat`
-- ----------------------------
DROP TABLE IF EXISTS `casescat`;
CREATE TABLE `casescat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `catname` varchar(200) DEFAULT NULL,
  `catorder` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of casescat
-- ----------------------------

-- ----------------------------
-- Table structure for `consulting`
-- ----------------------------
DROP TABLE IF EXISTS `consulting`;
CREATE TABLE `consulting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of consulting
-- ----------------------------

-- ----------------------------
-- Table structure for `friendlink`
-- ----------------------------
DROP TABLE IF EXISTS `friendlink`;
CREATE TABLE `friendlink` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `linkname` varchar(200) DEFAULT NULL,
  `linkaddress` varchar(256) DEFAULT NULL,
  `linkorder` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendlink
-- ----------------------------

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `newstitle` varchar(200) DEFAULT NULL,
  `catid` bigint(20) DEFAULT NULL,
  `newsdesc` text,
  `pubtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `newsimg` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for `newscat`
-- ----------------------------
DROP TABLE IF EXISTS `newscat`;
CREATE TABLE `newscat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `catname` varchar(200) DEFAULT NULL,
  `catorder` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of newscat
-- ----------------------------

-- ----------------------------
-- Table structure for `service`
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `servicename` varchar(200) DEFAULT NULL,
  `pubtime` datetime DEFAULT NULL,
  `servicedesc` text,
  `rootid` bigint(20) DEFAULT NULL,
  `catid` bigint(20) DEFAULT NULL,
  `servicepic` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service
-- ----------------------------

-- ----------------------------
-- Table structure for `servicecat`
-- ----------------------------
DROP TABLE IF EXISTS `servicecat`;
CREATE TABLE `servicecat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `catname` varchar(200) DEFAULT NULL,
  `rootid` bigint(20) DEFAULT NULL,
  `catdesc` text,
  `catorder` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of servicecat
-- ----------------------------

-- ----------------------------
-- Table structure for `srviceroot`
-- ----------------------------
DROP TABLE IF EXISTS `srviceroot`;
CREATE TABLE `srviceroot` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rootname` varchar(200) DEFAULT NULL,
  `rootorder` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of srviceroot
-- ----------------------------
