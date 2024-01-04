-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Gen 04, 2024 alle 16:02
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noteforall`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE `category` (
  `IdCategory` int(11) NOT NULL,
  `Description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `media`
--

CREATE TABLE `media` (
  `IdMedia` int(11) NOT NULL,
  `FileName` tinytext NOT NULL,
  `Extension` varchar(10) NOT NULL,
  `File` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `media`
--

INSERT INTO `media` (`IdMedia`, `FileName`, `Extension`, `File`) VALUES
(1, 'ciao', '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `IdNotification` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Description` tinytext NOT NULL,
  `IsRead` tinyint(1) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO `notification` (`IdNotification`, `Type`, `Description`, `IsRead`, `IdUser`) VALUES
(1, '', 'Prova notifica 1', 0, 2),
(2, 'Like', '@user liked your post', 0, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `IdPost` int(11) NOT NULL,
  `Title` tinytext NOT NULL,
  `Description` text DEFAULT NULL,
  `NumberVote` int(11) NOT NULL,
  `NumberComment` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdMedia` int(11) NOT NULL,
  `IdPreview` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`IdPost`, `Title`, `Description`, `NumberVote`, `NumberComment`, `IdUser`, `IdMedia`, `IdPreview`) VALUES
(5, 'Analisi 1', 'Appunti di analisi 1', 0, 0, 2, 1, 1),
(6, 'Analisi 2', 'Appunti di analisi 2', 0, 0, 2, 1, 1),
(7, 'Analisi 3', 'Appunti di analisi 3 prof Miglio', 0, 0, 2, 1, 1),
(8, 'Analisi strutturale', 'Approfondimento analisi strutturale', 0, 0, 2, 1, 1),
(9, 'Analisi e statistica', 'Statistica e analisi economica, prof Caselli', 0, 0, 2, 1, 1),
(10, 'Analisi 1 primo parziale', 'Appunti di analisi 1 fino al 2 novembre', 0, 0, 2, 1, 1),
(11, 'Analisi del software', 'Appunti di analisi del software prof Pianini', 0, 0, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `post_category`
--

CREATE TABLE `post_category` (
  `Id` int(11) NOT NULL,
  `IdPost` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `usercomment`
--

CREATE TABLE `usercomment` (
  `IdComment` int(11) NOT NULL,
  `CommentText` text NOT NULL,
  `IdPost` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `IdUser` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Description` tinytext DEFAULT NULL,
  `IdMedia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`IdUser`, `Name`, `Surname`, `Username`, `Email`, `Password`, `Description`, `IdMedia`) VALUES
(2, 'admin', 'super', 'admin', 'admin@nfa.com', '$2y$10$pX.RsB/uooJRrd0KID2BRezUAeZZzRiGMnjPbHfp6ZZ306enNcxJy', 'i\'m the captain now', NULL),
(3, 'Mario', 'Rossi', 'marros', 'mario.rossi@gmail.com', '$2y$10$m332ogYh5M9IFR4UYkdCIOhp1F1IetMLhjJGB3TYsUwoisgNEqfIi', NULL, NULL),
(8, 'Riccardo', 'Penazzi', 'riki17', 'rp@note.com', '$2y$10$5wmerMVdKeXSZiiuLOHByevoTFVSjJfzpRyefeh/O.jklrgciaEQi', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `vote`
--

CREATE TABLE `vote` (
  `IdVote` int(11) NOT NULL,
  `IdPost` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Indici per le tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`IdMedia`);

--
-- Indici per le tabelle `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`IdNotification`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`IdPost`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdMedia` (`IdMedia`),
  ADD KEY `IdPreview` (`IdPreview`);

--
-- Indici per le tabelle `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `IdCategory` (`IdCategory`);

--
-- Indici per le tabelle `usercomment`
--
ALTER TABLE `usercomment`
  ADD PRIMARY KEY (`IdComment`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `userComment_ibfk_2` (`IdUser`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`),
  ADD UNIQUE KEY `Username_2` (`Username`,`Email`),
  ADD KEY `IdMedia` (`IdMedia`);

--
-- Indici per le tabelle `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`IdVote`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `IdUser` (`IdUser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `category`
--
ALTER TABLE `category`
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `media`
--
ALTER TABLE `media`
  MODIFY `IdMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `IdNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `post_category`
--
ALTER TABLE `post_category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `usercomment`
--
ALTER TABLE `usercomment`
  MODIFY `IdComment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `vote`
--
ALTER TABLE `vote`
  MODIFY `IdVote` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`IdPreview`) REFERENCES `media` (`IdMedia`);

--
-- Limiti per la tabella `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`),
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`);

--
-- Limiti per la tabella `usercomment`
--
ALTER TABLE `usercomment`
  ADD CONSTRAINT `userComment_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`),
  ADD CONSTRAINT `userComment_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`);

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`);

--
-- Limiti per la tabella `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
