/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : db_glam

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-17 19:33:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_service
-- ----------------------------
DROP TABLE IF EXISTS `m_service`;
CREATE TABLE `m_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) DEFAULT NULL,
  `service_desc` varchar(255) DEFAULT NULL,
  `service_active` char(1) DEFAULT 'y',
  `service_createby` int(11) DEFAULT NULL,
  `service_jenis` varchar(255) DEFAULT NULL,
  `service_createat` datetime DEFAULT NULL,
  `sevice_updateby` int(11) DEFAULT NULL,
  `service_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_service
-- ----------------------------
INSERT INTO `m_service` VALUES ('1', 'HAIR', 'perawatan yang membuat seseorang tambah kinclong', 'y', '1', 'OUR SERVICES', '2016-09-30 13:11:29', null, null);
INSERT INTO `m_service` VALUES ('2', 'MAKE UP', 'Make Up adalah perawatan  mempercantik diri', 'y', '1', 'OUR SERVICES', '2016-09-30 13:16:52', null, null);
INSERT INTO `m_service` VALUES ('3', 'TREATMENT', 'adalah semua tindakan yang membuat seseorang menerima pelayan terbaik', 'y', '1', 'OUR SERVICES', '2016-09-30 13:17:53', null, null);
INSERT INTO `m_service` VALUES ('4', 'rgeger', 'regere', 'y', '1', 'OUR CREATIONS', '2016-10-13 08:36:44', null, null);
INSERT INTO `m_service` VALUES ('5', 'fwefwe', 'ewfwefwe', 'y', '1', 'OUR CREATIONS', '2016-10-13 08:37:51', null, null);

-- ----------------------------
-- Table structure for m_staff
-- ----------------------------
DROP TABLE IF EXISTS `m_staff`;
CREATE TABLE `m_staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(255) DEFAULT NULL,
  `staff_gender` char(1) DEFAULT NULL,
  `staff_address` varchar(255) DEFAULT NULL,
  `staff_tlp` varchar(255) DEFAULT NULL,
  `staff_photo` varchar(255) DEFAULT NULL,
  `staff_position` varchar(255) DEFAULT NULL,
  `staff_active` char(1) DEFAULT 'y',
  `staff_createby` int(11) DEFAULT NULL,
  `staff_createat` datetime DEFAULT NULL,
  `staff_updateby` int(11) DEFAULT NULL,
  `staff_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_staff
