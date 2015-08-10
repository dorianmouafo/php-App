
<?php 
// reçoit une date au format jj/mm/aaaa
// renvoi une date au format aaaa-mm-jj
function dateFormBase($date){
	if (trim($date) != "") {
		$elements=split("/",$date);
		if ((trim($elements[1]) != "") && (trim($elements[2]) != "") && (trim($elements[0]) != "")) {
			if (checkdate($elements[1],$elements[0],$elements[2])) {
				$rdate=$elements[2]."-".$elements[1]."-".$elements[0];
				return $rdate;
			}
		}
	}
	return "";
}

function formatage3Pos($valeur){
	$valeur_retournee="";
	$longueur=0;
	$longueur=strlen($valeur);
	
	switch ($longueur){

		case 3: $valeur_retournee=$valeur;
		break;
		
		case 4: $valeur_retournee=substr($valeur,0,1)." ".substr($valeur,1,3);
		break;
		
		case 5: $valeur_retournee=substr($valeur,0,2)." ".substr($valeur,2,3);
		break;
		
		case 6: $valeur_retournee=substr($valeur,0,3)." ".substr($valeur,3,3);
		break;
		
		case 7: $valeur_retournee=substr($valeur,0,1)." ".substr($valeur,1,3)." ".substr($valeur,4,3);
		break;
		
		case 8: $valeur_retournee=substr($valeur,0,2)." ".substr($valeur,2,3)." ".substr($valeur,5,3);
		break;
		
		case 9: $valeur_retournee=substr($valeur,0,3)." ".substr($valeur,3,3)." ".substr($valeur,6,3);
		break;
		
		case 10: $valeur_retournee=substr($valeur,0,1)." ".substr($valeur,1,3)." ".substr($valeur,4,3)." ".substr($valeur,7,3);
		break;
		
		case 11: $valeur_retournee=substr($valeur,0,2)." ".substr($valeur,2,3)." ".substr($valeur,5,3)." ".substr($valeur,8,3);
		break;
		
		case 12: $valeur_retournee=substr($valeur,0,3)." ".substr($valeur,3,3)." ".substr($valeur,6,3)." ".substr($valeur,9,3);
		break;
	}
	
	return $valeur_retournee;
}



?>
<?php 
// Ma fonction qui me revoit le nombre de jours quiu s'ecroule entre deux dates//
function NbJours($debut, $fin) {
  $tDeb = explode("-", $debut);
  $tFin = explode("-", $fin);
  $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
          mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
  return(($diff / 86400)+1);
}
//$Nombres_jours =  NbJours("2000-10-20", "2000-10-21");
// Affiche 2
//echo $Nombres_jours;
?>
<?php

//GESTION DES ATTRIBUTTIONS DES ETATS AUX CHAMBRES//
function recupere_valeur_lib_chalbre_etat_de_chambre($code){
	return ResultatRequette("select LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$code'");
 } 
 
 function recupere_valeur_lib_chalbre_etat_de_chambre1($code){
	return ResultatRequette("select CODE_CHAMBRE as info from avoir where CODE_AVOIR='$code'");
} 

//FIN GESTION DES ATTRIBUTTIONS DES ETATS AUX CHAMBRES//
 // gestion des types de chambre
 function ajout_type_chambre($LIBELLE_TYPE_CHAMBRE,$NOMBRE_DE_LIT_UNE_PLACE,$NOMBRE_LIT_DEUX_PLACES,$OBSERVATIONS){
	$requette="insert into type_chambre values (null,'$LIBELLE_TYPE_CHAMBRE','$NOMBRE_DE_LIT_UNE_PLACE','$NOMBRE_LIT_DEUX_PLACES','$OBSERVATIONS')";
	ExecuteRequette($requette);	 
}
 function modif_type_chambre($CODE_TYPE_CHAMBRE,$LIBELLE_TYPE_CHAMBRE,$NOMBRE_DE_LIT_UNE_PLACE,$NOMBRE_LIT_DEUX_PLACES,$OBSERVATIONS){
 $requette="update type_chambre set LIBELLE_TYPE_CHAMBRE='$LIBELLE_TYPE_CHAMBRE',NOMBRE_DE_LIT_UNE_PLACE='$NOMBRE_DE_LIT_UNE_PLACE', NOMBRE_LIT_DEUX_PLACES='$NOMBRE_LIT_DEUX_PLACES',OBSERVATIONS='$OBSERVATIONS'  where CODE_TYPE_CHAMBRE='$CODE_TYPE_CHAMBRE'";
 ExecuteRequette($requette);
 }
 function suppression_type_chambre($code){
$requette="delete from type_chambre where CODE_TYPE_CHAMBRE='$code'";
ExecuteRequette($requette);
 }
