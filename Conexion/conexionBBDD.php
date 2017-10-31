<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 31/10/2017
 * Time: 16:24
 */
/*
 * En conexion obtenemos los datos para realizar la conexion, vemos que en fichero
 * configBD tenemos todos los datos que queremos usar
 *
 * En el if, solo se cumple si la conxeion es erronea con lo cual muestra el if con el
 * error producido
 */

include ("configBD.php");

$conexion = new mysqli($server, $user, $pass, $dbName );

if (mysqli_connect_errno()){
    echo "No se pudo conectar: ", mysqli_connect_error();
    exit();
}else{
    echo "Conectado a la BBDD";
}