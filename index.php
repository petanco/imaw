<?php 
	require ('recursos/constantes.php');
	require ('recursos/funciones.php');	
	if (isset($_POST['tipo'])) {
		if ($_POST['tipo']==1) {
			login();
		} elseif ($_POST['tipo']==0) {
			sign_up();
		}
	} else {
		header('Location: index_publico.php');
	}
?>
