<h3>Novedades de tus amigos</h3>
<hr>
<div class="container novedades" style="">
    <?php foreach ($novedades as $amigo){ 
        $amigo->entradas = array_filter(
            $amigo->notificaciones,
            function($obj){ 
               return $obj->tipo === 5;
        });
        $amigo->nEntradas=count($amigo->entradas);

        $amigo->comentarios = array_filter(
            $amigo->notificaciones,
            function($obj){ 
               return $obj->tipo === 3;
        });
        $amigo->nComentarios=count($amigo->comentarios);
        
        ?>
        <div class="row" style="">
            <div class="col-2 " style="">
                <img class="fotoPerfilNovedades w-100" style="    border-radius: 50%;aspect-ratio:1/1;"src="<?=$amigo->perfil->foto_de_perfil; ?>"/>
            </div>
            <div class="col-10" style="">
                <?='<b><a href="#">'.$amigo->nombre_usuario."</a></b> <span>".$amigo->estado->contenido."</span>"?>
                <div class="container entradas" style="">
                    <div class="row" style="">
                        <div class="col-3" style="">
                            <?php if( $amigo->nEntradas > 1){
                                echo $amigo->nEntradas." Entradas nuevas";
                            }else if( $amigo->nEntradas == 1){
                                echo $amigo->nEntradas." Entrada nueva";
                            } ?>
                            
                        </div>
                        <div class="col-9" style="">
                            <?php 
                                
                            foreach($amigo->entradas as $entrada){  ?>
                                <div class="container entrada" style="">
                                    <div class="row" style="">
                                        <div class="col-12 entrada" style="">
                                        <?=$entrada->contenido?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        
                </div>
                <div class="container comentarios" style="">
                    <div class="row" style="">
                        <div class="col-3" style="">
                            <?php if( $amigo->nComentarios > 1){
                                echo $amigo->nComentarios." Comentarios";
                            }else{
                                echo $amigo->nComentarios." Comentario";
                            } ?>
                            
                        </div>
                        <div class="col-9" style="">
                            <?php 
                                
                            foreach($amigo->comentarios as $comentario){  ?>
                                <div class="container" style="">
                                    <div class="row" style="">
                                        <div class="col-12 entrada" style="">
                                        <?=$comentario->contenido?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        
                </div>
            </div>
            <div class="row">
                <div class="col-9"></div><div class="col-3"><?=$amigo->ultima_publicacion?></div>
            </div>
            <hr>
        </div>
        
            
        
    <?php } ?>



