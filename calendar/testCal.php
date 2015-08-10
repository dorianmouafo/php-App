

<?php
if($_SESSION['log']!=1)
	/* On teste si le user a été identifié. Sinon on rentre à la page login */
        header('Location: ../index.php');

ini_set("register_globals","off");
ini_set("display_errors","off");
ini_set("expose_php","off");


require_once('../calendar/tc_calendar.php');
header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TriConsole : PHP Calendar Date Picker</title>
<script language="javascript" src="../calendar/calendar.js"></script>
<link href="../calendar/calendar.css" rel="stylesheet" type="text/css">

<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
        <style type="text/css">
#formulaire{
	margin:auto;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	margin-top:20px;
        margin-bottom:60px;
        font-size:11px;

    }
table a{
	text-decoration:none;
	color:black;
	font-family:tahoma,"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-weight:bold;
        font-size:11px;

    }



h1 {
	text-align:center;
	color: #eedfff;
   }

fieldset {
        width:62%;
	margin:auto;
        
   }

#page {
       text-align:center;
       width:50%;
       font-size:14px;
       
   }

#page a {
       color:green;
       font-size:14px;

   }
  



</style>

</head>

<body>
<?php
        include_once '../form/menu_enregistrer.php';
        include_once '../business/m_Categorie.class.php';
        include_once '../business/m_Titre.class.php';

?>
<div id="formulaire">

    <fieldset>
    <legend>Ajout texte</legend>

<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="../controller/c_new_texte.php">
<table border="0" cellspacing="5" cellpadding="2">

                <tr>
                    <td colspan="2"><label>Fichier:</label></td>

                    <td></td>
                </tr>
               <tr>
                   <td colspan="2"><input name="fichier" type="file" size="90"/></td>
                   <td></td>
               </tr>
               <!--
               <tr>
                     <td><label>Num&eacute;ro:</label><input type="text" id="s" size="15" value=""  name="numero" /></td>

                    <td></td>
                </tr>  -->
               <tr>
                    <td><label>Cat&eacute;gorie:</label>
                        <select name="categorie" >
                            <?php 
                                $k=0;
                                $metier1= new m_Categorie();
                                $list= $metier1->donnerListe();
                                echo "<option value=\"0\"></option>";
                                while($k<count($list)){
                                    $code=$list[$k]->getIdentifiant();
                                    $lib=$list[$k]->getLibelleCategorie();
                                    echo"<option value=".$code.">".$lib."</option>";
                                    $k++;
			         }
                            
                            ?>

                        </select>
                    </td>
                    <td><label>Titre:</label>
                        <select name="titre" >
                             <?php
                                $i=0;
                                $metier2= new m_Titre();
                                $list= $metier2->donnerListe();
                                echo "<option value=\"0\"></option>";
                                while($i<count($list)){
                                    $code=$list[$i]->getIdentifiant();
                                    $lib=$list[$i]->getLibelleTitre();
                                    echo"<option value=".$code.">".$lib."</option>";
                                    $i++;
			         }

                            ?>
                        </select>
                    </td>

                </tr>
                
                <tr>
                     <td></td>
                   
                    <td></td>
                </tr>

                <tr>
                    <td><label>Objet:</label></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="objet" cols="100" rows="3" >

                        </textarea>

                    </td>
                    <td></td>
                </tr>
                <tr>
                     <td></td>

                    <td></td>
                </tr>

                <tr>
                    <td>Date de signature:</td>
                    <td><?php
                        $myCalendar = new tc_calendar("date5", true, false);
                        $myCalendar->setIcon("../calendar/images/iconCalendar.gif");
                        $myCalendar->setPath("../calendar/");
                        $myCalendar->setYearInterval(2000, 2015);
                        $myCalendar->dateAllow('1991-05-13', '2016-03-01');
                        $myCalendar->setDateFormat('j F Y');
                        $myCalendar->writeScript();
                    ?></td>
                </tr>
               

                <tr>
                    <td colspan="2"><label>Mots cl&eacute;s(separ&eacute;s par les virgules <u>Exemple:</u> mot1,mot2,mot3,...,motn)</label></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <textarea name="mot_clef" cols="100" rows="3" >

                        </textarea>

                    </td>
                    <td></td>
                </tr>
                
                
</table>
<p>

    <input style="text-align:right;" type="submit" name="Submit" value="Ajouter" />
    <input style="text-align:right;" type="reset" name="reset" value="Annuler" />
</p>
</form>
</fieldset>
<?php
            include_once '../business/m_Texte.class.php';
            $metier4= new m_Texte();
            $list=$metier4->donnerListe();
            $nombreDeTexteParPage=4;
            $nombreDeTexte=$metier4->donnerNombreDeTexte();
            $nombreDePages= ceil($nombreDeTexte/$nombreDeTexteParPage);
            echo "<div id=\"page\">Page :";
            for ($i = 1 ; $i <= $nombreDePages ; $i++)
            {
                 echo '<a href="../form/f_liste_texte.php?numpage=' . $i . '">' . $i . '</a> ';
            }
            echo '</div>';
            echo "<table style=\"color:black; width:100%; margin-top:10px; \" align='center'>";
            echo"<tr bgcolor=green style=\"text-align:center; font-weight:bold\"><td>Num&eacute;ro</td><td>Emplacement</td><td colspan=\"3\">Action</td></tr>";
            for($i=0; $i<count($list);$i++){
                $iden=$list[$i]->getIdentifiant();
                $chm=$list[$i]->getChemin();
                $num=$list[$i]->getNumero();
                $couleur = ($i % 2 == 0) ? "#CCCCCC" : "#FFFFFF";
                echo "<tr bgcolor=".$couleur."><td>".$num."</td><td>".$chm."</td>
                <td style=\"text-align:center;\"><a href='".$chm."'>Afficher</a></td>
                <td style=\"text-align:center;\">
                     <a href=\"../form/f_modifier_texte.php?modifier=$iden \"onclick=\"return confirm('Vous êtes sur le point de modifier: CONTINUER ?');\" title=\"modifier un lien\">Modifier</a>
                </td>

                <td style=\"text-align:center; color:red\">
                    <a href=\"../controller/c_new_texte.php?supprimer=$iden \"onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ?');\" title=\"Supprimer un lien\">Supprimer</a>
                </td>

                </tr>";

            }
            echo"</table>";
            
?>
    
</div>
</body>
</html>
