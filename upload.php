<?
/*
 * Modificado de  http://jmginer.eu @jmginer
 * ini_set('upload_max_filesize', 2147483647);
 */

ini_set('max_input_time', 0);
ini_set('max_execution_time', 0);

 $tipo=$_GET["tipo"];
 $clase="Nueva";
 $caminodb = "base.db";
 $db = new PDO("sqlite:$caminodb");
?>
<script type="text/javascript">
	$(document).ready(function(){
	$("#info").hide();
	$("#info").show(10000);
	$("#subido").hide();
});
function envio(){
	$("#formulario").hide(1000);
	$("#subido").show();
}
</script>
<?
  if ($tipo == "1"){
	$clase="pelicula";  
  }
  elseif($tipo == "2"){
	$clase="serie";
  }
  print "<title>Subir ".$clase."</title>";
  ?>
<br>
<div id="formulario">
<?
print "<h1>Formulario para ingreso de una ".$clase." a la videoteca</h1>";
if ($tipo!="1"){
	goto series;
	}
?>

    <form action="upload2.php" method="post" enctype="multipart/form-data" name="form"> 
	  <input type="hidden" name="categoria" value=1>
      <label for="archivo">Archivo</label><input name="archivo" type="file" id="archivo" accept="video/mp4, video/webm"/> <br>
      <label>Nombre del filme<input name="nombre_archivo" type="text" id="nombre_archivo"size="45" maxlength="80"/></label><br>
      <label>Nombre original del filme<input name="nombre_original" type="text" id="nombre_original"size="45"maxlength="80"/></label><br>
      <label>Pais de origen<input name="pais" type="text" id="pais"size="30" maxlength="30"/></label><br>
      <label>Ano del filme<input name="anho" type="text" id="anho"size="4" maxlength="4"/></label><br>
      <label>Duracion del filme (min)<input name="duracion" type="text" id="duracion"size="4" maxlength="4"/></label><br>
      <label for="portada">Portada</label><input name="portada" type="file" id="portada" accept="image/*"/> <br>
      <label>Genero</label>
      <SELECT name="genero0">  
		<?
        $r = $db->query("SELECT * FROM generos ORDER BY genero");
		foreach($r as $row){
			$id=$row["id"];
			$genero=$row["genero"];
			echo "<OPTION VALUE=".$id.">".$genero."</OPTION>";
		}
		?>
	 </SELECT>,
	 <SELECT name="genero1">
		<?
        $r = $db->query("SELECT * FROM generos ORDER BY genero");
		foreach($r as $row){
			$id=$row["id"];
			$genero=$row["genero"];
			echo "<OPTION VALUE=".$id.">".$genero."</OPTION>";
		}
		?>
	 </SELECT>,
	 <SELECT name="genero2">
		<?
        $r = $db->query("SELECT * FROM generos ORDER BY genero");
		foreach($r as $row){
			$id=$row["id"];
			$genero=$row["genero"];
			echo "<OPTION VALUE=".$id.">".$genero."</OPTION>";
		}
		?>
	 </SELECT>,
	 <SELECT name="genero3">
		<?
        $r = $db->query("SELECT * FROM generos ORDER BY genero");
		foreach($r as $row){
			$id=$row["id"];
			$genero=$row["genero"];
			echo "<OPTION VALUE=".$id.">".$genero."</OPTION>";
		}
		?>
	 </SELECT>,
	 <SELECT name="genero4">
		<?
        $r = $db->query("SELECT * FROM generos ORDER BY genero");
		foreach($r as $row){
			$id=$row["id"];
			$genero=$row["genero"];
			echo "<OPTION VALUE=".$id.">".$genero."</OPTION>";
		}
		?>
	 </SELECT><br>
	 <label>Descripcion</label><textarea name="descripcion" cols="40" rows="8" id="descripcion"></textarea><br>
      <input name="boton" type="submit" id="boton" value="Enviar" onclick="javascript:envio()"/>
     </form>
     <br>
  </div>
  <?
  goto fin;
  ?>
<?
series:
echo "Series";
?>

<?
fin:
$db = null;
?>
<div id="info">
<h3>IMPORTANTE: El fichero no debe contener espacios ni caracteres especiales, solo formato MP4/WEBM. 
<?
echo "El tamano maximo de todo es ".ini_get('post_max_size')." y por archivo es ".ini_get('upload_max_filesize')."</h3>";
?>
</div>
<div id="subido">Subiendo archivo...</div>
