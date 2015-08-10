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
<p>ETAT DES OCCUPATIONS DES SERVICES<p>

									   
									  <?php 
									        require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Nom  et  Pr&eacute;nom</strong>";
	           							print " </th>";
										
									    print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Service</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Date debut </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Date fin </strong>";
	           							print " </th>";
										  // Numero de page (1 par défaut)
                                        if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =5;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;											
										 // Préparation de la requête
										// on recupère la liste 
										$requete="select a.ID_CLIENT,a.CODE_SERVICE,a.DATE_UTILISATION,a.DATE_FIN from utiliser a LIMIT $limit_start, $pagination ";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";
                                            print " <td style='border:1px solid black'><a href='enregistrementoccupationservice.php?modif_code=$ID_CLIENT'>".stripslashes($ID_CLIENT)."</a></td>";	
											print " <td style='border:1px solid black'>".stripslashes($CODE_SERVICE)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($DATE_UTILISATION)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($DATE_FIN)."</td>";
											 											 
											 print " </tr>";
										}

										print "</table>";
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d enregistrement(s) : ".$i ."<br/><br/>";
$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM utiliser');
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];

// Pagination
$nb_pages = ceil($nb_total / $pagination);

// Affichage
echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';	
																			
									 ?>   
								 	
</body>
</html></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
