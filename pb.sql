/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : pb

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-10-17 17:58:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `book_type` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('1', '平凡的时间', '平凡的时间', '1', '2017-09-20 13:56:24', '2017-09-20 13:56:26', '1', '2017-09-12');
INSERT INTO `book` VALUES ('3', '分解', '分红', null, '2017-09-23 09:07:04', '2017-09-23 09:07:04', null, '2017-09-23');
INSERT INTO `book` VALUES ('10', '分解', '分红', null, '2017-09-23 09:07:39', '2017-09-23 09:07:39', null, '2017-09-23');
INSERT INTO `book` VALUES ('11', '嗨或或或或或或', '会很还很嗨或或或或或或或或或或或或或或或或或或或或', null, '2017-09-23 09:08:05', '2017-09-29 03:36:14', null, '2017-09-23');
INSERT INTO `book` VALUES ('12', '简介', '急急急', null, '2017-09-23 09:09:08', '2017-09-23 09:09:08', null, '2017-09-23');
INSERT INTO `book` VALUES ('13', '哈哈哈', '哈哈哈哈', null, '2017-09-23 09:09:27', '2017-09-23 09:09:27', null, '2017-09-23');
INSERT INTO `book` VALUES ('17', '烽火', '烽火烽火', null, '2017-09-23 09:22:35', '2017-09-23 09:22:35', null, '2017-09-23');
INSERT INTO `book` VALUES ('18', '烽火', '烽火烽火', null, '2017-09-23 09:22:37', '2017-09-23 09:22:37', null, '2017-09-23');
INSERT INTO `book` VALUES ('19', '烽火', '烽火烽火', null, '2017-09-23 09:22:39', '2017-09-23 09:22:39', null, '2017-09-23');
INSERT INTO `book` VALUES ('22', '烽火', '烽火烽火', null, '2017-09-23 09:22:44', '2017-09-23 09:22:44', null, '2017-09-23');
INSERT INTO `book` VALUES ('23', '烽火', '烽火烽火', null, '2017-09-23 09:22:46', '2017-09-23 09:22:46', null, '2017-09-23');
INSERT INTO `book` VALUES ('24', '烽火', '烽火烽火', null, '2017-09-23 09:22:47', '2017-09-23 09:22:47', null, '2017-09-23');
INSERT INTO `book` VALUES ('25', '烽火', '烽火烽火', null, '2017-09-23 09:22:50', '2017-09-23 09:22:50', null, '2017-09-23');
INSERT INTO `book` VALUES ('26', '烽火', '烽火烽火', null, '2017-09-23 09:22:52', '2017-09-23 09:22:52', null, '2017-09-23');
INSERT INTO `book` VALUES ('27', '烽火', '烽火烽火', null, '2017-09-23 09:22:53', '2017-09-23 09:22:53', null, '2017-09-23');
INSERT INTO `book` VALUES ('28', '烽火', '烽火烽火', null, '2017-09-23 09:22:55', '2017-09-23 09:22:55', null, '2017-09-23');
INSERT INTO `book` VALUES ('29', '烽火', '烽火烽火', null, '2017-09-23 09:22:57', '2017-09-23 09:22:57', null, '2017-09-23');
INSERT INTO `book` VALUES ('30', 'dcdcdcdaaaaaaaaaa', 'adsssssssssssssssssss', null, '2017-09-23 10:00:10', '2017-09-23 10:00:10', null, '2017-09-23');
INSERT INTO `book` VALUES ('31', '自由', '地方大幅度发', null, '2017-10-16 05:22:21', '2017-10-16 05:22:21', null, '2017-10-16');
INSERT INTO `book` VALUES ('32', 'test', 'fdfdfdf', null, '2017-10-16 06:43:44', '2017-10-16 06:43:44', null, '2017-10-16');
INSERT INTO `book` VALUES ('33', 'test', 'fdfdfdf', null, '2017-10-16 06:44:21', '2017-10-16 06:44:21', null, '2017-10-16');
INSERT INTO `book` VALUES ('34', 'test', 'fdfdfdf', null, '2017-10-16 06:44:31', '2017-10-16 06:44:31', null, '2017-10-16');

-- ----------------------------
-- Table structure for book_chapter
-- ----------------------------
DROP TABLE IF EXISTS `book_chapter`;
CREATE TABLE `book_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book_chapter
-- ----------------------------

-- ----------------------------
-- Table structure for book_is_tag
-- ----------------------------
DROP TABLE IF EXISTS `book_is_tag`;
CREATE TABLE `book_is_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `book_tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book_is_tag
-- ----------------------------
INSERT INTO `book_is_tag` VALUES ('1', '1', '1', '2017-10-17 11:08:33', '2017-10-17 11:08:35');
INSERT INTO `book_is_tag` VALUES ('2', '1', '3', '2017-10-17 11:08:58', '2017-10-17 11:09:00');
INSERT INTO `book_is_tag` VALUES ('3', '12', '1', '2017-10-17 06:21:44', '2017-10-17 06:21:44');
INSERT INTO `book_is_tag` VALUES ('4', '12', '3', '2017-10-17 06:21:44', '2017-10-17 06:21:44');

-- ----------------------------
-- Table structure for book_tag
-- ----------------------------
DROP TABLE IF EXISTS `book_tag`;
CREATE TABLE `book_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_tag_tag_unique` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book_tag
-- ----------------------------
INSERT INTO `book_tag` VALUES ('1', '自然', '2017-10-16 03:23:43', '2017-10-16 03:23:43');
INSERT INTO `book_tag` VALUES ('3', '科学', '2017-10-16 03:35:24', '2017-10-16 03:35:24');

-- ----------------------------
-- Table structure for book_type
-- ----------------------------
DROP TABLE IF EXISTS `book_type`;
CREATE TABLE `book_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `seq` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of book_type
-- ----------------------------

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'demo', 'ea48576f30be1669971699c09ad05c94', '123456');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('7', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('8', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('9', '2017_10_16_023436_create_book_tag_table', '1');
INSERT INTO `migrations` VALUES ('10', '2017_10_16_035532_create_book_is_tag_table', '2');

-- ----------------------------
-- Table structure for module
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(4) DEFAULT '1' COMMENT '等级',
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `introduce` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', '1', '基本信息', null, null, null);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- View structure for view_book_tag
-- ----------------------------
DROP VIEW IF EXISTS `view_book_tag`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_book_tag` AS select `book_is_tag`.`book_id` AS `book_id`,`book_is_tag`.`book_tag_id` AS `book_tag_id`,`book_tag`.`tag` AS `tag`,`book_tag`.`id` AS `id` from (`book_tag` join `book_is_tag` on((`book_is_tag`.`book_tag_id` = `book_is_tag`.`id`))) ;
