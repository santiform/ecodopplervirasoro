-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2025 a las 07:21:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `virasoro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `id` bigint(11) NOT NULL,
  `id_paciente` bigint(11) NOT NULL,
  `id_tipo_estudio` bigint(11) NOT NULL,
  `fecha` date NOT NULL,
  `solicitante` varchar(255) NOT NULL,
  `informe` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`id`, `id_paciente`, `id_tipo_estudio`, `fecha`, `solicitante`, `informe`, `created_at`, `updated_at`) VALUES
(27, 134, 3, '2025-03-14', 'El debusón', 'Protocolo de ecografía de abdomen\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at est scelerisque, elementum mi id, lobortis dui. Donec tempor erat eu tellus luctus pharetra. Mauris id nibh in felis elementum condimentum eu id nibh.', '2025-03-13 07:49:17', '2025-03-13 07:49:17'),
(28, 134, 3, '2025-03-22', 'El debusón', 'Protocolo de ecografía de abdomen\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at est scelerisque, elementum mi id, lobortis dui. Donec tempor erat eu tellus luctus pharetra. Mauris id nibh in felis elementum condimentum eu id nibh.', '2025-03-13 07:50:42', '2025-03-13 07:50:42'),
(29, 134, 4, '2025-03-08', 'El debusón', 'Protoclo de Ecografía de partes blandas.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nibh magna, vulputate eu velit sit amet, fermentum fermentum ante. Nulla at neque ipsum. Nulla quis efficitur velit. Duis placerat gravida dolor, a efficitur purus pulvinar at. Morbi ut magna tincidunt, gravida nibh at, vestibulum ipsum. Aenean dictum in libero eget laoreet. In et lectus eget urna feugiat fringilla non non velit. Pellentesque placerat sapien lectus, ut tempus eros tincidunt id. Nullam finibus magna sapien. Vivamus at euismod diam. Curabitur vitae lectus tellus. Sed congue enim ut magna fringilla ullamcorper.', '2025-03-13 07:51:42', '2025-03-13 07:51:42'),
(31, 134, 3, '2025-01-09', 'El debusón', 'Protocolo de ecografía de abdomen\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at est scelerisque, elementum mi id, lobortis dui. Donec tempor erat eu tellus luctus pharetra. Mauris id nibh in felis elementum condimentum eu id nibh.', '2025-03-13 08:43:49', '2025-03-13 08:43:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedias`
--

