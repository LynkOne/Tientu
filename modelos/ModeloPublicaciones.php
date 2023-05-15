<?php


class ModeloPublicaciones {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPublicaciones() {
        $sql = "SELECT * FROM publicaciones WHERE tipo = 1 ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPublicacionesUsuario($id_usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = ?  AND tipo = 1 ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->prepare($sql);
        $resultado->bind_param("i", $id_usuario);
        $resultado->execute();
        $resultados = $resultado->get_result();
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerNovedades($id_usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = ? AND fecha_creacion >= (SELECT MAX(DATE(fecha_creacion)) FROM publicaciones WHERE id_usuario = ?) ORDER BY fecha_creacion DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $id_usuario, $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $novedades = array();
        while ($fila = $resultado->fetch_assoc()) {
            $novedades[] = (Object)$fila;
        }
        $stmt->close();

        return $novedades;
    }
    public function obtenerUltimaPublicacionUsuario($usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = $usuario AND tipo = 1 ORDER BY fecha_creacion DESC LIMIT 1";
        $resultado = $this->conexion->query($sql);
        $publicacion = $resultado->fetch_assoc();
        if(!empty($publicacion)){
            return $publicacion;
            //return $resultado->fetch_all(MYSQLI_ASSOC)[0];
        }else{
            return array("contenido" => "");
        }
        
    }

    public function crearPublicacion($id_usuario, $contenido) {
        $sql = "INSERT INTO publicaciones (id_usuario, contenido, fecha_creacion, tipo) VALUES (?, ?, NOW(), 1)";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->bind_param("is", $id_usuario, $contenido);
        $sentencia->execute();
    }

}

?>
