/*
 Navicat Premium Data Transfer

 Source Server         : PersonalProjectDB
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : appointment

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 26/10/2024 23:17:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for appointment
-- ----------------------------
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment`  (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `queue_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `pet_id` int NULL DEFAULT NULL,
  `timeslot_id` int NULL DEFAULT NULL,
  `appointment_date` date NULL DEFAULT NULL,
  `appointment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`appointment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1041 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of appointment
-- ----------------------------
INSERT INTO `appointment` VALUES (1038, 'APP00030911', 2, 11, 3, 31, '2024-10-28', 'Ongoing', '2024-10-26 22:59:55', '2024-10-26 23:00:31');
INSERT INTO `appointment` VALUES (1039, 'APP00006827', 2, 11, 4, 31, '2024-10-29', 'Ongoing', '2024-10-26 23:00:03', '2024-10-26 23:00:32');
INSERT INTO `appointment` VALUES (1040, 'APP00089340', 2, 12, 5, 33, '2024-10-29', 'Ongoing', '2024-10-26 23:00:12', '2024-10-26 23:08:17');

-- ----------------------------
-- Table structure for billing
-- ----------------------------
DROP TABLE IF EXISTS `billing`;
CREATE TABLE `billing`  (
  `billing_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `sub_total` int NOT NULL DEFAULT 0,
  `discount` int NOT NULL,
  `total_less_discount` int NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Unpaid',
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`billing_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of billing
-- ----------------------------
INSERT INTO `billing` VALUES (20, NULL, 0, 0, 0, 'Unpaid', '', 1, '2024-05-13 18:15:13', '2024-05-13 18:15:13');
INSERT INTO `billing` VALUES (21, NULL, 0, 0, 0, 'Unpaid', '', 2, '2024-05-13 18:18:35', '2024-05-13 18:18:35');
INSERT INTO `billing` VALUES (22, NULL, 0, 0, 0, 'Unpaid', '', 1, '2024-05-14 10:28:00', '2024-05-14 10:28:00');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (10, 'Consultation', 3000.00, '2024-10-21 10:46:42', '2024-10-21 11:04:59');
INSERT INTO `category` VALUES (11, 'Vaccination | Deworming', 2000.00, '2024-10-21 10:49:53', '2024-10-21 11:05:09');
INSERT INTO `category` VALUES (12, 'Surgery', 2000.00, '2024-10-21 10:50:03', '2024-10-21 11:05:15');
INSERT INTO `category` VALUES (13, 'Diagnostic and Magic Examination', 20.00, '2024-10-21 11:05:27', '2024-10-21 11:05:27');

-- ----------------------------
-- Table structure for file_uploads
-- ----------------------------
DROP TABLE IF EXISTS `file_uploads`;
CREATE TABLE `file_uploads`  (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `pet_id` int NULL DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of file_uploads
-- ----------------------------
INSERT INTO `file_uploads` VALUES (8, 2, 3, '11.jpeg', '../../uploads/files/11.jpeg', '2024-10-26 14:38:07', '2024-10-26 23:16:55');
INSERT INTO `file_uploads` VALUES (9, 2, 3, 'Screenshot 2024-10-21 110701.png', '../../uploads/files/Screenshot 2024-10-21 110701.png', '2024-10-26 14:38:10', '2024-10-26 14:38:10');

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payment
-- ----------------------------

-- ----------------------------
-- Table structure for payment_category
-- ----------------------------
DROP TABLE IF EXISTS `payment_category`;
CREATE TABLE `payment_category`  (
  `payment_category_id` int NOT NULL AUTO_INCREMENT,
  `payment_category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payment_category
-- ----------------------------
INSERT INTO `payment_category` VALUES (1, 'Cash on Delivery', '2024-09-18 09:42:45', '2024-09-18 09:42:56');
INSERT INTO `payment_category` VALUES (2, 'Gcash', '2024-09-18 09:43:01', '2024-09-18 09:43:01');

-- ----------------------------
-- Table structure for pets
-- ----------------------------
DROP TABLE IF EXISTS `pets`;
CREATE TABLE `pets`  (
  `pet_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `pet_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `breed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `species` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `birthdate` date NULL DEFAULT NULL,
  `neutered` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pet_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pets
-- ----------------------------
INSERT INTO `pets` VALUES (3, 2, 'Albert', '2024-10-21 13:22:22', '2024-10-26 11:25:41', 'Bulldog Half Human', 'Feline', '2024-10-21', 'No');
INSERT INTO `pets` VALUES (4, 2, 'Garry', '2024-10-21 13:28:29', '2024-10-26 11:25:46', 'Bulldog Half Human', 'Canine', '2024-10-21', 'Yes');
INSERT INTO `pets` VALUES (5, 2, 'Patrick', '2024-10-26 10:04:56', '2024-10-26 11:25:54', 'Bulldog Half Human', 'Feline', '2024-12-12', 'Yes');
INSERT INTO `pets` VALUES (6, 2, 'Negro', '2024-10-26 10:05:28', '2024-10-26 11:26:05', '12', 'Canine', '2024-12-12', 'No');
INSERT INTO `pets` VALUES (7, 2, 'Astra my boy', '2024-10-26 11:35:10', '2024-10-26 11:35:10', '1', 'Canine', '2000-02-12', 'Yes');

-- ----------------------------
-- Table structure for prescription
-- ----------------------------
DROP TABLE IF EXISTS `prescription`;
CREATE TABLE `prescription`  (
  `prescription_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `pet_id` int NULL DEFAULT NULL,
  `prescription_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prescription_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prescription
-- ----------------------------
INSERT INTO `prescription` VALUES (1, 2, 3, 'qweqwe', '2024-10-26 11:46:31', '2024-10-26 11:46:31');
INSERT INTO `prescription` VALUES (2, 2, 3, 'qweqweqweqweqwe', '2024-10-26 11:47:01', '2024-10-26 11:47:01');
INSERT INTO `prescription` VALUES (3, 2, 3, 'qweqwe', '2024-10-26 11:47:20', '2024-10-26 11:47:20');
INSERT INTO `prescription` VALUES (4, 2, 3, '1', '2024-10-26 11:47:24', '2024-10-26 12:14:40');
INSERT INTO `prescription` VALUES (5, 2, 4, 'qweqwe', '2024-10-26 11:49:39', '2024-10-26 11:49:39');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_stocks` int NULL DEFAULT NULL,
  `product_unitprice` decimal(10, 2) NULL DEFAULT NULL,
  `product_sellingprice` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (17, 26, 1, '11', 'DESCRIPTION PRODUCT 1', '../../uploads/1.png', '11', 1, 11.00, 11.00, '2024-09-05 14:39:33', '2024-10-12 11:11:32');
INSERT INTO `product` VALUES (18, 27, 2, '22', 'DESCRIPTION PRODUCT 2', '../../uploads/2.png', '22', -9, 22.00, 22.00, '2024-09-05 14:40:14', '2024-10-11 21:00:23');
INSERT INTO `product` VALUES (19, 26, 1, 'dogfood ni bert', 'DESCRIPTION PRODUCT 3', '../../uploads/3.png', 'dogfood ni bert', 32, 1.00, 1.00, '2024-09-05 14:40:51', '2024-10-12 14:24:04');
INSERT INTO `product` VALUES (20, 26, 7, 'Test', 'DESCRIPTION PRODUCT 4', '../../uploads/test.jpg', '123', 97, 200.00, 300.00, '2024-09-06 22:20:40', '2024-09-26 16:16:30');
INSERT INTO `product` VALUES (21, 28, 1, 'VSS', 'VSS', '../../uploads/VSS APPLICATION.png', '123123123', 0, 1000.00, 1100.00, '2024-09-18 17:45:50', '2024-09-18 17:45:50');

-- ----------------------------
-- Table structure for purchase_order
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE `purchase_order`  (
  `purchase_order_id` int NOT NULL AUTO_INCREMENT,
  `purchase_number` int NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order
-- ----------------------------
INSERT INTO `purchase_order` VALUES (8, 4, 27, 18, 6, '2024-09-05 16:05:41', '2024-09-06 11:45:40');
INSERT INTO `purchase_order` VALUES (9, 2, 26, 17, 12, '2024-09-05 16:38:36', '2024-10-12 11:11:32');
INSERT INTO `purchase_order` VALUES (10, 1, 26, 19, 10, '2024-09-05 16:55:57', '2024-09-05 16:55:57');
INSERT INTO `purchase_order` VALUES (11, 1, 27, 18, 1, '2024-09-06 11:45:19', '2024-09-06 11:45:19');
INSERT INTO `purchase_order` VALUES (12, 123, 26, 17, 10, '2024-09-06 11:51:02', '2024-09-06 11:51:02');
INSERT INTO `purchase_order` VALUES (13, 123123, 26, 19, 10, '2024-09-06 21:21:51', '2024-09-06 21:21:51');
INSERT INTO `purchase_order` VALUES (14, 123123, 26, 20, 100, '2024-09-06 22:21:19', '2024-09-06 22:21:19');
INSERT INTO `purchase_order` VALUES (15, 12314, 26, 17, 10, '2024-09-18 17:41:02', '2024-09-18 17:41:02');
INSERT INTO `purchase_order` VALUES (16, 23, 26, 19, 23, '2024-10-12 11:10:32', '2024-10-12 11:10:32');

-- ----------------------------
-- Table structure for timeslot
-- ----------------------------
DROP TABLE IF EXISTS `timeslot`;
CREATE TABLE `timeslot`  (
  `timeslot_id` int NOT NULL AUTO_INCREMENT,
  `time_from` time NULL DEFAULT NULL,
  `time_to` time NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`timeslot_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of timeslot
-- ----------------------------
INSERT INTO `timeslot` VALUES (31, '09:00:00', '09:15:00', '2024-10-21 11:51:09', '2024-10-21 11:51:09');
INSERT INTO `timeslot` VALUES (33, '09:15:00', '09:30:00', '2024-10-21 11:54:03', '2024-10-21 11:54:57');
INSERT INTO `timeslot` VALUES (34, '09:30:00', '09:45:00', '2024-10-21 11:55:11', '2024-10-21 11:55:11');
INSERT INTO `timeslot` VALUES (35, '09:45:00', '10:00:00', '2024-10-21 11:55:24', '2024-10-21 11:55:24');
INSERT INTO `timeslot` VALUES (36, '10:15:00', '10:30:00', '2024-10-21 11:55:32', '2024-10-21 11:55:32');
INSERT INTO `timeslot` VALUES (37, '10:45:00', '11:00:00', '2024-10-21 13:39:11', '2024-10-21 13:39:11');

-- ----------------------------
-- Table structure for unavailable_dates
-- ----------------------------
DROP TABLE IF EXISTS `unavailable_dates`;
CREATE TABLE `unavailable_dates`  (
  `unavailable_id` int NOT NULL AUTO_INCREMENT,
  `unavailable_date` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unavailable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unavailable_dates
-- ----------------------------
INSERT INTO `unavailable_dates` VALUES (3, '2024-10-31', '2024-10-21 12:23:32', '2024-10-21 12:23:32');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_contact` int NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remember_me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `user_type_id` int NULL DEFAULT NULL,
  `is_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `account_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Garry Gajultos', 'garry', '123123@gmail.com', 123123123, '$2y$10$vtj3lvgROA.ecVm2oI2YnOrlhFzn1jNE/sMk72HTTH.ymfaBol9jW', '123123', '', '2024-04-07 16:08:00', '2024-09-04 15:57:51', NULL, '1', 'Active', '1');
INSERT INTO `users` VALUES (2, 'Test Account', 'Ron', '123123@gmail.comm', NULL, '$2y$10$Wtj4pYEWKXHYe4DUwLPTveZdPJUNrXwfkfeZRWXO4bnmbNd9NOA9y', 'test1005', NULL, '2024-05-13 18:18:17', '2024-10-12 14:19:57', 4, '0', 'Active', NULL);
INSERT INTO `users` VALUES (39, '1', 'test', '', 1, '$2y$10$XX19Ar6P.ig1stK9lZ0N2eP89FY5FughUlK0xhgDfLj1P60tMMPva', '1', NULL, '2024-09-13 23:58:14', '2024-10-21 13:43:56', 4, '1', 'Active', '1');
INSERT INTO `users` VALUES (40, 'Test', 'Account', '', 1, '$2y$10$nqzLAJIYpH8nYjFextCGJe6SKeqUvpZEfcbKW6R0KqBIzDFn0PdJe', '123123', NULL, '2024-10-21 11:20:20', '2024-10-21 13:43:57', 3, '1', 'Inactive', 'nayong Lourdes');
INSERT INTO `users` VALUES (41, 'Ronnel Cruz', 'ronnel', 'gajultos.garrydev@gmail.com', 2147483647, '$2y$10$M0pu4qQOqxpix/ASuvZZX.svI.ngiv4/Av2EeP4eVrwzEanorrKHi', '123123', NULL, '2024-10-21 13:47:43', '2024-10-21 13:47:54', NULL, '0', 'Active', 'Nayong Lourdes Blk 3 Lot 21');

-- ----------------------------
-- Table structure for usertype
-- ----------------------------
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype`  (
  `user_type_id` int NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `inventory_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `user_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `reports_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `po_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`user_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usertype
-- ----------------------------
INSERT INTO `usertype` VALUES (2, 'Admin', '2024-09-04 10:46:35', '2024-09-04 17:09:22', '0', '1', '1', '1');
INSERT INTO `usertype` VALUES (3, 'Doctor', '2024-09-04 10:46:46', '2024-10-21 11:08:38', '1', '1', '1', '1');
INSERT INTO `usertype` VALUES (4, 'Vet Nurse', '2024-10-12 11:21:06', '2024-10-21 11:08:41', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for vaccination
-- ----------------------------
DROP TABLE IF EXISTS `vaccination`;
CREATE TABLE `vaccination`  (
  `vaccination_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `pet_id` int NULL DEFAULT NULL,
  `vaccine_id` int NULL DEFAULT NULL,
  `expiration_date` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vaccination_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vaccination
-- ----------------------------
INSERT INTO `vaccination` VALUES (1, 2, 3, 1, '2024-10-24', '2024-10-26 12:37:19', '2024-10-26 13:00:38');
INSERT INTO `vaccination` VALUES (2, 2, 3, 2, '2026-12-12', '2024-10-26 12:38:37', '2024-10-26 12:38:37');
INSERT INTO `vaccination` VALUES (3, 2, 4, 6, '2022-02-12', '2024-10-26 12:51:32', '2024-10-26 12:51:32');
INSERT INTO `vaccination` VALUES (4, 2, 4, 1, '1222-12-12', '2024-10-26 12:52:33', '2024-10-26 12:52:33');
INSERT INTO `vaccination` VALUES (5, 2, 4, 5, '2222-02-01', '2024-10-26 12:52:40', '2024-10-26 12:52:40');

-- ----------------------------
-- Table structure for vaccine
-- ----------------------------
DROP TABLE IF EXISTS `vaccine`;
CREATE TABLE `vaccine`  (
  `vaccine_id` int NOT NULL AUTO_INCREMENT,
  `vaccine_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vaccine_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vaccine
-- ----------------------------
INSERT INTO `vaccine` VALUES (1, 'Vaccine 1', 1.00, '2024-10-26 11:16:11', '2024-10-26 12:25:05');
INSERT INTO `vaccine` VALUES (2, 'Vaccine 2', 1111.00, '2024-10-26 11:16:40', '2024-10-26 11:22:31');
INSERT INTO `vaccine` VALUES (3, 'Vaccine 3', 123.00, '2024-10-26 11:21:01', '2024-10-26 11:21:01');
INSERT INTO `vaccine` VALUES (4, 'Vaccine test 5', 1.00, '2024-10-26 12:23:58', '2024-10-26 12:23:58');
INSERT INTO `vaccine` VALUES (5, 'q', 123123.00, '2024-10-26 12:28:37', '2024-10-26 12:28:37');
INSERT INTO `vaccine` VALUES (6, '123123', 123123.00, '2024-10-26 12:28:50', '2024-10-26 12:28:50');
INSERT INTO `vaccine` VALUES (7, '123123', 11.00, '2024-10-26 12:29:10', '2024-10-26 12:29:15');

SET FOREIGN_KEY_CHECKS = 1;
