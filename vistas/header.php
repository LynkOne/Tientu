<!DOCTYPE html>
<html>
<head>
	<title>Red Social</title>
	<meta charset="utf-8">
	

	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/jquery-3.6.4.min.js"></script>
	<script src="assets/js/datatables.min.js"></script>
	
 
 
	<link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="assets/fontawesome/css/brands.css" rel="stylesheet">
	<link href="assets/fontawesome/css/solid.css" rel="stylesheet">
	<link href="assets/css/datatables.min.css" rel="stylesheet"/>

	<link rel="stylesheet" href="assets/css/main-styles.css">
    
    <?php if (!isset($_SESSION["id_usuario"])) { ?>   
        
        <link rel="stylesheet" href="assets/css/login.css">
    <?php } ?>
</head>
<body>

	<?php if (isset($_SESSION["id_usuario"])) { ?>

	<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="miModalLabel">Título del modal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Contenido del modal</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Guardar</button>
			</div>
			</div>
		</div>
	</div>
	
	<div class="" id="videoModal" hidden>
		<div class="embed-responsive embed-responsive-16by9 yt-controller">
			<div class="container">
				<div class="row">
					<div class="col-12 text-end"><b><i class="fa-solid fa-xmark"></i></b></div>
				</div>
				<div class="row">
					<div class="col-12"><iframe class="embed-responsive-item" src="" allowfullscreen></iframe></div>
				</div>
			</div>

			
		</div>
	</div>

	<header>
		
		<nav>
			<ul>
				<li><img src="assets/img/logo/tientu_white.png"/></li>
				<li><a href="index.php?accion=reload" id="enlace-inicio" class="enlace-inicio <?php if($accion == "inicio"){echo "active";} ?>">Inicio</a></li>
				<li><a href="index.php?accion=perfil" id="enlace-perfil" class="enlace-perfil <?php if($accion == "perfil"){echo "active";} ?>">Perfil</a></li>
				<li><a href="#">Mensajes</a></li>
				<li><a href="index.php?accion=amigos" id="enlace-amigos" class="enlace-amigos <?php if($accion == "amigos"){echo "active";} ?>">Gente</a></li>
				<li>
					<div class="busqueda">
						<div class="campo-icono">
							<input type="text" id="campo-busqueda" placeholder="Buscar... ">
							<i class="fa-solid fa-magnifying-glass" id="buscar" style="color: #000000;"></i>
						</div>
						<ul id="resultados-busqueda"></ul>
					</div>
				</li>
				<li><button type="button" class="btn btn-primary">Subir fotos</button></li>
				<li><a href="index.php?accion=miCuenta">Mi cuenta</a></li>
				<li><a href="index.php?accion=cerrarSesion">Salir</a></li>
			</ul>
		</nav>
	</header>
	<script>
		$(document).ready(function() {
			$(document).on('click', '.enlace-inicio', function(event) {
				event.preventDefault(); // Evita la redirección
				var url = $(this).attr('href'); // Obtiene la URL del enlace
				$('#contenedor-panel').load(url); // Recarga el contenido del contenedor
				$('nav a').removeClass('active');
				$('#enlace-inicio').addClass('active');
			});
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
