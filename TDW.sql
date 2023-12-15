-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3310
-- Généré le : ven. 15 déc. 2023 à 02:46
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tdw_project_model`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis_marques`
--

CREATE TABLE `avis_marques` (
  `ID_Avis` int(11) NOT NULL,
  `ID_Utilisateur` int(11) DEFAULT NULL,
  `ID_Marque` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis_véhicules`
--

CREATE TABLE `avis_véhicules` (
  `ID_Avis` int(11) NOT NULL,
  `ID_Utilisateur` int(11) DEFAULT NULL,
  `ID_Véhicule` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comparaisons`
--

CREATE TABLE `comparaisons` (
  `ID_Comparaison` int(11) NOT NULL,
  `ID_Utilisateur` int(11) DEFAULT NULL,
  `ID_Véhicule1` int(11) DEFAULT NULL,
  `ID_Véhicule2` int(11) DEFAULT NULL,
  `ID_Véhicule3` int(11) DEFAULT NULL,
  `ID_Véhicule4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `ID_Marque` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Pays_d_origine` varchar(50) DEFAULT NULL,
  `Siège_social` varchar(100) DEFAULT NULL,
  `Année_de_création` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `ID_News` int(11) NOT NULL,
  `Titre` varchar(100) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  `Texte` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `ID_Photo` int(11) NOT NULL,
  `ID_Véhicule` int(11) DEFAULT NULL,
  `Photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `spécifications`
--

CREATE TABLE `spécifications` (
  `ID_Spécification` int(11) NOT NULL,
  `Nom_Spécification` varchar(50) DEFAULT NULL,
  `ID_Type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `spécifications`
--

INSERT INTO `spécifications` (`ID_Spécification`, `Nom_Spécification`, `ID_Type`) VALUES
(1, 'Seating Capacity', 1),
(2, 'Fuel Efficiency (km/l)', 1),
(3, 'Cargo Space (liters)', 2),
(4, 'Acceleration (0-100 km/h)', 3),
(5, 'Horsepower', 3),
(6, 'Number of Doors', 4),
(7, 'Cargo Volume (liters)', 4),
(8, 'Top Speed (km/h)', 5),
(9, 'Fuel Tank Capacity (liters)', 5),
(10, 'Payload Capacity (kg)', 6),
(11, 'Towing Capacity (kg)', 6),
(12, 'Sliding Doors', 7);

-- --------------------------------------------------------

--
-- Structure de la table `types_véhicules`
--

CREATE TABLE `types_véhicules` (
  `ID_Type` int(11) NOT NULL,
  `Nom_Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types_véhicules`
--

INSERT INTO `types_véhicules` (`ID_Type`, `Nom_Type`) VALUES
(1, 'Sedan'),
(2, 'SUV'),
(3, 'Coupe'),
(4, 'Hatchback'),
(5, 'Convertible'),
(6, 'Truck'),
(7, 'Minivan');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID_Utilisateur` int(11) NOT NULL,
  `Nom` varchar(100) DEFAULT NULL,
  `Prénom` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Mot_de_passe` varchar(100) DEFAULT NULL,
  `Photo` varchar(100) DEFAULT NULL,
  `Type` enum('Utilisateur','Admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID_Utilisateur`, `Nom`, `Prénom`, `Email`, `Mot_de_passe`, `Photo`, `Type`) VALUES
(1, 'John', 'Doe', 'john.doe@email.com', 'password1', 'user1.jpg', 'Utilisateur'),
(2, 'Admin1', 'Admin', 'admin1@email.com', 'adminpass1', 'admin1.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `véhicules`
--

CREATE TABLE `véhicules` (
  `ID_Véhicule` int(11) NOT NULL,
  `ID_Type` int(11) DEFAULT NULL,
  `Marque` varchar(50) DEFAULT NULL,
  `Modèle` varchar(50) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL,
  `Année` year(4) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `véhicules`
--

INSERT INTO `véhicules` (`ID_Véhicule`, `ID_Type`, `Marque`, `Modèle`, `Version`, `Année`, `Prix`) VALUES
(1, 1, 'Toyota', 'Camry', 'LE', '2022', 25000.00),
(2, 1, 'Honda', 'Accord', 'Sport', '2022', 27000.00),
(3, 2, 'Honda', 'CR-V', 'EX', '2022', 32000.00),
(4, 2, 'Toyota', 'RAV4', 'XLE', '2022', 30000.00),
(5, 3, 'BMW', 'M4', 'Competition', '2022', 80000.00),
(6, 3, 'Mercedes-Benz', 'C-Class', 'AMG', '2022', 75000.00),
(7, 4, 'Volkswagen', 'Golf', 'GTI', '2022', 35000.00),
(8, 4, 'Ford', 'Focus', 'ST', '2022', 32000.00),
(9, 5, 'Ford', 'Mustang', 'GT Convertible', '2022', 55000.00),
(10, 6, 'Chevrolet', 'Silverado', '1500 LT', '2022', 38000.00),
(11, 7, 'Chrysler', 'Pacifica', 'Touring L', '2022', 35000.00);

-- --------------------------------------------------------

--
-- Structure de la table `véhicule_spécifications`
--

CREATE TABLE `véhicule_spécifications` (
  `ID_Véhicule` int(11) NOT NULL,
  `ID_Spécification` int(11) NOT NULL,
  `Valeur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `véhicule_spécifications`
--

INSERT INTO `véhicule_spécifications` (`ID_Véhicule`, `ID_Spécification`, `Valeur`) VALUES
(1, 1, '5'),
(1, 2, '15'),
(2, 1, '5'),
(2, 2, '14'),
(3, 3, '7'),
(3, 4, '600'),
(4, 3, '5'),
(4, 4, '580'),
(5, 5, '6.2'),
(5, 6, '450'),
(6, 5, '5.5'),
(6, 6, '400'),
(7, 7, '5'),
(7, 8, '380'),
(8, 7, '5'),
(8, 8, '350'),
(9, 9, '200'),
(9, 10, '60'),
(10, 11, '1000'),
(10, 12, '3500'),
(11, 12, '3500');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis_marques`
--
ALTER TABLE `avis_marques`
  ADD PRIMARY KEY (`ID_Avis`),
  ADD KEY `ID_Utilisateur` (`ID_Utilisateur`),
  ADD KEY `ID_Marque` (`ID_Marque`);

--
-- Index pour la table `avis_véhicules`
--
ALTER TABLE `avis_véhicules`
  ADD PRIMARY KEY (`ID_Avis`),
  ADD KEY `ID_Utilisateur` (`ID_Utilisateur`),
  ADD KEY `ID_Véhicule` (`ID_Véhicule`);

--
-- Index pour la table `comparaisons`
--
ALTER TABLE `comparaisons`
  ADD PRIMARY KEY (`ID_Comparaison`),
  ADD KEY `ID_Utilisateur` (`ID_Utilisateur`),
  ADD KEY `ID_Véhicule1` (`ID_Véhicule1`),
  ADD KEY `ID_Véhicule2` (`ID_Véhicule2`),
  ADD KEY `ID_Véhicule3` (`ID_Véhicule3`),
  ADD KEY `ID_Véhicule4` (`ID_Véhicule4`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`ID_Marque`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID_News`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`ID_Photo`),
  ADD KEY `ID_Véhicule` (`ID_Véhicule`);

--
-- Index pour la table `spécifications`
--
ALTER TABLE `spécifications`
  ADD PRIMARY KEY (`ID_Spécification`),
  ADD UNIQUE KEY `Nom_Spécification` (`Nom_Spécification`),
  ADD KEY `ID_Type` (`ID_Type`);

--
-- Index pour la table `types_véhicules`
--
ALTER TABLE `types_véhicules`
  ADD PRIMARY KEY (`ID_Type`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID_Utilisateur`);

--
-- Index pour la table `véhicules`
--
ALTER TABLE `véhicules`
  ADD PRIMARY KEY (`ID_Véhicule`),
  ADD KEY `ID_Type` (`ID_Type`);

--
-- Index pour la table `véhicule_spécifications`
--
ALTER TABLE `véhicule_spécifications`
  ADD PRIMARY KEY (`ID_Véhicule`,`ID_Spécification`),
  ADD KEY `ID_Spécification` (`ID_Spécification`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis_marques`
--
ALTER TABLE `avis_marques`
  MODIFY `ID_Avis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `avis_véhicules`
--
ALTER TABLE `avis_véhicules`
  MODIFY `ID_Avis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comparaisons`
--
ALTER TABLE `comparaisons`
  MODIFY `ID_Comparaison` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `ID_Marque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `ID_News` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `ID_Photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `spécifications`
--
ALTER TABLE `spécifications`
  MODIFY `ID_Spécification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `types_véhicules`
--
ALTER TABLE `types_véhicules`
  MODIFY `ID_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID_Utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `véhicules`
--
ALTER TABLE `véhicules`
  MODIFY `ID_Véhicule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_marques`
--
ALTER TABLE `avis_marques`
  ADD CONSTRAINT `avis_marques_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateurs` (`ID_Utilisateur`),
  ADD CONSTRAINT `avis_marques_ibfk_2` FOREIGN KEY (`ID_Marque`) REFERENCES `marques` (`ID_Marque`);

--
-- Contraintes pour la table `avis_véhicules`
--
ALTER TABLE `avis_véhicules`
  ADD CONSTRAINT `avis_véhicules_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateurs` (`ID_Utilisateur`),
  ADD CONSTRAINT `avis_véhicules_ibfk_2` FOREIGN KEY (`ID_Véhicule`) REFERENCES `véhicules` (`ID_Véhicule`);

--
-- Contraintes pour la table `comparaisons`
--
ALTER TABLE `comparaisons`
  ADD CONSTRAINT `comparaisons_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateurs` (`ID_Utilisateur`),
  ADD CONSTRAINT `comparaisons_ibfk_2` FOREIGN KEY (`ID_Véhicule1`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `comparaisons_ibfk_3` FOREIGN KEY (`ID_Véhicule2`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `comparaisons_ibfk_4` FOREIGN KEY (`ID_Véhicule3`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `comparaisons_ibfk_5` FOREIGN KEY (`ID_Véhicule4`) REFERENCES `véhicules` (`ID_Véhicule`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`ID_Véhicule`) REFERENCES `véhicules` (`ID_Véhicule`);

--
-- Contraintes pour la table `spécifications`
--
ALTER TABLE `spécifications`
  ADD CONSTRAINT `spécifications_ibfk_1` FOREIGN KEY (`ID_Type`) REFERENCES `types_véhicules` (`ID_Type`);

--
-- Contraintes pour la table `véhicules`
--
ALTER TABLE `véhicules`
  ADD CONSTRAINT `véhicules_ibfk_1` FOREIGN KEY (`ID_Type`) REFERENCES `types_véhicules` (`ID_Type`);

--
-- Contraintes pour la table `véhicule_spécifications`
--
ALTER TABLE `véhicule_spécifications`
  ADD CONSTRAINT `véhicule_spécifications_ibfk_1` FOREIGN KEY (`ID_Véhicule`) REFERENCES `véhicules` (`ID_Véhicule`),
  ADD CONSTRAINT `véhicule_spécifications_ibfk_2` FOREIGN KEY (`ID_Spécification`) REFERENCES `spécifications` (`ID_Spécification`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
