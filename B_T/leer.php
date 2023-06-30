<?php
include 'conexion.php';

$sql = "SELECT * FROM tabla";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Nombre</th><th>Email</th></tr>';
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $fila['id'] . '</td>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['email'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No se encontraron registros.';
}

$conexion->close();
?>
