--
-- Base de donn&eacute;e : `gestat`
--


--
-- Structure de la table `arrondissement`
--

DROP TABLE IF EXISTS `arrondissement`;
CREATE TABLE `arrondissement` (
  `id_arrond` int(4) NOT NULL auto_increment,
  `id_dpt` int(4) NOT NULL,
  `nom_arrond` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_arrond`),
  KEY `id_dpt` (`id_dpt`),
  CONSTRAINT `arrondissement_ibfk_1` FOREIGN KEY (`id_dpt`) REFERENCES `departement` (`id_dpt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `arrondissement`
--

INSERT INTO `arrondissement` (`id_arrond`, `id_dpt`, `nom_arrond`) VALUES ('2','1','Yaounde 1er'),
('4','2','SOA'),
('7','6','Bafang'),
('9','11','Ebolowa 1er'),
('10','10','Douala 5eme'),
('11','12','Kribi 1er'),
('12','1','Yde 4');

--
-- Structure de la table `arrondissement_equipement`
--

DROP TABLE IF EXISTS `arrondissement_equipement`;
CREATE TABLE `arrondissement_equipement` (
  `id_arrond` int(4) NOT NULL,
  `id_equip` int(4) NOT NULL,
  KEY `id_equip` (`id_equip`),
  KEY `id_arrond` (`id_arrond`),
  CONSTRAINT `arrondissement_equipement_ibfk_1` FOREIGN KEY (`id_arrond`) REFERENCES `arrondissement` (`id_arrond`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `arrondissement_equipement_ibfk_2` FOREIGN KEY (`id_equip`) REFERENCES `equipement` (`id_equip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `arrondissement_equipement`
--

INSERT INTO `arrondissement_equipement` (`id_arrond`, `id_equip`) VALUES ('2','1'),
('4','2'),
('7','15'),
('7','4'),
('2','11'),
('4','3'),
('7','5'),
('7','10'),
('9','8'),
('9','9'),
('2','7'),
('7','12');

--
-- Structure de la table `batiment`
--

DROP TABLE IF EXISTS `batiment`;
CREATE TABLE `batiment` (
  `id_bat` int(4) NOT NULL auto_increment,
  `id_arrond` int(4) NOT NULL,
  `nom_bat` varchar(40) NOT NULL,
  `etat_bat` varchar(15) NOT NULL,
  PRIMARY KEY  (`id_bat`),
  KEY `id_arrond` (`id_arrond`),
  CONSTRAINT `batiment_ibfk_1` FOREIGN KEY (`id_arrond`) REFERENCES `arrondissement` (`id_arrond`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `batiment`
--

INSERT INTO `batiment` (`id_bat`, `id_arrond`, `nom_bat`, `etat_bat`) VALUES ('2','2','délégation régionale du centre','achevé'),
('3','2','ggggggggggggggggggg','Acheve');

--
-- Structure de la table `batiment_commodite`
--

DROP TABLE IF EXISTS `batiment_commodite`;
CREATE TABLE `batiment_commodite` (
  `id_bat` int(4) NOT NULL,
  `id_com` int(4) NOT NULL,
  KEY `id_bat` (`id_bat`),
  KEY `id_com` (`id_com`),
  CONSTRAINT `batiment_commodite_ibfk_1` FOREIGN KEY (`id_bat`) REFERENCES `batiment` (`id_bat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batiment_commodite_ibfk_2` FOREIGN KEY (`id_com`) REFERENCES `commodite` (`id_com`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `batiment_commodite`
--

INSERT INTO `batiment_commodite` (`id_bat`, `id_com`) VALUES ('2','2');

--
-- Structure de la table `besoin`
--

DROP TABLE IF EXISTS `besoin`;
CREATE TABLE `besoin` (
  `id_besoin` int(4) NOT NULL auto_increment,
  `date_besoin` date NOT NULL,
  `nombre` int(6) NOT NULL,
  PRIMARY KEY  (`id_besoin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `besoin`
--

INSERT INTO `besoin` (`id_besoin`, `date_besoin`, `nombre`) VALUES ('1','2011-08-21','5'),
('2','2011-09-22','0'),
('3','2011-09-22','3'),
('4','2011-09-05','3');

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id_cat` int(4) NOT NULL auto_increment,
  `libelle_cat` varchar(30) NOT NULL,
  PRIMARY KEY  (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `libelle_cat`) VALUES ('1','A1'),
('2','A2'),
('3','B1'),
('4','B2');

--
-- Structure de la table `commodite`
--

DROP TABLE IF EXISTS `commodite`;
CREATE TABLE `commodite` (
  `id_com` int(4) NOT NULL auto_increment,
  `id_type_com` int(4) NOT NULL,
  `nom_com` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_com`),
  KEY `id_type_com` (`id_type_com`),
  CONSTRAINT `commodite_ibfk_1` FOREIGN KEY (`id_type_com`) REFERENCES `type_commodite` (`id_type_com`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commodite`
--

INSERT INTO `commodite` (`id_com`, `id_type_com`, `nom_com`) VALUES ('1','3','robinet individuel SNEC/CAMWATER'),
('2','3','robinet collectif SNEC/CAMWATER'),
('3','3','borne fontaine publique'),
('4','3','forage'),
('6','3','source aménagée'),
('8','4','compteur individuel AES-SONEL'),
('9','4','compteur collectif AES-SONEL'),
('10','4','AES-SONEL sans compteur'),
('12','5','WC avec chasse d\'eau'),
('13','5','latrine amenagée'),
('14','5','latrine non aménagée'),
('15','5','pas de WC'),
('16','5','autre'),
('17','6','oui régulierement'),
('18','6','oui de temps en temps'),
('19','6','rarement'),
('20','6','jamais'),
('21','7','cloturé'),
('22','7','non cloturé');

--
-- Structure de la table `commodite_service`
--

DROP TABLE IF EXISTS `commodite_service`;
CREATE TABLE `commodite_service` (
  `id_com` int(4) NOT NULL,
  `id_serv` int(4) NOT NULL,
  KEY `id_com` (`id_com`),
  KEY `id_serv` (`id_serv`),
  CONSTRAINT `commodite_service_ibfk_1` FOREIGN KEY (`id_com`) REFERENCES `commodite` (`id_com`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commodite_service_ibfk_2` FOREIGN KEY (`id_serv`) REFERENCES `service` (`id_serv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commodite_service`
--

INSERT INTO `commodite_service` (`id_com`, `id_serv`) VALUES ('1','1'),
('6','2'),
('6','1'),
('2','1'),
('1','2'),
('2','2'),
('8','1'),
('1','2'),
('9','1'),
('9','2');

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE `departement` (
  `id_dpt` int(4) NOT NULL auto_increment,
  `id_region` int(4) NOT NULL,
  `nom_dpt` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_dpt`),
  KEY `id_region` (`id_region`),
  CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id_dpt`, `id_region`, `nom_dpt`) VALUES ('1','1','Mfoundi'),
('2','1','Mefou et Afamba'),
('5','1','lekie'),
('6','3','haut-nkam'),
('9','4','Nyong et so\'o'),
('10','2','Wouri'),
('11','4','Mvila'),
('12','4','Océan');

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE `equipement` (
  `id_equip` int(4) NOT NULL auto_increment,
  `id_type_equip` int(4) NOT NULL,
  `nom_equip` varchar(100) NOT NULL,
  `etat_equip` varchar(30) NOT NULL,
  `date_acquis` date NOT NULL,
  `nombre` int(10) NOT NULL,
  PRIMARY KEY  (`id_equip`),
  KEY `id_type_equip` (`id_type_equip`),
  CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`id_type_equip`) REFERENCES `type_equipement` (`id_type_equip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`id_equip`, `id_type_equip`, `nom_equip`, `etat_equip`, `date_acquis`, `nombre`) VALUES ('1','1','table','bon état','2011-09-05','6'),
('2','1','chaise','assez bon etat','2011-09-05','12'),
('3','4','ordinateur','mauvais etat','2011-09-05','5'),
('4','1','imprimante','assez bon etat','2011-09-05','2'),
('5','1','photocopieur','bon etat','2011-09-05','1'),
('6','4','scanner','mauvais etat','2011-09-05','1'),
('7','1','machine à écrire','bon etat','2011-09-05','3'),
('8','1','ronéo','mauvais etat','2005-09-02','0'),
('9','3','placard','assez bon etat','2011-09-05','0'),
('10','1','dictionnaire','assez bon etat','2007-05-16','0'),
('11','2','sceau','assez bon etat','2011-09-05','8'),
('12','2','balai','bon etat','2011-09-05','10'),
('13','2','corbeille à ordure','assez bon etat','2011-09-05','10'),
('14','4','dispositif audio-video','bon etat','2011-09-05','2'),
('15','4','ordinateur','assez bon etat','2011-09-10','6');

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE `fonction` (
  `id_fonct` int(4) NOT NULL auto_increment,
  `nom_fonct` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_fonct`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`id_fonct`, `nom_fonct`) VALUES ('1','informaticien'),
('2','secretaire'),
('3','directeur'),
('4','chef de service'),
('5','sous-directeur'),
('6','ministre'),
('7','secretaire general'),
('8','chef de cellule'),
('9','communicateur'),
('10','agent d\'appui'),
('11','Enseignant d\'éducation physique');

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id_grade` int(4) NOT NULL auto_increment,
  `nom_grade` varchar(100) NOT NULL,
  `annee_retraite` date NOT NULL,
  PRIMARY KEY  (`id_grade`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `grade`
--

INSERT INTO `grade` (`id_grade`, `nom_grade`, `annee_retraite`) VALUES ('1','ingenieur','2026-07-06'),
('2','journalist','2016-08-17'),
('3','MEPS','2011-08-28'),
('4','IPJA','2011-09-03'),
('5','O.P','2011-09-03'),
('6','PAEPS','2011-09-03'),
('7','PLEG','2011-09-03'),
('8','PENIEG','2011-09-03'),
('9','CRF','2011-09-03'),
('10','decisionnaire','2011-09-03'),
('11','IAJA','2011-09-03'),
('12','IEG','2011-09-03'),
('13','IJA','2011-09-03'),
('14','CJA','2011-09-03'),
('15','CPJA','2011-09-03'),
('16','IET','2011-09-03'),
('17','TA','2011-09-03'),
('18','TP','2011-09-03'),
('19','AS','2011-09-03'),
('20','AS','2011-09-03'),
('21','CDOC','2011-09-03'),
('22','PEPS','2011-09-03'),
('23','A.E','2011-09-03'),
('24','A.U','2011-09-03'),
('25','ACP','2011-09-03'),
('26','C.A','2011-09-03'),
('27','C.A.DOC','2011-09-03');

--
-- Structure de la table `materiel_roulant`
--

DROP TABLE IF EXISTS `materiel_roulant`;
CREATE TABLE `materiel_roulant` (
  `id_mat_roul` int(4) NOT NULL auto_increment,
  `id_type_mat_roul` int(4) NOT NULL,
  `nom_mat_roul` varchar(40) NOT NULL,
  `etat_mat_roul` varchar(100) NOT NULL,
  `date_acquis` date NOT NULL,
  PRIMARY KEY  (`id_mat_roul`),
  KEY `id_type_mat_roul` (`id_type_mat_roul`),
  CONSTRAINT `materiel_roulant_ibfk_1` FOREIGN KEY (`id_type_mat_roul`) REFERENCES `type_mat_roul` (`id_type_mat_roul`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `materiel_roulant`
--

INSERT INTO `materiel_roulant` (`id_mat_roul`, `id_type_mat_roul`, `nom_mat_roul`, `etat_mat_roul`, `date_acquis`) VALUES ('1','1','véhicule','assez bon état','2009-03-13'),
('2','2','moto','assez bon état','2011-09-06'),
('3','1','velo','mauvais état','2011-09-06'),
('4','2','chaise roulante','bon état','2011-09-24');

--
-- Structure de la table `perso`
--

DROP TABLE IF EXISTS `perso`;
CREATE TABLE `perso` (
  `mat_pers` varchar(10) NOT NULL,
  `id_cat` int(4) NOT NULL,
  `id_struct` int(4) NOT NULL,
  `id_arrond` int(4) NOT NULL,
  `id_fonct` int(4) NOT NULL,
  `id_type_pers` int(4) NOT NULL,
  `id_grade` int(4) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) default NULL,
  `sexe` varchar(10) default NULL,
  `nationalite` varchar(100) default NULL,
  `cni` varchar(50) default NULL,
  `photo` varchar(50) default NULL,
  `telephone` int(15) default NULL,
  `ville` varchar(100) default NULL,
  `bp` int(10) default NULL,
  `sit_mat` text,
  `e_mail` varchar(30) default NULL,
  `date_embauche` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `perso`
--

INSERT INTO `perso` (`mat_pers`, `id_cat`, `id_struct`, `id_arrond`, `id_fonct`, `id_type_pers`, `id_grade`, `nom`, `prenom`, `sexe`, `nationalite`, `cni`, `photo`, `telephone`, `ville`, `bp`, `sit_mat`, `e_mail`, `date_embauche`) VALUES ('MADFUUI6','1','4','2','3','2','4','FOUDA','georges','M','camerounais','2345678','','23456789','yaounde','23456789','marié','latrue@gmail.com','2007-09-11'),
('MADFUUI9','2','8','4','2','1','5','Eloundou','Nadège','F','Cameroun','1234567890','5.jpg','23456788','Yaounde','234567890','mariée','magloir@gmail.net','2005-07-25');

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE `personnel` (
  `mat_pers` varchar(10) NOT NULL,
  `id_cat` int(4) NOT NULL,
  `id_struct` int(4) NOT NULL,
  `id_arrond` int(4) NOT NULL,
  `id_fonct` int(4) NOT NULL,
  `id_type_pers` int(4) NOT NULL,
  `id_grade` int(4) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) default NULL,
  `sexe` varchar(10) default NULL,
  `nationalite` varchar(100) default NULL,
  `cni` varchar(50) default NULL,
  `photo` varchar(50) NOT NULL,
  `telephone` int(15) default NULL,
  `ville` varchar(100) default NULL,
  `bp` int(10) default NULL,
  `sit_mat` text,
  `e_mail` varchar(30) default NULL,
  `date_embauche` date NOT NULL,
  PRIMARY KEY  (`mat_pers`),
  KEY `id_cat` (`id_cat`,`id_struct`,`id_arrond`,`id_fonct`,`id_type_pers`,`id_grade`),
  KEY `id_struct` (`id_struct`),
  KEY `id_arrond` (`id_arrond`),
  KEY `id_fonct` (`id_fonct`),
  KEY `id_type_pers` (`id_type_pers`),
  KEY `id_grade` (`id_grade`),
  CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`id_struct`) REFERENCES `structure` (`id_struct`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_ibfk_3` FOREIGN KEY (`id_arrond`) REFERENCES `arrondissement` (`id_arrond`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_ibfk_4` FOREIGN KEY (`id_fonct`) REFERENCES `fonction` (`id_fonct`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_ibfk_5` FOREIGN KEY (`id_type_pers`) REFERENCES `type_personnel` (`id_type_pers`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_ibfk_6` FOREIGN KEY (`id_grade`) REFERENCES `grade` (`id_grade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`mat_pers`, `id_cat`, `id_struct`, `id_arrond`, `id_fonct`, `id_type_pers`, `id_grade`, `nom`, `prenom`, `sexe`, `nationalite`, `cni`, `photo`, `telephone`, `ville`, `bp`, `sit_mat`, `e_mail`, `date_embauche`) VALUES ('MADFUUI1','2','1','7','1','1','1','WANDJI','eric','M','camerounais','kjkh598j','','39581588','bafang','85','celibataire','alex@hotmail.com','1989-07-11'),
('MADFUUI10','3','4','2','9','3','2','ESSOMBA','JEANNE','F','camerounaise','988933','','895953','yde','5598','mariée','gertrude@hotmail.com','2007-09-11'),
('MADFUUI2','1','11','11','10','3','5','Kenfack','Landry','M','camerounais','kjh598l','DSC07761.JPG','35981478','kribi','35','celibataire','alex@hotmail.com','1998-03-04'),
('MADFUUI3','3','7','2','1','1','1','NTONGA','lucien','M','camerounais','598khjhg5','DSC07769.JPG','22598158','yde','51','marié','heyou@yahoo.fr','1995-02-16'),
('MADFUUI4','4','10','9','10','4','14','Nso\'o','Bertine Flore','F','camerounaise','598njheg5','DSC07760.JPG','34598135','Ebolowa','3598','celibataire','berto@yahoo.fr','2003-04-11'),
('MADFUUI5','4','11','11','2','1','17','GOME','Solange','F','camerounaise','kj35l','DSC07787.JPG','31598587','kribi','58','celibataire','sol@hotmail.com','1996-02-05'),
('MADFUUI6','1','4','2','3','2','4','FOUDA','georges','M','camerounais','2345678','','23456789','yaounde','23456789','marié','latrue@gmail.com','2007-09-11'),
('MADFUUI7','2','12','12','11','2','6','BILE','Isidore','M','camerounais','598lkj85','DSC07791.JPG','23598521','yde','98','marié','showyou@gmail.com','1994-01-11'),
('MADFUUI8','3','9','10','2','4','17','DECCA','Julie','F','camerounaise','358mlk5','','33589647','Douala','32','célibataire','juliedec@yahoo.fr','1996-04-11'),
('MADFUUI9','2','8','4','2','1','5','Eloundou','Nadège','F','Cameroun','1234567890','','23456788','Yaounde','234567890','mariée','magloir@gmail.net','2005-07-25');

--
-- Structure de la table `personnel_categorie`
--

DROP TABLE IF EXISTS `personnel_categorie`;
CREATE TABLE `personnel_categorie` (
  `mat_pers` varchar(10) NOT NULL,
  `id_cat` int(4) NOT NULL,
  KEY `id_cat` (`id_cat`),
  KEY `mat_pers` (`mat_pers`),
  CONSTRAINT `personnel_categorie_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_categorie_ibfk_2` FOREIGN KEY (`mat_pers`) REFERENCES `personnel` (`mat_pers`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_categorie`
--

INSERT INTO `personnel_categorie` (`mat_pers`, `id_cat`) VALUES ('MADFUUI1','2'),
('MADFUUI9','2'),
('MADFUUI6','1'),
('MADFUUI10','3'),
('MADFUUI4','4'),
('MADFUUI2','1'),
('MADFUUI3','3'),
('MADFUUI7','2'),
('MADFUUI8','3');

--
-- Structure de la table `personnel_fonction`
--

DROP TABLE IF EXISTS `personnel_fonction`;
CREATE TABLE `personnel_fonction` (
  `mat_pers` varchar(10) NOT NULL,
  `id_fonc` int(4) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  KEY `mat_pers` (`mat_pers`),
  KEY `id_fonc` (`id_fonc`),
  CONSTRAINT `personnel_fonction_ibfk_1` FOREIGN KEY (`mat_pers`) REFERENCES `personnel` (`mat_pers`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_fonction_ibfk_2` FOREIGN KEY (`id_fonc`) REFERENCES `fonction` (`id_fonct`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_fonction`
--

INSERT INTO `personnel_fonction` (`mat_pers`, `id_fonc`, `date_debut`, `date_fin`) VALUES ('MADFUUI9','1','2011-08-28','2011-08-18'),
('MADFUUI10','9','2008-05-19','2011-09-24'),
('MADFUUI1','1','2011-09-24','2011-09-24'),
('MADFUUI6','3','2010-03-10','2011-09-24'),
('MADFUUI4','10','2010-08-20','2011-09-24'),
('MADFUUI2','10','1998-03-06','2011-09-26'),
('MADFUUI3','1','1997-09-23','0000-00-00'),
('MADFUUI7','11','2011-09-26','2011-09-26'),
('MADFUUI8','2','2011-09-26','2011-09-26');

--
-- Structure de la table `personnel_grade`
--

DROP TABLE IF EXISTS `personnel_grade`;
CREATE TABLE `personnel_grade` (
  `mat_pers` varchar(10) NOT NULL,
  `id_grade` int(4) NOT NULL,
  KEY `mat_pers` (`mat_pers`),
  KEY `id_grade` (`id_grade`),
  CONSTRAINT `personnel_grade_ibfk_1` FOREIGN KEY (`mat_pers`) REFERENCES `personnel` (`mat_pers`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_grade_ibfk_2` FOREIGN KEY (`id_grade`) REFERENCES `grade` (`id_grade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_grade`
--

INSERT INTO `personnel_grade` (`mat_pers`, `id_grade`) VALUES ('MADFUUI6','4'),
('MADFUUI9','5'),
('MADFUUI1','1'),
('MADFUUI10','2'),
('MADFUUI4','14'),
('MADFUUI2','5'),
('MADFUUI3','1'),
('MADFUUI7','6'),
('MADFUUI8','10');

--
-- Structure de la table `personnel_structure`
--

DROP TABLE IF EXISTS `personnel_structure`;
CREATE TABLE `personnel_structure` (
  `mat_pers` varchar(10) NOT NULL,
  `id_struct` int(4) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  KEY `mat_pers` (`mat_pers`),
  KEY `id_struct` (`id_struct`),
  CONSTRAINT `personnel_structure_ibfk_1` FOREIGN KEY (`mat_pers`) REFERENCES `personnel` (`mat_pers`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_structure_ibfk_2` FOREIGN KEY (`id_struct`) REFERENCES `structure` (`id_struct`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_structure`
--

INSERT INTO `personnel_structure` (`mat_pers`, `id_struct`, `date_debut`, `date_fin`) VALUES ('MADFUUI6','4','2008-09-12','2011-09-20'),
('MADFUUI9','8','2011-09-20','2007-09-14'),
('MADFUUI1','1','2007-02-06','2011-09-22'),
('MADFUUI10','4','2006-04-06','2011-09-24'),
('MADFUUI4','10','2011-01-19','2011-09-24'),
('MADFUUI2','11','1994-03-09','0000-00-00'),
('MADFUUI3','7','2003-04-15','0000-00-00'),
('MADFUUI7','12','2011-09-26','2011-09-26'),
('MADFUUI8','9','2011-09-26','2011-09-26');

--
-- Structure de la table `personnel_typepersonnel`
--

DROP TABLE IF EXISTS `personnel_typepersonnel`;
CREATE TABLE `personnel_typepersonnel` (
  `mat_pers` varchar(10) NOT NULL,
  `id_type_pers` int(4) NOT NULL,
  KEY `mat_pers` (`mat_pers`),
  KEY `id_type_pers` (`id_type_pers`),
  CONSTRAINT `personnel_typepersonnel_ibfk_1` FOREIGN KEY (`mat_pers`) REFERENCES `personnel` (`mat_pers`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personnel_typepersonnel_ibfk_2` FOREIGN KEY (`id_type_pers`) REFERENCES `type_personnel` (`id_type_pers`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_typepersonnel`
--

INSERT INTO `personnel_typepersonnel` (`mat_pers`, `id_type_pers`) VALUES ('MADFUUI6','2'),
('MADFUUI9','1'),
('MADFUUI1','1'),
('MADFUUI10','3'),
('MADFUUI4','4'),
('MADFUUI2','3'),
('MADFUUI3','1'),
('MADFUUI7','2'),
('MADFUUI8','4');

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `id_region` int(4) NOT NULL auto_increment,
  `nom_region` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `region`
--

INSERT INTO `region` (`id_region`, `nom_region`) VALUES ('1','Centre'),
('2','Littoral'),
('3','Ouest'),
('4','Sud'),
('5','Est'),
('6','Nord'),
('7','Extrême-nord'),
('8','Adamaoua'),
('9','Nord-ouest'),
('10','Sud-ouest');

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id_serv` int(4) NOT NULL auto_increment,
  `nom_serv` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_serv`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id_serv`, `nom_serv`) VALUES ('1','services centraux'),
('2','services exterieurs');

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE `structure` (
  `id_struct` int(4) NOT NULL auto_increment,
  `nom_struct` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_struct`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `structure`
--

INSERT INTO `structure` (`id_struct`, `nom_struct`) VALUES ('1','secrétariat général'),
('2','délégation régionale du centre'),
('4','DAG'),
('6','bureau des archives'),
('7','cellule informatique et des statistiques'),
('8','centre national d\'education populaire et d\'alphabetisation'),
('9','Délégation régionale du littoral'),
('10','délégation régionale du sud'),
('11','CENAJES'),
('12','Inspection national de la jeunesse et des sports');

--
-- Structure de la table `structure_equipement`
--

DROP TABLE IF EXISTS `structure_equipement`;
CREATE TABLE `structure_equipement` (
  `id_struct` int(4) NOT NULL,
  `id_equip` int(4) NOT NULL,
  KEY `id_struct` (`id_struct`),
  KEY `id_equip` (`id_equip`),
  CONSTRAINT `structure_equipement_ibfk_1` FOREIGN KEY (`id_struct`) REFERENCES `structure` (`id_struct`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `structure_equipement_ibfk_2` FOREIGN KEY (`id_equip`) REFERENCES `equipement` (`id_equip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `structure_equipement`
--

INSERT INTO `structure_equipement` (`id_struct`, `id_equip`) VALUES ('1','1'),
('2','2'),
('1','4'),
('7','6'),
('4','11'),
('1','3'),
('4','5'),
('9','15'),
('10','8'),
('8','7'),
('1','12'),
('6','9'),
('4','10'),
('10','13'),
('8','14');

--
-- Structure de la table `structure_materielroulant`
--

DROP TABLE IF EXISTS `structure_materielroulant`;
CREATE TABLE `structure_materielroulant` (
  `id_struct` int(4) NOT NULL,
  `id_mat_roul` int(4) NOT NULL,
  KEY `id_struct` (`id_struct`),
  KEY `id_mat_roul` (`id_mat_roul`),
  CONSTRAINT `structure_materielroulant_ibfk_1` FOREIGN KEY (`id_struct`) REFERENCES `structure` (`id_struct`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `structure_materielroulant_ibfk_2` FOREIGN KEY (`id_mat_roul`) REFERENCES `materiel_roulant` (`id_mat_roul`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `structure_materielroulant`
--

INSERT INTO `structure_materielroulant` (`id_struct`, `id_mat_roul`) VALUES ('1','1'),
('2','2'),
('1','3'),
('8','4');

--
-- Structure de la table `structure_service`
--

DROP TABLE IF EXISTS `structure_service`;
CREATE TABLE `structure_service` (
  `id_struct` int(4) NOT NULL,
  `id_serv` int(4) NOT NULL,
  KEY `id_struct` (`id_struct`),
  KEY `id_serv` (`id_serv`),
  CONSTRAINT `structure_service_ibfk_1` FOREIGN KEY (`id_struct`) REFERENCES `structure` (`id_struct`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `structure_service_ibfk_2` FOREIGN KEY (`id_serv`) REFERENCES `service` (`id_serv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `structure_service`
--

INSERT INTO `structure_service` (`id_struct`, `id_serv`) VALUES ('1','1'),
('4','1'),
('2','2'),
('7','1'),
('8','2'),
('6','1'),
('9','2'),
('10','2'),
('11','2'),
('12','2');

--
-- Structure de la table `type_commodite`
--

DROP TABLE IF EXISTS `type_commodite`;
CREATE TABLE `type_commodite` (
  `id_type_com` int(4) NOT NULL auto_increment,
  `nom_type_com` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_type_com`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_commodite`
--

INSERT INTO `type_commodite` (`id_type_com`, `nom_type_com`) VALUES ('3','mode approvisionnement en eau'),
('4','source eclairage des batiments'),
('5','type  lieu aisance'),
('6','état des écoulements des eaux des égouts'),
('7','cloture ou barriere autour des batiments');

--
-- Structure de la table `type_equipement`
--

DROP TABLE IF EXISTS `type_equipement`;
CREATE TABLE `type_equipement` (
  `id_type_equip` int(4) NOT NULL auto_increment,
  `nom_type_equip` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_type_equip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_equipement`
--

INSERT INTO `type_equipement` (`id_type_equip`, `nom_type_equip`) VALUES ('1','fourniture de bureau'),
('2','matériel de nettoyage'),
('3','matériel d\'ameublement'),
('4','materiel electronique');

--
-- Structure de la table `type_mat_roul`
--

DROP TABLE IF EXISTS `type_mat_roul`;
CREATE TABLE `type_mat_roul` (
  `id_type_mat_roul` int(4) NOT NULL auto_increment,
  `nom_type_mat_roul` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_type_mat_roul`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_mat_roul`
--

INSERT INTO `type_mat_roul` (`id_type_mat_roul`, `nom_type_mat_roul`) VALUES ('1','moyen de locomotion à quatre roues'),
('2','moyen de locomotion à deux roues');

--
-- Structure de la table `type_personnel`
--

DROP TABLE IF EXISTS `type_personnel`;
CREATE TABLE `type_personnel` (
  `id_type_pers` int(4) NOT NULL auto_increment,
  `nom_type_pers` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_type_pers`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_personnel`
--

INSERT INTO `type_personnel` (`id_type_pers`, `nom_type_pers`) VALUES ('1','contractuel'),
('2','Fonctionnaire'),
('3','agent etat'),
('4','décisionnaire');

--
-- Structure de la table `typeequipement_besoin`
--

DROP TABLE IF EXISTS `typeequipement_besoin`;
CREATE TABLE `typeequipement_besoin` (
  `id_type_equip` int(4) NOT NULL,
  `id_besoin` int(4) NOT NULL,
  KEY `id_type_equip` (`id_type_equip`),
  KEY `id_besoin` (`id_besoin`),
  CONSTRAINT `typeequipement_besoin_ibfk_1` FOREIGN KEY (`id_type_equip`) REFERENCES `type_equipement` (`id_type_equip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeequipement_besoin_ibfk_2` FOREIGN KEY (`id_besoin`) REFERENCES `besoin` (`id_besoin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typeequipement_besoin`
--

INSERT INTO `typeequipement_besoin` (`id_type_equip`, `id_besoin`) VALUES ('1','1'),
('2','2'),
('3','1'),
('4','4');

--
-- Structure de la table `typematerielroulant_besoin`
--

DROP TABLE IF EXISTS `typematerielroulant_besoin`;
CREATE TABLE `typematerielroulant_besoin` (
  `id_type_mat_roul` int(4) NOT NULL,
  `id_besoin` int(4) NOT NULL,
  KEY `id_type_mat_roul` (`id_type_mat_roul`),
  KEY `id_besoin` (`id_besoin`),
  CONSTRAINT `typematerielroulant_besoin_ibfk_1` FOREIGN KEY (`id_type_mat_roul`) REFERENCES `type_mat_roul` (`id_type_mat_roul`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typematerielroulant_besoin_ibfk_2` FOREIGN KEY (`id_besoin`) REFERENCES `besoin` (`id_besoin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typematerielroulant_besoin`
--

INSERT INTO `typematerielroulant_besoin` (`id_type_mat_roul`, `id_besoin`) VALUES ('1','1'),
('2','3');

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profil` varchar(30) NOT NULL,
  `droit_ajout` varchar(30) NOT NULL,
  `droit_consultation` varchar(30) NOT NULL,
  `droit_modification` varchar(30) NOT NULL,
  `droit_suppression` varchar(30) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `profil`, `droit_ajout`, `droit_consultation`, `droit_modification`, `droit_suppression`, `date_creation`) VALUES ('1','mbazoa','irene1976','admin','OUI','OUI','YES','YES','2011-09-29'),
('2','kuis','kuis','Admin','','','','','2011-09-01');

--
-- Fichier : "sauvegarde-gestat-27-09-2011.sql", 33 table(s), 255 enregistrement(s)
-- Sauvegarde g&eacute;n&eacute;r&eacute;e par K20save v1.0 en 0.0329 s, date : 27-09-2011
--