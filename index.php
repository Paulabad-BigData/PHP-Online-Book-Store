<?php

include 'global/conexion.php';
include 'global/metodosBd.php';
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';

?>




    
        <br>
        <br>
        <br>
        <?php if($mensaje!=" "){ ?>
        <div class="alert alert-primary" role="alert">
            
            <?php 
                echo $mensaje; //$mensaje1 . " " . $mensaje2 . " " . $mensaje3 . " " . $mensaje4;
                // echo $mensaje;
            ?>
            <a href="mostrarCarrito.php" class="badge badge-warning">Ver carrito</a>
            

        </div>
        <?php } ?>
        <div class="row"> <!--div de las filas -->
        
        <?php

            $miobjeto = new metodos;
            $sql = "SELECT * FROM productos";
            $datos = $miobjeto->mostrarDatos($sql);

            // es un ciclo solo para recorrer arrays 
            foreach($datos as $mostrar){
                /*
                echo $mostrar['ID'];
                echo $mostrar['Nombre'];
                echo $mostrar['Precio'];
                echo $mostrar['Descripcion'];
                echo $mostrar['Imagen'];
                */

        ?>

            <div class="col-3"> <!-- Inicio columna -->
                <div class="card">
                    <div class="card-body">
                        <img class="card-img-top" height="280" src="<?php echo $mostrar['Imagen']; ?>" alt="" data-toggle="popover" title="Popover title" data-trigger="hover" data-content="<?php echo $mostrar['Descripcion'];?>">
                        <span><?php  echo $mostrar['Nombre']; ?></span>
                        <h5 class="card-title">$<?php echo $mostrar['Precio']; ?></h5>
                        <p class="card-text"><!--<?php echo $mostrar['Descripcion'];?>--></p>
                        
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo openssl_encrypt($mostrar['ID'],COD,KEY); ?>">
                            <input type="hidden" name="nombre" value="<?php echo openssl_encrypt ($mostrar['Nombre'],COD,KEY);?>">
                            <input type="hidden" name="precio" value="<?php echo openssl_encrypt ($mostrar['Precio'],COD,KEY);?>">
                            <input type="hidden" name="cantidad" value="<?php echo openssl_encrypt(1,COD, KEY); ?>">
                            
                            <button class="btn btn-primary" type="submit" name="btnAccion" value="Agregar">Agregar al Carrito</button>
                        </form>
                        
                    </div>
                </div>    
            </div>
            <?php }    ?> <!-- cierre del foreach -->

        </div>
    </div> <!-- Cierre del container -->

   
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $(function () {
        $('[data-toggle="popover"]').popover()
        })
    </script>

<?php include 'templates/pie.php'; ?>