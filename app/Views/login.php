<!DOCTYPE html>
<html lang="es">

<?php
require __DIR__ . '/layout/head.php'
?>

<body>
  <?php
  require __DIR__ . '/layout/header.php'
  ?>
  <style>
    .error {
      text-align: center;
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>

  <?php
  if (isset($_SESSION['error'])) {
    echo '<div class="error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
    // Limpiar el mensaje de error después de mostrarlo 
  } ?>

  <div class="contenedor-login login">
    <h2>Inicio de sesión</h2>
    <div class="login-usercont">
      <i class="fa-regular fa-envelope fa-4x"></i>
      <form action="/login" method="POST">
        <input
          name="correo"
          id="correo"
          type="email"
          placeholder="Ingrese su correo electrónico" required />
        <i class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
    </div>
    <div class="error oculto">
      <p id="correoError"></p>
    </div>

    <div class="login-passwordcont">
      <i class="fa-solid fa-lock fa-4x"></i>
      <input
        name="password"
        id="password"
        type="password"
        placeholder="Ingrese su contraseña" required />

      <i class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
    </div>
    <div class="error oculto">
      <p id="passwordError"></p>
    </div>

    <div class="login-opcionescont">
      <div>
        <input type="checkbox" name="recordar" id="" />
        <span>Recordar usuario</span>
      </div>
      <div>
        <i class="fa-solid fa-caret-right fa-2x"></i>
        <a href=""><span>Recuperar contraseña</span></a>
      </div>
    </div>

    <div class="login-botonescont">
      <button type="submit" class="login-botonIniciar">Iniciar sesión</button>
      </form>
      <a href="/registro" class="login-botonregistrar">
        Registrarse
      </a>
    </div>
  </div>
  <?php
  require __DIR__ . '/layout/footer.php';
  ?>
</body>

</html>