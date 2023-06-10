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
    $tabla = isset($_SESSION['tabla']) ? $_SESSION['tabla'] : array();

    // Agregar los nuevos datos a la tabla
    $fila = array(
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
    $tabla[] = $fila;

    // Guardar la tabla actualizada en la sesión
    $_SESSION['tabla'] = $tabla;

    // Mostrar la tabla con todos los datos
    echo "<table>";
    echo "<br><br><br>";
    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Edad</th><th>Email</th><th>Horario</th><th>Team</th><th>Entrenador</th></tr>";
    foreach ($tabla as $fila) {
        echo "<tr>";
        echo "<td>".$fila['nombre']."</td>";
        echo "<td>".$fila['apellidos']."</td>";
        echo "<td>".$fila['direccion']."</td>";
        echo "<td>".$fila['edad']."</td>";
        echo "<td>".$fila['email']."</td>";
        echo "<td>".$fila['horario']."</td>";
        echo "<td>".$fila['team']."</td>";
        echo "<td>".$fila['entrenador']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    // session_destroy();
    echo "<br><br>";
    $credenciales["http"]["method"] = "POST";
    $credenciales["http"]["header"] = "Content-type: application/json";
    $data = [
        "cedula"=>$cedula,
        "nombre"=> $nombre,
        "apellidos"=> $apellidos,
        "direccion"=> $direccion,
        "edad"=> $edad,
        "email"=>$email,
        "horario"=>$horario,
        "team"=>$team,
        "entrenador"=>$entrenador
    ];
    $data = json_encode($data);
    $credenciales["http"]["content"] = $data;
    $config = stream_context_create($credenciales);
    
    $_DATA = file_get_contents("https://648136c029fa1c5c50313005.mockapi.io/informacion", false, $config);
    // print_r($_DATA);


    // session_destroy();
}else if (isset($_POST['buscar'])) {
    $cedula = ($_POST['cedula']) ;
    $_DATA2 = file_get_contents("https://648136c029fa1c5c50313005.mockapi.io/informacion/"."?cedula=".$cedula);
    
    
    $resultado = json_decode($_DATA2,true);
    $resultado = $resultado[0];
    // Verificar si se encontraron datos para la cédula especificada
    if (!empty($resultado)) {
        $nombre = $resultado[0]['nombre'];
        $apellidos = $resultado[0]['apellidos'];
        $direccion = $resultado[0]['direccion'];
        $edad = $resultado[0]['edad'];
        $email = $resultado[0]['email'];
        $horario = $resultado[0]['horario'];
        $team = $resultado[0]['team'];
        $entrenador = $resultado[0]['entrenador'];
    }
    // print_r($resultado);
    
}else if(isset($_POST['editar'])){
    $cedula = ($_POST['cedula']) ;
    $_DATA3 = file_get_contents("https://648136c029fa1c5c50313005.mockapi.io/informacion/"."?cedula=".$cedula);
}


?>

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
                    <input type="text" placeholder="NOMBRE" name="nombre" value="<?php echo isset($resultado) ? $resultado["nombre"] : ''; ?>">
                    <input type="text" placeholder="APELLIDOS" name="apellidos" value="<?php echo isset($resultado) ? $resultado["apellidos"] : ''; ?>">
                    <input type="text" placeholder="DIRECCIÓN" name="direccion" value="<?php echo isset($resultado) ? $resultado["direccion"] : ''; ?>">
                </div>
                <div class="columna">
                    <h1 class="campus">CAMPUSLANDS</h1>
                    <input type="number" placeholder="EDAD" name="edad" value="<?php echo isset($resultado) ? $resultado["edad"] : ''; ?>">
                    <input type="email" placeholder="EMAIL" name="email" value="<?php echo isset($resultado) ? $resultado["email"] : ''; ?>">
                </div>
            </div>
            <br><br><br>
            <div class="fila">
                <div class="columna">
                    <input type="time" placeholder="HORARIO DE ENTRADA" name="horario" value="<?php echo isset($resultado) ? $resultado["horario"] : ''; ?>">
                    <input type="text" placeholder="TEAM" name="team" value="<?php echo isset($resultado) ? $resultado["team"] : ''; ?>">
                    <input type="text" placeholder="ENTRENADOR" name="entrenador" value="<?php echo isset($resultado) ? $resultado["entrenador"] : ''; ?>">
                </div>
                <div class="columna">
                    <button type="submit" name="guardar">Guardar</button>
                    <button type="submit" name="editar">Editar</button>
                    <button type="submit" name="buscar">buscar</button>
                    <button type="submit" name="eliminar">Eliminar</button>
                    <input type="text" placeholder="CÉDULA" name="cedula" value="<?php echo isset($resultado) ? $resultado["cedula"] : ''; ?>">
                </div>
            </div>
            <br><br><br>
        </div>
    </form>
</body>
</html>
