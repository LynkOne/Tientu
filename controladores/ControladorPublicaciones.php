<?php

require_once "modelos/ModeloPublicaciones.php";

class ControladorPublicaciones {
    // Conexión a la base de datos
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listar() {
        $modelo = new ModeloPublicaciones();
        $publicaciones = $modelo->obtenerPublicaciones();
        require "vistas/publicaciones/vistaPublicaciones.php";
    }

    public function crear() {
        $modelo = new ModeloPublicaciones($this->conexion);
        $id_usuario = $_SESSION["id_usuario"];
        $contenido = $_POST["nuevo_estado"];
        $modelo->crearPublicacion($id_usuario, $contenido);
        header("Location: index.php?accion=actualizarPublicacion");
    }

    public function obtenerHistoricoPublicacionesAmigos($id_usuario) {
        $publicaciones = array();
        $modelo = new ModeloAmigos($this->conexion);
        $amigos = $modelo->obtenerAmigos($id_usuario);
        foreach ($amigos as $amigo) {
            $publicaciones_amigo = $this->modeloPublicaciones->obtenerPublicacionesUsuario($amigo['id_amigo']);
            foreach ($publicaciones_amigo as $publicacion_amigo) {
                $publicacion_amigo['nombre_usuario'] = $amigo['nombre_usuario'];
                $publicacion_amigo['nombre_completo'] = $amigo['nombre_completo'];
                $publicaciones[] = $publicacion_amigo;
            }
        }
        usort($publicaciones, function($a, $b) {
            return strtotime($b['fecha_publicacion']) - strtotime($a['fecha_publicacion']);
        });
        return $publicaciones;
    }
    public function obtenerUltimaPublicacionUsuario($id_usuario) {
        
        $modelo = new ModeloPublicaciones($this->conexion);
        $estado = $modelo->obtenerUltimaPublicacionUsuario($id_usuario);
        return $estado;
    }

}

?>
