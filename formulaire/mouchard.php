<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
print" <script>
    function openPopup(){
      window.open('../etat/mouchard_etat.php','','toolbar=yes,menubar=yes,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000');
    }
  </script>";
$retour_date_reserve=date('d/m/Y');
?>

<script type="text/javascript">
        //<!--
                function change_onglet(name)
                {
                        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }
        //-->
        </script>
		

<?php
  $retour_date_reserve=date('d/m/Y');
 	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	$g_date_confirme=addslashes($_REQUEST['date_confirme']);
	$g_date_annul=addslashes($_REQUEST['date_annul']);
	
	
	$date1=dateFormBase($g_date_annul);
	$date2=dateFormBase($g_date_confirme);
	//on passe en parametre les boutons
	if($_POST['btn']=='Afficher'){ //print $date1; 
	$affiche=1;
	$_SESSION['date_petit_mouchard']=$date1;
	$_SESSION['date_grand_mouchard']=$date2;
	/*$g_date_confirme="";
	$g_date_annul="";*/
	   if($_POST['btn']=='Imprimer'){ //print $date2; 
	$affiche=2;
        $_SESSION['date_petit_mouchard']=$date1;
		$_SESSION['date_grand_mouchard']=$date2;
		//header('location:arrivee_depart_popup.php');
	   }
	
	}
	elseif($_POST['btn']=='Imprimer'){ //print $date2; 
	$affiche=2;
        $_SESSION['date_petit_mouchard']=$date1;
		$_SESSION['date_grand_mouchard']=$date2;
		//header('location:arrivee_depart_popup.php');
	}
	$i=0;
	if (isset($v_global)){ 
	                
	    if($v_global==Ajout){
			    
			
		}
		elseif($v_global==Modif){
			
		}
		//bouton suppression
		elseif($v_global==Suppression){
		//
		}
		elseif($v_global=Annuler){
		   
		}
	
	$i++;	
	}
	
	if ($i==0){
	    if (isset($g_code)){
			
		}
	
	}	
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">MOUCHARD<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									
										  require_once('../procedure_php/procedure_globale.php');
										require_once('../procedure_php/mysql_requette.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
									
										print " <th class='entete_tableau' >";
										print " <strong> UTILISATEUR </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>DATE</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> HEURE </strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong> OPERATION </strong>";
	           							print " </th>";
										
                                      
																				
										// Pr�paration de la requ�te		
									    $requete="select  * from  mouchard where date_operation  BETWEEN '$date1' AND '$date2'";
										// on recup�re la liste 
										$result=mysql_query($requete, $link);
										$i=0;
														  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
										    print " <td>".stripslashes(recupere_nom_user_mouchard($code_user))."</a></td>";
											print " <td>".stripslashes($date_operation)."</td>";
											print " <td>".stripslashes($heure_operation)."</td>";
											print " <td>".stripslashes($operation_effectuee)."</td>";
											print " </tr>";
										}
										print "</table>";
										$retour_date=date('d/m/Y');
										$code_cen="";
										$libelle="";
										print "<br/>";
									              ?> 
										  <div class="art-postmetadataheader">
<?php
	        
if($affiche==""){
			print"<script type='text/javascript'>
                var anc_onglet = '.';
                change_onglet(anc_onglet);
          </script>";
    }
elseif($affiche!=""){
	if($affiche==1){
	//print "on affiche Afficher";
	print"<script type='text/javascript'>
                var anc_onglet = 'asigne1';
                change_onglet(anc_onglet);
    
          </script>";
	}
	elseif($affiche==2){ //print "Imprimer";
	}
}
		
?>	   
                                          </div>
                                          <div class="art-postcontent">
                                          </div>
                                          <div class="cleared"></div>
                                          <div class="art-postmetadatafooter">
                                             
                                          </div>
                          </div>
                          
                          		<div class="cleared"></div>
                              </div>
                          </div>
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
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader"><a href="#" title="Permanent Link to this Post"></a></h2>
                                          <div class="art-postmetadataheader">
										  <!-- formulaire -->
											    <form method="post" name="cadre" action="mouchard.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="71%">
								                        <tr>
														<td><label> Date Debut: </label></td>
						                               <td>  <div align="right"><font class="T2"> </font>     </div>
                                                        <input readonly type="text" name="date_annul"  value="<?php print $g_date_annul; ?>" >
	                                                     <?php
	                                                     include_once("../calendrierphp/calendar.php");
	                                                     calendarpopupDim('id1','document.cadre.date_annul',"fr","1","0");
	                                                     ?>
                                                        </td>
											            </tr>
														<tr>
														<td><label> Date Fin: </label></td>
						                                <td>  <div align="right"><font class="T2"> </font>     </div>
                                                         <input readonly type="text" name="date_confirme"  value="<?php print $g_date_confirme; ?>" >
	                                                     <?php
	                                                    include_once("../calendrierphp/calendar.php");
	                                                    calendarpopupDim('id1','document.cadre.date_confirme',"fr","1","0");
	                                                     ?>
                                                        <input type="submit" style="width:80px; height:30px" name="btn"  value="Afficher"/>
														<!-- <input type="submit" style="width:80px; height:30px" name="btn"  value="Imprimer" />  </td>-->
										                <input type="submit" style="width:80px; height:30px" name="btn" onclick="openPopup()" value="Imprimer" />  </td>
											            </tr>
								 				        </form>
												       </table> 
												 
                                              <div class="art-postheadericons art-metadata-icons">
                                                </div>
                                          </div>
                                          <div class="art-postcontent">
                                          </div>
                          </div>
<?php 
include('decoupagebon/coupe2.php');
?>              
                          		