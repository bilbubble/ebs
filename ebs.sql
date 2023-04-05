-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 01:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebs`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_account`
--

CREATE TABLE `td_account` (
  `id` int(11) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(500) NOT NULL,
  `otoritas` varchar(20) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_account`
--

INSERT INTO `td_account` (`id`, `fullname`, `email`, `username`, `password`, `otoritas`, `foto`) VALUES
(9, 'editor', 'editor@gmail.com', 'editor', '$2y$10$b8IuSlkISySoEVYIFxRTPuJ7ZRxBpf2TWU/wwYYT28ARJbOpiFUgG', 'editor', ''),
(10, 'user', 'user@gmail.com', 'user', '$2y$10$Mn9RAXGcLIH4jvGo5BXcEeH3JWYGYEDUB48sxkFhLduatJQ2yVdsO', 'user', ''),
(11, 'admin', 'admin@gmail.com', 'admin', '$2y$10$coMA7wXR/u/yGuW1KO35auQrWlChxokd.JVqxFVxrvHfImF83JOo.', 'admin', ''),
(12, 'bila', 'bilaputri3@gmail.com', 'biladek', '$2y$10$/xNTJcsv8sSibLdPjAseX.8aMYSV4vZQHw.PCAhBYPiLCo6eyhqmC', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `td_chart`
--

CREATE TABLE `td_chart` (
  `id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `artis` varchar(256) NOT NULL,
  `peringkat_minggu_ini` int(3) NOT NULL,
  `peringkat_minggu_lalu` int(3) NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_chart`
--

INSERT INTO `td_chart` (`id`, `judul`, `slug`, `artis`, `peringkat_minggu_ini`, `peringkat_minggu_lalu`, `foto`) VALUES
(4, 'Kereta', 'charlie-st12-kereta', 'Charlie ST12', 4, 1, '1677419311-63fb632fafe3f.jpg'),
(7, 'xxx', 'artis-baru-judul-baru', 'yyy', 3, 3, '1677915854-6402f6cec67cc.png'),
(8, 'xxx', 'asd-asd', 'yyy', 2, 3, '1677916280-6402f8785a987.png'),
(9, 'KKKK', 'artis-kedua-ini-judul', 'NNNN', 4, 5, '1677923514-640314ba30634.png');

-- --------------------------------------------------------

--
-- Table structure for table `td_news`
--

CREATE TABLE `td_news` (
  `id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `penulis` varchar(256) NOT NULL,
  `konten` varchar(4000) NOT NULL,
  `rubrik` varchar(50) NOT NULL,
  `tgl_terbit` date DEFAULT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_news`
--

INSERT INTO `td_news` (`id`, `judul`, `slug`, `penulis`, `konten`, `rubrik`, `tgl_terbit`, `foto`) VALUES
(19, 'Judul 1', 'judul-1', 'Penulis 1', 'Konten 1', 'Hollywood', '2023-02-12', '1677925993-64031e69645eb.png'),
(20, 'Judul 2', 'judul-2', 'Penulis 2', 'Konten 2', 'Sport', '2000-02-20', '1677925993-64031e69645eb.png'),
(23, 'Judul 5', 'judul-5', 'Penulis 5', 'Konten 5', 'Hollywood', '2023-03-15', '1677926430-6403201e501ef.png'),
(24, 'Judul 6', 'judul-6', 'Penulis 6', 'Konten 6', 'EBS Music Box', '2023-03-18', '1677926664-64032108d6203.jpg'),
(25, 'Judul 7', 'judul-7', 'Penulis 7', 'Konten 7', 'EBS Music Box', '2023-03-18', '1677926707-640321330ff9c.png'),
(26, 'ppp', 'ppp', 'boii', 'addgfs', 'Lifestyle', '2023-03-18', '1678279024-6408817084596.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `td_surat_masuk`
--

CREATE TABLE `td_surat_masuk` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_surat_masuk`
--

INSERT INTO `td_surat_masuk` (`id`, `nama`, `judul`, `slug`, `tanggal`, `jenis`, `file`) VALUES
(31, 'ubah', 'Acara ', 'tes-1-tes-1', '2003-03-31', 'media partner', '1677770972-6400c0dc72dbe.pdf'),
(36, 'AKBAR', 'aa', 'akbar-aa', '2023-03-06', 'media partner', '1678278798-6408808e9b775.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_account`
--
ALTER TABLE `td_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_chart`
--
ALTER TABLE `td_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_news`
--
ALTER TABLE `td_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_surat_masuk`
--
ALTER TABLE `td_surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_account`
--
ALTER TABLE `td_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `td_chart`
--
ALTER TABLE `td_chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `td_news`
--
ALTER TABLE `td_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `td_surat_masuk`
--
ALTER TABLE `td_surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
