-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2024 at 04:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web_reservasi_penginapan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `id_room` int NOT NULL,
  `type_rooms` enum('Single Room','Double Room','Suite','Studio','Deluxe Room','Executive Room') NOT NULL,
  `desk_room` varchar(500) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id_room`, `type_rooms`, `desk_room`, `price`) VALUES
(1, 'Single Room', 'Perfect for solo travelers, our Single Room offers a cozy space with a comfortable single bed, free Wi-Fi, and a modern bathroom. ', 100000),
(2, 'Double Room', 'Ideal for couples or friends, our Double Room features a spacious double bed or two single beds, ensuring a comfortable stay. ', 200000),
(3, 'Double Room', 'Ideal for couples or friends, our Double Room features a spacious double bed or two single beds, ensuring a comfortable stay. ', 300000),
(12, 'Suite', 'For travelers seeking a touch of luxury, our Suite Room offers a spacious and elegant retreat. Revel in the comfort of a plush king-sized bed, indulge in complimentary high-speed Wi-Fi, and unwind in the contemporary ambiance of the ensuite bathroom.', 500000),
(13, 'Studio', 'Discover comfort and style in our Studio Room, a cozy retreat designed for the discerning traveler. With modern amenities and thoughtful touches, this inviting space offers the perfect blend of functionality and relaxation.', 700000),
(14, 'Deluxe Room', 'Indulge in luxury and elegance in our Deluxe Room, where sophisticated design meets unparalleled comfort. Featuring upscale amenities and plush furnishings, this refined sanctuary provides a truly memorable stay for the modern traveler.', 800000),
(15, 'Executive Room', 'Experience the epitome of luxury in our Executive Room, a haven of sophistication and refinement. Boasting spacious interiors, lavish amenities, and impeccable service, this exclusive retreat is perfect for those seeking an elevated travel experience.', 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `id_transaction` int NOT NULL,
  `id_room` int NOT NULL,
  `id_user` int NOT NULL,
  `transaction_date` date NOT NULL,
  `price` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `transaction_kode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id_transaction`, `id_room`, `id_user`, `transaction_date`, `price`, `start_date`, `end_date`, `transaction_kode`) VALUES
(40, 1, 4, '2024-06-08', 100000, '2024-06-23', '2024-06-25', '1717834602'),
(41, 2, 4, '2024-06-08', 200000, '2024-06-23', '2024-06-25', '1717834602'),
(42, 1, 4, '2024-06-08', 100000, '2024-06-12', '2024-06-14', '1717834610'),
(43, 1, 4, '2024-06-12', 100000, '2024-06-12', '2024-06-14', '1718163162'),
(44, 1, 4, '2024-06-12', 100000, '2024-06-12', '2024-06-14', '1718163162');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `fullname`, `email`, `phone`, `username`, `password`) VALUES
(1, 'rizki febriansyah', 'ayam@gmail.com', '0988732387', 'iMixx', '$2y$10$Cjyj5v69Iyx2lS64F.c9nu6tmcn84QfMKb/AFykbst.EzDJ7iU4xC'),
(2, 'sdfadaw', 'ayam@gmail.com', '23424234234', 'adawdawd', '$2y$10$s0G.ZncZPPrMPY5m/XXsT.F9BoLtMqeJ/BVn8tZFjp9KagkkrhbV.'),
(3, 'qedqweqwe', 'ayam@gmail.com', '3456323242342', 'qweqweq', '$2y$10$nXgBAObg5MnUFpt4Dzaid.LAKGWQOwB5AZusNx1yK/8Otq/8uvS3e'),
(4, 'kiki', 'admin123@gmail.com', '0986735123', 'admin', '$2y$10$4XQNgMnBagSlFNa5aTxAu.qxqdbsMu4oigeNLPmT/2QQWY0CL.Khi'),
(5, 'kato', 'kato@gmail.com', '3223423423', 'megumi', '$2y$10$KYBO62MzHbTQaHzi8Sw5L.nAzJqsLYG4clgEkEqwDTeNaIH7.SoIe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `id_room` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id_transaction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD CONSTRAINT `tbl_transactions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`),
  ADD CONSTRAINT `tbl_transactions_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `tbl_rooms` (`id_room`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
