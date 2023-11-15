<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
  header("Location: home.html");
  exit();
}

// Credenciales de la conexión a la base de datos 
$servername = "localhost";
$username = "aldesquintero";
$password = "AdminDB70000";
$dbname = "livepharm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Verificación del envío de los datos a la base de datos 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Consulta a la base de datos 
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  // Verificar si se encontró un usuario con las credenciales proporcionadas
  if ($result->num_rows > 0) {
    // Obtener los datos del usuario
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
    $user_name = $row['name'];

    // Guardar los datos del usuario en la sesión
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;

    // Redirigir a la página de inicio
    header("Location: home.html");
    exit();
  } else {
    $error_message = "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
  }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    form {
      width: 300px;
      margin: 0 auto;
      border: 1px solid #cccccc;
      padding: 20px;
      background-color: #ffffff;
      margin-top: 50px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333333;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #333333;
    }

    input {
      width: 100%;
      height: 30px;
      border: 1px solid #cccccc;
      padding: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      height: 40px;
      border: none;
      background-color: #333333;
      color: #ffffff;
      margin-top: 20px;
      cursor: pointer;
    }

    button:hover {
      background-color: #555555;
    }

    .error {
      color: #ff0000;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <form action="login.php" method="post">
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error_message)) : ?>
      <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Iniciar Sesión</button>
  </form>

</body>
</html>
