<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facturacion Campus</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<div class="content">
    <div class="fila">
        <div class="columna">
            <input type="text" placeholder="NOMBRE">
            <input type="text" placeholder="APELLIDOS">
            <input type="text" placeholder="DIRECCION">
        </div>
        <div class="columna">
            <h1 class="campus">CAMPUSLANDS</h1>
            <input type="number" placeholder="EDAD">
            <input type="email" placeholder="EMAIL">
        </div>
    </div>
        <br><br><br>
    <div class="fila">
        <div class="columna">
            <input type="date" placeholder="HORARIO DE ENTRADA">
            <input type="number" placeholder="TEAM">
            <input type="text" placeholder="TRAINER">
        </div>
        <div class="columna">
            <button>Guardar</button>
            <button>ediar</button>
            <button>eliminar</button>
            <input type="text" placeholder="CEDULA">
        </div>
    </div>
    <br><br><br>
    <?php
    $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : "";
    $apellido = isset($_GET['apellido']) ? $_GET['apellido'] : "";
    $email = isset($_GET['email']) ? $_GET['email'] : "";
    $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : "";

    // Crear la tabla con los datos obtenidos
    echo "<table>";
    echo '<a href="index.html">Volver</a>';
    echo "<br><br><br>";
    echo "<tr><th>Fecha</th><td>$fecha</td></tr>";
    echo "<tr><th>Nombre</th><td>$nombre</td></tr>";
    echo "<tr><th>Apellido</th><td>$apellido</td></tr>";
    echo "<tr><th>Email</th><td>$email</td></tr>";
    echo "<tr><th>Contraseña</th><td>$direccion</td></tr>";
    echo "</td></tr>";
    echo '<a href="index.html">enviar</a>';
    echo "<br><br><br>";
    echo "</table>";
    ?>
</div>
</body>
</html>