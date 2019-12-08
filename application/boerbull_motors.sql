-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 10 sep. 2019 à 02:43
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boerbull_motors`
--

-- --------------------------------------------------------

--
-- Structure de la table `boerbull_admin`
--

DROP TABLE IF EXISTS `boerbull_admin`;
CREATE TABLE IF NOT EXISTS `boerbull_admin` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boerbull_admin`
--

INSERT INTO `boerbull_admin` (`id`, `name`, `mail`, `password`) VALUES
(3, 'boerbull', 'boerbull@gmail.com', '$2y$10$w5sVTVxwDMv8YIjaIwsM6ejHMTZweDfAxYTZ/9EMgSmKM7HC2aAXq');

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `booking_date_debut` date NOT NULL,
  `booking_time_debut` time NOT NULL,
  `booking_date_fin` date NOT NULL,
  `booking_time_fin` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `number_of_seats` int(1) NOT NULL,
  `user_i` int(11) NOT NULL,
  `car_id` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`id`, `booking_date_debut`, `booking_time_debut`, `booking_date_fin`, `booking_time_fin`, `created_at`, `number_of_seats`, `user_i`, `car_id`) VALUES
(11, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '2019-06-23 18:45:28', 0, 0, NULL),
(24, '2019-12-20', '00:00:00', '0000-00-00', '00:00:00', '2019-07-05 23:02:53', 3, 3, 3),
(25, '2019-12-30', '14:00:00', '0000-00-00', '00:00:00', '2019-07-10 16:17:02', 0, 2, NULL),
(26, '2021-08-06', '00:00:17', '0000-00-00', '00:00:00', '2019-07-10 16:18:28', 2, 5, NULL),
(27, '2019-10-20', '00:00:00', '0000-00-00', '00:00:00', '2019-07-28 18:21:18', 3, 4, NULL),
(28, '2019-12-20', '00:00:00', '0000-00-00', '00:00:00', '2019-07-31 14:59:13', 0, 4, NULL),
(35, '2019-09-28', '14:00:00', '0000-00-00', '00:00:00', '2019-08-02 20:19:24', 1, 17, NULL),
(47, '2019-08-30', '00:00:10', '0000-00-00', '00:00:00', '2019-08-05 15:22:40', 2, 2, NULL),
(49, '2019-08-20', '00:00:00', '0000-00-00', '00:00:00', '2019-08-05 17:02:33', 2, 33, 6),
(50, '2019-09-13', '00:00:11', '0000-00-00', '00:00:00', '2019-08-05 17:06:04', 0, 33, NULL),
(51, '2019-09-28', '14:00:00', '0000-00-00', '00:00:00', '2019-08-10 01:07:37', 2, 33, 4),
(52, '2019-09-28', '14:00:00', '0000-00-00', '00:00:00', '2019-08-10 01:21:56', 1, 34, 6),
(61, '2020-02-20', '15:00:00', '0000-00-00', '00:00:00', '2019-08-23 04:36:12', 2, 28, 3),
(67, '2019-08-27', '09:00:00', '2019-08-31', '10:00:00', '2019-08-25 21:00:08', 0, 2, NULL),
(68, '2019-09-01', '09:00:00', '2019-10-10', '10:00:00', '2019-08-25 21:22:14', 0, 32, NULL),
(78, '2019-09-28', '14:00:00', '2019-08-30', '10:00:00', '2019-09-10 00:26:49', 1, 15, 6);

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) CHARACTER SET utf8 NOT NULL,
  `modele` varchar(255) CHARACTER SET utf8 NOT NULL,
  `annee` int(4) NOT NULL,
  `conso` int(4) NOT NULL,
  `color` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prix_trois_jours` int(10) NOT NULL,
  `puissance` int(5) NOT NULL,
  `moteur` varchar(5) NOT NULL,
  `carburant` varchar(255) NOT NULL,
  `cent` int(3) NOT NULL,
  `nombre_de_place` int(1) NOT NULL,
  `nombre_de_voiture` int(255) NOT NULL DEFAULT '1',
  `id_category` int(5) NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `marque`, `modele`, `annee`, `conso`, `color`, `prix_trois_jours`, `puissance`, `moteur`, `carburant`, `cent`, `nombre_de_place`, `nombre_de_voiture`, `id_category`, `image_url`) VALUES
(2, 'Audi', 'Q4', 2019, 11, 'jaune', 1500, 475, '6', 'diesel', 6, 5, 1, 5, 'audi-q4.jpg'),
(3, 'Ford Mustang', 'shelby GT 500', 2017, 14, 'bleu et blanc', 1100, 475, 'V8', 'essence', 4, 4, 1, 2, 'mustang.jpg'),
(4, 'Mercedes ', 'Cla 180 Business edition', 2018, 9, 'gris', 400, 122, '4', 'essence', 9, 4, 1, 3, 'mercedesCla.2018.jpg'),
(6, 'Tesla', 'MODEL S P100D', 2016, 10, 'rouge', 1500, 775, 'NC', 'electric', 3, 4, 1, 4, 'teslaRouge.jpg'),
(9, 'Porsche', '911 cabriolets CARRERA 4S', 2017, 13, 'blanc', 1000, 420, '6', 'essence', 4, 2, 1, 1, 'porsche-911blanc.jpg'),
(12, 'Audi', ' TT III COUPE 2.0 TFSI 230 S TRONIC', 2018, 8, 'bleu', 750, 230, '4', 'essence', 5, 2, 1, 3, 'audi-tt.jpg'),
(13, 'Aston martin', 'V12 VANTAGE Coupé', 2018, 15, 'gris', 1500, 573, 'v12', 'essence', 4, 2, 1, 3, 'aston-martin-v12-vantage.jpg'),
(14, 'Chevrolet', 'Camaro Coupé VI 6.2 V8', 2016, 13, 'noir', 1100, 453, 'V8', 'essence', 5, 4, 1, 2, 'troisquartavant1.jpg'),
(15, 'Chevrolet', 'Camaro 1SS Coupe', 2018, 12, 'blanc', 1100, 455, 'V8', 'essence', 5, 4, 1, 2, '083887_2018_chevrolet_Camaro.jpg'),
(16, 'Chevrolet', 'Corvette VII 6.2 V8 2LT', 2015, 12, 'jaune', 1000, 466, 'V8', 'essence', 4, 2, 1, 2, 'TROISQUAR.jpg'),
(17, 'Dodge', 'Challenger SRT8 ', 2015, 12, 'rouge', 1100, 376, 'V8', 'essence', 8, 4, 1, 2, 'image-copyright.jpeg'),
(18, 'Mercedes', 'classe S VII 600 L MAYBACH', 2016, 12, 'noir', 2000, 530, '12', 'essence', 5, 4, 1, 3, 'mercedes-maybach-s-600-pullman-guard-2016-a09d99-0@1x.jpg'),
(19, 'BMW', 'SERIE 8 M850IA 530 XDRIVE', 2018, 10, 'noir', 1200, 530, '8', 'diesel', 4, 4, 1, 3, 'S7-gamme--bmw-serie-8.jpg'),
(21, 'lamborgini', 'aventador', 2018, 12, 'gris', 1500, 523, 'V8', 'essence', 3, 2, 1, 1, 'aventador.jpg'),
(23, 'Ford mustang shelby', 'GT 500 2020', 0, 12, 'bleu', 3000, 700, 'V8', 'rhum', 5, 4, 1, 2, '2020-ford-shelby-mustang-gt500-1.jpg'),
(28, 'maybach', 'gt 3000', 0, 12, 'bleu', 1500, 800, 'V12', 'essence', 4, 5, 1, 3, 'maybach.jpg'),
(32, 'maclaren', 'mp4', 2018, 10, 'or', 1500, 700, 'V8', 'essence', 4, 2, 1, 1, 'maclarenmp4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'super car'),
(2, 'muscle car'),
(3, 'GT'),
(4, 'electric'),
(5, '4x4');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `mail`, `password`) VALUES
(2, 'Neymard', 'jean', 'jeanneymard@gmail.com', '$2y$10$D2oGKD2VDnaWZXQkvYwM.OTU.tIFmPqxAVFkcBaWDcoPzBzVepUEy'),
(6, 'stiquer', 'sophie', 'sophiestiquer@gmail.com', '$2y$10$161qNSIcPVjAAjPHQ0rKyu6EkMNYUBHh8kEy13mf6WzWAgBlAqWQ2'),
(7, 'amploi', 'paul', 'paulamploi@gmail.com', '$2y$10$6eMzh/p4qMgRglHwyo5.9uUd9LdcwElZlDKGKGmp68p0hVConoC6C'),
(8, 'registre', 'jean', 'jeanregistre@gmail.com', '$2y$10$dYEYTRxJDffabQgw9SW/TeHXjBjG9Fxlcqy0D68lx1EI9Lg/gC50m'),
(12, 'dor', 'theo', 'theodor@gmail.com', '$2y$10$F99nvCbcZT.MUYP/YnYjMeLO8GRUSZmd.xxGPeUPH/GEpaATbcdD6'),
(14, 'kanne', 'jerry', 'jerrykanne@gmail.com', '$2y$10$lByrDyZNoW9YKbyI5eM0Feuuq4g.ZtJ0i1U49/iUbYubd6/hbsCRS'),
(15, 'kauvaire', 'harry', 'harrykauvaire@gmail.com', '$2y$10$8Myd.2XBGRE40dlX/F4Ps.JGUVN9Rs1qd23DnWc96L31pXR3z1tzW'),
(28, 'nasse', 'anna', 'annanasse@gmail.com', '$2y$10$YBNCowrs5oIfHbNRVJZw.OwsXG6uNEBbn.GQMmYRu3LdnQqo7Z3/i'),
(32, 'malt', 'vita', 'vitamalt@gmail.com', '$2y$10$ka9q6tCrQIInVa/R29mrxO4Z9d9/MjBA.nq9rFgIoq9mEvXfdV.hu'),
(33, 'inne', 'carole', 'caroleinne@gmail.com', '$2y$10$yWcMv8bj/.dsNv/7YknpHe7nKJT0.0ouUj0/5GKN/JUrQUgPusm0O');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
