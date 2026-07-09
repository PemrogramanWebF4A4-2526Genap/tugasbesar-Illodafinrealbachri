-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for caffin_db
CREATE DATABASE IF NOT EXISTS `caffin_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `caffin_db`;

-- Dumping structure for table caffin_db.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.cache: ~2 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('caffin-cache-buyer@caffin.com|127.0.0.1', 'i:1;', 1783618363),
	('caffin-cache-buyer@caffin.com|127.0.0.1:timer', 'i:1783618363;', 1783618363);

-- Dumping structure for table caffin_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.cache_locks: ~0 rows (approximately)

-- Dumping structure for table caffin_db.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_buyer_id_foreign` (`buyer_id`),
  CONSTRAINT `carts_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.carts: ~1 rows (approximately)
INSERT INTO `carts` (`id`, `buyer_id`, `created_at`, `updated_at`) VALUES
	(1, 4, '2026-06-22 08:53:49', '2026-06-22 08:53:49');

-- Dumping structure for table caffin_db.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.cart_items: ~0 rows (approximately)

-- Dumping structure for table caffin_db.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(4, 'Hoodie', 'Hoodie lengan panjang cotton fleece 300gsm + polyester', '2026-06-24 06:18:50', '2026-06-24 06:18:50'),
	(7, 'Kaos', 'All varian kaos dari caffin', '2026-06-24 18:58:31', '2026-06-24 18:58:31'),
	(8, 'Celana', 'All variant celana dari caffin', '2026-06-24 18:58:42', '2026-06-24 18:59:03'),
	(9, 'Kemeja', 'All variant kemeja dari caffin', '2026-06-24 18:59:29', '2026-06-24 18:59:29');

-- Dumping structure for table caffin_db.conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint unsigned NOT NULL,
  `seller_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conversations_buyer_id_seller_id_product_id_unique` (`buyer_id`,`seller_id`,`product_id`),
  KEY `conversations_seller_id_foreign` (`seller_id`),
  KEY `conversations_product_id_foreign` (`product_id`),
  CONSTRAINT `conversations_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.conversations: ~0 rows (approximately)

-- Dumping structure for table caffin_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table caffin_db.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.jobs: ~0 rows (approximately)

-- Dumping structure for table caffin_db.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.job_batches: ~0 rows (approximately)

-- Dumping structure for table caffin_db.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_conversation_id_foreign` (`conversation_id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.messages: ~0 rows (approximately)

-- Dumping structure for table caffin_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.migrations: ~19 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_06_12_072951_add_role_to_users_table', 2),
	(5, '2026_06_22_141447_create_categories_table', 3),
	(6, '2026_06_22_142956_create_products_table', 4),
	(7, '2026_06_22_153642_create_carts_table', 5),
	(8, '2026_06_22_153643_create_cart_items_table', 5),
	(9, '2026_06_22_155646_create_orders_table', 6),
	(10, '2026_06_22_155646_create_order_items_table', 7),
	(11, '2026_06_24_112347_create_reviews_table', 8),
	(12, '2026_06_24_120346_add_payment_fields_to_orders_table', 9),
	(13, '2026_06_24_122338_fix_payment_fields_in_orders_table', 10),
	(14, '2026_06_24_122533_fix_payment_fields_in_orders_table', 11),
	(15, '2026_06_24_145448_create_wishlists_table', 11),
	(16, '2026_06_25_001143_create_conversations_table', 12),
	(18, '2026_06_25_001142_create_conversations_table', 13),
	(19, '2026_06_25_001143_create_messages_table', 13),
	(20, '2026_06_25_010623_create_product_images_table', 14);

-- Dumping structure for table caffin_db.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint unsigned NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_buyer_id_foreign` (`buyer_id`),
  CONSTRAINT `orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.orders: ~2 rows (approximately)
INSERT INTO `orders` (`id`, `buyer_id`, `total_amount`, `shipping_address`, `payment_proof`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 99000.00, 'jl dutaharapan 3 kota bekasi', NULL, 'unpaid', 'completed', '2026-06-22 09:34:05', '2026-06-24 03:32:49'),
	(2, 4, 65000.00, 'Jl Dutaharapan blok bb9 no 9', 'payments/9UeawYACX6WXxtJxrjFdUbm3ayQtebfyxyay7kYS.png', 'paid', 'completed', '2026-06-24 03:38:33', '2026-06-24 09:00:58');

