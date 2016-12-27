<?php

isset($_GET["identitas"]) ?
 cx($_GET["identitas"]) : 
 print_r("cxcx");

function cx($identitas){
	$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
 $sql="delete from makanan where identitas_makanan='".$identitas."';";
 $mysql=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
 $mysql ?
 $cx="<div id='unchecked'> </div>" : $cx="cxcx";
 
 return $cx;
}

?>