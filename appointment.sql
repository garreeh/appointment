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

 Date: 23/11/2025 19:32:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_logs
-- ----------------------------
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs`  (
  `activity_log_id` int NOT NULL AUTO_INCREMENT,
  `actions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`activity_log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activity_logs
-- ----------------------------
INSERT INTO `activity_logs` VALUES (20, 'Edited a Category, Category ID: 10, changed into: Consultations', 1, '2025-11-09 17:19:02');
INSERT INTO `activity_logs` VALUES (21, 'Edited a Category, Category ID: 10, changed into: Consultations', 1, '2025-11-09 17:19:08');
INSERT INTO `activity_logs` VALUES (22, 'Deleted a Category ID: 14', 1, '2025-11-09 17:20:09');
INSERT INTO `activity_logs` VALUES (23, 'Added a Timeslot', 1, '2025-11-09 17:21:17');
INSERT INTO `activity_logs` VALUES (24, 'Edotd a Timeslot ID: 31', 1, '2025-11-09 17:22:08');
INSERT INTO `activity_logs` VALUES (25, 'Added a Unavailable Dates', 1, '2025-11-09 17:23:13');
INSERT INTO `activity_logs` VALUES (26, 'Edited a Unavailable Date, ID: 3', 1, '2025-11-09 17:24:23');
INSERT INTO `activity_logs` VALUES (27, 'Added a Vaccination: qwe', 1, '2025-11-09 17:25:24');
INSERT INTO `activity_logs` VALUES (28, 'Edited a Vaccination, Vaccination ID: 1', 1, '2025-11-09 17:26:30');
INSERT INTO `activity_logs` VALUES (29, 'Tagged appointment ID #1038 as Ongoing', 1, '2025-11-15 08:58:01');
INSERT INTO `activity_logs` VALUES (30, 'Tagged appointment ID #1038 as Complete', 1, '2025-11-15 08:58:07');
INSERT INTO `activity_logs` VALUES (31, 'Tagged appointment ID #1039 as Ongoing', 1, '2025-11-15 09:20:28');
INSERT INTO `activity_logs` VALUES (32, 'Tagged appointment ID #1039 as Complete', 1, '2025-11-15 09:20:35');
INSERT INTO `activity_logs` VALUES (33, 'Tagged appointment ID #1040 as Ongoing', 1, '2025-11-15 09:25:17');

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
  `notification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`appointment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1048 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of appointment
-- ----------------------------

-- ----------------------------
-- Table structure for billing
-- ----------------------------
DROP TABLE IF EXISTS `billing`;
CREATE TABLE `billing`  (
  `billing_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL DEFAULT 0,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `payment_proof` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `reference_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`billing_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of billing
