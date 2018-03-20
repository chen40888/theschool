-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2018 at 03:49 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jon_b`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`) VALUES
(2, 'Cyber', 'is a prefix used to describe a person, thing, or idea as part of the computer and information age. Taken from kybernetes, Greek for \"steersman\" or \"governor,\" it was first used in cybernetics, a word coined by Norbert Wiener and his colleagues.', 'cyber.jpg'),
(3, 'Economy', 'The economy is defined as a social domain that emphasizes the practices, discourses, and material expressions.\r\neconomy is defined as a social domain that emphasizes the practices, discourses, and material expressions associated with the production.', 'economy.jpg'),
(4, 'History', 'Historians write in the context of their own time, and with due regard to the current dominant ideas of how to interpret the past, and sometimes write to provide lessons for their own society. In the words of Benedetto Croce. History can also refer to the academic discipline which uses a narrative to examine and analyse a sequence of past events', 'history.jpg'),
(5, 'Capital Market', 'A capital market is a financial market in which long-term debt (over a year) or equity-backed securities are bought and sold.\r\nModern capital markets are almost invariably hosted on computer-based electronic trading systems.', 'capital_market.jpg'),
(6, 'QA ', 'preventing mistakes or defects in manufactured products and avoiding problems when delivering solutions or services to customers.\r\nSample quality assurance job description that clearly lists the duties and responsibilities associated with a quality assurance role. ', 'qa.png'),
(7, 'engineer', 'as practitioners of engineering, are people who invent, design, analyse, build and test machines, systems, structures and materials to fulfill objectives and requirements while considering the limitations imposed by practicality, regulation, safety, and cost.', 'engineering.jpg'),
(11, 'Python', 'Python is an interpreted high-level programming language for general-purpose programming. Created by Guido van Rossum and first released in 1991, Python has a design philosophy that emphasizes code readability, and a syntax that allows programmers to express concepts in fewer lines of code.', 'python.png'),
(12, 'C#', 'C# is a multi-paradigm programming language encompassing strong typing, imperative, declarative, functional, generic, object-oriented (class-based), and component-oriented programming disciplines. It was developed by Microsoft within its .NET initiative and later approved as a standard by Ecma (ECMA-334) and ISO.', 'c.jpg'),
(13, 'full stack', 'On the front-end, the full stack web developer uses a combination of HTML, CSS, and JavaScript to build everything a user sees and interacts with on a website. On the back-end they develop the application, server, and database that make up the foundational structure of a website. ', 'full_stuck.png');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `image`, `id_card`) VALUES
(14, 'shara under', '05240999888', 'shara@gmail.com', 'shara.jpg', '12345678'),
(16, 'moshe moshe', '052445688', 'moshe10@walla.co.il', 'moshe11.jpg', '30778865'),
(17, 'david halfon', '0524087677', 'david_aa@gmail.com', 'david.jpg', '13342657'),
(18, 'ben bar-on', '050888976', 'benba@gmail.com', 'ben.jpg', '3324451'),
(19, 'liran moshe', '096654323', 'liran_m12@gmail.com', 'liran.jpg', '14426745'),
(20, 'menashe kobi', '05477675', 'menashe@gmail.com', 'a.png', '1665438'),
(22, 'lior avraham', '050667665', 'lior_tak@walla.com', 'lior_av.jpg', '23432344'),
(23, 'eitan shavit', '05344234', 'pafi@gmail.com', 'eitan_sha.jpg', '234323'),
(24, 'or akiva', '22476539', 'oror11@gmail.com', 'malicccc.jpg', '234323'),
(26, 'einav adi', '050775352', 'gda@gmail.com', 'chen.png', '3563477'),
(27, 'maor zaguri', '052443568', 'zaguri@gmail.com', '1366x768.jpg', '74658723'),
(31, 'moshe', '054534533', 'aaa222@gmail.com', 'beautiful-models-wallpaper-11.jpg', '487356435'),
(32, 'or olam', '0548877623', 'orzuk11_gmail.com', 'chen.png', '423426554'),
(33, 'amos nach', '10203040', 'amos1020@gmail.com', 'moshe.jpg', '687326487'),
(34, 'moshe mlaci', '052778374', 'mosh_mosh@walla.co.il', 'moshi.jpg', '32746539'),
(35, 'chen nachum', '098765432', 'chen@gmail.com', 'chen.png', '305266074'),
(36, 'chen', '222223344', 'chen40888@gmail.com', 'chen.png', '23123123'),
(37, 'chen cocbi', '050777624', 'chen_40@gmail.com', 'cc.jpg', '333074765'),
(38, 'lavi ohayon', '05546675', 'lavi_o@gmail.com', 'WhatsApp Image 2017-10-26 at 12.45.21.jpeg', '123213765'),
(39, 'melec sdom', '05788635', 'melech@gmail.com', 'putin.jpg', '234324'),
(40, 'kofifo navon', '03324324', 'kovika@gmail.com', 'sini.jpg', '3243242342');

