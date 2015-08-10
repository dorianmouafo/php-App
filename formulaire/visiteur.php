<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
 print "<script>
    function dateWrite(){
      opener.document.getElementById('nom_du_client').value = window.document.getElementById('nom_du_client').value;
      self.close();
	}
  </script>";
  
  print "<script>
    	function openPopup(){
   		  window.open('liste_client_visite.php','Liste des clients','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=430');
   		}
			
 	</script>";
?>

<?php 
 		
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	
	$gCode_utilisateur=$_SESSION["code_code"];
	
	$g_code=$_REQUEST['modif_code'];
    $g_nom_visiteur=addslashes($_REQUEST['txt_nom_visiteur']);
	$g_prenom_visiteur=addslashes($_REQUEST['txt_prenom_visiteur']);
	$g_numero_identite_visiteur=addslashes($_REQUEST['txt_numero_identite_visiteur']);
	$g_type_identite_visiteur=addslashes($_REQUEST['txt_typidentite_visiteur']);
	$g_sexe_visiteur=addslashes($_REQUEST['txt_sexe_visiteur']);
	
			
	if ($_POST['btn']=='Ajouter') $v_global=Ajout;
	elseif ($_POST['btn']=='Modifier') $v_global=Modif;
	elseif ($_POST['btn']=='Supprimer') $v_global=Suppression;
	
	$i=0;
	
	if (isset($v_global)){ 
		if ($v_global==Ajout){		
			if ($g_nom_visiteur!="") {
				ajout_visiteur($g_nom_visiteur,$g_prenom_visiteur,$g_numero_identite_visiteur,$g_type_identite_visiteur,$g_sexe_visiteur);
				
				print "<script language='javascript'> alert('Enregistrement effectue avec succes');</script>";
				
			}
		}
		elseif ($v_global==Modif) {
			 if ($g_nom_visiteur!="") {
				 modif_visiteur($g_nom_visiteur,$g_prenom_visiteur,$g_numero_identite_visiteur,$g_type_identite_visiteur,$g_sexe_visiteur,$g_code);
				 
				 print "<script language='javascript'> alert('Modification effectuee avec succes');</script>";
				 
				
			}
		}
		elseif ($v_global==Suppression){
			suppression_visiteur($g_code);
			
		}	
		
		$g_code="";
		$g_nom_visiteur="";
    	$g_prenom_visiteur="";
		$g_numero_identite_visiteur="";
		$g_type_identite_visiteur="";
		$g_sexe_visiteur="";
		$i++;
	}
	
	if ($i==0) {
		if (isset($g_code)){
		$code=$g_code;
		$g_nom_visiteur=recup_nom_visiteur_table($g_code); 
		$g_prenom_visiteur=recup_prenom_visiteur_table($g_code); 
		$g_numero_identite_visiteur=recup_num_ident_visiteur_table($g_code);
		$g_type_identite_visiteur=recup_type_identite_visiteur_table($g_code);
		$g_sexe_visiteur=recup_sexe_table_visiteur($g_code);
		
		}
	}
  ?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">ENREGISTREMENT D&#39;UN VISITEUR<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		 
