<?php session_start();
       $_SESSION['date_petit_list_fact'];
	   $_SESSION['date_grand_list_fact'];
	
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
<?php  	$date2=$_SESSION['date_grand_list_fact'];
		$date1=$_SESSION['date_petit_list_fact'];
?>
<body>

<?php include('../etat/entete_impressiom/entete.php');
?>
  <!--<center><img src="../images/top_bg.JPG"/></center>  -->
<p><p>

									   
									  <?php 	
									            $date2=$_SESSION['date_grand_list_fact'];
		                                        $date1=$_SESSION['date_petit_list_fact'];
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> NUMERO </strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong> CLIENT </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> DATE </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> MONTANT </strong>";
	           							print " </th>";
										// on recupère la liste 
									
									    $requete="SELECT NUMERO_FACTURE , ID_CLIENT , DATE_REGLEMENT FROM facture where DATE_REGLEMENT  BETWEEN '$date1' AND '$date2'";
										$result=mysql_query($requete, $link);	
										$i=0;		
                                        $valeur_montant_fac=0;											
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
										        $code_fact=$lecture[NUMERO_FACTURE];
												$montant_facture=recupere_montant_reglement_liste_facture($code_fact);
												$valeur_montant_fac=$valeur_montant_fac+$montant_facture;
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
									    print " <td>".stripslashes(($NUMERO_FACTURE))."</a></td>";
									    print " <td>".stripslashes(retour_nomprenom_liste_facture_table($ID_CLIENT))."</a></td>";
										print " <td>".stripslashes($DATE_REGLEMENT)."</a></td>";
										print " <td  style='text-align:right;'>".stripslashes(formatage3Pos($montant_facture))."</a></td>";
											 print " </tr>";
										}
										print "</table>";
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de factures: ".$i."&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										";
										
										print "Montant Total des factures: ".formatage3Pos($valeur_montant_fac)."<br/>";
																			
									 ?>   
									 	
</body>
<!--<script>window.print();</script>-->
</html></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<center><img src="../images/footer.JPG"/></center>