-- --------------------------------------------------------

--
-- Table structure for table `students_courses`
--

DROP TABLE IF EXISTS `students_courses`;
CREATE TABLE IF NOT EXISTS `students_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `cours_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=623 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_courses`
--

INSERT INTO `students_courses` (`id`, `student_id`, `course_id`) VALUES
(274, 27, 5),
(275, 27, 6),
(276, 27, 7),
(297, 33, 2),
(298, 33, 3),
(375, 35, 2),
(376, 35, 3),
(377, 35, 5),
(383, 36, 2),
(384, 36, 3),
(385, 36, 6),
(475, 38, 2),
(476, 38, 3),
(477, 38, 4),
(478, 38, 5),
(479, 38, 7),
(516, 18, 3),
(517, 18, 4),
(518, 18, 5),
(519, 18, 11),
(520, 18, 12),
(521, 19, 2),
(522, 19, 3),
(523, 19, 4),
(524, 19, 6),
(530, 20, 2),
(531, 20, 5),
(532, 20, 6),
(533, 20, 11),
(534, 20, 12),
(535, 22, 5),
(536, 22, 6),
(537, 22, 12),
(542, 34, 3),
(543, 34, 4),
(544, 34, 7),
(545, 34, 11),
(546, 34, 12),
(550, 37, 4),
(551, 37, 5),
(552, 37, 12),
(553, 39, 2),
(554, 39, 11),
(555, 24, 2),
(556, 24, 4),
(589, 14, 3),
(590, 14, 4),
(591, 14, 6),
(592, 14, 7),
(593, 31, 2),
(594, 31, 3),
(595, 31, 4),
(596, 31, 6),
(597, 17, 2),
(598, 17, 3),
(599, 17, 5),
(600, 17, 6),
(601, 17, 7),
(602, 40, 3),
(603, 40, 4),
(604, 40, 13),
(605, 16, 2),
(606, 16, 6),
(607, 16, 13),
(617, 23, 2),
(618, 23, 3),
(619, 23, 4),
(620, 23, 6),
(621, 23, 11),
(622, 23, 13);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_created` datetime NOT NULL,
  `type` enum('login','reset_password') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'login',
  `status` enum('valid','invalid','expired','logged_out') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'valid',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `member_id`, `token`, `date_created`, `type`, `status`) VALUES
