-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 fév. 2024 à 15:11
-- Version du serveur : 11.4.0-MariaDB
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `infoclimat`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` mediumblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `titre` (`titre`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `titre`, `description`, `image`) VALUES
(1, 'Changement climatique', 'Qu\'est-ce que le changement climatique ?', ''),
(2, 'Effet de serre', 'Quel gaz est principalement responsable de l\'effet de serre ?', ''),
(3, 'Émissions de CO2', 'Quelle activité humaine contribue le plus aux émissions de dioxyde de carbone ?', ''),
(4, 'Séquestration du carbone', 'Qu\'est-ce que la séquestration du carbone ?', ''),
(5, 'Empreinte carbone', 'Qu\'est-ce que l\'empreinte carbone ?', ''),
(6, 'Énergies renouvelables', 'Quelle est la principale source d\'énergie renouvelable dans le monde ?', ''),
(7, 'Absorption de chaleur', 'Quel océan absorbe le plus de chaleur due au changement climatique ?', ''),
(8, 'Rôle des forêts', 'Quel est le rôle des forêts dans la régulation du climat ?', ''),
(9, 'Effet albedo', 'Qu\'est-ce que l\'effet albedo ?', ''),
(10, 'Fonte des glaciers', 'Quelle est la principale cause de la fonte des glaciers ?', ''),
(11, 'COP26', 'Qu\'est-ce que la COP26 ?', ''),
(12, 'Accord de Paris', 'Quel est l\'objectif principal de l\'accord de Paris sur le climat ?', ''),
(13, 'Météo vs Climat', 'Quelle est la différence entre météo et climat ?', ''),
(14, 'Réfrigérants', 'Quel est le principal gaz à effet de serre présent dans les réfrigérants ?', ''),
(15, 'Neutralité carbone', 'Qu\'est-ce que la neutralité carbone ?', ''),
(16, 'Montée du niveau de la mer', 'Quelle est la principale cause de la montée du niveau de la mer ?', ''),
(17, 'Acidification des océans', 'Qu\'est-ce que l\'acidification des océans ?', ''),
(18, 'Méthane', 'Quelle est la principale source d\'émissions de méthane d\'origine humaine ?', ''),
(19, 'Désertification', 'Qu\'est-ce que la désertification ?', ''),
(20, 'El Niño', 'Quelle est la conséquence du phénomène El Niño sur le climat mondial ?', ''),
(21, 'Ozone stratosphérique', 'Quelle est la principale cause de la diminution de l\'ozone stratosphérique ?', ''),
(22, 'Émissions de gaz à effet de serre', 'Quel secteur est généralement responsable de la plus grande part des émissions de gaz à effet de serre ?', ''),
(23, 'Électrification des transports', 'Quel est l\'avantage environnemental de l\'électrification des transports ?', ''),
(24, 'Puits de carbone', 'Qu\'est-ce qu\'un puits de carbone ?', ''),
(25, 'Développement durable', 'Quel est l\'objectif du développement durable en relation avec le climat ?', ''),
(26, 'Équilibre radiatif', 'Que signifie l\'équilibre radiatif de la Terre ?', ''),
(27, 'Énergies renouvelables', 'Quelle énergie renouvelable est produite par la conversion de la chaleur naturelle de la Terre ?', ''),
(28, 'Émissions de dioxyde de soufre', 'Quel processus naturel peut libérer du dioxyde de soufre dans l\'atmosphère ?', ''),
(29, 'Érosion côtière', 'Quel est le facteur humain qui contribue le plus à l\'érosion côtière ?', ''),
(30, 'Agriculture biologique', 'Quel est l\'avantage environnemental de l\'agriculture biologique par rapport à l\'agriculture conventionnelle ?', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
