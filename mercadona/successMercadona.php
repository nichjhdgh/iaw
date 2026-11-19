
<?php

$mensaje = 'La acción se ha realizado correctamente.';

if (isset($_GET['ok'])) {

    $ok = $_GET['ok'];

    $mensajes = [
        'store'   => 'Se ha insertado correctamente.',
        'destroy' => 'Se ha borrado correctamente.',
        'update'  => 'Se ha actualizado correctamente.',
    ];

    if (isset($mensajes[$ok])) {
        $mensaje = $mensajes[$ok];
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operación realizada</title>

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
            color: #237a42;
            font-size: 23px;
        }

        h2 {
            color: #444;
            font-size: 17px;
            font-weight: normal;
        }

        a {
            display: inline-block;
            margin-top: 18px;
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

        .seguir {
            background-color: #555;
        }

        .seguir:hover {
            background-color: #333;
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <h1>
            Operación realizada correctamente
        </h1>

        <h2>
            <?= htmlspecialchars($mensaje) ?>
        </h2>

        <?php if (isset($_GET['ok']) && $_GET['ok'] == 'store') { ?>

            <a class="seguir" href="createMercadona.php">
                Seguir insertando
            </a>

        <?php } ?>

        <br>

        <a href="indexMercadona.php">
            Volver al listado
        </a>

    </div>

</body>
</html>
