-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2020 pada 10.44
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bin`
--

CREATE TABLE `bin` (
  `id_bin` int(11) NOT NULL,
  `bin_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bin`
--

INSERT INTO `bin` (`id_bin`, `bin_name`) VALUES
(1, 'A-01-01'),
(2, 'A-01-02'),
(3, 'A-01-04'),
(4, 'A-01-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `id_so` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id`, `id_so`, `date`, `note`) VALUES
(3, 1, '2020-09-10 05:51:56', 'Naka add new #SO'),
(5, 3, '2020-11-03 07:10:47', 'Naka add new #SO'),
(6, 1, '2020-09-10 05:51:56', 'Yes history'),
(7, 1, '2020-11-04 10:43:45', 'Naka moved #SO 009299 from BIN C3 to A2'),
(8, 3, '2020-11-04 11:42:59', 'Naka sent #SO 0029309 from BIN C2 to BPU'),
(10, 4, '2020-11-04 13:27:39', 'Naka add new #SO 435672-30'),
(11, 5, '2020-11-04 13:27:49', 'Naka add new #SO 384168-40'),
(12, 6, '2020-11-04 13:28:21', 'Naka add new #SO 384109-50'),
(13, 7, '2020-11-06 09:52:33', 'Naka add new #SO 346133'),
(14, 1, '2020-11-06 15:55:54', 'Naka moved #SO 009299 from BIN A-01-02 to A-01-01'),
(15, 5, '2020-11-11 09:08:26', 'Naka sent #SO 384168-40 from BIN A-01-01 to BPU'),
(16, 8, '2020-11-11 09:21:54', 'Naka add new #SO 2000526414');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materialcode`
--

CREATE TABLE `materialcode` (
  `id_code` int(11) NOT NULL,
  `id_so` int(11) NOT NULL,
  `code` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materialcode`
--

INSERT INTO `materialcode` (`id_code`, `id_so`, `code`) VALUES
(11, 7, '1535356'),
(12, 7, '131566'),
(16, 7, '454669'),
(17, 5, '1005886'),
(18, 5, '1005886'),
(19, 1, '151335'),
(20, 1, '153155'),
(21, 4, '121244'),
(23, 4, '100544'),
(24, 8, '151335'),
(25, 6, '151335');

-- --------------------------------------------------------

--
-- Struktur dari tabel `so`
--

CREATE TABLE `so` (
  `id_so` int(11) NOT NULL,
  `id_bin` int(11) NOT NULL,
  `so_number` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `so`
--

INSERT INTO `so` (`id_so`, `id_bin`, `so_number`, `status`) VALUES
(1, 1, '009299', 1),
(3, 4, '0029309', 2),
(4, 1, '435672-30', 1),
(5, 1, '384168-40', 2),
(6, 4, '384109-50', 1),
(7, 1, '346133', 1),
(8, 1, '2000526414', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `epf` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('ADMIN','STAFF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`epf`, `name`, `password`, `level`) VALUES
('6458', 'Lukman', '9d63484abb477c97640154d40595a3bb', 'ADMIN'),
('8497', 'Naka', '4ef42b32bccc9485b10b8183507e5d82', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bin`
--
ALTER TABLE `bin`
  ADD PRIMARY KEY (`id_bin`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materialcode`
--
ALTER TABLE `materialcode`
  ADD PRIMARY KEY (`id_code`);

--
-- Indeks untuk tabel `so`
--
ALTER TABLE `so`
  ADD PRIMARY KEY (`id_so`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`epf`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bin`
--
ALTER TABLE `bin`
  MODIFY `id_bin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `materialcode`
--
ALTER TABLE `materialcode`
  MODIFY `id_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `so`
--
ALTER TABLE `so`
  MODIFY `id_so` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
