<?php

class metodos{
    static $lastid;

    public function mostrarDatos($sql){   //este servirá para consultar en la bd
        $sena = new conectar;    //creo un objeto de la clase conectar
        $cone = $sena->conexion(); //llamo al método conexion() y lo asigno a la variable $conexion

        $resultado = mysqli_query($cone,$sql); //se hace la consulta
        return mysqli_fetch_all($resultado,MYSQLI_ASSOC); // se debe mostrar la consulta
    }

    public function insertarDatos1($datos){
        $sena = new conectar;
        $conexion = $sena->conexion();

        // datos[3] corresponde a la fecha que ya no la introduciré manual
        $sql = "INSERT INTO `tblventas` (`ID`, `Clave Transaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) VALUES (NULL, '$datos[0]', '$datos[1]', 'NOW()', '$datos[2]', '$datos[3]', '$datos[4]'); ";

        $resultado = mysqli_query($conexion,$sql);
        metodos::$lastid = mysqli_insert_id($conexion);
        return $resultado;

    } // cierre método insertarDatos1

    public function retornarID() {
        return metodos::$lastid;
    }

    
    public function insertarDatos2($datos2){
        $sena = new conectar;    
        $conexion = $sena->conexion();
        $sql = "INSERT INTO `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) VALUES (NULL, '$datos2[0]', '$datos2[1]', '$datos2[2]', '$datos2[3]', '$datos2[4]');";

        $resultado2 = mysqli_query($conexion,$sql);
        
        return $resultado2;
    }
    
   
}

?>