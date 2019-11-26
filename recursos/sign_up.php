<?php 
	require ('constantes.php');
	require ('funciones.php');	
	if (isset($_POST['nombre'])) {
		sign_up();
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Gure Zapore</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="../index.php">Gure Zapore</a></h1>
						<nav>							
							<a href="../index.php">Inicio</a>
							<a href="generic.html">Actualidad</a>							
							<a href="login.php">Iniciar Sesión</a>
							<a href="sign_up.php">Registrarse</a>							
						</nav>
					</header>
				
				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<h2 class="major">Darse de alta</h2>
							<p>Rellena el siguiente formulario para enviar la solicitud y formar parte de esta familia.</p>							
							<form method="post" action="">
								<div class="fields">
									<div class="field">
										<label for="nombre">Nombre</label>
										<input type="text" name="nombre" id="nombre" required/>
									</div>
									<div class="field">
										<label for="apellidos">Apellidos</label>
										<input type="text" name="apellidos" id="apellidos" />
									</div>
									<div class="field">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" />
									</div>
									<div class="field">
										<label for="dni">DNI</label>
										<input type="text" name="dni" id="dni" />
									</div>
									<div class="field">
										<label for="telefono">Teléfono</label>
										<input type="tel" name="telefono" id="telefono" />
									</div>									
									<div class="field">
										<label for="direccion">Dirección</label>
										<input type="text" name="direccion" id="direccion" />
									</div>	
									<div class="field">
										<label for="password">Contraseña</label>
										<input type="password" name="password" id="password" />
									</div>		
									<input type="hidden" id="tipo" name="tipo" value="0">	
								</div>
								<ul class="actions">
									<li><input type="submit" value="Registrarse" /></li>
								</ul>
							</form>
							<ul class="copyright">
								<li>2019 &copy; Gure Zapore. Todos los derechos reservados.</li><li>Developed by Leandro Galípolo Uriarte</a></li>
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>