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
 	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	$g_code=$_REQUEST['modif_code'];
   	$g_type_service=addslashes($_REQUEST['type_service']);
	$g_service=addslashes($_REQUEST['service']);
	if ($_POST['btn']=='Ajouter') {$v_global=Ajout;}
	elseif ($_POST['btn']=='Modifier') {$v_global=Modif;}
	elseif ($_POST['btn']=='Supprimer') {$v_global=Suppression;}
		
	$i=0;

	if (isset($v_global)){
		$recup_code_id=recup_id_de_mon_type_service($g_type_service);
			if ($v_global==Ajout){
			    if($g_service!="") {
				ajout_service_tab($recup_code_id,$g_service);	
				   print"<script language='javascript'> alert('Ajout effectuee');</script>";
				   $g_service!="";
				   $g_type_service="";
			    }
		}
		elseif ($v_global==Modif) {
			if ($g_service!="") {
			
				 Modification_service_fft($g_code,$recup_code_id,$g_service);
				   print"<script language='javascript'> alert('Modification effectuee');</script>";	
				 $g_service!="";
				 $g_type_service="";
			}
		}
		
		elseif ($v_global==Suppression){
			suppression_service($g_code);
			  print"<script language='javascript'> alert('Suppression effectuee');</script>";	
			$g_service!="";
		}	
		
		$g_service="";
		$i++;
	}
	
	if ($i==0) {
		if (isset($g_code)){
			$code=$g_code;
			$g_service=recup_val_type($g_code);
		}
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES SERVICES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									     require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Libell&eacute;  </strong>";
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
                                            $pagination =20;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;											
													   // Préparation de la requête														
										// on recupère la liste 
										
										$requete="select * from service order by CODE_SERVICE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td> <a href='service.php?modif_code=$CODE_SERVICE'> ".stripslashes(recup_lib_servicessamedi_joint($CODE_SERVICE))." </a></td>";
											 print " <td>".stripslashes(recup_typeservice_servicessamedi_joint($CODE_TYPE_SERVICE))."</td>";							 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de chambres : ".$i."<br/>";
										
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM service ');
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
												<form method="post" action="service.php?modif_code=<?php print $g_code; ?>" >
												<table border="0" cellspacing="0" cellpadding="0" width="46%">
												        <tr style="border:hidden">
														<td style="border:hidden"><label> Type: </label></td>
                                                        <td> <select name="type_service">												
										<option></option> 															 
										<?php print $g_type_service; ?>
							            <?php ChargeCombo ("select LIBELLE_SERVICE as info from type_service",$g_type_service); ?>
															</select>
										 	            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Libell&eacute : </label></td>
	                                                    <td><input type="text" name="service" value="<?php print $g_service; ?>"  size="35" /></td>
											            </tr>
														
												    </form>
												</table></br>
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer ce service?');"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/liste_service.php','Liste des services','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=800,width=800')" value="Imprimer" />
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
                          		