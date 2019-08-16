-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 04 juil. 2019 à 11:46
-- Version du serveur :  5.6.38-1~dotdeb+7.1
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `w1vy57_phpmanon`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `Id` int(7) NOT NULL,
  `title` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `dateArticle` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='article';

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`Id`, `title`, `text`, `dateArticle`) VALUES
(2, 'test', 'test', '2019-06-16'),
(4, 'test police', '&lt;p style=&quot;text-align: center;&quot;&gt;test &lt;strong&gt;test &lt;/strong&gt;&lt;em&gt;test&lt;/em&gt;&lt;/p&gt;', '2019-06-04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
