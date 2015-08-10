<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>Statistique des consommations</title>
    
    <meta name="keywords" content="rgraph html5 canvas example horizontal bar charts" />
    <meta name="description" content="RGraph: Javascript charts library -  Horizontal Bar charts example" />
    
    <meta property="og:title" content="RGraph: Javascript charts library" />
    <meta property="og:description" content="A charts library based on the HTML5 canvas tag" />

    <meta property="og:image" content="http://www.rgraph.net/images/logo.png"/>

    <link rel="stylesheet" href="css/website.css" type="text/css" media="screen" />
    <link rel="icon" type="image/png" href="images/favicon.png">
    
   
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

    <script src="libraries/RGraph.common.core.js" ></script>
    <script src="libraries/RGraph.common.tooltips.js" ></script>

    <script src="libraries/RGraph.hbar.js" ></script>
    
<?php 
//$val1=55.11;
  require_once('../procedure_php/procedure_globale.php');
  require_once('../procedure_php/mysql_requette.php');
  $rr=recupere_dddtest('8');
      $date1=$_SESSION['debut'];
	  $date2=$_SESSION['fin'];
	  
	 // print $date1; print $date2;
  $nb_total=recupere_total_consom();
  /// on recupere toutes les valeurs des identifants 
  //$a="je suis la ";
  
   $requete="select * from service  order by CODE_SERVICE asc";
   $result=mysql_query($requete,$link);
   	while($letcure=mysql_fetch_array($result))
		{  extract($letcure);
        //$libelle=$letcure[TITRE_SERVICE];
        //$code=$letcure[CODE_SERVICE];
		//$nbr_service=recupere_main_courante_serv1($code);
		 print "".($CODE_SERVICE)."";
        }
    
       print "azazazazazzazaz";
  $nb1='1';
  $nb2='2';
  $nb3='3';
  $nb4='4';
  $nb5='5';
  $nb6='6';
  $nb7='7';
  $nb8='8';
  $nb9='9';
  $nb10='10';
  $nb11='11';
  $nb12='12';
  $nb13='13';
  $nb14='14';
  $nb15='15';
  $nb16='16';
  $nb17='17';
  $nb18='18';
  $val1=recupere_premier($nb1,$date1,$date2);
  $val2=recupere_deuxieme($nb2,$date1,$date2);
  $val3=recupere_troisieme($nb3,$date1,$date2);
  $val4=recupere_quatrieme($nb4,$date1,$date2);
  $val5=recupere_cinquieme($nb5,$date1,$date2);
  $val6=recupere_sixieme($nb6,$date1,$date2);
  $val7=recupere_septieme($nb7,$date1,$date2);
  $val8=recupere_huitieme($nb8,$date1,$date2);
  $val9=recupere_neuvieme($nb9,$date1,$date2);
  $val10=recupere_dixieme($nb10,$date1,$date2);
  $val11=recupere_onzieme($nb11,$date1,$date2);
  $val12=recupere_douxieme($nb12,$date1,$date2);
  $val13=recupere_triezieme($nb13,$date1,$date2);
  $val14=recupere_quatorze($nb14,$date1,$date2);
  $val15=recupere_quinze($nb15,$date1,$date2);
  $val16=recupere_sieze($nb16,$date1,$date2);
  $val17=recupere_dixsetp($nb17,$date1,$date2);
  $val18=recupere_dixhuit($nb18,$date1,$date2);
   
   
   
   // je recupere la valeur de chaque libelle pour les code//
   $libelle1=recupere_libell_premier($nb1);
   $libelle2=recupere_libell_deuxime($nb2);
   $libelle3=recupere_libell_troisieme($nb3);
   $libelle4=recupere_libell_quarieme($nb4);
   $libelle5=recupere_libell_cinquieme($nb5);
   $libelle6=recupere_libell_sixieme($nb6);
   $libelle7=recupere_libell_septieme($nb7);
   $libelle8=recupere_libell_huitieme($nb8);
   $libelle9=recupere_libell_neuvieme($nb9);
   $libelle10=recupere_libell_dixieme($nb10);
   $libelle11=recupere_libell_onzieme($nb11);
   $libelle12=recupere_libell_douzieme($nb12);
   $libelle13=recupere_libell_triezieme($nb13);
   $libelle14=recupere_libell_quatorze($nb14);
   $libelle15=recupere_libell_quinze($nb15);
   $libelle16=recupere_libell_sieze($nb16);
   $libelle17=recupere_libell_disetp($nb17);
   $libelle18=recupere_libell_dixhuit($nb18);
   // fin de je recupere mles libelles//
   
   
   // calcul en pourcentage des valeurs retrouvees//
   $pourcent1=ceil(($val1*100)/$nb_total);
   $pourcent2=ceil(($val2*100)/$nb_total);
   $pourcent3=ceil(($val3*100)/$nb_total);
   $pourcent4=ceil(($val4*100)/$nb_total);
   $pourcent5=ceil(($val5*100)/$nb_total);
   $pourcent6=ceil(($val6*100)/$nb_total);
   $pourcent7=ceil(($val7*100)/$nb_total);
   $pourcent8=ceil(($val8*100)/$nb_total);
   $pourcent9=ceil(($val9*100)/$nb_total);
   $pourcent10=ceil(($val10*100)/$nb_total);
   $pourcent11=ceil(($val11*100)/$nb_total);
   $pourcent12=ceil(($val12*100)/$nb_total);
   $pourcent13=ceil(($val13*100)/$nb_total);
   $pourcent14=ceil(($val14*100)/$nb_total);
   $pourcent15=ceil(($val15*100)/$nb_total);
   $pourcent16=ceil(($val16*100)/$nb_total);
   $pourcent17=ceil(($val17*100)/$nb_total);
   $pourcent18=ceil(($val18*100)/$nb_total);
   
   
   //fin calcul des valeur en pourcentages des valeurs trouvees//
