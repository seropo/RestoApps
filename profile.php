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
  session_start();
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
		 $('#biodata input[name=usernameregis]').val('".$valcx->{'namaclient'}."');
		  $('#biodata input[name=passwordregis]').val('".$valcx->{'passwor'}."');
		  $('#biodata textarea[name=alamat]').val('".$valcx->{'alamt'}."');
		  $('#biodata input[name=notelp]').val('".$valcx->{'numberphone'}."');
		  $('#biodata input[type=number]').val('".$valcx->{'kodepost'}."');
	
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
	 <input type="file"name="file"/>
	 
	 </div>
	 <div id="biodata">
	 <form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>"enctype="application/x-www-form-urlencode"name="form"><div id="handler">
	<img src="png/cancx.png"/>
	<img src="png/check_.png"/>
	<img src="png/three-quarters-loader.gif"/>
	Username :<input type="text"name="usernameregis"size="18"maxlength="18"required placeholder="username"disabled="true"/><br/>
<img src="png/cancx.png"/>
	<img src="png/check_.png"/>		<img src="png/three-quarters-loader.gif"/>
	Password : <input type="password"name="passwordregis"size="18"maxlength="18"required placeholder="password"disabled="true"/><br/>
<img src="png/cancx.png"/>
	<img src="png/check_.png"/>	<img src="png/three-quarters-loader.gif"/>
	Alamat : <textarea name="alamat"cols="10"rows="4"disabled="true"></textarea><br/>
<img src="png/cancx.png"/>
	<img src="png/check_.png"/>
	<img src="png/three-quarters-loader.gif"/>
	Nomor Telepon : <input type="text"size="18"maxlength="18"name="notelp"disabled="true"/><br/>
<img src="png/cancx.png"/>
	<img src="png/check_.png"/>
	Kode Post : <input type="number"min="0"name="kodepost"disabled="true"/><br/>

	</div> 
	 
	 </form>
	 <div id="edit">
	 <img src="png/edit.png"/>
	  </div>
	 
	  </div>
	 
	 </div>
	 <br/>
<div id="navigasimenu">
	<ul>
	<li>
	<div id="checkbalance"class="check">
	 <?php 
	
		print_r ($balance=$controller->checkbalance($_SESSION["check"]));

	 ?>
	  </div>
	<img src="png/balancecheck.png"/>
	
	<div id="check"class="balancecheck">
	Check About Your Balance here</div>
	</li>
	 <li>
	<div id="checkbalance"class="refillbalance">
	 <form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>"enctype="application/x-www-form-urlencoded">
	 <label> Isi Pulsa </label> : <input type="number"name="balance"min="0"step="1000"max="1000000"placeholder="input digit balance"required />
   <br/><label> Metode Pembayaran Bank </label> : <br/>
   <input type="radio"name="rekening"value="mandiri"/>Mandiri	
   <input type="radio"name="rekening"value="Bca"/>Bca
	<input type="submit"value="pembayaran"name="pembayaran"/>
	 </form>

	<?php 
	 if(isset($_POST["pembayaran"])){
		if(isset($_POST["balance"]) && isset($_POST["rekening"])){
	$saldo=$_POST["balance"]; $rekening=$_POST["rekening"];
  
	print_r($check=$controller->refillbalance($saldo,$rekening,$_SESSION["check"]));
		}else{
			echo "<script> swal({
				type:'info',
				text:'please input',
			});</script>";
		}
	 }
																						
	 
	

	 ?>
	  </div>
	<img src="png/refill.png"/>
	<div id="check"class="refill">
	This Option To Refill Your Balance</div></li>
	
	<li>
	<div id="checkbalance"class="historybalanc">
	 <?php 
		print_r ($balance=$controller->historybalance($_SESSION["check"]));

	 ?>
	  </div>
	 
	<img src="png/historybalance.png"/>
	<div id="check"class="historybalance">
	This Option To Check History Your Refill Payment</div></li>
	

	<li>
	<img src="png/backupdata.jpg"/>
	<div id="check"class="backupdata">
	This Option To Backup Your Data To Your mail</div></li>
	 </ul>
	
	 </div>	 
	
	   </div> 
	 <div id="validasicx">
	 <ul>
	  <li><img src="png/home.png"/>
	  </li>
	  <li><img src="png/logout.png"/></li>
	  <li></li>
	  </ul>
	 
	 </div>
	   
	  </aside>
	  
	  <footer>
	 
	   </footer>
	 
	 
	 </div>
  </body>


</html>