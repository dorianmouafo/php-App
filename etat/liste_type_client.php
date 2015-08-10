
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 

  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head>


<body><center><img src="../images/top_bg.JPG"/></center>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
<div>

<p>Liste des types de clients <p>




									   
									 <?php 
									    require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%'>";
															
										print " <th class='entete_tableau' >";
										print " <strong> Libell&eacute;  </strong>";
	           							print " </th>";
										
										$requete="select code,libelle  from type_client";
										$result = pg_exec($link, $requete);
										while ($row = pg_fetch_array($result))
										{
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 
											 print " <td>".stripslashes($row["libelle"])." </td>";
											 print " </tr>";
										} 
										print "</table>";
										
										print "<br/>";
																			
									 ?>   
</div>								 	
</body>
</html></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
