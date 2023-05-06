<?php
// Incluimos los archivos de configuración y las clases necesarias
require_once "config/requires.php";

// Verificamos si el usuario está autenticado
//session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}
//var_dump($_SESSION);

// Obtenemos la acción solicitada por el usuario
if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];
} else {
    $accion = "inicio";
}

// Creamos los controladores y modelos necesarios
$controladorUsuario = new ControladorUsuarios($conexion);
$modeloUsuario = new ModeloUsuarios($conexion);

$controladorPublicaciones = new ControladorPublicaciones($conexion);
$modeloPublicaciones = new ModeloPublicaciones($conexion);

$controladorPerfilesUsuario = new ControladorPerfilesUsuario($conexion);
$modeloPerfilesUsuario = new ModeloPerfilesUsuario($conexion);

$controladorAmigos = new ControladorAmigos($conexion);
$modeloAmigos = new ModeloSolicitudAmistad($conexion);

$controladorSolicitudAmistad = new ControladorSolicitudAmistad($conexion);
$modeloSolicitudAmistad = new ModeloSolicitudAmistad($conexion);

$controladorComentarios = new ControladorComentarios($conexion);
$modeloComentarios = new ModeloComentarios($conexion);
// Manejamos las acciones solicitadas por el usuario
$usuario = $modeloUsuario->obtenerUsuario($_SESSION["id_usuario"]);
$perfil = $modeloPerfilesUsuario->obtenerPorId($_SESSION["id_usuario"]);
$publicaciones = $controladorPublicaciones->obtenerHistoricoPublicacionesAmigos($_SESSION["id_usuario"]);
switch ($accion) {
    case "inicio":
        require_once "vistas/vistaInicio.php";
        break;
    case "perfil":
        require_once "vistas/vistaPerfilesUsuario.php";
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
    case "cerrarSesion":
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(),'',0,'/');
        session_regenerate_id(true);
        header('Location: index.php');
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        exit();
}


/*
// Carga del archivo de configuración
require_once 'config/config.php';

// Obtener la acción a realizar
$action = $_GET['action'] ?? 'index';

// Crear el controlador y ejecutar la acción solicitada
switch ($action) {
    case 'index':
        require_once 'controladores/ControladorUsuarios.php';
        $controller = new ControladorUsuarios($conexion);
        $controller->index();
        break;
    case 'login':
        require_once 'controladores/ControladorUsuarios.php';
        $controller = new ControladorUsuarios($conexion);
        $controller->login();
        break;
    case 'logout':
        require_once 'controladores/ControladorUsuarios.php';
        $controller = new ControladorUsuarios($conexion);
        $controller->logout();
        break;
    case 'perfil':
        require_once 'controladores/ControladorPerfilesUsuario.php';
        $controller = new ControladorPerfilesUsuario($conexion);
        $controller->perfil();
        break;
    case 'amigos':
        require_once 'controladores/ControladorAmigos.php';
        $controller = new ControladorAmigos($conexion);
        $controller->index();
        break;
    case 'solicitudes':
        require_once 'controladores/ControladorSolicitudesAmistad.php';
        $controller = new ControladorSolicitudesAmistad($conexion);
        $controller->index();
        break;
    case 'comentarios':
        require_once 'controladores/ControladorComentarios.php';
        $controller = new ControladorComentarios($conexion);
        $controller->index();
        break;
    default:
        require_once 'vistas/404.php';
        break;
}*/
?>
