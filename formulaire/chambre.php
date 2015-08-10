<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
function recupere_libelle_chambre_libelle($code){
	return ResultatRequette("select LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
 }
 
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
	$g_type_chambre=addslashes($_REQUEST['type_chambre']);
	$g_chambre=addslashes($_REQUEST['chambre']);
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=="Ajouter"){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global="Annuler";}
	//print $g_code;
	$retour=date('Y-m-d');
	$i=0;
	if (isset($v_global)){
	   $etat_libre=recup_val_code_etat('LIBRE');
	  $retour_code_type=Recup_code_type_chambre_tarification($g_type_chambre);
	     if($v_global==Ajout){
			if($g_chambre!=""){
				 ajout_table_chambre($retour_code_type,$g_chambre);
				 $id=mysql_insert_id();
				  $date_max=rechercher_datemaxtariftypechambre();
				 ajout_avoir_occupation_chambre($id,$etat_libre,$retour,$date_max,'RAS');
				 //print  $id;
				 print"<script language='javascript'> alert('Ajout effectuee');</script>";
				$g_type_chambre="";
				$g_chambre="";
				header('location: chambre.php');
			}
	    }
		elseif($v_global==Modif){	
				 if($g_chambre!=""){
                    Modif_table_chambre($g_code,$retour_code_type,$g_chambre);		
   print"<script language='javascript'> alert('Modification effectuee');</script>";					
		   }
		}
		//bouton annuler
		
		elseif($v_global==Suppression){
		suppression_table_chambre($g_code);
		  print"<script language='javascript'> alert('Suppression effectuee');</script>";	
   		}
		elseif($v_global='Annuler'){
		$g_type_chambre="";
		$g_chambre="";
		}
      $i++;
	  
	}
	
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
			$g_chambre=recupere_table_chambre_libelle($g_code);
		}
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES CHAMBRES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									  require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Chambre   </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Type </strong>";
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
										
										$requete="select * from chambre order by CODE_CHAMBRE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='chambre.php?modif_code=$CODE_CHAMBRE'> ".stripslashes($LIBELLE_CHAMBRE)." </a></td>";
											 print " <td>".stripslashes(recupere_libelle_chambre_libelle($CODE_TYPE_CHAMBRE))."</td>";							 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de chambres : ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM chambre ');
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
												<form method="post"  action="chambre.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="50%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Type: </label></td>
                                                        <td> <select name="type_chambre"><option value=""></option>
									  <?php print $g_type_chambre?>
									  <?php print ChargeCombo("select LIBELLE_TYPE_CHAMBRE as info from type_chambre",$g_type_chambre);?>
									  </select></td>
										 	            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Chambre: </label></td>
	                                                    <td><input type="text" name="chambre" value="<?php print $g_chambre;?>"  size="38" /></td>
											            </tr>
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer cette chambre?');"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/liste_chambre.php','Liste des chambre','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		