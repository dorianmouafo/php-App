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
   		   window.open('liste_client_visite.php','Liste des clients','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=356,width=350,');
   		}
			
 	</script>";
	
   print "<script>
    	function openPopup1(){
   		   window.open('liste_choisir_chambre.php','Liste des chambres','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=356,width=350,');
   		}
			
 	</script>";
?>

<?php
 
 	 		
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	
	$gCode_utilisateur=$_SESSION["code_code"];
	
	$g_code=$_REQUEST['modif_code'];
	$g_numero_chambre=addslashes($_REQUEST['txt_numero_chambre']);
    $g_nom_du_client=addslashes($_REQUEST['txt_numidentite']);
	$g_naturobjet=addslashes($_REQUEST['txt_naturobjet']);
	$g_nombrobjet=addslashes($_REQUEST['txt_nombrobjet']);
	$g_datedepot=addslashes($_REQUEST['txt_datedepot']);
	$g_heuredepot=addslashes($_REQUEST['txt_heuredepot']);
	$g_dateretrait=addslashes($_REQUEST['txt_dateretrait']);
	$g_heureretrait=addslashes($_REQUEST['txt_heureretrait']);
	$g_observation=addslashes($_REQUEST['txt_observation']);
			
	if ($_POST['btn']=='Ajouter') $v_global=Ajout;
	elseif ($_POST['btn']=='Modifier') $v_global=Modif;
	elseif ($_POST['btn']=='Supprimer') $v_global=Suppression;
		
	$i=0;

	if (isset($v_global)){ 
		if ($v_global==Ajout){
	
		$code_nom_client=recupere_code_popup_client_objet_oublie($g_nom_du_client);		
			if ($code_nom_client!="") {			
				$g_datedepot_formatee_visiteur=dateFormBase($g_datedepot);
				$g_dateretrait_formatee_visiteur=dateFormBase($g_dateretrait);
				ajout_table_objet_oublie($g_numero_chambre,$code_nom_client,$g_naturobjet,$g_nombrobjet,$g_datedepot_formatee_visiteur,$g_heuredepot,$g_dateretrait_formatee_visiteur,$g_heureretrait,$g_observation);			
				
				print "<script language='javascript'> alert('Enregistrement effectue avec succes');</script>";
			}
			
		}
		elseif ($v_global==Modif) {
		
			
				$code_nom_client=recupere_code_popup_client_objet_oublie($g_nom_du_client);
					if ($g_naturobjet!="") {
						$g_datedepot_formatee_visiteur=dateFormBase($g_datedepot);
						$g_dateretrait_formatee_visiteur=dateFormBase($g_dateretrait);
						modif_table_objet_oublie($g_numero_chambre,$code_nom_client,$g_naturobjet,$g_nombrobjet,$g_datedepot_formatee_visiteur,$g_heuredepot,$g_dateretrait_formatee_visiteur,$g_heureretrait,$g_observation,$g_code);
				
				print "<script language='javascript'> alert('Modification effectuee avec succes'); </script>";
			}
		}
		elseif ($v_global==Suppression){
			suppression_table_objet_oublie($g_code);
			
			
		}	
		
		$g_code="";
		$g_numero_chambre="";
    	$g_nom_du_client="";
		$g_naturobjet="";
		$g_nombrobjet="";
		$g_datedepot="";
		$g_heuredepot="";
		$g_dateretrait="";
		$g_heureretrait="";
		$g_observation="";
		$i++;
	}
	
	if ($i==0) {
		if (isset($g_code)){			
			$code=$g_code;
			$g_numero_chambre=recupere_numero_chambre_objet_oublie($g_code);
			$g_nom_du_client=recupere_nom_client_table_objet_oublie($g_code);
			$g_naturobjet=recupere_nature_objet_oublie($g_code);
			$g_nombrobjet=recupere_nombre_objet_oublie($g_code);
			$g_datedepot=recupere_date_retrouve($g_code);
			$g_heuredepot=recupere_heure_retrouve($g_code);
			$g_dateretrait=recupere_date_recupere($g_code);
			$g_heureretrait=recupere_heure_recupere($g_code);
			$g_observation=recupere_observation_objet_oublie($g_code);
			
			
			
			
		}
	}
  ?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES OBJETS OUBLI&Eacute;S<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		 
										<?php 
									   require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										
										/*  print " <th class='entete_tableau' >";
										print " <strong> Code  </strong>";
	           							print " </th>"; */
										
										print " <th class='entete_tableau' >";
										print " <strong> Num&eacute;ro de la chambre  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Nom du client </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Nature de l&#39;objet </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Quantit&eacute; </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date de la trouvaille </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date de retrait </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Observations </strong>";
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
										$requete="select ID_OBJET, CODE_CHAMBRE, CONCAT(NOM_CLIENT,' ',PRENOM_CLIENT) as NOM_CLIENT, NATURE_OBJET, NOMBRE_OBJET, DATE_RETROUVE, DATE_RECUPERE, OBSERVATION from objet_oublie,personne_physique where objet_oublie.ID_PERSONNE=personne_physique.ID_PERSONNE order by ID_OBJET DESC LIMIT $limit_start, $pagination";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											// print " <td>".$ID_OBJET."</td>";
											print " <td>".stripslashes($CODE_CHAMBRE)."</td>";
											 print " <td> <a href='objet_oublie.php?modif_code=$ID_OBJET'> ".stripslashes($NOM_CLIENT)." </a></td>";
											 print " <td>".stripslashes($NATURE_OBJET)."</td>";
											 print " <td>".stripslashes($NOMBRE_OBJET)."</td>";
											 print " <td>".stripslashes($DATE_RETROUVE)."</td>";
											 print " <td>".stripslashes($DATE_RECUPERE)."</td>";
											 print " <td>".stripslashes($OBSERVATION)."</td>";
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
										$requete="SELECT * FROM objet_oublie";
										$result=mysql_num_rows(mysql_query($requete));
										print "Nombre d&#39;objets oubli&eacute;s : ".$i." sur"." $result";
										
										// Début de la pagination
										// Nb d'enregistrement total
										$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM objet_oublie');
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
										   <table class="table" style="border:hidden" width="70%">
										  <tr style="border:hidden">
												<form method="post" name="objet_oublie" action="objet_oublie.php?modif_code=<?php print $g_code; ?>" >
													<p align="center">
														 <input type="text" name="txt_code" value="<?php print $g_code; ?>" class="le_code" />
														 <td style="border:hidden"><label> Num&eacute;ro de la chambre: </label></td>
														 <td><input readonly type="text" id="numero_chambre" name="txt_numero_chambre" value="<?php print $g_numero_chambre; ?>"  size="33" /><input type="button" value="..." onClick="openPopup1()" style="width:46px; height:21px" /></td>
												    </p>
											</tr>
											
											<tr style="border:hidden"><p align="center">
												<td style="border:hidden"><label> Nom du client : </label></td>
												<td style="border:hidden"><input readonly type="text" id="nom_du_client" name="txt_numidentite" value="<?php print $g_nom_du_client; ?>"  size="33" /><input type="button" value="..." onClick="openPopup()" style="width:46px; height:21px" /></td>
											</p>
										</tr>
										  <tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Nature de l&#39;objet : </label></td>
														<td style="border:hidden"><input type="text" name="txt_naturobjet" value="<?php print $g_naturobjet; ?>"  size="33" /></td>
													</p>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Nombre de pi&egrave;ces : </label></td>
														<td style="border:hidden"><input type="text" name="txt_nombrobjet" value="<?php print $g_nombrobjet; ?>"  size="10" /></td>
													</p>
											</tr>
											<tr style="border:hidden">
													<p align="center">
                                                    	<td style="border:hidden"><label> Date de d&eacute;pot: </label></td>
														<td style="border:hidden"><input readonly type="text" name="txt_datedepot" value="<?php print $g_datedepot; ?>"  size="10" /> 
														<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.objet_oublie.txt_datedepot',"fr","1","0"); ?>
							
														<!--Heure : <input type="text" name="txt_heuredepot" value="<?php print $g_heuredepot; ?>"  size="8" /></td>  -->
													</P>
											</tr>
																
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Date de retrait: </label></td>
														<td style="border:hidden"><input readonly type="text" name="txt_dateretrait" value="<?php print $g_dateretrait; ?>"  size="10" />
														<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.objet_oublie.txt_dateretrait',"fr","1","0"); ?>

														<!-- Heure : <input type="text" name="txt_heureretrait" value="<?php print $g_heureretrait; ?>"  size="8" /></td> -->
													</p>
											</tr>															
                                                        
														
													
											
																					
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Observations : </label></td>
														<td style="border:hidden"><textarea name="txt_observation" cols="30" rows="3"><?php print $g_observation;?></textarea></td> 
														
													</p>
											</tr>
											
																						
										  </table>
                                        	
                                            
										  <br/>
										  										 
										<input type="submit" name="btn" style="width:80px; height:30px" value="Ajouter"/>
										<input type="submit" name="btn" style="width:80px; height:30px"  value="Modifier"/>
										<input type="submit" name="btn"   style="width:80px; height:30px" value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer cet objet oubli&eacute?');"/>
										<input type="reset" name="btn_Annuler" style="width:80px; height:30px" value=" Annuler "/>
															
										<input type="submit" name="btn_Imprimer" style="width:80px; height:30px" onClick="window.open('../etat/liste_objet_oublie.php','Liste des objets oubliés','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=800,width=800')" value="Imprimer" />
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
                          		