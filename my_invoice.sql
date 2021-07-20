-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 06:47 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` text NOT NULL,
  `bank_name` text NOT NULL,
  `account_no` text NOT NULL,
  `cnfrm_account_no` text NOT NULL,
  `ifsc` text NOT NULL,
  `account_type` text NOT NULL,
  `account_holder` text NOT NULL,
  `phone` text NOT NULL,
  `upi_id` text NOT NULL,
  `paytm_id` text NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `bank_insert` int(11) NOT NULL,
  `bank_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `country`, `bank_name`, `account_no`, `cnfrm_account_no`, `ifsc`, `account_type`, `account_holder`, `phone`, `upi_id`, `paytm_id`, `invoice_id`, `bank_insert`, `bank_update`) VALUES
(1, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya', '8476069655', '', '', 1, 1624522215, 1624522215),
(2, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya', '8476069655', '', '', 2, 1624522548, 1624522548),
(3, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 0, 1624599024, 1624599024),
(4, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 7, 1624942602, 1624942602),
(5, 4, 'IN', 'HDFC', '7342689234', '734268923444', 'sd2343', 'current', 'Priya', '84760-69655', 'upi@okhdfc', 'paytm@okpaytm', 9, 1625561145, 1625561145),
(6, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 10, 1625567930, 1625567930),
(7, 1, 'IN', 'HDFC', '', '', '', 'current', 'Priya P', '8476069655', '', '', 11, 1625570630, 1625570630),
(8, 1, 'IN', 'HDFC', '', '', '', 'current', 'Priya P', '8476069655', '', '', 12, 1625572382, 1625572382),
(9, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 13, 1625576598, 1625576598),
(10, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 0, 1625579191, 1625579191),
(11, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 0, 1625579566, 1625579566),
(12, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 0, 1625580060, 1625580060),
(13, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 15, 1625580445, 1625580445),
(14, 1, 'IN', 'HDFC', '', '', '', 'current', 'Priya P', '8476069655', '', '', 16, 1625581597, 1625581597),
(15, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 18, 1625650743, 1625650743),
(16, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 19, 1625805587, 1625805587),
(17, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 20, 1625805795, 1625805795),
(18, 1, 'IN', 'HDFC', '', '', '', 'saving', 'Priya P', '8476069655', '', '', 21, 1625807954, 1625807954);

-- --------------------------------------------------------

--
-- Table structure for table `deals_user_master`
--

CREATE TABLE `deals_user_master` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_address` text DEFAULT NULL,
  `admin_telnumber` varchar(50) DEFAULT NULL,
  `admin_faxnumber` varchar(50) DEFAULT NULL,
  `admin_postalcode` varchar(50) DEFAULT NULL,
  `admin_mobile` varchar(50) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `admin_emailid` varchar(150) DEFAULT NULL,
  `admin_entry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_status` tinyint(4) NOT NULL DEFAULT 0,
  `admin_navigation` longblob DEFAULT NULL,
  `admin_navvalue` varchar(255) DEFAULT NULL,
  `admin_currency` varchar(256) DEFAULT NULL,
  `admin_domain` varchar(512) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deals_user_master`
--

INSERT INTO `deals_user_master` (`admin_id`, `admin_name`, `admin_address`, `admin_telnumber`, `admin_faxnumber`, `admin_postalcode`, `admin_mobile`, `admin_password`, `admin_emailid`, `admin_entry_date`, `admin_update_date`, `user_last_login`, `admin_status`, `admin_navigation`, `admin_navvalue`, `admin_currency`, `admin_domain`) VALUES
(1, 'admin', 'Gurgaon', '9910068028', '', '201303', '7982959619', 'e10adc3949ba59abbe56e057f20f883e', 'login@admin.com', '2013-06-04 19:16:34', '2015-05-27 12:10:42', '2014-10-31 19:06:29', 1, 0x3c6c69203e3c6120687265663d22687474703a2f2f6d6f626173737572652e636f6d2f7075626c69632f7072696365757365722f61612f6272616e642f3f6e617669643d3122203e3c7370616e3e4272616e643c2f7370616e3e3c2f613e3c2f6c693e3c6c69203e3c6120687265663d22687474703a2f2f6d6f626173737572652e636f6d2f7075626c69632f7072696365757365722f61612f70726f647563742f3f6e617669643d3322203e3c7370616e3e50726f647563743c2f7370616e3e3c2f613e3c2f6c693e3c6c69203e3c6120687265663d22687474703a2f2f6d6f626173737572652e636f6d2f7075626c69632f7072696365757365722f61612f73746f72652f3f6e617669643d3222203e3c7370616e3e53746f72653c2f7370616e3e3c2f613e3c2f6c693e, '', NULL, NULL),
(8, 'gaurav tyagi', 'gauravtyagi@mmm.com', NULL, NULL, NULL, '544545454545', 'e10adc3949ba59abbe56e057f20f883e', 'gauravtyagi@mmm.com', '2019-06-12 10:25:53', '2019-06-12 15:55:53', '0000-00-00 00:00:00', 1, NULL, NULL, 'ewe', 'gauravtyagi@mmm.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_client_details`
--

CREATE TABLE `invoice_client_details` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `client_country` text NOT NULL,
  `client_name` varchar(250) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_mobile` int(10) NOT NULL,
  `client_gstin` varchar(20) NOT NULL,
  `client_pan_no` varchar(20) NOT NULL,
  `client_street_address` text NOT NULL,
  `client_state` text NOT NULL,
  `client_city` text NOT NULL,
  `client_zip_code` int(10) NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `client_insert` int(11) NOT NULL,
  `client_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_client_details`
--

INSERT INTO `invoice_client_details` (`order_id`, `user_id`, `order_date`, `client_country`, `client_name`, `client_email`, `client_mobile`, `client_gstin`, `client_pan_no`, `client_street_address`, `client_state`, `client_city`, `client_zip_code`, `invoice_id`, `client_insert`, `client_update`) VALUES
(1, 1, '2021-06-24 08:10:15', 'India', 'Zone M', 'zonemedia@gmail.com', 1234567890, '', '', 'Udyog Vihar', 'Haryana', 'Gurgoan', 122001, 0, 0, 1625561269),
(2, 1, '2021-06-24 08:14:59', 'India', 'Techie World', 'tech@gmail.com', 1234567890, '', '', 'Udyog Vihar', 'Gujarat', 'Gurgoan', 122001, 0, 0, 1624523632),
(3, 1, '2021-06-25 05:17:25', 'India', 'Samsung', 'ss@gmail.com', 1234567890, '05ABDCE1234F1Z2', 'ABCDE1234F', 'Udyog Vihar', 'Andhra Pradesh', 'Gurgoan', 122001, 0, 1624598169, 1624598169),
(4, 1, '2021-06-28 09:18:01', 'India', 'tech', 'tech@gmail.com', 1234567890, '', '', 'Udyog Vihar', 'Haryana', 'Gurgoan', 122001, 0, 1624871802, 1624871802),
(5, 1, '2021-06-28 09:20:23', 'India', 'tech', 'tech@gmail.com', 1234567890, '', '', 'Udyog Vihar', 'Haryana', 'Gurgoan', 122001, 0, 1624871802, 1624871802),
(6, 4, '2021-07-06 08:44:16', 'Pakistan', 'Zone', 'zone@gmail.com', 1234567890, '', '', 'Udyog Vihar', 'Haryana', 'Gurgoan', 122001, 0, 1625560985, 1625560985);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `invoice_date` text NOT NULL,
  `due_date` text NOT NULL,
  `user_address` int(11) NOT NULL DEFAULT 0,
  `client_address` int(11) NOT NULL DEFAULT 0,
  `order_total_before_tax` decimal(10,0) NOT NULL,
  `order_total_tax` decimal(10,0) NOT NULL,
  `order_tax_per` varchar(250) NOT NULL,
  `order_total_after_tax` double NOT NULL,
  `order_amount_paid` double NOT NULL,
  `order_total_amount_due` double NOT NULL,
  `gst` varchar(50) NOT NULL,
  `invoice_insert` int(11) NOT NULL,
  `invoice_update` int(11) NOT NULL,
  `condition_desc` varchar(250) NOT NULL,
  `note_name` varchar(250) NOT NULL,
  `note` varchar(250) NOT NULL,
  `add_more` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`order_id`, `user_id`, `invoice_no`, `invoice_date`, `due_date`, `user_address`, `client_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `gst`, `invoice_insert`, `invoice_update`, `condition_desc`, `note_name`, `note`, `add_more`) VALUES
(1, 1, '00001', '06/24/2021', '07/10/2021', 1, 1, '15000', '2700', '18', 17700, 0, 17700, 'CGST&IGST', 1624522297, 1625561269, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.', '', '', ''),
(2, 1, '00002', '06/24/2021', '07/09/2021', 1, 2, '4800', '864', '18', 5664, 0, 5664, 'IGST', 1624522521, 1624523632, '', '', '', ''),
(3, 1, '00003', '06/25/2021', '07/10/2021', 2, 2, '10000', '1800', '18', 11800, 0, 11800, 'IGST', 1624596622, 1624596622, '', '', '', ''),
(4, 1, '00004', '06/25/2021', '07/10/2021', 1, 1, '4400', '792', '18', 5192, 0, 5192, 'CGST&IGST', 1624597694, 1624597694, '', '', '', ''),
(5, 1, '00005', '06/25/2021', '07/10/2021', 4, 3, '13000', '2340', '18', 15340, 0, 15340, 'IGST', 1624598308, 1624598308, '', '', '', ''),
(6, 1, '00006', '06/25/2021', '07/10/2021', 2, 2, '9130', '1643', '18', 10773.4, 0, 10773.4, 'IGST', 1624598548, 1624598548, '', '', '', ''),
(7, 1, '00007', '06/28/2021', '07/13/2021', 0, 5, '4000', '720', '18', 4720, 0, 4720, 'CGST&IGST', 1624871802, 1624871802, '', '', '', ''),
(8, 1, '00008', '06/29/2021', '07/14/2021', 4, 3, '6000', '1080', '18', 7080, 0, 7080, 'IGST', 1624942622, 1624942622, '', '', '', ''),
(9, 4, '00001', '07/06/2021', '07/21/2021', 0, 6, '10000', '1800', '18', 11800, 0, 11800, 'CGST&IGST', 1625560985, 1625560985, '', '', '', ''),
(10, 1, '00009', '07/06/2021', '07/21/2021', 3, 3, '800', '0', '', 800, 0, 800, 'IGST', 1625567869, 1625567869, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', 'Hiiiiiii', ''),
(11, 1, '00010', '07/06/2021', '07/21/2021', 4, 5, '8000', '1440', '18', 9440, 0, 9440, 'IGST', 1625570583, 1625570583, 'Terms and Conditions\r\n1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', 'HahA...', ''),
(12, 1, '00011', '07/06/2021', '07/21/2021', 2, 3, '10000', '1800', '18', 11800, 0, 11800, 'IGST', 1625571717, 1625571717, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', 'sdf', ''),
(13, 1, '00012', '07/06/2021', '07/21/2021', 3, 3, '4000', '0', '', 4000, 0, 4000, 'IGST', 1625576550, 1625576550, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', '', ''),
(14, 1, '00013', '07/06/2021', '07/21/2021', 4, 4, '1000', '180', '18', 1180, 0, 1180, 'IGST', 1625580176, 1625580176, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', '', 'a:3:{i:0;a:1:{s:4:\"New1\";s:2:\"PP\";}i:1;a:1:{s:3:\"New\";s:2:\"PP\";}i:2;a:1:{s:0:\"\";s:0:\"\";}}'),
(15, 1, '00013', '07/06/2021', '07/21/2021', 4, 4, '1000', '180', '18', 1180, 0, 1180, 'IGST', 1625580176, 1625580176, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', '', 'a:3:{i:0;a:1:{s:4:\"New1\";s:2:\"PP\";}i:1;a:1:{s:3:\"New\";s:2:\"PP\";}i:2;a:1:{s:0:\"\";s:0:\"\";}}'),
(16, 1, '00014', '07/06/2021', '07/21/2021', 4, 5, '1000', '180', '18', 1180, 0, 1180, 'IGST', 1625581549, 1625581549, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', '', 'a:2:{i:0;a:1:{s:6:\"label2\";s:4:\"LBL2\";}i:1;a:1:{s:6:\"label1\";s:4:\"LBL1\";}}'),
(18, 1, '00015', '07/07/2021', '07/22/2021', 3, 3, '9000', '0', '', 9000, 0, 9000, 'IGST', 1625650646, 1625650646, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n3.Hi this is for test.\r\n						', '', 'Heya!!!', 'a:1:{i:0;a:1:{s:10:\"Invoice Sr\";s:4:\"7896\";}}'),
(19, 1, '00016', '07/09/2021', '07/24/2021', 2, 2, '800', '144', '18', 944, 0, 944, 'IGST', 1625805550, 1625805550, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', 'Pppppppppppppppppppp', 'a:0:{}'),
(20, 1, '00017', '07/09/2021', '07/24/2021', 4, 5, '1000', '180', '18', 1180, 0, 1180, 'IGST', 1625805766, 1625805766, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n						', '', 'Hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', 'a:0:{}'),
(21, 1, '00018', '07/09/2021', '07/24/2021', 3, 3, '8000', '0', '', 8000, 0, 8000, 'IGST', 1625807914, 1625807914, '1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\r\n2.Please quote invoice number when remitting funds.\r\n', '', 'ppppppp', 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_service_details`
--

CREATE TABLE `invoice_service_details` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL,
  `service_description` text NOT NULL,
  `service_insert` int(11) NOT NULL,
  `service_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_service_details`
--

INSERT INTO `invoice_service_details` (`order_item_id`, `order_id`, `user_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`, `service_description`, `service_insert`, `service_update`) VALUES
(8, 0, 1, '1', 'Youtube', '2.00', '5000.00', '10000.00', '', 1624596622, 1624596622),
(9, 0, 1, '1', 'Twitter', '4.00', '1100.00', '4400.00', '', 1624597694, 1624597694),
(10, 0, 1, '1', 'Instagram', '1.00', '5000.00', '5000.00', '', 1624598308, 1624598308),
(11, 0, 1, '2', 'Youtube', '2.00', '4000.00', '8000.00', '', 1624598308, 1624598308),
(12, 0, 1, '1', 'Youtube', '2.00', '4565.00', '9130.00', '', 1624598548, 1624598548),
(13, 7, 1, '1', 'Instagram', '2.00', '2000.00', '4000.00', 'ffgdg', 1624871802, 1624871802),
(14, 8, 1, '1', 'Twitter', '2.00', '3000.00', '6000.00', '', 1624942622, 1624942622),
(15, 9, 4, '1', 'Instagram', '2.00', '5000.00', '10000.00', 'dfssdfsg', 1625560985, 1625560985),
(16, 10, 1, '1', 'Youtube', '2.00', '400.00', '800.00', 'gshdgsh', 1625567869, 1625567869),
(17, 11, 1, '1', 'Youtube', '2.00', '4000.00', '8000.00', 'gfffft', 1625570583, 1625570583),
(18, 12, 1, '1', 'Youtube', '2.00', '5000.00', '10000.00', 'dsfdf', 1625571717, 1625571717),
(19, 13, 1, '1', 'Youtube', '2.00', '2000.00', '4000.00', 'fgfghhhhhhhh', 1625576550, 1625576550),
(20, 0, 1, '1', 'Youtube', '2.00', '2000.00', '4000.00', '', 1625577302, 1625577302),
(21, 0, 1, '1', 'Instagram', '2.00', '2000.00', '4000.00', '', 1625579408, 1625579408),
(22, 0, 1, '1', 'Youtube', '2.00', '400.00', '800.00', '', 1625579684, 1625579684),
(23, 0, 1, '1', 'Youtube', '2.00', '400.00', '800.00', '', 1625579684, 1625579684),
(24, 0, 1, '1', 'Youtube', '2.00', '400.00', '800.00', '', 1625579684, 1625579684),
(25, 15, 1, '1', 'Instagram', '2.00', '500.00', '1000.00', '', 1625580176, 1625580176),
(26, 16, 1, '1', 'Twitter', '2.00', '500.00', '1000.00', '', 1625581549, 1625581549),
(28, 18, 1, '1', 'Youtube', '3.00', '3000.00', '9000.00', 'Ppppppppp', 1625650646, 1625650646),
(29, 19, 1, '1', 'Instagram', '2.00', '400.00', '800.00', '', 1625805550, 1625805550),
(30, 20, 1, '1', 'Instagram', '2.00', '500.00', '1000.00', 'hhhhhhhhhhhhhhhhhhhh', 1625805766, 1625805766),
(31, 21, 1, '1', 'Youtube', '2.00', '4000.00', '8000.00', 'ghhhh', 1625807914, 1625807914);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_user_details`
--

CREATE TABLE `invoice_user_details` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `user` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `gstin` varchar(10) NOT NULL,
  `pan_no` text NOT NULL,
  `street_address` text NOT NULL,
  `gst_state` text NOT NULL,
  `city` text NOT NULL,
  `zip_code` int(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `user_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_user_details`
--

INSERT INTO `invoice_user_details` (`order_id`, `user_id`, `country`, `user`, `email`, `mobile`, `gstin`, `pan_no`, `street_address`, `gst_state`, `city`, `zip_code`, `user_insert`, `user_update`) VALUES
(1, 1, 'India', 'Priya P', 'priya@mail.com', 8476069655, '05ABDCE123', 'ABCDE1234F', 'Kanhai', 'Haryana', 'gurgoan', 122001, 0, 1625561269),
(2, 1, 'India', 'Priya', 'priya@mail.com', 8476069655, '05ABDCE123', 'ABCDE1234F', 'Kanhai', 'Haryana', 'gurgoan', 122001, 0, 1624523632),
(3, 1, 'India', 'Priya', 'priya@mail.com', 8476069655, '', '', 'Kanhai', 'Haryana', 'gurgoan', 122001, 1624545034, 1624545034),
(4, 1, 'India', 'Pia', 'pia@gmail.com', 8758984656, '05ABDCE123', 'ABCDE1234F', 'fgdgf', 'Chandigarh', 'trregr', 234335, 1624597832, 1624597832);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `users_insert` int(11) NOT NULL,
  `users_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `users_insert`, `users_update`) VALUES
(1, 'Priya', '12345', '2021-06-24 08:08:35', 1624522109, 1624522109),
(2, 'Avika', '12345', '2021-06-25 07:07:54', 1624604867, 1624604867),
(3, 'Avika', '123456', '2021-06-25 07:08:00', 1624604874, 1624604874),
(4, 'Priya', '123456', '2021-07-06 08:36:34', 1625560587, 1625560587);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals_user_master`
--
ALTER TABLE `deals_user_master`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `invoice_client_details`
--
ALTER TABLE `invoice_client_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `invoice_service_details`
--
ALTER TABLE `invoice_service_details`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `invoice_user_details`
--
ALTER TABLE `invoice_user_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `deals_user_master`
--
ALTER TABLE `deals_user_master`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice_client_details`
--
ALTER TABLE `invoice_client_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `invoice_service_details`
--
ALTER TABLE `invoice_service_details`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `invoice_user_details`
--
ALTER TABLE `invoice_user_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
