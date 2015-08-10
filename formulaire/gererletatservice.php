<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
$date=date('d/m/Y');
$retour_date=date('d/m/Y');
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
    $g_chambre_val=addslashes($_REQUEST['chambre_val']);
	$g_etat=addslashes($_REQUEST['etat']);
	//on passe en parametre les boutons
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;

	if (isset($v_global)){ 
			$g_date=dateFormBase($date);
			$codeetat=rechercher_libetat_asntable($g_code);
			$etat=rechercher_libcode_sorti_lietatserv($g_etat);
			$libetat=rechercher_libformulaire_sorti_lietatserv($codeetat);
	    if($v_global==Ajout){
		    if($libetat!='OCCUPEE'){
			modifier_etatservice_service_modif($g_code,$etat,$g_date);
			print "<script language='javascript'> alert('Operation effectuee'); </script>";
			$codeetat="";
			$libetat="";
			}
			else{
			print "<script language='javascript'> alert('Operation impossible cette chambre est occupEe'); </script>";
			}
			  
		}
		elseif($v_global==Modif){	
		if($libetat!='OCCUPEE'){
		modifier_etatservice_service_modif($g_code,$etat,$g_date);
		print "<script language='javascript'> alert('Operation effectuee'); </script>";
			$codeetat="";
			$libetat="";
			}
			else{
			print "<script language='javascript'> alert('Operation impossible cette chambre est occupee'); </script>";
			}
		}
		//bouton suppression
		elseif($v_global==Suppression){
			print "<script language='javascript'> alert('Suppression Impossible'); </script>";
		}
		elseif($v_global=Annuler){
		     $g_indentifiant="";
		}
	$g_indentifiant="";

	$i++;	
	}
	
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
		 $g_chambre_val=rechercher_libformulaire_sorti_finuser($code);	
		}
	
	}

?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES ETATS DES SERVICES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									   require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong>  Service  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Etat </strong>";
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
										
										$requete="select * from possede_1 LIMIT $limit_start, $pagination  ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 //print " <td>".$CODE_TYPE_CHAMBRE."</td>";
											print " <td><a href='gererletatservice.php?modif_code=$CODE_SERVICE'>".stripslashes(rechercher_dlibservre_sorti_finuser($CODE_SERVICE))."</a></td>";											 
										    print " <td>".stripslashes(rechercher_datat_sorti_finuser($ID_ETAT_SERVICE))."</td>";
											 											 
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s)  ".$i."<br/>";
										
										
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM possede_1');
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
													<form method="post" name="cadre" action="gererletatservice.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="55%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Service: </label></td>
                                                        <td><input readonly name="chambre_val" id="service" type="text" value="<?php print $g_chambre_val;?>"  size="40" /></td>
										 	            </tr>
														<tr style="border:hidden">
							
									                    <td style="border:hidden"><label>Etat : </label></td>
						                                <td>
									                     <select name="etat"><option value=""></option>
									                     <?php print $g_etat?>
									                     <?php print ChargeCombo("select LIBELLE as info from etat_service",$g_etat);?>
									                      </select></td>
								                        </tr>   
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/liste_etat_service_envigeur.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		