(1, 1, 'd14awzjB4nI0sq9jcoLmuoX56gB8imef7CD1adT5hd6y23rxnh0YqZhp5HAbsJc2xL0v91Ls6PeAbIfvWQu3z67540WXhzaqb8l202IXUHSb2G70Cav8A2JckVn0fY3r25TZaf0opfH0kuOaYo98ZoPJpbs23pHJ9qo1TMcPHN4KcxMoj0tccHit3D3FajU2bFVq5sX0dIGpS6d762WWdfHQxzuehj63aG2i5OWL809iJ7q0UH17kVi7AGUFii5', '2018-03-18 18:44:03', 'login', 'logged_out'),
(2, 1, 'X70WGN8mboeYc6R49WU128dPS856bvBB9Fb9Qieme2tl0ue20ahGCif9lLiAAu0feTwfUAlnR4hEIleNszMRW8PeBwKu8W4EXiG64gbcx6IBrbH47Unh4ZuJasYtlE2bIcUBOAZ7dOTDM2HJ7cwCvd32BsUe9L98cYc5QJ4zqm0DoNuTwwg8JKF2o1Lhwfo9Bmd034wtB4E37K8wy4vkcJwMIUNJ2ZzL0eiazSK0d74Ead8fUe2Lip9wxXN1CiG', '2018-03-18 18:47:05', 'login', 'logged_out'),
(3, 1, 'aGu1fkCbDbvtY605znRPuekH7k8n1oKbdeke1TEzu0Dma8pu99GsePO0R5X7IaG4z8g5HweJ179gQ709mGp4OCBv7pmj2dSVU6d89z50jcQ94TIWXNbmhHb9zfsmA9XLQP92Rh268bfM3MKAy29W1bFs0tWc8lMagNz0hO5Gz5K633dh87NwxH8yg12lsY8pW1X16j8e763i3biz2Yc9ougN6aocShYbVcTwQElfW2Ap1LtOO6fBWCbe9NWMuX6', '2018-03-18 19:02:36', 'login', 'logged_out'),
(4, 5, 'yr7851WTfaz1lePeQR4nMA9kJ4m93wzevpAl688AeacnJ9vDOzDkueIjXNH499B0j9V2A18YcW1XfGNHkv6vfEE5bCoSSxbuknVGX1QS7rt2eIfbWXIEw8RXa2qc5gANgmPy0i2grZyZPredeN62aqcY7sQdg13IraCkbBGs6B5rCXqRFe7IYheK6OqYebGR9A3hjPBcwRglci3h4bf9fTM42W523S74ej66wn3Yv5cbUU8m0xTLJDadH1l6YH0', '2018-03-18 19:09:46', 'login', 'logged_out'),
(5, 1, 'F9F2v6luC2oYmAutMK4300vFfxgrVWBRpV51iX2Rqyb3kathNX2aM9b6Sb9d3bJcm3hX08nViYNr6Kw0LDX1d693R5i5f2POJ0245IR5qK8s8D1e1vCdy79c4SxV1ifcf7y7wQJUxekcKQ2b0PUi08xHfa01972FOsOIp0DuCcUmjKCz45DhKsdcZ0m1cKUfhe3FKOlM4Q23Fc5omd4eRf3588rmu8cEf218ISdHEFcfjAzeTjV9p5U0fx2O6Ky', '2018-03-18 19:15:51', 'login', 'logged_out'),
(6, 1, 'GR4J04whUuyALbH3jP6i5J2N1RhoyBqJRclen1HaZ3bG6knW9poHTtBMzE4pCFcxj4E2la03y9LK7ly14ALF1n0bQ65aD4qbb1u0Raj341RfY9m339b45AcOXm1FaCfx0eZaeS6ctdAeq5579YAFO465a2b8Q2dYqolEewCzdUdcm53v6ZHd67xV9q7W4Benqqow33w0vbIfe7bDIOmesLg75N8gdejCajpN7DbzabT64fH49eBxP1l2z25asvz', '2018-03-18 20:06:50', 'login', 'logged_out'),
(7, 1, '6j6M541o44abE76odBle4jx7g3gB1Ichx6V93Aakm7ugwWD2bGEo21Bjbwxh2m5I3j2iJFU4Yf1tfxl9x8parE42oyhBfei4A1g0nZLcB3X69Ad24jpXefE3ukEUB7uYNIrpAvqmL4ymyN5c5j3Jf4wxc3711pf1dt7HvSxcRC87r46N56aF71b4LfG29RZsf0WdC04yQ088X8uwPtD721y45Mo7gdddnKc7rstn6K6Ag0E74atammX9Xx1RS0Z', '2018-03-18 20:12:09', 'login', 'valid'),
(8, 1, '3Xc6bP3CT4SVeunTguffwAf72L21HBjOkFBd7hdc940elZcw50oUaHdJFNz9kLl0j18XecUf78HgBEsa14Sc20jUgGYlk1ns4OU8GrBnx82Z75H2nqG54dMDZq34f9QNeLzwKGCpxn9P89b03AV7zWyOuisTqMPkxe9z7Ia7rm4U1a56pwehI7dvE9baKm9oLtDR5nAy6ESJdeu54aVn762JQx8ml1L51dI3pUlca3M7u7910Zs42fX04X7OzV8', '2018-03-18 20:13:02', 'login', 'logged_out'),
(9, 5, '7uG4HabJPg972ud9XF4bi2d6PPhwag6946sp651i1bAS1rpW9H3dobccl3C3joyePvohIM33t4g2VNL6c146jsPTLZKd6LypvcjqiuXrs3lT7Ca2yH9o5b2Q1BPKv7Ge07Fbbs546oh2CPB1f7v4Cjv7zG6G81BDPx4vyVXbmSaM2cQ2bdZGdpnK1H1QbRMjWUtT80F5oaMAuBhfb5XvFRla35Y9uZ0n61zNM7q2HNuL8eHeceYLWmb6ubui0cZ', '2018-03-18 20:14:19', 'login', 'valid'),
(10, 1, 'azYMO1Sb2u88H30MEXW259u4UgXb0rXbJ9fJhrfmfja5kz37Uka3EfK8D6DwddgQF8lr79efGZzO1a7gaHxL4rtWz0ldye8yEumQqU48HbL3K73228lOygaxvKSm079dbSF4gdK4n5m52wZwz39vQg800h8V0hTrdWGkYc10tc666QunHf4L2Q469bFklIgNeLctUeIi8QoE8cbCW4idyJkVU873fbBf95gQ5Xyc9ISgbO8kMPvxJewmYB2BtNi', '2018-03-19 15:04:13', 'login', 'logged_out'),
(11, 12, '5meK7XLmqelCcg9q4W2c9o7app0CvXML0K887l6Zjc6lMTn8AZTM8To5K5aR08e81yIlt28cvQpdfddG9gLC9rY2NsbrK514393Lj6Gb8ix0TNasv76Mf7caBi3M19Dy3DdARe83OX03UuDYJkdH6hPefIp0MYzuM9Vypfad7S5Sy5JOO4wW5r2W2xW0HcB0p7IVfxtZt7a1mj8T96ciWdN3aXSaf1Oxb3uhpvYPgaBw0yTuxbZ0ecdwke79FSY', '2018-03-20 14:44:02', 'login', 'logged_out'),
(12, 1, 'aZ4dN0BVifM6V8d59dbkzlJ5sd9qgOx2k8dk1zqC92tgBWlab24pB7V0hpfOcKesAyU7i5e9CdJSzTf8AZak1X901bZX09rvgLO8Arfj0R4Z45soecUNMaO1M8Vacbwd46BDcjtsdSZY0AftmC9EgaF8S17gim91nyvzRERysWl4ZMpWzSwzi4nf3y28BuADPV0HAa1bf7obhj7aK3dcVRFrWub5sZcr083r9Ndeb9N9sHjncJ8t14TTDp7Jw56', '2018-03-20 14:46:09', 'login', 'valid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`, `id_card`, `image`) VALUES
(1, 'Chen Nachum', '0524088000', 'chen40888@gmail.com', 'chen', 'owner', '305266074', 'my-passport-photo.jpg'),
(3, 'Inbal Ehud', '0556652432', 'inballl12@gmail.com', 'chen', 'manager', '3323231111', 'inbal.jpg'),
(4, 'Alex Barkan', '5433454111', 'alesandro@gmail.com', 'moshe', 'manager', '1231234', 'ale.jpg'),
(5, 'J\'eki ohev', '055676223', 'ohev_zion@gmail.com', 'jajajaja\'', 'manager', '58398750', 'kk.jpg'),
(9, 'Kobi Oz', '055427762', 'oz_k5@gmail.com', '1234', 'sales', '2121219944', 'cc.jpg'),
(10, 'Elyakim Mazerano', '343242343', 'mazerano989@gmail.com', '1111', 'manager', '213123123', 'yak.jpg'),
(11, 'david cohbi', '252454252', 'cohav878@walla.com', '2342432', 'manager', '25544423', 'ben.jpg'),
(12, 'eeeehod', '234234', 'SSSS@SSS', '33333', 'sales', '234234', 's.jpg'),
(14, 'menashe amagniv', '23423553', 'menas2256@gmail.com', '1234', 'sales', '2245435345', 'sini.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD CONSTRAINT `students_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `students_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
