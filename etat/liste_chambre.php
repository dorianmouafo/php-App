
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 

  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 

<?php function recupere_libelle_chambre_libelle_liste($code){
	return ResultatRequette("select LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE='$code'");
 }
?>
<body>

<center><img src="../images/top_bg.JPG"/></center>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
<p>Liste des chambres<p>

									   
									  <?php 
									 require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>  Chambre   </strong>";
	           							print " </th>";
									
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Type Chambre </strong>";
	           							print " </th>";		
																											
										// on recupère la liste 
										$requete="select * from chambre ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";
										// print " <td>".$CODE_CHAMBRE."</td>";
											 print " <td style='border:1px solid black'>".$LIBELLE_CHAMBRE."</td>";
											 print " <td style='border:1px solid black'>".stripslashes(recupere_libelle_chambre_libelle_liste($CODE_TYPE_CHAMBRE))."</td>";
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i;
																			
									 ?>   
									 	
</body>
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
