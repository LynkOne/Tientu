
<div class="mis-entradas container">
    <div class="row">
        <div class="col-12">
            <h3>Mi espacio personal</h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            
            <?php 
            if(count($entradas) == 0){?>
                Tu blog está vacío <a href="#">Crea tu primera entrada del blog</a>
            <?php
            }else{
                var_dump($entradas);
            }
            
            ?>

        </div>
    </div>
    <script>
    $(document).ready(function() {
        

    });
    </script>
</div>
