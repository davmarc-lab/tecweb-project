-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2024 at 01:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `IdCategory` int(11) NOT NULL,
  `Description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `Id` int(11) NOT NULL,
  `IdSrc` int(11) NOT NULL,
  `IdDst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`Id`, `IdSrc`, `IdDst`) VALUES
(1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `IdMedia` int(11) NOT NULL,
  `FileName` tinytext NOT NULL,
  `FilePath` tinytext NOT NULL,
  `Extension` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`IdMedia`, `FileName`, `FilePath`, `Extension`) VALUES
(1, 'ciao', '', ''),
(10, 'wp_codequote.jpg', '/www/Project/website/uploads/wp_codequote.jpg', NULL),
(11, 'wp_coding.png', '/www/Project/website/uploads/wp_coding.png', NULL),
(12, 'grub_background.jpg', '/www/Project/website/uploads/grub_background.jpg', NULL),
(13, 'wp_codequote.jpg', '/www/Project/website/uploads/wp_codequote.jpg', NULL),
(14, 'wp_coding.png', '/www/Project/website/uploads/wp_coding.png', NULL),
(15, 'wp_car.png', '/www/Project/website/uploads/wp_car.png', NULL),
(16, 'wp_codequote.jpg', '/www/Project/website/uploads/wp_codequote.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `IdNotification` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Description` tinytext NOT NULL,
  `IsRead` tinyint(1) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`IdNotification`, `Type`, `Description`, `IsRead`, `IdUser`) VALUES
