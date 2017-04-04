/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : db_glam

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-15 14:00:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_status_payment
-- ----------------------------
DROP TABLE IF EXISTS `t_status_payment`;
CREATE TABLE `t_status_payment` (
  `status_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_payment_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`status_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_status_payment
-- ----------------------------
INSERT INTO `t_status_payment` VALUES ('1', 'PENDING', null, null);
INSERT INTO `t_status_payment` VALUES ('2', 'CONFIRMATION', null, null);
INSERT INTO `t_status_payment` VALUES ('3', 'CLOSE', null, null);
INSERT INTO `t_status_payment` VALUES ('4', 'BOOKED', null, null);
INSERT INTO `t_status_payment` VALUES ('5', 'CANCEL', null, null);
