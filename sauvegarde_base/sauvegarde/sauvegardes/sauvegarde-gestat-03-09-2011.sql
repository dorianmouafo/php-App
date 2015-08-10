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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `arrondissement`
--

INSERT INTO `arrondissement` (`id_arrond`, `id_dpt`, `nom_arrond`) VALUES ('1','2','Foumban'),
('2','1','Yaounde 1er'),
('4','4','SOA'),
('5','3','Akono');

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

--
-- Il n'y a aucun enregistrement dans la table `arrondissement_equipement`
--

--
-- Structure de la table `batiment`
--

DROP TABLE IF EXISTS `batiment`;
CREATE TABLE `batiment` (
  `id_bat` int(4) NOT NULL auto_increment,
  `id_arrond` int(4) NOT NULL,
  `nom_bat` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_bat`),
  KEY `id_arrond` (`id_arrond`),
  CONSTRAINT `batiment_ibfk_1` FOREIGN KEY (`id_arrond`) REFERENCES `arrondissement` (`id_arrond`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `batiment`
--

INSERT INTO `batiment` (`id_bat`, `id_arrond`, `nom_bat`) VALUES ('1','1','CTI'),
('2','2','RCE');

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

--
-- Il n'y a aucun enregistrement dans la table `batiment_commodite`
--

--
-- Structure de la table `besoin`
--

DROP TABLE IF EXISTS `besoin`;
CREATE TABLE `besoin` (
  `id_besoin` int(4) NOT NULL auto_increment,
  `date_besoin` date NOT NULL,
  `nombre` int(6) NOT NULL,
  PRIMARY KEY  (`id_besoin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `besoin`
--

INSERT INTO `besoin` (`id_besoin`, `date_besoin`, `nombre`) VALUES ('1','2011-08-21','5');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commodite`
--

--
-- Il n'y a aucun enregistrement dans la table `commodite`
--

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

--
-- Il n'y a aucun enregistrement dans la table `commodite_service`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id_dpt`, `id_region`, `nom_dpt`) VALUES ('1','1','Mfoundi'),
('2','3','Noun'),
('3','1','Mefou et Akono'),
('4','1','Mefou Assi');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipement`
--

--
-- Il n'y a aucun enregistrement dans la table `equipement`
--

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE `fonction` (
  `id_fonct` int(4) NOT NULL auto_increment,
  `nom_fonct` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_fonct`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`id_fonct`, `nom_fonct`) VALUES ('1','INFORMATICIEN'),
('2','Coordonnateur'),
('3','Médecin'),
('4','Officier Principal');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `materiel_roulant`
--

--
-- Il n'y a aucun enregistrement dans la table `materiel_roulant`
--

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
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `nationalite` varchar(100) NOT NULL,
  `cni` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `telephone` int(15) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `bp` int(10) NOT NULL,
  `sit_mat` text NOT NULL,
  `e_mail` varchar(30) NOT NULL,
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

INSERT INTO `personnel` (`mat_pers`, `id_cat`, `id_struct`, `id_arrond`, `id_fonct`, `id_type_pers`, `id_grade`, `nom`, `prenom`, `sexe`, `nationalite`, `cni`, `photo`, `telephone`, `ville`, `bp`, `sit_mat`, `e_mail`, `date_embauche`) VALUES ('1','1','1','1','1','1','1','VERRO','2011','M','CAMEROUN','1234567890','RAS','234567890','YAOUNDE','3456','RAS','ERTYUI@YAHOO.FR','0000-00-00'),
('MADFUUI6','1','1','1','1','1','1','Gerard','La true','M','France','2345678','','23456789','PAris','23456789','CÃ©libataire endurci','latrue@gmail.com','0000-00-00'),
('MADFUUI9','1','1','1','1','1','3','Magloire','RODRIGUE Labate','M','Cameroun','1234567890','5.jpg','23456788','YaoundÃƒÂ©','234567890','CÃƒÂ©libataire','magloir@gmail.net','0000-00-00'),
('OMLHNE54','3','1','4','1','1','2','EMANE','Guy Roland','M','Cameroun','23456789','vlcsnap-2011-08-21-02h21m55s81.png','345678998','Douala','2343','MariÃƒÂ©','emane@yahoo.fr','0000-00-00'),
('PNHB','1','1','1','1','1','1','MAyi','Germaine','F','Cameroun','23456789','','23456789','Garoua','23456','FiancÃ©e','mayi@voila.cm','0000-00-00');

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

