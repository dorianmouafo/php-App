<?php session_start();
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
<body>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>

<?php  	$date_de_debut=$_SESSION['date_de_debut'];
		$date_de_fin=$_SESSION['date_de_fin'];
?>
<body>

<?php //include('../etat/entete_impressiom/entete.php');
?>
  <!--<center><img src="../images/top_bg.JPG"/></center>  -->
<p><p>

									   
									<?php 
									  
										$date_de_debut=$_SESSION['date_de_debut'];
		                                $date_de_fin=$_SESSION['date_de_fin'];
										echo " Planning du ".$date_de_debut." au ".$date_de_fin;
									    require_once('../procedure_php/procedure_globale.php');
									    require_once('../procedure_php/mysql_requette.php');
									   $link=Connexion();
									   
									   																																							
										print "<table class='etat_table' border:1 width='100%' style='border-collapse:collapse;border:1px solid black;'>";
										
																			
										print " <th style='background-color:'>";
										print " <strong></strong>";
										print " </th>";
										
										$i=0;
										
										// on recupère la liste 
										$requete="select LIBELLE_CHAMBRE from chambre order by LIBELLE_CHAMBRE ASC";
										$result2=mysql_query($requete, $link);
																			
														  
										// on affiche la liste de l'état des chambres
										while($lecture=mysql_fetch_array($result2)){
											extract($lecture);
											 
											print " <th class='entete_tableau' style='border-collapse:collapse;border:1px solid black;' >";
										    print " <strong>".stripslashes($LIBELLE_CHAMBRE)."</strong>";
	           						     	print " </th>"; 

										}
										
																				
										// je récupère le nombre de chambres pour ma boucle
										$requete="SELECT * from chambre";
										$result_chambre=mysql_num_rows(mysql_query($requete));
										$boucle=$result_chambre;
																					  
										
										while($date_de_debut <= $date_de_fin){
																						 
											print " <tr	class='entete_tableau' style='border-collapse:collapse;border:1px solid black;'>";
										    print " <td>".$date_de_debut. "</td>";
											//echo $date_de_debut;
											
											$code_de_la_chambre=recupere_code_chambre_avec_libelle($LIBELLE_CHAMBRE);
																						
											$requete1="select code_chambre as code, LIBELLE_CHAMBRE as libelle from chambre order by LIBELLE_CHAMBRE ASC";
										    $result3=mysql_query($requete1, $link);
																			
														  
										    // on affiche la liste de l'état des chambres
										    while($lecture=mysql_fetch_array($result3)){
											     extract($lecture);
											    $couleur=recupere_couleur_planning_chambre($code,$date_de_debut);
											    print " <td ";
												print "style='background-color:$couleur;border:1px solid black' />"; 
											    print " </td>"; 

											}									
											
											$boucle=$result_chambre;
											
	           						     	print " </tr>"; 
											 
											 $date_de_debut=jour_suivant($date_de_debut);
											
										}
										
										print "</table>";	
										print "<br>";
																									
										print "<fieldset style='border:hidden;'><legend> L&eacute;gende </legend>";
											print "<table>";
												$requete="SELECT LIBELLE_ETAT_CHAMBRE, COULEUR_ASSOCIE FROM etat_chambre";
												$result10=mysql_query($requete, $link);
																	
												while($lecture=mysql_fetch_array($result10)){
													extract($lecture);
											 
													print " <tr class='entete_tableau' style='border-collapse:collapse;border:1px solid black;' >";
													print " <td style='border-collapse:collapse;border:1px solid black;'>".stripslashes($LIBELLE_ETAT_CHAMBRE)."</td>";
													print " <td";
													print " style='background-color:$COULEUR_ASSOCIE; color:$COULEUR_ASSOCIE;border:1px solid black'/>";
													print " <strong>".stripslashes($LIBELLE_ETAT_CHAMBRE)."</strong>";
													print " </td>";
													print " </tr>";
												}
											print" </table>";									
										print " </fieldset>";
									?>
									 	
</body>
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<!--<center><img src="../images/footer.JPG"/></center> -->