-- ----------------------------
INSERT INTO `m_staff` VALUES ('1', 'Rizal', 'M', 'Surabaya Kota Jatim', '081912237737', '32.jpg', 'Staff It Programmer', 'y', '1', '2016-09-30 13:07:52', '1', '2016-10-06 13:58:09');
INSERT INTO `m_staff` VALUES ('2', 'fariz S.Kom', 'M', 'Surabaya Kota Jatim', '081913707356', '22_thumb1.jpg', 'Staff It Programmer', 'y', '1', '2016-09-30 13:09:31', '1', '2016-10-06 14:07:22');
INSERT INTO `m_staff` VALUES ('3', 'Stephanie Martina', 'M', 'a', '0', 'FireShot_Screen_Capture_044_-_Untitled-1_-_GLAM_OK_2803_pdf_-__C__Users_faris_Downloads_Documents_GLAMOK_2803_pdf1.png', 'hair stylish', 'y', '1', '2016-10-01 08:31:31', '1', '2016-10-06 13:58:24');
INSERT INTO `m_staff` VALUES ('4', 'Yudi', 'M', 'a', '0', 'FireShot_Screen_Capture_045_-_Untitled-1_-_GLAM_OK_2803_pdf_-__C__Users_faris_Downloads_Documents_GLAMOK_2803_pdf.png', 'hair stylish', 'y', '1', '2016-10-01 08:36:06', '1', '2016-10-01 08:36:20');
INSERT INTO `m_staff` VALUES ('5', 'Debby', 'M', 'a', '0', 'FireShot_Screen_Capture_046_-_Untitled-1_-_GLAM_OK_2803_pdf_-__C__Users_faris_Downloads_Documents_GLAMOK_2803_pdf1.png', 'hair stylish', 'y', '1', '2016-10-01 08:36:46', '1', '2016-10-06 13:57:01');
INSERT INTO `m_staff` VALUES ('6', 'Ari', 'M', 'a', '0', 'FireShot_Screen_Capture_047_-_Untitled-1_-_GLAM_OK_2803_pdf_-__C__Users_faris_Downloads_Documents_GLAMOK_2803_pdf2.png', 'hair stylish', 'y', '1', '2016-10-01 08:37:14', '1', '2016-10-06 13:56:35');
INSERT INTO `m_staff` VALUES ('7', 'Riri', 'M', 'a', '0', 'FireShot_Screen_Capture_048_-_Untitled-1_-_GLAM_OK_2803_pdf_-__C__Users_faris_Downloads_Documents_GLAMOK_2803_pdf1.png', 'hair stylish', 'y', '1', '2016-10-01 08:37:41', '1', '2016-10-06 13:57:52');

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `user_active` char(1) DEFAULT 'y',
  `user_photo` varchar(255) DEFAULT NULL,
  `user_createby` int(11) DEFAULT NULL,
  `user_createat` datetime DEFAULT NULL,
  `user_updateby` int(11) DEFAULT NULL,
  `user_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', 'super', '1b3231655cebb7a1f783eddf27d254ca', '1', 'y', null, '1', '2016-09-04 14:27:18', null, null);
INSERT INTO `m_user` VALUES ('2', 'dsd', '457391c9c82bfdcbb4947278c0401e41', '2', 't', 'Capture8.JPG', '1', '2016-09-16 08:26:19', '1', '2016-09-16 09:59:35');
INSERT INTO `m_user` VALUES ('3', 'holil', '5bd2b1a376b9e13610bcbae93871e67b', '1', 'y', null, '1', '2016-10-17 19:02:09', null, null);

-- ----------------------------
-- Table structure for m_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `m_usergroup`;
CREATE TABLE `m_usergroup` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(255) DEFAULT NULL,
  `usergroup_desc` text,
  `usergroup_active` char(1) DEFAULT 'y',
  `usergroup_createby` int(11) DEFAULT NULL,
  `usergroup_createat` datetime DEFAULT NULL,
  `usergroup_updateby` int(11) DEFAULT NULL,
  `usergroup_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_usergroup
-- ----------------------------
INSERT INTO `m_usergroup` VALUES ('1', 'Super Admin', 'Super Admin', 'y', '1', '2016-09-04 14:26:48', null, null);
INSERT INTO `m_usergroup` VALUES ('2', 'Admin', 'Admin', 'y', '1', '2016-09-04 14:26:48', null, null);
INSERT INTO `m_usergroup` VALUES ('3', 'Operator', 'Operator', 'y', '1', '2016-09-04 14:26:48', '1', '2016-09-16 04:30:38');
INSERT INTO `m_usergroup` VALUES ('4', 'ddd', 'cdscsdc', 'y', '1', '2016-09-19 03:51:00', null, null);

