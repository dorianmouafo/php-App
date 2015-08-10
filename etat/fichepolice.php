<?php session_start();
print $_SESSION['id_imprime'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <!--
    we like wine
  -->
  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    
	<link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" /> 
</head> 


<body>
<?php 
?>

<p>FICHE DU CLIENT<p>

									   
								 <table>
										  <tr>
											<form  method="post"  name="cadre" action="enregistrementclient.php?modif_code=<?php print $g_code;?>">
													<p align="center">
												
											</tr>
											<tr>
												<td><label> CNI/Passport:</label><br/></td>		
                          <td><input readonly type="text" name="indentifiant" value="<?php print $g_indentifiant;?>"  size="56" class="les_code" /></td>
											
											</tr>
										   <tr>		
										 
														<td><label> Type Identit&eacute;: </label></td>
                          <td><input readonly type="text" name="type_identite" value="<?php print $g_type_identite;?>" size="56" /></td>
											</tr>
										  <tr>
										  <td><label> Date D&eacute;livrance:</label></td>
				                             <td>  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly type="text" name="date_delivrance"  value="<?php print $g_date_delivrance; ?>" >
	                                          <label> 
                           	Lieu <input type="text" name="lieu_delivrance" value="<?php print $g_lieu_delivrance?>"  size="20" /></label></td>
											</tr>
										  <tr>
														<td><label> Nom: </label></td>
                          <td><input readonly type="text" name="nom" value="<?php print $g_nom;?>"  size="56" /></td>
											</tr>
										  <tr>
														<td><label> Pr&eacute;nom: </label></td>
											<td><input readonly type="text" name="prenom" value="<?php print $g_prenom;?>"  size="56" /></td>
											</tr>
											<tr>
											         <td><label> Date de Naissance:</label></td>
			  <td>  <div align="right"><font class="T2"> </font>     </div>
                                     <input readonly  type="text" name="date_nais"  value="<?php print $g_date_nais; ?>" >
	                                           <label> 
			<label>    ville <input type="text" name="ville_nais" value="<?php print $g_ville_nais;?>"  size="20" />   </label></td>
											</tr>
											<tr>
														<td><label> Pays de naissance: </label></td>
                                      <td><input readonly type="text" name="pays_nais" value="<?php print $g_pays_nais;?>"  size="56" /></td>
											</tr>
											<tr>
														<td><label> Nationalit&eacute;: </label></td>
                                      <td><input readonly type="text" name="nationalite" value="<?php print $g_nationalite;?>"  size="56" /></td>
											</tr>
											<tr>
														<td><label> Pays de R&eacute;sidence:</label></td>
														  <td><input type="text" name="pays_residence" value="<?php print $g_pays_residence;?>"  size="22" /><label> &nbsp;   ville :<input type="text" name="ville_residence" value="<?php print $g_ville_residence;?>"  size="24" /></label></td>
											</tr>
											 <tr>
														         <td><label> Prof&eacute;ssion: </label></td>
                                         <td><input readonly  type="text" name="profession" value="<?php print $g_profession;?>"  size="56" /></td>
											</tr>
										  <tr>
														         <td><label> Adresse priv&eacute;e: </label></td>
                                         <td><input readonly type="text" name="adresse_pivee" value="<?php print $g_adresse_pivee;?>"  size="56" /></td>
											</tr>
										  <tr>
														         <td><label> Contactes</label></td>
                                         <td>T&eacute;l&eacute;phone: <input type="text" name="telephone_client" value="<?php print $g_telephone_client;?>"  size="15" /><label>Email:<input type="text" name="email_client" value="<?php print $g_email_client;?>"  size="21" /></label></td>
											</tr>
										   <tr>
														         <td><label> soci&eacute;t&eacute; de Travail: </label></td>
                                         <td><input readonly type="text" name="societe" value="<?php print $g_societe;?>"  size="56" /></td>
									     </tr>								  
										  <tr>
														         <td><label> Adr&eacute;sse soci&eacute;te: </label></td>
                                         <td><input readonly type="text" name="adresse_travail" value="<?php print $g_adresse_travail;?>"  size="56" /></td>
											</tr>											
											<tr>
														         <td><label> T&eacute;l&eacute;phone soci&eacute;te: </label></td>
                                         <td><input readonly type="text" name="telephone_travail" value="<?php print $g_telephone_travail;?>"  size="56" /></td>
											</tr>										  
										  <tr>
														         <td><label>Contacts</label></td>
                                         <td> Fax: <input readonly type="text" name="fax_travail" value="<?php print $g_fax_travail;?>"  size="21" /><label>Email : <input type="text" name="email_travail" value="<?php print $g_email_travail;?>"  size="20" /></label></td>
											</tr>
										
										  <tr>	         <td><label> Venant De: </label></td>
                                         <td><input readonly type="text" name="venant_de" value="<?php print $g_venant_de;?>"  size="56" /></td>
											</tr>
										  <tr>
														         <td><label> Se Rendant a: </label></td>
                                         <td><input readonly type="text" name="se_rendant" value="<?php print $g_se_rendant;?>"  size="56" /></td>
											</tr>
											<tr>
											<td><label> Sex: <br/></label></td>
					                           <td>
                                          <select name="sex">
                                    <option value="11">Masculin</option>
                                      <option value="21">Feminin</option>                              
                                               </select></td> 
											</tr>
											</table>  
											<input type="button" value="Imprimer la Fiche" onClick="window.print()">
									 	
</body>
</html>
