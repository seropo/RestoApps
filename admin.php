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
 if(isset($_POST["nameproduct"])&&isset($_FILES["file"])||
 isset($_POST["deskripsiproduct"])&&
 isset($_POST["hargaproduct"])&&isset($_POST["kategori"])){
	
	 $typefile=pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
		$namafile=$_FILES["file"]["name"];$tmpname=$_FILES["file"]["tmp_name"];
		$size=$_FILES["file"]["size"];
		$namaproduct=$_POST["nameproduct"];
		$deskripsiproduct=$_POST["deskripsiproduct"];
		echo $hargaproduct=$_POST["hargaproduct"];
		$kategori=$_POST["kategori"];
	$katec="check";
	if($kategori=="Makanan Ringan" || $kategori=="Makanan Berat"){
		 $katec="Makanan";
	move_uploaded_file($tmpname,"png/makanan/".$namafile);
		
	 }else if($kategori=="Minuman Dingin" || $kategori=="Minuman Hangat"){
		  $katec="Minuman";
		 	move_uploaded_file($tmpname,"png/minuman/".$namafile);

	 }
	$size >5000?
	$size_file=$_FILES["file"]["size"] : $size_file=0;
	
	
	$product=$controller->inputproduct($katec,$tmpname,$typefile,$namafile,$size_file,$namaproduct,$deskripsiproduct,$hargaproduct,$kategori);
   if($product==true){
   echo "<script>
   swal({
	   'type':'info',
	   'title':'Product',
	   'text':'product input'
	   
	   
   });
   
    </script>";

   
   }else{
 echo "<script>
   swal({
	   'type':'warning',
	   'title':'Product',
	   'text':'productcx '
	   
	   
   });
   
    </script>";
	   
   }
 }else{
 }
 
 if(isset($_POST["delete"])){
	$checks=$controller->deleteall();
	 if($checks==true){
		 echo"<script>
		  swal({
			  'type':'success',
			  'text':'check ',
			  'title':'sucess'
		  });
		  </script>";
	 }else{
		 	echo"  swal({
			  'type':'info',
			  'text':'check ',
			  'title':'hmm'
		  });
		  </script>";
	
	 }
 }
 
 
 
 ?>
 </head>
 <body class="administrator">
  <div id="kerangkaadmin">
     <div id="cover">
	 <nav>
		<div id="menucontrol">
		<ul>
		<li>Control </li>
		<li>Backup Database</li>
	  </ul>
		</nav>
		
		</div>
		<aside>
	   
		<div id="controllingpost">
		<form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>"enctype="multipart/form-data">
			Gambar Postingan : <input type="file"name="file"required/>
			Nama Product : <input type="text"name="nameproduct"size="19"maxlength="19"autocomplete="off"required placeholder="Nama Product"/><br/>
			Deskripsi Product : <textarea name="deskripsiproduct"cols="19"rows="4"placeholder="Deskripsi Product"autocomplete="off"required> </textarea><br/>
			Harga Product :<input type="number"name="hargaproduct"min="0"max="1000000"step="500"required autocomplete="off"/></br>
			Kategori Product : <select name="kategori"required>
								<option value="Makanan Berat"> Makanan Berat </option>
								<option value="Makanan Ringan"> Makanan Sehat </option>
								<option value="Minuman Dingin"> Minuman Dingin </option>
								<option value="Minuman Hangat"> Minuman Hangat </option>
							</select>
	<input type="submit"name="submitposting"value="posting Makanan"/>	
		</form>
		</div><div id="panelcontrol">
		<div id="update">
		<?php
		 echo $controller->values();
		 
		 ?>
		
		 
		 </div>
		 
	</div><div id="delete">
	<form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>"enctype="application/x-www-form-urlencoded">
   <input type="submit"name="delete"value="delete all"/>
	 </form>
	 
		  </div>
		<div id="backupdatabase">
		
		</div>
		</aside>
	</div>
	  
	 
	 
	  
	  <footer>
	 
	   </footer>
	 
	 
	 </div>
  </body>


</html>