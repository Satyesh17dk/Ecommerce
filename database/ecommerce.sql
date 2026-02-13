-- Adminer 4.8.1 MySQL 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_cart_user` (`user_id`),
  KEY `fk_cart_product` (`product_id`),
  CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `login_admin`;
CREATE TABLE `login_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `login_admin` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1,	'satya',	'satyesh@osinfotech.com',	'$2a$12$hcPqu7Io0iyKI1FViICyf.imlPbz8o/Ntrq.jGXtiKuIW6vMQEb7W',	'2026-02-11 08:18:23',	'2026-02-11 10:19:56');

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `order_status` enum('placed','processing','completed','cancelled') DEFAULT 'placed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_order_user` (`user_id`),
  CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `payment_status`, `order_status`, `created_at`, `updated_at`) VALUES
(1,	1,	0.00,	'pending',	'placed',	'2026-02-12 08:36:43',	'2026-02-12 08:36:43'),
(2,	1,	0.00,	'pending',	'placed',	'2026-02-12 08:37:08',	'2026-02-12 08:37:08'),
(3,	1,	0.00,	'pending',	'placed',	'2026-02-12 08:37:31',	'2026-02-12 08:37:31'),
(4,	1,	228351.00,	'pending',	'placed',	'2026-02-12 08:38:59',	'2026-02-12 08:38:59'),
(5,	1,	0.00,	'pending',	'placed',	'2026-02-12 08:39:34',	'2026-02-12 08:39:34'),
(6,	1,	9109.00,	'pending',	'placed',	'2026-02-12 08:41:11',	'2026-02-12 08:41:11'),
(7,	1,	0.00,	'pending',	'placed',	'2026-02-12 11:05:53',	'2026-02-12 11:05:53'),
(8,	1,	0.00,	'pending',	'placed',	'2026-02-12 11:09:34',	'2026-02-12 11:09:34'),
(9,	1,	0.00,	'pending',	'placed',	'2026-02-12 11:10:19',	'2026-02-12 11:10:19'),
(10,	1,	9109.00,	'pending',	'placed',	'2026-02-12 11:15:52',	'2026-02-12 11:15:52'),
(11,	1,	7919.00,	'pending',	'placed',	'2026-02-13 06:36:30',	'2026-02-13 06:36:30'),
(12,	1,	17836.00,	'pending',	'placed',	'2026-02-13 08:38:45',	'2026-02-13 08:38:45'),
(13,	1,	56298.00,	'pending',	'placed',	'2026-02-13 10:00:49',	'2026-02-13 10:00:49');

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orderitem_order` (`order_id`),
  KEY `fk_orderitem_product` (`product_id`),
  CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_orderitem_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_orderitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`) VALUES
(1,	4,	1,	5,	7919.00,	39595.00),
(2,	4,	2,	4,	1190.00,	4760.00),
(3,	4,	3,	4,	45999.00,	183996.00),
(4,	6,	1,	1,	7919.00,	7919.00),
(5,	6,	2,	1,	1190.00,	1190.00),
(6,	10,	1,	1,	7919.00,	7919.00),
(7,	10,	2,	1,	1190.00,	1190.00),
(8,	11,	1,	1,	7919.00,	7919.00),
(9,	12,	1,	2,	7919.00,	15838.00),
(10,	12,	4,	2,	999.00,	1998.00),
(11,	13,	1,	1,	7919.00,	7919.00),
(12,	13,	2,	2,	1190.00,	2380.00),
(13,	13,	3,	1,	45999.00,	45999.00);

DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE `payment_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `payment_gateway` varchar(50) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('success','failed','pending') DEFAULT 'pending',
  `response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_payment_order` (`order_id`),
  CONSTRAINT `fk_payment_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payment_details` (`id`, `order_id`, `payment_gateway`, `transaction_id`, `amount`, `status`, `response`, `created_at`) VALUES
(1,	4,	'Razorpay',	NULL,	228351.00,	'pending',	NULL,	'2026-02-12 08:38:59'),
(2,	6,	'Razorpay',	NULL,	9109.00,	'pending',	NULL,	'2026-02-12 08:41:11'),
(3,	10,	'Razorpay',	NULL,	9109.00,	'pending',	NULL,	'2026-02-12 11:15:52'),
(4,	11,	'Razorpay',	NULL,	7919.00,	'pending',	NULL,	'2026-02-13 06:36:30'),
(5,	12,	'Razorpay',	NULL,	17836.00,	'pending',	NULL,	'2026-02-13 08:38:46'),
(6,	13,	'Razorpay',	NULL,	56298.00,	'pending',	NULL,	'2026-02-13 10:00:49');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Dell Desktop 21 inch',	7919.00,	1,	'2026-02-11 11:35:01',	'2026-02-11 12:17:44'),
(2,	'Dell basic Key-board',	1190.00,	1,	'2026-02-11 11:35:52',	'2026-02-11 11:35:52'),
(3,	'Lennovo PC set',	45999.00,	1,	'2026-02-11 12:30:40',	'2026-02-11 12:30:40'),
(4,	'temp',	999.00,	1,	'2026-02-12 11:40:04',	'2026-02-12 11:40:04'),
(5,	'Lennovo Mother board',	4499.00,	1,	'2026-02-13 06:29:20',	'2026-02-13 06:29:20');

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_product_image` (`product_id`),
  CONSTRAINT `fk_product_image` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_product_images_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`) VALUES
(1,	3,	'uploads/products/1770813040_fabe0ca8d1354576ea59.webp',	'2026-02-11 12:30:40'),
(2,	4,	'uploads/products/1770896405_1563813b555cb8364d43.png',	'2026-02-12 11:40:05'),
(3,	5,	'uploads/products/1770964160_14d0a94fdb3aadda22df.webp',	'2026-02-13 06:29:20'),
(4,	1,	'uploads/products/shopping.webp',	'2026-02-13 08:03:59'),
(5,	2,	'uploads/products/61mwM6q4smL._AC_UF1000,1000_QL80_.jpg',	'2026-02-13 08:11:06');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1,	'Default User',	'user@test.com',	'2026-02-10 11:15:25',	'2026-02-11 11:10:46');

-- 2026-02-13 10:16:58
