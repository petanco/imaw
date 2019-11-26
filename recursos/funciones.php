<?php

// Función para conectarnos con una base de datos en general. Depende de los valores guardados en la constantews
function conexion(){
    try {
        $conn = new PDO("mysql:host=".SERVIDOR.";dbname=".BASE.";charset=utf8",USUARIO,CLAVE);
        $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $conn->setAttribute(PDO::NULL_TO_STRING, true);
    } catch (PDOException $e) {
        die ("<p><H3>No se ha podido establecer la conexión.</p><p>Compruebe si está activado el servidor de bases de
		datos MySQL.</H3></p>\n <p>Error: ".$e->getMessage()."</p>\n");
    }
    return $conn;
}

// Función que genera aleatoriamente una frase para el banner
function aleatorio_frase(){
    $db = conexion();
    $consulta = "SELECT count(*) FROM frases";
    $num = $db->query($consulta);
    foreach ($num as $n){
        $num=rand(1,$n[0]);
    }
    $consulta="SELECT texto FROM frases WHERE id=$num";
    $frases = $db->query($consulta);
    if (!$frases) {
        $error=$db->errorInfo();
        print "<p>Error en la consulta. Error ". $error[2] ."</p>";
    } else foreach ($frases as $frase){
        echo $frase[0];
    }
}

// Función que genera articulos para mostrar en la página index y actualidad
function noticias_general(){
    $db = conexion();
    $consulta = "SELECT titulo, texto, foto, url_direccion FROM noticias_actualidad WHERE tipo=0 ORDER BY id";
    $noticias = $db->query($consulta);
    $i = 0;
    if (!$noticias) {
        $error=$db->errorInfo();
        print "<p>Error en la consulta. Error ". $error[2] ."</p>";
    } else foreach ($noticias as $noticia){
            echo '<article>';
            echo '<a href="'.$noticia['url_direccion'].'" target="_blank" class="image"><img src="'.$noticia['foto'].'" alt=""/></a>';   
            echo '<h3 class="major">'.$noticia['titulo'].'</h3>';
            echo '<p>'.$noticia['texto'].'</p>';
            echo '<a href="'.$noticia['url_direccion'].'" target="_blank" class="special">Ver mas</a>';
            echo '</article>';      
            if (++$i == 4) break;  
    }
}

// Función para registrar un nuevo usuario
function sign_up(){
    $db = conexion();
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];    
     $direccion = $_POST['direccion'];
    $password = $_POST['password'];

    $consulta='insert into usuario values ("'.$dni.'", "'.$nombre.'", "'.$apellidos.'", "'.$email.'", '.$telefono.', "'.$direccion.'", 0, "'.md5($password).'")';
    $registrarse=$db->exec($consulta);
    if ($registrarse===false) {
        $error=$db->errorInfo();
        print "Error en la consulta. Error ". $error[2];
    }else header('Location: ../index_privado.php');  
}

// Función para loguear un usuario
function login(){
    $db = conexion();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $consulta='select *
			from usuario
			where email="'.$email.'" and password="'.md5($password).'"';
    $logged = $db->query($consulta);
    if (!$logged) {
        $error=$db->errorInfo();
        print "<p>Error en la consulta. Error ". $error[2] ."</p>";
    } else {
        if ($logged->rowcount()==0) $_SERVER['error_login'] = 1;
        else header('Location: index_privado.php');
    }
}