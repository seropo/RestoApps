<?php

class controller{
	function __construct(){
date_default_timezone_get('ASIA/JAKARTA');
		
	if(isset($_GET["identitas"]) && isset($_GET["name"]) || isset($_GET["value"])){
			$identitas=$_GET["identitas"];
			$name=$_GET["name"];
			$value=$_GET["value"];
			update($identitas,$name,$value);
		}else{
		}
	
	}
	function conection(){
		$conection=new mysqli("localhost","root","","RESTOapps") or die("somethting ".mysqli_connect_error());
		
	}function biodata($username){
		
		
	}function checkbalance($check){
		$conection=new mysqli("localhost","root","","RESTOapps") or die("somethting ".mysqli_connect_error());
	   $cx;$sql="select balance from balance where identitas_client='".$check."';";	
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));		
		if(mysqli_num_rows($query)>0){
			
		if($query){
			
			while($result=mysqli_fetch_assoc($query)){
				$cx="Your Balance : ".$result["balance"];
			}
		}else{
			$cx="cx";
		}
	}else{
		$cx="Please Refill Balance Your never pay a balance";
	}
		return $cx;
	}function refillbalance($value,$rekening,$check){
 $time=new DateTime();
 

	$conection=new mysqli("localhost","root","","RESTOapps") or die("somethting ".mysqli_connect_error());
	   $cx;$sql="select balance from balance where identitas_client='".$check."';";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
	if(mysqli_num_rows($query)>0){
			
		if($query){
			
			while($result=mysqli_fetch_assoc($query)){
				$cx="Your Balance Good";
				if($result["balance"]!=0){
					$last_value=$result["balance"]+$value;
					$sql="update balance set balance='".$last_value."' where identitas_client='".$check."';";
					$mysql=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
					$cx="check balance Your balance good";
				}
			}
		}else{
			$cx="cx";
		}
	}else{
         $sql="insert into balance values('','".$value."','".$check."','".$rekening."','". $time->format("Y-m-d H:i:s")."');";
	    $query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));		
		$cx="Check Balance";
		}
		return $cx;
	}function page(){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$sql="select * from product;";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$counting=mysqli_num_rows($query);
		if($counting >0){
		
			$page=ceil($counting/10);
			$cxcx=$page-1;
			$cx='<ul>
			<a href="home.php?page='.$page.'">
			<li class="nextpage">1</li></a>
			<li class="selection"></li>
			<a href="home.php?page='.$cxcx.'"><li class="prevpage"></li></a>
			</ul>
	';
		}
		return $cx;
		
		
	}
	function inputproduct($katecx,$tmpname,$typefile,$namafile,$size_file,$namaproduct,$deskripsiproduct,$hargaproduct,$kategori){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$cx;
	
		$sql="insert into product values('','".$namaproduct."','".$hargaproduct."','".$kategori."','1','".$namafile."','".$typefile."','".$size_file."','".$tmpname."','".$katecx."','".$deskripsiproduct."');";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$query ?
		$cx=true :$cx=false;
		
		return $cx;
		}function deleteall(){
			$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
			$cx;$sql="delete from product;";
			$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
			$query==true ?
			$cx=true :$cx=false;
			
		return $cx;
		}
	function historybalance($check){
		$conection=new mysqli("localhost","root","","RESTOapps") or die("somethting ".mysqli_connect_error());
	   $cx;$sql="select balance,time from balance where identitas_client='".$check."';";
	   $query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));		
	if(mysqli_num_rows($query)>0){
			
		if($query){
			
			while($result=mysqli_fetch_assoc($query)){
				$cx="balance :".$result["balance"]."<br/>";
				$cx.="time : ".$result["time"];
				
			}
		}else{
			$cx="cx";
		}
	}else{
		$cx="Please Refill Balance Your never pay a balance";
	}
		return $cx;
	}
	function search($page,$values){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$sql="select * from product where kategoriproduct='".$values."'limit ".$page.",10;";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$counting=mysqli_num_rows($query);
		$page=ceil($counting/10);
		$cx="";$i=0;
		$makanan;
	if($counting > 0){
    	if($query){
		$cx="<ul>";    
			if($values=="Makanan Ringan" || $values=="Makanan Berat"){
			$makanan="makanan";
			}else if($values=="Minuman Dingin" || $values="Minuman Hangat"){
			$makanan="minuman";
			}
	
		while($res=mysqli_fetch_assoc($query)){
				$cx.="<li>
		<div id='title'>".$res["namaproduct"]."
		</div>
		
		 <img src='png/".$makanan."/".$res["gambar"]."'alt='cx'/>
		 
	  <div id='page-label'>
			Harga :".$res["hargaproduct"]."
	 </div>
		  </li>";
		  }
		$cx.="</ul>";
	$cx.="<div id='pagelisting'><ul>";		
	do{
		$cx.="<a href='makanan.php?makanan=".$page."'>
		<li>".$page."</li></a>";	
		$i++;
		}while($i<=0);
		$cx.="</ul></div>";
	
		}else{
		 $cx="cx";
		 
			
		}
	}else{
		echo"Sorry Not Found";
		
	}
		return $cx;
										
		}function makananlistcheck($identitas_makanan){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$sql="select * from product where identitas_product='".$identitas_makanan."';";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$counting=mysqli_num_rows($query);
		
		$cx="";
	if($counting > 0){
    	if($query){
		while($res=mysqli_fetch_assoc($query)){
		$cx=json_encode($res);
		  }
			
	}else{
		$cx="cx";
		
		}
	}else{
		$cx="check";
	}
		return $cx;

		}
	function values(){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$cx;
		$sql="select * from product;";
		$query=mysqli_query($conection,$sql) or die("something".mysqli_error($conection));
		$counting=mysqli_num_rows($query);
		if($counting >0){
			if($query){
			$cx="<table><tr><th>Nama Product </th>";
			$cx.="<th>Harga Product </th>";
			$cx.="<th>Kategori Product </th>";
			$cx.="<th>Jenis Product </th></tr>";
			while($res=mysqli_fetch_assoc($query)){
				$cx.="<tr><td>".$res["namaproduct"]."</td>";
				$cx.="<td>".$res["hargaproduct"]."</td>";
				$cx.="<td>".$res["kategoriproduct"]."</td>";
				$cx.="<td>".$res["kategoricx"]."</td></tr>";
				
			}$cx.="</table>";
			
			}
		}else{
			$cx="Input ";
		}
		return $cx;
	}
	function checkmakanan($page){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$sql="select * from product where kategoricx='Makanan'  order by kategoricx DESC limit ".$page.",10;";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$cx="talktoadmin";
		if($query){
			if(!isset($_SESSION["check"])){
				echo "<script>
				$('#paket-makanan ul a').click(function(cx){
					cx.preventDefault();
				});
				</script>";
			}
		$cx="<ul>";    
	
			while($res=mysqli_fetch_assoc($query)){
				
			$cx.="<a href='ordercheck.php?makanpesan=".$res["identitas_product"]."'><li>
		<div id='title'>".$res["namaproduct"]."
		</div>
		
		 <img src='png/makanan/".$res["gambar"]."'alt='cx'/>
		 
	  <div id='page-label'>
			Harga :".$res["hargaproduct"]."
	 </div>
		  </li></a>";
		  }
		$cx.="</ul>";
		}
		return $cx;
	}function checkminuman($page){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$sql="select * from product where kategoricx='minuman' limit ".$page.",10;";
		$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$cx="talktoadmin";
		if($query){
			if(!isset($_SESSION["check"])){
				echo "<script>
				$('#paket-makanan ul a').click(function(cx){
					cx.preventDefault();
				});
				</script>";
			}
		$cx="<ul>";    
	
			while($res=mysqli_fetch_assoc($query)){
				
				$cx.="<a href='ordercheck.php?makanpesan=".$res["identitas_product"]."'><li>
		<div id='title'>".$res["namaproduct"]."
		</div>
		
		 <img src='png/minuman/".$res["gambar"]."'alt='cx'/>
		 
	  <div id='page-label'>
			Harga :".$res["hargaproduct"]."
	 </div>
		  </li></a>";
		  }
		$cx.="</ul>";
		}
		return $cx;
	}
	function register($usernameregis,$passwordregis,$nomorhp,$jekel,$alamat,$kode_post,$konfirmasi){
		$conection=new mysqli("localhost","root","","RESTOapps") or die("somethting ".mysqli_connect_error());
		$cx=false;
		$sql="insert into client values('','".$usernameregis."','".$alamat."','".$nomorhp."','".$passwordregis."','1','".$konfirmasi."','".$kode_post."','".$jekel."');";
		$query=mysqli_query($conection,$sql) or die("something wrong ".mysqli_error($conection));
 		if($query){
			return true;
		}else{
			return false;
		}
		return $cx;
	}function login($username,$passwor){
		$conection=new mysqli("localhost","root","","RESTOapps");
		
		$cx=false;
		$sql="select identitas_client,namaclient,passwor from client where namaclient='".$username."' and passwor='".$passwor."';";
		$mysql=mysqli_query($conection,$sql);
		if($mysql){
			while($res=mysqli_fetch_assoc($mysql)){
			if($res["namaclient"]==$username && $res["passwor"]==$passwor){
				 $cx=json_encode($res);
			}else{
				$cx=false;
			}
		 }
		}else{ 
		die("something ".mysqli_error($conection));
		}
		
		
		return $cx;

}function loginadministrator($username,$password){
	
	$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
	$cx=false;
	$sql="select namaadmin,password from administrator where namaadmin='".$username."' and password='".$password."';";
  $query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
  if($query){
	while($result=mysqli_fetch_assoc($query)){
		$namaadmin=$result["namaadmin"];
		$password_=$result["password"];
	if($namaadmin==$username && $password_==$password){
			$_SESSION["administrator"]=$result["namaadmin"];
			$cx=true;
		}else{
			$cx=false;
		}
  
	}
	
  }
return $cx;  
}
function update($resource,$name,$value){
		$conection=new mysqli("localhost","root","","RESTOapps");
		$sql="update client set ".$name."='".$value."'where identitas_client='".$resource."';";
	$cx="";	$mysqli=mysqli_query($conection,$sql) or die("something ".mysqli_error());
		if($mysqli){
		$sql="select ".$name."from client where ".$name."='".$value."';";	
	$mysql=mysqli_query($conection,$sql) or die("something".mysqli_error());
	 if($mysql){
		 while($res=mysqli_fetch_assoc($mysql)){
			$cx=$res[$name];
		 }
		 return $cx;
		 
	 }else{
		 return $cx;
	 }
		}else{
			return $cx;
		}
		return $cx;
}function pesanmakanan($identitas_client,$namamakanan,$jumlah,$harga){
		$conection=new mysqli("localhost","root","","RESTOapps") or die("somethting ".mysqli_connect_error());
		$cx=false;
		$sql="set foreign_key_checks=0;";
		$sql.="insert into makanan values('','".$identitas_client."','".$namamakanan."','".$jumlah."','".$harga."');";
		$query=mysqli_multi_query($conection,$sql) or die("something wrong ".mysqli_error($conection));
 		if($query){
			return $cx=true;
		}else{
			return $cx=false;
		}
		return $cx;
	
	
	
}function pembayaran($identitas,$total){
	$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
	$sql="update balance set balance='".$total."' where identitas_client='".$identitas."';";
	$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
	
}function keuangan($identitas){
		$conection=new mysqli("localhost","root","","RESTOapps");
	
	$cx="";$sql="select sum(harga)from makanan where identitas_client='".$identitas."'";	
	$mysql=mysqli_query($conection,$sql) or die("something".mysqli_error($conection));
	$check=mysqli_fetch_assoc($mysql);
	$count=mysqli_num_rows($mysql);
	$count>0 ?
	$harga=$check["sum(harga)"] : $harga=0;

	$sql="select balance from balance where identitas_client='".$identitas."';";
		$mysql=mysqli_query($conection,$sql);
	$check=mysqli_fetch_assoc($mysql);
	mysqli_num_rows($mysql)>0 ?
	$saldo=$check["balance"] :
	$saldo=0;
	echo $saldo."<br/>".$harga."<br/>";
   if($saldo < $harga){
	  $cx=0;
   }else{
		$cx=$saldo-$harga;
   }

		return $cx;
	
}function keranjang($identitas_client){
	  
		$conection=new mysqli("localhost","root","","RESTOapps");
		$cx="cxcx";
			$sql="select sum(harga) from makanan where identitas_client='".$identitas_client."';";
			$query=mysqli_query($conection,$sql);
			if($query){
			while($total=mysqli_fetch_assoc($query)){
			$cxcx=$total["sum(harga)"];		
			}
		
			}else{
			$cxcx=0;	
			}
		$sql="select * from makanan where identitas_client=".$identitas_client.";";
		$mysql=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		$count=mysqli_num_rows($mysql);
		
		if($count>0){
		$cx=' <div id="keranjangmakanan">

	<div id="image">
	  
	   </div> <div id="pesananmakan"> Pesanan Makanan  
	  <ul>';
	while($result=mysqli_fetch_assoc($mysql)){
	
	$cx.='
	  <li>
	   <div id="makanan_Cx"> 
	Nama Makanan : '.$result["namamakanan"].'<br/>
	Jumlah Makanan : '.$result["jumlah"].'<br/>
	Harga Makanan : '.$result["harga"].'<br/>

 
 </div>	<div id="icon">
 <img src="png/icon.png"onclick="check('.$result["identitas_makanan"].')"/>
 
 </div></li>
   ';
		}
		$cx.='</ul> </div>
		
	  </div><div id="checkout">
	  Wajib Bayar :<div id="biaya">
	  '.$cxcx.'
	  </div>
	  <form method="post"action="'.htmlentities($_SERVER["PHP_SELF"]).'"enctype="application/x-www-form-urlencode">
	<input type="submit"name="order"value="Cut Balance"/>
	</form>
		</div>
		<div id="deleteAllmakanan">
		
		<form method="post"action="'.htmlentities($_SERVER["PHP_SELF"]).'"enctype="application/x-www-form-urlencoded">
		<input type="submit"name="deleteAllmakanan"value="delete All Makanan"/>
		</form>
		</div>';
		}else{
			$cx="<img src='png/makanankosong.jpg'height='480px'width='800px'/>";
		}
		return $cx;
		
}function profile($identitas_client){
	$conection=new mysqli("localhost","root","","RESTOapps");	
			$sql="select * from client where identitas_client='".$identitas_client."';";
			$cx;$_;
			$query=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
			if($query){
				while($result=mysqli_fetch_assoc($query)){
				$cx=json_encode($result);	
				}
				$_=$cx;
				
			}else{
				$_="cx";
			}
			return $_;
		
	}function non_Exist($client,$identitas){
		$conection=new mysqli("localhost","root","","restoapps") or die("conection".mysqli_connect_error());
		$sql="insert into keranjang values('".$client."','','".$identitas."');";
		$query=mysqli_query($conection,$sql);
		$sql="delete from  makanan where identitas_client='".$client."';";
		$cx;
		$mysql=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		if($mysql){
		 $cx="<script>
		   swal({
			   'type':'info',
			   'text':'Check',
			   'title':'Makanan'
		   });
		  </script>";
	}else{
		$cx="check ";
		
	}
	return $cx;
	}function deleteAllmakanan($identitas){
		$conection=new mysqli("localhost","root","","restoapps") or die("something ".mysqli_connect_error());
		$sql="delete from makanan where identitas_client='".$identitas."';";
		$mysql=mysqli_query($conection,$sql) or die("something ".mysqli_error($conection));
		if($mysql){
			echo "<script>
			
			swal({
				'type':'info',
				'text':'data delete',
				'title':'delete cx'
				
			});
			 </scrip>";
		}

		}
	
	
	
	
}

?>