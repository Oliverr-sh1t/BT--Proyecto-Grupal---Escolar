<!DOCTYPE html>
<html>
<head>
<div class="container-menu">
          <div class="cont-menu">
              <nav>
                      <a href="Principal_A.php">Inicio</a>
                      <a href="perfilinicio.php">Perfil</a>
                      <a href="logout.php"> Cerrar sesion</a>

              </nav>
              <label for="btn-menu">✖️</label>
          </div>
  <title>Perfil</title>
 
</head>
<body>
  <div class="container">
    <h1>Perfil</h1>
    <?php
    session_start();

    if (!isset($_SESSION['correo'])) {
      // Si no se ha iniciado sesión o no se ha establecido el correo, redirigir al inicio de sesión u otra página de manejo de errores
      header("Location: Login_val/login.php");
      exit;
    }

    $correo = $_SESSION['correo'];

    // Incluir el archivo de conexión
    require_once 'cn.php';

    // Obtener los datos del perfil desde la base de datos
    $sql = "SELECT nombre, mail, telefono FROM alumno WHERE mail = '$correo'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $nombre = $row['nombre'];
      $email = $row['mail'];
      $telefono = $row['telefono'];

      // Mostrar los datos en el perfil
      echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
      echo "<p><strong>Email:</strong> " . $email . "</p>";
      echo "<p><strong>Teléfono:</strong> " . $telefono . "</p>";
    } else {
      echo "No se encontraron datos de perfil.";
    }

    // Cerrar la conexión (si es necesario)
    $con->close();
    ?>
    <p><a href="perfil.php">Editar Perfil</a></p>
  </div>
</body>
</html>