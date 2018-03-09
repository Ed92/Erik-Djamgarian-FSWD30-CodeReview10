-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Mrz 2018 um 16:28
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr10_erik_djamgarian_big_library`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `artist`
--

INSERT INTO `artist` (`artist_id`, `first_name`, `last_name`) VALUES
(1, 'Eminem', ''),
(2, 'Michael ', 'Jackson'),
(3, 'The', 'Killers'),
(4, 'Big', 'Shaq'),
(5, 'Hans', 'Zimmer'),
(6, 'Bushido', ''),
(7, 'Shindy', ''),
(8, 'Drake', ''),
(9, 'Kygo', ''),
(10, 'G-eazy', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'J. ', 'Tolkien'),
(2, 'J.K ', 'Rowling'),
(3, 'Stephen', 'King'),
(4, 'Charles', 'Dickens'),
(5, 'Pierre', 'Grimbert'),
(6, 'Michael', 'Peinkofer'),
(7, 'Brent', 'Weeks'),
(8, 'Trudi', 'Canavan'),
(9, 'Herman', 'Melville');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `big_library`
--

CREATE TABLE `big_library` (
  `big_library_id` int(11) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_cds_id` int(11) DEFAULT NULL,
  `fk_books_id` int(11) DEFAULT NULL,
  `fk_dvds_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `books`
--

CREATE TABLE `books` (
  `books_id` int(11) NOT NULL,
  `fk_author_id` int(11) NOT NULL,
  `fk_publisher_id` int(11) NOT NULL,
  `ISBN_code` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `publish_date` date DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `books`
--

INSERT INTO `books` (`books_id`, `fk_author_id`, `fk_publisher_id`, `ISBN_code`, `title`, `publish_date`, `type`, `image`, `description`) VALUES
(1, 1, 8, '098a0980', 'The first War', '1877-00-00', 'Book', 'war1.jpg', 'Realist Novel'),
(2, 2, 9, '09s80809', 'The art of War', '1856-00-00', 'Book', 'war2.jpg', 'Realist Novel'),
(3, 1, 8, '098098s0980', 'Harry Potter', '1865-00-00', 'Book', 'potter.jpg', 'Novel'),
(4, 3, 7, '098098s0898', 'The Great Gatsby', '1925-04-10', 'Book', 'gatsby.jpg', 'Novel'),
(5, 4, 6, '98908s098', 'The magicians guild', '1955-00-00', 'Book', 'magic.jpg', 'Novel'),
(6, 5, 5, '7978s9879', 'The gladiator', '1871-00-00', 'Book', 'gladiator.jpg', 'Novel'),
(7, 6, 4, '98790s7078', 'Robinson Crusoe', '1884-12-10', 'Book', 'rob.jpg', 'Novel'),
(8, 7, 3, '234234d234', 'Artemis Fowl', '1922-00-00', 'Book', 'artemis.jpg', 'Modernist'),
(9, 8, 2, '09890v09809', 'The wild cards', '1995-00-00', 'Book', 'cards.jpg', 'Novel'),
(10, 9, 1, '9790s90809', 'The gods', '1851-10-18', 'Book', 'gods.jpg', 'Novel');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cds`
--

