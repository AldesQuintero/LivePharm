<?php

// Configurar las variables de conexión a MySQL
$servername = "localhost";
$username = "aldesquintero";
$password = "AdminDB70000";
$database = "livepharm";

// Conectarse a MySQL
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// consulta hacia la tabla de presdription
$sql = "SELECT * FROM prescription";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Obtener los resultados de la consulta
$results = $stmt->fetchAll();

// Cerrar la conexión a MySQL
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recetas médicas</title>
</head>
<body>
  <table border="1">
    <thead>
      <tr>   <!-- Mostrar los datos de la API-->
        <th>ID</th>
        <th>Paciente</th>
        <th>Medicamento</th>
        <th>Dosis</th>
        <th>Fecha de receta</th>
        <th>Fecha de lote</th>
        <th>Fecha de vencimiento</th>
        <th>Médico prescriptor</th>
        <th>Hospital o clínica</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $result) { ?>
        <tr>
          <td><?php echo $result['id_receta']; ?></td>
          <td><?php echo $result['nombre_paciente']; ?></td>
          <td><?php echo $result['medicamento']; ?></td>
          <td><?php echo $result['dosis']; ?></td>
          <td><?php echo $result['fecha_receta']; ?></td>
          <td><?php echo $result['fecha_lote']; ?></td>
          <td><?php echo $result['fecha_vencimiento']; ?></td>
          <td><?php echo $result['medico_prescriptor']; ?></td>
          <td><?php echo $result['hospital_clinica']; ?></td>
          <td><?php echo $result['precio_medicamento']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>

<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid black;
  padding: 10px;
}
</style>
</html>

