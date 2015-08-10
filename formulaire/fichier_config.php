<?php 
session_start();
if($_SESSION['verification']==1){  
    $end=time();
    include("start_timer.php");
    include("end_timer.php");
	//print $_SESSION['verification'];
/*    session variables like user login info ..    */
}
elseif($_SESSION['verification']==2 OR $_SESSION['verification']=="" ){
header('location:../index.php');
}
?>