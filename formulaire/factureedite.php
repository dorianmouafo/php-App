<?php session_start();
  //print $_SESSION['id_imprime'];
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
include('convertion_en_lettre.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head>
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form> 
 <style type="text/css">
 .pour
{
   border: 1px solid black; 
   border-collapse: collapse;
}
.entetetab
{
background-color:;
}
 
 
</style>

<body>
<center><img src="../images/top_bg.JPG"/></center>
<center><p><?php $date=date("d-m-Y ");
                   print" Yaounde le ".$date;
                                      ?>
                                 
<br/> 
	 </p>
										 <p><?php 
                   print" Caisse ".$_SESSION['login'];
				/*print" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";*/
				   print"<strong><center>Facture de:</center>".$_SESSION['nom_prenom_clientv']."</strong>";
				   
				   
				   $montvalchambre=$_SESSION['prix_unit_factu']*$_SESSION['nuit_factu'];
				   
				   
				   
				   
                                      ?></p>
									  
<TABLE>
<COLGROUP>
<THEAD>																				
<TR class="entetetab" style="width:80px; height:30px" >
<TD class="pour">Reference</TD>
<TD class="pour">Designation</TD>
<TD class="pour">N&deg; de chambre</TD>
<TD class="pour">Nuitee</TD>
<TD class="pour">Prix unitaire</TD>
<TD class="pour">Montant Total</TD>
</TR>
</THEAD>
<TR>
<TD class="pour" style="width:80px; height:30px" ><?php print "Reglement facture";?></TD>
<TD class="pour" style="width:80px; height:30px" ><?php print "Ebergement";?></TD>
<TD class="pour" style="width:80px; height:30px" ><?php print "".$_SESSION['num_chambre_factu'];?></TD>
<TD class="pour" style="width:80px; height:30px" ><?php print "".$_SESSION['nuit_factu'];?></TD>
<TD class="pour" style="width:80px; height:30px; text-align:right;" ><?php print "".formatage3Pos($_SESSION['prix_unit_factu']);?></TD>
<TD class="pour" style="width:80px; height:30px; text-align:right;" ><?php print "".formatage3Pos($montvalchambre);
                                                           
                                                          ?></TD>
</TR>
</COLGROUP>
</TABLE><br/>

                                       <?php  
									       //print $_SESSION['identifiantduclient'];
										   $valeur=$_SESSION['identifiantduclient'];
										  $datemax=$_SESSION['date_max_client'];
										  $etat='0';
										 // print $datemax;
										  //print $valeur;
										  $valmonttal=recupere_somme_factureinstant102($valeur,$datemax,$etat);
									    require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										
										print "<table class='etat_table' border:1 width='50%'>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Designation </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Quantit&eacute; </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Prix unitaire</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>  Total </strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Date </strong>";
	           							print " </th>";
										
									
										// on recupère la liste 
										//$requete="select * from consommation where ID='$valeur'";
										$requete="select * from consommation where ID='$valeur' AND DATE >='$datemax' AND  ETAT='0'";
										$result=mysql_query($requete,$link);
																				
										$i=0;
										$mont=0;			  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 //ID_CLIENT
											 $mont=$letcure[TOTAL];
											// $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
											 print " <td>".stripslashes(recup_lib_info_pour_confirmation_annulation_service($CODE_SERVICE))."</td>";
											 print " <td>".stripslashes($QUANTITE)."</td>";
											 print " <td style='text-align:right;' >".stripslashes(formatage3Pos($PRIX_UNITAIRE))."</td>";
											 print " <td style='text-align:right;' >".stripslashes(formatage3Pos($TOTAL))."</td>";
                                             print " <td>".stripslashes($DATE)."</td>";											 
											 print " </tr>";
											 $i=$mont+$i;
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										//print "Montant Services consommes : ".formatage3Pos($i)."<br/>";
									   print "Montant Services consommes : ".formatage3Pos($valmonttal)."<br/>";
                                       //$total_paiement=$valmonttal+$_SESSION['prix_total_factu'];
                                       $total_paiement=$valmonttal+$montvalchambre;    
									 ?> 								 
<!--<table>
<THEAD>	
<TR>
<TD><?php print "Remise :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['remise_factu']."%";?></TD>
</TR>
</THEAD>
<THEAD>	
<TR>
<TD><?php print "Net a payer Logement: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".formatage3Pos($montvalchambre);?></TD>
</TR>
</THEAD>
<THEAD>	
<TR>
<TD><?php print "Montant Regle:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".formatage3Pos($_SESSION['regle_factu']);?></TD>
</TR>
</THEAD>
<THEAD>	
<TR>
<TD><?php print "Reste :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".formatage3Pos($_SESSION['reste_factu']);?></TD>
</TR><br/><br/>
</THEAD>
<THEAD>	
<TR>
<TD><?php print "MONTANT TOTAL FACTURE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".formatage3Pos($total_paiement);?></TD>
</TR><br/><br/>

</THEAD>
</table>
</center>-->
<?php 
print" <table class='table' border:1 width='50%'>";


print "<tr>";
print "<td> Remise :</td>";
print "<td>".$_SESSION['remise_factu']."</td>";
print "</tr>";




print "<tr>";
print "<td> Net a payer Logement: </td>";
print "<td style='text-align:right;' >".formatage3Pos($montvalchambre)."</td>";
print "</tr>";



print "<tr>";
print "<td> Montant Regle: </td>";
print "<td style='text-align:right;' >".formatage3Pos($_SESSION['regle_factu'])."</td>";
print "</tr>";


print "<tr>";
print "<td> Reste: </td>";
print "<td style='text-align:right;' >".formatage3Pos($_SESSION['reste_factu'])."</td>";
print "</tr>";


print "<tr>";
print "<td> Montant total Facture: </td>";
print "<td style='text-align:right;' >".formatage3Pos($total_paiement)."</td>";
print "</tr>";

print "</table>";
print "<strong> Montant en lettre&nbsp;&nbsp;".enlettres($total_paiement)."&nbsp;&nbsp;FCFA</strong>";
?>
<!--<script>window.print();</script>-->	
<center><img src="../images/footer.JPG"/></center>							 	
</body>
</html>
