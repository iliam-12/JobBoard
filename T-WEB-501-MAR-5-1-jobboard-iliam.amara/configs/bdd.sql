-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 oct. 2021 à 09:03
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_job`
--

DROP TABLE IF EXISTS `admin_job`;
CREATE TABLE `admin_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin_job`
--

INSERT INTO `admin_job` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '9a7e226a5f0def443ccccdeffd026f40');

-- --------------------------------------------------------

--
-- Structure de la table `advertising`
--

DROP TABLE IF EXISTS `advertising`;
CREATE TABLE IF NOT EXISTS `advertising` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `descript` text,
  `wages` int(11) DEFAULT NULL,
  `companie_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `date_e` date DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `companies_id` int(11) DEFAULT NULL,
  `contrat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_id` (`companies_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `advertising`
--

INSERT INTO `advertising` (`id`, `titre`, `descript`, `wages`, `companie_name`, `city`, `date_e`, `published`, `companies_id`, `contrat`) VALUES
(1, 'Maçon', 'Description du poste\r\n\r\nMD concept\r\n\r\nest une société spécialisé en BTP travaux de maçonnerie générale - rénovation - gros-oeuvre de batiment tout corps d\'états.\r\n\r\nDans le sillage de la forte croissance de l\'entreprise, qui nous assure une activité en pleine expansion et continue au long terme, MD concept structure son développement et recherche des maçons qualifiés confirmés.\r\n\r\nrattaché au chef d\'équipe, vous intervenez sur les chantiers.\r\n\r\nA ce titre vous serez amenez à :\r\n\r\n- réaliser l\'ossature en béton armé sur des chantiers de construction de bâtiments,\r\n\r\n- la préparation, la réalisation et la mise en place de banches, le montage d\'agglos,\r\n\r\n- l\'assemblage et le positionnement des éléments d\'armature d\'un béton,\r\n\r\n- l\'étayage, le ferraillage, le coulage des éléments de béton,\r\n\r\n- la pose des parpaings, la manutention des matériaux, le nettoyage et rangement du chantier dans le respect des normes de sécurité.\r\n\r\nqualification :\r\n\r\nvous bénéficiez d\'une solide expérience sur un poste similaire avec minimum 5 années.\r\n\r\nvous êtes ponctuel, sérieux, dynamique, minutieux et surtout autonome.\r\n\r\nvotre disponibilité, votre rigueur et votre capacité à travailler en équipe seront vos atouts pour évoluer dans le poste.\r\n\r\ncaractéristique du poste :\r\n\r\ndu lundi au vendredi\r\n\r\ncontrat CDD évolutif CDI à temps plein\r\n\r\nrémunération 2440€\r\n\r\nposte à pourvoir dès que possible\r\n\r\nsi ce poste vous intéresse merci d\'envoyer votre CV.\r\n\r\nType d\'emploi : CDI\r\n\r\nSalaire : à partir de 2 440,00€ par mois\r\n\r\nHoraires :\r\n\r\nDu Lundi au Vendredi\r\nTélétravail:\r\n\r\nNon', 1800, 'ESE', NULL, '2021-09-30', 1, 1, 'CDI'),
(3, 'Peintre', 'L\'entreprise\r\n\r\nCorallis Travail Temporaire recherche pour l\'un de ses clients, un peintre de bâtiment (H/F) dans le cadre d\'une mission de travail temporaire avec de réelles opportunités d\'emploi durable. Le poste est basé à Marseille (13)\r\n\r\n\r\nVos missions ?\r\n\r\nAu sein d\'un collectif qui rassemble des artisans indépendants travaillant essentiellement autour des métiers de la décoration intérieure de la menuiserie intérieure, la plâtrerie, le revêtement de sols et de mur, vos missions seront les suivantes:\r\n\r\nFinitions des murs, des plafonds et des sols d\'un bâtiment, que ce soit en intérieur ou en extérieur\r\nEmbellit, protège et assainit les constructions\r\nLa finition des travaux et le nettoyage du chantier\r\n\r\nSalaire: 1610 euros brut/mois\r\nEtes vous fait(e) pour le poste ?\r\n\r\nVous êtes récemment diplômé(e) ou vous disposez de 3 ans d’expériences en tant que peintre en bâtiment\r\n\r\nPour mener à bien votre mission, vous devez être méthodique, minutieux, organisé(e), et surtout soigneux dans votre travail\r\n\r\nVous recherchez un emploi dans un secteur d\'activité en plein essor ? Vous désirez vous investir sur un métier avec de réelles opportunités d\'emploi durable ? Alors n\'hésitez plus, postulez !', 1200, 'ESE', NULL, '2021-09-30', 1, 1, 'CDI'),
(4, 'Electricien', 'Electricien bâtiment, tertiaire.\r\n\r\nVous êtes autonomes, consciencieux, vous aurez en charge la réalisation de travaux électriques neuf et rénovation(Hors promotion).\r\n\r\nVous disposez d\'une solide expérience en la matière, une évolution salariale sera possible suivant vos compétences et résultats.\r\n\r\nType d\'emploi : Temps plein, CDI\r\n\r\nSalaire : 1 888,00€ à 2 495,00€ par mois\r\n\r\nHoraires :\r\n\r\nDu Lundi au Vendredi\r\nRémunération supplémentaire :\r\n\r\nPrimes\r\nFormation:\r\n\r\nCAP / BEP (Optionnel)\r\nExpérience:\r\n\r\nÉlectricien en bâtiment h/f ou similaire: 5 ans (Exigé)\r\nPermis/certificat:\r\n\r\nPermis de conduire (Exigé)\r\nDisposition à l\'égard des déplacements professionnels:\r\n\r\n25 % (Optionnel)\r\nTélétravail:\r\n\r\nNon', 2500, 'test', NULL, '2021-10-01', 1, 1, 'CDI'),
(38, 'Développeur Front-End', 'HN Services recrute un développeur Front-end afin de participer au développement et la maintenance des applications de notre client Marseillais\r\n\r\nTa mission :\r\nAnalyse des besoins\r\nDéveloppement Front-End avec Angular\r\nMaintenance évolutive et corrective\r\nTest\r\nRédaction de la documentation\r\n\r\nEnvironnement technique : Angular, PHP, Symfony, MongoDB, NestJS, MySQL, Go, Node.JS, Python', 1999, 'Le Silex', 'Tartampion', '2021-10-13', 1, NULL, 'CDD'),
(37, 'a', 'a', 1, 'Sofidis', 'a', '2021-10-12', 1, 3, 'alternance');

-- --------------------------------------------------------

--
-- Structure de la table `applied`
--

DROP TABLE IF EXISTS `applied`;
CREATE TABLE IF NOT EXISTS `applied` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companies_id` int(11) DEFAULT NULL,
  `people_id` int(11) DEFAULT NULL,
  `add_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_id` (`companies_id`),
  KEY `people_id` (`people_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_e` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` text,
  `addr` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `siret` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `companies`
--

INSERT INTO `companies` (`id`, `name_e`, `email`, `password`, `phone`, `website`, `addr`, `postal_code`, `city`, `siret`) VALUES
(1, 'ESE', 'ese@gmail.com', NULL, '0102030405', 'website.com', '10 traverse d\'epitech', '13002', 'Marseille', '121323413'),
(2, 'test', 'a@a.a', 'd0f1ced6f5e40aeaaaa4803d0c844982', NULL, NULL, NULL, '13000', NULL, NULL),
(3, 'Sofidis', 'e@e.e', '3a692f5de614441dfdd94acb73d22d7c', '0202020202', 'calcium.com', 'rue silex', '13005', '95005', '123456789'),
(4, NULL, 'z@z.z', 'de85e4c8b2430c1c9a838f8e434f36da', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `CV` blob,
  `sex` varchar(255) DEFAULT NULL,
  `picture` blob,
  `gender` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `postal_code`, `city`, `addr`, `birthdate`, `CV`, `sex`, `picture`, `gender`) VALUES
(32, 'admin', 'admin', 'admin@admin.com', '5465df3fffbf173438e07cb62f00f131', '0202020201', '13022', 'Masilia', 'rue 9', '2021-10-30', '', 'fomme', '', NULL),
(31, NULL, NULL, 'f@f.f', 'ae40b9e007571ac254b39ef04cdf65db', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'test', 'test', 'test@test.test', NULL, '0102030405', NULL, NULL, NULL, NULL, 0x4d6f6e204356202833292e706466, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
