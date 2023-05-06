<!DOCTYPE html>
<html>
<head>
    <title>Publicaciones</title>
</head>
<body>
    <h1>Publicaciones</h1>
    <?php foreach ($publicaciones as $publicacion) { ?>
        <p>
            <strong>Usuario:</strong> <?php echo $publicacion["id_usuario"] ?><br>
            <strong>Contenido:</strong> <?php echo $publicacion["contenido"] ?><br>
            <strong>Fecha de publicación:</strong> <?php echo $publicacion["fecha_publicacion"] ?><br>
        </p>
    <?php } ?>
    <h2>Crear publicación</h2>
    <form action="index.php?accion=crearPublicacion" method="POST">
        <textarea name="contenido"></textarea><br>
        <button type="submit">Publicar</button>
    </form>
</body>
</html>
