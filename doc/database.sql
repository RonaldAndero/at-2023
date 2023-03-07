-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2023 at 01:20 PM
-- Server version: 10.1.48-MariaDB-0+deb9u2
-- PHP Version: 7.0.33-0+deb9u12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `m7iktkhk_aastategija`
--
CREATE DATABASE IF NOT EXISTS `m7iktkhk_aastategija` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `m7iktkhk_aastategija`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Autocreated',
  `admin_name` varchar(50) NOT NULL COMMENT 'Autocreated',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`) VALUES
(1, 'admin #1'),
(2, 'admin #2');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Autocreated',
  `answer_text` varchar(191) NOT NULL COMMENT 'Autocreated',
  `answer_correct` tinyint(4) NOT NULL DEFAULT '0',
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `answer_text`, `answer_correct`, `question_id`) VALUES
(109, 'Hyper Text Markup Language  ', 1, 42),
(110, 'Hyperlinks and Text Markup Language ', 0, 42),
(111, 'Home Tool Markup Language', 0, 42),
(112, 'The World Wide Web Consortium  ', 1, 43),
(113, 'Google  ', 0, 43),
(114, 'Microsoft', 0, 43),
(115, '<h1>  ', 1, 44),
(116, '<head>', 0, 44),
(117, '<heading>  ', 0, 44),
(118, '<br>  ', 1, 45),
(119, '<break>', 0, 45),
(120, '<lb> ', 0, 45),
(121, '<body style=\"background-color:yellow;\">  ', 1, 46),
(122, '<body bg=\"yellow\">  ', 0, 46),
(123, '<background>yellow</background>', 0, 46),
(124, '<strong> ', 1, 47),
(125, '<b>', 0, 47),
(126, '<important>  ', 0, 47),
(127, '<em> ', 1, 48),
(128, '<i>', 0, 48),
(129, '<italic>', 0, 48),
(130, '<a href=\"https://khk.ee\">KHK</a> ', 1, 49),
(131, '<a>https://khk.ee</a>', 0, 49),
(132, '<a url=\"https://khk.ee\">khk</a>', 0, 49),
(133, '/  ', 1, 50),
(134, '<', 0, 50),
(135, '^', 0, 50),
(136, '<a href=\"url\" target=\"_blank\">  ', 1, 51),
(137, '<a href=\"url\" new>  ', 0, 51),
(138, '<a href=\"url\" target=\"new\">', 0, 51),
(139, '<table><tr><td>  ', 1, 52),
(140, '<table><head><tfoot>  ', 0, 52),
(141, '<table><tr><tt>', 0, 52),
(142, '<ol>  ', 1, 53),
(143, '<dl>', 0, 53),
(144, '<ul> ', 0, 53),
(145, '<ul>', 1, 54),
(146, '<ol>', 0, 54),
(147, '<list>', 0, 54),
(148, '<input type=\"checkbox\">  ', 1, 55),
(149, '<checkbox>', 0, 55),
(150, '<input type=\"check\">', 0, 55),
(151, '<input type=\"text\"> ', 1, 56),
(152, '<input type=\"textfield\">', 0, 56),
(153, '<textinput type=\"text\">', 0, 56),
(154, '<img src=\"image.gif\" alt=\"MyImage\">  ', 1, 57),
(155, '<img href=\"image.gif\" alt=\"MyImage\">', 0, 57),
(156, '<image src=\"image.gif\" alt=\"MyImage\">', 0, 57),
(157, '<body style=\"background-image:url(background.gif)\"> ', 1, 58),
(158, '<background img=\"background.gif\">  ', 0, 58),
(159, '<body bg=\"background.gif\">', 0, 58),
(160, '<title>  ', 1, 59),
(161, '<meta>', 0, 59),
(162, '<head> ', 0, 59),
(163, '<footer>', 1, 60),
(164, '<section>', 0, 60),
(165, '<bottom>', 0, 60),
(166, '<video>', 1, 61),
(167, '<movie>', 0, 61),
(168, '<media>', 0, 61),
(169, '<audio>', 1, 62),
(170, '<mp3>', 0, 62),
(171, '<sound>', 0, 62),
(172, 'XML', 1, 63),
(173, 'CSS', 0, 63),
(174, 'HTML', 0, 63),
(175, 'required', 1, 64),
(176, 'validate', 0, 64),
(177, 'formvalidate', 0, 64),
(178, '<nav>', 1, 65),
(179, '<navigate>', 0, 65),
(180, '<navigation>', 0, 65),
(181, 'Cascading Style Sheets', 1, 66),
(182, 'Creative Style Sheets', 0, 66),
(183, 'Computer Style Sheets', 0, 66),
(184, '<link rel=\"stylesheet\" type=\"text/css\" href=\"mystyle.css\"> ', 1, 67),
(185, '<stylesheet>mystyle.css</stylesheet>', 0, 67),
(186, '<style src=\"mystyle.css\"> ', 0, 67),
(187, '<style>', 1, 68),
(188, '<css>', 0, 68),
(189, '<script>', 0, 68),
(190, 'body {color: black;}', 1, 69),
(191, '{body;color:black;}', 0, 69),
(192, '{body:color=black;}', 0, 69),
(193, '/* this is a comment */', 1, 70),
(194, '// this is a comment', 0, 70),
(195, '// this is a comment //', 0, 70),
(196, 'h1 {background-color:#FFFFFF;}', 1, 71),
(197, 'all.h1 {background-color:#FFFFFF;}', 0, 71),
(198, 'h1.all {background-color:#FFFFFF;}', 0, 71),
(199, 'color', 1, 72),
(200, 'text-color', 0, 72),
(201, 'fgcolor', 0, 72),
(202, 'font-size', 1, 73),
(203, 'text-size', 0, 73),
(204, 'text-style', 0, 73),
(205, 'p {font-weight:bold;}', 1, 74),
(206, 'p {text-size:bold;}', 0, 74),
(207, '<p style=\"font-size:bold;\">', 0, 74),
(208, 'font-family ', 1, 75),
(209, 'font-style', 0, 75),
(210, 'font-weight', 0, 75),
(211, 'font-weight:bold;', 1, 76),
(212, 'style:bold;', 0, 76),
(213, 'font:bold;', 0, 76),
(214, 'margin-left', 1, 77),
(215, 'padding-left', 0, 77),
(216, 'indent', 0, 77),
(217, 'list-style-type: square;', 1, 78),
(218, 'list: square;', 0, 78),
(219, 'list-type: square;', 0, 78),
(220, '#demo', 1, 79),
(221, '.demo', 0, 79),
(222, '*demo', 0, 79),
(223, 'div p', 1, 80),
(224, 'div.p', 0, 80),
(225, 'div + p', 0, 80),
(226, 'static', 1, 81),
(227, 'fixed', 0, 81),
(228, 'relative', 0, 81);

-- --------------------------------------------------------

--
-- Table structure for table `practical`
--

DROP TABLE IF EXISTS `practical`;
CREATE TABLE IF NOT EXISTS `practical` (
  `practical_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Autocreated',
  `practical_text` text NOT NULL COMMENT 'Autocreated',
  `practical_title` varchar(255) NOT NULL,
  PRIMARY KEY (`practical_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `practical`
--

INSERT INTO `practical` (`practical_id`, `practical_text`, `practical_title`) VALUES
(6, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane lehe pealkirjaks enda nimi.;2. Kujunda tabel milles on kolm veergu ja kolm rida.;3. Tabeli laiuseks määra 100%.;4. Tabeli, tabeli veeru ja tabeli rea äärise paksuseks määra 25 pikslit, \"solid\" ja värviks must.;5. Täida tabel vabalt valitud andmetega.;6. Pane kogu lehel oleva teksti suuruseks 16 pikslit ja joonda rööpselt.;7. Lisa lehele tiitel - Tänase päeva moto!;8. Loo paragrahv, mille sisuks on lühike vabalt valitud tekst.;9. Määra paragrahvi värvuseks roheline, fontiks Calibri, suuruseks 45 pikslit ja joonda tekst paremale;10. Lisaks sellele tee nii, et iga paragrahvis olev sõna oleks eraldi rea peal.;        ', 'Ülesanne 1'),
(14, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur;2. Lisa lehele taustavärv - kollane.;3. Lisa punase fondiga tekst “Tere tulemast”, pealkirja suurus H1;4. Joonista sinine vabalt valitud kujund - joonda keskele;5. Koodi sisse tuleb lisada vähemalt üks kommentaar.;6. Pane kogu lehel oleva teksti suuruseks 16 pikslit ja joonda keskele.;7. Loo järjestatud list, mille elementideks kirjuta kolm omadussõna, mis sind kõige paremini iseloomustavad.;8. Lisa lehele tiitel - Tänase päeva moto!;9. Loo paragrahv, mille sisuks on lühike vabalt valitud tekst.;10. Iga paragrahvis olev sõna oleks eraldi rea peal.;        ', 'Ülesanne 2'),
(16, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur;2. Lisa lehele taustavärv - roosa;3. Lisa punase fondiga tekst “Tere tulemast”, pealkirja suurus H2;4. Lisa tabel, kahe veeru ja kolme reaga (sisesta vabalt valitud tekst tabelisse);5. Tabeli raami paksus 2;6. Joonda TABEL keskele;7. Lisa tekst:;Eesnimi:;Perekonnanimi:;Kuupäev:;Nime alla lisad oma nime, kuupäevaks tänane kuupäev;8. Tabeli laiuseks määra 70%.;9. Koodi sisse tuleb lisada vähemalt üks kommentaar.;10. Tabeli, tabeli veeru ja tabeli rea äärise paksuseks määra 25 pikslit, \"solid\" ja värviks must.;        ', 'Ülesanne 3'),
(21, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur;2. Lisa lehele taustavärv - sinine;3. Lisa valge fondiga tekst “Tere tulemast”, pealkirja suurus H2;4. Lisa pilt aadressilt: (https://i.ytimg.com/vi/c7oV1T2j5mc/maxresdefault.jpg). Tee pildist link ja suuna aadressile: https://www.estravel.ee/blog/san-juani-maed-metsikud-kaevanduslinnad-hirmkallil-teel/;6. Lisa tekst:;Eesnimi:;Perekonnanimi:;Kuupäev:;7. Nime alla lisad oma nime, kuupäevaks tänane kuupäev;8. Koodi sisse tuleb lisada vähemalt üks kommentaar.;9. Kirjuta paragrahvina \"Omadussõnad, mis mind iseloomustavad:\" - kirjuta vähemalt 5 omadussõna mis just sind iseloomustavad;10. Lisa lehele tiitel - Tänase päeva moto!;        ', 'Ülesanne 4'),
(23, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur;2. Lisa lehele taustavärv - #354685;3. Lisa  #FFFFFF värvi fondiga tekst “Olen kandideerimas Noorem tarkvaraarendaja erialale”, pealkirja suurus H2;4. Tee kolme veeru ja kahe reaga tabel;5. Lisa tabeli sisse tekst:;Eesnimi:;Perekonnanimi:;Kuupäev:;Nime alla lisad oma nime, kuupäevaks tänane kuupäev;6. Tabeli laiuseks määra 70%.;7. Joonda TABEL lehe keskele;8. Koodi sisse tuleb lisada vähemalt üks kommentaar.;9. Lisa link nimega TKHK (suuna veebilehele https://khk.ee/);10. Kirjuta paragrahvina \"Omadussõnad, mis mind iseloomustavad:\" - kirjuta vähemalt 5 omadussõna mis just sind iseloomustavad;        ', 'Ülesanne 5'),
(24, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur.;2. Lisa lehele taustavärv - #354685.;3. Lisa font - Calibri Light;4. Lisa  tekst “Kandideerin Noorem Tarkvaraarendaja erialale”, pealkirja suurus H3.;5. Lisa lõik  tekstiga - Miks soovid õppida noorem tarkvaraarendaja erialal? - kirjuta vähemalt 2 lauseline põhjendus, teksti värv - #FFFFFF.;6. Lisa vorm järgnevate väljadega: Eesnimi, Perenimi, Kuupäev. ;Nime alla lisad oma nime, kuupäevaks tänane kuupäev. Eesnimi, perenimi ja kuupäev peavad olema eraldi ridadel.;7. Lisa vormi alla nupp “Saada”.;8. Lisa tabel, kahe veeru ja kolme reaga;9. Sisesta veeru pealkirjad: Kandideerija, tulemus.;Tabelis peavad olema kahe kandideerja nimed ja punktid - need võid vabalt ise välja mõelda .;10. Koodi sisse tuleb lisada vähemalt üks kommentaar.;        ', 'Ülesanne 6'),
(25, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur. Loo suurima formaadiga pealkiri, mille sisuks on vabalt valitud tekst.;2. Määra pealkirja värvuseks #354685, fontiks Verdana ja suuruseks 35 pikslit.;3. Lisa paragrahv, mille sisuks on vabalt valitud tekst - vähemalt 3 lauset.;4. Määra paragrahvi värvuseks punane, fontiks Arial ja suuruseks 20 pikslit.;5. Lisa pilt ja joonda lehe keskele: (https://i.ytimg.com/vi/c7oV1T2j5mc/maxresdefault.jpg).;6. Pildi laiuseks määra 200 pikslit.;7. Pildi asukoht ülemisest äärest 100 pikslit.;8. Pildi ääris(border) 20 pikslit, pidev joon.;9. Koodi sisse tuleb lisada vähemalt üks kommentaar.;10. Joonista sinine vabalt valitud kujund - joonda paremale;        ', 'Ülesanne 7'),
(26, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur. Määra lehe tiitliks enda eesnimi.;2. Kirjuta kõige suurema pealkirjana oma täisnimi.;3. Kirjuta kõige väiksema pealkirjana oma sünnilinn.;4. Kirjuta h2 pealkiri \"Omadussõnad, mis mind iseloomustavad:\" - joonda keskele;5. Määra h2 fontiks Verdana, suuruseks 18px ja värviks punane.;6. Lisa järjestatud list, mille elementideks kirjuta kolm omadussõna, mis sind kõige paremini iseloomustavad - vähemalt 5.;7. Lisa pilt  ja joonda lehe keskele: (https://i.ytimg.com/vi/c7oV1T2j5mc/maxresdefault.jpg).;8. Pildi laiuseks määra 200 pikslit.;9. Pildi asukoht ülemisest äärest 100 pikslit.;10. Pildi ääris(border) 20 pikslit, katkendlik joon.;        ', 'Ülesanne 8'),
(27, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur. Loo suurima formaadiga pealkiri, mille sisuks on vabalt valitud tekst.;2. Määra pealkirja värvuseks punane, fontiks Impact, suuruseks 50 pikslit ja joonda tekst keskele.;3. Lisa paragrahv, mille sisuks on lühike vabalt valitud tekst - vähemalt 3 lauset.;4. Määra paragrahvi värvuseks roheline, fontiks Calibri, suuruseks 45 pikslit ja joonda tekst paremale.;5. Lisa pilt(https://i.ytimg.com/vi/c7oV1T2j5mc/maxresdefault.jpg), millele klikkimine viib https://khk.ee/ leheküljele.;6. Joonda pilt keskele, määra pildi laiuseks 50%;7. Tee pildi nurgad ümaraks.;8. Lisa pildile ääris(border) 20 pikslit, pidev joon.;9. Koodi sisse tuleb lisada vähemalt üks kommentaar.;10. Lisa lehele tiitel - Tänase päeva moto!;        ', 'Ülesanne 9'),
(28, 'NB! ülesande lahenduses tuleb HTML ja CSS kirjutada ühe ja sama faili sisse. CSS-i jaoks eraldi faili luua ei saa. Koodi kirjutamisel kasuta treppimist;1. Pane paika HTML dokumendi struktuur.;2. Lisa lehele tiitel - Tänase päeva moto!;3. Lisa pilt(https://i.ytimg.com/vi/c7oV1T2j5mc/maxresdefault.jpg), millele klikkimine viib https://khk.ee/ leheküljele.;4. Tee pildi nurgad ümaraks.;5. Koodi sisse tuleb lisada vähemalt üks kommentaar.;6. Lisa vorm järgnevate väljadega: Eesnimi, Perenimi, Kuupäev. ;Nime alla lisad oma nime, kuupäevaks tänane kuupäev. Eesnimi, perenimi ja kuupäev peavad olema eraldi ridadel.;7. Lisa vormi alla nupp “Saada”.;8. Joonista sinine vabalt valitud kujund - joonda paremale;9. Lisa lehele taustavärv - #354685.;10. Lisa font - Calibri Light;        ', 'Ülesanne 10');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` text,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`) VALUES
(42, 'What does HTML stand for?'),
(43, 'Who is making the Web standards?'),
(44, 'Choose the correct HTML element for the largest heading:'),
(45, 'What is the correct HTML element for inserting a line break?'),
(46, 'What is the correct HTML for adding a background color?'),
(47, 'Choose the correct HTML element to define important text'),
(48, 'Choose the correct HTML element to define emphasized text'),
(49, 'What is the correct HTML for creating a hyperlink?'),
(50, 'Which character is used to indicate an end tag?'),
(51, 'How can you open a link in a new tab/browser window?'),
(52, 'Which of these elements are all <table> elements?'),
(53, 'How can you make a numbered list?'),
(54, 'How can you make a bulleted list?'),
(55, 'What is the correct HTML for making a checkbox?'),
(56, 'What is the correct HTML for making a text input field?'),
(57, 'What is the correct HTML for inserting an image?'),
(58, 'What is the correct HTML for inserting a background image?'),
(59, 'Which HTML element defines the title of a document?'),
(60, 'Which HTML element is used to specify a footer for a document or section?'),
(61, 'What is the correct HTML element for playing video files?'),
(62, 'What is the correct HTML element for playing audio files?'),
(63, 'Graphics defined by SVG is in which format?'),
(64, 'In HTML, which attribute is used to specify that an input field must be filled out?'),
(65, 'Which HTML element defines navigation links?'),
(66, 'What does CSS stand for?'),
(67, 'What is the correct HTML for referring to an external style sheet?'),
(68, 'Which HTML tag is used to define an internal style sheet?'),
(69, 'Which is the correct CSS syntax?'),
(70, 'How do you insert a comment in a CSS file?'),
(71, 'How do you add a background color for all <h1> elements?'),
(72, 'Which CSS property is used to change the text color of an element?'),
(73, 'Which CSS property controls the text size?'),
(74, 'What is the correct CSS syntax for making all the <p> elements bold?'),
(75, 'Which property is used to change the font of an element?'),
(76, 'How do you make the text bold?'),
(77, 'Which property is used to change the left margin of an element?'),
(78, 'How do you make a list that lists its items with squares?'),
(79, 'How do you select an element with id \'demo\'?'),
(80, 'How do you select all p elements inside a div element?'),
(81, 'What is the default value of the position property?');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `result_id` int(10) UNSIGNED NOT NULL COMMENT 'Autocreated',
  `theoretical_points` tinyint(4) NOT NULL DEFAULT '-1' COMMENT 'Autocreated',
  `user_id` int(10) UNSIGNED NOT NULL,
  `practical_errors` blob,
  `practical_points` tinyint(4) DEFAULT '-2',
  `nr_of_questions` tinyint(3) UNSIGNED DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `practical_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `theoretical_points`, `user_id`, `practical_errors`, `practical_points`, `nr_of_questions`, `date`, `practical_id`) VALUES
