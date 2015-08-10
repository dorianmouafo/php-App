
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <!--
    we like wine
  -->
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
     <link rel="stylesheet" href="../procedure_css/le_style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" /> 
</head> 

<?php
if($_POST['bnt']=="Fermer"){
 print "<script language='javascript'> self.close(); </script>";
}
?>
<body>

<!--<center><img src="../images/top_bg.JPG"/></center>-->
<p><p>

									   
									  <?php 
									 require_once('../procedure_php/procedure_globale.php');
									 require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										print "<center> <table class='table' border:1 width='90%'></center>";
										
										print " <th class='entete_tableau' >";
										print " <strong>  Choix  </strong>";
	           							print " </th>";
									
										
										print " <th class='entete_tableau' >";
										print " <strong>Nom  </strong>";
	           							print " </th>";	
										
                                        print " <th class='entete_tableau' >";
										print " <strong>Quantite  </strong>";
	           							print " </th>";											
																											
										// on recupère la liste 
										$requete="select * from service ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
											 print " <td><input type='checkbox' name='' value=''/>".stripslashes($CODE_SERVICE)."</td>";	
											 print " <td>".stripslashes($TITRE_SERVICE)."</td>";
											 print " <td> <input type='text' name='' value='' size='3'/>".stripslashes($valeur)."</td>";
											 									 											 
											 print " </tr>";
										}
										print "</table>";
										print "<br/>";
										//print "Nombre d'Enregistrement(s) : ".$i;
																			
									 ?>   
 <!--<input type="submit" style="width:80px; height:30px" name="btn"  value="Fermer" />		-->							 	
</body>
<!--<script>window.print();</script>-->
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<!--<center><img src="../images/footer.JPG"/></center>-->
