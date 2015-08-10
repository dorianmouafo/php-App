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
      opener.document.getElementById("chambre").value = window.document.getElementById("chambre").value;
      self.close();
    }
  </script>

</head>
<?php   function recup_lib_chmabre_tab($num){
 return ResultatRequette("select LIBELLE_CHAMBRE as info from chambre where CODE_CHAMBRE='$num'");
}
function recup_lib_typemonchmabre_tab($num1){
 return ResultatRequette("select LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE='$num1'");
}
function recup_lib_etat_reserv_tebl($num1){
 return ResultatRequette("select LIBELLE_ETAT_CHAMBRE as info from etat_chambre where CODE_ETAT_CHAMBRE='$num1'");
}

function rechercher_id_chambre_popup_table($value){
return ResultatRequette("select CODE_TYPE_CHAMBRE as info from chambre where CODE_CHAMBRE='$value'");
} 
function rechercher_id_libell_chambre_popup_table($value){
return ResultatRequette("select LIBELLE_TYPE_CHAMBRE as info from type_chambre where CODE_TYPE_CHAMBRE='$value'");
}
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
  $g_code=$_REQUEST['modif_code'];
  //$g_valeur_recup=addslashes($_REQUEST['service']);
     if($g_code!=""){
$g_valeur_recup1=rechercher_id_chambre_popup_table($g_code);
//$g_valeur_recup=rechercher_id_libell_chambre_popup_table($g_valeur_recup1);
$g_valeur_recup=rechercher_id_libell_chambre_popup_table($g_code);
}
?>
<body>
               <?php                                  
                                        require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Type </strong>";
	           							print " </th>";
										
										// on recupère la liste 
										$requete="select * from type_chambre";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                             print " <td><a href='listechambre.php?modif_code=$CODE_TYPE_CHAMBRE'>".stripslashes(recup_lib_typemonchmabre_tab($CODE_TYPE_CHAMBRE))."</td>";	
											 print " </tr>";
										}
										print "</table>";
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s)".$i."<br/><br/>";
?>


                                        <?php                                  
                                  /*      require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Type </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Chambre </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> Etat </strong>";
	           							print " </th>";
									    
										// on recupère la liste 
										$requete="select a.CODE_CHAMBRE,a.CODE_ETAT_CHAMBRE,b.CODE_TYPE_CHAMBRE,c.CODE_CHAMBRE from avoir a,type_chambre b,chambre c where b.CODE_TYPE_CHAMBRE=c.CODE_TYPE_CHAMBRE AND a.CODE_CHAMBRE=c.CODE_CHAMBRE ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                             print " <td><a href='listechambre.php?modif_code=$CODE_CHAMBRE'>".stripslashes(recup_lib_typemonchmabre_tab($CODE_TYPE_CHAMBRE))."</td>";											 
                                             print " <td><a href='listechambre.php?modif_code=$CODE_CHAMBRE'>".stripslashes(recup_lib_chmabre_tab($CODE_CHAMBRE))."</a></td>";
                                             print " <td>".stripslashes(recup_lib_etat_reserv_tebl($CODE_ETAT_CHAMBRE))."</td>";
											 print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s)".$i."<br/><br/>";*/
?>
 <strong> Valider le choix</strong><input readonly id="chambre" type="text" value="<?php print $g_valeur_recup?>"/>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
