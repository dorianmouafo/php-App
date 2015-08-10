<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
print" <script>
    function openPopup(){
      window.open('arrivee_depart_popup.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000');
    }
  </script>";
$retour_date_reserve=date('d/m/Y');
?>

<script type="text/javascript">
        //<!--
                function change_onglet(name)
                {
                        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }
        //-->
        </script>
<?php
 	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$retour=date('d/m/Y');
	$g_nom=addslashes($_REQUEST['nom']);
	$g_typeuser=addslashes($_REQUEST['typeuser']);
	$g_fonction=addslashes($_REQUEST['fonction']);
	$g_login=addslashes($_REQUEST['login']);
	$g_pass=addslashes($_REQUEST['pass']);
	$g_groupe=addslashes($_REQUEST['groupe']);
 if($_POST['btn']=="Ajouter"){$v_global=Ajout;
 $g_groupeid=recupere_id_groupe($g_groupe);
 ajout_utilisateur($g_nom,$g_fonction,$g_typeuser,$retour);
 $id=mysql_insert_id();
    $sp=md5($g_login);
	$se=md5($g_pass);
 ajout_utilisateurs($id,$g_nom,$sp,$se);
 //ajout_utilisateurs($id,$g_nom,$g_login,$g_pass);
 ajout_appartenir_groupe( $id,$g_groupeid);
 $g_nom="";
 $g_typeuser="";
 $g_fonction="";
 $g_login="";
 $g_pass="";
 $g_groupe="";
 //print $id;
 print"<script language='javascript'> alert('Utilisateur cree');</script>";
 
 
 }
?>		


                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">CREATION D'UTILISATEUR<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									  
									              ?> 
										  <div class="art-postmetadataheader">
<?php
?>	   
                                          </div>
                                          <div class="art-postcontent">
                                          </div>
                                          <div class="cleared"></div>
                                          <div class="art-postmetadatafooter">
                                             
                                          </div>
                          </div>
                          
                          		<div class="cleared"></div>
                              </div>
                          </div>
                          <div class="art-post">
                              <div class="art-post-tl"></div>
                              <div class="art-post-tr"></div>
                              <div class="art-post-bl"></div>
                              <div class="art-post-br"></div>
                              <div class="art-post-tc"></div>
                              <div class="art-post-bc"></div>
                              <div class="art-post-cl"></div>
                              <div class="art-post-cr"></div>
                              <div class="art-post-cc"></div>
                              <div class="art-post-body">
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader"><a href="#" title="Permanent Link to this Post"></a></h2>
                                          <div class="art-postmetadataheader">
										 <!-- formulaire -->
											<form method="post" name="cadre" action="creer_utilisateur.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="60%">
												<tr>
														<td><label> Nom: </label></td>
	                                                    <td><input type="text" name="nom" value="<?php print $g_nom;?>"  size="38" /></td>
											    </tr>
												<tr>
														<td><label>Type: </label></td>
	                                                    <td><input type="text" name="typeuser" value="<?php print $g_typeuser;?>"  size="38" /></td>
											    </tr>
												<tr>
														<td><label>Fonction: </label></td>
	                                                    <td><input type="text" name="fonction" value="<?php print $g_fonction;?>"  size="38" /></td>
											    </tr>
												<tr>
														<td><label>Logion: </label></td>
	                                                    <td><input type="text" name="login" value="<?php print $g_login;?>"  size="38" /></td>
											    </tr>
												<tr>
														<td><label>Mot de passe: </label></td>
	                                                    <td><input type="password" name="pass" value="<?php print $g_pass;?>"  size="38" /></td>
											    </tr>
												 <tr>
														<td><label> Groupe: </label></td>
                                                        <td> <select name="groupe"><option value=""></option>
									  <?php print $g_groupe?>
									  <?php print ChargeCombo("select LIBELLE_GROUPE as info from groupe",$g_groupe);?>
									  </select></td>
										 	     </tr>
											    </table> 
			   <input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
											</form> 
												 
                                              <div class="art-postheadericons art-metadata-icons">
                                                </div>
                                          </div>
                                          <div class="art-postcontent">
                                          </div>
                          </div>
<?php 
include('decoupagebon/coupe2.php');
?>              
                          		