<html>
<body>
<form name="cadre">
<table >
    <tr><td><div align="right"><font class="T2"><?php print LANGELE10?> : </font></div></td>
        <td><input type="text" name="saisie_date_naissance" >
	<?php
	include_once("../calendrierphp/calendar.php");
	calendarpopupDim('id1','document.cadre.saisie_date_naissance',"fr","1","0");
	?>
 </td>
    </tr>
    </table>
    </form>
    </body>
    </html>

