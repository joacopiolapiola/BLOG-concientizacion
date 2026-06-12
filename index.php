<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ver articulos</title>
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
        $cat = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
        $art = $pdo->query("SELECT * FROM articulos")->fetchAll(PDO::FETCH_ASSOC);
        $artid = $pdo->query("SELECT id FROM articulos")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h3>articulos!!</h3>
        <?php foreach ($art as $arts): ?>
            <label>
                <a>
                    ID:
                    <?=  htmlspecialchars($arts['id']) ?>
                    NOMBRE:
                    <?= htmlspecialchars($arts['titulo']) ?>
                    CUERPO:
                    <?= htmlspecialchars($arts['cuerpo']) ?>   
                </a> 
                <br>
                CATEGORIAS de este articulo:
                <br>
                <a>
                    <?php 
                        $incats = $pdo->query("SELECT categoria_id FROM articulo_categoria WHERE articulo_id = ".$arts['id'].";")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($incats as $insidecats){
                            $nombredecategoria = $pdo->query("SELECT nombre FROM categorias WHERE id =".$insidecats['categoria_id'].";")->fetchAll(PDO::FETCH_ASSOC);
                            foreach($nombredecategoria as $indexnombres){
                                echo $indexnombres['nombre']."<br>";
                            }
                        }
                    ?>
                </a>                
            </label><br>
        <?php endforeach; ?>

    <h3> todas las categorias!!!</h3>
        <?php foreach ($cat as $cats): ?>
            <label>
                <a >
                    ID:
                    <?= htmlspecialchars($cats['id']) ?>
                    NOMBRE:
                    <?= htmlspecialchars($cats['nombre']) ?>
                </a>
            </label><br>
        <?php endforeach; ?>

        
<a href="crear_categorias.php">Crear mas categorias</a>
<a href="crear_articulos.php">Crear mas articulos</a>
    </body>
</html>
