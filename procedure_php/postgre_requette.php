<?php

// gestion des traces des utilisateurs
function LeMouchard($code_user,$operation){
	$la_date=date_serveur();
	$l_heure=heure_serveur();
    $requette="insert into mouchard (code_user,date_operation,heure_operation,operation_effectuee) values ('$code_user','$la_date','$l_heure','$operation')";
	ExecuteRequette($requette);
}

function Utilisateur_connecte($chaine,$chaine2){
    return  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font color='blue'><b>".ucwords($chaine)."  ".strtoupper($chaine2)."</b> </font>";
}

function Utilisateur_connecte1($chaine){
    $chaine1=ResultatRequette("select prenom as info from etudiant where matricule='$chaine'");
	$chaine2=ResultatRequette("select nom as info from etudiant where matricule='$chaine'");
	
    return  "&nbsp;&nbsp;&nbsp;&nbsp; <font color='blue'><b>".ucwords($chaine1)."  ".strtoupper($chaine2)."</b> </font>";
}

// fin

// gestion des dates et des heures
function Affichage_date($la_date){
	return substr($la_date,8,2)."/".substr($la_date,5,2)."/".substr($la_date,0,4);
}

function Affichage_heure($l_heure){
	return substr($l_heure,8,2).":".substr($l_heure,5,2);
}

function Formatage_chaine($requette){
   	str_replace("A","i",$requette);
	
	return $requette;
}

function date_serveur(){
	return date("d/m/Y");
}

