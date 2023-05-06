<!DOCTYPE html>
<html>
<head>
	<title>Red Social</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/main-styles.css">
    
    <?php if (!isset($_SESSION["id_usuario"])) { ?>   
        
        <link rel="stylesheet" href="assets/css/login.css">
    <?php } ?>
</head>
<body>
	<header>
		
		<nav>
			<ul>
				<li><img src="assets/img/logo/tientu_white.png"/></li>
				<li><a href="index.php?accion=inicio" class="<?php if($accion == "inicio"){echo "active";} ?>">Inicio</a></li>
				<li><a href="index.php?accion=perfil" class="<?php if($accion == "perfil"){echo "active";} ?>">Mi perfil</a></li>
				<li><a href="amigos.php">Amigos</a></li>
				<li><a href="solicitudes_amistad.php">Solicitudes de amistad</a></li>
				<li><a href="index.php?accion=cerrarSesion">Cerrar sesión</a></li>
			</ul>
		</nav>
	</header>
