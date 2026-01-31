-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jan 2026 pada 16.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olist_ecommerce`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetOrderHistory` (IN `p_id` VARCHAR(50))   BEGIN
    SELECT * FROM order_items WHERE product_id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `admin_name`, `action`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Daffa', 'Update Produk', 'Mengedit produk ID: P009', '2026-01-31 06:34:22', NULL),
(2, 'Daffa', 'Tambah Admin', 'Mendaftarkan admin baru: jesselyn@gmail.com', '2026-01-31 06:35:53', NULL),
(3, 'Daffa', 'Tambah Produk', 'Menambahkan produk P017 (Fresh Milk)', '2026-01-31 06:38:15', NULL),
(4, 'Daffa', 'Update Order', 'Status Order #OLIST-EOCQCWXK2L diubah ke batal', '2026-01-31 06:38:54', NULL),
(5, 'Daffa', 'Hapus Produk', 'Menghapus produk ID: P016', '2026-01-31 06:39:10', NULL),
(6, 'Daffa', 'Update Produk', 'Mengedit produk ID: P012', '2026-01-31 06:41:40', NULL),
(7, 'Daffa', 'Hapus Admin', 'Menghapus admin: jesselyn@gmail.com', '2026-01-31 07:40:03', '2026-01-31 07:40:03'),
(8, 'Daffa', 'Tambah Admin', 'Mendaftarkan admin baru: dave@gmail.com', '2026-01-31 07:40:31', '2026-01-31 07:40:31'),
(9, 'Daffa', 'Update Admin', 'Mengubah data admin: dave@gmail.com', '2026-01-31 07:42:29', '2026-01-31 07:42:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(30, 6, 'P010', 1, 450000.00, '2026-01-31 05:58:42', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_30_091246_create_products_table', 1),
(5, '2026_01_30_091256_create_orders_table', 1),
(6, '2026_01_30_091306_create_order_items_table', 1),
(7, '2026_01_31_132939_create_activity_logs_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `gross_amount` decimal(15,2) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `user_id`, `order_id`, `gross_amount`, `snap_token`, `status`, `shipping_address`) VALUES
(14, '2026-01-31 02:41:33', '2026-01-31 02:42:05', 3, 'OLIST-SYH9WUUHEQ', 1750000.00, NULL, 'selesai', NULL),
(15, '2026-01-31 02:59:20', '2026-01-31 02:59:45', 3, 'OLIST-UDN8VMYS8P', 15000000.00, NULL, 'selesai', NULL),
(16, '2026-01-31 03:45:48', '2026-01-31 03:46:27', 5, 'OLIST-WKWLH7ICLV', 50000000.00, NULL, 'batal', NULL),
(17, '2026-01-31 03:46:00', '2026-01-31 03:46:20', 5, 'OLIST-WGP5BXB0RD', 1750000.00, NULL, 'selesai', NULL),
(18, '2026-01-31 03:47:51', '2026-01-31 05:59:24', 3, 'OLIST-AS2SSDKSJS', 750000.00, NULL, 'batal', NULL),
(19, '2026-01-31 03:58:09', '2026-01-31 03:58:40', 5, 'OLIST-AKJRQ8UONP', 25000000.00, NULL, 'selesai', NULL),
(20, '2026-01-31 04:27:49', '2026-01-31 05:59:28', 3, 'OLIST-QG5NDINPOZ', 350000.00, NULL, 'batal', NULL),
(21, '2026-01-31 04:28:06', '2026-01-31 05:26:18', 3, 'OLIST-LQ5VSDH2J9', 250000.00, NULL, 'selesai', NULL),
(22, '2026-01-31 04:31:40', '2026-01-31 05:26:15', 3, 'OLIST-S7UUZO6MIA', 65000.00, NULL, 'selesai', NULL),
(23, '2026-01-31 05:05:29', '2026-01-31 05:26:12', 3, 'OLIST-TDPRGHBZIM', 120000.00, NULL, 'batal', 'Penerima: Daffa Afdilla | Alamat: Grand Imperial Ciwastra, Bandung Regency, 40287'),
(24, '2026-01-31 05:32:06', '2026-01-31 06:38:53', 6, 'OLIST-EOCQCWXK2L', 150000.00, NULL, 'batal', 'Penerima: John Cena | Alamat: Jalan Cempaka Putih Barat 12F, RW 12, Cempaka Putih Barat, Cempaka Putih, Central Jakarta, Special Capital Region of Jakarta, Java, 10520, Indonesia, Central Jakarta, 40287'),
(25, '2026-01-31 05:41:49', '2026-01-31 05:59:17', 6, 'OLIST-PK1Z8FSYTM', 850000.00, NULL, 'selesai', 'Penerima: John Cena | Alamat: Grand Imperial Ciwastra, Bandung Regency, 40287'),
(26, '2026-01-31 08:19:06', NULL, 5, 'OLIST-3XISXOM0EZ', 350000.00, NULL, 'pending', 'Penerima: Jake Park | Alamat: Grand Imperial Ciwastra, Bandung Regency, 40287');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `seller_id` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `seller_id`, `price`, `created_at`) VALUES
(13, 'OLIST-SYH9WUUHEQ', 'P011', 'OFFICIAL', 1750000.00, '2026-01-31 02:41:33'),
(14, 'OLIST-UDN8VMYS8P', 'P004', 'OFFICIAL', 15000000.00, '2026-01-31 02:59:20'),
(15, 'OLIST-WKWLH7ICLV', 'P009', 'OFFICIAL', 50000000.00, '2026-01-31 03:45:48'),
(16, 'OLIST-WGP5BXB0RD', 'P011', 'OFFICIAL', 1750000.00, '2026-01-31 03:46:00'),
(17, 'OLIST-AS2SSDKSJS', 'P003', 'OFFICIAL', 750000.00, '2026-01-31 03:47:51'),
(18, 'OLIST-AKJRQ8UONP', 'P001', 'OFFICIAL', 25000000.00, '2026-01-31 03:58:09'),
(19, 'OLIST-QG5NDINPOZ', 'P007', 'OFFICIAL', 350000.00, '2026-01-31 04:27:49'),
(20, 'OLIST-LQ5VSDH2J9', 'P013', 'OFFICIAL', 250000.00, '2026-01-31 04:28:06'),
(21, 'OLIST-S7UUZO6MIA', 'P016', 'OFFICIAL', 65000.00, '2026-01-31 04:31:40'),
(22, 'OLIST-TDPRGHBZIM', 'P014', 'OFFICIAL', 120000.00, '2026-01-31 05:05:29'),
(23, 'OLIST-EOCQCWXK2L', 'P005', 'OFFICIAL', 150000.00, '2026-01-31 05:32:06'),
(24, 'OLIST-PK1Z8FSYTM', 'P002', 'OFFICIAL', 850000.00, '2026-01-31 05:41:49'),
(25, 'OLIST-3XISXOM0EZ', 'P007', 'OFFICIAL', 350000.00, '2026-01-31 08:19:06');

