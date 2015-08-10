<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
    print" <script>
    function openPopup(){
      window.open('listeserviceoccup.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=700');
    }
  </script>";
   print" <script>
    function openPopup1(){
      window.open('listeserviceoccup.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=500');
    }
  </script>";
       print" <script>
      function openPopup2(){
	    window.open('listeentreprise.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=700');
      
    }
  </script>";
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
 		//print"".$retour_date_reserve;
//appel de tous les dossiers qui contienent les fonction que je vqis utiliser
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION['code_code'];
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	//on recuepere les valeurs entrees 
	$g_date_arrivee=addslashes($_REQUEST['date_arrivee']);
	$g_heure_arrivee=addslashes($_REQUEST['heure_arrivee']);
	$g_date_sortie=addslashes($_REQUEST['date_sortie']);
    $g_heure_sortie=addslashes($_REQUEST['heure_sortie']);
	$g_chambre_val=addslashes($_REQUEST['chambre_val']);
	$g_ident_parrain=addslashes($_REQUEST['parrainval']);
	$g_parrain=addslashes($_REQUEST['parrain']);
	$g_client_val=addslashes($_REQUEST['client_val']);
	$g_observation=addslashes($_REQUEST['observation']);
	//on passe en parametre les boutons
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	$g_confirme='confirm&eacute;e';
	$g_non_confirme='non confim&eacute;e';
	if (isset($v_global)){ 
	        $g_date_arrivee1=dateFormBase($g_date_arrivee);
			$g_date_reserv1=dateFormBase($g_date_sortie);
			 $g_chambre_val1=retour_idservice_pouruser($g_chambre_val);
	    if($v_global==Ajout){ //print $g_parrain; 
		//print $g_ident_parrain;
	//Ajout_utilservice_client_uniq($g_ident_parrain,$g_chambre_val1,$g_date_arrivee1,$g_date_reserv1,'0',$g_observation);
		Ajout_utilservice_client_uniq($g_ident_parrain,$g_chambre_val1,$g_date_arrivee1,'0000-00-00','0',$g_observation);
		LeMouchard($gCode_utilisateur,'Occuper un service pour un client');
				print "<script language='javascript'> alert('Ajout effectuee'); </script>";
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	$g_ident_parrain="";
		}
		elseif($v_global==Modif){
			// je recupere la date de lentree du client//
			$dateentree=rechercher_dateservice_sorti($g_code);
			//avec cette date d'etree de recherche la durrée doccupation//
			$dureevalcalcul=NbJours($dateentree,$g_date_reserv1);
			//vu que lq modifiction ne se fait juste qu'en sortie qlors je dois passer aussi la duree entre la date d'entree et la date de sortie//
			//sortieservice_service_table($g_code,$g_chambre_val1,$g_date_arrivee1,$g_date_reserv1,$dureevalcalcul);
			sortieservice_service_table($g_code,$g_date_reserv1,$dureevalcalcul);
			print "<script language='javascript'> alert('Requette effectuee'); </script>";
		
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	$g_ident_parrain="";
	       
		}
		//bouton suppression
		elseif($v_global==Suppression){
			print "<script language='javascript'> alert('Suppression impossible client dans le system'); </script>";
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	$g_ident_parrain="";
		}
		elseif($v_global=Annuler){
    $g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	$g_ident_parrain="";
		   
		}
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	$g_ident_parrain="";
		
	$i++;	
	}
	
	if ($i==0){
	    if (isset($g_code)){$g_code=$_REQUEST['modif_code'];
			$code=$g_code;
			   $g_chambre_val1=rechercher_codeseeraffiche_sorti($g_code);	
			   $g_date_arrivee=rechercher_datesuseraffiche_sorti($g_code);
			  $g_date_sortie=rechercher_datesuseraffiche_sorti_finuser($g_code);
			}
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">FICHE DE D&#39;OCCUPATION SERVICES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									  require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Nom  et  Pr&eacute;nom</strong>";
	           							print " </th>";
										
									    print " <th class='entete_tableau' >";
										print " <strong>Service</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date debut </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date fin </strong>";
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
										$requete="select a.ID_CLIENT,a.CODE_SERVICE,a.DATE_UTILISATION,a.DATE_FIN from utiliser a LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                            print " <td><a href='enregistrementoccupationservice.php?modif_code=$ID_CLIENT'>".stripslashes($ID_CLIENT)."</a></td>";	
											print " <td>".stripslashes(retour_service_pouruser($CODE_SERVICE))."</td>";
											print " <td>".stripslashes($DATE_UTILISATION)."</td>";
											print " <td>".stripslashes($DATE_FIN)."</td>";
											 											 
											 print " </tr>";
										}

										print "</table>";
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d enregistrement(s) : ".$i ."<br/><br/>";
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM utiliser');
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
										  
										  	
												
											<form method="post" name="cadre" action="enregistrementoccupationservice.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" class="table"  width="60%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Date debut: </label></td>
						                                <td>
                                                        <input readonly type="text" name="date_arrivee"  value="<?php print $g_date_arrivee; ?>" >
	                                                    <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                    calendarpopupDim('id1','document.cadre.date_arrivee',"fr","1","0");
	                                                     ?>
                                                        </td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Date fin: </label></td>
						                                <td>
                                                        <input readonly type="text" name="date_sortie"  value="<?php print $g_date_sortie; ?>" >
	                                                     <?php
	                                                     include_once("../calendrierphp/calendar.php");
	                                                     calendarpopupDim('id1','document.cadre.date_sortie',"fr","1","0");
	                                                    ?>
                                                        </td>
											            </tr>
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Observtions: </label></td>
														<td><textarea name="observation"  rows="5" cols="53"><?php print $g_observation;?></textarea></td>
											            </tr>
								 				        </form>
												       </table> 
										                <tr>
								                        <td>Utilisant(e):&nbsp;&nbsp;&nbsp;&nbsp;
								                         </label></td>	
								                         <td>  <select name="parrainselect">
                                                         <option value="1">Personne Physique</option>
                                                         <option value="2">Personne Morale </option>                              
                                                           </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="parrain" id="parrainn" type="text" value="<?php print $g_parrain;?>"  size="41" />
														   <input  name="parrainval" id="ident_parrain" type="hidden" value="<?php print $g_ident_parrain;?>"  size="1" />
                                                        <input type="button" value="....." onClick="openPopup2()" style="width:50px; height:30px"/></td>
									                   </tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
													   	<tr>
							                             <td>
														 Service:</td>
							                          	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly name="chambre_val" id="chambre" type="text" value="<?php print $g_chambre_val;?>"  size="67" />
                                                       <input type="button" value="....." onClick="openPopup1()" style="width:50px; height:30px" />
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							                             </td>
									                    </tr> 
												        </br></br>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/occupationchambre.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		