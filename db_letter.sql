-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2016 at 05:10 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
('PT.BANK NEGARA INDONESIA', 'Jl. Jend. Sudirman Kav.1 Jakarta Pusat', '01.001.606.1-093.000', '021-5728053', '021-5728387', '10220', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categori`
--

CREATE TABLE IF NOT EXISTS `categori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(150) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categori`
--

INSERT INTO `categori` (`id`, `kode`, `nama`, `note`) VALUES
(1, 'KU.00.2', 'PENYUSUNAN ANGGARAN', 'Surat-surat yang berkenaan dengan anggaran belanja, seperti PAGU Indikatif, Pagu Definitif, RKA, DIPA, POK, Revisi Anggaran'),
(3, 'KU.01.1', 'SURAT PERMINTAAN PEMBAYARAN1111', 'Surat-surat yang berkenaan dengan pengajuan dan pengeluaran surat permintaan pembayaran (SPP) meliputi SPPGU, SPPDU/TU, SPPLS, ABT rutin, termasuk gaji pegawai, Surat Pernyataan Pengajuan Tambahan Uang Persediaan, Surat Permohonan Tambahan Uang Persediaan, Surat Pernyataan Permintaan Dispensasi Tambahan Uang Persediaan, Penambahan Anggaran/Anggaran Pendapatan Belanja Negara Perubahan.');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE IF NOT EXISTS `disposisi` (
  `id` int(11) NOT NULL,
  `kode_disposisi` char(6) NOT NULL,
  `kode_sm` varchar(50) NOT NULL,
  `tgl_disposisi` date NOT NULL,
  `dari` varchar(50) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `tgl_surat` date NOT NULL,
  `catatan_disposisi` varchar(300) NOT NULL,
  `status_terima` varchar(15) NOT NULL,
  `tgl_terima` date NOT NULL,
  `penerima` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id`, `kode_disposisi`, `kode_sm`, `tgl_disposisi`, `dari`, `kepada`, `tgl_surat`, `catatan_disposisi`, `status_terima`, `tgl_terima`, `penerima`) VALUES
