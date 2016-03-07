--
-- Base de données :  `verygoodtrip`
--
CREATE DATABASE IF NOT EXISTS `verygoodtrip` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `verygoodtrip`;

--
-- User 'vgt_user'
--

GRANT USAGE ON *.* TO 'vgt_user'@'localhost' IDENTIFIED BY PASSWORD '*14E65567ABDB5135D0CFD9A70B3032C179A49EE7';

GRANT ALL PRIVILEGES ON `verygoodtrip`.* TO 'vgt_user'@'localhost';
