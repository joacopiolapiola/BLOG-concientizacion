<?php
$host    = 'localhost';
$db      = 'basededatos';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';
$nombre=$_REQUEST['nombre'];

// connexion
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// por si hay errores
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     //  database connection object
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "Connected to the database successfully!";
} catch (\PDOException $e) {
     //  error 
     die("Connection failed: " . $e->getMessage());
}

$sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
$sql2= "SELECT * FROM categorias";

//  Prepara el sql
$stmt = $pdo->prepare($sql);

// carga los datos
$data = [
    'nombre'   => $nombre,
];

// ejecuta el sql + datos
$stmt->execute($data);

echo "Data written successfully! Last inserted ID: <br>" . $pdo->lastInsertId();

$results = $pdo->query($sql2)->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
    echo "nombre:   ",$row['nombre']," ID:      ", $row['id'],"<br>";
}

?>