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
      opener.document.getElementById('numero_chambre').value = window.document.getElementById('numero_chambre').value;
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
    $g_numero_chambre=addslashes($_REQUEST['txt_numero_chambre']);
	$g_numero_des_chambres=addslashes($_REQUEST['txt_numero_des_chambres']);
	echo $g_numero_des_chambres;
	
	if ($_POST['btn']=='Rechercher') $v_global=Recherche;
	elseif ($_POST['btn']=='Afficher tout') $v_global=Affichage;
	
	$i=0;

	if (isset($v_global)){ echo $v_global;
		if ($v_global==Recherche){
				if ($g_numero_des_chambres!=""){
				$requete="SELECT CODE_CHAMBRE,LIBELLE_CHAMBRE, LIBELLE_TYPE_CHAMBRE FROM chambre, type_chambre WHERE chambre.CODE_TYPE_CHAMBRE=type_chambre.CODE_TYPE_CHAMBRE AND LIBELLE_CHAMBRE LIKE '$g_numero_des_chambres%'";
				$result=mysql_query($requete, $link);
				echo $requete;
			}
		}
	
		elseif ($v_global==Affichage){
			$requete="SELECT CODE_CHAMBRE,LIBELLE_CHAMBRE, LIBELLE_TYPE_CHAMBRE FROM chambre, type_chambre WHERE chambre.CODE_TYPE_CHAMBRE=type_chambre.CODE_TYPE_CHAMBRE ORDER BY LIBELLE_CHAMBRE asc";
			$result=mysql_query($requete, $link);
			echo $requete;
			
			
		}	
	}
			
	if ($i==0) {
		if (isset($g_code)){			
			$code=$g_code;
			$g_numero_chambre=recupere_code_popup_numero_chambre_objet_oublie($g_code);
			
			}
	}
  ?>

<body>

										<table class="table" style="border:hidden" width="65%">
										    <tr style="border:hidden">
												<form method="post" name="liste_client_visite" action="liste_choisir_chambre.php?modif_code=<?php print $g_code; ?>" >  
													<tr style="border:hidden">
														<p align="center">
															<td><label> Rechercher : </label>
																<input type="text" id="numero_des_chambres" name="txt_numero_des_chambres" value="<?php print $g_numero_des_chambres; ?>"  size="10" />
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
										print " <strong> Num&eacute;ro  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Type</strong>";
	           							print " </th>";
																																																																			
																			
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result)){  
											extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='liste_choisir_chambre.php?modif_code=$CODE_CHAMBRE'> ".stripslashes($LIBELLE_CHAMBRE)."</a></td>";
											 print " <td>".stripslashes($LIBELLE_TYPE_CHAMBRE)."</td>";
																					 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
										print "Nombre de chambre(s) : ".$i;
																																			
									 ?>
											<p align="center">
												<td><label> Nom : </label></td>
												<td><input readonly type="text" id="numero_chambre" name="txt_numero_chambre" value="<?php print $g_numero_chambre; ?>"  size="35" /><input type="button" value="Valider" onClick="dateWrite()" style="width:50px; height:21px"/></td>
											</p>
</body>
</html>
