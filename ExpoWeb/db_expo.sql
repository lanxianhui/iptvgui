/*
Navicat MySQL Data Transfer

Source Server         : MySQLLocal
Source Server Version : 50130
Source Host           : localhost:3306
Source Database       : db_expo

Target Server Type    : MYSQL
Target Server Version : 50130
File Encoding         : 65001

Date: 2010-02-24 14:51:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for `expert`
-- ----------------------------
DROP TABLE IF EXISTS `expert`;
CREATE TABLE `expert` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `userdesc` text NOT NULL,
  `userpic` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of expert
-- ----------------------------

-- ----------------------------
-- Table structure for `friendlink`
-- ----------------------------
DROP TABLE IF EXISTS `friendlink`;
CREATE TABLE `friendlink` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `linkname` varchar(200) NOT NULL,
  `linkaddress` varchar(256) NOT NULL,
  `linkorder` bigint(20) NOT NULL,
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
  `catid` bigint(20) NOT NULL,
  `newstitle` varchar(200) NOT NULL,
  `newsdesc` text NOT NULL,
  `pubtime` datetime NOT NULL,
  `newsimg` varchar(256) NOT NULL,
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
  `catname` varchar(200) NOT NULL,
  `catorder` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of newscat
-- ----------------------------
INSERT INTO `newscat` VALUES ('1', '世博信息', '1');
INSERT INTO `newscat` VALUES ('2', '课程通告', '2');
INSERT INTO `newscat` VALUES ('3', '图文热点', '3');

-- ----------------------------
-- Table structure for `partner`
-- ----------------------------
DROP TABLE IF EXISTS `partner`;
CREATE TABLE `partner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pname` varchar(200) NOT NULL,
  `paddress` varchar(256) NOT NULL,
  `pimage` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of partner
-- ----------------------------

-- ----------------------------
-- Table structure for `service`
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `servicename` varchar(0) NOT NULL,
  `pubtime` datetime NOT NULL,
  `servicedesc` text NOT NULL,
  `rootid` bigint(20) NOT NULL,
  `catid` bigint(20) NOT NULL,
  `servicepic` varchar(200) DEFAULT NULL,
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
  `catname` varchar(200) NOT NULL,
  `rootid` bigint(20) NOT NULL,
  `catdesc` text,
  `catorder` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of servicecat
-- ----------------------------
INSERT INTO `servicecat` VALUES ('1', '活动掠影', '6', null, '2');
INSERT INTO `servicecat` VALUES ('2', '酒店住宿', '3', '<p>啊死了都快放假啊是快乐大家疯狂拉升的纠纷</p>', '1');
INSERT INTO `servicecat` VALUES ('3', '观摩线路', '3', null, '2');
INSERT INTO `servicecat` VALUES ('4', '常见问题', '3', null, '3');
INSERT INTO `servicecat` VALUES ('5', '城市科技', '4', null, '1');
INSERT INTO `servicecat` VALUES ('6', '专家队伍', '4', null, '2');
INSERT INTO `servicecat` VALUES ('7', '学习指南', '3', null, '3');
INSERT INTO `servicecat` VALUES ('8', '合作伙伴', '6', null, '1');
INSERT INTO `servicecat` VALUES ('9', '媒体报道', '5', null, '1');
INSERT INTO `servicecat` VALUES ('10', '世博特刊', '5', null, '2');
INSERT INTO `servicecat` VALUES ('11', '金牌导师', '5', null, '3');
INSERT INTO `servicecat` VALUES ('12', '背景介绍', '2', null, '1');
INSERT INTO `servicecat` VALUES ('13', '组织机构', '2', null, '2');
INSERT INTO `servicecat` VALUES ('14', '领导关怀', '2', null, '3');

-- ----------------------------
-- Table structure for `serviceroot`
-- ----------------------------
DROP TABLE IF EXISTS `serviceroot`;
CREATE TABLE `serviceroot` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rootname` varchar(200) NOT NULL,
  `rootorder` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of serviceroot
-- ----------------------------
INSERT INTO `serviceroot` VALUES ('1', '信息资讯', '1');
INSERT INTO `serviceroot` VALUES ('2', '项目概况', '2');
INSERT INTO `serviceroot` VALUES ('3', '我看世博', '3');
INSERT INTO `serviceroot` VALUES ('4', '智慧城市', '4');
INSERT INTO `serviceroot` VALUES ('5', '沟通推荐', '5');
INSERT INTO `serviceroot` VALUES ('6', '合作交流', '6');
