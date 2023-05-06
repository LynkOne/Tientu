<?php include 'header.php'; ?>

	<h1>Perfil de Usuario</h1>
	
	<div>
		<h2>Información del Usuario</h2>
		<p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
		<p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
		<p><strong>País:</strong> <?php echo $usuario['pais']; ?></p>
		<p><strong>Ciudad:</strong> <?php echo $usuario['ciudad']; ?></p>
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

	<?php require_once "footer.php"; ?>