CREATE TABLE `multimedias` (
  `id` bigint(11) NOT NULL,
  `id_estudio` bigint(11) NOT NULL,
  `url` text NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `multimedias`
--

INSERT INTO `multimedias` (`id`, `id_estudio`, `url`, `tipo`, `created_at`, `updated_at`) VALUES
(32, 27, 'uploads/estudios/27/27(1).png', 'imagen', '2025-03-13 07:49:17', '2025-03-13 07:49:17'),
(33, 28, 'uploads/estudios/28/28(1).png', 'imagen', '2025-03-13 07:50:42', '2025-03-13 07:50:42'),
(34, 29, 'uploads/estudios/29/29(1).mp4', 'video', '2025-03-13 07:51:42', '2025-03-13 07:51:42'),
(37, 31, 'uploads/estudios/31/31(1).mp4', 'video', '2025-03-13 08:43:49', '2025-03-13 08:43:49'),
(38, 31, 'uploads/estudios/31/31(2).png', 'imagen', '2025-03-13 08:43:49', '2025-03-13 08:43:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` bigint(11) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` int(11) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `nacimiento` date NOT NULL,
  `obra_social` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `celular`, `nacimiento`, `obra_social`, `created_at`, `updated_at`) VALUES
(132, 'Díaz', 'Matías', 27567890, '+54 9 11 6789-0123', '1983-05-18', 'Medife', '2025-03-06 04:44:34', '2025-03-10 07:16:56'),
(133, 'Martínez', 'Sofía', 28901234, '+54 9 11 7890-1234', '1987-08-22', 'OSDE', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(134, 'Romero', 'Lucas', 33456789, '+54 9 11 8901-2345', '1999-02-14', 'Galeno', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(135, 'Alvarez', 'Mía', 30123455, '+54 9 11 9012-3456', '1991-04-03', 'SaludPlus', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(136, 'Gómez', 'Tomás', 31234566, '+54 9 11 0123-4567', '1993-07-29', 'IOMA', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(137, 'Torres', 'Emma', 32456788, '+54 9 11 1234-5678', '1997-10-05', 'Swiss Medical', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(138, 'Ruiz', 'Benjamín', 29890122, '+54 9 11 2345-6780', '1984-11-12', 'Sancor Salud', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(139, 'Flores', 'Julieta', 27567889, '+54 9 11 3456-7891', '1986-03-07', 'Medife', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(140, 'Acosta', 'Agustín', 28901233, '+54 9 11 4567-8902', '1989-06-21', 'OSDE', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(141, 'Morales', 'Lucía', 33456788, '+54 9 11 5678-9013', '1998-09-17', 'Galeno', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(142, 'Herrera', 'Juan', 30123454, '+54 9 11 6789-0124', '1994-12-01', 'SaludPlus', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(143, 'Medina', 'Martín', 31234565, '+54 9 11 7890-1235', '1996-02-08', 'IOMA', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(144, 'Giménez', 'Ana', 32456787, '+54 9 11 8901-2346', '2000-05-14', 'Swiss Medical', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(145, 'Paz', 'Santiago', 29890121, '+54 9 11 9012-3457', '1982-07-30', 'Sancor Salud', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(146, 'Rojas', 'Carla', 27567888, '+54 9 11 0123-4568', '1981-11-23', 'Medife', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(147, 'Vargas', 'Pedro', 28901232, '+54 9 11 1234-5679', '1985-01-27', 'OSDE', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(148, 'Benítez', 'Florencia', 33456787, '+54 9 11 2345-6781', '1999-04-19', 'Galeno', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(149, 'Molina', 'Diego', 30123453, '+54 9 11 3456-7892', '1992-08-15', 'SaludPlus', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(150, 'Silva', 'Victoria', 31234564, '+54 9 11 4567-8903', '1990-10-31', 'IOMA', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(151, 'Castro', 'Emanuel', 32456786, '+54 9 11 5678-9014', '1993-12-06', 'Swiss Medical', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(152, 'Ortiz', 'Gabriela', 29890120, '+54 9 11 6789-0125', '1987-03-22', 'Sancor Salud', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(153, 'Chávez', 'Nicolás', 27567887, '+54 9 11 7890-1236', '1986-06-12', 'Medife', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(154, 'Cáceres', 'Melina', 28901231, '+54 9 11 8901-2347', '1991-09-08', 'OSDE', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(155, 'Peralta', 'Francisco', 33456786, '+54 9 11 9012-3458', '1995-11-25', 'Galeno', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(156, 'Figueroa', 'Daniela', 30123452, '+54 9 11 0123-4569', '1984-02-18', 'SaludPlus', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(157, 'Luna', 'Andrés', 31234563, '+54 9 11 1234-5680', '1996-05-04', 'IOMA', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(158, 'Méndez', 'Paula', 32456785, '+54 9 11 2345-6782', '1994-07-13', 'Swiss Medical', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(159, 'Suárez', 'Leandro', 29890119, '+54 9 11 3456-7893', '1997-10-21', 'Sancor Salud', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(160, 'Aguilar', 'Camilo', 27567886, '+54 9 11 4567-8904', '1998-01-05', 'Medife', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(161, 'Navarro', 'Bianca', 28901230, '+54 9 11 5678-9015', '1999-03-09', 'OSDE', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(162, 'Godoy', 'Mariano', 33456785, '+54 9 11 6789-0126', '2000-08-11', 'Galeno', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(163, 'Correa', 'Isabella', 30123451, '+54 9 11 7890-1237', '1985-10-28', 'SaludPlus', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(164, 'Ojeda', 'Axel', 31234562, '+54 9 11 8901-2348', '1993-12-17', 'IOMA', '2025-03-06 04:44:34', '2025-03-06 04:44:34'),
(177, 'Formichelli', 'Jose Pedro', 12326594, '11263654', '1992-06-01', 'Sancor', '2025-03-07 10:10:26', '2025-03-07 10:10:26'),
(178, 'Formichelli', 'Gabriel', 93625362, '1138338669', '1991-06-01', 'IOMA', '2025-03-07 10:11:02', '2025-03-07 10:11:02'),
(181, 'Formichelli', 'Antonio', 26369568, '1138332996', '1946-02-02', 'Sancor', '2025-03-07 10:12:23', '2025-03-07 10:12:23'),
(182, 'Formichelli', 'David', 26563159, '11382659486', '1990-06-01', 'Sancor', '2025-03-07 10:14:32', '2025-03-07 10:14:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oELatqT4k0r8vlsr11DKCGiOjeFRhm1iwHlc2ILY', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNnhBTzVIanVtcWlQZWF0aWR1YnhVMkxjTzlsa2ZPT0lMa081OUpqbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9lY29kb3BwbGVydmlyYXNvcm8vcHVibGljL2VzdHVkaW8vMzEvZGVzY2FyZ2FyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1741844664);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_estudios`
--

CREATE TABLE `tipos_estudios` (
  `id` bigint(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `protocolo` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_estudios`
--

INSERT INTO `tipos_estudios` (`id`, `nombre`, `protocolo`, `created_at`, `updated_at`) VALUES
(3, 'Ecografía de abdomen', 'Protocolo de ecografía de abdomen\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at est scelerisque, elementum mi id, lobortis dui. Donec tempor erat eu tellus luctus pharetra. Mauris id nibh in felis elementum condimentum eu id nibh. ', NULL, NULL),
(4, 'Ecografía de partes blandas', 'Protoclo de Ecografía de partes blandas.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nibh magna, vulputate eu velit sit amet, fermentum fermentum ante. Nulla at neque ipsum. Nulla quis efficitur velit. Duis placerat gravida dolor, a efficitur purus pulvinar at. Morbi ut magna tincidunt, gravida nibh at, vestibulum ipsum. Aenean dictum in libero eget laoreet. In et lectus eget urna feugiat fringilla non non velit. Pellentesque placerat sapien lectus, ut tempus eros tincidunt id. Nullam finibus magna sapien. Vivamus at euismod diam. Curabitur vitae lectus tellus. Sed congue enim ut magna fringilla ullamcorper.', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Santiago Formichelli', 'santiform@gmail.com', NULL, '$2y$12$XdsEAkLF1D2SqhkupwnD5uMDfl1IdZDEM.xfLJIanRYkg9Ivhew76', NULL, NULL, '2025-03-05 03:56:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`,`id_tipo_estudio`),
  ADD KEY `id_tipo_estudio` (`id_tipo_estudio`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multimedias`
--
ALTER TABLE `multimedias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multimedias_ibfk_1` (`id_estudio`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `dni_2` (`dni`),
  ADD UNIQUE KEY `celular` (`celular`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipos_estudios`
--
ALTER TABLE `tipos_estudios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `multimedias`
--
ALTER TABLE `multimedias`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT de la tabla `tipos_estudios`
--
ALTER TABLE `tipos_estudios`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD CONSTRAINT `estudios_ibfk_2` FOREIGN KEY (`id_tipo_estudio`) REFERENCES `tipos_estudios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `estudios_ibfk_3` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `multimedias`
--
ALTER TABLE `multimedias`
  ADD CONSTRAINT `multimedias_ibfk_1` FOREIGN KEY (`id_estudio`) REFERENCES `estudios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
