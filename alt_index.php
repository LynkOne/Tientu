<?php
// Incluimos los archivos de configuración y las clases necesarias
require_once "configuracion/config.php";
require_once "controladores/ControladorUsuario.php";
require_once "controladores/ControladorPublicaciones.php";
require_once "modelos/ModeloUsuario.php";
require_once "modelos/ModeloPublicaciones.php";

// Verificamos si el usuario está autenticado
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

// Obtenemos la acción solicitada por el usuario
if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];
} else {
    $accion = "inicio";
}

// Creamos los controladores y modelos necesarios
$controladorUsuario = new ControladorUsuario();
$modeloUsuario = new ModeloUsuario();
$controladorPublicaciones = new ControladorPublicaciones();
$modeloPublicaciones = new ModeloPublicaciones();

// Manejamos las acciones solicitadas por el usuario
switch ($accion) {
    case "inicio":
        $usuario = $modeloUsuario->obtenerUsuario($_SESSION["id_usuario"]);
        require_once "vistas/vistaInicio.php";
        break;
    case "perfil":
        $usuario = $modeloUsuario->obtenerUsuario($_GET["id_usuario"]);
        require_once "vistas/vistaPerfil.php";
        break;
    case "publicaciones":
        $controladorPublicaciones->listar();
        break;
    case "crearPublicacion":
        $controladorPublicaciones->crear();
        break;
    case "amigos":
        $amigos = $modeloUsuario->obtenerAmigos($_SESSION["id_usuario"]);
        require_once "vistas/vistaAmigos.php";
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        exit();
}

?>
