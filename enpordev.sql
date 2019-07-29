-- phpMyAdmin SQL Dump
-- version 4.0.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2018 at 07:39 AM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demodemoga_enpordev`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ico_accounts`
--

CREATE TABLE IF NOT EXISTS `ico_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(500) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `coin_type` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '(0=pending,1=complete,2=fail/cancel)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_admin_ip`
--

CREATE TABLE IF NOT EXISTS `ico_admin_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_admin_log`
--

CREATE TABLE IF NOT EXISTS `ico_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(70) NOT NULL,
  `system` varchar(100) NOT NULL,
  `browser` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ico_admin_log`
--

INSERT INTO `ico_admin_log` (`id`, `admin_id`, `login_date`, `ip_address`, `system`, `browser`, `country`, `country_code`, `status`) VALUES
(1, 2, '2018-04-05 11:36:20', '103.91.103.88', '', '', 'India', 'IN', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `ico_broadcast`
--

CREATE TABLE IF NOT EXISTS `ico_broadcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_coins`
--

CREATE TABLE IF NOT EXISTS `ico_coins` (
  `coin_id` int(11) NOT NULL AUTO_INCREMENT,
  `coin_name` varchar(30) NOT NULL,
  PRIMARY KEY (`coin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ico_coins`
--

INSERT INTO `ico_coins` (`coin_id`, `coin_name`) VALUES
(1, 'BTC'),
(2, 'ETH'),
(3, 'DASH'),
(4, 'LTC');

-- --------------------------------------------------------

--
-- Table structure for table `ico_contact_us`
--

CREATE TABLE IF NOT EXISTS `ico_contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_country`
--

CREATE TABLE IF NOT EXISTS `ico_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(3) NOT NULL,
  `country_name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=248 ;

--
-- Dumping data for table `ico_country`
--

INSERT INTO `ico_country` (`id`, `country_code`, `country_name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D''Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263),
(247, 'UK', 'United Kingdom', 44);

-- --------------------------------------------------------

--
-- Table structure for table `ico_events`
--

CREATE TABLE IF NOT EXISTS `ico_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `event_link` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ico_events`
--

INSERT INTO `ico_events` (`id`, `event_name`, `logo`, `event_link`, `status`) VALUES
(1, 'BitConnect', 'bitconnect.png', '', 1),
(2, 'BlockChainNews', 'blockchainnews.png', 'http://enpor.demodemodemo.ga', 1),
(3, 'CoinTelegraph', 'cointelegraph.png', '', 1),
(4, 'CryptoCoinNews', 'cryptocoinnews.png', 'http://enpor.demodemodemo.ga', 1),
(5, 'MarketWatch', 'marketwatch.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ico_ico_status`
--

CREATE TABLE IF NOT EXISTS `ico_ico_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_kyc_detail`
--

CREATE TABLE IF NOT EXISTS `ico_kyc_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(500) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `dob` varchar(1000) NOT NULL,
  `address_one` varchar(1000) NOT NULL,
  `address_two` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `postcode` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `street` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `eth_address` varchar(200) NOT NULL,
  `id_proof` varchar(500) NOT NULL,
  `issuance` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `sources_of_income` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `occupation` text NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `purchase_amount` int(11) NOT NULL,
  `high_risk_country` text NOT NULL,
  `citizenship` text NOT NULL,
  `type` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'under',
  `device_id` varchar(1000) NOT NULL,
  `device_type` varchar(500) NOT NULL,
  `ip_address` varchar(500) NOT NULL,
  `sdelete` int(11) DEFAULT '0',
  `serial_no` int(11) NOT NULL,
  `reference_code` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_login_history`
--

CREATE TABLE IF NOT EXISTS `ico_login_history` (
  `login_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(70) NOT NULL,
  `system` varchar(100) NOT NULL,
  `browser` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`login_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_newsletter_users`
--

CREATE TABLE IF NOT EXISTS `ico_newsletter_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_partners`
--

CREATE TABLE IF NOT EXISTS `ico_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(150) NOT NULL,
  `partner_link` text NOT NULL,
  `logo` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ico_partners`
--

INSERT INTO `ico_partners` (`id`, `partner_name`, `partner_link`, `logo`, `status`) VALUES
(1, 'Bitconnect', 'bitconnect.com', 'bitconnect.png', 1),
(2, 'BlockChainNews', '', 'blockchainnews.png', 1),
(3, 'Cointelegraph', 'http://enpor.demodemodemo.ga', 'cointelegraph.png', 1),
(4, 'CryptoCoinNews', '', 'cryptocoinnews.png', 1),
(5, 'MarketWatch', '', 'marketwatch.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ico_progress_bar`
--

CREATE TABLE IF NOT EXISTS `ico_progress_bar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raised` text NOT NULL,
  `progress_bar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_referral_management`
--

CREATE TABLE IF NOT EXISTS `ico_referral_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `system_management` int(11) NOT NULL,
  `bonus` varchar(200) NOT NULL DEFAULT '5',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `timestamp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ico_referral_management`
--

INSERT INTO `ico_referral_management` (`id`, `system_management`, `bonus`, `date`, `timestamp`) VALUES
(1, 1, '5', '2018-03-28 11:32:06', '1522165458'),
(4, 1, '5', '2018-03-31 05:24:40', '1522473880'),
(5, 1, '5', '2018-03-31 07:02:21', '1522479741'),
(6, 1, '5', '2018-04-05 11:36:42', '1522928202');

-- --------------------------------------------------------

--
-- Table structure for table `ico_setup`
--

CREATE TABLE IF NOT EXISTS `ico_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ico_type` varchar(200) NOT NULL,
  `details` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `token_supply` float NOT NULL,
  `token_price` float NOT NULL,
  `extra_bonus` float NOT NULL,
  `stages` varchar(200) NOT NULL,
  `stages_title` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ico_setup`
--

INSERT INTO `ico_setup` (`id`, `ico_type`, `details`, `start_date`, `end_date`, `token_supply`, `token_price`, `extra_bonus`, `stages`, `stages_title`) VALUES
(1, 'pre_ico', 'Pre-sale started with 25% bonus.', '2018-03-27', '2018-05-15', 250000000, 1, 20, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ico_support`
--

CREATE TABLE IF NOT EXISTS `ico_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=>open,0=>close',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_support_reply`
--

CREATE TABLE IF NOT EXISTS `ico_support_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '0=>admin',
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_system_settings`
--

CREATE TABLE IF NOT EXISTS `ico_system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_status` int(11) NOT NULL DEFAULT '1',
  `login_status` int(11) NOT NULL DEFAULT '1',
  `register_status` int(11) NOT NULL DEFAULT '1',
  `activation_email_status` int(11) NOT NULL DEFAULT '1',
  `login_failed_limit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ico_system_settings`
--

INSERT INTO `ico_system_settings` (`id`, `website_status`, `login_status`, `register_status`, `activation_email_status`, `login_failed_limit`) VALUES
(1, 1, 1, 1, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ico_transaction`
--

CREATE TABLE IF NOT EXISTS `ico_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL,
  `amount` decimal(20,8) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `merchant` varchar(50) NOT NULL,
  `txn_id` varchar(80) NOT NULL,
  `ipn_id` varchar(50) NOT NULL,
  `ipn_mode` varchar(25) NOT NULL,
  `currency` varchar(16) NOT NULL,
  `dollar_amount` varchar(100) NOT NULL,
  `fees` varchar(200) NOT NULL,
  `received_confirms` varchar(200) NOT NULL,
  `received_amount` varchar(200) NOT NULL,
  `status_text` varchar(255) NOT NULL,
  `status` int(3) DEFAULT NULL,
  `ipn_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_users`
--

CREATE TABLE IF NOT EXISTS `ico_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` text NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve_edition` int(11) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `notification` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_user_config`
--

CREATE TABLE IF NOT EXISTS `ico_user_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_coins` varchar(200) NOT NULL,
  `previous_coins` varchar(200) NOT NULL,
  `token_change_rs` varchar(300) NOT NULL,
  `referral_coins` varchar(200) NOT NULL,
  `reference_id` varchar(100) NOT NULL,
  `refered_id` text NOT NULL,
  `google_auth_code` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `link_expire` int(11) NOT NULL DEFAULT '0',
  `token` varchar(500) NOT NULL,
  `forgot_token` varchar(500) NOT NULL,
  `ip_token` varchar(500) NOT NULL,
  `otp` int(11) NOT NULL,
  `login_type` varchar(50) NOT NULL,
  `login_attempt` int(11) NOT NULL,
  `sdelete` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `twilio_token` int(11) NOT NULL,
  `mail_authetication_code` varchar(30) NOT NULL,
  `mail_authetication_date` varchar(40) NOT NULL,
  `refered_status` int(11) NOT NULL COMMENT '(0=off,1=on)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_user_ip`
--

CREATE TABLE IF NOT EXISTS `ico_user_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ico_user_track`
--

CREATE TABLE IF NOT EXISTS `ico_user_track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `device_id` varchar(1000) NOT NULL,
  `device_type` varchar(500) NOT NULL,
  `country_name` varchar(200) NOT NULL,
  `country_code` varchar(200) NOT NULL,
  `ip_address` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `google_auth_code` varchar(50) NOT NULL,
  `authentication` int(11) NOT NULL COMMENT '(0=disable,1=enable)',
  `twilio_otp` int(11) NOT NULL,
  `login_attempt` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `google_auth_code`, `authentication`, `twilio_otp`, `login_attempt`, `token`) VALUES
(1, 'enpor@admin.com', '3oHvosNC9qSjnqALbJXvWeRhaaH501rvrD6VGSNid0jMLAtothbbfflnT4Pjjs8Y9B7r8l/K0pz7WkVmaoa44w==', 'PZO5TD4T455S74JT', 0, 0, 0, ''),
(2, 'malkeet.boominfotech@gmail.com', '/tYTzqOd7PqwBbMUy4+IAo9daXcSueEne4C6TvDCMD2Z9X9C2mxK39FKIPBPlheygI5qcZjUXMho+/JQ+fOCyA==', '3GZYEAS67FWIZQRD', 0, 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
