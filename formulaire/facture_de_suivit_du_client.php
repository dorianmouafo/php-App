<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
 
$retour_date_reserve=date('d/m/Y');
?>

<script type="text/javascript">
        //<!--
                function change_onglet(name)
                {
                        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }
        //-->
        </script>
		

<?php
 		//appel de tous les dossiers qui contienent les fonction que je vqis utiliser
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	//$g_code=addslashes($_REQUEST['code']);
	    $g_numero=addslashes($_REQUEST['numero']);                                            
	    $g_date_fac=addslashes($_REQUEST['date_fac']);
		$g_net=addslashes($_REQUEST['net']);	
	    $g_rest=addslashes($_REQUEST['rest']);
		$g_client=addslashes($_REQUEST['client']);
		$g_avance=addslashes($_REQUEST['avance']);
		$g_date_operation=addslashes($_REQUEST['date_operation']);
		
													
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=="Ajouter"){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=="Annuler"){$v_global="Annuler";}
	//print $g_code;
	$retour=date('Y-m-d');
	$i=0;
	if (isset($v_global)){
	        $g_date_operation_insert=dateFormBase($g_date_operation);
	   
	     if($v_global==Ajout){
		        if($g_avance=="" OR $g_date_operation=="" OR $g_date_operation_insert==""){
				print "<script language='javascript'> alert('veillez saisir le montant de l avance et la date'); </script>";
				}
				else{
				
				ajout_avance_occupation_suivit($g_code,$g_avance,$g_date_operation_insert);
				}
		          
		           
		 
		
		
		}
		
		
		
		
		
		elseif($v_global==Modif){	
				print "<script language='javascript'> alert('Operation impossible'); </script>";
		}
		//bouton annuler
		
		elseif($v_global==Suppression){
		print "<script language='javascript'> alert('Operation impossible'); </script>";
   		}
		elseif($v_global=="Annuler"){
		  $g_numero="";
		  $g_date_operation="";
		  $g_avance="";
		  $g_client="";
		  $g_rest="";
		  $g_net="";
		  $g_date_fac="";
		}
      $i++;
	   
	   
	   
	      $g_numero="";
		  $g_date_operation="";
		  $g_avance="";
		  $g_client="";
		  $g_rest="";
		  $g_net="";
		  $g_date_fac="";
	}
	
	if ($i==0){
	    if (isset($g_code)){
		     $etat_conso_affiche='0';
			$lecode_chambre=recupere_code_chambre_for_suivit($g_code);
			$le_idpersonne=recupere_id_personne_chambre_for_suivit($g_code);
			$ladate_dentree=recupere_date_entree_personne_chambre_for_suivit($g_code);
			$ladte_sortie=recupere_date_sortie_personne_chambre_for_suivit($g_code);
			$le_codetype_de_chambre=recupere_type_chambre_for_suivit($lecode_chambre);
			
			$lemontant_prix_chambre=recupere_montant_type_chambre_for_suivit($le_codetype_de_chambre);
			$la_nuite=recupere_nuit_client_type_chambre_for_suivit($g_code,$le_idpersonne,$ladate_dentree);
			$le_montant_chambre=$lemontant_prix_chambre*$la_nuite;
			
			$le_id_client=recupere_id_client_personne_occupant_for_suivit($le_idpersonne);
			$lemontant_services=recupere_consommation_personne_occupant_for_suivit($le_id_client,$etat_conso_affiche,$ladate_dentree,$ladte_sortie);
			
	        $g_net=formatage3Pos($lemontant_services+$le_montant_chambre);
			
			
			$la_sommes_des_avances=recupere_som_avancement_for_suivit($g_code);
			
			$g_rest= formatage3Pos(($lemontant_services+$le_montant_chambre)-$la_sommes_des_avances);
			$g_client=retour_nomprenom_liste_suivit_table($le_idpersonne);
		}
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES AVANCES CLIENT EN LOGEMENT<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										 $etat_conso='0';
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Client </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Chambre</strong>";
	           							print " </th>";
										
										
										print " <th class='entete_tableau' >";
										print " <strong> Date d entree </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Montant Net a payer</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Montant des verses </strong>";
	           							print " </th>";
										
										
										print " <th class='entete_tableau' >";
										print " <strong> Reste </strong>";
	           							print " </th>";
										
										   // Numero de page (1 par défaut)
                                        if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =30;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;											
													   // Préparation de la requête														
										// on recupère la liste 
										
										$requete="select *  from occuper order by 	DATE_ENTREE  desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{      extract($lecture);
										       $id_occup=$lecture[ID_OCCUPATION];
										       $id_personne=$lecture[ID_PERSONNE];
											   $id_chambre=$lecture[CODE_CHAMBRE];
										       $id_date=$lecture[DATE_ENTREE];
											   $id_date_sort=$lecture[DATE_SORTIE];
										        //je recupere le type de chambre occuppe pour chaque client
												$code_typechambre=recupere_type_chambre_for_suivit($id_chambre);
												//je recupre le prix associe au type de chmabre
												$prix_type_chambre=recupere_montant_type_chambre_for_suivit($code_typechambre);
												//je recupere lannuite pour chaque occupation
												 $nuitee_potentiel=recupere_nuit_client_type_chambre_for_suivit($id_occup,$id_personne,$id_date);
										         $montant_val_chambre=$nuitee_potentiel*$prix_type_chambre;
												 //je selectionnne id du client pour chaque occupant de maniere a le retrouver dans la table consommation
												 $id_client=recupere_id_client_personne_occupant_for_suivit($id_personne);
												 
												 //je commance a recupere les services 
												
												 //je rechercge ses consommations
												 //je fais le total services consomme non payé plus le montant logement
												
												 
												 //je recupere la somme de ses avances en fonction de son id
												 
												 
												  $montant_total_des_avances=recupere_som_avancement_for_suivit($id_occup);
												  //je recupere la date d'entre pour chaque client
												  
												  $date_today=date('Y-m-d');;
												  $durre_occupation=recupere_duree_personne_chambre_for_suivit($id_occup);
												  $date_entree_dans_table=recupere_date_entree_pourverif_personne_chambre_for_suivit($id_occup);
												  
												  $lenombre_de_jour_passe_dans_chambre=NbJours($date_entree_dans_table,$date_today);
												  $montant_val_deja_passe_en_chambre=$lenombre_de_jour_passe_dans_chambre*$prix_type_chambre;
												  $montant_service=recupere_consommation_personne_occupant_for_suivit($id_client,$etat_conso,$id_date,$id_date_sort);
												  
												  
												 
												  
												    
													 //$montant_total_utilisation_total=$montant_service+$montant_val_chambre;
													  $montant_total_utilisation_total=$montant_service+$montant_val_deja_passe_en_chambre;
													  
													   $reste_calcule=$montant_total_utilisation_total-$montant_total_des_avances;
													  
													if($durre_occupation=="" OR $durre_occupation=='0' ){
													
													
													
													if ($i%2==1) print "<tr class='ligne_impaire'>";
													else print " <tr class='ligne_paire'>";	
													
													print " <td> <a href='facture_de_suivit_du_client.php?modif_code=$ID_OCCUPATION'>".stripslashes(retour_nomprenom_liste_suivit_table($id_personne))." </a></td>";
													print " <td> ".(recupere_libelle_chambre_for_suivit($id_chambre))."</td>";	
													print " <td> ".($id_date)."</td>";	
													//print " <td style='text-align:right;'> ".(formatage3Pos($montant_val_chambre))."</td>";	
													//print " <td style='text-align:right;'> ".(formatage3Pos($montant_service))."</td>";	
													print " <td style='text-align:right;'> ".(formatage3Pos($montant_total_utilisation_total))."</td>";	
													print " <td style='text-align:right;'> ".(formatage3Pos($montant_total_des_avances))."</td>";	
													print " <td style='text-align:right;'> ".(formatage3Pos($reste_calcule))."</td>";									 
													print " </tr>";
													
													
													}
													
													
													
											    
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'enregistrement: ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM occuper ');
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];

