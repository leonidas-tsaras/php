-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 21 Νοε 2023 στις 09:25:33
-- Έκδοση διακομιστή: 10.4.28-MariaDB
-- Έκδοση PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `app`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `newsletter`
--

CREATE TABLE `newsletter` (
  `newsletter_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `newsletter`
--

INSERT INTO `newsletter` (`newsletter_id`, `email`, `date`) VALUES
(1, 'norberto_ritch@yahoo.com', '2023-11-15 08:19:36'),
(2, 'jack1974@yahoo.com', '2023-11-15 09:52:38'),
(3, 'jack1975@yahoo.com', '2023-11-15 09:53:29'),
(4, 'jack2000@yahoo.com', '2023-11-15 09:55:51'),
(5, 'clement.corw@gmail.com', '2023-11-15 10:01:37'),
(6, 'dante1974@gmail.com', '2023-11-18 21:29:38'),
(10, 'player@mygame.gr', '2023-11-21 08:22:26');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `type` enum('admin','user','merchant') NOT NULL DEFAULT 'user',
  `status` enum('pending','active','paused','deleted') NOT NULL DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `type`, `status`, `date`) VALUES
(1, 'Karlyn', 'Barrett', 'phoebe.beie8@yahoo.com', '123456', '423-741-4181', 'user', 'pending', '2023-11-15 10:49:11'),
(2, 'Megan', 'Wargo', 'dante1974@gmail.com', '123456', '607-301-4728', 'user', 'pending', '2023-11-18 21:27:56');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletter_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletter_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
