/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : bool

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-04-22 10:00:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) NOT NULL DEFAULT '',
  `intro` varchar(100) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '男士正装', '男士正装', '0');
INSERT INTO `category` VALUES ('2', '西装', '西装', '1');
INSERT INTO `category` VALUES ('3', '衬衫', '衬衫', '1');
INSERT INTO `category` VALUES ('4', '女士正装', '女士正装', '0');
INSERT INTO `category` VALUES ('5', '套装', '套装', '4');
INSERT INTO `category` VALUES ('6', '衬衫', '衬衫', '4');
INSERT INTO `category` VALUES ('7', '正装鞋', '正装鞋', '0');
INSERT INTO `category` VALUES ('8', '男士皮鞋', '男士皮鞋', '7');
INSERT INTO `category` VALUES ('9', '女士皮鞋', '女士皮鞋', '7');
INSERT INTO `category` VALUES ('10', '配饰', '配饰', '0');
INSERT INTO `category` VALUES ('11', '领带', '领带', '10');
INSERT INTO `category` VALUES ('12', '皮带', '皮带', '10');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_sn` char(15) NOT NULL DEFAULT '',
  `cat_id` smallint(6) NOT NULL DEFAULT '0',
  `brand_id` smallint(6) NOT NULL DEFAULT '0',
  `goods_name` varchar(60) NOT NULL DEFAULT '',
  `shop_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `market_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `goods_number` smallint(6) NOT NULL DEFAULT '1',
  `click_count` mediumint(9) NOT NULL DEFAULT '0',
  `goods_weight` decimal(6,3) NOT NULL DEFAULT '0.000',
  `goods_brief` varchar(100) NOT NULL DEFAULT '',
  `goods_desc` text NOT NULL,
  `thumb_img` varchar(50) NOT NULL DEFAULT '',
  `goods_img` varchar(50) NOT NULL DEFAULT '',
  `ori_img` varchar(50) NOT NULL DEFAULT '',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `is_best` tinyint(4) NOT NULL DEFAULT '0',
  `is_new` tinyint(4) NOT NULL DEFAULT '0',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_update` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  UNIQUE KEY `goods_sn` (`goods_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', 'BL2012121939587', '2', '0', '两扣双开衩平驳头斜兜男士西服套装3312/纯藏青色人字纹/羊毛+涤纶', '799.00', '1598.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_aifwnt.JPG', 'data/images/201212/19/goods_aifwnt.JPG', 'data/images/201212/19/aifwnt.JPG', '1', '0', '0', '1', '0', '1355915283', '0');
INSERT INTO `goods` VALUES ('2', 'BL2012121913673', '2', '0', '纯羊毛一粒扣枪驳领纯黑西服套装', '999.00', '1325.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_z2gd86.JPG', 'data/images/201212/19/goods_z2gd86.JPG', 'data/images/201212/19/z2gd86.JPG', '1', '0', '0', '0', '0', '1355915493', '0');
INSERT INTO `goods` VALUES ('3', 'BL2012121919874', '2', '0', '两扣平驳领棕色格纹男士休闲单西D6959', '1490.00', '1643.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_dx9ghq.JPG', 'data/images/201212/19/goods_dx9ghq.JPG', 'data/images/201212/19/dx9ghq.JPG', '1', '0', '0', '0', '0', '1355915572', '0');
INSERT INTO `goods` VALUES ('4', 'BL2012121970923', '3', '0', '蓝黑竖条纹男士休闲衬衫', '199.00', '238.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_juir8s.JPG', 'data/images/201212/19/goods_juir8s.JPG', 'data/images/201212/19/juir8s.JPG', '1', '0', '0', '0', '0', '1355915656', '0');
INSERT INTO `goods` VALUES ('5', 'BL2012121980647', '3', '0', '蓝底提花咖色竖条纹修身正装衬衫', '199.00', '234.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_rad3wq.JPG', 'data/images/201212/19/goods_rad3wq.JPG', 'data/images/201212/19/rad3wq.JPG', '1', '0', '0', '0', '0', '1355915689', '0');
INSERT INTO `goods` VALUES ('6', 'BL2012121956217', '3', '0', '男士短袖衬衫A52D/纯白暗竖纹/莫代尔棉', '45.00', '54.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_3fckzt.jpg', 'data/images/201212/19/goods_3fckzt.jpg', 'data/images/201212/19/3fckzt.jpg', '1', '0', '0', '0', '0', '1355915726', '0');
INSERT INTO `goods` VALUES ('7', 'BL2012121936338', '5', '0', '枪驳大领面后开叉短款两扣女士正装', '567.00', '1324.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_wcri9z.JPG', 'data/images/201212/19/goods_wcri9z.JPG', 'data/images/201212/19/wcri9z.JPG', '1', '0', '0', '0', '0', '1355915834', '0');
INSERT INTO `goods` VALUES ('8', 'BL2012121994403', '5', '0', '泡泡袖后领色丁拼接平驳领一扣女士正装套裤/黑色', '482.00', '897.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_5tsyhu.JPG', 'data/images/201212/19/goods_5tsyhu.JPG', 'data/images/201212/19/5tsyhu.JPG', '1', '0', '0', '0', '0', '1355915895', '0');
INSERT INTO `goods` VALUES ('9', 'BL2012121977239', '5', '0', '本白压褶下摆短袖套裙', '318.00', '564.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_ay86zh.JPG', 'data/images/201212/19/goods_ay86zh.JPG', 'data/images/201212/19/ay86zh.JPG', '1', '0', '0', '0', '0', '1355915936', '0');
INSERT INTO `goods` VALUES ('10', 'BL2012121941490', '5', '0', '枪驳大领面1扣女士正装/亮咖色', '499.00', '675.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_n29dmp.JPG', 'data/images/201212/19/goods_n29dmp.JPG', 'data/images/201212/19/n29dmp.JPG', '1', '0', '0', '0', '0', '1355915993', '0');
INSERT INTO `goods` VALUES ('11', 'BL2012121985783', '6', '0', '纯白斜条棉涤女士衬衫', '42.00', '67.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_byadc8.JPG', 'data/images/201212/19/goods_byadc8.JPG', 'data/images/201212/19/byadc8.JPG', '1', '0', '0', '0', '0', '1355916069', '0');
INSERT INTO `goods` VALUES ('12', 'BL2012121952838', '6', '0', '女士长袖衬衫165/蓝条纹/莫代尔棉V领花边', '99.00', '134.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_2mhjt4.JPG', 'data/images/201212/19/goods_2mhjt4.JPG', 'data/images/201212/19/2mhjt4.JPG', '1', '0', '0', '0', '0', '1355916106', '0');
INSERT INTO `goods` VALUES ('13', 'BL2012121982746', '6', '0', '白色暗竖纹V领莫代尔棉衬衫', '89.00', '156.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_fys85v.JPG', 'data/images/201212/19/goods_fys85v.JPG', 'data/images/201212/19/fys85v.JPG', '1', '0', '0', '0', '0', '1355916157', '0');
INSERT INTO `goods` VALUES ('14', 'BL2012121992429', '8', '0', '男士系带正装鞋/黑色/牛皮', '150.00', '250.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_yvwnc9.JPG', 'data/images/201212/19/goods_yvwnc9.JPG', 'data/images/201212/19/yvwnc9.JPG', '1', '0', '0', '0', '0', '1355916281', '0');
INSERT INTO `goods` VALUES ('15', 'BL2012121971035', '8', '0', '滑轮添奴男士系带正装鞋/牛皮', '150.00', '250.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_dh2yxm.JPG', 'data/images/201212/19/goods_dh2yxm.JPG', 'data/images/201212/19/dh2yxm.JPG', '1', '0', '0', '0', '0', '1355916549', '0');
INSERT INTO `goods` VALUES ('16', 'BL2012121977793', '8', '0', '全牛皮小圆头正装鞋', '199.00', '234.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_iu5xgq.JPG', 'data/images/201212/19/goods_iu5xgq.JPG', 'data/images/201212/19/iu5xgq.JPG', '1', '0', '0', '0', '0', '1355916612', '0');
INSERT INTO `goods` VALUES ('17', 'BL2012121952414', '0', '0', '鞋面三扣装饰胎牛皮带绒中跟踝靴/黑色', '299.00', '399.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_i7pqy8.JPG', 'data/images/201212/19/goods_i7pqy8.JPG', 'data/images/201212/19/i7pqy8.JPG', '1', '0', '0', '0', '0', '1355916746', '0');
INSERT INTO `goods` VALUES ('18', 'BL2012121957666', '9', '0', '简约中跟女士正装鞋黑色', '199.00', '399.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_fsuh7j.JPG', 'data/images/201212/19/goods_fsuh7j.JPG', 'data/images/201212/19/fsuh7j.JPG', '1', '0', '0', '0', '0', '1355916792', '0');
INSERT INTO `goods` VALUES ('19', 'BL2012121917277', '9', '0', '单侧镶钻漆皮中跟正装鞋/黑色', '145.00', '234.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_uigxw5.JPG', 'data/images/201212/19/goods_uigxw5.JPG', 'data/images/201212/19/uigxw5.JPG', '1', '0', '0', '0', '0', '1355916829', '0');
INSERT INTO `goods` VALUES ('20', 'BL2012121993042', '11', '0', '深蓝纯色领带', '89.00', '139.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_cbnrqe.JPG', 'data/images/201212/19/goods_cbnrqe.JPG', 'data/images/201212/19/cbnrqe.JPG', '1', '0', '0', '0', '0', '1355916948', '0');
INSERT INTO `goods` VALUES ('21', 'BL2012121965862', '11', '0', '100%桑蚕丝天蓝底黑斜纹领带', '128.00', '234.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_uc9n7f.JPG', 'data/images/201212/19/goods_uc9n7f.JPG', 'data/images/201212/19/uc9n7f.JPG', '1', '0', '0', '0', '0', '1355916979', '0');
INSERT INTO `goods` VALUES ('22', 'BL2012121940360', '11', '0', '100%桑蚕丝灰黑斜条纹领带', '128.00', '234.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_m5qd2j.JPG', 'data/images/201212/19/goods_m5qd2j.JPG', 'data/images/201212/19/m5qd2j.JPG', '1', '0', '0', '0', '0', '1355917010', '0');
INSERT INTO `goods` VALUES ('23', 'BL2012121939272', '12', '0', '不锈钢自动扣荔枝纹牛皮正装腰带', '69.00', '129.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_kixvwy.JPG', 'data/images/201212/19/goods_kixvwy.JPG', 'data/images/201212/19/kixvwy.JPG', '1', '0', '0', '0', '0', '1355917090', '0');
INSERT INTO `goods` VALUES ('24', 'BL2012121926113', '12', '0', '黑色烤漆不锈钢自动扣细纹牛皮正装腰带', '89.00', '169.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_avkfd4.JPG', 'data/images/201212/19/goods_avkfd4.JPG', 'data/images/201212/19/avkfd4.JPG', '1', '0', '0', '0', '0', '1355917125', '0');
INSERT INTO `goods` VALUES ('25', 'BL2012121943041', '12', '0', '银色不锈钢针扣头层小牛皮二层同色皮底正装腰带', '99.00', '169.00', '1', '0', '0.000', '', '', 'data/images/201212/19/thumb_nv7cas.JPG', 'data/images/201212/19/goods_nv7cas.JPG', 'data/images/201212/19/nv7cas.JPG', '1', '0', '0', '0', '0', '1355917162', '0');

-- ----------------------------
-- Table structure for ordergoods
-- ----------------------------
DROP TABLE IF EXISTS `ordergoods`;
CREATE TABLE `ordergoods` (
  `og_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` char(15) NOT NULL DEFAULT '',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(60) NOT NULL DEFAULT '',
  `goods_number` smallint(6) NOT NULL DEFAULT '1',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`og_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordergoods
-- ----------------------------

-- ----------------------------
-- Table structure for orderinfo
-- ----------------------------
DROP TABLE IF EXISTS `orderinfo`;
CREATE TABLE `orderinfo` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` char(15) NOT NULL DEFAULT '',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `zone` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(30) NOT NULL DEFAULT '',
  `zipcode` char(6) NOT NULL DEFAULT '',
  `reciver` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `building` varchar(30) NOT NULL DEFAULT '',
  `best_time` varchar(10) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orderinfo
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL DEFAULT '',
  `passwd` char(32) NOT NULL DEFAULT '',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastlogin` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
