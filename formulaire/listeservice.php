<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Fs Hotel</title>
    <link rel="stylesheet" href="../procedure_css/le_style.css" type="text/css" /> 
	<link rel="stylesheet" href="../procedure_css/styleclient.css" type="text/css" /> 
    <link rel="stylesheet" href="../procedure_css/css.css" type="text/css" media="screen" />
  <script>
    function dateWrite(){
      opener.document.getElementById("service").value = window.document.getElementById("service").value;
      self.close();
    }
  </script>

</head>
<?php function rechercher_id_servicepopuu_table($value){
return ResultatRequette("select TITRE_SERVICE as info from service where CODE_SERVICE='$value'");
} 
function rechercher_id_etataservicepopuu_table($valueu){
return ResultatRequette("select LIBELLE as info from etat_service where ID_ETAT_SERVICE='$valueu'");
}
function rechercher_id_service_insertbase_table($valuer){
return ResultatRequette("select CODE_SERVICE as info from service where CODE_SERVICE='$valuer'");
}
function rechercher_libelle_service_insertbase_table($valuer){
return ResultatRequette("select TITRE_SERVICE as info from service where CODE_SERVICE='$valuer'");
}
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
  $g_code=$_REQUEST['modif_code'];
  //$g_valeur_recup=addslashes($_REQUEST['service']);
     if($g_code!=""){
$g_valeur_recup1=rechercher_id_service_insertbase_table($g_code);
$g_valeur_recup=rechercher_libelle_service_insertbase_table($g_valeur_recup1);
}
?>
<body>
<?php                                   /*require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Service</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Type </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Etat </strong>";
	           							print " </th>";
									
										// on recupère la liste 
										$requete="select a.CODE_SERVICE,a.ID_ETAT_SERVICE,b.CODE_TYPE_SERVICE,c.CODE_TYPE_SERVICE from possede_1 a,type_service b,service c where b.CODE_TYPE_SERVICE=c.CODE_TYPE_SERVICE AND a.CODE_SERVICE=c.CODE_SERVICE ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
                                             print " <td><a href='listeservice.php?modif_code=$CODE_SERVICE'>".stripslashes(rechercher_id_servicepopuu_table($CODE_SERVICE))."</a></td>";
										     print " <td><a href='listeservice.php?modif_code=$CODE_SERVICE'>".stripslashes(recup_lib_type_Service_lib_affich($CODE_TYPE_SERVICE))."</td>";
                                             print " <td>".stripslashes(rechercher_id_etataservicepopuu_table($ID_ETAT_SERVICE))."</td>";
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de service: ".$i."<br/><br/>";*/
?>
<?php                                   require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Service</strong>";
	           							print " </th>";
										// on recupère la liste 
										$requete="select * from  service ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
                                             print " <td><a href='listeservice.php?modif_code=$CODE_SERVICE'>".stripslashes(rechercher_id_servicepopuu_table($CODE_SERVICE))."</a></td>";
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de service: ".$i."<br/><br/>";
?>
 <strong> Valider le choix</strong><input readonly id="service" type="text" value="<?php print $g_valeur_recup?>"/>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