-- ----------------------------
-- Table structure for t_creation
-- ----------------------------
DROP TABLE IF EXISTS `t_creation`;
CREATE TABLE `t_creation` (
  `creation_id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_desc` varchar(255) DEFAULT NULL,
  `creation_file` varchar(255) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `creation_active` char(1) DEFAULT 'y',
  `creation_createby` int(11) DEFAULT NULL,
  `creation_createat` datetime DEFAULT NULL,
  `creation_updateby` int(11) DEFAULT NULL,
  `creation_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`creation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_creation
-- ----------------------------
INSERT INTO `t_creation` VALUES ('1', 'hasil karyawa kryawan saya ketika melakukan perawataan salah satu pelanggan', 'men-hair.jpg', '1', 'y', '1', '2016-09-30 13:41:46', '1', '2016-10-03 15:29:14');
INSERT INTO `t_creation` VALUES ('2', 'a', 'Capture.JPG', '4', 'y', '1', '2016-09-30 13:42:31', '1', '2016-10-13 17:04:40');
INSERT INTO `t_creation` VALUES ('3', 'semer rambut dengan teknik bagus', 'coloring-hair.jpg', '3', 'y', '1', '2016-09-30 13:43:00', '1', '2016-10-03 15:28:01');

-- ----------------------------
-- Table structure for t_customer
-- ----------------------------
DROP TABLE IF EXISTS `t_customer`;
CREATE TABLE `t_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_active` varchar(10) DEFAULT 'y',
  `customer_createby` int(11) DEFAULT NULL,
  `customer_updateat` datetime DEFAULT NULL,
  `customer_createdat` datetime DEFAULT NULL,
  `customer_member` varchar(20) DEFAULT 'member',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_customer
-- ----------------------------
INSERT INTO `t_customer` VALUES ('1', 'fgdfgd', '085233265657', 'yayayya@yahoo.com', 'y', null, null, '2016-10-17 15:39:20', 'member');
INSERT INTO `t_customer` VALUES ('2', 'holil', '081913707336', 'yyyy@yahoo.com', 'y', null, null, '2016-10-17 17:11:36', 'member');

-- ----------------------------
-- Table structure for t_gallery
-- ----------------------------
DROP TABLE IF EXISTS `t_gallery`;
CREATE TABLE `t_gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_desc` varchar(255) DEFAULT NULL,
  `gallery_file` varchar(255) DEFAULT NULL,
  `gallery_active` char(1) DEFAULT 'y',
  `gallery_createby` int(11) DEFAULT NULL,
  `gallery_createat` datetime DEFAULT NULL,
  `gallery_updateby` int(11) DEFAULT NULL,
  `gallery_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_gallery
-- ----------------------------
INSERT INTO `t_gallery` VALUES ('1', 'photo inin hasil perwatan salah satu pelanggan kami pada hari senin lumayan cantik kan', '14.jpg', 'y', '1', '2016-09-30 13:27:20', null, null);
INSERT INTO `t_gallery` VALUES ('2', 'mempercantik rambut dengan teknik modern dan aman memberikan sensasi kenyamana', '23.jpg', 'y', '1', '2016-09-30 13:30:25', null, null);
INSERT INTO `t_gallery` VALUES ('3', 'tese', 'flat-simple-wallpaper-81.jpeg', 't', '1', '2016-10-01 05:39:20', '1', '2016-10-01 05:44:55');
INSERT INTO `t_gallery` VALUES ('4', 'Test', '12519531_453929071483743_1469886166_n.jpg', 'y', '1', '2016-10-01 07:17:29', null, null);
INSERT INTO `t_gallery` VALUES ('5', 'test', '12965907_866799746798624_9975261_n.jpg', 'y', '1', '2016-10-01 07:17:46', '1', '2016-10-01 07:19:49');
INSERT INTO `t_gallery` VALUES ('6', 'Hair ', '13297971_1139660492742398_1190843234_n.jpg', 'y', '1', '2016-10-01 07:20:28', null, null);
INSERT INTO `t_gallery` VALUES ('7', 'serum ', '12749914_1000322513372039_963841533_n.jpg', 'y', '1', '2016-10-01 07:21:24', null, null);
INSERT INTO `t_gallery` VALUES ('8', 'hair style', 'Screenshot_2016-09-23-07-53-05-01.jpeg', 'y', '1', '2016-10-01 07:22:21', null, null);
INSERT INTO `t_gallery` VALUES ('9', 's', '12328441_564691200372997_845854708_n.jpg', 'y', '1', '2016-10-01 07:22:48', '1', '2016-10-01 07:24:24');

-- ----------------------------
-- Table structure for t_product
-- ----------------------------
DROP TABLE IF EXISTS `t_product`;
CREATE TABLE `t_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `product_desc` varchar(255) DEFAULT NULL,
  `product_price_men` varchar(255) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `product_duration` varchar(255) DEFAULT NULL,
  `product_price` varchar(255) DEFAULT NULL,
  `product_active` char(1) DEFAULT 'y',
  `product_createby` int(11) DEFAULT NULL,
  `product_createat` datetime DEFAULT NULL,
  `product_updateby` int(11) DEFAULT NULL,
  `product_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_product
-- ----------------------------
INSERT INTO `t_product` VALUES ('1', 'Potong ', 'potong rambut basah ini adalah potong rambut yang membuat pelanggan pulang dengan wajah bersih', '1000', '1', '1', '30', '10000', 't', '1', '2016-09-30 13:20:08', '1', '2016-10-17 17:28:21');
INSERT INTO `t_product` VALUES ('2', 'cuci weqw ', 'adalah cuci rambut dengan pewarna', '10000', '1', '1', '40', '10000', 'y', '1', '2016-09-30 13:22:52', '1', '2016-10-17 18:45:34');
INSERT INTO `t_product` VALUES ('3', 'perwatan Kulit Full Body', 'untuk mempercantik diri anda dengan teknik modern yang memberikan sensai penampilan anda semakin OKE! tanpa mengganggu tubuh banda', '10000', '1', '3', '30', '4000000', 't', '1', '2016-09-30 13:25:20', '1', '2016-10-17 17:28:08');
INSERT INTO `t_product` VALUES ('4', 'Haircut a', 'Haircut', '180000', '1', '3', '10', '380000', 'y', '1', '2016-10-01 08:33:23', '1', '2016-10-01 09:01:50');
INSERT INTO `t_product` VALUES ('5', 'haircut b', 'a', '110000', '1', '4', '10', '250000', 'y', '1', '2016-10-01 08:38:20', '1', '2016-10-01 09:01:19');
INSERT INTO `t_product` VALUES ('6', 'Haircut c', 'Haircut', '85000', '1', '5', '10', '175000', 'y', '1', '2016-10-01 09:02:25', null, null);
INSERT INTO `t_product` VALUES ('7', 'Haircut d', 'Haircut', '100000', '1', '6', '10', '150000', 'y', '1', '2016-10-01 09:03:03', null, null);
INSERT INTO `t_product` VALUES ('8', 'Haircut e', 'Haircut', '65000', '1', '5', '10', '100000', 'y', '1', '2016-10-01 09:03:33', null, null);
INSERT INTO `t_product` VALUES ('9', 'Holi', 'dqwkdjqd', '900000', '1', '1', '', '', 't', '1', '2016-10-13 09:06:34', '1', '2016-10-17 17:28:39');
INSERT INTO `t_product` VALUES ('10', 'eewrfewf', 'czczca', '90000', '2', '2', '30', '', 'y', '1', '2016-10-17 17:51:07', null, null);
INSERT INTO `t_product` VALUES ('11', 'sadasdas', 'asASa', null, '3', '1', '4', '90000', 'y', '1', '2016-10-17 18:25:19', null, null);

-- ----------------------------
-- Table structure for t_promotion
-- ----------------------------
DROP TABLE IF EXISTS `t_promotion`;
CREATE TABLE `t_promotion` (
  `promotion_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_name` varchar(255) DEFAULT NULL,
  `promotion_desc` varchar(255) DEFAULT NULL,
  `promotion_endat` datetime DEFAULT NULL,
  `promotion_startat` datetime DEFAULT NULL,
  `promotion_file` varchar(255) DEFAULT NULL,
  `promotion_active` char(1) DEFAULT 'y',
  `promotion_createby` int(11) DEFAULT NULL,
  `promotion_createat` datetime DEFAULT NULL,
  `promotion_updateby` int(11) DEFAULT NULL,
  `promotion_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_promotion
-- ----------------------------
INSERT INTO `t_promotion` VALUES ('1', 'promo potong rambut ', 'ini dengan gaya apapaun harganya tetep noul dengan syart menjadi member dulu', '2016-10-27 13:00:00', '2016-10-04 05:25:00', '2.jpg', 'y', '1', '2016-09-30 13:32:14', '1', '2016-10-17 10:49:34');
INSERT INTO `t_promotion` VALUES ('2', 'creambut jdasjdasjdkads', 'memberi penamipilan dengan sensasi yang luar biasa', '2016-10-04 14:25:00', '2016-09-30 13:35:00', 'al1.JPG', 'y', '1', '2016-09-30 13:34:20', '1', '2016-10-17 10:41:15');
INSERT INTO `t_promotion` VALUES ('3', 'sisir Rambut cantik anda', 'cantik menawan shopan membuat htmu selalu sejuk', '2016-10-01 13:25:00', '2016-09-30 13:35:00', 'hair.jpg', 'y', '1', '2016-09-30 13:35:57', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_reservation
-- ----------------------------
INSERT INTO `t_reservation` VALUES ('1', '1', '1', '2016-10-17 14:15:00', '2016-10-17 14:45:00', '5', 'cancel', null, null, null, '16746', 'y', null, '2016-10-17 15:14:00', '2016-10-17 14:14:15', null, '2016-10-17 15:33:50');
INSERT INTO `t_reservation` VALUES ('9', '2', '1', '2016-10-17 17:15:00', '2016-10-17 17:45:00', '5', 'cancel', null, null, null, '167162', 'y', null, '2016-10-17 18:11:00', '2016-10-17 17:11:36', null, '2016-10-17 18:11:03');

-- ----------------------------
-- Table structure for t_reservation_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_reservation_copy`;
CREATE TABLE `t_reservation_copy` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_reservation_copy
-- ----------------------------
INSERT INTO `t_reservation_copy` VALUES ('1', '1', '1', '2016-10-17 07:00:00', '2016-10-17 07:30:00', '1', 'pending', null, null, null, '16745', 'y', null, '2016-10-17 13:34:00', '2016-10-17 12:34:34', null, null);
INSERT INTO `t_reservation_copy` VALUES ('2', '1', '1', '2016-10-17 07:00:00', '2016-10-17 07:30:00', '1', 'pending', null, null, null, '16745', 'y', null, '2016-10-17 13:34:00', '2016-10-17 12:34:34', null, null);
INSERT INTO `t_reservation_copy` VALUES ('3', '3', '1', '2016-10-17 09:00:00', '2016-10-17 09:30:00', '1', 'pending', null, null, null, '167693', 'y', null, '2016-10-17 13:36:00', '2016-10-17 12:36:19', null, null);
INSERT INTO `t_reservation_copy` VALUES ('4', '3', '1', '2016-10-17 09:00:00', '2016-10-17 09:30:00', '1', 'pending', null, null, null, '167693', 'y', null, '2016-10-17 13:36:00', '2016-10-17 12:36:19', null, null);

-- ----------------------------
-- Table structure for t_schedule_staff
-- ----------------------------
DROP TABLE IF EXISTS `t_schedule_staff`;
CREATE TABLE `t_schedule_staff` (
  `schedule_staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_starttime` time DEFAULT NULL,
  `schedule_enddatime` time DEFAULT NULL,
  `schedule_active` varchar(11) DEFAULT 'y',
  `schedule_status` varchar(50) DEFAULT 'open',
  `schedule_createby` int(11) DEFAULT NULL,
  `staff_cuti` varchar(255) DEFAULT 'come',
  `schedule_createat` datetime DEFAULT NULL,
  `schedule_updateby` int(11) DEFAULT NULL,
  `schedule_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`schedule_staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_schedule_staff
-- ----------------------------
INSERT INTO `t_schedule_staff` VALUES ('1', '1', '2016-10-17', '08:00:00', '16:25:00', 'y', 'close', '1', 'come', '2016-10-06 14:11:48', '1', '2016-10-17 11:22:41');
INSERT INTO `t_schedule_staff` VALUES ('2', '2', '2016-10-17', '09:00:00', '04:30:00', 'y', 'open', '1', 'come', '2016-10-06 14:15:50', '1', '2016-10-13 05:48:22');
INSERT INTO `t_schedule_staff` VALUES ('3', '1', '2016-10-17', '07:25:00', '23:15:00', 'y', 'open', '1', 'come', '2016-10-06 14:21:29', null, '2016-10-07 14:15:01');
INSERT INTO `t_schedule_staff` VALUES ('4', '3', '2016-10-17', '07:03:00', '21:30:00', 'y', 'open', '1', 'come', '2016-10-06 14:21:51', '1', '2016-10-17 11:19:04');
INSERT INTO `t_schedule_staff` VALUES ('5', '1', '2016-10-17', '07:00:00', '23:00:00', 'y', 'open', '1', 'come', '2016-10-10 14:24:49', null, '2016-10-17 11:19:12');

-- ----------------------------
-- Table structure for t_slide
-- ----------------------------
DROP TABLE IF EXISTS `t_slide`;
CREATE TABLE `t_slide` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_file` varchar(255) DEFAULT NULL,
  `slide_order` tinyint(4) DEFAULT NULL,
  `slide_active` char(1) DEFAULT 'y',
  `slide_createby` int(11) DEFAULT NULL,
  `slide_createat` datetime DEFAULT NULL,
  `slide_updateby` int(11) DEFAULT NULL,
  `slide_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_slide
-- ----------------------------
INSERT INTO `t_slide` VALUES ('1', 'slide_22.jpg', '1', 'y', '1', '2016-09-30 13:26:02', '1', '2016-10-17 16:50:52');
INSERT INTO `t_slide` VALUES ('2', 'slide2.jpg', '2', 'y', '1', '2016-09-30 13:26:24', null, null);
INSERT INTO `t_slide` VALUES ('3', 'indeaaax.jpg', '3', 'y', '1', '2016-10-12 15:29:31', null, null);

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

-- ----------------------------
-- Table structure for t_testimonial
-- ----------------------------
DROP TABLE IF EXISTS `t_testimonial`;
CREATE TABLE `t_testimonial` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial_name` varchar(255) DEFAULT NULL,
  `testimonial_desc` varchar(255) DEFAULT NULL,
  `testimonial_photo` varchar(255) DEFAULT NULL,
  `testimonial_active` char(1) DEFAULT 'y',
  `testimonial_createby` int(11) DEFAULT NULL,
  `testimonial_createat` datetime DEFAULT NULL,
  `testimonial_updateby` int(11) DEFAULT NULL,
  `testimonial_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_testimonial
-- ----------------------------
INSERT INTO `t_testimonial` VALUES ('1', 'tyas nirwana', 'saya tida', '11.jpg', 'y', '1', '2016-09-30 13:37:57', null, null);
INSERT INTO `t_testimonial` VALUES ('2', 'dinda wulandari', 'kami merasa nyaman dengan perwatan di glam , saya jamin bagi kalian yang belum pernah kesini ayoo coba pasti mauk kesni terus', '21.jpg', 'y', '1', '2016-09-30 13:39:47', null, null);

-- ----------------------------
-- View structure for v_product
-- ----------------------------
DROP VIEW IF EXISTS `v_product`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_product` AS SELECT
t_product.product_id,
t_product.product_name,
t_product.product_desc,
t_product.product_price_men,
t_product.service_id,
t_product.staff_id,
t_product.product_duration,
t_product.product_price,
t_product.product_active,
t_product.product_createby,
t_product.product_createat,
t_product.product_updateby,
t_product.product_updateat,
m_staff.staff_name,
m_staff.staff_photo,
m_staff.staff_position,
m_staff.staff_active
FROM
t_product
LEFT JOIN m_staff ON t_product.staff_id = m_staff.staff_id 
WHERE product_active='y' ; ;

-- ----------------------------
-- View structure for v_product_jadwal_staff
-- ----------------------------
DROP VIEW IF EXISTS `v_product_jadwal_staff`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_product_jadwal_staff` AS SELECT
t_product.product_id,
t_product.product_name,
t_product.product_desc,
t_product.product_price_men,
t_product.service_id,
t_product.staff_id,
t_product.product_duration,
t_product.product_price,
t_product.product_active,
t_product.product_createby,
t_product.product_createat,
t_product.product_updateby,
t_product.product_updateat,
m_staff.staff_name,
m_staff.staff_photo,
m_staff.staff_position,
m_staff.staff_active,
t_schedule_staff.schedule_date,
t_schedule_staff.schedule_starttime,
t_schedule_staff.schedule_enddatime,
t_schedule_staff.schedule_staff_id
FROM
t_product
LEFT JOIN m_staff ON t_product.staff_id = m_staff.staff_id
INNER JOIN t_schedule_staff ON t_schedule_staff.staff_id = m_staff.staff_id
WHERE schedule_status='open' ; ;

-- ----------------------------
-- View structure for v_reservation
-- ----------------------------
DROP VIEW IF EXISTS `v_reservation`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_reservation` AS select `db_glam`.`m_staff`.`staff_name` AS `staff_name`,`db_glam`.`m_staff`.`staff_id` AS `staff_id`,`db_glam`.`t_product`.`product_name` AS `product_name`,`db_glam`.`t_product`.`product_price_men` AS `product_price_men`,`db_glam`.`t_product`.`service_id` AS `service_id`,`db_glam`.`t_product`.`product_duration` AS `product_duration`,`db_glam`.`t_product`.`product_price` AS `product_price`,`db_glam`.`t_customer`.`customer_id` AS `customer_id`,`db_glam`.`t_customer`.`customer_name` AS `customer_name`,`db_glam`.`t_customer`.`customer_phone` AS `customer_phone`,`db_glam`.`t_customer`.`customer_email` AS `customer_email`,`db_glam`.`t_customer`.`customer_active` AS `customer_active`,`db_glam`.`t_customer`.`customer_createby` AS `customer_createby`,`db_glam`.`t_customer`.`customer_createdat` AS `customer_createdat`,`db_glam`.`t_customer`.`customer_member` AS `customer_member`,`db_glam`.`t_reservation`.`reservation_startdatetime` AS `reservation_startdatetime`,`db_glam`.`t_reservation`.`reservation_id` AS `reservation_id`,`db_glam`.`t_reservation`.`reservation_enddatetime` AS `reservation_enddatetime`,`db_glam`.`t_reservation`.`reservation_status` AS `reservation_status`,`db_glam`.`t_reservation`.`reservation_methode` AS `reservation_methode`,`db_glam`.`t_reservation`.`reservation_amount_paid` AS `reservation_amount_paid`,`db_glam`.`t_reservation`.`reservation_request` AS `reservation_request`,`db_glam`.`t_reservation`.`reservation_number` AS `reservation_number`,`db_glam`.`t_reservation`.`reservation_active` AS `reservation_active`,`db_glam`.`t_reservation`.`reservation_createby` AS `reservation_createby`,`db_glam`.`t_reservation`.`reservation_endtime_confir` AS `reservation_endtime_confir`,`db_glam`.`t_reservation`.`reservation_createat` AS `reservation_createat`,`db_glam`.`t_reservation`.`reservation_updateby` AS `reservation_updateby`,`db_glam`.`t_reservation`.`reservation_updateat` AS `reservation_updateat`,`db_glam`.`t_product`.`product_id` AS `product_id`,`db_glam`.`t_reservation`.`status_payment_id` AS `status_payment_id`,`db_glam`.`t_status_payment`.`status_payment_name` AS `status_payment_name` from ((((`db_glam`.`m_staff` join `db_glam`.`t_product` on((`db_glam`.`t_product`.`staff_id` = `db_glam`.`m_staff`.`staff_id`))) left join `db_glam`.`t_reservation` on((`db_glam`.`t_reservation`.`product_id` = `db_glam`.`t_product`.`product_id`))) join `db_glam`.`t_customer` on((`db_glam`.`t_reservation`.`customer_id` = `db_glam`.`t_customer`.`customer_id`))) left join `db_glam`.`t_status_payment` on((`db_glam`.`t_reservation`.`status_payment_id` = `db_glam`.`t_status_payment`.`status_payment_id`))) ;
