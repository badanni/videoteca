<? 
function envio($par1,$par2,$par3,$par4){
	//datos del arhivo de video 
		$direccion=$par1."/";
		$nombre_archivo = $_FILES[$par2]['name']; 
		$tipo_archivo = $_FILES[$par2]['type'];
		$tamano_archivo = $_FILES[$par2]['size']; 
		$error = $_FILES[$par2]['error'];
		//compruebo si las características del archivo son las que deseo 
		if($par3 && $error==UPLOAD_ERR_OK){
			if (copy($_FILES[$par2]['tmp_name'],$direccion.$par4)){ 
					 echo "El archivo ".$nombre_archivo." ha sido cargado correctamente.<br>"; 
					 $erro=0;
			}
			else{ 
					 echo "Ocurrió algún error al subir el fichero (".$nombre_archivo."). No pudo guardarse.<br>"; 
					 $erro=1;
			}  
		}
		return $erro;
	}
//Verificar si existe el archivo antes de subir

//Almacenar en la base de datos
$caminodb = "base.db";
$db = new PDO("sqlite:$caminodb");

//Variables
$categoria=$_POST["categoria"];
if ($categoria==1){
	$nombre_filme_original=$_POST["nombre_original"];
	$nombre_filme = $_POST["nombre_archivo"]; 
	echo "<center><h1>La pelicula " .$nombre_filme. "</h1></center><br><br>"; 
	$pais_origen = $_POST["pais"]; 
	$anho = $_POST["anho"]; 
	//Si algun genero es cero toca dejarlo en blanco
	$genero0 = $_POST["genero0"]; 
	$genero1 = $_POST["genero1"]; 
	$genero2 = $_POST["genero2"]; 
	$genero3 = $_POST["genero3"]; 
	$genero4 = $_POST["genero4"];
	$descripcion = $_POST["descripcion"];
	$duracion = $_POST["duracion"];
	$archivo_streaming = $_FILES['archivo']['name']; 
	$archivo_streaming_extension=$_FILES['archivo']['type']; 
	$archivo_portada = $_FILES['portada']['name']; 
	$archivo_portada_extension = $_FILES['portada']['type']; 
	
	$boton=isset($_POST['boton']);
	if (strpos($archivo_streaming_extension, "mp4")){
	$valor=-3;
	}
	elseif(strpos($archivo_streaming_extension, "webm")){
	$valor=-4;
	}
	else{
	$valor=NULL;
	}
	$nome_archivo=date("YmdHis").".".substr($archivo_streaming_extension, $valor);
	$nome_portada=date("YmdHis").".".substr($archivo_portada_extension, -3);
	$aviso1=envio("videos",'archivo',$boton,$nome_archivo);
	$aviso2=envio("portadas",'portada',$boton,$nome_portada);
	if ($aviso1 != 0 && $aviso2 != 0 && $valor== NULL){
		goto fin;
		}
	//Ingreso a la base de datos
	$sql="INSERT INTO archivos (categoria,direccion,nombre_original,existe) VALUES('$categoria','$archivo_streaming','$nombre_filme_original',1)";
	$r = $db->query($sql);
	//falta puntuacion y visto
	
	$sql="INSERT INTO videoteca (duracion,categoria,nombre_original,nombre,streaming,ano,descripcion,imagen_portada,genero_0,genero_1,genero_2,genero_3,genero_4,pais) VALUES($duracion,'$categoria','$nombre_filme_original','$nombre_filme','$nome_archivo','$anho','$descripcion','$nome_portada',$genero0,$genero1,$genero2,$genero3,$genero4,'$pais_origen')";
	$r = $db->query($sql);
	}
elseif($categoria==2){
	echo "En contruccion";
	}
	
	
?> 
<?
fin:
$inicio="http://".$_SERVER['HTTP_HOST']."/videoteca/";
echo "<center><a href=$inicio>Regresar</a></center>";
$db = null;
?>
<br><br><br>
<div align="center"> Videoteca de <a href="http://www.robotica-ecuador.com">RobEc</a></div>
