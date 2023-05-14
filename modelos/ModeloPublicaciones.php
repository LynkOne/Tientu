<?php


class ModeloPublicaciones {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPublicaciones() {
        $sql = "SELECT * FROM publicaciones ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPublicacionesUsuario($id_usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = ? ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->prepare($sql);
        $resultado->bind_param("i", $id_usuario);
        $resultado->execute();
        $resultados = $resultado->get_result();
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerNovedades() {
        $sql = "SELECT * FROM publicaciones ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    public function obtenerUltimaPublicacionUsuario($usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = $usuario ORDER BY fecha_creacion DESC LIMIT 1";
        $resultado = $this->conexion->query($sql);
        //return var_dump($resultado->fetch_all(MYSQLI_ASSOC));
        if(!empty($resultado->fetch_all(MYSQLI_ASSOC))){
            return $resultado->fetch_all(MYSQLI_ASSOC)[0];
        }else{
            return array("contenido" => "");
        }
        
    }

    public function crearPublicacion($id_usuario, $contenido) {
        $sql = "INSERT INTO publicaciones (id_usuario, contenido, fecha_creacion) VALUES (?, ?, NOW())";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->bind_param("is", $id_usuario, $contenido);
        $sentencia->execute();
    }

}

?>
