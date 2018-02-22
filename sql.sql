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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`phone`,`email`,`image`,`id_card`) values (1,'chen','0524088000','chen40888@gmail.com','chen.png',2),(5,'alex','0566666666','alex@alex','chen.png',7777777),(6,'1111','111111','nachum@chen','chen.png',212121),(8,'dddd','sss','sdasd@sss','chen.png',333),(9,'menasheeeee','07777','cjjj@jjjj','chen.png',1111),(10,'jaja','0987654321','mmm@ddd','chen.png',1111),(11,'moshe','22222','ff@ff','chen.png',232323),(14,'dada','20203331','jjj@kkk','chen.png',1234432),(15,'bdiak10','','bdiak10@bdika','chen.png',123456),(16,'bdiak10','','bdiak10@bdika','chen.png',123456),(17,'cdcdcdcd','99999999','inbal@inbal','chen.png',11111111),(18,'cdcdcdcd','99999999','inbal@inbal','chen.png',11111111),(19,'cdcdcdcd','99999999','inbal@inbal','chen.png',11111111),(20,'cdcdcdcd','99999999','inbal@inbal','chen.png',11111111),(22,'cdcdcd','12345454','inbal@inbal','chen.png',234323),(23,'cdcdcd','12345454','inbal@inbal','chen.png',234323),(24,'cdcdcd','12345454','inbal@inbal','chen.png',234323),(26,'cdcd','ddcd','cdcd@fff','chen.png',122),(27,'ccc','2222','chen@mosohe','chen.png',11111);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `students_courses` */

insert  into `students_courses`(`id`,`student_id`,`cours_id`) values (1,1,1),(3,1,2),(4,1,3);

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `token` */

