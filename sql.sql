/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.12-log : Database - jon_b
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jon_b` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jon_b`;

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `courses` */

insert  into `courses`(`id`,`name`,`description`,`image`) values (1,'full stack','web developer amaining','full_stuck.png'),(2,'cyber','hack and protect computers and people','cyber.png'),(3,'dcdc','dddd','img.jpg'),(4,'fvfvfv','vf',''),(5,'fvfvfv','vf','img.jpg'),(6,'fvfvfv','vf','full_stuck.png'),(7,'chencehcn','vf','full_stuck.png'),(8,'chencehcn','vf','full_stuck.png'),(9,'chencehcn','vf','full_stuck.png'),(10,'chencehcn','vf','img.jpg'),(11,'chencehcn','vf','img.jpg'),(12,'chencehcn','vf','img.jpg'),(13,'chencehcn','vf','img.jpg'),(14,'moshe moshe','vf','img.jpg'),(15,'momoshe','vf','butterfly.jpg'),(16,'momoshe','vf','butterfly.jpg');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`phone`,`email`,`image`) values (1,'chen','0524088000','chen40888@gmail.com','chen.png');

/*Table structure for table `students_courses` */

DROP TABLE IF EXISTS `students_courses`;

CREATE TABLE `students_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `cours_id` (`cours_id`),
  CONSTRAINT `students_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `students_courses_ibfk_2` FOREIGN KEY (`cours_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `students_courses` */

insert  into `students_courses`(`id`,`student_id`,`cours_id`) values (1,1,1);

/*Table structure for table `token` */

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_created` datetime NOT NULL,
  `type` enum('login','reset_password') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'login',
  `status` enum('valid','invalid','expired','logged_out') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'valid',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `token` */

insert  into `token`(`id`,`member_id`,`token`,`date_created`,`type`,`status`) values (1,1,'3PcCsbjiT9zBZ27vqcs5bcII4nc0wahCWmrXYOuaS9W9ysYE1rf9DWLzsPfy62tA5KcrZibyWVkNabYRPBwS01TzsVVeeI2jxEaaDs8L000Qca41iXoeWEqIWIoMx26q29W5eKgouj6hfOJLSzCc8mbd2yGpMSYsqK5Di6B8wuSZ1eY5gYV5BmyF9n30eojHoZf7YY60emcKQVVlnY81oPLau68pFWTaXX3dZf3De10ZGb05m45xcja0L6Zf42R','2018-02-15 12:48:38','login','logged_out'),(2,1,'FEUk4pSd9sGeCrAq6aGx0n8OIGCe3HG9nMBYAQiD80kfvo5HRA4KKh5dRF106fPp4j09v66DibQJez5oVta7YwBa9O1E7PCLdKrkpecd43Bej7FG2ffT9xXG45L8dqTPVaX8PbKdmuzd972jnY2fZ6cPuqTqIyvukdRXzHb0c4cS4v3b8BT10p2K96fNA2bq92bap7oa7lz04C8WKUo2iw8OiYTa7O1CZtX0kW29pIz8c4BcfU3bqjd1JVG7Teb','2018-02-15 13:05:26','login','logged_out'),(3,1,'Gp6bO28cWINjv100c6Q2Xs63hJQaQPAqf14x1UUBE8589d7FF2fAh8fpq3H5xFBXmjoM4tvtac7RC6we9OJfc20dCHWTZbV3Jamfwta7pl3kA3i5io3pv1i1ae06mtnZdmb44jg3D8OhaGpVC5388c2Q8Rjt2cMdS1du4xVQSUQRWIudHFn1af57n6hfBdmj6tOI2Pjvn6TcRhmUKMed3gUtLVfaDAFWk79bC1B7WC17hwB1q75GYa09f3VpcSf','2018-02-15 13:05:35','login','valid');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `id_card` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`phone`,`email`,`password`,`role`,`id_card`) values (1,'chen','0524088000','chen40888@gmail.com','chen','owner',NULL),(2,'inbal','0522222222','inbalik@gmail.com','inbal','teacher',NULL),(3,'david','394948558','david@gmail.com','david','teacher',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
