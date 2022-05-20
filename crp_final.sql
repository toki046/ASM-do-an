-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2021 at 08:26 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crp_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `accountID` varchar(255) NOT NULL,
  `accountFullname` varchar(255) NOT NULL,
  `accountUsername` varchar(255) NOT NULL,
  `accountPassword` varchar(255) NOT NULL,
  `accountEmail` varchar(255) DEFAULT NULL,
  `accountPhone` varchar(255) DEFAULT NULL,
  `roleID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`accountID`, `accountFullname`, `accountUsername`, `accountPassword`, `accountEmail`, `accountPhone`, `roleID`) VALUES
('account_0', 'Lam Nguyen', 'lamnguyen', '16482548', 'lamnguyen@gmail.com', '0868851101', 'role_0'),
('account_1', 'Lam Nguyen', 'lamnguyen', '16482548', 'lamnguyen@gmail.com', '0868851101', 'role_2'),
('user695247', 'Son Nguyen', 'sonnguyen', '16482548', 'sonnguyen@gmail.com', '0123456789', 'role_2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_role`
--

CREATE TABLE `tbl_account_role` (
  `roleID` varchar(255) NOT NULL,
  `roleName` varchar(255) NOT NULL,
  `roleDesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account_role`
--

INSERT INTO `tbl_account_role` (`roleID`, `roleName`, `roleDesc`) VALUES
('role_0', 'Admin', 'Boss'),
('role_1', 'Staff', 'Underpaid?'),
('role_2', 'Customer', 'Money Source');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_voucher`
--

CREATE TABLE `tbl_account_voucher` (
  `voucherID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `typeID` varchar(255) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account_voucher`
--

INSERT INTO `tbl_account_voucher` (`voucherID`, `accountID`, `typeID`, `createdTime`) VALUES
('wallet_0', 'account_1', 'type_0', '2021-12-14 17:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_wallet`
--

CREATE TABLE `tbl_account_wallet` (
  `walletID` varchar(255) NOT NULL,
  `walletBalance` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account_wallet`
--

INSERT INTO `tbl_account_wallet` (`walletID`, `walletBalance`, `accountID`) VALUES
('wallet29950', '6400', 'user695247'),
('wallet_0', '1250', 'account_1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_log`
--

CREATE TABLE `tbl_activity_log` (
  `logTime` varchar(255) NOT NULL,
  `logName` varchar(255) NOT NULL,
  `logContent` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderID` varchar(255) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `currentStatus` varchar(255) NOT NULL,
  `extraNotes` varchar(255) DEFAULT NULL,
  `customerName` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerEmail` varchar(255) DEFAULT NULL,
  `customerPhone` varchar(255) DEFAULT NULL,
  `paymentID` varchar(255) NOT NULL,
  `voucherID` varchar(255) DEFAULT NULL,
  `totalPrice` int(11) NOT NULL,
  `accountID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `createdTime`, `currentStatus`, `extraNotes`, `customerName`, `customerAddress`, `customerEmail`, `customerPhone`, `paymentID`, `voucherID`, `totalPrice`, `accountID`) VALUES
('202', '2021-12-15 17:11:55', 'Pending', NULL, 'Son Nguyen', '', 'sonnguyen@gmail.com', '0123456789', 'payment_0', 'type_0', 270000, 'user695247'),
('7495', '2021-12-14 18:17:07', 'Pending', NULL, 'Nam Nguyen', 'Ha Noi', 'namnguyen@gmail.com', '0123456789', 'payment_0', NULL, 10000, NULL),
('8077', '2021-12-14 03:38:34', 'Pending', NULL, 'Lam Nguyen', 'Ha Noi', 'lamnguyen@gmail.com', '0868851101', 'payment_0', NULL, 70000, NULL),
('8596', '2021-12-15 17:08:09', 'Pending', NULL, 'Son Nguyen', 'Ha Noi', 'sonnguyen@gmail.com', '0123456789', 'payment_0', NULL, 10000, 'user695247');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `orderID` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL,
  `currentPrice` int(11) NOT NULL,
  `orderedQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`orderID`, `productID`, `currentPrice`, `orderedQuantity`) VALUES
('202', 'product_0', 10000, 30),
('7495', 'product_0', 10000, 1),
('8077', 'product_0', 10000, 3),
('8077', 'product_1', 20000, 2),
('8596', 'product_0', 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `paymentID` varchar(255) NOT NULL,
  `paymentName` varchar(255) NOT NULL,
  `paymentDesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`paymentID`, `paymentName`, `paymentDesc`) VALUES
('payment_0', 'Cash on Delivery (CoD)', 'Pays the bill upon receiving purchase'),
('payment_1', 'PalPal', 'Payment through PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productID` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDesc` varchar(255) DEFAULT NULL,
  `productPrice` int(11) NOT NULL,
  `productStatus` varchar(255) NOT NULL,
  `inventoryQuantity` int(11) NOT NULL,
  `categoryID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productID`, `productName`, `productDesc`, `productPrice`, `productStatus`, `inventoryQuantity`, `categoryID`) VALUES
('product_0', 'Cabbages', 'Ai-chan', 10000, 'Empty', 0, 'category_0'),
('product_1', 'Pumpkin', 'For Halloween', 20000, 'Empty', 0, 'category_0'),
('product_2', 'Cucumber', 'Long', 15000, 'Empty', 0, 'category_0'),
('product_3', 'Tomatoes', 'Red', 10000, 'Empty', 0, 'category_0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `categoryID` varchar(255) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`categoryID`, `categoryName`, `categoryDesc`) VALUES
('category_0', 'Vegetables', 'Green');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_comment`
--

CREATE TABLE `tbl_product_comment` (
  `commentID` varchar(255) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `commentUser` varchar(255) NOT NULL,
  `commentContent` varchar(255) NOT NULL,
  `commentPhone` varchar(10) NOT NULL,
  `commentEmail` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_comment`
--

INSERT INTO `tbl_product_comment` (`commentID`, `createdTime`, `commentUser`, `commentContent`, `commentPhone`, `commentEmail`, `productID`) VALUES
('comment806734', '2021-12-14 03:16:38', 'Lam Nguyen', 'Nice', '0868851101', 'lamnguyen@gmail.com', 'product_0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

CREATE TABLE `tbl_product_images` (
  `imageID` varchar(255) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_images`
--

INSERT INTO `tbl_product_images` (`imageID`, `imageName`, `productID`) VALUES
('img_0', 'verza.jpg', 'product_0'),
('img_1', 'types-of-cabbage.jpg', 'product_0'),
('img_10', 'tomatoes-1296x728-feature.jpg', 'product_3'),
('img_11', 'Tomato_je.jpg', 'product_3'),
('img_2', 'primo-vantage.jpg', 'product_0'),
('img_3', 'Premiumpumpkin@2x.png', 'product_1'),
('img_4', 'download.jpg', 'product_1'),
('img_5', 'pumpkin-3f3d894.jpg', 'product_1'),
('img_6', 'download (2).jpg', 'product_2'),
('img_7', 'download (1).jpg', 'product_2'),
('img_8', 'marketmore-cucumber.jpg', 'product_2'),
('img_9', 'download-371231435.jpg', 'product_3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher_type`
--

CREATE TABLE `tbl_voucher_type` (
  `typeID` varchar(255) NOT NULL,
  `typeName` varchar(255) NOT NULL,
  `typeDesc` varchar(255) DEFAULT NULL,
  `voucherValue` int(11) NOT NULL,
  `voucherCost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_voucher_type`
--

INSERT INTO `tbl_voucher_type` (`typeID`, `typeName`, `typeDesc`, `voucherValue`, `voucherCost`) VALUES
('type_0', '10% all invoices', '10% off, can be applied to all purchases', 10, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet_history`
--

CREATE TABLE `tbl_wallet_history` (
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `historyName` varchar(255) NOT NULL,
  `historyContent` varchar(255) NOT NULL,
  `historyAmount` int(11) NOT NULL,
  `walletID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wallet_history`
--

INSERT INTO `tbl_wallet_history` (`createdTime`, `historyName`, `historyContent`, `historyAmount`, `walletID`) VALUES
('2021-12-14 05:43:00', 'Buy Product', '', 200, 'wallet_0'),
('2021-12-14 05:45:39', 'Buy Product', '', 100, 'wallet_0'),
('2021-12-14 08:48:15', 'Buy Product', '', 300, 'wallet_0'),
('2021-12-14 08:49:22', 'Buy Product', '', 200, 'wallet_0'),
('2021-12-14 08:49:39', 'Buy Product', '', 150, 'wallet_0'),
('2021-12-14 08:53:22', 'Buy Product', '', 100, 'wallet_0'),
('2021-12-14 08:55:00', 'Buy Product', '', 100, 'wallet_0'),
('2021-12-14 08:59:24', 'Buy Product', '', 100, 'wallet_0'),
('2021-12-14 18:48:56', 'Buy Product', '', 3000, 'wallet29950'),
('2021-12-15 16:59:48', 'Buy Product', '', 100, 'wallet29950'),
('2021-12-15 17:00:32', 'Buy Product', '', 100, 'wallet29950'),
('2021-12-15 17:05:31', 'Buy Product', '', 100, 'wallet29950'),
('2021-12-15 17:08:09', 'Buy Product', '', 100, 'wallet29950'),
('2021-12-15 17:11:55', 'Buy Product', '', 3000, 'wallet29950');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `account_role` (`roleID`);

--
-- Indexes for table `tbl_account_role`
--
ALTER TABLE `tbl_account_role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `tbl_account_voucher`
--
ALTER TABLE `tbl_account_voucher`
  ADD PRIMARY KEY (`voucherID`),
  ADD KEY `account_voucher` (`accountID`),
  ADD KEY `voucher_type` (`typeID`);

--
-- Indexes for table `tbl_account_wallet`
--
ALTER TABLE `tbl_account_wallet`
  ADD PRIMARY KEY (`walletID`),
  ADD KEY `account_wallet` (`accountID`);

--
-- Indexes for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD PRIMARY KEY (`logTime`),
  ADD KEY `account_log` (`accountID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `payment_type` (`paymentID`),
  ADD KEY `voucher_applied` (`voucherID`),
  ADD KEY `account_order` (`accountID`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`orderID`,`productID`),
  ADD KEY `product_list` (`productID`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `product_category` (`categoryID`);

--
-- Indexes for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `tbl_product_comment`
--
ALTER TABLE `tbl_product_comment`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `product_images` (`productID`);

--
-- Indexes for table `tbl_voucher_type`
--
ALTER TABLE `tbl_voucher_type`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `tbl_wallet_history`
--
ALTER TABLE `tbl_wallet_history`
  ADD PRIMARY KEY (`createdTime`),
  ADD KEY `wallet_history` (`walletID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD CONSTRAINT `account_role` FOREIGN KEY (`roleID`) REFERENCES `tbl_account_role` (`roleID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_account_voucher`
--
ALTER TABLE `tbl_account_voucher`
  ADD CONSTRAINT `account_voucher` FOREIGN KEY (`accountID`) REFERENCES `tbl_account` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `voucher_type` FOREIGN KEY (`typeID`) REFERENCES `tbl_voucher_type` (`typeID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_account_wallet`
--
ALTER TABLE `tbl_account_wallet`
  ADD CONSTRAINT `account_wallet` FOREIGN KEY (`accountID`) REFERENCES `tbl_account` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD CONSTRAINT `account_log` FOREIGN KEY (`accountID`) REFERENCES `tbl_account` (`accountID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `account_order` FOREIGN KEY (`accountID`) REFERENCES `tbl_account` (`accountID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_type` FOREIGN KEY (`paymentID`) REFERENCES `tbl_payment` (`paymentID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `voucher_applied` FOREIGN KEY (`voucherID`) REFERENCES `tbl_voucher_type` (`typeID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `order_detail` FOREIGN KEY (`orderID`) REFERENCES `tbl_order` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_list` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`categoryID`) REFERENCES `tbl_product_category` (`categoryID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD CONSTRAINT `product_images` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_wallet_history`
--
ALTER TABLE `tbl_wallet_history`
  ADD CONSTRAINT `wallet_history` FOREIGN KEY (`walletID`) REFERENCES `tbl_account_wallet` (`walletID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
