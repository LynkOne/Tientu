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
			<div class="container">
				<div class="row">
					<div class="contenedor-perfil col-11">
						<div class="row panel-lateral-perfil">
							<div class="col-4">
								<div class="mx-auto">
									<img src="<?php echo $perfil["foto_de_perfil"]; ?>" alt="Foto de perfil">
								</div>
							</div>
							<div class="col-8">
							<p class="panel-lateral-perfil-nombre"><?php echo $usuario["nombre_usuario"]; ?></p>
							<p class="panel-lateral-perfil-visitas"><i class="fa-sharp fa-solid fa-chart-simple"></i> <b>0</b> Visitas a tu perfil</p>
							</div>
						</div>
						<hr>
						<div class="row panel-lateral-notificaciones">
							<div class="col-11">
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
					<div class="col-11">
						<div class="panel-lateral-invitaciones">
							<h5>Invita a tus amigos</h5>
							<hr>
							<p><?php echo $usuario["invitaciones"]; ?> Invitaciones</p>
							<div class="container" style="margin: 0; padding: 0;">
								<form>
									<div class="row" style="margin: 0 auto;display: flex;justify-content: space-between;padding: 0;align-items: center;">
										<div class="col-8" style="margin: 0; padding: 0;">
											<div class="form-group">
											
											<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
											</div>
										</div>
										<div class="col-4">
											<button type="submit" class="btn btn-primary btn-block">Invitar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-11">
						<div class="panel-lateral-calendario">
							<div class="container" style="margin: 0; padding: 0;">
								<div class="row" style="margin: 0 auto;display: flex;justify-content: space-between;padding: 0;align-items: center;">
									<div class="col-8 " style="margin: 0; padding: 0;">
										<h5>Calendario</h5>
									</div>
									<div class="col-4" style="margin: 0; padding: 0;text-align:right;">
										<a href="#"><i class="fa-solid fa-calendar-days"></i> Crear evento</a>
									</div>
									<hr>
								</div>
							</div>
							<p><b>Hoy</b> no tienes ningún evento</p>
							<p><b>Mañana</b> no tienes ningún evento</p>
							<hr>
							<p>Ver todos</p>
							<hr>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div id="panel-central" class="col-6">
			
			
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
			
			<h2>Novedades de tus amigos</h2>
			<hr>
			<?php foreach ($publicaciones as $publicacion) { 
				
				
			?>
			<div>
				<h3><?php echo $publicacion["nombre_usuario"]; ?></h3>
				<p><?php echo $publicacion["contenido"]; ?></p>
				<p><?php echo $publicacion["fecha_publicacion"]; ?></p>
			</div>
			<?php } ?>
		</div>
		<div id="panel-lateral-derecho" class="col-3"></div>
	</div>
</div>
<!-- Incluye el archivo footer.php -->
<?php require_once "footer.php"; ?>
