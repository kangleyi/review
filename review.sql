/*
 Navicat Premium Data Transfer

 Source Server         : 本地服务器
 Source Server Type    : MariaDB
 Source Server Version : 100213
 Source Host           : localhost:3306
 Source Schema         : review

 Target Server Type    : MariaDB
 Target Server Version : 100213
 File Encoding         : 65001

 Date: 22/10/2018 14:45:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for movie
-- ----------------------------
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `years` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `director` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `actor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `flag` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie
-- ----------------------------
INSERT INTO `movie` VALUES (1, '动作片1', '2018', '等效', '阿达', '/src/a.png', 'asdada', 0);
INSERT INTO `movie` VALUES (2, '动作片', '2017', '等效', '阿达', '/src/a.png', 'asdada', 0);
INSERT INTO `movie` VALUES (3, '动作片', '2018', '等效', '阿达', '/src/a.png', 'asdada', 0);
INSERT INTO `movie` VALUES (4, '动作片', '2017', '等效', '阿达', '/src/a.png', 'asdada', 1);

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `create_id` int(11) DEFAULT NULL,
  `create_time` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for review
-- ----------------------------
DROP TABLE IF EXISTS `review`;
CREATE TABLE `review`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `create_id` int(11) DEFAULT NULL,
  `create_time` datetime(0) DEFAULT NULL,
  `del_flag` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '0',
  `is_pass` int(255) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of review
-- ----------------------------
INSERT INTO `review` VALUES (1, 3, 'asdada', 1, '2018-10-22 13:31:37', '0', 0);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `nick` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `is_admin` int(255) DEFAULT 0,
  `is_forbid` int(11) DEFAULT 0,
  `del_flag` int(255) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '1', '1', '哈哈哈', 0, 1, 1);
INSERT INTO `user` VALUES (2, 'C81E728D9D4C2F636F067F89CC14862C', 'adas', 'asdas', 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
