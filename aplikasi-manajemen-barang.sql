-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 01:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi-manajemen-barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_manajer` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_admin` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `history_barang_masuk_pusat`
--

CREATE TABLE `history_barang_masuk_pusat` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_supplier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(25, '2019_08_19_000000_create_failed_jobs_table', 1),
(26, '2020_11_07_031318_create_permission_tables', 1),
(27, '2021_02_16_174209_create_media_table', 1),
(28, '2021_11_03_161418_create_settings_table', 1),
(29, '2023_03_02_102155_create_kategori_barang_table', 1),
(30, '2023_03_02_102203_create_supplier_table', 1),
(31, '2023_03_02_102235_create_stok_barang_cabang_table', 1),
(32, '2023_03_02_102235_create_stok_barang_outlet_table', 1),
(33, '2023_03_02_102235_create_stok_barang_pusat_table', 1),
(34, '2023_03_02_102250_create_permintaan_barang_cabang_table', 1),
(35, '2023_03_02_102250_create_permintaan_barang_pusat_table', 1),
(36, '2023_03_02_102250_create_permintaan_retur_cabang_table', 1),
(37, '2023_03_02_102250_create_permintaan_retur_pusat_table', 1),
(38, '2023_03_02_102558_create_cabang_table', 1),
(39, '2023_03_02_103842_create_barang_table', 1),
(40, '2023_03_03_122436_create_outlet_table', 1),
(41, '2023_03_03_131116_create_table_history_pusat_barang_masuk', 1),
(42, '2023_03_05_005257_create_transaksi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
('989c868c-46ee-4d58-9de7-f1ba9419e52c', 'App\\Models\\User', '989c868e-2023-481f-8f84-b7a4c94eade6');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_supervisor` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cabang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang_cabang`
--

CREATE TABLE `permintaan_barang_cabang` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_outlet` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang_pusat`
--

CREATE TABLE `permintaan_barang_pusat` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cabang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_retur_cabang`
--

CREATE TABLE `permintaan_retur_cabang` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_outlet` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_retur_pusat`
--

CREATE TABLE `permintaan_retur_pusat` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cabang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
('989c8679-af8b-4707-a56d-4b9ba25757b7', 'view_users', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-b142-4cb9-aca2-cb1c84f42e99', 'add_users', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-b2e6-4a31-b681-2af762fb2661', 'edit_users', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-b4e7-4459-a98c-7ee998ad7dc8', 'delete_users', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-b67e-41b4-b581-d1438304c801', 'view_roles', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-b856-41a6-9bb8-f314e5e8c587', 'add_roles', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-ba03-4169-876f-bd27eb67329f', 'edit_roles', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-bb82-445b-a705-a4462d82c116', 'delete_roles', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-bcf3-4b24-9aff-275127b5e7f6', 'view_settings', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-be9b-43f3-a57d-22f6b07ab9bd', 'add_settings', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-c0fb-467f-801f-bb6badb55822', 'edit_settings', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-c2a4-418a-bd72-e1bb2dda139c', 'delete_settings', 'web', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c86f9-6010-4545-a83c-9e68f4ed1033', 'view_gudang_pusat-supplier', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-695e-4ee4-b4be-4b8ce87cbd59', 'add_gudang_pusat-supplier', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-6e4e-4923-b7c2-941d6f34d4bb', 'edit_gudang_pusat-supplier', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-72cd-42de-afaf-9d47b637b42d', 'delete_gudang_pusat-supplier', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-8e45-4eb0-bcdb-43f3dd3ac0a8', 'view_gudang_pusat-cabang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-931c-459b-a228-a59a738f59f2', 'add_gudang_pusat-cabang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-9778-4430-b87f-c89d72d3e80b', 'edit_gudang_pusat-cabang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-9c1f-4f03-840f-3c94d336c0dd', 'delete_gudang_pusat-cabang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-b2c6-4ab3-93de-b401bc8b6f39', 'view_gudang_pusat-outlet', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-b7a7-41d1-b80d-37f8c3f642ee', 'add_gudang_pusat-outlet', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-bbae-4486-b8dd-b7e8a831a6fb', 'edit_gudang_pusat-outlet', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-c0a7-4af3-b97f-34587198017a', 'delete_gudang_pusat-outlet', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-d825-45c6-8f17-f63e35c6649c', 'view_gudang_pusat-kategori_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-dcb6-4e89-a8f5-a79aa5db96f1', 'add_gudang_pusat-kategori_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-e166-4d9a-b733-2111d389f155', 'edit_gudang_pusat-kategori_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-e5cc-4411-a23e-1e6313e2d21f', 'delete_gudang_pusat-kategori_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86f9-fe61-44c5-a5e0-478be712082e', 'view_gudang_pusat-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-0381-4792-808d-d9e4f5c35a73', 'add_gudang_pusat-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-07bc-421d-aa53-ee0baa0a6342', 'edit_gudang_pusat-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-0d15-4ecf-b357-915aa3db94ff', 'delete_gudang_pusat-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-24e3-4cd7-b488-29328d7db00d', 'view_gudang_pusat-permintaan_order', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-2983-4b5b-bf5b-f7b13cf047a6', 'add_gudang_pusat-permintaan_order', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-2e2e-4ccd-9245-5899ee6369b0', 'edit_gudang_pusat-permintaan_order', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-3288-4b1b-9581-4a8961ecc206', 'delete_gudang_pusat-permintaan_order', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-4ab6-417c-be42-224b0ba487e6', 'view_gudang_pusat-permintaan_retur', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-4efc-4b25-8d95-7345fdb93ef8', 'add_gudang_pusat-permintaan_retur', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-5343-452a-927c-90b977a87d33', 'edit_gudang_pusat-permintaan_retur', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-5859-4bb8-94a4-30d4e014fd1c', 'delete_gudang_pusat-permintaan_retur', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-6f01-4c29-95e4-ef77262e9736', 'view_gudang_cabang-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-747b-4775-8457-3a8bd74960f4', 'add_gudang_cabang-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-79d6-4a30-b469-e3c69bbd4a2c', 'edit_gudang_cabang-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-7ed7-46a5-aa35-cc635a4c4f11', 'delete_gudang_cabang-stok_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-94c5-42be-9097-7d796f1e470d', 'view_gudang_cabang-order_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-9968-42c0-9ffd-3e9396e31d52', 'add_gudang_cabang-order_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-9e04-4f6f-8583-3d7f41964985', 'edit_gudang_cabang-order_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-a2c4-4de2-a39e-476e805c7d54', 'delete_gudang_cabang-order_barang', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-ba4f-4677-b8b0-483c24af4646', 'view_gudang_cabang-permintaan_order', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-be47-44cc-af89-af5d76a6dd4c', 'add_gudang_cabang-permintaan_order', 'web', '2023-03-04 18:41:08', '2023-03-04 18:41:08'),
('989c86fa-c303-432c-8429-0e5ff39f8fc2', 'edit_gudang_cabang-permintaan_order', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fa-c6d3-4711-bf6c-aabd9ddb586d', 'delete_gudang_cabang-permintaan_order', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fa-e031-4f64-9b7b-ec4c7004141c', 'view_gudang_cabang-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fa-e4e1-4eb7-8fe7-67e047a45557', 'add_gudang_cabang-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fa-e91e-4993-b175-f2420bb01757', 'edit_gudang_cabang-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fa-edc4-455f-bcc0-eb7aeb4641b0', 'delete_gudang_cabang-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-07d6-48ec-bc2e-456b11dd0c3b', 'view_gudang_cabang-permintaan_retur', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-0c2e-40b7-8dbf-663d793dec30', 'add_gudang_cabang-permintaan_retur', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-10b9-4c9e-930d-350fdaed5695', 'edit_gudang_cabang-permintaan_retur', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-147a-4ca0-b4ba-2c147edfca6e', 'delete_gudang_cabang-permintaan_retur', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-29f3-46a3-b61f-05847454819e', 'view_outlet-stok_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-2e6a-4b02-9dd8-8947bb8813e3', 'add_outlet-stok_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-3324-470d-b78d-17dc71062516', 'edit_outlet-stok_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-37cc-467c-8e3b-82c64fc9ac7a', 'delete_outlet-stok_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-5311-4c41-99a7-2b66efd9bc93', 'view_outlet-transaksi', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-5765-400b-8e0d-96a61a593d0d', 'add_outlet-transaksi', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-5b79-4035-927d-4a46a56eb248', 'edit_outlet-transaksi', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-6023-4022-be2a-12dec32ab580', 'delete_outlet-transaksi', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-7a98-467c-a28a-12fb1ddf4a99', 'view_outlet-order_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-7eff-4100-b308-21f4d9e89ca2', 'add_outlet-order_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-835c-46f1-a696-2b5e1f7132a3', 'edit_outlet-order_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-882c-4d67-bf5a-eb4ae9ceb5c8', 'delete_outlet-order_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-a25c-444e-9c28-ba5f53f18445', 'view_outlet-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-a5a3-4759-8cbb-015c17da95a2', 'add_outlet-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-a98b-4727-9828-f8bb10678f05', 'edit_outlet-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09'),
('989c86fb-ae20-4709-bacc-6b999e69c1f3', 'delete_outlet-retur_barang', 'web', '2023-03-04 18:41:09', '2023-03-04 18:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
('989c868c-46ee-4d58-9de7-f1ba9419e52c', 'Admin', 'web', '2023-03-04 18:39:56', '2023-03-04 18:39:56'),
('989c8763-2f1d-44d8-a017-dab329a9a1a6', 'Admin Pusat', 'web', '2023-03-04 18:42:17', '2023-03-04 18:42:17'),
('989c87a2-9fa7-4530-ba02-1c70f1da67a2', 'Manajer Pusat', 'web', '2023-03-04 18:42:59', '2023-03-04 18:42:59'),
('989c87d1-85fa-4a24-9c3c-bccafeaa85c0', 'Manajer Cabang', 'web', '2023-03-04 18:43:29', '2023-03-04 18:43:29'),
('989c8816-987b-4b72-adec-1ffd0a41e4ac', 'Admin Cabang', 'web', '2023-03-04 18:44:15', '2023-03-04 18:44:15'),
('989c8839-8517-42ea-9c7e-751089e15468', 'Supervisor Outlet', 'web', '2023-03-04 18:44:37', '2023-03-04 18:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
('989c8679-af8b-4707-a56d-4b9ba25757b7', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-b142-4cb9-aca2-cb1c84f42e99', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-b2e6-4a31-b681-2af762fb2661', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-b4e7-4459-a98c-7ee998ad7dc8', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-b67e-41b4-b581-d1438304c801', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-b856-41a6-9bb8-f314e5e8c587', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-ba03-4169-876f-bd27eb67329f', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-bb82-445b-a705-a4462d82c116', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-bcf3-4b24-9aff-275127b5e7f6', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-be9b-43f3-a57d-22f6b07ab9bd', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-c0fb-467f-801f-bb6badb55822', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-c2a4-418a-bd72-e1bb2dda139c', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-6010-4545-a83c-9e68f4ed1033', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-695e-4ee4-b4be-4b8ce87cbd59', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-6e4e-4923-b7c2-941d6f34d4bb', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-72cd-42de-afaf-9d47b637b42d', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-8e45-4eb0-bcdb-43f3dd3ac0a8', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-931c-459b-a228-a59a738f59f2', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-9778-4430-b87f-c89d72d3e80b', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-9c1f-4f03-840f-3c94d336c0dd', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-b2c6-4ab3-93de-b401bc8b6f39', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-b7a7-41d1-b80d-37f8c3f642ee', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-bbae-4486-b8dd-b7e8a831a6fb', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-c0a7-4af3-b97f-34587198017a', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-d825-45c6-8f17-f63e35c6649c', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-dcb6-4e89-a8f5-a79aa5db96f1', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-e166-4d9a-b733-2111d389f155', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-e5cc-4411-a23e-1e6313e2d21f', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86f9-fe61-44c5-a5e0-478be712082e', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-0381-4792-808d-d9e4f5c35a73', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-07bc-421d-aa53-ee0baa0a6342', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-0d15-4ecf-b357-915aa3db94ff', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-24e3-4cd7-b488-29328d7db00d', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-2983-4b5b-bf5b-f7b13cf047a6', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-2e2e-4ccd-9245-5899ee6369b0', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-3288-4b1b-9581-4a8961ecc206', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-4ab6-417c-be42-224b0ba487e6', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-4efc-4b25-8d95-7345fdb93ef8', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-5343-452a-927c-90b977a87d33', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-5859-4bb8-94a4-30d4e014fd1c', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-6f01-4c29-95e4-ef77262e9736', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-747b-4775-8457-3a8bd74960f4', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-79d6-4a30-b469-e3c69bbd4a2c', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-7ed7-46a5-aa35-cc635a4c4f11', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-94c5-42be-9097-7d796f1e470d', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-9968-42c0-9ffd-3e9396e31d52', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-9e04-4f6f-8583-3d7f41964985', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-a2c4-4de2-a39e-476e805c7d54', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-ba4f-4677-b8b0-483c24af4646', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-be47-44cc-af89-af5d76a6dd4c', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-c303-432c-8429-0e5ff39f8fc2', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-c6d3-4711-bf6c-aabd9ddb586d', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-e031-4f64-9b7b-ec4c7004141c', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-e4e1-4eb7-8fe7-67e047a45557', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-e91e-4993-b175-f2420bb01757', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fa-edc4-455f-bcc0-eb7aeb4641b0', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-07d6-48ec-bc2e-456b11dd0c3b', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-0c2e-40b7-8dbf-663d793dec30', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-10b9-4c9e-930d-350fdaed5695', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-147a-4ca0-b4ba-2c147edfca6e', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-29f3-46a3-b61f-05847454819e', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-2e6a-4b02-9dd8-8947bb8813e3', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-3324-470d-b78d-17dc71062516', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-37cc-467c-8e3b-82c64fc9ac7a', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-5311-4c41-99a7-2b66efd9bc93', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-5765-400b-8e0d-96a61a593d0d', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-5b79-4035-927d-4a46a56eb248', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-6023-4022-be2a-12dec32ab580', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-7a98-467c-a28a-12fb1ddf4a99', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-7eff-4100-b308-21f4d9e89ca2', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-835c-46f1-a696-2b5e1f7132a3', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-882c-4d67-bf5a-eb4ae9ceb5c8', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-a25c-444e-9c28-ba5f53f18445', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-a5a3-4759-8cbb-015c17da95a2', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-a98b-4727-9828-f8bb10678f05', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c86fb-ae20-4709-bacc-6b999e69c1f3', '989c868c-46ee-4d58-9de7-f1ba9419e52c'),
('989c8679-af8b-4707-a56d-4b9ba25757b7', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c8679-b142-4cb9-aca2-cb1c84f42e99', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c8679-b2e6-4a31-b681-2af762fb2661', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c8679-b4e7-4459-a98c-7ee998ad7dc8', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-6010-4545-a83c-9e68f4ed1033', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-695e-4ee4-b4be-4b8ce87cbd59', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-6e4e-4923-b7c2-941d6f34d4bb', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-72cd-42de-afaf-9d47b637b42d', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-8e45-4eb0-bcdb-43f3dd3ac0a8', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-931c-459b-a228-a59a738f59f2', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-9778-4430-b87f-c89d72d3e80b', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-9c1f-4f03-840f-3c94d336c0dd', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-b2c6-4ab3-93de-b401bc8b6f39', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-b7a7-41d1-b80d-37f8c3f642ee', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-bbae-4486-b8dd-b7e8a831a6fb', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-c0a7-4af3-b97f-34587198017a', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-d825-45c6-8f17-f63e35c6649c', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-dcb6-4e89-a8f5-a79aa5db96f1', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-e166-4d9a-b733-2111d389f155', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-e5cc-4411-a23e-1e6313e2d21f', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86f9-fe61-44c5-a5e0-478be712082e', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-0381-4792-808d-d9e4f5c35a73', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-07bc-421d-aa53-ee0baa0a6342', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-0d15-4ecf-b357-915aa3db94ff', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-24e3-4cd7-b488-29328d7db00d', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-2983-4b5b-bf5b-f7b13cf047a6', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-2e2e-4ccd-9245-5899ee6369b0', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-3288-4b1b-9581-4a8961ecc206', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-4ab6-417c-be42-224b0ba487e6', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-4efc-4b25-8d95-7345fdb93ef8', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-5343-452a-927c-90b977a87d33', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c86fa-5859-4bb8-94a4-30d4e014fd1c', '989c8763-2f1d-44d8-a017-dab329a9a1a6'),
('989c8679-af8b-4707-a56d-4b9ba25757b7', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c8679-b142-4cb9-aca2-cb1c84f42e99', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c8679-b2e6-4a31-b681-2af762fb2661', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c8679-b4e7-4459-a98c-7ee998ad7dc8', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-6010-4545-a83c-9e68f4ed1033', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-695e-4ee4-b4be-4b8ce87cbd59', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-6e4e-4923-b7c2-941d6f34d4bb', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-72cd-42de-afaf-9d47b637b42d', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-8e45-4eb0-bcdb-43f3dd3ac0a8', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-931c-459b-a228-a59a738f59f2', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-9778-4430-b87f-c89d72d3e80b', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-9c1f-4f03-840f-3c94d336c0dd', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-b2c6-4ab3-93de-b401bc8b6f39', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-b7a7-41d1-b80d-37f8c3f642ee', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-bbae-4486-b8dd-b7e8a831a6fb', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-c0a7-4af3-b97f-34587198017a', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-d825-45c6-8f17-f63e35c6649c', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-dcb6-4e89-a8f5-a79aa5db96f1', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-e166-4d9a-b733-2111d389f155', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-e5cc-4411-a23e-1e6313e2d21f', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86f9-fe61-44c5-a5e0-478be712082e', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-0381-4792-808d-d9e4f5c35a73', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-07bc-421d-aa53-ee0baa0a6342', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-0d15-4ecf-b357-915aa3db94ff', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-24e3-4cd7-b488-29328d7db00d', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-2983-4b5b-bf5b-f7b13cf047a6', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-2e2e-4ccd-9245-5899ee6369b0', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-3288-4b1b-9581-4a8961ecc206', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-4ab6-417c-be42-224b0ba487e6', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-4efc-4b25-8d95-7345fdb93ef8', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-5343-452a-927c-90b977a87d33', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-5859-4bb8-94a4-30d4e014fd1c', '989c87a2-9fa7-4530-ba02-1c70f1da67a2'),
('989c86fa-6f01-4c29-95e4-ef77262e9736', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-747b-4775-8457-3a8bd74960f4', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-79d6-4a30-b469-e3c69bbd4a2c', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-7ed7-46a5-aa35-cc635a4c4f11', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-94c5-42be-9097-7d796f1e470d', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-9968-42c0-9ffd-3e9396e31d52', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-9e04-4f6f-8583-3d7f41964985', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-a2c4-4de2-a39e-476e805c7d54', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-ba4f-4677-b8b0-483c24af4646', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-be47-44cc-af89-af5d76a6dd4c', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-c303-432c-8429-0e5ff39f8fc2', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-c6d3-4711-bf6c-aabd9ddb586d', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-e031-4f64-9b7b-ec4c7004141c', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-e4e1-4eb7-8fe7-67e047a45557', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-e91e-4993-b175-f2420bb01757', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-edc4-455f-bcc0-eb7aeb4641b0', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fb-07d6-48ec-bc2e-456b11dd0c3b', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fb-0c2e-40b7-8dbf-663d793dec30', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fb-10b9-4c9e-930d-350fdaed5695', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fb-147a-4ca0-b4ba-2c147edfca6e', '989c87d1-85fa-4a24-9c3c-bccafeaa85c0'),
('989c86fa-6f01-4c29-95e4-ef77262e9736', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-747b-4775-8457-3a8bd74960f4', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-79d6-4a30-b469-e3c69bbd4a2c', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-7ed7-46a5-aa35-cc635a4c4f11', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-94c5-42be-9097-7d796f1e470d', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-9968-42c0-9ffd-3e9396e31d52', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-9e04-4f6f-8583-3d7f41964985', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-a2c4-4de2-a39e-476e805c7d54', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-ba4f-4677-b8b0-483c24af4646', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-be47-44cc-af89-af5d76a6dd4c', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-c303-432c-8429-0e5ff39f8fc2', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-c6d3-4711-bf6c-aabd9ddb586d', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-e031-4f64-9b7b-ec4c7004141c', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-e4e1-4eb7-8fe7-67e047a45557', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-e91e-4993-b175-f2420bb01757', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fa-edc4-455f-bcc0-eb7aeb4641b0', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fb-07d6-48ec-bc2e-456b11dd0c3b', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fb-0c2e-40b7-8dbf-663d793dec30', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fb-10b9-4c9e-930d-350fdaed5695', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fb-147a-4ca0-b4ba-2c147edfca6e', '989c8816-987b-4b72-adec-1ffd0a41e4ac'),
('989c86fb-29f3-46a3-b61f-05847454819e', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-2e6a-4b02-9dd8-8947bb8813e3', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-3324-470d-b78d-17dc71062516', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-37cc-467c-8e3b-82c64fc9ac7a', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-5311-4c41-99a7-2b66efd9bc93', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-5765-400b-8e0d-96a61a593d0d', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-5b79-4035-927d-4a46a56eb248', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-6023-4022-be2a-12dec32ab580', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-7a98-467c-a28a-12fb1ddf4a99', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-7eff-4100-b308-21f4d9e89ca2', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-835c-46f1-a696-2b5e1f7132a3', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-882c-4d67-bf5a-eb4ae9ceb5c8', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-a25c-444e-9c28-ba5f53f18445', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-a5a3-4759-8cbb-015c17da95a2', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-a98b-4727-9828-f8bb10678f05', '989c8839-8517-42ea-9c7e-751089e15468'),
('989c86fb-ae20-4709-bacc-6b999e69c1f3', '989c8839-8517-42ea-9c7e-751089e15468');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `string_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_value` longtext COLLATE utf8mb4_unicode_ci,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` bigint DEFAULT NULL,
  `decimal_value` decimal(15,2) DEFAULT NULL,
  `validation_rules` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `category`, `setting_type`, `setting_key`, `name`, `string_value`, `file_value`, `text_value`, `boolean_value`, `integer_value`, `decimal_value`, `validation_rules`, `created_at`, `updated_at`) VALUES
