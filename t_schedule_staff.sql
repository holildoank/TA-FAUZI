/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : db_glam

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-03 15:36:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_schedule_staff
-- ----------------------------
DROP TABLE IF EXISTS `t_schedule_staff`;
CREATE TABLE `t_schedule_staff` (
  `schedule_staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `schedule_starttime` datetime DEFAULT NULL,
  `schedule_enddatime` datetime DEFAULT NULL,
  `schedule_active` varchar(11) DEFAULT 'y',
  `schedule_status` varchar(50) DEFAULT 'open',
  `schedule_createby` int(11) DEFAULT NULL,
  `schedule_createat` datetime DEFAULT NULL,
  `schedule_updateby` int(11) DEFAULT NULL,
  `schedule_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`schedule_staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_schedule_staff
-- ----------------------------
INSERT INTO `t_schedule_staff` VALUES ('1', '1', '2016-10-12 13:15:22', '2016-10-25 13:15:29', 't', 'open', '1', '2016-10-26 13:15:34', '1', '2016-10-18 13:21:24');
INSERT INTO `t_schedule_staff` VALUES ('2', '4', '2016-10-15 08:00:00', '2016-10-25 12:00:00', 'y', 'open', '1', '2016-10-03 14:15:26', '1', '2016-10-03 15:20:45');
INSERT INTO `t_schedule_staff` VALUES ('3', '1', '2016-10-15 07:00:00', '2016-10-25 06:10:00', 'y', 'open', '1', '2016-10-03 14:32:57', '1', '2016-10-03 15:19:14');
INSERT INTO `t_schedule_staff` VALUES ('4', '1', '2016-10-15 13:10:00', '2016-10-11 14:25:00', 'y', 'open', '1', '2016-10-03 14:36:50', '1', '2016-10-03 15:20:03');
