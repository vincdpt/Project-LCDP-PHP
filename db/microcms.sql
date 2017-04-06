-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 06 Avril 2017 à 11:59
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `microcms`
--

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `id_famille` int(5) NOT NULL,
  `famille_produit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`id_famille`, `famille_produit`) VALUES
(1, 'Analgésiques'),
(2, 'Antibiotiques'),
(3, 'Antalgiques'),
(4, 'Anti-inflammatoires'),
(5, 'Antidépresseurs'),
(6, 'Antihistaminiques'),
(7, 'Allergènes'),
(8, 'Antitussifs');

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

CREATE TABLE `gestionnaire` (
  `login` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`login`, `mdp`) VALUES
('alexandre', 'andrealex'),
('jean-baptiste', 'alcaraz'),
('kevin', 'vinke'),
('thibaud', 'demorand'),
('vincent', 'dupont');

-- --------------------------------------------------------

--
-- Structure de la table `praticien`
--

CREATE TABLE `praticien` (
  `id_praticien` int(10) NOT NULL,
  `id_specialite` int(5) NOT NULL,
  `raison_sociale` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `coeff_notoriete` double NOT NULL,
  `coeff_confiance` double NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `praticien`
--

INSERT INTO `praticien` (`id_praticien`, `id_specialite`, `raison_sociale`, `adresse`, `telephone`, `nom`, `mail`, `coeff_notoriete`, `coeff_confiance`, `type`) VALUES
(1, 1, 'Mr.', '114 r Authie', '0623275641', 'Notini', 'notini.alain@mail.fr', 290, 250, 'prospect'),
(2, 2, 'Mr.', '13 r Devon', '0654817259', 'Gosselin', 'gosselin.albert@mail.fr', 307, 300, 'client'),
(3, 3, 'Mme.', '31 r St Jean', '0641859520', 'Desmoulins', 'desmoulins.anne@mail.fr', 95, 120, 'client'),
(4, 7, 'Mr.', '47 av Robert Schuman', '0452163285', 'Leroux', 'leroux.andre@mail.fr', 172, 140, 'prospect'),
(5, 6, 'Mme.', '14 av Thiès', '0632154785', 'Rossa', 'rossa.claire@mail.fr', 530, 510, 'prospect'),
(6, 4, 'Mme.', '9 r Demolombe', '0632598410', 'Houchard', 'houchard.eliane@mail.fr', 437, 400, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` varchar(10) NOT NULL,
  `id_famille` int(5) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `effets` varchar(200) NOT NULL,
  `contre_indication` varchar(200) NOT NULL,
  `interactions_autres_produits` varchar(200) NOT NULL,
  `presentation` varchar(200) NOT NULL,
  `dosage` double NOT NULL,
  `prix_HT` double NOT NULL,
  `prix_Echantillon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_famille`, `nom`, `effets`, `contre_indication`, `interactions_autres_produits`, `presentation`, `dosage`, `prix_HT`, `prix_Echantillon`) VALUES
