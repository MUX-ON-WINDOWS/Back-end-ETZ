-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: database-5015879562.webspace-host.com
-- Gegenereerd op: 24 jun 2024 om 08:15
-- Serverversie: 8.0.32
-- PHP-versie: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbs12945069`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `name`, `type`) VALUES
(1, 'max@gmail.com', 'max', 'max', 'patient'),
(2, 'weshley@gmail.com', 'weshley', 'Weshley', 'verwant'),
(3, 'lonneke@gmail.com', 'lonneke', 'Lonneke', 'verwant');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `relative_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `history`
--

INSERT INTO `history` (`id`, `relative_id`, `user_id`) VALUES
(3, 0, 2),
(4, 0, 3),
(1, 1, 2),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `lamp_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `brightness` int NOT NULL,
  `volume` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `patient`
--

INSERT INTO `patient` (`id`, `lamp_id`, `name`, `user_id`, `status`, `brightness`, `volume`) VALUES
(1, 1, 'max', 1, 1, 254, 80);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `relative`
--

CREATE TABLE `relative` (
  `id` int NOT NULL,
  `patient_id` int NOT NULL,
  `user_id` int NOT NULL,
  `color` varchar(16) NOT NULL,
  `sound` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `relative`
--

INSERT INTO `relative` (`id`, `patient_id`, `user_id`, `color`, `sound`, `name`) VALUES
(1, 1, 2, '716f71', 'Geluid 1', 'Weshley'),
(2, 1, 3, '234564', 'Geluid 9', 'Lonneke');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relative_id` (`relative_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `relative`
--
ALTER TABLE `relative`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `relative`
--
ALTER TABLE `relative`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Beperkingen voor tabel `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Beperkingen voor tabel `relative`
--
ALTER TABLE `relative`
  ADD CONSTRAINT `relative_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `relative_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
