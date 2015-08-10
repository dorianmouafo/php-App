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
 require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	//$g_code=addslashes($_REQUEST['code']);
	$g_type_chambre=addslashes($_REQUEST['type_chambre']);
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
			if($g_type_chambre!="" OR $g_montant!=""){
		$g_debute1=dateFormBase($g_debut);
		$g_fin1=dateFormBase($g_fin);
		           $retour_code_type=Recup_code_type_chambre_tarification($g_type_chambre);
				   $retrour_max=max_valeur_tarification($response);
				  // print"".$retour_code_type;
				  // print"".$retrour_max+1;
				  $retour_max_plus=$retrour_max+1;
				  ajout_id_tarification($retour_max_plus);
				 Ajout_tarification_chambre_viser($retour_max_plus,$retour_code_type,$g_montant,$g_debute1,$g_fin1);
				  $g_type_chambre="";
		          $g_montant="";
		          $g_debut1="";
		          $g_fin1="";
				   print"<script language='javascript'> alert('Ajout effectuee');</script>";
			}
	    }
		elseif($v_global==Modif){
		//je recupere la valeur de lidentifiant du type de chambre
		  $retour_code_type=Recup_code_type_chambre_tarification($g_type_chambre);
		  $valour=Recup_code_type_chambre_tarification1($g_code);
		  $g_debute1=dateFormBase($g_debut);
		  $g_fin1=dateFormBase($g_fin);
		    if($g_montant!=""){
			    modifier_tarification_chambre_table($g_code,$valour,$g_montant,$g_debute1,$g_fin1);		
            print"<script language='javascript'> alert('Modification effectuee');</script>";				
			    }
		}
		elseif($v_global=Suppression){//print"".$v_global;
		//je recherche dabord le code du type de chambre
		    $value_code_typechambre_chercher=retourne_val_code_type_chambre_id_tarif_table($g_code);
			//je recherche si le code est dans une reservation pour ne pas supprimer
			$value_code_type_chambre_retrouve=retourne_val_code_type_chambre_dans_concerner($value_code_typechambre_chercher);
			if($value_code_type_chambre_retrouve!=""){
				print"<script language='javascript'> alert('Suppression impossible car le type de chambre est en reservation');</script>";
			}
			elseif($value_code_type_chambre_retrouve==""){
			suppression_tarification_chambre($g_code);
			  print"<script language='javascript'> alert('Suppresion effectuee');</script>";
			}
		}
		//bouton annuler
		elseif($v_global=Annuler){
		  $g_type_chambre="";
		  $g_montant="";
		  $g_debut1="";
		  $g_fin1="";
		}
		
      $i++;
	    
	}
	if ($i==0){
	    if (isset($g_code)){
			$code=$g_code;
			$g_montant=recup_montant_tarification_table($g_code);
			$g_debut=recup_date_debut_tarification_table($g_code);
			$g_fin=recup_date_fin_tarification_table($g_code);
			
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
										print " <strong> Chambre  </strong>";
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
                                            $pagination =10;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;											
													   // Préparation de la requête														
										// on recupère la liste 
										$requete="select distinct a.LIBELLE_TYPE_CHAMBRE,b.CODE_TARIFICATION,b.MONTANT_TARIF_TYPECHAMBRE,b.DATE_DEBUT_TARIF_TYPECHAMBRE,b.DATE_FIN_TARIF_TYPECHAMBRE from type_chambre a,viser b,tarification c 
										where a.CODE_TYPE_CHAMBRE=b.CODE_TYPE_CHAMBRE AND b.CODE_TARIFICATION=c.CODE_TARIFICATION order by CODE_TARIFICATION desc LIMIT $limit_start, $pagination ";
										//$requete="select * from chambre order by CODE_CHAMBRE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='tarification_chambre.php?modif_code=$CODE_TARIFICATION'> ".stripslashes($LIBELLE_TYPE_CHAMBRE)." </a></td>";
											 print " <td style='text-align:right;'>".stripslashes(formatage3Pos($MONTANT_TARIF_TYPECHAMBRE))."</td>";
											 print " <td>".stripslashes($DATE_DEBUT_TARIF_TYPECHAMBRE)."</td>";
											 print " <td>".stripslashes($DATE_FIN_TARIF_TYPECHAMBRE)."</td>";							 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de tarifications : ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM viser ');
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
										  
									 <form method="post" name="cadre" action="tarification_chambre.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="57%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Type: </label></td>
                                                        <td> <select name="type_chambre"><option value=""></option>
									  <?php print $g_type_chambre?>
									  <?php print ChargeCombo("select LIBELLE_TYPE_CHAMBRE as info from type_chambre",$g_type_chambre);?>
									  </select></td>
										 	            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Montant: </label></td>
	                                                    <td><input type="text" name="montant" value="<?php print $g_montant;?>"  size="44" /></td>
											            </tr>
														 <tr style="border:hidden">
										<td style="border:hidden"><label>Date Debut:  </label></td>
										<td><input readonly type="text" name="debut"  value="<?php print $g_debut; ?>"   size="35" / >
	                                             <?php
	                                    include_once("../calendrierphp/calendar.php");
	                                    calendarpopupDim('id1','document.cadre.debut',"fr","1","0");
	                                           ?> </td>
											            </tr>
														  <tr style="border:hidden">
												<td style="border:hidden"><label>Date Fin:  </label></td>
											  <td><input readonly type="text" name="fin"  value="<?php print $g_fin; ?>" size="35"/ >
	                                             <?php
	                                        include_once("../calendrierphp/calendar.php");
	                                       calendarpopupDim('id1','document.cadre.fin',"fr","1","0");
	                                           ?></td>
											</tr>
														
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer cette tarification?');"/>
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
                          		