?>
    <script>
     
        window.onload = function ()
        {

            var hbar1 = new RGraph.HBar('hbar1', [<?php print $val1; ?>,
			                                      <?php print $val2; ?>,
												  <?php print $val3; ?>, 
												  <?php print $val4; ?>,
												  <?php print $val5; ?>, 
												  <?php print $val6; ?>,
												  <?php print $val7; ?>,
												  <?php print $val8; ?>,
												  <?php print $val9; ?>,
												  <?php print $val10; ?>,
												  <?php print $val11; ?>,
												  <?php print $val12; ?>,
												  <?php print $val13; ?>,
												  <?php print $val14; ?>,
												  <?php print $val15; ?>,
												  <?php print $val16; ?>,
												  <?php print $val17; ?>,
												  <?php print $val18; ?>,
												  ]);

            var grad = hbar1.context.createLinearGradient(900,0,275,0);
            grad.addColorStop(0, '#E6D2ED');
            grad.addColorStop(1, '#A2D97B');

            hbar1.Set('chart.strokestyle', 'rgba(10,30,20,20)');
            hbar1.Set('chart.gutter.left', 209);
            hbar1.Set('chart.gutter.right', 4);
            hbar1.Set('chart.background.grid.autofit', true);
            hbar1.Set('chart.title', 'STATISTIQUE DES RESSOURCES LES PLUS UTILISEES');
            hbar1.Set('chart.labels', ['<?php print $libelle1; ?> (<?php print $pourcent1; ?>%)',
			                          '<?php print $libelle2; ?> (<?php print $pourcent2; ?>%)',
									  '<?php print $libelle3; ?> (<?php print $pourcent3; ?>%)',
									  '<?php print $libelle4; ?> (<?php print $pourcent4; ?>%)',
									  '<?php print $libelle5; ?> (<?php print $pourcent5; ?>%)',
									  '<?php print $libelle6; ?> (<?php print $pourcent6; ?>%)',
									  '<?php print $libelle7; ?> (<?php print $pourcent7; ?>%)',
			                          '<?php print $libelle8; ?> (<?php print $pourcent8; ?>%)',
									  '<?php print $libelle9; ?> (<?php print $pourcent9; ?>%)',
									  '<?php print $libelle10; ?> (<?php print $pourcent10; ?>%)',
									  '<?php print $libelle11; ?> (<?php print $pourcent11; ?>%)',
									  '<?php print $libelle12; ?> (<?php print $pourcent12; ?>%)',
									  '<?php print $libelle13; ?> (<?php print $pourcent13; ?>%)',
									  '<?php print $libelle14; ?> (<?php print $pourcent14; ?>%)',
									  '<?php print $libelle15; ?> (<?php print $pourcent15; ?>%)',
									  '<?php print $libelle16; ?> (<?php print $pourcent16; ?>%)',
									  '<?php print $libelle17; ?> (<?php print $pourcent17; ?>%)',
									  '<?php print $libelle18; ?> (<?php print $pourcent18; ?>%)',
									  ]);
            hbar1.Set('chart.shadow', true);
            hbar1.Set('chart.shadow.color', '#41453A');
            hbar1.Set('chart.shadow.offsetx', 0);
            hbar1.Set('chart.shadow.offsety', 0);
            hbar1.Set('chart.shadow.blur', 15);
            hbar1.Set('chart.colors', [grad]);
            hbar1.Draw();
        }
    </script>

    <script>
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-54706-2']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
</head>
<body>
        <script>
            // Opera fix
            if (navigator.userAgent.indexOf('Opera') == -1) {
              document.getElementById("social_icons").style.position = 'fixed';
            }
        </script>
        <div id="google_plusone">
            <g:plusone href="http://www.rgraph.net"></g:plusone>
        </div>
    <div id="breadcrumb_changer">
        <a href=""></a>
        <a href=""></a>
       
    </div>
    <h1><span></span></h1>

    <script>
        if (RGraph.isIE8()) {
            document.write('<div style="background-color: #fee; border: 2px dashed red; padding: 5px"><b>Important</b><br /><br /> Internet Explorer 8 does not natively support the HTML5 canvas tag, so if you want to see the charts, you can either:<ul><li>Install <a href="http://code.google.com/chrome/chromeframe/">Google Chrome Frame</a></li><li>Use ExCanvas. This is provided in the RGraph Archive.</li><li>Use another browser entirely. Your choices are Firefox 3.5+, Chrome 2+, Safari 4+ or Opera 10.5+. </li></ul> <b>Note:</b> Internet Explorer 9 fully supports the canvas tag. Click <a href="http://support.rgraph.net/message/rgraph-in-internet-explorer-9.html" target="_blank">here</a> to see some screenshots.</div>');
        }
    </script>
    <p>
    </p>
        <li><a href=""></a></li>
    <a name="gutter-example"></a>
    <canvas id="hbar1" width="1000" height="600">[No canvas support]</canvas>
</body>
</html>