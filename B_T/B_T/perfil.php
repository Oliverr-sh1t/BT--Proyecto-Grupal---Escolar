<!DOCTYPE html>
<html>
<head>
  <title>Editar Perfil</title>
  <link rel="stylesheet"  href="CSS/styleperfil.css">
  <div class="container-menu">
          <div class="cont-menu">
              <nav>
                      <a href="Principal_A.php">Inicio</a>
                      <a href="perfilinicio.php">Perfil</a>
                      <a href="logout.php"> Cerrar sesion</a>

              </nav>
              <label for="btn-menu">✖️</label>
          </div>
</head>
<body>
  <div class="container">
    <h1>Editar Perfil</h1>
    <form action="actualizar.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono">
      </div>
      <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo">
      </div>
      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">
      </div>
      <div class="form-group">
        <button type="submit">Guardar Cambios</button>
      </div>
    </form>
  </div>
  
</body>
</html>