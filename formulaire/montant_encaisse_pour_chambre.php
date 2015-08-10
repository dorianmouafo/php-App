<?php session_start();
include('decoupagebon/coupe1.php');

?>

<?php
 
 	 		
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$link=Connexion();
	
	$gCode_utilisateur=$_SESSION["code_code"];
	
	$g_code=$_REQUEST['modif_code'];
	$g_date_debut_encaissement=addslashes($_REQUEST['txt_date_debut_planning']);
	$g_date_fin_encaissement=addslashes($_REQUEST['txt_date_fin_planning']);
					
	$g_date_debut_formatee_affichage=dateFormBase($g_date_debut_encaissement);
	$g_date_fin_formatee_affichage=dateFormBase($g_date_fin_encaissement);			
	
	if ($_POST['btn']=='Afficher') $v_global=Affichage;{
		$_SESSION['date_de_debut']=$g_date_debut_formatee_affichage;
		$_SESSION['date_de_fin']=$g_date_fin_formatee_affichage;
	}

	$i=0;

	if (isset($v_global)){ 
		if ($v_global==Affichage){
	
			
			$g_code_etat_chambre=recupere_code_combo_etat_chambre($g_etat_chambre);

			
			$g_date_changement_etat=recupere_date_changement_dans_table_avoir($g_code_etat_chambre);
			$g_date=$g_date_debut_formatee_affichage;
			$g_date_fin_etat=recupere_date_fin_etat_dans_table_avoir($g_code_etat_chambre);
		}	
	}
	
	
	if ($i==0) {
		if (isset($g_code)){			
			$code=$g_code;
		}
	}
  ?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">MONTANT DES CHAMBRES PAR P&Eacute;RIODE<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		 
										<?php 
									/*   require_once('../procedure_php/mysql_requette.php');
									   require_once('../procedure_php/procedure_globale.php');
									   $link=Connexion();
									   
									   	$date_de_debut=date($g_date_debut_formatee_affichage); 
										$date_de_fin=date($g_date_fin_formatee_affichage);
																																					
										print "<table class='table' border:1 width='100%'>";										
																			
										print " <th style='background-color:'>";
										print " <strong></strong>";
										print " </th>";
										
										$i=0;
										
										// Début de la création de l'entête du tableau avec les chambres										
										$requete="select LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
										$result2=mysql_query($requete, $link);
																														
										while($lecture=mysql_fetch_array($result2)){
											extract($lecture);
											 
											print " <th class='entete_tableau' >";
										    print " <strong>".$LIBELLE_CHAMBRE."</strong>";
	           						     	print " </th>"; 

										}										
										
										
										print " <th class='entete_tableau' >";
										print " <strong>Total par jour</strong>";
	           						    print " </th>";										
										
										
										// Début de la création da la colonne date au début du tableau										
										// je récupère le nombre de chambres pour ma boucle
										$requete="SELECT * from chambre";
										$result_chambre=mysql_num_rows(mysql_query($requete));
										$boucle=$result_chambre;									
										
										while($date_de_debut <= $date_de_fin){
																						 
											print " <tr	class='entete_tableau' >";
										    print "<td>".$date_de_debut."</td>";
																						
											$code_de_la_chambre=recupere_code_chambre_avec_libelle($LIBELLE_CHAMBRE);
																						
											$requete1="select code_chambre as code, LIBELLE_CHAMBRE as libelle from chambre order by LIBELLE_CHAMBRE ASC";
										    $result3=mysql_query($requete1, $link);
																			
											$total_jour=0;				    
										    while($lecture=mysql_fetch_array($result3)){
											     extract($lecture);
											
											    $montant_du_jour=recupere_montant_chambre_par_jour($code,$date_de_debut);
											    print " <td>".$montant_du_jour."</td>";
											    $total_jour+=$montant_du_jour; 
											}
											
											print "<td class='entete_tableau'>  ";
											print "<strong> $total_jour </strong>";
											print "</td>";
																																									
											$boucle=$result_chambre;
											
	           						     	print " </tr>"; 
											 
											 $date_de_debut=jour_suivant($date_de_debut);							 
																															
										}										
										// Fin de la création da la colonne date au début du tableau
										
										// Début de la ligne du montant total produit par chambre										
										print " <th class='entete_tableau' >Total par chambre </th>";											
										
										
															
										$date_de_debut=date($g_date_debut_formatee_affichage); 
										
										$date_de_fin=date($g_date_fin_formatee_affichage); 
																																
										$requete="select CODE_CHAMBRE as code, LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
										$result3=mysql_query($requete, $link);
																							
										$total_pour_la_periode=0;
										while($lecture=mysql_fetch_array($result3)){
											extract($lecture);
											
											
											$cout_montant=cout_chambre_periode($code,$date_de_debut,$date_de_fin);																		 
										 
											print " <td class='entete_tableau'>";
											print " <strong>".$cout_montant."</strong>";
											$total_pour_la_periode+=$cout_montant;
											print " </td>";
																																								
										}
											print "<td class='entete_tableau'>  ";
											print "<strong> $total_pour_la_periode </strong>";
											print "</td>";
										// Fin de la ligne du montant total produit par chambre											

									print "</table>";	*/
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
                          <div class="art-post-inner art-article">&nbsp;D&eacute;finissez une p&eacute;riode<strong  style="text-align:center;" ></strong>
                                          <h2 class="art-postheader"><a href="#" title="Permanent Link to this Post"></a></h2>
                                          <div class="art-postmetadataheader"><br>
										   <table class="table" style="border:hidden" width="40%">
										  <tr style="border:hidden">
												<form method="post" name="objet_oublie" action="montant_encaisse_pour_chambre.php?modif_code=<?php print $g_code; ?>" >
													<p align="center">
                                                    	<td style="border:hidden"><label> Date de d&eacute;but: </label></td>
														<td style="border:hidden"><input readonly type="text" name="txt_date_debut_planning" value="<?php print $g_date_debut_encaissement; ?>"  size="10" /> 
														<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.objet_oublie.txt_date_debut_planning',"fr","1","0"); ?>
							
														<!--Heure : <input type="text" name="txt_heuredepot" value="<?php print $g_heuredepot; ?>"  size="8" /></td>  -->
													</P>
											</tr>
											
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Date de fin : </label></td>
														<td style="border:hidden"><input readonly type="text" name="txt_date_fin_planning" value="<?php print $g_date_fin_encaissement; ?>"  size="10" />
														<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.objet_oublie.txt_date_fin_planning',"fr","1","0"); ?>

														<!-- Heure : <input type="text" name="txt_heureretrait" value="<?php print $g_heureretrait; ?>"  size="8" /></td> -->
													</p>
											</tr>								  			
																								
										  </table>  <br/>
										  										 
									<input type="submit" name="btn" style="width:80px; height:30px" onClick="window.open('../etat/etat_montant_encaisse_pour_chambre.php','MONTANTS ENCAISSES POUR LES CHAMBRES','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=800,width=1200')" value="Afficher"/>
									<!--	<input type="submit" name="btn_Imprimer" style="width:80px; height:30px"  onClick="window.open('../etat/liste_objet_oublie.php','Liste des objets oubliés','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=800,width=800')" value="Imprimer" /> -->
									</form><br/><br/><br/> 
                                              <div class="art-postheadericons art-metadata-icons">
                                                 
                                                </div>
                                          </div>
                                          <div class="art-postcontent">
                                             
                                             
                                          </div>
                                          
                          </div>
<?php 
include('decoupagebon/coupe2.php');
?>              
                          		