-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 04 avr. 2019 à 18:37
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hms_hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `password`, `date_reg`) VALUES
(1, 'alaa', 'eddine', 'al2a@al2ae2dine.com', '70ae08c4c947c11d49c546864121c78f', '2019-04-02 11:23:14'),
(2, 'Administrateur', '01', 'admin@hms.com', '202cb962ac59075b964b07152d234b70', '2019-04-02 11:24:58'),
(6, 'za', 'za', 'kadarokho@gmail.com', '202cb962ac59075b964b07152d234b70', '2019-04-03 11:18:49');

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `chambres_id` int(11) NOT NULL,
  `num_chambres` int(11) NOT NULL,
  `num_etage` int(11) NOT NULL,
  `type_chambres` varchar(255) NOT NULL,
  `description_chambres` varchar(255) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`chambres_id`, `num_chambres`, `num_etage`, `type_chambres`, `description_chambres`, `prix`) VALUES
(1, 1, 1, 'Single', '                                          test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test tes', 1000),
(3, 5, 2, 'Single', 'aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa aaaaaaa ', 0),
(4, 9, 1, 'Double', 'zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzzzzzzz zzz', 2000);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `chambres_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`photo_id`, `chambres_id`, `name`) VALUES
(1, 1, '1554370266_1200px-Flag_of_Canada_(Pantone).svg.png'),
(5, 2, '1554370566_holmdel33.jpg'),
(6, 2, '1554370566_hqdefault (1).jpg'),
(7, 2, '1554370566_hqdefault.jpg'),
(8, 2, '1554370566_ken thompson japan prize 68.jpg'),
(9, 2, '1554370566_Ken_Thompson_(sitting)_and_Dennis_Ritchie_at_PDP-11_(2876612463).jpg'),
(13, 1, '1554374092_41evNnqmf-L._SX218_BO1,204,203,200_QL40_.jpg'),
(14, 3, '1554374322_251px-Dennis_Ritchie_2011.jpg'),
(16, 4, '1554374911_background.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `countries` varchar(255) NOT NULL,
  `type_chambres` varchar(255) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `n_days` int(11) NOT NULL,
  `date_reservation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `firstname`, `lastname`, `email`, `phone`, `countries`, `type_chambres`, `date_in`, `date_out`, `n_days`, `date_reservation`) VALUES
(1, 'Belalia', 'Mohamed Alaa Eddine', 'mascaprod7@gmail.com', 697701228, 'Algeria', '0', '2019-04-05', '2019-04-12', 7, '2019-04-04 15:43:39'),
(2, 'Belalia', 'Mohamed Alaa Eddine', 'mascaprod7@gmail.com', 697701228, 'Algeria', '0', '2019-04-05', '2019-04-12', 7, '2019-04-04 15:45:42'),
(3, 'Belalia', 'Mohamed Alaa Eddine', 'mascaprod7@gmail.com', 697701228, 'Algeria', 'Double', '2019-04-05', '2019-04-12', 7, '2019-04-04 15:46:55');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`chambres_id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `chambres`
--
ALTER TABLE `chambres`
  MODIFY `chambres_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
