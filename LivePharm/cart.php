<?php
$servername = "localhost";
$username = "aldesquintero";
$password = "AdminDB70000";
$dbname = "livepharm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si la solicitud es un GET para obtener los productos del carrito
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Realizar una consulta SELECT para obtener los productos del carrito desde la base de datos
    $sql = "SELECT nombre, precio FROM cart";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $productos = array();

        // Iterar sobre los resultados de la consulta y almacenar los productos en un array
        while ($row = $result->fetch_assoc()) {
            $producto = array(
                'nombre' => $row['nombre'],
                'precio' => $row['precio']
            );
            $productos[] = $producto;
        }

        // Devolver los productos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($productos);
    } else {
        // Devolver un array vacío en formato JSON, en caso de no haber productos
        header('Content-Type: application/json');
        echo json_encode([]);
    }
} else {
    echo json_encode(['error' => 'Acceso no permitido']); 
}

$conn->close();
?>
