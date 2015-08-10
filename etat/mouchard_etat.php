<?php session_start();?>
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
<p>MOUCHARD <p>

									   
									  <?php 
									  $date1=$_SESSION['date_petit_mouchard'];
									  $date2=$_SESSION['date_grand_mouchard'];
									     require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
									
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> UTILISATEUR </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong>DATE</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> HEURE </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> OPERATION </strong>";
	           							print " </th>";
										
                                      
																				
										// Préparation de la requête		
									    $requete="select  * from  mouchard where date_operation  BETWEEN '$date1' AND '$date2'";
										// on recupère la liste 
										$result=mysql_query($requete, $link);
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire'>";	
										    print " <td style='border:1px solid black'>".stripslashes(recupere_nom_user_mouchard($code_user))."</a></td>";
											print " <td style='border:1px solid black'>".stripslashes($date_operation)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($heure_operation)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($operation_effectuee)."</td>";
											print " </tr>";
										}
										print "</table>";
										$retour_date=date('d/m/Y');
										$code_cen="";
										$libelle="";
										print "<br/>";
									 ?>   
								 	
</body>
</html></br></br></br>
<center><img src="../images/footer.JPG"/></center>