('989c8679-9c64-4549-9232-68eeefadcc93', 'general', 'string', 'general_app_name', 'Application Name', 'Laravel Starter', NULL, NULL, NULL, NULL, NULL, 'required', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-a40f-4196-bd9d-777a7db03e52', 'general', 'string', 'general_app_description', 'App Description', 'Laravel Starter Application', NULL, NULL, NULL, NULL, NULL, '', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-a5b1-4569-abac-b804dd14d52c', 'general', 'file', 'general_app_logo', 'App Logo', NULL, '', NULL, NULL, NULL, NULL, 'image|mimes:jpeg,png,jpg,gif|max:4096', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-a83b-43d4-bbd9-c7563d0496ac', 'general', 'string', 'general_email_contact', 'Email Contact', 'contact@example.com', NULL, NULL, NULL, NULL, NULL, 'required|email', '2023-03-04 18:39:44', '2023-03-04 18:39:44'),
('989c8679-aa56-42b3-8bb5-da2c22444758', 'general', 'string', 'general_phone', 'Phone', '+62234234123', NULL, NULL, NULL, NULL, NULL, 'required', '2023-03-04 18:39:44', '2023-03-04 18:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang_cabang`
--

CREATE TABLE `stok_barang_cabang` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cabang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang_outlet`
--

CREATE TABLE `stok_barang_outlet` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_outlet` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang_pusat`
--

CREATE TABLE `stok_barang_pusat` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_outlet` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
('989c868e-2023-481f-8f84-b7a4c94eade6', 'Admin', 'admin@gmail.com', '2023-03-04 18:39:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'xNL8UB5mcECtzi719EN25mq9BQgt4mwlds8rRTxynz5KLnPX6mGFh3VtZ2Pw', '2023-03-04 18:39:57', '2023-03-04 18:39:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id_kategori_index` (`id_kategori`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cabang_id_manajer_unique` (`id_manajer`),
  ADD UNIQUE KEY `cabang_id_admin_unique` (`id_admin`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_barang_masuk_pusat`
--
ALTER TABLE `history_barang_masuk_pusat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `outlet_id_supervisor_unique` (`id_supervisor`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permintaan_barang_cabang`
--
ALTER TABLE `permintaan_barang_cabang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_barang_cabang_id_barang_index` (`id_barang`),
  ADD KEY `permintaan_barang_cabang_id_outlet_index` (`id_outlet`);

--
-- Indexes for table `permintaan_barang_pusat`
--
ALTER TABLE `permintaan_barang_pusat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_barang_pusat_id_barang_index` (`id_barang`),
  ADD KEY `permintaan_barang_pusat_id_cabang_index` (`id_cabang`);

--
-- Indexes for table `permintaan_retur_cabang`
--
ALTER TABLE `permintaan_retur_cabang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_retur_cabang_id_barang_index` (`id_barang`),
  ADD KEY `permintaan_retur_cabang_id_outlet_index` (`id_outlet`);

--
-- Indexes for table `permintaan_retur_pusat`
--
ALTER TABLE `permintaan_retur_pusat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_retur_pusat_id_barang_index` (`id_barang`),
  ADD KEY `permintaan_retur_pusat_id_cabang_index` (`id_cabang`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_setting_key_unique` (`setting_key`),
  ADD KEY `settings_category_index` (`category`),
  ADD KEY `settings_setting_type_index` (`setting_type`);

--
-- Indexes for table `stok_barang_cabang`
--
ALTER TABLE `stok_barang_cabang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_barang_cabang_id_barang_index` (`id_barang`),
  ADD KEY `stok_barang_cabang_id_cabang_index` (`id_cabang`);

--
-- Indexes for table `stok_barang_outlet`
--
ALTER TABLE `stok_barang_outlet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_barang_outlet_id_barang_index` (`id_barang`),
  ADD KEY `stok_barang_outlet_id_outlet_index` (`id_outlet`);

--
-- Indexes for table `stok_barang_pusat`
--
ALTER TABLE `stok_barang_pusat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_barang_pusat_id_barang_index` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id_barang_index` (`id_barang`),
  ADD KEY `transaksi_id_outlet_index` (`id_outlet`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
