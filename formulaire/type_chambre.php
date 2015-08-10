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
	//$g_code_v=addslashes($_REQUEST['code']);
	$g_libelle=addslashes($_REQUEST['libelle']);
    $g_lit=addslashes($_REQUEST['le_lit']);
	$g_litt=addslashes($_REQUEST['les_lit']);
	$g_observation=addslashes($_REQUEST['observation']);
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=="Ajouter"){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	// si une variable globale existe cest a dire si on  a appuie sur un bouton 
	if (isset($v_global)){
	// on verifie sur quel bouton il a appuie
	    if($v_global==Ajout){
	//si la variable globale est ajout alors on verifie les champs
			//bouton ajouter
			if($g_libelle!=""){
				ajout_type_chambre($g_libelle,$g_lit,$g_litt,$g_observation);
				  print"<script language='javascript'> alert('Ajout effectuee');</script>";
			}
	    }
		//bouton modifier
	    elseif($v_global==Modif){
		 //print "".$v_global;
		   if($g_libelle!=""){
		   modif_type_chambre($g_code,$g_libelle,$g_lit,$g_litt,$g_observation);
		   }
		}
		//bouton supprimer
		elseif($v_global==Suppression){ //print $g_code;
		// je dois verifier si mon type de chambre n'est pas utiliser dans une tarfication table viser
		    $valeur_exist_vise=recherche_codetype_dans_viser_table_rechr($g_code);
		// je dois verifier aussi si le type de chambre existe dans chambre
		    $valeur_exist_chambre=recherche_codetype_dans_chambre_table_rechr($g_code);
		//je dois verifier si le type de chambre exite aussi dans concerner pour les reservation
		    $valeur_exist_concerne=recherche_codetype_dans_concerne_table_rechr($g_code);
			if($valeur_exist_vise=="" AND $valeur_exist_chambre=="" AND  $valeur_exist_concerne==""){
				suppression_type_chambre($g_code);	
		    print"<script language='javascript'> alert('Seppression effectuee');</script>";
			}	
            else{
			print"<script language='javascript'> alert('Suppression impossible car ce type de chambre est en utilisation');</script>";
			}			
		
		}
		//bouton annuler
		elseif($v_global=Annuler){
		  $g_libelle="";
		  $g_lit="";
		  $g_litt="";
		  $g_observation="";	
		}
	 $g_libelle="";
	 $g_lit="";
	 $g_litt="";
	 $g_observation="";
	$i++;
	}
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
			$g_libelle=recupere_libelle_type_chambre($g_code);
			$g_lit=recupere_nb_lit_un_type_chambre($g_code);
			$g_litt=recupere_nb_lit_deux_type_chambre($g_code);
			$g_observation=recupere_observations($g_code);
			
		}
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES TYPE DE CHAMBRES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									  	require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Libell&eacute;  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Lit une place </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Lit deux places </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Observations </strong>";
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
										
										$requete="select * from type_chambre order by CODE_TYPE_CHAMBRE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 //print " <td>".$CODE_TYPE_CHAMBRE."</td>";
											 print " <td> <a href='type_chambre.php?modif_code=$CODE_TYPE_CHAMBRE'> ".stripslashes($LIBELLE_TYPE_CHAMBRE)." </a></td>";
											 print " <td>".stripslashes($NOMBRE_DE_LIT_UNE_PLACE)."</td>";
											 print " <td>".stripslashes($NOMBRE_LIT_DEUX_PLACES)."</td>";
											 print " <td>".stripslashes($OBSERVATIONS)."</td>";
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de type de chambres : ".$i."<br/>";
										
										
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM type_chambre');
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
									 <form method="post"  action="type_chambre.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="71%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Libell&eacute; : </label></td>
                                                        <td><input type="text" name="libelle" value="<?php print $g_libelle; ?>" size="35" /></td>
										 	            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Description : </label></td>
	                                                    <td><label> Lit une Place : </label><input type="text" name="le_lit" value="<?php print $g_lit;?>" size="11" /><label> Lit deux Places : </label><input type="text" name="les_lit" value="<?php print $g_litt;?>" size="12" /></td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Observations:</label></td>
														<td><textarea name="observation"  rows="5" cols="57"><?php print $g_observation;?></textarea></td>
											            </tr>
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer ce type de chambre?');"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/liste_type_chambre.php','Liste des types de chambre','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		