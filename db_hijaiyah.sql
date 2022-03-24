-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 02:03 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hijaiyah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `no_hp` varchar(24) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `alamat`, `no_hp`, `user_name`, `password`, `status`) VALUES
(1, 'ADMINSITRATOR', 'Depok', '081284285867', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(5) NOT NULL,
  `email` varchar(55) NOT NULL,
  `score` varchar(4) NOT NULL,
  `level` varchar(45) NOT NULL,
  `tgl_mengerjakan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id` int(5) NOT NULL,
  `soal` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `jwaban` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id`, `soal`, `a`, `b`, `c`, `d`, `jwaban`) VALUES
(1, 'Huruf hijaiyah berjumlah ....', '10', '20', '29', 'DELIK ADUAN', 3),
(2, 'Huruf hijaiyah urutan ke-13 adalah ....', 'Sad     \r\n', 'Syin    ', 'Mim', 'LIMIT', 1),
(3, 'Huruf da adalah urutan yang ke- ....', '6', '8', '10', 'KOMPLEKS', 2),
(4, 'Huruf nun adalah urutan yang ke- ....', '24', '25', '26', 'MAJU DENGAN BELAJAR SENDIRI', 2),
(5, 'Huruf jim jika diberi harakat dhammah dibaca ', 'Ja     \r\n', 'Ji', 'Ju', 'PEKERJAAN', 3),
(13, 'Tanda harakat yang letaknya di bawah huruf adalah ....', 'Kasrah', 'Dhammah', 'Fathah', 'BURUNG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
