<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear categorias</title>
</head>
<body >
<?php 
//variables de conexion
    $host    = 'localhost';
    $db      = 'basededatos';
    $user    = 'root';
    $pass    = '';
    $charset = 'utf8mb4';

    // conectar
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // errores
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        // database conection object
        $pdo = new PDO($dsn, $user, $pass, $options);
       // echo "Connected to the database successfully!";
    } catch (\PDOException $e) {
        //  display the error message
        die("Connection failed: " . $e->getMessage());
    }
    //rescatamos las categorias con todos sus valores (nombre e id)
    $results = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);

?>

    <form action="categorias.php" method="post" style="margin-left:100px;padding:1px 16px;height:1000px;text-align: center;">
    <?php
    //mostrar cada categoria y enviarla como un array para ser subida
    foreach ($results as $row): ?>
        <label>
            <a >
                ID:
                <?= htmlspecialchars($row['id']) ?>
                NOMBRE:
                <?= htmlspecialchars($row['nombre']) ?>
            </a>
        </label><br>
    <?php endforeach; ?>

    <input type="text" name="nombre" id="" placeholder="nombre de la categoria"><br>

        <input type="submit" value="subir">
    </form>        
    
<a href="crear_categorias.php">Crear mas categorias</a>
<a href="crear_articulos.php">Crear mas articulos</a>
</body>