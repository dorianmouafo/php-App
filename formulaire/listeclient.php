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
      opener.document.getElementById("client").value = window.document.getElementById("client").value;
	  opener.document.getElementById("identite").value = window.document.getElementById("identite").value;
      self.close();
    }
  </script>

</head>
<?php
function donner_nom_identitede_mercredi($selected){
return ResultatRequette("select NUMERO_INDENTIFIANT as info from personne_physique where  ID_PERSONNE='$selected'");
}
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
  $g_code=$_REQUEST['modif_code'];
     if($g_code!=""){
$g_valeur_recup=donner_nom_prenom_mercredi($g_code);
$g_valeur_identite=$g_code;
}
?>
<body>
                                        <?php                                  
                                        require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong>Nom</strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Pr&eacute;nom</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>CNI/Passport</strong>";
	           							print " </th>";
									    
										// on recupère la liste 
										$requete="select ID_PERSONNE,NOM_CLIENT,PRENOM_CLIENT,NUMERO_INDENTIFIANT from personne_physique ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                             print " <td><a href='listeclient.php?modif_code=$ID_PERSONNE'>".stripslashes($NOM_CLIENT )."</td>";											 
                                             print " <td><a href='listeclient.php?modif_code=$ID_PERSONNE'>".stripslashes($PRENOM_CLIENT)."</a></td>";
											 print " <td>".stripslashes($NUMERO_INDENTIFIANT )."</a></td>";
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de chambres: ".$i."<br/><br/>";
?>
 <strong>Client:</strong><input readonly id="client" type="text" value="<?php print $g_valeur_recup?>" size="80"/><input readonly id="identite" type="hidden" value="<?php print $g_valeur_identite?>" size="1"/>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
