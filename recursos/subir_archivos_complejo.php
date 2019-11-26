<?php
/*Este ejemplo es un script un poco más complejo en el que por una parte al subir un archivo se mira que sea una
 * extensión concreta (en este caso una imagen, pero podría ser cualquier tipo, y que el tamaño no supere un máximo impuesto.
 */

//La carpeta destino es una llamada almacen en la raiz del proyecto. IMPORTANTE PONER BIEN LA RUTA..
require 'constantes.php';
$tamnio_maximo=100000; //100 KB
$mensaje="";
if(isset($_REQUEST["subir_archivo"])){
    //$_FILES['nombre_campo']['name'] nos da el nombre del archivo..
    $nombre=basename($_FILES['archivo']['name']);
    //Miro el tipo de archivo
    $tipo_archivo = $_FILES['archivo']['type'];
    //lo primero es mirar que hay algún archivo
    if ($nombre==""){
        $mensaje="<span class='aviso'>No has elegido ningún archivo</span>";
    }elseif($_FILES['archivo']['size'] > $tamnio_maximo){
        $mensaje="<span class='aviso'>El archivo es demasiado grande</span>";
    }/* Compruebo que el tipo de archivo sea gif, jpg o png */
    elseif (!((strpos($tipo_archivo,"gif") || strpos($tipo_archivo,"jpeg") || strpos($tipo_archivo,"png")))){
        $mensaje="<span class='aviso'>El archivo no es una imagen. Los formatos admitidos son jpg, png y gif</span>";
    }else{
        //Añado el nombre a la ruta de subida..
        $fichero_subido = CARPETA.$nombre;    
        //Esta es la función que lo mueve desde la carpeta temporal al sitio donde le hemos indicado..
        //OJO si hay un archivo con el mismo nombre escribirá encima.
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
            $mensaje="<span>El fichero ".$nombre." se ha subido de forma correcta, puedes comprobarlo en la opción <a href='gestion_archivos.php'>Gestión de archivos</a></span>";
        }else{
            $mensaje="<span class='aviso'>Ha habido algún problema al subir el archivo</span>";
        }
    }
}




?>
<!DOCTYPE html>
<html>
	<head>
		<title>Subir archivos complejo</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css">
	</head>
	<body>
		<header>
			<h1>Subir archivos controlando tipo y tamaño</h1>
		</header>
		<nav>
			<ul>
				<li><a href="../index.php">Volver al inicio</a></li>
			</ul>
		</nav>
		
		<section>
		<h2>Tamaño máximo de subida <?php echo $tamnio_maximo/1000 ?>KB y solo imágenes (gif, jpg o png)</h2>
		<?php 
		//OJO es necesario poner el método POST y la encriptación multipart/form-data
		echo "<form action=".$_SERVER['PHP_SELF']." method='POST' enctype='multipart/form-data'>";
		echo "<p><input type='file' name='archivo'></p>";
		echo "<p><input type='submit' name='subir_archivo' Value='Subir Archivo'></p>";
		echo "</form>";
		echo $mensaje;
		
		
		
		?>
		</section>
	</body>

</html>
		