<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet"href="css.css"type="text/css"/>
 <link rel="stylesheet"href="lib/sweetalert-master/dist/sweetalert.css"type="text/css"/>
 <script src="config.js"></script>
 <script src="lib/jquery-3.1.0.min.js"></script>
 <script src="configuration.js"></script>
 <script src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
 <script src="lib/gmaps-master/gmaps.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD95vfD_2QmWzDzZkKJfdURA1qZyzlb1JI&callback=maps"></script>	
 <?php require_once("controller.php");
 
 $controller=new controller();
 $controller->conection();
 session_start();
 if(!isset($_SESSION["check"])){
echo"<script>
			$(document).ready(function(){
					$('#paket-makanan').find('li').children().on('click',function(){
			
			swal({
				 type:'warning',
				 title:'please login ',
				 text:'Mohon Maaf Perlu Login '
			 });
			});
			});		
			 </script>";

 }else{
	
	echo"<script>
		
			$(document).ready(function(){
				$('#login').fadeOut(1000);
			$('#register').fadeOut(1000);			
			$('#menu').find('li').eq(1).fadeIn(1000);
					$('#paket-makanan').find('li').on('click',function(){  
  });
  
			});		
			 </script>";
	 
 }
	 
 
 if(!isset($_POST["username"])&&
 !isset($_POST["password"])&&
 !isset($_POST["usernameregis"])&&
 !isset($_POST["passwordregis"])&&
 !isset($_POST["notelp"])&& !isset($_POST["namamakanan"]) && isset($_POST["jumlahmakanan"]) && !isset($_POST["uang"]) &&
!isset($_POST["jekel"])&&!isset($_POST["alamat"])&&!isset($_POST["kodepost"])){
	echo"<script>
			$(document).ready(function(){
				$('#menu').find('li').eq(1).css({'display':'none'});
				
				$('#menu').find('li').eq(2).css({'display':'none'});
				$('#menu').find('li').eq(3).css({'display':'none'});
				$('#menu').find('li').eq(4).css({'display':'none'});
				
				$('#menu').find('li').eq(5).css({'display':'none'});
				
				$('#menu').find('li').eq(6).css({'display':'none'});
				
				
			});
			
			 </script>"; 
 }else if(isset($_POST["username"])&&isset($_POST["password"])){
		$username=$_POST["username"];
		$password=$_POST["password"];
	$login= $controller->login($username,$password); 
	 $login_result=json_decode($login);
	 
	if($login_result->{"namaclient"}==$username || $login_result->{"passwor"}==$password){
		
		print_r($_SESSION["check"]=$login_result->{"identitas_client"});
	
		echo"<script>
			$(document).ready(function(){
				$('#cx').fadeOut(1000);
				$('#register_tick_function').fadeOut(1000);
			
			
			 </script>";
		}else if($login==false){
		echo"<script>
			$(document).ready(function(){
				swal({
					type:'warning',
					text:'Please Check Login',title:'Login'
				});
 });
				
			});
			
			 </script>";
		}
		 


	}else if(isset($_POST["usernameregis"])||
 isset($_POST["passwordregis"])||
 isset($_POST["nomorhp"])||
isset($_POST["jekel"])||isset($_POST["alamat"])||isset($_POST["kodepost"])){
	 $usernameregis=$_POST["usernameregis"];
	 $passwordregis=$_POST["passwordregis"];
	 $nomorhp=$_POST["notelp"];
	 $jekel=$_POST["jekel"];
	 $alamat=$_POST["alamat"];
	 $kode_post=$_POST["kodepost"];
	 
	$regis= $controller->register($usernameregis,$passwordregis,
	 $nomorhp,$jekel,$alamat,$kode_post,1);
	 if($regis==true){
		 echo"<script> swal({
			 'type':'info',
			 'title':'register'
			 
		 });</script>";
		 
	 }else{
		 
	 }
 }
 
if(isset($_POST["order"])){
	$total=$controller->keuangan($_SESSION["check"]);
	if($total==0){
		echo "<script>
		swal({
			'type':'info',
			'text':'Please Refill ',
			'title':'Your Blanace Empty'
			
		});
		 </script>";
	}else{
		$order=$_POST["order"];
		$controller->pembayaran($_SESSION["check"],$total);
		echo "balance ".$total;
	
		echo $controller->non_Exist($_SESSION["check"],$order);
	
	}
}else{
	
}
 
 ?>
 </head>
 <body>
  <div id="kerangka">
   <header>
    <div id="header_banner">
	
	 
	  </div>
	  <div id="search">
	  
	   </div>
	   
   
    </header>
	<nav><br/>
	 <div id="menu">
	 <ul>
	  <a href="home.php">
	   <li>HOME</li> </a>
	  <?php if(isset($_SESSION["check"])){
		 if($_SESSION["check"]!=0 || $_SESSION["check"]!=""){	 echo"<script>
			$(document).ready(function(){
				$('#menu').find('li').eq(1).fadeIn(1000);
				
				
			});
			
			 </script>";
			 
			 echo '<a href="profile.php?passing='.$_SESSION["check"].'">
	   <li>PROFILE</li>
	   </a>';
}else{	 echo"<script>
			$(document).ready(function(){
				$('#menu').find('li').eq(1).fadeOut(1000);				
				
			});
			
			 </script>";
}
  
  
	  }	
