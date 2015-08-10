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
      opener.document.getElementById("parrainn").value = window.document.getElementById("parrainn").value;
	  opener.document.getElementById("ident_parrain").value = window.document.getElementById("ident_parrain").value;
      self.close();
    }
  </script>

</head>
<?php function donner_rasion_tele_entreprise_mercredi($valparrainentreprsie){
return ResultatRequette("select concat('',RAISON_SOCIALE,'     ',TELEPHONE_MORALE,'       ') as info from personne_morale where  	ID_CLIENT='$valparrainentreprsie'");
}
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
  $g_code=$_REQUEST['modif_code'];
     if($g_code!=""){
$g_valeur_recup=donner_rasion_tele_entreprise_mercredi($g_code);
$g_valeur_identite=$g_code;
//$_SESSION['mon_id_du_parrain']=$g_code;
}
?>
<body>
                                        <?php                                  
                                        require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong>Raison sociale</strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong>Num&eacute;ro</strong>";
	           							print " </th>";
										
										/*print " <th class='entete_tableau' >";
										print " <strong>T&eacute;l&eacute;phone</strong>";
	           							print " </th>";*/
									    
										// on recupère la liste 
										$requete="select ID_CLIENT,NUMERO_INDENTIFIANT,RAISON_SOCIALE,TELEPHONE_MORALE from personne_morale ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                             print " <td><a href='listeentreprise.php?modif_code=$ID_CLIENT'>".stripslashes($RAISON_SOCIALE)."</td>";											 
                                             print " <td><a href='listeentreprise.php?modif_code=$ID_CLIENT'>".stripslashes($NUMERO_INDENTIFIANT)."</a></td>";
											 //print " <td>".stripslashes($TELEPHONE_MORALE)."</a></td>";
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de chambres: ".$i."<br/><br/>";
?>
 <strong>Client:</strong><input readonly id="parrainn" type="text" value="<?php print $g_valeur_recup?>" size="80"/><input readonly id="ident_parrain" type="text" value="<?php print $g_valeur_identite?>" size="1"/>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
