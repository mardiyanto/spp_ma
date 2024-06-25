-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 Jul 2023 pada 15.40
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp_ma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebas`
--

CREATE TABLE `bebas` (
  `bebas_id` int(254) NOT NULL,
  `student_student_id` int(254) DEFAULT NULL,
  `payment_payment_id` int(254) DEFAULT NULL,
  `bebas_bill` decimal(10,0) DEFAULT NULL,
  `bebas_total_pay` decimal(10,0) DEFAULT '0',
  `bebas_desc` text,
  `bebas_input_date` timestamp NULL DEFAULT NULL,
  `bebas_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebas_pay`
--

CREATE TABLE `bebas_pay` (
  `bebas_pay_id` int(254) NOT NULL,
  `bebas_bebas_id` int(254) DEFAULT NULL,
  `bebas_pay_number` varchar(100) DEFAULT NULL,
  `bebas_pay_bill` decimal(10,0) DEFAULT NULL,
  `bebas_pay_desc` varchar(100) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `bebas_pay_input_date` date DEFAULT NULL,
  `bebas_pay_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `bulan_id` int(254) NOT NULL,
  `student_student_id` int(254) DEFAULT NULL,
  `payment_payment_id` int(254) DEFAULT NULL,
  `month_month_id` int(254) DEFAULT NULL,
  `bulan_bill` decimal(10,0) DEFAULT NULL,
  `bulan_bill_total` decimal(10,0) NOT NULL,
  `bulan_status` tinyint(1) DEFAULT '0',
  `bulan_pay_desc` text,
  `bulan_number_pay` varchar(100) DEFAULT NULL,
  `bulan_date_pay` date DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `bulan_input_date` timestamp NULL DEFAULT NULL,
  `bulan_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan_pay`
--

