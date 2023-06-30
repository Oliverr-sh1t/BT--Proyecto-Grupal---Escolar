<?php
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];

// Establecer la conexión con la base de datos
$conn = new mysqli('localhost', 'root', '', 'b_trabajo');

// Verificar la conexión
if ($conn->connect_error) {
  die('Error en la conexión: ' . $conn->connect_error);
}

// Preparar la consulta SQL utilizando sentencias preparadas
$stmt = $conn->prepare("UPDATE alumno SET domicilio = ?, mail = ?, telefono = ?");

// Vincular los parámetros
$stmt->bind_param("sss", $direccion, $correo, $telefono);

// Ejecutar la consulta
if ($stmt->execute()) {
  echo "Los cambios se han guardado exitosamente";
} else {
  echo "Error al guardar los cambios: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

?>
