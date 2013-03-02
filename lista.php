<script type="text/javascript">
	$(document).ready(function() {
		
		$( "#accordion" ).accordion();
	});
</script>
<div id='lista_cabeza'>
<?
$tipo=$_GET["tipo"];
if ($tipo=="1"){
	$clase="Peliculas";
	}
elseif($tipo=="2"){
	$clase="Series";
	}
else{
	$clase=".....";
	$tipo="1";
	}
print "<center><h3>Listado de $clase</h3></center>";
?>
</div>
		<?php
		//Almacenar en la base de datos
		$caminodb = "base.db";
		$db = new PDO("sqlite:$caminodb");
		//Buscar archivo en la carpeta
		$dir="./videos";
		print "<div id='lista_cuerpo'>";
		print "<div id='accordion'>";
		$sql="select distinct ano from videoteca where categoria='".$tipo."' order by ano asc";
		$r = $db->query($sql);
		foreach($r as $row){
			$lista_primer=$row["ano"];
			print "<h3>$lista_primer</h3>";
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			$j=1; //No modificar
			$columnas=13; //13
			if ($j==1){
				echo "<tr>";
			}
			//Anadido de imagen si existe
			$sql="select imagen_portada, nombre, streaming from videoteca where ano='".$lista_primer."' and categoria='".$tipo."' order by nombre asc";
			$r = $db->query($sql);
			foreach($r as $row){
				$imagen=$row["imagen_portada"];
				$nombre=$row["nombre"];
				$archivo=$row["streaming"];
				if($imagen!=null || $imagen!=" "){
					echo "<td>";
					echo "<a href='./ver.php?peli=".$archivo."' target='popup' onclick='window.open ('./ver.php?peli=".$archivo."','ventana','menubar=no,resizable=no ,status=no,width=400,height=450')'>";
					echo "<img src='portadas/".$imagen."' WIDTH='70' HEIGHT='100'>";
					echo "<br>".$nombre;
					echo "</a><br>";
					echo "</td>";
					$j+=1;
					if($j >=$columnas){
						$j=1;
						echo "</tr>";
						echo "<tr>";
					}
				}
			}
			echo "</tr>"; 
			print "</table>";
		}
		$db=null;
		
		print "</div>";
		print "</div>";
		?>