-- ----------------------------
INSERT INTO `billing` VALUES (24, 1, 400, 'Unpaid', '2024-11-09 16:43:33', '2025-05-14 13:21:49', '', '', 'Cash');
INSERT INTO `billing` VALUES (25, 2, 400, 'Unpaid', '2024-11-09 16:50:09', '2025-05-14 12:54:27', '', '', 'Cash');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` int NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (10, 'Consultations', 3000, '2024-10-21 10:46:42', '2025-11-09 17:19:02');
INSERT INTO `category` VALUES (12, 'Surgery', 2000, '2024-10-21 10:50:03', '2024-10-21 11:05:15');
INSERT INTO `category` VALUES (13, 'Diagnostic and Magic Examination', 20, '2024-10-21 11:05:27', '2024-10-21 11:05:27');

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of file_uploads
-- ----------------------------

-- ----------------------------
-- Table structure for inside_billing
-- ----------------------------
DROP TABLE IF EXISTS `inside_billing`;
CREATE TABLE `inside_billing`  (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `billing_id` int NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `vaccine_id` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `items` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` int NULL DEFAULT NULL,
  PRIMARY KEY (`bill_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inside_billing
-- ----------------------------
INSERT INTO `inside_billing` VALUES (64, 24, 1, NULL, NULL, '2024-11-24 12:28:08', '2024-11-24 12:28:08', 'Vaccination | Deworming', 2000);
INSERT INTO `inside_billing` VALUES (65, 24, 1, NULL, NULL, '2024-11-24 12:29:09', '2024-11-24 12:29:09', 'Diagnostic and Magic Examination', 20);
INSERT INTO `inside_billing` VALUES (66, 24, 1, NULL, NULL, '2024-11-24 12:30:18', '2024-11-24 12:30:18', 'Vaccination | Deworming', 2000);
INSERT INTO `inside_billing` VALUES (67, 24, 1, NULL, NULL, '2024-11-24 12:32:45', '2024-11-24 12:32:45', 'Vaccination | Deworming', 2000);
INSERT INTO `inside_billing` VALUES (68, 25, 2, NULL, NULL, '2024-11-24 13:05:15', '2024-11-24 13:05:15', 'Surgery', 2000);
INSERT INTO `inside_billing` VALUES (69, 24, 1, NULL, NULL, '2024-11-24 13:09:55', '2024-11-24 13:09:55', 'Vaccination | Deworming', 2000);
INSERT INTO `inside_billing` VALUES (70, 25, 2, NULL, NULL, '2024-11-24 13:13:26', '2024-11-24 13:13:26', 'Vaccination | Deworming', 2000);
INSERT INTO `inside_billing` VALUES (71, 25, 2, NULL, NULL, '2024-11-24 13:13:30', '2024-11-24 13:13:30', 'Vaccine test 5', 1);

-- ----------------------------
-- Table structure for keyword_fetched
-- ----------------------------
DROP TABLE IF EXISTS `keyword_fetched`;
CREATE TABLE `keyword_fetched`  (
  `response_id` int NOT NULL,
  `client` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  INDEX `response_id`(`response_id` ASC) USING BTREE,
  CONSTRAINT `response_id_fk_kf` FOREIGN KEY (`response_id`) REFERENCES `response_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of keyword_fetched
-- ----------------------------
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (6, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (7, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (6, '::1');
INSERT INTO `keyword_fetched` VALUES (6, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (6, '::1');
INSERT INTO `keyword_fetched` VALUES (6, '::1');
INSERT INTO `keyword_fetched` VALUES (6, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (5, '::1');
INSERT INTO `keyword_fetched` VALUES (1, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (5, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');
INSERT INTO `keyword_fetched` VALUES (5, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (3, '::1');
INSERT INTO `keyword_fetched` VALUES (5, '::1');
INSERT INTO `keyword_fetched` VALUES (4, '::1');

-- ----------------------------
-- Table structure for keyword_list
-- ----------------------------
DROP TABLE IF EXISTS `keyword_list`;
CREATE TABLE `keyword_list`  (
  `response_id` int NOT NULL,
  `keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  INDEX `response_id`(`response_id` ASC) USING BTREE,
  CONSTRAINT `response_id_fk_kl` FOREIGN KEY (`response_id`) REFERENCES `response_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of keyword_list
-- ----------------------------
INSERT INTO `keyword_list` VALUES (1, 'Inquire');
INSERT INTO `keyword_list` VALUES (1, 'Hi');
INSERT INTO `keyword_list` VALUES (3, 'Contact Details');
INSERT INTO `keyword_list` VALUES (3, 'Contact');
INSERT INTO `keyword_list` VALUES (3, 'Details');
INSERT INTO `keyword_list` VALUES (4, 'Open Hours');
INSERT INTO `keyword_list` VALUES (4, 'Hours');
INSERT INTO `keyword_list` VALUES (4, 'Time');
INSERT INTO `keyword_list` VALUES (5, 'How does this work?');
INSERT INTO `keyword_list` VALUES (1, 'Hello');

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pets
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prescription
-- ----------------------------

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
-- Table structure for response_list
-- ----------------------------
DROP TABLE IF EXISTS `response_list`;
CREATE TABLE `response_list`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of response_list
-- ----------------------------
INSERT INTO `response_list` VALUES (1, 'The price range for veterinary appointments typically varies based on the type of service. Consultation starts at $50, and other treatments vary. Please contact us for specific pricing.', 1, '2022-05-05 10:30:35', '2024-11-09 15:31:26');
INSERT INTO `response_list` VALUES (3, 'For appointment inquiries, please contact us at:\n      <br><br>\n      <strong>Phone:</strong> 123-456-7890\n      <br>\n      <strong>Email:</strong> info@vetclinic.com\n      <br>\n      <strong>Office Hours:</strong> Monday to Friday, 9:00 AM to 5:00 PM\n      <br><br>\n      Feel free to reach out with any questions or to schedule your appointment!', 1, '2022-05-05 11:38:44', '2024-11-09 15:37:05');
INSERT INTO `response_list` VALUES (4, 'Our clinic\'s opening hours are as follows:\r\n      <br><br>\r\n      <strong>Monday to Friday:</strong> 9:00 AM - 5:00 PM\r\n      <br>\r\n      <strong>Saturday:</strong> 10:00 AM - 3:00 PM\r\n      <br>\r\n      <strong>Sunday:</strong> Closed\r\n      <br><br>\r\n      If you need any assistance, feel free to reach out within our operating hours!', 1, '2022-05-05 14:40:29', '2024-11-09 15:42:42');
INSERT INTO `response_list` VALUES (5, 'Just pick one of the suggestions, or you can create an account to login to our database to set an appointment.', 1, '2022-05-05 14:41:00', '2024-11-09 15:44:18');
INSERT INTO `response_list` VALUES (6, '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Pellentesque rutrum mi sem. Duis nisl arcu, mollis sed porttitor et, feugiat vel augue. Fusce pulvinar leo non ex convallis lacinia. In ullamcorper, nibh nec dignissim gravida, nibh leo placerat nisl, a dapibus quam nulla dictum est. Vestibulum rutrum vestibulum ex. Quisque eget mi nec orci vulputate pharetra quis quis sem.</span><br></p>', 1, '2022-05-05 14:41:36', '2022-05-05 14:41:36');
INSERT INTO `response_list` VALUES (7, '<p>On this simple ChatBot Application, You can query anything and the system will automatically browse a response that is stored on this site. </p><p>The queries fetch a response that has an equivalent keyword.</p><p>Also, the application consists of suggestion keywords to query.</p>', 1, '2022-05-05 15:19:35', '2022-05-05 15:28:59');

-- ----------------------------
-- Table structure for suggestion_list
-- ----------------------------
DROP TABLE IF EXISTS `suggestion_list`;
CREATE TABLE `suggestion_list`  (
  `response_id` int NOT NULL,
  `suggestion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  INDEX `response_id`(`response_id` ASC) USING BTREE,
  CONSTRAINT `response_id_fk_sl` FOREIGN KEY (`response_id`) REFERENCES `response_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suggestion_list
-- ----------------------------
INSERT INTO `suggestion_list` VALUES (1, 'Hi');
INSERT INTO `suggestion_list` VALUES (1, 'Inquire');
INSERT INTO `suggestion_list` VALUES (3, 'Contact Details');
INSERT INTO `suggestion_list` VALUES (4, 'Open Hours');
INSERT INTO `suggestion_list` VALUES (5, 'How does this work?');

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
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of timeslot
-- ----------------------------
INSERT INTO `timeslot` VALUES (31, '09:00:00', '09:15:00', '2024-10-21 11:51:09', '2024-10-21 11:51:09');
INSERT INTO `timeslot` VALUES (33, '09:15:00', '09:30:00', '2024-10-21 11:54:03', '2024-10-21 11:54:57');
INSERT INTO `timeslot` VALUES (34, '09:30:00', '09:45:00', '2024-10-21 11:55:11', '2024-10-21 11:55:11');
INSERT INTO `timeslot` VALUES (35, '09:45:00', '10:00:00', '2024-10-21 11:55:24', '2024-10-21 11:55:24');
INSERT INTO `timeslot` VALUES (36, '10:15:00', '10:30:00', '2024-10-21 11:55:32', '2024-10-21 11:55:32');
INSERT INTO `timeslot` VALUES (37, '10:45:00', '11:00:00', '2024-10-21 13:39:11', '2024-10-21 13:39:11');
INSERT INTO `timeslot` VALUES (38, '17:30:00', '18:30:00', '2025-05-14 12:42:22', '2025-05-14 12:42:22');
INSERT INTO `timeslot` VALUES (39, '19:00:00', '08:00:00', '2025-05-14 12:42:34', '2025-05-14 12:42:34');
INSERT INTO `timeslot` VALUES (40, '23:27:00', '00:00:00', '2025-11-09 17:21:17', '2025-11-09 17:21:17');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unavailable_dates
-- ----------------------------
INSERT INTO `unavailable_dates` VALUES (3, '2025-11-15', '2024-10-21 12:23:32', '2025-11-09 17:24:23');
INSERT INTO `unavailable_dates` VALUES (5, '2025-11-21', '2025-11-09 17:23:13', '2025-11-09 17:23:13');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remember_me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `user_type_id` int NULL DEFAULT NULL,
  `is_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `account_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `terms_and_condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Francis Magsino', 'francis', 'qweqwe', '123123123123123', '$2y$10$HhXfI0GmDXfIwxj.WojaG.3p1OMrwDM8y0TIACdj.oWH.9o1r/nqu', '123123', '', '2024-04-07 16:08:00', '2025-11-23 19:27:04', 1, '1', 'Active', 'test', NULL);
INSERT INTO `users` VALUES (2, 'Eavan Bonagua', 'eavan', '123123@gmail.comm', '123123123123', '$2y$10$HhXfI0GmDXfIwxj.WojaG.3p1OMrwDM8y0TIACdj.oWH.9o1r/nqu', '123123', NULL, '2024-05-13 18:18:17', '2025-11-23 19:28:32', 1, '1', 'Active', NULL, NULL);
INSERT INTO `users` VALUES (39, 'Jano Halina', 'jano', '123123@gmail.comm', '123123123123', '$2y$10$HhXfI0GmDXfIwxj.WojaG.3p1OMrwDM8y0TIACdj.oWH.9o1r/nqu', '123123', NULL, '2024-09-13 23:58:14', '2025-11-23 19:29:03', 1, '1', 'Active', '1', NULL);

-- ----------------------------
-- Table structure for usertype
-- ----------------------------
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype`  (
  `user_type_id` int NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `appointments_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `user_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `reports_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `patient_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `billing_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `appointment_setup_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `vaccine_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`user_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usertype
-- ----------------------------
INSERT INTO `usertype` VALUES (1, 'Admin', '2024-09-04 10:46:35', '2024-11-24 20:13:14', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `usertype` VALUES (3, 'Doctor', '2024-09-04 10:46:46', '2024-10-21 11:08:38', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `usertype` VALUES (4, 'Vet Nurse', '2024-10-12 11:21:06', '2024-11-24 20:16:06', '1', '1', '1', '1', '1', '1', '0');
INSERT INTO `usertype` VALUES (5, 'Test', '2025-11-09 15:49:21', '2025-11-09 15:49:29', '1', '1', '1', '0', '1', '1', '1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vaccination
-- ----------------------------
INSERT INTO `vaccination` VALUES (1, 2, 3, 5, '2024-10-24', '2024-10-26 12:37:19', '2025-11-09 17:07:03');
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
  `price` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vaccine_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vaccine
-- ----------------------------
INSERT INTO `vaccine` VALUES (1, 'Vaccine 12', 1, '2024-10-26 11:16:11', '2025-11-09 17:26:30');
INSERT INTO `vaccine` VALUES (2, 'Vaccine 2', 1111, '2024-10-26 11:16:40', '2024-10-26 11:22:31');
INSERT INTO `vaccine` VALUES (3, 'Vaccine 3', 123, '2024-10-26 11:21:01', '2024-10-26 11:21:01');
INSERT INTO `vaccine` VALUES (4, 'Vaccine test 5', 1, '2024-10-26 12:23:58', '2024-10-26 12:23:58');
INSERT INTO `vaccine` VALUES (5, 'q', 123123, '2024-10-26 12:28:37', '2024-10-26 12:28:37');
INSERT INTO `vaccine` VALUES (6, '123123', 123123, '2024-10-26 12:28:50', '2024-10-26 12:28:50');
INSERT INTO `vaccine` VALUES (7, '123123', 11, '2024-10-26 12:29:10', '2024-10-26 12:29:15');
INSERT INTO `vaccine` VALUES (8, 'qwe', 123, '2025-11-09 17:25:24', '2025-11-09 17:25:24');

SET FOREIGN_KEY_CHECKS = 1;