?>	  <a href="makanan.php"><li>MAKANAN</li>
</a>	 <a href="minuman.php"> <li>MINUMAN</li> </a>
<li class="aboutus">about Us</li>
<li class="contact"> Contact </li>
	  </ul>
	 </div>
	
	 </nav>
	 <div id="check">
	 </div>
	 
	 <aside>
	 <div id="body">
	  <div id="slide-image">
	  
	   </div><br/>
	   <div id="paket-makanan">
	   <?php
	   isset($_GET["page"]) ?
	   $page=$_GET["page"] :$page=0;
	   echo $controller->checkmakanan($page);
	    ?>
	   
	     </div>   <div id="paketminuman">
	  <?php
	   isset($_GET["page"]) ?
	   $page=$_GET["page"] :$page=0;
	   echo $controller->checkminuman($page);
	  
	   ?>
	   
	   
	     </div>
		
	 
	 
	   </div>  <div id="cxcx">
	   <div id="login">
	   <span>login</span>
	  
	    </div> <div id="form-login">
	    <form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>"enctype="application/x-form-urlencode">
		USERNAME : <input type="text"name="username"size="18"maxlength="18"required placeholder="username"autocomplete="off"required/>
		Password : <input type="password"name="password"size="18"maxlength="18"required placeholder="password"autocomplete="off"required/>
		<input type="submit"name="submit"/>
		</form>
	   
	   
	    </div>
		<div id="register">
		<span>register</span>
		 </div>
	   </div>
	   <div id="keranjang">
	   <img src="png/shoppingcart.jpg"/>
	    </div>
	 <div id="keranjangpesan">
	 <div id="kerangkakeranjang">
	 <?php
	 if(isset($_SESSION["check"])){
		 $val=$_SESSION["check"];
	echo $controller->keranjang($val);

	isset($_POST["deleteAllmakanan"]) ?
	$controller->deleteAllmakanan($_SESSION["check"]) : "";
	
	 }else{
		 
		 echo "Please Check Your not laper";
	 }
	 
	 ?>
	 
	  </div>
	 
	  </div>
	  <div id="page">
	  <?php 
	echo $controller->page();
	   ?>
	   </div>
	  </aside>
	  
	  <footer>
	  
	   </footer>
   <div id="black-transpare">
    </div> <div id="register_tick_function">
<div id="btn-cloes"><span>X</span></div>
  	<div id="_cx">
	<form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>"enctype="application/x-www-form-urlencode">
	Username :<input type="text"name="usernameregis"size="18"maxlength="18"required placeholder="username"autocomplete="off"/><br/>
	Password : <input type="password"name="passwordregis"size="18"maxlength="18"required placeholder="password"autocomplete="off"/><br/>
	Alamat : <textarea name="alamat"value=""cols="10"rows="4"autocomplete="off"></textarea><br/>
	Nomor Telepon : <input type="text"size="18"maxlength="18"name="notelp"autocomplete="off"/><br/>
	Kode Post : <input type="number"min="0"name="kodepost"autocomplete="off"/><br/>

	Jenis Kelamin : <input type="radio"name="jekel"value="L"autocomplete="off"/>Laki Laki
					<input type="radio"name="jekel"autocomplete="off"value="P"/>Cewe

	<br/><input type="reset"name="reset"/><br/><input type="submit"name="submit"/>
  </form>		
		</div> 
	</div>
	
	<div id="pesanan">
	<form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>"enctype="application/x-www-form-urlencode">
	Nama Makanan : <input type="text"name="namamakanan"size="18"placeholder="nama makanan"id="namamakan"required /><br/>
	 Jumlah Pemesanan : <input type="number"name="jumlahmakanan"id="jumlah"required/><br/>

	 <input type="submit"name="submitmakanan"value="Keranjang"onsubmit="makanan(document.getElementById('namamakan').value,document.getElementById('jumlah').value)"/>
	
</form>
    
	Harga Total  <div id="value"> </div>
	 </div>
   <div id="aboutus">
   <img src="png/aboutus.jpg"/>
    <div id="maps">  <?php
	   isset($_POST["page"]) ?
	   $page=$_POST["page"] :$page=0;
	   echo $controller->checkmakanan($page);
	   
	   ?>
	<script>
	maps();
	</script>
	  </div>
    </div>
	<div id="contact">
	<img src="png/contact.png"/>
	
	 </div>
	 
	 </div>
  </body>


</html>