(0, 14, 130, 0x613a303a7b7d, -1, 30, '2023-03-01 09:56:07', 16);

--
-- Triggers `results`
--
DROP TRIGGER IF EXISTS `results_deleted`;
DELIMITER $$
CREATE TRIGGER `results_deleted` BEFORE DELETE ON `results` FOR EACH ROW INSERT INTO results_log
SET result_id = OLD.result_id,
theoretical_points = OLD.theoretical_points,
user_id = OLD.user_id,
practical_errors = OLD.practical_errors,
practical_points = OLD.practical_points,
nr_of_questions = OLD.nr_of_questions,
firstname = (SELECT firstname FROM results INNER JOIN users ON results.user_id = users.user_id WHERE results.user_id = OLD.user_id),
lastname = (SELECT lastname FROM results INNER JOIN users ON results.user_id = users.user_id WHERE results.user_id = OLD.user_id),
date = OLD.date
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `results_log`
--

DROP TABLE IF EXISTS `results_log`;
CREATE TABLE IF NOT EXISTS `results_log` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `result_id` int(10) UNSIGNED NOT NULL,
  `theoretical_points` tinyint(4) NOT NULL DEFAULT '-1',
  `user_id` int(10) UNSIGNED NOT NULL,
  `practical_errors` blob,
  `practical_points` tinyint(4) DEFAULT '-2',
  `nr_of_questions` tinyint(3) UNSIGNED DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` char(1) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `nr_of_questions` tinyint(4) NOT NULL,
  `htmlvalidator` tinyint(4) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `livehtml` tinyint(3) UNSIGNED DEFAULT NULL,
  `scores` tinyint(3) UNSIGNED DEFAULT NULL,
  `scores_private` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `pwd`, `nr_of_questions`, `htmlvalidator`, `start`, `end`, `livehtml`, `scores`, `scores_private`) VALUES
('1', '0491', 30, 1, NULL, NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `translation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phrase` varchar(191) NOT NULL,
  `language` char(3) NOT NULL,
  `translation` varchar(191) DEFAULT NULL,
  `controller` varchar(15) NOT NULL,
  `action` varchar(20) NOT NULL,
  PRIMARY KEY (`translation_id`),
  UNIQUE KEY `language_phrase_controller_action_index` (`language`,`phrase`,`controller`,`action`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`translation_id`, `phrase`, `language`, `translation`, `controller`, `action`) VALUES
(1, 'Action', 'ee', '{untranslated}', 'global', 'global');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(191) DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `social_id` varchar(14) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_social_id_uindex` (`social_id`),
  UNIQUE KEY `UNIQUE` (`user_name`),
  UNIQUE KEY `users_user_name_social_id_uindex` (`user_name`,`social_id`)
) ENGINE=InnoDB AUTO_INCREMENT=641 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `is_admin`, `password`, `deleted`, `firstname`, `lastname`, `social_id`) VALUES
(17, 'admin', 1, '$2y$10$pUJeNPp/.RdO0GiM3ALzAOoy.oBH5W/FuQ4uHGpCq5imnCFkD42ZK', 0, 'Renee', 'Säks', '39501202844');

---
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);
SET FOREIGN_KEY_CHECKS=1;
