<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
  print" <script>
    function openPopup(){
      window.open('listeservice.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=500');
    }
  </script>";
   print" <script>
    function openPopupprintrserv(){
      window.open('fichereservchambre.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=500');
    }
  </script>";
   print" <script>
    function openPopup1(){
      window.open('listechambre.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=500');
    }
  </script>";

$retour_date_reserve=date('d/m/Y');
?>
<?php function rechercher_monidclient_dans_occupe_table($val_id_client){
return ResultatRequette("select ID_PERSONNE  as info from occuper where ID_PERSONNE ='$val_id_client'");
}
function rechercher_monidclient_dans_recevoir_table($val_id_client){
return ResultatRequette("select ID_PERSONNE  as info from recevoir where ID_PERSONNE ='$val_id_client'");
}
function rechercher_monidclient_dans_consigne_table($val_id_client){
return ResultatRequette("select ID_PERSONNE  as info from consigne where ID_PERSONNE ='$val_id_client'");
}
function recupnumero_responssable_parrain_table($donnee){
return ResultatRequette("select NUMERO_INDENTIFIANT as info from client where ID_CLIENT='$donnee'");
}
function recup_val_chabre_client_tab($client){
return ResultatRequette("select CODE_CHAMBRE as info from occuper where ID_PERSONNE='$client'");
}
function recup_val_recevoir_client_tab($client){
return ResultatRequette("select ID_VISITEUR as info from recevoir where ID_PERSONNE='$client'");
}
function recup_val_const_client_tab($client){
return ResultatRequette("select ID_CONSIGNE as info from consigne where ID_PERSONNE='$client'");
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
    $code_etat_occup= recup_val_code_etat('ok');
	//print "".$code_etat_occup;
       //je lui passe la valeur du code de chaque ligne en fonction du libelle 
	   $g_code=$_REQUEST['modif_code'];
	   $g_code_imprime=$_REQUEST['modif_code_imprime'];
	//$g_libelle=addslashes($_REQUEST['libelle']);	
	   $g_indentifiant=addslashes($_REQUEST['indentifiant']);
	   $g_type_identite=addslashes($_REQUEST['type_identite']);
	   $g_date_delivrance=addslashes($_REQUEST['date_delivrance']);
	   $g_lieu_delivrance=addslashes($_REQUEST['lieu_delivrance']);
	   $g_nom=addslashes($_REQUEST['nom']);
	   $g_prenom=addslashes($_REQUEST['prenom']);
	   $g_date_nais=addslashes($_REQUEST['date_nais']);
	   $g_ville_nais=addslashes($_REQUEST['ville_nais']);								  
	   $g_pays_nais=addslashes($_REQUEST['pays_nais']);
	   $g_nationalite=addslashes($_REQUEST['nationalite']);
	   $g_pays_residence=addslashes($_REQUEST['pays_residence']);
	   $g_ville_residence=addslashes($_REQUEST['ville_residence']);
	   $g_profession=addslashes($_REQUEST['profession']);
	   $g_adresse_pivee=addslashes($_REQUEST['adresse_pivee']);
	   $g_telephone_client=addslashes($_REQUEST['telephone_client']);
	   $g_email_client=addslashes($_REQUEST['email_client']);
       $g_societe=addslashes($_REQUEST['societe']);
	   $g_adresse_travail=addslashes($_REQUEST['adresse_travail']);
	   $g_telephone_travail=addslashes($_REQUEST['telephone_travail']);
	   $g_fax_travail=addslashes($_REQUEST['fax_travail']);
	   $g_email_travail=addslashes($_REQUEST['email_travail']);
	   $g_venant_de=addslashes($_REQUEST['venant_de']);
	   $g_se_rendant=addslashes($_REQUEST['se_rendant']);
	   $g_responsable=addslashes($_REQUEST['responsable']);
	    $g_responsable1=addslashes($_REQUEST['responsable1']);
	   //recuperation des information pour les personnes a charges
	   
	   $g_codee=$_REQUEST['modif_codee'];
	   $g_code1=addslashes($_REQUEST['code1']);
	   $g_code_v1=addslashes($_REQUEST['code_v1']);
	   $g_type_identite1=addslashes($_REQUEST['type_identite1']);
       $g_nom1=addslashes($_REQUEST['nom1']);
       $g_prenom1=addslashes($_REQUEST['prenom1']);
	//fin de la recuperation de donnes pour personnes a charge
	
	//debut recuperation des informations sur la chambre
	   $g_lib_chambre=addslashes($_REQUEST['lib_chambre']);
	   $g_date_ente=addslashes($_REQUEST['date_ente']);
	   $g_heure_ente=addslashes($_REQUEST['heure_ente']);
	   $g_date_depart=addslashes($_REQUEST['date_depart']);
	   $g_heure_depart=addslashes($_REQUEST['heure_depart']);
	//fin recuperation des informations sur la chambre
	
	//on  passe en parametre toutes les valeurs des boutons 
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
	$i=0;
	
	// si une variable globale existe cest a dire si on  a appuie sur un bouton 
	if (isset($v_global)){
	          // on verifie sur quel bouton il a appuie
	    if($v_global==Ajout){ 
		    if($g_nom!="" AND $g_prenom!=""){
			    $g_date_nais1=dateFormBase($g_date_nais);
				$g_date_delivrance1=dateFormBase($g_date_delivrance);
				//on ajoute d'abord dans la table client
				Ajout_client($g_indentifiant);
				$g_id=recup_phy($g_indentifiant);
				//on ajoute maintenant dans la table personnne physique
				    if($_POST['sex']!=""){
					    if($_POST['sex']=='11'){
							   ajout_personne_physique($g_id,$g_indentifiant,$g_type_identite,$g_date_delivrance1,$g_lieu_delivrance,$g_nom,$g_prenom,$g_date_nais1,
					            $g_ville_nais,$g_pays_nais,$g_nationalite,$g_pays_residence,$g_ville_residence,$g_adresse_pivee,$g_telephone_client,
					            $g_email_client,$g_profession,$g_societe,$g_adresse_travail,$g_telephone_travail,$g_fax_travail,$g_email_travail,$g_venant_de,$g_se_rendant,'masculin');
								//le lui reserve unenchqmbre fictive pour me faciliter le travail dans occupation//
								$id_parrain_ou_clit=recup_phy_dans_personne_table($g_id,$g_nom,$g_prenom);
								 LeMouchard($gCode_utilisateur,'Ajouter un client');
								//Ajout_occupation('1',$id_parrain_ou_clit,'0000-00-00','00:00:00','0000-00-00','00:00:00','0');
								   print "<script language='javascript'> alert('Ajout Effectuee'); </script>";
								   
					    }
					    elseif($_POST['sex']=='21'){
							   ajout_personne_physique($g_id,$g_indentifiant,$g_type_identite,$g_date_delivrance1,$g_lieu_delivrance,$g_nom,$g_prenom,$g_date_nais1,
					            $g_ville_nais,$g_pays_nais,$g_nationalite,$g_pays_residence,$g_ville_residence,$g_adresse_pivee,$g_telephone_client,
					            $g_email_client,$g_profession,$g_societe,$g_adresse_travail,$g_telephone_travail,$g_fax_travail,$g_email_travail,$g_venant_de,$g_se_rendant,'feminin');
								//le lui reserve unenchqmbre fictive pour me faciliter le travail dans occupation//
								//$id_parrain_ou_clit=recup_phy_dans_personne_table($g_id,$g_nom,$g_prenom);
								//Ajout_occupation('1',$id_parrain_ou_clit,'0000-00-00','00:00:00','0000-00-00','00:00:00','0');
								 LeMouchard($gCode_utilisateur,'Ajouter un client');
				        	     print "<script language='javascript'> alert('Ajout Effectuee'); </script>";
					    }
				    }
                    else{
				        print "<script language='javascript'> alert('Preciser le sex'); </script>";
			
			        }					
			}
			else{
				print "<script language='javascript'> alert('Preciser le nom et/ou le prenom'); </script>";
			
			}
	   $g_indentifiant="";
	   $g_type_identite="";
	   $g_date_delivrance="";
	   $g_lieu_delivrance="";
	   $g_nom="";
	   $g_prenom="";
	   $g_date_nais="";
	   $g_ville_nais="";								  
	   $g_pays_nais="";
	   $g_nationalite="";
	   $g_pays_residence="";
	   $g_ville_residence="";
	   $g_profession="";
	   $g_adresse_pivee="";
	   $g_telephone_client="";
	   $g_email_client="";
       $g_societe="";
	   $g_adresse_travail="";
	   $g_telephone_travail="";
	   $g_fax_travail="";
	   $g_email_travail="";
	   $g_venant_de="";
	   $g_se_rendant="";
	   $g_responsable="";
		}
	    elseif($v_global==Modif){
		   if($g_nom!=""){
		   	 	$g_date_nais1=dateFormBase($g_date_nais);
				$g_date_delivrance1=dateFormBase($g_date_delivrance);
				if($_POST['sex']!=""){
				    if($_POST['sex']=='11'){
		   Modifer_personne_physique($g_code,$g_indentifiant,$g_type_identite,$g_date_delivrance1,$g_lieu_delivrance,$g_nom,$g_prenom,$g_date_nais1,
					              $g_ville_nais,$g_pays_nais,$g_nationalite,$g_pays_residence,$g_ville_residence,$g_adresse_pivee,$g_telephone_client,
					              $g_email_client,$g_profession,$g_societe,$g_adresse_travail,$g_telephone_travail,$g_fax_travail,$g_email_travail,$g_venant_de,$g_se_rendant,'masculin');
								   LeMouchard($gCode_utilisateur,'Modifier les informations du  client');
		        
				    }
					elseif($_POST['sex']=='21'){
			Modifer_personne_physique($g_code,$g_indentifiant,$g_type_identite,$g_date_delivrance1,$g_lieu_delivrance,$g_nom,$g_prenom,$g_date_nais1,
					              $g_ville_nais,$g_pays_nais,$g_nationalite,$g_pays_residence,$g_ville_residence,$g_adresse_pivee,$g_telephone_client,
					              $g_email_client,$g_profession,$g_societe,$g_adresse_travail,$g_telephone_travail,$g_fax_travail,$g_email_travail,$g_venant_de,$g_se_rendant,'masculin');
								  LeMouchard($gCode_utilisateur,'Modifier les informations du  client');
		        		
					}
				}        
		    }
		}
		elseif($v_global==Suppression){
		//je verifie si le client n'est plus dans une chambre avec ma fonction
		        $valeur_dans_concerner=rechercher_monidclient_dans_occupe_table($g_code);
		//je verifier si dans recevoir
		        $valeur_dans_recevoir=rechercher_monidclient_dans_recevoir_table($g_code);
				$valeur_dans_consigne=rechercher_monidclient_dans_consigne_table($g_code);
				$chambre=recup_val_chabre_client_tab($g_code);
				$visiteur=recup_val_recevoir_client_tab($g_code);
				$idconsigne=recup_val_const_client_tab($g_code);
				 //suppression occupation
				
				/*if($chambre=!"" OR $visiteur!="" OR $valeur_dans_consigne!=""){
				suppression_occupation_personne_table($chambre,$g_code);
			   print "<script language='javascript'> alert('Suppression occupation'); </script>";
				}
				elseif($visiteur!=""){
				 suppression_recevoir_personne_table($g_code,$visiteur);
			    print "<script language='javascript'> alert('Suppression visiteur'); </script>";
				} 
			    elseif($valeur_dans_consigne!=""){
				     suppression_consigne_personne_table($idconsigne,$g_code);
			    print "<script language='javascript'> alert('Suppression des consignes'); </script>"; 
				}*/
                if($chambre!="" OR $visiteur!="" OR $valeur_dans_consigne!=""){
				  print "<script language='javascript'> alert('Suppression effectuee '); </script>";
				 Suppression_personne_physique($g_code);
				}				
			    else {Suppression_personne_physique($g_code);
			   print "<script language='javascript'> alert('Suppression Totale'); </script>";
			   }
		}
	}
    if ($i==0){
	    if (isset($g_code)){
//	print $g_code;
			//$code=$g_code;
		    $g_type_identite=recup_type($g_code);
			//print "".$g_code;
			$g_date_delivrance=recup_date_deliv($g_code);
			$g_lieu_delivrance=recup_lieu($g_code);
			$g_nom=recup_nome($g_code);
			$g_prenom=recup_prenom($g_code);
			$g_date_nais=recup_dat_naiss($g_code);
			$g_ville_nais=recup_ville_naiss($g_code);
			$g_pays_nais=recup_pays_naiss($g_code);
			$g_nationalite=recup_nationalite($g_code);
			$g_pays_residence=recup_pays_resid($g_code);
			$g_ville_residence=recup_ville_resid($g_code);
		    $g_profession=recup_prefession_cli($g_code);
			$g_adresse_pivee=recup_adres_cli($g_code);
			$g_telephone_client=recup_tel_cli($g_code);
			$g_email_client=recup_email_cli($g_code);
			$g_societe=recup_societ_cli($g_code);
			$g_adresse_travail=recup_addr_societ($g_code);
			$g_telephone_travail=recup_tel_societ($g_code);
			$g_fax_travail=recup_fax_societ($g_code);
			$g_email_travail=recup_email_societ($g_code);
			$g_venant_de=recup_depart($g_code);
			$g_se_rendant=recup_allant($g_code);
			$g_nb_personne=recup_nb($g_code);
			
			
			//affiche pour personnes a charges
			$g_code_v1=recupere_identif_a($g_code);
			$g_type_identite1=recupere_type_identifiant_a($g_code);
			$g_nom1=recupere_nom_a($g_code);
			$g_prenom1=recupere_prenom_a($g_code);
			//fin affiche pour personne a charges
		}
	}
	   /* if(isset($g_code_imprime) AND $g_code_imprime!="" ){
		 $date_max=retour_val_idpersonne_id_max_date($g_code_imprime);
		 print $date_max;
	     $_SESSION['id_imprime']=$g_code_imprime;
		 $_SESSION['code_chabre']=retour_chambre_sortietable1($g_code_imprime,$date_max);
		 $_SESSION['date_arrivee']=retour_date_arrivee_fiche($g_code_imprime,$_SESSION['code_chabre']);
		 $_SESSION['date_sortie']=retour_date_depart_fiche($g_code_imprime,$_SESSION['code_chabre']);
		 $_SESSION['annuite']=retour_annuite_fiche($g_code_imprime,$_SESSION['code_chabre']);
		 $_SESSION['code_type_chambre']=retour_type_chambre_fiche($_SESSION['code_chabre']);
		 $_SESSION['valeur_tarification']=retour_montant_type_chambre_fiche( $_SESSION['code_type_chambre']);
		 LeMouchard($gCode_utilisateur,'a Imprimer une fiche client');
		 print  $_SESSION['code_chabre'];
		header('location:fichepolice.php');
	  //print $_SESSION['id_imprime'];
	}*/
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES CLIENTS<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									   require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> NOM </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Pr&eacute;nom </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Cni ou passport </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Profession</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Venant de </strong>";
	           							print " </th>";
										
                                        print " <th class='entete_tableau' >";
										print " <strong> Se rendant &agrave; </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Sexe </strong>";
	           							print " </th>";
										
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
										$requete="select *from personne_physique order by ID_PERSONNE desc LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											else print " <tr class='ligne_paire'>";
                                            print " <td><a href='enregistrementclient.php?modif_code=$ID_PERSONNE'>".stripslashes($NOM_CLIENT)."</a></td>";											 
											print " <td>".$PRENOM_CLIENT."</td>";
											print " <td>".stripslashes($NUMERO_INDENTIFIANT)."</td>";
											print " <td>".stripslashes($PROFESSION_CLIENT)."</td>";
                                            print " <td>".stripslashes($VENANT_DE)."</td>";
										    print " <td>".stripslashes($SE_RENDANT_A)."</td>";
										    print " <td>".stripslashes($SEX)."</td>";
										    //print " <td><a href='?modif_code_imprime=$ID_PERSONNE' onclick='openPopupprint()'>".stripslashes(Imprimer)."</td>";
										    //print " <td><a href='enregistrementclient.php?modif_code_imprime=$ID_PERSONNE'>".stripslashes(Imprimer)."</td>";											 
											 print " </tr>";
										}
										print "</table>";
										// Nb d'enregistrement total
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM personne_physique');
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];
// Pagination
$nb_pages = ceil($nb_total / $pagination);
//Affichage
echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i ."<br/>";
										
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
                          <div class="art-post-inner art-article"><strong  style="text-align:center;" >FICHE DU CLIENT</strong>
                                          <h2 class="art-postheader"><a href="#" title="Permanent Link to this Post"></a></h2>
                                          <div class="art-postmetadataheader">
										  <form  method="post"  name="cadre" action="enregistrementclient.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" class="table"  width="60%">
												        <tr style="border:hidden">
												        <td style="border:hidden"><label> CNI/Passport:</label><br/></td>		
                                                        <td><input type="text" name="indentifiant" value="<?php print $g_indentifiant;?>"  size="60" /></td>
											            </tr>
														<tr style="border:hidden">	
														<td style="border:hidden"><label> Type Identit&eacute;: </label></td>
                                                        <td><input type="text" name="type_identite" value="<?php print $g_type_identite;?>" size="60" /></td>
											            </tr>
												        <tr style="border:hidden">
										                <td style="border:hidden"><label> Date D&eacute;livrance:</label></td>
				                                         <td>
                                                        <input readonly type="text" name="date_delivrance"  value="<?php print $g_date_delivrance; ?>" />
	                                                    <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                    calendarpopupDim('id1','document.cadre.date_delivrance',"fr","1","0");
	                                                    ?>
														<label> 
                                                     	Lieu:<input type="text" name="lieu_delivrance" value="<?php print $g_lieu_delivrance?>"  size="22" />
														</label>
														</td>
										             	</tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Nom: </label></td>
                                                        <td><input type="text" name="nom" value="<?php print $g_nom;?>"  size="60" /></td>
											           </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Pr&eacute;nom: </label></td>
											            <td><input type="text" name="prenom" value="<?php print $g_prenom;?>"  size="60" /></td>
											            </tr>
														<tr style="border:hidden">
											            <td style="border:hidden"><label> Date de Naissance:</label></td>
			                                            <td>
                                                         <input readonly  type="text" name="date_nais"  value="<?php print $g_date_nais; ?>" >
	                                                    <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                     calendarpopupDim('id1','document.cadre.date_nais',"fr","1","0");
	                                                    ?><label> 
			                                            <label style="border:hidden">ville: <input type="text" name="ville_nais" value="<?php print $g_ville_nais;?>"  size="22" />   </label></td>
										               	</tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Pays de naissance: </label></td>
                                                        <td><input type="text" name="pays_nais" value="<?php print $g_pays_nais;?>"  size="60" /></td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Nationalit&eacute;: </label></td>
                                                        <td><input type="text" name="nationalite" value="<?php print $g_nationalite;?>"  size="60" /></td>
										              	</tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Pays de R&eacute;sidence:</label></td>
														<td><input type="text" name="pays_residence" value="<?php print $g_pays_residence;?>"  size="25" /><label>ville :<input type="text" name="ville_residence" value="<?php print $g_ville_residence;?>"  size="27" /></label></td>
											            </tr>
														<tr style="border:hidden">
														<td style="border:hidden"><label> Prof&eacute;ssion: </label></td>
                                                        <td><input type="text" name="profession" value="<?php print $g_profession;?>"  size="60" /></td>
											            </tr>
														<tr style="border:hidden">
													     <td style="border:hidden"><label> Adresse priv&eacute;e: </label></td>
                                                        <td><input type="text" name="adresse_pivee" value="<?php print $g_adresse_pivee;?>"  size="60" /></td>
											            </tr>
														<tr style="border:hidden">
													    <td style="border:hidden"><label> Contact :</label></td>
                                                        <td style="border:hidden">T&eacute;l&eacute;phone: <input type="text" name="telephone_client" value="<?php print $g_telephone_client;?>"  size="17" /><label>Email:<input type="text" name="email_client" value="<?php print $g_email_client;?>"  size="23" /></label></td>
											            </tr>
														 <tr style="border:hidden">
													    <td style="border:hidden"><label> soci&eacute;t&eacute; de Travail: </label></td>
                                                        <td><input type="text" name="societe" value="<?php print $g_societe;?>"  size="60" /></td>
									                     </tr>
                                                        <tr style="border:hidden">
													    <td style="border:hidden"><label> Adr&eacute;sse soci&eacute;te: </label></td>
                                                         <td><input type="text" name="adresse_travail" value="<?php print $g_adresse_travail;?>"  size="60" /></td>
										             	</tr>	
                                                        <tr style="border:hidden">
														<td style="border:hidden"><label> T&eacute;l&eacute;phone soci&eacute;te: </label></td>
                                                         <td><input type="text" name="telephone_travail" value="<?php print $g_telephone_travail;?>"  size="60" /></td>
											            </tr>														
													    <tr style="border:hidden">
														<td style="border:hidden"><label>Contact :</label></td>
                                                         <td style="border:hidden"> Fax: <input type="text" name="fax_travail" value="<?php print $g_fax_travail;?>"  size="23" /><label>Email : <input type="text" name="email_travail" value="<?php print $g_email_travail;?>"  size="22" /></label></td>
											            </tr>
														 <tr style="border:hidden"><td style="border:hidden"><label> Venant De: </label></td>
                                                         <td ><input type="text" name="venant_de" value="<?php print $g_venant_de;?>"  size="60" /></td>
											            </tr>
										                 <tr style="border:hidden">
														<td style="border:hidden"><label> Se Rendant &agrave;: </label></td>
                                                         <td><input type="text" name="se_rendant" value="<?php print $g_se_rendant;?>"  size="60" /></td>
											            </tr>
											             <tr style="border:hidden">
											            <td style="border:hidden"><label> Sexe:</label></td>
					                                   <td>
                                                        <select name="sex">
                                                        <option value="11">Masculin</option>
                                                         <option value="21">Feminin</option>                              
                                                         </select></td> 
											             </tr>
								 				        </form>
												       </table>
												        </br>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn" value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>					
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/personne_physique.php','Liste des tarification','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=1000,width=1000')" value="Imprimer" />
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
                          		