function heure_serveur(){
	return date("h:i:s");
}

 // gestion des types de clients
 function ajout_type_client($libelle){
 	$requette="insert into type_client values ('$libelle')";	
	ExecuteRequette($requette);
 }
 
 function modif_type_client($libelle,$code){
	$requette="update type_client set libelle='$libelle'  where code=$code";
	ExecuteRequette($requette);
 }
 
 function suppression_type_client($code){
	$requette="delete from type_client where code=$code";
	ExecuteRequette($requette);
 }
  
 function recupere_libelle_type_client($code){
    return ResultatRequette("select libelle as info from type_client where code=$code");
 }
 
 
 function recupere_code_type_client($libelle){
	return ResultatRequette("select code as info from type_client where libelle='$libelle'");
 }
 
 // fin gestion des types de client
 
 // gestion des agents acep
 function ajout_agent($nom,$prenom,$num_acep,$cni){
    $requette="insert into agent_acep  values ('$nom','$prenom','$num_acep','$cni')";	
	ExecuteRequette($requette);
 }
 
 function modif_agent($nom,$prenom,$num_acep,$cni,$code){
	$requette="update agent_acep set nom='$nom',prenom='$prenom',num_acep='$num_acep',cni='$cni'  where code=$code";
	ExecuteRequette($requette);
 }
 
 function suppression_agent($code){
	$requette="delete from agent_acep where code=$code";
	ExecuteRequette($requette);
 }
  
 function recupere_nom_agent($code){
	return ResultatRequette("select nom as info from agent_acep where code=$code");
 }
 
 function recupere_prenom_agent($code){
	return ResultatRequette("select prenom as info from agent_acep where code=$code");
 }
 
 function recupere_cni_agent($code){
	return ResultatRequette("select cni as info from agent_acep where code=$code");
 }
 
 function recupere_num_acep_agent($code){
	return ResultatRequette("select num_acep as info from agent_acep where code=$code");
 }
 
  function recupere_code_agent($nom){
	return ResultatRequette("select code as info from agent_acep where nom='$nom'");
 }
 
 // fin gestion des agents acep

  // gestion des clients
 function ajout_client($nom,$prenom,$num_acep,$cxd,$cyd,$cxt,$cyt,$cni,$code_agent,$code_quartier){
    $requette="insert into client  values ('$nom','$prenom','$num_acep','$cxd','$cyd','$cxt','$cyt','$cni',$code_agent,$code_quartier)";
	ExecuteRequette($requette);
 }
  
 function modif_client($nom,$prenom,$num_acep,$cxd,$cyd,$cxt,$cyt,$cni,$code_agent,$code_quartier,$code){
	$requette="update client set nom='$nom',prenom='$prenom',num_acep='$num_acep',numcni='$cni',code_quartier=$code_quartier,";
	$requette.=" coordx_dom='$cxd',coordy_dom='$cyd',coordx_tra='$cxt',coordy_tra='$cyt',agent_acep=$code_agent where code=$code";
	ExecuteRequette($requette);
 }
 
 function suppression_client($code){
	$requette="delete from client where code=$code";
	ExecuteRequette($requette);
 }
  
 function recupere_nom_client($code){
	return ResultatRequette("select nom as info from client where code=$code");
 }
 
 function recupere_nom_prenom_client($code){
	return ResultatRequette("select nom||' '||prenom as info from client where code=$code");
 }
 
 
 function recupere_prenom_client($code){
	return ResultatRequette("select prenom as info from client where code=$code");
 }
 
 function recupere_cni_client($code){
	return ResultatRequette("select numcni as info from client where code=$code");
 }
 
 function recupere_cxd_client($code){
	return ResultatRequette("select coordx_dom as info from client where code=$code");
 }
 
 function recupere_cyd_client($code){
	return ResultatRequette("select coordy_dom as info from client where code=$code");
 }
 
 function recupere_cxt_client($code){
	return ResultatRequette("select coordx_tra as info from client where code=$code");
 }
 
 function recupere_cyt_client($code){
	return ResultatRequette("select coordy_tra as info from client where code=$code");
 }
 
 function recupere_code_client($nom){
	return ResultatRequette("select code as info from client where nom||' '||prenom='$nom'");
 }
 
 function recupere_num_acep_client($code){
	return ResultatRequette("select num_acep as info from client where code=$code");
 }
 
 function recupere_agent_client($code){
	return ResultatRequette("select a.nom as info from client c,agent_acep a where c.agent_acep=a.code and c.code=$code");
 }
 
  function recupere_type_client_client($code){
	return ResultatRequette("select libelle as info from type_client t,client c where t.code=c.code_type and c.code=$code");
 }
 
 function recupere_quartier_client($code){
	return ResultatRequette("select nomquartie as info from quartier q,client c where q.codequarti=c.code_quartier and c.code=$code");
 }
 
 // fin gestion des clients
 
  function recupere_code_quartier($nom){
	return ResultatRequette("select codequarti as info from quartier where nomquartie='$nom'");
 }
 
 // gestion des clients type clients 

  function ajout_client_type_client($codec,$codet,$date_debut,$date_fin){
    $requette="insert into client_type_client  values ($codec,$codet,'$date_debut','$date_fin')";
	ExecuteRequette($requette);
 }
  
 function modif_client_type_client($codec,$codet,$date_debut,$date_fin,$code){
	$requette="update client_type_client set code_client=$codec,code_type=$codet,date_debut='$date_debut',date_fin='$date_fin' where code=$code ";
	ExecuteRequette($requette);
 }
 
 function recupere_code_client_client_type_client($code){
	return ResultatRequette("select code_client  as info from client_type_client where code=$code");
 }
 
 function recupere_code_type_client_type_client($code){
	return ResultatRequette("select code_type  as info from client_type_client where code=$code");
 }
 
 function recupere_date_debut_client_type_client($code){
	return ResultatRequette("select date_debut  as info from client_type_client where code=$code");
 }
 
 function recupere_date_fin_client_type_client($code){
	return ResultatRequette("select date_fin  as info from client_type_client where code=$code");
 }
 
 function recupere_type_client_client_type_client($code){
	return ResultatRequette("select libelle  as info from client_type_client ctc,type_client tc where tc.code=ctc.code_type and ctc.code=$code");
 }
 
  function recupere_client_client_type_client($code){
	return ResultatRequette("select nom||' '||prenom  as info from client_type_client ctc,client c where c.code=ctc.code_client and ctc.code=$code");
 }
 
 function suppression_client_type_client($code){
	$requette="delete from client_type_client  where code=$code";
	ExecuteRequette($requette);
 }
 
  function importation($num_acep,$coodxdom,$coordydom,$coordxtra,$coordytra){
	$requette="update client set coordx_dom='$coodxdom',coordx_dom='$coordydom',coordx_dom='$coordxtra',coordx_dom='$coordytra' where num_acep='$num_acep'; ";
	return $requette;
 }
 
 function importation_donnees($requette){
	ExecuteRequette($requette);
 }
 
?>