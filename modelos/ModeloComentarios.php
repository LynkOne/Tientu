<?php

class ModeloComentarios
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function listarPorPublicacion($idPublicacion)
    {
        // Preparar la consulta
        $consulta = "SELECT * FROM comentarios WHERE id_publicacion = :idPublicacion ORDER BY fecha_creacion DESC";
        
        // Ejecutar la consulta
        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindValue(':idPublicacion', $idPublicacion, PDO::PARAM_INT);
        $sentencia->execute();
        
        // Obtener los resultados
        $comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $comentarios;
    }
    
    public function crear($idPublicacion, $idUsuario, $contenido)
    {
        // Preparar la consulta
        $consulta = "INSERT INTO comentarios (id_publicacion, id_usuario, contenido, fecha_creacion) VALUES (:idPublicacion, :idUsuario, :contenido, NOW())";
        
        // Ejecutar la consulta
        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindValue(':idPublicacion', $idPublicacion, PDO::PARAM_INT);
        $sentencia->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $sentencia->bindValue(':contenido', $contenido, PDO::PARAM_STR);
        $resultado = $sentencia->execute();
        
        // Retornar el resultado de la inserción
        return $resultado;
    }

    public function contarComentariosNuevosSinLeer($id_usuario)
    {
        $sql = "SELECT COUNT(*) FROM comentarios WHERE id_publicacion IN 
                (SELECT id_publicacion FROM publicaciones WHERE id_usuario = ?) AND leido = 0";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $stmt->bind_result($num_comentarios_nuevos);
        $stmt->fetch();
        $stmt->close();
        return $num_comentarios_nuevos;
    }
}
