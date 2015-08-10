<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
function recupere_libelle_chambre_libelle($code){
	return ResultatRequette("select LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
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
	
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=="Ajouter"){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global="Annuler";}
	//print $g_code;
	
	$i=0;
	if (isset($v_global)){
	     if($v_global==Ajout){
		
	    }
		elseif($v_global==Modif){
		
		}
		elseif($v_global=Suppression){
		
		}
		
		elseif($v_global=Annuler){
		 
		}
		
      $i++;
	    
	}
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
		
			
		}
	
	}

?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES PERSONNES A CHARGE<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									/*     require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> NOM  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Type Chambre </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> ETAT </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Dur&eacute;e </strong>";
	           							print " </th>";
										
                                        print " <th class='entete_tableau' >";
										print " <strong> Date Arriv&eacute;e </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Imprimer</strong>";
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
									    $requete="select  * from concerner order by ID_RESEVATION desc LIMIT $limit_start, $pagination";
										// on recupère la liste 
										$result=mysql_query($requete, $link);
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
										    print " <td><a href='reservation.php?modif_code=$ID_RESEVATION'>".stripslashes(retour_nomprenom_sortietable_reservation($ID_RESEVATION))."</a></td>";
											print " <td>".stripslashes(recupere_libelle_type_chambre($CODE_TYPE_CHAMBRE))."</td>";
											print " <td>".stripslashes($ETAT_RESERV_CHAM)."</td>";
											print " <td>".stripslashes($DUREE_RESERV_CHAM)."</td>";
                                            print " <td>".stripslashes($DATE_RESERV_CHAM)."</td>";
										    print " <td><a href='reservation.php?modif_code_imprime_reserv_chambre=$ID_RESEVATION' onclick='openPopup1imprimereserv()'>".stripslashes(Imprimer)."</td>";							 
											print " </tr>";
										}
										print "</table>";
										$retour_date=date('d/m/Y');
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i;  print"
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Reservation du ".$retour_date;
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM reservation ');
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];

// Pagination
$nb_pages = ceil($nb_total / $pagination);

// Affichage
echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';	*/
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
												<?php 
													$valcompte=8;
												
													print"  <tr>";
												    print "<td><label>Nom: </label><br/></td>";		
                                                    print" <td><input type='text' name='nom' value=''  size='40'/></td>";
                                                    print" </tr>";
													
													print"  <tr>";
												    print "<td><label>Pr&eacute;nom: </label><br/></td>";		
                                                    print" <td><input type='text' name='prenom' value=''  size='40'/></td>";
                                                    print" </tr>";
													
													print"  <tr>";
												    print "<td><label>Identifiant: </label><br/></td>";		
                                                    print" <td><input type='text' name='identifiant' value=''  size='40'/></td>";
                                                    print" </tr>";
													$valcompte=$valcompte-1;
													
												
													
													?>
												    </form>
												</table></br>&nbsp;&nbsp;&nbsp;&nbsp;
														<br/>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/tarification_chambre.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		