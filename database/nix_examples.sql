/*
Source Server         : localhost
Source Server Version : 5620
Source Host           : localhost:3306
Source Database       : nix_examples

Target Server Type    : MYSQL
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ------------------------
-- Database: `nix_examples`
-- ------------------------
CREATE DATABASE IF NOT EXISTS `nix_examples` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nix_examples`;

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `albums`
-- ----------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `artist_id` int(100) NOT NULL,
  `disk` enum('klasický','dvoj','troj','více') COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of albums
-- ----------------------------
INSERT INTO `albums` VALUES ('1', 'Album A', '1', 'klasický');
INSERT INTO `albums` VALUES ('2', 'Beta', '1', 'klasický');
INSERT INTO `albums` VALUES ('3', 'Common problems', '2', 'klasický');

-- ----------------------------
-- Table structure for `artists`
-- ----------------------------
DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `partner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of artists
-- ----------------------------
INSERT INTO `artists` VALUES ('1', 'Cally McDown');
INSERT INTO `artists` VALUES ('2', 'Peter File');

-- ----------------------------
-- Table structure for `partners`
-- ----------------------------
DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;