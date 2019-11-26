<?php
//ESTE ES UN SCRIPT SIMPLE QUE NOS HACE LA DESCARGA DE UN ARCHIVO PASADO COMO PARÁMETRO..
require 'constantes.php';

/*Se recoje el nombre del fichero a través de un formulario y se mete a una variable.
 * En un primero momento miramos si existe el archivo, si es así se crea un cuadro de diálogo para 
 * descargar o abrir el archivo. 
 */
if (isset($_REQUEST["archivo"])){
    $fichero=$_REQUEST["archivo"];
    if (is_file(CARPETA.$fichero)){
        header("Content-Type: text/plain");
        //El nombre que aquí aparece es el que se propone como el nombre tras descargar. El usuario puede cambiarlo.
        header("Content-Disposition: attachment; filename=$fichero");
        readfile(CARPETA.$fichero);
    }else{
        echo "<span class='aviso'>No se he encontrado el archivo.</span><a href='gestion_archivos.php'>Volver</a>";
    }
    
    
}
?>