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
<body>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>

<p>Liste des consignes<p>

									   
									  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										
										/*  print " <th class='entete_tableau' >";
										print " <strong> Code  </strong>";
	           							print " </th>"; */
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Nom du client  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> nature </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Quantité </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Date de dépot </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Date de retrait </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Observations </strong>";
	           							print " </th>";
																												
										// on recupère la liste 
										$requete="select ID_CONSIGNE,NOM_CLIENT,NATURE_OBJET,NOMBRE_OBJET,DATE_DEPOT,DATE_RETRAIT,OBSERVATION_OBJET from consigne,personne_physique where consigne.ID_CLIENT=personne_physique.ID_CLIENT order by ID_CONSIGNE";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";	
											// print " <td>".$ID_CONSIGNE."</td>";
											 print " <td style='border:1px solid black'> <a href='consigne.php?modif_code=$ID_CONSIGNE'> ".stripslashes($NOM_CLIENT)." </a></td>";
											 print " <td style='border:1px solid black'>".stripslashes($NATURE_OBJET)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($NOMBRE_OBJET)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($DATE_DEPOT)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($DATE_RETRAIT)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($OBSERVATION_OBJET)."</td>";
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										
										print "<br/>";
										print "Nombre de consignes : ".$i;
										
																			
									 ?> 
									 	
</body>
</html>
