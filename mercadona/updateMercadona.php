
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

    // Conexión con la base de datos
    $pdo = new PDO($dsn, $user, $password, $options);

    // Comprobar que llegan todos los datos
    if (
        !isset($_POST['id']) ||
        !isset($_POST['direccion']) ||
        !isset($_POST['localidad']) ||
        !isset($_POST['fecha_apertura']) ||
        !isset($_POST['encargado']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['ingreso_anual'])
    ) {
        header('Location: error.php?error=datos');
        exit;
    }

    // Recoger los datos del formulario
    $id             = $_POST['id'];
    $direccion      = $_POST['direccion'];
    $localidad      = $_POST['localidad'];
    $fecha_apertura = $_POST['fecha_apertura'];
    $encargado      = $_POST['encargado'];
    $telefono       = $_POST['telefono'];
    $ingreso_anual  = $_POST['ingreso_anual'];

    // Comprobar los campos vacíos
    if ($telefono == '') {
        $telefono = null;
    }

    if ($ingreso_anual == '') {
        $ingreso_anual = 0;
    }

    // Actualizar los datos de la tienda
    $sql = "UPDATE mercadona
            SET direccion = :direccion,
                localidad = :localidad,
                fecha_apertura = :fecha_apertura,
                encargado = :encargado,
                telefono = :telefono,
                ingreso_anual = :ingreso_anual
            WHERE id = :id";

    $sentencia_preparada = $pdo->prepare($sql);

    $datos = [
        'id'             => $id,
        'direccion'      => $direccion,
        'localidad'      => $localidad,
        'fecha_apertura' => $fecha_apertura,
        'encargado'      => $encargado,
        'telefono'       => $telefono,
        'ingreso_anual'  => $ingreso_anual
    ];

    // Ejecutar la actualización
    $sentencia_preparada->execute($datos);

    header('Location: successMercadona.php?ok=update');
    exit;

} catch (Throwable $error) {

    header('Location: errorMercadona.php?error=update');
    exit;

}
