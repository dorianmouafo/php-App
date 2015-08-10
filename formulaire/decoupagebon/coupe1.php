<?php 
session_start();
if($_SESSION['verification']==1){  
    $end=time();
    include("start_timer.php");
    include("end_timer.php");
	//print $_SESSION['verification'];
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function ouverture12()
{
window.open("../documents/dorian.pdf", "ouverture", "toolbar=yes, status=yes, scrollbars=yes, resizable=yes, width=700, height=500");
}
//-->
<!--
function ouverture_aprpopos()
{
window.open("../documents/a_propos.php", "ouverture", "toolbar=no, status=no, scrollbars=no, resizable=no, width=270, height=200");
}
//-->
</SCRIPT>  
<SCRIPT LANGUAGE="JavaScript">
<!--
function ouverturegraphe()
{
window.open("graphemontant.php", "ouverture", "toolbar=yes, status=yes, scrollbars=yes, resizable=yes, width=1000, height=500");
}
//-->
</SCRIPT> 
<SCRIPT LANGUAGE="JavaScript">
<!--
function ouverture_maincourante()
{
window.open("main_courante.php", "", "toolbar=yes, status=yes, scrollbars=yes, resizable=yes, width=10000, height=10000");
}
function ouverture1()
{
window.open("new  12.php", "", "toolbar=yes, status=yes, scrollbars=yes, resizable=yes, width=1000, height=1000");
}
//-->
<!--
</SCRIPT>   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>FS HOTEL 1.0 </title>
	  <!--  pour le tableau      le_style   -->
	<link rel="stylesheet" href="../procedure_css/le_style.css" type="text/css" media="screen" />
	  <!--  pour la pgination style css1          -->
	<link rel="stylesheet" href="../procedure_css/css1.css" type="text/css" media="screen" />
	 <!--  pour les onglets   -->
	<link rel="stylesheet" href="../procedure_css/styleclient.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../procedure_css/style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../procedure_js/jquery.js"></script>
    <script type="text/javascript" src="../procedure_js/script.js"></script>
</head>
<body>
<div id="art-page-background-glare">
        <div id="art-page-background-glare-image">
    <div id="art-main">
        <div class="art-sheet">
            <div class="art-sheet-tl"></div>
            <div class="art-sheet-tr"></div>
            <div class="art-sheet-bl"></div>
            <div class="art-sheet-br"></div>
            <div class="art-sheet-tc"></div>
            <div class="art-sheet-bc"></div>
            <div class="art-sheet-cl"></div>
            <div class="art-sheet-cr"></div>
            <div class="art-sheet-cc"></div>
            <div class="art-sheet-body">
                <div class="art-header">
                    <div class="art-header-center">
                        <div class="art-header-png"></div>
                        <div class="art-header-jpeg"></div>
                    </div>
                    <div class="art-logo">
                     <h1 id="name-text" class="art-logo-name"><a href="#"></a></h1>
                     <h2 id="slogan-text" class="art-logo-text"></h2>
                    </div>
                </div>
                <div class="art-nav">
                	<ul class="art-menu">
                		<li>
                			<a href="indexv.php" class="active"><span class="l"></span><span class="r"></span><span class="t">Accueil</span></a>
                		</li>
                		<li>
                			<a href="#"><span class="l"></span><span class="r"></span><span class="t">Client</span></a>
                			<ul>
								<li><a href="#">Nouveau Client</a>
                				<ul>
                				<li><a href="enregistrementclient.php">Personne Physique</a></li>
								<li><a href="personne_morale.php">Entreprise</a></li>
                				</ul>
                				</li>
								<li><a href="#">Occupation</a>
                				<ul>
                				<li><a href="enregistrementoccupation.php">Occupation Chambre</a></li>
								<li><a href="enregistrementoccupationservice.php">Occupation service</a></li>
                				</ul>
                				</li>
								<li><a href="consommation.php">Consommation</a></li>
								<li><a href="visite.php">Visiteur</a></li>
								<li><a href="consigne.php">Consigne</a></li>
								<li><a href="objet_oublie.php">Objets oubli&eacute;s</a></li>
								<li><a href="factureclient.php">Facturation</a>
								<ul>    
								<li><a href="factureclient.php">Facturation de sortie</a></li>
								<li><a href="facture_de_suivit_du_client.php">Payement des avances</a></li>
								<li><a href="avance.php">Payement ancienne Facture</a></li>
								</ul>
								</li>
                			</ul>
                		</li>

						
						<li>
							<a href="#"><span class="l"></span><span class="r"></span><span class="t">R&eacute;servation</span></a>
							<ul>
							<li><a href="">R&eacute;servation</a>
							<ul>
							<li><a href="reservation.php">R&eacute;servation Chambre</a></li>
							<li><a href="reservationserv.php">R&eacute;servation Service</a></li>
							</ul>
							</li>
							<li><a href="">Confirmer /Annuler </a>
							<ul>
							<li><a href="annulconfirmreservationchambre.php">R&eacute;servation Chambre</a></li>
							<li><a href="annulconfirmreservationservice.php">R&eacute;servation Service</a></li>
							</ul>
							</li>
							<li><a href="liste_reservation_periode.php">Liste des R&eacute;servation </a></li>
							</ul>
                		</li>
						
						
						
						
						<li>
							<a href="#"><span class="l"></span><span class="r"></span><span class="t">Enregistrement</span></a>
							<ul>
							<li><a href="chambre.php">Chambre</a></li>
							<li><a href="type_chambre.php">Type Chambre</a></li>
							<li><a href="service.php">Services</a></li>
							<li><a href="type_service.php">Type de Service</a></li>
							<li><a href="etat_chambre.php">Etat des chambres</a></li>
							<li><a href="#">Nouveau plan Tarifaire</a>
							<ul>
							<li><a href="tarification_chambre.php">Tarification Chambre</a></li>
							<li><a href="tarification_du_service.php">Tarification service</a></li>
							</ul>
							</li>
							<li><a href="">Attribution etat </a>
							<ul>
							<li><a href="gererletatchambre.php">Chambre</a></li>
							<li><a href="gererletatservice.php">Service</a></li>
							</ul>
							</li>
							</ul>
                		</li>
						
						  
						  
						  
						  
						  
						<li>
							<a href="#"><span class="l"></span><span class="r"></span><span class="t">Statistiques</span></a>
							<ul>
							     <li><a href="arrivee_depart.php">Arriv&eacute;es/D&eacute;parts</a></li>
								 <li><a href="liste_facture_periode.php">Liste Factures par periode</a></li>
                			<!--	<li><a href="#">Planning occupations/reservation</a>
								<ul>
								<li><a href="plannigserviceoccupation.php">Services </a></li>
								<li><a href="">Chambre</a></li>
								</ul>
								
								</li>-->
								
								
								<li><a href="">Planning des Etats </a>
								<ul>
								<!--<li><a href="plannigservice.php">Services </a></li>-->
								<li><a href="planning_etat_chambre_occupee_libre_reservee.php">Chambre</a></li>
								</ul>
								</li>
								<!--<li><a href="statistique.php">Statistiques</a></li>-->
					           <!-- <li><a href="#">Planning de reservation</a>
								<ul>
								<li><a href="#">R&eacute;servation des chambres</a></li>
								<li><a href="#">R&eacute;servation des services</a></li>
								</ul>
								</li>-->
								<li><a href="#">Montants encaiss&eacute;es</a>
								<ul>
									<li><a href="montant_encaisse_pour_chambre.php">Chambre</a></li>
									<li><a href="montant_encaisse_pour_service.php">Service</a></li>
								</ul>
								</li>
								<li><a href="main_couranteavant.php">Main courante de R&eacute;ception</a></li>
								<!--<li><a href="#">Situation p&eacute;riodique</a>
								<ul>
								<li><a href="#">Par jours</a></li>
								<li><a href="#">Par Mois</a></li>
								<li><a href="#">Par Ann&eacute;e</a></li>
								</ul>
								</li>-->
								
								<!--<li><a href="" onclick="ouverturegraphe()">Statistiques</a></li>-->
                			</ul>
                		</li>
						  
						  
						  
						  
						  
						  
						  <li>
                			<a href="#"><span class="l"></span><span class="r"></span><span class="t">A propos</span></a>
							<ul>
                				<li><a href="#" onclick="ouverture_aprpopos()">A propos de FS H&Ocirc;tel</a></li>
								<li><a href="#">Contact/Assistance</a></li>
								<li><a href="#" onclick="ouverture12()">Guide d'utilisation</a></li>
                			</ul>
                		</li>
						
						<li>
                			<!--<a href="../index.php"><span class="l"></span><span class="r"></span><span class="t">Deconnexion</span></a>-->
							<a href="decoupagebon/deconnexion.php"   ><span class="l"></span><span class="r"></span><span class="t">Deconnexion</span></a>
                		</li>
						
						
						<?php  
						$g_dd=$_REQUEST['deconnect'];
						if($g_dd==2){
					    LeMouchard($_SESSION['code_code'],'Deconnexion a FS');
						$_SESSION['verification']=2;
						session_destroy();
						header('location:../index.php');
						}
						
						?>
                		
                	</ul>
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1">
                          <div class="art-block">
                              <div class="art-block-body">
                                          <div class="art-blockheader">
                                              <div class="l"></div>
                                              <div class="r"></div>
                                              <h3 class="t">R&eacute;servation</h3>
                                          </div>
                                          <div class="art-blockcontent">
                                              <div class="art-blockcontent-tl"></div>
                                              <div class="art-blockcontent-tr"></div>
                                              <div class="art-blockcontent-bl"></div>
                                              <div class="art-blockcontent-br"></div>
                                              <div class="art-blockcontent-tc"></div>
                                              <div class="art-blockcontent-bc"></div>
                                              <div class="art-blockcontent-cl"></div>
                                              <div class="art-blockcontent-cr"></div>
                                              <div class="art-blockcontent-cc"></div>
                                              <div class="art-blockcontent-body">
													<ul>
                                                         <li><a href="reservation.php" title="Reservation" >R&eacute;servation Chambre</a></li>
														 <br/>
														 <li><a href="reservationserv.php"  title="Reservation">R&eacute;servation Service</a></li> 
                                                    </ul>
                                          		<div class="cleared"></div>
                                              </div>
                                          </div>
                          		<div class="cleared"></div>
                              </div>
                          </div>
						  
						  
                          <div class="art-block">
						  
						  
						   <div class="art-block-body">
                                          <div class="art-blockheader">
                                              <div class="l"></div>
                                              <div class="r"></div>
                                              <h3 class="t">Nouveau client</h3>
                                          </div>
                                          <div class="art-blockcontent">
                                              <div class="art-blockcontent-tl"></div>
                                              <div class="art-blockcontent-tr"></div>
                                              <div class="art-blockcontent-bl"></div>
                                              <div class="art-blockcontent-br"></div>
                                              <div class="art-blockcontent-tc"></div>
                                              <div class="art-blockcontent-bc"></div>
                                              <div class="art-blockcontent-cl"></div>
                                              <div class="art-blockcontent-cr"></div>
                                              <div class="art-blockcontent-cc"></div>
                                              <div class="art-blockcontent-body">
													<ul>
                                                         <li><a href="enregistrementclient.php" title="Client Unique">Client Unique</a></li>
														 <br/>
                                                         <li><a href="personne_morale.php" title="Entreprise" >Entreprise</a></li>
                                                    </ul>
                                          		<div class="cleared"></div>
                                              </div>
                                          </div>
                          		<div class="cleared"></div>
                              </div>
							  
                          </div>
						  
						  
						  
						  
						  
                          <div class="art-block">
                                   <div class="art-block-body">
                                          <div class="art-blockheader">
                                              <div class="l"></div>
                                              <div class="r"></div>
                                              <h3 class="t">Occupation</h3>
                                          </div>
                                          <div class="art-blockcontent">
                                              <div class="art-blockcontent-tl"></div>
                                              <div class="art-blockcontent-tr"></div>
                                              <div class="art-blockcontent-bl"></div>
                                              <div class="art-blockcontent-br"></div>
                                              <div class="art-blockcontent-tc"></div>
                                              <div class="art-blockcontent-bc"></div>
                                              <div class="art-blockcontent-cl"></div>
                                              <div class="art-blockcontent-cr"></div>
                                              <div class="art-blockcontent-cc"></div>
                                              <div class="art-blockcontent-body">
													<ul>
                                                       <li><a href="enregistrementoccupation.php" title="Occupation chambre">Occupation chambre</a></li>
													   <br/>
                                                       <li><a href="enregistrementoccupationservice.php" title="Occupation service" >Occupation service</a></li>
                                                    </ul>
                                          		<div class="cleared"></div>
                                              </div>
                                          </div>
                          		<div class="cleared"></div>
                              </div>
                              
                          </div>
                          <div class="art-block">
                              <div class="art-block-body">
                                       <div class="art-blockheader">
                                              <div class="l"></div>
                                              <div class="r"></div>
                                              <h3 class="t">Facturation</h3>
                                          </div>
                                          <div class="art-blockcontent">
                                              <div class="art-blockcontent-tl"></div>
                                              <div class="art-blockcontent-tr"></div>
                                              <div class="art-blockcontent-bl"></div>
                                              <div class="art-blockcontent-br"></div>
                                              <div class="art-blockcontent-tc"></div>
                                              <div class="art-blockcontent-bc"></div>
                                              <div class="art-blockcontent-cl"></div>
                                              <div class="art-blockcontent-cr"></div>
                                              <div class="art-blockcontent-cc"></div>
                                              <div class="art-blockcontent-body">
													<ul>
                                                    <li><a href="factureclient.php">Facturation de sortie</a></li><br/>
													<li><a href="facture_de_suivit_du_client.php">Payement des avances</a></li><br/>
													<li><a href="avance.php">Payement ancienne Facture</a></li>
                                                    </ul>
                                          		<div class="cleared"></div>
                                              </div>
                                          </div>       
                                          
                          		<div class="cleared"></div>
                              </div>
                          </div>
						  
						  
						  
						  
						     <div class="art-block">
                              <div class="art-block-body">
                                       <div class="art-blockheader">
                                              <div class="l"></div>
                                              <div class="r"></div>
                                              <h3 class="t">Documents</h3>
                                          </div>
                                          <div class="art-blockcontent">
                                              <div class="art-blockcontent-tl"></div>
                                              <div class="art-blockcontent-tr"></div>
                                              <div class="art-blockcontent-bl"></div>
                                              <div class="art-blockcontent-br"></div>
                                              <div class="art-blockcontent-tc"></div>
                                              <div class="art-blockcontent-bc"></div>
                                              <div class="art-blockcontent-cl"></div>
                                              <div class="art-blockcontent-cr"></div>
                                              <div class="art-blockcontent-cc"></div>
                                              <div class="art-blockcontent-body">
													<ul>
                                             <!-- <li><a href="#"  onclick="ouverture_maincourante()" title="Main Courante">Main courante de reception</a></li>-->
											 <li><a href="main_couranteavant.php"  title="Main Courante">Main courante de reception</a></li>
														 <br/>
														 <li><a href="arrivee_depart.php" title="Arriv&eacute; D&eacute;part">Arriv&eacute;es/D&eacute;parts</a></li>
                                                    </ul>
                                          		<div class="cleared"></div>
                                              </div>
                                          </div>       
                                          
                          		<div class="cleared"></div>
                              </div>
                          </div>
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  <?php
						  if($_SESSION['groupe']==1){
						 print "<div class='art-block'>
                              <div class='art-block-body'>
                                          <div class='art-blockheader'>
                                              <div class='l'></div>
                                              <div class='r'></div>
                                              <h3 class='t'>Administration</h3>
                                          </div>
                                          <div class='art-blockcontent'>
                                              <div class='art-blockcontent-tl'></div>
                                              <div class='art-blockcontent-tr'></div>
                                              <div class='art-blockcontent-bl'></div>
                                              <div class='art-blockcontent-br'></div>
                                              <div class='art-blockcontent-tc'></div>
                                              <div class='art-blockcontent-bc'></div>
                                              <div class='art-blockcontent-cl'></div>
                                              <div class='art-blockcontent-cr'></div>
                                              <div class='art-blockcontent-cc'></div>
                                              <div class='art-blockcontent-body'>
                                                        <ul>
                                                        <li><a href='mouchard.php'>Mouchard</a></li><br/>
                				                        <li><a href='creer_utilisateur.php'>Creer un utilisateur</a></li> <br/>
                                                        <li><a href='sauvegarde/k20download.php'>Sauvegarde de la base</a></li><br/>
                				                        <li><a href='sauvegarde/k20save.php'>Sauvegarde automatique</a></li><br/>
                                                        </ul>
                                          
                                          		<div class='cleared'></div>
                                              </div>
                                          </div>
                          		<div class='cleared'></div>
                              </div>
                          </div>";
						  }
						  else{
						
						    }
						  ?>
						  
						  
						  
						  
						  
                          <div class="cleared"></div>
                        </div>
                        <div class="art-layout-cell art-content">
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
							  
							  
<?php 
}

elseif($_SESSION['verification']==2 OR $_SESSION['verification']=="" ){
header('location:../index.php');
}
?>