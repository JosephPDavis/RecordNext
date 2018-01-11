-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2018 at 05:29 PM
-- Server version: 5.7.18
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_medicalrecords`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'admin id from user table where role =1',
  `admin_share` float(7,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` int(4) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `user_id`, `admin_share`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 1, 5.00, 1, 0, '2017-12-25 05:52:41', '2017-12-25 05:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'from user table',
  `customer_id` varchar(250) NOT NULL,
  `cc_no` varchar(50) NOT NULL,
  `name_on_card` varchar(250) NOT NULL,
  `exp_month` varchar(50) NOT NULL,
  `exp_year` varchar(50) NOT NULL,
  `payment_key` varchar(250) DEFAULT NULL,
  `default_card` enum('Y','N') DEFAULT 'N',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=>active,0=>inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`id`, `user_id`, `customer_id`, `cc_no`, `name_on_card`, `exp_month`, `exp_year`, `payment_key`, `default_card`, `created_by`, `modified_by`, `created`, `modified`, `status`) VALUES
(1, 21, 'cus_BrA9ky8oQNLLBs', '1111', 'snehag', '12', '2020', NULL, 'N', 21, NULL, '2017-11-29 09:26:08', '2017-11-29 09:26:08', 1),
(2, 21, 'cus_BrAC7W3zqFofZH', '1111', 'snehag', '12', '2020', NULL, 'Y', 21, NULL, '2017-11-29 09:28:52', '2017-11-29 09:28:52', 1),
(3, 21, 'cus_Brd9zREvarTfVv', '2222', 'gdsgdg', '4', '2020', NULL, 'N', 21, NULL, '2017-11-30 15:24:23', '2017-11-30 15:24:23', 1),
(4, 92, 'cus_Bt33OP20P31Ag3', '1111', 'Bhushan Chandel', '12', '2020', NULL, 'Y', 92, NULL, '2017-12-04 10:13:46', '2017-12-04 10:13:46', 1),
(5, 92, 'cus_BuFXpZV2RsVkYU', '5100', 'qwerty', '12', '2020', NULL, 'N', 92, NULL, '2017-12-07 15:12:30', '2017-12-07 15:12:30', 1),
(6, 92, 'cus_BuH8yzH6H4gFJu', '1881', 'card three', '12', '2020', NULL, 'N', 92, NULL, '2017-12-07 16:51:30', '2017-12-07 16:51:30', 1),
(7, 92, 'cus_BuH9aIDE8yizBo', '1881', 'card three', '12', '2020', NULL, 'N', 92, NULL, '2017-12-07 16:51:51', '2017-12-07 16:51:51', 1),
(8, 96, 'cus_BuayVhmbFbrnCn', '5100', 'american expresss', '12', '2020', NULL, 'N', 96, NULL, '2017-12-08 13:21:09', '2017-12-08 13:21:09', 1),
(9, 99, 'cus_BwjShjd1RcObsw', '4444', 'kamlesh katolkar', '12', '2020', NULL, 'N', 99, NULL, '2017-12-14 06:15:05', '2017-12-14 06:15:05', 1),
(10, 1, 'cus_BxFHq5uTXEDE9Z', '1111', 'Snehag', '12', '2020', NULL, 'Y', 1, NULL, '2017-12-15 15:08:16', '2017-12-15 15:08:16', 1),
(11, 3, 'cus_ByKhCgUU8hAUkB', '0005', 'test', '12', '2020', NULL, 'N', 3, NULL, '2017-12-18 12:48:17', '2017-12-18 12:48:17', 1),
(12, 74, 'cus_BzqYzEPPGFQzsE', '1111', 'Sneha G', '12', '2020', NULL, 'N', 74, NULL, '2017-12-22 13:47:14', '2017-12-22 13:47:14', 1),
(13, 3, 'cus_C1bZbfDIRNrGwa', '1111', 'sneha gosewade', '12', '2020', NULL, 'N', 3, NULL, '2017-12-27 06:25:47', '2017-12-27 06:25:47', 1),
(14, 77, 'cus_C52AGaruLHanZb', '4242', 'sneha gosewade', '11', '2021', NULL, 'N', 77, NULL, '2018-01-05 10:07:12', '2018-01-05 10:07:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(6) NOT NULL,
  `user_id` bigint(11) NOT NULL COMMENT 'from users table, by whom this client has been added',
  `client_number` varchar(20) DEFAULT NULL,
  `client_name` varchar(250) NOT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=>active,0=>inactive',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>not deleted,1=>deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `client_number`, `client_name`, `first_name`, `last_name`, `created`, `modified`, `status`, `is_deleted`) VALUES
(1, 3, '123456', 'Microsoft', NULL, NULL, '2017-12-21 14:29:32', '2017-12-21 14:29:32', 1, 0),
(2, 3, '987654', 'McDonalds', NULL, NULL, '2017-12-21 14:29:33', '2017-12-21 14:29:33', 1, 0),
(3, 3, '5787', 'testclientname', 'testfirstname', 'testlastname', '2017-12-22 11:53:13', '2017-12-22 11:53:13', 1, 0),
(4, 74, '123', 'CL123', 'Sneha', 'Gosewade', '2017-12-22 13:46:32', '2017-12-22 13:46:32', 1, 0),
(6, 3, '555', 'CL555', 'qwerty', 'qwerty', '2017-12-26 05:16:24', '2017-12-26 05:16:24', 1, 0),
(7, 3, '66', 'CL66', 'qwerty', 'qwerty', '2017-12-26 05:24:57', '2017-12-26 05:24:57', 1, 0),
(9, 3, '1111', 'clinetnew', 'testname', 'testname', '2017-12-26 06:39:32', '2017-12-26 06:39:32', 1, 0),
(12, 3, 'undefined', 'undefined', 'Sneha', 'Gosewade', '2017-12-27 07:36:47', '2017-12-27 07:36:47', 1, 0),
(13, 77, '123', 'CL123', 'Sneha', 'Gosewade', '2018-01-03 13:38:30', '2018-01-03 13:38:30', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country_id` tinyint(4) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `fax_no` varchar(15) DEFAULT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user id who created this company from users table',
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL COMMENT '1=>deleted,0=>inactive',
  `is_deleted` tinyint(4) NOT NULL COMMENT '0=>not deleted, 1=>deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>deleted,0=>not deleted',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>inactive',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `email`, `message`, `is_deleted`, `status`, `created`, `modified`) VALUES
(1, 'test', 'test_provider@yopmail.com', 'test', 0, 1, NULL, NULL),
(3, 'full test', 'teju@yopmail.com', 'fdsssdgg', 0, 1, NULL, NULL),
(4, 'ghffg', 'swati12@yopmail.com', 'gfgf', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `FIPS104` varchar(2) NOT NULL,
  `ISO2` varchar(2) NOT NULL,
  `ISO3` varchar(3) NOT NULL,
  `ISON` varchar(4) NOT NULL,
  `Internet` varchar(2) NOT NULL,
  `Capital` varchar(25) DEFAULT NULL,
  `MapReference` varchar(50) DEFAULT NULL,
  `NationalitySingular` varchar(35) DEFAULT NULL,
  `NationalityPlural` varchar(35) DEFAULT NULL,
  `Currency` varchar(30) DEFAULT NULL,
  `CurrencyCode` varchar(3) DEFAULT NULL,
  `Population` bigint(20) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_upd_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `FIPS104`, `ISO2`, `ISO3`, `ISON`, `Internet`, `Capital`, `MapReference`, `NationalitySingular`, `NationalityPlural`, `Currency`, `CurrencyCode`, `Population`, `Title`, `Comment`, `status`, `is_deleted`, `create_date`, `last_upd_date`) VALUES
(0, 'United States', 'US', 'US', 'USA', '840', 'US', 'Washington, DC ', 'North America ', 'American', 'Americans', 'US Dollar', 'USD', 278058881, 'The United States', '', 1, 0, '2015-10-28 00:00:00', '2018-01-03 10:50:49'),
(1, 'Afghanistan', 'AF', 'AF', 'AFG', '4', 'AF', 'Kabul ', 'Asia ', 'Afghan', 'Afghans', 'Afghani', 'AFA', 26813057, 'Afghanistan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-28 11:14:52'),
(2, 'Albania', 'AL', 'AL', 'ALB', '8', 'AL', 'Tirana ', 'Europe ', 'Albanian', 'Albanians', 'Lek', 'ALL', 3510484, 'Albania', '', 1, 0, '2015-10-28 00:00:00', '2015-10-28 11:15:04'),
(3, 'Algeria', 'AG', 'DZ', 'DZA', '12', 'DZ', 'Algiers ', 'Africa ', 'Algerian', 'Algerians', 'Algerian Dinar', 'DZD', 31736053, 'Algeria', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(4, 'American Samoa', 'AQ', 'AS', 'ASM', '16', 'AS', 'Pago Pago ', 'Oceania ', 'American Samoan', 'American Samoans', 'US Dollar', 'USD', 67084, 'American Samoa', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(5, 'Andorra', 'AN', 'AD', 'AND', '20', 'AD', 'Andorra la Vella ', 'Europe ', 'Andorran', 'Andorrans', 'Euro', 'EUR', 67627, 'Andorra', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(6, 'Angola', 'AO', 'AO', 'AGO', '24', 'AO', 'Luanda ', 'Africa ', 'Angolan', 'Angolans', 'Kwanza', 'AOA', 10366031, 'Angola', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(7, 'Anguilla', 'AV', 'AI', 'AIA', '660', 'AI', 'The Valley ', 'Central America and the Caribbean ', 'Anguillan', 'Anguillans', 'East Caribbean Dollar', 'XCD', 12132, 'Anguilla', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(8, 'Antarctica', 'AY', 'AQ', 'ATA', '10', 'AQ', '', 'Antarctic Region ', '', '', '', '', 0, 'Antarctica', 'ISO defines as the territory south of 60 degrees south latitude', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(9, 'Antigua and Barbuda', 'AC', 'AG', 'ATG', '28', 'AG', 'Saint John\'s ', 'Central America and the Caribbean ', 'Antiguan and Barbudan', 'Antiguans and Barbudans', 'East Caribbean Dollar', 'XCD', 66970, 'Antigua and Barbuda', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(10, 'Argentina', 'AR', 'AR', 'ARG', '32', 'AR', 'Buenos Aires ', 'South America ', 'Argentine', 'Argentines', 'Argentine Peso', 'ARS', 37384816, 'Argentina', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(11, 'Armenia', 'AM', 'AM', 'ARM', '51', 'AM', 'Yerevan ', 'Commonwealth of Independent States ', 'Armenian', 'Armenians', 'Armenian Dram', 'AMD', 3336100, 'Armenia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(12, 'Aruba', 'AA', 'AW', 'ABW', '533', 'AW', 'Oranjestad ', 'Central America and the Caribbean ', 'Aruban', 'Arubans', 'Aruban Guilder', 'AWG', 70007, 'Aruba', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(13, 'Ashmore and Cartier', 'AT', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'Ashmore and Cartier', 'ISO includes with Australia', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(14, 'Australia', 'AS', 'AU', 'AUS', '36', 'AU', 'Canberra ', 'Oceania ', 'Australian', 'Australians', 'Australian dollar', 'AUD', 19357594, 'Australia', 'ISO includes Ashmore and Cartier Islands,Coral Sea Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(15, 'Austria', 'AU', 'AT', 'AUT', '40', 'AT', 'Vienna ', 'Europe ', 'Austrian', 'Austrians', 'Euro', 'EUR', 8150835, 'Austria', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(16, 'Azerbaijan', 'AJ', 'AZ', 'AZE', '31', 'AZ', 'Baku (Baki) ', 'Commonwealth of Independent States ', 'Azerbaijani', 'Azerbaijanis', 'Azerbaijani Manat', 'AZM', 7771092, 'Azerbaijan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(17, 'The Bahamas', 'BF', 'BS', 'BHS', '44', 'BS', 'Nassau ', 'Central America and the Caribbean ', 'Bahamian', 'Bahamians', 'Bahamian Dollar', 'BSD', 297852, 'The Bahamas', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(18, 'Bahrain', 'BA', 'BH', 'BHR', '48', 'BH', 'Manama ', 'Middle East ', 'Bahraini', 'Bahrainis', 'Bahraini Dinar', 'BHD', 645361, 'Bahrain', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(19, 'Baker Island', 'FQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Baker Island', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(20, 'Bangladesh', 'BG', 'BD', 'BGD', '50', 'BD', 'Dhaka ', 'Asia ', 'Bangladeshi', 'Bangladeshis', 'Taka', 'BDT', 131269860, 'Bangladesh', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(21, 'Barbados', 'BB', 'BB', 'BRB', '52', 'BB', 'Bridgetown ', 'Central America and the Caribbean ', 'Barbadian', 'Barbadians', 'Barbados Dollar', 'BBD', 275330, 'Barbados', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(22, 'Bassas da India', 'BS', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Bassas da India', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(23, 'Belarus', 'BO', 'BY', 'BLR', '112', 'BY', 'Minsk ', 'Commonwealth of Independent States ', 'Belarusian', 'Belarusians', 'Belarussian Ruble', 'BYR', 10350194, 'Belarus', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(24, 'Belgium', 'BE', 'BE', 'BEL', '56', 'BE', 'Brussels ', 'Europe ', 'Belgian', 'Belgians', 'Euro', 'EUR', 10258762, 'Belgium', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(25, 'Belize', 'BH', 'BZ', 'BLZ', '84', 'BZ', 'Belmopan ', 'Central America and the Caribbean ', 'Belizean', 'Belizeans', 'Belize Dollar', 'BZD', 256062, 'Belize', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(26, 'Benin', 'BN', 'BJ', 'BEN', '204', 'BJ', 'Porto-Novo  ', 'Africa ', 'Beninese', 'Beninese', 'CFA Franc BCEAO', 'XOF', 6590782, 'Benin', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(27, 'Bermuda', 'BD', 'BM', 'BMU', '60', 'BM', 'Hamilton ', 'North America ', 'Bermudian', 'Bermudians', 'Bermudian Dollar', 'BMD', 63503, 'Bermuda', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(28, 'Bhutan', 'BT', 'BT', 'BTN', '64', 'BT', 'Thimphu ', 'Asia ', 'Bhutanese', 'Bhutanese', 'Ngultrum', 'BTN', 2049412, 'Bhutan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(29, 'Bolivia', 'BL', 'BO', 'BOL', '68', 'BO', 'La Paz /Sucre ', 'South America ', 'Bolivian', 'Bolivians', 'Boliviano', 'BOB', 8300463, 'Bolivia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(30, 'Bosnia and Herzegovina', 'BK', 'BA', 'BIH', '70', 'BA', 'Sarajevo ', 'Bosnia and Herzegovina, Europe ', 'Bosnian and Herzegovinian', 'Bosnians and Herzegovinians', 'Convertible Marka', 'BAM', 3922205, 'Bosnia and Herzegovina', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(31, 'Botswana', 'BC', 'BW', 'BWA', '72', 'BW', 'Gaborone ', 'Africa ', 'Motswana', 'Batswana', 'Pula', 'BWP', 1586119, 'Botswana', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(32, 'Bouvet Island', 'BV', 'BV', 'BVT', '74', 'BV', '', 'Antarctic Region ', '', '', 'Norwegian Krone', 'NOK', 0, 'Bouvet Island', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(33, 'Brazil', 'BR', 'BR', 'BRA', '76', 'BR', 'Brasilia ', 'South America ', 'Brazilian', 'Brazilians', 'Brazilian Real', 'BRL', 174468575, 'Brazil', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(34, 'British Indian Ocean Territory', 'IO', 'IO', 'IOT', '86', 'IO', '', 'World ', '', '', 'US Dollar', 'USD', 0, 'The British Indian Ocean Territory', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(35, 'British Virgin Islands', 'VI', 'VG', 'VGB', '92', 'VG', 'Road Town ', 'Central America and the Caribbean ', 'British Virgin Islander', 'British Virgin Islanders', 'US Dollar', 'USD', 20812, 'The British Virgin Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(36, 'Brunei Darussalam', 'BX', 'BN', 'BRN', '96', 'BN', '', '', '', '', 'Brunei Dollar', 'BND', 372361, 'Brunei', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(37, 'Bulgaria', 'BU', 'BG', 'BGR', '100', 'BG', 'Sofia ', 'Europe ', 'Bulgarian', 'Bulgarians', 'Lev', 'BGN', 7707495, 'Bulgaria', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(38, 'Burkina Faso', 'UV', 'BF', 'BFA', '854', 'BF', 'Ouagadougou ', 'Africa ', 'Burkinabe', 'Burkinabe', 'CFA Franc BCEAO', 'XOF', 12272289, 'Burkina Faso', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(39, 'Burma', 'BM', 'MM', 'MMR', '104', 'MM', 'Rangoon ', 'Southeast Asia ', 'Burmese', 'Burmese', 'kyat', 'MMK', 41994678, 'Burma', 'ISO uses the name Myanmar', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(40, 'Burundi', 'BY', 'BI', 'BDI', '108', 'BI', 'Bujumbura ', 'Africa ', 'Burundi', 'Burundians', 'Burundi Franc', 'BIF', 6223897, 'Burundi', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(41, 'Cambodia', 'CB', 'KH', 'KHM', '116', 'KH', 'Phnom Penh ', 'Southeast Asia ', 'Cambodian', 'Cambodians', 'Riel', 'KHR', 12491501, 'Cambodia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(42, 'Cameroon', 'CM', 'CM', 'CMR', '120', 'CM', 'Yaounde ', 'Africa ', 'Cameroonian', 'Cameroonians', 'CFA Franc BEAC', 'XAF', 15803220, 'Cameroon', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(43, 'Canada', 'CA', 'CA', 'CAN', '124', 'CA', 'Ottawa ', 'North America ', 'Canadian', 'Canadians', 'Canadian Dollar', 'CAD', 31592805, 'Canada', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(44, 'Cape Verde', 'CV', 'CV', 'CPV', '132', 'CV', 'Praia ', 'World ', 'Cape Verdean', 'Cape Verdeans', 'Cape Verdean Escudo', 'CVE', 405163, 'Cape Verde', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(45, 'Cayman Islands', 'CJ', 'KY', 'CYM', '136', 'KY', 'George Town ', 'Central America and the Caribbean ', 'Caymanian', 'Caymanians', 'Cayman Islands Dollar', 'KYD', 35527, 'The Cayman Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(46, 'Central African Republic', 'CT', 'CF', 'CAF', '140', 'CF', 'Bangui ', 'Africa ', 'Central African', 'Central Africans', 'CFA Franc BEAC', 'XAF', 3576884, 'The Central African Republic', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(47, 'Chad', 'CD', 'TD', 'TCD', '148', 'TD', 'N\'Djamena ', 'Africa ', 'Chadian', 'Chadians', 'CFA Franc BEAC', 'XAF', 8707078, 'Chad', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(48, 'Chile', 'CI', 'CL', 'CHL', '152', 'CL', 'Santiago ', 'South America ', 'Chilean', 'Chileans', 'Chilean Peso', 'CLP', 15328467, 'Chile', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(49, 'China', 'CH', 'CN', 'CHN', '156', 'CN', 'Beijing ', 'Asia ', 'Chinese', 'Chinese', 'Yuan Renminbi', 'CNY', 1273111290, 'China', 'see also Taiwan', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(50, 'Christmas Island', 'KT', 'CX', 'CXR', '162', 'CX', 'The Settlement ', 'Southeast Asia ', 'Christmas Island', 'Christmas Islanders', 'Australian Dollar', 'AUD', 2771, 'Christmas Island', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(51, 'Clipperton Island', 'IP', '--', '-- ', '--', '--', '', 'World ', '', '', '', '', 0, 'Clipperton Island', 'ISO includes with French Polynesia', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(52, 'Cocos (Keeling) Islands', 'CK', 'CC', 'CCK', '166', 'CC', 'West Island ', 'Southeast Asia ', 'Cocos Islander', 'Cocos Islanders', 'Australian Dollar', 'AUD', 633, 'The Cocos Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(53, 'Colombia', 'CO', 'CO', 'COL', '170', 'CO', 'Bogota ', 'South America, Central America and the Caribbean ', 'Colombian', 'Colombians', 'Colombian Peso', 'COP', 40349388, 'Colombia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(54, 'Comoros', 'CN', 'KM', 'COM', '174', 'KM', 'Moroni ', 'Africa ', 'Comoran', 'Comorans', 'Comoro Franc', 'KMF', 596202, 'Comoros', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(55, 'Congo, Democratic Republic of the', 'CG', 'CD', 'COD', '180', 'CD', 'Kinshasa ', 'Africa ', 'Congolese', 'Congolese', 'Franc Congolais', 'CDF', 53624718, 'Democratic Republic of the Congo', 'formerly Zaire', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(56, 'Congo, Republic of the', 'CF', 'CG', 'COG', '178', 'CG', 'Brazzaville ', 'Africa ', 'Congolese', 'Congolese', 'CFA Franc BEAC', 'XAF', 2894336, 'Republic of the Congo', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(57, 'Cook Islands', 'CW', 'CK', 'COK', '184', 'CK', 'Avarua ', 'Oceania ', 'Cook Islander', 'Cook Islanders', 'New Zealand Dollar', 'NZD', 20611, 'The Cook Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(58, 'Coral Sea Islands', 'CR', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'The Coral Sea Islands', 'ISO includes with Australia', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(59, 'Costa Rica', 'CS', 'CR', 'CRI', '188', 'CR', 'San Jose ', 'Central America and the Caribbean ', 'Costa Rican', 'Costa Ricans', 'Costa Rican Colon', 'CRC', 3773057, 'Costa Rica', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(60, 'Cote d\'Ivoire', 'IV', 'CI', 'CIV', '384', 'CI', 'Yamoussoukro', 'Africa ', 'Ivorian', 'Ivorians', 'CFA Franc BCEAO', 'XOF', 16393221, 'Cote d\'Ivoire', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(61, 'Croatia', 'HR', 'HR', 'HRV', '191', 'HR', 'Zagreb ', 'Europe ', 'Croatian', 'Croats', 'Kuna', 'HRK', 4334142, 'Croatia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(62, 'Cuba', 'CU', 'CU', 'CUB', '192', 'CU', 'Havana ', 'Central America and the Caribbean ', 'Cuban', 'Cubans', 'Cuban Peso', 'CUP', 11184023, 'Cuba', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(63, 'Cyprus', 'CY', 'CY', 'CYP', '196', 'CY', 'Nicosia ', 'Middle East ', 'Cypriot', 'Cypriots', 'Cyprus Pound', 'CYP', 762887, 'Cyprus', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(64, 'Czech Republic', 'EZ', 'CZ', 'CZE', '203', 'CZ', 'Prague ', 'Europe ', 'Czech', 'Czechs', 'Czech Koruna', 'CZK', 10264212, 'The Czech Republic', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(65, 'Denmark', 'DA', 'DK', 'DNK', '208', 'DK', 'Copenhagen ', 'Europe ', 'Danish', 'Danes', 'Danish Krone', 'DKK', 5352815, 'Denmark', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(66, 'Djibouti', 'DJ', 'DJ', 'DJI', '262', 'DJ', 'Djibouti ', 'Africa ', 'Djiboutian', 'Djiboutians', 'Djibouti Franc', 'DJF', 460700, 'Djibouti', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(67, 'Dominica', 'DO', 'DM', 'DMA', '212', 'DM', 'Roseau ', 'Central America and the Caribbean ', 'Dominican', 'Dominicans', 'East Caribbean Dollar', 'XCD', 70786, 'Dominica', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(68, 'Dominican Republic', 'DR', 'DO', 'DOM', '214', 'DO', 'Santo Domingo ', 'Central America and the Caribbean ', 'Dominican', 'Dominicans', 'Dominican Peso', 'DOP', 8581477, 'The Dominican Republic', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(69, 'East Timor', 'TT', 'TL', 'TLS', '626', 'TP', '', '', '', '', 'Timor Escudo', 'TPE', 1040880, 'East Timor', 'NULL', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(70, 'Ecuador', 'EC', 'EC', 'ECU', '218', 'EC', 'Quito ', 'South America ', 'Ecuadorian', 'Ecuadorians', 'US Dollar', 'USD', 13183978, 'Ecuador', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(71, 'Egypt', 'EG', 'EG', 'EGY', '818', 'EG', 'Cairo ', 'Africa ', 'Egyptian', 'Egyptians', 'Egyptian Pound', 'EGP', 69536644, 'Egypt', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(72, 'El Salvador', 'ES', 'SV', 'SLV', '222', 'SV', 'San Salvador ', 'Central America and the Caribbean ', 'Salvadoran', 'Salvadorans', 'El Salvador Colon', 'SVC', 6237662, 'El Salvador', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(73, 'Equatorial Guinea', 'EK', 'GQ', 'GNQ', '226', 'GQ', 'Malabo ', 'Africa ', 'Equatorial Guinean', 'Equatorial Guineans', 'CFA Franc BEAC', 'XAF', 486060, 'Equatorial Guinea', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(74, 'Eritrea', 'ER', 'ER', 'ERI', '232', 'ER', 'Asmara ', 'Africa ', 'Eritrean', 'Eritreans', 'Nakfa', 'ERN', 4298269, 'Eritrea', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(75, 'Estonia', 'EN', 'EE', 'EST', '233', 'EE', 'Tallinn ', 'Europe ', 'Estonian', 'Estonians', 'Kroon', 'EEK', 1423316, 'Estonia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(76, 'Ethiopia', 'ET', 'ET', 'ETH', '231', 'ET', 'Addis Ababa ', 'Africa ', 'Ethiopian', 'Ethiopians', 'Ethiopian Birr', 'ETB', 65891874, 'Ethiopia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(77, 'Europa Island', 'EU', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Europa Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(78, 'Falkland Islands (Islas Malvinas)', 'FK', 'FK', 'FLK', '238', 'FK', 'Stanley', 'South America', 'Falkland Island', 'Falkland Islanders', 'Falkland Islands Pound', 'FKP', 2895, 'The Falkland Islands ', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(79, 'Faroe Islands', 'FO', 'FO', 'FRO', '234', 'FO', 'Torshavn ', 'Europe ', 'Faroese', 'Faroese', 'Danish Krone', 'DKK', 45661, 'The Faroe Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(80, 'Fiji', 'FJ', 'FJ', 'FJI', '242', 'FJ', 'Suva ', 'Oceania ', 'Fijian', 'Fijians', 'Fijian Dollar', 'FJD', 844330, 'Fiji', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(81, 'Finland', 'FI', 'FI', 'FIN', '246', 'FI', 'Helsinki ', 'Europe ', 'Finnish', 'Finns', 'Euro', 'EUR', 5175783, 'Finland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(82, 'France', 'FR', 'FR', 'FRA', '250', 'FR', 'Paris ', 'Europe ', 'Frenchman', 'Frenchmen', 'Euro', 'EUR', 59551227, 'France', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(83, 'France, Metropolitan', '--', '--', '-- ', '--', 'FX', '', '', '', '', 'Euro', 'EUR', 0, 'Metropolitan France', 'ISO limits to the European part of France, excluding French Guiana, French Polynesia, French Southern and Antarctic Lands, Guadeloupe, Martinique, Mayotte, New Caledonia, Reunion, Saint Pierre and Miquelon, Wallis and Futuna', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(84, 'French Guiana', 'FG', 'GF', 'GUF', '254', 'GF', 'Cayenne ', 'South America ', 'French Guianese', 'French Guianese', 'Euro', 'EUR', 177562, 'French Guiana', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(85, 'French Polynesia', 'FP', 'PF', 'PYF', '258', 'PF', 'Papeete ', 'Oceania ', 'French Polynesian', 'French Polynesians', 'CFP Franc', 'XPF', 253506, 'French Polynesia', 'ISO includes Clipperton Island', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(86, 'French Southern and Antarctic Lands', 'FS', 'TF', 'ATF', '260', 'TF', '', 'Antarctic Region ', '', '', 'Euro', 'EUR', 0, 'The French Southern and Antarctic Lands', 'FIPS 10-4 does not include the French-claimed portion of Antarctica (Terre Adelie)', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(87, 'Gabon', 'GB', 'GA', 'GAB', '266', 'GA', 'Libreville ', 'Africa ', 'Gabonese', 'Gabonese', 'CFA Franc BEAC', 'XAF', 1221175, 'Gabon', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(88, 'The Gambia', 'GA', 'GM', 'GMB', '270', 'GM', 'Banjul ', 'Africa ', 'Gambian', 'Gambians', 'Dalasi', 'GMD', 1411205, 'The Gambia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(89, 'Gaza Strip', 'GZ', '--', '-- ', '--', '--', '', 'Middle East ', '', '', 'New Israeli Shekel', 'ILS', 1178119, 'The Gaza Strip', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(90, 'Georgia', 'GG', 'GE', 'GEO', '268', 'GE', 'T\'bilisi ', 'Commonwealth of Independent States ', 'Georgian', 'Georgians', 'Lari', 'GEL', 4989285, 'Georgia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(91, 'Germany', 'GM', 'DE', 'DEU', '276', 'DE', 'Berlin ', 'Europe ', 'German', 'Germans', 'Euro', 'EUR', 83029536, 'Deutschland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(92, 'Ghana', 'GH', 'GH', 'GHA', '288', 'GH', 'Accra ', 'Africa ', 'Ghanaian', 'Ghanaians', 'Cedi', 'GHC', 19894014, 'Ghana', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(93, 'Gibraltar', 'GI', 'GI', 'GIB', '292', 'GI', 'Gibraltar ', 'Europe ', 'Gibraltar', 'Gibraltarians', 'Gibraltar Pound', 'GIP', 27649, 'Gibraltar', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(94, 'Glorioso Islands', 'GO', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'The Glorioso Islands', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(95, 'Greece', 'GR', 'GR', 'GRC', '300', 'GR', 'Athens ', 'Europe ', 'Greek', 'Greeks', 'Euro', 'EUR', 10623835, 'Greece', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(96, 'Greenland', 'GL', 'GL', 'GRL', '304', 'GL', 'Nuuk ', 'Arctic Region ', 'Greenlandic', 'Greenlanders', 'Danish Krone', 'DKK', 56352, 'Greenland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(97, 'Grenada', 'GJ', 'GD', 'GRD', '308', 'GD', 'Saint George\'s ', 'Central America and the Caribbean ', 'Grenadian', 'Grenadians', 'East Caribbean Dollar', 'XCD', 89227, 'Grenada', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(98, 'Guadeloupe', 'GP', 'GP', 'GLP', '312', 'GP', 'Basse-Terre ', 'Central America and the Caribbean ', 'Guadeloupe', 'Guadeloupians', 'Euro', 'EUR', 431170, 'Guadeloupe', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(99, 'Guam', 'GQ', 'GU', 'GUM', '316', 'GU', 'Hagatna', 'Oceania ', 'Guamanian', 'Guamanians', 'US Dollar', 'USD', 157557, 'Guam', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(100, 'Guatemala', 'GT', 'GT', 'GTM', '320', 'GT', 'Guatemala ', 'Central America and the Caribbean ', 'Guatemalan', 'Guatemalans', 'Quetzal', 'GTQ', 12974361, 'Guatemala', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(101, 'Guernsey', 'GK', '--', '-- ', '--', 'GG', 'Saint Peter Port ', 'Europe ', 'Channel Islander', 'Channel Islanders', 'Pound Sterling', 'GBP', 64342, 'Guernsey', 'ISO includes with the United Kingdom', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(102, 'Guinea', 'GV', 'GN', 'GIN', '324', 'GN', 'Conakry ', 'Africa ', 'Guinean', 'Guineans', 'Guinean Franc', 'GNF', 7613870, 'Guinea', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(103, 'Guinea-Bissau', 'PU', 'GW', 'GNB', '624', 'GW', 'Bissau ', 'Africa ', 'Guinean', 'Guineans', 'CFA Franc BCEAO', 'XOF', 1315822, 'Guinea-Bissau', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(104, 'Guyana', 'GY', 'GY', 'GUY', '328', 'GY', 'Georgetown ', 'South America ', 'Guyanese', 'Guyanese', 'Guyana Dollar', 'GYD', 697181, 'Guyana', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(105, 'Haiti', 'HA', 'HT', 'HTI', '332', 'HT', 'Port-au-Prince ', 'Central America and the Caribbean ', 'Haitian', 'Haitians', 'Gourde', 'HTG', 6964549, 'Haiti', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(106, 'Heard Island and McDonald Islands', 'HM', 'HM', 'HMD', '334', 'HM', '', 'Antarctic Region ', '', '', 'Australian Dollar', 'AUD', 0, 'The Heard Island and McDonald Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(107, 'Holy See (Vatican City)', 'VT', 'VA', 'VAT', '336', 'VA', 'Vatican City ', 'Europe ', '', '', 'Euro', 'EUR', 890, 'The Vatican City', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(108, 'Honduras', 'HO', 'HN', 'HND', '340', 'HN', 'Tegucigalpa ', 'Central America and the Caribbean ', 'Honduran', 'Hondurans', 'Lempira', 'HNL', 6406052, 'Honduras', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(109, 'Hong Kong (SAR)', 'HK', 'HK', 'HKG', '344', 'HK', '', 'Southeast Asia ', '', '', 'Hong Kong Dollar', 'HKD', 0, 'Xianggang ', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(110, 'Howland Island', 'HQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 7210505, 'Howland Island', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(111, 'Hungary', 'HU', 'HU', 'HUN', '348', 'HU', 'Budapest ', 'Europe ', 'Hungarian', 'Hungarians', 'Forint', 'HUF', 10106017, 'Hungary', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(112, 'Iceland', 'IC', 'IS', 'ISL', '352', 'IS', 'Reykjavik ', 'Arctic Region ', 'Icelandic', 'Icelanders', 'Iceland Krona', 'ISK', 277906, 'Iceland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(113, 'India', 'IN', 'IN', 'IND', '356', 'IN', 'New Delhi ', 'Asia ', 'Indian', 'Indians', 'Indian Rupee', 'INR', 1029991145, 'India', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(114, 'Indonesia', 'ID', 'ID', 'IDN', '360', 'ID', 'Jakarta ', 'Southeast Asia ', 'Indonesian', 'Indonesians', 'Rupiah', 'IDR', 228437870, 'Indonesia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(115, 'Iran', 'IR', 'IR', 'IRN', '364', 'IR', 'Tehran ', 'Middle East ', 'Iranian', 'Iranians', 'Iranian Rial', 'IRR', 66128965, 'Iran', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(116, 'Iraq', 'IZ', 'IQ', 'IRQ', '368', 'IQ', 'Baghdad ', 'Middle East ', 'Iraqi', 'Iraqis', 'Iraqi Dinar', 'IQD', 23331985, 'Iraq', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(117, 'Ireland', 'EI', 'IE', 'IRL', '372', 'IE', 'Dublin ', 'Europe ', 'Irish', 'Irishmen', 'Euro', 'EUR', 3840838, 'Ireland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(118, 'Israel', 'IS', 'IL', 'ISR', '376', 'IL', 'Jerusalem', 'Middle East ', 'Israeli', 'Israelis', 'New Israeli Sheqel', 'ILS', 5938093, 'Israel', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(119, 'Italy', 'IT', 'IT', 'ITA', '380', 'IT', 'Rome ', 'Europe ', 'Italian', 'Italians', 'Euro', 'EUR', 57679825, 'Italia ', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(120, 'Jamaica', 'JM', 'JM', 'JAM', '388', 'JM', 'Kingston ', 'Central America and the Caribbean ', 'Jamaican', 'Jamaicans', 'Jamaican dollar', 'JMD', 2665636, 'Jamaica', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(121, 'Jan Mayen', 'JN', '--', '-- ', '--', '--', '', 'Arctic Region ', '', '', 'Norway Kroner', 'NOK', 0, 'Jan Mayen', 'ISO includes with Svalbard', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(122, 'Japan', 'JA', 'JP', 'JPN', '392', 'JP', 'Tokyo ', 'Asia ', 'Japanese', 'Japanese', 'Yen', 'JPY', 126771662, 'Japan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(123, 'Jarvis Island', 'DQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Jarvis Island', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(124, 'Jersey', 'JE', '--', '-- ', '--', 'JE', 'Saint Helier ', 'Europe ', 'Channel Islander', 'Channel Islanders', 'Pound Sterling', 'GBP', 89361, 'Jersey', 'ISO includes with the United Kingdom', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(125, 'Johnston Atoll', 'JQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Johnston Atoll', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(126, 'Jordan', 'JO', 'JO', 'JOR', '400', 'JO', 'Amman ', 'Middle East ', 'Jordanian', 'Jordanians', 'Jordanian Dinar', 'JOD', 5153378, 'Jordan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(127, 'Juan de Nova Island', 'JU', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Juan de Nova Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(128, 'Kazakhstan', 'KZ', 'KZ', 'KAZ', '398', 'KZ', 'Astana ', 'Commonwealth of Independent States ', 'Kazakhstani', 'Kazakhstanis', 'Tenge', 'KZT', 16731303, 'Kazakhstan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(129, 'Kenya', 'KE', 'KE', 'KEN', '404', 'KE', 'Nairobi ', 'Africa ', 'Kenyan', 'Kenyans', 'Kenyan shilling', 'KES', 30765916, 'Kenya', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(130, 'Kingman Reef', 'KQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Kingman Reef', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(131, 'Kiribati', 'KR', 'KI', 'KIR', '296', 'KI', 'Tarawa ', 'Oceania ', 'I-Kiribati', 'I-Kiribati', 'Australian dollar', 'AUD', 94149, 'Kiribati', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(132, 'Korea, North', 'KN', 'KP', 'PRK', '408', 'KP', 'P\'yongyang ', 'Asia ', 'Korean', 'Koreans', 'North Korean Won', 'KPW', 21968228, 'North Korea', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(133, 'Korea, South', 'KS', 'KR', 'KOR', '410', 'KR', 'Seoul ', 'Asia ', 'Korean', 'Koreans', 'Won', 'KRW', 47904370, 'South Korea', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(134, 'Kuwait', 'KU', 'KW', 'KWT', '414', 'KW', 'Kuwait ', 'Middle East ', 'Kuwaiti', 'Kuwaitis', 'Kuwaiti Dinar', 'KWD', 2041961, 'Al Kuwayt', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(135, 'Kyrgyzstan', 'KG', 'KG', 'KGZ', '417', 'KG', 'Bishkek ', 'Commonwealth of Independent States ', 'Kyrgyzstani', 'Kyrgyzstanis', 'Som', 'KGS', 4753003, 'Kyrgyzstan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(136, 'Laos', 'LA', 'LA', 'LAO', '418', 'LA', 'Vientiane ', 'Southeast Asia ', 'Lao', 'Laos', 'Kip', 'LAK', 5635967, 'Laos', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(137, 'Latvia', 'LG', 'LV', 'LVA', '428', 'LV', 'Riga ', 'Europe ', 'Latvian', 'Latvians', 'Latvian Lats', 'LVL', 2385231, 'Latvia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(138, 'Lebanon', 'LE', 'LB', 'LBN', '422', 'LB', 'Beirut ', 'Middle East ', 'Lebanese', 'Lebanese', 'Lebanese Pound', 'LBP', 3627774, 'Lebanon', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(139, 'Lesotho', 'LT', 'LS', 'LSO', '426', 'LS', 'Maseru ', 'Africa ', 'Basotho', 'Mosotho', 'Loti', 'LSL', 2177062, 'Lesotho', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(140, 'Liberia', 'LI', 'LR', 'LBR', '430', 'LR', 'Monrovia ', 'Africa ', 'Liberian', 'Liberians', 'Liberian Dollar', 'LRD', 3225837, 'Liberia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(141, 'Libya', 'LY', 'LY', 'LBY', '434', 'LY', 'Tripoli ', 'Africa ', 'Libyan', 'Libyans', 'Libyan Dinar', 'LYD', 5240599, 'Libya', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(142, 'Liechtenstein', 'LS', 'LI', 'LIE', '438', 'LI', 'Vaduz ', 'Europe ', 'Liechtenstein', 'Liechtensteiners', 'Swiss Franc', 'CHF', 32528, 'Liechtenstein', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(143, 'Lithuania', 'LH', 'LT', 'LTU', '440', 'LT', 'Vilnius ', 'Europe ', 'Lithuanian', 'Lithuanians', 'Lithuanian Litas', 'LTL', 3610535, 'Lithuania', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(144, 'Luxembourg', 'LU', 'LU', 'LUX', '442', 'LU', 'Luxembourg ', 'Europe ', 'Luxembourg', 'Luxembourgers', 'Euro', 'EUR', 442972, 'Luxembourg', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(145, 'Macao', 'MC', 'MO', 'MAC', '446', 'MO', '', 'Southeast Asia ', 'Chinese', 'Chinese', 'Pataca', 'MOP', 453733, 'Macao', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(146, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MK', 'MKD', '807', 'MK', 'Skopje ', 'Europe ', 'Macedonian', 'Macedonians', 'Denar', 'MKD', 2046209, 'Makedonija', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(147, 'Madagascar', 'MA', 'MG', 'MDG', '450', 'MG', 'Antananarivo ', 'Africa ', 'Malagasy', 'Malagasy', 'Malagasy Franc', 'MGF', 15982563, 'Madagascar', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(148, 'Malawi', 'MI', 'MW', 'MWI', '454', 'MW', 'Lilongwe ', 'Africa ', 'Malawian', 'Malawians', 'Kwacha', 'MWK', 10548250, 'Malawi', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(149, 'Malaysia', 'MY', 'MY', 'MYS', '458', 'MY', 'Kuala Lumpur ', 'Southeast Asia ', 'Malaysian', 'Malaysians', 'Malaysian Ringgit', 'MYR', 22229040, 'Malaysia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(150, 'Maldives', 'MV', 'MV', 'MDV', '462', 'MV', 'Male ', 'Asia ', 'Maldivian', 'Maldivians', 'Rufiyaa', 'MVR', 310764, 'Maldives', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(151, 'Mali', 'ML', 'ML', 'MLI', '466', 'ML', 'Bamako ', 'Africa ', 'Malian', 'Malians', 'CFA Franc BCEAO', 'XOF', 11008518, 'Mali', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(152, 'Malta', 'MT', 'MT', 'MLT', '470', 'MT', 'Valletta ', 'Europe ', 'Maltese', 'Maltese', 'Euro', 'EUR', 394583, 'Malta', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(153, 'Man, Isle of', 'IM', '--', '-- ', '--', 'IM', 'Douglas ', 'Europe ', 'Manxman', 'Manxmen', 'Pound Sterling', 'GBP', 73489, 'The Isle of Man', 'ISO includes with the United Kingdom', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(154, 'Marshall Islands', 'RM', 'MH', 'MHL', '584', 'MH', 'Majuro ', 'Oceania ', 'Marshallese', 'Marshallese', 'US Dollar', 'USD', 70822, 'The Marshall Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(155, 'Martinique', 'MB', 'MQ', 'MTQ', '474', 'MQ', 'Fort-de-France ', 'Central America and the Caribbean ', 'Martiniquais', 'Martiniquais', 'Euro', 'EUR', 418454, 'Martinique', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(156, 'Mauritania', 'MR', 'MR', 'MRT', '478', 'MR', 'Nouakchott ', 'Africa ', 'Mauritanian', 'Mauritanians', 'Ouguiya', 'MRO', 2747312, 'Mauritania', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(157, 'Mauritius', 'MP', 'MU', 'MUS', '480', 'MU', 'Port Louis ', 'World ', 'Mauritian', 'Mauritians', 'Mauritius Rupee', 'MUR', 1189825, 'Mauritius', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(158, 'Mayotte', 'MF', 'YT', 'MYT', '175', 'YT', 'Mamoutzou ', 'Africa ', 'Mahorais', 'Mahorais', 'Euro', 'EUR', 163366, 'Mayotte', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(159, 'Mexico', 'MX', 'MX', 'MEX', '484', 'MX', 'Mexico ', 'North America ', 'Mexican', 'Mexicans', 'Mexican Peso', 'MXN', 101879171, 'Mexico', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(160, 'Micronesia, Federated States of', 'FM', 'FM', 'FSM', '583', 'FM', 'Palikir ', 'Oceania ', 'Micronesian', 'Micronesians', 'US Dollar', 'USD', 134597, 'The Federated States of Micronesia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(161, 'Midway Islands', 'MQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', 'United States Dollars', 'USD', 0, 'The Midway Islands', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(162, 'Miscellaneous (French)', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Miscellaneous (French)', 'ISO includes Bassas da India, Europa Island, Glorioso Islands, Juan de Nova Island, Tromelin Island', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(163, 'Moldova', 'MD', 'MD', 'MDA', '498', 'MD', 'Chisinau ', 'Commonwealth of Independent States ', 'Moldovan', 'Moldovans', 'Moldovan Leu', 'MDL', 4431570, 'Moldova', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(164, 'Monaco', 'MN', 'MC', 'MCO', '492', 'MC', 'Monaco ', 'Europe ', 'Monegasque', 'Monegasques', 'Euro', 'EUR', 31842, 'Monaco', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(165, 'Mongolia', 'MG', 'MN', 'MNG', '496', 'MN', 'Ulaanbaatar ', 'Asia ', 'Mongolian', 'Mongolians', 'Tugrik', 'MNT', 2654999, 'Mongolia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(166, 'Montenegro', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Montenegro', 'now included as region within Yugoslavia', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(167, 'Montserrat', 'MH', 'MS', 'MSR', '500', 'MS', 'Plymouth', 'Central America and the Caribbean ', 'Montserratian', 'Montserratians', 'East Caribbean Dollar', 'XCD', 7574, 'Montserrat', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(168, 'Morocco', 'MO', 'MA', 'MAR', '504', 'MA', 'Rabat ', 'Africa ', 'Moroccan', 'Moroccans', 'Moroccan Dirham', 'MAD', 30645305, 'Morocco', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(169, 'Mozambique', 'MZ', 'MZ', 'MOZ', '508', 'MZ', 'Maputo ', 'Africa ', 'Mozambican', 'Mozambicans', 'Metical', 'MZM', 19371057, 'Mozambique', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(170, 'Myanmar', '--', '--', '-- ', '--', '--', '', '', '', '', 'Kyat', 'MMK', 0, 'Myanmar', 'see Burma', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(171, 'Namibia', 'WA', 'NA', 'NAM', '516', 'NA', 'Windhoek ', 'Africa ', 'Namibian', 'Namibians', 'Namibian Dollar', 'NAD', 1797677, 'Namibia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(172, 'Nauru', 'NR', 'NR', 'NRU', '520', 'NR', '', 'Oceania ', 'Nauruan', 'Nauruans', 'Australian Dollar', 'AUD', 12088, 'Nauru', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(173, 'Navassa Island', 'BQ', '--', '-- ', '--', '--', '', 'Central America and the Caribbean ', '', '', '', '', 0, 'Navassa Island', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(174, 'Nepal', 'NP', 'NP', 'NPL', '524', 'NP', 'Kathmandu ', 'Asia ', 'Nepalese', 'Nepalese', 'Nepalese Rupee', 'NPR', 25284463, 'Nepal', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(175, 'Netherlands', 'NL', 'NL', 'NLD', '528', 'NL', 'Amsterdam ', 'Europe ', 'Dutchman', 'Dutchmen', 'Euro', 'EUR', 15981472, 'The Netherlands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(176, 'Netherlands Antilles', 'NT', 'AN', 'ANT', '530', 'AN', 'Willemstad ', 'Central America and the Caribbean ', 'Dutch Antillean', 'Dutch Antilleans', 'Netherlands Antillean guilder', 'ANG', 212226, 'The Netherlands Antilles', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(177, 'New Caledonia', 'NC', 'NC', 'NCL', '540', 'NC', 'Noumea ', 'Oceania ', 'New Caledonian', 'New Caledonians', 'CFP Franc', 'XPF', 204863, 'New Caledonia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(178, 'New Zealand', 'NZ', 'NZ', 'NZL', '554', 'NZ', 'Wellington ', 'Oceania ', 'New Zealand', 'New Zealanders', 'New Zealand Dollar', 'NZD', 3864129, 'New Zealand', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(179, 'Nicaragua', 'NU', 'NI', 'NIC', '558', 'NI', 'Managua ', 'Central America and the Caribbean ', 'Nicaraguan', 'Nicaraguans', 'Cordoba Oro', 'NIO', 4918393, 'Nicaragua', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(180, 'Niger', 'NG', 'NE', 'NER', '562', 'NE', 'Niamey ', 'Africa ', 'Nigerien', 'Nigeriens', 'CFA Franc BCEAO', 'XOF', 10355156, 'Niger', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(181, 'Nigeria', 'NI', 'NG', 'NGA', '566', 'NG', 'Abuja', 'Africa ', 'Nigerian', 'Nigerians', 'Naira', 'NGN', 126635626, 'Nigeria', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(182, 'Niue', 'NE', 'NU', 'NIU', '570', 'NU', 'Alofi ', 'Oceania ', 'Niuean', 'Niueans', 'New Zealand Dollar', 'NZD', 2124, 'Niue', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(183, 'Norfolk Island', 'NF', 'NF', 'NFK', '574', 'NF', 'Kingston ', 'Oceania ', 'Norfolk Islander', 'Norfolk Islanders', 'Australian Dollar', 'AUD', 1879, 'Norfolk Island', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(184, 'Northern Mariana Islands', 'CQ', 'MP', 'MNP', '580', 'MP', 'Saipan ', 'Oceania ', '', '', 'US Dollar', 'USD', 74612, 'The Northern Mariana Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(185, 'Norway', 'NO', 'NO', 'NOR', '578', 'NO', 'Oslo ', 'Europe ', 'Norwegian', 'Norwegians', 'Norwegian Krone', 'NOK', 4503440, 'Norway', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(186, 'Oman', 'MU', 'OM', 'OMN', '512', 'OM', 'Muscat ', 'Middle East ', 'Omani', 'Omanis', 'Rial Omani', 'OMR', 2622198, 'Oman', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(187, 'Pakistan', 'PK', 'PK', 'PAK', '586', 'PK', 'Islamabad ', 'Asia ', 'Pakistani', 'Pakistanis', 'Pakistan Rupee', 'PKR', 144616639, 'Pakistan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(188, 'Palau', 'PS', 'PW', 'PLW', '585', 'PW', 'Koror ', 'Oceania ', 'Palauan', 'Palauans', 'US Dollar', 'USD', 19092, 'Palau', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(189, 'Palmyra Atoll', 'LQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Palmyra Atoll', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(190, 'Panama', 'PM', 'PA', 'PAN', '591', 'PA', 'Panama ', 'Central America and the Caribbean ', 'Panamanian', 'Panamanians', 'balboa', 'PAB', 2845647, 'Panama', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(191, 'Papua New Guinea', 'PP', 'PG', 'PNG', '598', 'PG', 'Port Moresby ', 'Oceania ', 'Papua New Guinean', 'Papua New Guineans', 'Kina', 'PGK', 5049055, 'Papua New Guinea', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(192, 'Paracel Islands', 'PF', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'The Paracel Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(193, 'Paraguay', 'PA', 'PY', 'PRY', '600', 'PY', 'Asuncion ', 'South America ', 'Paraguayan', 'Paraguayans', 'Guarani', 'PYG', 5734139, 'Paraguay', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(194, 'Peru', 'PE', 'PE', 'PER', '604', 'PE', 'Lima ', 'South America ', 'Peruvian', 'Peruvians', 'Nuevo Sol', 'PEN', 27483864, 'Peru', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(195, 'Philippines', 'RP', 'PH', 'PHL', '608', 'PH', 'Manila ', 'Southeast Asia ', 'Philippine', 'Filipinos', 'Philippine Peso', 'PHP', 82841518, 'The Philippines', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(196, 'Pitcairn Islands', 'PC', 'PN', 'PCN', '612', 'PN', 'Adamstown ', 'Oceania ', 'Pitcairn Islander', 'Pitcairn Islanders', 'New Zealand Dollar', 'NZD', 47, 'The Pitcairn Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(197, 'Poland', 'PL', 'PL', 'POL', '616', 'PL', 'Warsaw ', 'Europe ', 'Polish', 'Poles', 'Zloty', 'PLN', 38633912, 'Poland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(198, 'Portugal', 'PO', 'PT', 'PRT', '620', 'PT', 'Lisbon ', 'Europe ', 'Portuguese', 'Portuguese', 'Euro', 'EUR', 10066253, 'Portugal', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(199, 'Puerto Rico', 'RQ', 'PR', 'PRI', '630', 'PR', 'San Juan ', 'Central America and the Caribbean ', 'Puerto Rican', 'Puerto Ricans', 'US Dollar', 'USD', 3937316, 'Puerto Rico', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(200, 'Qatar', 'QA', 'QA', 'QAT', '634', 'QA', 'Doha ', 'Middle East ', 'Qatari', 'Qataris', 'Qatari Rial', 'QAR', 769152, 'Qatar', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(201, 'Reunion', 'RE', 'RE', 'REU', '638', 'RE', 'Saint-Denis', 'World', 'Reunionese', 'Reunionese', 'Euro', 'EUR', 732570, 'RÃ©union', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(202, 'Romania', 'RO', 'RO', 'ROU', '642', 'RO', 'Bucharest ', 'Europe ', 'Romanian', 'Romanians', 'Leu', 'ROL', 22364022, 'Romania', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(203, 'Russia', 'RS', 'RU', 'RUS', '643', 'RU', 'Moscow ', 'Asia ', 'Russian', 'Russians', 'Russian Ruble', 'RUB', 145470197, 'Russia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(204, 'Rwanda', 'RW', 'RW', 'RWA', '646', 'RW', 'Kigali ', 'Africa ', 'Rwandan', 'Rwandans', 'Rwanda Franc', 'RWF', 7312756, 'Rwanda', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(205, 'Saint Helena', 'SH', 'SH', 'SHN', '654', 'SH', 'Jamestown ', 'Africa ', 'Saint Helenian', 'Saint Helenians', 'Saint Helenian Pound', 'SHP', 7266, 'Saint Helena', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(206, 'Saint Kitts and Nevis', 'SC', 'KN', 'KNA', '659', 'KN', 'Basseterre ', 'Central America and the Caribbean ', 'Kittitian and Nevisian', 'Kittitians and Nevisians', 'East Caribbean Dollar', 'XCD', 38756, 'Saint Kitts and Nevis', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(207, 'Saint Lucia', 'ST', 'LC', 'LCA', '662', 'LC', 'Castries ', 'Central America and the Caribbean ', 'Saint Lucian', 'Saint Lucians', 'East Caribbean Dollar', 'XCD', 158178, 'Saint Lucia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(208, 'Saint Pierre and Miquelon', 'SB', 'PM', 'SPM', '666', 'PM', 'Saint-Pierre ', 'North America ', 'Frenchman', 'Frenchmen', 'Euro', 'EUR', 6928, 'Saint Pierre and Miquelon', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(209, 'Saint Vincent and the Grenadines', 'VC', 'VC', 'VCT', '670', 'VC', 'Kingstown ', 'Central America and the Caribbean ', 'Saint Vincentian', 'Saint Vincentians', 'East Caribbean Dollar', 'XCD', 115942, 'Saint Vincent and the Grenadines', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(210, 'Samoa', 'WS', 'WS', 'WSM', '882', 'WS', 'Apia ', 'Oceania ', 'Samoan', 'Samoans', 'Tala', 'WST', 179058, 'Samoa', 'NULL', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(211, 'San Marino', 'SM', 'SM', 'SMR', '674', 'SM', 'San Marino ', 'Europe ', 'Sammarinese', 'Sammarinese', 'Euro', 'EUR', 27336, 'San Marino', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(212, 'Sao Tome and Principe', 'TP', 'ST', 'STP', '678', 'ST', 'Sao Tome', 'Africa', 'Sao Tomean', 'Sao Tomeans', 'Dobra', 'STD', 165034, 'SÃ£o TomÃ© and PrÃ­ncipe', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(213, 'Saudi Arabia', 'SA', 'SA', 'SAU', '682', 'SA', 'Riyadh ', 'Middle East ', 'Saudi Arabian ', 'Saudis', 'Saudi Riyal', 'SAR', 22757092, 'Saudi Arabia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(214, 'Senegal', 'SG', 'SN', 'SEN', '686', 'SN', 'Dakar ', 'Africa ', 'Senegalese', 'Senegalese', 'CFA Franc BCEAO', 'XOF', 10284929, 'Senegal', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(215, 'Serbia', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Serbia', 'now included as region within Yugoslavia', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(216, 'Serbia and Montenegro', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Serbia and Montenegro', 'See Yugoslavia', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(217, 'Seychelles', 'SE', 'SC', 'SYC', '690', 'SC', 'Victoria ', 'Africa ', 'Seychellois', 'Seychellois', 'Seychelles Rupee', 'SCR', 79715, 'Seychelles', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(218, 'Sierra Leone', 'SL', 'SL', 'SLE', '694', 'SL', 'Freetown ', 'Africa ', 'Sierra Leonean', 'Sierra Leoneans', 'Leone', 'SLL', 5426618, 'Sierra Leone', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(219, 'Singapore', 'SN', 'SG', 'SGP', '702', 'SG', 'Singapore ', 'Southeast Asia ', 'Singaporeian', 'Singaporeans', 'Singapore Dollar', 'SGD', 4300419, 'Singapore', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(220, 'Slovakia', 'LO', 'SK', 'SVK', '703', 'SK', 'Bratislava ', 'Europe ', 'Slovakian', 'Slovaks', 'Euro', 'EUR', 5414937, 'Slovakia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(221, 'Slovenia', 'SI', 'SI', 'SVN', '705', 'SI', 'Ljubljana ', 'Europe ', 'Slovenian', 'Slovenes', 'Euro', 'EUR', 1930132, 'Slovenia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(222, 'Solomon Islands', 'BP', 'SB', 'SLB', '90', 'SB', 'Honiara ', 'Oceania ', 'Solomon Islander', 'Solomon Islanders', 'Solomon Islands Dollar', 'SBD', 480442, 'The Solomon Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(223, 'Somalia', 'SO', 'SO', 'SOM', '706', 'SO', 'Mogadishu ', 'Africa ', 'Somali', 'Somalis', 'Somali Shilling', 'SOS', 7488773, 'Somalia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(224, 'South Africa', 'SF', 'ZA', 'ZAF', '710', 'ZA', 'Pretoria', 'Africa ', 'South African', 'South Africans', 'Rand', 'ZAR', 43586097, 'South Africa', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(225, 'South Georgia and the South Sandwich Islands', 'SX', 'GS', 'SGS', '239', 'GS', '', 'Antarctic Region ', '', '', 'Pound Sterling', 'GBP', 0, 'The South Georgia and the South Sandwich Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(226, 'Spain', 'SP', 'ES', 'ESP', '724', 'ES', 'Madrid ', 'Europe ', 'Spanish', 'Spaniards', 'Euro', 'EUR', 40037995, 'Spain', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(227, 'Spratly Islands', 'PG', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'The Spratly Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(228, 'Sri Lanka', 'CE', 'LK', 'LKA', '144', 'LK', 'Colombo', 'Asia ', 'Sri Lankan', 'Sri Lankans', 'Sri Lanka Rupee', 'LKR', 19408635, 'Sri Lanka', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(229, 'Sudan', 'SU', 'SD', 'SDN', '736', 'SD', 'Khartoum ', 'Africa ', 'Sudanese', 'Sudanese', 'Sudanese Dinar', 'SDD', 36080373, 'Sudan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(230, 'Suriname', 'NS', 'SR', 'SUR', '740', 'SR', 'Paramaribo ', 'South America ', 'Surinamese', 'Surinamers', 'Suriname Guilder', 'SRG', 433998, 'Suriname', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(231, 'Svalbard', 'SV', 'SJ', 'SJM', '744', 'SJ', 'Longyearbyen ', 'Arctic Region ', '', '', 'Norwegian Krone', 'NOK', 2332, 'Svalbard', 'ISO includes Jan Mayen', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(232, 'Swaziland', 'WZ', 'SZ', 'SWZ', '748', 'SZ', 'Mbabane ', 'Africa ', 'Swazi', 'Swazis', 'Lilangeni', 'SZL', 1104343, 'Swaziland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(233, 'Sweden', 'SW', 'SE', 'SWE', '752', 'SE', 'Stockholm ', 'Europe ', 'Swedish', 'Swedes', 'Swedish Krona', 'SEK', 8875053, 'Sweden', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(234, 'Switzerland', 'SZ', 'CH', 'CHE', '756', 'CH', 'Bern ', 'Europe ', 'Swiss', 'Swiss', 'Swiss Franc', 'CHF', 7283274, 'Switzerland', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(235, 'Syria', 'SY', 'SY', 'SYR', '760', 'SY', 'Damascus ', 'Middle East ', 'Syrian', 'Syrians', 'Syrian Pound', 'SYP', 16728808, 'Syria', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11');
INSERT INTO `countries` (`id`, `name`, `FIPS104`, `ISO2`, `ISO3`, `ISON`, `Internet`, `Capital`, `MapReference`, `NationalitySingular`, `NationalityPlural`, `Currency`, `CurrencyCode`, `Population`, `Title`, `Comment`, `status`, `is_deleted`, `create_date`, `last_upd_date`) VALUES
(236, 'Taiwan', 'TW', 'TW', 'TWN', '158', 'TW', 'Taipei ', 'Southeast Asia ', 'Taiwanese', 'Taiwanese', 'New Taiwan Dollar', 'TWD', 22370461, 'Taiwan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(237, 'Tajikistan', 'TI', 'TJ', 'TJK', '762', 'TJ', 'Dushanbe ', 'Commonwealth of Independent States ', 'Tajikistani', 'Tajikistanis', 'Somoni', 'TJS', 6578681, 'Tajikistan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(238, 'Tanzania', 'TZ', 'TZ', 'TZA', '834', 'TZ', 'Dar es Salaam', 'Africa ', 'Tanzanian', 'Tanzanians', 'Tanzanian Shilling', 'TZS', 36232074, 'Tanzania', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(239, 'Thailand', 'TH', 'TH', 'THA', '764', 'TH', 'Bangkok ', 'Southeast Asia ', 'Thai', 'Thai', 'Baht', 'THB', 61797751, 'Thailand', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(240, 'Togo', 'TO', 'TG', 'TGO', '768', 'TG', 'Lome ', 'Africa ', 'Togolese', 'Togolese', 'CFA Franc BCEAO', 'XOF', 5153088, 'Togo', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(241, 'Tokelau', 'TL', 'TK', 'TKL', '772', 'TK', '', 'Oceania ', 'Tokelauan', 'Tokelauans', 'New Zealand Dollar', 'NZD', 1445, 'Tokelau', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(242, 'Tonga', 'TN', 'TO', 'TON', '776', 'TO', 'Nuku\'alofa ', 'Oceania ', 'Tongan', 'Tongans', 'Pa\'anga', 'TOP', 104227, 'Tonga', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(243, 'Trinidad and Tobago', 'TD', 'TT', 'TTO', '780', 'TT', 'Port-of-Spain ', 'Central America and the Caribbean ', 'Trinidadian and Tobagonian', 'Trinidadians and Tobagonians', 'Trinidad and Tobago Dollar', 'TTD', 1169682, 'Trinidad and Tobago', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(244, 'Tromelin Island', 'TE', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Tromelin Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(245, 'Tunisia', 'TS', 'TN', 'TUN', '788', 'TN', 'Tunis ', 'Africa ', 'Tunisian', 'Tunisians', 'Tunisian Dinar', 'TND', 9705102, 'Tunisia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(246, 'Turkey', 'TU', 'TR', 'TUR', '792', 'TR', 'Ankara ', 'Middle East ', 'Turkish', 'Turks', 'Turkish Lira', 'TRL', 66493970, 'Turkey', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(247, 'Turkmenistan', 'TX', 'TM', 'TKM', '795', 'TM', 'Ashgabat ', 'Commonwealth of Independent States ', 'Turkmen', 'Turkmens', 'Manat', 'TMM', 4603244, 'Turkmenistan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(248, 'Turks and Caicos Islands', 'TK', 'TC', 'TCA', '796', 'TC', 'Cockburn Town ', 'Central America and the Caribbean ', '', '', 'US Dollar', 'USD', 18122, 'The Turks and Caicos Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(249, 'Tuvalu', 'TV', 'TV', 'TUV', '798', 'TV', 'Funafuti ', 'Oceania ', 'Tuvaluan', 'Tuvaluans', 'Australian Dollar', 'AUD', 10991, 'Tuvalu', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(250, 'Uganda', 'UG', 'UG', 'UGA', '800', 'UG', 'Kampala ', 'Africa ', 'Ugandan', 'Ugandans', 'Uganda Shilling', 'UGX', 23985712, 'Uganda', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(251, 'Ukraine', 'UP', 'UA', 'UKR', '804', 'UA', 'Kiev ', 'Commonwealth of Independent States ', 'Ukrainian', 'Ukrainians', 'Hryvnia', 'UAH', 48760474, 'The Ukraine', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(252, 'United Arab Emirates', 'AE', 'AE', 'ARE', '784', 'AE', 'Abu Dhabi ', 'Middle East ', 'Emirati', 'Emiratis', 'UAE Dirham', 'AED', 2407460, 'The United Arab Emirates', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(253, 'United Kingdom', 'UK', 'GB', 'GBR', '826', 'UK', 'London ', 'Europe ', 'British', 'Britons', 'Pound Sterling', 'GBP', 59647790, 'The United Kingdom', 'ISO includes Guernsey, Isle of Man, Jersey', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(255, 'United States Minor Outlying Islands', '--', 'UM', 'UMI', '581', 'UM', '', '', '', '', 'US Dollar', 'USD', 0, 'The United States Minor Outlying Islands', 'ISO includes Baker Island, Howland Island, Jarvis Island, Johnston Atoll, Kingman Reef, Midway Islands, Palmyra Atoll, Wake Island', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(256, 'Uruguay', 'UY', 'UY', 'URY', '858', 'UY', 'Montevideo ', 'South America ', 'Uruguayan', 'Uruguayans', 'Peso Uruguayo', 'UYU', 3360105, 'Uruguay', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(257, 'Uzbekistan', 'UZ', 'UZ', 'UZB', '860', 'UZ', 'Tashkent', 'Commonwealth of Independent States ', 'Uzbekistani', 'Uzbekistanis', 'Uzbekistan Sum', 'UZS', 25155064, 'Uzbekistan', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(258, 'Vanuatu', 'NH', 'VU', 'VUT', '548', 'VU', 'Port-Vila ', 'Oceania ', 'Ni-Vanuatu', 'Ni-Vanuatu', 'Vatu', 'VUV', 192910, 'Vanuatu', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(259, 'Venezuela', 'VE', 'VE', 'VEN', '862', 'VE', 'Caracas ', 'South America, Central America and the Caribbean ', 'Venezuelan', 'Venezuelans', 'Bolivar', 'VEB', 23916810, 'Venezuela', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(260, 'Vietnam', 'VM', 'VN', 'VNM', '704', 'VN', 'Hanoi ', 'Southeast Asia ', 'Vietnamese', 'Vietnamese', 'Dong', 'VND', 79939014, 'Vietnam', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(261, 'Virgin Islands', 'VQ', 'VI', 'VIR', '850', 'VI', 'Charlotte Amalie ', 'Central America and the Caribbean ', 'Virgin Islander', 'Virgin Islanders', 'US Dollar', 'USD', 122211, 'The Virgin Islands', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(262, 'Virgin Islands (UK)', '--', '--', '-- ', '--', '--', '', '', '', '', 'US Dollar', 'USD', 0, 'Virgin Islands (UK)', 'see British Virgin Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(263, 'Virgin Islands (US)', '--', '--', '-- ', '--', '--', '', '', '', '', 'US Dollar', 'USD', 0, 'Virgin Islands (US)', 'see Virgin Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(264, 'Wake Island', 'WQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', 'US Dollar', 'USD', 0, 'Wake Island', 'ISO includes with the US Minor Outlying Islands', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(265, 'Wallis and Futuna', 'WF', 'WF', 'WLF', '876', 'WF', 'Mata-Utu', 'Oceania ', 'Wallis and Futuna Islander', 'Wallis and Futuna Islanders', 'CFP Franc', 'XPF', 15435, 'Wallis and Futuna', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(266, 'West Bank', 'WE', '--', '-- ', '--', '--', '', 'Middle East ', '', '', 'New Israeli Shekel', 'ILS', 2090713, 'The West Bank', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(267, 'Western Sahara', 'WI', 'EH', 'ESH', '732', 'EH', '', 'Africa ', 'Sahrawian', 'Sahrawis', 'Moroccan Dirham', 'MAD', 250559, 'Western Sahara', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(268, 'Western Samoa', '--', '--', '-- ', '--', '--', '', '', '', '', 'Tala', 'WST', 0, 'Western Samoa', 'see Samoa', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(269, 'World', '--', '--', '-- ', '--', '--', '', 'World, Time Zones ', '', '', '', '', 1862433264, 'The World', 'NULL', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(270, 'Yemen', 'YM', 'YE', 'YEM', '887', 'YE', 'Sanaa ', 'Middle East ', 'Yemeni', 'Yemenis', 'Yemeni Rial', 'YER', 18078035, 'Yemen', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(271, 'Yugoslavia', 'YI', 'YU', 'YUG', '891', 'YU', 'Belgrade ', 'Europe ', 'Serbian', 'Serbs', 'Yugoslavian Dinar', 'YUM', 10677290, 'Yugoslavia', 'NULL', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(272, 'Zaire', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Zaire', 'see Democratic Republic of the Congo', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(273, 'Zambia', 'ZA', 'ZM', 'ZWB', '894', 'ZM', 'Lusaka ', 'Africa ', 'Zambian', 'Zambians', 'Kwacha', 'ZMK', 9770199, 'Zambia', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(274, 'Zimbabwe', 'ZI', 'ZW', 'ZWE', '716', 'ZW', 'Harare ', 'Africa ', 'Zimbabwean', 'Zimbabweans', 'Zimbabwe Dollar', 'ZWD', 11365366, 'Zimbabwe', '', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11'),
(275, 'Palestinian Territory, Occupied', '--', 'PS', 'PSE', '275', 'PS', '', '', '', '', '', '', 0, 'Palestine', 'NULL', 1, 0, '2015-10-28 00:00:00', '2015-10-30 08:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_deleted` tinyint(4) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `user_id`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 'Dept1', 2, 1, 0, NULL, NULL),
(2, 'Pro dept1', 76, 1, 0, NULL, NULL),
(3, 'Pro Dept 2', 76, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(11) NOT NULL,
  `template_code` varchar(200) NOT NULL,
  `name` varchar(55) NOT NULL,
  `template` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `template_code`, `name`, `template`, `created`, `modified`) VALUES
(4, '4', 'Chat Conversation', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                Hello {Name}\r\n                \r\n<p style=\"font-family: arial; font-size:14px\">Below is the conversation between you and pharmacist:</p>\r\n{TEXT}\r\n             \r\n\r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>   \r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    					</td>\r\n    				</tr>\r\n    			</table>\r\n             </td>\r\n    	</tr>\r\n	</table>', '2017-07-11 00:00:00', '2017-11-03 14:24:43'),
(5, '5', 'Chat Notification', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                <p style=\"font-family: arial; font-size:14px\">Hello {Name} </p>\r\n\r\n{URL}\r\n           \r\n\r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>     \r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    					</td>\r\n    				</tr>\r\n    			</table>\r\n             </td>\r\n    	</tr>\r\n	</table>', '2017-07-14 00:00:00', '2017-11-03 14:25:32'),
(6, '6', 'Hello from Helping Patients team', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                Dear {Name},\r\n\r\n                <h3 style=\"font-family: Lobster; font-size:20px;\">Welcome to Helping Patients </h3>\r\n                <p style=\"font-family: arial; font-size:14px\">Pharmacists are one of the most trusted healthcare professional in todays healthcare and their scope seems to just keep expanding. We are proud to invite you to become a registered professional on this innovative platform and offer valuable advice to patients.</p>\r\n<div style=\"text-align:center\">\r\n<img src=\"https://www.patientandpharmacist.com/images/chat_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/rx_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/pictures_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/medications_icon_e.png\" style=\"width:80px;\">\r\n</div>\r\n<p style=\"font-family: arial; font-size:14px\">Congratulations! your license has been verified and now you can access your account here: </p>\r\n                {Link}\r\n                \r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>\r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n\r\n\r\n    					</td>\r\n    				</tr>\r\n    			</table>\r\n             </td>\r\n    	</tr>\r\n	</table>', '2017-07-14 00:00:00', '2017-11-03 14:26:31'),
(7, '7', 'New Question Posted', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                <p style=\"font-family: arial; font-size:14px\">Hello {Name} </p>\r\n\r\n{TEXT}\r\n                \r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>\r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    					</td>\r\n    				</tr>\r\n    			</table>\r\n             </td>\r\n    	</tr>\r\n	</table>', '2017-07-26 00:00:00', '2017-11-03 14:27:12'),
(8, '8', 'New Pharmcist Registered', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                 {Name},\r\n               \r\n                <p style=\"font-family: arial; font-size:14px\">New Pharmacist has been registered, please check the panel and verify the Licence.</p>\r\n\r\n                {Link}\r\n                \r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>\r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n            </td>\r\n        </tr>\r\n    </table>', '0000-00-00 00:00:00', '2017-08-28 07:45:39'),
(2, '2', 'Forget Password', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                Hello {Name}\r\n                \r\n                {URL}\r\n                \r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>\r\n\r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    					</td>\r\n    				</tr>\r\n    			</table>\r\n             </td>\r\n    	</tr>\r\n	</table>', '2017-05-17 00:00:00', '2017-11-03 14:22:50'),
(3, '3', 'Hey lucky you, someone really cares about you !', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                Hello {Name}\r\n\r\n<h3>One of your friends/family thought we would be a great match</h3>\r\n <p style=\"font-family: arial; font-size:14px\"> We are an online- free-full-service to your health, medications, wellness and everything in between.</p>\r\n<div style=\"text-align:center\">\r\n<img src=\"https://www.patientandpharmacist.com/images/chat_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/rx_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/pictures_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/medications_icon_e.png\" style=\"width:80px;\">\r\n</div>\r\n<p style=\"font-family: arial; font-size:14px\">Built for mobile.. now you can store, manage and access your health information anytime anywhere. Secure Chat with a licensed pharmacist is to help you find answers to any question about medical conditions, medications, medical equipment & supplies, natural health products, alternative therapies and so on..\r\n{Link} to sign up:</p>               \r\n\r\n\r\n                \r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>\r\n                \r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    					</td>\r\n    				</tr>\r\n    			</table>\r\n             </td>\r\n    	</tr>\r\n	</table>', '2017-06-06 00:00:00', '2017-11-03 14:23:47'),
(1, '1', 'Hello from Helping Patients team', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tr>\r\n			<td>      \r\n            	<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600px\" id=\"parent_tbl\">\r\n              		<tr>\r\n               			<td>\r\n	<table width=\"600px\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"child_tbl\" style=\" background:#fff;\">\r\n    	<tr>\r\n        	<td style=\"background:#f8f1e1;padding:20px 30px 20px 30px;text-align:center;\">\r\n            	<img src=\"https://www.patientandpharmacist.com/images/logo_email.jpg\">\r\n            </td>\r\n        </tr>\r\n        <tr>	\r\n        	<td style=\" padding:20px 30px 0 30px\">\r\n                 {Name},\r\n                <h3>Welcome to Helping Patients </h3>\r\n                <p style=\"font-family: arial; font-size:14px\">We are an online- free-full-service to your health, medications, wellness and everything in between.</hp>\r\n\r\n<div style=\"text-align:center\">\r\n<img src=\"https://www.patientandpharmacist.com/images/chat_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/rx_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/pictures_icon_e.png\" style=\"width:80px; margin-right:15px\">\r\n<img src=\"https://www.patientandpharmacist.com/images/medications_icon_e.png\" style=\"width:80px;\">\r\n</div>\r\n\r\n<p style=\"font-family: arial; font-size:14px\">Built for mobile.. now you can store, manage and access your health information anytime anywhere. Secure Chat with a licensed pharmacist is to help you find answers to any question about medical conditions, medications, medical equipment & supplies, natural health products, alternative therapies and so on..\r\nClick here to unlock your home screen and get started:</p>\r\n                {Link}\r\n                \r\n<h5>Thank you,</h5>\r\n<h5>Patient and Pharmacist Team</h5>\r\n        	</td>\r\n        </tr>\r\n        \r\n        <tr>\r\n        	<td style=\" background:#242121; padding:15px 30px; text-align:center;\">\r\n            	<h5 style=\"font-family: arial; font-size:16px; line-height:24px; color:#fff; margin:0; font-weight:400;\">Powered by Patient and Pharmacist  &copy;2017. All rights reserved.</h5>\r\n<a href=\"https://www.facebook.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/facebook.png\" alt=\"Facebook\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.instagram.com/patientandpharmacist\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/instagram.png\" alt=\"Instagram\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://www.linkedin.com/company-beta/25041284\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/linkedin.png\" alt=\"Linked In\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/your_tube.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"https://twitter.com/helpourpatients\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/twitter.png\" alt=\"Twitter\" style=\"padding-right: 2px;\"></a>\r\n                        <a href=\"#\" target=\"_blank\"><img src=\"https://www.patientandpharmacist.com/img/g_plus.png\" alt=\"You Tube\" style=\"padding-right: 2px;\"></a>\r\n            </td>\r\n        </tr>\r\n    </table>', '2017-05-17 00:00:00', '2017-11-03 14:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `fees_settings`
--

CREATE TABLE `fees_settings` (
  `id` int(100) NOT NULL,
  `provider_id` int(100) DEFAULT NULL,
  `fees_type` int(2) NOT NULL COMMENT '0=>Flat fees, 1=> Per page fees',
  `amount` float(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_settings`
--

INSERT INTO `fees_settings` (`id`, `provider_id`, `fees_type`, `amount`) VALUES
(8, 2, 1, 10.00),
(11, 75, 0, 250.00),
(12, 6, 0, 55.00),
(13, 76, 1, 16.00);

-- --------------------------------------------------------

--
-- Table structure for table `matters`
--

CREATE TABLE `matters` (
  `id` bigint(6) NOT NULL,
  `client_id` int(11) NOT NULL COMMENT 'from clients table',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `matter_no` varchar(50) DEFAULT NULL,
  `matter_name` varchar(255) DEFAULT NULL COMMENT 'matter name',
  `brief_description` text,
  `hipaa_form` varchar(100) DEFAULT NULL,
  `threshold` float(7,2) DEFAULT NULL,
  `lead_attorney` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>not_deleted, 1=>deleted',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>active,2=>inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matters`
--

INSERT INTO `matters` (`id`, `client_id`, `first_name`, `last_name`, `matter_no`, `matter_name`, `brief_description`, `hipaa_form`, `threshold`, `lead_attorney`, `created_by`, `modified_by`, `created`, `modified`, `is_deleted`, `status`) VALUES
(1, 1, NULL, NULL, '2', 'Microsoft vs. Google', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-21 14:29:33', 0, 1),
(2, 1, NULL, NULL, '3', 'Microsoft vs. Samsung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-21 14:29:33', 0, 1),
(3, 2, NULL, NULL, '1', 'McDonalds vs. Burger King', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-21 14:29:33', 0, 1),
(4, 2, NULL, NULL, '2', 'Mcdonalds vs. Wendy\'s', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-21 14:29:33', 0, 1),
(5, 3, 'testfirstname', 'testlastname', '12365', 'testmattername', NULL, NULL, 600.00, NULL, NULL, NULL, NULL, '2017-12-22 11:53:13', 0, 1),
(6, 4, 'Sneha', 'Gosewade', '12301', 'CL123M01', NULL, NULL, 45.25, NULL, NULL, NULL, NULL, '2017-12-22 13:46:33', 0, 1),
(8, 6, 'qwerty', 'qwerty', '55501', 'CL55501MT', NULL, NULL, 53.20, NULL, NULL, NULL, NULL, '2017-12-26 05:16:24', 0, 1),
(9, 7, 'qwerty', 'qwerty', '6601', 'CL6601MT', NULL, NULL, 53.20, NULL, NULL, NULL, NULL, '2017-12-26 05:24:58', 0, 1),
(11, 9, 'testname', 'testname', '1112', 'matternew', NULL, NULL, 600.00, NULL, NULL, NULL, NULL, '2017-12-26 06:39:32', 0, 1),
(13, 11, 'sneha', 'Gosewade', 'undefined', 'undefined', NULL, NULL, 53.20, NULL, NULL, NULL, NULL, '2017-12-27 07:29:13', 0, 1),
(14, 12, 'Sneha', 'Gosewade', 'undefined', 'undefined', NULL, NULL, 53.20, NULL, NULL, NULL, NULL, '2017-12-27 07:36:47', 0, 1),
(15, 13, 'Sneha', 'Gosewade', '12301', 'CL123M01', NULL, NULL, 32.30, NULL, NULL, NULL, NULL, '2018-01-03 13:38:30', 0, 1),
(16, 13, 'testing', 'tests', '12303', 'CL123M03', NULL, NULL, 23.32, NULL, NULL, NULL, NULL, '2018-01-05 10:34:30', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=>''inactive'',1=>''active''',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>''deleted'',0=>''not deleted''',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 'The request number {REQUEST_ID} has been marked as {REQUEST_STATUS}', 1, 0, '2018-01-04 06:17:30', '2018-01-04 06:17:30'),
(2, 'The payment for request number {REQUEST_ID} has been {REQUEST_STATUS} ', 1, 0, '2018-01-04 06:17:30', '2018-01-04 06:17:30'),
(3, 'Your payment for request number {REQUEST_ID}  has been  {REQUEST_STATUS}  by Admin', 1, 0, '2018-01-04 04:08:58', '2018-01-04 04:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(6) NOT NULL,
  `sender_id` bigint(6) DEFAULT NULL,
  `reciever_id` bigint(6) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0=>''unread'',1=>''read''',
  `is_sent` tinyint(4) DEFAULT '0' COMMENT '0=>not shown,1=>shown',
  `request_id` bigint(6) DEFAULT NULL,
  `request_status` int(11) DEFAULT NULL,
  `notification_type` varchar(255) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `reciever_id`, `status`, `is_sent`, `request_id`, `request_status`, `notification_type`, `message_id`, `created`, `modified`) VALUES
(2, 3, 2, 0, 1, 20, 0, 'Insert request', 1, '2017-12-27 06:25:24', '2017-12-27 06:25:24'),
(3, 2, 2, 0, 1, 20, 1, 'Update request', 1, '2017-12-27 07:23:22', '2017-12-27 07:23:22'),
(4, 2, 2, 0, 1, 20, 2, 'Update request', 1, '2017-12-27 07:23:27', '2017-12-27 07:23:27'),
(5, 2, 2, 0, 1, 20, 3, 'Update request', 1, '2017-12-27 07:24:05', '2017-12-27 07:24:05'),
(6, 2, 3, 0, 1, 20, 4, 'Update request', 1, '2017-12-27 07:24:13', '2017-12-27 07:24:13'),
(7, 2, 3, 0, 1, 20, 5, 'Update request', 1, '2017-12-27 07:24:14', '2017-12-27 07:24:14'),
(8, 3, 2, 0, 1, 21, 6, 'Insert request', 1, '2017-12-27 07:29:27', '2017-12-27 07:29:27'),
(9, 3, 2, 0, 1, 22, 7, 'Insert request', 1, '2017-12-27 07:36:52', '2017-12-27 07:36:52'),
(10, 3, 2, 0, 1, 23, 8, 'Insert request', 1, '2017-12-27 07:49:31', '2017-12-27 07:49:31'),
(11, 77, 76, 0, 1, 24, 0, 'Insert request', 1, '2018-01-03 13:38:50', '2018-01-03 13:38:50'),
(12, 75, 3, 0, 1, 18, 1, 'Update request', 1, '2018-01-04 14:48:39', '2018-01-04 14:48:39'),
(13, 76, 77, 0, 1, 24, 1, 'Update request', 1, '2018-01-05 05:42:47', '2018-01-05 05:42:47'),
(14, 76, 77, 0, 1, 24, 3, 'Update request', 1, '2018-01-05 05:42:53', '2018-01-05 05:42:53'),
(15, 76, 77, 0, 1, 24, 3, 'Update request', 1, '2018-01-05 06:02:00', '2018-01-05 06:02:00'),
(16, 76, 77, 0, 1, 24, 6, 'Update request', 1, '2018-01-05 06:02:08', '2018-01-05 06:02:08'),
(17, 76, 77, 0, 1, 24, 7, 'Update request', 1, '2018-01-05 06:02:08', '2018-01-05 06:02:08'),
(18, 77, 76, 0, 1, 25, 0, 'Insert request', 1, '2018-01-05 07:12:07', '2018-01-05 07:12:07'),
(19, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 07:21:30', '2018-01-05 07:21:30'),
(20, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 07:21:36', '2018-01-05 07:21:36'),
(21, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 07:33:20', '2018-01-05 07:33:20'),
(22, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 07:33:34', '2018-01-05 07:33:34'),
(23, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 07:33:39', '2018-01-05 07:33:39'),
(24, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 07:36:15', '2018-01-05 07:36:15'),
(25, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 07:39:40', '2018-01-05 07:39:40'),
(26, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 07:42:11', '2018-01-05 07:42:11'),
(27, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 07:44:26', '2018-01-05 07:44:26'),
(28, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 07:52:11', '2018-01-05 07:52:11'),
(29, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 07:52:16', '2018-01-05 07:52:16'),
(30, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 07:57:03', '2018-01-05 07:57:03'),
(31, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 07:57:52', '2018-01-05 07:57:52'),
(32, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 07:57:58', '2018-01-05 07:57:58'),
(33, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:01:19', '2018-01-05 08:01:19'),
(34, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 08:04:00', '2018-01-05 08:04:00'),
(35, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:04:05', '2018-01-05 08:04:05'),
(36, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:05:28', '2018-01-05 08:05:28'),
(37, 76, 77, 1, 1, 25, 1, 'Update request', 1, '2018-01-05 08:07:07', '2018-01-05 08:07:07'),
(38, 76, 77, 1, 1, 25, 3, 'Update request', 1, '2018-01-05 08:07:11', '2018-01-05 08:07:11'),
(39, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:13:51', '2018-01-05 08:13:51'),
(40, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 08:17:41', '2018-01-05 08:17:41'),
(41, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:17:45', '2018-01-05 08:17:45'),
(42, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:21:09', '2018-01-05 08:21:09'),
(43, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 08:25:20', '2018-01-05 08:25:20'),
(44, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:25:25', '2018-01-05 08:25:25'),
(45, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:26:32', '2018-01-05 08:26:32'),
(46, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:26:54', '2018-01-05 08:26:54'),
(47, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 08:27:38', '2018-01-05 08:27:38'),
(48, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:27:43', '2018-01-05 08:27:43'),
(49, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:28:37', '2018-01-05 08:28:37'),
(50, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:29:24', '2018-01-05 08:29:24'),
(51, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:30:20', '2018-01-05 08:30:20'),
(52, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:31:08', '2018-01-05 08:31:08'),
(53, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:32:10', '2018-01-05 08:32:10'),
(54, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 08:32:22', '2018-01-05 08:32:22'),
(55, 76, 77, 0, 1, 25, 1, 'Update request', 1, '2018-01-05 08:32:42', '2018-01-05 08:32:42'),
(56, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 08:32:46', '2018-01-05 08:32:46'),
(57, 2, 1, 0, 1, 1, 3, 'Update request', 1, '2018-01-05 09:11:51', '2018-01-05 09:11:51'),
(58, 76, 77, 0, 1, 25, 3, 'Update request', 1, '2018-01-05 09:13:32', '2018-01-05 09:13:32'),
(59, 76, 77, 0, 1, 25, 6, 'Update request', 1, '2018-01-05 09:13:40', '2018-01-05 09:13:40'),
(60, 76, 77, 0, 1, 25, 7, 'Update request', 1, '2018-01-05 09:13:40', '2018-01-05 09:13:40'),
(61, 77, 76, 0, 1, 26, 0, 'Insert request', 1, '2018-01-05 10:06:51', '2018-01-05 10:06:51'),
(62, 76, 77, 0, 1, 26, 1, 'Update request', 1, '2018-01-05 10:10:56', '2018-01-05 10:10:56'),
(63, 76, 77, 0, 1, 26, 3, 'Update request', 1, '2018-01-05 10:11:03', '2018-01-05 10:11:03'),
(64, 76, 77, 0, 1, 26, 3, 'Update request', 1, '2018-01-05 10:11:17', '2018-01-05 10:11:17'),
(65, 76, 77, 0, 1, 26, 3, 'Update request', 1, '2018-01-05 10:25:27', '2018-01-05 10:25:27'),
(66, 76, 77, 0, 1, 26, 6, 'Update request', 1, '2018-01-05 10:25:35', '2018-01-05 10:25:35'),
(67, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:25:53', '2018-01-05 10:25:53'),
(68, 76, 77, 0, 1, 26, 7, 'Update request', 1, '2018-01-05 10:27:51', '2018-01-05 10:27:51'),
(69, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:28:10', '2018-01-05 10:28:10'),
(70, 76, 77, 0, 1, 26, 0, 'Update request', 1, '2018-01-05 10:32:03', '2018-01-05 10:32:03'),
(71, 76, 77, 0, 1, 26, 1, 'Update request', 1, '2018-01-05 10:32:49', '2018-01-05 10:32:49'),
(72, 77, 76, 0, 1, 27, 0, 'Insert request', 1, '2018-01-05 10:34:43', '2018-01-05 10:34:43'),
(73, 77, 76, 0, 1, 28, 0, 'Insert request', 1, '2018-01-05 10:45:41', '2018-01-05 10:45:41'),
(74, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:47:09', '2018-01-05 10:47:09'),
(75, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:47:09', '2018-01-05 10:47:09'),
(76, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:47:14', '2018-01-05 10:47:14'),
(77, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:47:14', '2018-01-05 10:47:14'),
(78, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:47:44', '2018-01-05 10:47:44'),
(79, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:47:45', '2018-01-05 10:47:45'),
(80, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:49:09', '2018-01-05 10:49:09'),
(81, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:49:09', '2018-01-05 10:49:09'),
(82, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:49:44', '2018-01-05 10:49:44'),
(83, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:49:45', '2018-01-05 10:49:45'),
(84, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:51:09', '2018-01-05 10:51:09'),
(85, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:51:10', '2018-01-05 10:51:10'),
(86, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:51:44', '2018-01-05 10:51:44'),
(87, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:51:45', '2018-01-05 10:51:45'),
(88, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:53:09', '2018-01-05 10:53:09'),
(89, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:53:09', '2018-01-05 10:53:09'),
(90, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:53:44', '2018-01-05 10:53:44'),
(91, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:53:45', '2018-01-05 10:53:45'),
(92, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:55:09', '2018-01-05 10:55:09'),
(93, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:55:09', '2018-01-05 10:55:09'),
(94, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:55:44', '2018-01-05 10:55:44'),
(95, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:55:45', '2018-01-05 10:55:45'),
(96, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:56:52', '2018-01-05 10:56:52'),
(97, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:56:52', '2018-01-05 10:56:52'),
(98, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:04', '2018-01-05 10:57:04'),
(99, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:04', '2018-01-05 10:57:04'),
(100, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:06', '2018-01-05 10:57:06'),
(101, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:07', '2018-01-05 10:57:07'),
(102, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:08', '2018-01-05 10:57:08'),
(103, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:08', '2018-01-05 10:57:08'),
(104, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:09', '2018-01-05 10:57:09'),
(105, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:09', '2018-01-05 10:57:09'),
(106, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:15', '2018-01-05 10:57:15'),
(107, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:15', '2018-01-05 10:57:15'),
(108, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:16', '2018-01-05 10:57:16'),
(109, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:16', '2018-01-05 10:57:16'),
(110, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:19', '2018-01-05 10:57:19'),
(111, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:19', '2018-01-05 10:57:19'),
(112, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:26', '2018-01-05 10:57:26'),
(113, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:26', '2018-01-05 10:57:26'),
(114, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:28', '2018-01-05 10:57:28'),
(115, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:57:28', '2018-01-05 10:57:28'),
(116, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:59:26', '2018-01-05 10:59:26'),
(117, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 10:59:26', '2018-01-05 10:59:26'),
(118, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:01:26', '2018-01-05 11:01:26'),
(119, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:01:26', '2018-01-05 11:01:26'),
(120, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:03:26', '2018-01-05 11:03:26'),
(121, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:03:26', '2018-01-05 11:03:26'),
(122, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:05:26', '2018-01-05 11:05:26'),
(123, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:05:26', '2018-01-05 11:05:26'),
(124, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:07:26', '2018-01-05 11:07:26'),
(125, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:07:26', '2018-01-05 11:07:26'),
(126, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:09:26', '2018-01-05 11:09:26'),
(127, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:09:26', '2018-01-05 11:09:26'),
(128, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:11:26', '2018-01-05 11:11:26'),
(129, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:11:26', '2018-01-05 11:11:26'),
(130, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:13:26', '2018-01-05 11:13:26'),
(131, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:13:26', '2018-01-05 11:13:26'),
(132, 76, 77, 0, 1, 28, 1, 'Update request', 1, '2018-01-05 11:43:26', '2018-01-05 11:43:26'),
(133, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 11:43:31', '2018-01-05 11:43:31'),
(134, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 11:43:42', '2018-01-05 11:43:42'),
(135, 76, 77, 0, 1, 28, 6, 'Update request', 1, '2018-01-05 11:43:56', '2018-01-05 11:43:56'),
(136, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-05 11:43:56', '2018-01-05 11:43:56'),
(140, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:44:12', '2018-01-05 11:44:12'),
(141, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:46:06', '2018-01-05 11:46:06'),
(142, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:46:06', '2018-01-05 11:46:06'),
(143, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:46:42', '2018-01-05 11:46:42'),
(144, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:46:43', '2018-01-05 11:46:43'),
(145, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:46:45', '2018-01-05 11:46:45'),
(146, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:46:45', '2018-01-05 11:46:45'),
(147, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:48:42', '2018-01-05 11:48:42'),
(148, 76, 1, 0, 1, 26, 6, 'Insert Update', 2, '2018-01-05 11:48:43', '2018-01-05 11:48:43'),
(149, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 11:50:09', '2018-01-05 11:50:09'),
(150, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 11:50:28', '2018-01-05 11:50:28'),
(151, 76, 77, 0, 1, 28, 6, 'Update request', 1, '2018-01-05 11:50:35', '2018-01-05 11:50:35'),
(152, NULL, 1, 0, 1, NULL, NULL, 'Insert Update', 2, '2018-01-05 11:50:36', '2018-01-05 11:50:36'),
(153, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 11:54:36', '2018-01-05 11:54:36'),
(154, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 11:56:17', '2018-01-05 11:56:17'),
(155, 76, 77, 0, 1, 28, 6, 'Update request', 1, '2018-01-05 11:56:25', '2018-01-05 11:56:25'),
(156, 76, 1, 0, 1, 28, 6, 'Insert Update', 2, '2018-01-05 11:56:25', '2018-01-05 11:56:25'),
(157, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-05 11:56:25', '2018-01-05 11:56:25'),
(158, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 12:03:02', '2018-01-05 12:03:02'),
(159, 76, 77, 0, 1, 28, 3, 'Update request', 1, '2018-01-05 12:03:45', '2018-01-05 12:03:45'),
(160, 76, 77, 0, 1, 28, 6, 'Update request', 1, '2018-01-05 12:03:53', '2018-01-05 12:03:53'),
(161, 76, 1, 0, 1, 28, 6, 'Insert Update', 2, '2018-01-05 12:03:53', '2018-01-05 12:03:53'),
(162, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-05 12:03:53', '2018-01-05 12:03:53'),
(163, 76, 77, 0, 1, 27, 1, 'Update request', 1, '2018-01-05 12:29:56', '2018-01-05 12:29:56'),
(164, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-05 15:06:05', '2018-01-05 15:06:05'),
(165, 76, 77, 0, 1, 26, 0, 'Update request', 1, '2018-01-05 15:06:32', '2018-01-05 15:06:32'),
(166, 76, 77, 0, 1, 26, 1, 'Update request', 1, '2018-01-05 15:09:15', '2018-01-05 15:09:15'),
(167, 76, 77, 0, 1, 26, 3, 'Update request', 1, '2018-01-05 15:09:21', '2018-01-05 15:09:21'),
(168, 76, 77, 0, 1, 26, 3, 'Update request', 1, '2018-01-05 15:11:31', '2018-01-05 15:11:31'),
(169, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-06 08:42:37', '2018-01-06 08:42:37'),
(170, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-06 08:57:52', '2018-01-06 08:57:52'),
(171, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-06 09:09:06', '2018-01-06 09:09:06'),
(172, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-06 09:13:32', '2018-01-06 09:13:32'),
(173, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-06 09:18:50', '2018-01-06 09:18:50'),
(174, 76, 77, 0, 1, 25, 0, 'Update request', 1, '2018-01-06 09:31:21', '2018-01-06 09:31:21'),
(175, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:36:10', '2018-01-06 09:36:10'),
(176, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:38:53', '2018-01-06 09:38:53'),
(177, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:39:01', '2018-01-06 09:39:01'),
(178, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:39:09', '2018-01-06 09:39:09'),
(179, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:39:17', '2018-01-06 09:39:17'),
(180, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:39:25', '2018-01-06 09:39:25'),
(181, 76, 77, 0, 1, 28, 7, 'Update request', 1, '2018-01-06 09:39:33', '2018-01-06 09:39:33'),
(182, 76, 77, 0, 1, 24, 7, 'Update request', 1, '2018-01-06 09:39:41', '2018-01-06 09:39:41'),
(183, 77, 76, 0, 1, 29, 0, 'Insert request', 1, '2018-01-06 11:41:04', '2018-01-06 11:41:04'),
(184, 76, 77, 0, 1, 29, 1, 'Update request', 1, '2018-01-06 11:50:45', '2018-01-06 11:50:45'),
(185, 76, 77, 0, 1, 29, 3, 'Update request', 1, '2018-01-06 11:50:54', '2018-01-06 11:50:54'),
(186, 76, 77, 0, 1, 29, 3, 'Update request', 1, '2018-01-06 11:51:09', '2018-01-06 11:51:09'),
(187, 76, 77, 0, 1, 29, 6, 'Update request', 1, '2018-01-06 11:51:17', '2018-01-06 11:51:17'),
(188, 76, 1, 0, 1, 29, 6, 'Insert Update', 2, '2018-01-06 11:51:17', '2018-01-06 11:51:17'),
(189, 76, 77, 0, 1, 29, 7, 'Update request', 1, '2018-01-06 11:51:17', '2018-01-06 11:51:17'),
(190, 1, 76, 0, 1, 29, 6, 'Payment to provider', 3, '2018-01-06 11:51:49', '2018-01-06 11:51:49'),
(191, 76, 77, 0, 1, 29, 7, 'Update request', 1, '2018-01-06 11:51:49', '2018-01-06 11:51:49'),
(192, 75, 3, 0, 0, 18, 0, 'Update request', 1, '2018-01-08 17:03:39', '2018-01-08 17:03:39'),
(193, 75, 3, 0, 0, 18, 1, 'Update request', 1, '2018-01-08 17:04:20', '2018-01-08 17:04:20'),
(194, 75, 3, 0, 0, 18, 2, 'Update request', 1, '2018-01-08 17:07:16', '2018-01-08 17:07:16'),
(195, 75, 3, 0, 0, 18, 0, 'Update request', 1, '2018-01-08 17:07:18', '2018-01-08 17:07:18'),
(196, 75, 3, 0, 0, 18, 1, 'Update request', 1, '2018-01-08 17:15:51', '2018-01-08 17:15:51'),
(197, 75, 3, 0, 0, 18, 0, 'Update request', 1, '2018-01-08 17:17:17', '2018-01-08 17:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `cost_of_request` float(7,2) DEFAULT NULL,
  `system_fee` float(7,2) DEFAULT NULL,
  `total_cost` float(7,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `stripe_transaction_id` varchar(255) DEFAULT NULL,
  `paid_status` enum('y','n') DEFAULT NULL COMMENT 'y=>''yes'',n=>''no''',
  `remember` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>not remember,1=>remember',
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL COMMENT 'user id who made payment',
  `modified_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>''active'',0=>''inactive'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `request_id`, `cost_of_request`, `system_fee`, `total_cost`, `transaction_id`, `stripe_transaction_id`, `paid_status`, `remember`, `payment_date`, `created`, `modified`, `created_by`, `modified_by`, `status`) VALUES
(1, 74, NULL, NULL, 50.00, 'cus_BoCWsUgpTY9twi', NULL, 'n', 0, '2017-11-21 11:40:36', '2017-11-21 00:00:00', '2017-11-21 11:40:36', 21, NULL, 0),
(2, 76, NULL, NULL, 25.00, 'cus_BoCjQuy74mJPS3', NULL, 'n', 0, '2017-11-21 11:54:01', '2017-11-21 00:00:00', '2017-11-21 11:54:01', 21, NULL, 0),
(3, 87, NULL, NULL, 25.00, 'cus_BoEIf6hxsIMtqa', NULL, 'n', 0, '2017-11-21 13:30:20', '2017-11-21 00:00:00', '2017-11-21 13:30:20', 21, NULL, 0),
(4, 90, NULL, NULL, 25.00, 'cus_BoG2t10cKuOvQY', NULL, 'n', 0, '2017-11-21 15:18:36', '2017-11-21 00:00:00', '2017-11-21 15:18:36', 21, NULL, 0),
(5, 91, NULL, NULL, 45.00, 'cus_BoSrSCj0F1Pu7g', NULL, 'n', 0, '2017-11-22 04:33:41', '2017-11-22 00:00:00', '2017-11-22 04:33:41', 61, NULL, 0),
(6, 102, NULL, NULL, 45.00, 'cus_BoUe785D9EQnn5', NULL, 'n', 0, '2017-11-22 06:24:46', '2017-11-22 00:00:00', '2017-11-22 06:24:46', 61, NULL, 0),
(7, 104, NULL, NULL, 43.00, 'cus_BoUyKYPDotdnu5', NULL, 'n', 0, '2017-11-22 06:44:24', '2017-11-22 00:00:00', '2017-11-22 06:44:24', 61, NULL, 0),
(8, 105, NULL, NULL, 43.00, 'cus_BoUzW2gEmpqE7c', NULL, 'n', 0, '2017-11-22 06:45:37', '2017-11-22 00:00:00', '2017-11-22 06:45:37', 61, NULL, 0),
(9, 112, NULL, NULL, 5.23, 'cus_BoVM7Uo45GU5UX', NULL, 'n', 0, '2017-11-22 07:09:08', '2017-11-22 00:00:00', '2017-11-22 07:09:08', 21, NULL, 0),
(10, 113, NULL, NULL, 123.00, 'cus_BoVRDkmR2yPGh4', NULL, 'n', 0, '2017-11-22 07:14:09', '2017-11-22 00:00:00', '2017-11-22 07:14:09', 61, NULL, 0),
(11, 116, NULL, NULL, 32.00, 'cus_BoVhAPhIkHcyD7', NULL, 'n', 0, '2017-11-22 07:29:53', '2017-11-22 00:00:00', '2017-11-22 07:29:53', 61, NULL, 0),
(12, 117, NULL, NULL, 33.00, 'cus_BoVjUJBb5GkEsN', NULL, 'n', 0, '2017-11-22 07:31:55', '2017-11-22 00:00:00', '2017-11-22 07:31:55', 61, NULL, 0),
(13, 119, NULL, NULL, 8.20, 'cus_BoVvBgBai3gb8E', NULL, 'n', 0, '2017-11-22 07:43:57', '2017-11-22 00:00:00', '2017-11-22 07:43:57', 21, NULL, 0),
(14, 118, NULL, NULL, 34.00, 'cus_BoW2WWLBbF5JkV', NULL, 'n', 0, '2017-11-22 07:51:02', '2017-11-22 00:00:00', '2017-11-22 07:51:02', 61, NULL, 0),
(15, 120, NULL, NULL, 33.33, 'cus_BoWAppuBDa8MvT', NULL, 'n', 0, '2017-11-22 07:59:17', '2017-11-22 00:00:00', '2017-11-22 07:59:17', 21, NULL, 0),
(16, 121, NULL, NULL, 32.00, 'cus_BoX57a19qr0cMx', NULL, 'n', 0, '2017-11-22 08:55:37', '2017-11-22 00:00:00', '2017-11-22 08:55:37', 61, NULL, 0),
(17, 123, NULL, NULL, 55.55, 'cus_BoXFFcb3mUBV6k', NULL, 'n', 0, '2017-11-22 09:05:30', '2017-11-22 00:00:00', '2017-11-22 09:05:30', 21, NULL, 0),
(18, 123, NULL, NULL, 55.55, 'cus_BoXOata0b7y9aV', NULL, 'n', 0, '2017-11-22 09:15:12', '2017-11-22 00:00:00', '2017-11-22 09:15:12', 21, NULL, 0),
(19, 123, NULL, NULL, 55.55, 'cus_BoXQA8i268BZqD', NULL, 'n', 0, '2017-11-22 09:16:22', '2017-11-22 00:00:00', '2017-11-22 09:16:22', 21, NULL, 0),
(20, 123, NULL, NULL, 55.55, 'cus_BoXRdAC3ddcHSu', NULL, 'n', 0, '2017-11-22 09:17:47', '2017-11-22 00:00:00', '2017-11-22 09:17:47', 21, NULL, 0),
(21, 123, NULL, NULL, 55.55, 'cus_BoXZhO4yC4oDhM', NULL, 'n', 0, '2017-11-22 09:25:45', '2017-11-22 00:00:00', '2017-11-22 09:25:45', 21, NULL, 0),
(22, 122, NULL, NULL, 54.00, 'cus_BoXf3ayfjwFWu8', NULL, 'n', 0, '2017-11-22 09:31:43', '2017-11-22 00:00:00', '2017-11-22 09:31:43', 61, NULL, 0),
(23, 124, NULL, NULL, 43.00, 'cus_BoXgMpPqC4fjAq', NULL, 'n', 0, '2017-11-22 09:33:01', '2017-11-22 00:00:00', '2017-11-22 09:33:01', 61, NULL, 0),
(25, 25, NULL, NULL, 23.00, 'cus_C4zP6lCzUhDvYD', 'ch_1BgrGhL29sv8fqLrOutXyoMS', 'y', 0, '2018-01-05 09:13:40', '2018-01-05 00:00:00', '2018-01-05 07:15:55', 77, NULL, 0),
(125, 125, NULL, NULL, 5.23, 'cus_BoYEFTH4hUOGDQ', NULL, 'n', 0, '2017-11-22 10:06:48', '2017-11-22 00:00:00', '2017-11-22 10:04:15', 21, NULL, 0),
(126, 126, NULL, NULL, 66.66, 'cus_BoYVOl5pDjdGyR', NULL, 'n', 0, '2017-11-22 10:23:50', '2017-11-22 00:00:00', '2017-11-22 10:23:50', 21, NULL, 0),
(127, 127, NULL, NULL, 25.35, 'cus_BoYpq511S9WaWU', NULL, 'n', 0, '2017-11-22 10:44:05', '2017-11-22 00:00:00', '2017-11-22 10:44:05', 21, NULL, 0),
(128, 128, NULL, NULL, 12.00, 'cus_BoxcR7p8BO6T2Q', NULL, 'n', 0, '2017-11-23 12:21:12', '2017-11-23 00:00:00', '2017-11-23 12:21:12', 21, NULL, 0),
(129, 129, NULL, NULL, 44.00, 'cus_BowFJxh8q95J8t', NULL, 'n', 0, '2017-11-23 10:55:49', '2017-11-23 00:00:00', '2017-11-23 10:55:49', 21, NULL, 0),
(130, 130, NULL, NULL, 23.23, 'cus_Bownq7s4Q2wee9', NULL, 'n', 0, '2017-11-23 11:29:28', '2017-11-23 00:00:00', '2017-11-23 11:29:28', 21, NULL, 0),
(132, 132, NULL, NULL, 534.00, 'cus_BoxevEGZPsbzt9', NULL, 'n', 0, '2017-11-23 12:23:10', '2017-11-23 00:00:00', '2017-11-23 12:23:10', 21, NULL, 0),
(134, 134, NULL, NULL, 100.20, 'cus_BpDar4umcXQyxX', NULL, 'n', 0, '2017-11-24 04:50:30', '2017-11-24 00:00:00', '2017-11-24 04:50:30', 92, NULL, 0),
(135, 135, NULL, NULL, 123.00, 'cus_BpDrfLWZuGhlVg', NULL, 'n', 0, '2017-11-24 05:07:34', '2017-11-24 00:00:00', '2017-11-24 05:07:34', 92, NULL, 0),
(136, 136, NULL, NULL, 100.00, 'cus_BpEGTMEiCDyl02', NULL, 'n', 0, '2017-11-24 05:32:38', '2017-11-24 00:00:00', '2017-11-24 05:32:38', 92, NULL, 0),
(137, 137, NULL, NULL, 100.00, 'cus_BpFq4qvl6RGpTT', NULL, 'n', 0, '2017-11-24 07:10:35', '2017-11-24 00:00:00', '2017-11-24 07:10:35', 92, NULL, 0),
(138, 138, NULL, NULL, 100.22, 'cus_BpJ11wP8Vlt6BH', NULL, 'n', 0, '2017-11-24 10:27:52', '2017-11-24 00:00:00', '2017-11-24 10:27:52', 92, NULL, 0),
(139, 139, NULL, NULL, 200.00, 'cus_BpJDhiBZbHxa2N', NULL, 'n', 0, '2017-11-24 10:39:55', '2017-11-24 00:00:00', '2017-11-24 10:39:55', 92, NULL, 0),
(140, 140, NULL, NULL, 3.25, 'cus_BqLHuCo6BJTLks', NULL, 'n', 0, '2017-11-27 04:52:14', '2017-11-27 00:00:00', '2017-11-27 04:52:14', 21, NULL, 0),
(141, 141, NULL, NULL, 36.23, 'cus_BqTOK6rqxrl3uS', NULL, 'n', 0, '2017-11-27 13:15:19', '2017-11-27 00:00:00', '2017-11-27 13:15:19', 21, NULL, 0),
(143, 143, NULL, NULL, 36.23, 'cus_BqjvmZg8tSkqJo', NULL, 'n', 0, '2017-11-28 06:19:29', '2017-11-28 00:00:00', '2017-11-28 06:19:29', 21, NULL, 0),
(144, 144, NULL, NULL, 36.23, 'cus_BqkqLJKzbmupNT', NULL, 'n', 0, '2017-11-28 07:16:38', '2017-11-28 00:00:00', '2017-11-28 07:16:38', 21, NULL, 0),
(145, 145, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 1, '2017-11-29 09:28:52', '2017-11-29 00:00:00', '2017-11-29 08:53:46', 21, NULL, 0),
(148, 148, NULL, NULL, 36.23, 'cus_Brd9zREvarTfVv', NULL, 'n', 1, '2017-11-30 15:24:23', '2017-11-30 00:00:00', '2017-11-30 15:24:23', 21, NULL, 0),
(149, 149, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-01 06:52:27', '2017-12-01 00:00:00', '2017-12-01 06:52:27', 21, NULL, 0),
(150, 149, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-01 06:54:48', '2017-12-01 00:00:00', '2017-12-01 06:54:48', 21, NULL, 0),
(151, 151, NULL, NULL, 36.23, 'cus_BrtjKhX16XsWpC', NULL, 'n', 0, '2017-12-01 08:31:53', '2017-12-01 00:00:00', '2017-12-01 06:55:35', 21, NULL, 0),
(152, 152, NULL, NULL, 45.00, 'cus_BruiKT8glA6Qt9', NULL, 'n', 0, '2017-12-01 09:32:32', '2017-12-01 00:00:00', '2017-12-01 07:01:21', 95, NULL, 0),
(153, 149, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-01 07:03:57', '2017-12-01 00:00:00', '2017-12-01 07:03:57', 21, NULL, 0),
(154, 154, NULL, NULL, 100.00, 'cus_Bt33OP20P31Ag3', NULL, 'n', 1, '2017-12-04 10:13:46', '2017-12-04 00:00:00', '2017-12-01 07:04:28', 92, NULL, 0),
(155, 149, NULL, NULL, 36.23, 'cus_Brd9zREvarTfVv', NULL, 'n', 0, '2017-12-01 07:05:03', '2017-12-01 00:00:00', '2017-12-01 07:05:03', 21, NULL, 0),
(156, 149, NULL, NULL, 36.23, 'cus_Brd9zREvarTfVv', NULL, 'n', 0, '2017-12-01 07:06:03', '2017-12-01 00:00:00', '2017-12-01 07:06:03', 21, NULL, 0),
(157, 149, NULL, NULL, 36.23, 'cus_Brd9zREvarTfVv', NULL, 'n', 0, '2017-12-01 07:06:15', '2017-12-01 00:00:00', '2017-12-01 07:06:15', 21, NULL, 0),
(158, 151, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-01 08:32:17', '2017-12-01 00:00:00', '2017-12-01 08:32:17', 21, NULL, 0),
(159, 156, NULL, NULL, 100.00, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-04 10:44:21', '2017-12-04 00:00:00', '2017-12-04 10:44:21', 92, NULL, 0),
(160, 157, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-04 11:29:38', '2017-12-04 00:00:00', '2017-12-04 11:29:38', 92, NULL, 0),
(161, 158, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 11:29:18', '2017-12-05 00:00:00', '2017-12-05 11:29:18', 92, NULL, 0),
(162, 159, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 11:33:18', '2017-12-05 00:00:00', '2017-12-05 11:33:18', 92, NULL, 0),
(163, 160, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 11:42:37', '2017-12-05 00:00:00', '2017-12-05 11:42:37', 92, NULL, 0),
(164, 161, NULL, NULL, 100.22, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 11:50:47', '2017-12-05 00:00:00', '2017-12-05 11:50:47', 92, NULL, 0),
(165, 162, NULL, NULL, 100.22, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 11:59:22', '2017-12-05 00:00:00', '2017-12-05 11:59:22', 92, NULL, 0),
(166, 163, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 12:22:56', '2017-12-05 00:00:00', '2017-12-05 12:22:56', 92, NULL, 0),
(167, 164, NULL, NULL, 100.22, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 12:37:59', '2017-12-05 00:00:00', '2017-12-05 12:37:59', 92, NULL, 0),
(168, 166, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-05 15:52:04', '2017-12-05 00:00:00', '2017-12-05 15:52:04', 92, NULL, 0),
(169, 181, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-07 14:22:40', '2017-12-07 00:00:00', '2017-12-07 14:22:40', 92, NULL, 0),
(170, 182, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-07 14:48:47', '2017-12-07 00:00:00', '2017-12-07 14:48:47', 92, NULL, 0),
(183, 183, NULL, NULL, 100.01, 'cus_BuFXpZV2RsVkYU', NULL, 'n', 1, '2017-12-07 15:12:30', '2017-12-07 00:00:00', '2017-12-07 15:12:30', 92, NULL, 0),
(184, 184, NULL, NULL, 100.01, 'cus_Bt33OP20P31Ag3', NULL, 'n', 0, '2017-12-07 15:53:41', '2017-12-07 00:00:00', '2017-12-07 15:53:41', 92, NULL, 0),
(185, 185, NULL, NULL, 100.01, 'cus_BuH9aIDE8yizBo', NULL, 'n', 1, '2017-12-07 16:51:51', '2017-12-07 00:00:00', '2017-12-07 16:51:31', 92, NULL, 0),
(186, 186, NULL, NULL, 100.01, 'cus_BuH9aIDE8yizBo', NULL, 'n', 0, '2017-12-07 16:53:45', '2017-12-07 00:00:00', '2017-12-07 16:53:45', 92, NULL, 0),
(187, 187, NULL, NULL, 100.01, 'cus_BuFXpZV2RsVkYU', NULL, 'n', 0, '2017-12-07 16:57:49', '2017-12-07 00:00:00', '2017-12-07 16:57:49', 92, NULL, 0),
(188, 187, NULL, NULL, 100.01, 'cus_BuFXpZV2RsVkYU', NULL, 'n', 0, '2017-12-07 16:57:54', '2017-12-07 00:00:00', '2017-12-07 16:57:54', 92, NULL, 0),
(189, 189, NULL, NULL, 500.01, 'cus_BuFXpZV2RsVkYU', NULL, 'n', 0, '2017-12-08 03:58:37', '2017-12-08 00:00:00', '2017-12-08 03:58:37', 92, NULL, 0),
(190, 190, NULL, NULL, 650.01, 'cus_BuH8yzH6H4gFJu', NULL, 'n', 0, '2017-12-08 04:27:58', '2017-12-08 00:00:00', '2017-12-08 04:27:58', 92, NULL, 0),
(191, 194, NULL, NULL, 100.01, 'cus_BuH9aIDE8yizBo', NULL, 'n', 0, '2017-12-08 12:34:07', '2017-12-08 00:00:00', '2017-12-08 12:34:07', 92, NULL, 0),
(195, 195, NULL, NULL, 122.00, 'cus_Buam9Nr8kzSp9D', NULL, 'n', 0, '2017-12-08 13:09:17', '2017-12-08 00:00:00', '2017-12-08 13:09:17', 96, NULL, 0),
(196, 196, NULL, NULL, 89.00, 'cus_BuayVhmbFbrnCn', NULL, 'n', 1, '2017-12-08 13:21:10', '2017-12-08 00:00:00', '2017-12-08 13:21:10', 96, NULL, 0),
(197, 197, NULL, NULL, 56.00, 'cus_BuayVhmbFbrnCn', NULL, 'n', 0, '2017-12-08 15:42:52', '2017-12-08 00:00:00', '2017-12-08 15:42:52', 96, NULL, 0),
(198, 198, NULL, NULL, 102.00, 'cus_BuayVhmbFbrnCn', NULL, 'n', 0, '2017-12-08 16:23:31', '2017-12-08 00:00:00', '2017-12-08 16:23:31', 96, NULL, 0),
(199, 221, NULL, NULL, 0.00, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-11 14:59:23', '2017-12-11 00:00:00', '2017-12-11 14:59:23', 21, NULL, 0),
(200, 222, NULL, NULL, 0.00, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-11 15:24:21', '2017-12-11 00:00:00', '2017-12-11 15:24:21', 21, NULL, 0),
(223, 223, NULL, NULL, 102.33, 'cus_BvyFb6GZdY4nc2', NULL, 'n', 0, '2017-12-12 05:28:01', '2017-12-12 00:00:00', '2017-12-12 05:28:01', 95, NULL, 0),
(224, 224, NULL, NULL, 36.23, 'cus_Brd9zREvarTfVv', NULL, 'n', 0, '2017-12-12 11:13:08', '2017-12-12 00:00:00', '2017-12-12 11:13:08', 21, NULL, 0),
(225, 225, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-12 11:15:42', '2017-12-12 00:00:00', '2017-12-12 11:15:42', 21, NULL, 0),
(227, 227, NULL, NULL, 36.23, 'cus_BwNHScznYXXkOb', NULL, 'n', 0, '2017-12-13 07:20:18', '2017-12-13 00:00:00', '2017-12-13 07:20:18', 21, NULL, 0),
(228, 228, NULL, NULL, 36.23, 'cus_BwNJh4ivyDbCuI', NULL, 'n', 0, '2017-12-13 07:22:09', '2017-12-13 00:00:00', '2017-12-13 07:22:09', 21, NULL, 0),
(229, 229, NULL, NULL, 36.23, 'cus_Brd9zREvarTfVv', NULL, 'n', 0, '2017-12-13 07:23:03', '2017-12-13 00:00:00', '2017-12-13 07:23:03', 21, NULL, 0),
(230, 230, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-13 09:41:48', '2017-12-13 00:00:00', '2017-12-13 09:41:48', 21, NULL, 0),
(231, 231, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-13 09:43:05', '2017-12-13 00:00:00', '2017-12-13 09:43:05', 21, NULL, 0),
(232, 232, NULL, NULL, 36.23, 'cus_BrAC7W3zqFofZH', NULL, 'n', 0, '2017-12-13 10:24:57', '2017-12-13 00:00:00', '2017-12-13 10:24:57', 21, NULL, 0),
(233, 233, NULL, NULL, 69.00, 'cus_BwjShjd1RcObsw', NULL, 'n', 1, '2017-12-14 06:15:05', '2017-12-14 00:00:00', '2017-12-14 06:15:05', 99, NULL, 0),
(234, 234, NULL, NULL, 23.20, 'cus_BwjShjd1RcObsw', NULL, 'n', 0, '2017-12-14 12:19:38', '2017-12-14 00:00:00', '2017-12-14 12:19:38', 99, NULL, 0),
(235, 235, NULL, NULL, 23.01, 'cus_BwjShjd1RcObsw', NULL, 'n', 0, '2017-12-15 04:52:29', '2017-12-15 00:00:00', '2017-12-15 04:52:29', 99, NULL, 0),
(236, 236, NULL, NULL, 432.00, 'cus_BwjShjd1RcObsw', NULL, 'n', 0, '2017-12-15 04:57:05', '2017-12-15 00:00:00', '2017-12-15 04:57:05', 99, NULL, 0),
(237, 237, NULL, NULL, 2.00, 'cus_BwjShjd1RcObsw', NULL, 'n', 0, '2017-12-15 04:58:29', '2017-12-15 00:00:00', '2017-12-15 04:58:29', 99, NULL, 0),
(238, 238, NULL, NULL, 65.00, 'cus_BuayVhmbFbrnCn', NULL, 'n', 0, '2017-12-15 12:44:26', '2017-12-15 00:00:00', '2017-12-15 12:44:26', 96, NULL, 0),
(239, 1, NULL, NULL, 23.20, 'cus_BxF9uuezVfyeT6', NULL, 'n', 0, '2017-12-15 14:59:48', '2017-12-15 00:00:00', '2017-12-15 14:59:48', 1, NULL, 0),
(240, 2, NULL, NULL, 32.20, 'cus_BxFHq5uTXEDE9Z', NULL, 'n', 1, '2017-12-15 15:08:16', '2017-12-15 00:00:00', '2017-12-15 15:08:16', 1, NULL, 0),
(241, 3, NULL, NULL, 900.00, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 1, '2017-12-18 12:48:17', '2017-12-18 00:00:00', '2017-12-18 12:48:17', 3, NULL, 0),
(242, 4, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', 'ch_1BcrlGL29sv8fqLrsKJwmwju', 'y', 0, '2017-12-25 08:56:42', '2017-12-19 00:00:00', '2017-12-19 08:07:03', 3, NULL, 0),
(243, 5, NULL, NULL, 568.00, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-19 08:45:30', '2017-12-19 00:00:00', '2017-12-19 08:45:30', 3, NULL, 0),
(244, 6, NULL, NULL, 565.00, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-19 09:15:03', '2017-12-19 00:00:00', '2017-12-19 09:15:03', 3, NULL, 0),
(245, 7, NULL, NULL, 434.00, 'cus_ByzBjDaOZZ5dbe', NULL, 'n', 0, '2017-12-20 06:37:47', '2017-12-20 00:00:00', '2017-12-20 06:37:47', 74, NULL, 0),
(246, 8, NULL, NULL, 541.00, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-20 09:34:11', '2017-12-20 00:00:00', '2017-12-20 09:34:11', 3, NULL, 0),
(247, 9, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-20 13:09:29', '2017-12-20 00:00:00', '2017-12-20 13:09:29', 3, NULL, 0),
(248, 10, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-21 06:24:42', '2017-12-21 00:00:00', '2017-12-21 06:24:42', 3, NULL, 0),
(249, 11, NULL, NULL, 600.00, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-22 11:57:17', '2017-12-22 00:00:00', '2017-12-22 11:57:17', 3, NULL, 0),
(250, 12, NULL, NULL, 45.25, 'cus_BzqYzEPPGFQzsE', 'ch_1BbrEhL29sv8fqLrErl6MtRo', 'y', 1, '2017-12-22 14:10:56', '2017-12-22 00:00:00', '2017-12-22 13:47:14', 74, NULL, 0),
(251, 13, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', 'ch_1BcsogL29sv8fqLrmo6VyRDV', 'y', 0, '2017-12-25 10:04:18', '2017-12-25 00:00:00', '2017-12-25 09:00:18', 3, NULL, 0),
(252, 14, NULL, NULL, 53.20, 'cus_C0wTEwZMzhAVCA', 'ch_1BcudKL29sv8fqLr7Rx1gJSt', 'y', 0, '2017-12-25 12:00:43', '2017-12-25 00:00:00', '2017-12-25 11:57:34', 3, NULL, 0),
(253, 15, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', 'ch_1BdA0IL29sv8fqLrZngI3xp6', 'y', 0, '2017-12-26 04:25:27', '2017-12-26 00:00:00', '2017-12-26 03:58:02', 3, NULL, 0),
(254, 16, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-26 06:19:21', '2017-12-26 00:00:00', '2017-12-26 06:19:21', 3, NULL, 0),
(255, 17, NULL, NULL, 53.20, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-26 06:27:15', '2017-12-26 00:00:00', '2017-12-26 06:27:15', 3, NULL, 0),
(256, 18, NULL, NULL, 600.00, 'cus_ByKhCgUU8hAUkB', NULL, 'n', 0, '2017-12-26 06:39:39', '2017-12-26 00:00:00', '2017-12-26 06:39:39', 3, NULL, 0),
(257, 20, NULL, NULL, 53.20, 'cus_C1bZbfDIRNrGwa', 'ch_1BdZGrL29sv8fqLrRwpjUylq', 'y', 1, '2017-12-27 07:24:13', '2017-12-27 00:00:00', '2017-12-27 06:25:47', 3, NULL, 0),
(258, 21, NULL, NULL, 53.20, 'cus_C1bZbfDIRNrGwa', NULL, 'n', 0, '2017-12-27 07:29:27', '2017-12-27 00:00:00', '2017-12-27 07:29:27', 3, NULL, 0),
(259, 22, NULL, NULL, 53.20, 'cus_C1bZbfDIRNrGwa', NULL, 'n', 0, '2017-12-27 07:36:52', '2017-12-27 00:00:00', '2017-12-27 07:36:52', 3, NULL, 0),
(260, 23, NULL, NULL, 560.00, 'cus_C1bZbfDIRNrGwa', NULL, 'n', 0, '2017-12-27 07:49:32', '2017-12-27 00:00:00', '2017-12-27 07:49:32', 3, NULL, 0),
(261, 24, NULL, NULL, 32.30, 'cus_C4L84Z90JxjZLk', 'ch_1BgoHLL29sv8fqLryI8RDAME', 'y', 0, '2018-01-05 06:02:08', '2018-01-03 00:00:00', '2018-01-03 13:38:57', 77, NULL, 0),
(262, 26, NULL, NULL, 23.32, 'cus_C52AGaruLHanZb', 'ch_1BgsOIL29sv8fqLrNJmoc1Q4', 'y', 1, '2018-01-05 10:25:35', '2018-01-05 00:00:00', '2018-01-05 10:07:12', 77, NULL, 0),
(263, 27, NULL, NULL, 23.32, 'cus_C52AGaruLHanZb', NULL, 'n', 0, '2018-01-05 10:34:43', '2018-01-05 00:00:00', '2018-01-05 10:34:43', 77, NULL, 0),
(264, 28, NULL, NULL, 63.23, 'cus_C52AGaruLHanZb', 'ch_1BgtvQL29sv8fqLrzJvp2jWO', 'y', 0, '2018-01-05 12:03:53', '2018-01-05 00:00:00', '2018-01-05 10:45:42', 77, NULL, 0),
(265, 29, NULL, NULL, 55.00, 'cus_C52AGaruLHanZb', 'ch_1BhGCmL29sv8fqLrhz3Zw0vT', 'y', 0, '2018-01-06 11:51:17', '2018-01-06 00:00:00', '2018-01-06 11:41:04', 77, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `provider_details`
--

CREATE TABLE `provider_details` (
  `id` bigint(20) NOT NULL,
  `provider_id` bigint(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `ssn` varchar(15) DEFAULT NULL,
  `personal_id_number` int(20) DEFAULT NULL,
  `entityType` int(11) DEFAULT NULL COMMENT '0 => ''Individual'', 1 => ''Company''',
  `businessName` varchar(50) DEFAULT NULL,
  `business_tax_id` varchar(20) DEFAULT NULL,
  `ext_account_holder_name` varchar(20) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `ext_account_holder_type` varchar(20) DEFAULT NULL,
  `routing_number` int(20) DEFAULT NULL,
  `account_number` int(20) DEFAULT NULL,
  `pref_currency` varchar(3) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provider_details`
--

INSERT INTO `provider_details` (`id`, `provider_id`, `dob`, `ssn`, `personal_id_number`, `entityType`, `businessName`, `business_tax_id`, `ext_account_holder_name`, `bank_name`, `ext_account_holder_type`, `routing_number`, `account_number`, `pref_currency`, `country`, `created`, `modified`) VALUES
(1, 6, '1986-03-12', '456-787-8255', 798431316, 0, NULL, NULL, 'John Smith', 'Cosmos Bank', NULL, 110000000, 123456789, NULL, NULL, '2018-01-08 10:37:31', '2018-01-08 10:37:31'),
(2, 75, '1970-07-22', '445-54-4544', 798431316, 0, NULL, NULL, 'Jane Austen', 'STRIPE TEST BANK', NULL, 111000025, 123456789, NULL, NULL, '2018-01-08 16:01:15', '2018-01-08 16:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `provider_payments`
--

CREATE TABLE `provider_payments` (
  `id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL COMMENT 'from request table',
  `provider_id` bigint(6) DEFAULT NULL COMMENT 'from user table',
  `provider_fees` float(7,2) DEFAULT NULL COMMENT 'provider fees without admin share',
  `transaction_id` varchar(200) NOT NULL COMMENT 'stripe transcation id',
  `payment_status` tinyint(4) DEFAULT NULL COMMENT '0=>un paid, 1=>paid',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provider_payments`
--

INSERT INTO `provider_payments` (`id`, `request_id`, `provider_id`, `provider_fees`, `transaction_id`, `payment_status`, `created`, `modified`) VALUES
(1, 28, 76, 8000.00, '1', 0, '2018-01-05 15:01:53', '2018-01-05 15:01:53'),
(2, 26, 76, 48.00, 'tr_1BgwpKL29sv8fqLrpLajQSYm', 1, '2018-01-05 15:09:47', '2018-01-05 15:09:47'),
(3, 26, 76, 96.00, 'tr_1BgwqzL29sv8fqLrsCanGiE8', 1, '2018-01-05 15:11:31', '2018-01-05 15:11:31'),
(4, 25, 76, 90.00, 'tr_1BhDGCL29sv8fqLrOmeyrhab', 1, '2018-01-06 08:42:37', '2018-01-06 08:42:37'),
(5, 25, 76, 90.00, 'tr_1BhDUxL29sv8fqLrsi7funDq', 1, '2018-01-06 08:57:52', '2018-01-06 08:57:52'),
(6, 25, 76, 90.00, 'tr_1BhDfoL29sv8fqLrVJB5vPrG', 1, '2018-01-06 09:09:05', '2018-01-06 09:09:05'),
(7, 25, 76, 90.00, 'tr_1BhDk7L29sv8fqLrMpdVJFSC', 1, '2018-01-06 09:13:31', '2018-01-06 09:13:31'),
(8, 25, 76, 90.00, 'tr_1BhDpFL29sv8fqLrgmnASLp6', 1, '2018-01-06 09:18:50', '2018-01-06 09:18:50'),
(9, 25, 76, 90.00, 'tr_1BhE1ML29sv8fqLrnc61AJok', 1, '2018-01-06 09:31:21', '2018-01-06 09:31:21'),
(10, 28, 76, 80.00, 'tr_1BhE61L29sv8fqLrImbzW4mv', 1, '2018-01-06 09:36:10', '2018-01-06 09:36:10'),
(11, 28, 76, 80.00, 'tr_1BhE8eL29sv8fqLrTrfpfCRy', 1, '2018-01-06 09:38:53', '2018-01-06 09:38:53'),
(12, 28, 76, 80.00, 'tr_1BhE8mL29sv8fqLrW45oa7cY', 1, '2018-01-06 09:39:01', '2018-01-06 09:39:01'),
(13, 28, 76, 80.00, 'tr_1BhE8uL29sv8fqLrzMx4eVmg', 1, '2018-01-06 09:39:09', '2018-01-06 09:39:09'),
(14, 28, 76, 80.00, 'tr_1BhE92L29sv8fqLreEk3kzhO', 1, '2018-01-06 09:39:17', '2018-01-06 09:39:17'),
(15, 28, 76, 80.00, 'tr_1BhE9AL29sv8fqLr2eJ8NSTc', 1, '2018-01-06 09:39:25', '2018-01-06 09:39:25'),
(16, 28, 76, 80.00, 'tr_1BhE9IL29sv8fqLrDnKiy9in', 1, '2018-01-06 09:39:33', '2018-01-06 09:39:33'),
(17, 24, 76, 75.00, 'tr_1BhE9QL29sv8fqLrMTcDg7fF', 1, '2018-01-06 09:39:41', '2018-01-06 09:39:41'),
(18, 29, 76, 368.00, 'tr_1BhGDIL29sv8fqLr28vnX1jU', 1, '2018-01-06 11:51:49', '2018-01-06 11:51:49');

--
-- Triggers `provider_payments`
--
DELIMITER $$
CREATE TRIGGER `payment_to_payment` AFTER INSERT ON `provider_payments` FOR EACH ROW INSERT INTO notifications (`sender_id`,`reciever_id`,`status`,`request_id`,`notification_type`,`message_id`,`request_status`)
  VALUES (1, NEW.provider_id ,0,NEW.request_id,'Payment to provider',3,6)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `provider_payments_details`
--

CREATE TABLE `provider_payments_details` (
  `id` bigint(20) NOT NULL,
  `provider_id` bigint(20) NOT NULL,
  `stripe_custom_account_id` varchar(50) NOT NULL,
  `stripe_secret_key` varchar(50) NOT NULL,
  `stripe_publishable_key` varchar(50) NOT NULL,
  `fingerprint` varchar(50) DEFAULT NULL,
  `default_currency` varchar(3) NOT NULL,
  `country` varchar(3) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provider_payments_details`
--

INSERT INTO `provider_payments_details` (`id`, `provider_id`, `stripe_custom_account_id`, `stripe_secret_key`, `stripe_publishable_key`, `fingerprint`, `default_currency`, `country`, `url`, `status`, `created`, `modified`) VALUES
(15, 76, 'acct_1BgtTTG5TDP3qjYb', 'sk_test_gm7YnWuNd6QAp06Px00ZvIlP', 'pk_test_7cRJ7yX3tQwFHpgpPqPD8lJf', 'XRnEaIA0KLvVnFAd', 'usd', 'US', '/v1/accounts/acct_1BgtTTG5TDP3qjYb/external_accounts', 1, '2018-01-05 11:35:01', '2018-01-05 11:35:01'),
(16, 2, 'acct_1BhwpOEzwfb3dJHr', 'sk_test_NvA7Bero8yWiSwKLonNLgneQ', 'pk_test_CTp5Qgd7rOnAfTV0OUAgqz0Y', 'vn0rs6qAVKaNuTjh', 'usd', 'US', '/v1/accounts/acct_1BhwpOEzwfb3dJHr/external_accounts', 1, '2018-01-08 09:22:01', '2018-01-08 09:22:01'),
(20, 6, 'acct_1Bhxx6D4QsbC6477', 'sk_test_vtugubqaiHWbilmcGXMXjJVk', 'pk_test_5V4KmIt1YaD6Y0N30EXyX9EL', 'M6n1bSEhSr0joEY4', 'usd', 'US', '/v1/accounts/acct_1Bhxx6D4QsbC6477/external_accounts', 1, '2018-01-08 10:34:03', '2018-01-08 10:34:03'),
(22, 75, 'acct_1Bi33EBqP5PlSQ1T', 'sk_test_auTgyEy0RwFcVPGEZFCnzfW3', 'pk_test_5i0kyGOf2rqnAYtaBZgf2DVz', 'WQCfG5f6dB4qC8Mv', 'usd', 'US', '/v1/accounts/acct_1Bi33EBqP5PlSQ1T/external_accounts', 1, '2018-01-08 16:00:43', '2018-01-08 16:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `request_id` varchar(100) NOT NULL,
  `client_id` int(11) DEFAULT NULL COMMENT 'client id from client table',
  `matter_id` int(11) DEFAULT NULL COMMENT 'matter id from matters table',
  `description` text,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `rec_start_date` date DEFAULT NULL,
  `rec_end_date` date DEFAULT NULL,
  `requestor_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `request_status` int(1) DEFAULT '0' COMMENT '0=>''Submitted'',1=>''Provider Acknowledged'',2=>''Provider Denied'',3=>''In Progress'',4=>''No Records Found'',5=>''Records Uploaded'',6=>''Paid'',7=>''Records Available for Download'',8=>''Closed''',
  `pages` int(20) DEFAULT NULL,
  `ProFees` varchar(10) DEFAULT NULL,
  `feesType` int(2) DEFAULT NULL,
  `finalFees` float(7,2) DEFAULT NULL,
  `request_completion_file_path` varchar(255) DEFAULT NULL,
  `date_of_request` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estimated_delivery_date` datetime DEFAULT NULL,
  `requested_format` enum('p','f') DEFAULT NULL COMMENT 'P = PDF/FTP, F = Fax coversheet',
  `provider_acknowledgement` tinyint(4) DEFAULT NULL,
  `threshold` varchar(200) DEFAULT NULL,
  `ssn_no` varchar(100) DEFAULT NULL,
  `system_fee` float(7,2) DEFAULT NULL,
  `total_cost` float(7,2) DEFAULT NULL,
  `record_type` tinyint(4) DEFAULT NULL COMMENT '1=>''medical'', 2=>''billing'', 3=>''both''''',
  `hippa_form_date` date DEFAULT NULL,
  `upload_hippa` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=> Not pay complete, 1=>pay completed',
  `paid_to_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Payment paid to admin from requestor',
  `paid_to_provider` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'payment paid to provider from admin',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=>active,0=>inactive',
  `reason` text,
  `is_deleted` tinyint(4) DEFAULT '0' COMMENT '0=>not deleted,1=>deleted',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_id`, `client_id`, `matter_id`, `description`, `first_name`, `last_name`, `dob`, `rec_start_date`, `rec_end_date`, `requestor_id`, `provider_id`, `department_id`, `request_status`, `pages`, `ProFees`, `feesType`, `finalFees`, `request_completion_file_path`, `date_of_request`, `estimated_delivery_date`, `requested_format`, `provider_acknowledgement`, `threshold`, `ssn_no`, `system_fee`, `total_cost`, `record_type`, `hippa_form_date`, `upload_hippa`, `payment_status`, `paid_to_admin`, `paid_to_provider`, `status`, `reason`, `is_deleted`, `created`, `modified`) VALUES
(1, '1', NULL, NULL, 'qwerty', 'Sneha', 'Gosewade', '2017-12-14', '2017-12-15', '2017-12-28', 1, 2, 0, 3, 0, '', 0, 0.00, 'a:1:{i:0;s:28:\"1513399953_MRR_db_schema.pdf\";}', '2017-12-15 14:59:41', NULL, NULL, NULL, '23.20', '798-62-3665', NULL, NULL, 1, '2017-12-15', '1513349962_model.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-15 14:59:41', '2018-01-05 09:11:51'),
(2, '2', 1, 1, 'sadasdasd', 'Test', 'User', '1992-10-28', '2017-12-01', '2017-12-31', 1, 2, 1, 6, 0, '', 0, 0.00, NULL, '2017-12-15 15:07:55', NULL, NULL, NULL, '32.20', '789-41-3213', NULL, NULL, 1, '2017-12-27', '1513350448_model.pdf', 0, 0, 0, 1, 'Don\'t know', 0, '2017-12-15 15:07:55', '2017-12-16 04:51:25'),
(3, '3', NULL, NULL, 'test description', 'testing', 'testing', '2000-01-01', '2016-03-03', '2017-12-01', 3, 2, 1, 3, 45, '450', 1, 50.00, NULL, '2017-12-18 12:47:56', NULL, NULL, NULL, '900', '', 36.00, 486.00, 3, '2017-12-20', '1513601250_sample.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-18 12:47:56', '2017-12-26 10:28:06'),
(4, '4', 1, 1, 'qwerty', 'Test', 'User', '2017-12-07', '2017-12-13', '2017-12-26', 3, 2, 1, 6, 96, '960', 1, NULL, 'a:1:{i:0;s:47:\"1514192195_cleartax-guide-to-e-verification.pdf\";}', '2017-12-19 08:07:03', NULL, NULL, NULL, '53.2', '789-45-4654', 76.00, 1036.00, 1, '2017-12-28', '1513670684_BMGPG5343F_Q1_2017-18.pdf', 1, 1, 0, 1, NULL, 0, '2017-12-19 08:07:03', '2017-12-26 15:26:07'),
(5, '5', NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin arcu nec nulla eleifend tempor. Sed dapibus dui ante, id feugiat ligula tincidunt sed. Quisque varius, justo ut auctor feugiat, elit ipsum convallis purus, aliquet tristique elit nisi ac purus. Proin a elementum orci. Fusce a auctor velit. Aenean vel facilisis metus. Proin vitae nibh et leo scelerisque placerat. Sed ac est lacus. Maecenas venenatis dapibus vestibulum. Vivamus vel dignissim odio. Nullam faucibus, ligula in fermentum cursus, nisi velit fermentum lacus, id lacinia risus lacus id ante. Praesent pulvinar ut diam vitae interdum. In hac habitasse platea dictumst. Mauris iaculis lobortis lectus ut iaculis. Nullam tincidunt rutrum quam sit amet condimentum. Mauris leo nisi, interdum nec lectus a, molestie porttitor nulla. ', 'test', 'testtt', '1980-02-19', '2017-12-01', '2017-12-22', 3, 2, 1, 2, 6, '', 0, 60.00, NULL, '2017-12-19 08:45:30', NULL, NULL, NULL, '568', '456-45-6655', NULL, NULL, 1, '2017-12-20', '1513673045_pdf-sample.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-19 08:45:30', '2017-12-19 09:07:04'),
(6, '6', 2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin arcu nec nulla eleifend tempor. Sed dapibus dui ante, id feugiat ligula tincidunt sed. Quisque varius, justo ut auctor feugiat, elit ipsum convallis purus, aliquet tristique elit nisi ac purus. Proin a elementum orci. Fusce a auctor velit. Aenean vel facilisis metus. Proin vitae nibh et leo scelerisque placerat. Sed ac est lacus. Maecenas venenatis dapibus vestibulum. Vivamus vel dignissim odio. Nullam faucibus, ligula in fermentum cursus, nisi velit fermentum lacus, id lacinia risus lacus id ante. Praesent pulvinar ut diam vitae interdum. In hac habitasse platea dictumst. Mauris iaculis lobortis lectus ut iaculis. Nullam tincidunt rutrum quam sit amet condimentum. Mauris leo nisi, interdum nec lectus a, molestie porttitor nulla. ', 'testname', 'testsurname', '1970-11-25', '2017-12-08', '2017-12-22', 3, 2, 1, 3, 5, '50', 1, NULL, 'a:1:{i:0;s:36:\"1513950032_BMGPG5343F_Q2_2017-18.pdf\";}', '2017-12-19 09:15:03', NULL, NULL, NULL, '565', '454-56-4564', 2.00, 52.00, 1, '2017-12-08', '1513674890_pdf-sample.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-19 09:15:03', '2017-12-22 13:40:32'),
(7, '7', 1, 1, 'dterterterte', 'dsd', 'edsad', '2017-12-12', '2017-12-27', '2018-01-04', 74, 2, 1, 0, NULL, '', 0, NULL, NULL, '2017-12-20 06:37:39', NULL, NULL, NULL, '434', '343-43-434', NULL, NULL, 1, '2017-12-19', '1513751840_MRR_db_schema.pdf', 0, 0, 0, 1, NULL, 1, '2017-12-20 06:37:39', '2017-12-20 13:13:30'),
(8, '8', 3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin arcu nec nulla eleifend tempor. Sed dapibus dui ante, id feugiat ligula tincid', 'first name', 'last name', '2017-12-07', '2017-12-08', '2017-12-28', 3, 2, 0, 3, 0, '', 0, 450.00, NULL, '2017-12-20 09:34:11', NULL, NULL, NULL, '541', '454-56-5645', NULL, NULL, 1, '2017-12-22', '1513762344_pdf-sample.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-20 09:34:11', '2017-12-20 12:01:38'),
(9, '9', 1, 1, 'qwerty', 'test', 'user', '2017-12-05', '2017-12-19', '2017-12-27', 3, 75, 0, 0, NULL, '', 0, NULL, NULL, '2017-12-20 13:09:28', NULL, NULL, NULL, '53.2', '453-45-3453', NULL, NULL, 1, '2017-12-21', '1513775264_MRR_db_schema.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-20 13:09:28', '2017-12-20 13:09:28'),
(10, '10', NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin arcu nec nulla eleifend tempor. Sed dapibus dui ante, id feugiat ligula tincidunt sed. Quisque varius, justo ut auctor feugiat, elit ipsum convallis purus, aliquet tristique elit nisi ac purus. Proin a elementum orci. ', 'testname', 'testname', '1970-07-29', '2017-12-01', '2017-12-22', 3, 2, 1, 8, 0, '650', 0, 7.00, 'a:1:{i:0;s:18:\"1513942596_pdf.pdf\";}', '2017-12-21 06:24:41', NULL, NULL, NULL, '53.2', '465-45-4564', 32.00, 682.00, 3, '2017-12-14', '1513835323_sample.pdf', 0, 0, 0, 1, '', 0, '2017-12-21 06:24:41', '2017-12-22 14:24:54'),
(11, '11', 3, 5, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin arcu nec nulla eleifend tempor. Sed dapibus dui ante, id feugiat ligula tincidunt sed. Quisque varius, justo ut auctor feugiat, elit ipsum convallis purus, aliquet tristique elit nisi ac purus.', 'testfirstname', 'testlastname', '1980-06-18', '2017-12-15', '2017-12-28', 3, 2, 1, 3, 650, '6500', 1, NULL, 'a:1:{i:0;s:18:\"1513946250_pdf.pdf\";}', '2017-12-22 11:57:17', NULL, NULL, NULL, '600', '455-45-5464', 325.00, 6825.00, 1, '2017-12-20', '1513943593_pdf-sample.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-22 11:57:17', '2017-12-22 12:37:30'),
(13, '13', 4, 6, 'nothing', 'sneha', 'test', '2017-12-20', '2017-12-20', '2017-12-27', 3, 2, 1, 8, 9, '90', 1, NULL, 'a:1:{i:0;s:36:\"1514196251_BMGPG5343F_Q2_2017-18.pdf\";}', '2017-12-25 09:00:18', NULL, NULL, NULL, '53.2', '236-67-8990', 7.00, 97.00, 1, '2017-12-27', '1514192403_BMGPG5343F_Q1_2017-18.pdf', 1, 1, 0, 1, NULL, 0, '2017-12-25 09:00:18', '2017-12-26 15:26:02'),
(14, '14', 4, 6, 'rfdsfdfdgdf', 'sneha', 'ehierweihr', '2017-12-06', '2017-12-20', '2017-12-29', 3, 2, 1, 8, 15, '150', 1, NULL, 'a:1:{i:0;s:48:\"1514203235_1511340918_House_Information (2).docx\";}', '2017-12-25 11:57:27', NULL, NULL, NULL, '53.2', '343-53-4534', 12.00, 162.00, 1, '2017-12-14', '1514203026_cleartax-guide-to-e-verification.pdf', 1, 1, 0, 1, NULL, 0, '2017-12-25 11:57:27', '2017-12-26 15:26:00'),
(15, '15', 4, 6, 'yreyry', 'Sneha', 'Gosewade', '2017-12-06', '2017-12-14', '2017-12-21', 3, 2, 1, 8, 6, '60', 1, NULL, 'a:1:{i:0;s:18:\"1514262319_pdf.pdf\";}', '2017-12-26 03:58:02', NULL, NULL, NULL, '53.2', '353-45-4353', 4.00, 64.00, 1, '2017-12-27', '1514260550_pdf.pdf', 1, 1, 1, 1, NULL, 0, '2017-12-26 03:58:02', '2017-12-27 06:44:31'),
(16, '16', 8, 10, 'dsadasdasdasd', 'ewrwer', 'rewr', '2017-12-13', '2017-12-14', '2017-12-20', 3, 2, NULL, 3, 5, '50', 1, NULL, NULL, '2017-12-26 06:19:21', NULL, NULL, NULL, '53.2', '345-34-5345', 4.00, 54.00, 1, '2017-12-20', '1514269158_pdf.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-26 06:19:21', '2017-12-26 08:23:11'),
(17, '17', 7, 9, 'qwerty', 'qwerty', 'ewrwerew', '2017-12-20', '2017-12-19', '2017-12-29', 3, 75, 0, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-26 06:27:15', NULL, NULL, NULL, '53.2', '452-35-3453', NULL, NULL, 1, '2017-12-28', '1514269626_pdf.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-26 06:27:15', '2017-12-26 06:27:15'),
(18, '18', 9, 11, 'testing one two', 'testname', 'testname', '1990-02-01', '2017-12-01', '2017-12-29', 3, 75, 0, 0, 0, '250', 0, NULL, NULL, '2017-12-26 06:39:39', NULL, NULL, NULL, '600', '456-45-6456', 5.00, 255.00, 3, '2017-12-20', '1514270372_pdf-sample.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-26 06:39:39', '2018-01-08 17:17:17'),
(20, '19', 10, 12, 'qwerty', 'Sneha', 'Gosewade', '2017-12-22', '2017-12-12', '2017-12-14', 3, 2, 0, 7, 45, '450', 1, NULL, 'a:1:{i:0;s:18:\"1514359445_pdf.pdf\";}', '2017-12-27 06:25:24', NULL, NULL, NULL, '53.2', '634-56-3453', 36.00, 486.00, 1, '2017-12-20', '1514355788_pdf.pdf', 1, 1, 0, 1, NULL, 0, '2017-12-27 06:25:24', '2017-12-27 07:24:14'),
(21, '20', 11, 13, 'qwertyu', 'sneha', 'Gosewade', '2017-12-12', '2017-12-20', '2017-12-27', 3, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-27 07:29:27', NULL, NULL, NULL, '53.2', '535-43-5345', NULL, NULL, 1, '2017-12-28', '1514359752_pdf.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-27 07:29:27', '2017-12-27 07:29:27'),
(22, '21', 12, 14, 'qwerty', 'Sneha', 'Gosewade', '2017-11-28', '2017-12-06', '2017-12-14', 3, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-27 07:36:52', NULL, NULL, NULL, '53.2', '243-42-3423', NULL, NULL, 1, '2017-12-20', '1514360207_pdf.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-27 07:36:52', '2017-12-27 07:36:52'),
(23, '22', NULL, NULL, 'single quotes removed from table name totalloaner, because quotes effectively makes it a string literal instead of a proper identifier. You can use back ticks if you want but it\'s unnecessary since it\'s not a reserved word and it don\'t contain any special characters. ', 'testfirstname', 'testsurname', '2017-12-21', '2017-12-01', '2017-12-28', 3, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-27 07:49:31', NULL, NULL, NULL, '560', '465-46-5465', NULL, NULL, 3, '2017-12-21', '1514360952_pdf.pdf', 0, 0, 0, 1, NULL, 0, '2017-12-27 07:49:31', '2017-12-27 07:49:31'),
(24, '23', 13, 15, 'test description for the request', 'Sneha', 'Gosewade', '1980-02-06', '2018-01-24', '2018-01-31', 77, 76, 2, 7, 5, '75', 1, NULL, 'a:1:{i:0;s:18:\"1515132120_pdf.pdf\";}', '2018-01-03 13:38:50', NULL, NULL, NULL, '32.30', '423-42-3423', 3.00, 78.00, 1, '2018-01-16', '1514986710_pdf.pdf', 1, 1, 1, 1, NULL, 0, '2018-01-03 13:38:50', '2018-01-06 09:39:41'),
(25, '24', 13, 15, 'qwerty', 'Marry', 'Jane', '1990-02-07', '2018-01-11', '2018-02-10', 77, 76, 2, 0, 6, '90', 1, NULL, 'a:1:{i:0;s:18:\"1515143612_pdf.pdf\";}', '2018-01-05 07:12:07', NULL, NULL, NULL, '23', '456-32-1789', 4.00, 94.00, 1, '2018-01-24', '1515136285_pdf.pdf', 1, 1, 1, 1, NULL, 0, '2018-01-05 07:12:07', '2018-01-06 08:42:37'),
(26, '25', 13, 15, '654512rqwewerwerewrwer', 'Sneha', 'Gosewade', '2000-03-15', '2018-01-17', '2018-02-08', 77, 76, 2, 3, 6, '96', 1, NULL, 'a:1:{i:0;s:18:\"1515147927_pdf.pdf\";}', '2018-01-05 10:06:51', NULL, NULL, NULL, '23.32', '787-46-5413', 5.00, 101.00, 2, '2018-01-10', '1515146782_pdf.pdf', 1, 1, 1, 1, NULL, 0, '2018-01-05 10:06:51', '2018-01-05 15:11:31'),
(27, '26', 13, 16, 'qwqwweretryty', 'testing', 'tests', '2010-06-16', '2018-01-31', '2018-02-02', 77, 76, 2, 1, 6, '96', 1, NULL, NULL, '2018-01-05 10:34:43', NULL, NULL, NULL, '23.32', '423-42-3423', 4.00, 100.00, 2, '2018-01-18', '1515148470_pdf.pdf', 0, 0, 0, 1, NULL, 0, '2018-01-05 10:34:43', '2018-01-05 12:29:56'),
(28, '27', 13, 15, 'ewrwerwerwerwer', 'zsfsfdsf', 'rewrwer', '2018-01-04', '2018-01-17', '2018-02-01', 77, 76, 2, 7, 5, '80', 1, NULL, 'a:1:{i:0;s:18:\"1515153825_pdf.pdf\";}', '2018-01-05 10:45:41', NULL, NULL, NULL, '63.23', '534-53-4534', 4.00, 84.00, 1, '2018-01-09', '1515149128_pdf.pdf', 1, 1, 1, 1, NULL, 0, '2018-01-05 10:45:41', '2018-01-06 09:36:10'),
(29, '28', 13, 15, 'qwerty', 'sneha', 'Gosewade', '1990-03-14', '2018-01-16', '2018-02-10', 77, 76, 3, 7, 23, '368', 1, NULL, 'a:1:{i:0;s:18:\"1515239469_pdf.pdf\";}', '2018-01-06 11:41:04', NULL, NULL, NULL, '55', '353-45-4534', 5.00, 373.00, 2, '2018-01-24', '1515238856_pdf.pdf', 1, 1, 1, 1, NULL, 0, '2018-01-06 11:41:04', '2018-01-06 11:51:49');

--
-- Triggers `requests`
--
DELIMITER $$
CREATE TRIGGER `insert_notifications` AFTER INSERT ON `requests` FOR EACH ROW INSERT INTO notifications (`sender_id`,`reciever_id`,`status`,`request_id`,`notification_type`,`message_id`,`request_status`)
  VALUES (NEW.requestor_id , NEW.provider_id ,0,NEW.id,'Insert request',1,0)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_notifications` AFTER UPDATE ON `requests` FOR EACH ROW INSERT INTO notifications (`sender_id`,`reciever_id`,`status`,`request_id`,`notification_type`,`message_id`,`request_status`)
  VALUES (NEW.provider_id , NEW.requestor_id ,0,NEW.id,'Update request',1,NEW.request_status)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>inactive, 1=>''active''',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>deleted, 0 =>Not deleted',
  `created` date NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_description`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 'Admin', 'Super Admin with all permissions', 1, 0, '2015-03-03', '2015-03-03 12:28:47'),
(2, 'Provider', 'Provider such as clinic/hospitals who will going to provide the medical records of patients', 1, 0, '2017-11-02', '2017-11-02 09:48:41'),
(3, 'Requestor', 'Requestor such as Lawyer/Insurance company who will be requesting for their client records and not having access of provider part', 1, 0, '2017-11-02', '2017-11-02 09:48:41'),
(4, 'client', 'client for whom the data will be requested from provider by requestor', 1, 0, '2017-11-15', '2017-11-15 05:49:20'),
(5, 'staff', 'staff added by requester and provider', 1, 0, '2017-11-15', '2017-11-15 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country_id` varchar(250) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT 'if role_id =2 for providerso1=>doctor,2=>hospitals or role_id=3 for Requester so 1=Lawyers and 2=Insurance Company',
  `zip_code` varchar(250) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `about_company` text,
  `key_token` varchar(255) DEFAULT NULL,
  `reset_password_flag` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `threshold` double(5,2) DEFAULT NULL COMMENT 'amount entered for requested data',
  `using_our_system` enum('y','n') DEFAULT NULL COMMENT '''y''=>yes,''n''=>no',
  `card_preference_id` int(11) DEFAULT NULL COMMENT 'id from card_details',
  `role_id` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=>active,0=>inactive',
  `is_client_matter_preference` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=>yes,0=>no',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>deleted,0=>not deleted',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `city`, `state`, `country_id`, `type`, `zip_code`, `street_address`, `company_name`, `department`, `about_company`, `key_token`, `reset_password_flag`, `description`, `threshold`, `using_our_system`, `card_preference_id`, `role_id`, `status`, `is_client_matter_preference`, `is_deleted`, `created`, `modified`) VALUES
(1, 'Super', 'Admin', 'super_admin@yopmail.com', '$2y$10$L9BOMiPvlxFqYwfWL/UbWeElRDJfeZm3Bpo.p7uEvg4ZCOgNl/ZJe', '78785255232', 'Nagpur', 'Mh', '112', 2, '440002', 'ten downing street', 'SG Co', NULL, 'This is dummy company', '483c79a06d2f6e3baf15d7e0188a1fd4', 0, 'bgdsgdgdfg', 53.20, NULL, 10, 1, 1, 1, 0, '2017-12-15 14:52:21', '2017-12-16 04:50:44'),
(2, 'Demo', 'Provider', 'demo_pro@mailinator.com', '$2y$10$kFfA8BGNNN6t5boqMcSoOuauQhSLitT3gtb4TelB6p30MCLYB4IBS', '9632587412', 'SEATTLE', 'WA', '0', 2, '98102', ' 300 BOYLSTON AVE E', 'Snehag Co', '1', 'Test Co', 'f349fca084bca9919ce53481aaa4a600', 0, 'testing', NULL, NULL, NULL, 2, 1, 1, 0, '2017-12-15 14:55:52', '2018-01-08 09:17:02'),
(3, 'Demo', 'Requestor', 'demo_req@mailinator.com', '$2y$10$L9BOMiPvlxFqYwfWL/UbWeElRDJfeZm3Bpo.p7uEvg4ZCOgNl/ZJe', '78785255232', 'Nagpur', 'Mh', '112', 2, '440002', 'ten downing street', 'SG Co', NULL, 'This is dummy company', '483c79a06d2f6e3baf15d7e0188a1fd4', 0, 'bgdsgdgdfg', 53.20, NULL, 13, 3, 1, 0, 0, '2017-12-15 14:52:21', '2017-12-27 06:25:47'),
(4, 'First name', 'Last name', 'req_sneha@yopmail.com', '$2y$10$fnRbgk1At2A9hdF.h56jl.s3VtwTeUwgd8ONtO1hIv7dJmaCSzU2m', '787989111', 'city new', 'state new', '14', 2, '456321', 'strret Address', 'qwerty', NULL, 'test', NULL, 0, NULL, NULL, NULL, NULL, 3, 1, 1, 0, '2017-12-16 06:48:53', '2017-12-18 11:52:05'),
(5, 'sneha12', 'test12', 'snehar@yopmail.com', '$2y$10$nPS0lvBVxc32C0RVeuMZK.rW55mTdvAQ/BWNN7WSGnkuO/Sv4hJmq', '7896541222', 'city12', 'state12', '17', 1, '44000022', 'strret Address12', 'compnt12', NULL, 'testing 123412', NULL, 0, NULL, NULL, NULL, NULL, 3, 1, 1, 0, '2017-12-18 06:58:05', '2017-12-20 14:59:23'),
(6, 'sneha1', 'Provider1', 'sneha_pro@yopmail.com', '$2y$10$RlCDEk23AUad.648L5NaEeO4s2Xzw4nahHvUPn66kjBukczG83p4i', '78965412221', 'SEATTLE', 'WA', '0', 1, '98104', '100 MAIN ST', 'compnt1', '', 'edsadsad1', NULL, 0, NULL, NULL, NULL, NULL, 2, 1, 1, 0, '2017-12-18 08:38:16', '2018-01-08 10:15:48'),
(7, 'test', 'test', 'test1@yopmail.com', '$2y$10$L7RSkWGVd0MOLEhZBN5ZcOlUyjfdf/GNa9jA1PPsVT8Eldwm2Hppy', '5345345435', 'fdf', 'fds', '11', 1, '5345', 'fsdf', 'tret', NULL, 'fsdggfdgdfg', NULL, 0, NULL, NULL, NULL, NULL, 2, 1, 1, 0, '2017-12-18 11:02:46', '2018-01-08 11:30:56'),
(8, 'firstggg', 'last', 'req_sneha1@yopmail.com', '$2y$10$u2H6yRLPJaawvP2tyispWurkRbFdJae.IPSoIgJLC0DSH5z41FXK6', '5345345345', 'fsdf', 'sdf', '4', 1, '435345345', 'vdsfdsfsdf', 'compnt', NULL, 'fsfsdfsdfsd', NULL, 0, NULL, NULL, NULL, NULL, 3, 1, 1, 1, '2017-12-18 12:18:50', '2017-12-26 12:54:36'),
(74, 'Sneha', 'Requestor', 'sneha_req@yopmail.com', '$2y$10$wYlQiF08cCgdfbosKAIV5.P3X8D.kWWarVSwjFiUIZc.rxxseH9eG', '789654133', 'Nagpur', 'Maharashtra', '0', 2, '4400022', 'Ten downing street', 'qwerty', NULL, 'qwewqe', '7ca8d414f27caa09bd864d360c75f5e4', 0, 'testinh', NULL, NULL, 12, 3, 1, 1, 1, '2017-12-20 06:26:16', '2017-12-26 11:52:06'),
(75, 'testProvider', 'testProvider', 'demo_pro2@yopmail.com', '$2y$10$vVhG.u85KMuSB8pvWfDZIe34ntDIrZGHl3qEM5wV54R6HNU/PdIE.', '123121212313212', 'Los Lunas', 'New Mexico', '0', 2, '87031', '4860 Bird Street', '', '', '', '20f463b348e2b35e5ed98c6fab9b5114', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin arcu nec nulla eleifend tempor. Sed dapibus dui ante, id feugiat ligula tincidunt sed.', NULL, NULL, NULL, 2, 1, 1, 0, '2017-12-20 12:53:05', '2018-01-08 15:59:27'),
(76, 'new pro', 'testing', 'new_proTest@yopmail.com', '$2y$10$wJHFvcx2Uuf/tfN4/./rkejFpoLlPuDyNVl0QUyKD3m3ukhlTQtz2', '7896541236', 'Atlanta', 'Georgia', '0', 2, '30301', 'Ten downing street', 'New test Prov Co.', '2', 'This is testing company', '8426c6594c58b59fd8f40f23d96ca73d', 0, 'qwertyui', NULL, NULL, NULL, 2, 1, 1, 0, '2018-01-03 10:30:13', '2018-01-03 13:31:10'),
(77, 'new requestor', 'testinh', 'new_reqTest@yopmail.com', '$2y$10$TZgE7e.qlwhn5D.V2OjEYuf8fW5Ha82PkLl.qqdIDi7sqmkHwNjoq', '9632587412', 'Nagpur', 'MH', '83', 1, '44222200', 'TDS', '', NULL, '', '89e5e1e3ca2ba50c0121f7b2b01c4aab', 0, 'Testing requestor', NULL, NULL, 14, 3, 1, 1, 0, '2018-01-03 12:10:23', '2018-01-05 10:07:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_settings`
--
ALTER TABLE `fees_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matters`
--
ALTER TABLE `matters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_details`
--
ALTER TABLE `provider_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_payments`
--
ALTER TABLE `provider_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_payments_details`
--
ALTER TABLE `provider_payments_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fees_settings`
--
ALTER TABLE `fees_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `matters`
--
ALTER TABLE `matters`
  MODIFY `id` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;
--
-- AUTO_INCREMENT for table `provider_details`
--
ALTER TABLE `provider_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `provider_payments`
--
ALTER TABLE `provider_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `provider_payments_details`
--
ALTER TABLE `provider_payments_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
