
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
<p>Liste des types de chmabres<p>

									   
									  <?php 
									   require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										
										/*print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Code  </strong>";
	           							print " </th>";*/
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Libell&eacute;  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Nombre de lit une place </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Nombre de lit deux places </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Observations </strong>";
	           							print " </th>";
																												
										// on recupère la liste 
										$requete="select CODE_TYPE_CHAMBRE,LIBELLE_TYPE_CHAMBRE,NOMBRE_DE_LIT_UNE_PLACE,NOMBRE_LIT_DEUX_PLACES,OBSERVATIONS  from type_chambre";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire'>";	
											// print " <td>".$CODE_TYPE_CHAMBRE."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($LIBELLE_TYPE_CHAMBRE)." </a></td>";
											 print " <td style='border:1px solid black'>".stripslashes($NOMBRE_DE_LIT_UNE_PLACE)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($NOMBRE_LIT_DEUX_PLACES)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($OBSERVATIONS)."</td>";
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de type de chambres : ".$i;		
																			
									 ?>   
									 	
</body>
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
