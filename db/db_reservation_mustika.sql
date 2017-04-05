/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_reservation_mustika

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-05 07:21:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_kode` varchar(255) DEFAULT NULL,
  `menu_nama` varchar(255) DEFAULT NULL,
  `menu_ket` text,
  `menu_url` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_paten` char(1) DEFAULT NULL,
  `menu_active` char(1) DEFAULT 'y',
  `menu_createby` int(11) DEFAULT NULL,
  `menu_createat` datetime DEFAULT NULL,
  `menu_updateby` int(11) DEFAULT NULL,
  `menu_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES ('1', 'setting-user', 'Setting User', '', '#', 'fa fa-users', '0', 'y', 'y', null, '2016-12-13 20:16:32', null, '2016-12-13 20:16:32');
INSERT INTO `m_menu` VALUES ('2', 'usergroup', 'User Group', '', 'usergroup', 'fa fa-circle-o', '1', 'y', 'y', null, '2016-11-08 10:34:26', '1', '2017-03-26 05:12:16');
INSERT INTO `m_menu` VALUES ('3', 'user', 'User', null, 'user', 'fa fa-circle-o', '1', 'y', 'y', null, '2016-11-08 10:34:45', null, '2016-11-08 10:34:45');
INSERT INTO `m_menu` VALUES ('4', 'menu', 'Menu', null, 'menu', 'fa fa-circle-o', '1', 'y', 'y', null, '2016-11-08 10:35:15', null, '2016-11-08 10:35:15');
INSERT INTO `m_menu` VALUES ('5', 'akses', 'Hak Akses', null, 'akses', 'fa fa-circle-o', '1', 'y', 'y', null, '2016-11-08 10:35:52', null, '2016-11-08 10:35:52');
INSERT INTO `m_menu` VALUES ('6', 'master', 'Master', '', '#', 'fa fa-wrench', '0', null, 'y', null, '2016-12-13 20:18:21', null, null);
INSERT INTO `m_menu` VALUES ('24', 'service', 'Service', '', 'service', '', '6', null, 'y', null, '2017-03-26 08:31:24', null, null);
INSERT INTO `m_menu` VALUES ('25', 'frontend', 'Setting FrontEnd', '', '#', '', '0', null, 'y', null, '2017-03-26 10:10:44', null, null);
INSERT INTO `m_menu` VALUES ('26', 'slide', 'slide', '', 'slide', '', '25', null, 'y', null, '2017-03-26 10:20:21', null, null);
INSERT INTO `m_menu` VALUES ('27', 'gallery', 'Gallery', '', 'gallery', '', '25', null, 'y', null, '2017-03-26 10:20:54', null, null);
INSERT INTO `m_menu` VALUES ('29', 'testimonial', 'Testimonial', '', 'testimonial', '', '25', null, 'y', null, '2017-03-26 10:21:57', null, null);
INSERT INTO `m_menu` VALUES ('32', 'reservation', 'Reservation', '', 'reservation', '', '25', null, 'y', null, '2017-03-26 10:23:23', null, null);

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
  `service_harga` varchar(100) DEFAULT NULL,
  `hitungan_jam` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_service
-- ----------------------------
INSERT INTO `m_service` VALUES ('1', 'SOUND', 'perawatan yang membuat seseorang tambah kinclong', 'y', '1', 'OUR SERVICES', '2016-09-30 13:11:29', null, null, '1000', '10');
INSERT INTO `m_service` VALUES ('2', 'TEROP', 'ok;k;kl;', 'y', '1', 'OUR SERVICES', '2016-09-30 13:16:52', null, '2017-04-05 02:14:48', '3000', '10');
INSERT INTO `m_service` VALUES ('3', 'MUSIK', 'adalah semua tindakan yang membuat seseorang menerima pelayan terbaik', 'y', '1', 'OUR SERVICES', '2016-09-30 13:17:53', null, '2017-04-05 02:20:43', '10000', '10');
INSERT INTO `m_service` VALUES ('4', 'rgeger', 'regere', 't', '1', 'OUR CREATIONS', '2016-10-13 08:36:44', null, '2017-04-04 13:34:07', '6000', '10');
INSERT INTO `m_service` VALUES ('5', 'fwefwe', 'ewfwefwe', 't', '1', 'OUR CREATIONS', '2016-10-13 08:37:51', null, '2017-04-05 02:11:31', '4000', '100');

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_id` int(11) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_paten` char(1) DEFAULT NULL,
  `user_active` char(1) DEFAULT 'y',
  `user_createby` int(11) DEFAULT NULL,
  `user_createat` datetime DEFAULT NULL,
  `user_updateby` int(11) DEFAULT NULL,
  `user_updateat` datetime DEFAULT NULL,
  `user_photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `usergroup_id` (`usergroup_id`) USING BTREE,
  CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`usergroup_id`) REFERENCES `m_usergroup` (`usergroup_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', '1', 'super', '1b3231655cebb7a1f783eddf27d254ca', 'y', 'y', null, null, '1', '2016-11-08 13:22:31', null);
INSERT INTO `m_user` VALUES ('2', '2', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'y', 'y', null, null, null, '2016-11-08 12:56:26', null);
INSERT INTO `m_user` VALUES ('3', '3', 'holil', '4b77db956003ec65ef85fdb131379204', null, 'y', '1', '2017-03-26 03:58:47', null, null, '17202812_1423164871048337_164566900212283750_n.jpg');

-- ----------------------------
-- Table structure for m_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `m_usergroup`;
CREATE TABLE `m_usergroup` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(255) DEFAULT NULL,
  `usergroup_ket` text,
  `usergroup_paten` char(1) DEFAULT NULL,
  `usergroup_active` char(1) DEFAULT 'y',
  `usergroup_createby` int(11) DEFAULT NULL,
  `usergroup_createat` datetime DEFAULT NULL,
  `usergroup_updateby` int(11) DEFAULT NULL,
  `usergroup_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_usergroup
-- ----------------------------
INSERT INTO `m_usergroup` VALUES ('1', 'Super Admin', null, 'y', 'y', null, null, null, '2016-11-08 12:58:29');
INSERT INTO `m_usergroup` VALUES ('2', 'Admin', null, 'y', 'y', null, null, null, '2016-11-08 12:58:29');
INSERT INTO `m_usergroup` VALUES ('3', 'Bendahara', 'k', 'y', 'y', null, null, '1', '2016-12-13 19:13:18');

-- ----------------------------
-- Table structure for t_akses
-- ----------------------------
DROP TABLE IF EXISTS `t_akses`;
CREATE TABLE `t_akses` (
  `akses_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `akses_listfitur` varchar(255) DEFAULT NULL,
  `akses_paten` char(1) DEFAULT NULL,
  `akses_active` char(1) DEFAULT 'y',
  PRIMARY KEY (`akses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_akses
-- ----------------------------
INSERT INTO `t_akses` VALUES ('1', '1', '1', null, 'y', 'y');
INSERT INTO `t_akses` VALUES ('2', '1', '2', '1,2,3,4', 'y', 'y');
INSERT INTO `t_akses` VALUES ('3', '1', '3', '5,6,7,8', 'y', 'y');
INSERT INTO `t_akses` VALUES ('4', '1', '4', '9,10,11,12,13', 'y', 'y');
INSERT INTO `t_akses` VALUES ('5', '1', '5', '14,15,16,17', 'y', 'y');
INSERT INTO `t_akses` VALUES ('6', '2', '2', '1,2,3', null, 'y');
INSERT INTO `t_akses` VALUES ('7', '2', '1', null, null, 'y');
INSERT INTO `t_akses` VALUES ('8', '1', '7', '18,19,20', null, 'y');
INSERT INTO `t_akses` VALUES ('9', '1', '6', null, null, 'y');
INSERT INTO `t_akses` VALUES ('11', '1', '9', '26,27,28,29,30', null, 'y');
INSERT INTO `t_akses` VALUES ('12', '1', '10', '31,32,33,34', null, 'y');
INSERT INTO `t_akses` VALUES ('13', '1', '12', '35,36,37,38', null, 'y');
INSERT INTO `t_akses` VALUES ('14', '1', '11', null, null, 'y');
INSERT INTO `t_akses` VALUES ('15', '1', '13', '39,40,41,42', null, 'y');
INSERT INTO `t_akses` VALUES ('16', '1', '16', '45,46,47,48', null, 'y');
INSERT INTO `t_akses` VALUES ('17', '1', '15', null, null, 'y');
INSERT INTO `t_akses` VALUES ('19', '1', '17', '49,50,51,52', null, 'y');
INSERT INTO `t_akses` VALUES ('20', '1', '18', '53,54,55,56', null, 'y');
INSERT INTO `t_akses` VALUES ('21', '1', '20', '57,58,59,60', null, 'y');
INSERT INTO `t_akses` VALUES ('22', '1', '19', null, null, 'y');
INSERT INTO `t_akses` VALUES ('23', '1', '21', '61,62,63,64', null, 'y');
INSERT INTO `t_akses` VALUES ('24', '1', '22', '65,66,67,68', null, 'y');
INSERT INTO `t_akses` VALUES ('25', '1', '23', '69,70,71,72', null, 'y');
INSERT INTO `t_akses` VALUES ('26', '1', '24', '73,74,75,76', null, 'y');
INSERT INTO `t_akses` VALUES ('27', '1', '26', '77,78,79,80', null, 'y');
INSERT INTO `t_akses` VALUES ('28', '1', '25', null, null, 'y');
INSERT INTO `t_akses` VALUES ('29', '1', '27', '81,82,83,84', null, 'y');
INSERT INTO `t_akses` VALUES ('30', '1', '28', '', null, 'y');
INSERT INTO `t_akses` VALUES ('31', '1', '30', '', null, 'y');
INSERT INTO `t_akses` VALUES ('32', '1', '31', '', null, 'y');
INSERT INTO `t_akses` VALUES ('33', '1', '32', '', null, 'y');

-- ----------------------------
-- Table structure for t_customer
-- ----------------------------
DROP TABLE IF EXISTS `t_customer`;
CREATE TABLE `t_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_alamat` varchar(225) DEFAULT NULL,
  `customer_active` varchar(10) DEFAULT 'y',
  `customer_createby` int(11) DEFAULT NULL,
  `customer_updateat` datetime DEFAULT NULL,
  `customer_createdat` datetime DEFAULT NULL,
  `customer_member` varchar(20) DEFAULT 'member',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_customer
-- ----------------------------
INSERT INTO `t_customer` VALUES ('1', 'fgdfgd', '085233265657', 'yayayya@yahoo.com', null, 'y', null, null, '2016-10-17 15:39:20', 'member');
INSERT INTO `t_customer` VALUES ('2', 'ksdfksj', '081913707336', 'dddooo@gmail.com', 'dddd', 'y', null, '2017-04-04 19:31:05', '2016-10-17 17:11:36', 'member');
INSERT INTO `t_customer` VALUES ('3', 'jsdasda', '082330098881', 'dddooo@gmail.com', 'sfdsdf', 'y', null, '2017-04-04 19:29:06', '2017-04-04 14:28:48', 'member');

-- ----------------------------
-- Table structure for t_fitur
-- ----------------------------
DROP TABLE IF EXISTS `t_fitur`;
CREATE TABLE `t_fitur` (
  `fitur_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `fitur_kode` varchar(255) DEFAULT NULL,
  `fitur_nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fitur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fitur
-- ----------------------------
INSERT INTO `t_fitur` VALUES ('1', '2', 'xcreate_usergroup', 'Add');
INSERT INTO `t_fitur` VALUES ('2', '2', 'xread_usergroup', 'View');
INSERT INTO `t_fitur` VALUES ('3', '2', 'xupdate_usergroup', 'Edit');
INSERT INTO `t_fitur` VALUES ('4', '2', 'xdelete_usergroup', 'Delete');
INSERT INTO `t_fitur` VALUES ('5', '3', 'xcreate_user', 'Add');
INSERT INTO `t_fitur` VALUES ('6', '3', 'xread_user', 'View');
INSERT INTO `t_fitur` VALUES ('7', '3', 'xupdate_user', 'Edit');
INSERT INTO `t_fitur` VALUES ('8', '3', 'xdelete_user', 'Delete');
INSERT INTO `t_fitur` VALUES ('9', '4', 'xcreate_menu', 'Add');
INSERT INTO `t_fitur` VALUES ('10', '4', 'xread_menu', 'View');
INSERT INTO `t_fitur` VALUES ('11', '4', 'xupdate_menu', 'Edit');
INSERT INTO `t_fitur` VALUES ('12', '4', 'xdelete_menu', 'Delete');
INSERT INTO `t_fitur` VALUES ('13', '4', 'xfitur_menu', 'Fitur');
INSERT INTO `t_fitur` VALUES ('14', '5', 'xcreate_akses', 'Add');
INSERT INTO `t_fitur` VALUES ('15', '5', 'xread_akses', 'View');
INSERT INTO `t_fitur` VALUES ('16', '5', 'xupdate_akses', 'Edit');
INSERT INTO `t_fitur` VALUES ('17', '5', 'xdelete_akses', 'Delete');
INSERT INTO `t_fitur` VALUES ('73', '24', 'create_service', 'create service');
INSERT INTO `t_fitur` VALUES ('74', '24', 'update_service', 'update service');
INSERT INTO `t_fitur` VALUES ('75', '24', 'delete_service', 'delete service');
INSERT INTO `t_fitur` VALUES ('76', '24', 'view_service', 'view service');
INSERT INTO `t_fitur` VALUES ('77', '26', 'create_slide', 'create slide');
INSERT INTO `t_fitur` VALUES ('78', '26', 'update_slide', 'update slide');
INSERT INTO `t_fitur` VALUES ('79', '26', 'delete_slide', 'delete slide');
INSERT INTO `t_fitur` VALUES ('80', '26', 'view_slide', 'view slide');
INSERT INTO `t_fitur` VALUES ('81', '27', 'create_gallery', 'create gallery');
INSERT INTO `t_fitur` VALUES ('82', '27', 'update_gallery', 'update gallery');
INSERT INTO `t_fitur` VALUES ('83', '27', 'delete_gallery', 'delete gallery');
INSERT INTO `t_fitur` VALUES ('84', '27', 'view_gallery', 'view gallery');

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
INSERT INTO `t_gallery` VALUES ('4', 'Perayaan Hari Jadi Kamal', 'download_(3).jpg', 'y', '1', '2016-10-01 07:17:29', null, '2017-04-02 00:30:48');
INSERT INTO `t_gallery` VALUES ('5', 'test', '12965907_866799746798624_9975261_n.jpg', 'y', '1', '2016-10-01 07:17:46', '1', '2016-10-01 07:19:49');
INSERT INTO `t_gallery` VALUES ('6', 'Konser Ultah Bangkalan', '77a82852-72ad-4b65-8de5-5b4e462b99a0.jpg', 'y', '1', '2016-10-01 07:20:28', null, '2017-04-02 00:29:34');
INSERT INTO `t_gallery` VALUES ('7', 'serum ', '12749914_1000322513372039_963841533_n.jpg', 'y', '1', '2016-10-01 07:21:24', null, null);
INSERT INTO `t_gallery` VALUES ('8', 'hair style', '31.jpg', 'y', '1', '2016-10-01 07:22:21', null, '2017-04-04 13:37:10');
INSERT INTO `t_gallery` VALUES ('9', 's', '12328441_564691200372997_845854708_n.jpg', 'y', '1', '2016-10-01 07:22:48', '1', '2016-10-01 07:24:24');

-- ----------------------------
-- Table structure for t_product_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_product_copy`;
CREATE TABLE `t_product_copy` (
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
-- Records of t_product_copy
-- ----------------------------
INSERT INTO `t_product_copy` VALUES ('1', 'Potong ', 'potong rambut basah ini adalah potong rambut yang membuat pelanggan pulang dengan wajah bersih', '1000', '1', '1', '30', '10000', 't', '1', '2016-09-30 13:20:08', '1', '2016-10-17 17:28:21');
INSERT INTO `t_product_copy` VALUES ('2', 'cuci weqw ', 'adalah cuci rambut dengan pewarna', '10000', '1', '1', '40', '10000', 'y', '1', '2016-09-30 13:22:52', '1', '2016-10-17 18:45:34');
INSERT INTO `t_product_copy` VALUES ('3', 'perwatan Kulit Full Body', 'untuk mempercantik diri anda dengan teknik modern yang memberikan sensai penampilan anda semakin OKE! tanpa mengganggu tubuh banda', '10000', '1', '3', '30', '4000000', 't', '1', '2016-09-30 13:25:20', '1', '2016-10-17 17:28:08');
INSERT INTO `t_product_copy` VALUES ('4', 'Haircut a', 'Haircut', '180000', '1', '3', '10', '380000', 'y', '1', '2016-10-01 08:33:23', '1', '2016-10-01 09:01:50');
INSERT INTO `t_product_copy` VALUES ('5', 'haircut b', 'a', '110000', '1', '4', '10', '250000', 'y', '1', '2016-10-01 08:38:20', '1', '2016-10-01 09:01:19');
INSERT INTO `t_product_copy` VALUES ('6', 'Haircut c', 'Haircut', '85000', '1', '5', '10', '175000', 'y', '1', '2016-10-01 09:02:25', null, null);
INSERT INTO `t_product_copy` VALUES ('7', 'Haircut d', 'Haircut', '100000', '1', '6', '10', '150000', 'y', '1', '2016-10-01 09:03:03', null, null);
INSERT INTO `t_product_copy` VALUES ('8', 'Haircut e', 'Haircut', '65000', '1', '5', '10', '100000', 'y', '1', '2016-10-01 09:03:33', null, null);
INSERT INTO `t_product_copy` VALUES ('9', 'Holi', 'dqwkdjqd', '900000', '1', '1', '', '', 't', '1', '2016-10-13 09:06:34', '1', '2016-10-17 17:28:39');
INSERT INTO `t_product_copy` VALUES ('10', 'eewrfewf', 'czczca', '90000', '2', '2', '30', '', 'y', '1', '2016-10-17 17:51:07', null, null);
INSERT INTO `t_product_copy` VALUES ('11', 'sadasdas', 'asASa', null, '3', '1', '4', '90000', 'y', '1', '2016-10-17 18:25:19', null, null);

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
  `service_id` int(11) DEFAULT NULL,
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
  `jumlah_bayar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_reservation
-- ----------------------------
INSERT INTO `t_reservation` VALUES ('32', '3', '3', '2017-04-07 05:00:00', '2017-04-08 05:00:00', '5', 'cancel', null, null, null, '174961', 'y', null, '2017-04-05 07:10:00', '2017-04-04 19:29:06', null, '2017-04-05 02:10:00', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_slide
-- ----------------------------
INSERT INTO `t_slide` VALUES ('1', '14372280_321594894860173_5848860030601563291_o.jpg', '1', 'y', '1', '2016-09-30 13:26:02', null, '2017-04-04 16:43:01');
INSERT INTO `t_slide` VALUES ('2', 'IMG_0492.JPG', '2', 'y', '1', '2016-09-30 13:26:24', null, '2017-04-04 16:45:22');
INSERT INTO `t_slide` VALUES ('3', 'indeaaax.jpg', '3', 't', '1', '2016-10-12 15:29:31', null, null);
INSERT INTO `t_slide` VALUES ('4', 'P1080623(1).jpg', '4', 'y', null, '2017-03-30 15:17:30', null, '2017-03-30 15:23:53');
INSERT INTO `t_slide` VALUES ('5', 'IMG_0488.JPG', '5', 'y', null, '2017-03-30 15:22:14', null, '2017-04-04 16:47:06');
INSERT INTO `t_slide` VALUES ('6', 'panggung-dangdut.jpg', '6', 'y', null, '2017-03-30 15:22:43', null, '2017-03-30 15:23:18');

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
-- View structure for v_akses
-- ----------------------------
DROP VIEW IF EXISTS `v_akses`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_akses` AS SELECT
	`t_akses`.`akses_id` AS `akses_id`,
	`t_akses`.`usergroup_id` AS `usergroup_id`,
	`t_akses`.`menu_id` AS `menu_id`,
	`t_akses`.`akses_listfitur` AS `akses_listfitur`,
	`t_akses`.`akses_paten` AS `akses_paten`,
	`t_akses`.`akses_active` AS `akses_active`,
	`m_usergroup`.`usergroup_name` AS `usergroup_name`,
	`m_menu`.`menu_kode` AS `menu_kode`,
	`m_menu`.`menu_nama` AS `menu_nama`,
	`m_menu`.`menu_url` AS `menu_url`,
	`m_menu`.`menu_icon` AS `menu_icon`,
	`m_menu`.`menu_parent` AS `menu_parent`
FROM
	(
		(
			`t_akses`
			LEFT JOIN `m_usergroup` ON (
				(
					`t_akses`.`usergroup_id` = `m_usergroup`.`usergroup_id`
				)
			)
		)
		LEFT JOIN `m_menu` ON (
			(
				`t_akses`.`menu_id` = `m_menu`.`menu_id`
			)
		)
	) ;

-- ----------------------------
-- View structure for v_menu
-- ----------------------------
DROP VIEW IF EXISTS `v_menu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_menu` AS select `a`.`menu_id` AS `menu_id`,`a`.`menu_kode` AS `menu_kode`,`a`.`menu_nama` AS `menu_nama`,`a`.`menu_ket` AS `menu_ket`,`a`.`menu_url` AS `menu_url`,`a`.`menu_icon` AS `menu_icon`,`a`.`menu_parent` AS `menu_parent`,`a`.`menu_paten` AS `menu_paten`,`a`.`menu_active` AS `menu_active`,`a`.`menu_createby` AS `menu_createby`,`a`.`menu_createat` AS `menu_createat`,`a`.`menu_updateby` AS `menu_updateby`,`a`.`menu_updateat` AS `menu_updateat`,`b`.`menu_nama` AS `menu_parent_nama` from (`m_menu` `a` left join `m_menu` `b` on((`a`.`menu_parent` = `b`.`menu_id`))) ;

-- ----------------------------
-- View structure for v_product_jadwal_staff
-- ----------------------------
DROP VIEW IF EXISTS `v_product_jadwal_staff`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_product_jadwal_staff` AS SELECT
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
WHERE schedule_status='open' ;

-- ----------------------------
-- View structure for v_reservation
-- ----------------------------
DROP VIEW IF EXISTS `v_reservation`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_reservation` AS SELECT
t_customer.customer_name,
t_customer.customer_email,
t_customer.customer_alamat,
t_customer.customer_active,
t_customer.customer_createby,
t_customer.customer_updateat,
t_customer.customer_createdat,
t_customer.customer_member,
t_reservation.reservation_id,
t_reservation.reservation_startdatetime,
t_reservation.reservation_enddatetime,
t_reservation.status_payment_id,
t_reservation.reservation_status,
t_reservation.reservation_methode,
t_reservation.reservation_amount_paid,
t_reservation.reservation_request,
t_reservation.reservation_number,
t_reservation.reservation_active,
t_reservation.reservation_createby,
t_reservation.reservation_endtime_confir,
t_reservation.reservation_createat,
t_reservation.reservation_updateby,
t_reservation.reservation_updateat,
t_reservation.jumlah_bayar,
t_status_payment.status_payment_name,
t_status_payment.created_at,
t_status_payment.created_by,
t_customer.customer_phone,
t_reservation.customer_id,
m_service.service_id,
m_service.service_name,
m_service.service_desc,
m_service.service_active,
m_service.service_createby,
m_service.service_jenis,
m_service.service_createat,
m_service.sevice_updateby,
m_service.service_updateat,
m_service.service_harga,
m_service.hitungan_jam
FROM
t_customer
INNER JOIN t_reservation ON t_customer.customer_id = t_reservation.customer_id
INNER JOIN t_status_payment ON t_reservation.status_payment_id = t_status_payment.status_payment_id
INNER JOIN m_service ON t_reservation.service_id = m_service.service_id ;
