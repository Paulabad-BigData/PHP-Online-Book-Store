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
<br>
<?php

if($_POST){  // evalúo si hubo envío de datos
    $total = 0;
    $SID = session_id(); //esto fue después

    $correo = $_POST['email']; // aquí primero puso esto "andres@hotmail.com";
    foreach($_SESSION['CARRITO'] as $indice=>$producto){ // primer foreach
        $total = $total + ($producto['PRECIO']*$producto['CANTIDAD']);
    } // cierre foreach

    $miobjeto = new metodos;
    $datos = array(
        $SID,
        '',
        $correo,
        $total,
        'en proceso');

    /*
    $datos = array(
        '20987654321',
        '',
        'paula@gmail.com',
        '987',
        'en proceso');
    */

    echo 'A continuación retono el resultado del proceso de inserción en la tabla ventas ';
    $miobjeto->insertarDatos1($datos);

    echo "<br>";

    echo 'a continuación retorno el ID de la venta';
    echo $miobjeto->retornarID();

    $idVenta = $miobjeto->retornarID();

    foreach($_SESSION['CARRITO'] as $indice=>$producto){

        $datos2 = array(
            $idVenta, // array en la posición 0, corresponde a la columna IDVENTA
            $producto['ID'],
            $producto['PRECIO'],
            $producto['CANTIDAD'],
            '0'
        ); // cierro el array de $datos2

        echo "<br>";
        echo 'a continuación retorno el resultado de la inserción en la tabla detalleventas por cada producto agregado';
        echo $miobjeto->insertarDatos2(($datos2));
    } // cierre el foreac. Fue necesario por cada producto agregado al carrito

    echo "<h3>" .$total . "</h3>";
} // cierro el if que verifica si hubo envío de datos

?>

<?php include 'templates/pie.php'; ?>