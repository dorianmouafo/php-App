<?php session_start();
    $start=time();
    $_SESSION['time_start']=$start;
    /*get the login info & set to session */	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FS HOTEL</title>
<link href="procedure_css/stylelog.css" rel="stylesheet" type="text/css" />
</head>
<?php function verif_connection_pseudo_table($code_pseudo){
return ResultatRequette("select  pseudo as info from utilisateurs where pseudo='$code_pseudo'");
}
function verif_connection_pseudo_and_pass($pseudo,$pass){
return ResultatRequette("select  nom_user as info from utilisateurs where pseudo='$pseudo' AND password='$pass'");
}
?>
<?php function verif_connection_pass_table($code_pass){
return ResultatRequette("select  password as info from utilisateurs where password='$code_pass'");
}
?>
<?php 
	require_once('procedure_php/procedure_globale.php');
	require_once('procedure_php/mysql_requette.php');
	$gCode_utilisateur=$_SESSION["code_code"];
	$pseudo=addslashes($_REQUEST['pseudo']);
	$valpassword=addslashes($_REQUEST['valpassword']);
	if($_POST['btn']=='Connexion'){$v_global=connect;}
	elseif($_POST['btn']=='Deconnexion'){$v_global=deconnect;}
	if (isset($v_global)){
	     if($v_global==connect){ 
		 	if($pseudo==""  AND $valpassword==""){
		    print"<script language='javascript'> alert('Verifier les champs pseudo et password');</script>";
				 // header('location: index.php');
		    }
			elseif($pseudo=="" AND $valpassword!=""){
			print"<script language='javascript'> alert('Verifier les champs pseudo');</script>";
			 //header('location: index.php');
			}
			elseif($pseudo!="" AND $valpassword==""){
			print"<script language='javascript'> alert('Verifier les champs password');</script>";
			 //header('location: index.php');
			}
			elseif($pseudo!="" AND $valpassword!=""){
			             $long_pa=md5($pseudo);
						 $pass_pa=md5($valpassword);
						 $value_pseudo=verif_connection_pseudo_table($long_pa);
						 $value_pass=verif_connection_pass_table($pass_pa);
						 $nom_user_connect=verif_connection_pseudo_and_pass($long_pa,$pass_pa);
                    /*$value_pseudo=verif_connection_pseudo_table($pseudo);
					$value_pass=verif_connection_pass_table($valpassword);*/
					//je cripte les données
					   //$valspeudolog=md5($pseudo);
					   //$valspassword=md5($valpassword);
					   //je verifie les donnees crptee $log et  $pass sont les donnee sous formes cryptes 
					   /*$log=verif_connection_pseudo_table($valspeudolog);
					   $pass=verif_connection_pass_table($valspassword);
					   print $log;
					   print $pass;
					*/
					   
					   // le je passe a la verification des differente possibilité
				if($value_pseudo=="" AND $value_pass=="" ){
				print"<script language='javascript'> alert('Paremtres de connexion incorretes');</script>";
				 //header('location: index.php');
				}
				elseif($value_pseudo!="" AND $value_pass=="" ){
				print"<script language='javascript'> alert('Mot de passe incorrete');</script>";
				 //header('location: index.php');
				}
				elseif($value_pseudo!="" AND $value_pass!="" AND $nom_user_connect!=""){
				print"<script language='javascript'> alert('Bonne connexion');</script>";
				 $_SESSION['login']=$pseudo;
				 $_SESSION['password']=$valpassword;
				 //cette variable de session est pour la verification de connexion pour eviter de se connecter sans etre loge
				 $_SESSION['verification']=1;
				 //la je recupere la valeur du code de utilisateur pour verifier ses droits
				 $_SESSION['code_code']=recupere_id_utilisateur_connexion($value_pseudo,$value_pass);
				 $_SESSION['groupe']=recupere_id_groupeutilisateur_connexion($_SESSION['code_code']);
				           $re=$_SESSION['code_code'];
				 LeMouchard($re,'Connexion a FS');
				 header('location:formulaire/indexv.php');
				}
				elseif($log!="" AND $pass!=""){
					print"<script language='javascript'> alert('yes');</script>";
				
				
				}
			}
        }
		
	}		
?>
<body>
<div id="layer01_holder">
  <div id="left"></div>
  <div id="center"></div>
  <div id="right"></div>
</div>

<div id="layer02_holder">
  <div id="left"></div>
  <div id="center"></div>
  <div id="right"></div>
</div>

<div id="layer03_holder">
  <div id="left"></div>
  <div id="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <center> <tr>
    <td>CONNEXION<br /><br /></td>
  </tr></center>
  <tr>
    <form  method="post" action="index.php">
	<table>
	<tr>
      <td><label>Pseudo</label></td>  
        <td><input name="pseudo" type="text"  value="<?php print $pseudo;?>" /></td>
     </tr>
	 <tr>
     <td> <label>Password  </label> </td>
     <td> <input type="password" name="valpassword" style="margin-top:5px;" value="<?php print $valpassword;?>"  /></td>
      </tr>
	  </table>
      <label>
         <center><input type="submit" name="btn"  value="Connexion" /></center>
	     <!--<input type="submit" name="btn"  value="Deconnexion" />-->
      </label>
    </form></td>
  </tr>
</table>
  </div>
  <div id="right"></div>
</div>

<div id="layer04_holder">
  <div id="left"></div>
  <div id="center">
 Contacter Fire Software si vous avez oublier votre mot de passe <a href="www.firesoftwareonline.com">click here</a></div>
  <div id="right"></div>
</div>

<div id="layer05_holder">
  <div align="left">Copyright © 2011, Fire software Design</div>
</div>
</body>
</html>