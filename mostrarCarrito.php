<?php

include 'global/conexion.php';
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';

?>

<?php if(!empty($_SESSION['CARRITO'])){ ?>

    <br>
    <br>
    <br>
    
<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <th width="40%">Producto Agregado</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
        
        <?php
        $total = 0;
        // se debe abrir un foreach en la fila del producto para poder
        // visualizar los elemeentos agregados al carriito
        foreach($_SESSION['CARRITO'] as $producto) { ?>
        <tr>
            <td width="40%"><?php echo $producto['NOMBRE'] ?></td>
            <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
            <td width="20%" class="text-center"><?php echo $producto['PRECIO'] ?></td>
            <td width="20%" class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2); ?></td>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);?>">
                <td width="5%"><button class="btn btn-danger" name="btnAccion" value="eliminar" type="submit">Eliminar</button></td>
            </form>
        </tr>
        <?php
        $total = $total +($producto['PRECIO']*$producto['CANTIDAD']);
        } // cierre el foreach ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3><?php echo number_format($total,2); ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <form action="pagar.php" method="POST">
                    <div class="alert alert-primary" role="alert">
                        <div class="form-group">
                            <label for="email">Correo de contacto</label>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Digite su correo" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            Los productos se enviaran a este correo
                        </small>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">Proceder a pagar</button>
                </form>
            </td>
        </tr>
        
    </tbody>
</table>

<?php } else{?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito
    </div>

<?php } ?>



<?php include 'templates/pie.php'; ?>