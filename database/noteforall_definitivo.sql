-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Creato il: Feb 29, 2024 alle 22:05
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
(15, 'Software'),
(17, 'Web'),
(18, 'OOP'),
(19, 'Ingegneria'),
(20, 'Coding'),
(21, 'Matematica'),
(22, 'Algebra'),
(23, 'Ricerca operativa'),
(24, 'Analisi dei dati'),
(25, 'Biomedicina'),
(26, 'Biomeccanica'),
(27, 'Meccanica'),
(28, 'Fisica'),
(29, 'Filosofia'),
(30, 'Tecnologia'),
(31, 'Arte'),
(32, 'Intelligenza artificiale'),
(33, 'Sviluppo mobile');

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
(52, 2, 1),
(53, 3, 1),
(54, 3, 2),
(55, 4, 3),
(56, 4, 1),
(57, 4, 2),
(58, 5, 2),
(59, 6, 2),
(60, 6, 4),
(61, 8, 7),
(62, 2, 3),
(63, 2, 4),
(64, 8, 1),
(65, 9, 2),
(66, 11, 2),
(67, 11, 1),
(68, 11, 5),
(69, 11, 4),
(70, 11, 3),
(72, 1, 11);

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
(1, '20240229114743default_icon_profile.png', 'uploads/20240229114743default_icon_profile.png', NULL),
(2, '20240229115104european-shorthair-8142959_1280.jpg', 'uploads/20240229115104european-shorthair-8142959_1280.jpg', NULL),
(3, 'Ingegneria_del_software.pdf', 'uploads/Ingegneria_del_software.pdf', NULL),
(4, 'devops-3155972_1280.jpg', 'uploads/devops-3155972_1280.jpg', NULL),
(5, 'Sviluppo_mobile.pdf', 'uploads/Sviluppo_mobile.pdf', NULL),
(6, 'business-2717063_1280.jpg', 'uploads/business-2717063_1280.jpg', NULL),
(9, 'Analisi_1.pdf', 'uploads/Analisi_1.pdf', NULL),
(10, 'math-work-4711302_1280.jpg', 'uploads/math-work-4711302_1280.jpg', NULL),
(11, 'Algebra_lineare_e_geometria.pdf', 'uploads/Algebra_lineare_e_geometria.pdf', NULL),
(12, 'board-2853022_1280.jpg', 'uploads/board-2853022_1280.jpg', NULL),
(13, 'Appunti_AI.pdf', 'uploads/Appunti_AI.pdf', NULL),
(14, 'artificial-intelligence-3048957_1280.jpg', 'uploads/artificial-intelligence-3048957_1280.jpg', NULL),
(15, 'ProgrammazioneC_(1).pdf', 'uploads/ProgrammazioneC_(1).pdf', NULL),
(16, 'code-820275_1280.jpg', 'uploads/code-820275_1280.jpg', NULL),
(17, 'Architettura_elab.pdf', 'uploads/Architettura_elab.pdf', NULL),
(18, 'board-453758_1280.jpg', 'uploads/board-453758_1280.jpg', NULL),
(19, 'MDP_(1).pdf', 'uploads/MDP_(1).pdf', NULL),
(20, 'dices-4433289_1280.jpg', 'uploads/dices-4433289_1280.jpg', NULL),
(21, '20240229132301long-eared-owl-4811501_1280.jpg', 'uploads/20240229132301long-eared-owl-4811501_1280.jpg', NULL),
(24, 'OOP_(1).pdf', 'uploads/OOP_(1).pdf', NULL),
(25, 'computer-1873831_1280.png', 'uploads/computer-1873831_1280.png', NULL),
(26, 'ASD.pdf', 'uploads/ASD.pdf', NULL),
(27, 'organization-2478211_1280.jpg', 'uploads/organization-2478211_1280.jpg', NULL),
(30, 'OOP_(1).pdf', 'uploads/OOP_(1).pdf', NULL),
(31, 'computer-1873831_1280.png', 'uploads/computer-1873831_1280.png', NULL),
(32, 'ASD.pdf', 'uploads/ASD.pdf', NULL),
(33, 'board-453758_1280.jpg', 'uploads/board-453758_1280.jpg', NULL),
(34, 'ASD.pdf', 'uploads/ASD.pdf', NULL),
(35, 'board-453758_1280.jpg', 'uploads/board-453758_1280.jpg', NULL),
(40, 'Basi_di_dati.pdf', 'uploads/Basi_di_dati.pdf', NULL),
(41, 'big-3520096_1280.jpg', 'uploads/big-3520096_1280.jpg', NULL),
(42, 'sisop.pdf', 'uploads/sisop.pdf', NULL),
(43, 'matrix-2953869_1280.jpg', 'uploads/matrix-2953869_1280.jpg', NULL),
(44, 'basi_avanzate.pdf', 'uploads/basi_avanzate.pdf', NULL),
(45, 'monitor-2728120_1280.jpg', 'uploads/monitor-2728120_1280.jpg', NULL),
(46, 'metodi_num.pdf', 'uploads/metodi_num.pdf', NULL),
(47, 'mathematics-3821034_1280.jpg', 'uploads/mathematics-3821034_1280.jpg', NULL),
(48, 'prog_reti.pdf', 'uploads/prog_reti.pdf', NULL),
(49, 'social-media-2537391_1280.jpg', 'uploads/social-media-2537391_1280.jpg', NULL),
(50, 'tec_web.pdf', 'uploads/tec_web.pdf', NULL),
(51, 'seo-758264_1280.jpg', 'uploads/seo-758264_1280.jpg', NULL),
(52, 'iot.pdf', 'uploads/iot.pdf', NULL),
(53, 'raspberry-pi-4980917_1280.jpg', 'uploads/raspberry-pi-4980917_1280.jpg', NULL),
(56, 'inf_diritto.pdf', 'uploads/inf_diritto.pdf', NULL),
(57, 'gavel-2492011_1280.jpg', 'uploads/gavel-2492011_1280.jpg', NULL),
(58, 'visione_art.pdf', 'uploads/visione_art.pdf', NULL),
(59, 'eye-6921238_1280.jpg', 'uploads/eye-6921238_1280.jpg', NULL),
(60, 'crittografia.pdf', 'uploads/crittografia.pdf', NULL),
(61, 'cyber-security-2765707_1280.jpg', 'uploads/cyber-security-2765707_1280.jpg', NULL),
(62, 'virtualizzazione.pdf', 'uploads/virtualizzazione.pdf', NULL),
(63, 'hpc.pdf', 'uploads/hpc.pdf', NULL),
(64, 'workspace-1280538_1280.jpg', 'uploads/workspace-1280538_1280.jpg', NULL),
(65, 'cg.pdf', 'uploads/cg.pdf', NULL),
(66, 'gallery-2681238_1280.jpg', 'uploads/gallery-2681238_1280.jpg', NULL);

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
(1, 'User', 'User', 5, 0, '2024-02-29 22:03:47', 'user', 'user@email.com', '$2y$10$n7XgwNbvuui48r2oQzxK2OZkDxMJkDYnWxTcA4MwtvIEoyl1ndipu', '', 2),
(2, 'Riccardo', 'Penazzi', 6, 0, '2024-02-29 21:49:09', 'riccardopenazzi', 'riccardopenazzi@email.com', '$2y$10$EFpoa8w0u0O1/SHfpbm6o.3nu48pRbthWyKue0LjVdUoMUZEQnZcW', '', 21),
(3, 'Davide', 'Marchetti', 3, 0, '2024-02-29 22:02:07', 'davidemarchetti', 'davidemarchetti@email.com', '$2y$10$ZRfuvKbosVgrbVj2o/4GK.MvYjfvYUwcym2rdX.VS4LO2vad1g6w6', NULL, 1),
(4, 'Filippo', 'Pracucci', 3, 0, NULL, 'filippopracucci', 'filippopracucci@email.com', '$2y$10$wF.QzFuKJRM21F2WV83A2uhhM/tXS7mGwsUWN2lrQXFlJRMVRRKgi', NULL, 1),
(5, 'Federico', 'Verdi', 1, 0, NULL, 'fedeverdi', 'federicoverdi@email.com', '$2y$10$pbTvNX2ZbyjqqC0qlqvcJ.wh2EDJXq7KSMZRexLI.WXtHB0ol8Qge', NULL, 1),
(6, 'Ludovica', 'Gialli', 0, 0, NULL, 'ludogialli', 'ludogialli@email.com', '$2y$10$0IpPEIw6e6BYOjk6ZrL2k.aiB1rzek3vwSp80gU/6cik1EpKJaO/6', NULL, 1),
(7, 'Mario', 'Rossi', 1, 0, NULL, 'marros', 'mariorossi@email.com', '$2y$10$.4vW.RO6uZC6Pyw3N4Wl6Oz.rHfIVnQXM3hWbviKPqt1xCOi8o25q', NULL, 1),
(8, 'Giovanni', 'Storti', 0, 0, NULL, 'giovastorti', 'giovannistorti@email.com', '$2y$10$Nj4P0JyiR6vUqfg6EUJreuPxn21AO53qnqDAj706clekqwbNq1aaG', NULL, 1),
(9, 'Giacomo', 'Poretti', 0, 0, NULL, 'giacomoporetti', 'giacomoporetti@email.com', '$2y$10$l7qaQr44cMXDQpZSAUfFTOgequREZFVRBHmkoRJByhAgsN0yRF66m', NULL, 1),
(10, 'Valentina', 'Violi', 0, 0, '2024-02-29 20:12:51', 'valevioli', 'valevioli@email.com', '$2y$10$W1Lphcf5yBOBGt6T0tZ2vunDJAfHsXC4GzCmn9OzgutUlTBUX9cXi', NULL, 1),
(11, 'Irene', 'Marroni', 1, 0, NULL, 'iremarroni', 'irenemarroni@email.com', '$2y$10$BLmy8X8KX9ALnGvcpiucbOZfBTHIJpFM0XKNUaDlINhlG9py/TUWq', NULL, 1);

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
(1, 'Ciao, puoi mettere altri appunti di ingegneria del software?', '2024-02-29 21:59:40', 3, 1);

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
(1, 'Follower', 'riccardopenazzi started following you', 0, 1, 52),
(2, 'Like', 'riccardopenazzi liked your post', 0, 1, 1),
(3, 'Like', 'riccardopenazzi liked your post', 0, 1, 2),
(4, 'Like', 'riccardopenazzi liked your post', 0, 1, 3),
(5, 'Comment', 'riccardopenazzi added a comment to your post', 0, 1, 1),
(6, 'Comment', 'riccardopenazzi added a comment to your post', 0, 1, 2),
(7, 'Follower', 'davidemarchetti started following you', 0, 1, 53),
(8, 'Follower', 'davidemarchetti started following you', 1, 2, 54),
(9, 'Like', 'davidemarchetti liked your post', 0, 1, 4),
(10, 'Like', 'davidemarchetti liked your post', 0, 1, 5),
(11, 'Like', 'davidemarchetti liked your post', 0, 1, 6),
(12, 'Like', 'davidemarchetti liked your post', 1, 2, 7),
(13, 'Comment', 'davidemarchetti added a comment to your post', 1, 2, 3),
(14, 'Like', 'davidemarchetti liked your post', 1, 2, 8),
(15, 'Follower', 'filippopracucci started following you', 0, 3, 55),
(16, 'Follower', 'filippopracucci started following you', 0, 1, 56),
(17, 'Follower', 'filippopracucci started following you', 1, 2, 57),
(18, 'Follower', 'fedeverdi started following you', 1, 2, 58),
(19, 'Follower', 'ludogialli started following you', 1, 2, 59),
(20, 'Follower', 'ludogialli started following you', 0, 4, 60),
(21, 'Follower', 'giovastorti started following you', 0, 7, 61),
(22, 'Follower', 'riccardopenazzi started following you', 0, 3, 62),
(23, 'Follower', 'riccardopenazzi started following you', 0, 4, 63),
(24, 'Follower', 'giovastorti started following you', 0, 1, 64),
(25, 'Follower', 'giacomoporetti started following you', 1, 2, 65),
(26, 'Follower', 'iremarroni started following you', 1, 2, 66),
(27, 'Follower', 'iremarroni started following you', 0, 1, 67),
(28, 'Follower', 'iremarroni started following you', 0, 5, 68),
(29, 'Follower', 'iremarroni started following you', 0, 4, 69),
(30, 'Follower', 'iremarroni started following you', 0, 3, 70),
(32, 'Follower', 'user started following you', 0, 11, 72);

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
(1, 'Appunti di ingegneria del software', 'Benvenuti nella nostra community dedicata all\'Ingegneria del Software! In questo spazio, ci immergeremo nei dettagli di argomenti fondamentali del nostro percorso formativo. Iniziamo con \"Design Patterns\", esplorando soluzioni a problemi comuni nel software design. Proseguiamo con lo \"Sviluppo Agile\", concentrandoci sulle metodologie che favoriscono la flessibilità e la collaborazione. Infine, analizziamo il \"Testing\", esaminando strategie per garantire la qualità del software. Questo ambiente è creato per la condivisione approfondita di appunti su ciascun argomento, promuovendo una comprensione completa. Vi invitiamo a contribuire con i vostri appunti e a porre domande per stimolare una discussione collaborativa. L\'obiettivo è creare una risorsa educativa dinamica e partecipativa nell\'ambito dell\'Ingegneria del Software. Partecipate e arricchite il vostro percorso di apprendimento!', 2, 0, '2024-02-29 12:08:28', 0, 1, 3, 4, NULL),
(2, 'Appunti di sviluppo mobile', 'Esplora il vasto mondo dello sviluppo mobile con i nostri appunti dettagliati! Copriremo argomenti chiave come sviluppo per iOS e Android, utilizzo di framework come React Native o Flutter, design responsive e best practices per creare app user-friendly. Condividi le tue esperienze, scoperte e domande in questa comunità dedicata, rendendo il processo di apprendimento nel mondo dello sviluppo mobile un\'esperienza collaborativa e arricchente. Unisciti a noi per approfondire le tue competenze e connetterti con altri appassionati di sviluppo mobile.', 1, 1, '2024-02-29 12:17:32', 0, 1, 5, 6, NULL),
(4, 'Analisi 1', 'Immergiamoci nell\'affascinante mondo dell\'Analisi Matematica 1 attraverso i nostri appunti dettagliati! Esploreremo i fondamenti come limiti, derivati e integrali, approfondendo concetti come continuità e teorema fondamentale del calcolo. La nostra comunità è lo spazio ideale per la condivisione di approcci, risoluzioni di problemi e chiarimenti su argomenti complessi. Sia che tu sia uno studente alle prime armi o desideri rinfrescare le tue conoscenze, unisciti a noi per rendere l\'apprendimento dell\'Analisi Matematica 1 un\'esperienza collaborativa e gratificante.', 1, 0, '2024-02-29 12:20:43', 0, 1, 9, 10, NULL),
(5, 'Algebra lineare e geometria', 'Esploriamo insieme le profondità dell\'Algebra Lineare e della Geometria attraverso appunti approfonditi! Affronteremo concetti fondamentali come vettori, spazi vettoriali, trasformazioni lineari, matrici e determinanti. Nella sezione di Geometria, esamineremo teoremi, coordinate e concetti di spazi euclidei. La nostra comunità è il luogo perfetto per condividere strategie di risoluzione, chiarimenti e approfondimenti su argomenti complessi. Che tu sia uno studente alle prime armi o desideri approfondire le tue competenze, unisciti a noi per rendere l\'apprendimento di Algebra Lineare e Geometria un\'esperienza condivisa e stimolante.', 0, 1, '2024-02-29 12:22:26', 0, 1, 11, 12, NULL),
(6, 'Appunti di AI', 'Esplora l\'affascinante mondo dell\'Intelligenza Artificiale attraverso i nostri appunti dettagliati! Approfondiremo argomenti cruciali come machine learning, reti neurali, algoritmi di apprendimento profondo e applicazioni pratiche dell\'IA. Unisciti a noi per condividere conoscenze, risorse e ultime scoperte in questo campo in rapida evoluzione. La nostra comunità è aperta a tutti, dai principianti agli esperti, offrendo un ambiente collaborativo per esplorare l\'intelligenza artificiale e le sue infinite possibilità.', 1, 0, '2024-02-29 12:24:08', 0, 1, 13, 14, NULL),
(7, 'Appunti di programmazione in linguaggio C', 'Esplora le fondamenta della programmazione in linguaggio C attraverso appunti dettagliati che coprono una vasta gamma di argomenti:\r\nSintassi di Base: Comprendi gli elementi fondamentali della sintassi C, inclusi tipi di dati, operatori e struttura del programma.\r\nControllo di Flusso: Approfondisci le istruzioni di controllo di flusso, come cicli e condizioni, per gestire l\'esecuzione del programma.\r\nFunzioni: Esplora la definizione e l\'utilizzo delle funzioni per organizzare e strutturare il codice in modo modulare.\r\nPuntatori e Strutture dati: Comprende l\'uso dei puntatori e le strutture dati fondamentali come array e strutture per gestire dati complessi.\r\nGestione della Memoria: Apprendi le tecniche per la gestione efficiente della memoria, inclusa l\'allocazione dinamica di memoria.\r\nFile I/O: Scopri come leggere e scrivere dati su file, essenziale per l\'interazione con il sistema operativo.\r\nProgrammazione Modulare: Approfondisci il concetto di programmazione modulare, dividendo il codice in moduli funzionali per facilitare la manutenzione.\r\nDebugging e Ottimizzazione: Impara le strategie di debugging e ottimizzazione per migliorare le prestazioni del tuo codice.\r\nUnisciti a questa comunità dedicata per esplorare e approfondire le tue competenze nella programmazione in linguaggio C. Condividi le tue domande e scoperte per rendere l\'apprendimento collaborativo e appagante.\r\n\r\n', 1, 0, '2024-02-29 12:26:48', 0, 1, 15, 16, NULL),
(8, 'Appunti di architettura degli elaboratori', 'Esplora l\'affascinante mondo dell\'Architettura degli Elaboratori attraverso dettagliate dispense di corso, coprendo un ampio spettro di argomenti:\r\n\r\nIntroduzione all\'Architettura degli Elaboratori: Comprende i concetti fondamentali relativi alla struttura e al funzionamento dei calcolatori.\r\n\r\nOrganizzazione della Memoria: Esplora come la memoria è organizzata nei sistemi di calcolo e l\'impatto sulla performance.\r\n\r\nUnità di Elaborazione: Comprende la struttura delle unità centrali di elaborazione (CPU) e come eseguono le istruzioni.\r\n\r\nArchitettura RISC e CISC: Confronta le architetture a RISC (Reduced Instruction Set Computing) e CISC (Complex Instruction Set Computing) per capire i loro vantaggi e svantaggi.\r\n\r\nI/O e Periferiche: Studia l\'interazione tra il sistema di calcolo e i dispositivi periferici come tastiere, mouse e stampanti.\r\n\r\nStrutture Dati nell\'Architettura Hardware: Esamina come i dati sono memorizzati e manipolati a livello hardware.\r\n\r\nArchitetture Parallele e Distribuite: Esplora i concetti di architettura parallela e distribuita per affrontare le sfide di performance e scalabilità.\r\n\r\nArchitettura Von Neumann vs. Harvard: Analizza le differenze tra queste due architetture fondamentali.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire le tue conoscenze nell\'ambito dell\'Architettura degli Elaboratori. Condividi le tue domande e scoperte per rendere l\'apprendimento un\'esperienza collaborativa e gratificante.', 0, 0, '2024-02-29 12:34:00', 0, 2, 17, 18, NULL),
(9, 'MDP - matematica discreta e probabilità', 'Esplora le fondamenta della Matematica Discreta e della Probabilità attraverso approfondite dispense di corso che coprono una vasta gamma di argomenti:\r\n\r\nTeoria degli Insiemi: Approfondisci i concetti fondamentali degli insiemi, inclusi l\'unione, l\'intersezione e il complemento, e le loro applicazioni nella risoluzione di problemi.\r\n\r\nLogica Proposizionale e Predicativa: Studia le regole e le tecniche di inferenza della logica proposizionale e predicativa per l\'analisi e la costruzione di argomentazioni valide.\r\n\r\nTeoria dei Grafi: Esplora le strutture e le proprietà dei grafi, inclusi algoritmi di attraversamento, connettività e applicazioni pratiche.\r\n\r\nCombinatoria: Approfondisci le tecniche di conteggio, come le disposizioni, le combinazioni e le permutazioni, e le loro applicazioni nella risoluzione di problemi di conteggio.\r\n\r\nProbabilità: Introduzione ai concetti di probabilità, inclusi eventi, spazi campione, probabilità condizionata e distribuzioni di probabilità, e le loro applicazioni nella modellazione di fenomeni casuali.\r\n\r\nVariabili Aleatorie: Esplora le variabili aleatorie discrete e continue, le loro distribuzioni e le proprietà associate, e le applicazioni nella modellazione di processi casuali.\r\n\r\nTeoremi di Probabilità: Studia i teoremi fondamentali della teoria delle probabilità, come il teorema di Bayes, il teorema della probabilità totale e il teorema del limite centrale.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire le tue conoscenze in Matematica Discreta e Probabilità. Condividi le tue domande e scoperte per rendere l\'apprendimento un\'esperienza collaborativa e arricchente. ', 1, 1, '2024-02-29 13:22:25', 0, 2, 19, 20, NULL),
(11, 'OOP - introduzione a Java', 'Approfondisci la Programmazione Orientata agli Oggetti (OOP) attraverso dispense dettagliate che toccano una vasta gamma di argomenti chiave:\r\n\r\nPrincipi di OOP: Comprende i principi fondamentali come l\'incapsulamento, l\'ereditarietà e il polimorfismo, fondamentali per la progettazione orientata agli oggetti.\r\n\r\nClassi e Oggetti: Esamina la creazione e l\'utilizzo di classi e oggetti, le unità fondamentali della programmazione orientata agli oggetti.\r\n\r\nEreditarietà e Polimorfismo: Approfondisci come l\'ereditarietà favorisce la creazione di gerarchie di classi e come il polimorfismo consente il trattamento di oggetti di diverse classi attraverso una singola interfaccia.\r\n\r\nIncapsulamento e Modificatori di Accesso: Comprendi come l\'incapsulamento protegge i dettagli implementativi di una classe e come i modificatori di accesso regolano la visibilità dei membri.\r\n\r\nInterfacce e Astrazione: Studia l\'uso di interfacce per definire contratti e l\'astrazione per concentrarsi sugli aspetti essenziali di un oggetto.\r\n\r\nGestione delle Eccezioni: Esamina le pratiche per gestire eccezioni in ambienti ad oggetti, garantendo robustezza e manutenibilità del codice.\r\n\r\nDesign Patterns: Esplora soluzioni ricorrenti a problemi comuni attraverso l\'implementazione di design patterns, migliorando la struttura e la manutenibilità del codice.\r\n\r\nUnisciti a questa comunità per approfondire la tua comprensione della Programmazione Orientata agli Oggetti, condividere esperienze e affrontare sfide in modo collaborativo.', 1, 0, '2024-02-29 13:28:36', 0, 2, 24, 25, NULL),
(12, 'Algoritmi e strutture dati', 'Esplora il vasto mondo degli algoritmi e delle strutture dati attraverso dispense dettagliate che coprono una gamma diversificata di argomenti chiave:\r\n\r\nAnalisi degli Algoritmi: Approfondisci le tecniche di analisi degli algoritmi, comprese le notazioni O grande, per valutare le prestazioni e l\'efficienza.\r\n\r\nStrutture Dati Fondamentali: Esamina le strutture dati basilari come array, liste, code e pile, comprendendone l\'utilizzo e le implementazioni.\r\n\r\nRicerca e Ordinamento: Studia gli algoritmi di ricerca come la ricerca binaria e gli algoritmi di ordinamento come il quicksort e il mergesort, comprendendo i trade-off di efficienza tra di essi.\r\n\r\nGrafi e Algoritmi su Grafi: Approfondisci le strutture di grafo e gli algoritmi associati, come Dijkstra per i percorsi più brevi e l\'algoritmo di Kruskal per gli alberi di copertura minimi.\r\n\r\nAlgoritmi di Backtracking e Divide et Impera: Esplora l\'applicazione di algoritmi come il backtracking per risolvere problemi di decisione e l\'approccio divide et impera per problemi complessi.\r\n\r\nProgrammazione Dinamica: Comprende l\'applicazione della programmazione dinamica per risolvere problemi tramite suddivisione in sottoproblemi più piccoli.\r\n\r\nHashing e Tavole Hash: Approfondisci le strutture di hashing e le tavole hash, analizzando come possono essere utilizzate per migliorare le prestazioni di ricerca.\r\n\r\nUnisciti a questa comunità per approfondire la tua comprensione degli algoritmi e delle strutture dati, condividere approcci e risolvere insieme sfide in questo affascinante campo dell\'informatica.', 0, 0, '2024-02-29 13:32:32', 0, 2, 26, 27, NULL),
(19, 'Basi di dati', 'Esplora il mondo delle basi di dati attraverso dispense dettagliate che coprono un\'ampia gamma di argomenti chiave:\r\n\r\nIntroduzione alle Basi di Dati: Comprende i concetti fondamentali di database, modelli di dati e le differenze tra database relazionali e non relazionali.\r\n\r\nProgettazione del Database: Approfondisci la progettazione concettuale, logica e fisica dei database, includendo la normalizzazione per garantire l\'efficienza e l\'integrità.\r\n\r\nSQL e Interrogazioni: Esamina il linguaggio SQL (Structured Query Language) per gestire dati in database relazionali, inclusa la creazione, la modifica e la query delle tabelle.\r\n\r\nTransazioni e Controllo di Concorrenza: Studia come le transazioni vengono gestite per garantire la coerenza dei dati e affronta il controllo di concorrenza per gestire l\'accesso simultaneo.\r\n\r\nIndici e Ottimizzazione delle Query: Approfondisci l\'uso degli indici per migliorare le prestazioni delle query e le strategie di ottimizzazione del database.\r\n\r\nNoSQL e Basi di Dati Distribuite: Esplora i database NoSQL e le basi di dati distribuite, comprendendo quando e come utilizzarli per affrontare specifiche esigenze.\r\n\r\nSicurezza e Backup dei Dati: Studia le pratiche per garantire la sicurezza dei dati, inclusa l\'autenticazione, l\'autorizzazione e le strategie di backup.\r\n\r\nIntegrazione dei Dati e Data Warehousing: Analizza come integrare dati provenienti da diverse fonti e l\'uso di data warehousing per analisi approfondite.\r\n\r\nUnisciti a questa comunità per approfondire la tua comprensione delle basi di dati, condividere esperienze e discutere delle sfide legate alla gestione efficace dei dati.', 0, 0, '2024-02-29 19:08:21', 0, 3, 40, 41, 24),
(20, 'Sistemi operativi', 'Immergiti nel mondo complesso dei Sistemi Operativi attraverso dispense dettagliate che esplorano una vasta gamma di concetti chiave:\r\n\r\nIntroduzione ai Sistemi Operativi: Comprendi il ruolo fondamentale dei sistemi operativi nella gestione delle risorse di un sistema informatico.\r\n\r\nGestione dei Processi: Esamina la creazione, la programmazione e la terminazione dei processi, nonché la sincronizzazione e la comunicazione tra di essi.\r\n\r\nGestione della Memoria: Approfondisci come il sistema operativo gestisce la memoria fisica e virtuale per ottimizzare le risorse e la prestazione.\r\n\r\nSistema di File: Studia la struttura e l\'organizzazione dei sistemi di file, nonché le operazioni di lettura e scrittura sui dispositivi di archiviazione.\r\n\r\nGestione dell\'I/O: Analizza come il sistema operativo gestisce le operazioni di input/output per garantire l\'efficienza e la correttezza.\r\n\r\nSicurezza del Sistema Operativo: Esplora le pratiche di sicurezza, inclusa l\'autenticazione, l\'autorizzazione e la gestione delle vulnerabilità.\r\n\r\nReti e Sistemi Distribuiti: Comprende come i sistemi operativi facilitano la comunicazione e la gestione delle risorse in ambienti distribuiti e reti.\r\n\r\nVirtualizzazione e Containerization: Approfondisci concetti come la virtualizzazione e le tecnologie di containerizzazione, come Docker, per isolare e gestire le risorse.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione dei Sistemi Operativi, condividere approcci e risolvere insieme le sfide in questo campo cruciale dell\'informatica. ', 0, 0, '2024-02-29 19:11:44', 0, 3, 42, 43, 15),
(21, 'Basi di dati avanzate', 'Esplora le sfumature avanzate del mondo delle Basi di Dati attraverso dettagliate dispense di corso che approfondiscono concetti complessi:\r\nBasi di Dati NoSQL: Approfondisci il panorama delle basi di dati NoSQL, comprese le tipologie di document store, grafo, colonnare e chiave-valore.\r\nIndicizzazione Avanzata: Studia approcci avanzati all\'indicizzazione per migliorare le prestazioni delle query, inclusi gli indici full-text e spaziali.\r\nOttimizzazione delle Query Complesse: Approfondisci strategie avanzate per ottimizzare le query complesse, comprendendo l\'analisi dei piani di esecuzione e l\'uso di hint.\r\nTriggers e Stored Procedures: Esamina l\'implementazione di triggers e stored procedures per eseguire azioni automatiche e complesse all\'interno del database.\r\nData Warehousing e Data Mining: Analizza come progettare e utilizzare database per supportare processi di data warehousing e applicare tecniche di data mining per l\'analisi dei dati.\r\nIntegrazione con Big Data: Esplora come integrare basi di dati relazionali con sistemi di Big Data, compresi framework come Apache Hadoop e Apache Spark.\r\nGestione della Concorrenza Avanzata: Approfondisci le tecniche avanzate di gestione della concorrenza per garantire l\'integrità dei dati in contesti ad alta concorrenza.\r\nSicurezza Avanzata dei Dati: Studia le pratiche avanzate di sicurezza dei dati, inclusa la crittografia avanzata e le misure di protezione contro le minacce avanzate.\r\nUnisciti a questa comunità per esplorare le possibilità avanzate delle Basi di Dati, condividere esperienze e affrontare sfide in questo campo in costante evoluzione.\r\n\r\n\r\n', 0, 0, '2024-02-29 19:23:07', 0, 4, 44, 45, NULL),
(22, 'Metodi numerici', 'Esplora il vasto panorama dei Metodi Numerici attraverso dettagliate dispense di corso che coprono una gamma diversificata di argomenti:\r\n\r\nAnalisi Numerica di Equazioni Algebriche e Trascendentali: Approfondisci gli algoritmi per la soluzione numerica di equazioni, sia algebriche che trascendentali, utilizzando metodi come il metodo di bisezione e il metodo di Newton-Raphson.\r\n\r\nInterpolazione e Approssimazione: Studia le tecniche per approssimare funzioni complesse attraverso metodi di interpolazione polinomiale e curve di regressione.\r\n\r\nCalcolo Numerico dell\'Integrazione e Derivazione: Esamina gli algoritmi per il calcolo numerico delle integrazioni definite e delle derivate, essenziali in molteplici contesti matematici e scientifici.\r\n\r\nRisoluzione Numerica di Sistemi Lineari e Non Lineari: Approfondisci le strategie per risolvere sistemi di equazioni lineari e non lineari, compresi i metodi iterativi e di eliminazione gaussiana.\r\n\r\nMetodi di Risoluzione di Equazioni Differenziali Ordinarie: Esplora gli algoritmi per la soluzione numerica di equazioni differenziali ordinarie, fondamentali in molti ambiti scientifici e ingegneristici.\r\n\r\nMetodi di Risoluzione di Equazioni Differenziali Parziali: Studia le tecniche per la soluzione numerica di equazioni differenziali parziali, affrontando problemi come la diffusione del calore e la propagazione delle onde.\r\n\r\nMetodi per l\'Analisi Numerica di Grandi Dati: Esamina approcci numerici per analizzare grandi quantità di dati, comprese le tecniche di riduzione dimensionale e la gestione efficiente di dati massivi.\r\n\r\nApplicazioni Pratiche nei Campi Scientifici e Ingegneristici: Analizza casi di studio e applicazioni pratiche dei metodi numerici in discipline come la fisica, l\'ingegneria e la scienza dei dati.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione dei Metodi Numerici, condividere esperienze e affrontare sfide in questo campo essenziale per la risoluzione di problemi matematici e scientifici.', 0, 0, '2024-02-29 19:42:30', 0, 4, 46, 47, 21),
(24, 'Programmazione di reti', 'Approfondisci la complessità della Programmazione di Reti attraverso dispense di corso dettagliate che esplorano una vasta gamma di concetti chiave:\r\n\r\nArchitettura delle Reti: Comprendi l\'architettura di base delle reti, inclusi concetti come client-server, peer-to-peer e reti ibride.\r\n\r\nComunicazione su Rete: Studia i protocolli di comunicazione, come TCP/IP, e capisci come avviene il trasferimento di dati tra dispositivi in una rete.\r\n\r\nSocket Programming: Approfondisci la programmazione utilizzando i socket per creare applicazioni di rete, consentendo la comunicazione tra diversi processi.\r\n\r\nProtocolli di Applicazione: Esamina protocolli di applicazione comuni come HTTP, FTP e SMTP, comprendendo come vengono utilizzati nella programmazione di reti.\r\n\r\nSicurezza delle Reti: Studia le pratiche di sicurezza, inclusi algoritmi di crittografia e tecniche di autenticazione, per proteggere le reti da minacce esterne.\r\n\r\nProgrammazione di Reti Distribuite: Approfondisci come sviluppare applicazioni che operano su reti distribuite, consentendo la comunicazione tra sistemi separati geograficamente.\r\n\r\nProtocolli di Routing: Esamina i protocolli di routing utilizzati per indirizzare il traffico in reti complesse e dinamiche.\r\n\r\nApplicazioni Pratiche nei Sistemi Distribuiti: Analizza casi di studio e applicazioni pratiche della programmazione di reti nei sistemi distribuiti, come piattaforme cloud e servizi web.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione della Programmazione di Reti, condividere approcci e risolvere insieme le sfide in questo campo in continua evoluzione', 0, 0, '2024-02-29 19:46:06', 0, 4, 48, 49, NULL),
(25, 'Tecnologie web', 'Esplora le dinamiche e le Tecnologie Web attraverso dispense di corso che coprono un\'ampia gamma di argomenti cruciali:\r\n\r\nHTML e CSS: Comprendi le fondamenta della creazione di pagine web utilizzando HTML per la struttura e CSS per lo stile.\r\n\r\nJavaScript e Framework Front-end: Studia il linguaggio di scripting JavaScript e approfondisci l\'utilizzo di framework front-end come React, Angular o Vue per sviluppare interfacce utente dinamiche e reattive.\r\n\r\nServer-Side Development: Esplora le tecnologie e i linguaggi utilizzati per lo sviluppo lato server, come Node.js, Python (con Flask o Django), o Ruby on Rails.\r\n\r\nDatabase e Accesso ai Dati: Approfondisci come interagire con database utilizzando tecnologie come SQL o NoSQL, e comprendi il concetto di ORM (Object-Relational Mapping).\r\n\r\nAPI e Servizi Web: Studia la progettazione e l\'implementazione di API, nonché l\'integrazione con servizi web di terze parti.\r\n\r\nSicurezza Web: Esamina le best practices per la sicurezza web, inclusi concetti come HTTPS, protezione contro attacchi CSRF e XSS, e l\'implementazione di controlli di accesso.\r\n\r\nWeb Performance Optimization: Approfondisci le strategie per ottimizzare le prestazioni del sito web, compresa la gestione della cache, la compressione dei file e l\'ottimizzazione delle immagini.\r\n\r\nProgressive Web Apps (PWA) e Responsive Design: Esplora concetti come PWA per migliorare l\'esperienza utente offline e Responsive Design per adattare il layout alle diverse dimensioni dei dispositivi.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione delle Tecnologie Web, condividere esperienze e affrontare sfide in questo campo sempre in evoluzione.', 0, 0, '2024-02-29 19:51:26', 0, 5, 50, 51, 15),
(26, '', 'Esplora il coinvolgente mondo dell\'Internet delle Cose (IoT) attraverso dettagliati materiali didattici che trattano una vasta gamma di argomenti chiave:\r\n\r\nFondamenti dell\'IoT: Comprendi l\'essenza e l\'impatto dell\'Internet delle Cose, nonché il modo in cui dispositivi interconnessi possono comunicare e collaborare tra loro.\r\n\r\nSensori e Dispositivi IoT: Studia la diversità di sensori e dispositivi utilizzati nell\'IoT, nonché il modo in cui raccolgono e trasmettono dati.\r\n\r\nComunicazione nell\'IoT: Esplora i protocolli e le tecnologie di comunicazione utilizzate per facilitare lo scambio di informazioni tra dispositivi IoT, inclusi MQTT e CoAP.\r\n\r\nCloud Computing e IoT: Comprendi come le tecnologie cloud, come i servizi di archiviazione e di elaborazione, contribuiscano alla gestione dei volumi elevati di dati generati dai dispositivi IoT.\r\n\r\nSicurezza nell\'IoT: Studia gli aspetti di sicurezza associati ai dispositivi e alle reti IoT, inclusa la crittografia dei dati, l\'autenticazione dei dispositivi e la prevenzione degli attacchi.\r\n\r\nEdge Computing nell\'IoT: Esplora i vantaggi e le implementazioni dell\'Edge Computing per elaborare i dati localmente, riducendo la dipendenza dal cloud.\r\n\r\nApplicazioni Pratiche dell\'IoT: Analizza studi di caso e applicazioni pratiche dell\'IoT in settori come la salute, l\'industria, l\'agricoltura e le città intelligenti.\r\n\r\nStandardizzazione e Futuro dell\'IoT: Comprendi l\'importanza della standardizzazione nell\'IoT ed esplora le direzioni future di questa tecnologia.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire le tue conoscenze nell\'ambito dell\'Internet delle Cose, condividere esperienze e affrontare le sfide in questo settore in continua espansione. ', 0, 0, '2024-02-29 19:53:38', 0, 6, 52, 53, NULL),
(28, 'Informatica e diritto', 'Esplora l\'intersezione tra l\'informatica e il diritto, un campo affascinante che richiede una comprensione approfondita di entrambe le discipline. Di seguito sono riportati alcuni punti chiave che potrebbero essere inclusi in un corso su questo argomento:\r\n\r\nLeggi sulla Privacy e Protezione dei Dati: Approfondisci le leggi e le normative che regolamentano la raccolta, l\'elaborazione e la conservazione dei dati personali, come il Regolamento Generale sulla Protezione dei Dati (GDPR).\r\n\r\nCybersecurity e Leggi Anticrimine Informatico: Studia le leggi che affrontano le minacce alla sicurezza informatica, comprese le normative sulla prevenzione dell\'hacking e la protezione delle reti.\r\n\r\nProprietà Intellettuale e Software: Esamina le leggi relative alla protezione dei diritti d\'autore per il software e l\'affrontare le questioni di proprietà intellettuale in un contesto tecnologico.\r\n\r\nContratti Informatici e Servizi Online: Comprendi la redazione e l\'esecuzione di contratti relativi ai servizi informatici, alle licenze software e agli accordi per i servizi online.\r\n\r\nResponsabilità Legale e Tecnologia: Esplora le questioni di responsabilità legale in caso di malfunzionamenti del software, danni causati da algoritmi e altri aspetti correlati.\r\n\r\nE-Government e Diritto Digitale: Analizza le trasformazioni digitali nella pubblica amministrazione, inclusi i servizi online, e comprendi le leggi che regolamentano questa transizione.\r\n\r\nEvidenza Digitale e Prove Elettroniche: Studia come l\'evidenza digitale viene trattata nei procedimenti giudiziari, comprese le sfide e le leggi relative all\'utilizzo di prove elettroniche.\r\n\r\nRegolamentazioni sull\'Intelligenza Artificiale (IA): Esamina le normative emergenti e le implicazioni legali legate all\'uso dell\'intelligenza artificiale, compresi i rischi etici e la responsabilità legale.\r\n\r\nQuesto corso mira a fornire una visione completa delle interazioni tra informatica e diritto, preparando gli studenti a navigare nelle sfide legali del mondo digitale in continuo cambiamento. ', 0, 0, '2024-02-29 19:56:45', 0, 7, 56, 57, NULL),
(29, 'Visione artificiale', 'Immergiti nel vasto campo della Visione Artificiale attraverso dettagliate dispense di corso che coprono una gamma diversificata di argomenti chiave:\r\n\r\nFondamenti dell\'Elaborazione delle Immagini: Comprende i concetti di base dell\'elaborazione delle immagini, inclusa l\'acquisizione di immagini, la manipolazione e la trasformazione.\r\n\r\nSegmentazione e Riconoscimento di Oggetti: Esplora tecniche avanzate per la segmentazione delle immagini e il riconoscimento di oggetti, compresi algoritmi di machine learning e deep learning.\r\n\r\nClassificazione delle Immagini: Studia approcci per la classificazione automatica delle immagini utilizzando reti neurali convoluzionali (CNN) e altre tecniche di apprendimento automatico.\r\n\r\nLocalizzazione e Rilevamento degli Oggetti: Approfondisci i metodi per localizzare e rilevare oggetti specifici all\'interno di immagini, essenziali per applicazioni come la guida autonoma e il monitoraggio video.\r\n\r\nRappresentazione e Descrizione delle Immagini: Esamina come le immagini possono essere rappresentate in modo efficace e come estrarre descrizioni significative utilizzando approcci di machine learning.\r\n\r\nTracciamento di Oggetti in Tempo Reale: Studia algoritmi e metodologie per il tracciamento continuo di oggetti in sequenze di immagini, fondamentali in applicazioni come la videosorveglianza.\r\n\r\nApplicazioni Pratiche in Medicina, Industria e Robotica: Analizza casi di studio e applicazioni pratiche della Visione Artificiale in settori come la medicina, l\'industria manifatturiera e la robotica.\r\n\r\nEtica e Privacy nella Visione Artificiale: Esplora le questioni etiche associate all\'uso della Visione Artificiale, inclusa la privacy delle persone e le potenziali implicazioni negative.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione della Visione Artificiale, condividere esperienze e affrontare sfide in questo affascinante campo della computer vision. ', 0, 0, '2024-02-29 19:58:08', 0, 7, 58, 59, 32),
(30, 'Crittografia', 'Esplora l\'entusiasmante mondo della crittografia attraverso dettagliate dispense di corso che coprono una vasta gamma di argomenti chiave:\r\n\r\nFondamenti della Crittografia: Comprendi i principi di base della crittografia, inclusi concetti come cifratura e decifratura, chiavi e algoritmi di crittografia simmetrica e asimmetrica.\r\n\r\nCifratura Simmetrica e Algoritmi Classici: Studia algoritmi classici come il cifrario di Cesare, il cifrario di Vigenère e la cifratura a trasposizione, comprendendo le loro forze e debolezze.\r\n\r\nCifratura Asimmetrica e Chiave Pubblica/Privata: Esamina l\'approccio della crittografia asimmetrica, che coinvolge una coppia di chiavi pubblica e privata, e comprendi come vengono utilizzate per garantire sicurezza nelle comunicazioni.\r\n\r\nProtocolli Sicuri di Comunicazione: Approfondisci i protocolli di comunicazione sicuri come HTTPS, che utilizzano crittografia per proteggere dati sensibili scambiati su reti.\r\n\r\nFunzioni di Hash e Integrità dei Dati: Studia le funzioni di hash e il loro utilizzo per garantire l\'integrità dei dati, nonché per la generazione di firme digitali.\r\n\r\nCrittografia Quantistica: Esplora le basi della crittografia quantistica, un approccio che sfrutta i principi della meccanica quantistica per garantire la sicurezza delle comunicazioni.\r\n\r\nSicurezza dei Sistemi Informatici e Difese Informatiche: Analizza come la crittografia contribuisce alla sicurezza dei sistemi informatici e comprendi le sfide della sicurezza informatica e le strategie di difesa.\r\n\r\nApplicazioni Pratiche in Ambito Aziendale e Sistemi Distribuiti: Esamina casi di studio e applicazioni pratiche della crittografia in contesti aziendali, sistemi distribuiti e applicazioni crittografiche moderne.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione della crittografia, condividere approcci e risolvere insieme le sfide in questo cruciale campo della sicurezza informatica. ', 0, 0, '2024-02-29 20:04:35', 0, 8, 60, 61, NULL),
(31, 'Virtualizzazione e integrazione di sistemi', 'Immergiti nel mondo della virtualizzazione e integrazione di sistemi attraverso dispense di corso dettagliate che affrontano una vasta gamma di concetti chiave:\r\n\r\nVirtualizzazione di Server e Macchine Virtuali: Comprende i principi fondamentali della virtualizzazione, inclusa la creazione e la gestione di macchine virtuali per ottimizzare l\'utilizzo delle risorse hardware.\r\n\r\nHypervisors e Virtualization Platforms: Studia gli hypervisors e le piattaforme di virtualizzazione, come VMware, Hyper-V e KVM, per comprendere come consentono l\'esecuzione simultanea di più sistemi operativi su una singola macchina fisica.\r\n\r\nContainerization e Docker: Esplora il concetto di containerizzazione con Docker, comprendendo come i container consentano l\'esecuzione isolata di applicazioni con tutte le loro dipendenze.\r\n\r\nOrchestrazione di Container con Kubernetes: Studia Kubernetes come sistema di orchestrare i container, semplificando la distribuzione, la scalabilità e la gestione delle applicazioni containerizzate.\r\n\r\nIntegrazione di Sistemi e Middleware: Approfondisci come integrare sistemi eterogenei utilizzando middleware, messaggistica e servizi web per facilitare la comunicazione e lo scambio di dati.\r\n\r\nArchitettura a Microservizi: Esplora l\'architettura a microservizi, comprendendo come frammentare le applicazioni in servizi più piccoli per migliorare la manutenibilità e la scalabilità.\r\n\r\nAutomazione e Scripting: Studia l\'automazione di processi di gestione e provisioning utilizzando scripting e strumenti come Ansible o Puppet.\r\n\r\nSicurezza e Governance nei Sistemi Virtualizzati: Analizza le pratiche di sicurezza e le politiche di governance per garantire la sicurezza e la conformità nei sistemi virtualizzati.\r\n\r\nMonitoraggio e Ottimizzazione delle Prestazioni: Comprendi come monitorare e ottimizzare le prestazioni dei sistemi virtualizzati, garantendo un funzionamento efficiente delle risorse.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione della virtualizzazione e integrazione di sistemi, condividere esperienze e affrontare le sfide nell\'orchestrare ambienti complessi. ', 0, 0, '2024-02-29 20:09:44', 0, 9, 62, NULL, NULL),
(32, 'HPC - high performance computing', 'Esplora il campo dell\'High Performance Computing (HPC) attraverso dettagliate dispense di corso che coprono una vasta gamma di argomenti chiave:\r\n\r\nArchitetture dei Supercomputer: Comprende le architetture avanzate dei supercomputer, inclusi cluster di calcolo, sistemi a memoria distribuita e acceleratori hardware come GPU.\r\n\r\nProgrammazione Parallela: Studia tecniche di programmazione parallela per sfruttare appieno la potenza di calcolo di sistemi HPC, compresi modelli di programmazione come OpenMP e MPI.\r\n\r\nCalcolo ad Alte Prestazioni in Cloud: Esplora come le risorse di calcolo ad alte prestazioni possono essere implementate e scalate utilizzando servizi cloud, garantendo flessibilità e accessibilità.\r\n\r\nApplicazioni Scientifiche e Simulazioni: Analizza come l\'HPC è utilizzato in ambiti scientifici per eseguire simulazioni complesse, modellazione numerica e risolvere problemi di grandi dimensioni.\r\n\r\nBig Data e HPC: Comprende l\'integrazione di tecniche HPC con l\'analisi dei big data, cercando di affrontare le sfide legate alla gestione di grandi volumi di dati in tempi brevi.\r\n\r\nSistemi di Storage ad Alte Prestazioni: Studia l\'architettura dei sistemi di storage progettati per supportare il carico di lavoro ad alte prestazioni, comprese tecnologie come Lustre e parallel file systems.\r\n\r\nReti ad Alte Prestazioni: Esamina le reti specializzate utilizzate nei sistemi HPC per garantire una comunicazione veloce e affidabile tra nodi di calcolo.\r\n\r\nSicurezza e Prestazioni: Analizza le sfide di sicurezza legate agli ambienti HPC e comprendi come garantire la sicurezza senza compromettere le prestazioni.\r\n\r\nTendenze Future nell\'HPC: Esplora le nuove tecnologie e le tendenze future nel campo dell\'High Performance Computing, comprese architetture emergenti e nuovi paradigmi di programmazione.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione dell\'High Performance Computing, condividere approcci e risolvere insieme le sfide in questo affascinante campo del calcolo scientifico. ', 0, 0, '2024-02-29 20:12:51', 0, 10, 63, 64, NULL),
(33, 'Computer graphics', 'Esplora l\'affascinante mondo della Grafica per Computer attraverso dettagliati materiali didattici che coprono una vasta gamma di argomenti chiave:\r\n\r\nIntroduzione alla Grafica per Computer: Comprendi i fondamenti della grafica per computer, inclusi le tecniche di rendering, la sintesi delle immagini e la rappresentazione degli oggetti tridimensionali.\r\n\r\nProgrammazione Grafica: Esplora le basi della programmazione grafica utilizzando linguaggi come OpenGL o DirectX, imparando a creare e manipolare elementi grafici sullo schermo.\r\n\r\nTrasformazioni 2D e 3D: Studia le fondamenta matematiche delle trasformazioni degli oggetti sia nello spazio 2D che in quello 3D, comprendendo la traslazione, la rotazione, il ridimensionamento e la proiezione.\r\n\r\nRasterizzazione e Tecniche di Rendering: Approfondisci il processo di conversione delle primitive grafiche in pixel ed esplora varie tecniche di rendering come il tracciamento dei raggi e la radianza.\r\n\r\nShading e Illuminazione: Comprendi come i modelli di shading e le tecniche di illuminazione contribuiscano all\'aspetto realistico delle immagini generate al computer, includendo la riflessione diffusa e speculare.\r\n\r\nMappatura delle Texture: Esplora il concetto di mappatura delle texture per aggiungere dettaglio e complessità alle superfici, migliorando il realismo delle scene generate al computer.\r\n\r\nAnimazione al Computer: Impara i principi dell\'animazione al computer, compresi il keyframing, l\'interpolazione e l\'animazione scheletrica, per dare vita a mondi virtuali.\r\n\r\nRealtà Virtuale (VR) e Realtà Aumentata (AR): Esplora l\'intersezione della grafica per computer con le tecnologie di VR e AR, capendo come la grafica contribuisca alle esperienze immersive.\r\n\r\nHardware Grafico e GPU: Studia l\'architettura dell\'hardware grafico, concentrandoti sulle Unità di Elaborazione Grafica (GPU), e comprendi come accelerano i processi di rendering.\r\n\r\nGrafica Interattiva al Computer: Approfondisci le applicazioni grafiche interattive, inclusi videogiochi e simulazioni, capendo le sfide e le tecniche coinvolte nel rendering in tempo reale.\r\n\r\nUnisciti a questa comunità per esplorare e approfondire la tua comprensione della Grafica per Computer, condividere esperienze e affrontare sfide in questo coinvolgente campo dell\'informatica visiva. ', 0, 0, '2024-02-29 21:20:22', 0, 11, 65, 66, NULL);

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
(1, 'Appunti utili, peccato aver parlato poco di sviluppo in ambiente iOS', 2, 2),
(2, 'Ho trovato questi appunti abbastanza utili, potresti portare un approfondimento sul determinante di una matrice?', 5, 2),
(3, 'Veramente interessanti questi appunti!', 9, 3);

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
(1, 1, 2),
(2, 4, 2),
(3, 6, 2),
(4, 1, 3),
(5, 2, 3),
(6, 7, 3),
(7, 9, 3),
(8, 11, 3);

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
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `follow`
--
ALTER TABLE `follow`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT per la tabella `media`
--
ALTER TABLE `media`
  MODIFY `IdMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT per la tabella `member`
--
ALTER TABLE `member`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `message`
--
ALTER TABLE `message`
  MODIFY `IdMsg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `IdNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `IdPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `IdSponsor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `usercomment`
--
ALTER TABLE `usercomment`
  MODIFY `IdComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `vote`
--
ALTER TABLE `vote`
  MODIFY `IdVote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
