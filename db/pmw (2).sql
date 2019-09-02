-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Nov 2017 pada 03.59
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_anggota_tim`
--

CREATE TABLE `data_anggota_tim` (
  `id_tim` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_anggota_tim`
--

INSERT INTO `data_anggota_tim` (`id_tim`, `nama`, `nim`, `posisi`, `no_hp`, `fakultas`) VALUES
(2, 'Sattya', '24010009919', 'Anggota', '09282981991', 'Fakultas Teknik'),
(1, 'Sari devi', '24010313140101', 'Ketua', '444', 'Fakultas Teknik'),
(3, 'Ratna', '24010313140104', 'Ketua', '08999919911', 'Fakultas Psikologi'),
(1, 'Dudi Karis', '2401234564433', 'Ketua', '029929222', 'Fakultas Kesehatan Masyarakat'),
(5, 'ffDSF', '33333', 'Anggota', '4444', 'Fakultas Hukum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_hasil`
--

CREATE TABLE `data_hasil` (
  `id_hasil` int(20) NOT NULL,
  `id_tim` int(10) NOT NULL,
  `nilai_y` decimal(6,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_hasil`
--

INSERT INTO `data_hasil` (`id_hasil`, `id_tim`, `nilai_y`) VALUES
(1417, 1, '0.95252'),
(1418, 2, '1.06764'),
(1419, 3, '0.64379'),
(1420, 4, '0.91823'),
(1421, 5, '1.39243'),
(1422, 107, '0.45091'),
(1423, 108, '0.45091'),
(1424, 109, '1.20423'),
(1425, 110, '1.07859'),
(1426, 111, '1.02174'),
(1427, 112, '0.63991'),
(1428, 113, '1.32561'),
(1429, 114, '1.26464'),
(1430, 115, '0.95727'),
(1431, 116, '0.32809'),
(1432, 117, '0.66007'),
(1433, 118, '0.65989'),
(1434, 119, '0.56092'),
(1435, 120, '0.12045'),
(1436, 121, '0.83708');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kriteria`
--

CREATE TABLE `data_kriteria` (
  `id_kriteria` int(3) NOT NULL,
  `nama_kriteria` varchar(40) NOT NULL,
  `bobot_kriteria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kriteria`
--

INSERT INTO `data_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(1, 'Jenis Usaha', 15),
(2, 'Lokasi Usaha', 10),
(3, 'Kelayakan Pemasaran', 25),
(4, 'Kelayakan Teknis', 15),
(5, 'Kelayakan Manajemen', 15),
(6, 'Kelayakan Financial', 20),
(7, 'Kriteria 7', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_nilai`
--

CREATE TABLE `data_nilai` (
  `id_nilai` int(10) NOT NULL,
  `id_tim` int(5) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `skor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_nilai`
--

INSERT INTO `data_nilai` (`id_nilai`, `id_tim`, `id_kriteria`, `skor`) VALUES
(39, 1, 1, 60),
(40, 1, 2, 20),
(41, 1, 3, 75),
(42, 1, 4, 45),
(43, 1, 5, 60),
(44, 1, 6, 80),
(45, 2, 1, 45),
(46, 2, 2, 20),
(47, 2, 3, 75),
(48, 2, 4, 60),
(49, 2, 5, 75),
(50, 2, 6, 100),
(51, 3, 1, 45),
(52, 3, 2, 20),
(53, 3, 3, 75),
(54, 3, 4, 45),
(55, 3, 5, 30),
(56, 3, 6, 40),
(57, 4, 1, 45),
(58, 4, 2, 10),
(59, 4, 3, 100),
(60, 4, 4, 45),
(61, 4, 5, 45),
(62, 4, 6, 60),
(63, 5, 1, 75),
(64, 5, 2, 20),
(65, 5, 3, 125),
(66, 5, 4, 75),
(67, 5, 5, 75),
(68, 5, 6, 100),
(484, 104, 1, 12),
(485, 104, 2, 5),
(486, 104, 3, 4),
(487, 104, 4, 4.5),
(488, 104, 5, 750),
(489, 104, 6, 700),
(490, 104, 7, 150),
(491, 105, 1, 10),
(492, 105, 2, 7),
(493, 105, 3, 4),
(494, 105, 4, 3),
(495, 105, 5, 800),
(496, 105, 6, 600),
(497, 105, 7, 200),
(498, 106, 1, 10),
(499, 106, 2, 8),
(500, 106, 3, 1),
(501, 106, 4, 2.5),
(502, 106, 5, 1000),
(503, 106, 6, 900),
(504, 106, 7, 225),
(505, 107, 1, 30),
(506, 107, 2, 20),
(507, 107, 3, 50),
(508, 107, 4, 30),
(509, 107, 5, 30),
(510, 107, 6, 40),
(511, 107, 7, 0),
(512, 108, 1, 30),
(513, 108, 2, 20),
(514, 108, 3, 50),
(515, 108, 4, 30),
(516, 108, 5, 30),
(517, 108, 6, 40),
(518, 108, 7, 0),
(519, 109, 1, 75),
(520, 109, 2, 20),
(521, 109, 3, 100),
(522, 109, 4, 60),
(523, 109, 5, 75),
(524, 109, 6, 80),
(525, 109, 7, 0),
(526, 110, 1, 60),
(527, 110, 2, 20),
(528, 110, 3, 100),
(529, 110, 4, 60),
(530, 110, 5, 60),
(531, 110, 6, 80),
(532, 110, 7, 0),
(533, 111, 1, 60),
(534, 111, 2, 20),
(535, 111, 3, 125),
(536, 111, 4, 30),
(537, 111, 5, 60),
(538, 111, 6, 80),
(539, 111, 7, 0),
(540, 112, 1, 60),
(541, 112, 2, 40),
(542, 112, 3, 25),
(543, 112, 4, 75),
(544, 112, 5, 75),
(545, 112, 6, 20),
(546, 112, 7, 0),
(547, 113, 1, 60),
(548, 113, 2, 20),
(549, 113, 3, 125),
(550, 113, 4, 75),
(551, 113, 5, 75),
(552, 113, 6, 100),
(553, 113, 7, 0),
(554, 114, 1, 60),
(555, 114, 2, 20),
(556, 114, 3, 125),
(557, 114, 4, 60),
(558, 114, 5, 75),
(559, 114, 6, 100),
(560, 114, 7, 0),
(561, 115, 1, 60),
(562, 115, 2, 20),
(563, 115, 3, 125),
(564, 115, 4, 60),
(565, 115, 5, 60),
(566, 115, 6, 20),
(567, 115, 7, 0),
(568, 116, 1, 15),
(569, 116, 2, 40),
(570, 116, 3, 50),
(571, 116, 4, 75),
(572, 116, 5, 30),
(573, 116, 6, 20),
(574, 116, 7, 0),
(575, 117, 1, 30),
(576, 117, 2, 10),
(577, 117, 3, 50),
(578, 117, 4, 75),
(579, 117, 5, 30),
(580, 117, 6, 20),
(581, 117, 7, 0),
(582, 118, 1, 60),
(583, 118, 2, 40),
(584, 118, 3, 100),
(585, 118, 4, 60),
(586, 118, 5, 30),
(587, 118, 6, 40),
(588, 118, 7, 0),
(589, 119, 1, 15),
(590, 119, 2, 20),
(591, 119, 3, 25),
(592, 119, 4, 30),
(593, 119, 5, 60),
(594, 119, 6, 80),
(595, 119, 7, 0),
(596, 120, 1, 15),
(597, 120, 2, 50),
(598, 120, 3, 25),
(599, 120, 4, 15),
(600, 120, 5, 15),
(601, 120, 6, 100),
(602, 120, 7, 0),
(603, 121, 1, 30),
(604, 121, 2, 10),
(605, 121, 3, 25),
(606, 121, 4, 30),
(607, 121, 5, 75),
(608, 121, 6, 100),
(609, 121, 7, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_tim`
--

CREATE TABLE `data_tim` (
  `id_tim` int(3) NOT NULL,
  `no_tim` int(20) NOT NULL,
  `judul_proposal` varchar(200) NOT NULL,
  `jenis_usaha` varchar(30) NOT NULL,
  `usulan` varchar(30) NOT NULL,
  `tahun` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_tim`
--

INSERT INTO `data_tim` (`id_tim`, `no_tim`, `judul_proposal`, `jenis_usaha`, `usulan`, `tahun`) VALUES
(1, 1, 'Pandawa Rope Akses', 'Jasa', '10000000', 2016),
(2, 2, 'RUBIK (Rumah Belajar Bermain Inspiratif dan Kreatif)', 'Produksi', '12000000', 2016),
(3, 3, 'Kebun', 'Produksi', '12000000', 2016),
(4, 4, 'Suwe 6 co : Nugget dengan substitusi Puree', 'Produksi', '20000000', 2016),
(5, 5, 'Kedai Paparazi', 'Produksi', '14000000', 2016),
(104, 1, 'Project 1', 'Boga', '12', 2017),
(105, 2, 'Project B', 'Boga', '2000', 2017),
(106, 3, 'Project 3', 'Boga', '333', 2017),
(107, 6, 'Mr Arto', 'Boga', '230000000', 2016),
(108, 7, 'Choco knolle ', 'Boga', '19000000', 2016),
(109, 8, 'Katumbiri', 'Jasa', '17000000', 2016),
(110, 9, 'Tahu Bakso Kekinian "Tasoki"', 'Boga', '14000000', 2016),
(111, 10, 'Dipo Danus', 'Boga', '160000000', 2016),
(112, 11, 'BATAGOR VARIAN RASA', 'Boga', '13000000', 2016),
(113, 12, 'GINGERCULTURE', 'Boga', '18000000', 2016),
(114, 13, 'SANGKAR SENI', 'Budidaya', '18000000', 2016),
(115, 14, 'Euphoria Catering (We Serve With Love)', 'Jasa', '220000000', 2016),
(116, 15, 'Dhyeta Renting', 'Boga', '17000000', 2016),
(117, 16, 'House Of Mushroom', 'Boga', '16000000', 2016),
(118, 17, 'Golden Smart Course', 'Jasa', '18000000', 2016),
(119, 18, 'Warung Ayam Geprek Kosase ', 'Boga', '18000000', 2016),
(120, 19, 'Rafida Hijab', 'Produksi', '24000000', 2016),
(121, 20, 'Marev Lamp : Lampu Hias Multi Fungsi', 'Produksi', '21000000', 2016);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_user`
--

CREATE TABLE `data_user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_user`
--

INSERT INTO `data_user` (`username`, `password`, `level`) VALUES
('kesma', '1b44d60225ee82053f9a016c9e234d49', 'bagiankesma'),
('timseleksi', '788fa15376fefc17fd91ad2c304c0acd', 'timseleksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_anggota_tim`
--
ALTER TABLE `data_anggota_tim`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_tim` (`id_tim`);

--
-- Indexes for table `data_hasil`
--
ALTER TABLE `data_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_tim` (`id_tim`);

--
-- Indexes for table `data_kriteria`
--
ALTER TABLE `data_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `data_nilai`
--
ALTER TABLE `data_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_tim` (`id_tim`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `data_tim`
--
ALTER TABLE `data_tim`
  ADD PRIMARY KEY (`id_tim`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_hasil`
--
ALTER TABLE `data_hasil`
  MODIFY `id_hasil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1437;
--
-- AUTO_INCREMENT for table `data_kriteria`
--
ALTER TABLE `data_kriteria`
  MODIFY `id_kriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `data_nilai`
--
ALTER TABLE `data_nilai`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;
--
-- AUTO_INCREMENT for table `data_tim`
--
ALTER TABLE `data_tim`
  MODIFY `id_tim` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_anggota_tim`
--
ALTER TABLE `data_anggota_tim`
  ADD CONSTRAINT `data_anggota_tim_ibfk_1` FOREIGN KEY (`id_tim`) REFERENCES `data_tim` (`id_tim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_hasil`
--
ALTER TABLE `data_hasil`
  ADD CONSTRAINT `data_hasil_ibfk_1` FOREIGN KEY (`id_tim`) REFERENCES `data_tim` (`id_tim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_nilai`
--
ALTER TABLE `data_nilai`
  ADD CONSTRAINT `data_nilai_ibfk_1` FOREIGN KEY (`id_tim`) REFERENCES `data_tim` (`id_tim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_nilai_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `data_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
