
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
<p>Liste des entreprises<p>

									   
									  <?php 
									      require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Num&eacute;ro  </strong>";
	           							print " </th>";
										/*
										print " <th class='entete_tableau' >";
										print " <strong> Type Identifiant  </strong>";
	           							print " </th>";*/
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Raison Sociale  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>T&eacute;l&eacute;phone </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>  Ville </strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Email </strong>";
	           							print " </th>";
										
									  										
										 // Préparation de la requête		
										// on recupère la liste 
										$requete="select * from  personne_morale";
										$result=mysql_query($requete,$link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 //ID_CLIENT
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";										 
											 print " <td style='border:1px solid black'>".$NUMERO_INDENTIFIANT."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($RAISON_SOCIALE)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($TELEPHONE_MORALE)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($VILLE_MORALE)."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($EMAIL_MORALE)."</td>";								 
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";

																			
									 ?>   
	

</body>
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>

