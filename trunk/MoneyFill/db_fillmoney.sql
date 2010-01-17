/*
Navicat MySQL Data Transfer

Source Server         : MySQLLocal
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : db_fillmoney

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2010-01-18 07:56:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `fm_card`
-- ----------------------------
DROP TABLE IF EXISTS `fm_card`;
CREATE TABLE `fm_card` (
  `id` bigint(20) NOT NULL auto_increment,
  `cardnumber` varchar(255) NOT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `createtime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_card
-- ----------------------------
INSERT INTO `fm_card` VALUES ('1', '11', '11', '2', '2010-01-17 14:55:34');
INSERT INTO `fm_card` VALUES ('2', '13', '12', '2', '2010-01-17 14:58:09');
INSERT INTO `fm_card` VALUES ('3', '451236', '1590096555', '2', '2010-01-17 18:50:34');
INSERT INTO `fm_card` VALUES ('4', '12345678', '15922355441', '2', '2010-01-17 20:01:21');
INSERT INTO `fm_card` VALUES ('5', '12345678', '15922355441', '2', '2010-01-17 20:04:27');
INSERT INTO `fm_card` VALUES ('6', '12345678', '15922355441', '2', '2010-01-17 20:05:01');
INSERT INTO `fm_card` VALUES ('7', '12345678', '15922355441', '2', '2010-01-17 20:05:15');
INSERT INTO `fm_card` VALUES ('8', '12345678', '15922355441', '2', '2010-01-17 20:05:37');
INSERT INTO `fm_card` VALUES ('9', '12345678', '15922355441', '2', '2010-01-17 20:05:54');
INSERT INTO `fm_card` VALUES ('10', '12345678', '15922355441', '2', '2010-01-17 20:05:56');
INSERT INTO `fm_card` VALUES ('11', '12345678', '15922355441', '2', '2010-01-17 20:05:57');
INSERT INTO `fm_card` VALUES ('12', '12345678', '15922355441', '2', '2010-01-17 20:05:57');
INSERT INTO `fm_card` VALUES ('13', '124561', '15922644115', '2', '2010-01-17 20:06:06');
INSERT INTO `fm_card` VALUES ('14', '124561', '15922644115', '2', '2010-01-17 20:06:25');
INSERT INTO `fm_card` VALUES ('15', '124561', '15922644115', '2', '2010-01-17 20:06:48');
INSERT INTO `fm_card` VALUES ('16', '123456', '11111111111', '2', '2010-01-17 20:43:39');
INSERT INTO `fm_card` VALUES ('17', '99', '11111111111', '2', '2010-01-17 23:28:47');

-- ----------------------------
-- Table structure for `fm_order`
-- ----------------------------
DROP TABLE IF EXISTS `fm_order`;
CREATE TABLE `fm_order` (
  `id` bigint(20) NOT NULL auto_increment,
  `linenumber` varchar(200) NOT NULL,
  `cardnumber` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `ordertime` datetime NOT NULL,
  `modifytime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_order
-- ----------------------------
INSERT INTO `fm_order` VALUES ('1', '123456', '123456', '111.22', '0', '2', '2010-01-17 15:37:31', '2010-01-17 15:37:31');
INSERT INTO `fm_order` VALUES ('2', '123456', '123456', '22.36', '0', '2', '2010-01-17 18:53:11', '2010-01-17 18:53:11');
INSERT INTO `fm_order` VALUES ('3', '123456', '123456', '22.30', '0', '2', '2010-01-17 18:53:22', '2010-01-17 18:53:22');
INSERT INTO `fm_order` VALUES ('4', '123456', '123456', '22.30', '0', '2', '2010-01-17 20:20:17', '2010-01-17 20:20:17');
INSERT INTO `fm_order` VALUES ('5', '123456', '123456', '22.35', '0', '2', '2010-01-17 20:28:01', '2010-01-17 20:28:01');
INSERT INTO `fm_order` VALUES ('6', '123456', '111111', '12.30', '0', '2', '2010-01-17 20:28:13', '2010-01-17 20:28:13');
INSERT INTO `fm_order` VALUES ('7', '123456', '111111', '124.30', '0', '2', '2010-01-17 20:42:52', '2010-01-17 20:42:52');
INSERT INTO `fm_order` VALUES ('8', '123456', '11111111111', '99.00', '0', '2', '2010-01-17 23:29:34', '2010-01-17 23:29:34');

-- ----------------------------
-- Table structure for `fm_user`
-- ----------------------------
DROP TABLE IF EXISTS `fm_user`;
CREATE TABLE `fm_user` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `usersort` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_user
-- ----------------------------
INSERT INTO `fm_user` VALUES ('1', 'admin', '111111', '0');
INSERT INTO `fm_user` VALUES ('2', 'yanghuan', '123456', '1');
INSERT INTO `fm_user` VALUES ('5', 'ykk', '111111', '1');
