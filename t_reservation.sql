/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : db_glam

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-15 14:02:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_reservation
-- ----------------------------
DROP TABLE IF EXISTS `t_reservation`;
CREATE TABLE `t_reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reservation_startdatetime` datetime DEFAULT NULL,
  `reservation_enddatetime` datetime DEFAULT NULL,
  `status_payment_id` int(11) DEFAULT NULL,
  `reservation_status` char(30) DEFAULT NULL,
  `reservation_methode` varchar(255) DEFAULT NULL,
  `reservation_amount_paid` varchar(50) DEFAULT NULL,
  `reservation_request` varchar(255) DEFAULT NULL,
  `reservation_number` varchar(225) DEFAULT NULL,
  `reservation_active` varchar(10) DEFAULT 'y',
  `reservation_createby` int(11) DEFAULT NULL,
  `reservation_endtime_confir` datetime DEFAULT NULL,
  `reservation_createat` datetime DEFAULT NULL,
  `reservation_updateby` int(11) DEFAULT NULL,
  `reservation_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_reservation
-- ----------------------------
INSERT INTO `t_reservation` VALUES ('1', '1', '1', '2016-10-15 09:45:00', '2016-10-15 10:15:00', '5', 'cancel', null, null, null, '16538', 'y', null, '2016-10-15 10:43:00', '2016-10-15 09:43:47', null, '2016-10-15 10:43:02');
INSERT INTO `t_reservation` VALUES ('5', '1', '2', '2016-10-15 07:00:00', '2016-10-15 07:40:00', '5', 'cancel', null, null, null, '165792', 'y', null, '2016-10-15 12:27:00', '2016-10-15 11:27:59', null, '2016-10-15 12:27:03');
INSERT INTO `t_reservation` VALUES ('6', '3', '2', '2016-10-15 13:00:00', '2016-10-15 13:40:00', '5', 'cancel', null, null, null, '165756', 'y', null, '2016-10-15 12:47:00', '2016-10-15 11:47:15', null, '2016-10-15 12:47:01');
