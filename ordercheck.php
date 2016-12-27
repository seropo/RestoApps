<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet"href="css.css"type="text/css"/>
 <link rel="stylesheet"href="lib/sweetalert-master/dist/sweetalert.css"type="text/css"/>
 <script src="config.js"></script>
 <script src="lib/jquery-3.1.0.min.js"></script>
 <script src="configuration.js"></script>
 <script src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
 <?php require_once("controller.php");
 $controller=new controller();
 $controller->conection();
  session_start();if(isset($_GET["makanpesan"])){
	$identitas_makanan=$_GET["makanpesan"];
	$jcode=$controller->makananlistcheck($identitas_makanan);
	$cx=json_decode($jcode);
	$_SESSION["namamakanan"]=$namaproduct=$cx->{"namaproduct"};
$_SESSION["SAVE"]=$harga=$cx->{"hargaproduct"};
	$kategori=$cx->{"kategoricx"};
	$deskripsi=$cx->{"deksripsiproduct"};
}else{
	$identitas_makanan=0;
	$cx="";
	$namaproduct="";
	$harga=0;
	$deskripsi="";
	$kategori="";
	$image="";
}
 if($kategori=="Makanan"){
	 $image="png/makanan/".$cx->{"gambar"};
 }else if($kategori=="Minuman"){
	 $image="png/minuman/".$cx->{"gambar"};
 }
 if(isset($_POST["order"])){
	 $jumlah=$_POST["jumlah"];
	 $total=$_SESSION["SAVE"]*$jumlah;
	isset($_SESSION["check"])?
	$val=$_SESSION["check"] : $val="1";

	$cx=$controller->pesanmakanan($val,$_SESSION["namamakanan"],$jumlah,$total);
  
  if($cx==true){
		echo"<script>
		swal({'type':'info',
		'text':'Check Your Box',
		'title':'Check Menu '
		});
		
		 </script>";

	  }else{
		  echo"<script>swal({
			  type:'info',
			  title:'please login',
			  text:'want to order please login '
		  });</script>";
		  
	  }
 }

 if(isset($_SESSION["check"])){
		$js=$controller->profile($_SESSION["check"]);
		$valcx=json_decode($js);

	echo"<script> 
	 $(document).ready(function(){	
	$('#black-transpare').css({
 'margin-Top':'-180%',
 'z-index':'1000000000',
 'position':'absolute'
 
 
 }).fadeIn(1000); 
	$('body').css({'overflow':'hidden'});
	 $('#photo').append('<img src=".$image." alt=cx height=400px width=480px/>');
		 $('#biodata input[name=namamakanan]').val('".$namaproduct."');
		  $('#biodata textarea[name=deskripsi]').val('".$deskripsi."');
		  $('#biodata input[name=harga]').val('".$harga."');
 $('#biodata input[name=jumlah]').on('keyup mouseup',function(){

 $('#value').text($(this).val() *".$harga.");
  });	
	 $('#validasicx').find('li').eq(1).on('click',function(){
	
	if(".$_SESSION["check"]." ==''){
		 window.location=home.php;
	 }else{
		 window.location=home.php;
	 }

	 });
	 
	 });
	 
	 </script>";
 }else{
	$_SESSION["check"]=$_GET["passing"];
	
	 
 }
 
 ?>
 </head>
 <body>
  <div id="kerangkaprofile">
 
	 
	 <aside>
	 <div id="bodyprofile">
	 <div id="listprofile"><br/>
	 <div id="photo">
	 
	 </div>
	 <div id="biodata">
	 <form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>"enctype="application/x-www-form-urlencode"name="form"><div id="handler">
	Nama Makanan :<input type="text"name="namamakanan"size="18"maxlength="18"required placeholder="username"disabled="true"/><br/>
	Deskripsi : <textarea name="deskripsi"cols="10"rows="4"disabled="true"></textarea><br/>
	Harga : <input type="text"size="18"maxlength="18"name="harga"disabled="true"/><br/>

	Jumlah : <input type="number"min="0"name="jumlah"/><br/>

	</div> 
	 <input type="submit"name="order"value="Keranjang"/>
	 </form>
	<div id="value"> </div>
	 
	  </div>
	 
	 </div>
	 <br/>
	   
	  </aside>
	  
	  <footer>
	  <div id="validasicx">
	 <ul>
	  <li><img src="png/home.png"/>
	  </li>
	  <li><img src="png/logout.png"/></li>
	  <li></li>
	  </ul>
	 
	 </div>
	   
	   </footer>
	 
	 
	 </div>
  </body>


</html>