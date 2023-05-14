<?php
// Clase que maneja las operaciones relacionadas con la tabla de amigos
class ModeloAmigos {
    // Conexión a la base de datos
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    // Función que agrega un nuevo amigo a la base de datos
    public function agregarAmigo($id_usuario, $id_amigo) {
        

        
        // Sentencia SQL para insertar un nuevo amigo
        $sql = "INSERT INTO amigos (id_usuario, id_amigo) VALUES (?, ?)";
        
        // Preparación de la sentencia SQL
        $stmt = $conexion->prepare($sql);
        
        // Asignación de los valores a los parámetros de la sentencia SQL
        $stmt->bind_param("ii", $id_usuario, $id_amigo);
        
        // Ejecución de la sentencia SQL
        $stmt->execute();
        
        // Cierre de la conexión a la base de datos
        $stmt->close();
        //$conexion->close();
    }
    
    // Función que elimina un amigo de la base de datos
    public function eliminarAmigo($id_usuario, $id_amigo) {
        // Conexión a la base de datos
        $conexion = new Conexion();
        
        // Sentencia SQL para eliminar un amigo
        $sql = "DELETE FROM amigos WHERE id_usuario = ? AND id_amigo = ?";
        
        // Preparación de la sentencia SQL
        $stmt = $conexion->prepare($sql);
        
        // Asignación de los valores a los parámetros de la sentencia SQL
        $stmt->bind_param("ii", $id_usuario, $id_amigo);
        
        // Ejecución de la sentencia SQL
        $stmt->execute();
        
        // Cierre de la conexión a la base de datos
        $stmt->close();
        //$conexion->close();
    }
    
    // Función que devuelve la lista de amigos de un usuario
    public function obtenerAmigos($id_usuario) {
        // Conexión a la base de datos
        //$conexion = new Conexion();
        
        // Sentencia SQL para obtener la lista de amigos
        $sql = "SELECT * FROM usuarios WHERE id_usuario IN (SELECT id_usuario_1 as amigo_id FROM amigos WHERE id_usuario_2 = ? UNION SELECT id_usuario_2 as amigo_id FROM amigos WHERE id_usuario_1 = ?)";
        //$sql = "SELECT id_usuario_1 as amigo_id FROM amigos WHERE id_usuario_2 = ? UNION SELECT id_usuario_2 as amigo_id FROM amigos WHERE id_usuario_1 = ?";
        // Preparación de la sentencia SQL
        $stmt = $this->conexion->prepare($sql);
        
        // Asignación de los valores a los parámetros de la sentencia SQL
        $stmt->bind_param("ii", $id_usuario, $id_usuario);
        
        // Ejecución de la sentencia SQL
        $stmt->execute();
        
        // Obtención del resultado de la consulta
        $resultado = $stmt->get_result();
        
        // Creación de un array con los amigos del usuario
        $amigos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $amigos[] = $fila;
        }
        
        // Cierre de la conexión a la base de datos
        $stmt->close();
        //$this->conexion->close();
        
        return $amigos;
    }
}
?>
