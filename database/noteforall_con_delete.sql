-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Feb 28, 2024 alle 18:41
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

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`IdCategory`, `Description`) VALUES
(1, 'Mathematics'),
(2, 'Physics'),
(3, 'Web'),
(4, 'Information Tecnology'),
(5, 'Philosophy'),
(6, 'Physical Education'),
(7, 'Robotics'),
(8, 'Electronic'),
(9, 'Software engineering'),
(10, 'Coding'),
(11, 'Database'),
(12, 'Data analysis'),
(14, 'matgg');

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
  `Id` int(11) NOT NULL,
  `IdSrc` int(11) NOT NULL,
  `IdDst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `follow`
--

INSERT INTO `follow` (`Id`, `IdSrc`, `IdDst`) VALUES
(1, 2, 1),
(3, 6, 2),
(4, 16, 2),
(5, 16, 12),
(6, 16, 6),
(7, 16, 1),
(8, 2, 15),
(9, 2, 11),
(10, 2, 8),
(11, 2, 7),
(12, 4, 8),
(14, 4, 2),
(15, 4, 16),
(16, 4, 6),
(17, 4, 15),
(18, 4, 3),
(19, 3, 16),
(20, 3, 4),
(21, 3, 1),
(28, 1, 9),
(35, 1, 2),
(37, 1, 13),
(38, 1, 3),
(41, 1, 11),
(42, 1, 15),
(43, 1, 6),
(44, 1, 4),
(51, 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `media`
--

CREATE TABLE `media` (
  `IdMedia` int(11) NOT NULL,
  `FileName` tinytext NOT NULL,
  `FilePath` tinytext NOT NULL,
  `Extension` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `media`
--

INSERT INTO `media` (`IdMedia`, `FileName`, `FilePath`, `Extension`) VALUES
(1, '20240118113546tramonto.jpg', 'uploads/20240118113546tramonto.jpg', NULL),
(2, 'Robotica_avanzata.pdf', 'uploads/Robotica_avanzata.pdf', NULL),
(3, 'roboticspreview.jpeg', 'uploads/roboticspreview.jpeg', NULL),
(4, 'Robotica_avanzata.pdf', 'uploads/Robotica_avanzata.pdf', NULL),
(5, 'roboticspreview.jpeg', 'uploads/roboticspreview.jpeg', NULL),
(6, 'Robotica_avanzata.pdf', 'uploads/Robotica_avanzata.pdf', NULL),
(7, 'roboticspreview.jpeg', 'uploads/roboticspreview.jpeg', NULL),
(8, '20240118115249colosseo.jpg', 'uploads/20240118115249colosseo.jpg', NULL),
(9, '20240118115600DCM184.feature.jarrodcastaing_1405145051.jpg', 'uploads/20240118115600DCM184.feature.jarrodcastaing_1405145051.jpg', NULL),
(10, '20240118115706Come-usare-Midjourney.jpg', 'uploads/20240118115706Come-usare-Midjourney.jpg', NULL),
(11, '20240118115913tiger-jpg.jpg', 'uploads/20240118115913tiger-jpg.jpg', NULL),
(12, '20240118120053nooo_telecamera.jpg', 'uploads/20240118120053nooo_telecamera.jpg', NULL),
(13, '20240118120521istockphoto-1201041782-612x612.jpg', 'uploads/20240118120521istockphoto-1201041782-612x612.jpg', NULL),
(14, '20240118120656buona-giornata-480x600.jpg', 'uploads/20240118120656buona-giornata-480x600.jpg', NULL),
(15, '20240118120928peugeot-3008-2023-09-prime-immagini_5.jpg', 'uploads/20240118120928peugeot-3008-2023-09-prime-immagini_5.jpg', NULL),
(16, '20240118121025immagini-frasi-sogni-1024x683.jpg', 'uploads/20240118121025immagini-frasi-sogni-1024x683.jpg', NULL),
(17, '20240118121230b7f8b60c070a510279da7e58aed5d27b.jpg', 'uploads/20240118121230b7f8b60c070a510279da7e58aed5d27b.jpg', NULL),
(18, '20240118121407disegni-disney-2.jpg', 'uploads/20240118121407disegni-disney-2.jpg', NULL),
(19, '20240118121515Imgs-Ints_Tabs-Training.png', 'uploads/20240118121515Imgs-Ints_Tabs-Training.png', NULL),
(20, '20240118121652immagini-e-frasi-d-amore-1.jpg', 'uploads/20240118121652immagini-e-frasi-d-amore-1.jpg', NULL),
(21, '20240118121752Buongiorno-immagini-1.jpg', 'uploads/20240118121752Buongiorno-immagini-1.jpg', NULL),
(22, '20240118121956Risoluzione_Immagine.jpg', 'uploads/20240118121956Risoluzione_Immagine.jpg', NULL),
(23, 'analisi1.pdf', 'uploads/analisi1.pdf', NULL),
(24, 'libri-per-analisi-1.jpg', 'uploads/libri-per-analisi-1.jpg', NULL),
(25, 'ricercaOperativa.pdf', 'uploads/ricercaOperativa.pdf', NULL),
(26, 'ro.png', 'uploads/ro.png', NULL),
(27, 'fisicatecnicaesercizi.pdf', 'uploads/fisicatecnicaesercizi.pdf', NULL),
(28, 'tecnica-ingegneria-pdf.jpg', 'uploads/tecnica-ingegneria-pdf.jpg', NULL),
(29, 'elettronica1.pdf', 'uploads/elettronica1.pdf', NULL),
(30, 'Schermata-2020-04-29-alle-11.17.09.png', 'uploads/Schermata-2020-04-29-alle-11.17.09.png', NULL),
(31, 'Ingegneria_software.pdf', 'uploads/Ingegneria_software.pdf', NULL),
(32, 'Ingegneria-del-software-e-fasi-del-processo-software.jpg', 'uploads/Ingegneria-del-software-e-fasi-del-processo-software.jpg', NULL),
(33, 'ProgrammazioneC.pdf', 'uploads/ProgrammazioneC.pdf', NULL),
(34, 'programmazione-C.jpg', 'uploads/programmazione-C.jpg', NULL),
(35, 'OOP.pdf', 'uploads/OOP.pdf', NULL),
(36, '1675079412122.png', 'uploads/1675079412122.png', NULL),
(37, 'Python_prog.pdf', 'uploads/Python_prog.pdf', NULL),
(38, 'trasferimento.jpeg', 'uploads/trasferimento.jpeg', NULL),
(39, 'Algebra_lineare.pdf', 'uploads/Algebra_lineare.pdf', NULL),
(40, 'geometria_e_algebra_lineare.png', 'uploads/geometria_e_algebra_lineare.png', NULL),
(41, 'MDP.pdf', 'uploads/MDP.pdf', NULL),
(42, 'image-1132.png', 'uploads/image-1132.png', NULL),
(43, 'Database.pdf', 'uploads/Database.pdf', NULL),
(44, 'unnamed.jpg', 'uploads/unnamed.jpg', NULL),
(45, 'Analisi_numerica.pdf', 'uploads/Analisi_numerica.pdf', NULL),
(46, 'trasferimento_(1).jpeg', 'uploads/trasferimento_(1).jpeg', NULL),
(47, 'Fisica3.pdf', 'uploads/Fisica3.pdf', NULL),
(48, 'i__id638_w960_t1487578519.jpg', 'uploads/i__id638_w960_t1487578519.jpg', NULL),
(49, 'Analisi_dei_dati.pdf', 'uploads/Analisi_dei_dati.pdf', NULL),
(50, 'data-analytics.jpg', 'uploads/data-analytics.jpg', NULL),
(51, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(52, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(53, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(54, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(55, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(56, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(57, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(58, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(59, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(60, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(61, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(62, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(63, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(64, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(65, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(66, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(67, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(68, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(69, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(70, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(71, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(72, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(73, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(74, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(75, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(76, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(77, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(78, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(79, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(80, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(81, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(82, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(83, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(84, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(85, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(86, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(87, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(88, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(89, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(90, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(91, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(92, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(93, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(94, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(95, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(96, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(97, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(98, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(99, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(100, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(101, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(102, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(103, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(104, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(105, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(106, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(107, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(108, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(109, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(110, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(111, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(112, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(113, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(114, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(115, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(116, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(117, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(118, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(119, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(120, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(121, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(122, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(123, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(124, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(125, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(126, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(127, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(128, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(129, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(130, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(131, 'Concorso23.pdf', 'uploads/Concorso23.pdf', NULL),
(132, 'immagini-frasi-sogni-1024x683.jpg', 'uploads/immagini-frasi-sogni-1024x683.jpg', NULL),
(133, 'Concorso24.pdf', 'uploads/Concorso24.pdf', NULL),
(134, 'long-eared-owl-4811501_1280.jpg', 'uploads/long-eared-owl-4811501_1280.jpg', NULL),
(135, 'CompitoBD_Ago22_sol.pdf', 'uploads/CompitoBD_Ago22_sol.pdf', NULL),
(136, 'bebe-sole-teletubbies-annuncia-gravidanza.png', 'uploads/bebe-sole-teletubbies-annuncia-gravidanza.png', NULL),
(137, '20240227182339long-eared-owl-4811501_1280.jpg', 'uploads/20240227182339long-eared-owl-4811501_1280.jpg', NULL),
(138, '20240227183209long-eared-owl-4811501_1280.jpg', 'uploads/20240227183209long-eared-owl-4811501_1280.jpg', NULL),
(139, '20240227183229bebe-sole-teletubbies-annuncia-gravidanza.png', 'uploads/20240227183229bebe-sole-teletubbies-annuncia-gravidanza.png', NULL),
(140, '20240227183722bebe-sole-teletubbies-annuncia-gravidanza.png', 'uploads/20240227183722bebe-sole-teletubbies-annuncia-gravidanza.png', NULL),
(141, '20240227183739MacBook_Pro_16__-_9.png', 'uploads/20240227183739MacBook_Pro_16__-_9.png', NULL),
(142, 'analisi1_(1).pdf', 'uploads/analisi1_(1).pdf', NULL),
(143, 'bebe-sole-teletubbies-annuncia-gravidanza.png', 'uploads/bebe-sole-teletubbies-annuncia-gravidanza.png', NULL),
(145, 'long-eared-owl-4811501_1280.jpg', 'uploads/long-eared-owl-4811501_1280.jpg', NULL),
(147, 'MacBook_Pro_16__-_9.png', 'uploads/MacBook_Pro_16__-_9.png', NULL),
(149, 'MacBook_Pro_16__-_3.png', 'uploads/MacBook_Pro_16__-_3.png', NULL),
(151, 'MacBook_Pro_16__-_9.png', 'uploads/MacBook_Pro_16__-_9.png', NULL),
(153, 'bebe-sole-teletubbies-annuncia-gravidanza.png', 'uploads/bebe-sole-teletubbies-annuncia-gravidanza.png', NULL),
(155, 'long-eared-owl-4811501_1280.jpg', 'uploads/long-eared-owl-4811501_1280.jpg', NULL),
(157, 'MacBook_Pro_16__-_9.png', 'uploads/MacBook_Pro_16__-_9.png', NULL),
(159, 'long-eared-owl-4811501_1280.jpg', 'uploads/long-eared-owl-4811501_1280.jpg', NULL),
(160, 'analisi1_(1).pdf', 'uploads/analisi1_(1).pdf', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `member`
--

CREATE TABLE `member` (
  `IdUser` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `NumberFollower` int(11) NOT NULL DEFAULT 0,
  `NumberPost` int(11) NOT NULL DEFAULT 0,
  `lastseen` datetime DEFAULT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Description` tinytext DEFAULT NULL,
  `IdMedia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `member`
--

INSERT INTO `member` (`IdUser`, `Name`, `Surname`, `NumberFollower`, `NumberPost`, `lastseen`, `Username`, `Email`, `Password`, `Description`, `IdMedia`) VALUES
(1, 'Mario', 'Rossi', 4, 0, '2024-02-28 18:40:06', 'marros', 'marros@email.com', '$2y$10$Dt5DhRWtqApYTnOTU.V3NeGkOebP5n2WZmCEjNpW4QWbsgvFuOcSy', NULL, 1),
(2, 'Riccardo', 'Penazzi', 4, 0, '2024-02-28 17:57:20', 'riki17', 'riccardo.penazzi@studio.unibo.it', '$2y$10$xeoloC4BWE09llxo5rKUF.kXiU6F9yVlvGQBHlzPiThtxl9egCCh6', NULL, 8),
(3, 'Filippo', 'Pracucci', 2, 0, NULL, 'filprac', 'filippo.pracucci@studio.unibo.it', '$2y$10$lT9Q4TD9bOkkcckQuWIsxO.3y/tzEDdhtJWjth4uIAILQ3Epf71..', NULL, 9),
(4, 'Davide', 'Marchetti', 2, 0, '2024-02-28 17:30:10', 'davmarc', 'davide.marchetti6@studio.unibo.it', '$2y$10$hYPOThyXgMqcUxI2fFUBBeaAMdkZoUikX1mJQMvPQyI6G2tRrU38S', NULL, 10),
(5, 'Ludovica', 'Verdi', 0, 0, NULL, 'ludoverdi', 'ludoverdi@email.com', '$2y$10$AKM/ANeg0rElvcBaLnXz1Ouo/YHbl9vZqoR3PihD4b69fADny/xM6', NULL, 11),
(6, 'Federica', 'Gialli', 3, 0, '2024-02-22 17:30:36', 'fedegialli', 'fedegialli@email.com', '$2y$10$4.aEOiSRI.iBwO2KKvxmMeiuRbef/AidjwuL2YdJj6YAN.Zd0TniO', NULL, 12),
(7, 'Lorenzo', 'Violi', 1, 0, NULL, 'lorenzovioli', 'lorenzovioli@email.com', '$2y$10$XuofQyhaubLyoJEZAfbVruvLzGeSSEb8FAgEz.VN4MJNPzEEmjG6G', NULL, 13),
(8, 'Mattia', 'Sedia', 2, 0, NULL, 'mattiasedia', 'mattiasedia@email.com', '$2y$10$0mgn8U.KfW3OHpdmbo5sz.EODQAgfYJBN62qU/Bsy88g9nrF2dCjG', NULL, 14),
(9, 'Francesca', 'Scatola', 1, 0, NULL, 'francescascatola', 'francescascatola@email.com', '$2y$10$F60mSY/2iLkabW.ULC0pMeGX2MynSS14lIr5N4KjtJMawlkNJolPe', NULL, 15),
(10, 'Valentina', 'Gufo', 0, 0, NULL, 'valegufo', 'valegufo@email.com', '$2y$10$3qM.FgFVWrwcqdhly06g1ed2204zJrNZavEalr.sav1pAJLB.Z3me', NULL, 16),
(11, 'Beatrice', 'Libro', 2, 0, NULL, 'bealibro', 'bealibro@email.com', '$2y$10$mklVad4UIPfc2VlDoNtsGuQa4YZQF1I5ANOy/0yPs8vhBUim5P0bG', NULL, 17),
(12, 'Ettore', 'Piastrella', 1, 0, NULL, 'ettorepiastrella', 'ettorepiastrella@email.com', '$2y$10$Ggry8J6DkPkwW78kCmnJou0xOzBh2341PsOF5Oxl8jPJzdXBKMbqW', NULL, 18),
(13, 'Adamo', 'Finestra', 1, 0, NULL, 'adamofinestra', 'adamofinestra@email.com', '$2y$10$jfU4ZH20vDtFlebu6GznAexjE2gNeel.GAoMTRlgvKJqhleCkJgWG', NULL, 19),
(14, 'Achille', 'Calendario', 0, 0, NULL, 'achillecalendario', 'achillecalendario@email.com', '$2y$10$4pT8RZx/KZQmhHYcX46FP.6qrKkXVIUHRODoLI/ecYtFC4D2RjMBO', NULL, 20),
(15, 'Gaia', 'Scala', 3, 0, NULL, 'gaiascala', 'gaiascala@email.com', '$2y$10$KLyCjBoOr6EoKyWDA/Ii0OGDTrAYeDL9q3tTSyNuivQAKmUCtJYQi', NULL, 21),
(16, 'Greta', 'Gradino', 2, 0, NULL, 'gretagradino', 'gretagradino@email.com', '$2y$10$zG5Li/FNCdziyW491THP.erY0YeBynssv9T3FKsjBS/gvSzJpLigS', NULL, 22),
(22, 'r', 'p', 0, 0, NULL, 'rp', 'rp@e', '$2y$10$KKGqTD.Kyy/PUl4vwMzvvuAnJP8Q93gZi0Pv5x/Fqr.JS/R40Fpl2', NULL, 137),
(23, 'r', 'p', 0, 0, NULL, 'rprp', 'rprp@e', '$2y$10$NLlAwf9SBe9GhJafpM2vbuOi.yni/Ch9VLp5oW5uMNs0X/2iYmdqq', NULL, 19),
(24, 'r', 'p', 0, 0, '2024-02-27 18:26:21', 'rprprp', 'rprprp@e', '$2y$10$K.4y2s.obE9R7mvXAfGLjO1BaiWBK6DqB/SlvddEklj69u4hTf93W', NULL, 19),
(26, 'r', 'p', 0, 0, NULL, 'rprprprp', 'rprprrpp@e', '$2y$10$K.4y2s.obE9R7mvXAfGLjO1BaiWBK6DqB/SlvddEklj69u4hTf93W', NULL, 19),
(27, 'yeueuwh', 'djbsdjsjs', 0, 0, '2024-02-27 18:29:14', 'dnjsns', 'jndjsnjs@eh', '$2y$10$MmMbiwuFJdS6DGR0WEpGhe5JKcOUBhDD631OQksNPnNLm4hzfqlnm', NULL, 19),
(28, 'bddhdffnj', 'ncsknsn', 0, 0, '2024-02-27 18:31:48', 'jjjjjjj', 'jfjfjfjf@em', '$2y$10$Ya603xFguDkmNE1TsSGiNeQbvWGr.T254GYDdB3slthVsnBlyt62y', NULL, 19),
(29, 'bddhdffnj', 'ncsknsneeres', 0, 0, '2024-02-27 18:32:10', 'jjjjjjjssdsds', 'jfjfjfjf@emeree', '$2y$10$Q6EXZhXFs3hvggVQfKIytOIQi.lSuK7bATCa3jWBw/xhyHYBTwQBG', NULL, 19),
(30, 'fsdfsdsf', 'ffsfdssf', 0, 0, '2024-02-27 18:32:29', 'aasasasasasas', 'sfsfsfsfssf@ekekek', '$2y$10$NstNxHUIq/H/hEo02/ZTCOylgXOq6t.VMHmijFy0I5Tc1YJb9IosW', NULL, 19),
(31, 'rrrrrr', 'janjajajjsaj', 0, 0, '2024-02-27 18:36:25', 'kdkdksojsjsdosokdo', 'jddjdjdjsnsjs@email', '$2y$10$DDtBG/VOdN1BEKDIpiXgbudHWLTJvBssjmYnMI90RoRItine79xly', NULL, 19),
(32, 'saajsja', 'nkkasjksajkjsa', 0, 0, '2024-02-27 18:36:48', 'jjjjsjsjsakjskaj', 'jakkakjasajkkja@eejejje', '$2y$10$En9K8NM5H.jnK4stN5vVu.3VMEi1kjb7/unbXm96HcJyoLTNf0eA.', '', 141);

-- --------------------------------------------------------

--
-- Struttura della tabella `message`
--

CREATE TABLE `message` (
  `IdMsg` int(11) NOT NULL,
  `Content` longtext NOT NULL,
  `DateTime` datetime DEFAULT current_timestamp(),
  `IdSrc` int(11) NOT NULL,
  `IdDst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `message`
