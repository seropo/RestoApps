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
if(isset($_POST["username"]) && isset($_POST["passworlogin"])){
	$username=$_POST["username"];
	$password=$_POST["passworlogin"];
	$login=$controller->loginadministrator($username,$password);
	if($login==true){
 isset($_SESSION["administrator"]) ?		
	header("location:admin.php") : header("control_post.php");
	}else{
	echo"<script>
	  swal({
		  'type':'warning',
		  'title':'cx',
		  'text':'please valid data input'
	  });
	  </script>";
	}
	  }else{
		  
	  }
 
 ?>
 </head>
 <body>
  <div id="kerangkacx">
  <br/>
   <div id="loginadmin"><br/>
     <div id="login_">
    <form method="post"action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>"enctype="application/x-www-form-urlencoded">
	Username : <input type="text"name="username"size="15"maxlength="15"required autocomplete="off"/><br/>
	Password : <input type="password"name="passworlogin"size="15"maxlength="15"required autocomplete="off"/><br/>
	<input type="reset"/><input type="submit"name="login" value="login"/>
	 </form>
   </div>
     </div>
	 </div>
  </body>


</html>