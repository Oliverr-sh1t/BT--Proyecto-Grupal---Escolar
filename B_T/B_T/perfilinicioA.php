<!DOCTYPE html>
<html>
<head>
  <title>Perfil</title>
  <link rel="stylesheet" type="text/css" href="CSS/stylePI_A.css">

</head>
<body>
<?php
require_once 'cn.php'; // Asegúrate de que la ruta y el nombre del archivo sean correctos

session_start();

if (!isset($_SESSION['correo'])) {
    // Si no se ha iniciado sesión o no se ha establecido el correo, redirigir al inicio de sesión u otra página de manejo de errores
    header("Location: Login_val/login.php");
    exit;
}

$correo = $_SESSION['correo'];
?>
<div class="contenedor">
    <div class="btn-menu">  
        <label for="btn-menu" class="icon-menu">&#9776</label> 
    </div>
    <div class="logo">
        <div class="name">
            <h2>Build The Job</h2>
            <img src="./imagenes/bolsadetrabajo.png" alt="logo de la compañia">
        </div>
    </div> 
</div>
<div class="capa"></div>
  <!--	--------------->
      <div class="container">
        <?php
       

        if (!isset($_SESSION['correo'])) {
          // Si no se ha iniciado sesiSón o no se ha establecido el correo, redirigir al inicio de sesión u otra página de manejo de errores
          header("Location: Login_val/login.php");
          exit;
        }

        $correo = $_SESSION['correo'];

        // Incluir el archivo de conexión
        require_once 'cn.php';

        $sql = "SELECT Nombre, Mail, DNI, Telefono, Domicilio, Fecha_nacimiento, Contraseña FROM alumno WHERE Mail = '$correo'";
        $result = mysqli_query($con, $sql);
        
        if (!$result) {
            echo "Error en la consulta: " . mysqli_error($con);
            exit;
        }
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];
            $email = $row['Mail'];
            $dni = $row['DNI'];
            $telefono = $row['Telefono'];
            $domicilio = $row['Domicilio'];
            $fecha_nacimiento = $row['Fecha_nacimiento'];
            $contraseña = $row['Contraseña'];
       }else {
        echo "No se encontraron datos de perfil.";
        }
        
        ?>
               <div class="container">
    <div class="profile-card">
      <div class="profile-image">
  
      <?php
    // Obtener la ruta de la imagen desde la base de datos
    $sql = "SELECT ruta_imagen FROM alumno WHERE Mail = '$correo'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rutaImagen = $row['ruta_imagen'];

        // Mostrar la imagen de perfil si hay una ruta válida
        if (!empty($rutaImagen)) {
            echo '<img src="' . $rutaImagen . '" alt="Imagen de perfil">';
        } else {
            echo 'Imagen de perfil no encontrada';
        }
    } else {
        echo 'No se encontró la imagen de perfil';
    }
    ?>
    
        <span class="pencil-icon"></span>
        <form id="image-form" action="insert_imagen.php" method="POST" enctype="multipart/form-data">
          <input type="file" name="image" id="image">
    </form>
  
    </div>
        <div class="container-table">
          <form action="actualizar.php" method="POST" enctype="multipart/form-data">
            <label for="Nombre"></label>
              <div class="form-text">
                <?php echo $nombre . "</p>";?>
              </div>
            <label for="mail">Mail:</label>
            <div class="form-text">
              <?php echo $email . "</p>";?>
            </div>
            <label for="dni">DNI:</label>
            <div class="form-text">
              <?php echo $dni . "</p>";?>
            </div>
            <div class="form-group">
    <label for="telefono">Teléfono:</label>
    <input type="bigint" id="telefonos" name="telefonos" value="<?php echo $telefono; ?>">
</div>
<div class="form-group">
    <label for="direccion">Domicilio:</label>
    <input type="text" id="direccion" name="domicilio" value="<?php echo $domicilio; ?>">
</div>

<div class="form-group">
    <label for="f_nac">Fecha de nacimiento:</label>
    <input type="date" id="f_naci" name="f_nac" value="<?php echo $fecha_nacimiento; ?>">
</div>
<div class="form-group">
    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" value="<?php echo $contraseña; ?>">
</div>
          </form>
        </div>
       
    </div>
    <form id="image-form" action="insert_imagen.php" method="POST" enctype="multipart/form-data" style="display: none;">
    <input type="file" name="image" id="image">
</form>
<?php
      // Cerrar la conexión (si es necesario)
      $con->close();
      ?>
<input type="checkbox" id="btn-menu">
<div class="container-menu">
    <div class="cont-menu">
        <nav>
            <a href="principal_A.php">Inicio</a>
            <a href="perfilinicioA.php">Perfil</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
        <label for="btn-menu">✖️</label>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const pencilIcon = document.querySelector(".pencil-icon");
        const imageInput = document.getElementById("image");

        if (pencilIcon && imageInput) {
            pencilIcon.addEventListener("click", function () {
                imageInput.click();
            });

            imageInput.addEventListener("change", function () {
                const imageForm = document.getElementById("image-form");
                if (imageForm) {
                    imageForm.submit();
                }
            });
        }

        const btnMenu = document.getElementById("btn-menu");
        const containerMenu = document.querySelector(".container-menu");

        btnMenu.addEventListener("change", function () {
            containerMenu.style.opacity = btnMenu.checked ? "1" : "0";
            containerMenu.style.visibility = btnMenu.checked ? "visible" : "hidden";
        });
    });
</script>
</body>
</html>