--

INSERT INTO `message` (`IdMsg`, `Content`, `DateTime`, `IdSrc`, `IdDst`) VALUES
(1, 'prova inserimento', '2024-02-20 16:49:57', 3, 1),
(2, 'seconda prova', '2024-02-20 16:50:44', 1, 2),
(3, 'Ultima prova', '2024-02-20 16:51:28', 2, 1),
(4, 'Hello\n', '2024-02-24 12:25:36', 1, 8),
(5, 'ciao', '2024-02-27 16:03:58', 1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `IdNotification` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Description` tinytext NOT NULL,
  `IsRead` tinyint(1) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdTarget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO `notification` (`IdNotification`, `Type`, `Description`, `IsRead`, `IdUser`, `IdTarget`) VALUES
(1, 'Follower', 'riki17 started following you', 1, 1, 1),
(3, 'Follower', 'fedegialli started following you', 1, 2, 3),
(7, 'Follower', 'gretagradino started following you', 1, 2, 4),
(8, 'Follower', 'gretagradino started following you', 0, 12, 5),
(9, 'Follower', 'gretagradino started following you', 0, 6, 6),
(10, 'Follower', 'gretagradino started following you', 1, 1, 7),
(11, 'Follower', 'riki17 started following you', 0, 15, 8),
(12, 'Follower', 'riki17 started following you', 0, 11, 9),
(13, 'Follower', 'riki17 started following you', 0, 8, 10),
(14, 'Follower', 'riki17 started following you', 0, 7, 11),
(15, 'Follower', 'davmarc started following you', 0, 8, 12),
(17, 'Follower', 'davmarc started following you', 1, 2, 14),
(18, 'Follower', 'davmarc started following you', 0, 16, 15),
(19, 'Follower', 'davmarc started following you', 0, 6, 16),
(20, 'Follower', 'davmarc started following you', 0, 15, 17),
(21, 'Follower', 'davmarc started following you', 1, 3, 18),
(22, 'Follower', 'filprac started following you', 0, 16, 19),
(23, 'Follower', 'filprac started following you', 1, 4, 20),
(24, 'Follower', 'filprac started following you', 1, 1, 21),
(47, 'Comment', 'marros added a comment to your post', 1, 2, 4),
(49, 'Comment', 'marros added a comment to your post', 1, 2, 5),
(50, 'Comment', 'marros added a comment to your post', 1, 2, 6),
(51, 'Comment', 'marros added a comment to your post', 1, 2, 7),
(52, 'Comment', 'marros added a comment to your post', 1, 2, 8),
(53, 'Like', 'marros liked your post', 1, 2, 18),
(54, 'Like', 'marros liked your post', 0, 3, 19),
(56, 'Comment', 'marros added a comment to your post', 1, 2, 9),
(57, 'Follower', 'marros started following you', 0, 9, 28),
(58, 'Comment', 'marros added a comment to your post', 0, 3, 10),
(59, 'Like', 'marros liked your post', 0, 3, 21),
(60, 'Comment', 'marros added a comment to your post', 1, 2, 11),
(61, 'Comment', 'marros added a comment to your post', 1, 2, 12),
(63, 'Comment', 'marros added a comment to your post', 1, 2, 13),
(65, 'Comment', 'marros added a comment to your post', 1, 2, 14),
(69, 'Like', 'marros liked your post', 1, 2, 27),
(76, 'Follower', 'marros started following you', 1, 2, 35),
(78, 'Follower', 'marros started following you', 0, 13, 37),
(79, 'Follower', 'marros started following you', 0, 3, 38),
(82, 'Follower', 'marros started following you', 0, 11, 41),
(83, 'Follower', 'marros started following you', 0, 15, 42),
(84, 'Follower', 'marros started following you', 0, 6, 43),
(85, 'Follower', 'marros started following you', 0, 4, 44),
(107, 'Like', 'marros liked your post', 0, 16, 46),
(113, 'Like', 'marros liked your post', 1, 2, 48),
(114, 'Like', 'riki17 liked your post', 1, 1, 49),
(115, 'Comment', 'riki17 added a comment to your post', 1, 1, 16),
(116, 'Like', 'davmarc liked your post', 1, 1, 50),
(117, 'Comment', 'davmarc added a comment to your post', 1, 1, 17),
(120, 'Follower', 'davmarc started following you', 1, 1, 51),
(123, 'Like', 'riki17 liked your post', 1, 1, 53),
(124, 'Comment', 'riki17 added a comment to your post', 1, 1, 20),
(125, 'Comment', 'riki17 added a comment to your post', 1, 1, 21),
(126, 'Comment', 'riki17 added a comment to your post', 1, 1, 22);

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
  `Date` datetime DEFAULT NULL,
  `Private` tinyint(1) NOT NULL DEFAULT 0,
  `IdUser` int(11) NOT NULL,
  `IdMedia` int(11) NOT NULL,
  `IdPreview` int(11) DEFAULT NULL,
  `IdCategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`IdPost`, `Title`, `Description`, `NumberVote`, `NumberComment`, `Date`, `Private`, `IdUser`, `IdMedia`, `IdPreview`, `IdCategory`) VALUES
