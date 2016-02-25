--
-- Table structure for table `trip`
--

DROP TABLE IF EXISTS `trip`;
CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `trip_description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trip_price` int(11) NOT NULL,
  `trip_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `trip_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  CONSTRAINT pk_trip PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_firstname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `user_salt` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `user_town` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_zipcode` int(10) DEFAULT NULL,
  `user_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  CONSTRAINT pk_user PRIMARY KEY (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` date NOT NULL,
  `user_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  CONSTRAINT pk_cart PRIMARY KEY (`cart_id`),
  CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `cart_trip`
--

DROP TABLE IF EXISTS `cart_trip`;
CREATE TABLE `cart_trip` (
  `cart_trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  CONSTRAINT pk_cart_trip PRIMARY KEY (`cart_trip_id`),
  CONSTRAINT `fk_cart_trip` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_trip_2` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `trip_id` int(11) NOT NULL,
  `user_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `review_content` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `review_rating` int(11) NOT NULL,
  CONSTRAINT pk_review PRIMARY KEY (`trip_id`,`user_email`),
  CONSTRAINT `fk_review_trip` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_review_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;