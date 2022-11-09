-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 mai 2022 à 16:21
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-invites`
--

-- --------------------------------------------------------

--
-- Structure de la table `invites`
--

CREATE TABLE `invites` (
  `id` int(255) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `type_billet` varchar(15) NOT NULL,
  `nom_table` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `invites`
--

INSERT INTO `invites` (`id`, `nom`, `prenom`, `type_billet`, `nom_table`) VALUES
(1, 'Yanou', 'Yehiel', 'Célibataire', 'Limonade'),
(2, 'Yanou', 'Yehiel', 'Célibataire', 'Limonade'),
(3, 'Yanou', 'Yehiel', 'Célibataire', 'Limonade'),
(4, 'Alfonse', 'Yehiel', 'Couple', 'Limonade'),
(5, 'Yanou', 'Yehiel', 'Célibataire', 'Pamplemousse'),
(6, 'Yanou', 'Ezek', 'Célibataire', 'Pamplemousse'),
(7, 'Yanou', 'Ezek', 'Célibataire', 'Pamplemousse'),
(8, 'Yanou', 'Ezek', 'Célibataire', 'Pamplemousse'),
(9, 'Yanou', 'Ezek', 'Célibataire', 'Pamplemousse'),
(10, 'Djawa', 'Yedida', 'Célibataire', 'Ananas'),
(21, 'Piatchebe', 'Yehiel', 'Couple', 'Pamplemousse'),
(22, 'Piatchebe', 'Yehiel', 'Couple', 'Pamplemousse'),
(23, 'Yanou', 'Eraste', 'Couple', 'Limonade'),
(24, 'Paul', 'Evina', 'Couple', 'Limonade'),
(25, 'Paul', 'Evina', 'Couple', 'Limonade'),
(26, 'Toto', 'Tata', 'Célibataire', 'Pamplemousse');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
