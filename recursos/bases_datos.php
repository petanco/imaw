<?php
session_start();
/*   Esta aplicacion hace conexiones con una base de datos para realizar distintas acciones 
 *       
 */
require 'acciones_base.php';
require 'constantes.php';
$opcion="";
$mensaje="";
//Al dar a inicio se destruye la sesión..
if (isset($_REQUEST["inicio"])){
    session_destroy();
    header("location:".$_SERVER['PHP_SELF']);
}

//Al hacer clic en una opción esa opción es asignada a la variable de sesión
if (isset($_REQUEST["opcion"])){  
    $_SESSION["opcion"]=$_REQUEST["opcion"];
}
//Si existe la variable de sesión se crea una variable llamada opción (para simplificar el uso) y se crea una conexión con la base de datos
if (isset($_SESSION["opcion"])){
    $opcion=$_SESSION["opcion"];
    $db=conectaBD();
}
//Logeo
if (isset($_REQUEST["entrar"])){
    $mensaje=logear_usuario($db, $_REQUEST["usuario"], $_REQUEST["clave"]);
}
//Guardar un nuevo usuario
if (isset($_REQUEST["nuevo"])){
    if (es_unico($db, $_REQUEST["usuario"])){
        if (meter_usuario($db, $_REQUEST["usuario"],$_REQUEST["clave"], $_REQUEST["nombre"])){
            $mensaje="<span>Usuario añadido de forma correcta</span>";
        }
    }
}

//Borrar un usuario
if (isset($_REQUEST["borrar"])){
    borrar_usuario($db, $_REQUEST["borrar"]);
}

if (isset($_REQUEST["editar"])){
    $_SESSION["opcion"]="editar";
}
//Una vez hecha la edición esta se guarda en la base de datos
if (isset($_REQUEST["guardar_editado"])){
    if ($_REQUEST["clave"]==$_REQUEST["clave1"]){
        editar_usuario($db, $_REQUEST["editar"], $_REQUEST["clave"], $_REQUEST["nombre"]);
        //Después de guardar los cambios vuelvo al listado, se podría poner un mensaje también..
        $_SESSION["opcion"]="listar";
    }       
        else{
            $_SESSION["opcion"]="editar";
            $mensaje="<span class='aviso'>Las claves metidas no coinciden..</span>";
        }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bases de datos</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css">
	</head>
	<body>
		<header>
			<h1>Bases de datos</h1>
		</header>
		<nav>
			<ul>
				<li><a href="../index.php">Volver al inicio</a></li>
			</ul>
		</nav>
		<nav id="lateral">
			<ul>
				<li <?php if($opcion=="") echo "class='actual'";?>><a href="<?php echo $_SERVER["PHP_SELF"]?>?inicio=on">Inicio</a></li>
				<li <?php if($opcion=="login") echo "class='actual'";?>><a href="<?php echo $_SERVER["PHP_SELF"]?>?opcion=login">Login</a></li>
				<li <?php if($opcion=="listar") echo "class='actual'";?>><a href="<?php echo $_SERVER["PHP_SELF"]?>?opcion=listar">Listar Usuarios</a></li>
				<li <?php if($opcion=="nuevo") echo "class='actual'";?>><a href="<?php echo $_SERVER["PHP_SELF"]?>?opcion=nuevo">Nuevo Usuario</a></li>
			</ul>
		</nav>
		
		<section id="con_menu">
			<?php
			if (!isset($_SESSION["opcion"])){
			    echo "<h2 class='centrar'>Para utilizar esta web es necesario cargar en phpmyadmin el archivo base.sql para así crear la base de datos</h2>";
			    echo "<p>Si quieres descargarlo pulsa <a href='".CARPETA."base.sql' dowload='base.sql'>Aquí</a>.<p>";
			}else{
			    switch ($_SESSION["opcion"]){
			        case "login":
			            echo "<form action='".$_SERVER["PHP_SELF"]."' method='post' class='bases'>";
			            echo "<p><label for='usuario'>Usuario</label><input type='text' required name='usuario' id='usuario'></p>";
			            echo "<p><label for='clave'>Clave</label><input type='password' name='clave' id='clave'></p>";
			            echo "<p><input type='submit' name='entrar' value='Entrar'></p>";
			            echo $mensaje;
			            echo "</form>";
			            
			            break;
			        case "listar":
			            echo "<table>";
			            echo "<caption>Hay ".numero_usuarios($db)." usuarios almacenados en la base de datos</caption>";
			            echo "<tr><th>Usuario</th><th>Nombre</th><th colspan='2'>Acciones</th></tr>";
			            listar_usuarios($db);
			            echo "</table>";
			            break;
			        case "nuevo":
			            echo "<form action='".$_SERVER["PHP_SELF"]."' method='post' class='bases'>";
			            //Es interesante añadir el maxlenth para evitar fallos al meter datos a la base de datos.
			            echo "<p><label for='usuario'>Usuario</label><input type='text' required name='usuario' id='usuario' maxlength='10'></p>";
			            echo "<p><label for='clave'>Clave</label><input type='password' name='clave' id='clave' maxlength='10'></p>";
			            echo "<p><label for='nombre'>Nombre</label><input type='text' name='nombre' id='nombre' maxlength='30'></p>";
			            echo "<p><input type='submit' name='nuevo' value='Guardar'></p>";
			            echo $mensaje;
			            echo "</form>";			            
			            break;
			        case "editar":
			            /* Al editar es interesante tambiénañadir el maxlenth para evitar fallos al meter datos a la base de datos.
			             * En este caso dentro de los campos pongo el valor que ya existe en la base de datos.
			             * El usuario no quiero que lo cambien y es por lo que uso readonly. disabled no manda la información. Igual estéticamente queda
			             * mejor, ya que queda en gris, pero sería necesario mandar el usuario a través de un input hiden..
			             */
			            echo "<form action='".$_SERVER["PHP_SELF"]."' method='post' class='bases'>";
			           //El nombre de este campo (editar) lo pongo para facilitar las cosas en caso de retornar a esta sección, por error en las contraseñas
			            echo "<p><label for='usuario'>Usuario</label><input type='text' required name='editar' id='usuario' maxlength='10' value='".$_REQUEST["editar"]."' readonly></p>";
			            echo "<p><label for='nombre'>Nombre</label><input type='text' name='nombre' id='nombre' maxlength='30' value='".sacar_nombre($db, $_REQUEST["editar"])."'></p>";
			            echo "<p><label class='ancho'>Cambio de clave</label></p>";
			            echo "<p><label for='clave'>Nueva Clave</label><input type='password' name='clave' id='clave' maxlength='10' title='para no cambiarla dejarla en blanco'></p>";
			            echo "<p><label for='clave'>Rep nueva Clave</label><input type='password' name='clave1' id='clave' maxlength='10' title='para no cambiarla dejarla en blanco'></p>";
			            
			            echo "<p><input type='submit' name='guardar_editado' value='Guardar'></p>";
			            echo $mensaje;
			            echo "</form>";
			            $_SESSION["opcion"]="listar";
			            break;
			    }
			    
			}
			    
			?>
		</section>
	</body>

</html>