<?php session_start();
include('convertion_en_lettre.php');
		$date_de_debut=$_SESSION['date_de_debut'];
		$date_de_fin=$_SESSION['date_de_fin'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 
<!--<center><img src="../images/top_bg.JPG"/></center> -->
<body>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>

<?php  	$date_de_debut=$_SESSION['date_de_debut'];
		$date_de_fin=$_SESSION['date_de_fin'];
?>
<body>


  
<p><p>

									   
									  <?php 
									  
										$date_de_debut=$_SESSION['date_de_debut'];
		                                $date_de_fin=$_SESSION['date_de_fin'];
										echo " Recettes du ".$date_de_debut." au ".$date_de_fin;
										
									   require_once('../procedure_php/mysql_requette.php');
									   require_once('../procedure_php/procedure_globale.php');
									   $link=Connexion();
									   
									   																												
										print "<table class='etat_table' border:1 width='100%' style='border-collapse:collapse;border:1px solid black;'>";										
																			
										print " <th style='background-color:'>";
										print " <strong></strong>";
										print " </th>";
										
										$i=0;
										
										// Début de la création de l'entête du tableau avec les chambres										
										$requete="select LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
										$result2=mysql_query($requete, $link);
																														
										while($lecture=mysql_fetch_array($result2)){
											extract($lecture);
											 
											print " <th class='entete_tableau'  style='border-collapse:collapse;border:1px solid black;'>";
										    print " <strong>".$LIBELLE_CHAMBRE."</strong>";
	           						     	print " </th>"; 

										}										
										
										
										print " <th class='entete_tableau' style='border-collapse:collapse;border:1px solid black;'>";
										print " <strong>Total par jour</strong>";
	           						    print " </th>";										
										
										
										// Début de la création da la colonne date au début du tableau										
										// je récupère le nombre de chambres pour ma boucle
										$requete="SELECT * from chambre";
										$result_chambre=mysql_num_rows(mysql_query($requete));
										$boucle=$result_chambre;									
										
										while($date_de_debut <= $date_de_fin){
																						 
											print " <tr	class='entete_tableau' style='border-collapse:collapse;border:1px solid black;' >";
										    print "<td style='border-collapse:collapse;border:1px solid black;'>".$date_de_debut."</td>";
																						
											$code_de_la_chambre=recupere_code_chambre_avec_libelle($LIBELLE_CHAMBRE);
																						
											$requete1="select code_chambre as code, LIBELLE_CHAMBRE as libelle from chambre order by LIBELLE_CHAMBRE ASC";
										    $result3=mysql_query($requete1, $link);
																			
											$total_jour=0;				    
										    while($lecture=mysql_fetch_array($result3)){
											     extract($lecture);
											
											    $montant_du_jour=recupere_montant_chambre_par_jour($code,$date_de_debut);
											    print " <td align='right' style='border-collapse:collapse;border:1px solid black;background-color:#789DC2'>".formatage3Pos($montant_du_jour)."</td>";
											    $total_jour+=$montant_du_jour; 
											}
											
											print "<td class='entete_tableau'  align='right' style='border-collapse:collapse;border:1px solid black;'>  ";
											print "<strong>".formatage3Pos($total_jour)."</strong>";
											print "</td>";
																																									
											$boucle=$result_chambre;
											
	           						     	print " </tr>"; 
											 
											 $date_de_debut=jour_suivant($date_de_debut);							 
																															
										}										
										// Fin de la création da la colonne date au début du tableau
										
										// Début de la ligne du montant total produit par chambre										
										print " <th class='entete_tableau' >Total par chambre </th>";											
										
										$date_de_debut=$_SESSION['date_de_debut'];
										$date_de_fin=$_SESSION['date_de_fin'];
																																																											
										$requete="select CODE_CHAMBRE as code, LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
										$result3=mysql_query($requete, $link);
																							
										$total_pour_la_periode=0;
										while($lecture=mysql_fetch_array($result3)){
											extract($lecture);
											
											
											$cout_montant=cout_chambre_periode($code,$date_de_debut,$date_de_fin);																		 
										 
											print " <td class='entete_tableau'  align='right' style='border-collapse:collapse;border:1px solid black;'>";
											print " <strong>".formatage3Pos($cout_montant)."</strong>";
											$total_pour_la_periode+=$cout_montant;
											print " </td>";
																																								
										}
											print "<td class='entete_tableau'  align='right' style='border-collapse:collapse;border:1px solid black;'>  ";
											print "<strong>".formatage3Pos($total_pour_la_periode)."</strong>";
											print "</td>";
											
									// Fin de la ligne du montant total produit par chambre											

									print "</table>";	
									print "<br>";
									echo "<strong>"." Les chambres ont produit ".enlettres($total_pour_la_periode)." pour cette p&eacute;riode"."</strong>";
								?>    
									 	
</body>
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<!--<center><img src="../images/footer.JPG"/></center> -->
