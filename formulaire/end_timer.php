<?php

$Seconds." Seconds " ;
$time_out=20;
if($Minutes<$time_out){
    $_SESSION['time_start']=$end;
}else{
    
	include('logout.php');
}
?>