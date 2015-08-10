<?php session_start();
       $_SESSION['date_petit'];
	   $_SESSION['date_grand'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <!--
    we like wine
  -->
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
   <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
<?php  	$date2=$_SESSION['date_grand'];
		$date1=$_SESSION['date_petit'];
?>
<body>

<?php include('../etat/entete_impressiom/entete.php');
?>
  <!--<center><img src="../images/top_bg.JPG"/></center>  -->
<p><p>

									   
									  <?php 	
									            $date2=$_SESSION['date_grand'];
		                                        $date1=$_SESSION['date_petit'];
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='etat_table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> NOM PRENOM</strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong> ARRIVEE </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> DEPART  </strong>";
	           							print " </th>";
										
										// on recupère la liste 
										/*$requete="SELECT CODE_TYPE_CHAMBRE AS TITRE, ID_RESEVATION AS RESERVANT, 
										DUREE_RESERV_CHAM AS DUREE, ETAT_RESERV_CHAM AS ETAT  FROM concerner where DATE_RESERV_CHAM BETWEEN '$date1' AND '$date2'
                                        UNION
                                        SELECT CODE_SERVICE AS TITRE, ID_RESEVATION AS RESERVANT, DUREE_RESERV_SERV AS DUREE, ETAT_RESERV_SERV AS ETAT
                                        FROM sappliquer where DATE_RESERV_SERV BETWEEN '$date1' AND '$date2'";*/
									    $requete="SELECT ID_PERSONNE , DATE_ENTREE , 
										DATE_SORTIE FROM occuper 
										where DATE_SORTIE  BETWEEN '$date1' AND '$date2'
                                                                              ";
										$result=mysql_query($requete, $link);	
										$i=0;		  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
									    print " <td>".stripslashes(retour_nomprenom_sortietable($ID_PERSONNE))."</a></td>";
									    print " <td>".stripslashes($DATE_ENTREE)."</a></td>";
										print " <td>".stripslashes($DATE_SORTIE)."</a></td>";
											 print " </tr>";
										}
										print "</table>";
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre : ".$i."<br/>";

																			
									 ?>   
									 	
</body>
<!--<script>window.print();</script>-->
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
