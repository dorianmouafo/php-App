<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
function recherche_id_etat_chambre($id_etat_chambre){
return ResultatRequette("select CODE_ETAT_CHAMBRE as info from etat_chambre where LIBELLE_ETAT_CHAMBRE='$id_etat_chambre'");
}
function recherche_dans_avoir_id_code_chambre($id_etat_chambre){
return ResultatRequette("select CODE_ETAT_CHAMBRE as info from avoir");
}
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
	$g_code=$_REQUEST['modif_code'];
	$g_etat=addslashes($_REQUEST['etat']);
	$g_observation=addslashes($_REQUEST['txt_observation']);
	$g_couleur_associee=addslashes($_REQUEST['txt_couleur_associee']);
  	
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	// si une variable globale existe cest a dire si on  a appuie sur un bouton 
	if (isset($v_global)){
	    if($v_global==Ajout){
			if($g_etat!=""){
		ajout_etat_chambre_add($g_etat,$g_observation,$g_couleur_associee);
		 print "<script language='javascript'> alert('Ajout Effectue'); </script>";
			}
			elseif($g_etat==""){
			 print "<script language='javascript'> alert('Entrer un Etat'); </script>";
			}
	    }
		elseif($v_global==Modif){		$g_code=$_REQUEST['modif_code'];
				 if($g_etat!=""){	
		    modifier_etat_chambre($g_code,$g_etat,$g_observation,$g_couleur_associee);
		    print "<script language='javascript'> alert('Modification Effectuee'); </script>";
		        }
				elseif($g_etat==""){
			 print "<script language='javascript'> alert('Cliquer sur un etat pour Modifier'); </script>";
			
			}
		}
		//bouton supprimer
		elseif($v_global==Suppression){		
	   $g_code=$_REQUEST['modif_code'];
	   $resultat_de_recherche=recherche_dans_avoir_id_code_chambre($val_pop);
	   print"". $resultat_de_recherche;
	      if($g_code_v==$resultat_de_recherche OR  $g_code==$resultat_de_recherche){
		 print "<script language='javascript'> alert('Suppression impossible car cette etat est utilise'); </script>";
			}
			else{
			supresion_etat_chambre($g_code);
			 print "<script language='javascript'> alert('Suppression Effectuee'); </script>";
			}
   		}
		//bouton annuler
		elseif($v_global=Annuler){
		$g_etat="";
		$g_observation="";
		$g_couleur_associee="";
			
		}
	$g_etat="";
    $g_observation="";
	$g_couleur_associee="";
	$i++;
	}
	if ($i==0){
	    if (isset($g_code)){
		$g_code=$_REQUEST['modif_code'];
		$code=$g_code;
		$g_etat=recup_lib_etat_chamrtr($g_code);
		$g_observation=recup_descrip_etat_chambr($g_code);
		$g_couleur_associee=recup_couleur_associee_etat_chambre($g_code);
		}
	}

?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES &Eacute;TATS DES CHAMBRES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									  require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Libell&eacute;   </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Observation </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Couleur associ&eacute;e </strong>";
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
										
										$requete="select * from etat_chambre  order by CODE_ETAT_CHAMBRE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='etat_chambre.php?modif_code=$CODE_ETAT_CHAMBRE'> ".stripslashes($LIBELLE_ETAT_CHAMBRE)." </a></td>";
											 print " <td>".stripslashes($OBSERVATION_ETAT_CHAMBRE)."</td>";							 
											 print " <td>".stripslashes($COULEUR_ASSOCIE)."</td>";							 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d etat : ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM etat_chambre ');
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
										  
										<form method="post"  action="etat_chambre.php?modif_code=<?php print $g_code;?>">
												<table style="border:hidden" cellspacing="0" cellpadding="0" width="60%">
												        <tr style="border:hidden">
														<td  style="border:hidden"><label> Libell&eacute; : </label></td>
                                                        <td ><input type="text" name="etat" value="<?php print $g_etat; ?>" size="20" /></td>
										 	            </tr>
														
													<tr style="border:hidden">
														<td style="border:hidden"><label> Couleur associ&eacute;e : <br>(en anglais) </label></td>
	                                                    <td><input type="text" name="txt_couleur_associee" value="<?php print $g_couleur_associee; ?>" size="20" /></td>
											        </tr>

													<tr style="border:hidden">
														<td style="border:hidden"><label> Observations: </label></td>
														<td style="border:hidden"><textarea name="txt_observation" cols="30" rows="3"><?php print $g_observation;?></textarea></td> 
	                                                </tr>

														
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer cet &eacute;tat?');"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/liste_etat_chambre.php','Liste etat des chambres','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		