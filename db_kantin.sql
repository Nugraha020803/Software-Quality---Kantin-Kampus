-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2025 pada 13.15
-- Versi server: 10.4.22-MariaDB-log
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kantin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '482c811da5d5b4bc6d497ffa98491e38', '2025-06-04 05:05:11'),
(3, 'arya', '21232f297a57a5a743894a0e4a801fc3', '2025-06-08 04:47:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `image_url`, `created_at`) VALUES
(1, 'Nasi Goreng', 'Nasi goreng dengan telur, ayam, dan sayuran', '15000.00', 'nasi_goreng.jpg', '2025-06-04 05:05:11'),
(2, 'Mie Ayam', 'Mie ayam dengan kuah kaldu ayam dan sayuran', '12000.00', 'mie_ayam.jpg', '2025-06-04 05:05:11'),
(3, 'Sate Ayam', 'Sate ayam dengan bumbu kacang', '20000.00', 'sate_ayam.jpg', '2025-06-04 05:46:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `menu_id`, `nama`, `kelas`, `nohp`, `quantity`, `total_price`, `status`, `order_date`) VALUES
(1, 2, 'Arya', 'reguler', '085911090846', 3, '36000.00', 'pending', '2025-06-08 09:11:21'),
(2, 2, 'Denita', 'reguler', '098747646476', 4, '48000.00', 'pending', '2025-06-08 09:18:42'),
(3, 2, 'Arya', 'reguler', '085911090846', 4, '48000.00', 'completed', '2025-06-08 09:21:04'),
(4, 2, 'Denita', 'reguler', '0888647465737', 10, '120000.00', 'pending', '2025-06-08 09:49:22'),
(5, 1, '', '', '', 2, '30000.00', 'pending', '2025-06-08 09:52:02'),
(6, 1, '', '', '', 2, '30000.00', 'pending', '2025-06-08 10:04:32'),
(7, 1, '', '', '', 2, '30000.00', 'pending', '2025-06-08 10:11:04'),
(8, 1, '', '', '', 2, '30000.00', 'pending', '2025-06-08 10:15:27'),
(9, 1, '', '', '', 2, '30000.00', 'pending', '2025-06-08 10:18:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
