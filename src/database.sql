-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2023 at 12:23 AM
-- Server version: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eitalian`
--

-- --------------------------------------------------------

--
-- Table structure for table `annunci`
--

CREATE TABLE `annunci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titolo` varchar(60) NOT NULL,
  `descrizione` varchar(300) NOT NULL,
  `prezzo` double NOT NULL,
  `username` varchar(25) NOT NULL,
  `materia` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annunci`
--

INSERT INTO `annunci` (`id`, `titolo`, `descrizione`, `prezzo`, `username`, `materia`) VALUES
(171, 'Analisi ripetizioni', 'Sono uno studente universitario di matematica con passione per la materia e desideroso di condividere le mie conoscenze. Offro ripetizioni di analisi matematica 1 per studenti che hanno difficoltà a comprendere i concetti o che vogliono migliorare il loro rendimento.', 20, 'carlo', 'Matematica'),
(192, 'Introduzione agli algoritmi e struttura dati', 'Libro usato ma in buone condizioni \"Introduzione ad Algoritmi e Strutture Dati\" di Thomas H. Cormen. Copre tutti i concetti fondamentali degli algoritmi e delle strutture dati, con esempi pratici e spiegazioni dettagliate. Venduto a causa della conclusione del corso universitario.', 25, 'ennioitaliano', 'Architettura Informatica'),
(193, 'I moderni sistemi operativi', 'Libro usato in ottime condizioni \"I moderni sistemi operativi\" di Andrew S. Tanenbaum. Copre tutti i concetti fondamentali dei sistemi operativi moderni, con esempi pratici e spiegazioni dettagliate. Venduto a causa della conclusione del corso universitario.', 20, 'irmagos', 'Sistemi Informatica'),
(194, 'Introduzione agli algoritmi e struttura dati', 'Libro usato ma in buone condizioni \"Introduzione ad Algoritmi e Strutture Dati\" di Thomas H. Cormen. Copre tutti i concetti fondamentali degli algoritmi e delle strutture dati, con esempi pratici e spiegazioni dettagliate. Venduto a causa della conclusione del corso universitario.', 20, 'ennioitaliano', 'Algoritmi Informatica'),
(195, 'I moderni sistemi operativi', 'Libro usato in ottime condizioni \"I moderni sistemi operativi\" di Andrew S. Tanenbaum. Copre tutti i concetti fondamentali dei sistemi operativi moderni, con esempi pratici e spiegazioni dettagliate. Venduto a causa della conclusione del corso universitario.', 30, 'admin', 'Sistemi Operativi Informatica'),
(197, 'Architettura e organizzazione dei calcolatori', 'Vendi libro nuovo di Architettura e organizzazione dei calcolatori, mai utilizzato. Un\'ottima risorsa per studenti universitari o per chiunque voglia approfondire le conoscenze sulle tecnologie dei calcolatori. Venduto a causa della conclusione degli studi.', 35, 'admin', 'Informatica'),
(198, 'Oggetti, Concorrenza, Distribuzione', 'Sono presenti appunti', 23.15, 'carlo', 'Matematica'),
(199, 'Oggetti, Concorrenza, Distribuzione', 'Oggetti, Concorrenza, Distribuzione ma anche altro', 25, 'irmagos', 'Matematica'),
(200, 'Calcolo numerico esercizi', 'Vendo libro usato di Esercizi di calcolo numerico, in buone condizioni. Una raccolta di esercizi e soluzioni per studenti universitari o per chiunque voglia affinare le conoscenze in campo numerico. Venduto perché superato dalla nuova edizione.', 45, 'irmagos', 'Matematica'),
(201, 'Calcolo numerico metodi ed algoritmi', 'Vendi libro usato di Esercizi di calcolo numerico, in buone condizioni. Una raccolta di esercizi e soluzioni per studenti universitari o per chiunque voglia affinare le conoscenze in campo numerico. Venduto perché superato dalla nuova edizione.', 23, 'irmagos', 'Calcolo Matematica'),
(202, 'Calcolo numerico esercizi', 'Vendi libro usato di Esercizi di calcolo numerico, in buone condizioni. Una raccolta di esercizi e soluzioni per studenti universitari o per chiunque voglia affinare le conoscenze in campo numerico. Venduto perché superato dalla nuova edizione.', 40, 'ennioitaliano', 'Matematica'),
(203, 'Computer Organization and Architecture', 'Vendo libro nuovo di Computer organization and architecture, mai utilizzato. Una risorsa fondamentale per studenti universitari o per chiunque voglia approfondire le conoscenze sulle tecnologie dei calcolatori. Venduto perché acquistato in doppia copia.', 15, 'chargreavesl', 'Informatica'),
(204, 'I moderni sistemi operativi', 'Libro usato in ottime condizioni \"I moderni sistemi operativi\" di Andrew S. Tanenbaum. Copre tutti i concetti fondamentali dei sistemi operativi moderni, con esempi pratici e spiegazioni dettagliate. Venduto a causa della conclusione del corso universitario.', 34, 'chargreavesl', 'Sistemi Operativi Informatica'),
(205, 'Struttura e progetto dei calcolatori', 'Quarta Edizione', 47, 'chargreavesl', 'Architettura Informatica'),
(206, 'Geometria Analitica con elementi di algebra lineare', 'Vendo libro usato di Geometria analitica con elementi di algebra lineare, in buone condizioni. Una guida completa alla geometria analitica con elementi di algebra lineare. Venduto perché superato dalla nuova edizione.', 5, 'stuxwells', 'Matematica'),
(207, 'Programmazione ad oggetti', 'Libro con utili spiegazioni di P2', 28, 'stuxwells', 'Informatica'),
(208, 'Introduzione agli algoritmi e strutture dati', 'Libro usato ma in buone condizioni \"Introduzione ad Algoritmi e Strutture Dati\" di Thomas H. Cormen. Copre tutti i concetti fondamentali degli algoritmi e delle strutture dati, con esempi pratici e spiegazioni dettagliate. Venduto a causa della conclusione del corso universitario.', 67, 'stuxwells', 'Informatica'),
(209, 'Reti di calcolatori', 'quinta ed.', 24, 'stuxwells', 'Informatica'),
(210, 'Basi di Dati', 'Vendo libro nuovo di Basi di Dati, mai utilizzato. Una risorsa fondamentale per studenti universitari o per chiunque voglia acquisire competenze nell\'amministrazione di basi di dati. Venduto perché acquistato in doppia copia.', 40, 'admin', 'Informatica'),
(211, 'Automi e linguaggi formali', 'Vendi libro usato di Automi e linguaggi formali, in buone condizioni. Una guida completa per studenti universitari o per chiunque voglia acquisire competenze nei linguaggi formali. Venduto perché non più necessario.', 16, 'admin', 'Informatica'),
(212, 'Calcolo Numerico', 'Appunti dettagliati e precisi sulla materia di Calcolo Numerico. Coprono tutti i metodi numerici più utilizzati, con esempi pratici e formule spiegati in modo semplice. Ideali per studenti universitari o per chiunque voglia approfondire le conoscenze in campo numerico.', 15, 'admin', 'Matematica Calcolo'),
(213, 'Analisi Matematica', 'Vendo appunti di analisi matematica 1 completi e dettagliati. Coperti tutti i principali argomenti del corso, scritti con un linguaggio semplice e facilmente comprensibile. Perfetti per gli studenti che vogliono ottenere il massimo dal loro studio.', 22, 'admin', 'Analisi Matematica'),
(214, 'Tecnologie Web', 'Appunti sul linguaggio HTML e CSS', 12, 'admin', 'Informatica WEB'),
(215, 'Analisi', 'Vendo appunti di alta qualità per Analisi Matematica 1, compilati da uno studente universitario con anni di esperienza. Coprono tutti gli argomenti del programma in modo dettagliato e comprensibile. Ideali per studenti universitari che vogliono avere successo nell\'esame.', 40, 'carlo', 'Analisi Matematica'),
(216, 'Appunti di tecnologie web', 'Appunti completi e ben strutturati sulla materia di Tecnologie Web. Coprono tutti i concetti fondamentali, dalla progettazione di siti web all\'utilizzo di framework moderni. Ideali per studenti universitari o per chiunque voglia acquisire competenze nel mondo del web.', 8, 'carlo', 'Informatica WEB'),
(217, 'Programmazione ad Oggetti', 'Appunti di P2 di informatica su QT', 35, 'carlo', 'Informatica Programmazione'),
(218, 'QT', 'ripetizioni sul linguaggio C++ e sulle basi di QT Creator e sul framework QT', 50, 'carlo', 'Informatica Programmazion'),
(219, 'Appunti di Sistemi Operativi', 'Appunti completi e ben strutturati sulla materia di Sistemi Operativi. Coprono tutti i concetti chiave, con esempi pratici e schemi esplicativi per una comprensione facile e rapida. Ideali per studenti universitari o per chiunque voglia approfondire le conoscenze sui sistemi operativi.', 16, 'stuxwells', 'Informatica Sistemi'),
(220, 'Cyber Security', 'Appunti completi e ben strutturati sulla materia di Cybersecurity. Coprono tutti gli aspetti fondamentali della sicurezza informatica, dalla crittografia alla prevenzione delle minacce. Ideali per studenti universitari o per chiunque voglia acquisire competenze in campo di sicurezza informatica.', 30, 'stuxwells', 'Informatica CyberSecurity'),
(221, 'Programmazione consapevole', 'Libro di programmazione scritto dal Prof. Gilberto File per il corso di informatica dell Universita di Padova', 23, 'carlo', 'Programmazione'),
(224, 'Inglese', 'Ripetizioni di Lingua inglese per esame di B2 listening', 30, 'carlo', 'Inglese Lingue'),
(225, 'Inglese', 'Ripetizioni di Inglese per il B2 Reading Listening', 50, 'admin', 'Inglese Lingue'),
(226, 'Basi Di Dati', 'Vendo libro nuovo di Basi di Dati, mai utilizzato. Una risorsa fondamentale per studenti universitari o per chiunque voglia acquisire competenze nell\'amministrazione di basi di dati. Venduto perché acquistato in doppia copia.', 22, 'stuxwells', 'Informatica Basi Di Dati'),
(227, 'Logica', 'Ripetizioni sulle formalizzazioni dal linguaggio naturale al linguaggio formale con spiegazione breve sugli alberi di derivazione', 35, 'stuxwells', 'Matematica Logica'),
(229, 'Programmazione Consapevole', 'Libro nuovo e mai utilizzato \"Programmazione Consapevole\" di Gilberto Filè. Copre tutti gli aspetti della programmazione, dalla mentalità alla produttività, con esempi pratici e consigli pratici. Venduto a causa della duplicazione con altri libri acquistati.', 23, 'carlo', 'dsg'),
(232, 'Programmazione consapevole', 'Libro di programmazione scritto dal Prof. Gilberto Filè per il corso di informatica dell&#039;Università di Padova', 23, 'carlo', 'Programmazione');

