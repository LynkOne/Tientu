
<div class="mis-entradas container mt-3">
    <div class="row" style="align-items:baseline;">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center"><h3>Mi espacio personal</h3><?php if(count($entradas) != 0){?><a class="crear-entrada" href="#">Crear una entrada</a> <?php }?></div>
            <hr class="mt-0">
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            
            <?php 
            if(count($entradas) == 0){?>
                Tu blog está vacío <a class="crear-entrada" href="#">Crea tu primera entrada del blog</a>
            <?php
            }else{
                //var_dump($entradas);
                ?>
                
                <table id="lista_entradas" class="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <th></th><th></th><th></th>
                    </tr>
                    </thead>
                
                </table>


            <?php }
            
            ?>

        </div>
    </div>
    
</div>
<script>
        //Rellenar entradas con datatables
    $(document).ready(function() {
        
        

        $('#lista_entradas').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "searching": false, 
            "lengthChange": false,
            "ordering": false,
            "info": false,
            "pageLength": 1,
            "pagingType": "full_numbers",
            "dom": 'lBfrtip',
            "language": {
                "paginate": {
                    "first": "<<",
                    "previous": "<",
                    "next": ">",
                    "last": ">>"
                }
            },
            "columnDefs": [
                {
                "targets": 0, // Índice de la columna que deseas omitir (basado en cero)
                "visible": false, // Hacer la columna invisible
                "searchable": false // Desactivar la búsqueda en la columna
                },
                {
                "targets": 1, // Índice de la segunda columna (basado en cero)
                "visible": true, // Hacer la segunda columna visible
                "searchable": false // Activar la búsqueda en la segunda columna
                },
                {
                "targets": 2, // Índice de la segunda columna (basado en cero)
                "visible": false, // Hacer la segunda columna visible
                "searchable": false // Activar la búsqueda en la segunda columna
                }
            ],
            "ajax":function (data, callback, settings) {
                $.ajax({
                url: "index.php?accion=datatablesEntradasUsuario&perfil=<?=$perfil->id_usuario?>",
                type: "POST",
                data: data,
                error: function(){
                    $("#post_list_processing").css("display","none");
                },
                success:async function(data){
                    data=$.parseJSON(data);
                    // Obtener los datos de la respuesta AJAX y actualizar el encabezado de la columna
                    var titulo = data.data[0][0]; // Supongamos que el título se encuentra en la propiedad "titulo" de la respuesta
                    var fecha = data.data[0][2];
                    var tabla = $('#lista_entradas').DataTable();
                    tabla.columns(1).header().to$().html(titulo + ' <span class="font-weight-normal font-weight-bold">'+fecha+'</span>'); // La columna se especifica con un índice basado en cero (0) o un selector jQuery
                    data.data[0][1] = await insertarVideoYouTube(data.data[0][1]);
                    // Devolver los datos para que DataTables los procese y muestre en la tabla
                    callback(data);
                    return data.data; //
                    
                
                }
            })}
        });
        $(document).off('click', '#yt-video');
        $(document).on('click', '#yt-video', function(event) {
            event.stopPropagation();
            var target = $(event.currentTarget);
            
            //console.log(target);
            if (target.is('#yt-video') || target.parents('#yt-video').length > 0) {
                //console.log("SOY EL TARGET!!!!");
                //console.log(target.data("youtube-url"));
                var modal = $('#videoModal');
                var scrollDiv = $('#contenedor-panel');
                var scrollbarWidth = scrollDiv[0].offsetWidth - scrollDiv[0].clientWidth;
                modal.css('right', scrollbarWidth);
                modal.prop('hidden', false);
                //modal.data('youtube-url', target.data('youtube-url')); // Almacenar el ID del botón en el modal
                modal.find('iframe').attr('src', target.data('youtube-url'));
                //modal.modal('show');
                

            }
        });

        $(document).off('click', '.crear-entrada');
        $(document).on('click', '.crear-entrada', function(event){
            $('#miModal').load('vistas/publicaciones/vistaCrearEntrada.php', function(){
                $('#miModal').modal('show');
            });

        });

        // Al cerrar el modal, restablecer el atributo src del iframe para detener la reproducción del video
        $('#videoModal .fa-xmark').off('click');
        $('#videoModal .fa-xmark').on('click', function(event) {
            var modal = $("#videoModal");
            modal.find('iframe').attr('src', '');
            modal.prop('hidden', true);
        });

        async function insertarVideoYouTube(cadena) {
            var regex = /(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+/g;
            var matches = cadena.match(regex);

            if (matches) {
                var urlYouTube = matches[0];
                var videoId = obtenerVideoId(urlYouTube);
                var response;
                try {
                    response=$.parseJSON(await obtenerJSONVideo('https://noembed.com/embed?url=http://www.youtube.com/watch?v='+videoId));
                    //console.log('Data:', response);
                } catch (error) {
                    console.log('Error:', error);
                }
                var embedHTML ='<div id="yt-video" data-toggle="modal" data-target="#videoModal" class="container"  data-youtube-url="https://www.youtube.com/embed/' + videoId +'"><div class="row"><div class="col-4"><img style="width:100%;height:auto;" src="'+response.thumbnail_url+'"/></div><div class="col-8">'+response.title+'</div></div></div> ';
                cadena = cadena.replace(urlYouTube, embedHTML);
                
            }
            cadena = cadena.replace(/\n/g, '<br />');
            return cadena;
        }

        function obtenerVideoId(url) {
            /*var regex = /[?&]v=([^&#]+)/;
            var matches = url.match(regex);
            return matches ? matches[1] : null;*/
            // Patrones de URL de YouTube
            var patrones = [
                /(?:https?:\/\/(?:www\.)?)?youtube(?:-nocookie)?\.(?:com|be)\/(?:watch\?(?:.*&)?v=|embed\/|v\/|u\/\w\/|playlist\?|embed\/videoseries\?list=)([^#\&\?\n]+)/,
                /^https?:\/\/youtu\.be\/([^#\&\?\n]+)/,
                /(?:https?:\/\/(?:www\.)?)?youtube(?:-nocookie)?\.com\/(?:attribution_link\?a=|v\/|embed\/|playlist\?|watch\?v=|watch\?.+&v=)([^#\&\?\n]+)/
            ];

            // Buscar el ID en los patrones
            for (var i = 0; i < patrones.length; i++) {
                var match = url.match(patrones[i]);
                if (match && match[1]) {
                    return match[1];
                }
            }

            // Si no se encuentra ningún ID válido
            return null;
        }

        function obtenerJSONVideo(url) {
            return Promise.resolve($.ajax({
                url: url
            }));
        }
        



    });
    </script>