(1, '001', '001', '2016-04-15', 'Pemimpin Divisi', 'COA', '2016-04-13', 'Plis follow up dan koordinasi dengan PIC terkait program, buat balasan memo', 'Sudah Terima', '2016-04-15', 'Zumii-Staf Admin Kelompok');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE IF NOT EXISTS `jenis_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama`, `keterangan`) VALUES
(1, 'Notin', 'Nota Intern Komunikasi antar kelompok dalam satu Divisi/Satuan/Unit di Kantor Besar, antar unit dalam satu Kantor Wilayah, dan antar unit dalam satu Kantor Cabang'),
(2, 'Memo', 'Alat komunikasi yang digunakan di Kantor Besar secara timbal balik antara Direksi dengan Divisi/Satuan/Unit dan antara Divisi/ Satuan/Unit dengan Divisi/Satuan/Unit lainnya'),
(3, 'Surat', 'Alat komunikasi yang digunakan secara timbal balik antara Divisi/satuan/unit dengan Kantor Wilayah/Kantor cabang,antara kantor wilayah,antara kantor cabang, dan BNI dgn pihak luar');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE IF NOT EXISTS `kelompok` (
  `id` int(11) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_rubrik` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `kode`, `nama`, `no_rubrik`) VALUES
(1, 'CPL', 'Kelompok Kartu Premium & Loyal', 'BSK/1'),
(2, 'CUI', 'Kelompok Penggunaan Kartu Gene', 'BSK/2'),
(3, 'PDE', 'Kelompok Pengembangan Produk k', 'BSK/3'),
(4, 'COA', 'Kelompok Co Brand, Affinity & ', 'BSK/4'),
(5, 'PPG', 'Kelompok Perencanaan & Portofo', 'BSK/5'),
(6, 'OPE', 'Kelompok Operasional', 'BSK/6'),
(7, 'STL', 'Kelompok Penunjang Bisnis', 'BSK/7');

-- --------------------------------------------------------

--
-- Table structure for table `penomoran`
--

CREATE TABLE IF NOT EXISTS `penomoran` (
  `id` int(11) NOT NULL,
  `kode_nomor` char(6) NOT NULL,
  `kode_approval` char(9) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `kepada` varchar(30) NOT NULL,
  `tanggal_surat` int(11) NOT NULL,
  `File` varchar(150) NOT NULL,
  `User_Entry` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('E-MAILING SYSTEM', 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_sk` varchar(50) DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `dari` varchar(150) DEFAULT NULL,
  `no_surat` varchar(150) DEFAULT NULL,
  `lampiran` varchar(150) DEFAULT NULL,
  `file_scan` varchar(250) DEFAULT NULL,
  `idjenis_surat` int(11) DEFAULT NULL,
  `perihal` text,
  `tujuan` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `user_entry` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor_sk`, `tgl_terima`, `dari`, `no_surat`, `lampiran`, `file_scan`, `idjenis_surat`, `perihal`, `tujuan`, `keterangan`, `user_entry`) VALUES
(1, '002', '2016-04-03', 'PDE', 'BSK/3', '3 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'Permohonan Proses Refund Dana Kelebihan Pembayaran Kartu Kredit a.n Damayani', 'Wakil Pemimpin Divisi II', ' ', '0'),
(2, '001', '2016-04-03', 'CPL', 'BSK/1', '5 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'Penyampaian Desain Marketing Produk Kartu Kredit di Event Java Jazz Festival 2016', 'Wakil Pemimpin Divisi I', '', '0'),
(3, '003', '2016-04-03', 'COA', 'BSK/4', '1 Berkas', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'Kerjasama Event Penerimaan Mahasiswa Baru Tahun Ajaran 2017', 'Wakil Pemimpin Divisi I', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_sm` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `pengirim` varchar(150) DEFAULT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `lampiran` varchar(150) NOT NULL,
  `file_scan` varchar(150) NOT NULL,
  `idjenis_surat` int(11) NOT NULL,
  `perihal` text NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `keterangan` text,
  `user_entry` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_sm`, `tgl_terima`, `pengirim`, `no_surat`, `tgl_surat`, `lampiran`, `file_scan`, `idjenis_surat`, `perihal`, `tujuan`, `keterangan`, `user_entry`) VALUES
(1, '001', '2016-04-12', 'CMM', 'CMM/1/543', '2016-04-13', '5 Lembar', 'Magento Feature List 11.16.2015.pdf', 2, 'Penyampaian Desain Marketing Program Produk Kartu Kredit di Event Java Jazz Festival 2016', 'Pemimpin Divisi', '', ''),
(2, '002', '2016-04-13', 'STL', 'STL/123', '2016-04-13', '3 Lembar', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 1, 'Penyampaian Kebijakan Divisi Bisnis Kartu', 'Pemimpin Divisi', '', ''),
(3, '003', '2016-04-13', 'CLN', 'CLN/2/432', '2016-04-07', '5 Lembar', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'Permohonan Proses Refund Dana Kelebihan Pembayaran Kartu Kredit an Damayani', 'Wakil Pemimpin Divisi', '', ''),
(4, '004', '2016-04-15', 'Universitas Indi=onesia', 'UI/7366/SIU778', '2016-04-07', '2 Lembar', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 3, 'Permohonan Kerjasama Event Penerimaan Mahasiswa Baru Tahun Ajaran 2017', 'Pemimpin Divisi', '', ''),
(5, '005', '2016-04-14', 'PDM', 'PDM/6/378', '2016-04-07', '4 Lembar', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'Joint Program Kartu Kredit dan Kartu Debit Pada Event Fun Bike di Bandung Festival 2016', 'Wakil Pemimpin Divisi', '', ''),
(6, '006', '2016-04-16', 'INT', 'INT/4/154', '2016-04-06', '1 Lembar', 'Magento Enterprise Edition 2.0 Data Sheet 12.01.15.pdf', 2, 'Pengajuan Kartu Kredit an Tsukushi Kanimaru', 'Pemimpin Divisi', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelompok` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `kode`, `nama`, `kelompok`) VALUES
(1, '001', 'Affinity Kartu Kredit', 'COA'),
(2, '002', 'Co Brand Kartu Kredit', 'COA'),
(3, '003', 'Pengelolaan Restoran & Hiburan ', 'CPL'),
(4, '004', 'Pengelolaan Fashion & Perhiasan', 'CPL'),
(5, '005', 'Pengelolaan Kinerja Bisnis Keuangan', 'PPG'),
(6, '006', 'MIS Kartu & Datawarehouse', 'PPG'),
(7, '007', 'Pengelolaan Pembelian', 'STL'),
(8, '008', 'Perwakilan Modal Manusia', 'STL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `reset` int(1) NOT NULL,
  `reset_code` varchar(6) NOT NULL,
  `hit` int(1) NOT NULL,
  `kelompok` varchar(20) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `name`, `level`, `status`, `reset`, `reset_code`, `hit`, `kelompok`, `unit`, `email`) VALUES
(135, 'admin', '518b860eb3b453c51f2494ffab283860', 'admin', 2, 0, 0, '444444', 0, '', '', ''),
(137, 'popo', 'popo', 'popo', 2, 0, 0, '0', 0, '', '', ''),
(138, 'pipi', 'b2e2c4d7bdf7d7499d373a27f08c9c0a', 'pipi', 1, 0, 0, '0', 0, '', '', ''),
(139, 'joko', '2dac5176cbeda9f2b5dacc702c879fc8', 'joko saja', 1, 0, 0, '0', 0, '', '', ''),
(140, 'papa', 'fb27fe7cfadb4e57d7109ad9a5f52d2a', 'papa sayang', 1, 0, 1, '0', 2, '', '', ''),
(141, 'papas', '5c6a5e69c1501af9c4c40e4ba6e78930', 'papas', 2, 0, 1, '0', 1, '', '', ''),
(142, 'jokos', 'f5c0bb95b47ae91a69461dadec7ff0a8', 'jokos', 2, 0, 1, '0', 0, '', '', ''),
(143, 'TIUR', '85d636cc8c7a662c29c5438289413f44', 'tiur', 1, 0, 0, '0', 0, '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
