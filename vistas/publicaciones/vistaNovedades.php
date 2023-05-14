<h2>Novedades de tus amigos</h2>
<hr>
<div class="container" style="">
    <?php foreach ($novedades as $novedadAmigo){ ?>
        <div class="row" style="">
            <div class="col-2 " style="">
                <img class="fotoPerfilNovedades w-100" src="<?=$perfil["foto_de_perfil"]; ?>"/>
            </div>
            <div class="col-10" style="">
                <div class="container" style="">
                    <?php foreach($novedadAmigo->notificaciones as $notificacion){ ?>
                    <div class="row" style="">
                        <div class="col-12" style="">
                            <?=$notificacion?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <hr>
        </div>
    <?php } ?>



