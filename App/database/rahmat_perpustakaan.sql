-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 06:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rahmat_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nip` int(25) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `user_admin` varchar(25) NOT NULL,
  `pass_admin` varchar(25) NOT NULL,
  `telp_admin` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nip`, `nama`, `user_admin`, `pass_admin`, `telp_admin`, `jenis_kelamin`) VALUES
(1, 899893821, 'Admin', 'admin123', 'admin123', '083278743', 'perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(55) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `kategori_buku` varchar(25) NOT NULL,
  `gambar_buku` varchar(55) NOT NULL,
  `barcode_isbn` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `jumlah_buku`, `kategori_buku`, `gambar_buku`, `barcode_isbn`) VALUES
(11, 'Harry Potter', 2, 'Horror', 'f1711924720.jpg', '8390123'),
(12, 'Jungle', 21, 'Adventure', 'f1711924799.jpg', '7893213'),
(13, 'In Darkling Wood', 3, 'Romance', 'f1711924853.jpg', '897893721'),
(14, 'Grifingate', 7, 'Adult', 'f1711924876.jpg', '237983'),
(15, 'Bintang', 3, 'asik', 'f1711925098.jpg', '31241241'),
(16, 'Bumi', 66, 'Asik', 'f1711925118.jpg', '873445'),
(18, 'Menyapa Senja', 14, 'Romance', 'f1711925181.webp', '874872'),
(19, 'Sejarah Lengkap', 9, 'History', 'f1711925220.jpeg', '1274345'),
(20, 'Poonys World', 88, 'Romance', 'f1711925285.jpg', '137483');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `barcode_isbn` varchar(25) NOT NULL,
  `nis_peminjam` varchar(25) NOT NULL,
  `nama_peminjam` varchar(25) NOT NULL,
  `tgl_pinjam` varchar(25) NOT NULL,
  `tgl_kembali` varchar(25) NOT NULL,
  `telp_peminjam` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `barcode_isbn`, `nis_peminjam`, `nama_peminjam`, `tgl_pinjam`, `tgl_kembali`, `telp_peminjam`) VALUES
(6, '7893213', '8908890', 'Aldous', '01-04-2024', '08-04-2024', '809809'),
(7, '237983', '8908890', 'Aldous', '01-04-2024', '08-04-2024', '809809'),
(10, '874872', '8908890', 'Aldous', '01-04-2024', '08-04-2024', '809809');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `alamat` varchar(55) NOT NULL,
  `telp` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `password`, `nama`, `jenis_kelamin`, `kelas`, `alamat`, `telp`) VALUES
(2, 8908890, 'aldous', 'Aldous', 'Laki-laki', '9', 'kjlkfds', '809809');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
