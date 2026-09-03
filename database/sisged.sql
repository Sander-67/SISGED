-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 03, 2026 at 01:52 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisged`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdministrador` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuarioAdministrador` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailAdministrador` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senhaAdministrador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `administrador_emailadministrador_unique` (`emailAdministrador`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `usuarioAdministrador`, `emailAdministrador`, `senhaAdministrador`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@sisged.com', '$2y$12$g4z0IMcGCtnrJdhZc5tmhOpLiPpbYoqmouLXNvVPZBT1jBPajm71y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomeAluno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpfAluno` bigint UNSIGNED NOT NULL,
  `emailAluno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefoneAluno` bigint UNSIGNED DEFAULT NULL,
  `senhaAluno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idAluno`),
  UNIQUE KEY `aluno_cpfaluno_unique` (`cpfAluno`),
  UNIQUE KEY `aluno_emailaluno_unique` (`emailAluno`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE IF NOT EXISTS `aula` (
  `idAula` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Administrador_idAdministrador` bigint UNSIGNED DEFAULT NULL,
  `Aluno_idAluno` bigint UNSIGNED DEFAULT NULL,
  `Materia_idMateria` bigint UNSIGNED DEFAULT NULL,
  `Turma_idTurma` bigint UNSIGNED DEFAULT NULL,
  `dataAula` date DEFAULT NULL,
  `horarioinicioAula` time DEFAULT NULL,
  `horariofimAula` time DEFAULT NULL,
  `duracaoAula` time DEFAULT NULL,
  `tipoAula` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusAula` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idAula`),
  KEY `aula_administrador_idadministrador_foreign` (`Administrador_idAdministrador`),
  KEY `aula_aluno_idaluno_foreign` (`Aluno_idAluno`),
  KEY `aula_materia_idmateria_foreign` (`Materia_idMateria`),
  KEY `aula_turma_idturma_foreign` (`Turma_idTurma`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Turma_idTurma` bigint UNSIGNED DEFAULT NULL,
  `nomeCurso` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modalidadeCurso` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargahorariaCurso` int DEFAULT NULL,
  `nivelCurso` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `curso_turma_idturma_foreign` (`Turma_idTurma`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instrutor`
--

DROP TABLE IF EXISTS `instrutor`;
CREATE TABLE IF NOT EXISTS `instrutor` (
  `idInstrutor` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Aula_idAula` bigint UNSIGNED DEFAULT NULL,
  `nomeInstrutor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpfInstrutor` bigint UNSIGNED DEFAULT NULL,
  `emailInstrutor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefoneInstrutor` bigint UNSIGNED DEFAULT NULL,
  `areaInstrutor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusInstrutor` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idInstrutor`),
  KEY `instrutor_aula_idaula_foreign` (`Aula_idAula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `idMateria` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `siglaMateria` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomeMateria` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargahorariaMateria` time DEFAULT NULL,
  `ementaMateria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idMateria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2024_01_01_000000_create_turma_table', 1),
(4, '2024_01_01_000001_create_alunos_table', 1),
(5, '2024_01_01_000002_create_curso_table', 1),
(6, '2024_01_01_000003_create_administrador_table', 1),
(7, '2024_01_01_000004_create_materia_table', 1),
(8, '2024_01_01_000005_create_aula_table', 1),
(9, '2024_01_01_000006_create_instrutor_table', 1),
(10, '2024_01_01_000007_create_sala_table', 1),
(11, '2026_08_31_202809_add_senha_to_aluno_table', 2),
(12, '2026_08_31_203132_create_personal_access_tokens_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Administrador', 1, 'token-administrador', 'ada8bb28585c646ad0b4adb6dc4ddaa41a0d339b6d1727435bfd1ea4a3f9ed8d', '[\"administrador\"]', NULL, NULL, '2026-08-31 23:57:17', '2026-08-31 23:57:17'),
(2, 'App\\Models\\Administrador', 1, 'token-administrador', '5778b78c6b87d3565d406b873948426039e8deebe8fee777708b82e83ed3b916', '[\"administrador\"]', '2026-09-01 00:12:27', NULL, '2026-09-01 00:07:25', '2026-09-01 00:12:27'),
(3, 'App\\Models\\Aluno', 1, 'token-aluno', 'db9cf93fd87318ed56d1281cbceddc067b0b3187d2e6be786c90b4ec986287ba', '[\"aluno\"]', NULL, NULL, '2026-09-01 00:13:51', '2026-09-01 00:13:51'),
(4, 'App\\Models\\Aluno', 1, 'token-aluno', 'f8a7b7152eb405d137911f37d81e012b11e75984d7c3074c59e94db36ac5acfa', '[\"aluno\"]', NULL, NULL, '2026-09-01 00:17:55', '2026-09-01 00:17:55'),
(5, 'App\\Models\\Aluno', 1, 'token-aluno', '85d10ffa1f03df9de8c1ac6d6affcb95492295507bcda411af2146c79d0e68dc', '[\"aluno\"]', '2026-09-01 00:25:24', NULL, '2026-09-01 00:24:23', '2026-09-01 00:25:24'),
(6, 'App\\Models\\Administrador', 1, 'token-administrador', 'fe2e1b4066e7140fefd124eef0af23f9bbce1766de87cb5421d5526312a5794d', '[\"administrador\"]', '2026-09-02 23:39:51', NULL, '2026-09-02 23:28:12', '2026-09-02 23:39:51'),
(7, 'App\\Models\\Administrador', 1, 'token-administrador', '371477e87c27ba8938490dc916bde9372ce8e23bd96c4ff45068a3b38f1e5698', '[\"administrador\"]', '2026-09-03 04:11:15', NULL, '2026-09-02 23:52:12', '2026-09-03 04:11:15'),
(8, 'App\\Models\\Administrador', 1, 'token-administrador', '55b6c63b2751becd275a42f29230d05372ed9c0dbab11bfab966addb3f5d34b0', '[\"administrador\"]', NULL, NULL, '2026-09-03 04:13:50', '2026-09-03 04:13:50'),
(9, 'App\\Models\\Administrador', 1, 'token-administrador', '9f4ae7b6a84612073145de7d3f3ab02daaeef464cbf278b3d382ce94ca676149', '[\"administrador\"]', '2026-09-03 04:36:51', NULL, '2026-09-03 04:25:16', '2026-09-03 04:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `idSala` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Aula_idAula` bigint UNSIGNED DEFAULT NULL,
  `nomeSala` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidadeSala` int DEFAULT NULL,
  `tipoAula` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocoandarAula` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idSala`),
  KEY `sala_aula_idaula_foreign` (`Aula_idAula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DBj3MlkrGgNqhLVRo7Uw6Y5NQCWWZpCJX7mQ2glj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.134.0 Chrome/148.0.7778.280 Electron/42.8.1 Safari/537.36', 'eyJfdG9rZW4iOiJVbmNRVk1rZndhRW53OHlkR2pGaW5FV1AxWjJQNDBEdzg1TmFtWEd2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788207784),
('m5R9ZX4gbuBOV4ank3NobSRvqxpG2mbPYjzD9ugp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJpQ0lxbTU0MGFlRzdSTzJueGN2RldSY1FZS1AySHZLTlRTVno5b0ppIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788207791);

-- --------------------------------------------------------

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `idTurma` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigoTurma` int DEFAULT NULL,
  `turnoTurma` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datainicioTurma` date DEFAULT NULL,
  `datafimTurma` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idTurma`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
