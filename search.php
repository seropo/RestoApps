<?php
require("controller.php");
$controller=new controller();
$controller->conection();

isset($_GET["makanan"]) ?
$makanan=$_GET["makanan"] : $makanan="Makanan Berat";

isset($_GET["page"]) ?
$page=$_GET["page"] :$page=0;
echo $controller->search($page,$makanan);




?>