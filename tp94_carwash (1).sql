-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2024 pada 05.35
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp94_carwash`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_omzet`
--

CREATE TABLE `laporan_omzet` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_omzet` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `harga`, `kategori`) VALUES
(8, 'Cuci Reguler (Sedang)', '45000.00', ''),
(9, 'Cuci Reguler (Besar)', '50000.00', ''),
(10, 'Cuci Premium (Kecil)', '365000.00', ''),
(11, 'Cuci Premium (Sedang)', '415000.00', ''),
(12, 'Cuci Premium (Besar)', '465000.00', ''),
(13, 'Cuci + Jamur Kaca (Kecil)', '75000.00', ''),
(15, 'Cuci + Jamur Kaca (Sedang)', '85000.00', ''),
(16, 'Cuci + Jamur Kaca (Besar)', '95000.00', ''),
(17, 'Salon Interior (Kecil)', '350000.00', ''),
(18, 'Salon Interior (Sedang)', '400000.00', ''),
(19, 'Salon Interior (Besar)', '450000.00', ''),
(20, ' + Bongkar Karpet', '50000.00', ''),
(21, 'Cuci + Wax (Kecil)', '145000.00', ''),
(22, 'Cuci + Wax (Sedang)', '165000.00', ''),
(23, 'Cuci + Wax (Besar)', '185000.00', ''),
(24, 'Detailing (Kecil)', '2000000.00', ''),
(25, 'Detailing (Sedang)', '2500000.00', ''),
(26, 'Detailing (Besar)', '3000000.00', ''),
(27, 'Cuci + Wax + Jamur Kaca (Kecil)', '175000.00', ''),
(28, 'Cuci + Wax + Jamur Kaca (Sedang)', '200000.00', ''),
(29, 'Cuci + Wax + Jamur Kaca (Besar)', '225000.00', ''),
(30, 'Salon Body Luar (Kecil)', '700000.00', ''),
(31, 'Salon Body Luar (Sedang)', '900000.00', ''),
(32, 'Salon Body Luar (Besar)', '1200000.00', ''),
(33, 'Cuci Motor (Kecil)', '15000.00', ''),
(34, 'Cuci Motor (Besar)', '20000.00', ''),
(35, 'Kursi Pijat per 20menit', '20000.00', ''),
(36, 'Cuci Karpet 1 Meter', '10000.00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `kontak_hp`) VALUES
(13, 'Rehan', '082351844011');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'Shampoo Mobil', '25000.00', 100),
(2, 'Pengharum Mobil', '15000.00', 200),
(3, 'Lap Microfiber', '20000.00', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `nama_promo` varchar(100) NOT NULL,
  `diskon` decimal(5,2) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id`, `nama_promo`, `diskon`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, 'Diskon Akhir Tahun', '10.00', '2024-12-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `layanan_id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah_produk` int(11) DEFAULT 1,
  `total_harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `layanan_id`, `produk_id`, `jumlah_produk`, `total_harga`, `created_at`, `tanggal_transaksi`) VALUES
(22, 13, 36, NULL, 1, '10000.00', '2024-10-28 15:47:05', '2024-10-28 15:47:05'),
(23, 13, 8, NULL, 1, '45000.00', '2024-10-28 15:47:05', '2024-10-28 15:47:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_layanan`
--

CREATE TABLE `transaksi_layanan` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `layanan_id` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(3, 'owner', 'c96f16e3f0e21671c90adf0c9437fb4f', 'ica', 'owner'),
(4, 'kasir', '22c5c59b234367df53fc8ce1e8b0b96e', 'cici', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laporan_omzet`
--
ALTER TABLE `laporan_omzet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_layanan_id` (`layanan_id`),
  ADD KEY `fk_product_id` (`produk_id`),
  ADD KEY `fk_id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `layanan_id` (`layanan_id`);

--
-- Indeks untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laporan_omzet`
--
ALTER TABLE `laporan_omzet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_id_layanan_id` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`),
  ADD CONSTRAINT `fk_id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD CONSTRAINT `transaksi_layanan_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_layanan_ibfk_2` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD CONSTRAINT `transaksi_produk_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_produk_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
