<?php

	// Incluye el archivo header.php
	require_once "header.php";
	
	// Obtiene los datos del usuario
	//$usuario = $controladorUsuarios->buscarPorId($_SESSION["id_usuario"]);
	
	// Obtiene el historico de publicaciones de los amigos del usuario
	
?>
	
<!-- Crea la estructura HTML -->
<div id="contenedor-panel" class="container-fluid">
	<div class="row h-100">
		<div id="panel-lateral-izquierdo" class="col-3">
			<div class="row">
				<div class="contenedor-perfil">
					<div class="row panel-lateral-perfil">
						<div class="col-4">
							<img src="<?php echo $perfil["foto_de_perfil"]; ?>" alt="Foto de perfil">
						</div>
						<div class="col-8">
						<p class="panel-lateral-perfil-nombre"><?php echo $usuario["nombre_usuario"]; ?></p>
						<p class="panel-lateral-perfil-visitas"><i class="fa-sharp fa-solid fa-chart-simple"></i> <b>0</b> Visitas a tu perfil</p>
						</div>
					</div>
					<hr>
					<div class="row panel-lateral-notificaciones">
						<div class="col-12">
							<?php if( $debug || $controladorSolicitudAmistad->contarSolicitudesPendientes($_SESSION["id_usuario"]) > 0){ ?>
								<p><i class="fa-solid fa-user-plus fa-fw"></i> <?php echo $controladorSolicitudAmistad->contarSolicitudesPendientes($_SESSION["id_usuario"]); ?> Peticiones de amistad </p>
							<?php }?>
							<?php if( $debug || $controladorComentarios->contarComentariosNuevosSinLeer($_SESSION["id_usuario"]) > 0){ ?>
								<p><i class="fa-solid fa-comment fa-fw"></i> <?php echo $controladorComentarios->contarComentariosNuevosSinLeer($_SESSION["id_usuario"]); ?> Comentarios nuevos</p>
							<?php }?>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<h3>Invitar amigos</h3>
				</div>
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
