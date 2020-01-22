-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 22 Jan 2020 pada 01.16
-- Versi server: 5.7.26
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elektre_bobby`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` int(10) NOT NULL AUTO_INCREMENT,
  `id_merk` int(10) NOT NULL,
  `jns_produk` enum('laptop','smartphone') NOT NULL,
  `seri_produk` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_laptop`
--

DROP TABLE IF EXISTS `kriteria_laptop`;
CREATE TABLE IF NOT EXISTS `kriteria_laptop` (
  `id_k_laptop` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_k_laptop`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_laptop`
--

INSERT INTO `kriteria_laptop` (`id_k_laptop`, `nama_kriteria`, `bobot`) VALUES
(1, 'CPU', NULL),
(2, 'RAM', NULL),
(3, 'Kapasitas Harddisk', NULL),
(4, 'Kartu Grafis', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_smartphone`
--

DROP TABLE IF EXISTS `kriteria_smartphone`;
CREATE TABLE IF NOT EXISTS `kriteria_smartphone` (
  `id_k_smartphone` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_k_smartphone`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_smartphone`
--

INSERT INTO `kriteria_smartphone` (`id_k_smartphone`, `nama_kriteria`, `bobot`) VALUES
(1, 'SOC', NULL),
(2, 'Kapasitas RAM', NULL),
(3, 'Harga', NULL),
(4, 'Baterai', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

DROP TABLE IF EXISTS `merk`;
CREATE TABLE IF NOT EXISTS `merk` (
  `id_merk` int(10) NOT NULL AUTO_INCREMENT,
  `nama_merk` varchar(255) NOT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id_merk`, `nama_merk`) VALUES
(5, 'Samsung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria_laptop`
--

DROP TABLE IF EXISTS `nilai_kriteria_laptop`;
CREATE TABLE IF NOT EXISTS `nilai_kriteria_laptop` (
  `id_nilai` int(10) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(10) NOT NULL,
  `id_alternatif` int(10) NOT NULL,
  `nilai` int(10) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria_smartphone`
--

DROP TABLE IF EXISTS `nilai_kriteria_smartphone`;
CREATE TABLE IF NOT EXISTS `nilai_kriteria_smartphone` (
  `id_nilai` int(10) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(10) NOT NULL,
  `id_alternatif` int(10) NOT NULL,
  `nilai` int(10) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
