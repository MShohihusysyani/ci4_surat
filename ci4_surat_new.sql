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

-- Dumping structure for table ci4_surat_new.klien
CREATE TABLE IF NOT EXISTS `klien` (
  `id_klien` int NOT NULL AUTO_INCREMENT,
  `no_klien` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_klien` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_klien` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_klien` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `provinsi` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kabupaten` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelurahan` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dati2` int DEFAULT NULL,
  `jml_cabang` int DEFAULT NULL,
  `nama_dirut` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp_dirut` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_dirops` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_pic` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp_pic` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telp` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_bergabung` date DEFAULT NULL,
  `tgl_nonaktif` date DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_klien`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.klien: ~82 rows (approximately)
INSERT INTO `klien` (`id_klien`, `no_klien`, `nama_klien`, `jenis_klien`, `status_klien`, `alamat`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `kode_pos`, `dati2`, `jml_cabang`, `nama_dirut`, `no_hp_dirut`, `nama_dirops`, `nama_pic`, `no_hp_pic`, `no_telp`, `email`, `website`, `tgl_bergabung`, `tgl_nonaktif`, `user_id`) VALUES
	(2, '0001', 'PT BPR BKK Banjarharjo (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58),
	(3, '0002', 'PT BPR BKK Karangmalang (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59),
	(4, '0003', 'PT BPR BKK Purwokerto (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
	(5, '0006', 'PT BPR BKK Kab.Pekalongan (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61),
	(6, '0007', 'PT BPR BKK Kebumen (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
	(7, '0008', 'PT. BPR Arta Utama', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 101),
	(8, '0009', 'PT. BPR Mentari Terang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 102),
	(9, '0010', 'PT. BPR Sinar Garuda Prima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 103),
	(10, '0011', 'PT. BPR Wirosari Ijo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 104),
	(11, '0012', 'PT BPR BKK Blora (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 105),
	(12, '0013', 'Kospin Sekartama', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 106),
	(13, '0014', 'PT BPR BKK Jepara (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 107),
	(14, '0015', 'PT. BPR Kusuma Sumbing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 108),
	(15, '0016', 'PT BPR BKK Grogol (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 109),
	(16, '0018', 'PT. BPR Artha Guna Mandiri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112),
	(17, '0021', 'PT. BPR Mitradana Madani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 114),
	(18, '0022', 'PT. BPR Mitra Rakyat Riau', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 115),
	(19, '0024', 'PT. BPR Sejahtera Artha Sembada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 116),
	(20, '0029', 'PT BPR BKK Purbalingga (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 117),
	(21, '0030', 'PT BPR Bank Sukoharjo (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118),
	(22, '0031', 'PT. BPR DP Taspen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 119),
	(23, '0032', 'PT BPR Artha Tanah Mas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 120),
	(24, '0033', 'PT. BPR Gunung Kinibalu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 121),
	(25, '0034', 'PERUMDA BPR Bank Brebes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 122),
	(26, '0035', 'PT. BPR Artha Puspa Mega', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 123),
	(27, '0036', 'PT BPR Binalanggeng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 124),
	(28, '0037', 'PT. BPR Pedungan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 125),
	(29, '0039', 'PT BPR Bank Pekalongan (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 126),
	(30, '0041', 'PT BPR BKK Kab. Tegal (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127),
	(31, '0042', 'PT BPR Bank Purwa Artha (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 128),
	(32, '0043', 'PT. BPR Usaha Rakyat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 129),
	(33, '0045', 'PT BPR BKK Kota Tegal (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 130),
	(34, '0046', 'PT. BPR DP Taspen Jateng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 131),
	(35, '0047', 'PT.BPR Arthama Cerah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 132),
	(36, '0048', 'Kospin Surya Artha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133),
	(37, '0049', 'PT. BPR Sumber Arta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 134),
	(38, '0051', 'PT BPR Bank Pasar Kota Tegal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 135),
	(39, '0052', 'PD BPR Bank Pemalang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 136),
	(40, '0059', 'PT BPR Bank Tegal Gotong Royong (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 137),
	(41, '0061', 'PT. BPR Enggal Makmur Adi Santoso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 138),
	(42, '0062', 'Kospin Jujur Artha Mandiri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 139),
	(43, '0063', 'PT. BPR Bina Maju Usaha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 140),
	(44, '0064', 'PT.BPR Muhadi Setia Budi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 141),
	(45, '0065', 'Kospin Rejo Agung Sukses', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 142),
	(46, '0066', 'SMK 2 Pekalongan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 143),
	(47, '0067', 'PD. BKK Susukan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 188),
	(48, '0068', 'PT.BPR Dana Rakyat Sentosa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 144),
	(49, '0069', 'PT.BPR Dana Mitra Sentosa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 145),
	(50, '0070', 'PT. BPR Surya Kusuma Kranggan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 146),
	(51, '0071', 'PT. BPR Milala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 147),
	(52, '0072', 'PT. BPR Guna Rakyat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 148),
	(53, '0073', 'Koperasi Tri Capital Investama 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 150),
	(54, '0074', 'PT. BPR Duta Pasundan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 151),
	(55, '0075', 'PT. BPR Mitratama Arthabuana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 152),
	(56, '0077', 'PT BPR BKK Kota Semarang (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 153),
	(57, '0078', 'Koperasi Tri Capital Investama 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 154),
	(58, '0079', 'PT BPR BKK Ungaran (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 155),
	(59, '0080', 'PT BPR BKK Wonosobo (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 156),
	(60, '0081', 'Perumda BPR Artha Perwira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 157),
	(61, '0082', 'PT. BPR Delanggu Raya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 158),
	(62, '0083', 'Koperasi Jembar Maju Bersama', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 159),
	(63, '0084', 'PT.  BPR BKK Tulung (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 160),
	(64, '0085', 'PERUMDA BPR Marunting Sejahtera', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161),
	(65, '0086', 'PT. BPT Kurnia Sewon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 162),
	(66, '0087', 'PT. BPR Cipatujah Jabar Perseroda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 163),
	(67, '0088', 'KSP Bougenvill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164),
	(68, '0090', 'PT BPR TCI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165),
	(69, '0092', 'PT. BPR BKK Kota Magelang (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166),
	(70, '0093', 'PT. BPR Shinta Daya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 167),
	(71, '0094', 'Kospin Wijaya Kusuma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 168),
	(72, '0095', 'PT BPR Eleska Artha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 169),
	(73, '0096', 'PT. BPR Arta Mas Surakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 170),
	(74, '0097', 'PT. BPR BKK Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 171),
	(75, '0098', 'PT. BPR BKK GALUH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 172),
	(76, '0100', 'PT. BPR Sendang Harta Sejahtera', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 177),
	(77, '0101', 'PT BPR Sukdana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 178),
	(78, '0102', 'PT. BPR Sukadyarindang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 179),
	(79, '0004', 'PT. BPR BKK Kota Pekalongan (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 181),
	(80, '0099', 'PT BPR UKABIMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 182),
	(81, '0050', 'KSU BMT Amanah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187),
	(82, '0103', 'PT BPR BKK Demak (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 189),
	(83, '0004', 'PT. BPR BKK Kota Pekalongan (Perseroda)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table ci4_surat_new.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.migrations: ~1 rows (approximately)
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2025-06-03-153021', 'App\\Database\\Migrations\\User', 'default', 'App', 1749014700, 1),
	(3, '2025-06-04-094447', 'App\\Database\\Migrations\\Role', 'default', 'App', 1749030509, 2),
	(5, '2025-06-05-091123', 'App\\Database\\Migrations\\Provinsi', 'default', 'App', 1749114942, 4),
	(6, '2025-06-05-091746', 'App\\Database\\Migrations\\Kabupaten', 'default', 'App', 1749115333, 5),
	(7, '2025-06-05-092245', 'App\\Database\\Migrations\\Kecamatan', 'default', 'App', 1749115579, 6),
	(8, '2025-06-05-092726', 'App\\Database\\Migrations\\Kelurahan', 'default', 'App', 1749115809, 7),
	(9, '2025-06-05-093820', 'App\\Database\\Migrations\\Klien', 'default', 'App', 1749116358, 8);

-- Dumping structure for table ci4_surat_new.role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.role: ~7 rows (approximately)
INSERT INTO `role` (`id_role`, `nama_role`) VALUES
	(1, 'superadmin'),
	(2, 'klien'),
	(4, 'kadiv'),
	(5, 'staf'),
	(6, 'dirut'),
	(7, 'dirops'),
	(8, 'sekretaris');

-- Dumping structure for table ci4_surat_new.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `klien_id` int DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `divisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_user` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tgl_register` date DEFAULT NULL,
  `tgl_nonaktif` date DEFAULT NULL,
  `status_user` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.user: ~122 rows (approximately)
INSERT INTO `user` (`id_user`, `klien_id`, `username`, `password`, `role`, `divisi`, `nama_user`, `email`, `no_hp`, `foto`, `tgl_register`, `tgl_nonaktif`, `status_user`, `last_login`) VALUES
	(47, NULL, 'aling', '$2y$10$3fmu3UaUBtwMUn/ibOqgwO0h36GrfFrAwjP/GAHxYZfIPJOJPYdgC', 'staf', 'Supervisor 2', 'Aling', '', '', NULL, '2024-05-31', NULL, 'Aktif', '2025-02-20 07:59:57'),
	(48, NULL, 'ajeng', '$2y$10$yMDEbxjjlh4oNXdZJw1om.SmuYMqFSzqLe3vycjiXnVFnZVXh7Fli', 'staf', 'cbs', 'Ajeng Amanda', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-21 09:54:20'),
	(50, NULL, 'ayu', '$2y$10$B5GxkfNn7sZ3nZ8TZ0Kjb.I48l.xHvSAKUUE8FgNNbKQ.rFbDWa0K', 'staf', 'cbs', 'Ayu', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-21 08:15:21'),
	(52, NULL, 'epa', '$2y$10$R8oQzXHI8pnwusrmXCTX3e9FWIjfvqgXFekk1yqJNhXIAkFDTY.n.', 'staf', 'cbs', 'Eva Rosiana', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-20 10:12:07'),
	(54, NULL, 'nita', '$2y$10$lGRwZfprphMBSECfyzb/SOLIyxsTw2THLpKO5WYjUeq41XBy0Nnz.', 'staf', 'cbs', 'Nita', NULL, NULL, NULL, '2024-05-31', NULL, 'N', '2024-10-25 08:41:03'),
	(55, NULL, 'luthfi', '$2y$10$JEjAMFVKUPfcwhAh5mNlAOzSOKQmSmXL/2iVnTWN6NS4BRzke6wMu', 'staf', 'cbs', 'Luthfi', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-21 08:33:57'),
	(57, NULL, 'khabibah', '$2y$10$B2CATYduaY1k14AaFRVyP.m/rV5.yI4mj0.WXWt.Ud8P5oZMF1rQy', '3', 'Supervisor 1', 'Khabibah', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-21 10:28:10'),
	(58, 2, 'banjarharjo', '$2y$10$qruhkWYy5yfJg2vGwtz.pexELMTc6HVkaFrp3ZYEAerKEs0H4tYBi', 'klien', 'Klien', 'PT BPR BKK Banjarharjo (Perseroda)', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-19 12:54:57'),
	(59, 3, 'karangmalang', '$2y$10$QNYfJEq8VLi6JCCBdywKjumU8rGIQnu9LU5AIcCobSyvXzauc6EWm', 'klien', 'Klien', 'PT BPR BKK Karangmalang (Perseroda)', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-18 16:51:52'),
	(60, 4, 'purwokerto', '$2y$10$WniGIEgNUJA9Z/aNxOh3TO9oUtB9BAi9q3U8FYeqHHbTXTaV9Eywe', 'klien', 'Klien', 'PT BPR BKK Purwokerto (Perseroda)', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-20 18:00:11'),
	(61, 5, 'pekalongan', '$2y$10$BS4Kv4vDYwqiSORW84/jc.NC2eBo9CR.iaJ7N6m3QbECXM4AXnJze', 'klien', 'Klien', 'PT BPR BKK Kab.Pekalongan (Perseroda)', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-19 10:49:28'),
	(62, NULL, 'diki', '$2y$10$vAfqKnPDv/ymAIPib1NF2uhLZbnqWuJ6JN87f6T/Fq0A9n0axAoA2', 'staf', 'cbs', 'Diki', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-21 07:10:05'),
	(66, 6, 'kebumen', '$2y$10$8U34fAsqjj5IvjEe7CZgpeR.1.otC4xVr1F/cDHpSRCowoEUU4ffm', 'klien', 'Klien', 'PT BPR BKK Kebumen (Perseroda)', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-19 10:21:38'),
	(68, NULL, 'indri', '$2y$10$tDJeFvFcChAeZWacIUOTxuSJp9HbObg3pagd3zZiHSj9EkGou79Iy', 'kadiv', 'cbs', 'Indri', NULL, NULL, NULL, '2024-05-31', NULL, 'Aktif', '2025-02-04 11:17:50'),
	(78, NULL, 'indra', '$2y$10$8etE1d5OKw9.Gbyz58eyjuGIfU.O0MyFH0r6XZ8oY4bQek.ujQChK', 'staf', 'cbs', 'Indra', NULL, NULL, NULL, '2024-06-28', NULL, 'Aktif', '2025-02-20 11:29:34'),
	(79, NULL, 'arif', '$2y$10$Vbg7uz5gPOgYBEcSJUt2Jef5ox//0yFYSCtS60mPzC2irwkmbSPzW', 'staf', 'cbs', 'Arif P', NULL, NULL, NULL, '2024-07-01', NULL, 'Aktif', '2025-02-17 12:16:54'),
	(80, NULL, 'zelly', '$2y$10$w3ERUHDBVufTAMNPzcYdou5vlkWRrUykQxsVwJqCQkzOVIOYc2iZm', 'staf', 'cbs', 'Zelly', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-21 10:33:09'),
	(81, NULL, 'sandy', '$2y$10$rL5AZzoyO6rtAgWClQov7euzNspS5sP3UQydqwWDPLnBIR5cDZZcu', 'staf', 'cbs', 'Sandy', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-21 09:55:30'),
	(82, NULL, 'bachtiar', '$2y$10$YUjsywxMapJMpjKbhRBFmeAFAHMK/RkkFE2z4.ALkcUgy33e3/.Wa', 'staf', 'cbs', 'Bachtiar', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-21 09:34:48'),
	(83, NULL, 'ratna', '$2y$10$LVJvul7rFMEbi5eI6VQW2ula76hh2N4EMJWsRfiRMKCnjGt3DLuNe', 'staf', 'cbs', 'Ratna', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-21 10:26:39'),
	(84, NULL, 'tiwi', '$2y$10$yQJeyW.RDO6Kn7jVKR8JAeeXsbPrsuD.Z4iECH2JGwd88D0Z0MAaW', 'staf', 'cbs', 'Tiwi', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-19 20:32:12'),
	(85, NULL, 'herda', '$2y$10$UWx/hvX6PZW29q2WhLCOGuVRu9uIDJGMTpr16Hgpmv/h1hatjP4Zy', 'staf', 'cbs', 'Herda', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-20 10:18:12'),
	(86, NULL, 'isna', '$2y$10$RwDEjUmYW.auaIC6Db2YGuPVXXSoM2RqLLii7cZENEhUkAKUsMxNa', 'staf', 'cbs', 'Isna', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-17 09:45:27'),
	(87, NULL, 'zida', '$2y$10$PN9tJOUeKlb0hqcP.xeN.OHHzlQqttVXA7FYhdrKr8t8qqASR2tbS', 'staf', 'digital', 'Zida', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-12-20 09:12:01'),
	(88, NULL, 'norma', '$2y$10$sm5kMLxhTaw9BYfF1pkn1eel00qOiMPixy7AK.ScIcEVErhjjbKPm', 'staf', 'digital', 'Norma', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-07-27 10:41:33'),
	(89, NULL, 'dettia', '$2y$10$HApXZCz.1SBLh228GLzzneTVnKOOAKPXkPd8dl8Fz9jA..AWJkMiS', 'staf', 'digital', 'Dettia', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-01-21 14:52:18'),
	(90, NULL, 'mumu', '$2y$10$a10JPBaZBcEyfmecbyKNt.2zb2PiBV2be8gDLY7/7.NgiRkAyngZu', 'staf', 'cbs', 'Mumu', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-17 09:29:22'),
	(91, NULL, 'wasis', '$2y$10$BgNRkRD/zdzTYOSn49CAlu7F1.mH3X65/0slBywf2SiTiUnvNkT2i', 'staf', 'support', 'wasis dn', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-06 10:52:42'),
	(92, NULL, 'dwi', '$2y$10$hP325C8eu.Fxj4AxK2xMCubwTiPM1raY2pwAwwe8Wz2GwLmfNM9/C', 'staf', 'support', 'Dwi', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-07 14:54:38'),
	(93, NULL, 'rijal', '$2y$10$pXM4mb2Kg3iS7jY4pd3oX.u17tpNZ707DkqVdFnfaFaW0QswKiiz6', 'staf', 'support', 'Rijal Amri Majid', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-06 10:43:26'),
	(94, NULL, 'kiky', '$2y$10$MaB54/lHgfpG5NB4PGoqreskhl1H4TchyI7GHWoVzb4DRLTbU9G.S', 'staf', 'cbs', 'Kiky', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-07-27 11:02:44'),
	(95, NULL, 'jaman', '$2y$10$mfg4t7FeWCFn.xcZwxbYa.9HAYT.tJr8L6ts633Ld4Bds3IalkX5C', 'kadiv', 'support', 'Jaman', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-07-27 10:57:05'),
	(96, NULL, 'dettiaspv', '$2y$10$EzfEeeAW7c9ecyuyhGKLDOfqn9bK1E7T0g8QeoL.sWwYOJR4Zs8o.', 'sekretaris', 'digital', 'Dettia', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-07-27 11:03:33'),
	(97, NULL, 'normaspv', '$2y$10$K.YfvCf/L/aaWGHfzeKiC.TLhT4KTYbSCp2Y5QJG7ZMWk/1Q1wSM2', 'staf', 'digital', 'Norma', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-08-19 14:31:00'),
	(98, NULL, 'novi', '$2y$10$IKnzaZCdkEVutG/LqmNaneC4Q.u0fm18kGCFBYuYzyntceR6pB3xW', 'staf', 'cbs', 'Novi', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2025-02-13 10:18:30'),
	(99, NULL, 'muti', '$2y$10$TjmDQQw/JYMs.fRUA.6bsefuXIfIGzh.3dtTwG5efkfhrW/LTVF/y', 'sekretaris', 'cbs', 'Muti', NULL, NULL, NULL, '2024-07-27', NULL, 'Aktif', '2024-12-13 08:44:32'),
	(101, 7, 'artautama', '$2y$10$XMrlQAnltxMD0LPZB40XO.VeCPaAMfRuGao.qN0smAtfw1frh6tDy', 'klien', 'Klien', 'PT. BPR Arta Utama', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-19 16:25:06'),
	(102, 8, 'mentariterang', '$2y$10$AUlBIJ2KbdUgXuIoTE71MOKaVfh/HxHbBZo0DL4uxAIpGJ/BbgtTy', 'klien', 'Klien', 'PT. BPR Mentari Terang', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-19 14:47:17'),
	(103, 9, 'sinargarudaprima', '$2y$10$PHOrGjejFr0jdXzQZlkB0ObsDdO16s/G3soLdAntKzt9ek8AAmdPy', 'klien', 'Klien', 'PT. BPR Sinar Garuda Prima', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-20 11:57:31'),
	(104, 10, 'wirosariijo', '$2y$10$ASETsHREHofM4vjrVF0H4.O8hGu2GeodxFJ4O09zT38yyEO9gXy06', 'klien', 'Klien', 'PT. BPR Wirosari Ijo', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-19 09:48:05'),
	(105, 11, 'blora', '$2y$10$hOpF.ArXNQJPAEX.LjZMT.G5qxi4684vDrv6PyQwFt8NYOx4Eg12m', 'klien', 'Klien', 'PT BPR BKK Blora (Perseroda)', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-19 09:45:00'),
	(106, 12, 'sekartama', '$2y$10$jgQlX0GNz0/cqXaeZjATxO/MTNBRhlvdZl82ksogu7rvYN5l1ASuu', 'klien', 'Klien', 'Kospin Sekartama', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-19 14:05:35'),
	(107, 13, 'jepara', '$2y$10$MqnibtwmduWuDg63c9pUt.htUXpCBo/XXSg2M6UyyVruarVuFiUga', 'klien', 'Klien', 'PT BPR BKK Jepara (Perseroda)', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-17 11:37:07'),
	(108, 14, 'kusumasumbing', '$2y$10$PsRo6ECqNTPuVWV8qAnIJ.o7glngrf9UIAIorVMat8nYOeJBreKIO', 'klien', 'Klien', 'PT. BPR Kusuma Sumbing', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-20 09:08:46'),
	(109, 15, 'grogol', '$2y$10$C1Si1w.4W4dEWP.tMuAgoOjtrwxOMN3RL8bL1i9c6gWmyz1cyPudi', 'klien', 'Klien', 'PT BPR BKK Grogol (Perseroda)', NULL, NULL, NULL, '2024-08-02', NULL, 'Aktif', '2025-02-13 12:00:37'),
	(112, 16, 'agm', '$2y$10$nd6nh8D2biftGHUX9JOgP.m2ouEjWDecUjSzDPMdPtfcWunAs3TWS', 'klien', 'Klien', 'PT. BPR Artha Guna Mandiri', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 18:21:32'),
	(114, 17, 'mitradana', '$2y$10$HYJr1xITPxAupaPdgxSqru5.vsaEVfruxn4c0fMwwrV4vjUIosjL6', 'klien', 'Klien', 'PT. BPR Mitradana Madani', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-17 10:42:45'),
	(115, 18, 'mitrarakyatriau', '$2y$10$iWRtQIlNtEH2.SvvyVeXXeeKJZai.wmX5xE6cozMsoYuFQ9adhRQa', 'klien', 'Klien', 'PT. BPR Mitra Rakyat Riau', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 15:39:51'),
	(116, 19, 'arthasembada', '$2y$10$sX3cxLXu84zxtZ0ASfxxEe4//JRBtEM3QGpnet0KS2g4hC9T1sLPG', 'klien', 'Klien', 'PT. BPR Sejahtera Artha Sembada', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 10:04:03'),
	(117, 20, 'purbalingga', '$2y$10$pgVpwN.wBhJBKoSemeRmruEUy7xsHOptH.dD2LyyrDabd0JPK7TvG', 'klien', 'Klien', 'PT BPR BKK Purbalingga (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 04:03:28'),
	(118, 21, 'banksukoharjo', '$2y$10$d.2qW13ehNxttLhfjP1f..C3kdgcxqI5mZtYh7Op3DTJBTxiozSq.', 'klien', 'Klien', 'PT BPR Bank Sukoharjo (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 17:13:29'),
	(119, 22, 'dptaspen', '$2y$10$YvV7u0RgmgGETskM2t8jTuCMuK4YiDXF1/zsKI9gn1BifcRjrfPpW', 'klien', 'Klien', 'PT. BPR DP Taspen', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 17:24:19'),
	(120, 23, 'arthatanahmas', '$2y$10$d3dPNZt7Eb2Gzsjn.yHtvepHiGflGO83zLfygxl51xcr6W99L0Ucq', 'klien', 'Klien', 'PT BPR Artha Tanah Mas', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:54:43'),
	(121, 24, 'gunungkinibalu', '$2y$10$lu.682eVvWqOwdD72j2k3.NWb0WIr2NeXgRIcfgLyS/trkv2DD1Ie', 'klien', 'Klien', 'PT. BPR Gunung Kinibalu', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-14 09:57:10'),
	(122, 25, 'bankbrebes', '$2y$10$WkSUoKTPQZpHey/9S4.hpuUJITC2QDCOZQS/prAnhjOcDVyN6NHLi', 'klien', 'Klien', 'PERUMDA BPR Bank Brebes', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:24:12'),
	(123, 26, 'arthapuspamega', '$2y$10$wVzgc4YbxAuulD3Lqbesc.AuUxx1NZHEmo2bHurATolq1UV60eE0.', 'klien', 'Klien', 'PT. BPR Artha Puspa Mega', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 11:41:24'),
	(124, 27, 'binalanggeng', '$2y$10$wLuh0yGyR8MQTOqK1tzNi.GwYzF78j9MbGxQVpajL10AosAXWnhua', 'klien', 'Klien', 'PT BPR Binalanggeng', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 09:21:14'),
	(125, 28, 'pedungan', '$2y$10$1VnDAqxgy46ruRPYonjjXuKu6Xa3N24tFQM8s4DFV/LScvUEec.Ym', 'klien', 'Klien', 'PT. BPR Pedungan', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 14:54:43'),
	(126, 29, 'bankpekalongan', '$2y$10$dQtDnO5NMJ5p8zhnUsxxROI7YD78YseV4RwxGqBMP5ZE/8qOsTBKu', 'klien', 'Klien', 'PT BPR Bank Pekalongan (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 09:03:16'),
	(127, 30, 'kabtegal', '$2y$10$btKvHp52liRMaoW0OrFOIOFwwlrOPi7vYup8h0ssW38m8zXYaM3fW', 'klien', 'Klien', 'PT BPR BKK Kab. Tegal (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 17:18:26'),
	(128, 31, 'purwaartha', '$2y$10$QhOX5jMkii8p7KIaKPKVYuAqWH/.KPo7goJGMHE3e1jVIpOX.igby', 'klien', 'Klien', 'PT BPR Bank Purwa Artha (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:46:39'),
	(129, 32, 'usaharakyat', '$2y$10$lYnJrJQpIOIOJ91hqsu7PeoW7ZXdVtA66opS0VjrhkAbcFyi8Gpve', 'klien', 'Klien', 'PT. BPR Usaha Rakyat', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 14:41:40'),
	(130, 33, 'kotategal', '$2y$10$1nfemXm6wYL9TgWPwryN9ecwCAHI.EeBy4FtjGVt1R1z/Dttx1PRO', 'klien', 'Klien', 'PT BPR BKK Kota Tegal (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 12:26:38'),
	(131, 34, 'dptaspenjateng', '$2y$10$/HLrNQNqsWNtylN7bewflOKpXnAwBaTG5uFAvEJGHSddQzt0e6FkG', 'klien', 'Klien', 'PT. BPR DP Taspen Jateng', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 14:33:40'),
	(132, 35, 'arthamacerah', '$2y$10$uz0vXkMzEWhWRO8Z0sHRP.HFLWD0VWuXbdpEzJX2/WpNRF6hnJxmq', 'klien', 'Klien', 'PT.BPR Arthama Cerah', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 16:47:58'),
	(133, 36, 'suryaartha', '$2y$10$2nITxuXbT/jP.zwdh0sOXOr0nKWmtZkFSMzfQ8R5BAdXuUK.jerNy', 'klien', 'Klien', 'Kospin Surya Artha', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-18 15:51:17'),
	(134, 37, 'sumberarta', '$2y$10$Q1b3ppGcPCRKStQCFRS3iutqZ57QOTm/CLuJ27uPWjvqL3keTjLte', 'klien', 'Klien', 'PT. BPR Sumber Arta', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 18:19:44'),
	(135, 38, 'pasarkotategal', '$2y$10$vdzYkIzuD7Ai9bBCvE0HOukGGo1oCt3uwTwoUCcETSQEL4cQKjfyO', 'klien', 'Klien', 'PT BPR Bank Pasar Kota Tegal', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:47:33'),
	(136, 39, 'bankpemalang', '$2y$10$IiTkBHiuyBut8mTYZppw7eFc9Db2l1yhK87RogI9EweF1jkRkLtue', 'klien', 'Klien', 'PD BPR Bank Pemalang', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 14:42:52'),
	(137, 40, 'banktegal', '$2y$10$skD/gnkYbNbp1HX6KqECSuLqslReHf.gmN0A7wX1lNuEP9akxfkHq', 'klien', 'Klien', 'PT BPR Bank Tegal Gotong Royong (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 08:44:50'),
	(138, 41, 'enggalmakmur', '$2y$10$lzl4I8WRshS3Y1VKO7p8Au.bnNiJykbR1kv2Crp2DaEpg7yUWg5m2', 'klien', 'Klien', 'PT. BPR Enggal Makmur Adi Santoso', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:04:53'),
	(139, 42, 'arthamandiri', '$2y$10$RsV8kNuDe2gBDyoIwQHu5uYldVY9nDJzb.HifkbltODRsMRfAtcka', 'klien', 'Klien', 'Kospin Jujur Artha Mandiri', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-01-31 10:18:10'),
	(140, 43, 'binamajuusaha', '$2y$10$wVgMqcpkEGSAw8A5sSYe6.DuaPMue5GD6dzLT/nmK4YaUxYoaLgza', 'klien', 'Klien', 'PT. BPR Bina Maju Usaha', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 08:42:32'),
	(141, 44, 'muhadi', '$2y$10$mBt3J8hZ9J8wsyjBsjalRu/4bVeadeXeZ89cSB0UKy1AdeAtOWRsm', 'klien', 'Klien', 'PT.BPR Muhadi Setia Budi', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-18 10:08:52'),
	(142, 45, 'rejoagung', '$2y$10$bNzIBuVJwG3mj5thNFR6OeGl60jPLhNe4h81MgJ4WFVernVC1rJc2', 'klien', 'Klien', 'Kospin Rejo Agung Sukses', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 09:28:16'),
	(143, 46, 'smk2pekalongan', '$2y$10$2LQnTTrqTVCPigTEkXwYy.h4dWdWZTF7o6W4y4AQd5A47tk8PisPi', 'klien', 'Klien', 'SMK 2 Pekalongan', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2024-09-21 09:42:31'),
	(144, 48, 'drs', '$2y$10$XBtxnfBo5vQHRGzRofZjNe2Tnld09ZJl96Dlc4Rujx19Y68uS44Ee', 'klien', 'Klien', 'PT.BPR Dana Rakyat Sentosa', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 15:05:12'),
	(145, 49, 'dms', '$2y$10$dE8L5398nZajXe28tZNY7eX/M3Re1i6enmB5QqLyMH2D73Vlbo..2', 'klien', 'Klien', 'PT.BPR Dana Mitra Sentosa', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 12:09:47'),
	(146, 50, 'suryakusuma', '$2y$10$eN75b9kY9jSNV5GbbmTuGus345yxU8Esw26J8YmAOy2kA2nY3oqq6', 'klien', 'Klien', 'PT. BPR Surya Kusuma Kranggan', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-18 10:06:23'),
	(147, 51, 'milala', '$2y$10$olLUeWudKckMfuw9LkK9deL0ATAKE7O/JPgWFWtje7zO/xj5zdw4O', 'klien', 'Klien', 'PT. BPR Milala', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 09:15:44'),
	(148, 52, 'gunarakyat', '$2y$10$MxD0wT4KHhxH.mPthZRfxexN4o5lsSe18hO4dmhM8vVum19Uv6L9a', 'klien', 'Klien', 'PT. BPR Guna Rakyat', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-17 13:58:12'),
	(150, 53, 'tci1', '$2y$10$Qv2w5N9bd3G54vv0raBRiOiGlSf9GuCw8GvwWpHkpmJx3OWCcX16y', 'klien', 'Klien', 'Koperasi Tri Capital Investama 1', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-18 11:52:11'),
	(151, 54, 'dutapasundan', '$2y$10$HxFtex/psOKpGuOSrPeuQOQ.kVHxtXaGuhhTJn7OdYOOgMsE7B7P2', 'klien', 'Klien', 'PT. BPR Duta Pasundan', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2024-09-30 14:34:56'),
	(152, 55, 'arthabuana', '$2y$10$uP1od3gPLs98OWgYrOl1Meg1OB0FLuxb3tSRmpSfMui2IqvD4oPK6', 'klien', 'Klien', 'PT. BPR Mitratama Arthabuana', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 16:19:19'),
	(153, 56, 'kotasemarang', '$2y$10$oB3LWrCzzcyLVGcQuDuhCea8sYJePBwZb/imi5qCoqd7FPP7EUXS2', 'klien', 'Klien', 'PT BPR BKK Kota Semarang (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 14:03:24'),
	(154, 57, 'tci2', '$2y$10$UlJp1jIFE.qTsvgM2dat/O1bFxyu2jAblIPn4a37HpTHqPAWXOf0e', 'klien', 'Klien', 'Koperasi Tri Capital Investama 2', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2024-10-01 11:06:59'),
	(155, 58, 'ungaran', '$2y$10$QmEmWrRsgFOeLgKrqI6VluOhm6y3h2.BlRkyTn2QJUMKm4snrqVMe', 'klien', 'Klien', 'PT BPR BKK Ungaran (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 08:48:40'),
	(156, 59, 'wonosobo', '$2y$10$2AWICFoRUSXoXHD.5diH0OriW0M.efeyb2xtV2McE9a57c0iM04hu', 'klien', 'Klien', 'PT BPR BKK Wonosobo (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 12:59:04'),
	(157, 60, 'arthaperwira', '$2y$10$WkK8R2jM5Q1KNRXrLUJZJesm7HfiMx1War/cNKigaLl3AeFnZtYPm', 'klien', 'Klien', 'Perumda BPR Artha Perwira', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 10:11:06'),
	(158, 61, 'delangguraya', '$2y$10$2A9G6EwyKSCte6.hynO3UuEm0eDNlshdDOZtHipNtWtY.9lzKfAlS', 'klien', 'Klien', 'PT. BPR Delanggu Raya', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 14:56:25'),
	(159, 62, 'jembarmajubersama', '$2y$10$/fs5QKDhUIcAJazPfxPK9.CmNPN3c13mB5cvNgZpQO1DgqTBmNjKi', 'klien', 'Klien', 'Koperasi Jembar Maju Bersama', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-11 10:58:09'),
	(160, 63, 'tulung', '$2y$10$yti8zJ1YDVv54QnkOE8L1e5Tx2lQNvsN0Xderfo8CCtlqIYdPoDYK', 'klien', 'Klien', 'PT.  BPR BKK Tulung (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 07:56:41'),
	(161, 64, 'marunting', '$2y$10$CmLXMa/hKNq.K0/hiaB7QeN79jJFW3YBGTMs/3eDdsZ2/.7u2PHRu', 'klien', 'Klien', 'PERUMDA BPR Marunting Sejahtera', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-17 09:28:47'),
	(162, 65, 'sewon', '$2y$10$m6v5V1a2ewEr7Bw31CA0juriwgSCzFEawL6L/xpObbu1TOBt6OIPO', 'klien', 'Klien', 'PT. BPT Kurnia Sewon', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:48:35'),
	(163, 66, 'cipatujah', '$2y$10$kXi73/XiBRfI1qIUnEf.ouk.nFwk.NhyNOJH4TLYtN.UnnQkGMVrC', 'klien', 'Klien', 'PT. BPR Cipatujah Jabar Perseroda', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 09:49:17'),
	(164, 67, 'bougenvill', '$2y$10$WkgnCx8bTB2oYDhFIiq87ec5b6twTgqQ1/lhJhBBsk8IjhrQaq2lm', 'klien', 'Klien', 'KSP Bougenvill', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 10:51:19'),
	(165, 68, 'tci', '$2y$10$UkLG4vvcz.uYvYRObwZEN.yKSMVdIix7Vd/Kg5JLX9zHJ99yPP3sK', 'klien', 'Klien', 'PT BPR TCI', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 10:08:03'),
	(166, 69, 'kotamagelang', '$2y$10$iyQCR9LTXi3JEZWZjcwWYeuwEzR2s5Pr4FJmmgUGavhkP4Uz5pJZi', 'klien', 'Klien', 'PT. BPR BKK Kota Magelang (Perseroda)', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 14:13:19'),
	(167, 70, 'shintadaya', '$2y$10$1kHi5s7g0be3QivP7UeXu.dh4RwVuloyLagVmcLYrfZiPAFmRPrd6', 'klien', 'Klien', 'PT. BPR Shinta Daya', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-21 09:29:07'),
	(168, 71, 'wijayakusuma', '$2y$10$Iq3bQhYDltY217sI1fnGUOI9m8NM9TDMzl8SrZntdWR.lIaFI7DfS', 'klien', 'Klien', 'Kospin Wijaya Kusuma', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-06 15:24:57'),
	(169, 72, 'eleska', '$2y$10$.DRU1xSnJlNBl3qo4JUPV.a.lQGmJQVFAX7rgMaqJE93J3mNpMG5y', 'klien', 'Klien', 'PT BPR Eleska Artha', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-19 17:36:44'),
	(170, 73, 'artamassurakarta', '$2y$10$u4ayEQsyCJaxa.KBGk0RJO97B.QXdpbgHF9QAZesUlObbi9NeoSiS', 'klien', 'Klien', 'PT. BPR Arta Mas Surakarta', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 07:55:52'),
	(171, 74, 'batang', '$2y$10$AaMSsDGF2KyN3K1vLSIPROHwPmlQaS/vEzqmo8cKM4j1vZTRCdE8u', 'klien', 'Klien', 'PT. BPR BKK Batang', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-13 08:24:28'),
	(172, 75, 'galuh', '$2y$10$W5o/x1PCp6jFsK2EkXALPOth9GpPbjjeH5K/R58lT6TUGrVxEDd6S', 'klien', 'Klien', 'PT. BPR BKK GALUH', NULL, NULL, NULL, '2024-08-13', NULL, 'Aktif', '2025-02-20 13:27:45'),
	(174, NULL, 'adminbprxyz', '$2y$10$1E9gLHJmdR990WihZtAj6edGNj7IZr3pPPR6Z4FSUxNeX0M3rQDty', 'klien', 'Klien', 'PT BPR XYZ', NULL, NULL, NULL, '2024-08-22', NULL, 'Aktif', '2025-01-23 11:01:08'),
	(176, NULL, 'nida', '$2y$10$/LTmIooLMp5xN9VEFdNQtuOo9PtwE71hVmEuOxo/UayoBF2Msgq7e', 'staf', 'cbs', 'Nida', NULL, NULL, NULL, '2024-08-16', NULL, 'Aktif', NULL),
	(177, 76, 'sendanghartha', '$2y$10$eQEHfzS/PKELwIPiFSJ./OLniEJ5XTX6q7yGJz8yYiK3hMxTP.zQ2', 'klien', 'Klien', 'PT. BPR Sendang Harta Sejahtera', NULL, NULL, NULL, '2024-09-17', NULL, 'Aktif', '2025-02-20 08:47:23'),
	(178, 77, 'sukadana', '$2y$10$kZXh7pj3vs7cpCIZ7RwuQOpyPq.Ingeyh7.HunycQKQzwAJqtTz6q', 'klien', 'Klien', 'PT BPR Sukdana', NULL, NULL, NULL, '2024-09-17', NULL, 'Aktif', '2025-02-17 14:36:58'),
	(179, 78, 'sukadyarindang', '$2y$10$4i8C6urbWeRXZhyZrqA3uuzp2by7eRLQaD9bpl/L/fhnt3/3UotTu', 'klien', 'Klien', 'PT. BPR Sukadyarindang', NULL, NULL, NULL, '2024-09-17', NULL, 'Aktif', '2025-02-20 08:18:30'),
	(180, NULL, 'superadmin', '$2y$10$fUL13wLmn29PAU6Ogq/sf.2YsfC2UlNGuxA/JnsJVKNGvjJjRL8nm', 'superadmin', 'Superadmin', 'superadmin', NULL, NULL, NULL, '2024-03-18', NULL, 'Aktif', '2025-02-20 10:10:44'),
	(181, 79, 'kotapekalongan', '$2y$10$vK1ZFKBVl9gxIs4u79OmNeP2rTCr1sjQ18Jiw5EbQwmS6KYoPenZ.', 'klien', 'Klien', 'PT. BPR BKK Kota Pekalongan (Perseroda)', NULL, NULL, NULL, '2024-09-18', NULL, 'Aktif', '2025-02-21 08:01:59'),
	(182, 80, 'ukabima', '$2y$10$8Lt5pCNLGlTKNbvSlZ9YEexX55grR/V9WsGaBKpwqOccFqOk0rcrS', 'klien', 'Klien', 'PT BPR UKABIMA', NULL, NULL, NULL, '2024-09-18', NULL, 'Aktif', '2025-02-19 15:38:42'),
	(184, NULL, 'alingwi', '$2y$10$tXZyYGoPbY4wefZZdR0icOY4rXdz6l0aIXrO4T4FPW4RyHzhXHmLe', 'staf', 'cbs', 'alingwi', NULL, NULL, NULL, '2024-09-25', NULL, 'Aktif', '2025-02-06 09:40:03'),
	(187, 81, 'bmtamanah', '$2y$10$3qDv5C/XjM3J7mj7LHI3zOxcGHQ6v63UGE/KiS8EO1RprGxdWy.Y6', 'klien', 'Klien', 'KSU BMT Amananh', NULL, NULL, NULL, '2024-09-30', NULL, 'Aktif', '2024-09-30 14:39:48'),
	(188, 47, 'susukan', '$2y$10$mhO0fh0QiJ4xXsPVuWkQ6.5k7M4CcJ.HoHOs54V8ACH0gIaXXb0iq', 'klien', 'Klien', 'PD. BKK Susukan', NULL, NULL, NULL, '2024-09-30', NULL, 'Aktif', NULL),
	(189, 82, 'Demak', '$2y$10$HkcOm2VP5EPVwKNwNBpkL.t6IItBX5XwodByVqUvfMyBhU1PIO..K', 'klien', 'Klien', 'PT BPR BKK Demak (Perseroda)', NULL, NULL, NULL, '2025-01-15', NULL, 'Aktif', NULL),
	(190, NULL, 'hanifan', '$2y$10$ALcnyp5XWqBHCdWLV7kUUezEYGbESDvkCPpcXILiMJWsjTeGo8LAO', 'dirops', 'Superadmin', 'Hanifan', NULL, NULL, NULL, '2024-10-16', NULL, 'Aktif', NULL),
	(191, NULL, 'sobirin', '$2y$10$.wbVe6Xftn/iP4IVvZ/S5uERd5BlpwDKLP6Z.2P.580TmycBnv6ba', 'dirut', 'Superadmin', 'Sobirin', NULL, NULL, NULL, '2024-10-16', NULL, 'Aktif', NULL),
	(194, NULL, 'caesar', '$2y$10$xw1igNAKdm9/qQDgesRyaeprxkzyYtPl/6S5Fok51m8wrvMVJOVW2', 'dirops', 'dirops', 'Yusuf Caesar', '', '', NULL, '2025-03-13', NULL, 'Aktif', NULL),
	(195, NULL, 'tri', '$2y$10$eMCYOQGJ2YX57Qk2W9anEuSlhyJUrSFsXpy2Si1ByYbo6/X9o.ePi', 'kadiv', 'umum', 'Tri Resmiati', '', '', NULL, NULL, NULL, 'Aktif', NULL);

-- Dumping structure for table ci4_surat_new.wilayah_kabupaten
CREATE TABLE IF NOT EXISTS `wilayah_kabupaten` (
  `id_wilayah_kabupaten` int unsigned NOT NULL AUTO_INCREMENT,
  `id_wilayah_propinsi` int unsigned NOT NULL,
  `nama_kabupaten` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ibukota` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k_bsni` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_wilayah_kabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.wilayah_kabupaten: ~0 rows (approximately)

-- Dumping structure for table ci4_surat_new.wilayah_kecamatan
CREATE TABLE IF NOT EXISTS `wilayah_kecamatan` (
  `id_wilayah_kecamatan` int unsigned NOT NULL AUTO_INCREMENT,
  `id_wilayah_kabupaten` int unsigned NOT NULL,
  `nama_kecamatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_wilayah_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.wilayah_kecamatan: ~0 rows (approximately)

-- Dumping structure for table ci4_surat_new.wilayah_kelurahan
CREATE TABLE IF NOT EXISTS `wilayah_kelurahan` (
  `id_wilayah_kelurahan` int unsigned NOT NULL AUTO_INCREMENT,
  `id_wilayah_kecamatan` int unsigned NOT NULL,
  `nama_kelurahan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_wilayah_kelurahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.wilayah_kelurahan: ~0 rows (approximately)

-- Dumping structure for table ci4_surat_new.wilayah_propinsi
CREATE TABLE IF NOT EXISTS `wilayah_propinsi` (
  `id_wilayah_propinsi` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_propinsi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ibukota` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_bsni` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_wilayah_propinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ci4_surat_new.wilayah_propinsi: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
