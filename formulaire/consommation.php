<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
  print" <script>
    function openPopup(){
      window.open('listeclient.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=800,width=800');
    }
</script>";

  print" <script>
    function openPopup1(){
    window.open('listeserviceoccup.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=550');
    }
</script>";
  print" <script>
    function openPopup3(){
    window.open('facture_service.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=500,width=550');
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
    $g_client_val1=addslashes($_REQUEST['client_val1']);
	$g_chambre_val=addslashes($_REQUEST['chambre_val']);
	$g_quantite=addslashes($_REQUEST['quantite']);
	$g_echeance=addslashes($_REQUEST['echeance']);
	
	if($_POST['btn']=='Payer'){
	$code_serfactu=recup_code_du_service($g_chambre_val);
	$montant_service=recupere_montant_service_facturinstant($code_serfactu);
	$total=$montant_service*$g_quantite;
	$g_echeance1=dateFormBase($g_echeance);
	$idclient=recupere_idclient_facturinstant($g_client_val1);
	$date=date("Y-m-d H:i:s");
	ajout_consommation_facture($idclient,$code_serfactu,$g_quantite,$montant_service,$total,$g_echeance1,'1');
	LeMouchard($gCode_utilisateur,'Ajouter une consommation');
     //print $montant_service;
     //print $total;
      $g_client_val1="";	
      $g_chambre_val="";
      $g_quantite="";	
      $g_echeance="";	  
	}
	elseif($_POST['btn']=='Non Payer'){
	$code_serfactu=recup_code_du_service($g_chambre_val);
	$montant_service=recupere_montant_service_facturinstant($code_serfactu);
	$total=$montant_service*$g_quantite;
	$g_echeance1=dateFormBase($g_echeance);
	$idclient=recupere_idclient_facturinstant($g_client_val1);
	$date=date("Y-m-d H:i:s");
	ajout_consommation_facture($idclient,$code_serfactu,$g_quantite,$montant_service,$total,$g_echeance1,'0');
	LeMouchard($gCode_utilisateur,'Ajouter une consommation');
     //print $montant_service;
     //print $total;
      $g_client_val1="";	
      $g_chambre_val="";
      $g_quantite="";	
      $g_echeance="";	  
	}
	$i=0;
	if ($i==0){
	}	
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">FACTURATION CLIENT<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
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
							<form method="post" name="frm"  name="cadre" action="consommation.php?modif_code=<?php print $g_code;?>">
							<table border="0" cellspacing="0" cellpadding="0" width="71%">
								<tr style="border:hidden">
							<td style="border:hidden">Client:</td>
					<td><input readonly name="client_val" id="client" type="text" value="<?php print $g_client_val;?>"  size="50" />
								<input readonly name="client_val1" id="identite" type="hidden" value="<?php print $g_client_val1;?>"  size="1" />
                            <input type="button" value="....." onClick="openPopup()" style="width:50px; height:30px"/></td>
							    </tr> 
							 <tr style="border:hidden">
							<td style="border:hidden">Service: </td>
				<td><input readonly name="chambre_val" id="chambre" type="text" value="<?php print $g_chambre_val;?>"  size="40" />
                <input type="button" value="....." onClick="openPopup1()" style="width:50px; height:30px" />
							                             </td>
							</tr> 	
											<tr style="border:hidden">
												<td style="border:hidden"><label> Quantit&eacute;e: </label></td>
                          <td><input type="text" name="quantite" value="<?php print $g_quantite; ?>" size="30" /></td>
											</tr>
												<tr style="border:hidden">
													<p align="center">
														<td style="border:hidden"><label> Date: </label></td>
						                <td>  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly type="text" name="echeance"  value="<?php print $g_echeance; ?>" size="25" >
	                                        <?php
	                                        include_once("../calendrierphp/calendar.php");
	                                       calendarpopupDim('id1','document.frm.echeance',"fr","1","0");
	                                           ?>
                                        </td>
											</tr>
							
													   
													   
								 				        </form>
												       </table> <br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
                             <input type="submit" style="width:80px; height:30px" name="btn"  value="Payer" />
							  <input type="submit" style="width:80px; height:30px" name="btn"  value="Non Payer" />
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
                          		