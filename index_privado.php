<?php 
	require ('recursos/constantes.php');
	require ('recursos/funciones.php');	
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Gure Zapore</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
				<header id="header" class="alt">
						<h1><a href="index.php">Gure Zapore</a></h1>
						<nav>							
							<a href="index_privado.php">Inicio</a>
							<a href="recursos/reservas.html">Reservas</a>							
							<a href="recursos/settings.php">Ajustes de cuenta</a>
							<a href="recursos/logoff.php">Desconectar</a>							
						</nav>
					</header>				

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<div class="logo"><span class="icon fa-gem"></span></div>
							<h2>Gure Zapore</h2>
							<?php aleatorio_frase(); ?>
						</div>
					</section>

				<!-- Wrapper -->
					<section id="wrapper">
						
						<!-- Noticias -->
							<section id="one" class="wrapper alt style1">
								<div class="inner">
									<h2 class="major">Actualidad</h2>
									<p>Repaso a las noticias más destacadas del sector gastronómico</p>
									<section class="features">

										<!-- Se repite -->
										<?php
											noticias_general();											
										?>
										<!-- Se repite -->

									</section>
									<ul class="actions">
										<li><a href="#" class="button">Ver todas</a></li>
									</ul>
								</div>
							</section>

					</section>

				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<h2 class="major">Ponte en contacto</h2>
							<p>Ya sea para cualquier duda gastronómica o sobre la membresía de socio, no dudes en escribirnos.</p>							
							<ul class="contact">
								<li class="icon solid fa-home">									
									C/Manuel Iradier Kalea, 66<br />
									Vitoria-Gasteiz 01005, Álava									
								</li>								
								<li class="icon solid fa-envelope"><a href="#">info@gurezapore.com</a></li>
								<li class="icon brands fa-twitter"><a href="#">twitter.com/gurezapore</a></li>
								<li class="icon brands fa-facebook-f"><a href="#">facebook.com/gurezapore</a></li>
								<li class="icon brands fa-instagram"><a href="#">instagram.com/gurezapore</a></li>
							</ul>
							<ul class="copyright">
								<li>2019 &copy; Gure Zapore. Todos los derechos reservados.</li><li>Developed by Leandro Galípolo Uriarte</a></li>
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>