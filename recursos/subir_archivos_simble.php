<?php
/*Este ejemplo es uno muy simple para guardar archivos en una carpeta concreta. 
 * Es un ejemplo muy simple y no se comprueba mas que se haya elegido un archivo..
 * Toda la información relacionada con el archivo queda en el array $_FILES["nombre_campo"]
 * donde nombre_campo es el nombre elegido en el formulario..
 */

//La carpeta destino es una llamada almacen en la raiz del proyecto. IMPORTANTE PONER BIEN LA RUTA..
require 'constantes.php';
$mensaje="";
if(isset($_REQUEST["subir_archivo"])){
    //$_FILES['nombre_campo']['name'] nos da el nombre del archivo..
    $nombre=basename($_FILES['archivo']['name']);
    //La única comprobación que hacemos es que se haya elegido un archivo..
    if ($nombre==""){
        $mensaje="<span class='aviso'>No has elegido ningún archivo</span>";
    }else {
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
		<title>Subir archivos simple</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css">
	</head>
	<body>
		<header>
			<h1>Subir archivos sin controles</h1>
		</header>
		<nav>
			<ul>
				<li><a href="../index.php">Volver al inicio</a></li>
			</ul>
		</nav>
		
		<section>
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
		