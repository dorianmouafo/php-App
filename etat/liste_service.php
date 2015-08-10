
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 

<?php 
function recup_lib_type_Service_lib_affich_etat($val_id_typ){
return ResultatRequette("select LIBELLE_SERVICE as info from type_service where CODE_TYPE_SERVICE='$val_id_typ'");
}
?>
<body>
<center><img src="../images/top_bg.JPG"/></center>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
<p>LISTE DES SERVICES<p>

									   
									  <?php 
									    require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Type service </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Service  </strong>";
	           							print " </th>";
										
										
										// on recupère la liste 
										$requete="select CODE_TYPE_SERVICE,TITRE_SERVICE from service";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";	
											// print " <td>".$CODE_SERVICE."</td>";
											print " <td style='border:1px solid black'>".stripslashes(recup_lib_type_Service_lib_affich_etat($CODE_TYPE_SERVICE))."</td>";
											 print " <td style='border:1px solid black'>".stripslashes($TITRE_SERVICE)."</td>";
											 print " </tr>";
										}

										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de services : ".$i ."<br/>";
																	
																			
									 ?>   
									 	
</body>
</html></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>