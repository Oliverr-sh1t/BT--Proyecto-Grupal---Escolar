<?php
$con = mysqli_connect("localhost", "root", "", "b_trabajo");
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>