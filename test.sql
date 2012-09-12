-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 02 Cze 2012, 15:17
-- Wersja serwera: 5.5.16
-- Wersja PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `administratorzy`
--

CREATE TABLE IF NOT EXISTS `administratorzy` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nazwa_uzytkownika` varchar(10) NOT NULL,
  `haslo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `administratorzy`
--

INSERT INTO `administratorzy` (`id`, `nazwa_uzytkownika`, `haslo`) VALUES
(1, 'jan', 'nowak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `adresy_przesylki`
--

CREATE TABLE IF NOT EXISTS `adresy_przesylki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `adres1` varchar(50) NOT NULL,
  `adres2` varchar(50) NOT NULL,
  `adres3` varchar(50) NOT NULL,
  `kod_pocztowy` varchar(10) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'Ciastka'),
(2, 'Napoje');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `klienci`
--

CREATE TABLE IF NOT EXISTS `klienci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `adres1` varchar(50) NOT NULL,
  `adres2` varchar(50) NOT NULL,
  `adres3` varchar(50) NOT NULL,
  `kod_pocztowy` varchar(10) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `zarejestrowany` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `adres1`, `adres2`, `adres3`, `kod_pocztowy`, `telefon`, `email`, `zarejestrowany`) VALUES
(1, 'Tomasz', 'Litwin', '19/3', 'Barska', 'Kielce', '33-504', '0246547321', 'tomasz@abc.com', 1),
(2, 'Adam', 'Kowal', '11/5', 'Polna', 'Opole', '22-513', '0326228912', 'adam@tec.com', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `loginy`
--

CREATE TABLE IF NOT EXISTS `loginy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_klienta` int(11) NOT NULL,
  `nazwa_uzytkownika` varchar(10) NOT NULL,
  `haslo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `loginy`
--

INSERT INTO `loginy` (`id`, `id_klienta`, `nazwa_uzytkownika`, `haslo`) VALUES
(1, 1, 'tomasz', 'litwin'),
(2, 2, 'adam', 'kowal');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pozycje_zamowienia`
--

CREATE TABLE IF NOT EXISTS `pozycje_zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_klienta` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `produkty`
--

CREATE TABLE IF NOT EXISTS `produkty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kat` tinyint(4) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `opis` text NOT NULL,
  `obraz` varchar(30) NOT NULL,
  `cena` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `id_kat`, `nazwa`, `opis`, `obraz`, `cena`) VALUES
(1, 1, 'Najlepsze torebki', 'Wysokiej jako?ci zestaw torebek z herbat?. w ka?dym opakowaniu znajduje si? 200 torebek.', '', 2.99),
(2, 1, 'Najlepszy sok', 'Litr wysokiej jako?ci wyciskanego soku pomara?czowego.', 'najlepszy_sok.jpg', 0.9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `zamowienia`
--

CREATE TABLE IF NOT EXISTS `zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_klienta` int(11) NOT NULL,
  `zarejestrowany` int(11) NOT NULL,
  `id_adresu_przesylki` int(11) NOT NULL,
  `metoda_platnosci` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sesja` varchar(50) NOT NULL,
  `suma` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
