-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 10, 2024 at 11:28 AM
-- Server version: 11.5.2-MariaDB-log
-- PHP Version: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb_pksdftrpasien`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$aPGvje0fwE2aHc1g2e.iVOmjyHkRhPdIE0rwSQU353FjdQ7IT/hqm');

-- --------------------------------------------------------

--
-- Table structure for table `apotek`
--

CREATE TABLE `apotek` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `jenis_obat` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apotek`
--

INSERT INTO `apotek` (`id`, `nama_obat`, `jenis_obat`, `harga`, `stok`) VALUES
(1, 'Alopurinol tablet 100 mg', 'Tablet', 16000, 10),
(2, 'Ambroxol sirup 15 mg/ml\r\n', 'Botol/Sirup', 5000, 10),
(3, 'Amoksisilin kapsul 250 mg', 'Kapsul', 38000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `catatanmedis`
--

CREATE TABLE `catatanmedis` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `diagnosa` varchar(255) NOT NULL,
  `pengobatan` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `keluhan` text NOT NULL,
  `rencana_perawatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catatanmedis`
--

INSERT INTO `catatanmedis` (`id`, `id_pasien`, `id_dokter`, `tanggal_kunjungan`, `diagnosa`, `pengobatan`, `catatan`, `keluhan`, `rencana_perawatan`) VALUES
(1, 3, 1, '2024-08-04', 'ada semut', '', 'perkiraan sembuh 2 hari selama rutin', 'gatal ditelinga', 'teteskan obat tetes ke telingan 2x sehari');

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `id` int(11) NOT NULL,
  `id_pasien` varchar(255) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `alasan` text NOT NULL,
  `no_antrian` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar`
--

INSERT INTO `daftar` (`id`, `id_pasien`, `id_dokter`, `id_poli`, `tanggal_daftar`, `alasan`, `no_antrian`, `created_at`, `updated_at`, `approved`) VALUES
(3, '1', 1, 1, '2024-07-28', 'cek kolestrol', '', '2024-07-27 11:27:40', '0000-00-00 00:00:00', 1),
(4, '1', 1, 1, '2024-08-01', 'cek detak jantung', 'A1', '2024-08-01 13:53:25', '0000-00-00 00:00:00', 0),
(5, '2', 1, 1, '2024-08-01', 'cek tekanan darah', 'A2', '2024-08-01 14:23:45', '0000-00-00 00:00:00', 0),
(6, '3', 1, 1, '2024-08-02', 'cek jantung', 'A1', '2024-08-02 01:36:24', '0000-00-00 00:00:00', 0),
(7, '2', 5, 4, '2024-08-04', 'Gatal gatal di kulit kepala', 'A1', '2024-08-04 02:29:51', '0000-00-00 00:00:00', 0),
(8, '3', 1, 4, '2024-08-04', 'tenggorokan gatal', 'A2', '2024-08-04 15:16:42', '0000-00-00 00:00:00', 0),
(9, '2', 5, 4, '2024-08-11', 'cek kondisi kulit', 'A1', '2024-08-11 13:06:28', '0000-00-00 00:00:00', 0),
(10, '1', 1, 2, '2024-08-11', 'tenggorokan kering', 'A2', '2024-08-11 13:07:37', '0000-00-00 00:00:00', 0),
(11, '3', 5, 4, '2024-08-24', 'cek kondisi kulit', 'A1', '2024-08-24 14:36:50', '0000-00-00 00:00:00', 1),
(12, '1', 2, 1, '2024-08-24', 'cek kondisi jantung', 'A2', '2024-08-24 15:12:35', '0000-00-00 00:00:00', 0),
(13, '3', 0, 4, '2024-09-02', 'bintik merah di kulit', 'A1', '2024-09-02 01:17:47', '0000-00-00 00:00:00', 0),
(14, 'P1', 0, 1, '2024-09-02', 'detak jantung terlalu cepat', 'A2', '2024-09-02 01:46:59', '0000-00-00 00:00:00', 0),
(15, 'P1', 1, 5, '2024-10-01', 'batuk kering', 'A1', '2024-10-01 05:49:35', '0000-00-00 00:00:00', 1),
(16, '2', 0, 4, '2024-10-09', 'kulit merah', 'A1', '2024-10-09 05:45:53', '0000-00-00 00:00:00', 0),
(17, 'P1', 2, 1, '2024-10-10', 'detak jantung cepat', 'A1', '2024-10-10 11:22:39', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `keahlian` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `id_poli`, `nama_dokter`, `keahlian`, `nohp`, `email`) VALUES
(1, 5, 'dr. Western jau Sp.THT-KL', 'Sp. THT', '085123456789', 'western@gmail.com'),
(2, 1, 'dr. Agung Sucipto Sp.JP', 'Sp. Jantung dan Pembuluh Darah', '085213456782', 'agung@gmail.com'),
(5, 4, 'dr. Ari Gustiono Sp.KK', 'Sp. Kulit dan Kelamin', '081738238928', 'ari@gmail.com'),
(6, 2, 'dr. Salak Bali Sp.A', 'Sp. Anak', '087564124561', 'salak@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dokter_piket`
--

CREATE TABLE `dokter_piket` (
  `id` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `id_pasien`, `id_dokter`, `id_poli`, `tanggal`, `jam`, `alasan`, `status`) VALUES
(1, 1, 1, 1, '2024-07-30', '09:30:00', 'periksa tenggorokan', 'completed'),
(2, 1, 5, 4, '2024-08-20', '09:20:00', 'Merah bintik gatal di badan', 'scheduled'),
(3, 3, 5, 4, '2024-08-20', '09:30:00', 'kena cacar', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `NOKK` varchar(20) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `bpjs` varchar(10) NOT NULL DEFAULT 'Tidak',
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `NOKK`, `NIK`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `nohp`, `bpjs`, `email`, `password`) VALUES
(1, 'jauzi', '5201250809079167', '5201457382092400', '2024-07-01', 'Laki laki', 'Washington', '081653728156', 'Tidak', 'jauzi@gmail.com', '$2y$10$HPx63tzNm8uhaRmgBB3AEOz0Yhi9TmL1cbwsor/tEezC6EUl0zJ8G'),
(2, 'alex', '5201230809079665', '5201094378900002', '2024-02-14', 'Laki laki', 'Los Angeles', '085213456782', 'Tidak', 'alex@gmail.com', '$2y$10$cV4CXQ7CELq5FaFPNyD9He.VTCGaX4K4zzBjTKaCmgfTX//.pOCB.'),
(3, 'Venom', '5201230809079678', '5201086754120003', '2024-07-02', 'Laki laki', 'Gedong timur', '082341562761', 'Tidak', 'venom@gmail.com', '$2y$10$AhxrZbyZYdCpHGnAKGX8N.53Vw8TSbWdMr3AhQbMGuZ6TXL/h1.F2');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`) VALUES
(1, 'Jantung'),
(2, 'Anak'),
(4, 'Kulit'),
(5, 'THT (Telinga Hidung Tenggorokan)');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id`, `id_pasien`, `id_dokter`, `tanggal`) VALUES
(1, 1, 1, '2024-08-04 16:33:49'),
(2, 1, 5, '2024-08-04 18:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `resepobat`
--

CREATE TABLE `resepobat` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `dosis` varchar(50) NOT NULL,
  `instruksi` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resepobat`
--

INSERT INTO `resepobat` (`id`, `id_pasien`, `id_dokter`, `id_resep`, `id_obat`, `tanggal`, `dosis`, `instruksi`, `status`) VALUES
(1, 1, 1, 1, 1, '2024-08-04', '1', '2x sehari (setelah makan)', ''),
(2, 1, 1, 1, 2, '2024-08-04', '1', '2x sehari (setelah makan)', ''),
(3, 1, 1, 1, 3, '2024-08-04', '2', '1x sehari', ''),
(4, 1, 5, 2, 3, '2024-08-04', '1', 'minum ketika gatal muncul (pereda gatal)', ''),
(5, 1, 5, 2, 1, '2024-08-04', '1', '2x sehari (setelah makan)', '');

-- --------------------------------------------------------

--
-- Table structure for table `second_pasien`
--

CREATE TABLE `second_pasien` (
  `id` varchar(255) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `nokk` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `bpjs` varchar(10) NOT NULL DEFAULT 'Tidak',
  `nobpjs` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_pasien`
--

INSERT INTO `second_pasien` (`id`, `id_pasien`, `nama_pasien`, `nokk`, `nik`, `tgl_lahir`, `jk`, `alamat`, `nohp`, `bpjs`, `nobpjs`, `username`, `email`, `password`) VALUES
('P1', 3, 'Vero X', '5201230809079678', '5201092404010002', '2024-03-07', 'Laki laki', 'Dasan lauk', '081767128923', 'Ya', '01020003123', 'vero', 'vero@gmail.com', '$2y$10$2GZqjYd8JfMvZK7YbXgT8OFZ9hV6P/9o5jLyhs9yR1FLHP7B0p8BO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apotek`
--
ALTER TABLE `apotek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catatanmedis`
--
ALTER TABLE `catatanmedis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter_piket`
--
ALTER TABLE `dokter_piket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resepobat`
--
ALTER TABLE `resepobat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `second_pasien`
--
ALTER TABLE `second_pasien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apotek`
--
ALTER TABLE `apotek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catatanmedis`
--
ALTER TABLE `catatanmedis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar`
--
ALTER TABLE `daftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dokter_piket`
--
ALTER TABLE `dokter_piket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resepobat`
--
ALTER TABLE `resepobat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
