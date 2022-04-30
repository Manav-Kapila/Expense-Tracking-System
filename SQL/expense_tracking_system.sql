-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 04:49 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_tracking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_statement`
--

CREATE TABLE `bank_statement` (
  `statement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `initial_balance` int(11) NOT NULL,
  `final_balance` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_statement`
--

INSERT INTO `bank_statement` (`statement_id`, `user_id`, `initial_balance`, `final_balance`, `date`) VALUES
(15, 2, 0, 2, '2022-02-07 05:47:25'),
(16, 2, 2, 22, '2022-02-07 05:47:54'),
(17, 2, 22, 12, '2022-02-07 05:48:40'),
(18, 2, 12, 1012, '2022-04-30 12:13:39'),
(19, 2, 1012, 512, '2022-04-30 12:14:28'),
(20, 2, 512, 1512, '2022-04-30 13:33:14'),
(21, 2, 1512, 512, '2022-04-30 13:34:24'),
(22, 2, 512, 1512, '2022-04-30 14:03:39'),
(23, 2, 1512, 2512, '2022-04-30 14:12:11'),
(24, 2, 2512, 3512, '2022-04-30 14:16:25'),
(25, 2, 3512, 4512, '2022-04-30 14:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_amount`
--

CREATE TABLE `deposit_amount` (
  `creditId` int(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creditTitle` varchar(20) NOT NULL,
  `creditor` varchar(20) NOT NULL,
  `depositor` varchar(20) NOT NULL,
  `creditAmount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `creditComment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposit_amount`
--

INSERT INTO `deposit_amount` (`creditId`, `user_id`, `creditTitle`, `creditor`, `depositor`, `creditAmount`, `date`, `creditComment`) VALUES
(75, 2, 't', 'a', 'a', 2, '2022-02-07 05:44:34', 'f'),
(76, 2, 'e', 'e', 'e', 2, '2022-02-07 05:47:25', 'e'),
(77, 2, 'test2', 'test', 'a', 20, '2022-02-07 05:47:54', 'tw'),
(78, 2, 'test on 30 april', 'mk', 'mk', 1000, '2022-04-30 12:13:39', 'done for testing'),
(79, 2, 'Delete it', 'MK', 'MK', 1000, '2022-04-30 13:33:14', 'Delete this transaction'),
(80, 2, 'delete it 1', 'm', 'm', 1000, '2022-04-30 14:03:39', 'delete1'),
(81, 2, 'delete 1', 'm', 'm', 1000, '2022-04-30 14:12:11', 'delete it'),
(82, 2, 'delete it 22', 'm', 'm', 1000, '2022-04-30 14:16:25', 'comment'),
(83, 2, 'dsd', 'ml', 'ml', 1000, '2022-04-30 14:19:50', 'saa');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `txn_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `txn_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `txn_type` varchar(10) NOT NULL,
  `txn_amount` float NOT NULL,
  `initial_amount` float NOT NULL,
  `final_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`txn_id`, `user_id`, `txn_date`, `txn_type`, `txn_amount`, `initial_amount`, `final_amount`) VALUES
(17, 2, '2022-02-07 05:47:25', 'Deposit', 2, 0, 2),
(18, 2, '2022-02-07 05:47:54', 'Deposit', 20, 2, 22),
(19, 2, '2022-02-07 05:48:40', 'Withdrawl', 10, 22, 12),
(20, 2, '2022-04-30 12:13:39', 'Deposit', 1000, 12, 1012),
(21, 2, '2022-04-30 12:14:28', 'Withdrawl', 500, 1012, 512),
(25, 2, '2022-04-30 14:19:50', 'Deposit', 1000, 3512, 4512);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`) VALUES
(1, 'Manav', 'manav123'),
(2, 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_amount`
--

CREATE TABLE `withdraw_amount` (
  `withdraw_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `withdraw_title` varchar(20) NOT NULL,
  `withdrawn_by` varchar(20) NOT NULL,
  `withdraw_amount` float NOT NULL,
  `withdrawn_for` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `withdraw_reason` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw_amount`
--

INSERT INTO `withdraw_amount` (`withdraw_id`, `user_id`, `withdraw_title`, `withdrawn_by`, `withdraw_amount`, `withdrawn_for`, `date`, `withdraw_reason`) VALUES
(6, 2, 'test', 'a', 10, 'm', '2022-02-07 05:48:40', 'ea'),
(7, 2, 'testing on 30 april', 'mk', 500, 'mk', '2022-04-30 12:14:28', 'done for wi'),
(8, 2, 'Delete it 2', ' MK', 1000, 'MK', '2022-04-30 13:34:24', 'Delete it 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_statement`
--
ALTER TABLE `bank_statement`
  ADD PRIMARY KEY (`statement_id`);

--
-- Indexes for table `deposit_amount`
--
ALTER TABLE `deposit_amount`
  ADD PRIMARY KEY (`creditId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`txn_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `withdraw_amount`
--
ALTER TABLE `withdraw_amount`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_statement`
--
ALTER TABLE `bank_statement`
  MODIFY `statement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `deposit_amount`
--
ALTER TABLE `deposit_amount`
  MODIFY `creditId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `txn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `withdraw_amount`
--
ALTER TABLE `withdraw_amount`
  MODIFY `withdraw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
