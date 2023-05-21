<?php
// Incluimos los archivos de configuración y las clases necesarias
require_once "config/requires.php";

// Verificamos si el usuario está autenticado
//session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}else{
    $iduser=$_SESSION["id_usuario"];
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
$usuario = $modeloUsuario->obtenerUsuario($iduser);
$perfil = $modeloPerfilesUsuario->obtenerPorId($iduser);
//$publicaciones = $controladorPublicaciones->obtenerHistoricoPublicacionesAmigos($iduser);
switch ($accion) {
    case "inicio":
        require_once "vistas/vistaInicio.php";
        break;
    case "perfil":
        $entradas = $controladorPublicaciones->obtenerEntradasUsuario($iduser);
        require_once "vistas/perfiles/vistaMiPerfil.php";
        break;
    case "perfilUsuario":
        require_once "vistas/perfiles/vistaPerfilUsuario.php";
        break;
    case "publicaciones":
        $controladorPublicaciones->listar();
        break;
    case "crearPublicacion":
        $controladorPublicaciones->crear();
        break;
    case "actualizarPublicacion":
        require_once "vistas/publicaciones/vistaActualizarEstado.php";
        break;
    case "amigos":
        $amigos = $modeloUsuario->obtenerAmigos($iduser);
        require_once "vistas/vistaAmigos.php";
        break;
    case "novedades":
        $novedades=$controladorPublicaciones->obtenerNovedades($iduser);
        require_once "vistas/publicaciones/vistaNovedades.php";
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
?>
