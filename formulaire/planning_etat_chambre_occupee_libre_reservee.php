<?php session_start();
include('decoupagebon/coupe1.php');

?>

<?php
 
 	 		
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$link=Connexion();
	
	$gCode_utilisateur=$_SESSION["code_code"];
	
	$g_code=$_REQUEST['modif_code'];
	$g_date_debut_planning=addslashes($_REQUEST['txt_date_debut_planning']);
	$g_date_fin_planning=addslashes($_REQUEST['txt_date_fin_planning']);

	$g_date_debut_formatee_affichage=dateFormBase($g_date_debut_planning);
	$g_date_fin_formatee_affichage=dateFormBase($g_date_fin_planning);
	
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
                                          <h2 class="art-postheader" style="text-align:center;">PLANNING DES CHAMBRES PAR P&Eacute;RIODE<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		 
										<?php 
									/*    require_once('../procedure_php/procedure_globale.php');
									    require_once('../procedure_php/mysql_requette.php');
									   $link=Connexion();
									   
									   	$jour=date(D);															
										$date_en_cours=date('y-M-d');
										$date_de_debut=date($g_date_debut_formatee_affichage); 
										$date_de_fin=date($g_date_fin_formatee_affichage);
										$heure_courante=date("H:i:s"); 
										$jour_de_la_date=date('d',strtotime($date_de_debut));
										$mois_de_la_date=date('m',strtotime($date_de_debut));
																																						
										print "<table class='table' border:1 width='100%'>";
										
																			
										print " <th style='background-color:'>";
										print " <strong></strong>";
										print " </th>";
										
										$i=0;
										
										// on recupère la liste 
										$requete="select LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
										$result2=mysql_query($requete, $link);
																			
														  
										// on affiche la liste de l'état des chambres
										while($lecture=mysql_fetch_array($result2)){
											extract($lecture);
											 
											print " <th class='entete_tableau' >";
										    print " <strong>".stripslashes($LIBELLE_CHAMBRE)."</strong>";
	           						     	print " </th>"; 

										}
										
																				
										// je récupère le nombre de chambres pour ma boucle
										$requete="SELECT * from chambre";
										$result_chambre=mysql_num_rows(mysql_query($requete));
										$boucle=$result_chambre;
																					  
										
										while($date_de_debut <= $date_de_fin){
																						 
											print " <tr	class='entete_tableau' >";
										    print " <td>".$date_de_debut. "</td>";
											//echo $date_de_debut;
											
											$code_de_la_chambre=recupere_code_chambre_avec_libelle($LIBELLE_CHAMBRE);
																						
											$requete1="select code_chambre as code, LIBELLE_CHAMBRE as libelle from chambre order by LIBELLE_CHAMBRE ASC";
										    $result3=mysql_query($requete1, $link);
																			
														  
										    // on affiche la liste de l'état des chambres
										    while($lecture=mysql_fetch_array($result3)){
											     extract($lecture);
											    $couleur=recupere_couleur_planning_chambre($code,$date_de_debut);
											    print " <td ";
												print "style='background-color:$couleur' />"; 
												
										    //    print " <strong>".stripslashes($couleur)."</strong>";
												
	           						     	    print " </td>"; 

											}									
											
											$boucle=$result_chambre;
											
	           						     	print " </tr>"; 
											 
											 $date_de_debut=jour_suivant($date_de_debut);
											
										}
										
									

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
												<form method="post" name="objet_oublie" action="planning_etat_chambre_occupee_libre_reservee.php?modif_code=<?php print $g_code; ?>" >
													<p align="center">
                                                    	<td style="border:hidden"><label> Date de d&eacute;but: </label></td>
														<td style="border:hidden"><input readonly type="text" name="txt_date_debut_planning" value="<?php print $g_date_debut_planning; ?>"  size="10" /> 
														<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.objet_oublie.txt_date_debut_planning',"fr","1","0"); ?>
													</P>
											</tr>
											
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Date de fin : </label></td>
														<td style="border:hidden"><input readonly type="text" name="txt_date_fin_planning" value="<?php print $g_date_fin_planning; ?>"  size="10" />
														<?php include_once("../calendrierphp/calendar.php"); calendarpopupDim('id1','document.objet_oublie.txt_date_fin_planning',"fr","1","0"); ?>
													</p>
											</tr>								  			
																								
										  </table>  <br/>
										  										 
									<input type="submit" name="btn" style="width:80px; height:30px" onClick="window.open('../etat/etat_planning_etat_chambre_occupee_libre_reservee.php','MONTANTS ENCAISSES POUR LES CHAMBRES','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=800,width=1200')" value="Afficher"/>
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
                          		