<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación Campus</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<form action="index.php" method="POST">
<div class="content">
    <div class="fila">
        <div class="columna">
            <input type="text" placeholder="NOMBRE" name="nombre" value="<?php echo isset($_SESSION['datos']['nombre']) ? $_SESSION['datos']['nombre'] : ''; ?>">
            <input type="text" placeholder="APELLIDOS" name="apellidos" value="<?php echo isset($_SESSION['datos']['apellidos']) ? $_SESSION['datos']['apellidos'] : ''; ?>">
            <input type="text" placeholder="DIRECCIÓN" name="direccion" value="<?php echo isset($_SESSION['datos']['direccion']) ? $_SESSION['datos']['direccion'] : ''; ?>">
        </div>
        <div class="columna">
            <h1 class="campus">CAMPUSLANDS</h1>
            <input type="number" placeholder="EDAD" name="edad" value="<?php echo isset($_SESSION['datos']['edad']) ? $_SESSION['datos']['edad'] : ''; ?>">
            <input type="email" placeholder="EMAIL" name="email" value="<?php echo isset($_SESSION['datos']['email']) ? $_SESSION['datos']['email'] : ''; ?>">
        </div>
    </div>
        <br><br><br>
    <div class="fila">
        <div class="columna">
            <input type="date" placeholder="HORARIO DE ENTRADA" name="horario" value="<?php echo isset($_SESSION['datos']['horario']) ? $_SESSION['datos']['horario'] : ''; ?>">
            <input type="number" placeholder="TEAM" name="team" value="<?php echo isset($_SESSION['datos']['team']) ? $_SESSION['datos']['team'] : ''; ?>">
            <input type="text" placeholder="ENTRENADOR" name="entrenador" value="<?php echo isset($_SESSION['datos']['entrenador']) ? $_SESSION['datos']['entrenador'] : ''; ?>">
        </div>
        <div class="columna">
            <button type="submit" name="guardar">Guardar</button>
            <button type="submit" name="editar">Editar</button>
            <button>Eliminar</button>
            <input type="text" placeholder="CÉDULA" name="cedula" value="<?php echo isset($_SESSION['datos']['cedula']) ? $_SESSION['datos']['cedula'] : ''; ?>">
        </div>
    </div>
    <br><br><br>
</div>
</form>
<?php
session_start();

if (isset($_POST['guardar'])) {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : "";
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : "";
    $edad = isset($_POST['edad']) ? $_POST['edad'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $horario = isset($_POST['horario']) ? $_POST['horario'] : "";
    $team = isset($_POST['team']) ? $_POST['team'] : "";
    $entrenador = isset($_POST['entrenador']) ? $_POST['entrenador'] : "";
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : "";

    // Obtener los datos guardados en la sesión
    $datos = isset($_SESSION['datos']) ? $_SESSION['datos'] : array();

    // Agregar los nuevos datos a la sesión
    $datos = array(
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'direccion' => $direccion,
        'edad' => $edad,
        'email' => $email,
        'horario' => $horario,
        'team' => $team,
        'entrenador' => $entrenador,
        "cedula" => $cedula
    );
    $_SESSION['datos'] = $datos;

    // Mostrar la tabla con todos los datos
    echo "<table>";
    echo "<br><br><br>";
    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Edad</th><th>Email</th><th>Horario</th><th>Team</th><th>Entrenador</th></tr>";
    echo "<tr>";
    echo "<td>".$datos['nombre']."</td>";
    echo "<td>".$datos['apellidos']."</td>";
    echo "<td>".$datos['direccion']."</td>";
    echo "<td>".$datos['edad']."</td>";
    echo "<td>".$datos['email']."</td>";
    echo "<td>".$datos['horario']."</td>";
    echo "<td>".$datos['team']."</td>";
    echo "<td>".$datos['entrenador']."</td>";
    echo "</tr>";
    echo "</table>";
    session_destroy();
    echo "<br><br>";

    // Realizar el envío de datos a través de la API
    $url = 'https://648136c029fa1c5c50313005.mockapi.io/informacion';
    $data = array(
        'cedula' => $datos['cedula'],
        'nombre' => $datos['nombre'],
        'apellidos' => $datos['apellidos'],
        'direccion' => $datos['direccion'],
        'edad' => $datos['edad'],
        'email' => $datos['email'],
        'horario' => $datos['horario'],
        'team' => $datos['team'],
        'entrenador' => $datos['entrenador']
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === false) {
        echo "Error al enviar los datos a la API";
    } else {
        echo "Los datos se enviaron correctamente a la API";
    }
} elseif (isset($_POST['editar'])) {
    // Almacenar los datos en la sesión
    $_SESSION['datos'] = array(
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'direccion' => $_POST['direccion'],
        'edad' => $_POST['edad'],
        'email' => $_POST['email'],
        'horario' => $_POST['horario'],
        'team' => $_POST['team'],
        'entrenador' => $_POST['entrenador'],
        'cedula' => $_POST['cedula']
    );
}
?>
</body>
</html>
