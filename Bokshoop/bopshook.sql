-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2023 at 03:02 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bopshook`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_stock` (IN `id` INT)   BEGIN
    DECLARE endloop INT DEFAULT 0;
    DECLARE amnt INT;
    DECLARE bookid VARCHAR(13);
    DECLARE sel_detail CURSOR FOR SELECT isbn, amount FROM transaction_detail WHERE transaction_id = id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET endloop = 1;
    OPEN sel_detail;

    WHILE endloop = 0 DO

    FETCH sel_detail INTO bookid, amnt;
        If endloop = 0 THEN
            UPDATE stock set amount = amount - amnt WHERE stock.isbn = bookid;
        END IF;
    END WHILE;

    CLOSE sel_detail;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cal_discount` (`id` INT) RETURNS DECIMAL(8,2) DETERMINISTIC BEGIN
    DECLARE discount DECIMAL(8,2) DEFAULT 0;
    DECLARE pnt INT DEFAULT 0;
    SELECT point INTO pnt FROM member WHERE member_id = id;
    IF (pnt >= 2000 AND pnt <= 4999) THEN
    	SET discount = 0.03;
    ELSEIF (pnt >= 5000 AND pnt <= 9999) THEN
    	SET discount = 0.05;
    ELSEIF (pnt >= 10000) THEN
    	SET discount = 0.1;
    ELSE
    	SET discount = 0;
    END IF;
RETURN (discount);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `cal_price` (`id` INT) RETURNS DECIMAL(8,2) DETERMINISTIC BEGIN
    DECLARE total DECIMAL(8,2) DEFAULT 0;
    DECLARE endloop INT DEFAULT 0;
    DECLARE amnt INT;
    DECLARE pr DECIMAL(8,2);
    DECLARE bookid VARCHAR(13);
    DECLARE sel_detail CURSOR FOR SELECT isbn, amount FROM transaction_detail WHERE transaction_id = id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET endloop = 1;
    OPEN sel_detail;
        WHILE endloop = 0 DO
        FETCH sel_detail INTO bookid, amnt;
            If endloop = 0 THEN
                SET pr = (SELECT price FROM stock WHERE stock.isbn = bookid);
                SET total = total + (pr*amnt);
            END IF;
        END WHILE;
    CLOSE sel_detail;
RETURN (total);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  `dob` date NOT NULL,
  `tel_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `point`, `dob`, `tel_no`) VALUES
(1, 'Ngan Ron', 0, '2023-11-23', '0208713548'),
(2, 'Vein Diagram', 4191, '2023-11-23', '0208713549'),
(3, 'Marie', 100, '2023-11-23', '123'),
(5, 'sdh', 0, '2023-11-09', '85248'),
(6, 'Kane', 0, '2023-01-03', '984562'),
(7, 'Sadie', 0, '2023-01-04', '64782'),
(8, 'Eddie', 0, '2023-11-03', '852456'),
(9, 'Ed', 0, '2023-11-05', '8975497'),
(10, 'Pie', 0, '2023-11-27', '478521478'),
(11, 'kram', 0, '2023-11-23', '088888888');

--
-- Triggers `member`
--
DELIMITER $$
CREATE TRIGGER `safe_member_id` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN
SET NEW.member_id = OLD.member_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `username`, `password`) VALUES
(99, 'Luna Lovegood', 'staff', '$2y$10$36Swx6atfRTcCjoy2OFfUeOAJaTM9gTfmRdx3QrZGhIeUpcmZHAUG');

--
-- Triggers `staff`
--
DELIMITER $$
CREATE TRIGGER `safe_staff_id` BEFORE UPDATE ON `staff` FOR EACH ROW BEGIN
SET NEW.staff_id = OLD.staff_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `isbn` varchar(13) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL DEFAULT '0.00',
  `amount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`isbn`, `book_title`, `author`, `category`, `price`, `amount`) VALUES
('1', 'Uyt', 'A4', 'Horror', '450.00', 7),
('2', 'Demoman', 'Demoman', 'Engineering', '100.00', 0),
('3', 'Sleepy', 'Hypnos', 'Mythology', '150.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `totalprice` decimal(8,2) NOT NULL DEFAULT '0.00',
  `transaction_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `staff_id`, `member_id`, `totalprice`, `transaction_time`) VALUES
