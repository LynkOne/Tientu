<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="enviarEntrada" action="index.php?accion=crearEntrada" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="miModalLabel">Crear una entrada</h5>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Ingresa el título">
                </div>
                <div class="form-group mt-2">
                    <label for="contenido">Contenido:</label>
                    <textarea class="form-control" name="contenido" id="contenido" rows="5" required placeholder="Ingresa el contenido"></textarea>
                </div>
            

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary enviar-entrada">Guardar</button>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $(document).off('submit', '#enviarEntrada');
    $(document).on('submit', '#enviarEntrada', function(event) {
        event.preventDefault();
        var formulario = $('#enviarEntrada');
        //console.log(formulario);

        // Verificar los campos required
        var camposVacios = formulario.find('[required]').filter(function() {
            return $(this).val().trim() === '';
        });
        
        if (camposVacios.length > 0) {
            // Al menos un campo required está vacío
            // Puedes mostrar un mensaje de error o realizar alguna acción
            //console.log('Existen campos vacíos');
            return; // Detener el envío del formulario
        }
        
        // Todos los campos required están llenos, continuar con el envío del formulario
        

        $.ajax({
        url: formulario.attr('action'),
        type: formulario.attr('method'),
        data: formulario.serialize(),
        success: function(response) {
            //console.log("response");
            //console.log(response);
            
            if(response==="true"){
                $('#miModal').empty(); // Vaciar el contenido del modal
                $('#miModal').modal('hide');
                $('#enlace-perfil').click();
            }else{
                $('#miModal .modal-body').html('¡Ha ocurrido un error!');
                $('#miModal .enviar-entrada').css('display', 'none');
            }
        },
        error: function(xhr, status, error) {
            $('#miModal .modal-body').html('Error en la solicitud: ' + error);
        }
        });

    });
    $('#enviarEntrada').unbind('submit').submit();
});

</script>