<?php session_start();
include('decoupagebon/coupe1.php');
include('fonctionpagination.php');//////CA CEST MON SCRIPT JAVASCRIPT POUR RECUPERER LE NOM DE DU RESPONSABLE DANS UN POPUP////////
print" <script>
    function openPopup(){
      window.open('arrivee_depart_popup.php','','toolbar=no,menubar=no,location=no,risizable=no,scrollbars=yes,status=no,height=1000,width=1000');
    }
  </script>";
$retour_date_reserve=date('d/m/Y');
?>
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
function ouverturegraphe_reservation()
{
window.open("grap_reservations.php", "ouverture", "toolbar=yes, status=yes, scrollbars=yes, resizable=yes, width=1000, height=500");
}
//-->
</SCRIPT>
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
	$g_sta=$_REQUEST['stat'];
	$g_date_confirme=addslashes($_REQUEST['date_confirme']);
	$g_date_annul=addslashes($_REQUEST['date_annul']);

	   $date1=dateFormBase($g_date_annul);
	   $date2=dateFormBase($g_date_confirme);
	//on passe en parametre les liens
	if($_POST['btn_consommation']=='Consommations periodiques'){
	 
		$_SESSION['debut']=$date1;
	    $_SESSION['fin']=$date2;
		//print "dfdfdf";
		//print $_SESSION['debut'];
		//print $_SESSION['fin'];
		
	
	}
	if($_POST['btn_reservation']=='Types chambres les plus reservees'){
	 
		$_SESSION['debut_reserve']=$date1;
	    $_SESSION['fin_reserve']=$date2;
		/*print "dfdfdf";
		print $_SESSION['debut_reserve'];
		print $_SESSION['fin_reserve'];*/
		
	
	}
?>
                          <div class="art-post-inner art-article">
                                          <h2 class="art-postheader" style="text-align:center;">STATISTIQUES<a href="#" rel="bookmark" title="Permanent Link to this Post"></a> <a class="visited" href="#" rel="bookmark" title="Visited Hyperlink"></a> <a class="hovered" href="#" rel="bookmark" title="Hovered Hyperlink"></a></h2>
                                          		  <?php 
									    
									              ?> 
										  <div class="art-postmetadataheader">
                                              
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
										  <form method="post" name="cadre" action="statistique.php?modif_code=<?php print $g_code;?>">
												<table border="0" cellspacing="0" cellpadding="0" width="80%">
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
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
													    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
													    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														
													   
										          <!--  <a href="statistique.php?stat=2" onclick="ouverturegraphe()">Consommations periodiques</a>-->
													<input type="submit" onclick="ouverturegraphe()" name="btn_consommation" value="Consommations periodiques" style="width:200px; height:30px"/>
												 <input type="submit" onclick="ouverturegraphe_reservation()" name="btn_reservation" value="Types chambres les plus reservees" style="width:215px; height:30px"/>
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
                          		