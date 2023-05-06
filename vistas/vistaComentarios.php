<?php
// Obtener el id de la publicación a mostrar
$idPublicacion = $_GET['id'];

// Incluir el archivo de configuración y el modelo de Comentarios
require_once 'config.php';
require_once 'ModeloComentarios.php';

// Crear una instancia del modelo de Comentarios y listar los comentarios de la publicación
$modeloComentarios = new ModeloComentarios($conexion);
$comentarios = $modeloComentarios->listarPorPublicacion($idPublicacion);

// Mostrar la página con los comentarios
?>
<!DOCTYPE html>
<html>
<head>
    <title>Comentarios de publicación</title>
</head>
<body>
    <h1>Comentarios de la publicación</h1>
    <?php if (count($comentarios) == 0): ?>
        <p>No hay comentarios todavía</p>
    <?php else: ?>
        <ul>
        <?php foreach ($comentarios as $comentario): ?>
            <li>
                <strong><?php echo $comentario['nombre_usuario']; ?>:</strong>
                <?php echo $comentario['contenido']; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
