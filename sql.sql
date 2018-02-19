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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `courses` */

insert  into `courses`(`id`,`name`,`description`,`image`) values (1,'Full Stack','web developer amaining','full_stuck.png'),(2,'Cyber','hack and protect computers and people','cyber.jpg'),(3,'Economy','The economy is defined as a social domain that emphasizes the practices, discourses, and material expressions ','economy.jpg'),(4,'History','Historians write in the context of their own time, and with due regard to the current dominant ideas of how to interpret the past, and sometimes write to provide lessons for their own society. In the words of Benedetto Croce, \"All history is contemporary history\". History is facilitated by the formation of a \"true discourse of past\" through the production of narrative and analysis of past events relating to the human race.','history.jpg'),(5,'Capital Market','A capital market is a financial market in which long-term debt (over a year) or equity-backed securities are bought and sold.','capital_market.jpg'),(6,'QA ','preventing mistakes or defects in manufactured products and avoiding problems when delivering solutions or services to customers','qa.png'),(7,'engineer','as practitioners of engineering, are people who invent, design, analyse, build and test machines, systems, structures and materials to fulfill objectives and requirements while considering the limitations imposed by practicality, regulation, safety, and cost.','engineering.jpg'),(28,'cdcdcd','','20140401_091501.jpg'),(29,'vfvfv','','הורד.jpg'),(30,'ddd','','הורד.jpg');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_card` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`phone`,`email`,`image`,`id_card`) values (1,'chen','0524088000','chen40888@gmail.com','chen.png',2),(2,'inbal','0522222222','inbalik@gmail.com','dd.png',3),(3,'chen','0526805080','moshe@moshe','',333),(4,'גגג','02222','mosheee@aaaa','',4545),(5,'alex','0566666666','alex@alex','',7777777),(6,'1111','111111','nachum@chen','',212121),(7,'jjjj','09999992','chen@mosohe','',123456),(8,'dddd','sss','sdasd@sss','',333),(9,'menasheeeee','07777','cjjj@jjjj','',1111),(10,'jaja','0987654321','mmm@ddd','',1111),(11,'moshe','22222','ff@ff','',232323),(12,'moshe','22222','ff@ff','',232323),(13,'moshe','22222','ff@ff','',232323),(14,'dada','20203331','jjj@kkk','',1234432),(15,'bdiak10','','bdiak10@bdika','',123456),(16,'bdiak10','','bdiak10@bdika','',123456),(17,'cdcdcdcd','99999999','inbal@inbal','',11111111),(18,'cdcdcdcd','99999999','inbal@inbal','',11111111),(19,'cdcdcdcd','99999999','inbal@inbal','',11111111),(20,'cdcdcdcd','99999999','inbal@inbal','',11111111),(21,'cdcdcd','12345454','inbal@inbal','',234323),(22,'cdcdcd','12345454','inbal@inbal','',234323),(23,'cdcdcd','12345454','inbal@inbal','',234323),(24,'cdcdcd','12345454','inbal@inbal','',234323),(25,'bdika','99999999','bdika@bdika','',777777),(26,'cdcd','ddcd','cdcd@fff','',122),(27,'ccc','2222','chen@mosohe','',11111),(28,'sdasd','aaaaa','ccc@ss','',2222);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `students_courses` */

insert  into `students_courses`(`id`,`student_id`,`cours_id`) values (1,1,1),(2,2,1),(3,1,2),(4,1,3),(5,21,2),(6,21,4),(7,21,6),(8,21,28),(9,25,1),(10,25,2),(11,25,3);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `token` */

insert  into `token`(`id`,`member_id`,`token`,`date_created`,`type`,`status`) values (13,1,'h2q9taQa09CW12adYacU6Kb8LI8t5slJq1dAd85Ra180304FpYZ8i86YMdlcXM8Tr3d9e26m1vZ8nJH5aCDPGgEUQG10S61nBl2JcFWG3oR1GJU21JOjdb7NIMnbbbd6af0Fn1bIcvU5f0atbBbw9b4efbCdF68xArGk56Eed11ZK1b0f24xLVZiNFHJqWopLeMJNbDl0sGa95qwJ2pVFJdaFXZ9HGm3c4CPBKiqKOPzb9lK6b26D9W1HaBvJA6','2018-02-15 21:17:54','login','logged_out'),(14,1,'o2Le26s2BKyFa8Adv2JGqt5P8Ncf0fEb7alf1IsH7s43vqYi3bj605A45fbhbUa180206ZvRNeccIsDQxdyk4bD3O3QB2dnQyy2yvcsIB7yO1o2eH4paHYDsYbFERuAPgr3b7AExox8hcqF9pLgh406fw6DhmoUf74C54veBJ7e2wWcVdNsZrdc0kA8YgF9G8MVcew6c97n5e32WRoCOyKz3bhU27jeLv7Hus7rLA5qim9esraM31TRSrBlumLK','2018-02-16 11:10:13','login','logged_out'),(15,1,'5X1WakEo9T0aJN0kwo559Dbpdm76d3CXCKXa2bOVol7ErC229Cv2ap0jxs5nw6Uc8wxDN0NcYKFsusf1V0WObg7toUJ73dN78zvTExBcVU2kM49lkTceCUcr7JbAJabYjeJIibk5bBEcbfvlAjSbI5cfKubpXqtNF1bE9GD1Ce2MFx7s6A3UiC0HH2eQ9QedMna3KYqdz54f47tdE26qc4uw7pdGymO2F9Dnpab1K27CPdPYaX399SecdmejecY','2018-02-16 12:31:08','login','logged_out'),(16,1,'5jc116q5xISkB97OiyPNx9x68eBnV886ChoX4Kp6ecyRbjUUfrBymYQ3d2z9yC5JP1c6zEIprbcvHz9q3f4FmoYBta7PU13YkvaoGcBBieOAqwvN8yydEqsj9adM0JcfOdfl41awa1jIdAmb9vlQ2pYgsbFJA0OOPe1s1Z8FNKdUbaT0Ji71d1y39kl118obbAxMO0T93drTaXVkCHTy8gm1R21oVKr8bL62MffNW1Xlk1bLbkp9w9Rpwdwi2y0','2018-02-16 12:31:32','login','valid'),(17,1,'3hEk4M6Sn6Nj91xwffJ41oSUocSQb2c0114Xpd8rCd5K4oVXLQe6e1bJy0ubVvf2XPGAgAj83UJh0a3eZaFQZQ5dEpEaztdCjhAScz7dTZfq0x5kIdEW6HLfa44zLgq3P3i4JVec9wSlC3aB3Mduq5W3dlsUaaPgp2YuSPEbDwme9e0nr7R9KcuZ7wOp52Cnwsxa40b1ZeICT8qR0jeK1641xcOJ2Obpf3bf721c2Pz9kidXbHAESW214Aggv9C','2018-02-18 15:27:05','login','valid');

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
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
