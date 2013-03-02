<?php
function dameURL(){
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
return $url;
}
?>
<?php
$peli = $_GET['peli'];
//<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
?>

<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script>
$(document).ready(function(){
	$(\'#completa\').click(function(){
		$(\'#video\')[0].webkitEnterFullScreen();	
	});
});
</script>

<style type="text/css">
video:-webkit-full-screen {
max-height: 100%;
}
</style>


<?
$caminodb = "base.db";
$db = new PDO("sqlite:$caminodb");
$sql="select imagen_portada, nombre, descripcion, categoria from videoteca where streaming='".$peli."'";
$r = $db->query($sql);
print "<table><tr>";
foreach($r as $row){
	$imagen=$row["imagen_portada"];
	$nombre=$row["nombre"];
	$descripcion=$row["descripcion"];
	$categoria=$row["categoria"];
	echo "<td><img src='portadas/".$imagen."' WIDTH='70' HEIGHT='100'></td>";
	echo "<td>".$descripcion."</td>";
	echo "</table>";
}
$db=null;
?>
<div style="text-align:center"> 
<?
print "<h1>".$nombre."</h1>";
?>
  <video id="video" controls width="300" poster="loading.gif" autoplay="autoplay">
    <?
    if(strpos($peli, "mp4")){
    print "<source src='./videos/".$peli."' type='video/mp4' />";
    }
    elseif(strpos($peli, "webm")){
    print "<source src='./videos/".$peli."' type='video/webm' />";
    }
    ?>
    Your browser does not support HTML5 video.
  </video>
  <br><br>
  <!-- <button onclick="playPause()">Play/Pause</button> -->
  <button onclick="make800()">800px</button>
  <button onclick="make1024()">1024px</button>
  <button onclick="make1280()">1280px</button>
  <button onclick="make1366()">1366px</button>
  <button onclick="make1440()">1440px</button>
  <button id="completa" class="button">Full-Screen</button>
</div> 

<script type="text/javascript"> 
var myVideo=document.getElementById("video"); 

function playPause()
{ 
if (myVideo.paused) 
  myVideo.play(); 
else 
  myVideo.pause(); 
} 

function make800()
{ 
myVideo.width=740; 
} 

function make1024()
{ 
myVideo.width=964; 
} 

function make1280()
{ 
myVideo.width=1220; 
} 

function make1366()
{ 
myVideo.width=1306; 
} 

function make1440()
{ 
myVideo.width=1380; 
} 
</script>
