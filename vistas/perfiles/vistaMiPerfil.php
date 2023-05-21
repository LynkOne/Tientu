

	
	
	<div class="row h-100">
		<div id="panel-lateral-izquierdo" class="col-3">
			<div class="container">
				<div class="row">
					<div class="contenedor-perfil col-11">
						<div class="row panel-lateral-perfil">
							<div class="col-12">
								<div class="mx-auto">
									<img src="<?php echo $perfil->foto_de_perfil; ?>" alt="Foto de perfil" style="border-radius: initial;">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-11">
						<div class="panel-lateral-sitios">
							<div class="container" style="margin: 0; padding: 0;">
								<div class="row" style="margin: 0 auto;display: flex;justify-content: space-between;padding: 0;align-items: center;">
									<div class="col-12 " style="margin: 0; padding: 0;">
										<h5>Mis sitios</h5>
									</div>
									<hr>
								</div>
								<!-- Listado de sitios -->
								<div class="row" style="margin: 0 auto;display: flex;justify-content: space-between;padding: 0;align-items: center;">
									<div class="col-12 " style="margin: 0; padding: 0;">
										<p>Sitio 1...</p>
										<p>Sitio 2...</p>
										<p>Sitio 3...</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-11">
						<div class="panel-lateral-paginas">
							<div class="container" style="margin: 0; padding: 0;">
								<div class="row" style="margin: 0 auto;display: flex;justify-content: space-between;padding: 0;align-items: center;">
									<div class="col-12 " style="margin: 0; padding: 0;">
										<h5>Mus páginas</h5>
									</div>
									<hr>
								</div>
								<!-- Listado de páginas -->
								<div class="row" style="margin: 0 auto;display: flex;justify-content: space-between;padding: 0;align-items: center;">
									<div class="col-12 " style="margin: 0; padding: 0;">
										<p>Página 1...</p>
										<p>Página 2...</p>
										<p>Página 3...</p>
									</div>
								</div>
							</div>
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
			<div class="entradas-container">
				<?php require "vistas/publicaciones/vistaEntradasUsuario.php"; ?>
			</div>
			<div class="tablon-container">
				<?php require "vistas/publicaciones/vistaTablonUsuario.php"; ?>
			</div>
			<br>
			
			
		</div>
		<div id="panel-lateral-derecho" class="col-3"></div>
		<!-- Incluye el archivo footer.php -->
		<?php require_once "vistas/footer.php"; ?>
	</div>
	

	