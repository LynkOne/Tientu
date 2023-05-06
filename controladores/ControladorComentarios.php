<?php

//require_once('modelos/ModeloComentarios.php');

class ControladorComentarios
{

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarComentariosPorPublicacion($idPublicacion)
    {
        // Obtener los comentarios de la publicación
        $comentarios = Comentario::listarPorPublicacion($idPublicacion);
        
        // Mostrar la vista de comentarios
        require_once('vistas/vistaComentarios.php');
    }

    public function agregarComentario($idPublicacion, $idUsuario, $texto)
    {
        // Crear el nuevo comentario
        $comentario = new Comentario(null, $idPublicacion, $idUsuario, $texto, date('Y-m-d H:i:s'));
        $comentario->guardar();
        
        // Redirigir a la página de la publicación
        header('Location: index.php?accion=ver_publicacion&id=' . $idPublicacion);
    }

    public function eliminarComentario($idComentario)
    {
        // Eliminar el comentario
        $comentario = Comentario::obtenerPorId($idComentario);
        $idPublicacion = $comentario->getIdPublicacion();
        $comentario->eliminar();
        
        // Redirigir a la página de la publicación
        header('Location: index.php?accion=ver_publicacion&id=' . $idPublicacion);
    }

    public function contarComentariosNuevosSinLeer($id_usuario)
    {
        $modeloComentarios = new ModeloComentarios($this->conexion);

        // Obtener el número de comentarios nuevos sin leer para el usuario
        $numComentariosNuevos = $modeloComentarios->contarComentariosNuevosSinLeer($id_usuario);

        return $numComentariosNuevos;
    }
}
