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
	//$g_code=addslashes($_REQUEST['code']);
	$g_service=addslashes($_REQUEST['service']);
	$g_montant=addslashes($_REQUEST['montant']);
	$g_debut=addslashes($_REQUEST['debut']);
	$g_fin=addslashes($_REQUEST['fin']);
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=="Ajouter"){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global="Annuler";}
	//print $g_code;
	
	$i=0;
	if (isset($v_global)){
	     if($v_global==Ajout){
			if($g_service!=""){
			$g_debute1=dateFormBase($g_debut);
	     	$g_fin1=dateFormBase($g_fin);
		           $retour_code_service=recup_code_du_service($g_service);
				   $retrour_max=max_valeur_tarification($response);
				  // print"".$retour_code_service;
				   //print"".$retrour_max+1;
				  $retour_max_plus=$retrour_max+1;
				  ajout_id_tarification($retour_max_plus);
				  ajout_tarification_service($retour_code_service,$retour_max_plus,$g_montant,$g_debute1,$g_fin1);
				  print"<script language='javascript'> alert('Ajout effectuee');</script>";
		$g_service="";
		$g_montant="";
		$g_debut="";
		$g_fin="";
			}
	    }
		 elseif($v_global==Modif){
		    if($g_montant!=""){
			//je recupere la valeur du code concernant la tarfification a modifier
			    $retour_code_type=recup_id_code_service_val_id_tarification_table($g_service);
		    //je recupere la valeur du code du service
				$retour_code_service=recup_code_du_service($g_service);
				$pourmofid=recup_code_du_service11($g_code);
					$g_debute1=dateFormBase($g_debut);
	     	        $g_fin1=dateFormBase($g_fin);
					modif_tarif_service_tabl($pourmofid,$g_code,$g_montant,$g_debute1,$g_fin1);	
                      print"<script language='javascript'> alert('Modification Effectuee');</script>";			
                $g_service="";
	          	$g_montant="";
		        $g_debut="";
                $g_fin="";					  
			    }
		}
		elseif($v_global=Suppression){
		// je selcte le code du service concernant id de la tarrification
		    $value_code_service_recup=recup_id_code_service_val_id_tarification_table($g_code);
		//je verifie si l'identifiant de la tarification concernant le service est en reservation
		    $result_recherche=verif_si_service_utilise_en_reservation_table($value_code_service_recup); 
            if($result_recherche==""){
			 suppression_tarification_service_tab($g_code);
			 print"<script language='javascript'> alert('Suppression Effectuee');</script>";
			 $g_service="";
		$g_montant="";
		$g_debut="";
		$g_fin="";
			}
            elseif($result_recherche!=""){
			print"<script language='javascript'> alert('Suppression impossible car le service est en reservation');</script>";
			$g_service="";
		$g_montant="";
		$g_debut="";
		$g_fin="";
			}			
		
		}
		//bouton annuler
		elseif($v_global=Annuler){
		$g_service="";
		$g_montant="";
		$g_debut="";
		$g_fin="";
		}
      $i++;
	}
	if ($i==0){
	    if (isset($g_code)){//print"".$g_code;
			$code=$g_code;
			$g_montant=recup_montant_tarification_table_serv($g_code);
			$g_debut=recup_date_debut_tarification_table_serv($g_code);
			$g_fin=recup_date_fin_tarification_table_serv($g_code);
			
		}
	
	}

?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES TARIFICATIONS<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									      require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Service  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Montant  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date D&eacute;but </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Date Fin </strong>";
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
										$requete="select distinct a.TITRE_SERVICE,b.CODE_TARIFICATION,b.MONTANT_TARIF_SERV,b.DATE_DEBUT_TARIF_SERV,b.DATE_FIN_TARIF_SERV from service a,dependre b,tarification c 
										where a.CODE_SERVICE=b.CODE_SERVICE AND b.CODE_TARIFICATION=c.CODE_TARIFICATION order by CODE_TARIFICATION desc LIMIT $limit_start, $pagination ";
										//$requete="select * from chambre order by CODE_CHAMBRE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='tarification_du_service.php?modif_code=$CODE_TARIFICATION'> ".stripslashes($TITRE_SERVICE)." </a></td>";
											 print " <td style='text-align:right;'>".stripslashes(formatage3Pos($MONTANT_TARIF_SERV))."</td>";
											 print " <td>".stripslashes($DATE_DEBUT_TARIF_SERV)."</td>";
											 print " <td>".stripslashes($DATE_FIN_TARIF_SERV)."</td>";							 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de tarifications : ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM dependre ');
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
										  
									<form method="post"  name="cadre" action="tarification_du_service.php?modif_code=<?php print $g_code;?>">
												<table style="border.hidden" cellspacing="0" cellpadding="0" width="55%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Service: </label></td>
                                                        <td>  <select name="service"><option value=""></option>
									  
									  <?php print $g_service?>
									  <?php print ChargeCombo("select TITRE_SERVICE as info from service",$g_service);?>
									  </select></td>
										 	            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Montant: </label></td>
	                                                    <td><input type="text" name="montant" value="<?php print $g_montant;?>"  size="35" /></td>
											            </tr>
														 <tr style="border:hidden">
										<td style="border:hidden"><label>Date Debut:  </label></td>
										<td><input readonly type="text" name="debut"  value="<?php print $g_debut; ?>"   size="30" / >
	                                             <?php
	                                    include_once("../calendrierphp/calendar.php");
	                                    calendarpopupDim('id1','document.cadre.debut',"fr","1","0");
	                                           ?> </td>
											            </tr>
														  <tr style="border:hidden">
												<td style="border:hidden"><label>Date Fin:  </label></td>
											  <td><input readonly type="text" name="fin"  value="<?php print $g_fin; ?>" size="30"/ >
	                                             <?php
	                                        include_once("../calendrierphp/calendar.php");
	                                       calendarpopupDim('id1','document.cadre.fin',"fr","1","0");
	                                           ?></td>
											</tr>
														
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/tarification_service.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		