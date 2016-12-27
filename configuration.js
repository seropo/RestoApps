$(document).ready(function(){
 $("body").on("keydown mousedown",function(cx){
	if(cx==3 || cx==8 || cx==123){
	cx.preventDefault();
	}
 
 });
 $("#login,#register").hover(function(){
  $(this).find("span").fadeIn(1000);
  $(this).css({
  "padding":"8px",
  "transition":"padding 1s",
  "cursor":"pointer",
  "color":"white",
  "font-size":"14pt"
  });
 },function(){
 $("#login,#register").find("span").fadeOut(1000);
   $(this).css({
  "padding":"0px",
  "transition":"padding 1s",
  "cursor":"pointer",
  "color":"white",
  "font-size":"14pt"
  });
 });
 
 $("#black-transpare").on("click",function(){
 $(this).fadeOut(1000);
 $("#pesanan").fadeOut(1000);
 $("#keranjangpesan").fadeOut(1000);
 $("#pesanan input[type='number']").val("");
 $("#value").text("");
 $("#aboutus").fadeOut(1000);
 $("#contact").fadeOut(1000);
 $("body").css({"overflow":"scroll"});
 });
 $("#keranjang").on("click",function(){
  $("#keranjangpesan").fadeToggle(1000);
  $("body").css({"overflow":"hidden"});
		
  $("#black-transpare").fadeIn(1000);
 })
$("#paket-makanan").find("img").css({"height":"190px","width":"190px"});
 $("#register").on("click",function(){
 $("#black-transpare").fadeIn(1000)
 $("#btn-cloes").fadeIn(1000);
 $("body").css({"overflow":"hidden"});
 $("#register_tick_function").fadeIn(1000);
 })
 $("#btn-cloes").on("click",function(){
  $(this).fadeOut(1000);
  $("#register_tick_function").fadeOut(1000);
  $("#black-transpare").fadeOut(1000);
  
 $("body").css({"overflow":"scroll"});
 })
 $("#login").on("click",function(){
 $("#form-login").fadeToggle(1000);
 });
 

 var identitas=$.get("profile.php");
 $("#biodata input[name=usernameregis]").on("change blur",function(){
  $.ajax({
  type:"post",
  url:"controller.php",
 data:$.param({identitas:identitas,name:name,value:value}),
 beforeSend:function(){
  $("#biodata img[src='png/three-quarters-loader.gif']").eq(0).fadeIn(1000);


  },
  success:function(response){
  $("#biodata img[src='png/check_.png']").eq(0).fadeIn(1000);
 $("#biodata img[src='png/three-quarters-loader.gif']").eq(0).fadeOut(1000);
  $("biodata input[name=usernameregis]").val(response);
  },
  error:function(){
  $("#biodata img[src='png/cancx.png']").eq(0).fadeIn(1000);
  
  }
  });
 
 });
 
   $("#edit img").on("click",function(){
  $("#biodata input").attr("disabled","false");
 });
 $("#navigasimenu img[src='png/balancecheck.png']").on("mouseover",function(){
   $(".balancecheck").eq(0).fadeIn(1000);
   $(".balancecheck").delay("slow").fadeOut(1000);
 $("img[src='png/balancecheck.png']").on("click",function(){
 $(".check").toggle().animate({"height":"180px","margin-top":"-10%"},"slow");
 
 });  
  
 });
 $("#navigasimenu img[src='png/refill.png']").on("mouseover",function(){
   $(".refill").fadeIn(1000);
 $(".balancecheck").eq(0).fadeOut(400);
 $("img[src='png/refill.png']").on("click",function(){
 $(".refillbalance").toggle().animate({"height":"180px","margin-top":"-10%"},"slow");
 
 });  
   $(".refill").delay("slow").fadeOut(1000);
 });
 $("#navigasimenu img[src='png/historybalance.png']").on("mouseover click",function(){
    $(".refill").fadeOut(100);
 $(".balancecheck").eq(0).fadeOut(400);
   $(".historybalance").fadeIn(400);
 $("img[src='png/historybalance.png']").on("click",function(){
 $(".historybalanc").toggle().animate({"height":"180px","margin-top":"-10%"},"slow");
 
 });  
   $(".historybalance").delay("slow").fadeOut(1000);
 });
 $("#navigasimenu img[src='png/backupdata.jpg']").on("mouseover click",function(cx){
  
 $(".balancecheck").eq(0).fadeOut(400);
 $("#historybalance").fadeOut(400); 
 $(".backupdata").fadeIn(1000);
  
   $(".backupdata").delay("slow").fadeOut(1000);
 });
 $("#validasicx img[src='png/home.png']").on("click",function(){
   window.location="home.php";
   });
   $("#menu .aboutus").on("click",function(){
   $("#black-transpare").fadeIn(1000);
   $("#aboutus").fadeIn(1000);
   $("#contact").fadeOut(1000);
   });
   $("#menu .contact").on("click",function(){
   $("#black-transpare").fadeIn(1000);
   $("#contact").fadeIn(1000);
   $("#aboutus").fadeOut(1000);
   });
   $("#menucontrol").find("li").eq(0).on("click",function(){
   $("#panelcontrol").fadeToggle(1000);
   $("#controllingpost").fadeToggle(1000) ?
   $("#controllingpost input").val("") : "";
   });
   $("#page").on("click",function(){
   $("#page li").slideToggle(1000);
   });
 });
 
 
 $(document).scroll(function(cx){
  var cxcx=$(this).scrollTop();
  if(cxcx>=140){
  $("#keranjang").css({"position":"fixed"});
  }else if(cxcx<80){
  $("#keranjang").css({"margin-Top":"100px","position":"absolute"});
  }
  });
 function maps(){
 var maps=new google.maps.Map(document.getElementById("maps"),{
 center:{
       lat:36.132884,lng:37.650146 },
	  zoom:4
 
 });
 
 }
function makanan(namamakan){
var xmlhttp;
	
if(window.XMLHttpRequest){
xmlhttp=new XMLHttpRequest();
}else{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function(){
 if(xmlhttp.readyState==4 || xmlhttp.status==200){
   document.getElementById("searchmakananlist").innerHTML=xmlhttp.responseText;
 
 
 }else{
   document.getElementById("searchmakananlist").innerHTML="cx";
 
 }
};

window.alert(namamakan);
xmlhttp.open("GET","search.php?makanan="+namamakan,true);
xmlhttp.send();

}function check(identitas){
 var xmlhttp;
	
if(window.XMLHttpRequest){
xmlhttp=new XMLHttpRequest();
}else{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function(){
 if(xmlhttp.readyState==4 || xmlhttp.status==200){
   document.getElementById("makanan_Cx").innerHTML=xmlhttp.responseText;
 
 
 }
};

window.alert("cxcx");
xmlhttp.open("GET","keranjang.php?identitas="+identitas,true);
xmlhttp.send();

}