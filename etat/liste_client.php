﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 
<body>
<form><img src="../images/top_bg.JPG"/></center>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
<div>

<p>Liste des clients <p>




									   
									 <?php 
									    require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
															
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Nom  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Prenom  </strong>";
	           							print " </th>";

										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> CNI  </strong>";
	           							print " </th>";

										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Num ACEP  </strong>";
	           							print " </th>";
																																						
										// on recupère la liste 
										$requete="select *  from client ";
										$result = pg_exec($link, $requete);
																				
										$i=0;
														  
										// on affiche la liste 
										while($row=pg_fetch_array($result))
										{ 											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";	
											
											 print " <td style='border:1px solid black'>".stripslashes($row["nom"])." </td>";
											 print " <td style='border:1px solid black'>".stripslashes($row["prenom"])." </td>";
											 print " <td style='border:1px solid black'> ".stripslashes($row["numcni"])." </td>";
											 print " <td style='border:1px solid black'> ".stripslashes($row["num_acep"])." </td>";
											 										 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
																			
									 ?>   
</div>
									 	
</body>

</html></br></br></br>
<center><img src="../images/footer.JPG"/></center>