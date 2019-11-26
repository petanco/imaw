<?php 
	require ('constantes.php');
	require ('funciones.php');	
	if (isset($_POST['email'])) {
		login();
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
							<h2 class="major">Entrar a la zona privada</h2>
							<p>Rellena el siguiente formulario para entrar en la zona privada.</p>							
							<form method="post" action="../index.php">
								<div class="fields">									
									<div class="field">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" />
									</div>									
									<div class="field">
										<label for="password">Contraseña</label>
										<input type="password" name="password" id="password" />
									</div>		
									<input type="hidden" id="tipo" name="tipo" value="1">	
								</div>
								<ul class="actions">
									<li><input type="submit" value="Entrar" /></li>
								</ul>
							</form>
							<h2>
								<?php 
									if (isset($_SERVER['error_login'])) {
										if ($_SERVER['error_login'] == 1) {
											echo "Usuario o contraseña incorrecto.";
										}
									}									
								?>
							</h2>
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