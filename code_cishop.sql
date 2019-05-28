-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 28 Bulan Mei 2019 pada 13.25
-- Versi server: 5.7.24
-- Versi PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_cishop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` smallint(6) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `slug`, `title`) VALUES
(1, 'power-banks', 'Power Banks'),
(2, 'smartphones', 'Smartphones'),
(3, 'laptops', 'Laptops'),
(4, 'game-consoles', 'Game Consoles'),
(5, 'smartwatches', 'Smartwatches');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `invoice` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('waiting','paid','delivered','cancel') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `date`, `invoice`, `total`, `name`, `address`, `phone`, `status`) VALUES
(1, 1, '2019-05-27', '120190527161156', 7400000, 'Ahmad Hakim', 'Maja 2, Sidamulya, Astanajapura', '8996568953', 'waiting'),
(2, 1, '2019-05-27', '120190527161617', 21400000, 'Mohamad Soleh', 'Jl. Ciremai Giri E7 No.5', '62818280781', 'paid'),
(3, 1, '2019-05-28', '120190528012256', 20000000, 'Ahmad Hakim', 'Maja 2, Sidamulya, Astanajapura', '8996568953', 'delivered'),
(4, 1, '2019-05-28', '120190528021425', 14000000, 'DanDan Rumah', 'Cirebon\r\nRajawali', '83824020777', 'cancel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_confirm`
--

DROP TABLE IF EXISTS `orders_confirm`;
CREATE TABLE IF NOT EXISTS `orders_confirm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orders` int(11) NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders_confirm`
--

INSERT INTO `orders_confirm` (`id`, `id_orders`, `account_name`, `account_number`, `nominal`, `note`, `image`) VALUES
(1, 1, 'Ahmad Hakim', '3409123', 21000000, '-', '120190527161156-20190528005737.png'),
(2, 2, 'Hakim', '808879', 7000000, 'Lebihannya dikirim dalam paket', '120190527161617-20190528010139.jpg'),
(3, 3, 'Ahmad Hakim', '0899098', 20000000, 'Dikirim dari M-Banking', '120190528012256-20190528012411.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_detail`
--

DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orders` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` smallint(6) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `id_orders`, `id_product`, `qty`, `subtotal`) VALUES
(1, 1, 1, 2, 400000),
(2, 1, 2, 1, 7000000),
(3, 2, 1, 2, 400000),
(4, 2, 2, 3, 21000000),
(5, 3, 3, 4, 20000000),
(6, 4, 2, 2, 14000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `id_category`, `slug`, `title`, `description`, `price`, `image`, `is_available`) VALUES
(1, 1, 'power-banks-blue', 'Power Banks Blue', 'Nikmati daya charge sampai dengan 120000mAh', 200000, 'power-banks-blue-20190521163312.jpg', 1),
(2, 2, 'iphone-6', 'iPhone 6', 'Smartphone untuk lebih gaya', 7000000, 'iphone-6-20190521163353.jpg', 1),
(3, 3, 'laptop-baru-update', 'Laptop Baru Update', 'Laptop dengan spek tinggi Edit Lagi', 5000000, 'laptop-baru-update-20190522005536.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `photo`, `is_active`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$KxzjcOFX8rQpdoMcdqCVZ.e8tToqGeHmRXVS1aLF9BmC1m0b4D2/K', 'admin', 'admin321-20190522163840.png', 1),
(2, 'Member', 'member@mail.com', '$2y$10$HYEHnjBhoHXB7gQcNxfIZ.gmqxqSWCAIFxpZ6bdH3vw8YBm4x9SRO', 'member', NULL, 1),
(3, 'Member', 'member1@mail.com', '$2y$10$HYEHnjBhoHXB7gQcNxfIZ.gmqxqSWCAIFxpZ6bdH3vw8YBm4x9SRO', 'member', NULL, 1),
(4, 'Member', 'member2@mail.com', '$2y$10$HYEHnjBhoHXB7gQcNxfIZ.gmqxqSWCAIFxpZ6bdH3vw8YBm4x9SRO', 'member', NULL, 1),
(5, 'Member', 'member3@mail.com', '$2y$10$HYEHnjBhoHXB7gQcNxfIZ.gmqxqSWCAIFxpZ6bdH3vw8YBm4x9SRO', 'member', NULL, 1),
(7, 'Hakim', 'hakim@mail.com', '$2y$10$RWZZpsV57e8ZmPf9AFsfH.mVZaljdTam1cYQDS9wakLsb4vAN7Vv6', 'member', NULL, 1),
(8, 'luna', 'luna@mail.com', '$2y$10$wHPnlaGA8Nh6n09tGuUVGeeSRC3huhZ37Q8PPl8ZV/EgXPa6I55Ly', 'member', NULL, 1),
(9, 'Root', 'root@mail.com', '$2y$10$k4xom881bhtU35qwSMu91eYYXXA8TY1uFv.ccJhQYudQLtKNWQxHe', 'admin', 'root-20190522164246.png', 1);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
