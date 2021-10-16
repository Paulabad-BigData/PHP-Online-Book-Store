<?php


    /* Para iniciar sesión */
    session_start();

    $mensaje ="";

    /* Recepcionar las variables que vienen desde el formulario */
    /*
    $id = $_POST['ID']; //Se recepciona la variale id que viene desde el input encryptada 
    $ID = openssl_decrypt($id,COD,KEY);

    $nombre = $_POST['Nombre'];
    $NOMBRE = openssl_decrypt($nombre,COD,KEY);

    $precio = $_POST['Precio'];
    $PRECIO = openssl_decrypt($precio,COD,KEY);
    
    $cantidad = $_POST['Cantidad'];
    $CANTIDAD = openssl_decrypt($cantidad,COD,KEY);
    */
    

    if(isset($_POST['btnAccion'])){   /* isset devuelve true o false */
        switch($_POST['btnAccion']){
            case 'Agregar':
                $id = $_POST['id'];
                $miId = openssl_decrypt($id,COD,KEY);

                // Hacer validad adicional de seguridad comprobar que cada dato que llego es numerico
                if(is_numeric($miId)){
                    $ID = $miId;
                    $mensaje1 = "ID correcto.." . $ID."<br/>";
                }
                else{
                    $mensaje1 = "ID incorrecto.". $ID."<br/>";
                }

                $nombre = $_POST['nombre'];
                $miNombre = openssl_decrypt($nombre,COD,KEY);
                if(is_string($miNombre)){
                    $NOMBRE = $miNombre;
                    $mensaje2 = "El nombre es correcto.." . $NOMBRE."<br/>";
                }
                else{
                    $mensaje2 = "El nombre no es correcto". $NOMBRE."<br/>";
                }

                if(is_numeric(openssl_decrypt( $_POST['cantidad'], COD,KEY))){
                    $CANTIDAD = openssl_decrypt( $_POST['cantidad'], COD,KEY);
                    $mensaje4 = "La cantidad es correcto.." . $CANTIDAD;
                }
                else{
                    $mensaje4 = "La cantidad no es correcto";
                }

                if(is_numeric(openssl_decrypt( $_POST['precio'], COD, KEY))){
                    $PRECIO = openssl_decrypt( $_POST['precio'], COD, KEY);
                    $mensaje4="El precio es... ".$PRECIO."<br/>";
                }else{
                    $mensaje4="Upss... ID Incorrecto".$PRECIO."<br/>";
                break;
                }

                if(!isset($_SESSION['CARRITO'])){

                    $producto = array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=>$CANTIDAD,
                        'PRECIO'=>$PRECIO
                    );
                    $_SESSION['CARRITO'][0] = $producto;
                    $mensaje = "Producto agregado al carrito";
                }
                else{  // es decir si ya el arreglo CARRITO contiene algun producto
                        // Ahora validaremos que el producto seleccionado no esté dentro del carrito
                        // idProductos tendrá todos los ID del carrito de compras
                    $idProductos=array_column($_SESSION['CARRITO'],"ID");
                    /*
                    $numeroProductos = count($_SESSION['CARRITO']);  // cuenta cuantos elementos hay en el array CARRITO
                    $producto = array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=>$CANTIDAD,
                        'PRECIO'=>$PRECIO
                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                    */
                }  // cierro primer else
                
                //$mensaje = print_r($_SESSION,true);

                if(in_array($ID,$idProductos)){
                    echo "<sript>alert('El producto ya ha sido seleccionado')</scrip>";
                }
                else {
                    $numeroProductos = count($_SESSION['CARRITO']);  // cuenta cuantos elementos hay en el array CARRITO
                    $producto = array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'CANTIDAD'=>$CANTIDAD,
                        'PRECIO'=>$PRECIO
                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                    $mensaje = "Producto agregado al carrito";
                } // cierre segundo else

            break;

            case 'eliminar':
                $id = $_POST['id'];
                $miId = openssl_decrypt($id,COD,KEY);
                if(is_numeric($miId)){
                    $ID = $miId;
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){
                        if($producto['ID']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>alert('Elemento Borrado');</script>";
                        }
                    }
                }else{
                    $mensaje1="Upss... ID Incorrecto".$ID."<br/>";
                }
            break;
            
    

        } /* Cierro el swicth */
    } /* cierro el principal */
    
    
?>

