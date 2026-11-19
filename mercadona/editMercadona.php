
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
    <title>Edición de tienda</title>

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
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }

        a {
            display: block;
            margin-bottom: 20px;
            color: #237a42;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        label {
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #237a42;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 11px;
            background-color: #237a42;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #195c31;
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <h1>Edición de tienda Mercadona</h1>

        <a href="index.php">Volver al listado</a>

        <form action="update.php" method="post">

            <input type="hidden" name="id" value="<?= htmlspecialchars((string)$fila['id']) ?>">

            <label for="direccion">Dirección</label>
            <input type="text"
                   name="direccion"
                   id="direccion"
                   value="<?= htmlspecialchars($fila['direccion']) ?>"
                   placeholder="Ej.: Calle Recogidas, 45"
                   required
                   maxlength="150">

            <label for="localidad">Localidad</label>
            <input type="text"
                   name="localidad"
                   id="localidad"
                   value="<?= htmlspecialchars($fila['localidad']) ?>"
                   placeholder="Ej.: Granada"
                   required
                   maxlength="100">

            <label for="fecha_apertura">Fecha de apertura</label>
            <input type="date"
                   name="fecha_apertura"
                   id="fecha_apertura"
                   value="<?= htmlspecialchars($fila['fecha_apertura']) ?>"
                   required>

            <label for="encargado">Encargado</label>
            <input type="text"
                   name="encargado"
                   id="encargado"
                   value="<?= htmlspecialchars($fila['encargado']) ?>"
                   placeholder="Nombre del encargado"
                   maxlength="150">

            <label for="telefono">Teléfono</label>
            <input type="text"
                   name="telefono"
                   id="telefono"
                   value="<?= htmlspecialchars($fila['telefono'] ?? '') ?>"
                   placeholder="Ej.: 958123456"
                   maxlength="12">

            <label for="ingreso_anual">Ingreso anual</label>
            <input type="number"
                   name="ingreso_anual"
                   id="ingreso_anual"
                   value="<?= htmlspecialchars((string)$fila['ingreso_anual']) ?>"
                   placeholder="Ej.: 1250000.500"
                   min="0"
                   max="9999999.999"
                   step="0.001">

            <button type="submit">Confirmar edición de la tienda</button>

        </form>

    </div>

</body>
</html>
