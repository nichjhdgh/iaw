
<?php

$mensaje = 'La acción NO se ha realizado correctamente.';

if (isset($_GET['error'])) {

    $error = $_GET['error'];

    $mensajes = [
        'id'        => 'No ha llegado el ID de la tienda.',
        'mercadona' => 'La tienda no existe.',
        'destroy'   => 'No se ha podido borrar la tienda.',
        'datos'     => 'Los datos del formulario no son válidos.',
        'store'     => 'No se ha podido insertar la tienda.',
        'update'    => 'No se ha podido actualizar la tienda.'
    ];

    if (isset($mensajes[$error])) {
        $mensaje = $mensajes[$error];
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error en la operación</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            width: 450px;
            max-width: 100%;
            margin: 80px auto;
            background-color: white;
            padding: 25px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-align: center;
        }

        h1 {
            color: #c0392b;
            font-size: 23px;
        }

        h2 {
            color: #444;
            font-size: 17px;
            font-weight: normal;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #237a42;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 15px;
        }

        a:hover {
            background-color: #195c31;
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <h1>
            Se ha producido un error
        </h1>

        <h2>
            <?= htmlspecialchars($mensaje) ?>
        </h2>

        <a href="indexMercadona.php">
            Volver al listado
        </a>

    </div>

</body>
</html>
