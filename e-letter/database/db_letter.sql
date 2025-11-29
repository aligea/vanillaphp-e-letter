-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2016 at 01:45 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_letter`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `nama` varchar(255) NOT NULL,
  `alamat` text,
  `npwp` varchar(150) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `kodepos` varchar(50) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`nama`, `alamat`, `npwp`, `fax`, `telp`, `kodepos`, `logo`) VALUES
('PT. Polychem Indonesia Tbk', 'JL. Daan Mogot KM 21 - Desa Poris Plawad, Kec. Cipondoh Tangerang', '01.326.008.8-092.000', '021-55512986', '021-55512986', '15122', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categori`
--

CREATE TABLE IF NOT EXISTS `categori` (
  `id` int(11) NOT NULL,
  `kode` varchar(150) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `note` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categori`
--

INSERT INTO `categori` (`id`, `kode`, `nama`, `note`) VALUES
(1, 'KU.00.2', 'PENYUSUNAN ANGGARAN', 'Surat-surat yang berkenaan dengan anggaran belanja, seperti PAGU Indikatif, Pagu Definitif, RKA, DIPA, POK, Revisi Anggaran'),
(3, 'KU.01.1', 'SURAT PERMINTAAN PEMBAYARAN1111', 'Surat-surat yang berkenaan dengan pengajuan dan pengeluaran surat permintaan pembayaran (SPP) meliputi SPPGU, SPPDU/TU, SPPLS, ABT rutin, termasuk gaji pegawai, Surat Pernyataan Pengajuan Tambahan Uang Persediaan, Surat Permohonan Tambahan Uang Persediaan, Surat Pernyataan Permintaan Dispensasi Tambahan Uang Persediaan, Penambahan Anggaran/Anggaran Pendapatan Belanja Negara Perubahan.');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE IF NOT EXISTS `jenis_surat` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama`) VALUES
(1, 'Surat Edaran'),
(2, 'Biasa'),
(3, 'Rahasia'),
(4, 'Surat Pengumuman'),
(5, 'Surat Sangat Rahasia');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `banner` varchar(255) NOT NULL,
  `rows` int(11) NOT NULL,
  `pswd_limit` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`banner`, `rows`, `pswd_limit`) VALUES
('E-Surat', 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `id` int(11) NOT NULL,
  `no_agenda` varchar(150) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `pengirim` varchar(150) DEFAULT NULL,
  `no_surat` varchar(150) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `lampiran` varchar(150) DEFAULT NULL,
  `file_scan` varchar(250) DEFAULT NULL,
  `idjenis_surat` int(11) DEFAULT NULL,
  `ringkasan_pokok` text,
  `tujuan` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `created_by` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `no_agenda`, `tgl_kirim`, `pengirim`, `no_surat`, `tgl_surat`, `lampiran`, `file_scan`, `idjenis_surat`, `ringkasan_pokok`, `tujuan`, `keterangan`, `created_by`, `created_date`) VALUES
(1, '949/9090-09.3432', '2016-04-15', 'bambang', '53452-090.2349203', '2016-04-21', '3 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'fsdf kjfosuiofj lfjoasufio', 'bambang', 'kfuaoisf jreoiuewjr lkjlj dflsa', '0', '0000-00-00 00:00:00'),
(2, '949/9090-09.3432', '2016-04-20', 'bambang', '949/9090-09.3432', '2016-04-14', '5 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'fdaf kljflsjf lkjfl ksajflks f', 'Budi', 'fkj lkj lkjalkdfj lkjaf', '0', '0000-00-00 00:00:00'),
(3, 'fsdf', '2016-04-07', 'fsdf', 'fasdf', '2016-04-07', 'fsdaf', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'fsfs', 'fdsaf', 'fdsaf', '135', '2016-04-14 15:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id` int(11) NOT NULL,
  `no_agenda` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pengirim` varchar(150) DEFAULT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `lampiran` varchar(150) NOT NULL,
  `file_scan` varchar(150) NOT NULL,
  `idjenis_surat` int(11) NOT NULL,
  `ringkasan_pokok` text NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `keterangan` text,
  `created_by` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `no_agenda`, `tgl_terima`, `pengirim`, `no_surat`, `tgl_surat`, `lampiran`, `file_scan`, `idjenis_surat`, `ringkasan_pokok`, `tujuan`, `keterangan`, `created_by`, `created_date`) VALUES
(9, 'No.939/1300.23', '2016-04-13', 'Sudirman', '999-34/030.990', '2016-04-13', '2 berkas', 'Magento Feature List 11.16.2015.pdf', 3, 'Tentang masalah yang sedang dialami banyak orang saat ini dan bagaimana cara penyelesaianya.', 'bambang', 'mohon cepat di respon. terima kasih', '', '0000-00-00 00:00:00'),
(10, 'No.939/1300.23', '2016-04-13', 'Paijo', 'No.939/1300.23', '2016-04-13', '3 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 3, 'Baca Dunks', 'Budi', 'Cepat direspon woi!!', '', '0000-00-00 00:00:00'),
(11, '4234/30134', '2016-04-07', 'bambang', '123524234', '2016-04-07', '5 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 1, 'fsdfsd', 'Budi', 'fsdfsdafas', '', '0000-00-00 00:00:00'),
(12, 'fasdf', '0000-00-00', 'fdasf', 'fsdaf', '2016-04-07', 'fsadf', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'fsdafsa', 'fdsafa', 'fadf', '', '0000-00-00 00:00:00'),
(13, 'fdsafas', '2016-04-07', 'fsdaf', 'fsdf', '2016-04-07', 'fsadf', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'fdsfsa', 'fdsaf', 'fdsafsa', '', '0000-00-00 00:00:00'),
(14, 'fdsafa', '2016-04-05', 'fasdf', 'fasfd', '2016-04-06', 'fsddf', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'fsadf', 'fsdf', 'afsdf', '135', '2016-04-14 15:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `reset` int(1) NOT NULL,
  `reset_code` varchar(6) NOT NULL,
  `hit` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `name`, `level`, `status`, `reset`, `reset_code`, `hit`) VALUES
(135, 'admin', '518b860eb3b453c51f2494ffab283860', 'admin', 2, 0, 0, '444444', 0),
(137, 'popo', 'popo', 'popo', 2, 0, 0, '0', 0),
(138, 'pipi', 'b2e2c4d7bdf7d7499d373a27f08c9c0a', 'pipi', 1, 0, 0, '0', 0),
(139, 'joko', '2dac5176cbeda9f2b5dacc702c879fc8', 'joko saja', 1, 0, 0, '0', 0),
(140, 'papa', 'fb27fe7cfadb4e57d7109ad9a5f52d2a', 'papa sayang', 1, 0, 1, '0', 2),
(141, 'papas', '5c6a5e69c1501af9c4c40e4ba6e78930', 'papas', 2, 0, 1, '0', 1),
(142, 'jokos', 'f5c0bb95b47ae91a69461dadec7ff0a8', 'jokos', 2, 0, 1, '0', 0),
(143, 'TIUR', '85d636cc8c7a662c29c5438289413f44', 'tiur', 1, 0, 0, '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categori`
--
ALTER TABLE `categori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categori`
--
ALTER TABLE `categori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
