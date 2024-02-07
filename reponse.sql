-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 fév. 2024 à 15:12
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
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `texte` varchar(100) NOT NULL,
  `estcorrect` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `id_question`, `texte`, `estcorrect`) VALUES
(1, 1, 'Variation quotidienne de la météo', 0),
(2, 1, 'Changements à long terme dans les conditions météorologiques', 1),
(3, 1, 'Phénomène lié aux cycles lunaires', 0),
(4, 2, 'Azote', 0),
(5, 2, 'Dioxyde de carbone (CO2)', 1),
(6, 2, 'Oxygène', 0),
(7, 3, 'Agriculture', 0),
(8, 3, 'Transport', 1),
(9, 3, 'Production d\'électricité', 0),
(10, 4, 'Libération de carbone dans l\'atmosphère', 0),
(11, 4, 'Stockage du carbone pour l\'empêcher d\'atteindre l\'atmosphère', 1),
(12, 4, 'Transformation du carbone en énergie', 0),
(13, 5, 'La marque laissée par les émissions de carbone', 0),
(14, 5, 'La quantité totale de gaz à effet de serre émis par une personne, une entreprise ou un pays', 1),
(15, 5, 'La trace laissée par les glaciers en recul', 0),
(16, 6, 'Énergie solaire', 1),
(17, 6, 'Énergie éolienne', 0),
(18, 6, 'Biomasse', 0),
(19, 7, 'Pacifique', 1),
(20, 7, 'Atlantique', 0),
(21, 7, 'Indien', 0),
(22, 8, 'Elles libèrent du dioxyde de carbone', 0),
(23, 8, 'Elles absorbent le dioxyde de carbone', 1),
(24, 8, 'Elles n\'ont aucun impact sur le climat', 0),
(25, 9, 'Capacité d\'un matériau à absorber la chaleur', 0),
(26, 9, 'Capacité d\'un matériau à réfléchir la lumière', 1),
(27, 9, 'Capacité d\'un matériau à produire de l\'électricité', 0),
(28, 10, 'Activité volcanique', 0),
(29, 10, 'Augmentation des températures mondiales', 1),
(30, 10, 'Érosion naturelle', 0),
(31, 11, 'Conférence sur la protection des océans', 0),
(32, 11, 'Conférence sur le changement climatique', 1),
(33, 11, 'Conférence sur la biodiversité', 0),
(34, 12, 'Réduire les émissions de gaz à effet de serre', 1),
(35, 12, 'Promouvoir le tourisme durable', 0),
(36, 12, 'Protéger les forêts tropicales', 0),
(37, 13, 'La météo concerne les conditions à court terme, le climat à long terme', 1),
(38, 13, 'La météo concerne les températures élevées, le climat les températures basses', 0),
(39, 13, 'La météo concerne les phénomènes naturels, le climat les activités humaines', 0),
(40, 14, 'Methane (CH4)', 0),
(41, 14, 'Protoxyde d\'azote (N2O)', 0),
(42, 14, 'Hydrofluorocarbures (HFC)', 1),
(43, 15, 'Aucune émission de carbone', 0),
(44, 15, 'Compenser les émissions par des réductions équivalentes', 1),
(45, 15, 'Augmentation des émissions pour atteindre un équilibre', 0),
(46, 16, 'Fonte des glaciers', 0),
(47, 16, 'Expansion thermique de l\'eau', 1),
(48, 16, 'Évaporation accrue', 0),
(49, 17, 'Augmentation du pH de l\'eau de mer', 0),
(50, 17, 'Diminution du pH de l\'eau de mer', 1),
(51, 17, 'Aucun changement dans le pH de l\'eau de mer', 0),
(52, 18, 'Activité volcanique', 0),
(53, 18, 'Augmentation des températures mondiales', 1),
(54, 18, 'Érosion naturelle', 0),
(55, 19, 'Capacité d\'un matériau à absorber la chaleur', 0),
(56, 19, 'Capacité d\'un matériau à réfléchir la lumière', 1),
(57, 19, 'Capacité d\'un matériau à produire de l\'électricité', 0),
(58, 20, 'Activité humaine', 1),
(59, 20, 'Variations naturelles du climat', 0),
(60, 20, 'Changement dans l\'orbite terrestre', 0),
(61, 21, 'Chine', 0),
(62, 21, 'États-Unis', 0),
(63, 21, 'Qatar', 1),
(64, 22, 'Sol gelé en permanence', 1),
(65, 22, 'Sol riche en nutriments', 0),
(66, 22, 'Sol volcanique', 0),
(67, 23, 'Environ 25%', 1),
(68, 23, 'Environ 50%', 0),
(69, 23, 'Environ 75%', 0),
(70, 24, 'Renforcement des politiques environnementales', 0),
(71, 24, 'Augmentation des concentrations de gaz à effet de serre', 1),
(72, 24, 'Diminution des émissions industrielles', 0),
(73, 25, 'Imitation de modèles biologiques pour résoudre des problèmes climatiques', 1),
(74, 25, 'Utilisation de biomasse comme source d\'énergie', 0),
(75, 25, 'Protection des écosystèmes biologiques contre le changement climatique', 0),
(76, 26, 'Réduire la consommation de carburant', 0),
(77, 26, 'Sensibiliser aux émissions de carbone liées au transport', 1),
(78, 26, 'Promouvoir l\'utilisation de véhicules électriques', 0),
(79, 27, 'La déforestation réduit les émissions de gaz à effet de serre', 0),
(80, 27, 'La déforestation contribue aux émissions de gaz à effet de serre', 1),
(81, 27, 'La déforestation n\'a aucun impact sur le climat', 0),
(82, 28, 'Industrie chimique', 0),
(83, 28, 'Agriculture', 1),
(84, 28, 'Déchets municipaux', 0),
(85, 29, 'Réduction des émissions de gaz à effet de serre', 0),
(86, 29, 'Modification des infrastructures pour faire face aux impacts climatiques', 1),
(87, 29, 'Ignorer les changements climatiques', 0),
(88, 30, 'Augmentation de la diversité des espèces', 0),
(89, 30, 'Diminution des populations d\'espèces', 1),
(90, 30, 'Aucun impact sur la biodiversité', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
