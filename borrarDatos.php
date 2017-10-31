<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 31/10/2017
 * Time: 18:19
 */

include ("Conexion/conexionBBDD.php");

$dniUser = $_GET['dni'];

$query = "DELETE FROM alumnos WHERE dni = '$dniUser'";

$result = $conexion->query($query);

if ($result){
   echo "<script>
            alert('Se ha borrado el usuario');
            window.location='index.php';
            </script>";
}else{
    echo "<script>
            alert('No se ha borrado el usuario');
            window.location='index.php';
            </script>";
}

$conexion->close();