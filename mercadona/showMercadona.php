
<?php

if (!isset($_GET['id'])) {
    header('Location: error.php?error=id');
    exit;
}

$id = $_GET['id'];

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

    // Buscar la tienda por su ID
    $sql = "SELECT *
            FROM mercadona
            WHERE id = :id";

    $sentencia_preparada = $pdo->prepare($sql);

    $datos = [
        'id' => $id
    ];

    $sentencia_preparada->execute($datos);

} catch (Throwable $error) {

    echo "Se ha producido un error.";
    exit;
}

// Comprobar si existe la tienda
$fila = $sentencia_preparada->fetch();

if ($fila == NULL) {
    header('Location: error.php?error=mercadona');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de una tienda</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            max-width: 950px;
            margin: 40px auto;
            background-color: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .volver {
            display: inline-block;
            margin: 15px 0 20px;
            color: #237a42;
            text-decoration: none;
        }

        .volver:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 11px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        td a {
            display: inline-block;
            margin: 2px;
            padding: 7px 10px;
            background-color: #237a42;
            color: white;
            text-decoration: none;
            border-radius: 4px;
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

        @media (max-width: 700px) {
            .contenedor {
                overflow-x: auto;
            }

            table {
                min-width: 750px;
            }
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <h1>Datos de una tienda Mercadona</h1>

        <a class="volver" href="indexMercadona.php">Volver al listado</a>

        <table>

            <tr>
                <th>#</th>
                <th>Dirección</th>
                <th>Localidad</th>
                <th>Fecha apertura</th>
                <th>Encargado</th>
                <th>Teléfono</th>
                <th>Ingreso anual</th>
                <th>Operación</th>
            </tr>

            <tr>
                <td><?= htmlspecialchars((string)$fila['id']) ?></td>
                <td><?= htmlspecialchars($fila['direccion']) ?></td>
                <td><?= htmlspecialchars($fila['localidad']) ?></td>
                <td><?= htmlspecialchars($fila['fecha_apertura']) ?></td>
                <td><?= htmlspecialchars($fila['encargado']) ?></td>
                <td><?= htmlspecialchars($fila['telefono'] ?? '') ?></td>
                <td><?= htmlspecialchars((string)$fila['ingreso_anual']) ?></td>

                <td>
                    <a href="editMercadona.php?id=<?= urlencode((string)$fila['id']) ?>">Editar</a>

                    <a href="deleteMercadona.php?id=<?= urlencode((string)$fila['id']) ?>">Borrar</a>
                </td>
            </tr>

        </table>

    </div>

</body>
</html>