<div class="onglets">
            <div class="onglet_y onglet"><a href="visiteur.php" ><h2 class="art-postheader">Visiteur</h2></a></div>
            <div class="onglet_n onglet"><a href="visite_effectue.php"><h2 class="art-postheader">Visite</h2></a></div>
        </div>
												 <?php 
									require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Nom </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Pr&eacute;nom   </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Num&eacute;ro d&#39;identit&eacute;</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Type d&#39;identit&eacute; </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Sexe </strong>";
	           							print " </th>";
														
										// Début de la pagination
										 // Numero de page (1 par défaut)
                                        if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =5;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;
										// Fin de la pagination
																	
										// on recupère la liste 
										$requete="select * from visiteur order by ID_VISITEUR DESC LIMIT $limit_start, $pagination";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='visiteur.php?modif_code=$ID_VISITEUR'> ".stripslashes($NOM_VISITEUR)." </a></td>";
											 print " <td>".stripslashes($PRENOM_VISITEUR)."</td>";
											 print " <td>".stripslashes($NUM_IDENTITE_VISITEUR)."</td>";
											 print " <td>".stripslashes($TYPE_IDENTITE)."</td>";		
										     print " <td>".stripslashes($SEXE_VISITEUR)."</td>";
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
										$requete="SELECT * FROM visiteur";
										$result=mysql_num_rows(mysql_query($requete));
										print "Nombre de visiteurs : ".$i." sur"." $result";
										
										
										// Début de la pagination
										// Nb d'enregistrement total
										$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM visiteur');
										$nb_total = mysql_fetch_array($nb_total);
										$nb_total = $nb_total['nb_total'];

										// Pagination
										$nb_pages = ceil($nb_total / $pagination);

										// Affichage
										echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';
										// Fin de la pagination
										
									 ?> 
										  <div class="art-postmetadataheader">
                                              
                                          </div>
                                          <div class="art-postcontent">
                                          </div>
                                          <div class="cleared"></div>
                                          <div class="art-postmetadatafooter">
                                             
                                          </div>
                          </div>
                          
                          		<div class="cleared"></div>
                              </div>
                          </div>
                          <div class="art-post">
                              <div class="art-post-tl"></div>
                              <div class="art-post-tr"></div>
                              <div class="art-post-bl"></div>
                              <div class="art-post-br"></div>
                              <div class="art-post-tc"></div>
                              <div class="art-post-bc"></div>
                              <div class="art-post-cl"></div>
                              <div class="art-post-cr"></div>
                              <div class="art-post-cc"></div>
                              <div class="art-post-body">
                          <div class="art-post-inner art-article"><strong  style="text-align:center;" ></strong>
                                          <h2 class="art-postheader"><a href="#" title="Permanent Link to this Post"></a></h2>
                                          <div class="art-postmetadataheader">
										   <table class="table" style="border:hidden" width="65%">
										  <tr style="border:hidden">	<form method="post" action="visiteur.php?modif_code=<?php print $g_code; ?>" >
													<p align="center">
														 <input type="text" name="txt_code" value="<?php print $g_code; ?>" class="le_code" />
														<td style="border:hidden"><label> Nom : </label></td>
														<td style="border:hidden"><input type="text" name="txt_nom_visiteur" value="<?php print $g_nom_visiteur; ?>"  size="31" /></td>
												    </p>
											</tr>
											
										  <tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Pr&eacute;nom : </label></td>
														<td style="border:hidden"><input type="text" name="txt_prenom_visiteur" value="<?php print $g_prenom_visiteur; ?>"  size="31" /></td>
													</p>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Num&eacute;ro d&#39;identit&eacute; : </label></td>														
														<td style="border:hidden"><input type="text" name="txt_numero_identite_visiteur" value="<?php print $g_numero_identite_visiteur; ?>"  size="31" /></td>
													</p>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label>Type d&#39;identit&eacute; : </label></td>
														<td style="border:hidden"><select name="txt_typidentite_visiteur" value="<?php print $g_typidentite_visiteur; ?>"> 
																<option> Choisir </option>
																<option> CNI </option>
																<option> Passeport </option>
															</select>
														</td>
													</p>
											</tr>										
											
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Sexe : </label></td>
														<td style="border:hidden"><select name="txt_sexe_visiteur" value="<?php print $g_sexe_visiteur; ?>"> 
																<option> Choisir </option>
																<option> Masculin </option>
																<option> F&eacute;minin </option>
															</select>
														</td>
													</p>
											</tr>				
											
										  </table>
										  
										  <br/>  										 
									<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter" />
									<input type="submit" style="width:80px; height:30px" name="btn"   value="Modifier"/>
									<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer ce visiteur?')"/>
									<input type="reset" style="width:80px; height:30px" name="btn_Annuler" value=" Annuler "/>
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onClick="window.open('../etat/liste_visiteur.php','Liste des visiteurs','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=800,width=800')" value="Imprimer" />
									</form> 
                                              <div class="art-postheadericons art-metadata-icons">
                                                 
                                                </div>
                                          </div>
                                          <div class="art-postcontent">
                                             
                                             
                                          </div>
                                          
                          </div>
<?php 
include('decoupagebon/coupe2.php');
?>              
                          		