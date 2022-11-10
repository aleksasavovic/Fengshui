-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2018 at 08:30 PM
-- Server version: 5.7.20-log
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fengshui`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2018_06_06_005207_create_oglasi_table', 1),
(14, '2018_06_06_005432_create_radi_na_table', 1),
(15, '2018_06_06_005459_create_prijavljeni_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

DROP TABLE IF EXISTS `oglasi`;
CREATE TABLE IF NOT EXISTS `oglasi` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tip_prostorije` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kvadratura` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `slika` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oglasi_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oglasi`
--

INSERT INTO `oglasi` (`id`, `tip_prostorije`, `status`, `kvadratura`, `user_id`, `slika`, `created_at`, `updated_at`) VALUES
(1, 'ceo stan', 'otvoren za ponude', 86, 1, '1528487299jpg', '2018-06-08 17:48:19', '2018-06-08 17:48:19'),
(2, 'kupatilo', 'otvoren za ponude', 10, 2, '1528487476jpg', '2018-06-08 17:51:16', '2018-06-08 17:51:16'),
(3, 'dnevna soba', 'otvoren za ponude', 25, 3, '1528487732jpg', '2018-06-08 17:55:32', '2018-06-08 17:55:32'),
(4, 'spavaća soba', 'izrada', 18, 2, '1528488878jpg', '2018-06-08 18:14:38', '2018-06-08 18:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prijavljeni`
--

DROP TABLE IF EXISTS `prijavljeni`;
CREATE TABLE IF NOT EXISTS `prijavljeni` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `oglas_id` int(10) UNSIGNED NOT NULL,
  `cena` double(8,2) NOT NULL,
  `vreme_izrade` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `prijavljeni_user_id_foreign` (`user_id`),
  KEY `prijavljeni_oglas_id_foreign` (`oglas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prijavljeni`
--

INSERT INTO `prijavljeni` (`user_id`, `oglas_id`, `cena`, `vreme_izrade`, `created_at`, `updated_at`) VALUES
(3, 1, 2000.00, 20, '2018-06-08 17:58:09', '2018-06-08 17:58:09'),
(4, 1, 1900.00, 30, '2018-06-08 18:10:11', '2018-06-08 18:10:11'),
(3, 4, 50.00, 3, '2018-06-08 18:15:15', '2018-06-08 18:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `radi_na`
--

DROP TABLE IF EXISTS `radi_na`;
CREATE TABLE IF NOT EXISTS `radi_na` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `oglas_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `radi_na_user_id_foreign` (`user_id`),
  KEY `radi_na_oglas_id_foreign` (`oglas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radi_na`
--

INSERT INTO `radi_na` (`user_id`, `oglas_id`, `created_at`, `updated_at`) VALUES
(3, 4, '2018-06-08 18:16:00', '2018-06-08 18:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `korisnicko` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipKorisnika` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocena` double NOT NULL DEFAULT '0',
  `ocenilo` int(11) NOT NULL DEFAULT '0',
  `sumaOcena` int(11) NOT NULL DEFAULT '0',
  `opis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slika` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.jpg',
  `radovi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `email`, `password`, `prezime`, `korisnicko`, `tipKorisnika`, `ocena`, `ocenilo`, `sumaOcena`, `opis`, `slika`, `radovi`, `remember_token`) VALUES
(1, 'Žika', 'zika@email.com', '$2y$10$5oItxPVCbbcTf28oE/7uoOlQD6sRVLnN/0bOVBxJaMCwESHMPdH6C', 'Žikić', 'Žikica', 'korisnik', 0, 0, 0, 'Završio sam Muzičku akademiju, odsek za violončelo. U slobodno vreme igram košarku i idem na pecanje.', 'user.jpg', 'noimage.png', 'KGDO473KL0yHm74cbvp6uNxh8hJTuKvDRFqGi09buFSN0105UrltK8UCktuM'),
(2, 'Jana', 'jana@email.com', '$2y$10$GD.RYTxtr9opE7AHIakeY.lBy67yCB8NAEZLi1MbosqyhEQz3WWjS', 'Janić', 'Janči', 'korisnik', 0, 0, 0, 'Oduvek me zanima dizajn eneterijera, pa uživam čitajući magazin BravaCasa.', 'user.jpg', 'noimage.png', '54h735O2sP2yRujvSIufPjdv15z3Dvq0kNCnFMN45VdTeWvwQsSBt04LoePq'),
(3, 'Pera', 'pera@email.com', '$2y$10$sFnujmGam7ndwXHnoCk10ehUnFc3nmCnybwX33Ft1N9teH2ZSj5By', 'Perić', 'Pera75', 'dizajner', 5, 1, 5, 'Završio sam Arhitektonski fakultet, odsek za dizajn enterijera i time se bavim već 12 godina. Preferiram minimalizam, ali mi nijedan stil ne predstavlja problem.', 'user.jpg', 'noimage.png;1528487912.jpg;1528488087.jpg;1528489015.jpeg', 'hnZqlOso6I8EbfEWcrX9OWk7fQoCiPRGBk4vA2EQzsDwkFsN5W01fPAWKmFd'),
(4, 'Mara', 'mara@email.com', '$2y$10$AdgNr/tCYjpvemcoldkCJ.fWVtje7WCg2/r8NcFapkuOyZL.e8NxG', 'Marić', 'Maruška', 'dizajner', 5, 1, 5, 'Studirala sam u Skandinavskoj zemlji, pa mi je uža specijalnost upravo taj stil.', 'user.jpg', 'noimage.png;1528488473.jpg;1528488526.jpg;1528488564.jpg', 'gXZXFWh1QvlfGvqEPgY68cOFgJUkk54ccevClZPkUf8FnAs6ByPkEbWwJXQP');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD CONSTRAINT `oglasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `prijavljeni`
--
ALTER TABLE `prijavljeni`
  ADD CONSTRAINT `prijavljeni_oglas_id_foreign` FOREIGN KEY (`oglas_id`) REFERENCES `oglasi` (`id`),
  ADD CONSTRAINT `prijavljeni_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `radi_na`
--
ALTER TABLE `radi_na`
  ADD CONSTRAINT `radi_na_oglas_id_foreign` FOREIGN KEY (`oglas_id`) REFERENCES `oglasi` (`id`),
  ADD CONSTRAINT `radi_na_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
