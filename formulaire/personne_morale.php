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
 	 	//appel de tous les dossiers qui contienent les fonction que je vqis utiliser
	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION['code_code'];
	
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	//$g_code=addslashes($_REQUEST['code']);
	$g_identite=addslashes($_REQUEST['identite']);
	$g_type_identite=addslashes($_REQUEST['type_identite']);
    $g_sociale=addslashes($_REQUEST['sociale']);
    $g_adresse=addslashes($_REQUEST['adresse']);
	$g_telephone=addslashes($_REQUEST['telephone']);
    $g_fax=addslashes($_REQUEST['fax']);
	$g_ville=addslashes($_REQUEST['ville']);
    $g_pays=addslashes($_REQUEST['pays']);
	$g_email=addslashes($_REQUEST['email']);
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=="Ajouter"){$v_global=Ajout;
		$g_code=addslashes($_REQUEST['code']);		$g_identite=addslashes($_REQUEST['identite']);}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global="Annuler";}
	//print $g_code;
	
	$i=0;
	if (isset($v_global)){
	     if($v_global==Ajout){
		 //print "".$v_global;	
		    if($g_identite!=""){
			Ajout_client($g_identite);
			$ident=recup($g_identite);
			//print"".$ident;
			ajout_personne_morale($ident,$g_identite,$g_type_identite,$g_sociale,$g_adresse,$g_telephone,$g_fax,$g_ville,$g_pays,$g_email);
			LeMouchard($gCode_utilisateur,'Enregistrer une entreprise');
			$g_identite="";
		    $g_type_identite="";
		    $g_sociale="";
		    $g_adresse="";
		    $g_telephone="";
		    $g_fax="";
		    $g_ville="";
		    $g_pays="";
		    $g_email="";
			}
	    }
		//bouton modifier
		elseif($v_global==Modif){ $g_code=$_REQUEST['modif_code'];
		
		 if($g_identite!="" OR $g_identite=!"" OR 	$g_telephone=!"" ){$g_code=$_REQUEST['modif_code'];
		   modif_personne_morale($g_code,$g_identite,$g_type_identite,$g_sociale,$g_adresse,$g_telephone,$g_fax,$g_ville,$g_pays,$g_email);
		   LeMouchard($gCode_utilisateur,'Modifier des informations dune entreprise');
		   }
		}	
		//bouton supprimer
		elseif($v_global==Suppression){	
		//print"<script language='javascript'> alert('suppression impossible');</script>";
		$g_code=$_REQUEST['modif_code'];
			suppression_personne_morale($g_code);	
			LeMouchard($gCode_utilisateur,'Supprimer une entreprise');
         // print"".$v_global;			
		}
		//bouton annuler
		elseif($v_global=Annuler){
		$g_identite="";
		$g_type_identite="";
		$g_sociale="";
		$g_adresse="";
		$g_telephone="";
		$g_fax="";
		$g_ville="";
		$g_pays="";
		$g_email="";
		}
		
	$g_identite="";
	$g_type_identite="";
	$g_sociale="";
	$g_adresse="";
	$g_telephone="";
	$g_fax="";
	$g_ville="";
	$g_pays="";
	$g_email="";
      $i++;
	  
	        
	}
	
	if ($i==0){
	
	    if (isset($g_code)){
			$code=$g_code;
			$g_identite=recupere_identite_moral($g_code);
		    $g_type_identite=recupere_type_identifiant($g_code);
		    $g_sociale=recupere_raison($g_code);
		    $g_adresse=recupere_adresse($g_code);
		    $g_telephone=recupere_telephone($g_code);
		    $g_fax=recupere_fax($g_code);
		    $g_ville=recupere_ville($g_code);
		    $g_pays=recupere_pays($g_code);
		    $g_email=recupere_email($g_code);
		}
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES ENTREPRISES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										
										print "<table class='table' border:1 width='100%'>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Num&eacute;ro  </strong>";
	           							print " </th>";
										/*
										print " <th class='entete_tableau' >";
										print " <strong> Type Identifiant  </strong>";
	           							print " </th>";*/
										
										print " <th class='entete_tableau' >";
										print " <strong> Raison Sociale  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>T&eacute;l&eacute;phone </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>  Ville </strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Email </strong>";
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
										$requete="select * from  personne_morale order by ID_CLIENT desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete,$link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 //ID_CLIENT
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";									 
											 print " <td><a href='personne_morale.php?modif_code=$ID_CLIENT'> ".$NUMERO_INDENTIFIANT."</td>";
											 print " <td>".stripslashes($RAISON_SOCIALE)."</td>";
											 print " <td>".stripslashes($TELEPHONE_MORALE)."</td>";
											 print " <td>".stripslashes($VILLE_MORALE)."</td>";
											 print " <td>".stripslashes($EMAIL_MORALE)."</td>";							 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i."<br/>";

$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM personne_morale');
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
										 	<form method="post"  action="personne_morale.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" class="table"  width="60%">
												        <tr style="border:hidden">
													    <td style="border:hidden"><label>  Num&eacute;ro contribuable:</label></td>
                                                        <td><input type="text" name="identite" value="<?php print $g_identite;?>"  size="55" /></td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label>Type Identit&eacute; : </label></td>
                                                        <td><input type="text" name="type_identite" value="<?php print $g_type_identite; ?>" size="55" /></td>
											            </tr>
												         <tr style="border:hidden">
														<td style="border:hidden"><label>Raison sociale : </label></td>
                                                        <td><input type="text" name="sociale" value="<?php print $g_sociale; ?>" size="55" /></td>
											            </tr>
														 <tr style="border:hidden">
														<td style="border:hidden"><label>  Adr&eacute;sse: </label></td>
                                                        <td><input type="text" name="adresse" value="<?php print $g_adresse; ?>" size="55" /></td>
											            </tr>
														<td style="border:hidden"><label> Contacte: </label></td>
	                                                    <td style="border:hidden"><label> T&eacute;l&egrave;phone: </label><input type="text" name="telephone" value="<?php print $g_telephone;?>" size="14" /><label> &nbsp;Fax : </label><input type="text" name="fax" value="<?php print $g_fax;?>" size="17" /></td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label>  Ville: </label></td>
                                                        <td><input type="text" name="ville" value="<?php print $g_ville; ?>" size="55" /></td>
										             	</tr>
													    <tr style="border:hidden">
														<td style="border:hidden"><label> Pays: </label></td>
                                                        <td><input type="text" name="pays" value="<?php print $g_pays; ?>" size="55" /></td>
											            </tr>
														 <tr style="border:hidden">
														<td style="border:hidden"><label>  Email: </label></td>
                                                         <td><input type="text" name="email" value="<?php print $g_email; ?>" size="55" /></td>
										              	</tr>
								 				        </form>
												       </table> 
												        </br></br>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/personne_morale.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		