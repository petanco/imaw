<?php
/*      Esta aplicacion devuelve los archivos que están alojados en una carpeta y nos permite
 *      hacer ciertas acciones con ellos     
 */
//La carpeta destino es una llamada almacen en la raiz del proyecto. IMPORTANTE PONER BIEN LA RUTA..
require 'constantes.php';
$mensaje="";

//BORRAR ARCHIVOS

/* En esta parte se usa unlink para borrar el archivo elegido. */
if (isset($_REQUEST["borrar"])){
    if (is_file(CARPETA.$_REQUEST["borrar"])){
        unlink(CARPETA.$_REQUEST["borrar"]);
        $mensaje="<span>Archivo borrado correctamente</span>";
    }else{
        $mensaje="<span class='aviso'>No se ha encontrado el archivo elegido..</span>";
    }
    
}

//VER LOS ARCHIVOS QUE HAY EN UNA CARPETA
/* scandir me devuelve un array con los archivos que hay en un directorio */
$archivos=scandir(CARPETA);
if (!$archivos){
    $mensaje="<span class='aviso'>No se ha podido acceder a la carpeta de destino</span>";
}



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gestión de archivos</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css">
	</head>
	<body>
		<header>
			<h1>Gestión de archivos</h1>
		</header>
		<nav>
			<ul>
				<li><a href="../index.php">Volver al inicio</a></li>
			</ul>
		</nav>
		
		<section>
			<?php
			/* En un direcctorio nos encontraremos . y .. en las posiciones 0 y 1. A partir de ahí estan los archivos de verdad.
			 * En este caso hago una tabla con el nombre de los archivos y unos enlaces para borra o descargar esos archivos. 
			 */
			echo $mensaje;
			if ($archivos){
    			$num_archivos=count($archivos);
    			if ($num_archivos>2){
    			    echo "<table>";
    			    for($archivo=2;$archivo<$num_archivos;$archivo++){
    			        echo "<tr>";
    			        echo "<td class='nombre'>".$archivos[$archivo]."</td>";
    			        echo "<td><a href='".CARPETA.$archivos[$archivo]."' download='".$archivos[$archivo]."'>Descargar</a></td>";
    			        echo "<td><a href='".$_SERVER['PHP_SELF']."?borrar=".$archivos[$archivo]."'>Borrar</a></td>";
    			        echo "<td><a href='descarga.php?archivo=".$archivos[$archivo]."'>Guardar Como</a></td>";
    			        echo "</tr>";
    			    }   			    
    			    echo "</table>";
    			}
    					
			}
			
			?>
		</section>
	</body>

</html>