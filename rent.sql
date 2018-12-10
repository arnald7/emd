-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2018 às 20:29
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `transations`
--

CREATE TABLE `transations` (
  `tr_id` int(50) NOT NULL,
  `tr_user` varchar(50) NOT NULL,
  `tr_ghlogin` varchar(50) NOT NULL,
  `tr_qtd` int(5) NOT NULL,
  `tr_vlr` double NOT NULL,
  `tr_data` datetime NOT NULL,
  `tr_close` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transations`
--

INSERT INTO `transations` (`tr_id`, `tr_user`, `tr_ghlogin`, `tr_qtd`, `tr_vlr`, `tr_data`, `tr_close`) VALUES
(5, 'Adm', 'jamesgolick', 3, 3, '2018-12-10 10:24:55', 1),
(6, 'Adm', 'topfunky', 2, 0, '2018-12-10 10:49:13', 1),
(10, 'Adm', 'wycats', 4, 6, '2018-12-10 16:21:47', 1),
(11, 'Adm', 'arnald7', 3, 1.5, '2018-12-10 16:40:55', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `us_id` int(5) NOT NULL,
  `us_name` varchar(50) NOT NULL,
  `us_login` varchar(50) NOT NULL,
  `us_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`us_id`, `us_name`, `us_login`, `us_pass`) VALUES
(1, 'Administrator', 'adm', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Guest', 'guest', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transations`
--
ALTER TABLE `transations`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transations`
--
ALTER TABLE `transations`
  MODIFY `tr_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `us_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
