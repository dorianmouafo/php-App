<?php session_start();
  //print $_SESSION['id_imprime'];
require_once('../procedure_php/procedure_globale.php');
require_once('../procedure_php/mysql_requette.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 

  <title>  </title> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <link rel="stylesheet" href="../procedure_css/imp_style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="../procedure_css/impression.css" type="text/css" media="print" /> 
</head> 
<form>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn1"  value=" Imprimer  " onclick="window.print();"/>
<input type="submit" style="width:80px; height:30px"  name="btn"  class="btn2" value="   Fermer" onclick="window.close();"/>
</form>
<!--<script>window.print();</script>-->
 <style type="text/css">
 .pour
{
   border: 1px solid black; 
   border-collapse: collapse;
}
.entetetab
{
background-color:;
}
 
 
</style>
<?php 
  require_once('../procedure_php/procedure_globale.php');
  require_once('../procedure_php/mysql_requette.php');
  $link=Connexion();
?>

<body>

<?php 
  require_once('../procedure_php/procedure_globale.php');
  require_once('../procedure_php/mysql_requette.php');
  $link=Connexion();
  $etat_zero='0';
  $etat_un='1';
  
  
  $debut_total_hebergement=0;
  $debut_total_pour_service=0;
  $debut_total_du_jour=0;
  $deb_total_report_veil=0;
  $debut_total_general=0;
  $debut_total_encaisse=0;
  $debut_total_arepporter=0;
  $debut_total_montant_service=0;
  //je verifie si il ya des services avant de faire la main courante
  $val=recupere_main_courante_serv();
        $dateday=$_SESSION['date_main_courante']; 
		
		
    // $dateday='2011-11-01';
	// $gt='11-11-01';
	 
       $hier = date('Y-m-d', strtotime("".$dateday." -1 day"));
          print "<h3 style='text-align:right;'>  Main courante du&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['date_main_courante']. "</h3>";
   //print $val;

   $requete="select * from type_service order by LIBELLE_SERVICE asc";
   $result=mysql_query($requete, $link);
   /* dEBUT DE TABLEAU*/
  print"<table border='1' width='1000%'>";
  
  /* PREMIERES ENTETES DU TABLEAU*/
  print "<th align='center' colspan='4' > HEBERGEMENT</th>";
		while($letcure=mysql_fetch_array($result))
		{  //extract($letcure);
        $libelle=$letcure[LIBELLE_SERVICE];
        $code=$letcure[CODE_TYPE_SERVICE];
		$nbr_service=recupere_main_courante_serv1($code);
		print "<th align='center' colspan=".$nbr_service.">".stripslashes($letcure[LIBELLE_SERVICE])."</th>";
        }
		print "<th align='center' colspan='8'> TOTAL</th>";
		//fin pour les premieres cellules
		
		/*DEBUT DES PETITES CELLULES POUR LES GRANDES*/
			print "<tr>";
               
		        //jaffiche la premiere cellule sans probleme
		        print "<th> Num Chambre</th>  <th> Nb Place </th> <th>Noms Prenoms</th> <th>Appt Chambre</th>";
		       //jaffiche la deuximme cellule ou jai les services
			   
			   
			   
			   $requete="select CODE_TYPE_SERVICE as lecode from type_service order by LIBELLE_SERVICE asc";
			   $result=mysql_query($requete, $link);
			   while($letcure=mysql_fetch_array($result)){
					 $code=$letcure[lecode];
					 $requete1="select * from service  where CODE_TYPE_SERVICE=$code ";
		             $result1=mysql_query($requete1,$link);
			        while($letcure1=mysql_fetch_array($result1))
			        {  extract($letcure1);
			              print "<th>".stripslashes($TITRE_SERVICE)."</th> ";
			        }
			    }
				
				
				
				
			print "<th style='width:80px; height:30px'> Total du jour</th>  <th>Repport veille </th> <th>Total general</th> <th>Deduction</th> <th> Encais</th>  <th>Debiteur D </th> <th>A Reporter</th> <th>Observations</th>";			$nb_chambre=recupere_main_courante_nbchambre();
			// premiere boucle pour determiner le nombre total de ligne que jaurais usr ma main courante
			//while($nb_chambre>=0){
			        //print"<tr>";
					//je construis pour la lebergemnet 
	                $requete2="select * from chambre order by LIBELLE_CHAMBRE asc";
                    $result2=mysql_query($requete2,$link);
					
			        while($letcure2=mysql_fetch_array($result2))
					
					
			        {   print "<tr>";
					  //$u=0;
			             $code2_chambre=$letcure2[CODE_CHAMBRE];
				         $code_type2=$letcure2[CODE_TYPE_CHAMBRE];
			             $libelle_chambre2=$letcure2[LIBELLE_CHAMBRE];
						 //je selectionne le nombre de personne pour la chambre et la dateday
						 $val_nbpersonne=recupere_mainnbchambrenb($code2_chambre,$dateday);
						 //je selectionne id de la personne pour afficher son non 
						 $id_personne=recupere_idpersone_main_courante($code2_chambre,$dateday);
						 $id_client=recupere_idclient_maincourante($id_personne);
						 $la_personne=retour_nomprenom_main_courante($id_personne);
						 //je cherche le tarif de la chambre en fonction du type
						 $prix_chambre=recupere_montant_chambre($code_type2);
						 $tt=retour_nomprenom_main_courante($id_personne);
			             print"<td title=".$tt.">".stripslashes($letcure2[LIBELLE_CHAMBRE])."</td>";
						 print"<td>".$val_nbpersonne."</td>";
						 print"<td>".$la_personne."</td>";
						 if($la_personne!=""){
						  print"<td style='text-align:right;' >".formatage3Pos($prix_chambre)."</td>";
						   $u=1;
						   $debut_total_hebergement=$debut_total_hebergement+$prix_chambre;
						  }
						  else{
						  print"<td></td>";
						  $u=2;
						  }
						 //print"<td>".$prix_chambre."</td>";
						  
						  
						  
						  
						  
						  
						  
						  
						  //la je gere les types deservices
						  
						  $total_general=0;
						  $requete4="select CODE_TYPE_SERVICE as lecode from type_service order by LIBELLE_SERVICE asc";
			              $result4=mysql_query($requete4, $link);
			            while($letcure4=mysql_fetch_array($result4))
						{   $code4=$letcure4[lecode];
						 $requete5="select * from service  where CODE_TYPE_SERVICE=$code4 ";
		                 $result5=mysql_query($requete5,$link);
			             while($letcure5=mysql_fetch_array($result5))
			              {  $code_service=$letcure5[CODE_SERVICE];
						    $val_montserv=recupere_montant_service_maincourante($code_service);
							$test=$code_service+$id_personne;
							//je recupre la somme pour chaque id du service en fonction dun client qui passe et de la dateday de consommation
							$montat_affiche_client=recupere_montant_cellule_maincourante($id_client,$code_service,$dateday);
							 print"<td style='text-align:right;'>".formatage3Pos($montat_affiche_client)."</td>";
							 $total_general=$total_general+$montat_affiche_client;
							 $debut_total_pour_service=$debut_total_pour_service+$montat_affiche_client;
			              }
						   
			            }
						
						$total_jour=$prix_chambre+$total_general;
						//fin je gere les types de services
						//je construit les totaux
						if($u==1){
						print "<td style='text-align:right; '>".formatage3Pos($total_jour)."</td>";
						$debut_total_du_jour=$debut_total_du_jour+$total_jour;
						}
						elseif($u==2){
						 print "<td></td>";
						}
						//report veille
						
						/*
						  $requete10="select CODE_TYPE_SERVICE as lecode from type_service order by LIBELLE_SERVICE asc";
			              $result10=mysql_query($requete10, $link);
			            while($letcure10=mysql_fetch_array($result10))
						{   $code10=$letcure10[lecode];
						 $requete11="select * from service  where CODE_TYPE_SERVICE=$code10 ";
		                 $result11=mysql_query($requete11,$link);
			             while($letcure11=mysql_fetch_array($result11))
			              {  $code_service=$letcure11[CODE_SERVICE];
						    $val_montserv=recupere_montant_service_maincourante($code_service);
							$test=$code_service+$id_personne;
							//je recupre la somme pour chaque id du service en fonction dun client qui passe et de la dateday de consommation
							$montat_affiche_client=recupere_montant_cellule_maincourante($id_client,$code_service,$dateday);
							 //print"<td>".$montat_affiche_client."</td>";
							 $total_general=$total_general+$montat_affiche_client;
							 
			              }
						   
			            }*/
						
						$repport_veil=recupere_montant_cellule_maincourante_veille($id_client,$hier,$etat_zero);
						$deb_total_report_veil=$deb_total_report_veil+$repport_veil;
						print "<td style='text-align:right;'>".formatage3Pos($repport_veil)."</td>";
						//print "<td>fgg</td>";
						//fin repport veille
						$total_general=$repport_veil+$total_jour;
						//total general
						if($u==1){
							print "<td style='text-align:right;'>".formatage3Pos($total_general)."</td>";
							$debut_total_general=$debut_total_general+$total_general;
						
						}
					    elseif($u==2){
						 print "<td></td>";
						}
						
						
						//fin total general
						
						  
						//deduction
						print "<td>1002</td>";
						//en caisse
						$encaisse=recupere_montant_cellule_maincourante_today($id_client,$dateday,$etat_un);
						$debut_total_encaisse=$debut_total_encaisse+$encaisse;
						print "<td style='text-align:right;'>".formatage3Pos($encaisse)."</td>";
						//debiteur
						print "<td>1002</td>";
						
						
						$arepporter=$total_general-$encaisse;
						//a repporter
						//print "<td>".$arepporter."</td>";
					    if($u==1){
							print "<td style='text-align:right;'>".formatage3Pos($arepporter)."</td>";
						$debut_total_arepporter=$debut_total_arepporter+$arepporter;
						}
					    elseif($u==2){
						 print "<td></td>";
						}
						
						//observations
						print "<td>RAS</td>";
						
						print "</tr>";
						
						
						
						
						
			        }
					
					 
					 
					
					
					
					//contruction de la derniere cellule pour les totaux
			    
				     print "<tr>";
					 
					 
					 
					 
					 print "<td></td>";
					 print "<td></td>";
					 print "<td>TAOTAL A REPORTER</td>";
					 print "<td style='text-align:right;'>".formatage3Pos($debut_total_hebergement)."</td>";
					 
					 
					 
					 //je veux faire a ce niveau les totaux pour tous les services
					 
					 
					 
					      $requete40="select CODE_TYPE_SERVICE as lecode from type_service order by LIBELLE_SERVICE asc";
			              $result40=mysql_query($requete40, $link);
			            while($letcure40=mysql_fetch_array($result40))
						{   $code4=$letcure40[lecode];
						 $requete5="select * from service  where CODE_TYPE_SERVICE=$code4 ";
		                 $result5=mysql_query($requete5,$link);
			             while($letcure5=mysql_fetch_array($result5))
			              {  $code_service=$letcure5[CODE_SERVICE];
						    $val_montserv=recupere_montant_service_maincourante($code_service);
							$test=$code_service+$id_personne;
							//je recupre la somme pour chaque id du service en fonction dun client qui passe et de la dateday de consommation
							$montat_affiche_client=recupere_montant_cellule_maincourante($id_client,$code_service,$dateday);
							// print"<td style='text-align:right;'>".formatage3Pos($montat_affiche_client)."</td>";
							$val_montant_service_totaux=recupere_montant_total_service_maincourante($code_service,$dateday);
							 //$total_general=$total_general+$montat_affiche_client;
							 // print "<td>".$montat_affiche_client."</td>";
							  print "<td style='text-align:right;'>".formatage3Pos($val_montant_service_totaux)."</td>";
							  $debut_total_montant_service=$debut_total_montant_service+$val_montant_service_totaux;
			              }
						   
			            }
					 
					 //fin des totaux pour les services
					 
					 print "<td style='text-align:right;'>".formatage3Pos($debut_total_du_jour)."</td>";
					 print "<td style='text-align:right;'>".formatage3Pos($deb_total_report_veil)."</td>";
					 print "<td style='text-align:right;'>".formatage3Pos($debut_total_general)."</td>";
					 print "<td style='text-align:right;'></td>";
					 print "<td style='text-align:right;'>".formatage3Pos($debut_total_encaisse)."</td>";
					 print "<td style='text-align:right;'></td>";
					 print "<td style='text-align:right;' >".formatage3Pos($debut_total_arepporter)."</td>";
					 print "<td></td>";
					 print "</tr>";
			
			        //fin  de la construction de la derniere cellule pour les totaux
			print"</tr>";
		 
		     
					$total_journee=$debut_total_hebergement+$debut_total_du_jour+$deb_total_report_veil+$debut_total_general+$debut_total_encaisse+$debut_total_arepporter+$debut_total_montant_service;
			 
			      
			 
			 
			 
			 
			 
			 
			 
  print "</table>";
     print "Main Courante du &nbsp;&nbsp;&nbsp;".$dateday. " &nbsp;&nbsp;&nbsp;&nbsp;Montant &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".formatage3Pos($total_journee);
?>

 
					 	
</body>
</html>
