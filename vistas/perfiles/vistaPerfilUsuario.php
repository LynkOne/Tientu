

	
	
	<div class="row h-100">
		<div id="panel-lateral-izquierdo" class="col-3">
			<div class="container">
				<div class="row">
					<div class="contenedor-perfil col-11">
						<div class="row panel-lateral-perfil">
							<div class="col-4">
								<div class="mx-auto">
									<img src="<?php echo $perfil->foto_de_perfil; ?>" alt="Foto de perfil">
								</div>
							</div>
							<div class="col-8">
							<a href="index.php?accion=perfil" class="enlace-perfil"><p class="panel-lateral-perfil-nombre"><?php echo $usuario["nombre_usuario"]; ?></p></a>
							<p class="panel-lateral-perfil-visitas"><i class="fa-sharp fa-solid fa-chart-simple"></i> <b>0</b> Visitas a tu perfil</p>
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
							<a href="#">Ver todos</a>
							
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div id="panel-central" class="col-6">
			<div class="nueva-publicacion-container">
				<?php require "vistas/publicaciones/vistaActualizarEstado.php"; ?>
			</div>
			<!-- Aquí iría el historial de publicaciones -->
			Entradas usuario
			<br>
			Tablon usuario
			
		</div>
		<div id="panel-lateral-derecho" class="col-3"></div>
	</div>
	
	
	<h1>Perfil de Usuario</h1>
	
	<div>
		<h2>Información del Usuario</h2>
		<p><strong>Nombre:</strong> <?php echo $usuario['nombre_usuario']; ?></p>
		<p><strong>Email:</strong> <?php echo $usuario['correo_electronico']; ?></p>
		
		<p><strong>Miembro desde:</strong> <?php echo $usuario['fecha_creacion']; ?></p>
	</div>

	<div>
		<h2>Publicaciones</h2>
		<!-- Aquí se podrían mostrar las publicaciones del usuario -->
	</div>

	<div>
		<h2>Amigos</h2>
		<?php if (empty($amigos)): ?>
			<p>El usuario no tiene amigos aún.</p>
		<?php else: ?>
			<ul>
			<?php foreach ($amigos as $amigo): ?>
				<li><?php echo $amigo['nombre']; ?></li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

	<div>
		<h2>Solicitudes de Amistad</h2>
		<?php if (empty($solicitudes)): ?>
			<p>No hay solicitudes de amistad pendientes.</p>
		<?php else: ?>
			<ul>
			<?php foreach ($solicitudes as $solicitud): ?>
				<li><?php echo $solicitud['nombre']; ?> - 
					<a href="index.php?accion=aceptar_solicitud&id=<?php echo $solicitud['id']; ?>">Aceptar</a> |
					<a href="index.php?accion=rechazar_solicitud&id=<?php echo $solicitud['id']; ?>">Rechazar</a>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

	