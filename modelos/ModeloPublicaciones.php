<?php


class ModeloPublicaciones {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPublicaciones() {
        $sql = "SELECT * FROM publicaciones ORDER BY fecha_publicacion DESC";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    public function obtenerUltimaPublicacionUsuario($usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = $usuario ORDER BY fecha_creacion DESC LIMIT 1";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function crearPublicacion($id_usuario, $contenido) {
        $sql = "INSERT INTO publicaciones (id_usuario, contenido, fecha_creacion) VALUES (?, ?, NOW())";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->bind_param("is", $id_usuario, $contenido);
        $sentencia->execute();
    }

}

?>