-- --------------------------------------------------------

--
-- Table structure for table `appunti`
--

CREATE TABLE `appunti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mediapath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appunti`
--

INSERT INTO `appunti` (`id`, `mediapath`) VALUES
(212, 'uploads/admin93b8bbb9e95f6e81e212b64527d1711d.jpg'),
(213, 'uploads/adminf98ab1289b8f29561cb7cc05cbc3da7c.jpg'),
(214, 'uploads/admin6397d3ac38c262dc22b88cc241ab3700.jpg'),
(215, 'uploads/carloa90e4aa9dbf72b670a1118c9ddc30079.jpg'),
(216, 'uploads/carloa90e4aa9dbf72b670a1118c9ddc30079.jpg'),
(217, 'uploads/carlo0e5acd93f0c869dca97438bc99300ea3.jpg'),
(219, 'uploads/stuxwells25b783385ba8efc9424b781b23b23ee3.jpg'),
(220, 'uploads/stuxwellseafe1818c81a03e18730037fbb6f94e7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `libri`
--

CREATE TABLE `libri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `autore` varchar(40) NOT NULL,
  `edizione` varchar(40) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `mediapath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libri`
--

INSERT INTO `libri` (`id`, `autore`, `edizione`, `ISBN`, `mediapath`) VALUES
(192, 'homas H. Cormen', 'McGraw', '4590299585', 'uploads/ennioitalianoe7bd00c889575d2721e755a1d65d8a93.jpg'),
(193, 'S. Tanenbaum', 'Mondadori', '9042791810', 'uploads/irmagos5b23f52f35fab01871c34a375e81ecb4.jpg'),
(194, 'homas H. Cormen', 'McGraw', '4590299584', 'uploads/ennioitaliano65505f1a7c93aa6e3b807601a4ab0385.jpg'),
(195, 'S. Tanenbaum', 'Mondadori', '9042791810', 'uploads/admin5b23f52f35fab01871c34a375e81ecb4.jpg'),
(197, 'Tomas Ferimbah', 'Pearson', '4226345487', 'uploads/adminb40881ebed885ad093400af69acefa0b.jpg'),
(198, 'Crafa', 'Escularo', '2316287316283', 'uploads/carlo1ac50fec1ff2a8bf48ce53d31ed7065e.jpg'),
(199, 'Silvia Crafa', 'BibUni', '1375534963', 'uploads/irmagos1ac50fec1ff2a8bf48ce53d31ed7065e.jpg'),
(200, 'Zaglia', 'Libraccio', '3419092741', 'uploads/irmagos78509cf99472c1aa9c90822220ad7a5f.jpg'),
(201, 'Zaglia', 'Edizione Libreria Pr PD', '5660194737', 'uploads/irmagos02c1f4f8fdc51b6543c14d5e99196850.jpg'),
(202, 'Zaglia', 'Libraccio', '3419092741', 'uploads/ennioitaliano78509cf99472c1aa9c90822220ad7a5f.jpg'),
(203, 'Williams Stallings', 'UniBib', '8803358854', 'uploads/chargreavesl55b0e9d0c40138c3c8f80081f3aeee59.jpg'),
(204, 'S. Tanenbaum', 'Paravia Pearson', '9042791811', 'uploads/chargreavesle6929b6f6935883a23767c66e9b9df71.jpg'),
(205, 'David A. Patterson e John L. Hennessy', 'Zanichelli', '5660194737', 'uploads/chargreavesl50c48f1071f5ce754b5c07840e07a306.jpg'),
(206, 'M. Abate', 'Feltrinelli', '7024146036', 'uploads/stuxwells76ae3165f7c1f14dc1f139ba7b7b9d15.jpg'),
(207, 'F.Ranzato', 'UniPadova', '2548684989', 'uploads/stuxwells93c7a183a0acbd2ff7b332f2355f5da0.jpg'),
(208, 'Cormen', 'Mondadori', '7032952151', 'uploads/stuxwells6af4524150c3fe5568988a93184db8ae.jpg'),
(209, 'Tanenbaum', 'UniVerona', '6948684912', 'uploads/stuxwellsb6e05844bd58b7c29e6e6ddb8d5ce881.jpg'),
(210, 'Ceri', 'UNIPD', '0159853648', 'uploads/admina3db56a19ce538bf9af2e35d1ff2ec33.jpg'),
(211, 'Hopcroft', 'Pearson', '088972133', 'uploads/admin6978bb15fd71342cccb223d119565ec7.jpg'),
(221, 'Gilberto Filè', '2020', '1234567890', 'uploads/carlo8c65f7e81d705eeb846fa985ce5795f2.jpg'),
(229, 'sdfg', '233434', '1234567890', ''),
(232, 'Gilberto Filè', '2020', '1234567890', '');

-- --------------------------------------------------------

--
-- Table structure for table `ripetizioni`
--

CREATE TABLE `ripetizioni` (
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ripetizioni`
--

INSERT INTO `ripetizioni` (`id`) VALUES
(171),
(218),
(224),
(225),
(226),
(227);

-- --------------------------------------------------------

--
-- Table structure for table `salvati`
--

CREATE TABLE `salvati` (
  `annuncio` bigint(20) UNSIGNED NOT NULL,
  `utente` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salvati`
--

INSERT INTO `salvati` (`annuncio`, `utente`) VALUES
(194, 'stuxwells'),
(195, 'stuxwells'),
(199, 'admin'),
(202, 'admin'),
(203, 'stuxwells'),
(204, 'stuxwells'),
(213, 'carlo'),
(224, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `datanascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`nome`, `cognome`, `username`, `email`, `password`, `datanascita`) VALUES
('Admin', 'Admin', 'admin', 'admin@admin.com', 'admin', '1999-12-29'),
('Andrei', 'Bobirica', 'andreibobirica', 'andreibobirica99@gmail.com', '12345678.S', '1999-12-29'),
('bug', 'fixer', 'bugFixer00', 'bug.fixer@si.com', '#12345678A', '1999-12-29'),
('Carlo', 'Costa', 'carlo', 'carlo.costa@studenti.unipd.com', '12345678.S', '1999-12-21'),
('Carin', 'Hargreaves', 'chargreavesl', 'chargreavesl@ox.ac.uk', 'eRepedk.', '1989-06-14'),
('Cornelius', 'Sentance', 'csentancek', 'csentancek@dyndns.org', 'N8HJEJm.', '1993-06-14'),
('Ennio', 'Italiano', 'ennioitaliano', 'ennio.italiano@studenti.unipd.it', '12345678.A', '2000-05-28'),
('Irma', 'Gossage', 'irmagos', 'irmagos@vk.com', 'Oa0jBT.', '1990-04-27'),
('Luis', 'Downton', 'ldowntonq', 'ldowntonq@samsung.com', '6QAx5Ht.', '1994-10-17'),
('Stuart', 'Tuxwell', 'stuxwells', 'stuxwells@friendfeed.com', 'rTZ3EYsnWPFb.', '1988-04-28'),
('User', 'User', 'user', 'user@gmail.com', 'user', '2023-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annunci`
--
ALTER TABLE `annunci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `username` (`username`);
ALTER TABLE `annunci` ADD FULLTEXT KEY `materia` (`materia`);
ALTER TABLE `annunci` ADD FULLTEXT KEY `descrizione` (`descrizione`);
ALTER TABLE `annunci` ADD FULLTEXT KEY `titolo` (`titolo`);
ALTER TABLE `annunci` ADD FULLTEXT KEY `titolo_2` (`titolo`,`descrizione`,`materia`);

--
-- Indexes for table `appunti`
--
ALTER TABLE `appunti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ripetizioni`
--
ALTER TABLE `ripetizioni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `salvati`
--
ALTER TABLE `salvati`
  ADD PRIMARY KEY (`annuncio`,`utente`),
  ADD KEY `utente` (`utente`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annunci`
--
ALTER TABLE `annunci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `appunti`
--
ALTER TABLE `appunti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `libri`
--
ALTER TABLE `libri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `ripetizioni`
--
ALTER TABLE `ripetizioni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annunci`
--
ALTER TABLE `annunci`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appunti`
--
ALTER TABLE `appunti`
  ADD CONSTRAINT `appunti_ibfk_1` FOREIGN KEY (`id`) REFERENCES `annunci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `libri`
--
ALTER TABLE `libri`
  ADD CONSTRAINT `libri_ibfk_1` FOREIGN KEY (`id`) REFERENCES `annunci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ripetizioni`
--
ALTER TABLE `ripetizioni`
  ADD CONSTRAINT `ripetizioni_ibfk_1` FOREIGN KEY (`id`) REFERENCES `annunci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salvati`
--
ALTER TABLE `salvati`
  ADD CONSTRAINT `salvati_ibfk_1` FOREIGN KEY (`annuncio`) REFERENCES `annunci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salvati_ibfk_2` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
