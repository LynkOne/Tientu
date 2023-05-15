<h2>Novedades de tus amigos</h2>
<hr>
<div class="container novedades" style="">
    <?php foreach ($novedades as $amigo){ 
        $estados = array_filter(
            $amigo->notificaciones,
            function($obj){ 
               return $obj->tipo === 1;
        });
        $amigo->nEstados=count($estados);
        
        ?>
        <div class="row" style="">
            <div class="col-2 " style="">
                <img class="fotoPerfilNovedades w-100" style="    border-radius: 50%;aspect-ratio:1/1;"src="<?=$perfil["foto_de_perfil"]; ?>"/>
            </div>
            <div class="col-10" style="">
                <?=$amigo->nombre_usuario?>
                <div class="container" style="">
                    <div class="row" style="">
                        <div class="col-3" style="">
                            <?php if( $amigo->nEstados > 1){
                                echo $amigo->nEstados." Entradas nuevas";
                            }else{
                                echo $amigo->nEstados." Entrada nueva";
                            } ?>
                            
                        </div>
                        <div class="col-9" style="">
                            <?php 
                                
                            foreach($estados as $estado){  ?>
                                <div class="container" style="">
                                    <div class="row" style="">
                                        <div class="col-12 entrada" style="">
                                        <?=$estado->contenido?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        
                </div>
                <div class="container" style="">
                    <div class="row" style="">
                        <div class="col-3" style="">
                            <?php if( $amigo->nEstados > 1){
                                echo $amigo->nEstados." Entradas nuevas";
                            }else{
                                echo $amigo->nEstados." Entrada nueva";
                            } ?>
                            
                        </div>
                        <div class="col-9" style="">
                            <?php 
                                
                            foreach($estados as $estado){  ?>
                                <div class="container" style="">
                                    <div class="row" style="">
                                        <div class="col-12 entrada" style="">
                                        <?=$estado->contenido?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        
                </div>
            </div>
            <hr>
        </div>
    <?php } ?>



