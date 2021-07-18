-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 18 juil. 2021 à 14:57
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `contenu`, `date`, `id_utilisateur`) VALUES
(3, 'coucou!!', '2021-07-16 15:55:53', 3),
(6, 'coucou', '2021-07-16 16:59:32', 3),
(9, 'Au travail :) !', '2021-07-17 13:35:36', 1),
(10, 'Let\'s go !!', '2021-07-17 13:51:22', 1),
(11, 'come on !!', '2021-07-17 13:52:08', 1),
(14, 'LOL xD', '2021-07-17 13:53:24', 1),
(15, 'hey !!', '2021-07-17 17:42:23', 1),
(21, 'ça va tout le monde?', '2021-07-18 16:46:58', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(1) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fin` datetime NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=Active | 0=Inactive''',
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `titre` varchar(25) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_debut` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('archive','todo','done') NOT NULL DEFAULT 'todo',
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `todolist`
--

INSERT INTO `todolist` (`id`, `titre`, `description`, `date_debut`, `date_fin`, `status`, `id_utilisateur`) VALUES
(1, 'journal', 'cc', '2021-07-18 16:08:03', '2021-07-20 00:00:00', 'todo', 1),
(2, 'anniversaire', '', '2021-07-18 16:13:14', '2021-07-18 16:13:14', 'todo', 1),
(3, 'facetime', 'facetime avec Patrick', '2021-07-18 16:14:44', '2021-07-18 16:14:44', 'todo', 1),
(4, 'journal', '', '2021-07-18 16:45:01', '2021-07-18 16:45:01', 'todo', 3),
(5, 'anniversaire', '', '2021-07-18 16:45:01', '2021-07-18 16:45:01', 'todo', 3),
(6, 'facetime', 'facetime avec Jean', '2021-07-18 16:45:26', '2021-07-18 16:45:26', 'todo', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `supprimé` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `mdp`, `mail`, `status`, `supprimé`) VALUES
(1, 'Alicia69!', '$2y$10$ZRYQUXgZH3oeBpCr3AhiW.Uys6TRlZgptG3aNQ4/89ovNPEuEnL12', 'ali@ali.fr', 1, 0),
(2, 'aliali1', '$2y$10$7ggx/dXiVql1YuuviA75cuWljdeHpO9gKdMj7ZtSXZG7fJOzQsPpu', 'ali12@ali.fr', 0, 0),
(3, 'Aliali12', '$2y$10$tksNDP.PiUXekORFQ37XU.9.OBrohR4vhqt7AuND.lGLwc4FptOua', 'alici@ge.fr', 0, 0),
(5, 'Rara', '$2y$10$xwr5DDTs6FN2oLaBourcJeq3/mxqgIvSdmkQgMcpzKnkOFmQ5JlMe', 'rara@gmail.com', 0, 0),
(6, 'coco', '$2y$10$QJKHrv0oARFJNsu5bSLf9eH7aUJI3ujp6RhMW8iLERwTLtwFfR5YK', 'coco@gmail.com', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_event` (`id_utilisateur`);

--
-- Index pour la table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `user_event` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
