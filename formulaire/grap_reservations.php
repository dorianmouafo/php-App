<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
   
    <title>Statistique des reservations</title>
    
    <meta name="keywords" content="rgraph html5 canvas example donut charts" />
    <meta name="description" content="RGraph: Javascript charts library -  Donut charts examples" />
    
    <meta property="og:title" content="RGraph: Javascript charts library" />
    <meta property="og:description" content="A charts library based on the HTML5 canvas tag" />

    <meta property="og:image" content="http://www.rgraph.net/images/logo.png"/>

    <link rel="stylesheet" href="css/website.css" type="text/css" media="screen" />
    <link rel="icon" type="image/png" href="images/favicon.png">
    
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

    <script src="libraries/RGraph.common.core.js" ></script>
    <script src="libraries/RGraph.common.context.js" ></script>

    <script src="libraries/RGraph.common.annotate.js" ></script>
    <script src="libraries/RGraph.common.tooltips.js" ></script>
    <script src="libraries/RGraph.common.zoom.js" ></script>
    <script src="libraries/RGraph.pie.js" ></script>
    <script>
	<?php
	 require_once('../procedure_php/procedure_globale.php');
     require_once('../procedure_php/mysql_requette.php');
	
	          $date1cc=$_SESSION['debut_reserve'];
	          $date2cc=$_SESSION['fin_reserve'];
	          print  $date1cc;
	          print  $date2cc;
	
	    $nb_total=recupere_total_type_chambre();
	     print $nb_total;
	    $nb1='10';
        $nb2='11';
        $nb3='12';
		
       $val1=recupere_type_un($nb1);
       $val2=recupere_type_deux($nb2);
       $val3=recupere_type_trois($nb3);
	   
	   
	   
	   
	   $lib1=recupere_libelle_type_un($nb1);
	   $lib2=recupere_libelle_type_deux($nb2);
	   $lib3=recupere_libelle_type_trois($nb3);
	   
	   
	   
	  $pourcent1=ceil(($val1*100)/$nb_total);
	  $pourcent2=ceil(($val2*100)/$nb_total);
	  $pourcent3=ceil(($val3*100)/$nb_total);
	?>
	
        window.onload = function ()
        {
            var donut = new RGraph.Pie('donut1', [<?php print $val1; ?>,
			                                      <?php print $val2; ?>,
												  <?php print $val3; ?>
												  ]);
            donut.Set('chart.variant', 'donut');
            donut.Set('chart.linewidth', 5);
            donut.Set('chart.strokestyle', 'white');
            donut.Set('chart.title', "Types de chambres les plus reservees");
            donut.Set('chart.key', [ '<?php print $lib1; ?> (<?php print $pourcent1; ?>%)',
               			             '<?php print $lib2; ?> (<?php print $pourcent2; ?>%)', 
									 '<?php print $lib3; ?> (<?php print $pourcent3; ?>%)']);
            donut.Set('chart.key.shadow', true);
            donut.Set('chart.key.shadow.offsetx', 0);
            donut.Set('chart.key.shadow.offsety', 0);
            donut.Set('chart.key.shadow.blur', 15);
            donut.Set('chart.key.shadow.color', '#ccc');
            donut.Set('chart.key.position', 'graph');
            donut.Set('chart.align', 'left');
            donut.Draw();


            function getGradient(obj, color)
            {
                var gradient = obj.context.createRadialGradient(obj.canvas.width / 2, obj.canvas.height / 2, 0, obj.canvas.width / 2, obj.canvas.height / 2, 200);
                gradient.addColorStop(0, 'black');
                gradient.addColorStop(0.5, color);
                gradient.addColorStop(1, 'black');
                
                return RGraph.isIE8() ? color : gradient;
            }

            /*var donut2 = new RGraph.Pie('donut2', [8,6,5,3,8,9,9,4]);
            
            // Create the gradients
            var gradient = getGradient(donut2, 'red');
            var gradient2 = getGradient(donut2, 'green');
            var gradient3 = getGradient(donut2, 'pink');
            var gradient4 = getGradient(donut2, 'yellow');
            var gradient5 = getGradient(donut2, 'grey');
            var gradient6 = getGradient(donut2, 'cyan');
            var gradient7 = getGradient(donut2, 'red');
            var gradient8 = getGradient(donut2, '#ddd');
            var gradient9 = getGradient(donut2, 'blue');

            donut2.Set('chart.variant', 'donut');
            donut2.Set('chart.labels', ['Flipper', 'Harry', 'Ben', 'Richard', 'Keith', 'Ben', 'George', 'Barry']);
            donut2.Set('chart.title', "Sales figures for week 43");
            donut2.Set('chart.gutter.left', 35);
            donut2.Set('chart.gutter.right', 35);
            donut2.Set('chart.strokestyle', 'rgba(0,0,0,0)');
            donut2.Set('chart.colors', [gradient, gradient2, gradient3, gradient4, gradient5, gradient6, gradient7, gradient8, gradient9]);
            donut2.Draw();*/
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

        <div id="social_icons" class="warning" style="border-radius: 10px; top: 1px; position: fixed; width: 175px; height: 20px">
            <a title="Bookmark with delicious" href="http://delicious.com/save?jump=close&v=4&noui&jump=close&url=http://www.rgraph.net&notes=RGraph%20is%20a%20HTML5%20based%20javascript%20charts%20library%20supporting%20a%20wide%20range%20of%20different%20chart%20types&title=RGraph:%20Javascript%20charts%20%26%20graph%20library" target="_blank"><img src="..images/delicious.png" alt="" width="22" height="22" border="0" style="position: relative; top: 1px" /></a>
            <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.rgraph.net" data-count="none" data-via="_RGraph"></a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

            <iframe src="http://www.facebook.com/plugins/like.php?app_id=253862424642173&amp;href=http%3A%2F%2Fwww.rgraph.net&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="width: 80px; height:21px; position: relative; top: 1px"></iframe>
        </div>

        <script>
            // Opera fix
            if (navigator.userAgent.indexOf('Opera') == -1) {
              document.getElementById("social_icons").style.position = 'fixed';
            }
        </script>
        
        <div id="google_plusone">
            <!-- Place this tag where you want the +1 button to render -->
            <g:plusone href="http://www.rgraph.net"></g:plusone>
        </div>

    <!-- Social networking buttons -->

<div id="breadcrumb">
    <a href=""></a>
    
    <a href=""></a>
   
</div>

<h1> <span></span></h1>

    <script>
        if (RGraph.isIE8()) {
            document.write('<div style="background-color: #fee; border: 2px dashed red; padding: 5px"><b>Important</b><br /><br /> Internet Explorer 8 does not natively support the HTML5 canvas tag, so if you want to see the charts, you can either:<ul><li>Install <a href="http://code.google.com/chrome/chromeframe/">Google Chrome Frame</a></li><li>Use ExCanvas. This is provided in the RGraph Archive.</li><li>Use another browser entirely. Your choices are Firefox 3.5+, Chrome 2+, Safari 4+ or Opera 10.5+. </li></ul> <b>Note:</b> Internet Explorer 9 fully supports the canvas tag. Click <a href="http://support.rgraph.net/message/rgraph-in-internet-explorer-9.html" target="_blank">here</a> to see some screenshots.</div>');
        }
    </script>

    <div>

        <p>
        </p>

        <div>
            <ul>

                <li></li>
            </ul>
        </div>

        <div>
            <canvas id="donut1" width="430" height="350">[No canvas support]</canvas>
            <canvas id="donut2" width="450" height="350">[No canvas support]</canvas>
        </div>

    </div>


</body>
</html>