/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.14-MariaDB : Database - grims
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`username`,`password`,`level`,`profilename`,`gender`,`profileimg`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`lat`,`lng`) values 
(2,'super','1b3231655cebb7a1f783eddf27d254ca',1,'IRONMAN','Male','fileadmin_31082020130633.png','0852 3334 1122','robot@mail.net','USA',NULL,1,'2020-12-28 13:34:44',NULL,NULL,NULL,NULL,NULL,NULL),
(14,'admin','21232f297a57a5a743894a0e4a801fc3',2,'Mr.Cepi','Male','11203014.png','0852 2096 9224','cs@gmail.com','Indonesia',NULL,1,'2020-12-28 13:33:50',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `data_brigif` */

DROP TABLE IF EXISTS `data_brigif`;

CREATE TABLE `data_brigif` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `namadata` varchar(50) DEFAULT NULL,
  `descdata` text DEFAULT NULL,
  `imgdata` varchar(200) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

/*Data for the table `data_brigif` */

insert  into `data_brigif`(`id`,`username`,`password`,`level`,`profilename`,`profileimg`,`gender`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`namadata`,`descdata`,`imgdata`,`lat`,`lng`) values 
(128,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:15:42',14,'2020-12-11 06:22:10','BRIGIF 1','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-1.7492293097718894','119.96548106952483'),
(129,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:14:31',14,'2020-12-10 15:30:26','BRIGIF 2','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'0.518895833899798','113.99926779406825'),
(131,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 19:20:19',14,'2020-12-10 15:30:08','BRIGIF 3','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-8.523104387344718','121.0530720311966'),
(133,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 21:11:52',14,'2020-12-11 06:19:16','BRIGIF 4','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-3.394437170925762','126.58424892198444');

/*Table structure for table `data_konis` */

DROP TABLE IF EXISTS `data_konis`;

CREATE TABLE `data_konis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_kri` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `data` text DEFAULT NULL,
  `kondisi` varchar(15) DEFAULT NULL COMMENT '1=aktif 2=blokir',
  `jml_qty` int(10) DEFAULT NULL,
  `jml_peralatan` int(10) DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `data_konis` */

/*Table structure for table `data_konlog` */

DROP TABLE IF EXISTS `data_konlog`;

CREATE TABLE `data_konlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_kri` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `data` text DEFAULT NULL,
  `kondisi` varchar(15) DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `data_konlog` */

insert  into `data_konlog`(`id`,`id_kri`,`tanggal`,`data`,`kondisi`,`_cid`,`_ctime`,`_uid`,`_utime`) values 
(1,128,'2020-12-24','{\"tgl\":\"2020-12-24 19:42:12\",\"data\":[{\"kondisi\":\"Tidak siap\",\"nama\":\"Minyak\",\"jumlah\":10,\"min\":100,\"ket\":\"oke\"}]}','Siap',128,'2020-12-24 19:42:12',NULL,NULL);

/*Table structure for table `data_kri` */

DROP TABLE IF EXISTS `data_kri`;

CREATE TABLE `data_kri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `namadata` varchar(50) DEFAULT NULL,
  `descdata` text DEFAULT NULL,
  `imgdata` varchar(200) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

/*Data for the table `data_kri` */

insert  into `data_kri`(`id`,`username`,`password`,`level`,`profilename`,`profileimg`,`gender`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`namadata`,`descdata`,`imgdata`,`lat`,`lng`) values 
(128,'USH359','827ccb0eea8a706c4c34a16891f84e7b',3,'USH-359','filekri_09122020101431.jpg','Male','0000 8000 0000','359@mail.com','#',NULL,1,'2020-12-28 14:40:39',14,'2020-12-09 10:15:42',14,'2020-12-09 15:09:09','USH-359','Google seems to be actively working on the font loading issue (described below) and functionality has changed very recently so you may or may not see the Roboto font load.','filekri_09122020211152.jpg','-5.005893238065995','111.79301164548704'),
(129,'SIM367','827ccb0eea8a706c4c34a16891f84e7b',3,'SIM-367','filekri_09122020101431.jpg',NULL,NULL,'367@mail.com',NULL,NULL,1,NULL,14,'2020-12-09 10:14:31',14,'2020-12-09 10:53:39','SIM-367',NULL,'filekri_09122020211152.jpg','-0.972603696782272','107.34942591413224'),
(131,'AHP355','827ccb0eea8a706c4c34a16891f84e7b',3,'AHP-355',NULL,NULL,NULL,'stma@gmail.com',NULL,NULL,1,NULL,14,'2020-12-09 19:20:19',NULL,NULL,'AHP-355',NULL,'filekri_09122020211152.jpg','-4.913020128812676','100.48206584186191'),
(133,'REM331','827ccb0eea8a706c4c34a16891f84e7b',3,'REM-331','fileuser_09122020211152.jpg',NULL,NULL,'220@gmail.com',NULL,NULL,1,NULL,14,'2020-12-09 21:11:52',NULL,NULL,'REM-331','5555555555','filekri_09122020211152.jpg','-6.860264928616977','121.89207077305767');

/*Table structure for table `data_lanal` */

DROP TABLE IF EXISTS `data_lanal`;

CREATE TABLE `data_lanal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `namadata` varchar(50) DEFAULT NULL,
  `descdata` text DEFAULT NULL,
  `imgdata` varchar(200) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

/*Data for the table `data_lanal` */

insert  into `data_lanal`(`id`,`username`,`password`,`level`,`profilename`,`profileimg`,`gender`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`namadata`,`descdata`,`imgdata`,`lat`,`lng`) values 
(128,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:15:42',14,'2020-12-10 19:05:34','LANAL 1','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-6.914744','107.609810'),
(129,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:14:31',14,'2020-12-10 15:30:26','LANAL 2','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-6.581175','106.807275'),
(131,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 19:20:19',14,'2020-12-10 15:30:08','LANAL 3','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-7.5924513738002055','112.45229516097906'),
(133,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 21:11:52',14,'2020-12-11 06:19:16','LANAL 4','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-8.361778928669294','115.40432777123101');

/*Table structure for table `data_lantamal` */

DROP TABLE IF EXISTS `data_lantamal`;

CREATE TABLE `data_lantamal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `namadata` varchar(50) DEFAULT NULL,
  `descdata` text DEFAULT NULL,
  `imgdata` varchar(200) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  `wilayah_kerja` text DEFAULT NULL,
  `luas_wilayah` varchar(100) DEFAULT NULL,
  `batas_wilayah` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

/*Data for the table `data_lantamal` */

insert  into `data_lantamal`(`id`,`username`,`password`,`level`,`profilename`,`profileimg`,`gender`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`namadata`,`descdata`,`imgdata`,`lat`,`lng`,`wilayah_kerja`,`luas_wilayah`,`batas_wilayah`) values 
(128,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:15:42',14,'2020-12-23 20:44:36','LANTAMAL 1','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-6.121435','106.774124','-2.981621,106.823562;-5.041878,102.516922;-9.14024,107.702469;-5.391983,110.69075',NULL,NULL),
(129,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:14:31',14,'2020-12-21 22:18:58','LANTAMAL 2','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'4.695135','96.749397',NULL,NULL,NULL),
(131,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 19:20:19',14,'2020-12-10 15:30:08','LANTAMAL 3','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-2.6063130905031584','106.2499812419408',NULL,NULL,NULL),
(133,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 21:11:52',14,'2020-12-26 17:12:53','LANTAMAL 4','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-2.2514374297713524','111.21288910232444','-1.4473522859592813,111.7178535700199;-3.5107369849644354,109.70735558744248;-5.111959172753594,111.65461445152383;-3.900691328369087,113.40532701845108;-1.3493719941744606,113.29427435562361;-1.4473522859592813,111.7178535700199\r\n','1200 Ha','Barat : Aceh\r\nSelatan : asfasdf\r\nTImur : asf fasdf\r\nUtara : adsfasdf');

/*Table structure for table `data_posal` */

DROP TABLE IF EXISTS `data_posal`;

CREATE TABLE `data_posal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `namadata` varchar(50) DEFAULT NULL,
  `descdata` text DEFAULT NULL,
  `imgdata` varchar(200) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

/*Data for the table `data_posal` */

insert  into `data_posal`(`id`,`username`,`password`,`level`,`profilename`,`profileimg`,`gender`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`namadata`,`descdata`,`imgdata`,`lat`,`lng`) values 
(128,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:15:42',14,'2020-12-11 06:22:10','POSAL 1','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'3.4067783323781793','116.48519035291562'),
(129,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:14:31',14,'2020-12-10 15:30:26','POSAL 2','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'0.7053292585302653','123.60114266685973'),
(131,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 19:20:19',14,'2020-12-10 15:30:08','POSAL 3','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-1.4075452232937053','133.20301715704767'),
(133,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 21:11:52',14,'2020-12-11 06:19:16','POSAL 4','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-4.076609314823709','138.23700960821418');

/*Table structure for table `data_satrad` */

DROP TABLE IF EXISTS `data_satrad`;

CREATE TABLE `data_satrad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `profilename` varchar(30) DEFAULT NULL,
  `profileimg` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Fimale') DEFAULT NULL,
  `wa` varchar(15) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `profileaddress` varchar(300) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sts_aktif` tinyint(4) DEFAULT 1 COMMENT '1=aktif 2=blokir',
  `last_login` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `namadata` varchar(50) DEFAULT NULL,
  `descdata` text DEFAULT NULL,
  `imgdata` varchar(200) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

/*Data for the table `data_satrad` */

insert  into `data_satrad`(`id`,`username`,`password`,`level`,`profilename`,`profileimg`,`gender`,`wa`,`email`,`profileaddress`,`ip`,`sts_aktif`,`last_login`,`_cid`,`_ctime`,`_uid`,`_utime`,`namadata`,`descdata`,`imgdata`,`lat`,`lng`) values 
(128,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:15:42',14,'2020-12-11 06:28:23','SATRAD 1','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-6.121435','106.774124'),
(129,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 10:14:31',14,'2020-12-10 15:30:26','SATRAD 2','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'4.695135','96.749397'),
(131,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 19:20:19',14,'2020-12-10 15:30:08','SATRAD 3','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-2.5315','112.9496'),
(133,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2020-12-09 21:11:52',14,'2020-12-11 06:19:16','SATRAD 4','Pangkalan TNI Angkatan Laut (disingkat Lanal) adalah komando pembinaan dan operasional TNI Angkatan Laut di bawah Lantama',NULL,'-4.466667','135.199997');

/*Table structure for table `main_konfig` */

DROP TABLE IF EXISTS `main_konfig`;

CREATE TABLE `main_konfig` (
  `id_konfig` int(10) unsigned NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `main_konfig` */

insert  into `main_konfig`(`id_konfig`,`nama`,`value`) values 
(1,'Loggo','filea_23122020101903.png'),
(2,'Favicon','fileb_15122020085520.ico'),
(3,'loggo_login','filec_23122020104601.png'),
(4,'loggo_admin','filed_23122020105958.png'),
(5,'Project Date','01/12/2020'),
(6,'Client Name','TNI AL'),
(8,'Product By','#'),
(7,'Aplication Name','GRIMS'),
(9,'Copyright','grims'),
(10,'Record log','2000'),
(11,'Version','DEV 1.0.0'),
(12,'Power',''),
(13,'Title Name','GRIMS'),
(14,'Header Name','GRIMS');

/*Table structure for table `main_level` */

DROP TABLE IF EXISTS `main_level`;

CREATE TABLE `main_level` (
  `id_level` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_level` int(5) DEFAULT NULL,
  `levelname` varchar(25) NOT NULL,
  `direct` text DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `control` text DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_cid` int(11) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `main_level` */

insert  into `main_level`(`id_level`,`code_level`,`levelname`,`direct`,`ket`,`control`,`_ctime`,`_cid`,`_utime`,`_uid`) values 
(1,1,'super','super','kelola keseluruhan',NULL,NULL,NULL,'2020-07-22 22:05:14',2),
(2,2,'admin','maps','admin',NULL,NULL,NULL,'2020-12-16 05:37:55',2),
(3,3,'kri','mapskri','Akses KRI',NULL,'2020-07-19 15:49:23',2,'2020-12-17 13:52:37',2),
(46,4,'lantamal',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(47,5,'lanal',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(48,6,'brigif',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(49,7,'posal',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(50,8,'satrad',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `main_log` */

DROP TABLE IF EXISTS `main_log`;

CREATE TABLE `main_log` (
  `id_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) DEFAULT NULL,
  `nama_user` varchar(56) DEFAULT NULL,
  `table_updated` varchar(25) DEFAULT NULL,
  `aksi` text NOT NULL,
  `tgl` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `main_log` */

insert  into `main_log`(`id_log`,`id_admin`,`nama_user`,`table_updated`,`aksi`,`tgl`) values 
(1,2,'IRONMAN','admin','Login','2020-12-24 15:54:57'),
(2,128,'USH-359','admin','Login','2020-12-24 15:58:14'),
(3,128,'USH-359','admin','Login','2020-12-24 15:59:32'),
(4,128,'USH-359','admin','Login','2020-12-24 19:37:26'),
(5,128,'USH-359','admin','Login','2020-12-25 13:42:42'),
(6,128,'USH-359','admin','Login','2020-12-25 14:28:22'),
(7,14,'Mr.Cepi','admin','Login','2020-12-25 14:46:16'),
(8,14,'Mr.Cepi','admin','Login','2020-12-25 14:54:44'),
(9,128,'USH-359','admin','Login','2020-12-25 15:20:37'),
(10,14,'Mr.Cepi','admin','Login','2020-12-25 15:21:56'),
(11,14,'Mr.Cepi','admin','Login','2020-12-25 16:55:58'),
(12,2,'IRONMAN','admin','Login','2020-12-25 16:59:53'),
(13,14,'Mr.Cepi','admin','Login','2020-12-25 17:14:04'),
(14,128,'USH-359','admin','Login','2020-12-25 18:37:52'),
(15,128,'USH-359','admin','Login','2020-12-25 20:28:06'),
(16,128,'USH-359','admin','Login','2020-12-25 20:40:29'),
(17,14,'Mr.Cepi','admin','Login','2020-12-25 20:42:20'),
(18,14,'Mr.Cepi','admin','Login','2020-12-25 20:47:43'),
(19,14,'Mr.Cepi','admin','Login','2020-12-26 10:00:18'),
(20,14,'Mr.Cepi','admin','Login','2020-12-26 10:11:48'),
(21,14,'Mr.Cepi','admin','Login','2020-12-26 13:08:12'),
(22,14,'Mr.Cepi','admin','Login','2020-12-26 14:54:58'),
(23,14,'Mr.Cepi','admin','Login','2020-12-26 16:50:34'),
(24,128,'USH-359','admin','Login','2020-12-26 17:06:13'),
(25,14,'Mr.Cepi','admin','Login','2020-12-26 17:08:42'),
(26,128,'USH-359','admin','Login','2020-12-26 20:43:42'),
(27,14,'Mr.Cepi','admin','Login','2020-12-26 21:37:44'),
(28,14,'Mr.Cepi','admin','Login','2020-12-28 10:00:13'),
(29,14,'Mr.Cepi','admin','Login','2020-12-28 10:33:41'),
(30,128,'USH-359','admin','Login','2020-12-28 10:43:06'),
(31,14,'Mr.Cepi','admin','Login','2020-12-28 10:49:15'),
(32,128,'USH-359','admin','Login','2020-12-28 13:10:40'),
(33,14,'Mr.Cepi','admin','Login','2020-12-28 13:17:59'),
(34,128,'USH-359','admin','Login','2020-12-28 13:24:26'),
(35,14,'Mr.Cepi','admin','Login','2020-12-28 13:33:50'),
(36,2,'IRONMAN','admin','Login','2020-12-28 13:34:44'),
(37,128,'USH-359','data_kri','Login','2020-12-28 14:40:39');

/*Table structure for table `main_menu` */

DROP TABLE IF EXISTS `main_menu`;

CREATE TABLE `main_menu` (
  `id_menu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) DEFAULT NULL,
  `level` enum('1','2') DEFAULT NULL,
  `id_main` int(11) DEFAULT 0,
  `dropdown` varchar(10) DEFAULT NULL,
  `icon` varchar(25) DEFAULT NULL,
  `hak_akses` int(11) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `target` varchar(10) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_cid` int(10) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  `_uid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `main_menu` */

insert  into `main_menu`(`id_menu`,`nama`,`level`,`id_main`,`dropdown`,`icon`,`hak_akses`,`link`,`target`,`_ctime`,`_cid`,`_utime`,`_uid`) values 
(1,'Dashboard','1',0,'no','fas fa-tachometer-alt',1,'super/dashboard','direct','2019-12-06 17:08:21',2,NULL,NULL),
(2,'User Group','1',0,'no','fas fa-star',1,'super/manajemen','direct','2019-12-06 17:08:54',2,'2019-12-07 11:38:46',2),
(3,'Data user','1',0,'no','fas fa-users',1,'super/data_user','direct','2019-12-06 17:27:07',2,'2019-12-07 20:39:29',2),
(4,'Data Log','1',0,'no','fas fa-key',1,'super/data_log','direct','2019-12-07 11:30:13',2,'2019-12-07 21:01:23',2),
(5,'Config App','1',0,'no','fas fa-cog',1,'super/config_app','direct','2019-12-07 11:31:27',2,'2019-12-07 11:33:48',2),
(25,'Dashboard','1',0,'no','fas fa-tachometer-alt',2,'index','direct','2020-12-08 07:30:24',2,'2020-12-15 10:36:46',2),
(26,'Maps GRIMS','1',0,'no','fas fa-map',2,'maps','newtab','2020-12-08 07:32:32',2,'2020-12-15 11:18:45',2),
(49,'KONLOG','1',0,'no','fas fa-laptop',3,'page_konlog','direct','2020-12-17 23:39:05',2,'2020-12-18 09:04:20',2),
(50,'KONIS','1',0,'no','fas fa-laptop',3,'page_konis','direct','2020-12-17 23:39:24',2,'2020-12-18 09:04:27',2),
(38,'Laporan','1',0,'no','fas fa-chart-bar',2,'page_report','direct','2020-12-09 07:05:31',2,'2020-12-23 08:39:54',2),
(39,'Setting Maps','1',0,'no','fas fa-cog',2,'page_settingmaps','direct','2020-12-09 08:22:15',2,'2020-12-23 08:39:38',2),
(52,'DATA LANTAMAL','2',40,'no','#',2,'page_lantamal','direct','2020-12-22 12:49:34',2,NULL,NULL),
(53,'DATA LANAL','2',40,'no','#',2,'page_lanal','direct','2020-12-22 12:50:19',2,'2020-12-22 12:50:36',2),
(54,'DATA BRIGIF','2',40,'no','#',2,'page_brigif','direct','2020-12-22 12:51:56',2,NULL,NULL),
(40,'Master','1',0,'yes','fas fa-database',2,'master','direct','2020-12-09 08:22:56',2,'2020-12-10 05:29:41',2),
(44,'Icon Marker','2',40,'no','#',2,'mimarker','direct','2020-12-13 14:09:11',2,'2020-12-15 11:08:57',2),
(55,'DATA POSAL','2',40,'no','#',2,'page_posal','direct','2020-12-22 12:53:42',2,NULL,NULL),
(51,'KONPERS','1',0,'no','fas fa-laptop',3,'page_konpers','direct','2020-12-17 23:39:42',2,'2020-12-18 09:04:35',2),
(48,'DATA KRI','2',40,'no','#',2,'page_kri','direct','2020-12-15 10:35:14',2,'2020-12-22 12:48:49',2),
(56,'DATA SATRAD','2',40,'no','#',2,'page_satrad','direct','2020-12-22 12:54:15',2,NULL,NULL);

/*Table structure for table `tm_iconmarker` */

DROP TABLE IF EXISTS `tm_iconmarker`;

CREATE TABLE `tm_iconmarker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(3) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `_cid` int(11) DEFAULT NULL,
  `_ctime` datetime DEFAULT NULL,
  `_uid` int(11) DEFAULT NULL,
  `_utime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `tm_iconmarker` */

insert  into `tm_iconmarker`(`id`,`level`,`nama`,`icon`,`_cid`,`_ctime`,`_uid`,`_utime`) values 
(3,3,'kri','filemarker_13122020205641.png',NULL,NULL,14,'2020-12-13 20:56:41'),
(46,4,'lantamal','filemarker_14122020100834.png',NULL,NULL,14,'2020-12-14 10:08:34'),
(47,5,'lanal','filemarker_14122020101103.png',NULL,NULL,14,'2020-12-14 10:11:03'),
(48,6,'brigif','filemarker_14122020102255.png',NULL,NULL,14,'2020-12-14 10:22:55'),
(49,7,'posal','filemarker_14122020095017.png',NULL,NULL,14,'2020-12-14 09:50:17'),
(50,8,'satrad','filemarker_14122020102017.png',NULL,NULL,14,'2020-12-14 10:20:17');

/*Table structure for table `tm_maps` */

DROP TABLE IF EXISTS `tm_maps`;

CREATE TABLE `tm_maps` (
  `id_konfig` int(10) unsigned NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tm_maps` */

insert  into `tm_maps`(`id_konfig`,`nama`,`value`) values 
(1,'GOOGLE MAPS API KEY','AIzaSyCKjblg5VRhjpV9qZ-EkglAInbkzxid4Nk'),
(2,'CENTER LATITUDE','-0.038302'),
(3,'CENTER LONGITUDE','120.060753');

/*Table structure for table `tracking_kri` */

DROP TABLE IF EXISTS `tracking_kri`;

CREATE TABLE `tracking_kri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idkri` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `latlng` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tracking_kri` */

insert  into `tracking_kri`(`id`,`idkri`,`tanggal`,`latlng`) values 
(1,128,'2020-12-16','{\"2020-12-16 12:27:35\":{\"lat\":\"-4.187608945390835\",\"lng\":\"110.14316333842572\"},\"2020-12-16 13:10:35\":{\"lat\":\"-5.635761104597985\",\"lng\":\"111.0771003217223\"},\"2020-12-16 14:10:35\":{\"lat\":\"-5.1763890154664445\",\"lng\":\"111.91206123251949\"}} '),
(2,128,'2020-12-17','{\"2020-12-17 13:27:35\":{\"lat\":\"-4.997979828379912\",\"lng\":\"113.1534171484051\"}}');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
