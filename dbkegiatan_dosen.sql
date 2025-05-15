-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2025 pada 10.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkegiatan_dosen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_ilmu`
--

CREATE TABLE `bidang_ilmu` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang_ilmu`
--

INSERT INTO `bidang_ilmu` (`id`, `nama`, `deskripsi`) VALUES
(1, 'ilmu agama', 'ilmu agama adalah ilmu yang harus di pelajari setiap mahasiswa mahasiswi STT NF'),
(2, 'Ilmu Komputer', 'Bidang ilmu yang mempelajari teori, desain, pengembangan, dan aplikasi komputer dan sistem perangkat lunak.'),
(3, 'Ilmu Sosial', 'Bidang ilmu yang mengkaji masyarakat manusia dan hubungan sosial di dalamnya. Termasuk sosiologi, ekonomi, antropologi, dll.'),
(4, 'Ilmu Pendidikan', 'Bidang ilmu yang berkaitan dengan proses belajar-mengajar, serta sistem dan kebijakan pendidikan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `gelar_belakang` varchar(30) DEFAULT NULL,
  `gelar_depan` varchar(20) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(45) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tahun_masuk` int(11) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama`, `gelar_belakang`, `gelar_depan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `tahun_masuk`, `prodi_id`) VALUES
(1, '0012345678', 'Dr. Arya Wijaya', 'M.Kom.', 'Dr.', 'L', 'Bandung', '1980-05-15', 'Jl. Ganesha No. 10, Bandung', 'arya.wijaya@example.ac.id', 2010, 1),
(2, '0098765432', 'Prof. Siti Aminah', '	Ph.D.', 'Prof.', 'P', 'Jakarta', '1980-05-22', 'Komplek UI, Depok', 'siti.aminah@example.ac.id', 2010, 2),
(3, '0011223344', 'Rendy Pratama, S.E., M.M.', 'S.E., M.M.', 'Prof.', 'L', 'Surabaya', '1970-05-29', 'Jl. Ahmad Yani No. 5, Surabaya', 'rendy.pratama@example.ac.id', 2005, 3),
(4, '0055667788', 'Dr. Dewi Lestari', 'M.T.', 'Dr.', 'P', 'Yogyakarta', '1980-05-29', 'Jl. Kaliurang Km 12, Yogyakarta', 'dewi.lestari@example.ac.id', 2007, 1),
(5, '0044332211', 'Bambang Sudarso, S.Kom.', 'S.Kom.', 'Dr.', 'L', 'Semarang', '1980-05-30', 'Jl. Pemuda No. 20, Semarang', 'bambang.s@example.ac.id', 2008, 3),
(6, '0066778899', 'Maya Anggraini, M.B.A.', 'M.B.A.', 'Dr.', 'P', 'Medan', '1970-05-29', 'Jl. Gatot Subroto No. 100, Medan', 'maya.a@example.ac.id', 2006, 2),
(7, '0022334455', 'Ir. Chandra Kirana', 'M.Eng.', 'Ir.', 'L', 'Malang', '1980-05-01', 'jl malang no199', 'chandra.k@example.ac.id', 2007, 3),
(8, '0088990011', 'Dra. Rina Fitriani', 'M.Si.', 'Dra.', 'P', 'Padang', '1980-05-20', 'Jl. gunistuy padang no8778', 'rina.fitriani@example.ac.id', 2007, 2),
(9, '0033445566', 'Kevin Wijaya, S.Kom., M.Sc.', 'M.Sc.', 'Dr.', 'L', 'Denpasar', '1980-05-14', 'Jl. Sunset Road No. 88, Denpasar', 'kevin.w@example.ac.id', 2007, 2),
(10, '0077889900', 'Dr. Lisa Kurniawati', 'S.T., M.Kom.', 'Dr.', 'P', 'Solo', '1980-05-29', 'Jl. Slamet Riyadi No. 150, Solo', 'lisa.k@example.ac.id', 2007, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen_kegiatan`
--

CREATE TABLE `dosen_kegiatan` (
  `dosen_id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen_kegiatan`
--

INSERT INTO `dosen_kegiatan` (`dosen_id`, `kegiatan_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(3, 2),
(3, 3),
(6, 3),
(9, 3),
(10, 3),
(10, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_kegiatan`
--

INSERT INTO `jenis_kegiatan` (`id`, `nama`) VALUES
(1, 'Konferensi Ilmiah'),
(2, 'Workshop'),
(3, 'Seminar Nasional'),
(4, 'Sosialisasi'),
(5, 'Simposium Internasional'),
(6, 'Bakti Sosial'),
(7, 'Pameran'),
(8, 'Pentas Seni'),
(9, 'Pelatihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenis_kegiatan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `tanggal_mulai`, `tanggal_selesai`, `tempat`, `deskripsi`, `jenis_kegiatan_id`) VALUES
(1, '2025-05-01', '2025-05-31', 'Aula Barat ITB, Bandung', 'Konferensi Nasional Sistem Informasi dan Inovasi Digital 2025', 1),
(2, '2025-04-01', '2025-04-30', 'Ruang Multimedia Fasilkom UI, Depok', 'Workshop Pengembangan Aplikasi Web Modern dengan Framework React', 2),
(3, '2025-03-01', '2025-03-31', 'Gedung Kuliah Bersama Unair, Surabaya', 'Seminar Nasional Tren dan Peluang Bisnis Digital di Era Metaverse', 3),
(4, '2025-05-01', '2025-05-24', 'Aula Barat ITB, Bandung', 'Drama mahasiswa tentang palestina.', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penelitian`
--

CREATE TABLE `penelitian` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `mulai` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `tahun_ajaran` varchar(5) DEFAULT NULL,
  `bidang_ilmu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penelitian`
--

INSERT INTO `penelitian` (`id`, `judul`, `mulai`, `akhir`, `tahun_ajaran`, `bidang_ilmu_id`) VALUES
(1, 'Integrasi Nilai-Nilai Islam dalam Pengembangan Aplikasi Pembelajaran Anak Usia Dini', '2025-02-01', '2025-07-16', '2024/', 1),
(2, 'Analisis Pengaruh Media Sosial Terhadap Pembentukan Identitas Generasi Z', '2025-04-01', '2025-05-15', '2024/', 3),
(3, 'Pengembangan Model Pembelajaran Blended Learning Berbasis Proyek pada Mata Kuliah Pemrograman Web', '2025-01-02', '2025-05-23', '2024/', 4),
(4, 'Pengembangan Algoritma Machine Learning untuk Prediksi Harga Saham Real-Time', '2024-12-11', '2025-08-22', '2024/', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `ketua` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `kode`, `nama`, `alamat`, `telpon`, `ketua`) VALUES
(1, 'SI001', 'Sistem Informasi', 'Jl. Ganesha No. 10, Bandung', '	(022) 1234567', 'Dr. Arya Wijaya'),
(2, 'TI002', 'Teknik Informatika', 'Komplek UI, Depok', '	(021) 9876543', 'Prof. Siti Aminah'),
(3, 'BD003', 'Bisnis Digital', 'Jl. Ahmad Yani No. 5, Surabaya', '(031) 5556667', '	Rendy Pratama, S.E.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_penelitian`
--

CREATE TABLE `tim_penelitian` (
  `dosen_id` int(11) NOT NULL,
  `penelitian_id` int(11) NOT NULL,
  `peran` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim_penelitian`
--

INSERT INTO `tim_penelitian` (`dosen_id`, `penelitian_id`, `peran`) VALUES
(1, 1, 'KETUA'),
(2, 3, 'WAKIL'),
(3, 4, 'ANGGOTA');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indeks untuk tabel `dosen_kegiatan`
--
ALTER TABLE `dosen_kegiatan`
  ADD PRIMARY KEY (`dosen_id`,`kegiatan_id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indeks untuk tabel `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_kegiatan_id` (`jenis_kegiatan_id`);

--
-- Indeks untuk tabel `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidang_ilmu_id` (`bidang_ilmu_id`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tim_penelitian`
--
ALTER TABLE `tim_penelitian`
  ADD PRIMARY KEY (`dosen_id`,`penelitian_id`),
  ADD KEY `penelitian_id` (`penelitian_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Ketidakleluasaan untuk tabel `dosen_kegiatan`
--
ALTER TABLE `dosen_kegiatan`
  ADD CONSTRAINT `dosen_kegiatan_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `dosen_kegiatan_ibfk_2` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`jenis_kegiatan_id`) REFERENCES `jenis_kegiatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `penelitian_ibfk_1` FOREIGN KEY (`bidang_ilmu_id`) REFERENCES `bidang_ilmu` (`id`);

--
-- Ketidakleluasaan untuk tabel `tim_penelitian`
--
ALTER TABLE `tim_penelitian`
  ADD CONSTRAINT `tim_penelitian_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `tim_penelitian_ibfk_2` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitian` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
