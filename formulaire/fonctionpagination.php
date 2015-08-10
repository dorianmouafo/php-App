<?php
    require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
/*************************************/ 
/*LA CEST MQ FONTION QUI ME PERMETTRA DE FAIRE LA PAGINATION SUR TOUTES MES PAGES DANS MON APPLICATION*/
/*MADE BY MOI MEME APRES PLUSIEURS NUITS DE DUR LABEURS MAIS CEST POUR TOUJOUR*/
/************************************/

 function pagination($current_page, $nb_pages, $link='?page=%d', $around=3,$firstlast=1)
{
  $pagination = '';
  if ( !ereg('%d', $link) ) $link .= '%d';
  if ( $nb_pages > 1 ) {

    // Lien précédent
    if ( $current_page > 1 )
      $pagination .= '<a class="prevnext" href="'.sprintf($link, $current_page-1
).'" title="Page précédente">&laquo; Pr&eacute;c&eacute;dent</a>';
    else
      $pagination .= '<span class="prevnext disabled">&laquo; Pr&eacute;c&eacute;dent</span>';

    // Lien(s) début
    for ( $i=1 ; $i<=$firstlast ; $i++ ) {
      $pagination .= ' ';
      $pagination .= ($current_page==$i) ? '<span class="current">'.$i.'</span>'
 : '<a href="'.sprintf($link, $i).'">'.$i.'</a>';
    }
    // ... après pages début ?
    if ( ($current_page-$around) > $firstlast+1 )
      $pagination .= ' &hellip;';
    // On boucle autour de la page courante
    $start = ($current_page-$around)>$firstlast ? $current_page-$around :$firstlast+1;
    $end = ($current_page+$around)<=($nb_pages-$firstlast) ? $current_page+
$around : $nb_pages-$firstlast;
    for ( $i=$start ; $i<=$end ; $i++ ) {
      $pagination .= ' ';
      if ( $i==$current_page )
        $pagination .= '<span class="current">'.$i.'</span>';
      else
        $pagination .= '<a href="'.sprintf($link, $i).'">'.$i.'</a>';
    }

    // ... avant page nb_pages ?
    if ( ($current_page+$around) < $nb_pages-$firstlast )
      $pagination .= ' &hellip;';

    // Lien(s) fin
    $start = $nb_pages-$firstlast+1;
    if( $start <= $firstlast ) $start = $firstlast+1;
    for ( $i=$start ; $i<=$nb_pages ; $i++ ) {
      $pagination .= ' ';
      $pagination .= ($current_page==$i) ? '<span class="current">'.$i.'</span>'
 : '<a href="'.sprintf($link, $i).'">'.$i.'</a>';
    }

    // Lien suivant
    if ( $current_page < $nb_pages )
      $pagination .= ' <a class="prevnext" href="'.sprintf($link, ($current_page+1)).'" title="Page suivante">Suivant &raquo;</a>';
    else
      $pagination .= ' <span class="prevnext disabled">Suivant &raquo;</span>';
  }
  return $pagination;
} 
?>