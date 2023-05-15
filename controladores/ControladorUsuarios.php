<?php
// Controlador de usuarios
class ControladorUsuarios {
    
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Función que muestra el formulario de inicio de sesión
    public function login() {
        // Se muestra la vista con el formulario de inicio de sesión
        $vista_usuario = new VistaUsuario();
        $vista_usuario->mostrarFormularioLogin();
    }
    public function obtenerPorCorreo($correo) {
        $modelo_usuario = new ModeloUsuarios($this->conexion);
        return $modelo_usuario->obtenerPorCorreo($correo);

    }

    
    // Función que procesa el inicio de sesión de un usuario
    public function procesarLogin() {
        // Se obtienen los datos del usuario
        $nombre_usuario = $_POST['nombre_usuario'];
        $contrasena = $_POST['contrasena'];
        
        // Se verifica si los datos son correctos
        $modelo_usuario = new ModeloUsuario();
        $id_usuario = $modelo_usuario->verificarUsuario($nombre_usuario, $contrasena);
        
        if ($id_usuario != null) {
            // Si los datos son correctos, se inicia la sesión del usuario
            session_start();
            $_SESSION['id_usuario'] = $id_usuario;
            
            // Se redirige al usuario a la lista de amigos
            header('Location: index.php?action=amigo');
        } else {
            // Si los datos son incorrectos, se muestra un mensaje de error
            $vista_usuario = new VistaUsuario();
            $vista_usuario->mostrarMensajeError("Los datos ingresados son incorrectos.");
        }
    }
    
    
    // Función que procesa el registro de un usuario
    public function procesarRegistro() {
        // Se obtienen los datos del usuario
        $nombre = $_POST["nombre"];
        $email = $_POST["correo"];
        $password = $_POST["password"];
        
        // Se registra al usuario
        $modelo_usuario = new ModeloUsuarios($this->conexion);
        $modelo_usuario->crear($nombre, $password, $email);
        $usuario_creado=$modelo_usuario->obtenerPorCorreo($email);
        
        // Se muestra un mensaje de éxito y se redirige al usuario al formulario de inicio de sesión
        return $usuario_creado;
    }
    
    // Función que cierra la sesión de un usuario
    public function cerrarSesion() {
        // Se cierra la sesión del usuario
        session_start();
        session_destroy();
        
        // Se redirige al usuario al formulario de inicio de sesión
        header('Location: index.php?action=login');
    }
}
?>