insert  into `token`(`id`,`member_id`,`token`,`date_created`,`type`,`status`) values (13,1,'h2q9taQa09CW12adYacU6Kb8LI8t5slJq1dAd85Ra180304FpYZ8i86YMdlcXM8Tr3d9e26m1vZ8nJH5aCDPGgEUQG10S61nBl2JcFWG3oR1GJU21JOjdb7NIMnbbbd6af0Fn1bIcvU5f0atbBbw9b4efbCdF68xArGk56Eed11ZK1b0f24xLVZiNFHJqWopLeMJNbDl0sGa95qwJ2pVFJdaFXZ9HGm3c4CPBKiqKOPzb9lK6b26D9W1HaBvJA6','2018-02-15 21:17:54','login','logged_out'),(14,1,'o2Le26s2BKyFa8Adv2JGqt5P8Ncf0fEb7alf1IsH7s43vqYi3bj605A45fbhbUa180206ZvRNeccIsDQxdyk4bD3O3QB2dnQyy2yvcsIB7yO1o2eH4paHYDsYbFERuAPgr3b7AExox8hcqF9pLgh406fw6DhmoUf74C54veBJ7e2wWcVdNsZrdc0kA8YgF9G8MVcew6c97n5e32WRoCOyKz3bhU27jeLv7Hus7rLA5qim9esraM31TRSrBlumLK','2018-02-16 11:10:13','login','logged_out'),(15,1,'5X1WakEo9T0aJN0kwo559Dbpdm76d3CXCKXa2bOVol7ErC229Cv2ap0jxs5nw6Uc8wxDN0NcYKFsusf1V0WObg7toUJ73dN78zvTExBcVU2kM49lkTceCUcr7JbAJabYjeJIibk5bBEcbfvlAjSbI5cfKubpXqtNF1bE9GD1Ce2MFx7s6A3UiC0HH2eQ9QedMna3KYqdz54f47tdE26qc4uw7pdGymO2F9Dnpab1K27CPdPYaX399SecdmejecY','2018-02-16 12:31:08','login','logged_out'),(16,1,'5jc116q5xISkB97OiyPNx9x68eBnV886ChoX4Kp6ecyRbjUUfrBymYQ3d2z9yC5JP1c6zEIprbcvHz9q3f4FmoYBta7PU13YkvaoGcBBieOAqwvN8yydEqsj9adM0JcfOdfl41awa1jIdAmb9vlQ2pYgsbFJA0OOPe1s1Z8FNKdUbaT0Ji71d1y39kl118obbAxMO0T93drTaXVkCHTy8gm1R21oVKr8bL62MffNW1Xlk1bLbkp9w9Rpwdwi2y0','2018-02-16 12:31:32','login','logged_out'),(17,1,'3hEk4M6Sn6Nj91xwffJ41oSUocSQb2c0114Xpd8rCd5K4oVXLQe6e1bJy0ubVvf2XPGAgAj83UJh0a3eZaFQZQ5dEpEaztdCjhAScz7dTZfq0x5kIdEW6HLfa44zLgq3P3i4JVec9wSlC3aB3Mduq5W3dlsUaaPgp2YuSPEbDwme9e0nr7R9KcuZ7wOp52Cnwsxa40b1ZeICT8qR0jeK1641xcOJ2Obpf3bf721c2Pz9kidXbHAESW214Aggv9C','2018-02-18 15:27:05','login','valid'),(18,1,'c2bELF2ebcT6g0fyqeajIltK0bhRO25ZbayZcbPXnHQHZf6ayoC62n7abuaB7SkpZaNns6KtPVfgc6E20GZ598RxTH5LyvxeI0x7GZ24YQ4YC8rxQqO5NDOda1m9t0PJXcGbQCDkhs01Ife69fSnXDeIBkLnXOj0VabbaZjX2yZe7cFQn0Hts80epiazjeq6I3jni4Imec5IzA39g9agrQp5e9Ho6cs0L9C4vN8wk7zwHrkFe6Omm87y2Wk7QK8','2018-02-19 17:34:41','login','valid'),(19,1,'td75rAeReILXrh8S6q2v8fwPTFZ9eBdeXuI893EMHJoU3O8nq9ZWPszZb10Hrfa1qcnGYWMZ13wces4bv8ntqvYwKjt2SXTBNwWinQ9F3afT2OfEeeXTxU50Jd5cLm81SNKt79kN38vWdlAjaJebo1f9z1EBT8st02jWW60HW54OxW3Bq31eTAVk6WxbJ1Ghan9mT7b6agbvG390WhpX5d9U28M1plS70eL2WW67bPr1eSfaWz5mh65LwZgnZfC','2018-02-20 13:52:40','login','valid'),(20,1,'YIqpfhlgC5e7f5CLQJanTGX7aU16se9N25WafaHlvxX4efjAsebt9d4O5J2oE4Qzed42axT0R0tc2C499GWjzU3fHr54iaq2Op7Rt1Js75p75kK9TJD9Sew7wU78GiIAZkP5WP5BhxaT4CCd8GxwE2n1sU7UbPGVVcY206qBhpY3AfH1SiicF1tO914sz856d0CfsIXPPSrd2bKZ3aon67jG0epiN76K569ef4E5Iye71xGtv2949eVb98dQcaO','2018-02-20 14:02:03','login','logged_out'),(21,1,'8cwxzdm5C0RVRGyH94IWXG96oCGCeQD6eyfE4fIw9dyb2qujE8385i0O86wE8Lf4dCadl5dEbiWxJtxL8d18PyQnPgTRIce3ClfQbbWje1QGJc3VWB03IRVCkon53LhSAdm1Sq5Ofbje4VzBL79SZkToXYYUT9tRnAeXuatt30Jcoy99T0Fz0cLwahmN6lM9CxaG8dJF7jAAYarLpbNRcjpFUL2rCzeBgWOPtfFBCcUdYe5Ymijm085B42Fff5O','2018-02-20 14:22:09','login','logged_out'),(22,1,'29ciw0020IwGOecaN102JMMdoAlg7TeUxwNs2w6gTNFvAwa0zeu8ke90vhMeA9NWI438231lA003iJFTIoRlU0XGp3e09JlsonaBRw48D1GJDJCw4B0IBc4qtL1wCiYBXE083xB0BLeWzLiUBZfBnc3w742xCufEoGWEUuCg7Xcf1Ym94K53Oc6ziWPq1iHUub5ZmfK4dt7iZLshthEacz9bywKaWb8dEm914QbKYdeN9uQ4SPJ7m4b89GHShOl','2018-02-20 14:22:22','login','logged_out'),(23,4,'9Ohx0VifNbaD5y9k6nfK1kdAe7r96qes959Q3qE2X2RWaN2Kc8m373vp1kHX5W8NW2jcFsi20eWS45yy3xe4UWObtK5Dh1m19nbx54rjhvefce9a0b8KcW8m83152ShOql9u4y7w9aNb9398BtcKk6tmje5ncIVXRVN0OuSVeH105G40C85mC05vfyF1930QSgzLJd518EJeKa2DjKW8e2iwwLe61HKF1Vln8F5Kexof5cmC0N266u7kyN4LQjs','2018-02-20 14:55:07','login','valid'),(24,1,'567Hs7Ap1Tbnm9L7e1aB536x99CdPm9lTY23oMjbU5ctvya6Ed46ddbsBEam1b3f76VZ2zzY7lD4tY6YI9aca2pgVbOgqSbgRaQqp4kibnOVSeYzpadKg7e4bdNfjzjqmONf7ktk7eg6eI7k7062blrA26I1396277Rv0oQ1LhLHRdTJNt3h7T5WOglr34s60U5PKG89cU4jr24MLZ4Vj5fv5n1a2y4KDOK9dRAtJs9io10co58fcu84b6N1leQ','2018-02-20 14:58:55','login','logged_out'),(25,4,'zd3Dzw16Ru8st9kPb1941YcMhJbdeNQ3805TdzQogCn6u07kz1Y7X62zbP5pB04G8hXhD9bYXH1aVWGjlHALspdMu6uz9I7mFsCtm3dOt3WWcwD6XezoWMbdum56aIjpxW1W46s21g9gKHQ4k2K928nWoNeRc0y74QiXX9S1C19gOc5zThPVt4Bf9y73zaW1GYl6T0iU18jdER4pu09bl7Kuc751ANw9GkBaKe4xSN3b52cm6O7O9NbAHEMLgbe','2018-02-20 14:59:08','login','valid'),(26,1,'QDibvAo3V3a70QWadcTNe0UXBQ5OYpNaeafRM1QaWpdyPdHwi3W5dVC0R47onxj96dcj02a9AuL1P77935kiscibt301mwc0R4IGVlSq4P269DHNahT3tta7225ap4U62eFf3U1aPW3V0h8cFlxqS03Lbx0U8doX6sg61tR876ekdx44FRw2I3g6XDKhG86P7TmObp49Nc5qykJ7b6h17F892vGUBde7c93cr0vfTeKjOtTdjkfdPI3aD16sA2J','2018-02-20 15:02:21','login','logged_out'),(27,4,'rf9E1wp8MAEQ1mYDIkBT5uHRUJbcc4BW2rjCSgrwK3eDLPCvYdfNon3LC1nl27zOh5g9a6DT6vYzXgedi7l05aP5ygdX0NnfqJrGeiA5AbbNZaaIRem3RSb0nG8a4WV07Gbwhb0g5QPHVAS7XJ2sA6dkX6yN48A9eevl4YazrHjGB4165ve74hbb96IkWmQEcSXuftbB9k09b4ajXIIaqRbWqU0Fbqe4Hupfz8NYZFlwc339aTay6vYPrOx4f1k','2018-02-20 15:04:16','login','valid'),(28,1,'X33Iz5OMPrY1iy8m2DKc75ky52QL4O7wPScVVgZ7DkjuKKyc36sEFK8a8R8URp2OJfd3fKf99V6f3Kmfhb0r9Jef12mxthpq5p9meeIi7AmA50XxvXKFRVF0DuJ54jx4B1b0aUcQe6cU5lUd9TCF45wUf4M3JeKq04XY0NaMKGD0e132SF4Ubc2Yayv4OgCydO3ut6786jzfsNCuSfbi9i23THd2H6I1F55xxC4RaQohdc8Rers82imi5pIFd5n','2018-02-20 15:06:53','login','logged_out'),(29,4,'9FgDa0bfhEocW2aiQ0RSuQ52kflsJ9XYsJEbyuPNGfs7Y3XeJcPcPyC3FeVft1J06Mx0yt6HFE3CmHgX8E280naTkmBXe2vXbNA60uSyxbWGecaxkV1NPY8y6RdXGaYbeaIDay48fhaVaNSCJx2kd2Q1H7En3f1E5wd23dxVhLK4lp7q1cr6EcYcWI89nGhKhIEm95p5elxh4cM95qPbaXZ8zw3ep2ZbGpL11fyya58VY3H68D0AekAWO11cmze','2018-02-20 15:07:27','login','logged_out'),(30,1,'KwA3e3qaaru31Sa09dFgBDnDjF1P7fu8ao431Nxy0fxSCLWk0eSA5cbqF3H05bXIxa41U1RmHRla4beD57MyizP8R32NsBkx43afA47a7tYh2KNsrl4ImvQ2dIa1O6HfftP0t8odcuuc1o94VpV3iGIdBHm95b7H1a10rBUdAZtUKesj08Rb61bLRh0azcyCYu8KQC1C9363w75hGWdn39KctlCdHSy6NM3QKd0abmQR28OMdMa4bTvne8rbE6G','2018-02-20 15:10:16','login','logged_out'),(31,4,'I4Nls1d6drJ2Hp9btr108bQMfCR5Sdd2Uidbe1JH9PEMTb1ZerfbZ03lfembH4uh114naaY6rnudf21572x4MQHgcSIpIz5bcfcmZ9yc8RJvLNazRWetg6e4ncSd4cTOdXlXe670TUNeb10I4fKJc1QPMDaX4KzReC7Sz1Fp146dRY9tT98bNfgmo7fJivpuc4dJ34oxi77pPQCikaes1kQ3QjbdmvUip5HdjZ9X1dpfo58cus3Ch7XjgNTi32h','2018-02-20 15:10:23','login','logged_out'),(32,1,'eb2iS2Bu08uOFA8DhyKU96ZbEd201S83laBlPyUB6WN465exV2c5yBfVxYOsQdrac2a0a3DrJM3s9c5dt2X2G2efWe1EKB25Z14e6gfOtp9r4uXBfOniU87auuy0MJfdlZ6Tx8NJP5z2c14ve1vQD5r09bX2xxKmc5FGzdN970ICLuj5QaJKpiW0yybxckaA6qmZ4h5rlppka0YEbd1Z5It9yaef6Gtcw1Ko2WgejCTO6fc529JuQ7PrYTdc8HN','2018-02-20 15:28:07','login','logged_out'),(33,1,'GSNE00bU1Dy82TarklFI8eIL1A9SYnXbUqub2d3cPo5qT8wLbaHR9dQ77DKB5aI29Nukgl2dfD1BZmaEU4aCK5GpJogmO77NY6zNl8I8aer4S8IfdATb1S934HZMA8o18biCW0P5tA6wfaOSb6e8FFepW3eG83jwPgX76qyeI3W27W4rDyNNcE2p5m9fO8x5KpwZws068ds6ffdbgaQij7jN472LRbziKbaGAbx9ia8YMw4081CsZVvFmaK3uee','2018-02-20 17:44:53','login','logged_out'),(34,1,'e9jNNxSk9BFvVM6gwbvpjvPk6f5QU4cCf5J5aaaTEPKdLl2de3n2jxcPtW7WfxYW5Lb57hfyCTa5x1QY8hvgf84q98xl9fyp3ubcpfKw7cW8cFs06a0Gg4OTaifdSMAC0r36ndatyaMb5Xg61VzVhdeZ4qH5b1me8f4uTK9aR1pzxxbBD1KTRS1cc86RVBibwEhZ0Fqe1e8eyIeib8jOoJ2x2VDpC4JU3vcQE9sD631Kl1Uc4z2YGHF8Qb9T339','2018-02-20 17:45:36','login','logged_out'),(35,1,'H7Vc7n6nHkd4txKVwy5Ci927LcufldSi4I56QQao95K5a44hSfRBaQq24Pj39bbtSw8OgGFJn7OivyyM61WT5YIsy97rcIJM0T0BT7IgetOefLSKQxNE4VI5JlXcfYq2lad1T4REn9093yYd5Kf4j2TaxOL9AaD8fi9sIs3eq12a0fCnuwGDhc24wwjVd6151jXcbfucRN25AH0LfgycUHaW2E3LV6NbP5S20hEUfCl8mvW1vlQ8051aD6f2aG8','2018-02-21 15:32:31','login','logged_out'),(36,2,'kqh8kcvF5G9TnfG4U2yay5xANe8d9b2ot510eCoN9c23X4g3m3xyRsO6nLeaQUIP6138ZEVavP2Zz2j7rqc636L1aOu1uR8sljD35FykvDtIe3lbpb6lUl3bhS2ct4ntzr61bdeln7WvMllk3783vxanha3tBs9vfsY0t8230Y1501sHVX7HbaQTA747b4A3b135WDwGR2D1iU1eVkVXF2ChdNBB2aekdjw6E4x6e2pRayN7mRa2eH08f8X38dU','2018-02-21 15:53:13','login','logged_out'),(37,4,'zZdbo1j9cK21vQNXK18W1c5zddy4nWYqYPI105e9g0b1o8m21ATFd2i2VRLafbwyAeIYYeVdqU8ovO87KsS0h1i4nfta9d0G1r7z6xMjow0Jb9O0576mzdP2flsx81HRb62cq7OLXq7U1HQSew1l3cj4fy6tj9YXN5FY587ZWOoGdzFaHOzFrBAKkaMn74Bx8aVxlm5dgHGFambb5sCSem9dA0QdsnUDblp8W8ZpM89b9QPsB2Lndo1bpP7FXN7','2018-02-21 15:53:27','login','logged_out'),(38,4,'0XNzDjamyu3Tw88A81OZiypK6y0aYo9YKgnV2qEScWSdos0eXweVx0tLDYIvQoKoT5ab6CrbJWo3VVR9W2Mxs4aZ5uGFXrIfDfzefwbsiOf2lW3u4Key7Z0fBDIPg9b1qWn6udYWRBjxTn3qkcDWGmLi71e66Iw67ZcMYdVs5cZX3Ec1jEW2qhF0BsP277fHc4jC6Ypz9LpxS6Zs7aj1BLsfzZLZCy8ehmd3S9Q22mfV64c0Ihc1ioeYYP6b002','2018-02-21 15:55:02','login','logged_out'),(39,1,'MufyudeKTpgiWiJDXCCc3t7E9Sh2fdOwtVMYA66faro4eSc2dJ7iJAcu37MjgObk3dEkJ5EWA1QA9BpqVdraYcaY1uVr1hJGunJ5psc5nd5Torb0r0hX6PDtgR6SVsf4J4Wf9LjsaUNe21V0vwwQv65n3cdo5oeWQ1VF5cwnbsveRA8bZ91lPu8a7K9r5D3reBv2W7ryrlGCV82coA6dcrLSc4d6nRFfi9s6xcY0zJHlZmatkPSce0o4eaccCfd','2018-02-21 15:55:18','login','logged_out'),(40,4,'f5P4fR56eTYHg0A2EsYQlO9razEZZsfaNW3JparM9O8K0xf738NNwcPd1IBxKeJH4Xq6pw6iyf2dM67rfLcArsfifYit8dU0A5Sv4jH0B5B3Pm7Rfanv28Eed7fNaAQqi34aj2gaw79n6fcH8PVb5KM8eGb6mDaHw284eVJxqa1PvccW536D3lceXdHlrlObNB8HAvbcb3RaRc3SV1qZf28M3A6OQxv3iwJmRvcfU7fjM9sSR56B2xzx0cfJaWX','2018-02-21 17:10:22','login','logged_out'),(41,2,'67j1Z09a5Va2llmACl9BbIehHygy68Ul6avi0EdXlxadTnns6fcy7jHqd5R0H9iLnqEddYJ3BbfjnuPo64O10I8lPFW21Qs3h5evzezhf8H9pmpcU3F6v33DWZ9Oqa5cOJcbeBr7y1H33jM64v05By8ewueKfz2ajL6b5eGHCtE9pWa1C6g2b4j7lBCbweqap34YEC4l4drfqOwZtLYd93vxm8pfBzqJm515Ina3GopkR0ibQQ2kpwFfRE46XDm','2018-02-21 17:11:12','login','logged_out'),(42,1,'gdhb72I8oOe8vaatzOge9tFJDpyw2eOc7fYW8ywLc11ls6j498Nr80yN7fpfjzQV591VVBhScSK7WozLeHzaWtuJJYH9e4X55Fes2Ki4vXz1P9CafFNhR1bTf4aopfao8uT2dS8f6c6daji6SV6b41a57vOgr9Yes78i3lQHcWgVw4ghIC9Ea6moL34D9064o3w1Me210Q4QedaKS14ieu10Ymv0lReiDCSCRmrCPwY5MObxHWH4DlvsUapxl8g','2018-02-21 20:22:01','login','logged_out'),(43,2,'HhpkyB74v5N1AUH6MZl64cey64Ee0Gp6gC7o9besB0Sgkd13nPF776vcs8Ejnwc9crI8FBffk90d6XI5uWVm4uKIX1Dg2x3a2xetzX1d9e5ajXZt1ro95F6gae2W7K0Xby2Xa7gbLfS61EIed3fB4b0GEraymegTcad9XZ5bLJYZ70p4fl8f1n1ce79xqjGxZ2YmSEwSAr26wge23uytlOpo08fgyO7wigvFmutN32zbKvtc62C8qffPh0RLqBA','2018-02-21 20:42:15','login','logged_out'),(44,1,'6bj2QeJ0fQAw0FWrUi372g5naV9zeBhL5GuW79s1x7rXDO07d1cTfTbLkxCdNakqSff6kmDsHv52kVycc86X1Gk31eLInUU8xcyWeyeZUT8Ab8aOd6OaffU4c3CH4e3euC1knMISP7LEU7l0uRH4gv70H79S5ZG9qhQfq3rjs0VxL426LzcLE4rdB6Y3YfA96wdj4dCb97kLIWTTO2VkhnO54WUAcS0KdyxuHB26sF90sw5sI45080Q16AoRoz6','2018-02-21 21:43:17','login','valid');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `id_card` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`phone`,`email`,`password`,`role`,`id_card`,`image`) values (1,'chen','0524088000','chen40888@gmail.com','chen','owner',123,'chen.png'),(2,'inbal','0522222222','inbalik@gmail.com','inbal','manager',222,'chen.png'),(3,'david','394948558','david@gmail.com','david','manager',3323,'chen.png'),(4,'moshe2','54454','moshe@moshe.com','moshe','manager',1231234,'note.jpg'),(5,'','111111','ccc@e','jajajaja','manager',2222,'my-passport-photo.jpg'),(6,'ccccc','1212121','aaa@aaa','ssss','sales',1111,'20140401_091501.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
