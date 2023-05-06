<?php
// Vista que muestra la lista de amigos de un usuario
class VistaAmigo {
    
    // Función que muestra la lista de amigos de un usuario
    public function mostrarLista($amigos) {
        echo "<h3>Lista de amigos:</h3>";
        
        // Si el usuario no tiene amigos, se muestra un mensaje indicándolo
        if (count($amigos) == 0) {
            echo "<p>No tienes amigos.</p>";
        } else {
            // Si el usuario tiene amigos, se muestra la lista de amigos
            echo "<ul>";
            foreach ($amigos as $amigo) {
                echo "<li>$amigo</li>";
            }
            echo "</ul>";
        }
        
        echo "<br>";
        echo "<a href='index.php'>Volver al inicio</a>";
    }
}
?>