function recupere_libelle_type_chambre($code){
	return ResultatRequette("select LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
 }
 function recupere_nb_lit_un_type_chambre($code){
	return ResultatRequette("select NOMBRE_DE_LIT_UNE_PLACE as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
 }  
 function recupere_nb_lit_deux_type_chambre($code){
	return ResultatRequette("select NOMBRE_LIT_DEUX_PLACES as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
 }
function recupere_observations($code){
	return ResultatRequette("select OBSERVATIONS as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
 }
 function recherche_codetype_dans_concerne_table_rechr($val_code_type){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from concerner where CODE_TYPE_CHAMBRE='$val_code_type'");
}

function recherche_codetype_dans_viser_table_rechr($val_code_type){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from viser where CODE_TYPE_CHAMBRE='$val_code_type'");
}
function recherche_codetype_dans_chambre_table_rechr($val_code_type){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from chambre where CODE_TYPE_CHAMBRE='$val_code_type'");
}
 // fin gestion des type de chambres
 
 
 //DEBUR GESTION DES CHAMBRES 
  function ajout_table_chambre($code_typ,$libelle_chambre){
 $requette="insert into chambre values (null,'$code_typ','$libelle_chambre')";
	ExecuteRequette($requette);	 
 }
  function recupere_table_chambre_libelle($code){
	return ResultatRequette("select LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$code'");
 }
  function Modif_table_chambre($code_chambre,$code_typ,$libelle_chambre){
 $requette="update chambre set CODE_TYPE_CHAMBRE='$code_typ',LIBELLE_CHAMBRE='$libelle_chambre'  where CODE_CHAMBRE=$code_chambre";
 ExecuteRequette($requette);
 }
 function suppression_table_chambre($code_chamb){
 $requette="delete from chambre where CODE_CHAMBRE='$code_chamb'";
	ExecuteRequette($requette);
 }

 //FIN GESTUON DES CHAMBRES


 //GESTION DES ENTREPRISES OU PERSONNE MORALES
function ajout_personne_morale($ident,$NUMERO_INDENTIFIANT,$TYPE_NUMERO_INDENTIFIANT,$RAISON_SOCIALE,$ADRESSE_MORALE,$TELEPHONE_MORALE,$FAX_MORALE,$VILLE_MORALE,$PAYS_MORALE,$EMAIL_MORALE){
 $requette="insert into personne_morale values ('$ident','$NUMERO_INDENTIFIANT','$TYPE_NUMERO_INDENTIFIANT','$RAISON_SOCIALE','$ADRESSE_MORALE','$TELEPHONE_MORALE','$FAX_MORALE','$VILLE_MORALE','$PAYS_MORALE','$EMAIL_MORALE')";
 ExecuteRequette($requette);
 }
 function modif_personne_morale($ID_CLIENT,$NUMERO_INDENTIFIANT,$TYPE_NUMERO_INDENTIFIANT,$RAISON_SOCIALE,$ADRESSE_MORALE,$TELEPHONE_MORALE,$FAX_MORALE,$VILLE_MORALE,$PAYS_MORALE,$EMAIL_MORALE){
 $requette="update personne_morale set NUMERO_INDENTIFIANT='$NUMERO_INDENTIFIANT',TYPE_NUMERO_INDENTIFIANT='$TYPE_NUMERO_INDENTIFIANT',RAISON_SOCIALE='$RAISON_SOCIALE',ADRESSE_MORALE='$ADRESSE_MORALE',TELEPHONE_MORALE='$TELEPHONE_MORALE',FAX_MORALE='$FAX_MORALE',VILLE_MORALE='$VILLE_MORALE',PAYS_MORALE='$PAYS_MORALE',EMAIL_MORALE='$EMAIL_MORALE' where  ID_CLIENT='$ID_CLIENT'";
  ExecuteRequette($requette);
 }
 
 function suppression_personne_morale($ID_CLIENT){
 $requette="delete from personne_morale where ID_CLIENT=$ID_CLIENT";
	ExecuteRequette($requette);
 }
 function recupere_type_identifiant($code){
	return ResultatRequette("select TYPE_NUMERO_INDENTIFIANT as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_raison($code){
	return ResultatRequette("select RAISON_SOCIALE as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_adresse($code){
	return ResultatRequette("select ADRESSE_MORALE as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_telephone($code){
	return ResultatRequette("select TELEPHONE_MORALE as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_fax($code){
	return ResultatRequette("select FAX_MORALE as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_ville($code){
	return ResultatRequette("select VILLE_MORALE as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_pays($code){
	return ResultatRequette("select PAYS_MORALE as info from personne_morale where ID_CLIENT='$code'");
 } 
 function recupere_email($code){
	return ResultatRequette("select EMAIL_MORALE as info from personne_morale where ID_CLIENT='$code'");
 }
 function recupere_identite_moral($code){
	return ResultatRequette("select NUMERO_INDENTIFIANT as info from personne_morale where ID_CLIENT='$code'");
 }
 //FIN GESTION DES ENTREPRSISES OU PERSONNE MORALES

 
 /////////GESTION DES PERSONNES A CHARGES  /////////////////////////////////////
 function ajout_personne_charge($id_cli,$id,$num_charge,$type,$date_deliv,$lieu,$nom,$prenom,$date_nais,$ville_nais,$pays_nais,$nationalite,$pays_r,$ville_r,$adress_cli,$telephone_cli,$email_cli,$profession,$societe,$adresse_soci,$telephone_soci,$fax_soci,$email_soci,$venant,$allant,$nb){
 $requette="insert into personne_a_charge values(null,'$id_cli','$id',$num_charge,'$type','$date_deliv','$lieu','$nom','$prenom','$date_nais','$ville_nais','$pays_nais','$nationalite','$pays_r','$ville_r','$adress_cli','$telephone_cli','$email_cli','$profession','$societe','$adresse_soci','$telephone_soci','$fax_soci','$email_soci','$venant','$allant','$nb')";
  ExecuteRequette($requette);
 }
function modif_personne_a_charge($ID_PERCHARGE,$NUM_IDENT_PERCHARGE,$TYPE_IDENT_PERCHARGE,$NOM_PERCHARGE,$PRENOM_PERCHARGE){
  $requette="update personne_a_charge set NUM_IDENT_PERCHARGE='$NUM_IDENT_PERCHARGE',TYPE_IDENT_PERCHARGE='$TYPE_IDENT_PERCHARGE',NOM_PERCHARGE='$NOM_PERCHARGE',PRENOM_PERCHARGE='$PRENOM_PERCHARGE'  where  ID_PERCHARGE=$ID_PERCHARGE";
  ExecuteRequette($requette);
 }
 function suppression_personne_a_charge($ID_PERCHARGE){
  $requette="delete from personne_a_charge where ID_PERCHARGE=$ID_PERCHARGE";
	ExecuteRequette($requette);
 }
 function recupere_identif_a($code){
 return ResultatRequette("select NUM_IDENT_PERCHARGE as info from personne_a_charge where ID_PERCHARGE=$code");
 }
 function recupere_type_identifiant_a($code){
	return ResultatRequette("select TYPE_IDENT_PERCHARGE as info from personne_a_charge where ID_PERCHARGE=$code");
 }
 function recupere_nom_a($code){
 return ResultatRequette("select NOM_PERCHARGE as info from personne_a_charge where ID_PERCHARGE=$code");
 }
 function  recupere_prenom_a($code){
 return ResultatRequette("select PRENOM_PERCHARGE as info from personne_a_charge where ID_PERCHARGE=$code");
 }
  function recup_type2($code){
  return ResultatRequette("select TYPE_IDENTITE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 
 function recup_date_deliv2($code){
  return ResultatRequette("select DELIVRE_LE as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 function recup_lieu2($code){
  return ResultatRequette("select LIEU_DELIVRANCE as info from personne_a_chargewhere 	ID_PERSONNE_CHARGE=$code");
 }
  function recup_nome2($code){
  return ResultatRequette("select NOM_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 } 

 function recup_prenom2($code){
  return ResultatRequette("select PRENOM_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 } 
 function recup_dat_naiss2($code){
  return ResultatRequette("select DATE_NAISSANCE_CLIENT as  info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
function recup_ville_naiss2($code){
  return ResultatRequette("select VILLE_NAISSANCE_CLIENT as info from personne_a_chargewhere 	ID_PERSONNE_CHARGE=$code");
 }
function recup_pays_naiss2($code){
  return ResultatRequette("select PAYS_NAISSANCE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 function recup_nationalite2($code){
  return ResultatRequette("select NATIONALITE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
  function recup_pays_resid2($code){
  return ResultatRequette("select PAYS_RESIDENCE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 function recup_ville_resid2($code){
  return ResultatRequette("select VILLE_RESIDENCE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
  function recup_adres_cli2($code){
  return ResultatRequette("select ADRESSE_PRIVEE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
   function recup_tel_cli2($code){
  return ResultatRequette("select TELEPHONE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 function recup_email_cli2($code){
  return ResultatRequette("select EMAIL_CLIENT as info from personne_a_charge where	ID_PERSONNE_CHARGE=$code");
 }
  function recup_prefession_cli2($code){
  return ResultatRequette("select PROFESSION_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
   function recup_societ_cli2($code){
  return ResultatRequette("select SOCIETE_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
  function recup_addr_societ2($code){
  return ResultatRequette("select ADRESSE_SOCIETE_TRA_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
   function recup_tel_societ2($code){
  return ResultatRequette("select TELEPHONE_SOCIETE_TRA_CLIENT as info from ppersonne_a_charge where ID_PERSONNE_CHARGE=$code");
 }
    function recup_fax_societ2($code){
  return ResultatRequette("select FAX_SOCIETE_TRA_CLIENT as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
function recup_email_societ2($code){
  return ResultatRequette("select EMAIL_SOCIETE as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 function recup_depart2($code){
  return ResultatRequette("select VENANT_DE as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
  function recup_allant2($code){
  return ResultatRequette("select SE_RENDANT_A as info from personne_a_charge where 	ID_PERSONNE_CHARGE=$code");
 }
 
  function recup_phy_dans_personne_charge_table($id,$nom,$prenom){
 return ResultatRequette("select ID_PERSONNE_CHARGE as info from personne_a_charge where ID_CLIENT='$id' AND NOM_CLIENT='$nom' AND PRENOM_CLIENT='$prenom'");
}
 ////////FIN GESTION DES PERSONNES A CHARGES/////////

 
 //GESTION DE TABLE PRENDRE ENTRE PERSONNE A CHARGE ET PERSONNE PHYSIQUE 
 
 function ajouter_prendre($ID_CLIENT,$ID_PERCHARGE){
  $requette="insert into prendre values('$ID_CLIENT','$ID_PERCHARGE')";
   ExecuteRequette($requette);
 }

 //GESTION DE TABLE PRENDRE ENTRE PERSONNE A CHARGE ET PERSONNE PHYSIQUE 
 
 
   
  //debut gestion de client

 function Modif_client($id,$NUMERO_INDENTIFIANT){
 $requette="update client set NUMERO_INDENTIFIANT='$NUMERO_INDENTIFIANT' where ID_CLIENT=$id";
ExecuteRequette($requette);
 }
 function Supprim_client($id){
 $requette="delete from client where ID_CLIENT=$id";
	ExecuteRequette($requette);
 }
 function recup_identifiant($code){
 return ResultatRequette("select NUMERO_INDENTIFIANT as info from client where ID_CLIENT=$code");
 }
 //fin gestion de client
  
 
//Eregistrement dune reservation
 function Ajout_reservation($ID_CLIENT,$NUMERO,$NOM,$TITRE_RESERVATION,$ETAT_RESERVATION,$OBSERVATION_RESERVATION,$DATE_RESERVATION_CLIENT,$DUREE_RESERVATION_CLIENT,$DATE_ARRIVE,$AUTEUR_RESERVATION){
  $requette="insert into reservation values(null,'$ID_CLIENT','$NUMERO','$NOM','$TITRE_RESERVATION','$ETAT_RESERVATION','$OBSERVATION_RESERVATION','$DATE_RESERVATION_CLIENT','$DUREE_RESERVATION_CLIENT','$DATE_ARRIVE','$AUTEUR_RESERVATION')";
 ExecuteRequette($requette);
 }   
 function modif_reservation($id_reservation,$nom,$titre,$etat,$observation,$date_r,$dure,$date_a,$auteur){
  $requette="update reservation set  NOM='$nom',TITRE_RESERVATION='$titre',ETAT_RESERVATION='$etat',OBSERVATION_RESERVATION='$observation',DATE_RESERVATION_CLIENT='$date_r',DUREE_RESERVATION_CLIENT='$dure',DATE_ARRIVE='$date_a',AUTEUR_RESERVATION='$auteur'  where ID_RESEVATION='$id_reservation'";
  ExecuteRequette($requette);
 }
 function suppression_reservation($id){
 $requette="delete from reservation where ID_RESEVATION='$id'";
  ExecuteRequette($requette);
 }
 function suppression_table_concerne_table($id_reservation_rec){
  $requette="delete from concerner where ID_RESEVATION='$id_reservation_rec'";
  ExecuteRequette($requette);
 }
  function suppression_table_sapplique_table_delect_jeudi($id_reservation_rec){
  $requette="delete from sappliquer where ID_RESEVATION='$id_reservation_rec'";
  ExecuteRequette($requette);
 }
 function recup_numero($code){
  return ResultatRequette("select NUMERO_INDENTIFIANT as info from reservation where ID_RESEVATION=$code");
 }
  function recup_nom($code){
  return ResultatRequette("select NOM as info from reservation where ID_RESEVATION=$code");
 }
  function recup_titre($code){
  return ResultatRequette("select TITRE_RESERVATION as info from reservation where ID_RESEVATION=$code");
 }
  function recup_etat($code){
  return ResultatRequette("select ETAT_RESERVATION as info from reservation where ID_RESEVATION=$code");
 }
   function recup_observation($code){
  return ResultatRequette("select OBSERVATION_RESERVATION as info from reservation where ID_RESEVATION=$code");
 }
 function recup_date_reserv($code){
  return ResultatRequette("select DATE_RESERVATION_CLIENT as info from reservation where ID_RESEVATION=$code");
 }
  function recup_duree($code){
  return ResultatRequette("select DUREE_RESERVATION_CLIENT as info from reservation where ID_RESEVATION=$code");
 }
  function recup_date_arrive($code){
  return ResultatRequette("select DATE_ARRIVE as info from reservation where ID_RESEVATION=$code");
 }
function recup_auteur($code){
return ResultatRequette("select AUTEUR_RESERVATION as info from reservation where ID_RESEVATION=$code");
 }
 //fin enregistremant dune reservation
 
 
 
 
 //GESTION DES CONFIRMATION ANNULATION DES CHAMBRES ET SERVICES//
 function modif_date_confirme_chambresate($confirm,$id_reservation,$date_r){
  $requette="update concerner  set  ETAT_RESERV_CHAM='$confirm' , DATE_CONFIRME='$date_r' where ID_RESEVATION='$id_reservation'";
  ExecuteRequette($requette);
 }
 function modif_date_annul_chambresate($annul,$id_reservation,$date_r){
  $requette="update concerner  set  ETAT_RESERV_CHAM='$annul' , DATE_ANNUL='$date_r' where ID_RESEVATION='$id_reservation'";
  ExecuteRequette($requette);
 }
 function rechercher_recsenalibbatypechabmre_sans_table($value){
return ResultatRequette("select  LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE ='$value'");
}
function rechercher_nomclient_fromreservation_sans_table($nomval){
return ResultatRequette("select  NOM as info from reservation where ID_RESEVATION='$nomval'");
}
function recup_nom_info_pour_confirmation_annulation($code){
return ResultatRequette("select NOM as info from reservation where ID_RESEVATION='$code'");
 }
 function recup_lib_info_pour_confirmation_annulation_service($code){
return ResultatRequette("select TITRE_SERVICE as info from service where CODE_SERVICE='$code'");
 }
  function modif_date_confirme_reserbv_services_etat($id_reservation,$date_r){
  $requette="update sappliquer  set  DATE__CONFIRMATION='$date_r' where ID_RESEVATION='$id_reservation'";
  ExecuteRequette($requette);
 }
  function modif_date_annul_reservlibetat_moi($id_reservation,$date_r){
  $requette="update sappliquer  set  DATE_ANNUL='$date_r' where ID_RESEVATION='$id_reservation'";
  ExecuteRequette($requette);
 }
 //FIN GESTION DES CONFIRMATION ANNULATION DES CHAMBRES ET SERVICES//
 
 
 
 
 //GESTION DE LA TABLE CONCERNE ENTRE RESERVATION ET CHAMBRE
 
function Ajout_concerne($CODE_TYPE_CHAMBRE,$ID_RESEVATION,$DATE_RESERV_CHAM,$DUREE_RESERV_CHAM,$ETAT_RESERV_CHAM,$DATE_CONFIRMATION_CHAM,$DATE_ANNUL){
 $requette="insert into concerner values('$CODE_TYPE_CHAMBRE','$ID_RESEVATION','$DATE_RESERV_CHAM','$DUREE_RESERV_CHAM','$ETAT_RESERV_CHAM','$DATE_CONFIRMATION_CHAM','$DATE_ANNUL')";
 ExecuteRequette($requette);
} 
function recup($num){
 return ResultatRequette("select ID_CLIENT as info from client where NUMERO_INDENTIFIANT='$num'");
}
 function recup_chambre($chambre){
 return ResultatRequette("select LIBELLE_CHAMBRE as info from chambre where CODE_TYPE_CHAMBRE='$chambre'");
}
function recup_code_type($type){
 return ResultatRequette("select CODE_TYPE_CHAMBRE as info from type_chambre where LIBELLE_TYPE_CHAMBRE='$type'");
}
 function recup_reservation($reservation,$date){
 return ResultatRequette("select ID_RESEVATION  as info from reservation where ID_CLIENT='$reservation' AND DATE_RESERVATION_CLIENT='$date'");  
 }
 //FIN GESTION DE LA TABLE CONCERNE ENTRE RESERVATION ET CHAMBRE
  
  //GESTIOND DES RESERVATION DE SERVICES dans table s'applique
function ajout_reservation_du_service_cli($id_service,$id_reservation_serv,$date_reserv_serv,$duree_reserv_serv,$etat_reserv_serv,$date_conf,$date_annul){
$requette="insert into sappliquer values('$id_service','$id_reservation_serv','$date_reserv_serv','$duree_reserv_serv','$etat_reserv_serv','$date_conf','$date_annul')";
  ExecuteRequette($requette);
}
function recuperation_ide_client_du_reference_reserve_table($value_idclient){
return ResultatRequette("select ID_CLIENT as info from reservation where ID_RESEVATION='$value_idclient'");
} 
 function suppression_table_sapplique_table($id_reservation_rec){
  $requette="delete from sappliquer where ID_RESEVATION='$id_reservation_rec'";
  ExecuteRequette($requette);
 }
function modification_reservation_service_table(){

}
function retour_nomprenom_sortietable_reservation($idpers){
return ResultatRequette("select NOM as info from reservation where ID_RESEVATION='$idpers'");
}
  //FIN GESTION DES RESERVATION DE SERVICE table s'applique
  
 /////////GESTION DES CLIENTS UNIQUE OU PARRAIN////////////////
 function recup_phy_dans_personne_table($id,$nom,$prenom){
 return ResultatRequette("select ID_PERSONNE as info from personne_physique where ID_CLIENT='$id' AND NOM_CLIENT='$nom' AND PRENOM_CLIENT='$prenom'");
}
 
  function recup_phy($num){
 return ResultatRequette("select ID_CLIENT as info from client where NUMERO_INDENTIFIANT='$num'");
}
  function Ajout_client($NUMERO){
 $requette="insert into client values(null,'$NUMERO')";
 	ExecuteRequette($requette);
 }
 function recup_val_code_etat($chaine){
     return ResultatRequette("select CODE_ETAT_CHAMBRE as info from etat_chambre where LIBELLE_ETAT_CHAMBRE='$chaine'");
}
 function ajout_personne_physique($id_cli,$id,$type,$date_deliv,$lieu,$nom,$prenom,$date_nais,$ville_nais,$pays_nais,$nationalite,$pays_r,$ville_r,$adress_cli,$telephone_cli,$email_cli,$profession,$societe,$adresse_soci,$telephone_soci,$fax_soci,$email_soci,$venant,$allant,$nb){
 $requette="insert into personne_physique values(null,'$id_cli','$id','$type','$date_deliv','$lieu','$nom','$prenom','$date_nais','$ville_nais','$pays_nais','$nationalite','$pays_r','$ville_r','$adress_cli','$telephone_cli','$email_cli','$profession','$societe','$adresse_soci','$telephone_soci','$fax_soci','$email_soci','$venant','$allant','$nb')";
  ExecuteRequette($requette);
 }
 function Modifer_personne_physique($id_cli,$id,$type,$date_deliv,$lieu,$nom,$prenom,$date_nais,$ville_nais,$pays_nais,$nationalite,$pays_r,$ville_r,$adress_cli,$telephone_cli,$email_cli,$profession,$societe,$adresse_soci,$telephone_soci,$fax_soci,$email_soci,$venant,$allant,$nb){
 $requette="update personne_physique set  NUMERO_INDENTIFIANT='$id',TYPE_IDENTITE_CLIENT='$type',DELIVRE_LE='$date_deliv',LIEU_DELIVRANCE='$lieu',NOM_CLIENT='$nom',PRENOM_CLIENT='$prenom',DATE_NAISSANCE_CLIENT='$date_nais',VILLE_NAISSANCE_CLIENT='$ville_nais',PAYS_NAISSANCE_CLIENT='$pays_nais',NATIONALITE_CLIENT='$nationalite',PAYS_RESIDENCE_CLIENT='$pays_r',VILLE_RESIDENCE_CLIENT='$ville_r',ADRESSE_PRIVEE_CLIENT='$adress_cli',TELEPHONE_CLIENT='$telephone_cli',EMAIL_CLIENT='$email_cli',PROFESSION_CLIENT='$profession',SOCIETE_CLIENT='$societe',ADRESSE_SOCIETE_TRA_CLIENT='$adresse_soci',TELEPHONE_SOCIETE_TRA_CLIENT='$telephone_soci',FAX_SOCIETE_TRA_CLIENT='$fax_soci',EMAIL_SOCIETE='$email_soci',VENANT_DE='$venant',SE_RENDANT_A='$allant',SEX='$nb' where ID_PERSONNE=$id_cli";
  ExecuteRequette($requette);
 }
  function suppression_consigne_personne_table($idconsigne,$id){
  $requette="delete from consigne where ID_CONSIGNE='$idconsigne' AND ID_PERSONNE='$id'";
  ExecuteRequette($requette);
 }
 function suppression_occupation_personne_table($chambre,$id){
  $requette="delete from occuper where CODE_CHAMBRE='$chambre' AND ID_PERSONNE='$id'";
  ExecuteRequette($requette);
 }
  function suppression_recevoir_personne_table($idpers,$idvisit){
  $requette="delete from recevoir where ID_PERSONNE='$idpers' AND ID_VISITEUR='$idvisit'";
  ExecuteRequette($requette);
 }
 function Suppression_personne_physique($id){
  $requette="delete from personne_physique where ID_PERSONNE=$id";
  ExecuteRequette($requette);
 }
 function recup_type($code){
  return ResultatRequette("select TYPE_IDENTITE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 } 
  function recup_date_deliv($code){
  return ResultatRequette("select DELIVRE_LE as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_identifiant_fiche_deliv($code){
  return ResultatRequette("select NUMERO_INDENTIFIANT as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_typeidentifiant_fiche_deliv($code){
  return ResultatRequette("select TYPE_IDENTITE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_lieu($code){
  return ResultatRequette("select LIEU_DELIVRANCE as info from personne_physique where 	ID_PERSONNE=$code");
 }
  function recup_nome($code){
  return ResultatRequette("select NOM_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 } 

 function recup_prenom($code){
  return ResultatRequette("select PRENOM_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 } 
 function recup_dat_naiss($code){
  return ResultatRequette("select DATE_NAISSANCE_CLIENT as  info from personne_physique where 	ID_PERSONNE=$code");
 }
function recup_ville_naiss($code){
  return ResultatRequette("select VILLE_NAISSANCE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
function recup_pays_naiss($code){
  return ResultatRequette("select PAYS_NAISSANCE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_nationalite($code){
  return ResultatRequette("select NATIONALITE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
  function recup_pays_resid($code){
  return ResultatRequette("select PAYS_RESIDENCE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_ville_resid($code){
  return ResultatRequette("select VILLE_RESIDENCE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
  function recup_adres_cli($code){
  return ResultatRequette("select ADRESSE_PRIVEE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
   function recup_tel_cli($code){
  return ResultatRequette("select TELEPHONE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_email_cli($code){
  return ResultatRequette("select EMAIL_CLIENT as info from personne_physique where	ID_PERSONNE=$code");
 }
  function recup_prefession_cli($code){
  return ResultatRequette("select PROFESSION_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
   function recup_societ_cli($code){
  return ResultatRequette("select SOCIETE_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
  function recup_addr_societ($code){
  return ResultatRequette("select ADRESSE_SOCIETE_TRA_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
   function recup_tel_societ($code){
  return ResultatRequette("select TELEPHONE_SOCIETE_TRA_CLIENT as info from personne_physique where ID_PERSONNE=$code");
 }
    function recup_fax_societ($code){
  return ResultatRequette("select FAX_SOCIETE_TRA_CLIENT as info from personne_physique where 	ID_PERSONNE=$code");
 }
function recup_email_societ($code){
  return ResultatRequette("select EMAIL_SOCIETE as info from personne_physique where 	ID_PERSONNE=$code");
 }
 function recup_depart($code){
  return ResultatRequette("select VENANT_DE as info from personne_physique where 	ID_PERSONNE=$code");
 }
  function recup_allant($code){
  return ResultatRequette("select SE_RENDANT_A as info from personne_physique where 	ID_PERSONNE=$code");
 }
  function recup_nb($code){
  return ResultatRequette("select NOMBRE_PERSONNE as info from personne_physique where 	ID_PERSONNE=$code");
 }
 ////////////FIN GESTION DES CLIENT UNIQUES OU PARRAINS//////////////

 
 
//GESTION DES OCCUPATION OU DES LOGEMENT DES CLIENT/////////
  function Ajout_occupation($doce_cham,$cod_cli,$date_ent,$heure_ent,$date_sort,$hueure_sort,$duree){
 $requette="insert into occuper values('$doce_cham','$cod_cli','$date_ent','$heure_ent','$date_sort','$hueure_sort','$duree')";
	ExecuteRequette($requette);	 
}
  function Ajout_logement_charge($doce_cham,$cod_cli,$date_ent,$heure_ent,$date_sort,$hueure_sort,$duree){
 $requette="insert into loger values('$doce_cham','$cod_cli','$date_ent','$heure_ent','$date_sort','$hueure_sort','$duree')";
	ExecuteRequette($requette);	 
}
function sortieclient_dechambre_table($idpersonne,$datesort,$heuresort,$duree){
 $requette="update occuper set  DATE_SORTIE='$datesort',HEURE_SORTIE='$heuresort',DUREE_OCCUPATION='$duree' where ID_OCCUPATION='$idpersonne'";
ExecuteRequette($requette);
}
 function recup_code_chambre($libelle){
 return ResultatRequette("select CODE_CHAMBRE  as info from chambre where LIBELLE_CHAMBRE='$libelle'");  
 }
function assisgner_chambre_client_tableoccuper($doce_cham,$cod_cli,$date_ent,$heure_ent,$date_sort,$hueure_sort,$duree,$parrain,$nbpersonne){
$requette="insert into occuper values(null,'$doce_cham','$cod_cli','$date_ent','$heure_ent','$date_sort','$hueure_sort','$duree','$parrain','$nbpersonne')";
	ExecuteRequette($requette);	
}
function retour_date_debuttable($date1){
return ResultatRequette("select DATE_ENTREE as info from occuper where ID_OCCUPATION='$date1'");
}
function retour_date_sortietable($date2){
return ResultatRequette("select DATE_SORTIE as info from occuper where ID_OCCUPATION='$date2'");
}
function retour_heure_entrereetable($date2){
return ResultatRequette("select HEURE_ENTREE as info from occuper where ID_OCCUPATION='$date2'");
}
function retour_heure_sortietable($date2){
return ResultatRequette("select HEURE_SORTIE as info from occuper where ID_OCCUPATION='$date2'");
}

function retour_heure_sortietabledes($date2){
return ResultatRequette("select CODE_CHAMBRE as info from occuper where ID_OCCUPATION='$date2'");
}


function retour_heure_sortietable_date($date2){
return ResultatRequette("select max(DATE_ENTREE) as info from occuper where ID_PERSONNE='$date2'");
}
function retour_nombreperfiche($date2){
return ResultatRequette("select NB_PERSONNE as info from occuper where ID_OCCUPATION='$date2'");
}



function retour_chambre_sortietable($date2){
return ResultatRequette("select CODE_CHAMBRE as info from occuper where DATE_ENTREE='$date2'");
}
function retour_chambre_sortietable1($date2){
return ResultatRequette("select CODE_CHAMBRE as info from occuper where ID_OCCUPATION='$date2'");
}
function retour_val_idpersonne_id_sortietable($date2){
return ResultatRequette("select ID_PERSONNE  as info from occuper where ID_OCCUPATION='$date2'");
}
function retour_val_idpersonne_id_max_date($date2){
return ResultatRequette("select max(DATE_ENTREE)  as info from occuper where ID_PERSONNE='$date2'");
}
function retour_val_idpersonne_id_max_date1($date2){
return ResultatRequette("select DATE_ENTREE  as info from occuper where ID_OCCUPATION='$date2'");
}
function retour_nomprenom_sortietable($idpers){
return ResultatRequette("select concat(NOM_CLIENT,'  ',PRENOM_CLIENT) as info from personne_physique where ID_PERSONNE='$idpers'");
}
function retour_annuite_fiche1($idpers){
return ResultatRequette("select DUREE_OCCUPATION  as info from occuper where ID_OCCUPATION='$idpers'");
}
 ///GESTION DES OCCUPATION OU DES LOGEMENT DES CLIENT///
 
 
 //GESTION DE LA FICHE DE POLICE///
function retour_idpersonne_chambre_fiche($id){
return ResultatRequette("select ID_PERSONNE  as info from occuper where ID_OCCUPATION='$id'");
}
function retour_date_arrivee_fiche($idpers,$code_chambre){
return ResultatRequette("select DATE_ENTREE  as info from occuper where ID_OCCUPATION='$idpers' AND CODE_CHAMBRE='$code_chambre'");
} 
function retour_date_depart_fiche($idpers,$code_chambre){
return ResultatRequette("select DATE_SORTIE as info from occuper where ID_OCCUPATION='$idpers' AND CODE_CHAMBRE='$code_chambre'");
}
 function retour_annuite_fiche($idpers,$code_chambre){
return ResultatRequette("select DUREE_OCCUPATION  as info from occuper where ID_OCCUPATION='$idpers' AND CODE_CHAMBRE='$code_chambre'");
}
function retour_libelle_chambre_fiche($CODE_CHAMBRE){
return ResultatRequette("select LIBELLE_CHAMBRE  as info from chambre where CODE_CHAMBRE='$CODE_CHAMBRE'");
}
/**je recherche le code type de chambre*/
function retour_type_chambre_fiche($CODE_CHAMBRE){
return ResultatRequette("select CODE_TYPE_CHAMBRE  as info from chambre where CODE_CHAMBRE='$CODE_CHAMBRE'");
}
/**je recherche le libelle type de chambre*/
function retour_libebe_type_chambre_fiche($CODE_TYPE_CHAMBRE){
return ResultatRequette("select LIBELLE_TYPE_CHAMBRE  as info from type_chambre where CODE_TYPE_CHAMBRE='$CODE_TYPE_CHAMBRE'");
}
/**je recherche le libelle type de chambre*/
function retour_montant_type_chambre_fiche($CODE_TYPE_CHAMBRE){
return ResultatRequette("select MONTANT_TARIF_TYPECHAMBRE  as info from viser where CODE_TYPE_CHAMBRE='$CODE_TYPE_CHAMBRE'");
}
 ///FIN GESTION DE LA FICHE DE POLICE///
 function retour_date_arriveeprevu_fiche_reserv_chambre($ID_RESEVATION){
return ResultatRequette("select DATE_ARRIVE  as info from reservation where ID_RESEVATION='$ID_RESEVATION'");
}
 function retour_duree_arriveeprevu_fiche_reserv_chambre($ID_RESEVATION){
return ResultatRequette("select DUREE_RESERVATION_CLIENT as info from reservation where ID_RESEVATION='$ID_RESEVATION'");
}
function retour_type_chambre_fiche_reserv_chambre($ID_RESEVATION){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from concerner where ID_RESEVATION='$ID_RESEVATION'");
}
 function retour_etat_reserv_fiche_reserv_chambre($ID_RESEVATION){
return ResultatRequette("select ETAT_RESERV_CHAM as info from concerner where ID_RESEVATION='$ID_RESEVATION'");
}
 function retour_etat_reserv_fiche_reserv_services($ID_RESEVATION){
return ResultatRequette("select ETAT_RESERV_SERV  as info from sappliquer where ID_RESEVATION='$ID_RESEVATION'");
}
 // GESTION DE LA FICHE DE RESERVATION DES CHAMBRE//
 
 
 //GESTION DE LA FICHE DE RESERVATION DES SERVICES//
function retour_id_services_fiche_reserv_service($ID_RESEVATION){
return ResultatRequette("select TITRE_RESERVATION 	as info from reservation where ID_RESEVATION='$ID_RESEVATION'");
}
function retour_montant_fiche_valeur_reserv_service($CODE_SERVICE ){
return ResultatRequette("select MONTANT_TARIF_SERV 	as info from dependre where CODE_SERVICE='$CODE_SERVICE'");
}
 //FIN GESTION DE LA FICHE DE RESERVATION DES SERVICES//
 
 
 //FIN GESTION DE LA FICHE DE RESERVATION DES CHAMBRES//

 
 ///GESTION DES OCCUPATION DES SERVICES///
 function Ajout_utilservice_client_uniq($doce_cli,$cod_serv,$date_debut,$date_fin,$duree,$observation){
 $requette="insert into utiliser values('$doce_cli','$cod_serv','$date_debut','$date_fin','$duree','$observation')";
	ExecuteRequette($requette);	 
}
function retour_service_sortietablepopup($code){
return ResultatRequette("select LIBELLE_SERVICE  as info from type_service where CODE_TYPE_SERVICE='$code'");
}
 function retour_service_pouruser($code){
return ResultatRequette("select TITRE_SERVICE   as info from service where CODE_SERVICE='$code'");
}
function retour_idservice_pouruser($code){
return ResultatRequette("select CODE_SERVICE    as info from service where TITRE_SERVICE='$code'");
}
/*function sortieservice_service_table($idpersonne,$codeserv,$dateuser,$datefin,$duree){
 $requette="update utiliser set  CODE_SERVICE='$codeserv',DATE_UTILISATION='$dateuser' DATE_FIN='$datefin' DUREE_UTILISATION='$duree' 	where ID_CLIENT='$idpersonne'";
ExecuteRequette($requette);
}*/
function sortieservice_service_table($idpersonne,$datefin,$duree){
 $requette="update utiliser set  DATE_FIN='$datefin',DUREE_UTILISATION='$duree' where ID_CLIENT='$idpersonne'";
ExecuteRequette($requette);
}
function rechercher_dateservice_sorti($code){
return ResultatRequette("select DATE_UTILISATION  as info from utiliser where ID_CLIENT='$code'");
}
function rechercher_codeseeraffiche_sorti($code){
return ResultatRequette("select CODE_SERVICE  as info from utiliser where ID_CLIENT='$code'");
}
function rechercher_datesuseraffiche_sorti($code){
return ResultatRequette("select DATE_UTILISATION  as info from utiliser where ID_CLIENT='$code'");
}
function rechercher_datesuseraffiche_sorti_finuser($code){
return ResultatRequette("select DATE_FIN  as info from utiliser where ID_CLIENT='$code'");
}
function rechercher_dlibservre_sorti_finuser($code){
return ResultatRequette("select TITRE_SERVICE   as info from service where CODE_SERVICE='$code'");
}
function rechercher_datat_sorti_finuser($code){
return ResultatRequette("select LIBELLE   as info from etat_service where ID_ETAT_SERVICE='$code'");
}
function rechercher_libformulaire_sorti_finuser($code){
return ResultatRequette("select TITRE_SERVICE   as info from service  where CODE_SERVICE='$code'");
}
function rechercher_libformulaire_sorti_lietatserv($code){
return ResultatRequette("select LIBELLE   as info from etat_service where ID_ETAT_SERVICE='$code'");
}
function rechercher_libcode_sorti_lietatserv($libelle){
return ResultatRequette("select ID_ETAT_SERVICE  as info from etat_service where LIBELLE='$libelle'");
}
function modifier_etatservice_service_modif($CODE_SERVICE,$ID_ETAT_SERVICE,$DATE_CHANGEMENT_ETAT){
 $requette="update possede_1 set ID_ETAT_SERVICE='$ID_ETAT_SERVICE',DATE_CHANGEMENT_ETAT='$DATE_CHANGEMENT_ETAT' where CODE_SERVICE='$CODE_SERVICE'";
	ExecuteRequette($requette);
}
function rechercher_libetat_asntable($valueserve){
return ResultatRequette("select ID_ETAT_SERVICE as info from possede_1 where CODE_SERVICE='$valueserve'");
}
 ///FIN GESTIOIN OCCUPATION SERVICE////
 
 //gestion des des tarifications DES CHAMBRES
 
function ajout_id_tarification($val_id){
$requette="insert into tarification values ('$val_id')";
	ExecuteRequette($requette);
}
function retour_typeservice_sortipopup($code){
return ResultatRequette("select LIBELLE_SERVICE  as info from type_service where CODE_TYPE_SERVICE ='$code'");
}

function Ajout_tarification_chambre_viser($id_tarif,$code_chamb,$montant,$date_debut_tari,$date_fin_tarif){
$requette="insert into viser values ('$id_tarif','$code_chamb','$montant','$date_debut_tari','$date_fin_tarif')";
	ExecuteRequette($requette);	 
}
function modifier_tarification_chambre_table($id_tarif,$code_chamb,$montant,$date_debut_tari,$date_fin_tarif){
 $requette="update viser set  MONTANT_TARIF_TYPECHAMBRE='$montant',DATE_DEBUT_TARIF_TYPECHAMBRE='$date_debut_tari',DATE_FIN_TARIF_TYPECHAMBRE='$date_fin_tarif' where CODE_TARIFICATION='$id_tarif' AND CODE_TYPE_CHAMBRE='$code_chamb'";
ExecuteRequette($requette);
}
function suppression_tarification_chambre($code){
 $requette="delete from viser where CODE_TARIFICATION='$code'";
  ExecuteRequette($requette);
}
function max_valeur_tarification($val_max){
return ResultatRequette("select max(CODE_TARIFICATION) as info from tarification");
}
 function Recup_code_type_chambre_tarification($code_tarif_type) {
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from type_chambre where LIBELLE_TYPE_CHAMBRE='$code_tarif_type'");}

function Recup_code_type_chambre_tarification1($code_tarif) {
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from viser where CODE_TARIFICATION='$code_tarif'");}

function recup_montant_tarification_table($code){
return ResultatRequette("select MONTANT_TARIF_TYPECHAMBRE as info from viser  where CODE_TARIFICATION='$code'");
}
function recup_date_debut_tarification_table($code){
return ResultatRequette("select DATE_DEBUT_TARIF_TYPECHAMBRE as info from viser where CODE_TARIFICATION='$code'");
}
function recup_date_fin_tarification_table($code){
return ResultatRequette("select DATE_FIN_TARIF_TYPECHAMBRE as info from viser where CODE_TARIFICATION='$code'");
}
function retourne_val_code_type_chambre_dans_concerner($code_type_cham){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from concerner where CODE_TARIFICATION='$code_type_cham'");
}
function retourne_val_code_type_chambre_id_tarif_table($code_type_cham){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from viser where CODE_TARIFICATION='$code_type_cham'");
}
function recherche_si_id_exist_table($recherche){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from chambre");
}
 function retourn_val_code_type_chambre_table($code_type_cham){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from viser where CODE_TARIFICATION='$code_type_cham'");
}
 //fin gestion des tarifications DES CHAMBRES
 
 
 
 
 //DEBUT TARIFICATION DES SERVICES
 
 function ajout_tarification_service($id_tarif,$code_service,$montant,$date_debut_tari,$date_fin_tarif){
 $requette="insert into dependre values ('$id_tarif','$code_service','$montant','$date_debut_tari','$date_fin_tarif')";
	ExecuteRequette($requette);	
 }
  function recup_code_du_service($code_du_service){
return ResultatRequette("select CODE_SERVICE as info from service where TITRE_SERVICE='$code_du_service'");
}
  function recup_code_du_service11($codeservice){
return ResultatRequette("select CODE_SERVICE as info from dependre where CODE_TARIFICATION='$codeservice'");
}

function recup_montant_tarification_table_serv($code){
return ResultatRequette("select MONTANT_TARIF_SERV 	as info from dependre  where CODE_TARIFICATION='$code'");
}
function recup_date_debut_tarification_table_serv($code){
return ResultatRequette("select DATE_DEBUT_TARIF_SERV as info from dependre where CODE_TARIFICATION='$code'");
}
function recup_date_fin_tarification_table_serv($code){
return ResultatRequette("select DATE_FIN_TARIF_SERV as info from dependre where CODE_TARIFICATION='$code'");
}
function suppression_tarification_service_tab($code){
 $requette="delete from dependre where CODE_TARIFICATION=$code";
  ExecuteRequette($requette);
}
function modif_tarif_service_tabl($code_service,$id_tarif,$montant,$date_debut_tari,$date_fin_tarif){
 $requette="update dependre set  MONTANT_TARIF_SERV='$montant',DATE_DEBUT_TARIF_SERV='$date_debut_tari',DATE_FIN_TARIF_SERV='$date_fin_tarif' where CODE_SERVICE='$code_service' AND CODE_TARIFICATION='$id_tarif'";
ExecuteRequette($requette);
}
function  verif_si_service_utilise_en_reservation_table($id_service){
return ResultatRequette("select CODE_SERVICE  as info from  sappliquer where CODE_SERVICE='$id_service'");
}
function  recup_id_code_service_val_id_tarification_table($id_tarification){
return ResultatRequette("select CODE_SERVICE  as info from  dependre where CODE_TARIFICATION='$id_tarification'");
}
 //FIN TARIFICATION DES SERVICES
 
 
 
//GESTION DES enregistrements desETAT DE CHAMBRE
function ajout_etat_chambre_add($libelle,$description,$couleur_associee){
 $requette="insert into etat_chambre values(null,'$libelle','$description','$couleur_associee')";
	ExecuteRequette($requette);	
}
function modifier_etat_chambre($id,$libe,$descrip,$couleur_associee){
   $requette="update etat_chambre set LIBELLE_ETAT_CHAMBRE='$libe',OBSERVATION_ETAT_CHAMBRE='$descrip', COULEUR_ASSOCIE='$couleur_associee' where CODE_ETAT_CHAMBRE='$id'";
 ExecuteRequette($requette);
 }
function supresion_etat_chambre($id_etat){
 $requette="delete from etat_chambre where CODE_ETAT_CHAMBRE=$id_etat";
	ExecuteRequette($requette);
}
function recup_lib_etat_chamrtr($val){
return ResultatRequette("select LIBELLE_ETAT_CHAMBRE as info from etat_chambre where CODE_ETAT_CHAMBRE='$val'");
 }
 function recup_descrip_etat_chambr($codeetat){
return ResultatRequette("select OBSERVATION_ETAT_CHAMBRE as info from etat_chambre where CODE_ETAT_CHAMBRE='$codeetat'");
 }
 
 function recup_couleur_associee_etat_chambre($code){
return ResultatRequette("select COULEUR_ASSOCIE as info from etat_chambre where CODE_ETAT_CHAMBRE='$code'");
 }
 
//GESTION DES enregistrements desETAT DE CHAMBRE

//gestion des assignations des etats a des chambres//
function modifier_etat_assignation_chambre_lundibut($code,$chambre,$etat,$dated,$datefin,$observations){
   $requette="update avoir set CODE_CHAMBRE='$chambre',	CODE_ETAT_CHAMBRE='$etat',DATE_CHANGEMENT_ETAT='$dated',DATE_FIN_ETAT='$datefin', 
   OBSERVATION_ETAT_CHAMBRE='$observations' where CODE_AVOIR='$code'";
   ExecuteRequette($requette);
 }
 function rechercher_titre_libell_etatchambre_lunditable_table($valueserve){
return ResultatRequette("select  LIBELLE_ETAT_CHAMBRE as info from etat_chambre where CODE_ETAT_CHAMBRE='$valueserve'");
}
 function rechercher_codeetat_for_assignationtable($valueserve){
return ResultatRequette("select  CODE_ETAT_CHAMBRE as info from etat_chambre where LIBELLE_ETAT_CHAMBRE='$valueserve'");
}
function rechercher_libetat_for_assignationtable($valueserve){
return ResultatRequette("select  CODE_ETAT_CHAMBRE as info from avoir where CODE_CHAMBRE='$valueserve'");
}
function rechercher_lnationtable($valueserve){
return ResultatRequette("select  CODE_ETAT_CHAMBRE as info from avoir where CODE_AVOIR='$valueserve'");
}
function rechercher_letat_assignationtable($valueserve){
return ResultatRequette("select  CODE_ETAT_CHAMBRE as info from avoir where CODE_AVOIR='$valueserve'");
}
function rechercher_letat_adatebeging($valueserve){
return ResultatRequette("select  DATE_CHANGEMENT_ETAT as info from avoir where CODE_AVOIR='$valueserve'");
}
function rechercher_letat_adateend($valueserve){
return ResultatRequette("select  DATE_FIN_ETAT as info from avoir where CODE_AVOIR='$valueserve'");
}
function rechercher_letat_adateobservations($valueserve){
return ResultatRequette("select  OBSERVATION_ETAT_CHAMBRE as info from avoir where CODE_AVOIR='$valueserve'");
}
//fin gestion des assignations des etats a des chambres//



//debut gestion avoir des chambres etat chambre

function ajout_avoir_occupation_chambre($code_chamb,$code_etat,$date_ent,$datefi,$ob){
 $requette="insert into avoir values(null,'$code_chamb','$code_etat','$date_ent','$datefi','$ob')";
	ExecuteRequette($requette);	
}
function rechercher_libetatforavoir($valueserve){
return ResultatRequette("select  CODE_CHAMBRE as info from chambre where LIBELLE_CHAMBRE='$valueserve'");
}
function rechercher_datemaxtariftypechambre(){
return ResultatRequette("select  max(DATE_FIN_TARIF_TYPECHAMBRE) as info from viser");
}
function rechercher_datemaxcodeavoir($chambred){
return ResultatRequette("select  max(CODE_AVOIR) as info from avoir where CODE_CHAMBRE='$chambred'");
}
//fin gestion affectation etat chambre


// Début GESTION DU TYPE DE SERVICE
function recup_id_type_Service($val_id_typ){
return ResultatRequette("select CODE_TYPE_SERVICE as info from type_service where LIBELLE_SERVICE='$val_id_typ'");
}

function ajout_type_service($libelle_type_service){
 $requette="insert into type_service values(null,'$libelle_type_service')";
	ExecuteRequette($requette);
}
function modifier_type_service_modif($CODE_TYPE_SERVICE,$LIBELLE_SERVICE){
 $requette="update type_service set LIBELLE_SERVICE='$LIBELLE_SERVICE' where CODE_TYPE_SERVICE=$CODE_TYPE_SERVICE";
	ExecuteRequette($requette);
}
 function recup_lib_type_service($id_type_sevice){
	return ResultatRequette("select LIBELLE_SERVICE as info from type_service where CODE_TYPE_SERVICE='$id_type_sevice'");
 }
 function suppression_type_service($id_type_sevice){
 $requette="delete from type_service where CODE_TYPE_SERVICE=$id_type_sevice";
	ExecuteRequette($requette);
 }
//FIN GESTION DU TYPE DE SERVICE


// Débutgestion des sevices
 function recup_id_de_mon_type_service($code_de_type_service){
return ResultatRequette("select CODE_TYPE_SERVICE as info from type_service where LIBELLE_SERVICE='$code_de_type_service'");
}
function ajout_service_tab($CODE_TYPE_SERVICE,$TITRE_SERVICE){
 $requette="insert into service values(null,'$CODE_TYPE_SERVICE','$TITRE_SERVICE')";
 ExecuteRequette($requette);
}
function Modification_service_fft($code,$code_type,$TITRE){
 $requette="update service set CODE_TYPE_SERVICE='$code_type',TITRE_SERVICE='$TITRE'  where CODE_SERVICE='$code'";
  ExecuteRequette($requette);
}

function suppression_service($CODE_SERVICE){
 $requette="delete from service where CODE_SERVICE=$CODE_SERVICE"; 
ExecuteRequette($requette);
	
 }

function recup_val_type($vale_code_serv){
return ResultatRequette("select TITRE_SERVICE as info from service where CODE_SERVICE='$vale_code_serv'");
}
function recup_lib_type_Service_lib_affich($val_id_typ){
return ResultatRequette("select LIBELLE_SERVICE as info from type_service where CODE_TYPE_SERVICE='$val_id_typ'");
}
function recup_lib_servicessamedi_joint($val_id_typ){
return ResultatRequette("select TITRE_SERVICE as info from service where CODE_SERVICE='$val_id_typ'");
}
function recup_typeservice_servicessamedi_joint($val_id_typ){
return ResultatRequette("select LIBELLE_SERVICE as info from type_service where CODE_TYPE_SERVICE='$val_id_typ'");
}
//fin gestion des services


//GESTION DES VISITEURS
 function recup_id_responsable__personne_visite($nom,$prenom){
 return ResultatRequette("select ID_CLIENT as info from personne_physique where NOM_CLIENT='$nom' AND PRENOM_CLIENT='$prenom'");
}
function recup_id_venant_visiter($nomp,$prenomp){
 return ResultatRequette("select ID_VISITEUR as info from visiteur where NOM_VISITEUR='$nomp' AND PRENOM_VISITEUR='$prenomp'");
}
function ajout_visiteur($NOM_VISITEUR,$PRENOM_VISITEUR,$NUM_IDENTITE_VISITEUR,$TYPE_IDENTITE){
 $requette="insert into visiteur values(null,'$NOM_VISITEUR','$PRENOM_VISITEUR','$NUM_IDENTITE_VISITEUR','$TYPE_IDENTITE')";
 ExecuteRequette($requette);
}
function ajout_table_recevoir($ID_CLIENT,$ID_VISITEUR,$DATE_ENTREE_VISITEUR,$HEURE_ENTREE_VISITEUR,$DATE_SORTIE_VISITEUR,$HEURE_SORTIE_VISITEUR){
 $requette="insert into recevoir values('$ID_CLIENT','$ID_VISITEUR','$DATE_ENTREE_VISITEUR','$HEURE_ENTREE_VISITEUR','$DATE_SORTIE_VISITEUR','$HEURE_SORTIE_VISITEUR')";
 ExecuteRequette($requette);
}
function suppression_visiteur($ID_VISITEUR){
$requette="delete from visiteur where ID_VISITEUR='$ID_VISITEUR'";
ExecuteRequette($requette);
}
function modif_visiteur($ID_VISITEUR,$NOM_VISITEUR,$PRENOM_VISITEUR,$NUM_IDENTITE_VISITEUR,$TYPE_IDENTITE){
$requette="update visiteur set NOM_VISITEUR='$NOM_VISITEUR',PRENOM_VISITEUR='$PRENOM_VISITEUR',NUM_IDENTITE_VISITEUR='$NUM_IDENTITE_VISITEUR',TYPE_IDENTITE='$TYPE_IDENTITE'  where ID_VISITEUR='$ID_VISITEUR' ";
 ExecuteRequette($requette);
}
function modif_visiteur_table_recevoir($ID_VISITEUR,$DATE_SORTIE_VISITEUR,$HEURE_SORTIE_VISITEUR){
$requette="update recevoir set DATE_SORTIE_VISITEUR='$DATE_SORTIE_VISITEUR',HEURE_SORTIE_VISITEUR='$HEURE_SORTIE_VISITEUR'  where  ID_VISITEUR='$ID_VISITEUR' ";
ExecuteRequette($requette);
}
function recup_nom_visiteur_table($code){
return ResultatRequette("select NOM_VISITEUR as info from visiteur where ID_VISITEUR='$code'");
}
function recup_prenom_visiteur_table($code){
return ResultatRequette("select PRENOM_VISITEUR as info from visiteur where ID_VISITEUR='$code'");
}
function recup_num_ident_visiteur_table($code){
return ResultatRequette("select NUM_IDENTITE_VISITEUR as info from visiteur where ID_VISITEUR='$code'");
}
function recup_type_identite_visiteur_table($code){
return ResultatRequette("select TYPE_IDENTITE as info from visiteur where ID_VISITEUR='$code'");
}
function recup_date_ent_table_recevoir($code){
return ResultatRequette("select DATE_ENTREE_VISITEUR as info from recevoir where ID_VISITEUR='$code'");
}
function recup_heure_ent_table_recevoir($code){
return ResultatRequette("select HEURE_ENTREE_VISITEUR as info from recevoir where ID_VISITEUR='$code'");
}
function recup_date_sort_table_recevoir($code){
return ResultatRequette("select DATE_SORTIE_VISITEUR as info from recevoir where ID_VISITEUR='$code'");
}
function recup_heure_sort_table_recevoir($code){
return ResultatRequette("select HEURE_SORTIE_VISITEUR as info from recevoir where ID_VISITEUR='$code'");
}

function recupere_nom_prenom_client_dans_liste_client_visite($code){
return ResultatRequette("SELECT CONCAT(NOM_CLIENT,' ',PRENOM_CLIENT) AS info FROM personne_physique WHERE ID_CLIENT='$code'");
}

function recupere_nom_prenom_visiteur_dans_liste_visiteur_client($code){
return ResultatRequette("SELECT CONCAT(NOM_VISITEUR,' ',PRENOM_VISITEUR) AS info FROM visiteur WHERE ID_VISITEUR='$code'");
}

//FIN GESTION DES VISITEURS

// Début gestion table visite
function recupere_affiche_visiteur($code){
return ResultatRequette("SELECT CONCAT(NOM_VISITEUR,' ',PRENOM_VISITEUR) AS info FROM visiteur WHERE ID_VISITEUR='$code'");
}
function ajout_table_visite($nom_client,$nom_visiteur,$date_arrivee,$date_depart){
	$requette="insert into visite values (null,'$nom_client','$nom_visiteur','$date_arrivee','$date_depart')";	
	ExecuteRequette($requette);	 
}
 function modif_table_visite($nom_client,$nom_visiteur,$date_arrivee,$date_depart,$code){
 $requette="update visite set NOM_CLIENT='$nom_client',NOM_VISITEUR='$nom_visiteur', DATE_ARRIVEE='$date_arrivee',DATE_DEPART='$date_depart'  where CODE_VISITE='$code'";
 echo $requette;
 ExecuteRequette($requette);
 }
 function suppression_table_visite($code){
$requette="delete from visite where CODE_VISITE='$code'";
echo $requette;
ExecuteRequette($requette);
 }
function recupere_nom_client_table_visite($code){
	return ResultatRequette("select NOM_CLIENT as info from visite where CODE_VISITE='$code'");
}

function recupere_nom_visiteur_table_visite($code){
	return ResultatRequette("select NOM_VISITEUR as info from visite where CODE_VISITE='$code'");
}

function recupere_date_arrivee_table_visite($code){
	return ResultatRequette("select DATE_ARRIVEE as info from visite where CODE_VISITE='$code'");
}

function recupere_date_depart_table_visite($code){
	return ResultatRequette("select DATE_DEPART as info from visite where CODE_VISITE='$code'");
}

// Fin gestion table visite




   
// Début gestion des consignes *
   
 function ajout_table_consigne($nom_client,$naturobjet,$nombrobjet,$datedepot,$heure_depot,$dateretrait,$heure_retrait,$observation){	
	$requette="insert into consigne values (null,'$nom_client','$naturobjet','$nombrobjet','$datedepot','$heure_depot','$dateretrait','$heure_retrait','$observation')";
	ExecuteRequette($requette);
 }
 
 function modif_table_consigne($nom_client,$naturobjet,$nombrobjet,$datedepot,$heure_depot,$dateretrait,$heure_retrait,$observation,$code){	
	$requette="update consigne set ID_PERSONNE='$nom_client', NATURE_OBJET='$naturobjet', NOMBRE_OBJET='$nombrobjet', DATE_DEPOT='$datedepot',HEURE_DEPOT='$heure_depot', DATE_RETRAIT='$dateretrait',HEURE_RETRAIT='$heure_retrait', OBSERVATION_OBJET='$observation' where ID_CONSIGNE=$code";
	ExecuteRequette($requette);
 }
 
 function suppression_table_consigne($code){
	$requette="delete from consigne where ID_CONSIGNE=$code";
	ExecuteRequette($requette);
 }
 
 function recupere_code_popup_consigne($code_type){
	return ResultatRequette("select ID_PERSONNE as info from personne_physique where concat(NOM_CLIENT,' ',PRENOM_CLIENT)='$code_type'");
 } 
 
 function recupere_nom_client_table_consigne($code){
	return ResultatRequette("select concat(NOM_CLIENT,' ',PRENOM_CLIENT) as info from personne_physique,consigne where ID_CONSIGNE=$code and consigne.ID_PERSONNE=personne_physique.ID_PERSONNE");
 } 

 function recupere_nature_objet($code){
	return ResultatRequette("select NATURE_OBJET as info from consigne where ID_CONSIGNE=$code");
 }
 
 function recupere_nombre_objet($code){
	return ResultatRequette("select NOMBRE_OBJET as info from consigne where ID_CONSIGNE=$code");
 }
 
 function recupere_date_depot($code){
	return ResultatRequette("select DATE_DEPOT as info from consigne where ID_CONSIGNE=$code");
 }
 
 function recupere_heure_depot($code){
	return ResultatRequette("select HEURE_DEPOT as info from consigne where ID_CONSIGNE=$code");
 }

 function recupere_date_retrait($code){
	return ResultatRequette("select DATE_RETRAIT as info from consigne where ID_CONSIGNE=$code");
 }
 
 function recupere_heure_retrait($code){
	return ResultatRequette("select HEURE_RETRAIT as info from consigne where ID_CONSIGNE=$code");
 }
 
 function recupere_observation($code){
	return ResultatRequette("select OBSERVATION_OBJET as info from consigne where ID_CONSIGNE=$code");
 }
 
 // Fin gestion des consignes *

 // Début gestion des objets oubliés

function ajout_table_objet_oublie($numero_chambre,$nom_client,$naturobjet,$nombrobjet,$datedepot,$heure_depot,$dateretrait,$heure_retrait,$observation){	
	$requette="insert into objet_oublie values (null,'$numero_chambre','$nom_client','$naturobjet','$nombrobjet','$datedepot','$heure_depot','$dateretrait','$heure_retrait','$observation')";
	ExecuteRequette($requette);
 }
 
 function modif_table_objet_oublie($numero_chambre,$nom_client,$naturobjet,$nombrobjet,$datedepot,$heure_depot,$dateretrait,$heure_retrait,$observation,$code){	
	$requette="update objet_oublie set CODE_CHAMBRE='$numero_chambre', ID_PERSONNE='$nom_client', NATURE_OBJET='$naturobjet', NOMBRE_OBJET='$nombrobjet', DATE_RETROUVE='$datedepot',HEURE_RETROUVE='$heure_depot', DATE_RECUPERE='$dateretrait',HEURE_RECUPERE='$heure_retrait', OBSERVATION='$observation' where ID_OBJET=$code";
	ExecuteRequette($requette);
 }
 
 function suppression_table_objet_oublie($code){
	$requette="delete from objet_oublie where ID_OBJET='$code'";
	ExecuteRequette($requette);
 }
 
 function recupere_code_popup_client_objet_oublie($code_type){
	return ResultatRequette("select ID_PERSONNE as info from personne_physique where concat(NOM_CLIENT,' ',PRENOM_CLIENT)='$code_type'");
 } 
 
 function recupere_code_popup_numero_chambre_objet_oublie($code_type){
	return ResultatRequette("select LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$code_type'");
 } 
 
 function recupere_numero_chambre_objet_oublie($code_type){
	return ResultatRequette("select CODE_CHAMBRE as info from objet_oublie where ID_OBJET='$code_type'");
 } 
 
 function recupere_nom_client_table_objet_oublie($code){
	return ResultatRequette("select concat(NOM_CLIENT,' ',PRENOM_CLIENT) as info from personne_physique,objet_oublie where ID_OBJET=$code and objet_oublie.ID_PERSONNE=personne_physique.ID_PERSONNE");
 } 

 function recupere_nature_objet_oublie($code){
	return ResultatRequette("select NATURE_OBJET as info from objet_oublie where ID_OBJET='$code'");
 }
 
 function recupere_nombre_objet_oublie($code){
	return ResultatRequette("select NOMBRE_OBJET as info from objet_oublie where ID_OBJET='$code'");
 }
 
 function recupere_date_retrouve($code){
	return ResultatRequette("select DATE_RETROUVE as info from objet_oublie where ID_OBJET='$code'");
 }
 
 function recupere_heure_retrouve($code){
	return ResultatRequette("select HEURE_RETROUVE as info from objet_oublie where ID_OBJET='$code'");
 }

 function recupere_date_recupere($code){
	return ResultatRequette("select DATE_RECUPERE as info from objet_oublie where ID_OBJET='$code'");
 }
 
 function recupere_heure_recupere($code){
	return ResultatRequette("select HEURE_RECUPERE as info from objet_oublie where ID_OBJET='$code'");
 }
 
 function recupere_observation_objet_oublie($code){
	return ResultatRequette("select OBSERVATION as info from objet_oublie where ID_OBJET='$code'");
 }

// Fin gestion des objets oubliés

///GESTION DE LA FACTURATION///

 function retour_val_idpersonne_id_max_occup($code){
	return ResultatRequette("select max(ID_OCCUPATION) as info from occuper where ID_PERSONNE=$code");
 }

 function donner_nom_prenom_mercredi($valueserve){
return ResultatRequette("select concat('',NOM_CLIENT,'     ',PRENOM_CLIENT,'       ') as info from personne_physique where  ID_PERSONNE='$valueserve'");
}
function ajout_facture($client,$date){
$requette="insert into facture values(null,'$client','$date')";
ExecuteRequette($requette);	
}
function ajout_facture_table_engendre($numfac,$chambre,$montant,$date){
$requette="insert into engendrer values('$numfac','$chambre','$montant','$date')";
ExecuteRequette($requette);	
}
function ajout_facture_table_reglement($code_reglement,$numfac,$date,$montant,$regle){
$requette="insert into reglement values(null,'$code_reglement','$numfac','$date','$montant','$regle')";
ExecuteRequette($requette);	
}
function recupere_id_client_faturation($code){
return ResultatRequette("select ID_CLIENT as info from personne_physique where ID_PERSONNE=$code");
}
function recupere_id_valeur_facture_en_cours($id,$date){
return ResultatRequette("select NUMERO_FACTURE as info from facture where ID_CLIENT='$id' AND DATE_FACTURE='$date'");
}
function recupere_id_type_reglement_faturation($code){
return ResultatRequette("select CODE_TYPE_REGLEMENT as info from type_reglement where LIBELLE_TYPE_REGLEMENT='$code'");
}

///FIN GESTION DE LA FACTURATION///




//gestion des montants  en caisse des chambres
function recupere_max_valeurdate($code){
return ResultatRequette("select max(DATE) as info from engendrer");
}
function recupere_min_valeurdate($code){
return ResultatRequette("select min(DATE) as info from engendrer");
}
function recupere_somme_deuxdate($g_date_debutbase,$g_date_finbase){
return ResultatRequette("select sum(MONTTANT) from engendrer where DATE BETWEEN '$g_date_debutbase' AND '$g_date_finbase' ");
}
// fin gestion des montants en caisse des chambres

//gestion des utilisateurs///
function ajout_utilisateur($nom,$fonction,$type,$date){
$requette="insert into utilisateur values(null,'$nom','$fonction','$type','$date')";
ExecuteRequette($requette);	
}
function ajout_utilisateurs($id,$nom,$login,$password){
$requette="insert into utilisateurs values('$id','$nom','$login','$password')";
ExecuteRequette($requette);	
}
function ajout_appartenir_groupe($user,$groupe){
$requette="insert into appartient values('$user','$groupe')";
ExecuteRequette($requette);	
}
function recupere_id_groupe($libele){
return ResultatRequette("select CODE_GROUPE as info from groupe where LIBELLE_GROUPE='$libele' ");
}
function recupere_id_utilisateur_connexion($login,$pass){
return ResultatRequette("select id_user as info from utilisateurs where pseudo='$login' AND password='$pass' ");
}
function recupere_id_groupeutilisateur_connexion($login){
return ResultatRequette("select CODE_GROUPE  as info from appartient where CODE_UTILISATEUR='$login' ");
}
function recupere_nom_user_mouchard($login){
return ResultatRequette("select nom_user  as info from utilisateurs where id_user='$login' ");
}
//fin gestion des utilisateurs//



//GESTION DE LA FACTURATION INSTANTANEE//
function ajout_consommation_facture($client,$service,$quantite,$prix,$total,$date,$etat){
$requette="insert into consommation values('$client','$service','$quantite','$prix','$total','$date','$etat')";
ExecuteRequette($requette);	
}
function recupere_montant_service_facturinstant($libele){
return ResultatRequette("select MONTANT_TARIF_SERV 	 as info from dependre where CODE_SERVICE='$libele' ");
}
function recupere_idclient_facturinstant($libele){
return ResultatRequette("select ID_CLIENT as info from personne_physique where ID_PERSONNE='$libele' ");
}
function recupere_somme_factureinstant($g_code){
return ResultatRequette("select sum(TOTAL) as info  from consommation where ID='$g_code'");
}
function recupere_somme_factureinstant102($g_code,$valdate,$etat){
return ResultatRequette("select sum(TOTAL) as info  from consommation where ID='$g_code' AND DATE >='$valdate' AND ETAT='$etat'");
}
function recupere_somme_factureinstant103($g_code,$valdate,$etat){
return ResultatRequette("select sum(TOTAL) as info  from consommation where ID='$g_code' AND DATE >='$valdate'");
}
//FIN GESTION DE LA FACTURATION INSTANTANEE//
function recupere_dddtest($g_code){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'");
}
//  Requette pour le graphe sur les consommations//
function recupere_premier($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_deuxieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_troisieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_quatrieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_cinquieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_sixieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_septieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code' AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_huitieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_neuvieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_dixieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_onzieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_douxieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_triezieme($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_quatorze($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_quinze($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code' AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_sieze($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code'  AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_dixsetp($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code' AND DATE  BETWEEN '$date1' AND '$date2'");
}
function recupere_dixhuit($g_code,$date1,$date2){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation where CODE_SERVICE='$g_code' AND DATE  BETWEEN '$date1' AND '$date2'");
}

function recupere_total_consom(){
return ResultatRequette("SELECT sum(QUANTITE) as info from consommation ");
}







function recupere_libell_premier($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_deuxime($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_troisieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_quarieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_cinquieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_sixieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_septieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_huitieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_neuvieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_dixieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_onzieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_douzieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_triezieme($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_quatorze($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_quinze($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_sieze($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_disetp($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
function recupere_libell_dixhuit($g_code){
return ResultatRequette("SELECT  TITRE_SERVICE 	 as info from service where CODE_SERVICE='$g_code'");
}
//fin requette pour les graphe sur les consommations//

function recupere_type_un($g_code){
return ResultatRequette("SELECT  count(CODE_TYPE_CHAMBRE)	 as info from concerner where CODE_TYPE_CHAMBRE='$g_code'");
}
function recupere_type_deux($g_code){
return ResultatRequette("SELECT  count(CODE_TYPE_CHAMBRE)	 as info from concerner where CODE_TYPE_CHAMBRE='$g_code'");
}
function recupere_type_trois($g_code){
return ResultatRequette("SELECT  count(CODE_TYPE_CHAMBRE)	 as info from concerner where CODE_TYPE_CHAMBRE='$g_code'");
}


function recupere_libelle_type_un($g_code){
return ResultatRequette("SELECT  LIBELLE_TYPE_CHAMBRE	 as info from type_chambre where CODE_TYPE_CHAMBRE='$g_code'");
}
function recupere_libelle_type_deux($g_code){
return ResultatRequette("SELECT  LIBELLE_TYPE_CHAMBRE	 as info from type_chambre where CODE_TYPE_CHAMBRE='$g_code'");
}
function recupere_libelle_type_trois($g_code){
return ResultatRequette("SELECT  LIBELLE_TYPE_CHAMBRE	 as info from type_chambre where CODE_TYPE_CHAMBRE='$g_code'");
}
function recupere_total_type_chambre(){
return ResultatRequette("SELECT count(CODE_TYPE_CHAMBRE) as info from concerner ");
}
// debut requette pour les type de cha


//GESTION DE LA MAIN COURANTE
function recupere_main_courante_serv(){
return ResultatRequette("SELECT count(CODE_TYPE_SERVICE) as info from type_service ");
}
function recupere_main_courante_serv1($code){
return ResultatRequette("SELECT count(CODE_SERVICE) as info from service where CODE_TYPE_SERVICE='$code'");
}
function recupere_main_courante_nbchambre(){
return ResultatRequette("SELECT count(CODE_CHAMBRE) as info from chambre");
}
function recupere_mainnbchambrenb($code,$date){
return ResultatRequette("SELECT NB_PERSONNE as info from occuper where CODE_CHAMBRE='$code' AND DATE_ENTREE='$date'");
}
/*function recupere_idpersone_main_courante($code,$date){
return ResultatRequette("SELECT ID_PERSONNE as info from occuper where CODE_CHAMBRE='$code' AND DATE_ENTREE='$date'");
}*/
function recupere_idpersone_main_courante($code,$date){
return ResultatRequette("SELECT ID_PERSONNE as info from occuper where CODE_CHAMBRE='$code' AND '$date' BETWEEN DATE_ENTREE AND DATE_SORTIE");
}


function retour_nomprenom_main_courante($idpers){
return ResultatRequette("select concat(NOM_CLIENT,'  ',PRENOM_CLIENT) as info from personne_physique where ID_PERSONNE='$idpers'");
}
function recupere_montant_chambre($code_tmain){
return ResultatRequette("SELECT MONTANT_TARIF_TYPECHAMBRE as info from viser where CODE_TYPE_CHAMBRE='$code_tmain'");
}
function recupere_montant_service_maincourante($code_tmain){
return ResultatRequette("SELECT MONTANT_TARIF_SERV as info from dependre where CODE_SERVICE='$code_tmain'");
}
function recupere_idclient_maincourante($code_tmain){
return ResultatRequette("SELECT ID_CLIENT as info from personne_physique where ID_PERSONNE='$code_tmain'");
}
function recupere_montant_cellule_maincourante($id_occ,$code_serv,$date){
return ResultatRequette("SELECT sum(TOTAL) as info from consommation where ID='$id_occ' AND CODE_SERVICE='$code_serv' AND DATE='$date'");
}
function recupere_montant_cellule_maincourante_veille($id_occ,$date,$etat){
return ResultatRequette("SELECT sum(TOTAL) as info from consommation where ID='$id_occ' AND DATE='$date' AND ETAT='$etat'");
}
function recupere_montant_cellule_maincourante_today($id_occ,$date,$etat){
return ResultatRequette("SELECT sum(TOTAL) as info from consommation where ID='$id_occ' AND DATE='$date' AND ETAT='$etat'");
}

function recupere_montant_total_service_maincourante($code_serv,$date){
return ResultatRequette("SELECT sum(TOTAL) as info from consommation where CODE_SERVICE='$code_serv' AND DATE='$date'");
}



//gestion des montants
function recupere_code_chambre_avec_libelle($code_type){
	return ResultatRequette("select CODE_CHAMBRE as info from chambre where LIBELLE_CHAMBRE='$code_type'");
 }
 function recupere_code_chambre_pour_montant(){
		$requette="select CODE_CHAMBRE as code, LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
		return ResultatRequette($requette);
		
 }
function recupere_montant_chambre_par_jour($code_chambre,$date_du_jour){
		return ResultatRequette("SELECT MONTANT_TARIF_TYPECHAMBRE as info FROM chambre, type_chambre, viser, avoir, engendrer,facture, reglement, etat_chambre WHERE chambre.CODE_TYPE_CHAMBRE=viser.CODE_TYPE_CHAMBRE AND chambre.CODE_TYPE_CHAMBRE=type_chambre.CODE_TYPE_CHAMBRE AND chambre.CODE_CHAMBRE=avoir.CODE_CHAMBRE AND chambre.CODE_CHAMBRE=engendrer.CODE_CHAMBRE AND facture.NUMERO_FACTURE=engendrer.NUMERO_FACTURE AND facture.NUMERO_FACTURE=reglement.NUMERO_FACTURE AND avoir.CODE_ETAT_CHAMBRE=etat_chambre.CODE_ETAT_CHAMBRE AND avoir.CODE_CHAMBRE='$code_chambre' AND '$date_du_jour' BETWEEN DATE_CHANGEMENT_ETAT AND DATE_FIN_ETAT");
 }
 
 
 function cout_chambre_periode($code_chambre,$date_debut,$date_fin){
        $montant=0;
		
		while($date_debut<=$date_fin){
			$montant+=recupere_montant_chambre_par_jour($code_chambre,$date_debut);		
			$date_debut=jour_suivant($date_debut);
		
		}
		return $montant;
 } 
  
 function jour_suivant($date_debut){
		return date('Y-m-d',strtotime("".$date_debut."+1 day"));
 }
 // Fin gestion des montants par chambre pour une période
 
 
  // Début gestion des montants par service pour une période
 
 function recupere_montant_service_par_jour($code_service,$date_du_jour){
		return ResultatRequette("SELECT SUM(TOTAL) as info FROM consommation WHERE CODE_SERVICE='$code_service'  AND DATE='$date_du_jour'");
 }
 
 function cout_service_periode($code_service,$date_debut,$date_fin){
        $montant=0;	
		while($date_debut<=$date_fin){
			$montant+=recupere_montant_service_par_jour($code_service,$date_debut);		
			$date_debut=jour_suivant($date_debut);
		
		}
		return $montant;
 } 
 
 // Fin gestion des montants par service pour une période
 
 
 
 // Début gestion de la planification des chambres

function recupere_couleur_planning_chambre($numero_chambre,$la_date){
$requette=" SELECT COULEUR_ASSOCIE as info FROM chambre, etat_chambre, avoir WHERE etat_chambre.CODE_ETAT_CHAMBRE=avoir.CODE_ETAT_CHAMBRE AND chambre.CODE_CHAMBRE=avoir.CODE_CHAMBRE AND chambre.code_chambre='$numero_chambre' AND '$la_date' BETWEEN DATE_CHANGEMENT_ETAT AND DATE_FIN_ETAT";
return ResultatRequette($requette);
}

function recupere_date_changement_dans_table_avoir($code){
	return ResultatRequette("SELECT DATE_CHANGEMENT_ETAT as info FROM avoir WHERE CODE_ETAT_CHAMBRE='$code'");
 }
 
 function recupere_date_fin_etat_dans_table_avoir($code){
	return ResultatRequette("SELECT DATE_FIN_ETAT as info FROM avoir WHERE CODE_ETAT_CHAMBRE='$code'");
 }
function recupere_code_combo_etat_chambre($code_combo){
	return ResultatRequette("SELECT CODE_ETAT_CHAMBRE as info FROM etat_chambre WHERE LIBELLE_ETAT_CHAMBRE='$code_combo'");
 }

// Fin gestion de la planification des chambres



//GESTION DES AVANCES 
function ajout_avance($code_facture,$montant,$date_operation){
$requette="insert into avance values(null,'$code_facture','$montant','$date_operation')";
ExecuteRequette($requette);	
}

function recupere_date_for_avance($numfacture){
return ResultatRequette("SELECT DATE_REGLEMENT as info from facture where NUMERO_FACTURE='$numfacture'");
}
function recupere_id_for_avance($numfacture){
return ResultatRequette("SELECT ID_CLIENT as info from facture where NUMERO_FACTURE='$numfacture'");
}


function recupere_montant_reglement_for_avance($numfacture){
return ResultatRequette("SELECT MONTANT_REGELEMENT as info from reglement where NUMERO_FACTURE='$numfacture'");
}
function recupere_montant_regle_for_avance($numfacture){
return ResultatRequette("SELECT MONTANT_REGLE as info from reglement where NUMERO_FACTURE='$numfacture'");
}
function recupere_numfact_affiche($numfacture){
return ResultatRequette("SELECT NUMERO_FACTURE  as info from avance where ID_AVANCE='$numfacture'");
}
function retour_nomprenom_savance($idpers){
return ResultatRequette("select concat(NOM_CLIENT,'  ',PRENOM_CLIENT) as info from personne_physique where ID_CLIENT='$idpers'");
}

function recupere_total_montant_affiche($numfacture){
return ResultatRequette("SELECT sum(MONTANT)  as info from avance where NUMERO_FACTURE='$numfacture'");
}
//FIN GESTION DES AVANCES

//gestin des factures par periode//

function recupere_montant_reglement_liste_facture($numfacture){
return ResultatRequette("SELECT MONTANT_REGELEMENT as info from reglement where NUMERO_FACTURE='$numfacture'");
}
function retour_nomprenom_liste_facture_table($idpers){
return ResultatRequette("select concat(NOM_CLIENT,'  ',PRENOM_CLIENT) as info from personne_physique where ID_CLIENT='$idpers'");
}
//fin gestioon des factures par periode//










///gestion du suivit des client dans lhotel///
function recupere_type_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT CODE_TYPE_CHAMBRE as info from chambre where CODE_CHAMBRE='$numfacture'");
}
function recupere_montant_type_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT MONTANT_TARIF_TYPECHAMBRE as info from viser where CODE_TYPE_CHAMBRE='$numfacture'");
}
function recupere_nuit_client_type_chambre_for_suivit($numfacture,$id_personnne,$date_entree){
return ResultatRequette("SELECT DUREE_OCCUPATION  as info from occuper where ID_OCCUPATION='$numfacture' AND ID_PERSONNE='$id_personnne' AND DATE_ENTREE='$date_entree'");
}
function recupere_id_client_personne_occupant_for_suivit($numfacture){
return ResultatRequette("SELECT ID_CLIENT as info from personne_physique where ID_PERSONNE='$numfacture'");
}
function recupere_consommation_personne_occupant_for_suivit($id_cli,$etat,$date_entree,$date_sortie){
return ResultatRequette("SELECT sum(TOTAL) as info from consommation where ID='$id_cli' AND ETAT='$etat' AND DATE  BETWEEN '$date_entree' AND '$date_sortie'  ");
}
function retour_nomprenom_liste_suivit_table($idpers){
return ResultatRequette("select concat(NOM_CLIENT,'  ',PRENOM_CLIENT) as info from personne_physique where ID_PERSONNE='$idpers'");
}
function recupere_libelle_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$numfacture'");
}
function recupere_idpersonne_edition_for_suivit($numfacture){
return ResultatRequette("SELECT ID_PERSONNE as info from occuper where ID_OCCUPATION='$numfacture'");
}
function recupere_som_avancement_for_suivit($numfacture){
return ResultatRequette("SELECT sum(MONTANT_AJOUTE) as info from avance_utilisation where ID_OCCUPATION='$numfacture'");
}

function ajout_avance_occupation_suivit($code,$montant,$date_operation){
$requette="insert into avance_utilisation values(null,'$code','$montant','$date_operation')";
ExecuteRequette($requette);	
}
function recupere_code_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT CODE_CHAMBRE as info from occuper where ID_OCCUPATION='$numfacture'");
}
function recupere_id_personne_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT ID_PERSONNE as info from occuper where ID_OCCUPATION='$numfacture'");
}
function recupere_date_entree_personne_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT DATE_ENTREE as info from occuper where ID_OCCUPATION='$numfacture'");
}
function recupere_date_sortie_personne_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT DATE_SORTIE as info from occuper where ID_OCCUPATION='$numfacture'");
}
function recupere_duree_personne_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT DUREE_OCCUPATION as info from occuper where ID_OCCUPATION='$numfacture'");
}
function recupere_date_entree_pourverif_personne_chambre_for_suivit($numfacture){
return ResultatRequette("SELECT DATE_ENTREE as info from occuper where ID_OCCUPATION='$numfacture'");
}
///fin de la gestion du suivit des client dans lhotel///
?>