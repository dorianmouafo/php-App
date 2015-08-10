<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
 <style type="text/css">
 .pour
{
   border: 1px solid black; 
   border-collapse: collapse;
}
.entetetab
{

   background-color:#789DC2;
}
.bord{
   border: 1px solid white; 
   border-collapse: collapse;
}
 
       </style>  
<link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" /> 
  <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
</head> 
<body>
<?php
  //print $_SESSION['id_reserv_chambre'];
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
if(isset($_SESSION['id_reserv_chambre']) AND $_SESSION['id_reserv_chambre']!="" ){
            $g_code_val=$_SESSION['id_reserv_chambre'];
            $g_indentifiant=recup_numero($g_code_val);
			$g_nom=recup_nom($g_code_val);
			$g_titre=recup_titre($g_code_val);
			$g_observation=recup_etat($g_code_val);
			$g_observation=recup_observation($g_code_val);
			$g_date_reserv=recup_date_reserv($g_code_val);
			$g_duree=recup_duree($g_code_val);
			$g_date_arriv=recup_date_arrive($g_code_val);
			$g_auteur=recup_auteur($g_code_val);      
            $g_date_arrivee=retour_date_arriveeprevu_fiche_reserv_chambre($g_code_val);
			$g_nuit=retour_duree_arriveeprevu_fiche_reserv_chambre($g_code_val);
	        $g_etat=stripslashes(retour_etat_reserv_fiche_reserv_chambre($g_code_val));
}
?>
<img src="../images/entete.PNG"/>
                                    <p>FICHE DE RESERVATION <p>
								 	  <table class="bord">
											<!-- <tr class="bord">
															<td class="bord"><label>Num&eacute;ro CNI/Passport: </label><br/></td>		
                          <td class="bord"><input readonly type="text" name="indentifiant" value="<?php print $g_indentifiant;?>"  size="40" class="les_code" /></td>
											</tr>-->
										 <!--  <tr class="bord"><td><label> Nom  : </label></td>
                          <td class="bord"><input readonly  type="text" name="nom" value="<?php print $g_nom; ?>" size="40" /></td>
											</tr>-->
											<!--  <tr class="bord">
														<td class="bord"><label> Dur&eacute;e: </label></td>
                          <td class="bord"><input readonly  type="text" name="nuit" value="<?php print $g_nuit."jours"; ?>" size="20" /></td>
											</tr>-->
											<!-- <tr class="bord">
														<td class="bord"><label> Date Arriv&eacute;e Prevue: </label></td>
						                <td class="bord">  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly type="text" name="date_arrivee"  value="<?php print $g_date_arrivee; ?>" >
                                        </td>
											</tr>-->
											<!--  <tr class="bord">
										<td class="bord"><label> Etat R&eacute;servation :</label> </td>
										<td class="bord"><input readonly type="text" name="etat"  value="<?php print stripslashes($g_etat); ?>" ></td>
											</tr>-->
											<!--  <tr class="bord">
										<td class="bord"><label> Observations : </label><br/><br/></td>
		              <td class="bord"><textarea readonly name="observation" rows="3" cols="30"><?php print $g_observation;?></textarea></td>
											</tr>-->
					               </table>
								   <?php print "CNI ou Passport N:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_indentifiant;?><br/>
								   <?php print "Nom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_nom;?><br/>
								   <?php print "Duree:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_nuit."jours";?><br/>
								   <?php print "Date d arrivee:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_date_arrivee;?><br/>
								   <?php print "Etat de la reservation:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_etat;?><br/>
								   <?php print "Observations :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_observation;?><br/>
								   <?php print "Reservation faite par :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_auteur;?><br/>
								   <?php print "Reservation Prise par :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['login'];?>
											<p></p>
<TABLE class="pour">
<COLGROUP width="">
<THEAD>																				
<TR class="entetetab">
<TD class="pour">Type de chambre</TD>
<TD class="pour">Prix</TD>
</TR>
 </THEAD>
<TR>
<TD class="pour" style="width:100px; height:50px"><?php print recupere_libelle_type_chambre($_SESSION['id_type_chambre_reserv']);?></TD>
<TD class="pour" style="width:100px; height:50px"><?php print  $_SESSION['montant_type_chambre_reserv'];?></TD>
</TR>
</COLGROUP>
</TABLE>
<img src="../images/pied.PNG"/>	
									 	
</body>
</html>