// Pagination
$nb_pages = ceil($nb_total / $pagination);

// Affichage
echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';	
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
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader"><a href="#" title="Permanent Link to this Post"></a></h2>
                                          <div class="art-postmetadataheader">
										  
										<!-- formulaire -->
												<form method="post" name="cadre" action="facture_de_suivit_du_client.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="50%">
												    
													
														
														
														
														
														
														<tr style="border:hidden">
														<td style="border:hidden"><label> Net a payer : </label></td>
	                                                    <td><input readonly type="text" name="net" value="<?php print $g_net;?>"  size="40" />
														</td>
											            </tr>
														
														
														
														<tr style="border:hidden">
														<td style="border:hidden"><label> Reste: </label></td>
	                                                    <td>
														<input type="text" readonly  name="rest" value="<?php print $g_rest;?>"  size="40" />
														</td>
											            </tr>
														
														
														<tr style="border:hidden">
														<td style="border:hidden"><label> Client : </label></td>
	                                                    <td><input type="text" readonly  name="client" value="<?php print $g_client;?>"  size="40" />
														</td>
											            </tr>
														
														
														
														<tr style="border:hidden">
														<td style="border:hidden"><label> Avance:</label></td>
	                                                    <td>
														<input type="text" name="avance" value="<?php print $g_avance;?>"  size="40" />
														<input type="text" name="date_operation" value="<?php print $g_date_operation;?>"  size="15" />
														<?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                    calendarpopupDim('id1','document.cadre.date_operation',"fr","1","0");
	                                                    ?>
														</td>
											            </tr>
														
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/avances_suivit.php','Liste des avances','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		