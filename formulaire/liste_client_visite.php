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
      opener.document.getElementById('nom_du_client').value = window.document.getElementById('nom_du_client').value;
      self.close();
    }
  </script>

</head>
<html>
<?php 
 	 		
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$link=Connexion();
	
	$gCode_utilisateur=$_SESSION["code_code"];
	
	$g_code=$_REQUEST['modif_code'];
    $g_nom_du_client=addslashes($_REQUEST['txt_nom_du_client']);
	$g_noms_des_clients=addslashes($_REQUEST['txt_noms_des_clients']);
	echo $g_noms_des_clients;
	
	if ($_POST['btn']=='Rechercher') $v_global=Recherche;
	elseif ($_POST['btn']=='Afficher tout') $v_global=Affichage;
	
	$i=0;

	if (isset($v_global)){ echo $v_global;
		if ($v_global==Recherche){
				if ($g_noms_des_clients!=""){
				$requete="SELECT ID_CLIENT, NOM_CLIENT, PRENOM_CLIENT FROM personne_physique WHERE NOM_CLIENT LIKE '$g_noms_des_clients%'";
				$result=mysql_query($requete, $link);
				echo $requete;
			}
		}
	
		elseif ($v_global==Affichage){
			$requete="select ID_CLIENT, NOM_CLIENT, PRENOM_CLIENT from personne_physique order by NOM_CLIENT ASC";
			$result=mysql_query($requete, $link);
			echo $requete;
			
			
		}	
	}
			
	if ($i==0) {
		if (isset($g_code)){			
			$code=$g_code;
			$g_nom_du_client=recupere_nom_prenom_client_dans_liste_client_visite($g_code);
			
			}
	}
  ?>
<body>

										<table class="table" style="border:hidden" width="65%">
										    <tr style="border:hidden">
												<form method="post" name="liste_client_visite" action="liste_client_visite.php?modif_code=<?php print $g_code; ?>" >  
													<tr style="border:hidden">
														<p align="center">
															<td><label> Rechercher : </label>
																<input type="text" id="noms_des_clients" name="txt_noms_des_clients" value="<?php print $g_noms_des_clients; ?>"  size="10" />
																<input type="submit" name="btn" style="width:80px; height:21px" value="Rechercher"/>
															</td>										
														</p>
													</tr>
													
													<tr>
														<td style="text-align:right">
															<input type="submit" name="btn" style="width:80px; height:21px" value="Afficher tout"/>
														</td>
													</tr>
												</form>
											</tr>
										</table>

                                        <?php 
									   require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										
																				
										print " <th class='entete_tableau' >";
										print " <strong> Nom  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Pr&eacute;nom </strong>";
	           							print " </th>";
																																																																			
																			
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result)){  
											extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='liste_client_visite.php?modif_code=$ID_CLIENT'> ".stripslashes($NOM_CLIENT)."</a></td>";
											 print " <td>".stripslashes($PRENOM_CLIENT)."</td>";
																					 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
										print "Nombre de clients : ".$i;
																																			
									 ?>
											<p align="center">
												<td><label> Nom : </label></td>
												<td><input readonly type="text" id="nom_du_client" name="txt_nom_du_client" value="<?php print $g_nom_du_client; ?>"  size="35" /><input type="button" value="Valider" onClick="dateWrite()" style="width:50px; height:21px"/></td>
											</p>
</body>
</html>