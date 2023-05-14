<?php 
include "config/requires.php";

include 'vistas/header.php'; 
$modeloPerfilesUsuario = new ModeloPerfilesUsuario($conexion);
$municipios = $modeloPerfilesUsuario->obtenerMunicipios();
  //var_dump($municipios);
  //exit();
  // Validar datos
  if(!empty($_POST["nombre"]) && !empty($_POST["correo"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])){
    //echo "SUBMIT!";
    // Insertar usuario en la base de datos
    //$controladorUsuarios = new ControladorUsuarios($conexion);
    //$resultado = $controladorUsuarios->procesarRegistro();
    var_dump($_POST);
    
    if($resultado){
        // El usuario ha sido insertado correctamente
    }else{
        // Error al insertar el usuario en la base de datos
    }

  }



?>

<div class="container">
  <div class="row justify-content-center">
    <img src="assets/img/logo/tientu_white.png" class="logo">
  </div>
  <div class="row justify-content-center">
  
    <div class="col-lg-6 col-md-8 col-sm-10">
    
      <form class="registro" action="registro.php" method="POST">
        <div class="form-group">
          <div class="instrucciones-registro">
            Este formulario te permite registrar una cuenta en Tientu usando una invitación de <b>Inserte Nombre Aquí</b>
          </div>
          <hr>
          <label for="nombre">Nombre completo:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label>Sexo:</label>
          <div class="sexoradio">
            <input type="radio" id="masculino" name="sexo" value="1">
            <label for="masculino">Masculino</label>
            <input type="radio" id="femenino" name="sexo" value="2">
            <label for="femenino">Femenino</label>
            <input type="radio" id="nobinario" name="sexo" value="3">
            <label for="nobinario">No binario</label>
            <input type="radio" id="nsnc" name="sexo" value="4">
            <label for="nsnc">Prefiero no decirlo</label>
          </div>
        </div>
        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de nacimiento:</label>
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
          <div id="fecha_nacimiento_error" class="error-message" style="display: none;"></div>
        </div>
        <div class="form-group">
          <label for="municipio">Municipio:</label>
          <input type="text" id="municipio" list="municipios" name="municipio" placeholder="Buscar municipio / código postal" required>
          <datalist id="municipios">
            <?php foreach($municipios as $municipio){ ?>
            <option data-value="<?=$municipio->id?>"><?=$municipio->DESC_LOCALIDAD." - ".$municipio->COD_POST?></option>
            <?php } ?>
            <!-- Agrega más opciones de municipios aquí -->
          </datalist>
          <script>
            $(document).ready(function() {
              $('#municipio').on('change', function() {
                var selectedOption = $(this).val();
                console.log("selected option: " + selectedOption);
                
                var datalist = $(this).attr('list');
                var option = $('datalist#' + datalist + ' option').filter(function() {
                  return $(this).text() === selectedOption;
                });
                
                var selectedDataValue = option.data('value');
                console.log("selected option id: " + selectedDataValue);
                $(this).attr('data-value', selectedDataValue);
              });

              $('form').on('submit', function(e) {

                var fechaNacimiento = new Date($('#fecha_nacimiento').val());
                var fechaActual = new Date();
                var minDate = new Date();
                minDate.setFullYear(fechaActual.getFullYear() - 14); // Restar 14 años a la fecha actual
                
                if (fechaNacimiento > minDate) {
                  // La fecha de nacimiento es menor a 14 años
                  e.preventDefault(); // Evitar el envío del formulario
                  $('#fecha_nacimiento').addClass('error'); // Marcar el campo con una clase de error
                  // Mostrar mensaje de error
                  $('#fecha_nacimiento_error').text('Debes tener al menos 14 años para registrarte.').show();
                  return false;
                }


                var valueToSubmit = $('#municipio').data('value');
                $(this).append('<input type="hidden" name="municipio-id" value="' + valueToSubmit + '">');
              });
            });
          </script>
        </div>

        <div class="form-group">
          <label for="correo">Correo electrónico:</label>
          <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="password_confirm">Confirmar contraseña:</label>
          <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrarse</button>
      </form>
    </div>
  </div>
</div>

<?php include 'vistas/footer.php'; ?>
