-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2022 pada 13.14
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spforwardcf3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_diagnosa`
--

CREATE TABLE `tb_diagnosa` (
  `id` int(10) NOT NULL,
  `kode_diagnosa` varchar(16) NOT NULL,
  `nama_diagnosa` varchar(255) DEFAULT NULL,
  `solusi` text NOT NULL,
  `penyebab` text NOT NULL,
  `gambar` text NOT NULL
  `merk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_diagnosa`
--

INSERT INTO `tb_diagnosa` (`id`, `kode_diagnosa`, `nama_diagnosa`, `solusi`, `penyebab`, `gambar`, `merk`) VALUES
(1, 'P001', 'Hama Kutu Daun', '', '', '',''),
(2, 'P002', '', '', '', '',''),

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id` int(11) NOT NULL,
  `kode_gejala` varchar(20) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_gejala`
--

INSERT INTO `tb_gejala` (`id`, `kode_gejala`, `nama_gejala`, `keterangan`, `gambar`) VALUES
(3, 'G01', 'daun layu', '', 'test.jpg'),
(12, 'G03', 'test', '', 'Lighthouse.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id` int(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `hasil_konsultasi` varchar(30) NOT NULL,
  `kepercayaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hasil`
--

INSERT INTO `tb_hasil` (`id`, `nama`, `email`, `jk`, `alamat`, `tgl`, `hasil_konsultasi`, `kepercayaan`) VALUES
(40, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(41, '', '', '', '', '0000-00-00', '', 'Positif'),
(42, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(43, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(44, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(45, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(46, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(47, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(48, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(49, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(50, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(51, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(52, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(53, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(54, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(55, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(56, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(57, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(58, '', '', '', '', '0000-00-00', 'semut', 'Positif'),
(59, '', '', '', '', '0000-00-00', 'semut', 'Positif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konsultasi`
--

CREATE TABLE `tb_konsultasi` (
  `id` int(11) NOT NULL,
  `kode_gejala` varchar(10) NOT NULL,
  `jawaban` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_konsultasi`
--

INSERT INTO `tb_konsultasi` (`id`, `kode_gejala`, `jawaban`) VALUES
(14, 'G01', 'Ya'),
(15, 'G03', 'Ya'),
(16, '', 'Ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_relasi`
--

CREATE TABLE `tb_relasi` (
  `ID` int(11) NOT NULL,
  `kode_diagnosa` varchar(10) NOT NULL,
  `kode_gejala` varchar(10) NOT NULL,
  `mb` varchar(10) NOT NULL,
  `md` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_relasi`
--

INSERT INTO `tb_relasi` (`ID`, `kode_diagnosa`, `kode_gejala`, `mb`, `md`) VALUES
(9, 'P001', 'G01', 'tes', 'tes'),
(11, 'P003', 'G03', 'tes', 'tes');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_diagnosa`
--
ALTER TABLE `tb_diagnosa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_relasi`
--
ALTER TABLE `tb_relasi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_diagnosa`
--
ALTER TABLE `tb_diagnosa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_relasi`
--
ALTER TABLE `tb_relasi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
