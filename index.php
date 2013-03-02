<?php
function dameURL(){
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
return $url;
}
?>
<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/jquery.fixedMenu.js"></script>
<script src="js/jquery-ui-1.10.0.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link href="css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
<div id="menu1"><?require("menu.php");?></div>

<?php 
$upload = ( isset( $_GET['upload'] ) ) ? @$_GET['upload'] : NULL;
$tipo = ( isset( $_GET['tipo'] ) ) ? @$_GET['tipo'] : NULL;
$ver = ( isset( $_GET['peli'] ) ) ? @$_GET['peli'] : NULL;
print "<div id='lista'>";
if ($upload==1 && $tipo!=NULL){
	require("./upload.php");
	}
elseif($upload==NULL && $tipo!=NULL ){
	require("./lista.php");
	}
elseif($upload==NULL && $tipo==NULL && $ver!=NULL){
	//Todavia no funciona
	print "<title>Ver Pelicula Online</title>";
	require("./ver.php");
	
	}
else{
	print "<title>BadaTeca</title>";
	//require("./lista.php"); //Cargar  nuevas peliculas y series
}
print "</div>";
?>

<div align="center" id="pie"> Videoteca de <a href="http://www.robotica-ecuador.com">RobEc</a> 2013</div>
