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