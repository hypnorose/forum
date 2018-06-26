-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Kwi 2018, 22:00
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `forumorg`
--
CREATE DATABASE IF NOT EXISTS `forumorg` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `forumorg`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `iskatforall`
--

CREATE TABLE `iskatforall` (
  `id` int(11) NOT NULL,
  `v` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `iskatforall`
--

INSERT INTO `iskatforall` (`id`, `v`) VALUES
(28, 1),
(29, 1),
(31, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `parent` mediumtext NOT NULL,
  `kolej` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `name`, `description`, `parent`, `kolej`) VALUES
(28, 'Ogłoszenia', 'Sprawy najważniejsze', 'main', 1),
(29, 'Klasy', '', 'main', 2),
(30, '4TI', '', '29', 1),
(31, 'Koła zainteresowań', '', 'main', 3),
(32, 'Grupa programistyczna', '', '31', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorietitles`
--

CREATE TABLE `kategorietitles` (
  `id` int(11) NOT NULL,
  `katid` int(11) NOT NULL,
  `titlesid` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorietitles`
--

INSERT INTO `kategorietitles` (`id`, `katid`, `titlesid`) VALUES
(58, 30, '4TI'),
(61, 32, 'Programista');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ranks`
--

CREATE TABLE `ranks` (
  `prog` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tematy`
--

CREATE TABLE `tematy` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `autor` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `data_ost` datetime NOT NULL,
  `parent_kat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tematy`
--

INSERT INTO `tematy` (`id`, `name`, `autor`, `data`, `data_ost`, `parent_kat`) VALUES
(21, 'Darmowe drożdż&oacute;wki', 4, '2018-04-17 21:39:15', '2018-04-17 21:39:15', 28);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `titles`
--

CREATE TABLE `titles` (
  `name` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `color` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `titles`
--

INSERT INTO `titles` (`name`, `color`) VALUES
('4TI', '#f5e065'),
('Nauczyciel', '#50f858'),
('Programista', '#0aa9a5'),
('Uczeń ', '#112ef4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `login` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `cookie` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `staff`, `login`, `password`, `email`, `cookie`) VALUES
(4, 100, 'Administrator', '$2y$10$3kmIp.1f2h0uSC.eKAitf.KeYY1tn0N9dvjBykyhh47FTGyT4cRHu', 'mailmailmail@mail.mail', 'fba826271e5588297db02b5303f6863a0891eaeb'),
(5, 0, 'Tester', '$2y$10$MlGUWsDbPNjaOLbLjicaJO9EHePMD4GiKuv0ThOh.RGrJt2Ptfho6', 'testowy@mail.com', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userstitles`
--

CREATE TABLE `userstitles` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `titlesid` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `userstitles`
--

INSERT INTO `userstitles` (`id`, `userid`, `titlesid`) VALUES
(109, 5, 'Uczeń_'),
(110, 4, 'Nauczyciel');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `iskatforall`
--
ALTER TABLE `iskatforall`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorietitles`
--
ALTER TABLE `kategorietitles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`prog`);

--
-- Indeksy dla tabeli `tematy`
--
ALTER TABLE `tematy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `userstitles`
--
ALTER TABLE `userstitles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `iskatforall`
--
ALTER TABLE `iskatforall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT dla tabeli `kategorietitles`
--
ALTER TABLE `kategorietitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT dla tabeli `tematy`
--
ALTER TABLE `tematy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `userstitles`
--
ALTER TABLE `userstitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- Baza danych: `forumposty`
--
CREATE DATABASE IF NOT EXISTS `forumposty` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `forumposty`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `id` int(11) NOT NULL,
  `tresc` text NOT NULL,
  `autor` int(11) NOT NULL,
  `parent_temat` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`id`, `tresc`, `autor`, `parent_temat`, `data`) VALUES
(23, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAARATUNKU', 4, 13, '2017-09-20 20:59:13'),
(24, 'asdasmdasdaasdasdada', 4, 14, '2017-09-20 21:18:00'),
(25, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHA', 4, 15, '2017-09-20 21:19:31'),
(26, 'Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹Å¹x', 4, 16, '2017-09-22 18:12:19'),
(27, 'Å¹Å¹Å¹Å¹Å¹Å¹Å¹Ä„Ä„Ä„Ä„Ä„Ä„Ä„Ä„Ä„Ä„Ä„Ä„ÅšÅšÅšÅšÅšÅšÅšÅšÅš', 4, 17, '2017-09-22 18:19:10'),
(28, '/ŹŹŹŹŹŹŹŹŹŹŹŹŹĆĆĆĆĆĆĆĆĆc\r\n', 4, 17, '2017-09-22 18:24:39'),
(29, 'ŚŚŚŚŚŚŚŚŚśs', 4, 17, '2017-09-22 18:24:46'),
(30, 'Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†Ä†', 4, 18, '2017-09-22 18:24:59'),
(31, 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXĆ', 4, 19, '2017-09-22 19:03:02'),
(32, 'SADASDADad', 4, 19, '2017-09-23 16:48:28'),
(33, 'asaasdsadasdasdsadas', 4, 19, '2017-09-23 16:48:37'),
(34, 'XDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', 4, 13, '2017-09-23 16:48:49'),
(35, '<br />\r\nWszystkich moich fanów rzede wasdadnsadmksadsa', 4, 20, '2018-04-14 18:50:23'),
(36, 'asdsadsadasdas', 4, 20, '2018-04-14 18:52:29'),
(37, 'Z racji na postępy w przypadku rozgrywek Terraformacji Marsa Robert Sulej, widzeprezes korporacji Solium General Motors ogłasza: darmowe drożdżaki', 4, 21, '2018-04-17 21:39:15');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
