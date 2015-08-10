<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
   print" <script>
    function openPopup1(){
      window.open('listeclientfacturation.php','','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=500');
    }
</script>";
print" <script>
    function openPopupvue(){
      window.open('Copie de factureedite.php','','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000');
    }
  </script>";
  print" <script>
    function openPopup2(){
    window.open('bascule.php','','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=550');
    }
</script>";
  print" <script>
    function openPopup3(){
    window.open('facture_service.php','','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=550');
    }
</script>";
  print" <script>
    function openPopupprint(){
    window.open('factureedite.php','','toolbar=yes,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000');
    }
</script>";
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

<script language="javascript">
function calcul(total,prix,tva)
{ // on se limite à un prix avec un taux de TVA et des frais de port
x=document.getElementById(prix);p=(1*x.value); // le prix
x=document.getElementById(tva);t=(1*x.value); // le taux de TVA
// les frais de port (boucle car bouton radio)
for(i=0;i<document.frm.length;i++){
   if(document.frm[i].checked){f=(1*document.frm[i].value);}
}
//r=(p*(1+(t/100))); // On calcule
r=(p-(p*(t/100)));
//r=(1.1925*p*(1-(t/100)));
x=document.getElementById(total);x.value=r; // On affecte
}
</script>

<?php
 	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION['code_code'];
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	$g_modif_code_imprime_reserv_chambre=$_REQUEST['modif_code_imprime_reserv_chambre'];
	$g_chambre=$_REQUEST['chambre'];
	$g_mode=$_REQUEST['mode'];
	$g_regle=$_REQUEST['regle'];
	$g_nuit=$_REQUEST['nuit'];
	$g_date_max=$_REQUEST['date_max'];
	$_SESSION['nom_prenom_clientv']=addslashes($_REQUEST['chambre_val']);
	$g_prixunitaire=addslashes($_REQUEST['prixunitaire']);
	$g_prix=$_REQUEST['prix'];
	$g_remise=addslashes($_REQUEST['remise']);
	$g_montantttc=$_REQUEST['total'];
	$g_idc=addslashes($_REQUEST['idc']);
	
	
	if($_POST['btn']=='Imprimer'){
	$v_global=imprimer;
	LeMouchard($gCode_utilisateur,'Facturer le client');
	$date=date("Y-m-d"); 
    $dateengendre=date("Y-m-d"); 	
    $code_type_reglement=recupere_id_type_reglement_faturation($g_mode);	
	$code_ch=recup_code_chambre($g_chambre);
	ajout_facture($g_idc,$date);
	$fr_facture_id=mysql_insert_id();
	$recherche_idfacture=recupere_id_valeur_facture_en_cours($g_idc,$date);
	ajout_facture_table_engendre($fr_facture_id,$code_ch,$g_prix,$dateengendre);
	//ajout_facture_table_reglement($code_type_reglement,$fr_facture_id,$date,$g_prix);
	//ajout_facture_table_reglement($code_type_reglement,$fr_facture_id,$date,$g_regle);
	$_SESSION['num_chambre_factu']=$g_chambre;
	$_SESSION['nuit_factu']=$g_nuit;
	$_SESSION['date_max_client']=$g_date_max;
	$_SESSION['prix_unit_factu']=$g_prixunitaire;
	$_SESSION['prix_total_factu']=$g_montantttc;
	$_SESSION['remise_factu']=$g_remise;
	$_SESSION['identifiantduclient']=$g_idc;
	$_SESSION['regle_factu']=$g_regle;
	$_SESSION['reste_factu']=$_SESSION['prix_total_factu']-$_SESSION['regle_factu'];
	
	
	
	
	
	                     $montant_service=recupere_somme_factureinstant103($g_idc,$g_date_max);
	                 // print $montant_service;
	
	
	
	
	
			if($_SESSION['reste_factu']!=""){
			$_SESSION['reste_factu']=$_SESSION['prix_total_factu']-$_SESSION['regle_factu'];
			}
			elseif($_SESSION['reste_factu']==""){
			$_SESSION['reste_factu']='null';
			}
	
	            
	$montant_total_regle=$montant_service+$g_prix;
	
	ajout_facture_table_reglement($code_type_reglement,$fr_facture_id,$date,$montant_total_regle,$g_regle);
	
	                 // la gere les effets pour les factures qui ne sont pas totalement payees
	
	                 $verif_reste=$g_montantttc-$g_regle;
					 //je verifie si la valeur du reste est differente de zeoro si oui j'introduit ca dans la table avance
					 if($verif_reste!=""){
					    ajout_avance($fr_facture_id,$g_regle,$dateengendre);
					 
					 }
	               
	             
	
	
	
	
	
	//header('location:factureedite.php');
	}

	if($_POST['btn']=='Visualiser'){
	$v_global=Visualiser;
	LeMouchard($gCode_utilisateur,'visualiser la fauture du client');
	$date=date("Y-m-d"); 
    $dateengendre=date("Y-m-d"); 	
    $code_type_reglement=recupere_id_type_reglement_faturation($g_mode);	
	$code_ch=recup_code_chambre($g_chambre);
	//ajout_facture($g_idc,$date);
	$recherche_idfacture=recupere_id_valeur_facture_en_cours($g_idc,$date);
	//ajout_facture_table_engendre($recherche_idfacture,$code_ch,$g_prix,$dateengendre);
	//ajout_facture_table_reglement($code_type_reglement,$recherche_idfacture,$date,$g_regle);
	$_SESSION['num_chambre_factu']=$g_chambre;
	$_SESSION['nuit_factu']=$g_nuit;
	$_SESSION['date_max_client']=$g_date_max;
	$_SESSION['prix_unit_factu']=$g_prixunitaire;
	$_SESSION['prix_total_factu']=$g_montantttc;
	//$_SESSION['remise_factu']=$g_remise;
	$_SESSION['identifiantduclient']=$g_idc;
	$_SESSION['regle_factu']=$g_regle;
	$_SESSION['reste_factu']=$_SESSION['prix_total_factu']-$_SESSION['regle_factu'];
	if($_SESSION['reste_factu']!=""){
	$_SESSION['reste_factu']=$_SESSION['prix_total_factu']-$_SESSION['regle_factu'];
	}
	elseif($_SESSION['reste_factu']==""){
	$_SESSION['reste_factu']='null';
	}
	//header('location:Copie de factureedite.php');
	}
	
	
	$i=0;
	$g_confirme='confirm&eacute;e';
	$g_non_confirme='non confirm&eacute;e';
	
	if ($i==0){
	}	
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">FACTURATION<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									  
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
											<form method="post" name="frm"  name="cadre" action="factureclient.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" class="table"  width="55%">
												       
													   			<tr style="border:hidden">
							<td style="border:hidden"><label align="center"></label></td>
						Client:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input readonly name="chambre_val" id="chambre" type="text" value="<?php print  $_SESSION['nom_prenom_clientv'];?>"  size="50" />
                              <input readonly type="hidden" name="idc" value="<?php print $g_idc;?>"  size="1" id="idc" />
							  <input readonly type="hidden" name="date_max" value="<?php print $g_date_max;?>"  size="30" id="date_max" />
							  <input type="button" value="....." onClick="openPopup1()" style="width:50px; height:30px" /></td>
									</tr> 
											<tr style="border:hidden">
											<td style="border:hidden"><label>N&deg; de chambre: </label><br/></td>		
                          <td><input readonly type="text" name="chambre" value="<?php print $g_chambre;?>"  size="34" id="loge" /></td>
											</tr>
										  <tr style="border:hidden"><p align="center">
														
														<td style="border:hidden"><label> Total nuit&eacute: </label></td>
                          <td><input readonly type="text" name="nuit" value="<?php print $g_nuit; ?>" size="34" id="nui" /></td>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Prix Unitaire: </label></td>
                          <td><input readonly type="text" name="prixunitaire" value="<?php print $g_prixunitaire; ?>" size="34"  id="prixunique" /></td>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label>Montant HT: </label></td>
						<td><input readonly type="text" name="prix" id="prix" onBlur="calcul('total','prix','tva')" value="<?php print $g_prix; ?>" size="34" ></td>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label>TVA: </label></td>
                          <td><input readonly type="text" name="tvabon" value="19.25%" size="34" /></td>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label>Remise: </label></td>
								<td><input type="text" name="remise" id="tva" onChange="calcul('total','prix','tva')" size="34" value="<?php print $g_remise; ?>" /></td>
											</tr>
											<tr style="border:hidden">
											  <p align="center">
														<td style="border:hidden"><label>Montant TTC: </label></td>
								<td>	<input id="total" type="text" name="total" readonly="true" value="<?php print $g_montantttc; ?>" size="34" /></td>
											</tr>
											<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Montant Regl&eacute;: </label></td>
                          <td><input type="text" name="regle" value="<?php print $g_regle; ?>" size="34" /></td>
											</tr>
												<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Echeance: </label></td>
						                <td>  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly type="text" name="echeance"  value="<?php print $g_echeance; ?>" size="25" >
	                                        <?php
	                                        include_once("../calendrierphp/calendar.php");
	                                       calendarpopupDim('id1','document.frm.echeance',"fr","1","0");
	                                           ?>
                                        </td>
											</tr>
								<tr style="border:hidden"><p align="left">	
								<td style="border:hidden"><label> Mode de reglement: </label></td>
                     			<td>
								<select name="mode"><option value=""></option>
									  <?php print $g_mode?>
									  <?php print ChargeCombo("select LIBELLE_TYPE_REGLEMENT as info from type_reglement",$g_mode);?>
							    </select></td>
                                </tr>
													   
													   
								 				        </form>
												       </table> 
													    <tr>
							<td><label align="center"></label></td>
					Service:         
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<td><input readonly name="" id="" type="text" value="<?php print "";?>"  size="30" />
                          <input type="button" value="....." onClick="openPopup3()" style="width:50px; height:30px" /></td>
							</tr> 	
                             <input type="submit" style="width:80px; height:30px" name="btn"  value="Visualiser" onclick="openPopupvue()"/>
							 <input type="submit" style="width:80px; height:30px" name="btn"  value="Imprimer"  onclick="openPopupprint()" />
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
                          		