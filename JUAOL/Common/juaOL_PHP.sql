/*
 Navicat Premium Data Transfer

 Source Server         : myServer
 Source Server Type    : MySQL
 Source Server Version : 50173
 Source Host           : 172.27.1.226
 Source Database       : juaOL_PHP

 Target Server Type    : MySQL
 Target Server Version : 50173
 File Encoding         : utf-8

 Date: 04/12/2015 21:23:03 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `jua_category`
-- ----------------------------
DROP TABLE IF EXISTS `jua_category`;
CREATE TABLE `jua_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weight` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `drawn` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `jua_event`
-- ----------------------------
DROP TABLE IF EXISTS `jua_event`;
CREATE TABLE `jua_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `par_type` varchar(45) NOT NULL,
  `age_group` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `mcate` varchar(100) NOT NULL,
  `fcate` varchar(100) NOT NULL,
  `system` varchar(45) NOT NULL,
  `mat_no` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ref_no` int(11) NOT NULL,
  `activated` int(11) NOT NULL,
  `small_str` varchar(45) NOT NULL,
  `seed_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

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
  `seeding` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `failed` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ranking` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `team_id` varchar(45) NOT NULL,
  `seed_rank` int(11) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `best_result` varchar(100) NOT NULL,
  `number_of_officials` varchar(100) NOT NULL,
  `number_of_competitiors` varchar(100) NOT NULL,
  `federation` varchar(100) NOT NULL,
  `passport_no` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `adress` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `jua_user`
-- ----------------------------
DROP TABLE IF EXISTS `jua_user`;
CREATE TABLE `jua_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
