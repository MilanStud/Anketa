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
-- Struktura tabulky `anketa_otazka`
--

CREATE TABLE `anketa_otazka` (
  `id_otazka` int(11) NOT NULL,
  `otazka` varchar(250) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `anketa_otazka`
--

INSERT INTO `anketa_otazka` (`id_otazka`, `otazka`) VALUES
(1, 'prvni otazka'),
(2, 'druha otazka'),
(3, 'test form'),
(4, 'test form 2'),
(5, 'test form 3'),
(6, 'ASDASSDA');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `anketa_otazka`
--
ALTER TABLE `anketa_otazka`
  ADD PRIMARY KEY (`id_otazka`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `anketa_otazka`
--
ALTER TABLE `anketa_otazka`
  MODIFY `id_otazka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