('3MYC7', 4, 'TRIMYCINE', 'Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.', 'Ce médicament est contre-indiqué en cas d\'\'allergie à  l\'\'un des constituants, d\'\'infections de la peau ou de parasitisme non traités, d\'\'acné. Ne pas appliquer sur une plaie.', '', 'Triamcinolone (acétonide) + Néomycine + Nystatine', 50, 10, 2.5),
('AMOPIL7', 1, 'AMOPIL', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'\'allergie aux céphalosporines.', '', 'Amoxicilline', 10, 12.5, 4.8),
('CARTION6', 6, 'CARTION', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas de troubles de la coagulation (tendances aux hémorragies), d\'\'ulcère gastroduodénal, maladies graves du foie.', 'aucun', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 30, 20, 12),
('DEPRIL9', 3, 'DEPRAMIL', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères, certaines douleurs rebelles, les troubles obsessionnels compulsifs et certaines énurésies chez l\'\'enfant.', 'Ce médicament est contre-indiqué en cas de glaucome ou d\'\'adénome de la prostate, d\'\'infarctus récent, ou si vous avez reà§u un traitement par IMAO durant les 2 semaines précédentes.', 'aucun', 'Clomipramine', 25, 17, 10),
('DORNOM8', 8, 'NORMADOR', 'Ce médicament est utilisé pour traiter l\'\'insomnie chez l\'\'adulte.', 'Ce médicament est contre-indiqué en cas de glaucome, de certains troubles urinaires (rétention urinaire) et chez l\'\'enfant de moins de 15 ans.', 'aucun', 'Doxylamine', 35, 27, 13),
('INSXT5', 5, 'INSECTIL', 'Ce médicament est utilisé en application locale sur les piqûres d\'\'insecte et l\'\'urticaire.', 'Ce médicament est contre-indiqué en cas d\'\'allergie aux antihistaminiques.', 'aucun', 'Diphénydramine', 13, 5, 1),
('PARMOL16', 6, 'PARMOCODEINE', 'Ce médicament est utilisé pour le traitement des douleurs lorsque des antalgiques simples ne sont pas assez efficaces.', 'Ce médicament est contre-indiqué en cas d\'\'allergie à  l\'\'un des constituants, chez l\'\'enfant de moins de 15 Kg, en cas d\'\'insuffisance hépatique ou respiratoire.', 'aucun', 'Codéine + Paracétamol', 10, 7, 4),
('PHYSOI8', 8, 'PHYSICOR', 'Ce médicament est utilisé pour traiter les baisses d\'\'activité physique ou psychique, souvent dans un contexte de dépression.', 'Ce médicament est contre-indiqué en cas d\'\'allergie à  l\'\'un des constituants.', 'aucun', 'Sulbutiamine', 5, 8, 3),
('POMDI20', 5, 'POMADINE', 'Ce médicament est utilisé pour traiter les infections oculaires de la surface de l\'\'oeil.', 'Ce médicament est contre-indiqué en cas d\'\'allergie aux antibiotiques appliqués localement.', 'aucun', 'Bacitracine', 9, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `id_secteur` int(5) NOT NULL,
  `secteur_intervention` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `secteur`
--

INSERT INTO `secteur` (`id_secteur`, `secteur_intervention`) VALUES
(1, 'Est'),
(2, 'Nord'),
(3, 'Ouest'),
(4, 'Paris centre'),
(5, 'Sud');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id_specialite` int(5) NOT NULL,
  `specialite_praticien` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `specialite`
--

INSERT INTO `specialite` (`id_specialite`, `specialite_praticien`) VALUES
(1, 'médecin'),
(2, 'dentiste'),
(3, 'infirmier'),
(4, 'cardiologue'),
(5, 'chirurgien'),
(6, 'allergologue'),
(7, 'pneumologue');

-- --------------------------------------------------------

--
-- Structure de la table `t_article`
--

CREATE TABLE `t_article` (
  `art_id` int(11) NOT NULL,
  `art_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `art_content` varchar(2000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `t_article`
--

INSERT INTO `t_article` (`art_id`, `art_title`, `art_content`) VALUES
(1, 'First article', 'Hi there! This is the very first article.'),
(2, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut hendrerit mauris ac porttitor accumsan. Nunc vitae pulvinar odio, auctor interdum dolor. Aenean sodales dui quis metus iaculis, hendrerit vulputate lorem vestibulum. Suspendisse pulvinar, purus at euismod semper, nulla orci pulvinar massa, ac placerat nisi urna eu tellus. Fusce dapibus rutrum diam et dictum. Sed tellus ipsum, ullamcorper at consectetur vitae, gravida vel sem. Vestibulum pellentesque tortor et elit posuere vulputate. Sed et volutpat nunc. Praesent nec accumsan nisi, in hendrerit nibh. In ipsum mi, fermentum et eleifend eget, eleifend vitae libero. Phasellus in magna tempor diam consequat posuere eu eget urna. Fusce varius nulla dolor, vel semper dui accumsan vitae. Sed eget risus neque.'),
(3, 'Lorem ipsum in french', 'J’en dis autant de ceux qui, par mollesse d’esprit, c’est-à-dire par la crainte de la peine et de la douleur, manquent aux devoirs de la vie. Et il est très facile de rendre raison de ce que j’avance. Car, lorsque nous sommes tout à fait libres, et que rien ne nous empêche de faire ce qui peut nous donner le plus de plaisir, nous pouvons nous livrer entièrement à la volupté et chasser toute sorte de douleur ; mais, dans les temps destinés aux devoirs de la société ou à la nécessité des affaires, souvent il faut faire divorce avec la volupté, et ne se point refuser à la peine. La règle que suit en cela un homme sage, c’est de renoncer à de légères voluptés pour en avoir de plus grandes, et de savoir supporter des douleurs légères pour en éviter de plus fâcheuses.');

-- --------------------------------------------------------

--
-- Structure de la table `t_comment`
--

CREATE TABLE `t_comment` (
  `com_id` int(11) NOT NULL,
  `com_content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `art_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `t_comment`
--

INSERT INTO `t_comment` (`com_id`, `com_content`, `art_id`, `usr_id`) VALUES
(1, 'Great! Keep up the good work.', 1, 1),
(2, 'Thank you, I\'ll try my best.', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usr_password` varchar(88) COLLATE utf8_unicode_ci NOT NULL,
  `usr_salt` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `usr_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `t_user`
--

INSERT INTO `t_user` (`usr_id`, `usr_name`, `usr_password`, `usr_salt`, `usr_role`) VALUES
(1, 'JohnDoe', '$2y$13$F9v8pl5u5WMrCorP9MLyJeyIsOLj.0/xqKd/hqa5440kyeB7FQ8te', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_ADMIN'),
(2, 'JaneDoe', '$2y$13$qOvvtnceX.TjmiFn4c4vFe.hYlIVXHSPHfInEG21D99QZ6/LM70xa', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER'),
(3, 'admin', '$2y$13$ojx9e8uax1LtiXU3S1sgbu/YQNF3tzUr6o3NGAuySPzkgTUauV4j.', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id_visiteur` char(4) NOT NULL,
  `id_secteur` int(5) DEFAULT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` char(20) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `Privileges` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id_visiteur`, `id_secteur`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`, `Privileges`) VALUES
('a131', NULL, 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21', 0),
('a17', NULL, 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', 1),
('a55', NULL, 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12', 0),
('a93', NULL, 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01', 0),
('b13', NULL, 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09', 0),
('b16', NULL, 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11', 0),
('b19', NULL, 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21', 0),
('b25', NULL, 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'paris', '2010-12-05', 0),
('b28', NULL, 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris', '2009-11-12', 0),
('b34', NULL, 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris', '2008-09-23', 0),
('b4', NULL, 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris', '2005-11-12', 0),
('b50', NULL, 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville', '2003-08-11', 0),
('b59', NULL, 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18', 0),
('c14', NULL, 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11', 0),
('c3', NULL, 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', '94000', 'Créteil', '2010-12-14', 0),
('c54', NULL, 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23', 0),
('d13', NULL, 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11', 0),
('d51', NULL, 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17', 0),
('e22', NULL, 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans', '2005-11-12', 0),
('e24', NULL, 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05', 0),
('e39', NULL, 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01', 0),
('e49', NULL, 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10', 0),
('e5', NULL, 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret', '1995-09-01', 0),
('e52', NULL, 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille', '1999-11-01', 0),
('f21', NULL, 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10', 0),
('f39', NULL, 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh', '1998-10-01', 0),
('f4', NULL, 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre', '1985-11-01', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`id_famille`);

--
-- Index pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD PRIMARY KEY (`id_praticien`),
  ADD KEY `praticien` (`id_specialite`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `produits` (`id_famille`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id_secteur`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id_specialite`);

--
-- Index pour la table `t_article`
--
ALTER TABLE `t_article`
  ADD PRIMARY KEY (`art_id`);

--
-- Index pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fk_com_art` (`art_id`),
  ADD KEY `fk_com_usr` (`usr_id`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`usr_id`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id_visiteur`),
  ADD KEY `visiteur` (`id_secteur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `id_famille` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `praticien`
--
ALTER TABLE `praticien`
  MODIFY `id_praticien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id_secteur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `t_article`
--
ALTER TABLE `t_article`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD CONSTRAINT `praticien_ibfk_1` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id_specialite`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_famille`) REFERENCES `famille` (`id_famille`);

--
-- Contraintes pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `fk_com_art` FOREIGN KEY (`art_id`) REFERENCES `t_article` (`art_id`),
  ADD CONSTRAINT `fk_com_usr` FOREIGN KEY (`usr_id`) REFERENCES `t_user` (`usr_id`);

--
-- Contraintes pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD CONSTRAINT `visiteur_ibfk_1` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id_secteur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
