<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta DB</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Utilizando colores de Bootstrap */
        }
        table {
            border: solid 2px #7e7c7c;
            border-collapse: collapse;
        }

        th, h1 {
            background-color: #edf797;
        }

        td, th {
            border: solid 1px #7e7c7c;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Registros Realizados</h1>
    <?php
    //validamos datos del servidor
    $user = "root";
    $pass = "";
    $host = "localhost";

    //conetamos al base datos
    $connection = mysqli_connect($host, $user, $pass);

    //hacemos llamado al imput de formulario
    $nombre = $_POST["nombre"] ;
    $usuario = $_POST["usuario"] ;
    $contraseña = $_POST["contraseña"] ;

    //verificamos la conexion a base datos
    if(!$connection) 
    {
        echo "No se ha podido conectar con el servidor" . mysql_error();
    }
    else
    {
        echo "<b><h3>Usted se ha conectado al servidor</h3></b>" ;
    }
    //indicamos el nombre de la base datos
    $datab = "dbfinal";
    //indicamos selecionar ala base datos
    $db = mysqli_select_db($connection,$datab);

    if (!$db)
    {
        echo "No se ha podido encontrar la Tabla";
    }
    else
    {
        echo "<h3>Tabla seleccionada:</h3>" ;
    }
    //insertamos datos de registro al mysql xamp, indicando nombre de la tabla y sus atributos
    $instruccion_SQL = "INSERT INTO tabla_form (nombre, usuario, contraseña)
                             VALUES ('$nombre','$usuario','$contraseña')";
                           
                            
    $resultado = mysqli_query($connection,$instruccion_SQL);

    //$consulta = "SELECT * FROM tabla where id ='2'"; si queremos que nos muestre solo un registro en especifivo de ID
    $consulta = "SELECT * FROM tabla_form";
        
    $result = mysqli_query($connection,$consulta);
    if(!$result) 
    {
        echo "No se ha podido realizar la consulta";
    }
    echo "<table class='table'>";
    echo "<thead class='thead-light'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>Nombre</th>";
    echo "<th>Usuario</th>";
    echo "<th>Contraseña</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($colum = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $colum['id']. "</td>";
        echo "<td>" . $colum['nombre']. "</td>";
        echo "<td>" . $colum['usuario'] . "</td>";
        echo "<td>" . $colum['contraseña'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    mysqli_close( $connection );

    //echo "Fuera " ;
    echo '<a href="index.html" class="btn btn-primary">Volver Atrás</a>';
    ?>
</div>
</body>
</html>
