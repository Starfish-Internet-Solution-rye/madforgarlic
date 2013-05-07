-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2013 at 04:19 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `madforgarlic`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(45) NOT NULL DEFAULT 'New Album',
  `album_folder` varchar(250) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_title`, `album_folder`) VALUES
(1, 'Background Images', 'Background-Images_album'),
(2, 'slider images', 'slider-images_album'),
(3, 'Menu_Images', 'Menu_Images_album'),
(4, 'Pasta_images', 'Pasta_images_album');

-- --------------------------------------------------------

--
-- Table structure for table `album_image_sizes`
--

CREATE TABLE IF NOT EXISTS `album_image_sizes` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimensions` varchar(20) NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`size_id`),
  KEY `fk_size_album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `album_image_sizes`
--

INSERT INTO `album_image_sizes` (`size_id`, `dimensions`, `album_id`) VALUES
(2, '489x978', 2),
(3, '671x987', 1),
(4, '489x301', 1),
(5, '23x134', 3),
(7, '358x332', 4);

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_settings`
--

CREATE TABLE IF NOT EXISTS `enterprise_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `use_smtp` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_host` varchar(45) NOT NULL,
  `smtp_username` varchar(45) NOT NULL,
  `smtp_pass` varchar(45) NOT NULL,
  `smtp_auth` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_port` varchar(45) NOT NULL,
  `from_email` varchar(45) NOT NULL,
  `from_name` varchar(45) NOT NULL,
  `to_email` varchar(45) NOT NULL,
  `to_name` varchar(45) NOT NULL,
  `google_analytics` text NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `enterprise_settings`
--

INSERT INTO `enterprise_settings` (`settings_id`, `username`, `password`, `use_smtp`, `smtp_host`, `smtp_username`, `smtp_pass`, `smtp_auth`, `smtp_port`, `from_email`, `from_name`, `to_email`, `to_name`, `google_analytics`) VALUES
(1, 'admin', 'fe703d258c7ef5f50b71e06565a65aa07194907f', 1, 'mail.starfi.sh', 'mailing@starfi.sh', '4mailing', 0, '25', '', '', 'ug@agl.com.au', 'Upstream Gas', ' var _gaq = _gaq || [];\r\n  _gaq.push([''_setAccount'', ''UA-35662078-1'']);\r\n  _gaq.push([''_trackPageview'']);\r\n\r\n  (function() {\r\n    var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true;\r\n    ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js'';\r\n    var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s);\r\n  })();');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `image_title` varchar(45) NOT NULL DEFAULT 'New Photo',
  `image_caption` varchar(500) NOT NULL DEFAULT 'Place caption here.',
  `filename` varchar(120) NOT NULL,
  `filename_ext` varchar(4) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `fk_images_album_id` (`album_id`),
  KEY `fk_images_size_id` (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `album_id`, `size_id`, `image_title`, `image_caption`, `filename`, `filename_ext`, `date_created`) VALUES
(4, 2, 2, 'New Photo', 'Place caption here.', 'rotating_image1', '.png', '2013-04-22 03:03:37'),
(5, 2, 2, 'New Photo', 'Place caption here.', 'rotating_image2', '.png', '2013-04-22 03:03:45'),
(6, 2, 2, 'New Photo', 'Place caption here.', 'rotating_image3', '.png', '2013-04-22 03:03:51'),
(7, 2, 2, 'New Photo', 'Place caption here.', 'rotating_image4', '.png', '2013-04-22 03:03:57'),
(8, 2, 2, 'New Photo', 'Place caption here.', 'rotating_image5', '.png', '2013-04-24 08:36:25'),
(9, 1, 3, 'New Photo', 'Place caption here.', 'About_bg', '.png', '2013-04-26 03:44:07'),
(10, 1, 3, 'New Photo', 'Place caption here.', 'global_bg', '.png', '2013-04-26 06:01:42'),
(11, 1, 3, 'New Photo', 'Place caption here.', 'contact_bg', '.png', '2013-04-26 06:50:13'),
(12, 1, 4, 'New Photo', 'Place caption here.', 'menu_bg', '.png', '2013-04-26 08:32:40'),
(13, 1, 3, 'New Photo', 'Place caption here.', 'MenuBg', '.png', '2013-05-07 02:58:15'),
(14, 3, 5, 'New Photo', 'Place caption here.', 'madgarlic', '.png', '2013-05-07 03:21:49'),
(15, 3, 5, 'New Photo', 'Place caption here.', 'madgarlic-brown', '.png', '2013-05-07 04:00:22'),
(22, 4, 7, 'New Photo', 'Place caption here.', 'arrabita', '.png', '2013-05-07 06:05:09'),
(23, 4, 7, 'New Photo', 'Place caption here.', 'creamychicken', '.png', '2013-05-07 06:05:15'),
(24, 4, 7, 'New Photo', 'Place caption here.', 'GarlicPasta', '.png', '2013-05-07 06:05:22'),
(25, 4, 7, 'New Photo', 'Place caption here.', 'shrimp', '.png', '2013-05-07 06:05:31'),
(26, 4, 7, 'New Photo', 'Place caption here.', 'triple', '.png', '2013-05-07 06:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_title` varchar(45) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `description` text,
  `date_created` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_products_product_categories1` (`category_id`),
  KEY `fk_products_3` (`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `route_id`, `category_id`, `subcategory_id`, `product_title`, `price`, `description`, `date_created`, `date_updated`) VALUES
(29, NULL, 1, 1, '100ml', '250', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  `category_url` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_title_UNIQUE` (`category_title`),
  UNIQUE KEY `category_url_UNIQUE` (`category_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_title`, `category_url`) VALUES
(1, 'Beer', 'products');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `used_for` varchar(45) NOT NULL DEFAULT 'main_image',
  PRIMARY KEY (`product_image_id`),
  KEY `fk_product_images_images1` (`image_id`),
  KEY `fk_product_images_products1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_subcategories`
--

CREATE TABLE IF NOT EXISTS `product_subcategories` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_title` varchar(100) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `subcategory_description` varchar(250) NOT NULL,
  `subcategory_url` varchar(100) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `FK_subcategory_2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product_subcategories`
--

INSERT INTO `product_subcategories` (`subcategory_id`, `category_id`, `subcategory_title`, `image_id`, `subcategory_description`, `subcategory_url`) VALUES
(1, 1, 'St. John Series', 3, 'Aweseome', ''),
(2, 1, 'San Miguel Beer', 2, 'Extra Strong Beer', ''),
(3, 1, 'St Johns Series Specials', 3, 'Super awsome! Fantastic Beer', '');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `permalink` varchar(45) NOT NULL,
  `page_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`route_id`),
  UNIQUE KEY `permalink_UNIQUE` (`permalink`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `routes`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `user_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_role_id` varchar(45) NOT NULL DEFAULT 'admin',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_accounts`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_image_sizes`
--
ALTER TABLE `album_image_sizes`
  ADD CONSTRAINT `fk_size_album_id` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_album_id` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_images_size_id` FOREIGN KEY (`size_id`) REFERENCES `album_image_sizes` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_3` FOREIGN KEY (`subcategory_id`) REFERENCES `product_subcategories` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_product_categories1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_images1` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_images_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  ADD CONSTRAINT `FK_subcategory_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
