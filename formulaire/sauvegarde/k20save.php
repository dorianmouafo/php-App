<?php


// Include du fichier de configuration et du fichier de langue choisis //
include ('config.php');
include ('lang/'.$langue.'.php');

// D&eacute;part chrono
$temps_depart = getMicroTime();

// Base de donn&eacute;e informations
$info_bdd = "--\n-- ".$lang['db']." : `$bdd`\n--\n\n";
	if ($create_bdd == true)
{
$save = "--\n-- ".$lang['create_db']."\n--\nCREATE DATABASE `$bdd`;\n\n".$info_bdd;
}
	else
{
$save = $info_bdd;
}

// Connexion à la base de donn&eacute;e et s&eacute;lection de la base de donn&eacute;e
$connexion = mysql_connect($serveur,$login,$mdp) or die($lang['error_connexion']."<br />".mysql_error());

// S&eacute;lection de la bdd
mysql_select_db($bdd, $connexion) or die($lang['error_select']."<br />".mysql_error());

// Selection de TOUTES les tables //
$alltable = mysql_list_tables($bdd,$connexion);

/////////////////////////////////////////////////////////////////
// On effectue l'op&eacute;ration de sauvegarde sur toutes les tables //
////////////////////////////////////////////////////////////////
$num = mysql_num_rows($alltable);
	
	if (empty($num)) // V&eacute;rification  la pr&eacute;sence d'au moins 1 table !
{
echo $lang['any_table'];
exit(); // On arrête le script
}

for ($i = 0; $i < $num; $i++) 
{
$table = mysql_tablename($alltable, $i);

// Supprimer la table si existante
$qry_drop = 'DROP TABLE IF EXISTS `'.$table.'`;';
// Importation de la structure de la table
$qry_import_structure = 'SHOW CREATE TABLE `'.$table.'`';
$result = mysql_query($qry_import_structure,$connexion) or die (mysql_error($connexion));
$qry_create = mysql_fetch_row($result);

// Importation des lignes de la table et construction de l'INSERT
$qry_import_lignes = 'SELECT * FROM `'.$table.'`';
$lignes = mysql_query($qry_import_lignes, $connexion) or die (mysql_error($connexion));

// Nombres de champs
$nbchamps = mysql_num_fields($lignes);

// Ecriture de la table
$save .= "\n--\n-- ".$lang['structure']." `$table`\n--\n\n";
$save .= $qry_drop."\n";
$save .= $qry_create[1].";\n\n";
$save .= "--\n-- ".$lang['contents']." `$table`\n--\n\n";
	
// V&eacute;rification de la pr&eacute;sence d'au moins 1 enregistrement dans la table ! //
$nb_save = mysql_num_rows($lignes);
if (!empty($nb_save))
	{
	$save .= "INSERT INTO `$table`";
	// Inscription des champs
	$save .= ' (';
	for($j = 0; $j < $nbchamps; $j++)
			{
			$save .= '`'.mysql_field_name($lignes, $j).'`';
			// Continue ou termine la chaîne
			if($j == ($nbchamps - 1))	$save .= ') ';
			else			$save .= ', ';
			}
	// G&eacute;n&eacute;ration des enregistrements
	$save .= 'VALUES ';
	while ($row = mysql_fetch_row($lignes))
        {
        if(isset($boucle_start)) { $save .= ",\n"; } else { $boucle_start = ''; }
        $values = '(\''.implode("','", array_map('mysql_real_escape_string', $row)).'\')';
        $save .= $values;
        $nb++;
        }
$save .= ";\n";
unset($boucle_start);
	}

// Si 0 enregistrement on l'affiche !	
else {
	 echo  $lang['any_data']." $table ...<br />"; // On l'affiche ...
	 $save .= "--\n-- ".$lang['any_data']." `$table`\n--\n"; // On l'&eacute;crit dans le fichier
	 }
}

// On ferme la connexion
mysql_close($connexion);

////////////////////////////////////////////////////////////
// Fin de l'op&eacute;ration de sauvegarde sur toutes les tables //
///////////////////////////////////////////////////////////
// Date actuelle et temps
$date = date("d-m-Y",time());
$temps = round(getMicroTime() - $temps_depart,4);

// Nom du fichier g&eacute;n&eacute;r&eacute; dynamiquement en fonction de la date
$fichier = 'sauvegarde-'.$bdd.'-'.$date.'.sql';

// Informations finales
$save .= "\n--\n-- ".$lang['info']." \"$fichier\", $num table(s), $nb ".$lang['info2']." $temps s, date : $date\n--";

/////////////////////////////////////////////////////////////////
// Enregistrement de la base de donn&eacute;e dans un fichier texte ! //
/////////////////////////////////////////////////////////////////

	// Cr&eacute;ation du fichier
    if (!$file = fopen("sauvegardes/".$fichier, 'w+')) 
	{
    echo $lang['open_no'].$fichier;
    exit;
    }

    // Ecriture dans le fichier
    if (fwrite($file, $save) === FALSE) 
	{
    echo $lang['write_no'].$fichier;
    exit;
    }
    
    echo $lang['write_success'];
	
	// On ferme le fichier
	fclose($file);              

// Envoie d'un mail avec le fichier si demand&eacute;
if ($send_mail == true)
{
// Construction de l'attachement
$header .= "Content-Type: text/sql; name=\"$fichier\"\n";
$header .= "Content-Transfer-Encoding: charset=iso-8859-1\n";
$header .= "Content-Disposition: attachment; filename=\"$fichier\"\n\n"; 
// Ouverture et lecture du fichier à attacher
$file = fopen("sauvegardes/".$fichier, "r" );
$contenu = fread( $file, filesize("sauvegardes/".$fichier));
fclose($file); // Fermeture du fichier
$header .= $contenu; // Introduction du fichier dans le mail

//mail($email,"Votre fichier de sauvegarde MySQL du $date","Votre fichier de sauvegarde !",$header); // Envoie du mail
//echo $lang['email']; // Message de succès
}

// On efface le fichier si demand&eacute;
if ($del_sql == true and $send_email == true)
{
	if (unlink("sauvegardes/".$fichier) === FALSE)
	{
	echo $lang['no_del'].$fichier;
	}
	else
	{
	echo $lang['del'];
	}
}
?>