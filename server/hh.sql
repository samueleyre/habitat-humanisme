
-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 14 Août 2016 à 16:18
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `habitat`
--

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE `etablissements` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etablissements`
--

INSERT INTO `etablissements` ( `nom`, `code`) VALUES
('ECOLE LDLC', 'AAA1'),
('ECOLE SIMPLON', 'BBB1'),
('ARFRIPS', 'CCC1'),
('UCLY - DROIT', 'DDD1'),
('ASSOMPTION BELLEVUE', 'EEE1'),
('IUT TECH DE CO', 'FFF1'),
('LES CHASSAGNES', 'GGG1'),
('IMSI', 'HHH1'),
('BROSSOLETTE', 'III1'),
('IFMEM', 'JJJ1'),
('LYCEE JEAN PERRIN', 'KKK1'),
('ECE', 'MMM1'),
('ECL', 'NNN1'),
('BBA INSEEC', 'OOO1'),
('ETUDIANTS EEM', 'PPP1');

-- --------------------------------------------------------

--
-- Structure de la table `etabl_etudiants`
--

CREATE TABLE `etabl_etudiants` (
  `id_etablissement` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id_etudiant` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `school` varchar(100) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `code_activation` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `nom`, `prenom`, `school`, `mdp`, `mail`, `code_activation`, `active`) VALUES
(1, 'admin', 'admin', 'simplon69', 'admin', 'samuel.eyre@hotmail.fr', 'a99547829e6f012346f6cf351854565d', 1);


-- --------------------------------------------------------

--
-- Structure de la table `passants`
--

CREATE TABLE `passants` (
  `id_passant` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `idEtudiant` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `code_postal` int(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `sexe` varchar(60) NOT NULL,
  `actif` varchar(50) NOT NULL,
  `donnation` varchar(250) NOT NULL,
  `dons` decimal(3,1) NOT NULL,
  `connaitreHabitat` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------


--
-- Index pour les tables exportées
--
