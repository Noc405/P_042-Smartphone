-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 03 mai 2022 à 12:40
-- Version du serveur :  5.7.11
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_smartphones`
--
DROP DATABASE IF EXISTS `db_smartphones`;
CREATE DATABASE `db_smartphones`;
USE `db_smartphones`;
-- --------------------------------------------------------

--
-- Structure de la table `t_cart`
--

CREATE TABLE `t_cart` (
  `idCart` int(11) NOT NULL,
  `carQuantity` int(11) NOT NULL,
  `fkProduct` int(11) NOT NULL,
  `fkClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_cart`
--

INSERT INTO `t_cart` (`idCart`, `carQuantity`, `fkProduct`, `fkClient`) VALUES
(1, 1, 2, 2),
(2, 1, 2, 2),
(3, 1, 1, 2),
(4, 1, 4, 2),
(5, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_constructor`
--

CREATE TABLE `t_constructor` (
  `idConstructor` int(11) NOT NULL,
  `conName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_constructor`
--

INSERT INTO `t_constructor` (`idConstructor`, `conName`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Microsoft');

-- --------------------------------------------------------

--
-- Structure de la table `t_products`
--

CREATE TABLE `t_products` (
  `idProducts` int(11) NOT NULL,
  `proRef` int(11) DEFAULT NULL,
  `proOS` varchar(50) NOT NULL,
  `proOSVersion` float NOT NULL,
  `proName` varchar(50) NOT NULL,
  `proCategory` varchar(50) NOT NULL,
  `proPrice` float NOT NULL,
  `proDescription` text NOT NULL,
  `proAutonomy` int(3) NOT NULL,
  `proFrequence` float NOT NULL,
  `proNbHearts` int(2) NOT NULL,
  `proRam` int(3) NOT NULL,
  `proImg` text NOT NULL,
  `proSize` float NOT NULL,
  `fkConstructor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_products`
--

INSERT INTO `t_products` (`idProducts`, `proRef`, `proOS`, `proOSVersion`, `proName`, `proCategory`, `proPrice`, `proDescription`, `proAutonomy`, `proFrequence`, `proNbHearts`, `proRam`, `proImg`, `proSize`, `fkConstructor`) VALUES
(1, NULL, 'iOS', 15, 'I Phone', '12 Pro', 1016, 'Smartphone de marque apple', 2, 3.1, 6, 6, 'iPhone12Pro.png', 6.1, 1),
(2, NULL, 'Android', 10, 'Samsung', 'S20 5G', 449, 'Telephone samsung gris', 2, 2.73, 8, 12, 'samsungS20.png', 6.2, 2),
(3, NULL, 'Windows Phone', 10, 'Microsoft', 'Lumia 650', 155, 'Petit téléphone microsoft', 4, 1.3, 4, 1, 'microsoftLumia.png', 5, 3),
(4, NULL, 'Windows Phone', 10, 'Microsoft', 'Lumia 650', 255, 'Petit téléphone microsoft', 4, 1.3, 4, 1, 'microsoftLumia.png', 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE `t_users` (
  `idUser` int(11) NOT NULL,
  `useEmail` text NOT NULL,
  `usePassword` text NOT NULL,
  `useUsername` text NOT NULL,
  `useCreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `useAge` int(3) NOT NULL,
  `useAdministrator` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_users`
--

INSERT INTO `t_users` (`idUser`, `useEmail`, `usePassword`, `useUsername`, `useCreationDate`, `useAge`, `useAdministrator`) VALUES
(1, 'emilien.charpie@gmail.com', '$2y$10$lzNDi7PrsA15SDfWJnULw.OtFGrbXKZkBUAxee8WMjlsiOMyI/bwu', 'emilien_chrp', '2022-03-29 21:15:19', 17, 0),
(2, 'test@test.com', '$2y$10$DUfO0jUcTmgdhSlkDFZjqu67TwE2MAlH6VYQp24vi2YQZt2NSe3DS', 'testUser', '2022-03-30 08:18:39', 12, 0),
(4, 'testa@test.com', '$2y$10$1mewN.SUNgjMlSwyPdb45.ScKkWrfOwxZFAZaDzI8glbI.DFoRPua', 'testAdmin', '2022-03-30 08:27:56', 12, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_cart`
--
ALTER TABLE `t_cart`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `fkClient` (`fkClient`),
  ADD KEY `fkProduct` (`fkProduct`);

--
-- Index pour la table `t_constructor`
--
ALTER TABLE `t_constructor`
  ADD PRIMARY KEY (`idConstructor`);

--
-- Index pour la table `t_products`
--
ALTER TABLE `t_products`
  ADD PRIMARY KEY (`idProducts`),
  ADD KEY `fkConstructor` (`fkConstructor`);

--
-- Index pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_cart`
--
ALTER TABLE `t_cart`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_constructor`
--
ALTER TABLE `t_constructor`
  MODIFY `idConstructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_products`
--
ALTER TABLE `t_products`
  MODIFY `idProducts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_cart`
--
ALTER TABLE `t_cart`
  ADD CONSTRAINT `fkClient` FOREIGN KEY (`fkClient`) REFERENCES `t_users` (`idUser`),
  ADD CONSTRAINT `fkProduct` FOREIGN KEY (`fkProduct`) REFERENCES `t_products` (`idProducts`);

--
-- Contraintes pour la table `t_products`
--
ALTER TABLE `t_products`
  ADD CONSTRAINT `fkConstructor` FOREIGN KEY (`fkConstructor`) REFERENCES `t_constructor` (`idConstructor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
