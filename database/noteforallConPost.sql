-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Gen 04, 2024 alle 15:59
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

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`),
  ADD UNIQUE KEY `Username_2` (`Username`,`Email`),
  ADD KEY `IdMedia` (`IdMedia`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
