-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 08:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pegawaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(4) NOT NULL,
  `foto_bukti` text NOT NULL,
  `nama_absen` text NOT NULL,
  `status_absen` varchar(50) NOT NULL,
  `tanggal_absen` date NOT NULL DEFAULT current_timestamp(),
  `maker_absen` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `foto_bukti`, `nama_absen`, `status_absen`, `tanggal_absen`, `maker_absen`) VALUES
(15, '1697003059_ffbbfb1773b4b4a3179d.png', 'Hadir', 'Disetujui', '2023-10-11', 4);

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(4) NOT NULL,
  `nama_rencana` text NOT NULL,
  `agenda` text NOT NULL,
  `tanggal_agenda` date NOT NULL DEFAULT current_timestamp(),
  `status_agenda` text NOT NULL,
  `maker_agenda` int(4) NOT NULL,
  `agenda_agenda` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `nama_rencana`, `agenda`, `tanggal_agenda`, `status_agenda`, `maker_agenda`, `agenda_agenda`) VALUES
(8, 'merakit PC', 'Memperbaiki Server', '2023-10-11', 'Disetujui', 4, '2023-10-11 12:45:11'),
(9, 'mempersiapkan meeting ', 'memperbaiki CCTV', '2023-10-11', 'Tidak Disetujui', 5, '2023-10-11 12:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(4) NOT NULL,
  `id_pegawai_gaji` int(4) NOT NULL,
  `harga_gaji` text NOT NULL,
  `tanggal_gaji` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(15) NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_pegawai_gaji`, `harga_gaji`, `tanggal_gaji`, `status`, `bukti`) VALUES
(6, 3, '2.000.000', '2023-11-01', 'Diterima', '1697003296_dca9c8997f05277d4d14.png');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(4) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `catatan_jabatan` text NOT NULL,
  `tanggal_jabatan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `catatan_jabatan`, `tanggal_jabatan`) VALUES
(1, 'CEO', 'tugas CEO adalah membangun strategi dan memiliki rencana B, C, D, dan seterusnya jika kelak terjadi hambatan.', '2023-09-14 00:00:00'),
(4, 'Manager', ' Mengelola tim, mengambil keputusan strategis, dan memantau kinerja departemen.', '2023-09-14 00:00:00'),
(5, 'Staf Keuangan', 'Mengelola keuangan perusahaan, mengatur laporan keuangan, dan melakukan analisis keuangan.', '2023-09-14 00:00:00'),
(6, 'Konsultan Bisnis', ' Memberikan saran bisnis kepada klien, melakukan analisis bisnis, dan membantu dalam pengambilan keputusan strategis.', '2023-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(4) NOT NULL,
  `id_user_pegawai` int(4) NOT NULL,
  `id_jabatan_pegawai` int(4) NOT NULL,
  `nik` int(20) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `ttl` varchar(255) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal_pegawai` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user_pegawai`, `id_jabatan_pegawai`, `nik`, `nama_pegawai`, `ttl`, `jk`, `email`, `tanggal_pegawai`) VALUES
(1, 1, 5, 1234567890, 'Norman Ang', 'singapore, 28 mei 2006', 'Laki-Laki', 'jofinson_lim88@gmail.com', '2023-09-14 00:00:00'),
(2, 4, 6, 1123456789, 'Asep Asep', 'batam, 01 maret 2006', 'Laki-Laki', 'kepinnnn@gmail.com', '2023-09-14 00:00:00'),
(3, 5, 1, 122345678, 'Sumantooo', 'batam, 20 november 2006', 'Female', 'ferdi_sambo@gmail.com', '2023-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `foto` text NOT NULL,
  `tanggal_user` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `foto`, `tanggal_user`) VALUES
(1, 'Norman', 'cccf3d86bddad524562a235e24ad4850', 1, '1694778507_2d8fd7ff078fb7f35c66.jpg', '2023-09-14'),
(4, 'Asep', 'cccf3d86bddad524562a235e24ad4850', 2, '1694772409_a353a6a80d7f9392349a.jpeg', '2023-09-14'),
(5, 'Sumanto', 'cccf3d86bddad524562a235e24ad4850', 3, '1694946605_064fd8543bab05bb51b5.jpeg', '2023-09-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