CREATE TABLE `bulan_pay` (
  `bulan_pay_id` int(254) NOT NULL,
  `bulan_bulan_id` int(254) DEFAULT NULL,
  `bulan_pay_number` varchar(100) DEFAULT NULL,
  `bulan_pay_bill` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `bulan_pay_input_date` date DEFAULT NULL,
  `bulan_pay_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `class_id` int(254) NOT NULL,
  `class_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(1, 'VII'),
(2, 'VIII'),
(3, 'IX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `debit`
--

CREATE TABLE `debit` (
  `debit_id` int(254) NOT NULL,
  `debit_date` date DEFAULT NULL,
  `debit_desc` varchar(100) DEFAULT NULL,
  `debit_value` decimal(10,0) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `debit_input_date` timestamp NULL DEFAULT NULL,
  `debit_last_update` timestamp NULL DEFAULT NULL,
  `debit_jenis_jenis_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `debit_jenis`
--

CREATE TABLE `debit_jenis` (
  `debit_jenis_id` int(254) NOT NULL,
  `debit_jenis_date` date DEFAULT NULL,
  `debit_jenis_desc` varchar(100) DEFAULT NULL,
  `debit_jenis_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `gaji_id` int(254) NOT NULL,
  `gaji_date` date DEFAULT NULL,
  `gaji_desc` varchar(100) DEFAULT NULL,
  `gaji_value` decimal(10,0) DEFAULT NULL,
  `gaji_bill` varchar(100) NOT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `gaji_jenis` varchar(10) NOT NULL,
  `gaji_input_date` timestamp NULL DEFAULT NULL,
  `gaji_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`gaji_id`, `gaji_date`, `gaji_desc`, `gaji_value`, `gaji_bill`, `user_user_id`, `gaji_jenis`, `gaji_input_date`, `gaji_last_update`) VALUES
(1, '2023-07-04', 'GAJI NGAJAR', '35000', '', 1, 'umum', '2023-07-04 13:12:02', '2023-07-04 13:12:25'),
(2, '2023-07-04', 'AL', '40000', '3', 1, 'khusus', '2023-07-04 13:13:04', '2023-07-04 13:13:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji_pay`
--

CREATE TABLE `gaji_pay` (
  `gaji_pay_id` int(254) NOT NULL,
  `gaji_gaji_id` int(254) NOT NULL,
  `gaji_pay_date` date DEFAULT NULL,
  `gaji_pay_desc` varchar(100) DEFAULT NULL,
  `gaji_pay_value` decimal(10,0) DEFAULT NULL,
  `guru_guru_id` int(254) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `gaji_pay_input_date` timestamp NULL DEFAULT NULL,
  `gaji_pay_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `guru_id` int(250) NOT NULL,
  `guru_nik` varchar(100) NOT NULL,
  `guru_nuptk` varchar(100) NOT NULL,
  `guru_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`guru_id`, `guru_nik`, `guru_nuptk`, `guru_nama`) VALUES
(1, '-', '-', 'Subowo'),
(2, '-', '-', 'Dwi Indah Lestari'),
(3, '-', '-', 'Wahyudi'),
(4, '-', '-', 'Anisa Usholihah'),
(5, '-', '-', 'Ari Setiawan'),
(6, '-', '-', 'Rakhmad Perkasa R.'),
(7, '-', '-', 'Nur Baiti'),
(8, '-', '-', 'Itoh Mualaviah'),
(9, '-', '-', 'Hanggara Setiawan'),
(10, '-', '-', 'Ahsan Fauzi'),
(11, '-', '-', 'Kurniawati'),
(12, '-', '-', 'Adnasih'),
(13, '-', '-', 'Wanudya Prabandini'),
(14, '-', '-', 'Rizqi Fatmalasari'),
(15, '-', '-', 'Bagus Asmoro'),
(16, '-', '-', 'Viki Alim Rabani'),
(17, '-', '-', 'Desta Kurnia Parka '),
(18, '-', '-', 'Fatah'),
(19, '-', '-', 'Ngato\'ur Rohman'),
(20, '-', '-', 'Nurlailasari'),
(21, '-', '-', 'Suroso'),
(22, '-', '-', 'Nurhayati'),
(23, '-', '-', 'Rahmawati'),
(24, '-', '-', 'Dyan Kurmalasari'),
(25, '-', '-', 'Vira Oktafiani'),
(26, '-', '-', 'Yuni Kartika'),
(27, '-', '-', 'Evi Nurohmah'),
(28, '-', '-', 'Egi Bayu Kosasih'),
(29, '-', '-', 'Farid Rahmadani'),
(30, '-', '-', 'Lita Apriyani'),
(31, '-', '-', 'Desi Yulitasari'),
(32, '-', '-', 'Desy Ambarwati'),
(33, '-', '-', 'Anhari Kustiwindoko'),
(34, '-', '-', 'Muhammad Fauzan'),
(35, '-', '-', 'Umi Zakiyah'),
(36, '-', '-', 'Feby Ika Putri'),
(37, '-', '-', 'Lisa Aprillia'),
(38, '-', '-', 'Irham Yazid A'),
(39, '-', '-', 'Ahmad Mu\'alim'),
(40, '-', '-', 'Septi Wulan Sari'),
(41, '-', '-', 'Nilam Basce Leusy'),
(42, '-', '-', 'Titis Avliani S.'),
(43, '-', '-', 'Johan Iskandar'),
(44, '-', '-', 'Saludin'),
(45, '-', '-', 'Puspayanti'),
(46, '-', '-', 'Intan Tri Sayekti'),
(47, '-', '-', 'Kukuh Famuzi'),
(48, '-', '-', 'Eka Riskiana'),
(49, '-', '-', 'Aan Farianto'),
(50, '-', '-', 'Dapur 1'),
(51, '-', '-', 'Dapur 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `holiday`
--

CREATE TABLE `holiday` (
  `id` int(254) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `hutang_id` int(254) NOT NULL,
  `hutang_date` date DEFAULT NULL,
  `hutang_desc` varchar(100) DEFAULT NULL,
  `hutang_value` decimal(10,0) DEFAULT NULL,
  `hutang_bill` varchar(100) NOT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `hutang_input_date` timestamp NULL DEFAULT NULL,
  `hutang_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang_pay`
--

CREATE TABLE `hutang_pay` (
  `hutang_pay_id` int(254) NOT NULL,
  `hutang_hutang_id` int(254) NOT NULL,
  `hutang_pay_date` date DEFAULT NULL,
  `hutang_pay_desc` varchar(100) DEFAULT NULL,
  `hutang_pay_value` decimal(10,0) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `hutang_pay_input_date` timestamp NULL DEFAULT NULL,
  `hutang_pay_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `information`
--

CREATE TABLE `information` (
  `information_id` int(254) NOT NULL,
  `information_title` varchar(100) DEFAULT NULL,
  `information_desc` text,
  `information_img` varchar(255) DEFAULT NULL,
  `information_publish` tinyint(1) DEFAULT '0',
  `user_user_id` int(254) DEFAULT NULL,
  `information_input_date` timestamp NULL DEFAULT NULL,
  `information_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit`
--

CREATE TABLE `kredit` (
  `kredit_id` int(254) NOT NULL,
  `kredit_jenis_jenis_id` int(100) NOT NULL,
  `kredit_date` date DEFAULT NULL,
  `kredit_desc` varchar(100) DEFAULT NULL,
  `kredit_value` decimal(10,0) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `kredit_input_date` timestamp NULL DEFAULT NULL,
  `kredit_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit_jenis`
--

CREATE TABLE `kredit_jenis` (
  `kredit_jenis_id` int(254) NOT NULL,
  `kredit_jenis_date` date DEFAULT NULL,
  `kredit_jenis_desc` varchar(100) DEFAULT NULL,
  `kredit_jenis_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `letter`
--

CREATE TABLE `letter` (
  `letter_id` int(254) NOT NULL,
  `letter_number` varchar(100) DEFAULT NULL,
  `letter_month` int(254) DEFAULT NULL,
  `letter_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `log_id` int(254) NOT NULL,
  `log_date` timestamp NULL DEFAULT NULL,
  `log_action` varchar(45) DEFAULT NULL,
  `log_module` varchar(45) DEFAULT NULL,
  `log_info` text,
  `user_id` int(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`log_id`, `log_date`, `log_action`, `log_module`, `log_info`, `user_id`) VALUES
(1, '2023-07-04 12:18:09', 'Tambah', 'Tahun Ajaran', 'ID:null;Title:2023/2024', NULL),
(2, '2023-07-04 12:20:29', 'Tambah', 'Jenis Pembayaran', 'ID:null;Title:', NULL),
(3, '2023-07-04 12:57:33', 'Tambah', 'Tambah Gaji', 'ID:;Title:', 1),
(4, '2023-07-04 13:00:18', 'Tambah', 'Bayar Gaji', 'ID:1;Title:', 1),
(5, '2023-07-04 13:08:53', 'Hapus', 'gaji Guru', 'ID:1;Title:AL', 1),
(6, '2023-07-04 13:09:19', 'Tambah', 'Tambah Gaji', 'ID:;Title:', 1),
(7, '2023-07-04 13:12:02', 'Tambah', 'Tambah Gaji', 'ID:;Title:', 1),
(8, '2023-07-04 13:13:04', 'Tambah', 'Tambah Gaji', 'ID:;Title:', 1),
(9, '2023-07-04 13:13:21', 'Tambah', 'Bayar Gaji', 'ID:2;Title:', 1),
(10, '2023-07-04 13:14:30', 'Hapus', 'Bayar gaji Umum', 'ID:1;Title:', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_trx`
--

CREATE TABLE `log_trx` (
  `log_trx_id` int(254) NOT NULL,
  `student_student_id` int(254) DEFAULT NULL,
  `bulan_bulan_id` int(254) DEFAULT NULL,
  `bebas_pay_bebas_pay_id` int(254) DEFAULT NULL,
  `log_trx_input_date` timestamp NULL DEFAULT NULL,
  `log_trx_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `majors`
--

CREATE TABLE `majors` (
  `majors_id` int(254) NOT NULL,
  `majors_name` varchar(100) DEFAULT NULL,
  `majors_short_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `majors`
--

INSERT INTO `majors` (`majors_id`, `majors_name`, `majors_short_name`) VALUES
(1, 'SMP', 'SMP'),
(2, 'MI', 'MI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `month`
--

CREATE TABLE `month` (
  `month_id` int(254) NOT NULL,
  `month_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `month`
--

INSERT INTO `month` (`month_id`, `month_name`) VALUES
(1, 'JULI'),
(2, 'AGUSTUS'),
(3, 'SEPTEMBER'),
(4, 'OKTOBER'),
(5, 'NOVEMBER'),
(6, 'DESEMBER'),
(7, 'JANUARI'),
(8, 'FEBRUARI'),
(9, 'MARET'),
(10, 'APRIL'),
(11, 'MEI'),
(12, 'JUNI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(254) NOT NULL,
  `payment_type` enum('BEBAS','BULAN') DEFAULT NULL,
  `period_period_id` int(254) DEFAULT NULL,
  `pos_pos_id` int(254) DEFAULT NULL,
  `payment_input_date` timestamp NULL DEFAULT NULL,
  `payment_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_type`, `period_period_id`, `pos_pos_id`, `payment_input_date`, `payment_last_update`) VALUES
(1, 'BULAN', 1, 1, '2023-07-04 12:20:29', '2023-07-04 12:20:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `period`
--

CREATE TABLE `period` (
  `period_id` int(254) NOT NULL,
  `period_start` year(4) DEFAULT NULL,
  `period_end` year(4) DEFAULT NULL,
  `period_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `period`
--

INSERT INTO `period` (`period_id`, `period_start`, `period_end`, `period_status`) VALUES
(1, 2023, 2024, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos`
--

CREATE TABLE `pos` (
  `pos_id` int(254) NOT NULL,
  `pos_name` varchar(100) DEFAULT NULL,
  `pos_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos`
--

INSERT INTO `pos` (`pos_id`, `pos_name`, `pos_description`) VALUES
(1, 'SPP', 'SPP WAJIB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_pay`
--

CREATE TABLE `potongan_pay` (
  `potongan_pay_id` int(254) NOT NULL,
  `potongan_pay_date` date DEFAULT NULL,
  `potongan_pay_desc` varchar(100) DEFAULT NULL,
  `potongan_pay_value` decimal(10,0) DEFAULT NULL,
  `guru_guru_id` int(254) DEFAULT NULL,
  `user_user_id` int(254) DEFAULT NULL,
  `potongan_pay_input_date` timestamp NULL DEFAULT NULL,
  `potongan_pay_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(254) NOT NULL,
  `setting_name` varchar(255) DEFAULT NULL,
  `setting_value` text,
  `setting_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`setting_id`, `setting_name`, `setting_value`, `setting_last_update`) VALUES
(1, 'setting_school', 'IBN LAMPUNG', '2020-06-23 05:07:07'),
(2, 'setting_address', 'JALAN WISMARINI NO 09 PRINGSEWU', '2020-06-23 05:07:07'),
(3, 'setting_phone', '+62 852 5806 2655', '2020-06-23 05:07:07'),
(4, 'setting_district', 'PRINGSEWU', '2020-06-23 05:07:07'),
(5, 'setting_city', 'LAMPUNG', '2020-06-23 05:07:07'),
(6, 'setting_logo', 'IBN_LAMPUNG1.png', '2020-06-23 05:07:07'),
(7, 'setting_level', 'senior', '2020-06-23 05:07:07'),
(8, 'setting_user_sms', '-', '2020-06-23 05:07:07'),
(9, 'setting_pass_sms', 'password', '2020-06-23 05:07:07'),
(10, 'setting_sms', 'N', '2020-06-23 05:07:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(254) NOT NULL,
  `student_nis` varchar(45) DEFAULT NULL,
  `student_nisn` varchar(45) DEFAULT NULL,
  `student_password` varchar(100) DEFAULT NULL,
  `student_full_name` varchar(255) DEFAULT NULL,
  `student_gender` enum('L','P') DEFAULT NULL,
  `student_born_place` varchar(45) DEFAULT NULL,
  `student_born_date` date DEFAULT NULL,
  `student_img` varchar(255) DEFAULT NULL,
  `student_phone` varchar(45) DEFAULT NULL,
  `student_hobby` varchar(100) DEFAULT NULL,
  `student_address` text,
  `student_name_of_mother` varchar(255) DEFAULT NULL,
  `student_name_of_father` varchar(255) DEFAULT NULL,
  `student_parent_phone` varchar(45) DEFAULT NULL,
  `class_class_id` int(254) DEFAULT NULL,
  `majors_majors_id` int(254) DEFAULT NULL,
  `student_status` tinyint(1) DEFAULT '1',
  `student_input_date` timestamp NULL DEFAULT NULL,
  `student_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `student_nis`, `student_nisn`, `student_password`, `student_full_name`, `student_gender`, `student_born_place`, `student_born_date`, `student_img`, `student_phone`, `student_hobby`, `student_address`, `student_name_of_mother`, `student_name_of_father`, `student_parent_phone`, `class_class_id`, `majors_majors_id`, `student_status`, `student_input_date`, `student_last_update`) VALUES
(1, '0101167797', '0101167797', '78038347d67500fd6a62bac10dcf31904050cbe0', 'Abiyu Rafiq Tianto', 'L', 'Bekasi', '2010-01-22', NULL, '-', '-', 'Sendang Mulyo', 'Sarjito', 'Sumaryati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(2, '3104364891', '3104364891', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Ahmad Azril Irham', 'L', 'Sendang Mulyo', '2010-01-07', NULL, '-', '-', 'Sendang Mulyo', 'Mahjudi', 'Eka Susanti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(3, '0098140460', '0098140460', '25646d6f594b3b9a03c162f4de463925c8088409', 'Akhtar As\'shabur Al Sudais', 'L', 'Bandar Lampung', '2009-09-09', NULL, '-', '-', 'Beringin Raya, Kemiling, Bandar Lampung', 'Elwan', 'Maysaroh Martha', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(4, '0091167269', '0091167269', '25646d6f594b3b9a03c162f4de463925c8088409', 'Alfath Suhada', 'L', 'Pringsewu', '2009-08-21', NULL, '-', '-', 'Surabaya, Padang Ratu', 'Riyanto', 'Siti Romlah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(5, '0096974957', '0096974957', '25646d6f594b3b9a03c162f4de463925c8088409', 'Alfath Tabiin', 'L', 'Pringsewu', '2009-08-21', NULL, '-', '-', 'Surabaya, Padang Ratu', 'Riyanto', 'Siti Romlah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(6, '0109695696', '0109695696', '25646d6f594b3b9a03c162f4de463925c8088409', 'Apri Hariyanto', 'L', 'Sendang Retno', '2010-04-10', NULL, '-', '-', 'Sendang Retno', 'Lutfianto', 'Dartati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(7, '0109246668', '0109246668', '25646d6f594b3b9a03c162f4de463925c8088409', 'Ayrel Anugrah Ar-Rasyid', 'L', 'Bandar Lampung', '2010-06-15', NULL, '-', '-', 'Kemiling, Bandar Lampung', 'Novi Hendri', 'Herlina', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(8, '0101880179', '0101880179', '25646d6f594b3b9a03c162f4de463925c8088409', 'Bagus Heru Mufti', 'L', 'Sendang Mukti', '2010-05-21', NULL, '-', '-', 'Sendang Mukti, Sendang Agung', 'Mustohani', 'Eka Diana Purnamasari', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(9, '0085009902', '0085009902', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Dhiyaul Fikri Arrosyidin', 'L', 'Kalirejo', '2009-02-06', NULL, '-', '-', 'Sukosari, Kalirejo', 'Wahyudin', 'Anggar Susilowati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(10, '0109758808', '0109758808', '25646d6f594b3b9a03c162f4de463925c8088409', 'Delphine Muta\'ali', 'L', 'Sendang Rejo', '2010-08-03', NULL, '-', '-', 'Sendang Rejo, Sendang Agung', 'Marjiyanto', 'Fitri Nuryani', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(11, '0104878927', '0104878927', 'a26c7fbe658fe063a0633251a24516dacc825455', 'Fadilah Muzaki', 'L', 'Mengupeh', '2010-03-15', NULL, '-', '-', 'Tengah Ilir, Tebo, Jambi', 'Teguh Rahayu', 'Thohiroh', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(12, '0103820017', '0103820017', 'be9708be12cacde6b2acf73527668cb9aa448c7f', 'Fikri Khoirul Azmi', 'L', 'Sendang Rejo', '2010-02-24', NULL, '-', '-', 'Sendang Rejo, Sendang Agung', 'Mohamad Jaelani', 'Amanatun Khasanah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(13, '0107010817', '0107010817', '25646d6f594b3b9a03c162f4de463925c8088409', 'Forlan Dima Hafizzhadin', 'L', 'Saribumi', '2010-08-03', NULL, '-', '-', 'Saribumi, Wates Selatan, Gading Rejo', 'Edi Suprayitno', 'Mala Yutiana', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(14, '0103622537', '0103622537', '25646d6f594b3b9a03c162f4de463925c8088409', 'Hamzah Farchani', 'L', 'Kalidadi', '2010-09-10', NULL, '-', '-', 'Sribasuki', 'Subowo', 'Dwi Indah Lestari', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(15, '0094445671', '0094445671', '6c99b8410f78a34a546b960a17d960f01a892b6d', 'Husni Mubarok', 'L', 'Kalidadi', '2010-02-22', NULL, '-', '-', 'Kalidadi', 'Tohirin', 'Suwanti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(16, '0107755086', '0107755086', '25646d6f594b3b9a03c162f4de463925c8088409', 'M. Ikhwan Maulana Kaizan', 'L', 'Pergulaan', '2010-04-25', NULL, '-', '-', 'Tunas Asri, Tulang Bawang Tengah, TBB', 'Tasno', 'Retna Fatma Sari', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(17, '0108539302', '0108539302', '25646d6f594b3b9a03c162f4de463925c8088409', 'Muhamad Zaidan Rifai', 'L', 'Kalirejo', '2010-04-26', NULL, '-', '-', 'Kalirejo', 'A Fauzi', 'Suningsih', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(18, '0095031014', '0095031014', '25646d6f594b3b9a03c162f4de463925c8088409', 'Muhammad Risqi Aditia', 'L', 'Teluk Betung', '2009-09-27', NULL, '-', '-', 'Sendang Rejo, Sendang Agung', 'Muhammad Nasruddin', 'Supriyanti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(19, '0092449007', '0092449007', '25646d6f594b3b9a03c162f4de463925c8088409', 'Muhammad Roihan', 'L', 'Waringinsari', '2009-06-21', NULL, '-', '-', 'Karawang', 'Ali Murtadho', 'Rochyanti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(20, '0107213118', '0107213118', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Muhammad Widyan Alfatih', 'L', 'Kalirejo', '2010-04-03', NULL, '-', '-', 'Balai Rejo', 'Budi Widodo', 'Novita Indrayani', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(21, '0107033849', '0107033849', 'be9708be12cacde6b2acf73527668cb9aa448c7f', 'Muhammad Yusuf Priatno', 'L', 'Sendang Agung', '2010-02-24', NULL, '-', '-', 'Sendang Agung', 'Pantio Priyanto', 'Robiah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(22, '0102031313', '0102031313', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Putra Nur Ahmad', 'L', 'Saribumi', '2010-02-05', NULL, '-', '-', 'Saribumi, Wates Selatan, Gading Rejo', 'Amat Buhori', 'Nuryani Yuni Lestari', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(23, '0102432805', '0102432805', 'bfe80a55d299fce59ff8e9a0e704515676903f51', 'Rafa Praditya Harun', 'L', 'Kalirejo', '2010-01-25', NULL, '-', '-', 'Sri Basuki', 'Agus Nuryanto', 'Arniyanti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(24, '0093966940', '0093966940', '25646d6f594b3b9a03c162f4de463925c8088409', 'Ziddan Albarra', 'L', 'Pringsewu', '2009-09-18', NULL, '-', '-', 'Sendang Retno', 'Fisi Yamil Huda', 'Rohmah Wati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(25, '0108090941', '0108090941', '25646d6f594b3b9a03c162f4de463925c8088409', 'Kahlyl Aldebaran Syaian', 'L', 'Bandar Lampung', '2010-08-14', NULL, '-', '-', 'Kalirejo', 'Elmi Syaian HS', 'Rika Novaria Agustina', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(26, '0106539473', '0106539473', '25646d6f594b3b9a03c162f4de463925c8088409', 'Adinda Salsabilla Putri', 'L', 'Sukoharjo I', '2010-09-26', NULL, '-', '-', 'Way Mengaku, Balik Bukit, Lam-Bar', 'Achmad', 'Suwarni', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(27, '0106655958', '0106655958', '25646d6f594b3b9a03c162f4de463925c8088409', 'Ahsana Syakira Effendi', 'L', 'Kalirejo', '2010-08-05', NULL, '-', '-', 'Kalirejo', 'Nurzaman', 'Puspawati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(28, '0099993978', '0099993978', '25646d6f594b3b9a03c162f4de463925c8088409', 'Aisyah Ayunda', 'L', 'Harapan Rejo', '2009-09-27', NULL, '-', '-', 'Harapan Rejo, Seputih Agung, Lampung Tengah', 'Ebit Sutoto', 'Sinta Dewi Megawati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(29, '0102013456', '0102013456', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Aisyah Miftahul Fitri', 'L', 'Banyumas', '2010-05-09', NULL, '-', '-', 'Nusawungu, Banyumas, Pringsewu', 'M. Miftakhudin', 'Yuni Fitriasih', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(30, '0092522429', '0092522429', '1f33f8b3ac0831aaee70ccd95f8776c12a3eedd9', 'Aliska Novita Andini', 'L', 'Kalirejo', '2009-11-16', NULL, '-', '-', 'Kalirejo, Kalirejo, Lampung Tengah', 'Fitri Andi', 'Kasiati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(31, '0106149713', '0106149713', '25646d6f594b3b9a03c162f4de463925c8088409', 'Alisya Syafa Qulbina', 'L', 'B. Lampung', '2010-07-16', NULL, '-', '-', 'Kaliawi, Tanjung Karang Pusat, Bandar Lampung', 'Adis Kurnia', 'Safitri', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(32, '0109635691', '0109635691', '25646d6f594b3b9a03c162f4de463925c8088409', 'Annisa Adelia Hamzah', 'L', 'Bandar Lampung', '2010-07-10', NULL, '-', '-', 'Beringin Raya, Kemiling, Bandar Lampung', 'Yuni Hamzah, ST', 'Usnah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(33, '0099472409', '0099472409', '25646d6f594b3b9a03c162f4de463925c8088409', 'Arum Diena Kamila', 'L', 'Lampung Tengah', '2009-08-29', NULL, '-', '-', 'Sridadi', 'Ichwanto', 'Nur Khamadah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(34, '0108259071', '0108259071', '25646d6f594b3b9a03c162f4de463925c8088409', 'Atya Kamila Salsabila', 'L', 'Kali Bening', '2010-09-05', NULL, '-', '-', 'Kalibening Raya, Abung Selatan, Lampung Utara', 'Ahmad Subandi', 'Mutmainah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(35, '0097841748', '0097841748', '25646d6f594b3b9a03c162f4de463925c8088409', 'Dhiya Putih Prasetia', 'L', 'Metro', '2009-09-27', NULL, '-', '-', 'Sumbersari, Metro Selatan', 'Mixa Prasetia', 'Novi Tunjung Sari', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(36, '0092969177', '0092969177', '978dda25bff3a3c112380cc4fa9acae6c0eff538', 'Esy Tita Hanum', 'L', 'Sribasuki', '2009-02-20', NULL, '-', '-', 'Sribasuki', 'Suwardi', 'Painem', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(37, '0102480211', '0102480211', '496018fc27ce2abb8b6c181bca44bfa130f63bca', 'Firqatun Najiyah', 'L', 'Surabaya', '2009-10-29', NULL, '-', '-', 'Surabaya, Padang Ratu', 'Musiran', 'Khusnul Khotimah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(38, '0106695309', '0106695309', '25646d6f594b3b9a03c162f4de463925c8088409', 'Fitri Anisa Fauzi', 'L', 'Sukoyoso', '2010-07-25', NULL, '-', '-', 'Sukoyoso, Sukoharjo', 'Ahmad Fauzi', 'Herlina', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(39, '0108718369', '0108718369', '25646d6f594b3b9a03c162f4de463925c8088409', 'Intan Khoirunnisa', 'L', 'Sribasuki', '2010-07-22', NULL, '-', '-', 'Sribasuki', 'Muhammad Khoirul Anwar', 'Siti Fatimah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(40, '0097262957', '0097262957', 'd9bdc75a5ae0dc58237a92d6acf5827f6392130e', 'Nadhira Asshafa', 'L', 'Kalirejo', '2009-10-10', NULL, '-', '-', 'Kalidadi, Kalirejo', 'Herman Chandra', 'Kamyati', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(41, '0097909341', '0097909341', '23df6f849d7f60d50c9a33715497b473d79e34dc', 'Nadia Sefira', 'L', 'Sribasuki', '2009-02-15', NULL, '-', '-', 'Sribasuki', 'Sabar', 'Sai Munah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(42, '0091214222', '0091214222', '25646d6f594b3b9a03c162f4de463925c8088409', 'Nadila Ramadhani', 'L', 'Pringsewu', '2009-09-02', NULL, '-', '-', 'Sendang Asri', 'Iskandar', 'Linda Ningsih', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(43, '0094595798', '0094595798', '25646d6f594b3b9a03c162f4de463925c8088409', 'Najwa Velove', 'L', 'Watu Agung', '2009-07-10', NULL, '-', '-', 'Sumberrejo, Kemiling, Bandar Lampung', 'Hendri', 'Tri Utami', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(44, '0097657183', '0097657183', 'a5001453f32365c8bd14636b48e5d5c3e3538a6e', 'Nayla Azkia Arafah', 'L', 'Pringsewu', '2009-12-02', NULL, '-', '-', 'Banyumas, Pringsewu', 'Eko Kartono', 'Fitri Isnaini', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(45, '0094433344', '0094433344', '25646d6f594b3b9a03c162f4de463925c8088409', 'Nisfi Laily Rahmi', 'L', 'Poncowarno', '2009-06-29', NULL, '-', '-', 'Sinarrejo, Kalirejo', 'Syaefuddin', 'Martiningsih', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(46, '3096721846', '3096721846', '640752d4c2fed87629187dbc5f99236d90038b6b', 'Okta Adzkahayu', 'L', 'Sendang Mulyo', '2009-10-27', NULL, '-', '-', 'Sendang Mulyo', 'Tri Purnomo', 'Rina Lestari', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(47, '0104260795', '0104260795', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Rahil', 'L', 'Malang', '2010-04-08', NULL, '-', '-', 'Way Mengaku, Balik Bukit, Lam-Bar', 'Muhammad Abdul Halim', 'Reni Yunita', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(48, '3102169986', '3102169986', 'f036ee21d36b476ca1b0833d5d0afb32042cfccf', 'Rahmah Raihanah', 'L', 'Bandung', '2010-02-26', NULL, '-', '-', 'Cikalong Wetan, Bandung Barat, Jawa Barat', 'Yoga Muslihat', 'Rita Afrilianti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(49, '0091433526', '0091433526', '1228ad35313f26a377884fbd232f7675cc00b129', 'Rezka Putri Giani', 'L', 'Kaliwungu', '2009-11-17', NULL, '-', '-', 'Sribasuki', 'Sutadi', 'Siti Septiani', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(50, '0094748940', '0094748940', '4abcb21dd03e82528f43183eeabd1d35560a516d', 'Shafa Naisila Rahma', 'L', 'Sediamaju', '2009-12-20', NULL, '-', '-', 'Sidodadi, Way Lima, Pesawaran', 'Saryono', 'Arbaedah', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(51, '0091402224', '0091402224', '94ed9bcd19c5eb68f77d48ed02fba916db3d12f5', 'Tiara Putri Rizky Yana', 'L', 'Sendang Asih', '2009-12-28', NULL, '-', '-', 'Sendang Asih, Sendang Agung', 'Muhammad Roem', 'Susanti', '-', 1, 1, 1, '2023-07-04 12:00:00', '2023-07-04 12:00:00'),
(52, '0093427365', '0093427365', 'f7e73037a4902c57fc54eb1f4c5f60244475e1ec', 'Afristan Rizki Barokah', 'L', 'Sendang Mulyo', '2009-10-24', NULL, '-', '-', 'Sendang Mulyo', 'Siswanto', 'Tuwarni', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(53, '0086363240', '0086363240', '25646d6f594b3b9a03c162f4de463925c8088409', 'Ahmad Faozan', 'L', 'Pringsewu', '2008-09-28', NULL, '-', '-', 'Sidoluhur', 'Aziz Muslim', 'Lulu Atul Fuadah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(54, '0084606459', '0084606459', '1faf59d1d7a98955a775679269988ce0a769891f', 'Ainun Banyu Sakti', 'L', 'Kalirejo', '2008-10-01', NULL, '-', '-', 'Kaliwungu', 'Susaptono', 'Barlia', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(55, '0086763709', '0086763709', '9555f3bc14c4ab662d6f9eab7bfa6bc512f26e62', 'Danish Musyaffa Albani', 'L', 'Teluk Betung', '2008-12-02', NULL, '-', '-', 'Bandar Lampung', 'Bambang Fitriadi', 'Lina Yunita', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(56, '0091443066', '0091443066', '25646d6f594b3b9a03c162f4de463925c8088409', 'Fakih Arkan', 'L', 'Pringsewu', '2009-07-03', NULL, '-', '-', 'Sendang Asri', 'Supriyadi', 'Rini Setiawati', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(57, '0093720512', '0093720512', '85f3ba60860c4c81cd4a8f2e593d1c147e5709d8', 'Khoerul Jihad Amirulloh', 'L', 'Surabaya', '2009-03-29', NULL, '-', '-', 'Surabaya', 'M. Alfisori', 'Siti Khomsatun', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(58, '0086220932', '0086220932', '6f3260049e2f7537e36d1096215358a10a938575', 'Latif Muhazib', 'L', 'Sukanegara', '2008-10-21', NULL, '-', '-', 'Sukanegara', 'Dal Hari', 'Maskanah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(59, '0099275016', '0099275016', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Lucky Arkan', 'L', 'Gumukmas', '2009-01-09', NULL, '-', '-', 'Sendang Agung', 'Agus Ahmad S.', 'Nurur Rizkiyah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(60, '0099546977', '0099546977', '85f3ba60860c4c81cd4a8f2e593d1c147e5709d8', 'M. Arif Hisbulloh', 'L', 'Kalirejo', '2009-03-29', NULL, '-', '-', 'Surabaya', 'M. Alfisori', 'Siti Khomsatun', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(61, '0086293922', '0086293922', 'd00580f564df226d9307339c6e22ce58877f51a6', 'Muhammad Said Probo Kusumo', 'L', 'Bandar Lampung', '2008-12-29', NULL, '-', '-', 'Bandar Lampung', 'Suyono', 'Rohmah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(62, '0091108064', '0091108064', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Nofal Hafiz', 'L', 'Gumukmas', '2009-01-09', NULL, '-', '-', 'Sendang Agung', 'Agus Ahmad S.', 'Nurur Rizkiyah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(63, '0092300641', '0092300641', '496018fc27ce2abb8b6c181bca44bfa130f63bca', 'Radiyan Khadafi', 'L', 'Pagar Dewa', '2009-10-29', NULL, '-', '-', 'Pagar Dewa, Lam-Bar', 'Rohmadi', 'Nurhayati', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(64, '0085813437', '0085813437', '25646d6f594b3b9a03c162f4de463925c8088409', 'Rido Dwi Cahyo', 'L', 'Sendang Rejo', '2008-06-28', NULL, '-', '-', 'Sendang Rejo', 'Sunardi', 'Yeni Estriana', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(65, '0097790044', '0097790044', '25646d6f594b3b9a03c162f4de463925c8088409', 'Tegar Kurnia', 'L', 'Pringsewu', '2009-07-08', NULL, '-', '-', 'Sribasuki', 'Faridno', 'Mulidah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(66, '0077885347', '0077885347', 'c81221f867a2ce3d5cfe38e55496dc644bfa69f8', 'Fatah Abdul Aziz', 'L', 'Sendang Agung', '2007-10-16', NULL, '-', '-', 'Sendang Agung', 'Pantio Priyanto', 'Robiah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(67, '3088253615', '3088253615', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Nur Iksan', 'L', 'Sribasuki', '2008-05-05', NULL, '-', '-', 'Sribasuki', 'Saludin', 'Samsiyah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(68, '0085117160', '0085117160', '523b52dba72f56dcbfb8def7233569c731e3a177', 'Alhadi Unoffa Ariyanto', 'L', 'Sleman', '2008-11-27', NULL, '-', '-', 'Sukosari', 'Yuni Ariyanto', 'Cahya Megawati, S.E', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(69, '0099729960', '0099729960', '7738c40d8eae23398aeee9b52543566b81efd7df', 'Alif Febriyansyah', 'L', 'Serang', '2009-02-25', NULL, '-', '-', 'Warkuk Ranau Selatan, OKU Selatan', 'Ahmad Arpan', 'Tariah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(70, '0086877631', '0086877631', '25646d6f594b3b9a03c162f4de463925c8088409', 'Assyifa Sintya Balqis', 'L', 'Kalirejo', '2008-07-14', NULL, '-', '-', 'Sri Basuki', 'Sunarso', 'Neneng Hasanah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(71, '0094869297', '0094869297', '25646d6f594b3b9a03c162f4de463925c8088409', 'Afabel Nata', 'L', 'Kalirejo', '2009-06-02', NULL, '-', '-', 'Kalirejo', 'Sugito', 'Suparni', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(72, '0086640913', '0086640913', '25646d6f594b3b9a03c162f4de463925c8088409', 'Ajeng Julia Afrida', 'L', 'Sridadi', '2008-06-12', NULL, '-', '-', 'Sridadi', 'Basir', 'Onah Kartika', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(73, '0092220895', '0092220895', '25646d6f594b3b9a03c162f4de463925c8088409', 'Annisa Azzahra', 'L', 'Bandar Sari', '2009-06-21', NULL, '-', '-', 'Surabaya', 'Imam Hudori', 'Siti Yunairah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(74, '0097523807', '0097523807', '25646d6f594b3b9a03c162f4de463925c8088409', 'Asy\' Syifaa\'', 'L', 'Tulung Rejo', '2009-07-07', NULL, '-', '-', 'Balik Bukit, Lam- Bar', 'Abdullah Mukhlis', 'Kurniawati', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(75, '0091075032', '0091075032', 'e9c4ba5afd9c00933fd0adca802a02f0ffc9ceb3', 'Aulia Lutfiah Dewi', 'L', 'Sri Basuki', '2009-03-30', NULL, '-', '-', 'Sri Basuki', 'M. Sunardi', 'Juminah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(76, '3091698901', '3091698901', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Awlia Intan Asyfa', 'L', 'Way Kanan', '2009-03-04', NULL, '-', '-', 'Sendang Retno', 'Fauzin', 'Zauna', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(77, '0095343227', '0095343227', 'f26321b05d7571a28eb4d5f966ce4f4630e6a2a8', 'Azkia Annaziha', 'L', 'Pekalongan', '2009-03-11', NULL, '-', '-', 'Punggur', 'Saiful Anwar', 'Nurjannatin Aliyah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(78, '0085063375', '0085063375', 'ed3cc962a0636f22fbb279beb90406e7afa762db', 'Bening Bakambuya', 'L', 'Sribasuki', '2008-12-12', NULL, '-', '-', 'Sribasuki', 'Irmansyah', 'Sutini', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(79, '0098574842', '0098574842', '2ee5763da668b66a4a78f1d319943a190b880ae3', 'Bintang Ratu Ayusha', 'L', 'Kalirejo', '2009-01-15', NULL, '-', '-', 'Kalirejo', 'Joni Wibowo', 'Siti Rokhimah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(80, '0097049426', '0097049426', '25646d6f594b3b9a03c162f4de463925c8088409', 'Farah Benazir', 'L', 'Sendang Retno', '2009-08-10', NULL, '-', '-', 'Sendang Retno', 'Ikhwani', 'nasihatul karomah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(81, '0085232823', '0085232823', '25646d6f594b3b9a03c162f4de463925c8088409', 'Fatika Afriana', 'L', 'Sri Basuki', '2008-04-23', NULL, '-', '-', 'Sri Basuki', 'Ade Iskandar', 'Sumiyah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(82, '0096686130', '0096686130', '4d94616e58d0cfc16824daeec1ece6ab8a45ab9b', 'Fiona Fathunisa', 'L', 'Bangunrejo', '2009-02-18', NULL, '-', '-', 'Sidoluhur', 'Husni Tamrin', 'Sulistikomah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(83, '0095912333', '0095912333', '2ee5763da668b66a4a78f1d319943a190b880ae3', 'Firna Nahwa Firdaus', 'L', 'Bangunrejo', '2009-01-15', NULL, '-', '-', 'Sidoluhur', 'Ibnu Zaid Alhak', 'Nafiatul Isnaini', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(84, '0093096406', '0093096406', '317d8a9e24dba1df85809ee72b2a8bcc2115685f', 'Hanifa Rahma Auni', 'L', 'Sidoluhur', '2009-03-17', NULL, '-', '-', 'Sidoluhur', 'H. Amin Fauzi', 'Husnul Khotimah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(85, '3094550905', '3094550905', '25646d6f594b3b9a03c162f4de463925c8088409', 'Ida Ratna Ningsih', 'L', 'Purwosari', '2009-04-28', NULL, '-', '-', 'Purwosari', 'Saean', 'Sri Wahyuningsih', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(86, '0093901819', '0093901819', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Khalisah Pribadi', 'L', 'Bekasi', '2009-01-07', NULL, '-', '-', 'Metro', 'Agus Pribadi', 'Tuti Kurniasih', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(87, '0098170205', '0098170205', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Khumairoh Lutfiana Safitri', 'L', 'Sendang Retno', '2009-01-04', NULL, '-', '-', 'Sendang Retno', 'Iput Sriyono', 'Miftahul Janah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(88, '0098953159', '0098953159', '25646d6f594b3b9a03c162f4de463925c8088409', 'Laila Firosah', 'L', 'Sri Basuki', '2009-05-14', NULL, '-', '-', 'Sri Basuki', 'Winarto', 'Muslimah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(89, '3092579861', '3092579861', 'ade5af4b838ca74c1b8f246414fdf8de14a542a9', 'Lukhen Azmi Atifah', 'L', 'Sumber Bakti', '2009-01-24', NULL, '-', '-', 'Jati Agung, Lam-Sel', 'Teguh Rahayu', 'Tri Nurhayati', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(90, '0086631517', '0086631517', '25646d6f594b3b9a03c162f4de463925c8088409', 'Malika Dhanis Yulianto', 'L', 'Sendang Agung', '2008-05-28', NULL, '-', '-', 'Sendang Agung', 'Yulianto', 'Vivi Afrianti', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(91, '3083937720', '3083937720', '8b0071e3c568560779fa6f7056a75bb5454164d6', 'Naufa Nada Afifah', 'L', 'Pringsewu', '2008-11-08', NULL, '-', '-', 'Sukoharjo 2', 'Mulyono', 'Winarsih', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(92, '0093234261', '0093234261', '25646d6f594b3b9a03c162f4de463925c8088409', 'Neneng Syifa Azzahra', 'L', 'Balairejo', '2009-08-04', NULL, '-', '-', 'Balairejo', 'H. Sidik Sukron', 'Sopiah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(93, '0096366774', '0096366774', '23df6f849d7f60d50c9a33715497b473d79e34dc', 'Nur Aisyah', 'L', 'Kabupaten Cirebon', '2009-02-15', NULL, '-', '-', 'Sri Basuki', 'Samingan', 'Mulyati', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(94, '0096745060', '0096745060', '25646d6f594b3b9a03c162f4de463925c8088409', 'Raisya', 'L', 'Jakarta', '2009-06-12', NULL, '-', '-', 'Kp. Duri, Jakarta', 'Sukarno', 'Nur Khasanah', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(95, '0088869345', '0088869345', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Salsabilla', 'L', 'Bumi Raharjo', '2008-05-07', NULL, '-', '-', 'Bumi Raharjo', 'Soderi', 'Musrifin', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(96, '0089743890', '0089743890', '25646d6f594b3b9a03c162f4de463925c8088409', 'Shofiyyah Aini', 'L', 'Metro', '2008-05-27', NULL, '-', '-', 'Metro Selatan', 'Amirudin Azmi', 'Syukriah Chairan', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(97, '0095304711', '0095304711', '81fa9785759934e64cf6fc334536c01b020783c8', 'Syifa Ul Husna', 'L', 'Sendang Retno', '2009-02-17', NULL, '-', '-', 'Sendang Retno', 'Heli Yunarko', 'Suci Rahayu', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(98, '0098059163', '0098059163', '25646d6f594b3b9a03c162f4de463925c8088409', 'Tantrina Irsandi', 'L', 'Batam', '2009-09-19', NULL, '-', '-', 'Kaliwungu', 'Irsandi', 'Sismiyati', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(99, '0087734404', '0087734404', '15be2b4bba260502522bbb09f4028a4bf1f4a765', 'Wardah Syafira', 'L', 'Kalidadi', '2008-11-12', NULL, '-', '-', 'Kalidadi', 'Suroso', 'Tatik Hartini', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(100, '0085319310', '0085319310', '25646d6f594b3b9a03c162f4de463925c8088409', 'Zaskia Ramadhani', 'L', 'Kalirejo', '2008-09-25', NULL, '-', '-', 'Kalirejo', 'Ahmad Fauzi', 'Suningsih', '-', 2, 1, 1, '2023-07-04 12:05:13', '2023-07-04 12:05:13'),
(101, '0076381449', '0076381449', 'bb2172000eb13c098f8d8e597851426e8374ef1c', 'Alif Febriyan', 'L', 'Batang', '2007-02-15', NULL, '-', '-', 'Sendang Asih', 'Surip Bejo', 'Suprihatin', '-', 3, 1, 1, '2023-07-04 12:10:46', '2023-07-04 12:10:46'),
(102, '0083090042', '0083090042', '25646d6f594b3b9a03c162f4de463925c8088409', 'Imam Firdaus', 'L', 'Waringinsari Barat', '2008-04-18', NULL, '-', '-', 'Waringinsari Barat', 'Subhan Sururi', 'Umi Zakiyah', '-', 3, 1, 1, '2023-07-04 12:10:46', '2023-07-04 12:10:46'),
(103, '3089268659', '3089268659', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Farel Adi Saputra', 'L', 'Tegal', '2008-01-09', NULL, '-', '-', 'Sendang Asri', 'Wahyudi Maulana', 'Sriyanti', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(104, '0085976941', '0085976941', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Gifahri Nakata Maulana', 'L', 'Kalirejo', '2008-05-01', NULL, '-', '-', 'Kaliwungu', 'Wardoyo', 'Ade Kartikasari', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(105, '0079859360', '0079859360', '858a77e9c961b1dce5cbfdb3765566c2b90e2d7b', 'Muhammad Hazel Fahrezi', 'L', 'Pringsewu', '2007-10-27', NULL, '-', '-', 'Kaliwungu', 'Suhendri', 'Indra Sulistyaningsih', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(106, '0077490420', '0077490420', '25646d6f594b3b9a03c162f4de463925c8088409', 'Muhammad Ridho Gumelar', 'L', 'Cimarias', '2007-09-04', NULL, '-', '-', 'Cimarias', 'Maman', 'Jahra Juwita', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(107, '0082427229', '0082427229', 'c0fdc77fcaa7464c8f7d69f4914aa8ebde66e975', 'Puguh Irsandi', 'L', 'Batam', '2008-01-08', NULL, '-', '-', 'Kaliwungu', 'Irsandi', 'Sismiyati', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(108, '0071636315', '0071636315', '80f4f4adb4361257cb90d45bc540eec0a7646384', 'Zulfa Yanuar', 'L', 'Pringsewu', '2007-01-11', NULL, '-', '-', 'Kalidadi', 'Wiyanto Budi H.', 'Winarsih', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(109, '3080020413', '3080020413', '25646d6f594b3b9a03c162f4de463925c8088409', 'Athfal Aprita Palupi', 'P', 'Pringsewu', '2008-04-26', NULL, '-', '-', 'Sukosari', 'Syarifudin Ahmad', 'Sarmiyatun', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(110, '0085118513', '0085118513', '25646d6f594b3b9a03c162f4de463925c8088409', 'Azizah', 'P', 'Pringsewu', '2008-07-14', NULL, '-', '-', 'Poncowarno', 'Doni Suryadi', 'Riyana Safitri', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(111, '0084033334', '0084033334', '25646d6f594b3b9a03c162f4de463925c8088409', 'Khodijah Nur Izzah Tsabita', 'P', 'Metro', '2008-04-19', NULL, '-', '-', 'Kalirejo', 'Paino', 'Musringatun', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(112, '0079864801', '0079864801', '25646d6f594b3b9a03c162f4de463925c8088409', 'Nabila Yuliana Rizki', 'P', 'Sridadi', '2007-07-15', NULL, '-', '-', 'Sridadi', 'Sugeng', 'Ehak', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(113, '0085885899', '0085885899', '25646d6f594b3b9a03c162f4de463925c8088409', 'Naila Hafshoh', 'P', 'Kalirejo', '2008-07-16', NULL, '-', '-', 'Sribasuki', 'Subowo', 'Dwi Indah Lestari', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47'),
(114, '0085885900', '0085885900', '25646d6f594b3b9a03c162f4de463925c8088409', 'Mufidah', 'P', 'Kalirejo', '2008-06-01', NULL, '-', '-', 'Baturaja', 'Bambang Erwanto', 'Nur Qoriah', '-', 3, 1, 1, '2023-07-04 12:10:47', '2023-07-04 12:10:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(254) NOT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_full_name` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_description` text,
  `user_role_role_id` int(254) DEFAULT NULL,
  `user_is_deleted` tinyint(1) DEFAULT '0',
  `user_input_date` timestamp NULL DEFAULT NULL,
  `user_last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_full_name`, `user_image`, `user_description`, `user_role_role_id`, `user_is_deleted`, `user_input_date`, `user_last_update`) VALUES
(1, 'admin@ibnus.ac.id', 'c48c303456a548097b4a36e5c391f9bd8fef591c', 'MARDIYANTO, M.T.I', NULL, 'Administrator', 1, 0, '2018-01-16 03:19:33', '2023-07-04 11:43:51'),
(2, 'user@user.com', '7e6f4cf6ca1bf15e56552308ff423db37222024b', 'Petugas', NULL, 'User', 2, 0, '2021-08-16 07:49:06', '2021-10-18 00:19:29'),
(3, 'bd@bendahara.com', 'bd4912e8b9d4da023c30f973c8dcb4dc54bab0b7', 'Bendahara', NULL, 'Bendahara', 3, 0, '2021-10-02 05:00:32', '2021-10-18 00:29:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(254) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'SUPERUSER'),
(2, 'USER'),
(3, 'BENDAHARA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bebas`
--
ALTER TABLE `bebas`
  ADD PRIMARY KEY (`bebas_id`),
  ADD KEY `fk_bebas_payment1_idx` (`payment_payment_id`),
  ADD KEY `fk_bebas_student1_idx` (`student_student_id`);

--
-- Indexes for table `bebas_pay`
--
ALTER TABLE `bebas_pay`
  ADD PRIMARY KEY (`bebas_pay_id`),
  ADD KEY `fk_bebas_pay_bebas1_idx` (`bebas_bebas_id`),
  ADD KEY `fk_bebas_pay_users1_idx` (`user_user_id`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`bulan_id`),
  ADD KEY `fk_bulan_payment1_idx` (`payment_payment_id`),
  ADD KEY `fk_bulan_month1_idx` (`month_month_id`),
  ADD KEY `fk_bulan_student1_idx` (`student_student_id`),
  ADD KEY `fk_bulan_users1_idx` (`user_user_id`);

--
-- Indexes for table `bulan_pay`
--
ALTER TABLE `bulan_pay`
  ADD PRIMARY KEY (`bulan_pay_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `debit`
--
ALTER TABLE `debit`
  ADD PRIMARY KEY (`debit_id`),
  ADD KEY `fk_jurnal_debit_users1_idx` (`user_user_id`);

--
-- Indexes for table `debit_jenis`
--
ALTER TABLE `debit_jenis`
  ADD PRIMARY KEY (`debit_jenis_id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`gaji_id`),
  ADD KEY `fk_jurnal_gaji_users1_idx` (`user_user_id`);

--
-- Indexes for table `gaji_pay`
--
ALTER TABLE `gaji_pay`
  ADD PRIMARY KEY (`gaji_pay_id`),
  ADD KEY `gaji_gaji_id` (`gaji_gaji_id`),
  ADD KEY `guru_guru_id` (`guru_guru_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`hutang_id`),
  ADD KEY `fk_jurnal_hutang_users1_idx` (`user_user_id`);

--
-- Indexes for table `hutang_pay`
--
ALTER TABLE `hutang_pay`
  ADD PRIMARY KEY (`hutang_pay_id`),
  ADD KEY `fk_jurnal_hutang_pay_users1_idx` (`user_user_id`),
  ADD KEY `hutang_hutang_id` (`hutang_hutang_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`information_id`),
  ADD KEY `fk_information_users1_idx` (`user_user_id`);

--
-- Indexes for table `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`kredit_id`),
  ADD KEY `fk_jurnal_kredit_users1_idx` (`user_user_id`);

--
-- Indexes for table `kredit_jenis`
--
ALTER TABLE `kredit_jenis`
  ADD PRIMARY KEY (`kredit_jenis_id`);

--
-- Indexes for table `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`letter_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_g_activity_log_g_user1_idx` (`user_id`);

--
-- Indexes for table `log_trx`
--
ALTER TABLE `log_trx`
  ADD PRIMARY KEY (`log_trx_id`),
  ADD KEY `fk_log_trx_bebas_pay1_idx` (`bebas_pay_bebas_pay_id`),
  ADD KEY `fk_log_trx_bulan1_idx` (`bulan_bulan_id`),
  ADD KEY `fk_log_trx_student1_idx` (`student_student_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`majors_id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_pos1_idx` (`pos_pos_id`),
  ADD KEY `fk_payment_period1_idx` (`period_period_id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `potongan_pay`
--
ALTER TABLE `potongan_pay`
  ADD PRIMARY KEY (`potongan_pay_id`),
  ADD KEY `guru_guru_id` (`guru_guru_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_student_class1_idx` (`class_class_id`),
  ADD KEY `fk_student_majors1_idx` (`majors_majors_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_user_user_role1_idx` (`user_role_role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bebas`
--
ALTER TABLE `bebas`
  MODIFY `bebas_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bebas_pay`
--
ALTER TABLE `bebas_pay`
  MODIFY `bebas_pay_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `bulan_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bulan_pay`
--
ALTER TABLE `bulan_pay`
  MODIFY `bulan_pay_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `debit`
--
ALTER TABLE `debit`
  MODIFY `debit_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `debit_jenis`
--
ALTER TABLE `debit_jenis`
  MODIFY `debit_jenis_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `gaji_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gaji_pay`
--
ALTER TABLE `gaji_pay`
  MODIFY `gaji_pay_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `hutang_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hutang_pay`
--
ALTER TABLE `hutang_pay`
  MODIFY `hutang_pay_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `information_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kredit`
--
ALTER TABLE `kredit`
  MODIFY `kredit_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kredit_jenis`
--
ALTER TABLE `kredit_jenis`
  MODIFY `kredit_jenis_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `letter`
--
ALTER TABLE `letter`
  MODIFY `letter_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `log_trx`
--
ALTER TABLE `log_trx`
  MODIFY `log_trx_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `majors_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `month_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `period_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `potongan_pay`
--
ALTER TABLE `potongan_pay`
  MODIFY `potongan_pay_id` int(254) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bebas`
--
ALTER TABLE `bebas`
  ADD CONSTRAINT `fk_bebas_payment1` FOREIGN KEY (`payment_payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bebas_student1` FOREIGN KEY (`student_student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `bebas_pay`
--
ALTER TABLE `bebas_pay`
  ADD CONSTRAINT `fk_bebas_pay_bebas1` FOREIGN KEY (`bebas_bebas_id`) REFERENCES `bebas` (`bebas_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bebas_pay_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD CONSTRAINT `fk_bulan_month1` FOREIGN KEY (`month_month_id`) REFERENCES `month` (`month_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bulan_payment1` FOREIGN KEY (`payment_payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bulan_student1` FOREIGN KEY (`student_student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bulan_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `debit`
--
ALTER TABLE `debit`
  ADD CONSTRAINT `fk_jurnal_debit_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `fk_jurnal_gaji_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `gaji_pay`
--
ALTER TABLE `gaji_pay`
  ADD CONSTRAINT `gaji_pay_ibfk_1` FOREIGN KEY (`guru_guru_id`) REFERENCES `guru` (`guru_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gaji_pay_ibfk_2` FOREIGN KEY (`gaji_gaji_id`) REFERENCES `gaji` (`gaji_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `fk_jurnal_hutang_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `hutang_pay`
--
ALTER TABLE `hutang_pay`
  ADD CONSTRAINT `fk_jurnal_hutang_pay_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `hutang_pay_ibfk_1` FOREIGN KEY (`hutang_hutang_id`) REFERENCES `hutang` (`hutang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `fk_information_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD CONSTRAINT `fk_jurnal_kredit_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_g_activity_log_g_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `log_trx`
--
ALTER TABLE `log_trx`
  ADD CONSTRAINT `fk_log_trx_bebas_pay1` FOREIGN KEY (`bebas_pay_bebas_pay_id`) REFERENCES `bebas_pay` (`bebas_pay_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_log_trx_bulan1` FOREIGN KEY (`bulan_bulan_id`) REFERENCES `bulan` (`bulan_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_log_trx_student1` FOREIGN KEY (`student_student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_period1` FOREIGN KEY (`period_period_id`) REFERENCES `period` (`period_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_payment_pos1` FOREIGN KEY (`pos_pos_id`) REFERENCES `pos` (`pos_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_class1` FOREIGN KEY (`class_class_id`) REFERENCES `class` (`class_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_student_majors1` FOREIGN KEY (`majors_majors_id`) REFERENCES `majors` (`majors_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_user_role1` FOREIGN KEY (`user_role_role_id`) REFERENCES `user_roles` (`role_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
