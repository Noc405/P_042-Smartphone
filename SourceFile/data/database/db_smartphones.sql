-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 27 mai 2022 à 16:35
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
(3, 'ColorOS');

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
(5, NULL, 'Android', 12, 'samsung', 'S22 ultra', 1499, 'La srie Galaxy S22 marque le dbut de l\'re de la photographie nocturne : Avec des couleurs authentiques et vives, la nuit est claire comme jamais auparavant - pour des rsultats piques dans toutes les situations d\'clairage. Le premier processeur 4 nm au monde assure en outre des performances maximales avec une longue dure de vie de la batterie. Le Galaxy S22 Series dispose de l\'cran le plus lumineux jamais intgr A? un appareil Galaxy, pour que tu puisses tout voir clairement et dans les moindres dtails, mme en plein soleil. Le Galaxy S22 intgre le S Pen rapide pour favoriser au maximum la productivit, le multitche et la crativit. quip d\'un cadre en aluminium solide et du verre le plus dur, le Galaxy S22 fait preuve d\'une rsistance extrmement leve. La srie Galaxy S22 est dote de capteurs de camra plus grands et plus sensibles et de la technologie de pixels adaptatifs qui apporte de la lumire dans l\'obscurit de la nuit. Ainsi, mme les plus petits dtails peuvent tre capturs avec une qualit maximale dans toutes les situations d\'clairage. Grce au HDR 12 bits, les prises de vue sont rsolues avec des couleurs et des contrastes 64 fois plus vifs. Grce au processeur puissant, jusqu\'A? 20 images sont analyses en l\'espace de quelques millisecondes - pour des photos et des vidos encore plus nettes et dtailles.', 3, 3, 8, 12, 'SamsungS22Ultra.jpg', 6, 2),
(6, NULL, 'iOS', 13, 'iphone ', '11 Pro max', 1349, 'Tout nouveau triple appareil photo. Autonomie dune journe. La plus rapide de toutes les puces de smartphone. Et un cran Super Retina XDR de 6,5 pouces, lcran le plus grand et le plus lumineux jamais vu sur iPhone. Prenez de superbes photos et vidos avec lultra grand-angle, le grand-angle et le tlobjectif. Tous vos clichs nocturnes sont russis avec le mode Nuit. Dcouvrez (et admirez) vos sries et films HDR sur lcran Super Retina XDR de 6,5 pouces, lcran le plus lumineux jamais vu sur iPhone. Profitez, avec la puce A13 Bionic, de performances sans prcdent pour les jeux, la ralit augmente (AR) et la photographie. Bnficiez dune autonomie dune journe1 et dune rsistance A? leau accrue. Les capacits de cet iPhone sont telles quil est le premier A? dcrocher lappellation Pro. Et il la mrite.', 3, 3, 8, 4, 'Iphone11ProMax.jpg', 6, 1),
(7, NULL, 'iOS', 14, 'iphone ', '12', 700, 'Tout nouveau triple appareil photo. Autonomie dune journe. La plus rapide de toutes les puces de smartphone. Et un cran Super Retina XDR de 6,5 pouces, lcran le plus grand et le plus lumineux jamais vu sur iPhone. Prenez de superbes photos et vidos avec lultra grand-angle, le grand-angle et le tlobjectif. Tous vos clichs nocturnes sont russis avec le mode Nuit. Dcouvrez (et admirez) vos sries et films HDR sur lcran Super Retina XDR de 6,5 pouces, lcran le plus lumineux jamais vu sur iPhone. Profitez, avec la puce A13 Bionic, de performances sans prcdent pour les jeux, la ralit augmente (AR) et la photographie. Bnficiez dune autonomie dune journe1 et dune rsistance A? leau accrue. Les capacits de cet iPhone sont telles quil est le premier A? dcrocher lappellation Pro. Et il la mrite.', 3, 3, 8, 4, 'Iphone12.jpg', 6, 1),
(8, NULL, 'iOS', 14, 'iphone ', '12 Pro max', 700, 'Tout nouveau triple appareil photo. Autonomie dune journe. La plus rapide de toutes les puces de smartphone. Et un cran Super Retina XDR de 6,5 pouces, lcran le plus grand et le plus lumineux jamais vu sur iPhone. Prenez de superbes photos et vidos avec lultra grand-angle, le grand-angle et le tlobjectif. Tous vos clichs nocturnes sont russis avec le mode Nuit. Dcouvrez (et admirez) vos sries et films HDR sur lcran Super Retina XDR de 6,5 pouces, lcran le plus lumineux jamais vu sur iPhone. Profitez, avec la puce A13 Bionic, de performances sans prcdent pour les jeux, la ralit augmente (AR) et la photographie. Bnficiez dune autonomie dune journe1 et dune rsistance A? leau accrue. Les capacits de cet iPhone sont telles quil est le premier A? dcrocher lappellation Pro. Et il la mrite.', 3, 3, 8, 4, 'Iphone12ProMax.jpg', 6, 1),
(9, NULL, 'iOS', 14, 'iphone ', '11 Pro', 700, 'Tout nouveau triple appareil photo. Autonomie dune journe. La plus rapide de toutes les puces de smartphone. Et un cran Super Retina XDR de 6,5 pouces, lcran le plus grand et le plus lumineux jamais vu sur iPhone. Prenez de superbes photos et vidos avec lultra grand-angle, le grand-angle et le tlobjectif. Tous vos clichs nocturnes sont russis avec le mode Nuit. Dcouvrez (et admirez) vos sries et films HDR sur lcran Super Retina XDR de 6,5 pouces, lcran le plus lumineux jamais vu sur iPhone. Profitez, avec la puce A13 Bionic, de performances sans prcdent pour les jeux, la ralit augmente (AR) et la photographie. Bnficiez dune autonomie dune journe1 et dune rsistance A? leau accrue. Les capacits de cet iPhone sont telles quil est le premier A? dcrocher lappellation Pro. Et il la mrite.', 3, 3, 8, 4, 'Iphone11Pro.jpg', 6, 1),
(10, NULL, 'Android', 12, 'samsung', 'Galaxy Z Fold3 5G UE', 1520, 'La srie Galaxy S22 marque le dbut de l\'re de la photographie nocturne : Avec des couleurs authentiques et vives, la nuit est claire comme jamais auparavant - pour des rsultats piques dans toutes les situations d\'clairage. Le premier processeur 4 nm au monde assure en outre des performances maximales avec une longue dure de vie de la batterie. Le Galaxy S22 Series dispose de l\'cran le plus lumineux jamais intgr A? un appareil Galaxy, pour que tu puisses tout voir clairement et dans les moindres dtails, mme en plein soleil. Le Galaxy S22 intgre le S Pen rapide pour favoriser au maximum la productivit, le multitche et la crativit. quip d\'un cadre en aluminium solide et du verre le plus dur, le Galaxy S22 fait preuve d\'une rsistance extrmement leve. La srie Galaxy S22 est dote de capteurs de camra plus grands et plus sensibles et de la technologie de pixels adaptatifs qui apporte de la lumire dans l\'obscurit de la nuit. Ainsi, mme les plus petits dtails peuvent tre capturs avec une qualit maximale dans toutes les situations d\'clairage. Grce au HDR 12 bits, les prises de vue sont rsolues avec des couleurs et des contrastes 64 fois plus vifs. Grce au processeur puissant, jusqu\'A? 20 images sont analyses en l\'espace de quelques millisecondes - pour des photos et des vidos encore plus nettes et dtailles.', 3, 3, 8, 12, 'SamsungZFold3.jpg', 6, 2),
(16, NULL, 'Android', 11, 'Fairphone', '4', 611, 'Diagonale d\'cran : 6.3 , Systme d\'exploitation : Android, Couleur du dtail : Vert, Capacit de stockage totale : 256 Go, Mmoire vive intgre : 8 Go, Chargement par induction : Non.', 5, 3, 8, 8, 'FairPhone4.jpg', 6, 2),
(17, NULL, 'Android', 12, 'samsung', 'Galaxy Z Flip3 5G UE', 1520, 'La srie Galaxy S22 marque le dbut de l\'re de la photographie nocturne : Avec des couleurs authentiques et vives, la nuit est claire comme jamais auparavant - pour des rsultats piques dans toutes les situations d\'clairage. Le premier processeur 4 nm au monde assure en outre des performances maximales avec une longue dure de vie de la batterie. Le Galaxy S22 Series dispose de l\'cran le plus lumineux jamais intgr A? un appareil Galaxy, pour que tu puisses tout voir clairement et dans les moindres dtails, mme en plein soleil. Le Galaxy S22 intgre le S Pen rapide pour favoriser au maximum la productivit, le multitche et la crativit. quip d\'un cadre en aluminium solide et du verre le plus dur, le Galaxy S22 fait preuve d\'une rsistance extrmement leve. La srie Galaxy S22 est dote de capteurs de camra plus grands et plus sensibles et de la technologie de pixels adaptatifs qui apporte de la lumire dans l\'obscurit de la nuit. Ainsi, mme les plus petits dtails peuvent tre capturs avec une qualit maximale dans toutes les situations d\'clairage. Grce au HDR 12 bits, les prises de vue sont rsolues avec des couleurs et des contrastes 64 fois plus vifs. Grce au processeur puissant, jusqu\'A? 20 images sont analyses en l\'espace de quelques millisecondes - pour des photos et des vidos encore plus nettes et dtailles.', 3, 3, 8, 12, 'SamsungZFold3.jpg', 6, 2),
(18, NULL, 'Android', 12, 'OnePlus', '10 Pro', 919, 'Diagonale d\'cran : 6.7 , Systme d\'exploitation : Android, Couleur du dtail : Noir, Capacit de stockage totale : 256 Go, Mmoire vive intgre : 12 Go, Chargement par induction : Oui.', 3, 3, 8, 12, 'OnePlus10Pro.jpg', 6, 3),
(19, NULL, 'Android', 11, 'XIAOMI', '11T', 1500, 'Le Xiaomi 11T est une nouvelle tape dans l\'histoire de la technologie des appareils photo de Xiaomi. quip d\'un appareil photo grand angle de 108 Mpx, d\'un tlmacro 2x et d\'un ultra grand angle de 120A?, vous pouvez capturer des clips rapides et des vidos cinmatiques dans le creux de votre main. Le Super Pixel 9-en-1 est soutenu par un traitement d\'image puissant. Avec la photographie par calcul AI et le cinma AI en un clic, le Xiaomi 11T est parfaitement quip pour capturer des photos ou des vidos poustouflantes en dplacement. Le zoom audio ajoute une dimension optimale A? vos vidos, vous permettant de zoomer sur les objets et de profiter d\'une exprience d\'coute immersive. Le Xiaomi 11T est dot d\'un cran plat flexible avec TrueColor, permettant aux utilisateurs de redcouvrir la magie du cinma sur leur smartphone. Grce A? sa luminosit de pointe de 1000 nits, votre contenu est toujours clair. Un appareil haut de gamme qui rpond A? tous vos besoins en matire de films et de mdias, le Xiaomi 11T est construit sur la plus puissante plateforme mobile Mediatek Dimensity 1200-Ultra 6nm qui permet une double veille 5G et offre une combinaison d\'un CPU 3.0GHz conome en nergie qui figure parmi les chipsets phares les plus parfaits du march actuel.', 2, 3, 8, 8, 'xiaomi11t.jpg', 6, 3),
(20, NULL, 'Android', 12, 'LG', 'Velvet', 450, 'Design pur et minimaliste : en deux couleurs luxueuses qui scintillent pour crer l\'illusion du velours.A?Le LG Velvet a un verre incurv A? l\'avant et A? l\'arrire qui s\'adapte parfaitement A? votre main.A?Disponible dans les couleurs : Aurora White et Aurora Grey.', 2, 3, 8, 8, 'lgvelvet.jpg', 6, 3),
(21, NULL, 'Android', 12, 'LG', 'Velours', 450, 'Design pur et minimaliste : en deux couleurs luxueuses qui scintillent pour crer l\'illusion du velours.A?Le LG Velvet a un verre incurv A? l\'avant et A? l\'arrire qui s\'adapte parfaitement A? votre main.A?Disponible dans les couleurs : Aurora White et Aurora Grey.', 2, 3, 8, 8, 'lgvelours.jpg', 6, 3),
(22, NULL, 'Android', 11, 'XIAOMI', '11T Pro', 486, 'Le Xiaomi 11T Pro s\'appuie sur l\'impressionnante gamme de technologies photographiques innovantes de Xiaomi. Avec une configuration A? trois camras comprenant un grand angle de 108 Mpx, un tlmacro 2x et un ultra grand angle de 120A?, le Xiaomi 11T Pro apporte des paysages cinmatographiques dans la paume de votre main. Combin A? de solides capacits de calcul de l\'IA, A? l\'enregistrement 4K HDR10+, A? plus d\'un milliard de couleurs qui permettent au Xiaomi 11T Pro d\'optimiser la luminosit, la couleur et le contraste image par image, tout le monde peut capturer des clichs qui merveilleront ses amis et ses adeptes des mdias sociaux. Le zoom audio complte la bote A? outils de cration de contenu, en vous permettant de zoomer sur des objets A? la fois visuellement et auditivement. Le mode nuit avanc transforme le smartphone en un outil cratif de jour comme de nuit.', 2, 3, 8, 8, 'xiaomi11tPro.jpg', 6, 3),
(23, NULL, 'Android', 11, 'XIAOMI', 'MI 11 Ultra', 1399, 'Brisez le schma. Laissez l\'imagination vous guider. Trois grands capteurs, trois camras principales, une mise au point parfaite la nuit et lors du tournage de vidos 8K. Dans l\'obscurit, mme les images aux dtails complexes sont reproduites avec des couleurs prcises qui refltent parfaitement la ralit. Dans des conditions de trs faible luminosit, il est presque impossible pour l\'ÅA??il nu de percevoir clairement ce qui l\'entoure, mais avec les Ultra Night Photos dveloppes en interne par Xiaomi, vous pouvez voir le monde tel qu\'il est grce A? la fusion multi-image de l\'IA. Le capteur GN2 de trs grande taille effectue une mise au point prcise en un instant, mme dans des environnements sombres et complexes. Pour la premire fois, Xiaomi a introduit un systme de mise au point A? 64 points avec un champ de vision plus large qui offre une plus grande plage de mise au point. Profitez d\'une mise au point prcise des sujets loigns et en mouvement. Avec Action Capture, l\'appareil photo ajuste la valeur d\'exposition en temps rel. La fonction intelligente suit automatiquement les personnes et les animaux, ce qui permet de rester concentr sur ce que vous voulez. Grce A? la double fusion ISO native, les prises de vue bruyantes en basse lumire font partie du pass. Le HDR progressif A? une seule prise au niveau du processeur capture la gamme de tons de la scne en une seule image et vite les problmes de mouvement tels que les images fantA?mes ou le flou de mouvement.', 3, 3, 8, 12, 'xiaomiMi11UltraPro.jpg', 6, 3);

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
(1, 'emilien.charpie@gmail.com', '$2y$10$lzNDi7PrsA15SDfWJnULw.OtFGrbXKZkBUAxee8WMjlsiOMyI/bwu', 'emilien_chrp', '2022-03-29 21:15:19', 17, 1),
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
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_constructor`
--
ALTER TABLE `t_constructor`
  MODIFY `idConstructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_products`
--
ALTER TABLE `t_products`
  MODIFY `idProducts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
