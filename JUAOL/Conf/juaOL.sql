/*
 Navicat Premium Data Transfer

 Source Server         : pubServer
 Source Server Type    : MySQL
 Source Server Version : 50173
 Source Host           : 103.249.252.165
 Source Database       : juaOL

 Target Server Type    : MySQL
 Target Server Version : 50173
 File Encoding         : utf-8

 Date: 04/28/2015 20:03:17 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `jua_event`
-- ----------------------------
DROP TABLE IF EXISTS `jua_event`;
CREATE TABLE `jua_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organizer` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `mcate` varchar(100) DEFAULT NULL,
  `fcate` varchar(100) DEFAULT NULL,
  `hosted_by` varchar(100) DEFAULT NULL,
  `venue` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `jua_event`
-- ----------------------------
BEGIN;
INSERT INTO `jua_event` VALUES ('1', 'JUDO UNION OF ASIA', '13 to 15 May 2015', '-60kg,-66kg,-73kg,-81kg,-90kg,-100kg,+100kg', null, 'Kuwait Judo Federation ( KUW )', ' .Al Qadisiyah Club Indoor Stadium, Hawalli., Kuwait', 'Asian Senior Judo Championships 2015'), ('2', 'XMU', '14 to 19 May 2015', '-50kg,-55kg,-60kg,-65kg,-70kg,-75kg,+100kg', null, 'XMU', null, 'XMUJUA');
COMMIT;

-- ----------------------------
--  Table structure for `jua_person`
-- ----------------------------
DROP TABLE IF EXISTS `jua_person`;
CREATE TABLE `jua_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(100) NOT NULL,
  `family_name` varchar(255) NOT NULL,
  `given_name` varchar(255) NOT NULL,
  `simple_name` varchar(255) NOT NULL,
  `identity_num` varchar(255) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `groupe` varchar(100) NOT NULL,
  `category` varchar(45) NOT NULL,
  `edit_time` date NOT NULL,
  `create_time` date NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `best_result` varchar(100) NOT NULL,
  `passport_no` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `jua_person`
-- ----------------------------
BEGIN;
INSERT INTO `jua_person` VALUES ('5', '', 'Jiang', 'Xian', 'JX', '2015-04-15', 'male', 'VVIP', 'hh', '2015-04-26', '0000-00-00', '/juaOL/JUAOL/Resource/img/person_img/1429680825_1848855972.png', '2015-04-09', '', '1245'), ('6', '', 'LI', 'BO', 'LB', '', 'male', 'Catering', 'hh', '2015-04-20', '0000-00-00', '/juaOL/JUAOL/Resource/img/person_img/1429416766_1398778467.jpg', '2015-04-28', '', ''), ('7', '', 'LI', 'Ren', 'LB', '', 'hh', 'hh', 'hh', '0000-00-00', '0000-00-00', '', '0000-00-00', '', ''), ('8', '', 'ss', 'cc', 'sc', '', 'male', 'Catering', 'hh', '2015-04-20', '2015-04-13', '', '2015-04-23', '', ''), ('9', '', 'LI', 'Xian', 'JX', '', 'hh', 'hh', 'hh', '0000-00-00', '0000-00-00', '', '0000-00-00', '', ''), ('10', '', 'Jiang', 'Ren', '', '', 'hh', 'hh', 'hh', '2015-04-13', '2015-04-13', '', '0000-00-00', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `jua_user`
-- ----------------------------
DROP TABLE IF EXISTS `jua_user`;
CREATE TABLE `jua_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `power` tinyint(4) NOT NULL DEFAULT '2',
  `eventName` int(11) NOT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `federation` varchar(100) DEFAULT NULL,
  `number_of_officials` varchar(11) DEFAULT NULL,
  `number_of_competitiors` varchar(11) DEFAULT NULL,
  `category_info` varchar(255) DEFAULT NULL,
  `fax` varchar(11) DEFAULT NULL,
  `men_team` tinyint(4) DEFAULT NULL,
  `women_team` tinyint(4) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `jua_user`
-- ----------------------------
BEGIN;
INSERT INTO `jua_user` VALUES ('1', 'admin', '23fe0d6e1ae0b13e97b0d396cb2528a0', 'CHN', null, '0', '0', null, null, null, null, null, null, null, null, null, '0000-00-00 00:00:00'), ('2', 'jx', '71e4d0554bb5f5c000c0c9aadaa525d6', 'USA', '15604510369', '1', '1', '??2', 'Asian Judo', '12', '20', null, '0592-854712', '0', '0', 'abcdko123321@163.com', '0000-00-00 00:00:00'), ('7', 'test2', '23', 'sa', '3456', '2', '0', null, 'sdvd', null, null, null, null, null, null, '23rg', '0000-00-00 00:00:00'), ('6', 'test', 'asd', 'sad', '12312', '2', '0', null, 'asfas', null, null, null, null, null, null, 'asd', '0000-00-00 00:00:00'), ('8', '12', '124', '12r', '124124', '2', '0', null, '1wfwef', null, null, null, null, null, null, 'wefew', '0000-00-00 00:00:00'), ('9', 'testAgain', 'e10adc3949ba59abbe56e057f20f883e', '', '1391287412', '2', '0', null, 'BJ', null, null, null, null, null, null, 'asfa@dad.ava', '0000-00-00 00:00:00'), ('11', 'jiangxian', '0cc175b9c0f1b6a831c399e269772661', '', null, '2', '0', null, 's', null, null, null, null, null, null, null, '2015-04-26 21:12:16');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
