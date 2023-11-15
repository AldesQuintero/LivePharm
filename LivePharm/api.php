<?php
header("Content-Type: application/json");

// Configuración de la conexión a la base de datos
$host = 'localhost';
$user = 'aldesquintero';
$pass = 'AdminDB70000';
$db = 'livepharm';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ruta para obtener todos los medicamentos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM medicamentos");

    if ($result) {
        if ($result->num_rows > 0) {
            $medicamentos = array();

            while ($row = $result->fetch_assoc()) {
                $medicamentos[] = $row;
            }

            echo json_encode($medicamentos);
        } else {
            echo json_encode(array('message' => 'No se encontraron medicamentos.'));
        }
    } else {
        echo json_encode(array('message' => 'Error en la consulta: ' . $conn->error));
    }

    // Cierra la conexión
    $conn->close();
}
?>

