<?php 
include "config/requires.php";

include 'vistas/header.php'; 


echo "asdsadsad!";

  
  
  // Validar datos
  if(!empty($_POST["nombre"]) && !empty($_POST["correo"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])){
    echo "SUBMIT!";
    // Insertar usuario en la base de datos
    $controladorUsuarios = new ControladorUsuarios($conexion);
    $resultado = $controladorUsuarios->procesarRegistro();

    if($resultado){
        // El usuario ha sido insertado correctamente
    }else{
        // Error al insertar el usuario en la base de datos
    }

  }



?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-10">
      <h2>Registro de usuario</h2>
      <form action="registro.php" method="POST">
        <div class="form-group">
          <label for="nombre">Nombre completo:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
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
