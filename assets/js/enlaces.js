$('.enlace-perfil').click(function(event){
    event.preventDefault(); // Evita la redirección
    var url = $(this).attr('href'); // Obtiene la URL del enlace
    $('#contenedor-panel').load(url); // Recarga el contenido del contenedor
    $('nav a').removeClass('active');
    $('#enlace-perfil').addClass('active');
});

$('.enlace-amigos').click(function(event){
    event.preventDefault(); // Evita la redirección
    var url = $(this).attr('href'); // Obtiene la URL del enlace
    $('#contenedor-panel').load(url); // Recarga el contenido del contenedor
    $('nav a').removeClass('active');
    $('#enlace-amigos').addClass('active');
});