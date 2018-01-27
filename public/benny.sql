/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : benny

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-27 16:24:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for benny_admin
-- ----------------------------
DROP TABLE IF EXISTS `benny_admin`;
CREATE TABLE `benny_admin` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `pwd` varchar(200) DEFAULT NULL,
  `nick` varchar(200) DEFAULT NULL,
  `login_time` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `imgurl` varchar(255) DEFAULT NULL COMMENT '头像地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of benny_admin
-- ----------------------------
INSERT INTO `benny_admin` VALUES ('1', 'admin', '698d51a19d8a121ce581499d7b701668', '夜凝', '1517028987', '1', null);
