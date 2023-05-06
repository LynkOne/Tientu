<?php

	// Incluye el archivo header.php
	require_once "header.php";
	
	// Obtiene los datos del usuario
	//$usuario = $controladorUsuarios->buscarPorId($_SESSION["id_usuario"]);
	
	// Obtiene el historico de publicaciones de los amigos del usuario
	
?>
	
<!-- Crea la estructura HTML -->
<div id="contenedor-panel" class="container-fluid">
	<div class="row">
		<div id="panel-lateral-izquierdo" class="col-3">
			<div class="contenedor-perfil">
				<img src="<?php echo $perfil["foto_de_perfil"]; ?>" alt="Foto de perfil">
				<p><?php echo $usuario["nombre_usuario"]; ?></p>
				<p>Solicitudes de amistad pendientes: <?php echo $controladorSolicitudAmistad->contarSolicitudesPendientes($_SESSION["id_usuario"]); ?></p>
				<p>Comentarios nuevos sin leer: <?php echo $controladorComentarios->contarComentariosNuevosSinLeer($_SESSION["id_usuario"]); ?></p>
			</div>
		</div>

		<div id="panel-central" class="col-9">
			
			
			<div id="nueva-publicacion">
				<h3>Nueva publicación</h3>
				<form action="controlador_publicaciones.php" method="POST">
				<label for="titulo">Título:</label>
				<input type="text" id="titulo" name="titulo" required>

				<label for="contenido">Contenido:</label>
				<textarea id="contenido" name="contenido" required></textarea>

				<input type="submit" value="Enviar publicación">
				</form>
			</div>
			<!-- Aquí iría el historial de publicaciones -->
			
			<h2>Historial de publicaciones</h2>
			<?php foreach ($publicaciones as $publicacion) { 
				
				
			?>
			<div>
				<h3><?php echo $publicacion["nombre_usuario"]; ?></h3>
				<p><?php echo $publicacion["contenido"]; ?></p>
				<p><?php echo $publicacion["fecha_publicacion"]; ?></p>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- Incluye el archivo footer.php -->
<?php require_once "footer.php"; ?>
