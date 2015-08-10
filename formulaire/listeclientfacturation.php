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
	opener.document.getElementById("idc").value = window.document.getElementById("idc").value;
    opener.document.getElementById("chambre").value = window.document.getElementById("chambre").value;
	opener.document.getElementById("loge").value = window.document.getElementById("loge").value;
	opener.document.getElementById("prixunique").value = window.document.getElementById("prixunique").value;
	opener.document.getElementById("nui").value = window.document.getElementById("nui").value;
	opener.document.getElementById("prix").value = window.document.getElementById("prix").value;
	opener.document.getElementById("date_max").value = window.document.getElementById("date_max").value;
      self.close();
    }
  </script>
</head>
<?php 
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
 // $g_code=$_REQUEST['modif_code'];
  $_SESSION['code_client_facturation']=$_REQUEST['modif_code'];
    if($_SESSION['code_client_facturation']!=""){
	//je recupete id du client enn fonction de id personne 
	    $g_id=recupere_id_client_faturation($_SESSION['code_client_facturation']);
		//je recure le non et le prenom du client concatené
        $_SESSION['nom_prenom_client']=donner_nom_prenom_mercredi($_SESSION['code_client_facturation']);
		$g_valeur_recup=$_SESSION['nom_prenom_client'];
		$etat='0';
		print $g_id;
		$idoccupation=retour_val_idpersonne_id_max_occup($_SESSION['code_client_facturation']);
		print $idoccupation;
		//$g_loge_code=retour_chambre_sortietable1($_SESSION['code_client_facturation']);
		
		//code du logement de la chambre
		$g_loge_code=retour_chambre_sortietable1($idoccupation);
		//numero de la chambre
		$g_loge=recupere_valeur_lib_chalbre_etat_de_chambre($g_loge_code);
		
		//$date_max_client=retour_val_idpersonne_id_max_date($_SESSION['code_client_facturation']);
		
		$date_max_client=retour_val_idpersonne_id_max_date1($idoccupation);
		print $date_max_client;
		$code_type=retour_type_chambre_fiche($g_loge_code);
		$g_prix=retour_montant_type_chambre_fiche($code_type);
		$g_nui=retour_annuite_fiche1($idoccupation);
		$g_montant_chambre=$g_nui*$g_prix;
		//$g_montant=$g_nui*$g_prix;
	    $g_montant_services=recupere_somme_factureinstant102($g_id,$date_max_client,$etat);
		//$g_montant=recupere_somme_factureinstant102($g_id,$date_max_client,$etat);
		$g_montant=$g_montant_services+$g_montant_chambre;
		//$_SESSION['nom_prenom_clientv']=$_SESSION['nom_prenom_client'];
		//print $_SESSION['nom_prenom_client'];
    }
?>
<body>
                                        <?php                                  
                                        require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Nom et Pr&eacute;nom</strong>";
	           							print " </th>";
										// on recupère la liste 
										$requete="select * from personne_physique ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                             print " <td><a href='listeclientfacturation.php?modif_code=$ID_PERSONNE'>".stripslashes(donner_nom_prenom_mercredi($ID_PERSONNE))."</td>";	
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s)".$i."<br/><br/>";
?>
<table>
<tr>
<td>Client:</td>
<td> <input  readonly="true" id="chambre" type="text" value="<?php print $g_valeur_recup?>"   
size="40"/><input  readonly="true" id="idc" type="hidden" value="<?php print $g_id?>"   size="1"/>
<input readonly="true" id="date_max" type="hidden" value="<?php print $date_max_client?>"   size="0"/></td>
</tr>
<tr>
<td>N&deg; de chambre:</td>
<td> <input readonly="true" id="loge" type="text" value="<?php print $g_loge?>"   size=""/></td>
</tr>
<tr>
<td>Prix:</td>
<td> <input readonly="true" id="prixunique" type="text" value="<?php print $g_prix?>"   size="0"/></td>
</tr>
<tr>
<td>Nuit&eacute: </td>
<td> <input readonly="true" id="nui" type="text" value="<?php print $g_nui?>"   size="0"/></td>
</tr>
<tr>
<td>Montant: </td>
<td> <input readonly="true" id="prix" type="text" value="<?php print $g_montant?>"   size="0"/></td>
</tr>
</table>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
