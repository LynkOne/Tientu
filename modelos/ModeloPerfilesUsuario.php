<?php
// Importar la clase de conexión a la base de datos
//require_once('ConexionBD.php');

class ModeloPerfilesUsuario {
    // Propiedad para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor que recibe una conexión a la base de datos
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Obtener la información del perfil de usuario por nombre de usuario
    public function obtenerPorNombreUsuario($nombreUsuario) {
        // Preparar la consulta
        $consulta = $this->conexion->prepare('SELECT * FROM perfiles_usuario WHERE nombre_usuario = ?');
        $consulta->bind_param('s', $nombreUsuario);

        // Ejecutar la consulta
        $consulta->execute();

        // Obtener los resultados de la consulta
        $resultado = $consulta->get_result();

        // Obtener la fila del resultado
        $perfilUsuario = $resultado->fetch_assoc();

        // Cerrar la consulta y devolver el resultado
        $consulta->close();
        return $perfilUsuario;
    }

    public function obtenerPorId($idUsuario) {
        // Preparar la consulta
        $consulta = $this->conexion->prepare('SELECT * FROM perfiles_usuario WHERE id_usuario = ?');
        $consulta->bind_param('s', $idUsuario);

        // Ejecutar la consulta
        $consulta->execute();

        // Obtener los resultados de la consulta
        $resultado = $consulta->get_result();

        // Obtener la fila del resultado
        $perfilUsuario = $resultado->fetch_assoc();

        // Cerrar la consulta y devolver el resultado
        $consulta->close();
        if(!isset($perfilUsuario["foto_de_perfil"])){
            $perfilUsuario["foto_de_perfil"] = "assets/img/profile/Profile.jpg";
        }
        return $perfilUsuario;
    }

    // Actualizar la información del perfil de usuario
    public function actualizarPerfilUsuario($nombreUsuario, $nombreCompleto, $fechaNacimiento, $ciudad, $pais, $imagenPerfil) {
        // Preparar la consulta
        $consulta = $this->conexion->prepare('UPDATE perfiles_usuario SET nombre_completo = ?, fecha_nacimiento = ?, ciudad = ?, pais = ?, imagen_perfil = ? WHERE nombre_usuario = ?');
        $consulta->bind_param('ssssss', $nombreCompleto, $fechaNacimiento, $ciudad, $pais, $imagenPerfil, $nombreUsuario);

        // Ejecutar la consulta
        $resultado = $consulta->execute();

        // Cerrar la consulta y devolver el resultado
        $consulta->close();
        return $resultado;
    }
}
