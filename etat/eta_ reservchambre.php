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
<p>Etat reservation des chambres<p>

									   
									  <?php 
									           require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%'    style='border:1px solid black'>";
										print " <th class='entete_tableau' style='border:1px solid black' >";
										print " <strong> NOM  </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Service</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> ETAT </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Dur&eacute;e </strong>";
	           							print " </th>";
										
                                        print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Date Arriv&eacute;e </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> AUTEUR </strong>";
	           							print " </th>";
													
										 // Préparation de la requête														
										// on recupère la list
										/*$requete="SELECT a.ID_RESEVATION, a.NOM, a.TITRE_RESERVATION, a.ETAT_RESERVATION, a.DATE_ARRIVE, a.DUREE_RESERVATION_CLIENT, b.ID_RESEVATION, b.CODE_SERVICE
                                                    FROM reservation a, sappliquer b
                                                    WHERE a.ID_RESEVATION = b.ID_RESEVATION order by a.ID_RESEVATION desc  LIMIT $limit_start, $pagination ";*/
									    $requete="select  * from reservation order by ID_RESEVATION desc";
										$result=mysql_query($requete, $link);
										$i=0;
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";
											 // print " <td>".$ID_RESEVATION."</td>";
                                            print " <td style='border:1px solid black'>".stripslashes($NOM)."</a></td>";											 
										    print " <td style='border:1px solid black'>".stripslashes($TITRE_RESERVATION)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($ETAT_RESERVATION)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($DUREE_RESERVATION_CLIENT)."</td>";
                                            print " <td style='border:1px solid black'>".stripslashes($DATE_ARRIVE)."</td>";
										    print " <td style='border:1px solid black'>".stripslashes($AUTEUR_RESERVATION)."</td>";
											 											 
											 print " </tr>";
										}

										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) ".$i ."<br/><br/>";
										

																			
									 ?>   
								 	
</body>
</html></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>