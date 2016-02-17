/* testé sous mysql 5.x */
-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Février 2016 à 09:40
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.9

--
-- Base de données :  `tintam`
--

-- --------------------------------------------------------

--
-- Structure de la table `correspond`
--

CREATE TABLE IF NOT EXISTS `correspond` (
  `NUM_RESA` int(11) NOT NULL,
  `CODE_SAISON` varchar(3) NOT NULL,
  PRIMARY KEY (`NUM_RESA`,`CODE_SAISON`),
  KEY `FK_CORRESPOND2` (`CODE_SAISON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE IF NOT EXISTS `equipement` (
  `CODE_EQUI` varchar(3) NOT NULL,
  `LIBELLE_EQUI` varchar(50) DEFAULT NULL,
  `DESCRIPTION_EQUI` text,
  `PRIX_EQUI` decimal(10,0) DEFAULT NULL,
  `COMM_EQUI` text,
  PRIMARY KEY (`CODE_EQUI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `CODE_FAC` varchar(5) NOT NULL,
  `NUM_RESA` int(11) DEFAULT NULL,
  `DATE_FAC` date DEFAULT NULL,
  `MONTANT_FAC` decimal(10,0) DEFAULT NULL,
  `EDD` decimal(10,0) DEFAULT NULL,
  `SOLDE_FAC` decimal(10,0) DEFAULT NULL,
  `UNITE_PAIEMENT_FAC` varchar(20) DEFAULT NULL,
  `COMM_FAC` text,
  PRIMARY KEY (`CODE_FAC`),
  KEY `FK_REFERENCE_9` (`NUM_RESA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `forfait`
--

CREATE TABLE IF NOT EXISTS `forfait` (
  `CODE_FOR` varchar(2) NOT NULL,
  `LIBELLE_FOR` varchar(50) DEFAULT NULL,
  `DESCRIPTION_FOR` text,
  `TARIF_FOR` decimal(10,0) DEFAULT NULL,
  `COMM_FOR` text,
  PRIMARY KEY (`CODE_FOR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `locataire`
--

CREATE TABLE IF NOT EXISTS `locataire` (
  `NUM_LOC` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_LOC` varchar(50) DEFAULT NULL,
  `PRENOM_LOC` varchar(50) DEFAULT NULL,
  `RUE_LOC` varchar(50) DEFAULT NULL,
  `VILLE_LOC` varchar(50) DEFAULT NULL,
  `CP_LOC` varchar(10) DEFAULT NULL,
  `PAYS_LOC` varchar(50) DEFAULT NULL,
  `TEL_LOC` varchar(20) DEFAULT NULL,
  `EMAIL_LOC` varchar(50) DEFAULT NULL,
  `COMM_LOC` text,
  PRIMARY KEY (`NUM_LOC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE IF NOT EXISTS `possede` (
  `CODE_EQUI` varchar(3) NOT NULL,
  `NUM_VILLA` int(11) NOT NULL,
  `ETAT_EQUI` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODE_EQUI`,`NUM_VILLA`),
  KEY `FK_POSSEDE2` (`NUM_VILLA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `NUM_RESA` int(11) NOT NULL,
  `NUM_VILLA` int(11) DEFAULT NULL,
  `NUM_LOC` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_FOR` varchar(2) NOT NULL,
  `DATE_ARRIVEE` date DEFAULT NULL,
  `DATE_DEPART` date DEFAULT NULL,
  `NB_NUITS_RESA` int(11) DEFAULT NULL,
  `NB_SEMAINE_RESA` int(11) DEFAULT NULL,
  `NB_MOIS_RESA` int(11) DEFAULT NULL,
  `NB_ADULTE_RESA` int(11) DEFAULT NULL,
  `NB_ENFANT_RESA` int(11) DEFAULT NULL,
  `ETAT_RESA` varchar(20) DEFAULT NULL,
  `DATE_RESA` date DEFAULT NULL,
  `MONTANT_RESA` decimal(10,0) DEFAULT NULL,
  `MONTANT_ANIMAUX_RESA` decimal(10,0) DEFAULT NULL,
  `COMM_RESA` text,
  PRIMARY KEY (`NUM_RESA`),
  KEY `FK_AFFECTE` (`CODE_FOR`),
  KEY `FK_CORRESPOND_A` (`NUM_VILLA`),
  KEY `FK_EFFECTUE` (`NUM_LOC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE IF NOT EXISTS `saison` (
  `CODE_SAISON` varchar(3) NOT NULL,
  `LIBELLE_SAISON` varchar(20) DEFAULT NULL,
  `DATE_DEBUT` date DEFAULT NULL,
  `DATE_FIN` date DEFAULT NULL,
  `TARIF_SEMAINE` decimal(10,0) DEFAULT NULL,
  `TARIF_MOIS` decimal(10,0) DEFAULT NULL,
  `COMM_SAISON` text,
  PRIMARY KEY (`CODE_SAISON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_villa`
--

CREATE TABLE IF NOT EXISTS `type_villa` (
  `CODE_TYVILLA` varchar(2) NOT NULL,
  `LIBELLE_TYVILLA` varchar(30) DEFAULT NULL,
  `NB_COUCHAGE` int(11) DEFAULT NULL,
  `COMM_TYVILLA` text,
  PRIMARY KEY (`CODE_TYVILLA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_UTILISATEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_UTILISATEUR` varchar(100) NOT NULL,
  `PRENOM_UTILISATEUR` varchar(100) NOT NULL,
  `LOGIN_UTILISATEUR` varchar(50) NOT NULL,
  `PWD_UTILISATEUR` varchar(200) NOT NULL,
  `SALT` varchar(23) NOT NULL,
  `ROLE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_UTILISATEUR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_UTILISATEUR`, `NOM_UTILISATEUR`, `PRENOM_UTILISATEUR`, `LOGIN_UTILISATEUR`, `PWD_UTILISATEUR`, `SALT`, `ROLE`) VALUES
(1, 'PEYRIN', 'BERNARD', 'Bernard', 'peyrin', 'mnPEaJNz6,rUPbAYGg6$UXt', 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `villa`
--

CREATE TABLE IF NOT EXISTS `villa` (
  `NUM_VILLA` int(11) NOT NULL,
  `CODE_TYVILLA` varchar(2) NOT NULL,
  `NOM_VILLA` varchar(50) DEFAULT NULL,
  `VILLE` varchar(50) DEFAULT NULL,
  `CP_VILLA` varchar(10) DEFAULT NULL,
  `DESCRIPTION_VILLA` text,
  `DESCRIPTION_PIECE` text,
  `SURFACE_HABITABLE` int(11) DEFAULT NULL,
  `ANNEE_CONSTRUCTION` varchar(10) DEFAULT NULL,
  `CAUTION_VILLA` decimal(10,0) DEFAULT NULL,
  `CAUTION_VELO` decimal(10,0) DEFAULT NULL,
  `ANIMAUX` tinyint(1) DEFAULT NULL,
  `COMM_VILLA` text,
  PRIMARY KEY (`NUM_VILLA`),
  KEY `FK_APPARTIENT` (`CODE_TYVILLA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

