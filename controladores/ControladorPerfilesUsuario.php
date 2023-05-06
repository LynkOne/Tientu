<?php
// Incluir el archivo de configuración y el modelo de Usuarios
//require_once '../config.php';
//require_once 'modelos/ModeloUsuarios.php';

class ControladorPerfilesUsuario {
    private $modeloUsuarios;
    
    public function __construct($conexion) {
        $this->modeloUsuarios = new ModeloUsuarios($conexion);
    }
    
    public function mostrarPerfilUsuario() {
        // Obtener el nombre de usuario del perfil a mostrar
        $nombreUsuario = $_GET['usuario'];
    
        // Obtener la información del usuario
        $usuario = $this->modeloUsuarios->obtenerPorNombreUsuario($nombreUsuario);
    
        // Redirigir al usuario a la página del perfil de usuario
        header('Location: ../vistas/vistaPerfilUsuario.php');
    }
}

// Crear una instancia del controlador de Perfiles de Usuario y mostrar el perfil de usuario
//$controladorPerfilesUsuario = new ControladorPerfilesUsuario($conexion);
//$controladorPerfilesUsuario->mostrarPerfilUsuario();
?>