--
-- Trigger `order_items`
--
DELIMITER $$
CREATE TRIGGER `trg_kurangi_stok` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
    UPDATE products 
    SET product_stock_qty = product_stock_qty - 1
    WHERE product_id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_restock_stok` AFTER DELETE ON `order_items` FOR EACH ROW BEGIN
    UPDATE products 
    SET product_stock_qty = product_stock_qty + 1
    WHERE product_id = OLD.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` varchar(255) NOT NULL,
  `product_category_name` varchar(255) NOT NULL,
  `product_stock_qty` int(11) NOT NULL DEFAULT 100,
  `price` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `product_category_name`, `product_stock_qty`, `price`, `created_at`, `updated_at`, `image_url`) VALUES
('P001', 'Iphone 17 Pro Max', 29, 25000000, '2026-01-31 03:56:32', '2026-01-31 06:24:43', 'https://images.unsplash.com/photo-1759588071814-f960ed8f7ee8?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P002', 'Nike Air Force', 88, 850000, NULL, NULL, 'https://images.unsplash.com/photo-1600269452121-4f2416e55c28?q=80&w=465&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P003', 'Philips Air Fryer', 22, 750000, NULL, NULL, 'https://images.unsplash.com/photo-1695089028114-ce28248f0ab9?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P004', 'Macbook Air', 13, 15000000, NULL, NULL, 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=726&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P005', 'Plain Shirt', 119, 150000, NULL, NULL, 'https://plus.unsplash.com/premium_photo-1688497831503-235238709bd2?q=80&w=378&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P006', 'Monitor', 10, 2500000, NULL, NULL, 'https://images.unsplash.com/photo-1614624533048-a9c2f9cb5a96?q=80&w=327&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P007', 'Blender Juicer ', 36, 350000, NULL, NULL, 'https://images.unsplash.com/photo-1686961767668-391378d0a33b?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P008', 'Flanel Shirt', 63, 175000, NULL, NULL, 'https://images.unsplash.com/photo-1606724003282-df6ecad297ce?q=80&w=773&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P009', 'ASUS ROG Gaming Setup', 14, 50000000, '2026-01-30 10:39:35', '2026-01-31 06:34:22', 'https://images.unsplash.com/photo-1696710257827-75e2e5954059?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P010', 'Headphone', 15, 450000, '2026-01-30 10:39:35', NULL, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P011', 'Puma Shoes', 46, 1750000, '2026-01-30 10:39:35', NULL, 'https://images.unsplash.com/photo-1680204101400-aeac783c9d87?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P012', 'Adidas Shirt', 0, 850000, '2026-01-30 10:39:35', '2026-01-31 06:41:40', 'https://images.unsplash.com/photo-1511746315387-c4a76990fdce?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P013', 'Calins Product', 44, 500000, '2026-01-30 10:39:35', '2026-01-31 06:28:16', 'https://images.unsplash.com/photo-1612218798572-dfb779591d56?q=80&w=464&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P014', 'Lipstick', 39, 120000, '2026-01-30 10:39:35', NULL, 'https://images.unsplash.com/photo-1613255348289-1407e4f2f980?q=80&w=415&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P015', 'Baby Soap', 12, 30000, '2026-01-30 10:39:35', NULL, 'https://images.unsplash.com/photo-1738892248232-a5fd26a98ec4?q=80&w=442&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('P016', 'Fresh Milk', 53, 29000, '2026-01-31 06:38:15', '2026-01-31 06:38:15', 'https://images.unsplash.com/photo-1563636619-e9143da7973b?q=80&w=465&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cxeSmFLjPgGWiTdc8JaRLXZH2V2OqNlVlVYeDQ2s', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak5YNGZvanBwTTdOd21YbkdZYXNQUUJEOUhiOFVpMHVZTWZyQkw3RyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Qvb2xpc3QtYXBwL3B1YmxpYyI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1769873828);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `latitude`, `longitude`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Daffa', 'olist@gmail.com', NULL, 'Kebon Melati', -6.2, 106.816666, '$2y$12$Ax/Mlo4zxz3d1SjIjt3x6uCFBGluEbKuOF02/xT88IXnJ9SxNnAVu', '2026-01-30 02:57:25', '2026-01-30 06:34:49', 'admin'),
(3, 'Angga', 'angga@gmail.com', NULL, 'Menteng No.1', -6.2, 106.816666, '$2y$12$ym6o9dBxNYSSPrdNlJYaNuI12kjP.J9k44jtVuD0y/I/UWUmntlOu', '2026-01-30 03:25:13', '2026-01-30 06:56:17', 'user'),
(5, 'Jake', 'jake@gmail.com', NULL, 'Menteng No. 125', -6.202112670314712, 106.84812401593543, '$2y$12$.WLWNt8MzANapm40Ep897OCjZMojP3KZPlbEQBZpFiOyJifx.3e9i', '2026-01-30 05:07:40', '2026-01-31 02:30:02', 'user'),
(6, 'John Cena', 'john@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$uK7e2Vq8.1.4kKB/s2kDJeBisd1A9trUdE/sBPBdfHoCxD4T/YlfK', '2026-01-31 05:27:20', NULL, 'user'),
(8, 'Dave', 'dave@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$PwVyvQCh4I63zkdtfbSeluYwH1fe8e7X6VgotG.T6kN7com4N88ZO', '2026-01-31 07:40:31', '2026-01-31 07:42:29', 'admin');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pendapatan_kategori`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pendapatan_kategori` (
`product_category_name` varchar(255)
,`total_terjual` bigint(21)
,`total_pendapatan` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_performa_toko`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_performa_toko` (
`kategori` varchar(255)
,`total_terjual` bigint(21)
,`pendapatan` decimal(32,2)
,`sisa_stok_rata_rata` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pendapatan_kategori`
--
DROP TABLE IF EXISTS `v_pendapatan_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pendapatan_kategori`  AS SELECT `p`.`product_category_name` AS `product_category_name`, count(`oi`.`order_id`) AS `total_terjual`, sum(`oi`.`price`) AS `total_pendapatan` FROM (`order_items` `oi` join `products` `p` on(`oi`.`product_id` = `p`.`product_id`)) GROUP BY `p`.`product_category_name` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_performa_toko`
--
DROP TABLE IF EXISTS `v_performa_toko`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_performa_toko`  AS SELECT `p`.`product_category_name` AS `kategori`, count(`oi`.`order_item_id`) AS `total_terjual`, sum(`oi`.`price`) AS `pendapatan`, avg(`p`.`product_stock_qty`) AS `sisa_stok_rata_rata` FROM (`products` `p` left join `order_items` `oi` on(`p`.`product_id` = `oi`.`product_id`)) GROUP BY `p`.`product_category_name` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
