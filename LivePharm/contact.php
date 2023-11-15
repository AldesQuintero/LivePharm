<?php
// Conectar a la base de datos livepharm
$servername = "localhost";
$username = "aldesquintero";
$password = "AdminDB70000";
$dbname = "livepharm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario de contacto
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

// Preparar la sentencia SQL para insertar los datos en la tabla contact
$sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Vincular los parámetros a los valores del formulario
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Ejecución de las sentencias SQL
if ($stmt->execute()) {
  echo "Mensaje enviado correctamente.";
} else {
  echo "Error: " . $stmt->error;
}

// Cerrar las sentencias y la conexión
$stmt->close();
$conn->close();
?>
