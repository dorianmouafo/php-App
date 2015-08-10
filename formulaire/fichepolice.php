<?php session_start();

  //print $_SESSION['id_imprime'];
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
if(isset($_SESSION['id_imprime']) AND $_SESSION['id_imprime']!="" ){
            //print "je suis la";
            $g_type_identite=recup_type($g_code);
			//print "".$g_code;
			$g_type_identite=recup_typeidentifiant_fiche_deliv($_SESSION['id_imprime']);
			$g_indentifiant=recup_identifiant_fiche_deliv($_SESSION['id_imprime']);
			$g_date_delivrance=recup_date_deliv($_SESSION['id_imprime']);
			$g_lieu_delivrance=recup_lieu($_SESSION['id_imprime']);
			$g_nom=recup_nome($_SESSION['id_imprime']);
			$g_prenom=recup_prenom($_SESSION['id_imprime']);
			$g_date_nais=recup_dat_naiss($_SESSION['id_imprime']);
			$g_ville_nais=recup_ville_naiss($_SESSION['id_imprime']);
			$g_pays_nais=recup_pays_naiss($_SESSION['id_imprime']);
			$g_nationalite=recup_nationalite($_SESSION['id_imprime']);
			$g_pays_residence=recup_pays_resid($_SESSION['id_imprime']);
			$g_ville_residence=recup_ville_resid($_SESSION['id_imprime']);
		    $g_profession=recup_prefession_cli($_SESSION['id_imprime']);
			$g_adresse_pivee=recup_adres_cli($_SESSION['id_imprime']);
			$g_telephone_client=recup_tel_cli($_SESSION['id_imprime']);
			$g_email_client=recup_email_cli($_SESSION['id_imprime']);
			$g_societe=recup_societ_cli($_SESSION['id_imprime']);
			$g_adresse_travail=recup_addr_societ($_SESSION['id_imprime']);
			$g_telephone_travail=recup_tel_societ($_SESSION['id_imprime']);
			$g_fax_travail=recup_fax_societ($_SESSION['id_imprime']);
			$g_email_travail=recup_email_societ($_SESSION['id_imprime']);
			$g_venant_de=recup_depart($_SESSION['id_imprime']);
			$g_se_rendant=recup_allant($_SESSION['id_imprime']);
			$g_nb_personne=recup_nb($g_code);
			$nbb=$_SESSION['nombre_retour'];
}
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
 
       </style>
	     <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
	<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
</head> 
<body>

<?php //print   $_SESSION['valeur_tarification'];
?>