-- Dumping structure for table caffin_db.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.order_items: ~0 rows (approximately)

-- Dumping structure for table caffin_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table caffin_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_seller_id_foreign` (`seller_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.products: ~4 rows (approximately)
INSERT INTO `products` (`id`, `seller_id`, `category_id`, `name`, `description`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
	(4, 3, 4, 'Hoodie Korean Caffin 300gsm', 'cakepp benerr', 200000.00, 200, 'products/Aap0vsSObTKkN6ZbWqHoWXG1Ufk4p1Roe1JQch3M.webp', '2026-06-24 07:44:22', '2026-06-24 07:44:22'),
	(7, 3, 9, 'Caffin - Cuban Linen Bowling Shirt | Kemeja Linen Lengan Pendek', '✨ Tampil Santai, Tetap Stylish! ✨\r\n\r\nKemeja Linen Cuban Bowling lengan pendek dengan desain kerah terbuka ini cocok buat kamu yang ingin tampil keren tanpa ribet. Terbuat dari bahan linen premium yang lembut, ringan, dan adem, sehingga nyaman dipakai seharian untuk berbagai aktivitas.\r\n\r\n😎 Desain kerah terbuka memberikan kesan casual dan modern, cocok dipadukan dengan celana jeans, chino, maupun short pants favoritmu.\r\n\r\n🎨 Tersedia dalam 4 pilihan warna menarik yang mudah dipadukan dengan berbagai gaya outfit. Kamu bisa bebas memilih warna yang paling sesuai dengan karakter dan kebutuhanmu.\r\n\r\n✅ Bahan nyaman dan adem\r\n✅ Model casual yang stylish\r\n✅ Cocok untuk hangout, kuliah, kerja, hingga acara santai lainnya\r\n✅ Tersedia banyak pilihan warna\r\n\r\n🛡️ Tidak perlu khawatir saat berbelanja! Kami memberikan garansi produk apabila terdapat cacat atau kesalahan produksi saat barang diterima.\r\n\r\nYuk, lengkapi koleksi outfit-mu sekarang dan rasakan kombinasi sempurna antara kenyamanan, kualitas, dan gaya dalam satu kemeja! 🔥👕✨', 150000.00, 499, 'products/69xc8okzCVxuOlg7VzqHL5LZlKTCNFiu8AFBydhF.webp', '2026-06-24 19:23:52', '2026-06-24 19:23:52'),
	(8, 3, 7, 'Regular Tee', NULL, 159.00, 115, 'products/rn2IhnIS1Yk35dAegmHoFDBMTku1V0ytdOqKaQxX.jpg', '2026-07-09 07:47:06', '2026-07-09 07:47:06'),
	(9, 3, 7, 'Boxy Oversize Tee', NULL, 149.00, 125, 'products/DBk8s3D0Kg10s7H1pavb7eHSIa5SypDBbts9jOaV.jpg', '2026-07-09 07:48:53', '2026-07-09 07:48:53');

-- Dumping structure for table caffin_db.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.product_images: ~6 rows (approximately)
INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
	(2, 7, 'products/gallery/Jb6RFwt7Qg6RC1j61HTshMUNQ87di4VPvlay9HcK.webp', '2026-06-24 19:23:52', '2026-06-24 19:23:52'),
	(3, 7, 'products/gallery/3HrgDO8ibwcPJCQKSwTB7lHfnxxQ7S2US2RV9XAK.webp', '2026-06-24 19:23:52', '2026-06-24 19:23:52'),
	(4, 7, 'products/gallery/l95AwidLkgTM22G6kaB1ZIoW1YLxgSML3yk5R3Kg.webp', '2026-06-24 19:23:52', '2026-06-24 19:23:52'),
	(5, 7, 'products/gallery/KdLRhPL2OaGn7KzDLO7R5SxprLvQaKmHTW1eShy1.webp', '2026-06-24 19:23:52', '2026-06-24 19:23:52'),
	(6, 8, 'products/gallery/hI3PVdnXRY0kVFypc9V4kIKoisVuTipIJc8g3zwC.webp', '2026-07-09 07:47:06', '2026-07-09 07:47:06'),
	(7, 9, 'products/gallery/Eq17wRb9mMYTEv7GQJAyVY7BRGywNlK5FMb94hoO.jpg', '2026-07-09 07:48:53', '2026-07-09 07:48:53');

-- Dumping structure for table caffin_db.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_buyer_id_foreign` (`buyer_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `reviews_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.reviews: ~0 rows (approximately)

-- Dumping structure for table caffin_db.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.sessions: ~5 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('5kqvY3L0vnBAGqDqnTywGZKX66XKTVwa0Er6fMHB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJvTklPOXVqS3R5UFZNOVk3SDJmZXZQWFptY0x4NkRxYjl3SmVlalNNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2NhZmZpbi50ZXN0OjgwODBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1783606349),
	('8YhCUyko139I5oAZg1zFuoKoSHyJqkKuEMqPpEoh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ6dk9UZlZMQ2pMbnFiem1Ubzh3MUZiSGZTcmttTVJkbXhHR2pneXlMIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1783606465),
	('M5kJqctFFlKPsm23yacCIqZwwwFsSljV5fW7yTif', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJJMTBSNFhuOFJPZkFkOEtHbUpnbVI4TUFwbTVtRm5Bd2hGdE1qeGFvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2NhZmZpbi50ZXN0OjgwODBcL3Byb2R1Y3RzP2NhdGVnb3J5PTciLCJyb3V0ZSI6InB1YmxpYy5wcm9kdWN0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1783607488),
	('Ss19Fsgvh6aJeztMCvT2JItyhlViZTK2RuWGyPXr', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJNTVFOdkdWTTZuMXZrWk9VeTBzalFIMEpieEhqbHNtOUw1aDIyOHcxIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvY2FmZmluLnRlc3Q6ODA4MFwvcHJvZHVjdHMiLCJyb3V0ZSI6InB1YmxpYy5wcm9kdWN0cy5pbmRleCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=', 1783607441),
	('w7F4YeoRaCrJP2li2AdIWE2LS4Fb3D0tNFeg6rLQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJUVmFSSWFseUp2RzE1QmpETXd0cDR5VmtBZWFabWVmcElBRWJ3WW9XIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvY2FmZmluLnRlc3Q6ODA4MFwvYWRtaW5cL2Rhc2hib2FyZCIsInJvdXRlIjoiYWRtaW4uZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1783618631);

-- Dumping structure for table caffin_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','seller','buyer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buyer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@caffin.com', 'admin', NULL, '$2y$12$bFaHJ7tB7y81TFIzSrgqMeaYLhiHrwZFCgbtP9pTxJPhL8XlhqzcG', NULL, '2026-06-12 00:36:16', '2026-06-22 06:54:01'),
	(2, 'Buyer Test', 'buyer@caffin.com', 'seller', NULL, '$2y$12$uMNObbCiDtGNaUczDehUIe11I/fBP54O9hWHBjkzMPMGlOP9ACfBW', NULL, '2026-06-22 06:52:01', '2026-06-22 07:12:11'),
	(3, 'Seller CAFFIN', 'seller@caffin.com', 'seller', NULL, '$2y$12$Qo7r2LBEHg6JmbytJOO61uLXQ8PMrdFBPmPmNP3QBsfz8CsnL6SI6', NULL, '2026-06-22 07:58:03', '2026-06-22 07:58:03'),
	(4, 'Buyer CAFFIN', 'buyer2@caffin.com', 'buyer', NULL, '$2y$12$/wDZpPIXH2qPtcfr.DBLLeGh.ruetiTL/p4i2fMEwq/zRNob2ZwSO', NULL, '2026-06-22 08:27:04', '2026-06-22 08:27:04');

-- Dumping structure for table caffin_db.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_buyer_id_product_id_unique` (`buyer_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caffin_db.wishlists: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
