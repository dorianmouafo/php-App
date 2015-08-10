
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 

  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 


<body>
<center><img src="../images/top_bg.JPG"/></center>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>

<p>Etat des Avances<p>

									   
									  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
									
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Facture  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Date </strong>";
	           							print " </th>";
										
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Client </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Net a payer </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Avance </strong>";
	           							print " </th>";
										
										
										// on recupère la liste 
										$requete="select * from avance";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
										    $num_facture=$lecture[NUMERO_FACTURE];
										   //je recupere la date demission de chaque numero de facture
										    $dateemissionfacture=recupere_date_for_avance($num_facture);
											
											
											
											
											
											
											
											
											
											
										   //je recupere le client en fonction du numero de facture 
										     $id_client=recupere_id_for_avance($num_facture);
											 //je recupre le montant total en fonction 
											 $montant_reglement=recupere_montant_reglement_for_avance($num_facture);
											 //je recupere ce quil a payer pour la facture 
											 $montant_regler=recupere_montant_regle_for_avance($num_facture);
											 //la je recherche le reste
											 $reste_montant_payement=$montant_reglement-$montant_regler;
											 
											 
											  //je recupere la somme des enregistrements pour chaque numero de facture
											 
											 $somme_des_versements=recupere_total_montant_affiche($num_facture);
											 
											 
											 $reste_montant_payementbon=$montant_reglement-$somme_des_versements;
											 
											 
											 
													$i++;
													if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
													else print " <tr class='ligne_paire' style='border:1px solid black'>";	
													print " <td style='border:1px solid black'>".stripslashes($lecture[NUMERO_FACTURE])." </a></td>";
													print " <td style='border:1px solid black'>".($dateemissionfacture)."</td>";	
													print " <td style='border:1px solid black'>".(retour_nomprenom_savance($id_client))."</td>";	
													print " <td style='text-align:right; border:1px solid black' >".formatage3Pos($montant_reglement)."</td>";	
													print " <td style='text-align:right; border:1px solid black'  >".formatage3Pos($reste_montant_payementbon)."</td>";												 
													print " </tr>";
										}

										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d occupation faites : ".$i ."<br/><br/><br/>";
									 ?>   
									 	
</body>

</html></br></br></br>
<center><img src="../images/footer.JPG"/></center>
