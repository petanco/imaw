<?php

/*PHP tiene soporte para las «cookies» de HTTP de forma transparente.
 * Las cookies son un mecanismo por el que se almacenan datos en el navegador remoto para monitorizar 
 * o identificar a los usuarios que vuelvan al sito web. 
 * ES NECESARIO POR LEY INFORMAR A LOS USUARIOS DE QUE ESTÁS USANDO COOKIES
 * 
 * En este pequeño script hago dos ejemplos:
 * - Un nombre que se recibe de teclado y nunca expira.
 * - Un botón que una vez hecho click desaparecerá durante 2 minutos. Por mucho que se recargue la página
 *   no habrá botón en ese tiempo. Una vez pasado el tiempo SI RECARGO la página, aparecerá..
 */

// Zona del nombre que no caduca..
if (isset($_REQUEST["nombre"])){
    /*Para crear la cookie se usa setcookie. El primer parámetro es el nombre de la cookie, el segundo es el valor de la
     * misma. Se podría añadir un tercero (en realidad hay más) para indicar la caducidad de la cookie
     * p.e. setcookie("nombre",$_REQUEST["nombre"],time()+$int); $int es el número de segundos que se mantendrá..
     * Si quieres que "no caduque" puedes añadir un número como 300mill de segundos, que viene a ser 10 años
     * Si no utilizamos el tercer argumento será como una variable de sesión. durará hasta cerrar el navegador.
     * Es interesante poner un nombre a la cookie que no coincida con nombre de los campos..
     */
    setcookie("cookie_nombre",$_REQUEST["nombre"],time()+300000000);
    //SI quieres que tenga efecto en esta misma página es necesario hacer la recarga..
    header("location:".$_SERVER['PHP_SELF']);
}
//Para borrar las cookies hacemos que expire una hora antes..
if (isset($_REQUEST["borrar"])){
    setcookie("cookie_nombre", "", time() - 3600);
    //OJO en esta carga todavía existiría, por eso usamos el header y recargamos la página, ya sin cookie..
    header("location:".$_SERVER['PHP_SELF']);
}


// Zona del botón..
if (isset($_REQUEST["boton"])){
    // Creo una cookie pero con caducidad de 2 minutos..
    setcookie("cookie_boton","1",time()+(60*2));
    //Por lo mismo que antes debo recargar..
    header("location:".$_SERVER['PHP_SELF']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cookies</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css">
	</head>
	<body>
		<header>
			<h1>Cookies</h1>
		</header>
		<nav>
			<ul>
				<li><a href="../index.php">Volver al inicio</a></li>
			</ul>
		</nav>
		
		<section>
			<?php
			echo "<form action=".$_SERVER['PHP_SELF'].">";
			if (isset($_COOKIE["cookie_nombre"])){
			    echo "<h1>Tu eres ".$_COOKIE["cookie_nombre"].". Aunque cierres el navegador sabré quien eres..</h1>";
			    echo "<a href='".$_SERVER['PHP_SELF']."?borrar=true'>Olvídate de mí..</a>";
			}else{
			    
			    echo "<p><label for='nombre'>Nombre: <input type='text' name='nombre' id='nombre'></p>";
			    echo "<p><input type='submit' value='Guardar Nombre'></p>";	    
			}
			if (!isset($_COOKIE["cookie_boton"])){
			    echo "<p><input type='submit' value='Botón que desaparece dos minutos' name='boton'></p>";	  
			}
			echo "</form>";
			?>
		</section>
	</body>

</html>