(4, 'Appunti di ricerca operativa - terzo anno ISI', 'Questo post raccoglie appunti approfonditi relativi al corso di Ricerca Operativa tenuto presso l\'Istituto Superiore di Informatica (ISI) durante il terzo anno di studi. Gli appunti sono concepiti per fornire agli studenti un\'ampia comprensione degli argomenti trattati nel corso, offrendo chiarimenti, esempi pratici e risorse utili per la preparazione agli esami.\r\n\r\nI principali contenuti degli appunti includono:\r\n\r\nIntroduzione alla Ricerca Operativa: Un\'analisi dettagliata delle basi concettuali della Ricerca Operativa, con un\'enfasi particolare sulle sue applicazioni pratiche e impatti nel contesto dell\'informatica.\r\n\r\nMetodi di Ottimizzazione: Approfondimento dei metodi di ottimizzazione utilizzati nella Ricerca Operativa, compresi algoritmi di programmazione lineare, programmazione intera e tecniche di programmazione dinamica.\r\n\r\nAnalisi di Sensibilità: Spiegazioni dettagliate sull\'analisi di sensibilità e il suo ruolo nella valutazione delle decisioni strategiche in situazioni complesse.\r\n\r\nModellazione dei Problemi: Guida pratica alla modellazione dei problemi reali in scenari che richiedono soluzioni di Ricerca Operativa. Gli esempi illustrano come tradurre situazioni complesse in modelli matematici risolvibili.\r\n\r\nCasi di Studio e Applicazioni Pratiche: Esplorazione di casi di studio rilevanti e applicazioni pratiche della Ricerca Operativa nell\'ambito dell\'Informatica e oltre.\r\n\r\nQuesti appunti sono destinati a fornire un\'utile risorsa di studio per gli studenti del terzo anno presso l\'ISI, facilitando la comprensione dei concetti chiave della Ricerca Operativa e supportando la preparazione agli esami.', 1, 0, '2024-01-18 12:33:06', 0, 16, 25, 26, 1),
(5, 'Fisica tecnica - esercizi completi ', 'Questo post è una raccolta completa di esercizi di Fisica Tecnica, progettata per offrire agli studenti un\'opportunità pratica di applicare i concetti teorici appresi durante il corso. Gli esercizi coprono una vasta gamma di argomenti fondamentali in Fisica Tecnica e sono strutturati per fornire una comprensione approfondita e un\'abilità pratica nella risoluzione di problemi.\r\n\r\nGli argomenti trattati includono, ma non sono limitati a:\r\n\r\nTrasmissione del Calore: Esercizi che coinvolgono la conduzione, la convezione e l\'irraggiamento termico, con applicazioni pratiche in sistemi di isolamento termico e scambio di calore.\r\n\r\nTermodinamica Applicata: Problemi che esplorano cicli termodinamici, leggi della termodinamica, e applicazioni pratiche nell\'ottimizzazione di processi energetici.\r\n\r\nFluidodinamica Applicata: Esercizi che coinvolgono la dinamica dei fluidi, flusso in condotte, perdite di carico e applicazioni nella progettazione di sistemi di raffreddamento.\r\n\r\nApplicazioni Pratiche di Fisica Tecnica: Esercizi basati su situazioni reali in cui gli studenti devono applicare i principi della Fisica Tecnica per risolvere problemi specifici in ambiti come l\'edilizia, l\'energia e l\'ambiente.\r\n\r\nTrasmissione del Suono e dell\'Acustica: Problemi che coinvolgono la propagazione del suono, la riflessione e l\'assorbimento acustico, con applicazioni pratiche nella progettazione di ambienti acusticamente confortevoli.\r\n\r\nGli esercizi sono accompagnati da soluzioni dettagliate e spiegazioni passo-passo per consentire agli studenti di comprendere appieno i processi di risoluzione. Questa risorsa mira a essere un supporto completo per lo studio e la preparazione agli esami di Fisica Tecnica.', 0, 0, '2024-01-18 12:36:06', 0, 7, 27, 28, 2),
(6, 'Elettronica 1 - appunti di elettronica 1', 'Questo post fornisce una dettagliata raccolta di appunti dedicati al corso di Elettronica 1. Gli appunti sono pensati per gli studenti che stanno seguendo questo corso e mirano a offrire una guida completa attraverso i concetti fondamentali dell\'elettronica.\r\n\r\nGli argomenti trattati includono, ma non sono limitati a:\r\n\r\nTeoria dei Circuiti: Concetti di base sui circuiti elettrici, leggi di Kirchhoff, analisi di circuiti in corrente continua (DC) e in corrente alternata (AC).\r\n\r\nComponenti Elettronici: Descrizione e caratteristiche di componenti fondamentali come resistenze, condensatori, induttori, diodi, transistor, e amplificatori operazionali.\r\n\r\nAnalisi di Circuiti Trifase: Studio dei sistemi di alimentazione elettrica trifase, equilibrio di potenza, e analisi dei circuiti trifase.\r\n\r\nElettronica Digitale: Introduzione ai concetti di logica digitale, porte logiche, flip-flop, contatori, e circuiti combinatori.\r\n\r\nAmplificatori e Circuiti di Potenza: Approfondimento sugli amplificatori elettronici e sui circuiti di potenza, con un focus sulle applicazioni pratiche e sulle caratteristiche di progettazione.\r\n\r\nFiltri Elettronici: Studio di filtri attivi e passivi, con un\'attenzione particolare ai filtri di primo e secondo ordine e alle loro applicazioni.\r\n\r\nGli appunti sono organizzati in modo chiaro e strutturato, con esempi pratici e illustrazioni per facilitare la comprensione degli studenti. Ogni sezione è corredata da esercizi e problemi risolti per permettere agli studenti di mettere in pratica quanto appreso durante il corso. Questa risorsa è ideale per consolidare la conoscenza in Elettronica 1 e prepararsi efficacemente per gli esami.', 0, 0, '2024-01-18 12:38:27', 0, 7, 29, 30, 8),
(7, 'Appunti di ingegneria del software', 'Questo post contiene una completa raccolta di appunti dedicati al corso di Ingegneria del Software. Gli appunti sono pensati per gli studenti che stanno seguendo questo corso e forniscono un approfondimento su concetti chiave e metodologie utilizzate nella progettazione e sviluppo del software.\r\n\r\nGli argomenti trattati includono, ma non sono limitati a:\r\n\r\nCiclo di Vita del Software: Descrizione delle fasi principali del ciclo di vita del software, tra cui analisi, progettazione, implementazione, testing, manutenzione, e gestione.\r\n\r\nModelli di Sviluppo del Software: Studio dei diversi modelli di sviluppo, come il modello a cascata, il modello a spirale, il modello incrementale, e metodologie agili come Scrum e Kanban.\r\n\r\nRequisiti del Software: Approfondimento sulla raccolta, analisi e documentazione dei requisiti software, con un focus sulla creazione di documenti di specifica.\r\n\r\nProgettazione del Software: Concetti di progettazione architetturale e dettagliata, con l\'uso di diagrammi UML (Unified Modeling Language).\r\n\r\nTesting del Software: Strategie di testing, tipologie di test, e metodologie per garantire la qualità del software.\r\n\r\nGestione di Progetto Software: Principi di gestione del progetto software, pianificazione, assegnazione delle risorse, monitoraggio e controllo.\r\n\r\nQualità del Software: Approfondimento sulla gestione della qualità del software, normative e standard di settore.\r\n\r\nGli appunti forniscono esempi pratici, casi studio, e risorse aggiuntive per agevolare la comprensione degli studenti. Sono pensati come guida completa per prepararsi agli esami e per sviluppare competenze pratiche nell\'ambito dell\'Ingegneria del Software.', 0, 0, '2024-01-18 12:42:07', 0, 7, 31, 32, 9),
(8, 'Programmazione C - appunti di programmazione C ', 'Questo post è una preziosa risorsa contenente appunti dettagliati dedicati al linguaggio di programmazione C. Gli appunti sono pensati per studenti di informatica, ingegneria informatica o per chiunque voglia imparare o approfondire le basi della programmazione utilizzando il linguaggio C.\r\n\r\nGli argomenti trattati includono, ma non sono limitati a:\r\n\r\nIntroduzione a C: Concetti di base, la struttura di un programma C, dichiarazione e inizializzazione delle variabili.\r\n\r\nControllo di Flusso: I costrutti di controllo come if, else, switch, e cicli come for, while, e do-while.\r\n\r\nFunzioni: Creazione, dichiarazione e chiamata di funzioni. Passaggio di parametri e ritorno di valori.\r\n\r\nPuntatori: Concetti fondamentali sui puntatori, gestione della memoria e utilizzo in operazioni avanzate.\r\n\r\nStrutture Dati: Utilizzo di strutture per raggruppare dati correlati, definizione e manipolazione di array.\r\n\r\nFile I/O: Operazioni di input/output su file, lettura e scrittura di dati su file.\r\n\r\nAllocazione Dinamica della Memoria: Utilizzo delle funzioni malloc e free per gestire la memoria dinamicamente.\r\n\r\nStringhe: Manipolazione di stringhe, funzioni di libreria per operazioni stringa.\r\n\r\nGli appunti includono esempi pratici, codice sorgente, e spiegazioni dettagliate per consentire agli studenti di acquisire familiarità con il linguaggio C. Sia per chi sta iniziando la propria avventura nella programmazione che per chi cerca di approfondire le proprie competenze, questi appunti forniscono una guida completa e accessibile.', 1, 4, '2024-01-18 12:44:27', 0, 2, 33, 34, 10),
(9, 'OOP - object oriented programming ', 'Questo post costituisce una guida completa per chi desidera approfondire i fondamenti della Programmazione Orientata agli Oggetti (OOP). Rivolto a studenti di informatica, sviluppatori in erba e a chiunque voglia acquisire competenze nell\'OOP, il post offre un\'introduzione chiara e dettagliata ai concetti fondamentali della programmazione orientata agli oggetti.\r\n\r\nArgomenti Trattati:\r\n\r\nPrincipi Fondamentali: Spiegazione dei principi chiave dell\'OOP, tra cui incapsulamento, ereditarietà e polimorfismo.\r\n\r\nClassi e Oggetti: Definizione di classi e creazione di oggetti. Illustrazione di come le classi siano utilizzate per modellare oggetti del mondo reale.\r\n\r\nEreditarietà: Approfondimento sulla creazione di nuove classi basate su classi esistenti. Discussione dei concetti di classe base e classe derivata.\r\n\r\nPolimorfismo: Spiegazione di come il polimorfismo consenta a oggetti di classi diverse di rispondere allo stesso messaggio in modi specifici alla propria classe.\r\n\r\nIncapsulamento: Importanza e implementazione dell\'incapsulamento per nascondere dettagli di implementazione e garantire l\'integrità del sistema.\r\n\r\nAbstract Classes e Interfacce: Introduzione alle classi astratte e alle interfacce, elementi chiave per la progettazione di sistemi complessi.\r\n\r\nCostruttori e Distruttori: Ruolo dei costruttori e distruttori nelle classi, con esempi pratici.\r\n\r\nEsempi Pratici: Applicazione degli argomenti trattati attraverso esempi di codice, con focus su scenari realistici.\r\n\r\nQuesto post fornisce una base solida per chiunque desideri comprendere e applicare i principi dell\'OOP nei propri progetti di sviluppo software. Che tu sia alle prime armi o desideri consolidare le tue conoscenze, questa risorsa sarà un valido punto di partenza.', 1, 4, '2024-01-18 12:46:03', 0, 2, 35, 36, 10),
(10, 'Programmazione python - numpy e pandas', 'Questo post serve come guida completa per l\'utilizzo di NumPy e Pandas nella programmazione in Python, focalizzandosi sulla manipolazione avanzata di dati e analisi. Rivolto a programmatori Python di tutti i livelli, il post fornisce una panoramica dettagliata di NumPy e Pandas, due librerie essenziali per il trattamento efficiente di dati in Python.\r\n\r\nArgomenti Trattati:\r\n\r\nIntroduzione a NumPy:\r\n\r\nSpiegazione dei concetti chiave di NumPy.\r\nCreazione e manipolazione di array NumPy.\r\nOperazioni vettorializzate e broadcasting.\r\nLavorare con Pandas:\r\n\r\nCreazione di Serie e DataFrame in Pandas.\r\nCaricamento e manipolazione di dati tabulari.\r\nOperazioni di pulizia e preparazione dei dati.\r\nOperazioni Avanzate con NumPy e Pandas:\r\n\r\nIndicizzazione avanzata e selezione di dati.\r\nApplicazione di funzioni e trasformazioni su dati in modo efficiente.\r\nAnalisi Esplorativa dei Dati (EDA):\r\n\r\nUtilizzo di Pandas per eseguire analisi statistiche di base.\r\nVisualizzazione di dati utilizzando librerie come Matplotlib e Seaborn.\r\nIntegrazione di NumPy e Pandas:\r\n\r\nCome combinare efficacemente le funzionalità di NumPy e Pandas per un\'analisi completa.\r\nGestione di Grandi Dati:\r\n\r\nOttimizzazione delle prestazioni con NumPy e Pandas per dataset di grandi dimensioni.\r\nUtilizzo di tecniche di chunking e parallelismo.\r\nProgetti Pratici:\r\n\r\nApplicazione degli argomenti trattati a casi di studio reali.\r\nCreazione di script Python per risolvere problemi pratici di analisi dati.\r\nQuesto post fornisce una base solida per chiunque voglia padroneggiare NumPy e Pandas per la manipolazione e l\'analisi dei dati in Python. Che tu sia uno sviluppatore Python alle prime armi o un professionista che desidera migliorare le tue competenze di data science, questa risorsa ti guiderà attraverso gli aspetti chiave di queste librerie essenziali.', 1, 2, '2024-01-18 12:47:57', 0, 2, 37, 38, 10),
(11, 'Algebra lineare e geometria - nuovo corso', 'Benvenuti nel nostro nuovo corso che esplora in profondità gli aspetti fondamentali dell\'algebra lineare e della geometria. Questo corso è progettato per studenti di matematica, fisica, informatica e ingegneria, offrendo una solida base concettuale e applicativa in queste discipline cruciali.\r\n\r\nArgomenti Trattati:\r\n\r\nIntroduzione all\'Algebra Lineare:\r\n\r\nConcetti di vettori e spazi vettoriali.\r\nOperazioni con matrici e determinanti.\r\nSistemi di equazioni lineari.\r\nTrasformazioni Lineari:\r\n\r\nComprendere le trasformazioni e le applicazioni pratiche.\r\nMatrici e operatori lineari.\r\nSpazi Euclidei e Geometria Vettoriale:\r\n\r\nConcetti di spazi euclidei.\r\nProdotti scalari e ortogonalità.\r\nApplicazioni geometriche.\r\nAutospazi e Autovettori:\r\n\r\nDefinizione e proprietà degli autospazi.\r\nDiagonalizzazione delle matrici.\r\nGeometria Analitica:\r\n\r\nCoordinate cartesiane nello spazio.\r\nCurve e superfici.\r\nApplicazioni in Informatica e Fisica:\r\n\r\nRuolo dell\'algebra lineare e della geometria in informatica e fisica applicata.\r\nEsempi pratici e progetti.\r\nProgetti Avanzati e Problem Solving:\r\n\r\nRisoluzione di problemi avanzati utilizzando gli strumenti appresi.\r\nProgetti pratici e applicazioni reali.\r\nQuesto corso offre un\'esperienza di apprendimento coinvolgente con lezioni interattive, esempi pratici e progetti che consentiranno agli studenti di acquisire familiarità con le nozioni di algebra lineare e geometria e di applicarle in contesti reali. Che tu sia uno studente che si avvicina per la prima volta a questi argomenti o un professionista che cerca di approfondire le tue conoscenze, questo corso è progettato per te.', 0, 0, '2024-01-18 12:51:46', 0, 15, 39, 40, 1),
(12, 'MDP - matematica discreta e probabilità', 'Benvenuti nel nostro viaggio attraverso il mondo affascinante della matematica discreta e delle probabilità. Questo post offre un\'immersione approfondita in concetti chiave e applicazioni pratiche di queste discipline essenziali per la teoria dell\'informazione, l\'informatica, la teoria dei giochi e molti altri campi.\r\n\r\nArgomenti Trattati:\r\n\r\nMatematica Discreta:\r\n\r\nConcetti fondamentali di insiemi, relazioni e funzioni.\r\nTeoria dei grafi e sue applicazioni.\r\nLogica proposizionale e predicativa.\r\nProbabilità di Base:\r\n\r\nFondamenti della teoria delle probabilità.\r\nEventi, spazi campione e probabilità condizionata.\r\nDistribuzioni discrete.\r\nTeoria dei Numeri:\r\n\r\nNumeri primi e loro proprietà.\r\nTeorema cinese del resto.\r\nCrittografia basata sui numeri primi.\r\nCombinatoria:\r\n\r\nConteggio e principi combinatori.\r\nBinomiale e coefficienti multinomiali.\r\nProblemi di disposizione e combinazione.\r\nAlgoritmi e Complessità:\r\n\r\nAlgoritmi di base in matematica discreta.\r\nComplessità computazionale e teoria degli algoritmi.\r\nProbabilità Avanzata:\r\n\r\nVariabili casuali continue.\r\nDistribuzioni continue e legge dei grandi numeri.\r\nApplicazioni in statistica.\r\nApplicazioni Pratiche e Progetti:\r\n\r\nUtilizzo di strumenti matematici discreti in informatica.\r\nApplicazioni della teoria delle probabilità in scenari reali.\r\nProgetti pratici per applicare le conoscenze acquisite.\r\nChe tu stia cercando di approfondire la comprensione della matematica discreta, delle probabilità o entrambe, questo post offre un percorso completo che si adatta alle tue esigenze. Scopri le connessioni tra questi argomenti affascinanti e come possono essere applicati in diversi contesti accademici e professionali.', 0, 0, '2024-01-18 12:56:24', 0, 4, 41, 42, 1),
(13, 'Database - basi di dati', 'Benvenuti in un viaggio avvincente nel vasto mondo delle basi di dati e dei database. Questo post fornisce una panoramica completa delle basi di dati, spaziando dalle fondamenta concettuali ai concetti più avanzati utilizzati nell\'ambito della gestione delle informazioni.\r\n\r\nArgomenti Trattati:\r\n\r\nIntroduzione alle Basi di Dati:\r\n\r\nDefinizione di base e importanza delle basi di dati.\r\nDifferenza tra dati e informazioni.\r\nRuolo cruciale delle basi di dati nella gestione delle informazioni.\r\nModello Relazionale:\r\n\r\nConcetti fondamentali dei database relazionali.\r\nTabelle, chiavi primarie e relazioni.\r\nNormalizzazione per garantire la coerenza dei dati.\r\nQuery SQL:\r\n\r\nLinguaggio SQL per interrogare i database.\r\nSelezione, proiezione e unione di dati.\r\nOttimizzazione delle query.\r\nSchemi di Progettazione:\r\n\r\nProgettare schemi di database efficaci.\r\nRelazioni uno a uno, uno a molti e molti a molti.\r\nGestione delle chiavi esterne.\r\nTransazioni e Controllo di Concorrenza:\r\n\r\nConcetti chiave di transazioni in un database.\r\nControllo delle concorrenze per garantire l\'integrità dei dati.\r\nGestione degli errori e dei rollback.\r\nSistemi di Gestione di Database (DBMS):\r\n\r\nRuolo e funzioni principali di un DBMS.\r\nTipi di DBMS e scelta del sistema più adatto.\r\nSicurezza e backup del database.\r\nDatabase NoSQL:\r\n\r\nIntroduzione ai database NoSQL.\r\nDifferenze rispetto ai database relazionali.\r\nApplicazioni e casi d\'uso comuni.\r\nBig Data e Scalabilità:\r\n\r\nTrattare con grandi volumi di dati.\r\nSoluzioni per la scalabilità dei database.\r\nTecnologie emergenti nel campo del big data.\r\nProgetti Pratici e Case Study:\r\n\r\nCreazione di un database di esempio.\r\nRisoluzione di problemi di progettazione del database.\r\nAnalisi di casi studio reali.\r\nChe tu sia uno studente alle prime armi, un professionista del settore IT o semplicemente interessato a comprendere meglio il funzionamento dei database, questo post ti guiderà attraverso i concetti chiave, le pratiche consigliate e le applicazioni reali di questa disciplina cruciale nell\'era digitale.', 0, 0, '2024-01-18 12:58:09', 0, 4, 43, 44, 11),
(14, 'Analisi numerica - appunti di analisi numerica e distribuzioni ', 'Benvenuti in un\'avventura matematica che esplorerà le profondità dell\'analisi numerica e le affascinanti distribuzioni matematiche. Questo post offre una panoramica completa degli strumenti e delle tecniche utilizzate nell\'analisi numerica, arricchendo la comprensione con l\'esplorazione delle distribuzioni matematiche e delle loro applicazioni.\r\n\r\nArgomenti Trattati:\r\n\r\nIntroduzione all\'Analisi Numerica:\r\n\r\nDefinizione e importanza dell\'analisi numerica.\r\nRuolo nell\'approssimazione e risoluzione di problemi matematici.\r\nErrori e approssimazioni.\r\nMetodi Iterativi e Algoritmi Numerici:\r\n\r\nMetodi di bisezione, Newton-Raphson, e altri.\r\nConcetti fondamentali degli algoritmi numerici.\r\nImplementazioni pratiche.\r\nInterpolazione e Approssimazione:\r\n\r\nInterpolazione polinomiale.\r\nMetodo dei minimi quadrati.\r\nCurve di interpolazione.\r\nIntegrazione Numerica:\r\n\r\nMetodi di quadratura numerica.\r\nRegole del trapezio, di Simpson, e altri.\r\nApplicazioni in problemi del mondo reale.\r\nRisoluzione di Equazioni Differenziali:\r\n\r\nMetodi numerici per equazioni differenziali ordinarie.\r\nAnalisi di equazioni differenziali parziali.\r\nSimulazioni e modelli matematici.\r\nDistribuzioni Matematiche:\r\n\r\nConcetti di base sulle distribuzioni.\r\nDistribuzioni discrete e continue.\r\nDistribuzioni normali, di Poisson, ed esponenziali.\r\nTeoria delle Probabilità:\r\n\r\nFondamenti della teoria delle probabilità.\r\nEventi, spazi campionari, e probabilità condizionata.\r\nConcetti chiave per comprendere le distribuzioni.\r\nApplicazioni Pratiche:\r\n\r\nRisoluzione di problemi numerici complessi.\r\nAnalisi di dati reali attraverso distribuzioni matematiche.\r\nProgetti e esercizi pratici.\r\nChe tu sia uno studente di matematica, un professionista impegnato nell\'analisi numerica o un appassionato del mondo delle distribuzioni matematiche, questo post ti guiderà attraverso un viaggio coinvolgente, fornendo approfondimenti pratici e applicazioni reali di queste discipline affascinanti.', 1, 0, '2024-01-18 13:00:09', 0, 3, 45, 46, 1),
(15, 'Fisica 3 - appunti avanzati di fisica 3 ', 'Benvenuti in un viaggio appassionante attraverso la fisica avanzata! Questo post offre appunti dettagliati e accurati per il corso di Fisica 3, progettati per coloro che cercano una comprensione approfondita di concetti avanzati della fisica. Preparati a immergerti in teorie avanzate, esperimenti sofisticati e applicazioni pratiche che porteranno la tua comprensione della fisica al livello successivo.\r\n\r\nArgomenti Trattati:\r\n\r\nMeccanica Quantistica:\r\n\r\nPrincipi fondamentali della meccanica quantistica.\r\nEquazione di Schrödinger e stati quantici.\r\nEsperimenti fondamentali: doppia fenditura, intrappolamento quantico.\r\nTeoria dei Campi:\r\n\r\nConcetti di base della teoria dei campi.\r\nCampi scalari, vettoriali e tensoriali.\r\nInterazioni fondamentali e particelle elementari.\r\nRelatività Ristretta e Generale:\r\n\r\nPrincipi della relatività.\r\nTrasformazioni di Lorentz e dilatazione del tempo.\r\nCurvatura dello spazio-tempo secondo Einstein.\r\nFisica delle Particelle:\r\n\r\nStudio delle particelle subatomiche.\r\nAcceleratori di particelle e rivelatori.\r\nModelli standard e oltre.\r\nTermodinamica Statistica:\r\n\r\nFondamenti della termodinamica statistica.\r\nEntropia, distribuzioni di probabilità e leggi del moto browniano.\r\nApplicazioni alle transizioni di fase.\r\nOnde Elettromagnetiche Avanzate:\r\n\r\nEquazioni di Maxwell in forma avanzata.\r\nProprietà delle onde elettromagnetiche.\r\nApplicazioni alle onde elettromagnetiche avanzate.\r\nTeoria del Caos e Sistemi Complessi:\r\n\r\nPrincipi della teoria del caos.\r\nDinamica dei sistemi complessi.\r\nApplicazioni alla modellazione del mondo reale.\r\nApplicazioni Pratiche e Progetti Avanzati:\r\n\r\nEsperimenti e progetti avanzati di laboratorio.\r\nApplicazioni pratiche delle teorie avanzate.\r\nProspettive future e nuove frontiere della fisica.\r\nPreparati per un\'esperienza di apprendimento stimolante, dove la fisica diventa una vera e propria avventura intellettuale. Questi appunti avanzati ti guideranno attraverso le sfide concettuali e le meraviglie della fisica, fornendo una base solida per coloro che desiderano approfondire la loro comprensione della disciplina.', 0, 0, '2024-01-18 13:02:00', 0, 3, 47, 48, 2),
(16, 'Analisi dei dati - analisi dei dati con supporto di strumenti informatici', 'Benvenuti in un viaggio nel mondo dell\'analisi dei dati potenziato dalla potenza degli strumenti informatici! Questo post offre una panoramica completa e pratica sull\'analisi dei dati, con un focus particolare sull\'utilizzo di strumenti informatici avanzati per ottenere risultati significativi. Che tu sia uno studente, un professionista o un appassionato di dati, queste informazioni ti guideranno attraverso le fondamenta e le applicazioni avanzate dell\'analisi dei dati.\r\n\r\nArgomenti Trattati:\r\n\r\nIntroduzione all\'Analisi dei Dati:\r\n\r\nConcetti fondamentali dell\'analisi dei dati.\r\nImportanza dell\'analisi dei dati nelle decisioni aziendali e scientifiche.\r\nStrumenti Informatici per l\'Analisi dei Dati:\r\n\r\nPanoramica di strumenti come Python, R, e SQL per l\'analisi dei dati.\r\nUtilizzo di librerie e framework specializzati.\r\nRaccolta e Preparazione dei Dati:\r\n\r\nMetodi per raccogliere dati da diverse fonti.\r\nTecniche di pulizia e preparazione dei dati per l\'analisi.\r\nAnalisi Statistica:\r\n\r\nMetodi statistici di base e avanzati.\r\nInterpretazione dei risultati statistici.\r\nVisualizzazione dei Dati:\r\n\r\nRuolo chiave della visualizzazione dei dati.\r\nCreazione di grafici e visualizzazioni efficaci.\r\nApprendimento Automatico e Analisi Predittiva:\r\n\r\nConcetti di base di machine learning.\r\nApplicazioni dell\'analisi predittiva.\r\nAnalisi dei Grandi Dati:\r\n\r\nGestione e analisi di grandi volumi di dati.\r\nApprocci distribuiti e tecnologie Big Data.\r\nProgetti Pratici di Analisi dei Dati:\r\n\r\nEsempi pratici di progetti di analisi dei dati.\r\nApplicazioni reali e casi di studio.\r\nTendenze Future e Sfide:\r\n\r\nSviluppi futuri nell\'analisi dei dati.\r\nSfide etiche e legali associate all\'analisi dei dati.\r\nSe sei interessato a scoprire il potenziale dell\'analisi dei dati supportata da strumenti informatici avanzati, questo post ti offrirà una guida completa per esplorare le metodologie, gli strumenti e le applicazioni di questa disciplina in continua evoluzione. Preparati per un\'avventura nell\'analisi dei dati che trasformerà la tua prospettiva sulla gestione e sfruttamento delle informazioni.', 1, 1, '2024-01-18 13:04:10', 0, 3, 49, 50, 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `sponsor`
--

CREATE TABLE `sponsor` (
  `IdSponsor` int(11) NOT NULL,
  `Expiration` date NOT NULL,
  `IdPost` int(11) NOT NULL
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

--
-- Dump dei dati per la tabella `usercomment`
--

INSERT INTO `usercomment` (`IdComment`, `CommentText`, `IdPost`, `IdUser`) VALUES
(4, 'prova ancora', 8, 1),
(5, 'scusa', 9, 1),
(6, 'dovevo', 9, 1),
(7, 'provare', 9, 1),
(8, 'bene!', 9, 1),
(9, 'gg\n', 8, 1),
(10, 'tt', 16, 1),
(11, 'dont care', 8, 1),
(12, 'sadad', 8, 1),
(13, 'ahcak', 10, 1),
(14, 'ajdha', 10, 1);

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
-- Dump dei dati per la tabella `vote`
--

INSERT INTO `vote` (`IdVote`, `IdPost`, `IdUser`) VALUES
(18, 9, 1),
(19, 14, 1),
(21, 16, 1),
(27, 10, 1),
(46, 4, 1),
(48, 8, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdSrc` (`IdSrc`),
  ADD KEY `IdDst` (`IdDst`);

--
-- Indici per le tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`IdMedia`);

--
-- Indici per le tabelle `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`),
  ADD UNIQUE KEY `Username_2` (`Username`,`Email`),
  ADD KEY `IdMedia` (`IdMedia`);

--
-- Indici per le tabelle `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`IdMsg`),
  ADD KEY `IdSrc` (`IdSrc`),
  ADD KEY `IdDst` (`IdDst`);

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
  ADD KEY `IdPreview` (`IdPreview`),
  ADD KEY `IdCategory` (`IdCategory`);

--
-- Indici per le tabelle `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`IdSponsor`),
  ADD KEY `IdPost` (`IdPost`);

--
-- Indici per le tabelle `usercomment`
--
ALTER TABLE `usercomment`
  ADD PRIMARY KEY (`IdComment`),
  ADD KEY `IdPost` (`IdPost`),
  ADD KEY `userComment_ibfk_2` (`IdUser`);

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
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `follow`
--
ALTER TABLE `follow`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT per la tabella `media`
--
ALTER TABLE `media`
  MODIFY `IdMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT per la tabella `member`
--
ALTER TABLE `member`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `message`
--
ALTER TABLE `message`
  MODIFY `IdMsg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `IdNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT per la tabella `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `IdSponsor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `usercomment`
--
ALTER TABLE `usercomment`
  MODIFY `IdComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `vote`
--
ALTER TABLE `vote`
  MODIFY `IdVote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`IdSrc`) REFERENCES `member` (`IdUser`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`IdDst`) REFERENCES `member` (`IdUser`);

--
-- Limiti per la tabella `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`);

--
-- Limiti per la tabella `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`IdSrc`) REFERENCES `member` (`IdUser`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`IdDst`) REFERENCES `member` (`IdUser`);

--
-- Limiti per la tabella `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `member` (`IdUser`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `member` (`IdUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`IdMedia`) REFERENCES `media` (`IdMedia`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`IdPreview`) REFERENCES `media` (`IdMedia`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_4` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`) ON DELETE CASCADE;

--
-- Limiti per la tabella `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`) ON DELETE CASCADE;

--
-- Limiti per la tabella `usercomment`
--
ALTER TABLE `usercomment`
  ADD CONSTRAINT `userComment_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`) ON DELETE CASCADE,
  ADD CONSTRAINT `userComment_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `member` (`IdUser`);

--
-- Limiti per la tabella `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`IdPost`) REFERENCES `post` (`IdPost`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `member` (`IdUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