CREATE TABLE `cds` (
  `cds_id` int(11) NOT NULL,
  `fk_artist_id` int(11) NOT NULL,
  `fk_record_label_id` int(11) NOT NULL,
  `ISBN_code` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_date` date DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `cds`
--

INSERT INTO `cds` (`cds_id`, `fk_artist_id`, `fk_record_label_id`, `ISBN_code`, `title`, `release_date`, `type`, `image`, `description`) VALUES
(1, 1, 1, '123d123d', 'Metalica', '2005-06-06', 'CD', 'metalica.jpg', 'Alternative Rock'),
(2, 2, 2, '2342j3342j', 'Ascne', '1982-11-30', 'CD', 'ascne.jpg', 'Pop'),
(3, 3, 3, '98098s89808', 'Christmas hits', '1980-07-25', 'CD', 'christmas.jpg', 'Hard Rock'),
(4, 6, 6, '9879s987', 'The hits of 2000', '1976-02-17', 'CD', '2000.jpg', 'Rock'),
(5, 4, 4, '97987s8987', 'The transformers', '1973-03-01', 'CD', 'transform.jpg', 'Progressive Rock'),
(6, 5, 5, '98787s9879', 'The geek club', '1992-11-17', 'CD', 'geeks.jpg', 'Pop'),
(7, 7, 7, '089w098', 'Dreams', '1997-11-04', 'CD', 'dreams.jpg', 'Country'),
(8, 8, 8, '09899s09809', 'Isklud', '1971-11-08', 'CD', 'isklud.jpg', 'Hard Rock'),
(9, 9, 9, '876786s768', 'Firestone', '1996-03-08', 'CD', 'fire.jpg', 'Pop'),
(10, 10, 1, '97s00979', 'Classics', '1965-08-06', 'CD', 'classics.jpg', 'Pop Rock');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dvds`
--

CREATE TABLE `dvds` (
  `dvds_id` int(11) NOT NULL,
  `fk_director_id` int(11) NOT NULL,
  `fk_production_company_id` int(11) NOT NULL,
  `ISBN_code` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_date` date DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `dvds`
--

INSERT INTO `dvds` (`dvds_id`, `fk_director_id`, `fk_production_company_id`, `ISBN_code`, `title`, `release_date`, `type`, `image`, `description`) VALUES
(1, 9, 9, '264524k334', 'Die Hard 1', '2005-05-15', 'DVD', 'diehard.jpg', 'Sci-Fi'),
(2, 8, 8, '08787s0887', 'The great Gatsby', '2017-09-08', 'DVD', 'gatsby1.jpg', 'Thriller'),
(3, 7, 7, '09808s9009', 'Mission impossible', '1939-08-25', 'DVD', 'mission.jpg', 'Fantasy'),
(4, 7, 7, '098098s080', 'Naruto', '1939-12-15', 'DVD', 'naruto.jpg', 'Drama'),
(5, 6, 6, '9809s8098', 'How I met your mother', '1941-04-01', 'DVD', 'kane.jpg', 'Drama'),
(6, 5, 5, '09890f09809', 'Star wars 1', '1942-11-26', 'DVD', 'starwars.jpg', 'Drama'),
(7, 4, 4, '0988b082', 'Unbreakable', '1980-11-14', 'DVD', 'unbreakable.jpg', 'Drama'),
(8, 3, 3, '098098n098', 'The Godfather', '1993-11-30', 'DVD', 'godfather.jpg', 'Drama'),
(9, 2, 2, '09809r098', 'The dark knight', '1994-09-10', 'DVD', 'darkknight.jpg', 'Drama'),
(10, 1, 1, '098098w089', 'Dragonball Z', '1972-03-15', 'DVD', 'dragonball.jpg', 'Crime');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_media_id` int(11) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `fk_author_id` int(11) NOT NULL,
  `fk_publisher_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `title` varchar(55) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `ISBN` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`media_id`, `fk_author_id`, `fk_publisher_id`, `type`, `title`, `image`, `description`, `ISBN`) VALUES
(1, 1, 1, 'book', 'The Magicians Guild', 'image.jpg', 'Description here,', 9781120215000),
(2, 2, 2, 'book', 'Eragon', 'image2.jpg', 'Description here, ', 9781120215017),
(3, 3, 3, 'book', 'Europe', 'image3.jpg', 'Description here, ', 9781120215024),
(4, 4, 4, 'book', 'Harry Potter', 'image4.jpg', 'Description here,', 9781120215031),
(5, 5, 5, 'book', 'The Hobbit', 'image5.jpg', 'Description here,', 9781120215048),
(6, 6, 6, 'book', 'The Iskluds', 'image6.jpg', 'Description here, ', 9781120215055),
(7, 7, 7, 'cd', 'Michael Jackson', 'image7.jpg', 'Description here,', 9781120215062),
(8, 8, 8, 'cd', 'Ascne', 'image8.jpg', 'Description here, ', 9781120215079),
(9, 9, 9, 'cd', 'Curtain call', 'image9.jpg', 'Description here, ', 9781120215086),
(10, 10, 10, 'cd', 'Uxlud', 'image10.jpg', 'Description here,', 9781120215093),
(11, 11, 11, 'cd', 'The youngsters', 'image11.jpg', 'Description here, ', 9781120215109),
(12, 12, 10, 'cd', 'The killers', 'image12.jpg', 'Description here', 9781120215123),
(13, 13, 13, 'dvd', 'Mission impossible', 'image13.jpg', 'Description here,', 9781120215130),
(14, 14, 14, 'dvd', 'The Godfather', 'image14.jpg', 'Description here, ', 9781120215116),
(15, 15, 15, 'dvd', 'Unbreakable', 'image15.jpg', 'description here, ', 9781120215147),
(16, 16, 16, 'dvd', 'Inception', 'image16.jpg', 'description here, ', 9781120215154),
(17, 17, 16, 'dvd', 'Star Wars', 'image17.jpg', 'Description here, ', 9781120215161),
(18, 18, 15, 'dvd', 'Die Hard', 'image18.jpg', 'Description here,  ', 9781120215178);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `size` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `name`, `address`, `size`) VALUES
(1, 'John Doe', 'UK', 'Small'),
(2, 'Farringdon Books', 'Germany', 'Small'),
(3, 'Piper', 'France', 'Small'),
(4, 'Heyne', 'USA', 'Medium'),
(5, 'Pearson ltd', 'UK', 'Large'),
(6, 'Ascne', 'France', 'Small'),
(7, 'Triple A', 'USA', 'Large'),
(8, 'Porter ltd', 'Russia', 'Small'),
(9, 'Isklud inc', 'France', 'Small');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(22) NOT NULL,
  `birthday` date NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `gender`, `birthday`, `user_email`, `user_pass`) VALUES
(0, 'erik', 'djamgarian', 'male', '1992-02-07', 'djamgarian0702@gmail.com', 'erik199207'),
(10, 'Admin', 'Admin', 'others', '0000-00-00', 'ascne@gmail.com', '112233');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indizes für die Tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indizes für die Tabelle `big_library`
--
ALTER TABLE `big_library`
  ADD PRIMARY KEY (`big_library_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_cds_id` (`fk_cds_id`),
  ADD KEY `fk_books_id` (`fk_books_id`),
  ADD KEY `fk_dvds_id` (`fk_dvds_id`);

--
-- Indizes für die Tabelle `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`books_id`),
  ADD KEY `fk_author_id` (`fk_author_id`),
  ADD KEY `fk_publisher_id` (`fk_publisher_id`);

--
-- Indizes für die Tabelle `cds`
--
ALTER TABLE `cds`
  ADD PRIMARY KEY (`cds_id`),
  ADD KEY `fk_artist_id` (`fk_artist_id`),
  ADD KEY `fk_record_label_id` (`fk_record_label_id`);

--
-- Indizes für die Tabelle `dvds`
--
ALTER TABLE `dvds`
  ADD PRIMARY KEY (`dvds_id`);

--
-- Indizes für die Tabelle `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `big_library`
--
ALTER TABLE `big_library`
  ADD CONSTRAINT `big_library_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `big_library_ibfk_2` FOREIGN KEY (`fk_cds_id`) REFERENCES `cds` (`cds_id`),
  ADD CONSTRAINT `big_library_ibfk_3` FOREIGN KEY (`fk_books_id`) REFERENCES `books` (`books_id`),
  ADD CONSTRAINT `big_library_ibfk_4` FOREIGN KEY (`fk_dvds_id`) REFERENCES `dvds` (`dvds_id`);

--
-- Constraints der Tabelle `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`fk_author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`fk_publisher_id`) REFERENCES `publisher` (`publisher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
