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
<p>liste des clients <p>

									   
									  <?php 
									   require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> NOM </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong>Pr&eacute;nom </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Cni ou passport </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong>Profession</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Venant de </strong>";
	           							print " </th>";
										
                                        print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Se rendant a </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> Sex </strong>";
	           							print " </th>";
										
									
										/* if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =5;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;
                                            // Préparation de la requête*/
										// on recupère la liste 
										//$requete="select *from personne_physique order by ID_PERSONNE desc LIMIT $limit_start, $pagination ";
									  $requete="select *from personne_physique order by ID_PERSONNE desc ";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											else print " <tr class='ligne_paire'>";
                                            print " <td style='border:1px solid black'>".stripslashes($NOM_CLIENT)."</td>";											 
											print " <td style='border:1px solid black'>".$PRENOM_CLIENT."</td>";
											print " <td style='border:1px solid black'>".stripslashes($NUMERO_INDENTIFIANT)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($PROFESSION_CLIENT)."</td>";
                                            print " <td style='border:1px solid black'>".stripslashes($VENANT_DE)."</td>";
										    print " <td style='border:1px solid black'>".stripslashes($SE_RENDANT_A)."</td>";
										    print " <td style='border:1px solid black'>".stripslashes($SEX)."</td>";											 
											 print " </tr>";
										}
										print "</table>";
										// Nb d'enregistrement total
/*$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM personne_physique');
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];
// Pagination
$nb_pages = ceil($nb_total / $pagination);
//Affichage
echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i ."<br/><br/><br/>";
																	*/		
									 ?>   
								 	
</body>
</html></br></br></br>
<center><img src="../images/footer.JPG"/></center>