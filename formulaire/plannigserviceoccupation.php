<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
print" <script>
    function openPopup(){
      window.open('listeservice.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=500');
    }
  </script>";
   print" <script>
    function openPopup1(){
      window.open('listechambre.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=500,width=500');
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
function rechercher_pourafficher_enfonction_du_choix($value){
return ResultatRequette("select ID_ETAT_SERVICE as info from etat_service where LIBELLE='$value'");
}
 	require_once('../procedure_php/procedure_globale.php');
	require_once('../procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	//je lui passe la valeur du code de chaque ligne en fonction du libelle 
	$g_code=$_REQUEST['modif_code'];
	$g_etat=addslashes($_REQUEST['etat']);
	$g_code_etat_libelle=rechercher_pourafficher_enfonction_du_choix($g_etat);
	//on passe en parametre les boutons
	if($_POST['btn']=='Ajouter'){$v_global=Ajout;}
	elseif($_POST['btn']=='Modifier'){$v_global=Modif;}
	elseif($_POST['btn']=='Supprimer'){$v_global=Suppression;}
	elseif($_POST['btn']=='Afficher'){$v_global=Affich;}
	elseif($_POST['btn_Annuler']=='Annuler'){$v_global=Annuler;}
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
                                          <h2 class="art-postheader" style="text-align:center;">GESTION DES OCCUPATIONS/RESERVATION SERVICES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									   require_once('../procedure_php/procedure_globale.php');
										$link=Connexion();
										
										print "<table class='table' border:1 width='100%'>";
										print " <th class='entete_tableau' >";
										print " <strong> Client</strong>";
	           							print " </th>";
									
										print " <th class='entete_tableau' >";
										print " <strong> Service</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date debut</strong>";
	           							print " </th>";
										
										print " <th class='entete_tableau' >";
										print " <strong>Date fin</strong>";
	           							print " </th>";
										// on recupère la liste 
										$requete="select * from utiliser";
										$result=mysql_query($requete, $link);	
										$i=0;		  
										// on affiche la liste 
										while($lecture=mysql_fetch_array($result))
										{  extract($lecture);
											 $i++;
											 if ($i%2==1) print " <tr class='ligne_impaire'>";
											 else print " <tr class='ligne_paire'>";	
                                        print " <td>".stripslashes($ID_CLIENT )."</a></td>";
									    print " <td>".stripslashes(rechercher_dlibservre_sorti_finuser($CODE_SERVICE))."</a></td>";
									    print " <td>".stripslashes($DATE_UTILISATION)."</a></td>";
										print " <td>".stripslashes($DATE_FIN)."</a></td>";
											 print " </tr>";
										}
										print "</table>";
										$code_cen="";
										$libelle="";
										print "<br/>";
										print "Nombre de service: ".$i."<br/>";
									              ?> 
										  <div class="art-postmetadataheader">
 <?php
	        
if($_POST['etat']==""){
			print"<script type='text/javascript'>
                var anc_onglet = '.';
                change_onglet(anc_onglet);
          </script>";
    }
elseif($_POST['etat']!=""){
	if($_POST['etat']=='1'){
	print"<script type='text/javascript'>
                var anc_onglet = 'asigne1';
                change_onglet(anc_onglet);
    
          </script>";
	}
	if($_POST['etat']=='2'){
	print"<script type='text/javascript'>
                var anc_onglet = 'asigne';
                change_onglet(anc_onglet);
    
          </script>";
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
											<form method="post" name="cadre" action="plannigserviceoccupation.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="71%">
								        <tr>
										<td><label> Etat R&eacute;servation :</label> </td>
										<td>
                                          <select name="etat">
							        <option value=""></option>
                                    <option value="1">Reserv&eacute;</option>
                                      <option value="2">Occup&eacute;e</option>                              
                                     </select></td>
									    </tr>
								 				        </form>
												       </table> <br/>
                                        <input type="submit" style="width:80px; height:30px" name="btn"  value="Ajouter"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Modifier"/>
										<input type="submit" style="width:80px; height:30px" name="btn"   value="Supprimer"/>
										<input type="reset" style="width:80px; height:30px" name="btn_Annuler"   value=" Annuler "/>
										<input type="submit" style="width:80px; height:30px" name="btn_Imprimer" onclick="window.open('../etat/liste_type_chambre.php','Liste des types de chambre','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=no,status=no,height=800,width=800')" value="Imprimer" />
												 </form> 
												 
                                              <div class="art-postheadericons art-metadata-icons">
                                                </div>
                                          </div>
                                          <div class="art-postcontent">
                                          </div>
                          </div>
<?php 
include('decoupagebon/coupe2.php');
?>              
                          		