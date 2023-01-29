-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.6.11-MariaDB - MariaDB Server
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla idesa.ciudades
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.ciudades: ~0 rows (aproximadamente)
DELETE FROM `ciudades`;

-- Volcando estructura para tabla idesa.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` text DEFAULT NULL,
  `apellidos` text DEFAULT NULL,
  `correo` text DEFAULT NULL,
  `domicilio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `nombres` (`nombres`),
  FULLTEXT KEY `apellidos` (`apellidos`),
  FULLTEXT KEY `correo` (`correo`),
  FULLTEXT KEY `domicilio` (`domicilio`)
) ENGINE=InnoDB AUTO_INCREMENT=123465 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla idesa.clientes: ~5 rows (aproximadamente)
DELETE FROM `clientes`;
INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `correo`, `domicilio`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(123456, 'Felix', 'Estigarribia', 'felix.estigarribia@gmail,com', 'En al gun lugar del Metaverso', NULL, '2023-01-27 04:07:36', NULL),
	(123457, 'Richard', 'Arce', 'rifarca@gmail.com', 'Herrera 3145 c/ JF kennedy', '2023-01-26 18:33:21', '2023-01-26 18:33:21', NULL),
	(123458, 'Jose', 'Fernandez', 'jkose.fernandez@gmail.com', 'algun lugar del MetAVERSO', '2023-01-26 19:04:56', '2023-01-26 19:04:56', NULL),
	(123459, 'Jose', 'Fernandez', 'jkose.fernandez@gmail.com', 'algun lugar del MetAVERSO', '2023-01-26 20:17:15', '2023-01-26 20:17:15', NULL),
	(123460, 'Dario', 'Lopez', 'dario.lopez@gmail.com', 'en algun lugar del meta verso', '2023-01-26 20:18:00', '2023-01-26 20:18:00', NULL),
	(123461, 'Eduardo', 'Santoro', 'eduardo.santoro@gmail.com', 'en algun lugar del meta verso', '2023-01-27 03:17:45', '2023-01-27 03:17:45', NULL),
	(123462, 'Hector', 'Gimenez', 'hector.gimenez@gmail.com', 'en algun lugar del meta verso', '2023-01-27 03:18:51', '2023-01-27 03:18:51', NULL),
	(123463, 'Carlos', 'Gimenez', 'carlos.gimenez@gmail,com', 'en algun lugar del meta verso', '2023-01-27 03:27:16', '2023-01-27 04:05:46', NULL),
	(123464, 'Luis', 'Cardenas', 'luis.cardenas@gmail.com', 'en algun lugar del meta verso', '2023-01-27 04:10:47', '2023-01-27 04:10:47', NULL);

-- Volcando estructura para tabla idesa.cuotas
CREATE TABLE IF NOT EXISTS `cuotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clienteID` int(11) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `nro` int(11) NOT NULL,
  `precio` varchar(255) NOT NULL,
  `vencimiento` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.cuotas: ~7 rows (aproximadamente)
DELETE FROM `cuotas`;
INSERT INTO `cuotas` (`id`, `clienteID`, `lote`, `nro`, `precio`, `vencimiento`, `status`, `created_at`, `updated_at`) VALUES
	(1, 123456, '00145', 1, '150000', '2022-09-01', 1, NULL, NULL),
	(2, 135486, '00146', 2, '110000', NULL, 1, NULL, NULL),
	(3, 135486, '00147', 3, '160000', NULL, 1, NULL, NULL),
	(4, 123456, '00148', 4, '130000', '2022-10-01', 1, NULL, NULL),
	(5, 123456, '00148', 5, '145000', NULL, 1, NULL, NULL),
	(6, 123456, '00148', 6, '190000', '2023-01-01', 1, NULL, NULL),
	(7, 123456, '00148', 7, '190000', '2023-02-01', 0, NULL, NULL);

-- Volcando estructura para tabla idesa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;

-- Volcando estructura para tabla idesa.fracciones
CREATE TABLE IF NOT EXISTS `fracciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.fracciones: ~0 rows (aproximadamente)
DELETE FROM `fracciones`;

-- Volcando estructura para tabla idesa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.migrations: ~9 rows (aproximadamente)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2023_01_25_025808_create_lotes_table', 1),
	(5, '2023_01_25_050719_create_pagos_table', 1),
	(6, '2023_01_25_051700_create_pagos_detalles_table', 1),
	(7, '2023_01_25_051757_create_fracciones_table', 1),
	(8, '2023_01_25_051833_create_ciudades_table', 1),
	(9, '2023_01_25_051846_create_zonas_table', 1),
	(10, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- Volcando estructura para tabla idesa.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.pagos: ~0 rows (aproximadamente)
DELETE FROM `pagos`;

-- Volcando estructura para tabla idesa.pagos_detalles
CREATE TABLE IF NOT EXISTS `pagos_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.pagos_detalles: ~0 rows (aproximadamente)
DELETE FROM `pagos_detalles`;

-- Volcando estructura para tabla idesa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;

-- Volcando estructura para tabla idesa.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.personal_access_tokens: ~5 rows (aproximadamente)
DELETE FROM `personal_access_tokens`;

-- Volcando estructura para tabla idesa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'IDESA', 'desafio@idesa.com.py', NULL, '$2y$10$ChYtFQ1qGRvI8rmqN0GORu7EUQ/dlYU0uXcpFgDVaEiJOj94fdFuS', NULL, NULL, NULL),
	(3, 'Desafio Idesa', 'rifarca@gmail.com', NULL, '$2y$10$vl29UMVDcdpSluVVT8ivW.FhEDywrGnwO18X2u3cCkDOhakUo5kxi', NULL, NULL, NULL),
	(4, 'Valentin Idesa', 'valentin.zaracho@idesa.com.py', NULL, '$2y$10$S5q6VuVbpslsQ7Fe5TuefOkX2RTud0pv9k/OfU2u3v.2tQPBWIOzi', NULL, NULL, NULL),
	(5, 'Martin Martinez', 'martin.martinez@idesa.com.py', NULL, '$2y$10$0/S/9tdiW7hMzs30UMKn7.X4hGNkhn5Xr3F/C.YywUJrkxbiyQjoi', NULL, NULL, NULL);

-- Volcando estructura para tabla idesa.zonas
CREATE TABLE IF NOT EXISTS `zonas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla idesa.zonas: ~0 rows (aproximadamente)
DELETE FROM `zonas`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
