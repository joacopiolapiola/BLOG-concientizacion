<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear articulos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body ><main>
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
    $articulos = $pdo->query("SELECT * FROM articulos")->fetchAll(PDO::FETCH_ASSOC);
?>

    <form action="articulos.php" method="post" style="margin-left:100px;padding:1px 16px;height:1000px;text-align: center;">
        Titulo de tu articulo <br>
        <input type="text" name="titulo" id="" placeholder=""><br>

    <h3>Categorias:</h3>
    <?php
    //mostrar cada categoria y enviarla como un array para ser subida
    foreach ($results as $row): ?>
        <label>
            <input type="checkbox" name="categorias[]" value="<?= htmlspecialchars($row['id']) ?>">
            <?= htmlspecialchars($row['nombre']) ?>
        </label><br>
    <?php endforeach; ?>

        <h3>Cuerpo el articulo</h3> <br>
        <textarea id="story" name="cuerpo" rows="10" cols="10" style="color: black;">
        ......
        </textarea>
        <input type="submit" value="subir">
    </form>        

<a href="crear_categorias.php">Crear mas categorias</a>
<a href="crear_articulos.php">Crear mas articulos</a>

    <h3>Articulos existentes:</h3>
    <ul>
        <?php foreach ($articulos as $articulo): ?>
            <li>
                <h3>titulo: <?= htmlspecialchars($articulo['titulo']) ?></h3>
                
                <h3>cuerpo:</h3>
                <p>
                <?= htmlspecialchars($articulo['cuerpo']) ?>
                </p>
                <h5>Categorias</h5>
                <ul>
                    <?php 
                        $incats = $pdo->query("SELECT categoria_id FROM articulo_categoria WHERE articulo_id = ".$articulo['id'].";")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($incats as $insidecats){
                            $nombredecategoria = $pdo->query("SELECT nombre FROM categorias WHERE id =".$insidecats['categoria_id'].";")->fetchAll(PDO::FETCH_ASSOC);
                            foreach($nombredecategoria as $indexnombres){
                                echo "<li>".$indexnombres['nombre']."</li><br>";
                            }
                        }
                    ?>
                </ul>    
                <?= htmlspecialchars($articulo['titulo']) ?>            
            </li>
        <?php endforeach; ?>
    </ul>
        </main>
</body>
</html>