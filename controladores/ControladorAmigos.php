<?php
// Controlador de amigos
class ControladorAmigos {
    
    // Función que muestra la lista de amigos de un usuario
    public function lista() {
        // Se obtiene el id del usuario de la sesión
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        
        // Se obtienen los amigos del usuario
        $modelo_amigo = new ModeloAmigo();
        $amigos = $modelo_amigo->obtenerAmigos($id_usuario);
        
        // Se muestra la vista con la lista de amigos
        $vista_amigo = new VistaAmigo();
        $vista_amigo->mostrarLista($amigos);
    }
    
    // Función que agrega un amigo a la lista de amigos de un usuario
    public function agregar() {
        // Se obtiene el id del usuario de la sesión
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        
        // Se obtiene el nombre del amigo a agregar
        $nombre_amigo = $_POST['nombre_amigo'];
        
        // Se agrega el amigo a la lista de amigos del usuario
        $modelo_amigo = new ModeloAmigo();
        $modelo_amigo->agregarAmigo($id_usuario, $nombre_amigo);
        
        // Se redirige al usuario a la lista de amigos
        header('Location: index.php?action=amigo');
    }
    
    // Función que elimina un amigo de la lista de amigos de un usuario
    public function eliminar() {
        // Se obtiene el id del usuario de la sesión
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        
        // Se obtiene el nombre del amigo a eliminar
        $nombre_amigo = $_GET['nombre_amigo'];
        
        // Se elimina el amigo de la lista de amigos del usuario
        $modelo_amigo = new ModeloAmigo();
        $modelo_amigo->eliminarAmigo($id_usuario, $nombre_amigo);
        
        // Se redirige al usuario a la lista de amigos
        header('Location: index.php?action=amigo');
    }
}
?>