--
-- Il n'y a aucun enregistrement dans la table `personnel_categorie`
--

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

INSERT INTO `personnel_fonction` (`mat_pers`, `id_fonc`, `date_debut`, `date_fin`) VALUES ('MADFUUI9','1','2011-08-28','2011-08-18');

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

--
-- Il n'y a aucun enregistrement dans la table `personnel_grade`
--

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

INSERT INTO `personnel_structure` (`mat_pers`, `id_struct`, `date_debut`, `date_fin`) VALUES ('1','1','2011-08-27','2015-08-20');

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

--
-- Il n'y a aucun enregistrement dans la table `personnel_typepersonnel`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id_serv`, `nom_serv`) VALUES ('1','services centraux'),
('2','services déconcentrés'),
('3','services rattachés'),
('4','projets et programmes');

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE `structure` (
  `id_struct` int(4) NOT NULL auto_increment,
  `nom_struct` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_struct`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `structure`
--

INSERT INTO `structure` (`id_struct`, `nom_struct`) VALUES ('1','MINJEUN');

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

--
-- Il n'y a aucun enregistrement dans la table `structure_equipement`
--

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

--
-- Il n'y a aucun enregistrement dans la table `structure_materielroulant`
--

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

--
-- Il n'y a aucun enregistrement dans la table `structure_service`
--

--
-- Structure de la table `type_commodite`
--

DROP TABLE IF EXISTS `type_commodite`;
CREATE TABLE `type_commodite` (
  `id_type_com` int(4) NOT NULL auto_increment,
  `nom_type_com` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_type_com`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_commodite`
--

--
-- Il n'y a aucun enregistrement dans la table `type_commodite`
--

--
-- Structure de la table `type_equipement`
--

DROP TABLE IF EXISTS `type_equipement`;
CREATE TABLE `type_equipement` (
  `id_type_equip` int(4) NOT NULL auto_increment,
  `nom_type_equip` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_type_equip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_equipement`
--

--
-- Il n'y a aucun enregistrement dans la table `type_equipement`
--

--
-- Structure de la table `type_mat_roul`
--

DROP TABLE IF EXISTS `type_mat_roul`;
CREATE TABLE `type_mat_roul` (
  `id_type_mat_roul` int(4) NOT NULL auto_increment,
  `nom_type_mat_roul` varchar(40) NOT NULL,
  PRIMARY KEY  (`id_type_mat_roul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_mat_roul`
--

--
-- Il n'y a aucun enregistrement dans la table `type_mat_roul`
--

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
('3','agent de l\'Etat'),
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

--
-- Il n'y a aucun enregistrement dans la table `typeequipement_besoin`
--

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

--
-- Il n'y a aucun enregistrement dans la table `typematerielroulant_besoin`
--

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

INSERT INTO `users` (`id`, `login`, `password`, `profil`, `droit_ajout`, `droit_consultation`, `droit_modification`, `droit_suppression`, `date_creation`) VALUES ('1','admin','admin','','OUI','OUI','YES','YES','0000-00-00'),
('2','kuis','kuis','Admin','','','','','2011-09-01');

--
-- Fichier : "sauvegarde-gestat-03-09-2011.sql", 32 table(s), 74 enregistrement(s)
-- Sauvegarde g&eacute;n&eacute;r&eacute;e par K20save v1.0 en 0.0728 s, date : 03-09-2011
--