-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 06 mars 2026 à 13:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_web_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `liste_pays`
--

CREATE TABLE `liste_pays` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `desciption` varchar(255) NOT NULL,
  `continent` varchar(50) NOT NULL,
  `apercu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liste_pays`
--

INSERT INTO `liste_pays` (`id`, `nom`, `desciption`, `continent`, `apercu`) VALUES
(1, 'Nicaragua', 'un magnifique pays d\'Amérique', 'Amerique', 'Nicaragua.png'),
(2, 'Haïti', 'îles pleine de surprise', 'Amerique', 'Haïtipng.png'),
(3, 'Nigeria', 'peuplé, divertissant', 'Afrique', 'images/Nigeria.png'),
(4, 'Maroc', 'chaud, tempéré, acceuillant', 'Afrique', 'images/Maroc.png'),
(5, 'arménie', 'magnifique pays du Causase, montagneux, immenses reliefs à couper le souffle', 'Europe', 'arménie.png'),
(6, 'l\'Allemagne', 'discipliné, industrie et paysages illustant la grandeur, centre financizr et carrefour de l\'Europe', 'Europe', 'Germany.png'),
(7, 'Angola', 'territoire d\'Afrique, vaste et fascinant à explorer', 'Afrique', 'Angola.png'),
(8, 'l\'Afrique du sud', 'Coeur de l\'innovation, riche en or, en culture et patriotisme grandissant', 'Afrique', 'South_Africa.png'),
(9, 'la Pologne', 'territoire fière, une culture à tout épreuve malgré les périodes les plus sombres, une résilience dans l\'histoire expectionnelle', 'Europe', 'Poland.png'),
(10, 'Le Venezuela', 'ancienne colonie américaine, malgré ses préavis, le Venezuela reste une terre d\'acceuil pour les plus valeureux et amateurs de le nature sauvage', 'Amerique', 'Venezuela.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'images/avatar_default.png',
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  `tentatives` int(11) NOT NULL,
  `dernier_echec` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `password`, `mail`, `role`, `avatar`, `date_inscription`, `tentatives`, `dernier_echec`) VALUES
(3, 'Ravaudeur', '$2y$10$br6JlZoCsUtktfH1PDMtEuWAE2brCP0rTWeUrXKnn/fMX4GqVkSy6', 'djoukalberic@gmail.com', 1, 'images/avatar_Ravaudeur_1772747760.jpeg', '2026-03-05 22:52:23', 0, '2026-03-06 12:14:16'),
(5, 'YUYU', '$2y$10$WGUPCYlE5M2nvrcu28Q1N.uMDZfXELtDeYtWyo4guki9FsaGqxWB.', 'youssef.ouarras@student.helb-prigogine.be', 3, 'images/avatar_YUYU_1772797640.jpg', '2026-03-06 12:42:26', 0, '2026-03-06 12:42:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `liste_pays`
--
ALTER TABLE `liste_pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `liste_pays`
--
ALTER TABLE `liste_pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
