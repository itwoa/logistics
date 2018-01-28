/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost:3306
 Source Schema         : benny

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : 65001

 Date: 28/01/2018 20:28:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
  `acc_type` int(1) DEFAULT '0' COMMENT '账号类型',
  `acc_attr` int(1) DEFAULT '1' COMMENT '账号属性',
  `state` int(1) NOT NULL DEFAULT '1' COMMENT '账号状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员列表';

-- ----------------------------
-- Records of benny_admin
-- ----------------------------
BEGIN;
INSERT INTO `benny_admin` VALUES (1, 'admin', '698d51a19d8a121ce581499d7b701668', '夜凝', '1517129780', 1, NULL, 0, 0, 1);
INSERT INTO `benny_admin` VALUES (2, 'eeee', 'fff', 'kjjjK', NULL, 1, NULL, 1, 0, 1);
INSERT INTO `benny_admin` VALUES (3, 'hjhfhhf', '8888', '账上', NULL, 1, NULL, 1, 0, 1);
INSERT INTO `benny_admin` VALUES (4, '809808', '000', '80989080', NULL, 1, NULL, 1, 0, 1);
INSERT INTO `benny_admin` VALUES (5, '特儿童', '698d51a19d8a121ce581499d7b701668', '测试一下', NULL, 1, NULL, 1, 1, 1);
INSERT INTO `benny_admin` VALUES (6, 'dddd', '2be9bd7a3434f7038ca27d1918de58bd', 'weqwe', NULL, 1, NULL, 1, 0, 1);
INSERT INTO `benny_admin` VALUES (7, 'sdfsd', '550a141f12de6341fba65b0ad0433500', 'ewew', NULL, 1, NULL, 1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for benny_apply
-- ----------------------------
DROP TABLE IF EXISTS `benny_apply`;
CREATE TABLE `benny_apply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `namee` varchar(32) DEFAULT NULL COMMENT '申请人姓名',
  `tel` varchar(12) DEFAULT NULL COMMENT '联系电话',
  `goods_id` varchar(50) DEFAULT NULL COMMENT '申请物品编号',
  `aid` int(5) DEFAULT NULL COMMENT '操作账号ID',
  `timee` varchar(50) DEFAULT NULL COMMENT '操作时间',
  `status1` int(1) NOT NULL DEFAULT '0' COMMENT '管理员审核状态',
  `status2` int(1) NOT NULL DEFAULT '0' COMMENT '总管理员审核状态',
  `receive` int(1) NOT NULL DEFAULT '0' COMMENT '领取状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='申请列表';

-- ----------------------------
-- Table structure for benny_article
-- ----------------------------
DROP TABLE IF EXISTS `benny_article`;
CREATE TABLE `benny_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_tit` varbinary(200) NOT NULL COMMENT '标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `description` varchar(100) DEFAULT NULL COMMENT '描述',
  `tags` varchar(100) DEFAULT NULL COMMENT '标签',
  `content` text COMMENT '内容',
  `timee` varchar(20) DEFAULT NULL COMMENT '发布时间',
  `views` int(6) NOT NULL DEFAULT '1' COMMENT '阅读数',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `flag` int(1) DEFAULT '0' COMMENT '置顶',
  `tuijian` int(1) DEFAULT NULL COMMENT '推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章公告';

-- ----------------------------
-- Records of benny_article
-- ----------------------------
BEGIN;
INSERT INTO `benny_article` VALUES (1, 0x7366736466, 'sdfsdf', 'dsfsfs', 'sdfdsf', '<p>sdfsdf</p><p>sdfsf</p>', '1515677037', 0, 0, 0, NULL);
COMMIT;

-- ----------------------------
-- Table structure for benny_goods
-- ----------------------------
DROP TABLE IF EXISTS `benny_goods`;
CREATE TABLE `benny_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `namee` varchar(32) DEFAULT NULL COMMENT '名称',
  `desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `nums` int(5) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='物品管理';

-- ----------------------------
-- Records of benny_goods
-- ----------------------------
BEGIN;
INSERT INTO `benny_goods` VALUES (1, 0, 1, 2, '其他物品', NULL, NULL);
INSERT INTO `benny_goods` VALUES (2, 0, 1, 0, '办公用品', NULL, NULL);
INSERT INTO `benny_goods` VALUES (3, 0, 1, 0, '生活用品', NULL, NULL);
INSERT INTO `benny_goods` VALUES (4, 2, 1, 0, '打印机', NULL, 5);
INSERT INTO `benny_goods` VALUES (5, 3, 1, 0, '警服', NULL, 20);
INSERT INTO `benny_goods` VALUES (6, 2, 1, 0, '笔记本电脑', NULL, 10);
COMMIT;

-- ----------------------------
-- Table structure for benny_logs
-- ----------------------------
DROP TABLE IF EXISTS `benny_logs`;
CREATE TABLE `benny_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT NULL COMMENT '关联账号ID',
  `content` varchar(200) DEFAULT NULL COMMENT '操作内容',
  `timee` varchar(60) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Table structure for benny_sysinfo
-- ----------------------------
DROP TABLE IF EXISTS `benny_sysinfo`;
CREATE TABLE `benny_sysinfo` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(200) NOT NULL,
  `copyright` varchar(200) NOT NULL,
  `site_tools` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统信息';

-- ----------------------------
-- Records of benny_sysinfo
-- ----------------------------
BEGIN;
INSERT INTO `benny_sysinfo` VALUES (1, '夜凝博客', 'PHP,编程', '键盘敲得烂，月薪能上万。键盘落灰尘，狗屎一大堆', '/upload/20171126/1511704558456.png', '© Copy Right Benny Blog 2018 版权所有.', 'qweqwe');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
