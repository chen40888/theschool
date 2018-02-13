/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.19 : Database - jon_b
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
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

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`phone`,`email`,`password`,`role`) values (1,'chen','0524088000','chen40888@gmail.com','chen','owner'),(2,'inbal','0522222222','inbalik@gmail.com','inbal','tea'),(3,'david','394948558','david@gmail.com','david','te');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
