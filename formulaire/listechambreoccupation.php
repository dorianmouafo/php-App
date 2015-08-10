<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Fs Hotel</title>
    <link rel="stylesheet" href="../procedure_css/le_style.css" type="text/css" /> 
	<link rel="stylesheet" href="../procedure_css/styleclient.css" type="text/css" /> 
    <link rel="stylesheet" href="../procedure_css/css.css" type="text/css" media="screen" />
  <script>
    function dateWrite(){
      opener.document.getElementById("chambre").value = window.document.getElementById("chambre").value;
      self.close();
    }
  </script>

</head>
<?php 
function donner_libbelele_chambre_mercredi($valueserve){
return ResultatRequette("select  LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$valueserve'");
}
function donner_lecodepour_verif_occupe_chambre_mercredi($valueserve){
return ResultatRequette("select CODE_CHAMBRE  as info from chambre where LIBELLE_CHAMBRE='$valueserve'");
}
function donner_lecode_dans_occupe_chambre_mercredi($valueserve){
return ResultatRequette("select CODE_CHAMBRE  as info from occuper where CODE_CHAMBRE='$valueserve'");
}
function donner_coderecup_liebbe_etat_mercredi($valib){
return ResultatRequette("select LIBELLE_ETAT_CHAMBRE as info from etat_chambre where CODE_ETAT_CHAMBRE='$valib'");
}
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
  $g_code=$_REQUEST['modif_code'];
     if($g_code!=""){
	    $libelle=donner_libbelele_chambre_mercredi($g_code);
		$code=donner_lecodepour_verif_occupe_chambre_mercredi($libelle);
		$codeoccup=donner_lecode_dans_occupe_chambre_mercredi($code);
	    /*if($codeoccup!=""){
		print "<script language='javascript'> alert('La chambre selectionnee est occupee'); </script>";
		}
		else{
       $g_valeur_recup=donner_libbelele_chambre_mercredi($g_code);
	   
	   }*/
	    $g_valeur_recup=donner_libbelele_chambre_mercredi($g_code);
}
?>
<body>
                                        <?php                                  
                                        require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										$etat_libre=recup_val_code_etat('LIBRE');
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong>Chambre</strong>";
	           							print " </th>";
									
										/*print " <th class='entete_tableau' >";
										print " <strong> Etat </strong>";
	           							print " </th>";*/
									    
										// on recupère la liste 
										//$requete="select a.CODE_CHAMBRE,b.CODE_ETAT_CHAMBRE from chambre a,etat_chambre b,avoir c where	 a.CODE_CHAMBRE=c.CODE_CHAMBRE and b.CODE_ETAT_CHAMBRE =c.CODE_ETAT_CHAMBRE ";
										//$requete="select * from chambre";
										//$requete="select * from avoir where CODE_ETAT_CHAMBRE='$etat_libre'";
										$requete="select distinct CODE_CHAMBRE from avoir";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{   extract($lecture);
										         $code_chambre=$lecture[CODE_CHAMBRE];
												 $val_code=rechercher_datemaxcodeavoir($code_chambre);
												 $valcode_etat=rechercher_lnationtable($val_code);
												 $etat_libre=recup_val_code_etat('LIBRE');
												 //print $etat_libre;
											 $i++;
											/*print $code_chambre;
											print "<br/>";
											  print $val_code;
											   print "<br/>";
											  print $valcode_etat;*/
											  if($valcode_etat==$etat_libre){
											if ($i%2==1){ print " <tr class='ligne_impaire'>"; 
											}
											 else {print " <tr class='ligne_paire'>"; 
											 }
											 print " <td><a href='listechambreoccupation.php?modif_code=$CODE_CHAMBRE'>".stripslashes(donner_libbelele_chambre_mercredi($CODE_CHAMBRE))."</td>";
											 }
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de chambres libres: ".$i."<br/><br/>";
?>
 <strong> Valider le choix</strong><input readonly id="chambre" type="text" value="<?php print $g_valeur_recup?>"/>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
