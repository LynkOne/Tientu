<?php

class ModeloUsuarios {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPorNombreUsuario($nombreUsuario) {
        // Preparar la consulta
        $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");

        // Vincular parámetros e indicar el tipo de datos
        $stmt->bind_param('s', $nombreUsuario);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();

        // Devolver la fila correspondiente al usuario
        return $resultado->fetch_assoc();
    }

    public function obtenerPorCorreo($correo) {
      // Preparar la consulta
      $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE correo_electronico = ?");

      // Vincular parámetros e indicar el tipo de datos
      $stmt->bind_param('s', $correo);

      // Ejecutar la consulta
      $stmt->execute();

      // Obtener el resultado
      $resultado = $stmt->get_result();

      // Devolver la fila correspondiente al usuario
      return $resultado->fetch_assoc();
    }

    public function obtenerUsuario($idUsuario) {
      // Preparar la consulta
      $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");

      // Vincular parámetros e indicar el tipo de datos
      $stmt->bind_param('s', $idUsuario);

      // Ejecutar la consulta
      $stmt->execute();

      // Obtener el resultado
      $resultado = $stmt->get_result();

      // Devolver la fila correspondiente al usuario
      return $resultado->fetch_assoc();
  }

    public function crear($nombreUsuario, $contrasena, $correoElectronico) {
        // Calcular el hash de la contraseña
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Preparar la consulta
        $stmt = $this->conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)");

        // Vincular parámetros e indicar el tipo de datos
        $stmt->bind_param('sss', $nombreUsuario, $correoElectronico, $hash);

        // Ejecutar la consulta
        return $stmt->execute();

    }

    public function verificarCredenciales($nombreUsuario, $contrasena) {
        // Obtener la fila correspondiente al usuario
        $usuario = $this->obtenerPorNombreUsuario($nombreUsuario);

        // Verificar que se haya obtenido un resultado
        if (!$usuario) {
            return false;
        }

        // Verificar que la contraseña sea correcta
        return password_verify($contrasena, $usuario['contrasena']);
    }
}





/*class ModeloUsuarios {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function insertarUsuario($nombre_usuario, $correo_electronico, $contrasena) {
    $stmt = $this->conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre_usuario, $correo_electronico, $contrasena);
    return $stmt->execute();
  }

  public function actualizarUsuario($id_usuario, $nombre_usuario, $correo_electronico, $contrasena) {
    $stmt = $this->conexion->prepare("UPDATE usuarios SET nombre_usuario=?, correo_electronico=?, contrasena=? WHERE id_usuario=?");
    $stmt->bind_param("sssi", $nombre_usuario, $correo_electronico, $contrasena, $id_usuario);
    return $stmt->execute();
  }

  public function eliminarUsuario($id_usuario) {
    $stmt = $this->conexion->prepare("DELETE FROM usuarios WHERE id_usuario=?");
    $stmt->bind_param("i", $id_usuario);
    return $stmt->execute();
  }

  public function obtenerUsuario($id_usuario) {
    $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE id_usuario=?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
  }

  public function obtenerUsuarios() {
    $stmt = $this->conexion->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
  }
}*/
?>