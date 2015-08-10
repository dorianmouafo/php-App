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
<?php   
?>
<html>
<?php 
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
  $g_code=$_REQUEST['modif_code'];
  //$g_valeur_recup=addslashes($_REQUEST['service']);
     if($g_code!=""){
            $g_valeur_recup=recupere_table_chambre_libelle($g_code);
}
?>
<body>
                                        <?php                                  
                                        require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Chambre</strong>";
	           							print " </th>";
										
										// on recupère la liste 
										$requete="select * from chambre ";
										$result=mysql_query($requete, $link);
																				
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";
                                             print " <td><a href='listechambreetat.php?modif_code=$CODE_CHAMBRE'>".stripslashes($LIBELLE_CHAMBRE)."</td>";											 
                                             print " </tr>";
										}
										print "</table>";
										
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre d'Enregistrement(s)".$i."<br/><br/>";
?>
 <strong> Valider le choix</strong><input readonly id="chambre" type="text" value="<?php print $g_valeur_recup?>"/>
  <input type="button" value="Valider" onClick="dateWrite()" style="width:80px; height:30px"/>
</body>
</html>
