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
<div>

<p><p>




									   
									 <?php 
									    require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
															
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Client  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Type  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Date début  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Date fin </strong>";
	           							print " </th>";
										
										$requete=" select ctc.code, nom||' '||prenom as nom,libelle,date_debut,date_fin from type_client tc ,client c,client_type_client ctc ";
										$requete.=" where ctc.code_client=c.code and ctc.code_type=tc.code";
										$result = pg_exec($link, $requete);
										$i=0;
										while ($row = pg_fetch_array($result))
										{
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 
											 print " <td style='border:1px solid black'> ".stripslashes($row["nom"])." </td>";
											 print " <td style='border:1px solid black'> ".stripslashes($row["libelle"])." </td>";
											 print " <td style='border:1px solid black'> ".stripslashes($row["date_debut"])." </td>";
											 print " <td style='border:1px solid black'> ".stripslashes($row["date_fin"])." </td>";
											 print " </tr>";
										} 
										print "</table>";
										
										print "<br/>";
																			
									 ?>   
</div>
									 	
</body>

</html></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
