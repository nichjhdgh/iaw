
<?php

$host     = 'mysql';
$db       = 'siga';
$user     = 'sigauser';
$password = 'sigapassword';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    $sql = "SELECT * FROM mercadona";

    $sentencia_preparada = $pdo->prepare($sql);
    $sentencia_preparada->execute();

} catch (Throwable $error) {
    echo "Se ha producido un error.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tiendas Mercadona</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            max-width: 850px;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .crear {
            display: inline-block;
            margin: 15px 0 20px;
            padding: 10px 15px;
            background-color: #237a42;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .crear:hover {
            background-color: #195c31;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #eee;
            color: #333;
        }

        tr:hover {
            background-color: #f8f8f8;
        }

        td a {
            display: inline-block;
            margin: 2px;
            padding: 6px 9px;
            text-decoration: none;
            color: white;
            background-color: #237a42;
            border-radius: 3px;
            font-size: 13px;
        }

        td a:hover {
            background-color: #195c31;
        }

        td a:last-child {
            background-color: #c0392b;
        }

        td a:last-child:hover {
            background-color: #922b21;
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <h1>Lista de tiendas Mercadona</h1>

        <a class="crear" href="create.php">Crear tienda</a>

        <table>

            <tr>
                <th>#</th>
                <th>Tienda</th>
                <th>Operación</th>
            </tr>

            <?php
            while ($fila = $sentencia_preparada->fetch()) {
            ?>

            <tr>

                <td><?= htmlspecialchars((string)$fila['id']) ?></td>

                <td>
                    <?= htmlspecialchars($fila['direccion'] . ' (' . $fila['localidad'] . ')') ?>
                </td>

                <td>
                    <a href="show.php?id=<?= urlencode((string)$fila['id']) ?>">Ver</a>

                    <a href="edit.php?id=<?= urlencode((string)$fila['id']) ?>">Editar</a>

                    <a href="delete.php?id=<?= urlencode((string)$fila['id']) ?>">Borrar</a>
                </td>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</body>
</html>