(572, 99, 1, '0.00', '2023-11-22 22:15:06'),
(573, 99, 1, '0.00', '2023-11-22 22:17:00'),
(574, 99, 3, '100.00', '2023-11-22 22:21:01'),
(575, 99, 2, '1000.00', '2023-11-22 22:21:33'),
(576, 99, 2, '1350.00', '2023-11-22 22:33:08'),
(577, 99, 1, '0.00', '2023-11-22 22:33:15'),
(578, 99, NULL, '450.00', '2023-11-27 09:03:05'),
(579, 99, 2, '200.00', '2023-11-27 10:11:11'),
(580, 99, 2, '400.00', '2023-11-27 10:12:25'),
(581, 99, 2, '400.00', '2023-11-27 10:12:51'),
(582, 99, 2, '500.00', '2023-11-27 10:13:45'),
(583, 99, NULL, '450.00', '2023-11-27 10:19:13'),
(584, 99, NULL, '450.00', '2023-11-27 10:21:46'),
(585, 99, 2, '450.00', '2023-11-27 10:23:24'),
(586, 99, 2, '97.00', '2023-11-27 10:25:32'),
(587, 99, 2, '97.00', '2023-11-27 10:32:36'),
(588, 99, 2, '97.00', '2023-11-27 11:01:11'),
(589, 99, 2, '97.00', '2023-11-27 11:02:43'),
(590, 99, 2, '97.00', '2023-11-27 11:04:07');

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `safe_transaction` BEFORE UPDATE ON `transaction` FOR EACH ROW BEGIN
SET NEW.transaction_id = OLD.transaction_id;
SET NEW.staff_id = OLD.staff_id;
SET NEW.member_id = OLD.member_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_stock_on_sale` BEFORE UPDATE ON `transaction` FOR EACH ROW BEGIN
IF (OLD.totalprice=0 AND NEW.totalprice > OLD.totalprice) THEN
CALL upd_stock(OLD.transaction_id);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `transaction_id` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`transaction_id`, `isbn`, `amount`) VALUES
(572, '1', 1),
(573, '1', 1),
(574, '2', 1),
(575, '1', 2),
(575, '2', 1),
(576, '1', 3),
(578, '1', 1),
(579, '2', 2),
(580, '2', 4),
(581, '2', 4),
(582, '2', 5),
(583, '1', 1),
(584, '1', 1),
(585, '1', 1),
(586, '2', 1),
(587, '2', 1),
(588, '2', 1),
(589, '2', 1),
(590, '2', 1);

--
-- Triggers `transaction_detail`
--
DELIMITER $$
CREATE TRIGGER `check_amnt_bf_buy_isrt` BEFORE INSERT ON `transaction_detail` FOR EACH ROW BEGIN
IF NEW.amount > (SELECT amount FROM stock WHERE stock.isbn = NEW.isbn) THEN
	SIGNAL SQLSTATE '45000' 
	SET MESSAGE_TEXT = "The amount exceed the stock quantity!";
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_amnt_bf_buy_updt` BEFORE UPDATE ON `transaction_detail` FOR EACH ROW BEGIN
IF NEW.amount > (SELECT amount FROM stock WHERE stock.isbn = NEW.isbn) THEN
	SIGNAL SQLSTATE '45000' 
	SET MESSAGE_TEXT = "The amount exceed the stock quantity!";
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `safe_transaction_dt` BEFORE UPDATE ON `transaction_detail` FOR EACH ROW BEGIN
SET NEW.transaction_id = OLD.transaction_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `tel_no` (`tel_no`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`transaction_id`,`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `stock` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
