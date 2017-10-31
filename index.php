<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 31/10/2017
 * Time: 15:44
 */?>

<?php

    include ("Conexion/conexionBBDD.php");

    /*
     * Para la insercion, comprobamos que el metodo post que le enviamos al formulario no este vacio
     *
     * Luego en variables guardamos todos los datos que cogemos del formulario con $_POST[nombre de la propiedad]
     * Con el mysqli_real_escape_string, lo que conseguimos es que no se introduzcan datos extraños, solo introduce
     * datos que acorde con la nomenclatura de nuestra BBDD
     *
     * Antes de insertar, comprobamos si el usuario existe haciendo una consulta, si existe lo notificamos, sino
     * Hacemos nuestro insert y con el metodo query le pasamos el insert y luego notificamos al usuario
     */
    if (!empty($_POST)){
        $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
        $edad = intval(mysqli_real_escape_string($conexion, $_POST['edad']));
        $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);

        $verUser = "SELECT * FROM alumnos WHERE dni = '$dni'";

        $existUser = $conexion->query($verUser);
        $filas = $existUser->num_rows;

        if ($filas > 0){
            echo "<script>
                    alert('El usuario ya existe');
                    window.location = 'index.php';
                    </script>";
        }else{
            $sqlUser = "Insert into alumnos (dni, nombre, apellidos, edad, telefono) VALUES ('$dni', '$nombre', '$apellidos', '$edad', '$telefono')";

            $result = $conexion->query($sqlUser);

            if ($result > 0){
                echo "<script>
                    alert('El usuario se ha insertado correctamente');
                    window.location = 'index.php';
                    </script>";
            }else{
                echo "<script>
                    alert('Error al registrar');
                    window.location = 'index.php';
                    </script>";
            }
        }

    }

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

    <h3 align="center">Registro de usuarios</h3>

    <!-- $_SERVER funcion que se ejecuta en el servidor toda la info que le enviamos
        PHP_SELF -> para que se ejecute en el mismo lugar
    -->
    <form action="<?php $_SERVER["PHP_SELF"]?> " method="post">
        Datos del usuario

        <input type="text" name="dni" placeholder="Introduzca el dni" required>
        <input type="text" name="nombre" placeholder="Introduzca su nombre" required>
        <input type="text" name="apellidos" placeholder="Introduzca sus apellidos" required>
        <input type="number" name="edad" placeholder="Introduzca su edad" required>
        <input type="text" name="telefono" placeholder="Introduzca su teléfono" required>

        <input type="submit" name="guardar" value="Dar de alta">


    </form>

    <hr>

    <h4 align="center">Usuarios en el sistema</h4>

    <table>

        <thead>

            <tr>

                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Editar</th>
                <th>Eliminar</th>

            </tr>

        </thead>

        <!-- Se agregan los datos dinamos desde la BBDD -->
        <?php
            $consultaAlumnos = "SELECT * FROM alumnos";

            $resultado = $conexion->query($consultaAlumnos);
        ?>

        <tbody>

                <?php
                //El MYSQLI_BOTH dentro del fetch_array, nos devuelve todos los resultados en un array
                    while ($datos = $resultado->fetch_array(MYSQLI_BOTH)){
                        echo"<tr>
                                <td>".$datos['dni']."</td>
                                <td>".$datos['nombre']."</td>
                                <td>".$datos['apellidos']."</td>
                                <td>".$datos['edad']."</td>
                                <td>".$datos['telefono']."</td>
                                <td><a href='editarDatos.php?dni=".$datos['dni']."'>Editar</a> </td>
                                <td><a href='borrarDatos.php?dni=".$datos['dni']."'>Borrar</a> </td>
                            </tr>";
                    }

                    $conexion->close();
                ?>

        </tbody>

    </table>

</body>
</html>