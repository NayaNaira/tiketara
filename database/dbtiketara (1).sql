-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2026 at 06:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtiketara`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `promoter_id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('music_festival','seminar_education','sports','arts_theater_culture','lifestyle_holiday','attraction_tourism') COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_rating` enum('all_ages','13_plus','17_plus','18_plus','21_plus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all_ages',
  `venue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `max_ticket_per_order` int UNSIGNED NOT NULL DEFAULT '5',
  `poster_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `terms_and_conditions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `promoter_id`, `title`, `description`, `category`, `age_rating`, `venue_name`, `address`, `city`, `event_date`, `start_time`, `end_time`, `max_ticket_per_order`, `poster_path`, `status`, `rejection_reason`, `terms_and_conditions`, `created_at`, `updated_at`) VALUES
(1, 2, 'Saturday Live Session: Indie Music Night', 'Sesi intim musik indie lokal bareng komunitas musisi kota. Nikmati malam minggu syahdu dengan alunan musik folk dan pop-indie.', 'music_festival', 'all_ages', 'The Backyard Creative Space', 'Jl. Kenanga No. 18 (Area Outdoor Café)', 'Bandung', '2026-08-15', '19:00:00', '23:59:00', 4, 'events/posters/GCXP0tSm3HuAxdSjWW7e8iq9px5G8Dy3y8n447pG.jpg', 'approved', NULL, '1. Tiket yang sudah dibeli bersifat final dan tidak dapat dibatalkan, di-refund, atau diuangkan kembali.\r\n2. Pembeli wajib menunjukkan E-Ticket resmi beserta kartu identitas (KTP/SIM/Paspor) yang sah pada saat registrasi masuk.\r\n3. Satu E-Ticket hanya berlaku untuk 1 (satu) orang pengunjung.\r\n4. Harga tiket sudah termasuk 1 (satu) minuman gratis yang dapat ditukarkan di area bar kafe.\r\n5. Pengunjung dilarang membawa makanan dan minuman dari luar area The Backyard Creative Space.\r\n6. Dilarang keras membawa senjata tajam, senjata api, obat-obatan terlarang, serta minuman beralkohol.\r\n7. Penyelenggara berhak mengeluarkan pengunjung yang membuat kegaduhan atau tidak mematuhi protokol ketertiban demi kenyamanan bersama.', '2026-06-20 11:27:10', '2026-06-20 11:44:11'),
(2, 2, 'Tech & Coffee: Building Startup with AI', 'Sharing session santai sesama tech-enthusiast dan developer lokal. Kupas tuntas pemanfaatan AI untuk efisiensi bisnis rintisan.', 'seminar_education', '13_plus', 'Kopi & Ruang Kerja Co-Working', 'Sudirman Avenue Blk C/12', 'Jakarta', '2026-09-05', '10:00:00', '23:59:00', 4, 'events/posters/cU8rqgYrsfC721w4adDI6CC0aSaZ9T6l1FLeLYJh.jpg', 'approved', NULL, '1. Registrasi ulang dibuka 45 menit sebelum acara dimulai. Pengunjung disarankan datang tepat waktu untuk menghindari antrean.\r\n2. E-Ticket akan di-scan di pintu masuk. Harap siapkan barcode dengan kecerahan layar handphone yang cukup.\r\n3. Fasilitas yang didapatkan meliputi akses workshop, free-flow coffee/tea, kudapan ringan, serta E-Certificate resmi yang dikirimkan maksimal H+3 acara melalui email terdaftar.\r\n4. Pengunjung diwajibkan membawa laptop atau perangkat pendukung sendiri jika ingin mengikuti sesi praktik secara langsung.\r\n5. Dilarang melakukan perekaman video secara utuh selama pemaparan materi tanpa izin tertulis dari panitia.\r\n6. Panitia tidak bertanggung jawab atas kehilangan barang pribadi milik pengunjung selama acara berlangsung.', '2026-06-20 11:27:10', '2026-06-20 11:44:28'),
(3, 4, '3on3 Community Basketball League', 'Turnamen basket 3on3 antar komunitas regional. Tunjukkan skill tim kamu dan bawa pulang hadiah jutaan rupiah!', 'sports', 'all_ages', 'Gor Pemuda Indoor Court', 'Kompleks Olahraga Rakyat', 'Surabaya', '2026-07-20', '09:00:00', '23:59:00', 4, 'events/posters/SgpP3H56zPqGsndgj273UyUBLrwaCi6aPoPwMKhA.webp', 'approved', NULL, '1. Tiket penonton berlaku untuk akses satu hari penuh ke area tribun GOR Pemuda Indoor Court.\r\n2. Pengunjung wajib menjaga kebersihan dan dilarang membuang sampah sembarangan di area tribun maupun lapangan.\r\n3. Penonton dilarang memasuki area *court* (lapangan pertandingan) kecuali atas instruksi dari panitia atau wasit.\r\n4. Dilarang membawa atribut politik, spanduk yang bersifat provokatif, rasis, atau mengandung unsur SARA.\r\n5. Semua pengunjung wajib menggunakan sepatu olahraga atau alas kaki yang tidak merusak lantai lapangan indoor.\r\n6. Apabila terjadi keributan atau tindakan anarkis, pihak keamanan berhak mengusir pelaku dari area GOR tanpa ada pengembalian uang tiket.\r\n7. Keputusan panitia dan wasit pertandingan bersifat mutlak dan tidak dapat diganggu gugat.', '2026-06-20 11:27:10', '2026-06-20 11:44:48'),
(4, 2, 'Art & Verse: Malam Puisi Pop-Up', 'Kolaborasi pameran seni visual lokal mini dengan panggung pembacaan puisi kontemporer. Ruang berekspresi tanpa batas.', 'arts_theater_culture', 'all_ages', 'Kala Kini Art Gallery', 'Jl. Braga No. 44', 'Bandung', '2026-10-31', '19:00:00', '23:59:00', 4, 'events/posters/aIhITrnkHkW0ubhRO1rbIYMUY3K3dLkb6ncnYctr.webp', 'pending', NULL, '1. Pengunjung wajib menjaga ketenangan dan suasana kondusif selama acara pembacaan puisi dan teater berlangsung.\r\n2. Dilarang menyentuh, merusak, atau mengotori instalasi karya seni yang dipajang di dalam Kala Kini Art Gallery.\r\n3. Diperbolehkan mengambil foto menggunakan kamera handphone tanpa menyalakan fitur lampu kilat (*flash photography*).\r\n4. Penggunaan kamera profesional (DSLR/Mirrorless) untuk keperluan komersial wajib melaporkan diri ke meja registrasi terlebih dahulu.\r\n5. Gerbang masuk galeri akan ditutup 15 menit setelah pertunjukan utama dimulai demi menjaga kekhusyukan acara.\r\n6. Pengunjung yang terlambat baru diperbolehkan masuk pada saat sesi jeda atau *break*.', '2026-06-20 11:27:10', '2026-06-20 11:39:43'),
(5, 5, 'Sunday Urban Market: Food & Thrifting', 'Pasar akhir pekan anak muda! Berburu baju-baju vintage/thrift pilihan sekalian jajan kuliner artisan lokal yang hits.', 'lifestyle_holiday', 'all_ages', 'Downtown Parking Lot & Plaza', 'Pusat Belanja Sudirman', 'Jakarta', '2026-12-20', '10:00:00', '21:00:00', 5, 'events/urban-market.jpg', 'approved', NULL, '1. Tiket fisik atau E-Ticket harian wajib disimpan selama berada di dalam area festival.\n2. Tiket masuk yang valid dapat ditukarkan dengan voucher potongan belanja senilai Rp5.000 di tenant thrift atau F&B tertentu dengan syarat minimum belanja.\n3. Pengunjung bertanggung jawab penuh atas barang belanjaan dan barang bawaan pribadi masing-masing.\n4. Transaksi di dalam area market disarankan menggunakan pembayaran non-tunai (QRIS/E-Wallet), namun tetap sediakan uang tunai secukupnya.\n5. Pembeli diharapkan membawa kantong belanja ramah lingkungan sendiri (*tote bag*) guna mengurangi sampah plastik.\n6. Area ini ramah hewan peliharaan (*pet-friendly*), dengan syarat hewan peliharaan menggunakan tali pengikat (*leash*) dan kebersihannya dijaga oleh pemilik.', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(6, 5, 'City Heritage Photowalk', 'Jalan santai bersama komunitas fotografi menyusuri sudut-sudut arsitektur tua kota lama sambil berburu foto estetik.', 'attraction_tourism', 'all_ages', 'Titik Kumpul Post Office Heritage', 'Kawasan Kota Lama', 'Semarang', '2026-11-10', '06:30:00', '10:00:00', 3, 'events/photowalk.jpg', 'approved', NULL, '1. Tiket pendaftaran sudah termasuk atribut photowalk (peta rute, stiker komunitas) dan air mineral botol.\n2. Pengunjung bebas menggunakan jenis kamera apapun, mulai dari kamera HP, Analog, Mirrorless, hingga DSLR.\n3. Rute jalan kaki akan melewati area publik dan jalan raya umum. Seluruh peserta wajib mengutamakan keselamatan dan mematuhi rambu lalu lintas.\n4. Dilarang memotret objek atau area militer/privat yang memiliki tanda larangan memotret.\n5. Selama photowalk berlangsung, peserta dilarang merusak fasilitas cagar budaya atau mengganggu kenyamanan pejalan kaki lainnya.\n6. Acara akan tetap berlangsung jika hujan ringan (gerimis). Peserta disarankan membawa pelindung kamera tambahan (*rain cover*) dan payung/jas hujan pribadi.', '2026-06-20 11:27:11', '2026-06-20 11:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `event_galleries`
--

CREATE TABLE `event_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_galleries`
--

INSERT INTO `event_galleries` (`id`, `event_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'galleries/indie-1.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(2, 1, 'galleries/indie-2.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(3, 2, 'galleries/tech-1.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(4, 2, 'galleries/tech-2.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(5, 3, 'galleries/basket-1.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(6, 3, 'galleries/basket-2.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(7, 4, 'galleries/art-1.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(8, 5, 'galleries/market-1.jpg', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(9, 5, 'galleries/market-2.jpg', '2026-06-20 11:27:11', '2026-06-20 11:27:11'),
(10, 6, 'galleries/photo-1.jpg', '2026-06-20 11:27:11', '2026-06-20 11:27:11'),
(11, 4, 'events/galleries/Pz09bvy3dXcbeLCfebu88eRzOhTgJaHpKQl7clKp.jpg', '2026-06-20 11:37:24', '2026-06-20 11:37:24'),
(12, 3, 'events/galleries/3qbSHQ1HmX9vpyGXgqG3PbwqAPohvNuAtNi8drnQ.jpg', '2026-06-20 11:42:53', '2026-06-20 11:42:53'),
(13, 3, 'events/galleries/wdxt8jaeXzx0KZUI0OdcMIi0QORsVa7lVXtZLgeu.jpg', '2026-06-20 11:42:53', '2026-06-20 11:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_06_054749_create_events_table', 1),
(5, '2026_06_06_054750_create_payment_methods_table', 1),
(6, '2026_06_06_054752_create_orders_table', 1),
(7, '2026_06_06_063740_create_personal_access_tokens_table', 1),
(8, '2026_06_09_134213_create_event_galleries_table', 1),
(9, '2026_06_11_141337_create_ticket_types_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `events_id` bigint UNSIGNED NOT NULL,
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','expired','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4vcMlocY1rzIfD7x2luoiWmV1Qm8ANJLX27zu81s', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJMOTdyMDRnNDdOc1JzZkkwMU52RVQ2R25aOHZRTHVsT0pRN3QyVUNVIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2J1eWVyXC9ldmVudFwvMVwvc2VsZWN0LXRpY2tldCIsInJvdXRlIjoiYnV5ZXIudGlja2V0LnNlbGVjdCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MywiYm9va2luZ190aWNrZXRfdHlwZV9pZCI6IjkiLCJib29raW5nX3F1YW50aXR5IjoiMSJ9', 1781981243);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_types`
--

CREATE TABLE `ticket_types` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quota` int NOT NULL,
  `sold` int NOT NULL DEFAULT '0',
  `start_sale` timestamp NULL DEFAULT NULL,
  `end_sale` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive','sold_out') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_types`
--

INSERT INTO `ticket_types` (`id`, `event_id`, `name`, `price`, `quota`, `sold`, `start_sale`, `end_sale`, `status`, `created_at`, `updated_at`) VALUES
(6, 5, 'Daily Pass Ticket', 15000.00, 300, 0, '2026-06-20 11:27:10', '2026-09-20 11:27:10', 'active', '2026-06-20 11:27:10', '2026-06-20 11:27:10'),
(7, 6, 'Registration Fee', 25000.00, 60, 0, '2026-06-20 11:27:11', '2026-09-20 11:27:11', 'active', '2026-06-20 11:27:11', '2026-06-20 11:27:11'),
(8, 2, 'Seat Pass', 45000.00, 50, 0, '2026-06-20 11:27:00', '2026-09-20 11:27:00', 'active', '2026-06-20 11:31:50', '2026-06-20 11:31:50'),
(9, 1, 'Early Bird', 35000.00, 30, 0, '2026-06-20 11:27:00', '2026-09-20 11:27:00', 'active', '2026-06-20 11:36:04', '2026-06-20 11:36:04'),
(10, 1, 'Regular Pass', 50000.00, 70, 0, '2026-06-20 11:27:00', '2026-09-20 11:27:00', 'active', '2026-06-20 11:36:04', '2026-06-20 11:36:04'),
(11, 4, 'Art Pass', 30000.00, 80, 0, '2026-06-20 11:27:00', '2026-09-20 11:27:00', 'active', '2026-06-20 11:37:24', '2026-06-20 11:37:24'),
(13, 3, 'General Admission', 20000.00, 150, 0, '2026-06-20 11:27:00', '2026-09-20 11:27:00', 'active', '2026-06-20 11:43:15', '2026-06-20 11:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('buyer','promoter','super_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buyer',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('verify','active','banned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'verify',
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promoter_status` enum('none','pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `avatar`, `status`, `nik`, `address`, `phone_number`, `promoter_status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super_admin@gmail.com', '2026-06-20 11:27:07', '$2y$12$wUxkh/9mlHytQ.QFsEUTceH6.vZHjm0T/.NHOfY8eSwwSos0y0WLm', NULL, 'super_admin', NULL, 'active', NULL, NULL, NULL, 'none', '2026-06-20 11:27:08', '2026-06-20 11:27:08'),
(2, 'Promoter', 'promoter@gmail.com', '2026-06-20 11:27:08', '$2y$12$KMlmcAfR0NYVDRcHoNdUV.t.ozo.osDz9LA/yBIwZWl74ZRQBMo9m', 'cHgYS8BnDv3pMX0bmVs3f7KvmyubgWsRC9HjC86leQodMMT84g2A1wjValIN', 'promoter', NULL, 'active', NULL, NULL, NULL, 'approved', '2026-06-20 11:27:09', '2026-06-20 11:27:09'),
(3, 'Buyer', 'buyer@gmail.com', '2026-06-20 11:27:09', '$2y$12$yz209pIFzeGItvXRdY0XbOuDpI3e0w04fsDW0pwu58vzdDNnmDWVm', NULL, 'buyer', NULL, 'active', '7654321234568888', NULL, '081213467582', 'none', '2026-06-20 11:27:09', '2026-06-20 11:47:09'),
(4, 'Promoter2', 'promoter2@gmail.com', '2026-06-20 11:27:09', '$2y$12$WSy8hgquzpcbmF.g..CI1O9VanUOfc.5j8VGreF89w1RtrYvoCi3C', NULL, 'promoter', NULL, 'active', NULL, NULL, NULL, 'approved', '2026-06-20 11:27:09', '2026-06-20 11:27:09'),
(5, 'Promoter3', 'promoter3@gmail.com', '2026-06-20 11:27:09', '$2y$12$fME2CYibnDsbPHqwkuGag.vf5BAcSPQpoAaWVAFKp.TKAeKgm9fHW', NULL, 'promoter', NULL, 'active', NULL, NULL, NULL, 'approved', '2026-06-20 11:27:10', '2026-06-20 11:27:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_promoter_id_foreign` (`promoter_id`);

--
-- Indexes for table `event_galleries`
--
ALTER TABLE `event_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_galleries_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_events_id_foreign` (`events_id`),
  ADD KEY `orders_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_types_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD KEY `users_role_index` (`role`),
  ADD KEY `users_status_index` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_galleries`
--
ALTER TABLE `event_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_types`
--
ALTER TABLE `ticket_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_promoter_id_foreign` FOREIGN KEY (`promoter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_galleries`
--
ALTER TABLE `event_galleries`
  ADD CONSTRAINT `event_galleries_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_events_id_foreign` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD CONSTRAINT `ticket_types_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
