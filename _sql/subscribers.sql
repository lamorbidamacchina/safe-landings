-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ott 17, 2019 alle 18:50
-- Versione del server: 5.5.64-MariaDB
-- Versione PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safe_landings`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `privacy` char(1) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `email_hash` varchar(255) DEFAULT NULL,
  `phone_hash` varchar(255) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `subscribers`
--

INSERT INTO `subscribers` (`id`, `first_name`, `last_name`, `email`, `phone`, `privacy`, `source`, `ip`, `email_hash`, `phone_hash`, `creation_date`) VALUES
(23, 'Roger', 'Federer', 'Ts+YDYF6LCzYiOhSXVHvwDZ4Y4q1qQkfIX9pKvoE6xgurNRpp96kOjkwQ9bOZGfFCvyqynV/', 'RB2ahFRjHZLJZl4L8A+ax2mZeOyjEYquboRPvRRau+L58WDPam3+z1O4+wy44Ip5LA==', '1', 'Organic Web', NULL, '3e3eed26a4e2589062997895b09f9299fefe728010b0fa28961c8ae6ee36df32', '31cf3b99c6f034bdee329a1bffb5bdbe6e7efe3fe827dfb8653ed4fd62fd2dc6', '2019-10-17 18:02:34'),
(24, 'Rafa', 'Nadal', 'Dw2RSeM9DR7cjs2vM/5kcMA57wRmf8MZfXBhgpLVIKX/6BIQjJsvM2jmrm0HIyKB5EiHFIQ=', 'mAqJLer/ZUsfmpL5b3b05oiXRXjYD3w+fxYp6pchVeN5rBpXDS0SdNcyLJbtGLzfj2Za', '1', 'Organic Web', NULL, 'b45f020606e6409bf775afda95985ac00cd1767296ac9a1a718f3a13a87ec570', '9e1bc9932a7dd835586a211795e48b309f96cb187dc3482eae7dbef3e02fee88', '2019-10-17 18:02:54'),
(25, 'Novak', 'Đoković', 'uGN8ZsfomumAJnQ0WBBQNcW7MOAC+5Px5UX6FY0cu84t4vPWOJR6+0ZK37zPZegDywCIt4lJ', 'ahi18/rMoPAalH8n6QH55ZCMYG4JE7CZli9bKk0NwFeHm7JoZ2B1K2kJUye+JfFV5A==', '1', 'Organic Web', NULL, 'ebb62e2157b4e52b31ffaeeac8811652dde742843acda8d565995c05a4e645f1', '450617d2caf2f8e5d6f0d4ba9aba7ef9d437f678d9788b94fce4f15d54ae4f51', '2019-10-17 18:03:28'),
(26, 'John', 'McEnroe', '5+dgHzOZvX1RcTwgDE3F0EeAPWXzi3pNTWdjZX/2vJ+i7D20+XwRLK/OJ4zd66evhhaT', '2C0Tw30kLoZrCYfMCYN9ndH2b8nVBL2WPChvnNtl+l+DY+2v+Hs9hVhAJug16xlZRg==', '1', 'Organic Web', NULL, '20b16187652f63159677ce3f38cb4103ec2f44fd16a23c190feb65f83be304c9', '4a05de27e4d7a4cca921ac63c056e95b4f434c9abcc85bb0dd6e01facd37177e', '2019-10-17 18:10:31'),
(27, 'Matteo', 'Berrettini', 'awS3IQFpAgLV8i1Wmj9pYg6xn4OhKcuVWS0tDST3sGsFD0ROKtHiFPyPh8jFNc1kMwj9rcu9lxHpMp8=', 'YNvJInQU8HCbrTwLClP0ZX7x5GVFwgJZeg32eZvqjp3IISZneSnrnGvyOGR44W+g', '1', 'Organic Web', NULL, '1ddbd65e69919e7b5ad1c5c395d480a94657b7fb9fe26881a9f7087eb3ae2003', '2f997304e5029090346e5424d50b3f5010bd94eac3dafa0af384849d1db79a87', '2019-10-17 18:20:49');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_hash` (`email_hash`,`phone_hash`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
