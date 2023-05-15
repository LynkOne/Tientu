<?php 
include "config/requires.php";
$controladorUsuarios = new ControladorUsuarios($conexion);
$modeloPerfilesUsuario = new ModeloPerfilesUsuario($conexion);
if (isset($_POST["accion"])) {
  $accion = $_POST["accion"];
  if($accion == "verificar_email"){  
    if(isset($_POST["email"])){
      //comprobar si existe el correo en la bd
      $existeUser=$controladorUsuarios->obtenerPorCorreo($_POST["email"]);
      if($existeUser != NULL){
        //$existe=1;
        echo "existe";
      }else{
        //$existe=0;
        echo "no_existe";
      }
    }else{
      echo "else post email";
      var_dump($_POST);
    }
  }else{
    var_dump($_POST);
  }
  exit();
}



if(!empty($_POST["nombre"]) 
&& !empty($_POST["sexo"])
&& !empty($_POST["fecha_nacimiento"])
&& !empty($_POST["municipio-id"])
&& !empty($_POST["correo"]) 
&& !empty($_POST["correo_confirmar"])
&& !empty($_POST["password"]) 
&& !empty($_POST["password_confirm"]) ){
  //echo "SUBMIT!";
  // Insertar usuario en la base de datos
  //
  $resultado = $controladorUsuarios->procesarRegistro();

  var_dump($resultado);
  
  
  if($resultado != NULL){
    //Crear perfil del usuario
    $modeloPerfilesUsuario->crearPerfil($resultado["id_usuario"], $_POST["fecha_nacimiento"], $_POST["municipio-id"], $_POST["sexo"]);

    header("Location: index.php?action=login");
      // El usuario ha sido insertado correctamente
  }else{
      
      // Error al insertar el usuario en la base de datos
  }
  exit();
}



$municipios = $modeloPerfilesUsuario->obtenerMunicipios();

include 'vistas/header.php'; 

//var_dump($municipios);
//exit();
// Validar datos




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
            <input type="radio" id="masculino" name="sexo" value="1" required>
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
          <div id="municipio_error" class="error-message" style="display: none;"></div>
        </div>
        <div class="form-group">
          <label for="correo">Correo electrónico:</label>
          <input type="email" class="form-control" id="correo" name="correo" required>
          <div id="correo_error" class="error-message" style="display: none;"></div>
          <label for="correo_confirmar">Confirmar correo electrónico:</label>
          <input type="email" class="form-control" id="correo_confirmar" name="correo_confirmar" required>
          <div id="correo_confirmar_error" class="error-message" style="display: none;"></div>
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" class="form-control" id="password" name="password" required>
          <div id="password-strength" class="error-message">Mínimo 8 carácteres, 1 mayúscula, 1 minúscula, 1 número y un carácter especial </div>
        </div>
        <div class="form-group">
          <label for="password_confirm">Confirmar contraseña:</label>
          <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
          <div id="password_confirm_error" class="error-message" style="display: none;"></div>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrarse</button>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    var error_password = false;
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
      $('#municipio').removeClass('error');
      $('#municipio_error').hide();
    });

    $('#password').on('keyup', function() {
      var password = $(this).val();

      // Verificar la longitud de la contraseña
      var lengthValid = password.length >= 8;

      // Verificar si la contraseña contiene al menos una letra mayúscula
      var uppercaseValid = /[A-Z]/.test(password);

      // Verificar si la contraseña contiene al menos una letra minúscula
      var lowercaseValid = /[a-z]/.test(password);

      // Verificar si la contraseña contiene al menos un número
      var numberValid = /\d/.test(password);

      // Verificar si la contraseña contiene al menos un carácter especial
      var specialCharValid = /[!@#$%^&*()\-=_+[\]{}|\\:;'"<>,.?/]/.test(password);

      // Verificar si todas las condiciones se cumplen
      var isPasswordValid = lengthValid && uppercaseValid && lowercaseValid && numberValid && specialCharValid;

      // Actualizar la visualización de la fortaleza de la contraseña
      if (isPasswordValid) {
        $('#password-strength').text('Fuerte');
        $('#password-strength').removeClass('weak').addClass('strong');
        error_password=false;
      } else {
        $('#password-strength').text('Débil. Mínimo 8 carácteres, 1 mayúscula, 1 minúscula, 1 número y un carácter especial');
        $('#password-strength').removeClass('strong').addClass('weak');
        error_password=true;
      }
    });


    $('form').on('submit', function(e) {
      e.preventDefault(); // Evitar el envío del formulario
      var error=false
      //Comprobar edad
      var fechaNacimiento = new Date($('#fecha_nacimiento').val());
      var fechaActual = new Date();
      var minDate = new Date();
      minDate.setFullYear(fechaActual.getFullYear() - 14); // Restar 14 años a la fecha actual
      if (fechaNacimiento > minDate) {
        // La fecha de nacimiento es menor a 14 años
        $('#fecha_nacimiento').addClass('error'); // Marcar el campo con una clase de error
        // Mostrar mensaje de error
        $('#fecha_nacimiento_error').text('Debes tener al menos 14 años para registrarte.').show();
        error=true;
      }else{
        $('#fecha_nacimiento').removeClass('error');
        $('#fecha_nacimiento_error').hide();
      }

      //Obtener id del municipio seleccionado
      var valueToSubmit = $('#municipio').data('value');
      if (typeof valueToSubmit === 'undefined') {
        $('#municipio').addClass('error');
        $('#municipio_error').text('Debes seleccionar un municipio.').show();
        error=true;
      }else{
        $('#municipio').removeClass('error');
        $('#municipio_error').hide();
        $(this).append('<input type="hidden" name="municipio-id" value="' + valueToSubmit + '">');
      }
      

      //Comprobar email

      var email = $('#correo').val();
      var email_confirmar = $('#correo_confirmar').val();
      if(email !== email_confirmar){
        $('#correo_confirmar').addClass('error');
        $('#correo_confirmar_error').text('El correo de confirmación no coincide con el correo ingresado.').show();;
        error=true;
      }else{
        $('#correo_confirmar').removeClass('error');
        $('#correo_confirmar_error').hide();
      }

      // Realizar la solicitud AJAX al servidor
      $.ajax({
        url: 'registro.php', // Ruta al archivo PHP que realizará la verificación en el servidor
        type: 'POST',
        data: { 
          accion: 'verificar_email',
          email: email
          }, // Enviar el email al servidor

        success: function(response) {
          if (response !== 'no_existe') {
            // El email ya está registrado, mostrar mensaje de error
            $('#correo').addClass('error');
            $('#correo_error').text('El email ya está registrado. Por favor, utiliza otro email.').show();
            error=true;
          } else if(response === 'no_existe'){
            $('#correo_error').hide();
          }
        },

        error: function() {
          // Error en la solicitud AJAX
          console.log('Error al verificar el email.');
          error=true;
        }
      });



      //Comprobar contraseñas
      var password = $('#password').val();
      var password_confirm = $('#password_confirm').val();
      if(password !== password_confirm){
        $('#password_confirm').addClass('error');
        $('#password_confirm_error').text('Las contraseñas no coinciden.').show();;
        error=true;
      }else{
        $('#password_confirm').removeClass('error');
        $('#password_confirm_error').hide();
      }
      if(error_password){
        error=true;
      }
      


      if(error){
        return false;
      }else{
        $('form').unbind('submit').submit(); // Enviar el formulario nuevamente
      }
      
      
    });
  });
</script>

<?php include 'vistas/footer.php'; ?>
