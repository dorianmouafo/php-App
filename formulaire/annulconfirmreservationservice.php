<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
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
  $retour_date_reserve=date('d/m/Y');
 	//appel de tous les dossiers qui contienent les fonction que je vqis utiliser
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	$g_date_confirme=addslashes($_REQUEST['date_confirme']);
    $g_date_annul=addslashes($_REQUEST['date_annul']);
	$g_nom=addslashes($_REQUEST['nom']);
	//on passe en parametre les boutons
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	if (isset($v_global)){
 $g_date_confirme1=dateFormBase($g_date_confirme);
 $g_date_annul1=dateFormBase($g_date_annul); 
	    if($v_global==Ajout){
		    if($g_date_confirme!="" OR $g_date_annul!=""){
		         if($g_date_confirme!="" AND $g_date_annul==""){
			modif_date_confirme_reserbv_services_etat($g_code,$g_date_confirme1);
			 LeMouchard($gCode_utilisateur,'Confirmer une reservation');
			    }
			     elseif($g_date_annul!="" AND $g_date_confirme==""){
			modif_date_annul_reservlibetat_moi($g_code,$g_date_annul1);
			 LeMouchard($gCode_utilisateur,'Annuler une reservation');
			    }
			}
			else{
			 print "<script language='javascript'> alert('Choisiser un seule operation a la fois'); </script>";
			    }
		
		}
		elseif($v_global==Modif){
		   if($g_date_confirme!="" OR $g_date_annul!=""){
		         if($g_date_confirme!="" AND $g_date_annul==""){
			modif_date_confirme_chambresate($g_code,$g_date_confirme1);
			 LeMouchard($gCode_utilisateur,'Confirmer une reservation');
			    }
			     elseif($g_date_annul!="" AND $g_date_confirme==""){
			modif_date_annul_reservlibetat_moi($g_code,$g_date_annul1);
			 LeMouchard($gCode_utilisateur,'Annuler une reservation');
			    }
			}
			else{
			 print "<script language='javascript'> alert('Choisiser un seule operation a la fois'); </script>";
			    }
		}
		//bouton suppression
		elseif($v_global==Suppression){
			 print "<script language='javascript'> alert('Operation Imopssible'); </script>";
		}
		elseif($v_global=Annuler){
		     $g_indentifiant="";
	         $g_nom="";
			 $g_date_confirme="";
			 $g_date_annul="";
	    
		}
	         $g_indentifiant="";
	         $g_nom="";
			 $g_date_confirme="";
			 $g_date_annul="";
	
	$i++;	
	}
	
	if ($i==0){
	    if (isset($g_code)){$g_code=$_REQUEST['modif_code'];
			$code=$g_code;
			$g_nom=recup_nom_info_pour_confirmation_annulation($g_code);
		}
	
	}


?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES RESERVATIONS<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> NOM  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Service </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> ETAT </strong>";
	           							print " </th>";
										
                                        print " <th class='entete_tableau' >";
										print " <strong> Date Confirme </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date Annulation </strong>";
	           							print " </th>";
										
										 // Numero de page (1 par défaut)
                                        if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =10;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;										
										 // Préparation de la requête
										
										// on recupère la liste 
										$requete="select * from sappliquer LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
											 // print " <td>".$ID_RESEVATION."</td>";
                                            print " <td><a href='annulconfirmreservationservice.php?modif_code=$ID_RESEVATION'>".stripslashes(rechercher_nomclient_fromreservation_sans_table($ID_RESEVATION))."</a></td>";											 
											print " <td>".stripslashes(recup_lib_info_pour_confirmation_annulation_service($CODE_SERVICE))."</td>";
											print " <td>".stripslashes($ETAT_RESERV_SERV)."</td>";
											print " <td>".stripslashes($DATE__CONFIRMATION )."</td>";
											print " <td>".stripslashes($DATE_ANNUL)."</td>";
											print " </tr>";
										}          
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) ".$i ."<br/><br/>";
										
																				
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM sappliquer');
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
										 <form method="post" name="cadre" action="annulconfirmreservationservice.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="71%">
												         <tr style="border:hidden">
														 <td style="border:hidden"><label> Nom  : </label></td>
                                                         <td><input readonly type="text" name="nom" value="<?php print $g_nom; ?>" size="70" /></td>
											             </tr>
														 <tr style="border:hidden">
														<td style="border:hidden"><label> Dur&eacute;e: </label></td>
                                                         <td><input readonly type="text" name="nuit" value="<?php print $g_nuit; ?>" size="20" /></td>
										              	</tr>
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Date Confirmation: </label></td>
						                                <td>  <div align="right"><font class="T2"> </font>     </div>
                                                         <input readonly type="text" name="date_confirme"  value="<?php print $g_date_confirme; ?>" >
	                                                     <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                    calendarpopupDim('id1','document.cadre.date_confirme',"fr","1","0");
	                                                     ?>
                                                        </td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Date Annulation: </label></td>
						                               <td>  <div align="right"><font class="T2"> </font>     </div>
                                                        <input readonly type="text" name="date_annul"  value="<?php print $g_date_annul; ?>" >
	                                                     <?php
	                                                     include_once("../calendrierphp/calendar.php");
	                                                     calendarpopupDim('id1','document.cadre.date_annul',"fr","1","0");
	                                                     ?>
                                                        </td>
											            </tr>
								 				        </form>
												       </table><BR/>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/eta_ reservchambre.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		