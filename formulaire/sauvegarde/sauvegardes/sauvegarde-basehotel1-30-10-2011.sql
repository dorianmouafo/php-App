--
-- Base de donn&eacute;e : `basehotel1`
--


--
-- Structure de la table `acces_bloc`
--

DROP TABLE IF EXISTS `acces_bloc`;
CREATE TABLE `acces_bloc` (
  `CODE_PRIVILEGE` int(11) NOT NULL,
  `CODE_BLOC` int(11) NOT NULL,
  `ACCES_TOTAL_BLOC` char(32) DEFAULT NULL,
  `ACCES_PARTIEL_BLOC` char(32) DEFAULT NULL,
  `PAS_ACCES_BLOC` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_PRIVILEGE`,`CODE_BLOC`),
  KEY `I_FK_ACCES_BLOC_PRIVILEGE` (`CODE_PRIVILEGE`),
  KEY `I_FK_ACCES_BLOC_BLOC` (`CODE_BLOC`),
  CONSTRAINT `acces_bloc_ibfk_1` FOREIGN KEY (`CODE_PRIVILEGE`) REFERENCES `privilege` (`CODE_PRIVILEGE`),
  CONSTRAINT `acces_bloc_ibfk_2` FOREIGN KEY (`CODE_BLOC`) REFERENCES `bloc` (`CODE_BLOC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acces_bloc`
--

--
-- Il n'y a aucun enregistrement dans la table `acces_bloc`
--

--
-- Structure de la table `acces_menu`
--

DROP TABLE IF EXISTS `acces_menu`;
CREATE TABLE `acces_menu` (
  `CODE_MENU` int(11) NOT NULL,
  `CODE_PRIVILEGE` int(11) NOT NULL,
  `ACCES_TOTAL_MENU` char(32) DEFAULT NULL,
  `ACCES_PARTIEL_MENU` char(32) DEFAULT NULL,
  `PAS_ACCES_MENU` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_MENU`,`CODE_PRIVILEGE`),
  KEY `I_FK_ACCES_MENU_MENU` (`CODE_MENU`),
  KEY `I_FK_ACCES_MENU_PRIVILEGE` (`CODE_PRIVILEGE`),
  CONSTRAINT `acces_menu_ibfk_1` FOREIGN KEY (`CODE_MENU`) REFERENCES `menu` (`CODE_MENU`),
  CONSTRAINT `acces_menu_ibfk_2` FOREIGN KEY (`CODE_PRIVILEGE`) REFERENCES `privilege` (`CODE_PRIVILEGE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acces_menu`
--

--
-- Il n'y a aucun enregistrement dans la table `acces_menu`
--

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE `appartient` (
  `CODE_UTILISATEUR` int(11) NOT NULL,
  `CODE_GROUPE` int(11) NOT NULL,
  PRIMARY KEY (`CODE_UTILISATEUR`,`CODE_GROUPE`),
  KEY `I_FK_APPARTIENT_UTILISATEUR` (`CODE_UTILISATEUR`),
  KEY `I_FK_APPARTIENT_GROUPE` (`CODE_GROUPE`),
  CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`CODE_UTILISATEUR`) REFERENCES `utilisateur` (`CODE_UTILISATEUR`),
  CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`CODE_GROUPE`) REFERENCES `groupe` (`CODE_GROUPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appartient`
--

INSERT INTO `appartient` (`CODE_UTILISATEUR`, `CODE_GROUPE`) VALUES ('1','1'),
('2','2'),
('3','2'),
('4','1'),
('5','1'),
('6','1'),
('7','1');

--
-- Structure de la table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
CREATE TABLE `avoir` (
  `CODE_CHAMBRE` int(2) NOT NULL,
  `CODE_ETAT_CHAMBRE` int(2) NOT NULL,
  `DATE_CHANGE_STAT` date NOT NULL,
  PRIMARY KEY (`CODE_CHAMBRE`,`CODE_ETAT_CHAMBRE`),
  KEY `I_FK_AVOIR_CHAMBRE` (`CODE_CHAMBRE`),
  KEY `I_FK_AVOIR_ETAT_CHAMBRE` (`CODE_ETAT_CHAMBRE`),
  CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`CODE_CHAMBRE`) REFERENCES `chambre` (`CODE_CHAMBRE`),
  CONSTRAINT `avoir_ibfk_2` FOREIGN KEY (`CODE_ETAT_CHAMBRE`) REFERENCES `etat_chambre` (`CODE_ETAT_CHAMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avoir`
--

INSERT INTO `avoir` (`CODE_CHAMBRE`, `CODE_ETAT_CHAMBRE`, `DATE_CHANGE_STAT`) VALUES ('1','3','2011-10-17'),
('2','3','2011-10-23'),
('3','3','2011-10-23'),
('4','3','2011-10-23'),
('5','2','2011-09-04'),
('6','3','2011-10-23'),
('7','2','2011-10-30'),
('8','3','2011-10-23'),
('9','3','2011-10-23'),
('10','3','2011-10-23'),
('11','3','2011-10-23'),
('12','3','2011-10-23'),
('13','3','2011-10-23'),
('14','3','2011-10-23'),
('15','3','2011-10-23'),
('16','3','2011-10-23'),
('17','3','2011-10-23'),
('18','3','2011-10-23'),
('19','3','2011-10-23'),
('20','3','2011-10-23'),
('21','3','2011-10-23'),
('22','3','2011-10-23'),
('23','3','2011-10-23'),
('24','3','2011-10-23'),
('28','3','0000-00-00'),
('29','3','2011-12-29');

--
-- Structure de la table `bloc`
--

DROP TABLE IF EXISTS `bloc`;
CREATE TABLE `bloc` (
  `CODE_BLOC` int(11) NOT NULL,
  `TITRE_BLOC` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_BLOC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bloc`
--

--
-- Il n'y a aucun enregistrement dans la table `bloc`
--

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE `chambre` (
  `CODE_CHAMBRE` int(2) NOT NULL AUTO_INCREMENT,
  `CODE_TYPE_CHAMBRE` int(2) NOT NULL,
  `LIBELLE_CHAMBRE` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_CHAMBRE`),
  KEY `I_FK_CHAMBRE_TYPE_CHAMBRE` (`CODE_TYPE_CHAMBRE`),
  CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`CODE_TYPE_CHAMBRE`) REFERENCES `type_chambre` (`CODE_TYPE_CHAMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chambre`
--

INSERT INTO `chambre` (`CODE_CHAMBRE`, `CODE_TYPE_CHAMBRE`, `LIBELLE_CHAMBRE`) VALUES ('1','12','505'),
('2','11','103'),
('3','11','105'),
('4','11','203'),
('5','11','205'),
('6','11','303'),
('7','11','305'),
('8','11','403'),
('9','11','405'),
('10','10','102'),
('11','10','104'),
('12','10','101'),
('13','10','201'),
('14','10','202'),
('15','10','204'),
('16','10','301'),
('17','10','302'),
('18','10','304'),
('19','10','401'),
('20','10','402'),
('21','10','404'),
('22','10','501'),
('23','10','502'),
('24','10','504'),
('25','11','601'),
('28','12','604'),
('29','11','605');

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `ID_CLIENT` int(2) NOT NULL AUTO_INCREMENT,
  `NUMERO_INDENTIFIANT` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `NUMERO_INDENTIFIANT`) VALUES ('5','45'),
('40','457855'),
('41','457855'),
('42','78678'),
('43','12354695'),
('44','78678'),
('45','518765568'),
('46','102354'),
('47','102354'),
('48','45211'),
('49','25968'),
('50','68268'),
('51','68268'),
('52','123011'),
('53','45875'),
('54','58756'),
('55','124'),
('56','6976'),
('57','145212'),
('58','1445212'),
('59','4557'),
('60','454412'),
('61','78554'),
('62','45785'),
('63','45785'),
('64','45221455'),
('65','1544255'),
('66','2544'),
('67','455244'),
('68','87895GFGH'),
('69','5478965223'),
('70','1212'),
('71','1312'),
('72','233'),
('73','12323'),
('74','SDQS12'),
('75','SDQS12'),
('76','106913846'),
('77','124'),
('78','1090'),
('79','006745'),
('80','0045'),
('81','56097'),
('82','46098'),
('83','230909'),
('84','870981'),
('85','645'),
('86','1236340'),
('87','212989'),
('88','90882397'),
('89','1235457'),
('90','00BDG4'),
('91','QOSDE567'),
('92','56RE45R'),
('93','18075'),
('94','456590'),
('95','3438'),
('96','465454'),
('97','24434'),
('98','1234');

--
-- Structure de la table `concerner`
--

DROP TABLE IF EXISTS `concerner`;
CREATE TABLE `concerner` (
  `CODE_TYPE_CHAMBRE` int(2) NOT NULL,
  `ID_RESEVATION` int(2) NOT NULL,
  `DATE_RESERV_CHAM` date DEFAULT NULL,
  `DUREE_RESERV_CHAM` int(2) DEFAULT NULL,
  `ETAT_RESERV_CHAM` char(15) DEFAULT NULL,
  `DATE_CONFIRME` date DEFAULT NULL,
  `DATE_ANNUL` date NOT NULL,
  PRIMARY KEY (`CODE_TYPE_CHAMBRE`,`ID_RESEVATION`),
  KEY `I_FK_CONCERNER_TYPE_CHAMBRE` (`CODE_TYPE_CHAMBRE`),
  KEY `I_FK_CONCERNER_RESERVATION` (`ID_RESEVATION`),
  CONSTRAINT `concerner_ibfk_1` FOREIGN KEY (`CODE_TYPE_CHAMBRE`) REFERENCES `type_chambre` (`CODE_TYPE_CHAMBRE`),
  CONSTRAINT `concerner_ibfk_2` FOREIGN KEY (`ID_RESEVATION`) REFERENCES `reservation` (`ID_RESEVATION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `concerner`
--

INSERT INTO `concerner` (`CODE_TYPE_CHAMBRE`, `ID_RESEVATION`, `DATE_RESERV_CHAM`, `DUREE_RESERV_CHAM`, `ETAT_RESERV_CHAM`, `DATE_CONFIRME`, `DATE_ANNUL`) VALUES ('10','3','2011-11-22','2','non confirm&eac','0000-00-00','0000-00-00'),
('10','4','2011-11-13','3','non confirmee','0000-00-00','0000-00-00'),
('11','1','2011-10-22','2','annullee','2011-10-31','2011-10-31'),
('11','2','2011-10-25','10','confirm&eacute;','2011-10-22','0000-00-00'),
('11','5','2011-11-17','30','non confirmee','0000-00-00','0000-00-00'),
('11','10','2011-12-27','10','non confirmee','0000-00-00','0000-00-00'),
('12','6','2011-12-06','90','confirmee','2011-10-22','0000-00-00'),
('12','11','2011-10-31','14','confirmee','2011-11-02','0000-00-00'),
('12','12','2011-10-31','12','confirmee','2011-10-10','0000-00-00');

--
-- Structure de la table `consigne`
--

DROP TABLE IF EXISTS `consigne`;
CREATE TABLE `consigne` (
  `ID_CONSIGNE` int(10) NOT NULL AUTO_INCREMENT,
  `ID_PERSONNE` int(2) NOT NULL,
  `NATURE_OBJET` char(32) NOT NULL,
  `NOMBRE_OBJET` int(2) NOT NULL,
  `DATE_DEPOT` date NOT NULL,
  `DATE_RETRAIT` date DEFAULT NULL,
  `OBSERVATION_OBJET` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_CONSIGNE`),
  KEY `I_FK_CONSIGNE_PERSONNE_PHYSIQUE` (`ID_PERSONNE`),
  CONSTRAINT `consigne_ibfk_1` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne_physique` (`ID_PERSONNE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consigne`
--

INSERT INTO `consigne` (`ID_CONSIGNE`, `ID_PERSONNE`, `NATURE_OBJET`, `NOMBRE_OBJET`, `DATE_DEPOT`, `DATE_RETRAIT`, `OBSERVATION_OBJET`) VALUES ('1','6','Cles','1','2011-11-11','2011-11-12','RAS');

--
-- Structure de la table `consommation`
--

DROP TABLE IF EXISTS `consommation`;
CREATE TABLE `consommation` (
  `ID` int(20) NOT NULL,
  `CODE_SERVICE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `QUANTITE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PRIX_UNITAIRE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `TOTAL` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `consommation`
--

INSERT INTO `consommation` (`ID`, `CODE_SERVICE`, `QUANTITE`, `PRIX_UNITAIRE`, `TOTAL`, `DATE`) VALUES ('76','3','1','1500','1500','2011-10-20'),
('76','15','2','3000','6000','2011-10-20'),
('86','6','2','2000','4000','2011-10-17'),
('86','7','1','1000','1000','2011-10-03'),
('86','8','2','2000','4000','2011-11-08'),
('86','9','1','3000','3000','2011-10-10'),
('86','10','1','3000','3000','2011-10-24'),
('86','5','1','20000','20000','2011-08-23'),
('86','15','3','3000','9000','2011-12-27'),
('86','17','3','500','1500','2011-07-03'),
('86','11','13','3000','39000','2011-11-29'),
('86','12','2','3000','6000','2011-11-15'),
('86','12','2','3000','6000','2011-11-15'),
('86','2','23','700','16100','2011-10-24'),
('86','9','12','3000','36000','2011-11-19'),
('86','14','3','3000','9000','2011-10-04'),
('86','5','10','20000','200000','2011-10-11'),
('86','9','2','3000','6000','2011-10-28'),
('86','16','23','3000','69000','2011-10-29'),
('86','1','12','1000','12000','2011-12-06'),
('86','10','2','3000','6000','2011-10-05'),
('87','3','9','1500','13500','2011-11-15'),
('87','4','9','1000','9000','2011-10-24'),
('87','5','4','20000','80000','2012-01-10'),
('87','3','8','1500','12000','2011-10-24'),
('87','4','6','1000','6000','2011-10-04'),
('87','10','1','3000','3000','2011-11-14'),
('87','12','3','3000','9000','2011-09-04'),
('87','15','3','3000','9000','2011-10-12'),
('76','8','7','2000','14000','2011-11-16'),
('87','14','1','3000','3000','2011-08-08'),
('87','6','4','2000','8000','2011-10-17'),
('87','7','4','1000','4000','2011-10-10'),
('87','1','6','1000','6000','2011-10-03'),
('87','1','5','1000','5000','2011-09-12'),
('87','18','1','1000','1000','2011-10-11'),
('87','17','3','500','1500','2011-10-10'),
('88','4','2','1000','2000','2011-10-24'),
('86','10','2','3000','6000','2011-10-22'),
('86','1','10','1000','10000','2011-10-19'),
('92','10','10','3000','30000','2011-10-25'),
('92','10','27','3000','81000','2011-11-29'),
('95','15','2','3000','6000','2011-11-08'),
('95','4','8','1000','8000','2011-11-13'),
('95','7','3','1000','3000','2011-11-16');

--
-- Structure de la table `dependre`
--

DROP TABLE IF EXISTS `dependre`;
CREATE TABLE `dependre` (
  `CODE_SERVICE` int(2) NOT NULL,
  `CODE_TARIFICATION` int(2) NOT NULL,
  `MONTANT_TARIF_SERV` char(32) NOT NULL,
  `DATE_DEBUT_TARIF_SERV` date NOT NULL,
  `DATE_FIN_TARIF_SERV` date NOT NULL,
  PRIMARY KEY (`CODE_SERVICE`,`CODE_TARIFICATION`),
  KEY `I_FK_DEPENDRE_SERVICE` (`CODE_SERVICE`),
  KEY `I_FK_DEPENDRE_TARIFICATION` (`CODE_TARIFICATION`),
  CONSTRAINT `dependre_ibfk_1` FOREIGN KEY (`CODE_SERVICE`) REFERENCES `service` (`CODE_SERVICE`),
  CONSTRAINT `dependre_ibfk_2` FOREIGN KEY (`CODE_TARIFICATION`) REFERENCES `tarification` (`CODE_TARIFICATION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dependre`
--

INSERT INTO `dependre` (`CODE_SERVICE`, `CODE_TARIFICATION`, `MONTANT_TARIF_SERV`, `DATE_DEBUT_TARIF_SERV`, `DATE_FIN_TARIF_SERV`) VALUES ('1','4','1000','2011-10-20','2011-12-31'),
('2','5','700','2011-10-20','2011-12-31'),
('3','6','1500','2011-10-20','2011-12-31'),
('4','7','1000','2011-10-20','2011-10-20'),
('5','8','20000','2011-10-20','2011-12-31'),
('6','9','2000','2011-10-20','2011-12-31'),
('7','10','1000','2011-10-20','2011-12-31'),
('8','11','2000','2011-10-20','2011-12-31'),
('9','12','3000','2011-10-20','2011-12-31'),
('10','13','3000','2011-10-20','2011-12-31'),
('11','14','3000','2011-10-20','2011-12-31'),
('12','15','3000','2011-10-20','2011-12-31'),
('13','16','3000','2011-10-20','2011-12-31'),
('14','17','3000','2011-10-20','2011-12-31'),
('15','18','3000','2011-10-20','2011-12-31'),
('16','19','3000','2011-10-20','2011-12-31'),
('17','20','500','2011-10-20','2011-12-31'),
('18','21','1000','2011-10-20','2011-12-31');

--
-- Structure de la table `engendrer`
--

DROP TABLE IF EXISTS `engendrer`;
CREATE TABLE `engendrer` (
  `NUMERO_FACTURE` int(2) NOT NULL,
  `CODE_CHAMBRE` int(2) NOT NULL,
  `MONTTANT` varchar(100) NOT NULL,
  `DATE` date NOT NULL,
  PRIMARY KEY (`NUMERO_FACTURE`,`CODE_CHAMBRE`),
  KEY `I_FK_ENGENDRER_FACTURE` (`NUMERO_FACTURE`),
  KEY `I_FK_ENGENDRER_CHAMBRE` (`CODE_CHAMBRE`),
  CONSTRAINT `engendrer_ibfk_1` FOREIGN KEY (`NUMERO_FACTURE`) REFERENCES `facture` (`NUMERO_FACTURE`),
  CONSTRAINT `engendrer_ibfk_2` FOREIGN KEY (`CODE_CHAMBRE`) REFERENCES `chambre` (`CODE_CHAMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `engendrer`
--

INSERT INTO `engendrer` (`NUMERO_FACTURE`, `CODE_CHAMBRE`, `MONTTANT`, `DATE`) VALUES ('1','15','50000','2011-10-20'),
('2','2','1280000','2011-10-23'),
('3','29','1060000','2011-10-26'),
('4','2','1280000','2011-10-26'),
('6','29','1060000','2011-10-26');

--
-- Structure de la table `etat_chambre`
--

DROP TABLE IF EXISTS `etat_chambre`;
CREATE TABLE `etat_chambre` (
  `CODE_ETAT_CHAMBRE` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLE_ETAT_CHAMBRE` char(32) NOT NULL,
  `OBSERVATION_ETAT_CHAMBRE` char(100) NOT NULL,
  PRIMARY KEY (`CODE_ETAT_CHAMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat_chambre`
--

INSERT INTO `etat_chambre` (`CODE_ETAT_CHAMBRE`, `LIBELLE_ETAT_CHAMBRE`, `OBSERVATION_ETAT_CHAMBRE`) VALUES ('1','HORS SERVICE',''),
('2','OCCUPEE',''),
('3','LIBRE',''),
('4','NON FAITE',''),
('5','RECOUCHE',''),
('6','RECOUCHER NON FAITE',''),
('7','VIDE','PERSONNE NE PEUT ENTRER POUR LE'),
('8','STAND','STAND BY ME AND PARLEMENT VERIDIQUE DES ELUS DES DEPUTES');

--
-- Structure de la table `etat_reservation_periode`
--

DROP TABLE IF EXISTS `etat_reservation_periode`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `etat_reservation_periode` AS select `concerner`.`CODE_TYPE_CHAMBRE` AS `TITRE`,`concerner`.`ID_RESEVATION` AS `RESERVANT`,`concerner`.`DUREE_RESERV_CHAM` AS `DUREE`,`concerner`.`ETAT_RESERV_CHAM` AS `ETAT` from `concerner` where (`concerner`.`DATE_RESERV_CHAM` between '2011-10-22' and '2011-11_17') union select `sappliquer`.`CODE_SERVICE` AS `TITRE`,`sappliquer`.`ID_RESEVATION` AS `RESERVANT`,`sappliquer`.`DUREE_RESERV_SERV` AS `DUREE`,`sappliquer`.`ETAT_RESERV_SERV` AS `ETAT` from `sappliquer` where (`sappliquer`.`DATE_RESERV_SERV` between ((2011 - 10) - 11) and ((2011 - 11) - 7));

--
-- Contenu de la table `etat_reservation_periode`
--

INSERT INTO `etat_reservation_periode` (`TITRE`, `RESERVANT`, `DUREE`, `ETAT`) VALUES ('10','4','3','non confirmee'),
('11','1','2','annullee'),
('11','2','10','confirm&eacute;'),
('11','5','30','non confirmee'),
('12','11','14','confirmee'),
('12','12','12','confirmee');

--
-- Structure de la table `etat_service`
--

DROP TABLE IF EXISTS `etat_service`;
CREATE TABLE `etat_service` (
  `ID_ETAT_SERVICE` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLE` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_ETAT_SERVICE`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat_service`
--

INSERT INTO `etat_service` (`ID_ETAT_SERVICE`, `LIBELLE`) VALUES ('1','HORS SERVICE'),
('2','OCCUPEE'),
('3','LIBRE'),
('4','NON FAITE'),
('5','RECOUCHE'),
('6','RESERVE');

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE `facture` (
  `NUMERO_FACTURE` int(2) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(2) NOT NULL,
  `DATE_FACTURE` datetime DEFAULT NULL,
  PRIMARY KEY (`NUMERO_FACTURE`),
  KEY `I_FK_FACTURE_CLIENT` (`ID_CLIENT`),
  CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`NUMERO_FACTURE`, `ID_CLIENT`, `DATE_FACTURE`) VALUES ('1','76','2011-10-20 14:45:38'),
('2','87','2011-10-23 08:26:30'),
('3','95','2011-10-26 05:01:26'),
('4','87','2011-10-26 05:02:16'),
('6','95','2011-10-26 05:05:33');

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE `groupe` (
  `CODE_GROUPE` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_PRIVILEGE` int(11) NOT NULL,
  `LIBELLE_GROUPE` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_GROUPE`),
  KEY `I_FK_GROUPE_PRIVILEGE` (`CODE_PRIVILEGE`),
  CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`CODE_PRIVILEGE`) REFERENCES `privilege` (`CODE_PRIVILEGE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`CODE_GROUPE`, `CODE_PRIVILEGE`, `LIBELLE_GROUPE`) VALUES ('1','2','Administrateur'),
('2','1','Utilisateur simple');

--
-- Structure de la table `loger`
--

DROP TABLE IF EXISTS `loger`;
CREATE TABLE `loger` (
  `CODE_CHAMBRE` int(2) NOT NULL,
  `ID_PERSONNE_CHARGE` int(2) NOT NULL,
  `DATE_ENTREE` date DEFAULT NULL,
  `HEURE_ENTREE` time DEFAULT NULL,
  `DATE_SORTIE` date DEFAULT NULL,
  `HEURE_SORTIE` time DEFAULT NULL,
  `DUREE_OCCUPATION` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_CHAMBRE`,`ID_PERSONNE_CHARGE`),
  KEY `I_FK_LOGER_CHAMBRE` (`CODE_CHAMBRE`),
  KEY `I_FK_LOGER_PERSONNE_A_CHARGE` (`ID_PERSONNE_CHARGE`),
  CONSTRAINT `loger_ibfk_1` FOREIGN KEY (`CODE_CHAMBRE`) REFERENCES `chambre` (`CODE_CHAMBRE`),
  CONSTRAINT `loger_ibfk_2` FOREIGN KEY (`ID_PERSONNE_CHARGE`) REFERENCES `personne_a_charge` (`ID_PERSONNE_CHARGE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `loger`
--

--
-- Il n'y a aucun enregistrement dans la table `loger`
--

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `CODE_MENU` int(11) NOT NULL,
  `TITRE_MENU` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_MENU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `menu`
--

--
-- Il n'y a aucun enregistrement dans la table `menu`
--

--
-- Structure de la table `mouchard`
--

DROP TABLE IF EXISTS `mouchard`;
CREATE TABLE `mouchard` (
  `code_user` int(30) NOT NULL,
  `date_operation` date NOT NULL,
  `heure_operation` time NOT NULL,
  `operation_effectuee` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `mouchard`
--

INSERT INTO `mouchard` (`code_user`, `date_operation`, `heure_operation`, `operation_effectuee`) VALUES ('3','2011-10-30','20:19:05','Connexion a FS'),
('3','2011-10-30','20:20:20','Connexion a FS'),
('3','2011-10-30','20:21:25','a Imprimer une fiche client'),
('3','2011-10-30','20:25:04','Occuper un client'),
('3','2011-10-30','20:31:32','Deconnexion a FS'),
('3','2011-10-30','20:31:53','Connexion a FS'),
('3','2011-10-30','20:32:06','Deconnexion a FS'),
('7','2011-10-30','20:32:12','Connexion a FS');

--
-- Structure de la table `occuper`
--

DROP TABLE IF EXISTS `occuper`;
CREATE TABLE `occuper` (
  `CODE_CHAMBRE` int(2) NOT NULL,
  `ID_PERSONNE` int(2) NOT NULL,
  `DATE_ENTREE` date DEFAULT NULL,
  `HEURE_ENTREE` time DEFAULT NULL,
  `DATE_SORTIE` date DEFAULT NULL,
  `HEURE_SORTIE` time DEFAULT NULL,
  `DUREE_OCCUPATION` char(32) DEFAULT NULL,
  `PARRAIN_ID` int(44) NOT NULL,
  PRIMARY KEY (`CODE_CHAMBRE`,`ID_PERSONNE`),
  KEY `I_FK_OCCUPER_CHAMBRE` (`CODE_CHAMBRE`),
  KEY `I_FK_OCCUPER_PERSONNE_PHYSIQUE` (`ID_PERSONNE`),
  CONSTRAINT `occuper_ibfk_1` FOREIGN KEY (`CODE_CHAMBRE`) REFERENCES `chambre` (`CODE_CHAMBRE`),
  CONSTRAINT `occuper_ibfk_2` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne_physique` (`ID_PERSONNE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `occuper`
--

INSERT INTO `occuper` (`CODE_CHAMBRE`, `ID_PERSONNE`, `DATE_ENTREE`, `HEURE_ENTREE`, `DATE_SORTIE`, `HEURE_SORTIE`, `DUREE_OCCUPATION`, `PARRAIN_ID`) VALUES ('1','2','2011-10-23','14:34:07','2011-10-17','10:40:00','-5','0'),
('2','3','2011-12-27','18:34:23','2012-02-28','14:00:00','64','0'),
('5','4','2011-09-04','09:34:23','0000-00-00','00:00:00','-15220','0'),
('7','2','2011-10-30','15:14:15','0000-00-00','00:00:00','-15276','0'),
('15','1','2011-10-20','12:00:00','2011-10-31','14:01:02','12.041666666667','0'),
('29','5','2011-10-24','06:12:34','2011-10-27','09:00:00','4','0'),
('29','6','2011-11-07','12:34:23','2011-12-29','16:00:00','53','0');

--
-- Structure de la table `personne_a_charge`
--

DROP TABLE IF EXISTS `personne_a_charge`;
CREATE TABLE `personne_a_charge` (
  `ID_PERSONNE_CHARGE` int(2) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(2) NOT NULL,
  `NUM_ACHARGE` char(32) DEFAULT NULL,
  `TYPE_IDENTITE_CLIENT` char(32) DEFAULT NULL,
  `DELIVRE_LE` datetime DEFAULT NULL,
  `LIEU_DELIVRANCE` char(32) DEFAULT NULL,
  `NOM_CLIENT` char(32) DEFAULT NULL,
  `PRENOM_CLIENT` char(32) DEFAULT NULL,
  `DATE_NAISSANCE_CLIENT` datetime DEFAULT NULL,
  `VILLE_NAISSANCE_CLIENT` char(32) DEFAULT NULL,
  `PAYS_NAISSANCE_CLIENT` char(32) DEFAULT NULL,
  `NATIONALITE_CLIENT` char(32) DEFAULT NULL,
  `PAYS_RESIDENCE_CLIENT` char(32) DEFAULT NULL,
  `VILLE_RESIDENCE_CLIENT` char(32) DEFAULT NULL,
  `ADRESSE_PRIVEE_CLIENT` char(32) DEFAULT NULL,
  `TELEPHONE_CLIENT` int(2) DEFAULT NULL,
  `EMAIL_CLIENT` char(32) DEFAULT NULL,
  `PROFESSION_CLIENT` char(32) DEFAULT NULL,
  `SOCIETE_CLIENT` char(32) DEFAULT NULL,
  `ADRESSE_SOCIETE_TRA_CLIENT` char(32) DEFAULT NULL,
  `TELEPHONE_SOCIETE_TRA_CLIENT` int(2) DEFAULT NULL,
  `FAX_SOCIETE_TRA_CLIENT` char(32) DEFAULT NULL,
  `EMAIL_SOCIETE` char(32) DEFAULT NULL,
  `VENANT_DE` char(32) DEFAULT NULL,
  `SE_RENDANT_A` char(32) DEFAULT NULL,
  `SEX` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONNE_CHARGE`),
  KEY `I_FK_PERSONNE_A_CHARGE_CLIENT` (`ID_CLIENT`),
  CONSTRAINT `personne_a_charge_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personne_a_charge`
--

--
-- Il n'y a aucun enregistrement dans la table `personne_a_charge`
--

--
-- Structure de la table `personne_morale`
--

DROP TABLE IF EXISTS `personne_morale`;
CREATE TABLE `personne_morale` (
  `ID_CLIENT` int(2) NOT NULL,
  `NUMERO_INDENTIFIANT` varchar(100) NOT NULL,
  `TYPE_NUMERO_INDENTIFIANT` char(100) NOT NULL,
  `RAISON_SOCIALE` char(200) DEFAULT NULL,
  `ADRESSE_MORALE` char(200) DEFAULT NULL,
  `TELEPHONE_MORALE` int(2) DEFAULT NULL,
  `FAX_MORALE` char(100) DEFAULT NULL,
  `VILLE_MORALE` char(200) DEFAULT NULL,
  `PAYS_MORALE` char(200) DEFAULT NULL,
  `EMAIL_MORALE` char(200) DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENT`),
  CONSTRAINT `personne_morale_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personne_morale`
--

INSERT INTO `personne_morale` (`ID_CLIENT`, `NUMERO_INDENTIFIANT`, `TYPE_NUMERO_INDENTIFIANT`, `RAISON_SOCIALE`, `ADRESSE_MORALE`, `TELEPHONE_MORALE`, `FAX_MORALE`, `VILLE_MORALE`, `PAYS_MORALE`, `EMAIL_MORALE`) VALUES ('89','1235457','Numero correspondance','Fire software','Chapel Nsimeon II','223456','0023423','Yaounde','Cameroun','firesoftwareonline@yahoo.fr'),
('90','00BDG4','carte contribuable','NIKI Centre','Dans toute l entendue du territo','22564543','0000022223334','Sur toute l\'entendu du teritoire','Cameroun','niki_centrale@yahoo.fr'),
('91','QOSDE567','ras','FOKOU','Societe centrale yaounde douala bafoussam','9878678','00989877','Sur toute l\'entendu du teritoire','Cameroun','fokou_societe@yahoo.cm');

--
-- Structure de la table `personne_physique`
--

DROP TABLE IF EXISTS `personne_physique`;
CREATE TABLE `personne_physique` (
  `ID_PERSONNE` int(2) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(2) NOT NULL,
  `NUMERO_INDENTIFIANT` varchar(50) NOT NULL,
  `TYPE_IDENTITE_CLIENT` char(32) DEFAULT NULL,
  `DELIVRE_LE` date DEFAULT NULL,
  `LIEU_DELIVRANCE` char(32) DEFAULT NULL,
  `NOM_CLIENT` char(100) DEFAULT NULL,
  `PRENOM_CLIENT` char(100) DEFAULT NULL,
  `DATE_NAISSANCE_CLIENT` date DEFAULT NULL,
  `VILLE_NAISSANCE_CLIENT` char(32) DEFAULT NULL,
  `PAYS_NAISSANCE_CLIENT` char(32) DEFAULT NULL,
  `NATIONALITE_CLIENT` char(32) DEFAULT NULL,
  `PAYS_RESIDENCE_CLIENT` char(32) DEFAULT NULL,
  `VILLE_RESIDENCE_CLIENT` char(32) DEFAULT NULL,
  `ADRESSE_PRIVEE_CLIENT` char(32) DEFAULT NULL,
  `TELEPHONE_CLIENT` int(2) DEFAULT NULL,
  `EMAIL_CLIENT` char(32) DEFAULT NULL,
  `PROFESSION_CLIENT` char(32) DEFAULT NULL,
  `SOCIETE_CLIENT` char(32) DEFAULT NULL,
  `ADRESSE_SOCIETE_TRA_CLIENT` char(32) DEFAULT NULL,
  `TELEPHONE_SOCIETE_TRA_CLIENT` int(2) DEFAULT NULL,
  `FAX_SOCIETE_TRA_CLIENT` char(32) DEFAULT NULL,
  `EMAIL_SOCIETE` char(32) DEFAULT NULL,
  `VENANT_DE` char(32) DEFAULT NULL,
  `SE_RENDANT_A` char(32) DEFAULT NULL,
  `SEX` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONNE`),
  KEY `I_FK_PERSONNE_PHYSIQUE_CLIENT` (`ID_CLIENT`),
  CONSTRAINT `personne_physique_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personne_physique`
--

INSERT INTO `personne_physique` (`ID_PERSONNE`, `ID_CLIENT`, `NUMERO_INDENTIFIANT`, `TYPE_IDENTITE_CLIENT`, `DELIVRE_LE`, `LIEU_DELIVRANCE`, `NOM_CLIENT`, `PRENOM_CLIENT`, `DATE_NAISSANCE_CLIENT`, `VILLE_NAISSANCE_CLIENT`, `PAYS_NAISSANCE_CLIENT`, `NATIONALITE_CLIENT`, `PAYS_RESIDENCE_CLIENT`, `VILLE_RESIDENCE_CLIENT`, `ADRESSE_PRIVEE_CLIENT`, `TELEPHONE_CLIENT`, `EMAIL_CLIENT`, `PROFESSION_CLIENT`, `SOCIETE_CLIENT`, `ADRESSE_SOCIETE_TRA_CLIENT`, `TELEPHONE_SOCIETE_TRA_CLIENT`, `FAX_SOCIETE_TRA_CLIENT`, `EMAIL_SOCIETE`, `VENANT_DE`, `SE_RENDANT_A`, `SEX`) VALUES ('1','76','106913846','CNI','2006-02-13','Bertoua','BIELE','Francis','1983-07-18','Bertoua','Cam','Camerounaise','Cam','Yde','','75317985','','Comptable','Hotel Nguela','Bp 8919','22175710','','','Douala','Yaounde','masculin'),
('2','86','1236340','Passport','2011-10-16','Nkolandom','MBIA BI MVONDO','Paul','1955-10-04','MVONMECA','Cameroun','Camerounaise','Cameroun','Yaoundé','Palais de l\'unité','2233467','Mbiapalu@yahoo.fr','President de la republique','Palais de l\'unite','Etoudi','2276456','00454545','Etoudigrand@cameroun.cm','Marseille','Toulouse','masculin'),
('3','87','212989','Passport','2011-10-17','labas','E\'TOO','Samuel','1983-10-12','Douala','Cameroun','Camerounaise','Russie','Moscou','Moscou foot','2147483647','','Footbaleur','Foot revolution','','0','','','Los angeles','New york','masculin'),
('4','88','90882397','Carte nationale','2011-10-03','Youandé','Monsieur yamsi','Christian','2011-10-09','Bafoussam','Cameroun','Camerounaise','Cameroun','Yaoundé','Fs software','22564356','fs@yahoo.fr','INGENIEUR INFORMATIQUE','DG fire software','firesoftware fs elearning','3456532','00000','','Garoua','Mfoubot','feminin'),
('5','92','56RE45R','carte bancaire','2011-10-02','yaoude','TCHINDA MOUAFO','Dorian Francis','2011-10-03','libreville','Gabon','Americaine','Cameroun','Yaounde','Mendong Maeture','99320005','mouafodor2000@yahoo.fr','Developpeur web','Maison lit','Moi meme meme','22703468','','','France','Allemagne','masculin'),
('6','95','3438','Passport','2011-10-04','Los angeles','TAKAM','Patout','1986-10-22','','Gabon','Camerounaise','Etat Unis','New york','BP 1232','16564564','takou@yahoo.fr','INGENIEUR INFORMATIQUE','Microsoft Fondation','BP 00165454','565447','001654566','msfondantion@Gmail.com','Canada','Maroua','masculin');

--
-- Structure de la table `possede_1`
--

DROP TABLE IF EXISTS `possede_1`;
CREATE TABLE `possede_1` (
  `CODE_SERVICE` int(2) NOT NULL,
  `ID_ETAT_SERVICE` int(2) NOT NULL,
  `DATE_CHANGEMENT_ETAT` date DEFAULT NULL,
  PRIMARY KEY (`CODE_SERVICE`,`ID_ETAT_SERVICE`),
  KEY `I_FK_POSSEDE_1_SERVICE` (`CODE_SERVICE`),
  KEY `I_FK_POSSEDE_1_ETAT_SERVICE` (`ID_ETAT_SERVICE`),
  CONSTRAINT `possede_1_ibfk_1` FOREIGN KEY (`CODE_SERVICE`) REFERENCES `service` (`CODE_SERVICE`),
  CONSTRAINT `possede_1_ibfk_2` FOREIGN KEY (`ID_ETAT_SERVICE`) REFERENCES `etat_service` (`ID_ETAT_SERVICE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `possede_1`
--

--
-- Il n'y a aucun enregistrement dans la table `possede_1`
--

--
-- Structure de la table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE `privilege` (
  `CODE_PRIVILEGE` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE_PRIVILEGE` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_PRIVILEGE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `privilege`
--

INSERT INTO `privilege` (`CODE_PRIVILEGE`, `TITRE_PRIVILEGE`) VALUES ('1','total'),
('2','limite');

--
-- Structure de la table `produire`
--

DROP TABLE IF EXISTS `produire`;
CREATE TABLE `produire` (
  `NUMERO_FACTURE` int(2) NOT NULL,
  `CODE_SERVICE` int(2) NOT NULL,
  PRIMARY KEY (`NUMERO_FACTURE`,`CODE_SERVICE`),
  KEY `I_FK_PRODUIRE_FACTURE` (`NUMERO_FACTURE`),
  KEY `I_FK_PRODUIRE_SERVICE` (`CODE_SERVICE`),
  CONSTRAINT `produire_ibfk_1` FOREIGN KEY (`NUMERO_FACTURE`) REFERENCES `facture` (`NUMERO_FACTURE`),
  CONSTRAINT `produire_ibfk_2` FOREIGN KEY (`CODE_SERVICE`) REFERENCES `service` (`CODE_SERVICE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produire`
--

--
-- Il n'y a aucun enregistrement dans la table `produire`
--

--
-- Structure de la table `recevoir`
--

DROP TABLE IF EXISTS `recevoir`;
CREATE TABLE `recevoir` (
  `ID_PERSONNE` int(2) NOT NULL,
  `ID_VISITEUR` int(2) NOT NULL,
  `DATE_ENTREE_VISITEUR` date NOT NULL,
  `HEURE_ENTREE_VISITEUR` time NOT NULL,
  `DATE_SORTIE_VISITEUR` date NOT NULL,
  `HEURE_SORTIE_VISITEUR` time NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`ID_VISITEUR`),
  KEY `I_FK_RECEVOIR_PERSONNE_PHYSIQUE` (`ID_PERSONNE`),
  KEY `I_FK_RECEVOIR_VISITEUR` (`ID_VISITEUR`),
  CONSTRAINT `recevoir_ibfk_1` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne_physique` (`ID_PERSONNE`),
  CONSTRAINT `recevoir_ibfk_2` FOREIGN KEY (`ID_VISITEUR`) REFERENCES `visiteur` (`ID_VISITEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `recevoir`
--

INSERT INTO `recevoir` (`ID_PERSONNE`, `ID_VISITEUR`, `DATE_ENTREE_VISITEUR`, `HEURE_ENTREE_VISITEUR`, `DATE_SORTIE_VISITEUR`, `HEURE_SORTIE_VISITEUR`) VALUES ('6','1','2011-11-10','12:04:12','2011-11-10','15:00:00');

--
-- Structure de la table `reglement`
--

DROP TABLE IF EXISTS `reglement`;
CREATE TABLE `reglement` (
  `ID_REGLEMENT` int(2) NOT NULL AUTO_INCREMENT,
  `CODE_TYPE_REGLEMENT` int(2) NOT NULL,
  `NUMERO_FACTURE` int(2) NOT NULL,
  `DATE_REGLEMENT` datetime DEFAULT NULL,
  `MONTANT_REGELEMENT` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_REGLEMENT`),
  KEY `I_FK_REGLEMENT_TYPE_REGLEMENT` (`CODE_TYPE_REGLEMENT`),
  KEY `I_FK_REGLEMENT_FACTURE` (`NUMERO_FACTURE`),
  CONSTRAINT `reglement_ibfk_1` FOREIGN KEY (`CODE_TYPE_REGLEMENT`) REFERENCES `type_reglement` (`CODE_TYPE_REGLEMENT`),
  CONSTRAINT `reglement_ibfk_2` FOREIGN KEY (`NUMERO_FACTURE`) REFERENCES `facture` (`NUMERO_FACTURE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reglement`
--

INSERT INTO `reglement` (`ID_REGLEMENT`, `CODE_TYPE_REGLEMENT`, `NUMERO_FACTURE`, `DATE_REGLEMENT`, `MONTANT_REGELEMENT`) VALUES ('1','2','1','2011-10-20 14:45:38','40000'),
('2','1','2','2011-10-23 08:26:30','1280000'),
('3','2','3','2011-10-26 05:01:26','954000');

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `ID_RESEVATION` int(2) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(2) NOT NULL,
  `NUMERO_INDENTIFIANT` varchar(100) NOT NULL,
  `NOM` char(200) DEFAULT NULL,
  `TITRE_RESERVATION` char(200) DEFAULT NULL,
  `ETAT_RESERVATION` char(32) DEFAULT NULL,
  `OBSERVATION_RESERVATION` char(200) DEFAULT NULL,
  `DATE_RESERVATION_CLIENT` date DEFAULT NULL,
  `DUREE_RESERVATION_CLIENT` char(32) DEFAULT NULL,
  `DATE_ARRIVE` date DEFAULT NULL,
  `AUTEUR_RESERVATION` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_RESEVATION`),
  KEY `I_FK_RESERVATION_CLIENT` (`ID_CLIENT`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`ID_RESEVATION`, `ID_CLIENT`, `NUMERO_INDENTIFIANT`, `NOM`, `TITRE_RESERVATION`, `ETAT_RESERVATION`, `OBSERVATION_RESERVATION`, `DATE_RESERVATION_CLIENT`, `DUREE_RESERVATION_CLIENT`, `DATE_ARRIVE`, `AUTEUR_RESERVATION`) VALUES ('1','77','124','Moussa','11','non confirm&eacute;e','','2011-10-20','2','2011-10-22','dorian'),
('2','78','1090','Francois jean de parle G','11','confirm&eacute;e','RAS','2011-10-22','10','2011-10-25','dorian'),
('3','79','006745','Madame Mouafo Odette','10','non confirm&eacute;e','RAS','2011-10-22','2','2011-11-22','dorian'),
('4','80','0045','Monsieur Takougne Mouafo Andy','','non confim&eacute;e','une television avec des jeux vid','2011-10-22','','0000-00-00','dorian'),
('5','81','56097','Monsieur Kamgang ulrich','11','non confirmee','RAS','2011-10-22','30','2011-11-17','dorian'),
('6','82','46098','Monsieur Tchetchoua Christophe','12','confirmee','RAS','2011-10-22','90','2011-12-06','dorian'),
('7','83','230909','Pasto Sango Donald jean','','non confirmee','RAS','2011-10-22','','0000-00-00','dorian'),
('8','84','870981','Jean Bieleu Pascale','12','confirm&eacute;e','RAS','2011-10-22','2','2011-10-11','dorian'),
('9','85','645','LOUIS Pasteur jean momo pascale francis','8','confirmee','RAS','2011-10-22','23','2011-11-22','dorian'),
('10','93','18075','Tcheutchoa Mouafo Pacome','11','non confirmee','Une chaine musicale avec deux dines par jour','2011-10-25','10','2011-12-27','dorian'),
('11','94','456590','Monsieur Takam patout','12','non confirmee','Connexion internet haut debit et cable dans la chambre pour suivre la Television','2011-10-26','14','2011-10-31','dorian'),
('12','96','465454','Monsieur EMANA','12','non confirmee','cable internet','2011-10-26','12','2011-10-31','dorian');

--
-- Structure de la table `sappliquer`
--

DROP TABLE IF EXISTS `sappliquer`;
CREATE TABLE `sappliquer` (
  `CODE_SERVICE` int(2) NOT NULL,
  `ID_RESEVATION` int(2) NOT NULL,
  `DATE_RESERV_SERV` date DEFAULT NULL,
  `DUREE_RESERV_SERV` char(32) DEFAULT NULL,
  `ETAT_RESERV_SERV` char(32) DEFAULT NULL,
  `DATE__CONFIRMATION` date NOT NULL,
  `DATE_ANNUL` date NOT NULL,
  PRIMARY KEY (`CODE_SERVICE`,`ID_RESEVATION`),
  KEY `I_FK_SAPPLIQUER_SERVICE` (`CODE_SERVICE`),
  KEY `I_FK_SAPPLIQUER_RESERVATION` (`ID_RESEVATION`),
  CONSTRAINT `sappliquer_ibfk_1` FOREIGN KEY (`CODE_SERVICE`) REFERENCES `service` (`CODE_SERVICE`),
  CONSTRAINT `sappliquer_ibfk_2` FOREIGN KEY (`ID_RESEVATION`) REFERENCES `reservation` (`ID_RESEVATION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sappliquer`
--

INSERT INTO `sappliquer` (`CODE_SERVICE`, `ID_RESEVATION`, `DATE_RESERV_SERV`, `DUREE_RESERV_SERV`, `ETAT_RESERV_SERV`, `DATE__CONFIRMATION`, `DATE_ANNUL`) VALUES ('8','9','2011-11-22','23','confirmee','2011-10-22','0000-00-00'),
('12','8','2011-10-11','2','confirm&eacute;e','2011-10-22','0000-00-00'),
('18','7','2011-10-12','2','non confirm&eacute;e','0000-00-00','0000-00-00');

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `CODE_SERVICE` int(2) NOT NULL AUTO_INCREMENT,
  `CODE_TYPE_SERVICE` int(2) NOT NULL,
  `TITRE_SERVICE` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_SERVICE`),
  KEY `I_FK_SERVICE_TYPE_SERVICE` (`CODE_TYPE_SERVICE`),
  CONSTRAINT `service_ibfk_1` FOREIGN KEY (`CODE_TYPE_SERVICE`) REFERENCES `type_service` (`CODE_TYPE_SERVICE`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`CODE_SERVICE`, `CODE_TYPE_SERVICE`, `TITRE_SERVICE`) VALUES ('1','14','Grand jus'),
('2','14','Petit jus'),
('3','14','Grande biere'),
('4','14','Petite biere'),
('5','14','whisky bouteille'),
('6','14','whisky consommation'),
('7','14','Jus naturel'),
('8','14','Petit dejeune simple'),
('9','14','Petit dejeune complet'),
('10','14','Plat de Ndole'),
('11','14','Plat poisson bar'),
('12','14','Plat de poisson sole'),
('13','14','Plat de poulet'),
('14','14','Plat de steak'),
('15','14','Plat de viande achee'),
('16','14','Plat de lapin'),
('17','14','Petite bouteille eau'),
('18','14','Grande bouteille eau');

--
-- Structure de la table `statut`
--

DROP TABLE IF EXISTS `statut`;
CREATE TABLE `statut` (
  `CODE_STATUT` int(11) NOT NULL,
  `LIBELLE_STATUT` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_STATUT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statut`
--

--
-- Il n'y a aucun enregistrement dans la table `statut`
--

--
-- Structure de la table `tarification`
--

DROP TABLE IF EXISTS `tarification`;
CREATE TABLE `tarification` (
  `CODE_TARIFICATION` int(2) NOT NULL,
  PRIMARY KEY (`CODE_TARIFICATION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tarification`
--

INSERT INTO `tarification` (`CODE_TARIFICATION`) VALUES ('1'),
('2'),
('3'),
('4'),
('5'),
('6'),
('7'),
('8'),
('9'),
('10'),
('11'),
('12'),
('13'),
('14'),
('15'),
('16'),
('17'),
('18'),
('19'),
('20'),
('21');

--
-- Structure de la table `type_chambre`
--

DROP TABLE IF EXISTS `type_chambre`;
CREATE TABLE `type_chambre` (
  `CODE_TYPE_CHAMBRE` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLE_TYPE_CHAMBRE` char(32) DEFAULT NULL,
  `NOMBRE_DE_LIT_UNE_PLACE` int(2) DEFAULT NULL,
  `NOMBRE_LIT_DEUX_PLACES` int(2) DEFAULT NULL,
  `OBSERVATIONS` char(100) DEFAULT NULL,
  PRIMARY KEY (`CODE_TYPE_CHAMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_chambre`
--

INSERT INTO `type_chambre` (`CODE_TYPE_CHAMBRE`, `LIBELLE_TYPE_CHAMBRE`, `NOMBRE_DE_LIT_UNE_PLACE`, `NOMBRE_LIT_DEUX_PLACES`, `OBSERVATIONS`) VALUES ('10','Senior','0','1','Plus Spacieuse'),
('11','Simple','0','1','Moins Spacieuse'),
('12','Suite','0','1','Appartement');

--
-- Structure de la table `type_reglement`
--

DROP TABLE IF EXISTS `type_reglement`;
CREATE TABLE `type_reglement` (
  `CODE_TYPE_REGLEMENT` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLE_TYPE_REGLEMENT` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_TYPE_REGLEMENT`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_reglement`
--

INSERT INTO `type_reglement` (`CODE_TYPE_REGLEMENT`, `LIBELLE_TYPE_REGLEMENT`) VALUES ('1','cheque'),
('2','cash');

--
-- Structure de la table `type_service`
--

DROP TABLE IF EXISTS `type_service`;
CREATE TABLE `type_service` (
  `CODE_TYPE_SERVICE` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLE_SERVICE` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_TYPE_SERVICE`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_service`
--

INSERT INTO `type_service` (`CODE_TYPE_SERVICE`, `LIBELLE_SERVICE`) VALUES ('14','Bar-Restaurant');

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `CODE_UTILISATEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_UTILISATEUR` char(32) DEFAULT NULL,
  `FONCTION_UTILISATEUR` char(32) DEFAULT NULL,
  `TYPE_UTILISATEUR` char(32) DEFAULT NULL,
  `DATE_CREATION_UTILISATEUR` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_UTILISATEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`CODE_UTILISATEUR`, `NOM_UTILISATEUR`, `FONCTION_UTILISATEUR`, `TYPE_UTILISATEUR`, `DATE_CREATION_UTILISATEUR`) VALUES ('1','dorian','Administrateur','Administrateur',''),
('2','Andy','caissier','Caissier','24/10/2011'),
('3','Papa','receptionniste','utilisateur','30/10/2011'),
('4','loic','gestionnaire','utilisateur','30/10/2011'),
('5','loic','gestionnaire','utilisateur','30/10/2011'),
('6','loic','gestionnaire','utilisateur','30/10/2011'),
('7','loic','gestionnaire','utilisateur','30/10/2011');

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `nom_user`, `pseudo`, `password`) VALUES ('1','dorian','dorian','dorian'),
('2','Andy','andy','andy'),
('3','Papa','0ac6cd34e2fac333bf0ee3cd06bdcf96','0ac6cd34e2fac333bf0ee3cd06bdcf96'),
('4','loic','8f8c4ba92dab870d61461b28e3f63d69','8f8c4ba92dab870d61461b28e3f63d69'),
('5','loic','8f8c4ba92dab870d61461b28e3f63d69','8f8c4ba92dab870d61461b28e3f63d69'),
('6','loic','8f8c4ba92dab870d61461b28e3f63d69','8f8c4ba92dab870d61461b28e3f63d69'),
('7','loic','8f8c4ba92dab870d61461b28e3f63d69','8f8c4ba92dab870d61461b28e3f63d69'),
('12','francis','francis','franco');

--
-- Structure de la table `utiliser`
--

DROP TABLE IF EXISTS `utiliser`;
CREATE TABLE `utiliser` (
  `ID_CLIENT` int(2) NOT NULL,
  `CODE_SERVICE` int(2) NOT NULL,
  `DATE_UTILISATION` date DEFAULT NULL,
  `DATE_FIN` date NOT NULL,
  `DUREE_UTILISATION` int(11) DEFAULT NULL,
  `OBSERVATION_UTILISATION_SERVICE` char(32) DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENT`,`CODE_SERVICE`),
  KEY `I_FK_UTILISER_CLIENT` (`ID_CLIENT`),
  KEY `I_FK_UTILISER_SERVICE` (`CODE_SERVICE`),
  CONSTRAINT `utiliser_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`),
  CONSTRAINT `utiliser_ibfk_2` FOREIGN KEY (`CODE_SERVICE`) REFERENCES `service` (`CODE_SERVICE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utiliser`
--

INSERT INTO `utiliser` (`ID_CLIENT`, `CODE_SERVICE`, `DATE_UTILISATION`, `DATE_FIN`, `DUREE_UTILISATION`, `OBSERVATION_UTILISATION_SERVICE`) VALUES ('91','8','2011-10-10','0000-00-00','0','ras');

--
-- Structure de la table `verrou`
--

DROP TABLE IF EXISTS `verrou`;
CREATE TABLE `verrou` (
  `CODE_UTILISATEUR` int(11) NOT NULL,
  `CODE_STATUT` int(11) NOT NULL,
  `MOTIF` char(32) DEFAULT NULL,
  `DATE_DEBUT_VERROU` char(32) DEFAULT NULL,
  `DATE_FIN_VERROU` char(32) DEFAULT NULL,
  PRIMARY KEY (`CODE_UTILISATEUR`,`CODE_STATUT`),
  KEY `I_FK_VERROU_UTILISATEUR` (`CODE_UTILISATEUR`),
  KEY `I_FK_VERROU_STATUT` (`CODE_STATUT`),
  CONSTRAINT `verrou_ibfk_1` FOREIGN KEY (`CODE_UTILISATEUR`) REFERENCES `utilisateur` (`CODE_UTILISATEUR`),
  CONSTRAINT `verrou_ibfk_2` FOREIGN KEY (`CODE_STATUT`) REFERENCES `statut` (`CODE_STATUT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `verrou`
--

--
-- Il n'y a aucun enregistrement dans la table `verrou`
--

--
-- Structure de la table `viser`
--

DROP TABLE IF EXISTS `viser`;
CREATE TABLE `viser` (
  `CODE_TARIFICATION` int(2) NOT NULL,
  `CODE_TYPE_CHAMBRE` int(2) NOT NULL,
  `MONTANT_TARIF_TYPECHAMBRE` char(32) NOT NULL,
  `DATE_DEBUT_TARIF_TYPECHAMBRE` date NOT NULL,
  `DATE_FIN_TARIF_TYPECHAMBRE` date NOT NULL,
  PRIMARY KEY (`CODE_TARIFICATION`,`CODE_TYPE_CHAMBRE`),
  KEY `I_FK_VISER_TARIFICATION` (`CODE_TARIFICATION`),
  KEY `I_FK_VISER_TYPE_CHAMBRE` (`CODE_TYPE_CHAMBRE`),
  CONSTRAINT `viser_ibfk_1` FOREIGN KEY (`CODE_TARIFICATION`) REFERENCES `tarification` (`CODE_TARIFICATION`),
  CONSTRAINT `viser_ibfk_2` FOREIGN KEY (`CODE_TYPE_CHAMBRE`) REFERENCES `type_chambre` (`CODE_TYPE_CHAMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `viser`
--

INSERT INTO `viser` (`CODE_TARIFICATION`, `CODE_TYPE_CHAMBRE`, `MONTANT_TARIF_TYPECHAMBRE`, `DATE_DEBUT_TARIF_TYPECHAMBRE`, `DATE_FIN_TARIF_TYPECHAMBRE`) VALUES ('1','12','50000','2011-10-20','2011-12-31'),
('2','11','20000','2011-10-20','2011-12-31'),
('3','10','25000','2011-10-20','2011-12-31');

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE `visite` (
  `CODE_VISITE` int(10) NOT NULL AUTO_INCREMENT,
  `NOM_CLIENT` char(50) NOT NULL,
  `NOM_VISITEUR` char(50) NOT NULL,
  `DATE_ARRIVEE` date NOT NULL,
  `DATE_DEPART` date DEFAULT NULL,
  PRIMARY KEY (`CODE_VISITE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visite`
--

--
-- Il n'y a aucun enregistrement dans la table `visite`
--

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE `visiteur` (
  `ID_VISITEUR` int(2) NOT NULL AUTO_INCREMENT,
  `NOM_VISITEUR` char(32) NOT NULL,
  `PRENOM_VISITEUR` char(32) NOT NULL,
  `NUM_IDENTITE_VISITEUR` int(2) NOT NULL,
  `TYPE_IDENTITE` char(32) NOT NULL,
  PRIMARY KEY (`ID_VISITEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`ID_VISITEUR`, `NOM_VISITEUR`, `PRENOM_VISITEUR`, `NUM_IDENTITE_VISITEUR`, `TYPE_IDENTITE`) VALUES ('1','Yogo','Leticia','34367','carte nationale');

--
-- Fichier : "sauvegarde-basehotel1-30-10-2011.sql", 44 table(s), 335 enregistrement(s)
-- Sauvegarde g&eacute;n&eacute;r&eacute;e par K20save v1.0 en 0.0634 s, date : 30-10-2011
--