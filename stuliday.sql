-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 06 mai 2021 à 10:01
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stuliday`
--
CREATE DATABASE IF NOT EXISTS `stuliday` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `stuliday`;

-- --------------------------------------------------------

--
-- Structure de la table `biens`
--

DROP TABLE IF EXISTS `biens`;
CREATE TABLE IF NOT EXISTS `biens` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'France',
  `surface` int(10) NOT NULL,
  `bedroom_number` int(4) NOT NULL,
  `price` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `author_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `biens`
--

INSERT INTO `biens` (`id`, `title`, `photo`, `description`, `country`, `surface`, `bedroom_number`, `price`, `category_id`, `author_id`) VALUES
(18, 'Maison geek 2', '', 'blah blah 1\"', 'France', 81, 2, 450, 18, 6),
(10, 'La maison qui va bien', 'depreux-construction.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in dolor at augue sodales tempus sit amet nec erat. Phasellus tincidunt iaculis tempus. Quisque elementum lobortis metus a feugiat. Duis sodales elit vitae arcu egestas, vitae ultrices risus molestie. Nam eleifend imperdiet augue sed pulvinar. In euismod at justo non faucibus. Duis eleifend, justo sed eleifend finibus, dolor tortor tristique turpis, ut pellentesque ligula mi nec velit. Nullam et commodo dolor.\r\n\r\nCurabitur accumsan porta blandit. Sed tincidunt eu ante id blandit. Fusce molestie nisi mattis, sollicitudin magna non, lobortis mauris. Proin malesuada pretium metus sit amet consequat. Nam ac dui ac risus venenatis auctor eu non mi. Vestibulum auctor metus eget tincidunt facilisis. Nulla nec porttitor urna. Vestibulum est tellus, aliquam non massa sit amet, congue finibus tellus. Praesent augue leo, placerat fringilla bibendum at, tempor a urna.\"', 'France', 220, 3, 600, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'maison'),
(4, 'appartement'),
(5, 'box');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'ROLE_USER',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(2, 'thierry', 'd.thierry@talis-bs.net', '$2y$10$ZVasNXPsN/vUP.qjVi5e5Oe8JoFaLmZDbGY6D8ERb6QeU8dXfxh2a', 'ROLE_ADMIN'),
(6, 'geek', 'geek@del-castillo.fr', '$2y$10$L4Lo9PSOqyWEllUWEa0dee9r6Vyz8QBoaajritgeKuBgrKiuSiJUy', 'ROLE_USER');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
