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
        //return false;
        $publicaciones = array();
        $modelo = new ModeloAmigos($this->conexion);
        $amigos = $modelo->obtenerAmigos($id_usuario);
        //var_dump($amigos);
        $modeloPublicaciones = new ModeloPublicaciones($this->conexion);
        foreach ($amigos as $amigo) {
            $publicaciones_amigo = $modeloPublicaciones->obtenerPublicacionesUsuario($amigo["id_usuario"]);
            //var_dump($publicaciones_amigo);
            foreach ($publicaciones_amigo as $publicacion_amigo) {
                $publicacion_amigo['nombre_usuario'] = $amigo['nombre_usuario'];
                
                $publicaciones[] = $publicacion_amigo;
            }
        }
        usort($publicaciones, function($a, $b) {
            return strtotime($b['fecha_creacion']) - strtotime($a['fecha_creacion']);
        });
        return $publicaciones;
    }
    
    public function obtenerUltimaPublicacionUsuario($id_usuario) {
        
        $modelo = new ModeloPublicaciones($this->conexion);
        $estado = $modelo->obtenerUltimaPublicacionUsuario($id_usuario);
        return $estado;
    }
    public function obtenerNovedades($id_usuario){
        //Obtener listado de amigos ordenado por ultima actividad
        $modeloAmigos = new ModeloAmigos($this->conexion);
        $modeloPublicaciones = new ModeloPublicaciones($this->conexion);

        $amigos = $modeloAmigos->obtenerAmigosNovedades($id_usuario);
        //var_dump($amigos);
        //Obtener publicaciones de cada amigo
        foreach($amigos as $amigo){
            
            $novedades = $modeloPublicaciones->obtenerNovedades($amigo->id_usuario);
            $amigo->notificaciones=$novedades;
        }
        
        //header('Location: ../vistas/publicaciones/vistaNovedades.php');
        //var_dump($amigos);
        return $amigos;

    }

}

?>