(1, '', 'Prova notifica 1', 0, 2),
(2, 'Like', '@user liked your post', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `IdPost` int(11) NOT NULL,
  `Title` tinytext NOT NULL,
  `Description` text DEFAULT NULL,
  `NumberVote` int(11) NOT NULL,
  `NumberComment` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdMedia` int(11) NOT NULL,
  `IdPreview` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`IdPost`, `Title`, `Description`, `NumberVote`, `NumberComment`, `IdUser`, `IdMedia`, `IdPreview`, `Date`) VALUES
(5, 'Analisi 1', 'Appunti di analisi 1', 12, 0, 2, 15, 12, '2024-01-05 11:43:08'),
(6, 'Analisi 2', 'Appunti di analisi 2', 4, 0, 2, 14, 14, '2024-01-05 11:43:08'),
(7, 'Analisi 3', 'Appunti di analisi 3 prof Miglio', 0, 0, 2, 11, 15, '2024-01-05 11:43:08'),
(8, 'Analisi strutturale', 'Approfondimento analisi strutturale', 1, 0, 2, 12, 10, '2024-01-05 11:43:08'),
(9, 'Analisi e statistica', 'Statistica e analisi economica, prof Caselli', 1, 0, 2, 16, 11, '2024-01-05 11:43:08'),
(10, 'Analisi 1 primo parziale', 'Appunti di analisi 1 fino al 2 novembre', 0, 0, 2, 13, 13, '2024-01-05 11:43:08'),
(11, 'Analisi del software', 'Appunti di analisi del software prof Pianini', 1, 0, 2, 14, 10, '2024-01-05 11:43:08'),
(12, 'Ricerca operativa', 'Appunti di ricerca operativa, prof Boschetti', 1, 0, 4, 15, 12, '2024-01-05 11:43:08'),
(102, 'Introduzione all\'informatica', 'Appunti del corso introduttivo di informatica', 0, 0, 2, 13, 14, '2023-12-26 10:50:00'),
(103, 'Analisi Matematica I', 'Appunti del corso di Analisi Matematica I', 0, 0, 2, 11, 13, '2023-12-26 10:50:00'),
(104, 'Chimica Organica', 'Note sulle reazioni chimiche organiche', 0, 0, 2, 14, 15, '2024-01-01 17:12:20'),
(105, 'Storia dell\'arte', 'Appunti sulla storia dell\'arte medievale', 0, 0, 2, 15, 16, '2024-01-01 17:12:20'),
(106, 'Fisica Quantistica', 'Breve introduzione alla fisica quantistica', 0, 0, 4, 12, 10, '2024-01-01 17:12:20'),
(132, 'Programmazione Java', 'Esercizi e codice Java avanzato', 0, 0, 2, 16, 11, '2023-12-29 09:43:00'),
(133, 'Filosofia Morale', 'Riflessioni sulla filosofia morale contemporanea', 0, 0, 2, 10, 13, '2024-01-01 17:12:20'),
(134, 'Economia Politica', 'Analisi delle teorie economiche contemporanee', 0, 0, 4, 14, 15, '2024-01-01 17:12:20'),
(135, 'Letteratura Inglese', 'Studio dei classici della letteratura inglese', 0, 0, 4, 15, 10, '2024-01-01 17:12:20'),
(136, 'Algoritmi Avanzati', 'Approfondimento sugli algoritmi avanzati', 0, 0, 2, 10, 16, '2023-12-26 10:50:00'),
(151, 'Architettura dei Calcolatori', 'Lezioni sull\'architettura dei calcolatori moderni', 0, 0, 2, 13, 14, '2024-01-01 17:12:20'),
(152, 'Biologia Molecolare', 'Ricerche e scoperte recenti in biologia molecolare', 0, 0, 4, 12, 13, '2024-01-01 17:12:20'),
(153, 'Cucina Italiana', 'Ricette tradizionali della cucina italiana', 0, 0, 4, 11, 12, '2023-12-29 09:43:00'),
(154, 'Statistica Applicata', 'Esempi pratici di statistica applicata', 0, 0, 4, 15, 10, '2023-12-29 09:43:00'),
(155, 'Diritto Internazionale', 'Principi fondamentali del diritto internazionale', 0, 0, 4, 14, 13, '2024-01-01 17:12:20'),
(156, 'Geografia del Mondo', 'Studio delle principali caratteristiche geografiche globali', 0, 0, 4, 12, 15, '2024-01-01 17:12:20'),
(157, 'Psicologia Clinica', 'Approfondimenti sulla psicologia clinica contemporanea', 0, 0, 3, 16, 14, '2024-01-01 17:12:20'),
(158, 'Scienze della Terra', 'Esplorazione delle scienze della terra e della geologia', 0, 0, 3, 14, 10, '2023-12-26 10:50:00'),
(159, 'Teoria della Musica', 'Lezioni sulla teoria e composizione musicale', 0, 0, 2, 11, 15, '2023-12-29 09:43:00'),
(160, 'Medicina Preventiva', 'Note sulla medicina preventiva e la salute pubblica', 0, 0, 3, 12, 16, '2023-12-29 09:43:00'),
(161, 'Ricerca Operativa', 'Metodi avanzati di ricerca operativa', 0, 0, 2, 13, 14, '2023-12-26 10:50:00'),
(162, 'Ingegneria del Software', 'Approfondimento sull\'ingegneria del software', 0, 0, 2, 14, 15, '2023-12-29 09:43:00'),
(163, 'Arte Contemporanea', 'Analisi delle tendenze artistiche contemporanee', 0, 0, 2, 15, 10, '2023-12-29 09:43:00'),
(164, 'Chimica Fisica', 'Studi sulla chimica fisica e le sue applicazioni', 0, 0, 4, 10, 13, '2023-12-29 09:43:00'),
(165, 'Antropologia Culturale', 'Esplorazione dell\'antropologia culturale', 0, 0, 2, 11, 16, '2023-12-26 10:50:00'),
(166, 'Economia del Lavoro', 'Analisi dell\'economia del lavoro e delle risorse umane', 0, 0, 2, 12, 14, '2023-12-29 09:43:00'),
(167, 'Filosofia Politica', 'Riflessioni sulla filosofia politica contemporanea', 0, 0, 2, 13, 10, '2023-12-26 10:50:00'),
(168, 'Robotica Avanzata', 'Sviluppi recenti nella robotica avanzata', 0, 0, 2, 14, 13, '2024-12-26 10:50:00'),
(169, 'Teatro Moderno', 'Esplorazione del teatro moderno e contemporaneo', 0, 0, 2, 15, 11, '2023-12-26 10:50:00'),
(170, 'Linguaggi di Programmazione', 'Studio dei linguaggi di programmazione moderni', 0, 0, 3, 12, 14, '2024-01-01 17:12:20'),
(201, 'Biologia Cellulare', 'Studio avanzato sulla biologia cellulare con il prof. Rossi', 0, 0, 3, 11, 16, '2023-12-23 08:55:09'),
(202, 'Economia Aziendale', 'Analisi dei principi dell\'economia aziendale con il prof. Bianchi', 0, 0, 3, 14, 13, '2023-12-23 08:55:09'),
(203, 'Storia dell\'Informatica', 'Retrospettiva sulla storia dell\'informatica con il prof. Verdi', 0, 0, 3, 16, 12, '2023-12-23 08:55:09'),
(204, 'Chimica Inorganica', 'Lezioni sulla chimica inorganica avanzata con il prof. Neri', 0, 0, 4, 10, 14, '2023-12-23 08:55:09'),
(205, 'Psicologia Sperimentale', 'Esperimenti e studi in psicologia sperimentale con la prof. Rossi', 0, 0, 3, 11, 15, '2023-12-23 08:55:09'),
(206, 'Teoria dei Giochi', 'Approfondimenti sulla teoria dei giochi con il prof. Martini', 0, 0, 2, 13, 16, '2023-12-23 08:55:09'),
(207, 'Antropologia Forense', 'Analisi forense attraverso l\'antropologia con la prof. Ferrari', 0, 0, 4, 15, 10, '2023-12-23 08:55:09'),
(208, 'Economia dello Sviluppo', 'Studio dell\'economia dello sviluppo con il prof. Morelli', 0, 0, 3, 12, 11, '2023-12-23 08:55:09'),
(209, 'Storia della Musica', 'Esplorazione della storia della musica con il prof. Rizzo', 0, 0, 3, 14, 12, '2023-12-23 08:55:09'),
(210, 'Analisi dei Dati', 'Metodi avanzati di analisi dei dati con il prof. Monti', 0, 0, 4, 15, 13, '2023-12-23 08:55:09'),
(211, 'Architettura del Paesaggio', 'Lezioni sull\'architettura del paesaggio con il prof. Colombo', 0, 0, 4, 16, 14, '2023-12-23 08:55:09'),
(212, 'Fisica delle Particelle', 'Ricerche sulla fisica delle particelle con il prof. Galilei', 0, 0, 4, 10, 15, '2023-12-23 08:55:09'),
(213, 'Filosofia dell\'Estetica', 'Riflessioni sulla filosofia dell\'estetica con il prof. De Luca', 0, 0, 2, 11, 10, '2024-01-02 18:55:09'),
(214, 'Biologia Evoluzionistica', 'Studi avanzati sulla biologia evoluzionistica con la prof. Mancini', 0, 0, 2, 12, 11, '2024-01-02 18:55:09'),
(215, 'Economia della Cultura', 'Analisi dell\'economia della cultura con il prof. Marini', 0, 0, 2, 13, 12, '2024-01-02 18:55:09'),
(216, 'Storia dell\'Asia', 'Esplorazione della storia dell\'Asia con il prof. Kim', 0, 0, 2, 14, 13, '2024-01-02 18:55:09'),
(231, 'Psicologia Sociale', 'Ricerche e studi sulla psicologia sociale con la prof. Russo', 0, 0, 4, 15, 14, '2024-01-02 18:55:09'),
(232, 'Scienze della Terra Applicata', 'Applicazioni pratiche delle scienze della terra con il prof. Volterra', 0, 0, 4, 16, 15, '2024-01-02 18:55:09'),
(233, 'Teoria Musicale', 'Lezioni avanzate sulla teoria e composizione musicale con il prof. Beethoven', 0, 0, 4, 10, 16, '2024-01-02 18:55:09'),
(234, 'Medicina di Emergenza', 'Note sulla medicina di emergenza con la prof. Salvatore', 0, 0, 4, 11, 14, '2024-01-02 18:55:09'),
(235, 'Analisi delle Reti', 'Studi avanzati sull\'analisi delle reti con il prof. Ferrara', 0, 0, 4, 12, 16, '2024-01-02 18:55:09'),
(236, 'Ingegneria del Software Avanzata', 'Approfondimento sull\'ingegneria del software avanzata con il prof. Pianini', 0, 0, 4, 13, 10, '2024-01-02 18:55:09'),
(237, 'Arte Cinematografica', 'Analisi dell\'arte cinematografica con il prof. Leone', 0, 0, 2, 14, 11, '2024-01-02 18:55:09'),
(238, 'Chimica Organica Avanzata', 'Studi avanzati sulla chimica organica con il prof. Carboni', 0, 0, 2, 15, 12, '2024-01-02 18:55:09'),
(239, 'Antropologia Medica', 'Ricerche sull\'antropologia medica con la prof. Bianchi', 0, 0, 2, 16, 13, '2024-01-02 18:55:09'),
(240, 'Economia delle Risorse Umane', 'Analisi dell\'economia delle risorse umane con il prof. Moretti', 0, 0, 2, 10, 14, '2024-01-02 18:55:09'),
(241, 'Filosofia dell\'Etica', 'Riflessioni sulla filosofia dell\'etica con il prof. De Rossi', 0, 0, 2, 11, 15, '2024-01-02 18:55:09'),
(242, 'Robotica Avanzata Applicata', 'Applicazioni pratiche della robotica avanzata con il prof. Robottini', 0, 0, 4, 12, 16, '2024-01-02 18:55:09'),
(243, 'Teatro Classico', 'Esplorazione del teatro classico con il prof. Shakespeare', 0, 0, 3, 13, 13, '2024-01-02 18:55:09'),
(244, 'Linguaggi di Programmazione Avanzati', 'Studio dei linguaggi di programmazione avanzati con il prof. Codice', 0, 0, 4, 14, 12, '2024-01-02 18:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `Id` int(11) NOT NULL,
  `IdPost` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usercomment`
--

CREATE TABLE `usercomment` (
  `IdComment` int(11) NOT NULL,
  `CommentText` text NOT NULL,
  `IdPost` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
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
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`IdUser`, `Name`, `Surname`, `Username`, `Email`, `Password`, `Description`, `IdMedia`) VALUES
(2, 'admin', 'super', 'admin', 'admin@nfa.com', '$2y$10$pX.RsB/uooJRrd0KID2BRezUAeZZzRiGMnjPbHfp6ZZ306enNcxJy', 'i\'m the captain now', NULL),
(3, 'Mario', 'Rossi', 'marros', 'mario.rossi@gmail.com', '$2y$10$m332ogYh5M9IFR4UYkdCIOhp1F1IetMLhjJGB3TYsUwoisgNEqfIi', NULL, NULL),
(4, 'Riccardo', 'Penazzi', 'riki17', 'rp@note.com', '$2y$10$3w5jlZ/8Q2kHYcsfg/co6uhIV5Oi2v9BYJBU7re3/OO07y.RKtcyu', NULL, NULL),
(6, 'Davide', 'Marchetti', 'davmarc', 'davide.marchetti6@studio.unibo.it', '$2y$10$5AhtSA..GFsbdymHMDvAOu6.akHphl62/4g4yva.Kg1KIaGxkd9qO', NULL, NULL),
(7, 'Filippo', 'Pracucci', 'filprac', 'filippo.pracucci@studio.unibo.it', '$2y$10$8gv5SAgVq0dBH9lUM9Fy9udWWpUMIjXlgBPpjMBQx0sy7FjU3.wLq', NULL, NULL),
(8, 'Luigi', 'Bianchi', 'luibia', 'luigi.bianchi@nfa.com', '$2y$10$4xUD3Mog7NStE.Z94sfSdOpSe.PEKZMuvArFw7gxc1hb7qSzPuFMm', NULL, NULL),
(9, 'Lisa', 'Simpson', 'lisasimp', 'lisa.simpson@springfield.com', '$2y$10$9wuiYeOHnKkNN7dpb32Aa.F6FZsap7BGi65z50BD1G33bw187j5Zi', NULL, NULL),
(10, 'Bart', 'Simposon', 'bartsimp', 'bart.simpson@springfield.com', '$2y$10$4un/oGXOIOXRqBjzNFdVoOz72x4KDL47iHldAhcGM89cdk1EEzlUi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `IdVote` int(11) NOT NULL,
  `IdPost` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`IdVote`, `IdPost`, `IdUser`) VALUES
(18, 6, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdSrc` (`IdSrc`),
  ADD KEY `IdDst` (`IdDst`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`IdMedia`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`IdNotification`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`IdPost`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdMedia` (`IdMedia`),
  ADD KEY `IdPreview` (`IdPreview`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `IdCategory` (`IdCategory`);

--
-- Indexes for table `usercomment`
--
ALTER TABLE `usercomment`
  ADD PRIMARY KEY (`IdComment`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `userComment_ibfk_2` (`IdUser`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`),
  ADD UNIQUE KEY `Username_2` (`Username`,`Email`),
  ADD KEY `IdMedia` (`IdMedia`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`IdVote`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `IdUser` (`IdUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `IdMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `IdNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usercomment`
--
ALTER TABLE `usercomment`
  MODIFY `IdComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `IdVote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`IdSrc`) REFERENCES `utente` (`IdUser`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`IdDst`) REFERENCES `utente` (`IdUser`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`IdPreview`) REFERENCES `media` (`IdMedia`);

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`),
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`);

--
-- Constraints for table `usercomment`
--
ALTER TABLE `usercomment`
  ADD CONSTRAINT `userComment_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`),
  ADD CONSTRAINT `userComment_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`);

--
-- Constraints for table `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `utente` (`IdUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
