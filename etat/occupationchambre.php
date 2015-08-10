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
<p>ETAT DES OCCUPATIONS DES CHAMBRES<p>
<?php function rechercher_libertrechambre_sans_table_mercredi($value){
return ResultatRequette("select  LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$value'");
}
function rechercher_nomclient_sans_table_mercredi($valueserve){
return ResultatRequette("select  NOM_CLIENT as info from personne_physique where ID_PERSONNE='$valueserve'");
}
function rechercher_codechambredert_sans_table_mercredi($vadesre){
return ResultatRequette("select CODE_CHAMBRE  as info from chambre where LIBELLE_CHAMBRE='$vadesre'");
}
function rechercher_datedentrer_pour_valeur_desortiemodfi($date){
return ResultatRequette("select DATE_ENTREE as info from occuper where ID_PERSONNE='$date'");
}?>
									   
									  <?php 
require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
									    print "<table class='etat_table' border:1 width='100%' style='border:1px solid black'>";
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong> Nom  et  Pr&eacute;nom</strong>";
	           							print " </th>";
										
									    print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Chambre </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Date Entr&eacute;e </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' style='border:1px solid black'>";
										print " <strong>Date Sortie </strong>";
	           							print " </th>";
										
									
									    // Numero de page (1 par défaut)
                                        /*if( isset($_GET['page']) && is_numeric($_GET['page']) )
                                            $page = $_GET['page'];
                                        else
                                            $page = 1;
                                            // Nombre d'info par page
                                            $pagination =10;
                                            // Numéro du 1er enregistrement à lire
                                            $limit_start = ($page - 1) * $pagination;*/											
										 // Préparation de la requête		
										// on recupère la liste 
									  // $requete="select a.CODE_CHAMBRE,a.ID_PERSONNE,a.DATE_ENTREE,a.DATE_SORTIE from occuper a LIMIT $limit_start, $pagination ";
									  $requete="select a.CODE_CHAMBRE,a.ID_PERSONNE,a.DATE_ENTREE,a.DATE_SORTIE from occuper a ";
										$result=mysql_query($requete,$link);	
										$i=0;  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 //ID_CLIENT
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire' style='border:1px solid black'>";
											 else print " <tr class='ligne_paire' style='border:1px solid black'>";									 
											print " <td style='border:1px solid black'>".stripslashes(retour_nomprenom_sortietable($ID_PERSONNE))."</a></td>";	
											print " <td style='border:1px solid black'>".stripslashes(rechercher_libertrechambre_sans_table_mercredi($CODE_CHAMBRE))."</td>";
											print " <td style='border:1px solid black'>".stripslashes($DATE_ENTREE)."</td>";
											print " <td style='border:1px solid black'>".stripslashes($DATE_SORTIE)."</td>";
											print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s) : ".$i."<br/>";

/*$nb_total = mysql_query('SELECT COUNT(*) AS nb_total FROM occuper');
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];

// Pagination
$nb_pages = ceil($nb_total / $pagination);

// Affichage
echo '<p class="pagination">' . pagination($page, $nb_pages) . '</p>';*/
																			
									 ?>   
								 	
</body>
<center><img src="../images/footer.JPG"/></center>
</html>
