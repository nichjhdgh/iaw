
<?php

if (!isset($_GET['id'])) {
    header('Location: error.php?error=id');
    exit;
}

$id = $_GET['id'];

$host = 'mysql';
$db = 'siga';
$user = 'sigauser';
$password = 'sigapassword';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

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
    <title>Confirmar borrado</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            width: 750px;
            max-width: 100%;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        h1 {
            color: #c0392b;
            text-align: center;
        }

        a {
            color: #237a42;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .botones {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            background-color: #c0392b;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #922b21;
        }

        @media (max-width: 600px) {
            .contenedor {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <h1>Confirmación de borrado</h1>

        <p>
            ¿Estás seguro de que quieres borrar esta tienda?
        </p>

        <a href="show.php?id=<?= urlencode((string)$id) ?>">
            Volver a la tienda
        </a>

        <table>

            <tr>
                <th>#</th>
                <th>Dirección</th>
                <th>Localidad</th>
                <th>Fecha apertura</th>
                <th>Encargado</th>
                <th>Teléfono</th>
                <th>Ingreso anual</th>
            </tr>

            <tr>
                <td><?= htmlspecialchars((string)$fila['id']) ?></td>
                <td><?= htmlspecialchars($fila['direccion']) ?></td>
                <td><?= htmlspecialchars($fila['localidad']) ?></td>
                <td><?= htmlspecialchars($fila['fecha_apertura']) ?></td>
                <td><?= htmlspecialchars($fila['encargado']) ?></td>
                <td><?= htmlspecialchars($fila['telefono'] ?? '') ?></td>
                <td><?= htmlspecialchars((string)$fila['ingreso_anual']) ?></td>
            </tr>

        </table>

        <div class="botones">

            <a href="index.php">Cancelar</a>

            <form action="destroy.php" method="post">

                <input type="hidden" name="id"
                       value="<?= htmlspecialchars((string)$id) ?>">

                <button type="submit">
                    Borrar tienda
                </button>

            </form>

        </div>

    </div>

</body>
</html>
