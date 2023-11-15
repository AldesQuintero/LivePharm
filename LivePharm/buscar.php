<?php
// Credenciales de acceso a la base de datos 
$servername = "localhost";
$username = "aldesquintero";
$password = "AdminDB70000";
$dbname = "livepharm";

// Establecer la conexion mediante estos parámetros de la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Si no hay conexión se cierra la sesión y si la hay queda establecida la sesión 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta la tabla products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en un cuadro HTML
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Stock</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["description"] . "</td><td>" . $row["price"] . "</td><td>" . $row["stock"] . "</td></tr>";
    }
    echo "</table>";
} else {
    // Mensaje si no hay resultados 
    echo "No hay productos en esta tabla.";
    die();
}

// Cerrar la conexion a la base de datos
$conn->close();
?>
