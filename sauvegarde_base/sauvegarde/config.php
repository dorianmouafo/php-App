<?php


/* Modifiez les paramêtres ci-dessous à votre guise */

/////////////////////////////
// Paramètres de connexion //
////////////////////////////
// N'oubliez pas de renseigner les champs ci-dessous !
$serveur = 'localhost'; // votre serveur sql (exemple pour free : sql.free.fr)
$login = 'root'; // votre login
$bdd = 'gestat'; // la base de donn&eacute;e que vous voulez sauvegarder
$mdp = ''; // le mot de passe de votre base de donn&eacute;e

///////////////////////
// Autres paramètres //
//////////////////////
// Cr&eacute;er la base de donn&eacute;e ? //
$create_bdd = false; // true pour oui, false pour non
// Variable de comptage (ne pas modifier)
$nb = 0;
// Langue du script
$langue = 'french'; // french pour français, english pour anglais ...
// Envoyer la sauvegarde sql à votre email ? //
$send_mail = true; // true pour oui, false pour non
// Votre adresse email
$email = '';
// Si oui, voulez-vous effacer le fichier sql de votre serveur une fois le mail envoy&eacute; ? //
$del_sql = true; // true pour oui, false pour non

///////////////////////////////////////
// fonction timing (ne pas modifier) //
///////////////////////////////////////
function getMicroTime() {
  $mt = microtime();
  list($micro, $time) = explode(' ', $mt);
  return($micro + $time);
}

?>
