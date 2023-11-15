<?php
// Iniciar la sesión
session_start();

// Conectar a la base de datos
$servername = "localhost";
$username = "aldesquintero";
$password = "AdminDB70000";
$dbname = "livepharm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validar los datos
  if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $error_message = "Por favor, ingrese todos los campos";
  } else if ($password != $confirm_password) {
    $error_message = "Las contraseñas no coinciden";
  } else {
    // Consultar la base de datos
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    // Verificar si el correo electrónico ya está registrado
    if ($result->num_rows > 0) {
      // Mostrar un mensaje de error
      $error_message = "El correo electrónico ya está en uso";
    } else {
      // Insertar el nuevo usuario en la base de datos
      $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
      if ($conn->query($sql) === TRUE) {
        // Obtener el id del nuevo usuario
        $user_id = $conn->insert_id;

        // Guardar los datos del usuario en la sesión
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $name;

        // Redirigir a la página de inicio
        header("Location: index.html");
        exit();
      } else {
        // Mostrar un mensaje de error
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
      }
    }
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
  <title>Registro de usuarios</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    form {  /* formulario  */
      width: 300px;
      margin: 0 auto;
      border: 1px solid #5D6D7E;
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
      background-color: #2E86C1 ;
      color: #ffffff;
      margin-top: 20px;
      cursor: pointer;
    }

    button:hover {
      background-color:#85C1E9  ;
    }

    .error {
      color: #ff0000;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <form action="register.php" method="post">
    <h1>Registro de usuarios</h1>
    <?php if (isset($error_message)) : ?>
      <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Confirmar contraseña:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <button type="submit">Registrarse</button>
  </form>

</body>
</html>
