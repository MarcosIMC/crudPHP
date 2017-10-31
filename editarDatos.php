<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 31/10/2017
 * Time: 18:19
 */


include ("Conexion/conexionBBDD.php");

$dniUser = $_GET['dni'];

$usuario = "SELECT * FROM alumnos WHERE dni = '$dniUser'";

//var_dump($usuario);die;

$resultadoUsuario = $conexion->query($usuario);

//Con fetch_assoc obtenemos los datos dato a dato
$filas = $resultadoUsuario->fetch_assoc();

?>

<!DOCTYPE html>

<html lang="es">

<head>
    <title>Titulo de la web</title>
    <meta charset="utf-8" />
</head>

<body>
<header>
    <h1>Mi sitio web</h1>
    <p>CRUD PHP</p>
</header>

<h3 align="center">Modificar usuario</h3>

<!-- $_SERVER funcion que se ejecuta en el servidor toda la info que le enviamos
    PHP_SELF -> para que se ejecute en el mismo lugar
-->
<form action="<?php $_SERVER["PHP_SELF"]?> " method="post">
    Datos del usuario

    DNI --> <input type="text" name="dni" value="<?php echo $filas['dni']?>" disabled required>
    <br>
    Marcos --> <input type="text" name="nombre" value="<?php echo $filas['nombre']?>"  required>
    <br>
    Apellidos --> <input type="text" name="apellidos" value="<?php echo $filas['apellidos']?>" required>
    <br>
    Edad --> <input type="number" name="edad" value="<?php echo $filas['edad']?>" required>
    <br>
    Teléfono --> <input type="text" name="telefono" value="<?php echo $filas['telefono']?>" required>

    <br>
    <br>
    <input type="submit" name="modificar" value="Modificar">


</form>

<?php
    if (isset($_POST['modificar'])){
        //$dni = $_POST['dni'];
        $name = $_POST['nombre'];
        $surname = $_POST['apellidos'];
        $age = $_POST['edad'];
        $number = $_POST['telefono'];


        $sqlUpdate = "UPDATE alumnos SET nombre = '$name', apellidos = '$surname', edad = '$age', telefono = '$number' 
                        WHERE dni = '$dniUser'";

        $result = $conexion->query($sqlUpdate);

        if ($result){
            echo "<script>
                    alert('El usuario se ha modificado correctamente');
                    window.location='index.php';
                   </script>";
        }else{
            echo "<script>
                    alert('El usuario no se ha podido modificar');
                    window.location='index.php';
                   </script>";
        }

    }

    $conexion->close();
?>

<hr>

<h4 align="center">Usuarios en el sistema</h4>



</body>
</html>