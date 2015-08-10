<?php
 function Connexion(){
	$host_mysql='localhost';
	$user_mysql='root';
	$pass_mysql='';
	$bd_mysql='bd_hotel';
	$link=mysql_connect($host_mysql,$user_mysql,$pass_mysql);
	mysql_select_db($bd_mysql) or die("Connexion impossible");
	
	return $link;
}

function ExecuteRequette($requette){
	$link=Connexion();
	$result=mysql_query($requette);
}

function Formatage_chaine($requette){
   	str_replace("A","i",$requette);
	
	return $requette;
}

function ecrire_fichier($information){
	  $fichier=fopen("c:\fichier.txt","a"); // permet de faire le debogage sur le contenu des variables 
	  fputs($fichier,$information);
	  fclose($fichier);
}

function ResultatRequette($requette){
   	$link=Connexion();
	mysql_select_db($bd_mysql);     
	$result=mysql_query($requette,$link);
         
    while($resultat1=mysql_fetch_array($result)){
	   $resultat=$resultat1[info];
	}
	return stripslashes($resultat);
}

function LeMouchard($code_user,$operation){
	$la_date=date("y/m/d");
	$l_heure=date("h:s");
    $requette="insert into mouchard (code_user,date_operation,heure_operation,operation_effectuee) values ('$code_user','$la_date','$l_heure','$operation')";
	print $requette;
	ExecuteRequette($requette);
}

function Affichage_date($la_date){
	return substr($la_date,8,2)."/".substr($la_date,5,2)."/".substr($la_date,0,4);
}

function Affichage_heure($l_heure){
	return substr($l_heure,8,2).":".substr($l_heure,5,2);
}

function ChargeCombo($requette,$element_selectionne){
	$link=Connexion();
	$result=mysql_query($requette, $link);
																																	  
	while($lecture=mysql_fetch_array($result))
	{  extract($lecture);							 
		$info=Formatage_chaine($info);
		if ($info!=$element_selectionne) print " <option value='".$info."'>".$info."</option>";
		else print " <option value='".stripslashes($info)."' selected>".stripslashes($info)."</option>";
	}
}

function Utilisateur_connecte($chaine,$chaine2){
    return  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font color='blue'><b>".ucwords($chaine)."  ".strtoupper($chaine2)."</b> </font>";
}

function Utilisateur_connecte1($chaine){
    $chaine1=ResultatRequette("select prenom as info from etudiant where matricule='$chaine'");
	$chaine2=ResultatRequette("select nom as info from etudiant where matricule='$chaine'");
	
    return  "&nbsp;&nbsp;&nbsp;&nbsp; <font color='blue'><b>".ucwords($chaine1)."  ".strtoupper($chaine2)."</b> </font>";
}
?>