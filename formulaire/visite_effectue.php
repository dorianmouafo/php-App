<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
 print "<script>
    	function openPopup(){
   		   window.open('liste_client_visite.php','Liste des clients','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=430');
   		}
	
		function openPopup1(){
   		   window.open('liste_visiteur_client.php','Liste des visiteurs','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=356,width=350');
 	   }
 	</script>";
?>

<?php
 require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	
	$gCode_utilisateur=$_SESSION["code_code"];
	
	$g_code=$_REQUEST['modif_code'];	
    $g_nom_visite=addslashes($_REQUEST['nom_visit']);
    $g_nom_du_visiteur=addslashes($_REQUEST['txt_nom_du_visiteur']);
	$g_date_arrivee=addslashes($_REQUEST['txt_date_arrivee']);
	$g_date_depart=addslashes($_REQUEST['txt_date_depart']);
	$g_heurarrivee=addslashes($_REQUEST['txt_heurarrivee']);	
	$g_heuredepart=addslashes($_REQUEST['txt_heuredepart']);
	
	if ($_POST['btn']=='Ajouter') {$v_global=Ajout;}
	elseif ($_POST['btn']=='Modifier') {$v_global=Modif;}
	elseif ($_POST['btn']=='Supprimer') {$v_global=Suppression;}
		
	$i=0;

	if (isset($v_global)){
		if ($v_global==Ajout){
			$g_id_personne_recupere=recupere_id_personne_pour_table_recevoir($g_nom_visite);
			$g_id_visiteur_recupere=recupere_id_visiteur_pour_table_recevoir($g_nom_du_visiteur);
			
			if ($g_nom_visite!=""){	
				$g_date_arrivee_formatee_visiteur=dateFormBase($g_date_arrivee);
				$g_date_depart_formatee_visiteur=dateFormBase($g_date_depart);
				ajout_table_recevoir($g_id_personne_recupere,$g_id_visiteur_recupere,$g_date_arrivee_formatee_visiteur,$g_heurarrivee,$g_date_depart_formatee_visiteur,$g_heuredepart);
			
			print "<script language='javascript'> alert('Enregistrement effectue avec succes');</script>";
			
			}
						
		}
		elseif ($v_global==Modif){
			$g_id_personne_recupere=recupere_id_personne_pour_table_recevoir($g_nom_visite);
			$g_id_visiteur_recupere=recupere_id_visiteur_pour_table_recevoir($g_nom_du_visiteur);
			$g_date_arrivee_formatee_visiteur=dateFormBase($g_date_arrivee);
			$g_date_depart_formatee_visiteur=dateFormBase($g_date_depart);
			modif_table_recevoir($g_id_personne_recupere,$g_id_visiteur_recupere,$g_date_arrivee_formatee_visiteur,$g_heurarrivee,$g_date_depart_formatee_visiteur,$g_heuredepart,$g_code);
			
			print "<script language='javascript'> alert('Modification effectuee avec succes');</script>";
			
		}
		
		elseif ($v_global==Suppression){
			suppression_table_recevoir($g_code);
				}	
		
		
				  $g_nom_visite="";
				  $g_nom_du_visiteur="";
				  $g_date_arrivee="";
				  $g_date_depart="";
				  $g_heurarrivee="";				  
				  $g_heuredepart="";
		$i++;
		
	}
	
	if ($i==0) {
		if (isset($g_code)){
		$code=$g_code;
		$g_nom_visite=recupere_nom_client_table_recevoir($g_code);
		$g_nom_du_visiteur=recupere_nom_visiteur_table_recevoir($g_code);
		$g_date_arrivee=recupere_date_entree_table_recevoir($g_code);
		$g_date_depart=recupere_date_sortie_table_recevoir($g_code);
		$g_heurarrivee=recupere_heure_entree_table_recevoir($g_code);		
		$g_heuredepart=recupere_heure_sortie_table_recevoir($g_code);
		}
	}
  ?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">ENREGISTREMENT D&#39;UNE VISITE<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <div class="onglets">
            <div class="onglet_y onglet"><a href="visiteur.php" ><h2 class="art-postheader">Visiteur</h2></a></div>
            <div class="onglet_n onglet"><a href="visite_effectue.php"><h2 class="art-postheader">Visite</h2></a></div>
        </div>
										  
										  
										  
                                          <?php 
									require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Nom du client </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Nom du visiteur  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date d&#39;arriv&eacute;e </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date de d&eacute;part </strong>";
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
										$requete="SELECT ID_VISITE, CONCAT(NOM_CLIENT,' ',PRENOM_CLIENT) AS NOM_CLIENT , CONCAT(NOM_VISITEUR,' ',PRENOM_VISITEUR) AS NOM_VISITEUR, DATE_ENTREE_VISITEUR, DATE_SORTIE_VISITEUR FROM recevoir, visiteur, personne_physique WHERE recevoir.ID_PERSONNE=personne_physique.ID_PERSONNE AND recevoir.ID_VISITEUR=visiteur.ID_VISITEUR order by ID_VISITE DESC LIMIT $limit_start, $pagination";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='visite_effectue.php?modif_code=$ID_VISITE'> ".stripslashes($NOM_CLIENT)." </a></td>";
											 print " <td>".stripslashes($NOM_VISITEUR)."</td>";
											 print " <td>".stripslashes($DATE_ENTREE_VISITEUR)."</td>";
											 print " <td>".stripslashes($DATE_SORTIE_VISITEUR)."</td>";					 
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
										$requete="SELECT * FROM recevoir";
										$result=mysql_num_rows(mysql_query($requete));
										print "Nombre de visites : ".$i." sur"." $result";
										
										// Début de la pagination
										// Nb d'enregistrement total
										$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM recevoir');
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
										
										  <tr><br/>
												<form method="post" name="visite" action="visite_effectue.php?modif_code=<?php print $g_code; ?>" >
													<p align="center">
								 <input type="text" name="code" value="<?php print $g_code; ?>" class="le_code" />
											

									    <tr style="border:hidden"><p align="center">
												<td style="border:hidden"><label> Nom du client: </label></td>												
												<td style="border:hidden"><input readonly type="text" id="nom_du_client" name="nom_visit" value="<?php print $g_nom_visite; ?>"  size="35" /><input type="button" value="..." onClick="openPopup()" style="width:46px; height:21px" /> <!--<input type="submit" style="width:46px; height:21px" name="btn"  value="Liste..." onClick="window.open('liste_client_visite.php','Liste des clients','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=356,width=350')" /> --> </td>
											</p>
										</tr>
										
										<tr style="border:hidden"><p align="center">
												<td style="border:hidden"><label> Nom du visiteur: </label></td>
												<td><input readonly type="text" id="nom_du_visiteur" name="txt_nom_du_visiteur" value="<?php print $g_nom_du_visiteur; ?>"  size="35" /><input type="button" value="..." onClick="openPopup1()" style="width:46px; height:21px" />  <!-- <input type="submit" style="width:46px; height:21px" name="btn"  value="Liste..." onClick="window.open('liste_visiteur_client.php','Liste des visiteurs','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=356,width=350')" />  --></td>
											</p>
										</tr>
										
										<tr style="border:hidden"><td><label> date d&#39;arriv&eacute;e: </label></td>
											<td style="border:hidden"><input type="text" name="txt_date_arrivee" value="<?php print $g_date_arrivee; ?>"  size="10" /> 
											<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.visite.txt_date_arrivee',"fr","1","0"); ?>
										</tr>
										
									<!--	<tr style="border:hidden">										
											<td><label>Heure d&#39;arriv&eacute;e:</label></td>
											<td><input type="text" name="txt_heurarrivee" value="<?php print $g_heurarrivee; ?>"  size="10"/><input type="button" value="..." onClick="<?php print $g_heurarrivee=date('H:i:s');?>" style="width:46px; height:21px" /></td>
										</tr> 
											
										<tr style="border:hidden">										
											<td><label>Heure de d&eacute;part:</label></td>
											<td><input type="text" name="txt_heuredepart" value="<?php print $g_heuredepart; ?>"  size="10" /></td>
										</tr>	-->
											
										<tr style="border:hidden">
											<td style="border:hidden"><label> Date de d&eacute;part: </label></td>
											<td style="border:hidden"><input type="text" name="txt_date_depart" value="<?php print $g_date_depart; ?>"  size="10" /> 
											<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.visite.txt_date_depart',"fr","1","0"); ?>
										</tr>
										
										
										
									 </table>
										  <br/>  										 
									<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
									<input type="submit" style="width:80px; height:30px" name="btn"   value="Modifier"/>
									<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer cette consigne?');"/>
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
                          		