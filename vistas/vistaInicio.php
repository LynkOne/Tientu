<?php

	// Incluye el archivo header.php
	require_once "header.php";
	
	// Obtiene los datos del usuario
	//$usuario = $controladorUsuarios->buscarPorId($_SESSION["id_usuario"]);
	
	// Obtiene el historico de publicaciones de los amigos del usuario
	///echo "aaaa";
	//var_dump($perfil);
?>
	
<!-- Crea la estructura HTML -->
<div id="contenedor-panel" class="container-fluid">
	<?php require_once "vistas/inicio/inicio.php";?>
</div>