<center><img src="../images/entete.PNG"/> <p>FICHE DU CLIENT<p></center>
							
										 <!--  <tr>
											<form  method="post"  name="cadre" action="fichepolice.php?modif_code=<?php print $_SESSION['id_imprime'];?>">
													<p align="center">
											</tr>-->
										<!-- 	<tr>
												<td><label> CNI/Passport:</label><br/></td>		
                          <td><input readonly type="text" name="indentifiant" value="<?php print $g_indentifiant;?>"  size="56" class="les_code" /></td>
											
											</tr>-->
										   <!--  <tr>		
										 
														<td><label> Type Identit&eacute;: </label></td>
                          <td><input readonly type="text" name="type_identite" value="<?php print $g_type_identite;?>" size="56" /></td>
											</tr>-->
										 <!--   <tr>
										  <td><label> Date D&eacute;livrance:</label></td>
				                             <td>  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly type="text" name="date_delivrance"  value="<?php print $g_date_delivrance; ?>" >
	                                          <label> 
                           	Lieu <input readonly type="text" name="lieu_delivrance" value="<?php print $g_lieu_delivrance?>"  size="26" /></label></td>
											</tr>>-->
										 <!--   <tr>
														<td><label> Nom: </label></td>
                         <td><input readonly type="text" name="nom" value="<?php print $g_nom;?>"  size="56" /></td>
											</tr>-->
										 <!-- <tr>
														<td><label> Pr&eacute;nom: </label></td>
											<td><input readonly type="text" name="prenom" value="<?php print $g_prenom;?>"  size="56" /></td>
											</tr>-->
											<!--<tr>
											         <td><label> Date de Naissance:</label></td>
			  <td>  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly  type="text" name="date_nais"  value="<?php print $g_date_nais; ?>" >
	                                           <label> 
			<label>    ville <input readonly type="text" name="ville_nais" value="<?php print $g_ville_nais;?>"  size="26" />   </label></td>
											</tr>-->
											<!--<tr>
														<td><label> Pays de naissance: </label></td>
                                      <td><input readonly type="text" name="pays_nais" value="<?php print $g_pays_nais;?>"  size="56" /></td>
											</tr>-->
											 <!--<tr>
														<td><label> Nationalit&eacute;: </label></td>
                                      <td><input readonly type="text" name="nationalite" value="<?php print $g_nationalite;?>"  size="56" /></td>
											</tr>-->
											 <!--<tr>
														<td><label> Pays de R&eacute;sidence:</label></td>
														  <td><input readonly type="text" name="pays_residence" value="<?php print $g_pays_residence;?>"  size="22" /><label> &nbsp;&nbsp;ville :<input readonly type="text" name="ville_residence" value="<?php print $g_ville_residence;?>"  size="22" /></label></td>
											</tr>-->
											 <!--<tr>
														         <td><label> Prof&eacute;ssion: </label></td>
                                         <td><input readonly  type="text" name="profession" value="<?php print $g_profession;?>"  size="56" /></td>
											</tr>-->
										  <!-- <tr>
														         <td><label> Adresse priv&eacute;e: </label></td>
                                         <td><input readonly type="text" name="adresse_pivee" value="<?php print $g_adresse_pivee;?>"  size="56" /></td>
											</tr>-->
										   <!--  <tr>
														         <td><label> Contactes</label></td>
                                         <td>T&eacute;l&eacute;phone: <input readonly type="text" name="telephone_client" value="<?php print $g_telephone_client;?>"  size="15" /><label>Email:<input readonly type="text" name="email_client" value="<?php print $g_email_client;?>"  size="19" /></label></td>
											</tr>-->
										   <!-- <tr>
														         <td><label> soci&eacute;t&eacute; de Travail: </label></td>
                                         <td><input readonly type="text" name="societe" value="<?php print $g_societe;?>"  size="56" /></td>
									     </tr>-->									  
										  <!--<tr>
														         <td><label> Adr&eacute;sse soci&eacute;te: </label></td>
                                         <td><input readonly type="text" name="adresse_travail" value="<?php print $g_adresse_travail;?>"  size="56" /></td>
											</tr>	-->										
											 <!--<tr>
														         <td><label> T&eacute;l&eacute;phone soci&eacute;te: </label></td>
                                         <td><input readonly type="text" name="telephone_travail" value="<?php print $g_telephone_travail;?>"  size="56" /></td>
											</tr>-->										  
										   <!--<tr>
							                 <td><label>Contacts</label></td>
                                         <td> Fax: <input readonly type="text" name="fax_travail" value="<?php print $g_fax_travail;?>"  size="21" /><label>Email : <input readonly type="text" name="email_travail" value="<?php print $g_email_travail;?>"  size="18" /></label></td>
											</tr>-->
										
										 <!-- <tr>	         <td><label> Venant De: </label></td>
                                         <td><input readonly type="text" name="venant_de" value="<?php print $g_venant_de;?>"  size="56" /></td>
											</tr>-->
										 <!-- <tr>
														         <td><label> Se Rendant a: </label></td>
                                         <td><input readonly type="text" name="se_rendant" value="<?php print $g_se_rendant;?>"  size="56" /></td>
											</tr>--><p></p>
										    <?php   print " Numero d identite:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_indentifiant; ?><br/> 
										    <?php   print " Type identite:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_type_identite; ?><br/> 
										    <?php   print " Date de delivrance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_date_delivrance; ?><br/> 
										    <?php   print " Nom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_nom; ?><br/> 
										    <?php   print " Prenom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_prenom; ?><br/>  
										    <?php   print " Date de Naissance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_date_nais; ?><br/>  
										    <?php   print " Pays de Naissance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_pays_nais;?><br/> 
											<?php   print " Ville de Naissance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_ville_nais;?><br/> 
										    <?php   print " Nationalite:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_nationalite;?><br/> 
										    <?php   print " Pays de residence:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_pays_residence;?><br/> 
											<?php   print " Ville de residence:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_ville_residence;?><br/> 
										    <?php   print " Profession:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_profession;?><br/> 
										    <?php   print " Adresse  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_adresse_pivee; ?><br/> 
										    <?php   print " Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_email_client; ?><br/> 
										    <?php   print " Telephone :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_telephone_client; ?><br/> 
										    <?php   print " Societe de travail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_societe; ?><br/> 
										    <?php   print " Adresse Societe de travail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_adresse_travail; ?><br/> 
										    <?php   print " Telephone societe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_telephone_travail; ?><br/> 
										    <?php   print " Email Travail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_email_travail; ?><br/>
										    <?php   print " Fax travail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_fax_travail; ?><br/>
										    <?php   print " Venant de :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_venant_de; ?><br/>
                                            <?php   print " se rendanr a :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$g_se_rendant; ?>	<br/>
                                            <?php   print " Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$nbb; ?>												
										
<TABLE class="pour">
<COLGROUP width="">
<THEAD>	
																			
<TR class="entetetab" style="width:80px; height:30px" >
<TD class="pour">Chambre N&deg;</TD>
<TD class="pour">Date arriv&eacute;e</TD>
<TD class="pour">Date d&eacute;part</TD>
<TD class="pour">Total nuit&eacute;</TD>
<TD class="pour">Arrang</TD>
<TD class="pour">Prix de la chambre</TD>
<TD class="pour">Receptionniste</TD>
</TR>
 </THEAD>
<TR>
<TD class="pour" style="width:80px; height:50px"><?php print retour_libelle_chambre_fiche($_SESSION['code_chabre']);?></TD>
<TD class="pour" style="width:80px; height:50px"><?php print $_SESSION['date_arrivee'];?></TD>
<TD class="pour" style="width:80px; height:50px"><?php print $_SESSION['date_sortie'];?></TD>
<TD class="pour" style="width:80px; height:50px"><?php print $_SESSION['annuite']."nuits";?></TD>
<TD class="pour" style="width:80px; height:50px"><?php print $g_arrang;?></TD>
<TD class="pour" style="width:80px; height:50px"><?php print $_SESSION['valeur_tarification'];?></TD>
<TD class="pour" style="width:80px; height:50px"><?php print $_SESSION['login'];?></TD>
</TR>
</COLGROUP>
</TABLE>							 	
</body>
<!--<script>window.print();</script>-->
</html></br></br></br>

