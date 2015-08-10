<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
  print" <script>
    function openPopup(){
      window.open('listeclient.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=700');
    }
  </script>";
   print" <script>
    function openPopup1(){
      window.open('listechambreoccupation.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=500');
    }
  </script>";

    print" <script>
      function openPopup2(){
	    window.open('listeentreprise.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=700');
      
    }
  </script>"; 
   print" <script>
      function openPopupprintfiche(){
	    window.open('fichepolice.php','','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=700');
      
    }
  </script>"; 
  $retour_date_reserve=date('d/m/Y');
function rechercher_libertrechambre_sans_table_mercredi($value){
return ResultatRequette("select  LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$value'");
}
function rechercher_nomclient_sans_table_mercredi($valueserve){
return ResultatRequette("select  NOM_CLIENT as info from personne_physique where ID_PERSONNE='$valueserve'");
}
function rechercher_codechambredert_sans_table_mercredi($vadesre){
return ResultatRequette("select CODE_CHAMBRE  as info from chambre where LIBELLE_CHAMBRE='$vadesre'");
}
function rechercher_datedentrer_pour_valeur_desortiemodfi($date){
return ResultatRequette("select DATE_ENTREE as info from occuper where ID_OCCUPATION='$date'");
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
	//on recuepere les valeurs entrees 
	$g_code_imprime1=$_REQUEST['modif_code_imprime'];
	$g_date_arrivee=addslashes($_REQUEST['date_arrivee']);
	$g_heure_arrivee=addslashes($_REQUEST['heure_arrivee']);
	$g_date_sortie=addslashes($_REQUEST['date_sortie']);
    $g_heure_sortie=addslashes($_REQUEST['heure_sortie']);
	$g_chambre_val=addslashes($_REQUEST['chambre_val']);
	$g_client_val1=addslashes($_REQUEST['client_val1']);
	$g_parrain=addslashes($_REQUEST['parrain']);
	$g_client_val=addslashes($_REQUEST['client_val']);
	$nb_personne=$_POST['nbpersonne'];
	//print $nb_personne;
	//on passe en parametre les boutons
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	$g_confirme='confirm&eacute;e';
	$g_non_confirme='non confim&eacute;e';
	if (isset($v_global)){ 
	// je recupere le code de leteat occuper pour la table avoir
	$etat_occupe=recup_val_code_etat('OCCUPEE');
	$etat_libre=recup_val_code_etat('LIBRE');
	        $g_date_arrivee1=dateFormBase($g_date_arrivee);
			$g_date_reserv1=dateFormBase($g_date_sortie);
			$g_chambre_val1=rechercher_codechambredert_sans_table_mercredi($g_chambre_val);
	    if($v_global==Ajout){    
		$dureet=NbJours($g_date_arrivee1,$g_date_reserv1);
	assisgner_chambre_client_tableoccuper($g_chambre_val1,$g_client_val1,$g_date_arrivee1,$g_heure_arrivee,$g_date_reserv1,$g_heure_sortie,'0','0',$nb_personne);
	//je consigne la chambre comme occupee
	ajout_avoir_occupation_chambre($g_chambre_val1,$etat_occupe,$g_date_arrivee1,$g_date_reserv1,'OCCUPEE');
	//modifier_etat_assignation_chambre_lundibut($g_chambre_val1,$etat_occupe,$g_date_arrivee1);
	LeMouchard($gCode_utilisateur,'Occuper un client');
				print "<script language='javascript'> alert('Ajout effectuee'); </script>";
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	                              if($nb_personne!='1'){
									$_SESSION['nb_personne']=$nb_personne;
									header('location: personne_a_charge.php');	
									
								}
		}
		elseif($v_global==Modif){
		$datere=retour_date_debuttable($g_code);
		    if($g_date_sortie=='0000-00-00' OR $g_heure_sortie=='00:00:00' OR $g_date_arrivee=='0000-00-00' OR $g_date_arrivee1=='0000-00-00' OR $g_date_reserv1=='0000-00-00' ){
		    print "<script language='javascript'> alert('Entrer la date et l heure de sortie'); </script>";
			}
			else{                
			// je recupere la date de lentree du client//
			$dateentree=rechercher_datedentrer_pour_valeur_desortiemodfi($g_code);
			//avec cette date d'etree je recherche la durrée doccupation//
			         $dureevalcalcul=NbJours($dateentree,$g_date_reserv1);
			//vu que la	modifiction ne se fait juste qu'en sortie qlors je dois passer aussi la duree entre la date d'entree et la date de sortie//
			sortieclient_dechambre_table($g_code,$g_date_reserv1,$g_heure_sortie,$dureevalcalcul);
			ajout_avoir_occupation_chambre($g_chambre_val1,$etat_libre,$datere,$g_date_reserv1,'LIBEREE');
			//modifier_etat_assignation_chambre_lundibut($g_chambre_val1,$etat_libre,$g_date_reserv1);
			LeMouchard($gCode_utilisateur,'Liberer  un client');
			print "<script language='javascript'> alert('Requette effectuee'); </script>";
			}
		
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
	       
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
		   
		}
	$g_date_arrivee="";
	$g_heure_arrivee="";
	$g_date_sortie="";
    $g_heure_sortie="";
	$g_chambre_val="";
	$g_client_val1="";
	$g_parrain="";
	$g_client_val="";
		
	$i++;	
	}
	
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
			$g_chambre_val1=retour_chambre_sortietable($g_code);
			$g_chambre_val=rechercher_libertrechambre_sans_table_mercredi($g_chambre_val1);
			$g_date_arrivee=retour_date_debuttable($g_code);
			$g_date_sortie=retour_date_sortietable($g_code);
			$g_heure_sortie=retour_heure_sortietable($g_code);
			$g_heure_arrivee=retour_heure_entrereetable($g_code);
			$g_codepersonne=retour_val_idpersonne_id_sortietable($g_code);
            $g_client_val=retour_nomprenom_sortietable($g_codepersonne);
            $g_chambre_val1=retour_heure_sortietabledes($g_code);	
            $g_chambre_val=retour_libelle_chambre_fiche($g_chambre_val1);			
			}
	
	}
	
	 if(isset($g_code_imprime1) AND $g_code_imprime1!="" ){
	     //print $g_code_imprime1;
		 $g_code_imprime=retour_idpersonne_chambre_fiche($g_code_imprime1);
		 $date_max=retour_val_idpersonne_id_max_date($g_code_imprime);
		 //print $date_max;
	     $_SESSION['id_imprime']=$g_code_imprime;
		 $_SESSION['code_chabre']=retour_chambre_sortietable1($g_code_imprime1);
		 $_SESSION['date_arrivee']=retour_date_arrivee_fiche($g_code_imprime1,$_SESSION['code_chabre']);
		 $_SESSION['date_sortie']=retour_date_depart_fiche($g_code_imprime1,$_SESSION['code_chabre']);
		 $_SESSION['annuite']=retour_annuite_fiche($g_code_imprime1,$_SESSION['code_chabre']);
		 $_SESSION['code_type_chambre']=retour_type_chambre_fiche($_SESSION['code_chabre']);
		 $_SESSION['valeur_tarification']=retour_montant_type_chambre_fiche( $_SESSION['code_type_chambre']);
		 LeMouchard($gCode_utilisateur,'a Imprimer une fiche client');
		 $_SESSION['nombre_retour']=retour_nombreperfiche($g_code_imprime1);
		 //print  $_SESSION['code_chabre'];
		//header('location:fichepolice.php');
	    //print $_SESSION['id_imprime'];
	}
	
	
	if($_POST['choix']=='Go'){  //print" rien non morale";
	   if($_POST['parrainselect']=='1'){
	  print" non morale";
	   }
	   elseif($_POST['parrainselect']=='2'){
	   /*print" <script>
	    window.open('listeentreprise.php','','toolbar=yes,menubar=yes,location=yes,risizable=yes,scrollbars=yes,status=no,height=500,width=700');
         </script>";*/
        header('location:listeentreprise.php');		 
	   }
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">FICHE DE D&#39;OCCUPATION CHAMBRE<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
									    print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Nom  et  Pr&eacute;nom</strong>";
	           							print " </th>";
										
									    print " <th class='entete_tableau' >";
										print " <strong>Chambre </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date Entr&eacute;e </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date Sortie </strong>";
	           							print " </th>";
										
										/*print " <th class='entete_tableau' >";
										print " <strong>Imprimer </strong>";
	           							print " </th>";*/
									
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
									   $requete="select a.ID_OCCUPATION ,a.CODE_CHAMBRE,a.ID_PERSONNE,a.DATE_ENTREE,a.DATE_SORTIE from occuper a LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete,$link);	
										$i=0;  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 //ID_CLIENT
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";									 
											print " <td><a href='enregistrementoccupation.php?modif_code=$ID_OCCUPATION'>".stripslashes(retour_nomprenom_sortietable($ID_PERSONNE))."</a></td>";	
											print " <td>".stripslashes(rechercher_libertrechambre_sans_table_mercredi($CODE_CHAMBRE))."</td>";
											print " <td>".stripslashes($DATE_ENTREE)."</td>";
											print " <td>".stripslashes($DATE_SORTIE)."</td>";
											print " <td><a href='enregistrementoccupation.php?modif_code_imprime=$ID_OCCUPATION' onclick='openPopupprintfiche()'>".stripslashes(Imprimer)."</td>";
											print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i."<br/>";

$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM occuper');
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
											<form method="post" name="cadre" action="enregistrementoccupation.php?modif_code=<?php print $g_code;?>">
											
											
												<table border="0" cellspacing="0" cellpadding="0" class="table"  width="60%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Date Entr&eacute;e: </label></td>
						                                <td> 
                                                        <input readonly type="text" name="date_arrivee"  value="<?php print $g_date_arrivee; ?>" >
	                                                    <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                     calendarpopupDim('id1','document.cadre.date_arrivee',"fr","1","0");
	                                                    ?>
                                                        </td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Heure: </label></td>
						                                 <td> 
                                                         <input type="text" name="heure_arrivee"  value="<?php print $g_heure_arrivee; ?>">Format(H:MM:S)</td>
											            </tr>
														
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Date Sortie: </label></td>
						                                <td>
                                                        <input readonly type="text" name="date_sortie"  value="<?php print $g_date_sortie; ?>" >
	                                                     <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                     calendarpopupDim('id1','document.cadre.date_sortie',"fr","1","0");
	                                                    ?>
                                                        </td>
										              	</tr>
														 <tr style="border:hidden">
														<td style="border:hidden"><label> Heure: </label></td>
						                                <td> 
                                                        <input type="text" name="heure_sortie"  value="<?php print $g_heure_sortie; ?>" >Format(H:MM:S)</td>
											            </tr>
								 				        </form>
												       </table> 
													    <tr>
							<td>
								<td>Chambre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly name="chambre_val" id="chambre" type="text" value="<?php print $g_chambre_val;?>"  size="20" />
                                         <input type="button" value="....." onClick="openPopup1()" style="width:50px; height:30px" /></br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								 <tr>
									   <td>Nombre de personne(s)</td>
									   <td>
									   <select name="nbpersonne">
									    <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3 </option> 
									   </select>
									   </td>
                                       </tr>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Occupant:
								<input readonly name="client_val" id="client" type="text" value="<?php print $g_client_val;?>"  size="67" />
								<input readonly name="client_val1" id="identite" type="hidden" value="<?php print $g_client_val1;?>"  size="1" />
                            <input type="button" value="....." onClick="openPopup()" style="width:50px; height:30px"/>
							</td><br/> 
									</tr> 							   
                                   <tr>
								   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
								<td><label align="left">&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;Parrain:&nbsp;&nbsp;
								</label></td>	
								<td>  <select name="parrainselect">
								    <option value=""></option>
                                    <option value="1">Personne Physique</option>
                                    <option value="2">Personne Morale </option>                              
                                    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly name="parrain" id="parrainn" type="text" value="<?php print $g_parrain;?>"  size="39" /> 
									<input readonly name="parrainval" id="ident_parrain" type="hidden" value="<?php print $g_ident_parrain;?>"  size="1" />
                                <!--<input type="button" value="....." onClick="openPopup2()" style="width:50px; height:30px" /></td>-->
						          &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Go" style="width:50px; height:30px" name="choix"/>
								 </td>
									</tr> 
												 </br></br>&nbsp;&nbsp;
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/occupationchambre.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		