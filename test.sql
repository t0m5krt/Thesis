-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 05:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `office_accounts`
--

CREATE TABLE `office_accounts` (
  `REGISTRATION_ID` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office_accounts`
--

INSERT INTO `office_accounts` (`REGISTRATION_ID`, `firstname`, `lastname`, `username`, `password`, `account_type`, `isDeleted`) VALUES
(4, 'Thomas', 'Pancha', 'pancha.21345', 'password', 'super_admin', 0),
(5, 'admin', 'one', 'admin.12345', 'password', 'admin', 0),
(6, 'employee', 'one', 'employee.12345', 'password', 'employee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_request_status`
--

CREATE TABLE `service_request_status` (
  `STATUS_ID` int(11) NOT NULL,
  `SERVICE_REQUEST_ID` int(11) NOT NULL,
  `STATUS_VALUE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_request_status`
--

INSERT INTO `service_request_status` (`STATUS_ID`, `SERVICE_REQUEST_ID`, `STATUS_VALUE`) VALUES
(1, 17, 'In progress'),
(2, 19, 'In progress'),
(3, 18, 'In progress'),
(4, 0, 'In progress'),
(5, 26, 'In progress'),
(6, 21, 'In progress'),
(7, 23, 'In progress'),
(8, 22, 'In progress'),
(9, 27, 'In progress'),
(10, 28, 'In progress'),
(11, 29, 'In progress'),
(12, 30, 'In progress'),
(13, 31, 'In progress');

-- --------------------------------------------------------

--
-- Table structure for table `submit_requests`
--

CREATE TABLE `submit_requests` (
  `SERVICE_REQUEST_ID` int(11) NOT NULL,
  `sort_value` tinyint(4) NOT NULL,
  `requestor` varchar(255) NOT NULL,
  `date_of_request` date NOT NULL,
  `mobile_or_phone_no` varchar(20) NOT NULL,
  `business_unit` varchar(255) NOT NULL,
  `cust_project_name` varchar(255) NOT NULL,
  `asset_code` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `equip_desc` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `service_meter_reading` varchar(255) NOT NULL,
  `type_of_request` varchar(255) NOT NULL,
  `additional_option` varchar(255) NOT NULL,
  `other_service_request` varchar(255) NOT NULL,
  `charging` varchar(255) NOT NULL,
  `unit_problem` varchar(255) NOT NULL,
  `others` varchar(255) NOT NULL,
  `unit_operational` varchar(255) NOT NULL,
  `specific_requirement` varchar(255) NOT NULL,
  `onsite_contact_person` varchar(255) NOT NULL,
  `fax_no` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_requests`
--

INSERT INTO `submit_requests` (`SERVICE_REQUEST_ID`, `sort_value`, `requestor`, `date_of_request`, `mobile_or_phone_no`, `business_unit`, `cust_project_name`, `asset_code`, `model`, `serial_no`, `equip_desc`, `brand`, `service_meter_reading`, `type_of_request`, `additional_option`, `other_service_request`, `charging`, `unit_problem`, `others`, `unit_operational`, `specific_requirement`, `onsite_contact_person`, `fax_no`, `user_id`) VALUES
(17, 1, 'John Doe', '2023-10-15', '09562138923', 'Qui aliqua Velit fu', 'Ian Zamora', 'Magni rerum officia ', 'Ut deserunt temporib', 'Rem similique rem ul', 'Enim consequuntur un', 'Quis tempore commod', 'Velit eius deleniti ', 'Technical Evaluation Request', '', '', 'Rental', 'Praesentium labore l', 'Ea facere debitis du', 'Yes', 'Veniam aut quas cup', 'Et Nam doloribus ali', '+1 (471) 715-8092', 0),
(18, 4, 'Nisi in soluta conse', '1981-09-18', '11151355252', 'Sit facere do sunt ', 'Marcia Hubbard', 'Est consequuntur ut', 'Dignissimos incididu', 'Nihil odit reprehend', 'Impedit sed dicta i', 'Voluptatibus nisi vo', 'Officia earum offici', 'Service Request', '', '', 'Lease', 'Suscipit sunt ullam', 'Voluptatem hic quia', 'Yes', 'Eum repudiandae rati', 'Vitae labore pariatu', '+1 (495) 266-5332', 0),
(19, 1, 'Quas voluptatibus la', '2023-10-15', '19857932012', 'Quasi deserunt incid', 'Beverly Hawkins', 'Voluptates sunt amet', 'Officiis accusamus v', 'Sit omnis voluptate', 'Aperiam nulla dolore', 'Incidunt suscipit a', 'Aliqua Eum nulla mo', 'Service Request', 'Emergency Call', '', 'Warranty', 'Et quae dolore totam', 'Duis harum non imped', 'No', 'Nostrud ipsa quod i', 'Hic laboris ratione ', '+1 (542) 789-9039', 0),
(21, 4, 'tom', '2023-10-19', '09562165456', 'wasd', 'askdjlk', 'asdkajsd', 'alskdj', 'aklsjd', 'kajslkd', 'aklsjd', 'asdklj', 'Quotation Parts', '', '', 'Rental', 'aklsdklj', 'aklsjdklj', 'Yes', 'aklsjdkasl', 'asdaksldj', 'asdjoi', 0),
(22, 1, 'eeeeeeeee', '2023-10-05', '099893823', 'qwkeoqwjeoi', 'kiqwejiqwjei', 'joiqwjiqwjeioqwjio', 'jeiqwjeqiwejiqwejio', 'jiqwejiqwejiqowe', 'polkqweopq', 'w9ejikqwep', 'jqwiejqwipeqwewq', 'Technical Evaluation Request', '', '', 'Warranty', 'retwertwertwertwert', 'ewrtwertwert', 'Yes', 'werwertwer', 'twertwer', 'wretwret', 0),
(23, 3, 'lorem', '2023-10-19', '0998983322', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'EQC Inspection', '', '', 'Rental', 'lorem', 'lorem', 'Yes', 'lorem', 'lorem', 'lorem', 0),
(26, 2, 'moirel', '2023-10-19', '0894654634', 'moire', 'moire', 'moirel', 'moirel', 'moirel', 'morelkerjqer', 'brand x ', 'ewriwerjewir', 'Quotation - Minor Repair', '', '', 'Lease', 'lorem', 'lorem', 'Yes', 'lorem', 'lorem', 'lorem', 0),
(27, 1, 'JONATHAN', '2023-10-20', '0983222211', 'IPSUM', 'LOREM', 'IPSUM', 'LOREM', 'LOREM IPSUM', 'LOREM IPUSMEW', 'MOKERKER', 'QWEQWEDFADF', 'Technical Evaluation Request', '', '', 'Rental', 'LOREM', 'LOREM', 'Yes', 'LOREM IPSUM', 'LOREM', 'IPSUM', 0),
(28, 4, 'Thomas', '2023-10-19', '090322222', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'Service Request', 'Emergency Call', '', 'Warranty', 'lorem', 'lorem', 'Yes', 'loremn', 'lorem', 'lorem', 0),
(29, 1, 'QWEQWEEWQQWE', '2023-10-19', '09898734423', 'LOREM', 'LOREM', 'LOREM', 'OLOIKREJIWERI', 'LEQWOJIQWEJI', 'LWEQRKOQEW', 'O', 'PQKWOQWKOEQWEKOP', 'Service Request', 'Emergency Call', '', 'Rental', 'LOREM', 'LOWERMNKWERWER', 'No', 'LORMEIKQWEWQE', 'LOWERMWEREWR', 'WERQEQWQWE', 0),
(30, 4, 'thom2222', '2023-10-19', '09493221122', 'lorem', 'lorem', 'lpqweoqwjeio', 'jui', 'lorem', 'lorem', 'lorem', 'lorem', 'Service Request', 'Emergency Call', '', 'Lease', 'polrem', 'lo,asdmflsdaf.', 'Yes', 'qweqwe', 'trsfg', 'sfgsfg', 0),
(31, 1, 'lorem', '2023-10-20', '0990832322', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'loremp', 'pqwelpqweop', 'lorem', 'Technical Evaluation Request', '', '', 'Rental', 'lorem', 'lorem', 'No', 'lorem', 'lorem', 'lorem', 0),
(32, 1, 'lorem', '2023-10-25', '09234923432', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'Service Request', 'Emergency Call', '', 'Warranty', 'lorem', 'lorem', 'No', 'lorem', 'lorem', 'lorme123123', 0),
(33, 2, 'Thomas Pancha', '2023-11-01', '0981231234445', 'Mining', 'project x', 'qweqweqwe', 'qweqweqw', 'eqweqweqwe', 'eqweqwe', 'JCB', '123123123', 'Quotation - Minor Repair', '', '', 'Rental', 'Engine failure', '123123qweasd', 'Yes', 'eadasdqwe', 'qweqwe', '1231245', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `projectname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `firstname`, `lastname`, `companyname`, `projectname`, `email`, `contactnumber`, `password`) VALUES
(1, 'Thomas', 'Pancha', 'QWE', 'EEEE', 'login@gmail.com', '1234567223', '$2y$10$KRjZDkIkT3Y.3ZfTEwGCBuB4YfuWfXDGHhgz2lIfN35/z6mLzhJYO'),
(2, 'Thomas', 'Pancha', 'Company aw3t', 'Project Zero', 'wapwap@gmail.com', '2147483647', '$2y$10$nHURxDdgvyZPeXA.9IsPKOmXlNSs/0R0Td4IWiq9k2YhtHXenbCRi'),
(3, 'Thomas', 'Pancha', 'panypany', 'project x', 't0m5krt@gmail.com', '0981231234445', '$2y$10$.YeqfK94fBt2fFXrmHpH1.TgwVjoviV3V4iHWGxlweNxXVgWQVDVW');

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `SERVICE_REQUEST_ID` int(11) NOT NULL,
  `requestor` varchar(255) NOT NULL,
  `date_of_request` varchar(255) NOT NULL,
  `mobile_or_phone_no` varchar(255) NOT NULL,
  `assign_tech` varchar(255) NOT NULL,
  `assign_date` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`SERVICE_REQUEST_ID`, `requestor`, `date_of_request`, `mobile_or_phone_no`, `assign_tech`, `assign_date`) VALUES
(0, 'Thomas', '2023-10-19', '090322222', 'VAN VIOLA', '2023-10-19 00:00:00.000000'),
(1, 'John Doe', '09/28/2023', '098099322', 'Thomas', '0000-00-00 00:00:00.000000'),
(17, 'John Doe', '2023-10-15', '09562138923', 'Thomas', '2023-10-18 00:00:00.000000'),
(18, 'Nisi in soluta conse', '1981-09-18', '11151355252', 'Thomas', '2023-10-19 00:00:00.000000'),
(19, 'Quas voluptatibus la', '2023-10-15', '19857932012', 'Altes', '2023-10-19 00:00:00.000000'),
(20, 'Thomas', '2023-10-19', '090322222', 'test', '0000-00-00 00:00:00.000000'),
(21, 'tom', '2023-10-19', '09562165456', 'rrrr', '0000-00-00 00:00:00.000000'),
(22, 'eeeeeeeee', '2023-10-05', '099893823', 'lorem', '2023-10-19 00:00:00.000000'),
(23, 'lorem', '2023-10-19', '0998983322', 'altes', '0000-00-00 00:00:00.000000'),
(26, 'moirel', '2023-10-19', '0894654634', 'lorem', '2023-10-19 00:00:00.000000'),
(27, 'JONATHAN', '2023-10-20', '0983222211', 'LOREM', '2023-10-19 00:00:00.000000'),
(28, 'Thomas', '2023-10-19', '090322222', 'KURT', '2023-10-19 00:00:00.000000'),
(29, 'QWEQWEEWQQWE', '2023-10-19', '09898734423', 'HGHCGH', '2023-10-19 00:00:00.000000'),
(30, 'thom2222', '2023-10-19', '09493221122', 'mark', '2023-10-31 00:00:00.000000'),
(31, 'lorem', '2023-10-20', '0990832322', 'l0rem', '2023-10-31 00:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `office_accounts`
--
ALTER TABLE `office_accounts`
  ADD PRIMARY KEY (`REGISTRATION_ID`);

--
-- Indexes for table `service_request_status`
--
ALTER TABLE `service_request_status`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indexes for table `submit_requests`
--
ALTER TABLE `submit_requests`
  ADD PRIMARY KEY (`SERVICE_REQUEST_ID`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`SERVICE_REQUEST_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `office_accounts`
--
ALTER TABLE `office_accounts`
  MODIFY `REGISTRATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_request_status`
--
ALTER TABLE `service_request_status`
  MODIFY `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `submit_requests`
--
ALTER TABLE `submit_requests`
  MODIFY `SERVICE_REQUEST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
