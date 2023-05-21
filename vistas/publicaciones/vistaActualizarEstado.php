
<div class="nueva-publicacion container">
    
    <form  id="publicacion-form" method="POST">
    <div class="row mb-2">
        <div class="col-12 nuevo_estado_container">
            <input type="text" class="form-control" maxlength="200" id="nuevo_estado" name="nuevo_estado" placeholder="&#xf303; Actualiza tu estado" required>
            <div class="counter-container">
                <span id="counter">200</span>
            </div>
        </div>
    </div>
    <div class="row d-flex align-items-center">
        <div class="col-10">
            <span><b>Última actualización:</b> <?php echo $controladorPublicaciones->obtenerUltimoEstadoUsuario($iduser)->contenido; ?></span>
        </div>
        <div class="col-2 d-flex justify-content-end">
            <input type="submit" class="btn btn-primary btn-block" value="Guardar">
        </div>
    </div>
    </form>
    <script>
    $(document).ready(function() {
        $('#publicacion-form').submit(function(e) {
            e.preventDefault(); // evita el envío del formulario predeterminado
            $.ajax({
                url: 'index.php?accion=crearPublicacion',
                type: 'POST',
                data: $('#publicacion-form').serialize(), // obtiene los datos del formulario
                success: function(data) {
                    $('.nueva-publicacion-container').html(data); // actualiza el contenido de la sección
                }
            });
        });

        //Contador de caracteres
        var maxLength = $('#nuevo_estado').attr('maxlength');
        $('#contador').text(maxLength);
        
        $('#nuevo_estado').on('input', function() {
            var length = $(this).val().length;
            var length = maxLength - length;
            $('#counter').text(length);
        });

    });
    </script>
</div>
