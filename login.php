<?php
// Incluir archivo de configuración y controlador de usuarios
include "config/requires.php";

// Inicializar sesión
//session_start();

// Verificar si el usuario ya ha iniciado sesión, redirigir a la página de inicio si es así
if (isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
    exit();
}

// Si el formulario de inicio de sesión ha sido enviado, procesar los datos de inicio de sesión
if (isset($_POST["submit"])) {
    // Obtener nombre de usuario y contraseña enviados desde el formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Verificar credenciales de inicio de sesión
    $controladorUsuarios = new ControladorUsuarios($conexion);
    $usuario = $controladorUsuarios->obtenerPorCorreo($correo);
    if ($usuario && password_verify($contrasena, $usuario["contrasena"])) {
        // Iniciar sesión y redirigir a la página de inicio
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        header("Location: index.php");
        exit();
    } else {
        // Mostrar mensaje de error
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}

// Incluir encabezado de la página
include_once "vistas/header.php";
?>

<h2>Iniciar sesión</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="correo">Nombre de usuario:</label>
        <input type="email" name="correo" id="correo" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Iniciar sesión</button>
</form>

<?php
// Incluir pie de página
include_once "vistas/footer.php";
?>
