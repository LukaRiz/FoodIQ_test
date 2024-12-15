-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2024 at 04:29 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolFoodInfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `Jed`
--

CREATE TABLE `Jed` (
  `id_jedi` int NOT NULL,
  `naziv_jedi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `id_kategorije` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Jed`
--

INSERT INTO `Jed` (`id_jedi`, `naziv_jedi`, `id_kategorije`) VALUES
(1, 'Gobava juha', 1),
(2, 'Rizota', 5),
(3, 'Rizota', 3),
(4, 'nekaj', 6),
(5, 'Majoneza', 5),
(6, 'Jed1', 1),
(7, 'jed2', 3),
(8, '123', 1),
(9, 'sdf', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Kategorija`
--

CREATE TABLE `Kategorija` (
  `id_kategorije` int NOT NULL,
  `naziv_kategorije` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Kategorija`
--

INSERT INTO `Kategorija` (`id_kategorije`, `naziv_kategorije`) VALUES
(1, 'Juha'),
(2, 'Priloga'),
(3, 'Glavna jed'),
(4, 'Solata'),
(5, 'Sladica'),
(6, 'Pijaca'),
(7, 'Drugo');

-- --------------------------------------------------------

--
-- Table structure for table `Kraj`
--

CREATE TABLE `Kraj` (
  `stevilka_kraja` int NOT NULL,
  `ime_kraja` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Meni`
--

CREATE TABLE `Meni` (
  `id_menija` int NOT NULL,
  `datum` date NOT NULL,
  `opombe` text CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci,
  `id_sole` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Meni`
--

INSERT INTO `Meni` (`id_menija`, `datum`, `opombe`, `id_sole`) VALUES
(1, '2024-12-07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Meni_Jed`
--

CREATE TABLE `Meni_Jed` (
  `id_jedi` int NOT NULL,
  `id_menija` int NOT NULL,
  `kolicina_kuhana` int NOT NULL,
  `kolicina_nepostrezena` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Meni_Jed`
--

INSERT INTO `Meni_Jed` (`id_jedi`, `id_menija`, `kolicina_kuhana`, `kolicina_nepostrezena`) VALUES
(1, 1, 50, 5),
(2, 1, 100, 20),
(3, 1, 123, 10),
(4, 1, 123, 234),
(5, 1, 123, 234),
(6, 1, 123, 123),
(7, 1, 123, 123),
(8, 1, 123, 123),
(9, 1, 34, 34);

-- --------------------------------------------------------

--
-- Table structure for table `Naslov`
--

CREATE TABLE `Naslov` (
  `id_naslova` int NOT NULL,
  `naslov` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `hisna_stevilka` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `stevilka_kraja` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Prisotnost`
--

CREATE TABLE `Prisotnost` (
  `id_prisotnosti` int NOT NULL,
  `id_menija` int DEFAULT NULL,
  `id_sole` int DEFAULT NULL,
  `datum` datetime DEFAULT CURRENT_TIMESTAMP,
  `prijavljeni_otroci` int NOT NULL,
  `poskenirani_otroci` int NOT NULL,
  `opombe` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Prisotnost`
--

INSERT INTO `Prisotnost` (`id_prisotnosti`, `id_menija`, `id_sole`, `datum`, `prijavljeni_otroci`, `poskenirani_otroci`, `opombe`) VALUES
(1, 1, NULL, '2024-12-08 18:35:19', 500, 480, 'haha'),
(2, 1, NULL, '2024-12-12 20:34:43', 500, 490, ''),
(3, 1, NULL, '2024-12-13 19:31:51', 345, 456, 'sdfsd'),
(4, 1, NULL, '2024-12-13 19:33:12', 345, 456, 'nic'),
(5, 1, NULL, '2024-12-13 19:33:47', 123, 123, ''),
(6, 1, NULL, '2024-12-13 19:33:47', 123, 123, '123'),
(7, 1, NULL, '2024-12-14 00:00:00', 123, 123, ''),
(8, 1, NULL, '2024-12-20 00:00:00', 43, 43, '');

-- --------------------------------------------------------

--
-- Table structure for table `Sola`
--

CREATE TABLE `Sola` (
  `id_sole` int NOT NULL,
  `naziv_sole` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `id_naslova` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Uporabnik`
--

CREATE TABLE `Uporabnik` (
  `id_uporabnika` int NOT NULL,
  `ime` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `priimek` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `e_posta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `geslo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL,
  `id_sole` int DEFAULT NULL,
  `id_vloge` int DEFAULT '3',
  `uporabnik_ustvarjen` datetime DEFAULT CURRENT_TIMESTAMP,
  `uporabnik_nazadnje_posodobljen` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `telefon` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci DEFAULT NULL,
  `aktiven` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Uporabnik`
--

INSERT INTO `Uporabnik` (`id_uporabnika`, `ime`, `priimek`, `e_posta`, `geslo`, `id_sole`, `id_vloge`, `uporabnik_ustvarjen`, `uporabnik_nazadnje_posodobljen`, `telefon`, `aktiven`) VALUES
(22, 'Luka', 'Rizman', 'luka.rizman@foodiq.si', '$2y$10$Qp5M.bF4ByGKwaM.HLn/6.aczgzh0GeRTd6rvE0xcr26ek8ZeM9f6', NULL, 2, '2024-11-12 10:39:10', '2024-11-24 00:58:44', '070070070', 1),
(23, 'Erik', 'Curk', 'erik.curk@foodiq.si', '$2y$10$eBVgfrj140/NEHvRw6XeDuL9QYe9F1h4vs9hYQQDCGpx7.4zgtD6C', NULL, 1, '2024-11-12 10:45:30', '2024-11-24 00:59:03', '041041041', 1),
(24, 'Vid', 'Gojković', 'vid.gojkovic@foodiq.si', '$2y$10$A.k/y0a8FscrZb2ZtA2qlOoT8VOnaUyzhFPNBtbRHA0mJGfspkSLe', NULL, 3, '2024-11-13 11:40:35', '2024-11-24 00:59:24', '041555223', 1),
(25, 'Tilen', 'Dragar', 'tilen.dragar@foodiq.si', '$2y$10$CdfdFxCjTBmZU65cW0XP9.RuMW2cCl4Ule28Zqwws5bA3LGgMobbO', NULL, 3, '2024-11-13 11:42:52', '2024-11-24 00:59:43', '050883223', 1),
(26, 'Test', 'Testing', 'test@foodiq.si', '$2y$10$K8fxVoDgzXvYxIb0VA6wj.CxY43UsHFsyQwrKm8CrS6FfZNajJAvq', NULL, 1, '2024-11-24 01:01:02', '2024-12-14 19:46:18', '123456789', 1),
(27, 'Ana', 'Bella', 'ana@bella.si', '$2y$10$tKAAUR69IXJOgE/mVPgs6OXBksrM/ad3vENPakePM3hRHomizJBki', NULL, 3, '2024-12-04 21:18:00', '2024-12-14 20:56:09', '1112223355', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Vloga`
--

CREATE TABLE `Vloga` (
  `id_vloge` int NOT NULL,
  `naziv_vloge` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `Vloga`
--

INSERT INTO `Vloga` (`id_vloge`, `naziv_vloge`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Jed`
--
ALTER TABLE `Jed`
  ADD PRIMARY KEY (`id_jedi`),
  ADD KEY `id_kategorije` (`id_kategorije`);

--
-- Indexes for table `Kategorija`
--
ALTER TABLE `Kategorija`
  ADD PRIMARY KEY (`id_kategorije`);

--
-- Indexes for table `Kraj`
--
ALTER TABLE `Kraj`
  ADD PRIMARY KEY (`stevilka_kraja`);

--
-- Indexes for table `Meni`
--
ALTER TABLE `Meni`
  ADD PRIMARY KEY (`id_menija`),
  ADD KEY `id_sole` (`id_sole`);

--
-- Indexes for table `Meni_Jed`
--
ALTER TABLE `Meni_Jed`
  ADD PRIMARY KEY (`id_jedi`,`id_menija`),
  ADD KEY `id_menija` (`id_menija`);

--
-- Indexes for table `Naslov`
--
ALTER TABLE `Naslov`
  ADD PRIMARY KEY (`id_naslova`),
  ADD KEY `stevilka_kraja` (`stevilka_kraja`);

--
-- Indexes for table `Prisotnost`
--
ALTER TABLE `Prisotnost`
  ADD PRIMARY KEY (`id_prisotnosti`),
  ADD KEY `id_menija` (`id_menija`),
  ADD KEY `id_sole` (`id_sole`);

--
-- Indexes for table `Sola`
--
ALTER TABLE `Sola`
  ADD PRIMARY KEY (`id_sole`),
  ADD KEY `id_naslova` (`id_naslova`);

--
-- Indexes for table `Uporabnik`
--
ALTER TABLE `Uporabnik`
  ADD PRIMARY KEY (`id_uporabnika`),
  ADD UNIQUE KEY `e_posta` (`e_posta`),
  ADD KEY `id_sole` (`id_sole`),
  ADD KEY `fk_uporabnik_vloga` (`id_vloge`);

--
-- Indexes for table `Vloga`
--
ALTER TABLE `Vloga`
  ADD PRIMARY KEY (`id_vloge`),
  ADD UNIQUE KEY `naziv_vloge` (`naziv_vloge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Jed`
--
ALTER TABLE `Jed`
  MODIFY `id_jedi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Kategorija`
--
ALTER TABLE `Kategorija`
  MODIFY `id_kategorije` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Meni`
--
ALTER TABLE `Meni`
  MODIFY `id_menija` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Naslov`
--
ALTER TABLE `Naslov`
  MODIFY `id_naslova` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Prisotnost`
--
ALTER TABLE `Prisotnost`
  MODIFY `id_prisotnosti` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Sola`
--
ALTER TABLE `Sola`
  MODIFY `id_sole` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Uporabnik`
--
ALTER TABLE `Uporabnik`
  MODIFY `id_uporabnika` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `Vloga`
--
ALTER TABLE `Vloga`
  MODIFY `id_vloge` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Jed`
--
ALTER TABLE `Jed`
  ADD CONSTRAINT `Jed_ibfk_1` FOREIGN KEY (`id_kategorije`) REFERENCES `Kategorija` (`id_kategorije`);

--
-- Constraints for table `Meni`
--
ALTER TABLE `Meni`
  ADD CONSTRAINT `Meni_ibfk_1` FOREIGN KEY (`id_sole`) REFERENCES `Sola` (`id_sole`);

--
-- Constraints for table `Meni_Jed`
--
ALTER TABLE `Meni_Jed`
  ADD CONSTRAINT `Meni_Jed_ibfk_1` FOREIGN KEY (`id_jedi`) REFERENCES `Jed` (`id_jedi`) ON DELETE CASCADE,
  ADD CONSTRAINT `Meni_Jed_ibfk_2` FOREIGN KEY (`id_menija`) REFERENCES `Meni` (`id_menija`) ON DELETE CASCADE;

--
-- Constraints for table `Naslov`
--
ALTER TABLE `Naslov`
  ADD CONSTRAINT `Naslov_ibfk_1` FOREIGN KEY (`stevilka_kraja`) REFERENCES `Kraj` (`stevilka_kraja`);

--
-- Constraints for table `Prisotnost`
--
ALTER TABLE `Prisotnost`
  ADD CONSTRAINT `Prisotnost_ibfk_1` FOREIGN KEY (`id_menija`) REFERENCES `Meni` (`id_menija`),
  ADD CONSTRAINT `Prisotnost_ibfk_2` FOREIGN KEY (`id_sole`) REFERENCES `Sola` (`id_sole`);

--
-- Constraints for table `Sola`
--
ALTER TABLE `Sola`
  ADD CONSTRAINT `Sola_ibfk_1` FOREIGN KEY (`id_naslova`) REFERENCES `Naslov` (`id_naslova`);

--
-- Constraints for table `Uporabnik`
--
ALTER TABLE `Uporabnik`
  ADD CONSTRAINT `fk_uporabnik_vloga` FOREIGN KEY (`id_vloge`) REFERENCES `Vloga` (`id_vloge`),
  ADD CONSTRAINT `Uporabnik_ibfk_1` FOREIGN KEY (`id_sole`) REFERENCES `Sola` (`id_sole`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
