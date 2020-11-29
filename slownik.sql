-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Lis 2020, 16:45
-- Wersja serwera: 10.4.10-MariaDB
-- Wersja PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `slownik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slowa`
--

CREATE TABLE `slowa` (
  `id` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `slowo` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `tlumaczenie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `notatka` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `slowa`
--

INSERT INTO `slowa` (`id`, `id_uzytkownik`, `slowo`, `tlumaczenie`, `notatka`) VALUES
(1, 1, 'longsword', 'miecz długi', ''),
(2, 1, 'coat of plates', 'pancerz typu płaty', ''),
(3, 2, 'network', 'sieć komputerowa', ''),
(4, 2, 'switch', 'switch, przełącznik', ''),
(5, 1, 'lance', 'kopia rycerska', ''),
(6, 2, 'netmask', 'maska podsieci', ''),
(7, 2, 'router', 'router, trasownik', ''),
(8, 1, 'warhammer', 'młot rycerski, nadziak', ''),
(9, 1, 'charge', 'szarżować', ''),
(10, 1, 'retreat', 'odwrót', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `email`, `login`, `haslo`) VALUES
(1, 'adam@gmail.com', 'adam', 'zaq1@WSX'),
(2, 'ola@o2.pl', 'ola', 'qwerty123');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `slowa`
--
ALTER TABLE `slowa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownik` (`id_uzytkownik`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `slowa`
--
ALTER TABLE `slowa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `slowa`
--
ALTER TABLE `slowa`
  ADD CONSTRAINT `slowa_ibfk_1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
