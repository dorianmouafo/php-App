<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
  print" <script>
    function openPopup(){
      window.open('listeservice.php','','toolbar=no,menubar=no,location=no,risizable=yes,scrollbars=yes,status=no,height=500,width=500');
    }
  </script>";
   print" <script>
    function openPopupprintrserv(){
      window.open('fichereservchambre.php','','toolbar=no,menubar=no,location=no,risizable=yes,scrollbars=yes,status=no,height=500,width=500');
    }
  </script>";
   print" <script>
    function openPopup1(){
      window.open('listechambre.php','','toolbar=no,menubar=no,location=no,risizable=yes,scrollbars=yes,status=no,height=500,width=500');
    }
  </script>";
 print" <script>
    function openPopup1imprimereserv(){
      window.open('fichereservchambre.php','','toolbar=yes,menubar=no,location=no,risizable=yes,scrollbars=yes,status=no,height=500,width=500');
    }
  </script>";
$retour_date_reserve=date('d/m/Y');
function rechercher_id_libell_chambre_sans_table($value){
return ResultatRequette("select  CODE_TYPE_CHAMBRE as info from type_chambre where LIBELLE_TYPE_CHAMBRE='$value'");
}
function rechercher_titre_libell_service_sans_table($valueserve){
return ResultatRequette("select  CODE_SERVICE as info from service where TITRE_SERVICE='$valueserve'");
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
	$gCode_utilisateur=$_SESSION['code_code'];
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	$g_modif_code_imprime_reserv_chambre=$_REQUEST['modif_code_imprime_reserv_chambre'];
	//on recuepere les valeurs entrees 
	//$g_code=addslashes($_REQUEST['modif_code']);
	$g_indentifiant=addslashes($_REQUEST['indentifiant']);
	$g_nom=addslashes($_REQUEST['nom']);
	$g_titre=addslashes($_REQUEST['titre']);
	$g_observation=addslashes($_REQUEST['observation']);
	$g_date_reserv=addslashes($_REQUEST['date_reserv']);
	$g_duree=addslashes($_REQUEST['duree']);
	$g_date_arriv=addslashes($_REQUEST['date_arriv']);
	$g_auteur=addslashes($_REQUEST['auteur']);
	$g_type=addslashes($_REQUEST['type']);
	$g_cham=addslashes($_REQUEST['cham']);
	$g_date_conf=addslashes($_REQUEST['date_conf']);
	$g_nuit=addslashes($_REQUEST['nuit']);
	$g_date_arrivee=addslashes($_REQUEST['date_arrivee']);
    $g_chambre_val=addslashes($_REQUEST['chambre_val']);
    $g_service_val=addslashes($_REQUEST['service_val']);
	
	//on passe en parametre les boutons
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	$g_confirme='confirmee';
	$g_non_confirme='non confirmee';
	if (isset($v_global)){ 
	                $g_chambre_val1=rechercher_id_libell_chambre_sans_table($g_chambre_val);
			        //$g_service_val1=rechercher_titre_libell_service_sans_table($g_service_val);
			        $g_date_arrivee1=dateFormBase($g_date_arrivee);
					$g_date_reserv1=dateFormBase($g_date_reserv);
					$g_date_reserv12=dateFormBase($retour_date_reserve);
					$g_date_arriv1=dateFormBase($g_date_arriv);
					$g_date_conf1=dateFormBase($g_date_conf);
	    if($v_global==Ajout){
			    if($g_indentifiant!="" OR $g_nom=="" ){
				     Ajout_client($g_indentifiant);
					 $g_id=recup($g_indentifiant);
				    if($_POST['etat']!=""){
					    if($_POST['etat']=='2'){	
						     //comme ma reservation est confirmee je verifie donc si la date de confirmation a ete entree avant tous ajouts
							if($g_chambre_val!=""){
							 $id_type_cham=recup_code_type($g_type);
							  $g_date_arrivee1=dateFormBase($g_date_arrivee);
						       Ajout_reservation($g_id,$g_indentifiant,$g_nom,$g_chambre_val1,$g_non_confirme,$g_observation,$g_date_reserv12,$g_nuit,$g_date_arrivee1,$_SESSION['login']); 
						          // je dois recuperer id de l'invitation et id du type de chambre concerné avant le dernier ajout
							  $id_reservation=recup_reservation($g_id,$g_date_reserv12); 
							     Ajout_concerne($g_chambre_val1,$id_reservation,$g_date_arrivee1,$g_nuit,$g_non_confirme,'0000-00-00','0000-00-00');
								 LeMouchard($gCode_utilisateur,'Enregistrer une reservation');
			 $g_indentifiant="";
	         $g_nom="";
	         $g_titre="";
	         $g_observation="";
	         $g_date_reserv="";
	         $g_duree="";
	         $g_date_arriv="";
	         $g_auteur="";
			 $g_nuit=="";
			 $g_chambre_val="";
	         $g_date_arrivee=="";
							           //print "".$id_type_cham;
						 print "<script language='javascript'> alert('Reservation Effecruee'); </script>";
								}
							elseif($g_service_val!="" AND $g_chambre_val!=""){
							print "<script language='javascript'> alert('Faite le choix dune seule reservation'); </script>";
							}
						}
					    elseif($_POST['etat']=='1'){
						     if($g_chambre_val!=""){
						       Ajout_reservation($g_id,$g_indentifiant,$g_nom,$g_chambre_val1,$g_confirme,$g_observation,$g_date_reserv12,$g_nuit,$g_date_arrivee1, $_SESSION['login']); 
						          // je dois recuperer id de l'invitation et id du type de chambre concerné avant le dernier ajout
							  $id_reservation=recup_reservation($g_id,$g_date_reserv12); 
							  $id_type_cham=recup_code_type($g_type);
							  $g_date_arrivee1=dateFormBase($g_date_arrivee);
							    Ajout_concerne($g_chambre_val1,$id_reservation,$g_date_arrivee1,$g_nuit,$g_confirme,$g_date_reserv12,'0000-00-00');
								 LeMouchard($gCode_utilisateur,'Enregistrer une reservation');
			 $g_indentifiant="";
	         $g_nom="";
	         $g_titre="";
	         $g_observation="";
	         $g_date_reserv="";
	         $g_duree="";
	         $g_date_arriv="";
	         $g_auteur="";
			 $g_nuit=="";
			 $g_chambre_val="";
	         $g_date_arrivee=="";
							           //print "".$id_type_cham;
						 print "<script language='javascript'> alert('Reservation Effecruee'); </script>";
						    }
						}
					}
					elseif($_POST['etat']!=""){ print "<script language='javascript'> alert('Faite le choix de l etat de la reservation'); </script>";}
				}
			
		}
		elseif($v_global==Modif){
			if($_POST['etat']!=""){
				    $g_confirme='confirm&eacute;e';
	                $g_non_confirme='non confim&eacute;e';
					$g_date_reserv1=dateFormBase($g_date_reserv);
				    $g_date_arriv1=dateFormBase($g_date_arriv);
				    $g_date_reserv12=dateFormBase($retour_date_reserve);
					$g_id=recup($g_indentifiant);
				    $id1=recuperation_ide_client_du_reference_reserve_table();
					    if($_POST['etat']=='1'){
						      modif_reservation($g_code,$g_nom,$g_titre,$g_confirme,$g_observation,$g_date_reserv12,$g_duree,$g_date_arriv1, $_SESSION['login']);
							   LeMouchard($gCode_utilisateur,'Modifier letat dune reservation');
						      // print"ajout confirm";
			 $g_indentifiant="";
	         $g_nom="";
	         $g_titre="";
	         $g_observation="";
	         $g_date_reserv="";
	         $g_duree="";
	         $g_date_arriv="";
	         $g_auteur="";
			 $g_nuit=="";
			 $g_chambre_val="";
	         $g_date_arrivee=="";
							   print "<script language='javascript'> alert('Modification Effectuee'); </script>";
						  }
					    elseif($_POST['etat']=='2'){
						      modif_reservation($g_code,$g_nom,$g_titre,$g_non_confirme,$g_observation,$g_date_reserv12,$g_duree,$g_date_arriv1, $_SESSION['login']);
							  LeMouchard($gCode_utilisateur,'Modifier letat dune reservation');
	         $g_indentifiant="";
	         $g_nom="";
	         $g_titre="";
			 $g_chambre_val="";
	         $g_date_arrivee=="";
	         $g_observation="";
	         $g_date_reserv="";
	         $g_duree="";
	         $g_date_arriv="";
	         $g_auteur="";
							 // print"ajout non confirm";
							  print "<script language='javascript'> alert('Modification Effectuee'); </script>";
						    }
		    }
		}
		//bouton suppression
		elseif($v_global==Suppression){$g_code=$_REQUEST['modif_code'];
		// je supprime dans la table concerne avant toutes autres suppressions
		  suppression_table_concerne_table($g_code);
		    print "<script language='javascript'> alert('Suppression concerne Effectuee'); </script>";
			suppression_reservation($g_code);		
			LeMouchard($gCode_utilisateur,'Supprimer une  reservation');
			print "<script language='javascript'> alert('Suppression reservation Effectuee'); </script>";
			 $g_indentifiant="";
	         $g_nom="";
	         $g_titre="";
	         $g_observation="";
	         $g_date_reserv="";
	         $g_duree="";
	         $g_date_arriv="";
	         $g_auteur="";
			 $g_nuit=="";
			 $g_chambre_val="";
	         $g_date_arrivee=="";
		}
		elseif($v_global=Annuler){
		     $g_indentifiant="";
	         $g_nom="";
	         $g_titre="";
	         $g_observation="";
	         $g_date_reserv="";
	         $g_duree="";
	         $g_date_arriv="";
	         $g_auteur="";
			 $g_nuit=="";
			 $g_chambre_val="";
	         $g_date_arrivee=="";
		}
	$g_indentifiant="";
	$g_nom="";
	$g_titre="";
	$g_observation="";
	$g_date_reserv="";
	$g_duree="";
	$g_date_arriv="";
	$g_auteur="";	
	$g_nuit=="";
	$g_chambre_val="";
	$g_date_arrivee=="";
	$i++;	
	}
	
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
			$g_indentifiant=recup_numero($g_code);
			$g_nom=recup_nom($g_code);
			$g_titre=recup_titre($g_code);
			$g_observation=recup_etat($g_code);
			$g_observation=recup_observation($g_code);
			$g_date_reserv=recup_date_reserv($g_code);
			$g_duree=recup_duree($g_code);
			$g_date_arriv=recup_date_arrive($g_code);
			$g_auteur=recup_auteur($g_code);	
		}
	
	}
	if(isset($g_modif_code_imprime_reserv_chambre) AND $g_modif_code_imprime_reserv_chambre!=""){
	     $_SESSION['id_reserv_chambre']=$g_modif_code_imprime_reserv_chambre;
		 $_SESSION['id_type_chambre_reserv']=retour_type_chambre_fiche_reserv_chambre($_SESSION['id_reserv_chambre']);
		 $_SESSION['montant_type_chambre_reserv']=retour_montant_type_chambre_fiche($_SESSION['id_type_chambre_reserv']);
		 LeMouchard($gCode_utilisateur,'Imprimer une reservation de chambre');
		//header('location:fichereservchambre.php');
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
												<form method="post" name="cadre" action="reservation.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="71%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label>Num&eacute;ro CNI/Passport: </label><br/></td>		
                                                        <td><input type="text" name="indentifiant" value="<?php print $g_indentifiant;?>"  size="40"/></td>
                                                        </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Nom  : </label></td>
                                                        <td><input type="text" name="nom" value="<?php print $g_nom; ?>" size="40" /></td>
											            </tr>
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Dur&eacute;e: </label></td>
                                                        <td><input type="text" name="nuit" value="<?php print $g_nuit; ?>" size="20" /></td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Date Arriv&eacute;e Prevue: </label></td>
						                                <td>  <div align="right"><font class="T2"> </font>     </div>
                                                         <input readonly type="text" name="date_arrivee"  value="<?php print $g_date_arrivee; ?>" >
	                                                    <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                    calendarpopupDim('id1','document.cadre.date_arrivee',"fr","1","0");
	                                                    ?>
                                                        </td>
											            </tr>
														<tr style="border:hidden">
										                <td style="border:hidden"><label> Etat R&eacute;servation :</label> </td>
										                <td>
                                                        <select name="etat">
														<option value=""></option>
                                                        <option value="1">Confirm&eacute;e</option>
                                                        <option value="2">Non Confirm&eacute;e </option>                              
                                                        </select></td>
											            </tr>
														<tr style="border:hidden">
										               <td style="border:hidden"><label> Observations : </label><br/>*renseigner les exigences<br/> du client *</td>
		                                                <td><textarea name="observation" rows="4" cols="36"><?php print $g_observation;?></textarea></td>
											           </tr>
													    
								 				        </form>
												       </table> </br>
												        <tr style="border:hidden">
							                            <td style="border:hidden"></label></td>
								                       &nbsp;&nbsp;Type Chambre:&nbsp;
													   &nbsp;&nbsp;&nbsp;&nbsp;<input readonly name="chambre_val" id="chambre" type="text" value="<?php print $g_chambre_val;?>"  size="43" />
                                                       <input type="button" value="....." onClick="openPopup1()" style="width:46px; height:21px" /></td>
								                       	</tr> 
												        </br></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer cette r&eacute;servation?');"/>
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
                          		