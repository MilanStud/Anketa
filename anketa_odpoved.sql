-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 30. led 2023, 12:32
-- Verze serveru: 10.4.21-MariaDB
-- Verze PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `anketa`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `anketa_odpoved`
--

CREATE TABLE `anketa_odpoved` (
  `id_odpoved` int(11) NOT NULL,
  `id_otazka` int(11) NOT NULL,
  `odpoved` varchar(250) COLLATE utf8_czech_ci NOT NULL,
  `pocet_hlasu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `anketa_odpoved`
--

INSERT INTO `anketa_odpoved` (`id_odpoved`, `id_otazka`, `odpoved`, `pocet_hlasu`) VALUES
(1, 1, 'hgfhshg', 3),
(2, 5, 'trzrzertzzez\r\ntrzer\r\ntrzetrz', 0),
(3, 2, 'odpoved druha ot', 1),
(4, 1, 'odpoved prvni otazka', 1),
(5, 3, 'odpoved test form', 0),
(6, 6, 'odpoved na AS', 1),
(7, 6, 'odpoved 2 na AS', 0),
(8, 6, 'odpoved 3 na AS', 0),
(9, 6, '4', 0),
(10, 5, 'efa', 1),
(11, 5, '3', 0),
(12, 1, 'fddgzf', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `anketa_odpoved`
--
ALTER TABLE `anketa_odpoved`
  ADD PRIMARY KEY (`id_odpoved`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `anketa_odpoved`
--
ALTER TABLE `anketa_odpoved`
  MODIFY `id_odpoved` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
