<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear articulos</title>
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
        echo "Connected to the database successfully!";
    } catch (\PDOException $e) {
        //  display the error message
        die("Connection failed: " . $e->getMessage());
    }
    //rescatamos las categorias con todos sus valores (nombre e id)
    $results = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);

?>

    <form action="articulos.php" method="post" style="margin-left:100px;padding:1px 16px;height:1000px;text-align: center;">
        Titulo de tu articulo <br>
        <input type="text" name="titulo" id="" placeholder=""><br>

    <h3>Select Categories:</h3>

    <?php
    //mostrar cada categoria y enviarla como un array para ser subida
    foreach ($results as $row): ?>
        <label>
            <input type="checkbox" name="categorias[]" value="<?= htmlspecialchars($row['id']) ?>">
            <?= htmlspecialchars($row['nombre']) ?>
        </label><br>
    <?php endforeach; ?>

        Cuerpo el articulo <br>
        <textarea id="story" name="cuerpo" rows="10" cols="40" style="color: black;">
        ......
        </textarea>
        <input type="submit" value="subir">
    </form>        

</body>
</html>