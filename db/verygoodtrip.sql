-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 22 Mars 2016 à 16:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `verygoodtrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL COMMENT 'Identifiant de la catégorie',
  `category_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nom de la catégorie',
  `category_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description de la catégorie',
  `category_image` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Image de la catégorie'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(1, 'Europe', 'L''Europe est un continent ou une partie des supercontinents de l''Eurasie et de l''Afro-Eurasie. Elle est parfois appelée le « Vieux Continent », par opposition au « Nouveau Monde » (l''Amérique). Sur le plan culturel, l''Europe a reçu une multiplicité d''influences au cours des âges, et comprend de nombreux pays qui possèdent à la fois un héritage commun, des différences linguistiques, religieuses et historiques, et des apports récents venus depuis la mondialisation. À ce titre, l''Europe est un espace de civilisation forgé par une histoire millénaire. Une communauté de peuples, de différents États, tend à se constituer politiquement avec l''Union européenne.', './images/europe.jpg'),
(2, 'Amérique du Nord', 'Visitez les Etats-Unis ou encore le Canada au meilleur prix', './images/amerique.jpg'),
(3, 'Asie', 'L''Asie est délimitée par l''océan Arctique au nord, l''océan Pacifique à l''est, l''océan Indien au sud, l''océan Indien (mer Rouge) au sud-ouest, l''océan Atlantique (mer Méditerranée et mer Noire) et la mer Caspienne...', './images/asie.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_content` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `review_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trip`
--

CREATE TABLE IF NOT EXISTS `trip` (
  `trip_id` int(11) NOT NULL,
  `trip_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `trip_description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trip_price` int(11) NOT NULL,
  `trip_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL COMMENT 'Identifiant de la catégorie'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `trip`
--

INSERT INTO `trip` (`trip_id`, `trip_name`, `trip_description`, `trip_price`, `trip_image`, `category_id`) VALUES
(1, 'France', 'La France est merveilleuse !', 500, './images/france.jpg', 1),
(2, 'Espagne', 'Diversité des paysages, des cultures, des langues (castillan, catalan, basque), des terroirs et des villes. L’Espagne s’offre à tous les goûts : laissons de côté les plages envahies l’été et la Costa del Sol bétonnée par les complexes hôteliers. Aventurons-nous plutôt dans l’intérieur du pays, superbe et naturel, prodigue en paysages saisissants, en monuments splendides, en modes de vie passionnants…\r\n\r\nEn savoir plus : http://www.routard.com/guide/code_dest/espagne.htm#ixzz42urECR3S', 475, './images/espagne.jpg', 1),
(3, 'Allemagne', 'L''Allemagne, en forme longue République fédérale d''Allemagne, en allemand Deutschland, est un pays d''Europe centrale, entouré par la mer du Nord, le Danemark et la mer Baltique au nord, par la Pologne et la ...', 348, './images/allemagne.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `user_lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_firstname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `user_salt` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `user_town` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_zipcode` int(10) DEFAULT NULL,
  `user_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_lastname`, `user_firstname`, `user_password`, `user_salt`, `user_address`, `user_town`, `user_zipcode`, `user_role`) VALUES
(1, 'gaetan.martin1993@gmail.com', 'MARTIN', 'Gaëtan', 'C4FFYa3Zz7IE61h73peUeatwcVxQeczs53zj4rxTQ/98Dlpe3E7EBj+1ATMrlycN6axUrzJpEoxzm4ZTax4twQ==', 'qUgq3NAYfC1MKwrW?yevbE', '8 chemin de la Croix de Mission', 'Lézigneux', 42600, 'ROLE_USER');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cart_trip` (`trip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la catégorie',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_trip` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
