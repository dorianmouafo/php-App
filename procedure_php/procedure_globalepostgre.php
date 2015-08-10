<?php
 function Connexion(){
	$host='127.0.0.1';
	$user='postgres';
	$psw='christian';
	$bd='bd_client';
	$port=5432;
	
	$link=pg_connect("host=$host dbname=$bd user=$user password=$psw");
	
	return $link;
}

function ExecuteRequette($requette){
	$link=Connexion();
	$result=pg_query($requette);
}

function ecrire_fichier($information){
	  $fichier=fopen("d:\fichier.txt","a"); // permet de faire le debogage sur le contenu des variables 
	  fputs($fichier,$information);
	  fclose($fichier);
}

function ResultatRequette($requette){
   	$link=Connexion();
    $result = pg_query($requette);
    if (!$result) {
        echo "Problem with query " . $requette . "<br/>";
        echo pg_last_error();
        exit();
    }

    while($myrow = pg_fetch_assoc($result)) {
         $leresultat=htmlspecialchars($myrow['info']);
    } 
	
	return $leresultat;
}

function ChargeCombo($requette,$element_selectionne){
	$link=Connexion();
	$result=pg_query($requette);
	if (!$result) {
        echo "Problem with query " . $requette . "<br/>";
        echo pg_last_error();
        exit();
    }
	
	while ($ligne = pg_fetch_assoc($result)) {
	
		if ($ligne["info"]!=$element_selectionne) print " <option value='".$ligne["info"]."'>".stripslashes($ligne["info"])."</option>";
		else print " <option value='".stripslashes($ligne["info"])."' selected>".stripslashes($ligne["info"])."</option>";
	} 
}
?>