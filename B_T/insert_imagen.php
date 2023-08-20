<?php
require_once 'cn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $imageTmpPath = $_FILES["image"]["tmp_name"];
    $imageName = $_FILES["image"]["name"];
    $imageUploadPath = "perfil_fotos/" . $imageName;

    // Mueve la imagen del directorio temporal al directorio de imágenes en el servidor
    if (move_uploaded_file($imageTmpPath, $imageUploadPath)) {
        if (isset($_SESSION['correo'])) {
            $correo = $_SESSION['correo'];
            
            // Actualiza la ruta de la imagen en la tabla alumno
            $stmt = $con->prepare("UPDATE alumno SET ruta_imagen = ? WHERE Mail = ?");
            $stmt->bind_param("ss", $imageUploadPath, $correo);

            if ($stmt->execute()) {
                echo "La imagen se cargó correctamente en el servidor y se actualizó la base de datos.";
            } else {
                echo "Error al cargar la imagen en el servidor y actualizar la base de datos: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "No se encontró el correo del usuario en la sesión.";
        }
    } else {
        echo "Error al mover la imagen al servidor.";
    }
    $con->close();
}
?>