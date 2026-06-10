<?php
$host    = 'localhost';
$db      = 'basededatos';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';
$titulo=$_REQUEST['titulo'];
$cuerpo=$_REQUEST['cuerpo'];
$cats[]=$_REQUEST['categorias'];

// conexion
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// opciones para que te tire errores 
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     //  database connection object
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "Connected to the database successfully! <br>";
} catch (\PDOException $e) {
     //  display the error message
     die("Connection failed: " . $e->getMessage());
}

$sql = "INSERT INTO articulos (titulo, cuerpo) VALUES (:titulo, :cuerpo)";

// cargas el sql
$stmt = $pdo->prepare($sql);

// datos en un array
$data = [
    'titulo'   => $titulo,
    'cuerpo' => $cuerpo,
];

// ejecuta sql + datos
$stmt->execute($data);
$actualid = $pdo->lastInsertId(); 
echo "Data written successfully! Last inserted ID: " . $pdo->lastInsertId()."<br>";


//query para buscar 
$sql2= "SELECT * FROM articulos";
$results = $pdo->query($sql2)->fetchAll(PDO::FETCH_ASSOC);

//mostramos todo
foreach ($results as $row) {
    echo "titulo:   ",$row['titulo']," ID:      ", $row['id'],"cuerpo:        ", $row['cuerpo'] . "<br>";
}

//link de art y categorias
// falta hacer esto!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// falta hacer esto!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// falta hacer esto!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// falta hacer esto!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$sql3= "INSERT INTO articulo_categoria (articulo_id, categoria_id) VALUES (:id,:cats)";

//hay que hacer algo asi, iterar por cada categoria pero no se como escribirlo

//$stmt= $pdo->prepare($sql3);

// for ($i=0; $i < count($cats) ; $i++) {  
// $stmt->execute(['id' => $actualid, 'cats' => $cats[$i]]);
// }


?>