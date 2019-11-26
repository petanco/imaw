<?php
/*      Esta aplicación da la opción de leer un archivo de texto o crear uno nuevo y guardarlo en la carpeta
 * de datos almacén     
 */
//La carpeta destino es una llamada almacen en la raiz del proyecto. IMPORTANTE PONER BIEN LA RUTA..
require 'constantes.php'; //para la carpeta de trabajo CARPPETA=almacen
$mensaje="";
$archivo="";
$nombre_archivo="";

//Leer datos de un archivo y pasarlos a una variable de cadena
if(isset($_REQUEST["leer"])){
    $nombre_archivo=$_REQUEST["nombre"];
    /* Compruebo que existe el archivo especificado en la carpeta de trabajo */
    if (is_file(CARPETA.$nombre_archivo)){
        /* Estas comprobaciones se pueden evitar ya que si encuentra el archivo con la ruta sería correcto */
        @chdir(CARPETA) //elijo el directorio de trabajo
        or die("<p>No sepuede acceder al directorio ".CARPETA."</p>");     
        $id_fichero=@fopen($nombre_archivo,"r+") //Abro el fichero con el nombre metido en el formulario y posibilito lectura y escritura
        or die("<p>El fichero \"$nombre_archivo\" no se ha podido abrir.</p>"); // si queremos que aparezca las comillas podemos usar \"
        $archivo=file_get_contents($nombre_archivo); //Paso los datos del archivo a la variable $archivo
    }else $mensaje="<span class='aviso'>El nombre proporcionado no es correcto o la carpeta de datos no está<span>";
    
   
}
// Mete los datos pasados a través del campo texto a un archivo cuyo nombre se pasa en el campo nombre. El directorio de trabajo esta en CARPETA
if (isset($_REQUEST["guardar"])){
    @chdir(CARPETA) //elijo el directorio de trabajo
    or die("<p>No sepuede acceder al directorio".CARPETA."</p>");
    $nombre_archivo=$_REQUEST["nombre"];
    $id_fichero=@fopen($nombre_archivo,"w") //abro el archivo para escritura. Si no existe lo crea y si existe borrará el contenido..
    or die("<p>El fichero \"$nombre_archivo\" no se ha podido abrir.</p>");
    if(fwrite($id_fichero,$_REQUEST["texto"]))
        {$mensaje="<span>El archivo se ha guardado de forma correcta</span>";
        $archivo=$_REQUEST["texto"];
        }
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Leer escribir archivos</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css">
	</head>
	<body>
		<header>
			<h1>Leer escribir archivos</h1>
		</header>
		<nav>
			<ul>
				<li><a href="../index.php">Volver al inicio</a></li>
			</ul>
		</nav>
		
		<section>
			<article>
    			<h2>Crear/Editar un archivo (puedes comprobarlo en la opción <a href='gestion_archivos.php'>Gestión de archivos</a>)</h2>
    			<form action="leer_escribir_archivos.php" method="post" enctype="multipart/form-data'">
    				<p><label for="nombre">Guardar como:(con extensión)</label>
    				<input type="text" name="nombre" id="nombre" size="36" required value="<?php echo $nombre_archivo;?>"></p>
    				<p><textarea name="texto" rows="20" cols="60"><?php echo $archivo;?></textarea></p>  				
    				<p><input type="submit" name="guardar" value="Guardar Archivo"></p>
    				<?php echo $mensaje;?>
    			</form>
    			<?php
    			
    			
    			?>
			</article>
			<article>
    			<h2>Leer un archivo (debe estar en la carpeta de datos: <?php echo CARPETA?>)</h2>
    			<form action="leer_escribir_archivos.php" method="post" enctype="multipart/form-data'">
    				<p><label for="nombre">Nombre del archivo:(con extensión) </label>
    				<input type="text" name="nombre" id="nombre" size="36" required></p>
					<p><input type="submit" name="leer" value="Leer Archivo"></p>';
    			</form>
			</article>
		</section>
	</body>

</html>