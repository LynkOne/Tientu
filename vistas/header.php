<!DOCTYPE html>
<html>
<head>
	<title>Red Social</title>
	<meta charset="utf-8">
	

	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/jquery-3.6.4.min.js"></script>
	

	<link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="assets/fontawesome/css/brands.css" rel="stylesheet">
	<link href="assets/fontawesome/css/solid.css" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/main-styles.css">
    
    <?php if (!isset($_SESSION["id_usuario"])) { ?>   
        
        <link rel="stylesheet" href="assets/css/login.css">
    <?php } ?>
</head>
<body>

	<?php if (isset($_SESSION["id_usuario"])) { ?>
	<header>
		
		<nav>
			<ul>
				<li><img src="assets/img/logo/tientu_white.png"/></li>
				<li><a href="index.php?accion=inicio" class="<?php if($accion == "inicio"){echo "active";} ?>">Inicio</a></li>
				<li><a href="index.php?accion=perfil" id="enlace-perfil" class="enlace-perfil <?php if($accion == "perfil"){echo "active";} ?>">Perfil</a></li>
				<li><a href="#">Mensajes</a></li>
				<li><a href="index.php?accion=amigos" id="enlace-amigos" class="enlace-amigos <?php if($accion == "amigos"){echo "active";} ?>">Gente</a></li>
				<li>
					<div class="busqueda">
						<input type="text" id="campo-busqueda" placeholder="Buscar...">
						<ul id="resultados-busqueda"></ul>
					</div>
				</li>
				<li><a href="index.php?accion=cerrarSesion">Cerrar sesión</a></li>
			</ul>
		</nav>
	</header>
	<script>
		$(document).ready(function() {
			$(document).on('click', '.enlace-perfil', function(event) {
				event.preventDefault(); // Evita la redirección
				var url = $(this).attr('href'); // Obtiene la URL del enlace
				$('#contenedor-panel').load(url); // Recarga el contenido del contenedor
				$('nav a').removeClass('active');
				$('#enlace-perfil').addClass('active');
			});
			$(document).on('click', '.enlace-amigos', function(event) {
				event.preventDefault(); // Evita la redirección
				var url = $(this).attr('href'); // Obtiene la URL del enlace
				$('#contenedor-panel').load(url); // Recarga el contenido del contenedor
				$('nav a').removeClass('active');
				$('#enlace-amigos').addClass('active');
			});
		});
    </script>

	<?php } ?>
