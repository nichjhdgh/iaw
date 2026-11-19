
<?php

/* Variables de conexión */
$host     = 'mysql';
$db       = 'siga';
$user     = 'sigauser';
$password = 'sigapassword';
$charset  = 'utf8mb4';

// Cadena de conexión (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones de configuración de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {

    // Conexión con MySQL
    $pdo = new PDO($dsn, $user, $password, $options);

    echo "Conexión correcta a MySQL.<br>";

    // Crear la tabla si no existe
    $sql = "CREATE TABLE IF NOT EXISTS mercadona (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        direccion VARCHAR(150) NOT NULL,
        localidad VARCHAR(100) NOT NULL,
        fecha_apertura DATE NOT NULL,
        encargado VARCHAR(150) UNIQUE NOT NULL,
        telefono VARCHAR(12) NULL,
        ingreso_anual DECIMAL(10,3) DEFAULT 0,
        CONSTRAINT uq_direccion_localidad UNIQUE (direccion, localidad)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    // Ejecutar la sentencia SQL
    $pdo->exec($sql);

    echo "La tabla 'mercadona' se ha creado correctamente.";

} catch (Throwable $error) {

    echo "Se ha producido un error al conectar o crear la tabla.";
    echo "<br>";
    echo $error->getMessage();

}

?>
