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
		           //je verifie si la valeur a ajouter estbonne 
		 
		                   //je recuper la valeur du montant qu'on devait regler en fonction du numero de la facture
			$val_montant_pourverif=recupere_montant_reglement_for_avance($g_numero);
		        //je fais la somme des versements en fonction du numerode la facture
				
		    $valeur_somme_calculee=recupere_total_montant_affiche($g_numero);
			
			       // je verifie si on peut faire lajout du montanat entree
				   $calcul_sur_avance=$val_montant_pourverif-$valeur_somme_calculee;
			    if($g_avance <= $calcul_sur_avance){
 			    ajout_avance($g_numero,$g_avance,$g_date_operation_insert);
				print "<script language='javascript'> alert('Avance effectuee'); </script>";
	            }
				else{
				 print "<script language='javascript'> alert('Valeur du montant est trop elevee'); </script>";
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
			$code=$g_code;
			//$g_numero=recupere_numfact_affiche($g_code);
			$g_numero=($g_code);
			$g_date_fac=recupere_date_for_avance($g_numero);
			$g_net=recupere_montant_reglement_for_avance($g_numero);
			//je calcule le reste
			$avant=recupere_montant_reglement_for_avance($g_numero);
			$apres=recupere_montant_regle_for_avance($g_numero);
			$reste_affiche=$avant-$apres;
			$g_rest=$reste_affiche;
			$idclient_affiche=recupere_id_for_avance($g_numero);
			$g_client=retour_nomprenom_savance($idclient_affiche);
		}
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES AVANCES ANCIENNES FACTURES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Facture  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date </strong>";
	           							print " </th>";
										
										
										print " <th class='entete_tableau' >";
										print " <strong> Client </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Net a payer </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Reste a payer </strong>";
	           							print " </th>";
										
										
										   // Numero de page (1 par défaut)
                                        if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =5;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;											
													   // Préparation de la requête														
										// on recupère la liste 
										
										$requete="select distinct NUMERO_FACTURE from avance order by NUMERO_FACTURE  desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{   extract($lecture);
										    $num_facture=$lecture[NUMERO_FACTURE];
										   //je recupere la date demission de chaque numero de facture
										    $dateemissionfacture=recupere_date_for_avance($num_facture);
										   //je recupere le client en fonction du numero de facture 
										     $id_client=recupere_id_for_avance($num_facture);
											 //je recupre le montant total en fonction 
											 $montant_reglement=recupere_montant_reglement_for_avance($num_facture);
											 //je recupere ce quil a payer pour la facture 
											 $montant_regler=recupere_montant_regle_for_avance($num_facture);
											 //la je recherche le reste
											 $reste_montant_payement=$montant_reglement-$montant_regler;
											 
											 
											  //je recupere la somme des enregistrements pour chaque numero de facture
											 
											 $somme_des_versements=recupere_total_montant_affiche($num_facture);
											 
											 
											 $reste_montant_payementbon=$montant_reglement-$somme_des_versements;
											 
											    if($reste_montant_payementbon!="" OR $reste_montant_payementbon!='0'){
											 
													$i++;
													if ($i%2==1) print " <tr class='ligne_impaire'>";
													else print " <tr class='ligne_paire'>";	
													print " <td> <a href='avance.php?modif_code=$NUMERO_FACTURE'>".stripslashes($lecture[NUMERO_FACTURE])." </a></td>";
													print " <td> ".($dateemissionfacture)."</td>";	
													print " <td>".(retour_nomprenom_savance($id_client))."</td>";	
													print " <td style='text-align:right;' >".formatage3Pos($montant_reglement)."</td>";	
													print " <td style='text-align:right;' >".formatage3Pos($reste_montant_payementbon)."</td>";												 
													print " </tr>";
													
											    }
												
												else{
												
												}
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'enregistrement: ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM avance ');
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
												<form method="post" name="cadre" action="avance.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="50%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Numero Facture: </label></td>
                                                        <td><input readonly type="text" name="numero" value="<?php print $g_numero;?>"  size="40" />
														</td>
										 	            </tr>
													
														 <tr style="border:hidden">
														<td style="border:hidden"><label>Date:</label></td>
														<td><input readonly type="text" name="date_fac" value="<?php print $g_date_fac;?>"  size="40" /></td>
										 	            </tr>
														
														
														
														
														
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
														<input type="text" name="avance" value="<?php print $g_avance;?>"  size="35" />
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
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/avances.php','Liste des avances','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		