-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 12:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kassasysteem`
--

-- --------------------------------------------------------

--
-- Table structure for table `besteld`
--

CREATE TABLE `besteld` (
  `idproduct_tafel` int(11) NOT NULL,
  `idtafel` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `betaald` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `prijs` varchar(255) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `naam`, `prijs`, `categorie`) VALUES
(1, 'Fanta', '2,49', 'Drank'),
(2, 'Cola', '2,49', 'Drank'),
(3, 'Spa Rood', '1,99', 'Drank'),
(4, 'Spa blauw', '1,99', 'Drank'),
(5, '7-Up', '2,49', 'Drank'),
(6, 'Chocomel', '2,19', 'Drank'),
(7, 'Tomatensoep', '7,99', 'Eten'),
(8, 'Groentensoep', '10,49', 'Eten'),
(9, 'Carpaccio', '9,99', 'Eten'),
(10, 'Stokbrood met kruidenboter', '8,49', 'Eten'),
(11, 'Biefstuk', '12,29', 'Eten'),
(12, 'Vega-burger', '7,59', 'Eten'),
(13, 'Hamburger de luxe', '9,59', 'Eten'),
(14, 'Noorse zalm', '8,79', 'Eten'),
(15, 'Drie bolletjes ijs', '3,29', 'Eten'),
(16, 'Salade', '4,29', 'Eten'),
(17, 'Koffie', '4,59', 'Drank'),
(18, 'Kaasplankje', '5,49', 'Eten'),
(19, 'Friet', '5,19', 'Eten'),
(20, 'Olijven', '4,59', 'Eten'),
(21, 'Tortillachips', '6,29', 'Eten'),
(22, 'Pizza', '12,99', 'Eten'),
(23, 'Kip', '12,59', 'Eten'),
(24, 'Hachee', '22,99', 'Eten'),
(25, 'Zuurkool', '5,99', 'Eten'),
(26, 'Pannenkoeken', '8,29', 'Eten'),
(27, 'Poffertjes', '6,49', 'Eten'),
(28, 'Frikandel', '3,19', 'Eten'),
(29, 'Kroket', '4,39', 'Eten'),
(30, 'Bitterbal', '3,89', 'Eten'),
(31, 'Oliebollen', '4,99', 'Eten'),
(32, 'Bier', '6,29', 'Drank'),
(33, 'Wijn Rood', '4,29', 'Drank'),
(34, 'Wijn Wit', '4,29', 'Drank'),
(35, 'Mixed grill', '23,99', 'Eten'),
(36, 'Italiaanse runderstoof', '23,99', 'Eten'),
(37, 'Gebakken dorade', '23,99', 'Eten'),
(38, 'Paddenstoelen pie', '23,99', 'Eten'),
(39, 'Portugese kipspies', '23,99', 'Eten'),
(40, 'Tiramisu', '7,99', 'Eten'),
(41, 'Appeltaart', '7,99', 'Eten'),
(42, 'Aardbeientaart', '7,99', 'Eten'),
(43, 'Speculoos-brownie', '7,99', 'Eten'),
(44, 'Gerookte Zalm Bagel', '9,99', 'Eten'),
(45, 'Avocado Toast', '8.49', 'Eten'),
(46, 'Caesar Salade', '11,99', 'Eten'),
(47, 'Margherita Pizza', '13,99', 'Eten'),
(48, 'Kip Alfredo Pasta', '15,99', 'Eten'),
(49, 'Sushi Schotel', '18,99', 'Eten'),
(50, 'Miso Soep', '4,99', 'Eten'),
(51, 'Garnalen Tempura', '16,99', 'Eten'),
(52, 'Chocolade Fondue', '12,99', 'Eten'),
(53, 'Fruit Smoothie', '5,99', 'Drank'),
(54, 'Knoflookbrood', '6,99', 'Eten'),
(55, 'Caprese Salade', '10,99', 'Eten'),
(56, 'Club Sandwich', '14.49', 'Eten'),
(57, 'Runder Tacos', '11,99', 'Eten'),
(58, 'Kip Quesadilla', '9,99', 'Eten'),
(59, 'Spinazie en Artisjok Dip', '8,99', 'Eten'),
(60, 'Mango Sorbet', '7.49', 'Drank'),
(61, 'Chocolade Truffel Cake', '13,99', 'Eten'),
(62, 'Kip Caesar Wrap', '10.49', 'Eten'),
(63, 'Gegrilde Kaas Sandwich', '8,99', 'Eten'),
(64, 'Clam Chowder', '6,99', 'Eten'),
(65, 'Griekse Salade', '12,99', 'Eten'),
(66, 'Tiramisu Cheesecake', '14,99', 'Eten'),
(67, 'Frambozen Limonade', '3,99', 'Drank'),
(68, 'Kip Teriyaki Kom', '16.49', 'Eten'),
(69, 'Knoflook Parmezaanse Frietjes', '5,99', 'Eten'),
(70, 'Appeltaart', '9.49', 'Eten'),
(71, 'Banana Split', '7,99', 'Eten'),
(72, 'Ice Tea', '2,49', 'Drank'),
(73, 'Verse Jus d\'Orange', '3.49', 'Drank'),
(74, 'Limonade', '1.99', 'Drank'),
(75, 'Perensap', '3.99', 'Drank'),
(76, 'Muntthee', '2.99', 'Drank'),
(77, 'Gemberbier Klein', '2.99', 'Drank'),
(78, 'Gemberbier', '4,99', 'Drank'),
(79, 'Smoothie Bosvruchten', '3.99', 'Drank'),
(80, 'Latté', '3.49', 'Drank'),
(81, 'Chai Latte', '3.99', 'Drank'),
(82, 'Iced Cappuccino', '4.49', 'Drank'),
(83, 'Warme Chocolademelk', '3.99', 'Drank'),
(84, 'Matcha Latte', '4.99', 'Drank'),
(85, 'Coca Cola Zeo', '2,49', 'Drank'),
(86, 'Limonade', '1,99', 'Drank'),
(87, 'Perensap', '3,99', 'Drank'),
(88, 'Muntthee', '2,99', 'Drank'),
(89, 'Gemberbier Groot', '5,99', 'Drank'),
(90, 'Milkshake Aardbei', '4.99', 'Drank'),
(91, 'Milkshake Chocomel', '4,99', 'Drank'),
(92, 'Milkshake Banaan', '4,99', 'Drank'),
(93, 'Milkshake Vanilie', '4,99', 'Drank'),
(94, 'Milkshake Cool mint', '4,99', 'Drank'),
(95, 'Milkshake Blueberry', '4,99', 'Drank');

-- --------------------------------------------------------

--
-- Table structure for table `product_tafel`
--

CREATE TABLE `product_tafel` (
  `idproduct_tafel` int(11) NOT NULL,
  `idtafel` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `datumtijd` datetime NOT NULL,
  `betaald` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tafel`
--

CREATE TABLE `tafel` (
  `idtafel` int(11) NOT NULL,
  `omschrijving` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tafel`
--

INSERT INTO `tafel` (`idtafel`, `omschrijving`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(14, '14'),
(15, '15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `besteld`
--
ALTER TABLE `besteld`
  ADD PRIMARY KEY (`idproduct_tafel`),
  ADD KEY `fk_besteld_tafel` (`idtafel`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indexes for table `product_tafel`
--
ALTER TABLE `product_tafel`
  ADD PRIMARY KEY (`idproduct_tafel`);

--
-- Indexes for table `tafel`
--
ALTER TABLE `tafel`
  ADD PRIMARY KEY (`idtafel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `besteld`
--
ALTER TABLE `besteld`
  MODIFY `idproduct_tafel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `product_tafel`
--
ALTER TABLE `product_tafel`
  MODIFY `idproduct_tafel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tafel`
--
ALTER TABLE `tafel`
  MODIFY `idtafel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `besteld`
--
ALTER TABLE `besteld`
  ADD CONSTRAINT `fk_besteld_tafel` FOREIGN KEY (`idtafel`) REFERENCES `tafel` (`idtafel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
