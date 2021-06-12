-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 11 juin 2020 à 08:46
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ppe2`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `NO_ARTICLE` int(32) NOT NULL,
  `NO_THEME` varchar(40) NOT NULL,
  `NO_UTILISATEUR` varchar(40) NOT NULL,
  `NOM_ARTICLE` varchar(40) NOT NULL,
  `DATE` date NOT NULL,
  `Photo` varchar(40) NOT NULL,
  `Description` varchar(5000) NOT NULL,
  `Saisie` varchar(1000) NOT NULL,
  `No_Type` int(11) NOT NULL,
  `No_Genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`NO_ARTICLE`, `NO_THEME`, `NO_UTILISATEUR`, `NOM_ARTICLE`, `DATE`, `Photo`, `Description`, `Saisie`, `No_Type`, `No_Genre`) VALUES
(1, '1', '1', 'Obi-Wan', '2020-01-20', 'obiw-e1579828872328-150x150.jpg', 'Retard Series', 'Soit après sa défaite face à Anakin Skywalker mais avant sa rencontre officielle avec Luke. Une partie de l\'action pourrait ainsi se dérouler sur Tatooine, planète sur laquelle il s est cache avec une fausse identite durant plusieurs annees.', 1, 1),
(3, '1', '1', 'Captain Marvel', '2020-01-20', 'captainmarvel.jpg', 'Nouvelle réalisatrice', 'Synopsis : Carol Danvers va devenir l une des super-héroïnes les plus puissantes de l\'univers lorsque la Terre se révèle l\'enjeu d\'une guerre galactique entre deux races extraterrestres.', 1, 3),
(7, '1', '1', 'test', '2020-01-31', 'bloodshot.jpg', 'Decouverte Film', 'Synopsis: Bloodshot est un ancien soldat doté de pouvoirs de régénération et de meta-morphing suite à l\'injection de nanites dans son sang. Après avoir vu sa mémoire effacée à plusieurs reprises, il finit par découvrir qui il est et décide de se venger de ceux qui lui ont infligé cette expérience.', 1, 2),
(9, '8', '1', 'Dc Legends of Tomorow', '2020-02-19', 'Legends.jpg', 'Decouverte Serie', 'Synopsis: Lorsque les héros seuls ne sont plus suffisants, le monde a besoin de légende. Rip Hunter vient du futur qu\'il veut empêcher et crée un nouveau groupe de super-héros sous l\'égide de Flash et Green Arrow. Son nom ? Legends of Tomorrow', 2, 3),
(11, '1', '1', 'The Flash', '2020-02-20', 'loveis-e1581503008190-150x150.jpg', 'Information Film', 'Synopsis :Jeune expert de la police scientifique de Central City, Barry Allen se retrouve doté d’une vitesse extraordinaire après avoir été frappé par la foudre. Sous le costume de Flash, il utilise ses nouveaux pouvoirs pour combattre le crime.', 2, 1),
(12, '1', '1', 'Impact du Coronavirus sur le Cinema', '2020-03-19', 'black widow.jpg', 'Impact du Coronavirus sur le cinema', 'Films Reportes:\r\n<br>\r\n-Mourir Peut attendre\r\n<br>\r\n-Fast And Furious\r\n<br>\r\n-Mulan\r\n<br>\r\n-Black Widow\r\n<br>\r\n-Les Trolls 2', 1, 1),
(14, '1', '1', 'Oscar', '2020-05-11', 'joker.jpeg', 'Joaquim Phoenix decroche l oscar du meilleur acteur', 'Joaquim Phoenix decroche l oscar du meilleur acteur', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `No_Commentaire` int(11) NOT NULL,
  `No_Utilisateur` varchar(40) NOT NULL,
  `No_Article` varchar(40) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`No_Commentaire`, `No_Utilisateur`, `No_Article`, `libelle`) VALUES
(1, '3', '1', 'Ah dommage !'),
(5, '3', '1', 'testmodif'),
(6, '1', '1', 'test'),
(7, '3', '1', 'test'),
(10, '3', '1', 'test 2'),
(11, '3', '1', 'eererer'),
(12, '3', '1', 'zaza'),
(13, '3', '1', '(reerer'),
(14, '1', '9', 'Genial'),
(15, '1', '3', 'YES'),
(16, '1', '1', 'test'),
(17, '1', '3', 'test'),
(18, '1', '12', 'Aie, Black Widow prevu pour quand?\r\n'),
(19, '1', '1', 'General Kenobi'),
(20, '1', '14', 'Il le mérite.'),
(21, '5', '7', 'Ce film a du potentiel !');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `compter`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `compter` (
`NB` bigint(21)
,`No_Genre` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `No_Genre` int(11) NOT NULL,
  `Nom_Genre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`No_Genre`, `Nom_Genre`) VALUES
(1, 'Science-Fiction'),
(2, 'Comedie'),
(3, 'Super-Heros'),
(4, 'Action');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `No_Theme` int(40) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`No_Theme`, `libelle`) VALUES
(1, 'Film'),
(8, 'Serie'),
(9, 'Anime');

-- --------------------------------------------------------

--
-- Structure de la table `type_article`
--

CREATE TABLE `type_article` (
  `No_Type_Art` int(11) NOT NULL,
  `Nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_article`
--

INSERT INTO `type_article` (`No_Type_Art`, `Nom`) VALUES
(1, 'News'),
(2, 'Critique');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `No_Type` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`No_Type`, `libelle`) VALUES
(3, 'Membre'),
(4, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `NO_UTILISATEUR` int(40) NOT NULL,
  `NO_TYPE` int(40) NOT NULL,
  `LOGIN` varchar(40) NOT NULL,
  `MDP` varchar(40) NOT NULL,
  `NOM` varchar(40) NOT NULL,
  `PRENOM` varchar(40) NOT NULL,
  `DATENAISS` date NOT NULL,
  `EMAIL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`NO_UTILISATEUR`, `NO_TYPE`, `LOGIN`, `MDP`, `NOM`, `PRENOM`, `DATENAISS`, `EMAIL`) VALUES
(1, 4, 'admin', 'sioslm', 'Weltmann', 'Jeremy', '2020-01-15', 'weltmannjeremy@gmail.com'),
(3, 3, 'WeltmannJ', 'vilgenis91', 'Weltmann', 'Jeremy', '2020-02-10', 'jeremy.we@hotmail.fr'),
(4, 3, 'LeMacon', '91470', 'LeMacon', 'Jean', '1977-03-19', 'jeanlemacon@gmail.com'),
(5, 3, 'Weltmann', 'Jeremy', 'Weltmann', 'Jeremy', '1999-04-20', 'jeremy.We@hotmail.fr'),
(6, 3, 'test', '123', 'Weltmann', 'Jeremy', '2020-06-01', 'jeremy.We@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la vue `compter`
--
DROP TABLE IF EXISTS `compter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `compter`  AS  select count(0) AS `NB`,`article`.`No_Genre` AS `No_Genre` from `article` group by `article`.`No_Genre` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`NO_ARTICLE`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`No_Commentaire`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`No_Genre`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`No_Theme`);

--
-- Index pour la table `type_article`
--
ALTER TABLE `type_article`
  ADD PRIMARY KEY (`No_Type_Art`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`No_Type`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`NO_UTILISATEUR`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `NO_ARTICLE` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `No_Commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `No_Genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `No_Theme` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `type_article`
--
ALTER TABLE `type_article`
  MODIFY `No_Type_Art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `No_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `NO_UTILISATEUR` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
