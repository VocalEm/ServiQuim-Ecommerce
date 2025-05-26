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

  <div class="registro-principal">
    <div class="contenedor">
      <div class="registro-seccion">
        <h2>Registro</h2>
      </div>

      <div class="registro-seccion">
        <h3>Correo electrónico</h3>
        <form action="/registro" method="POST">
          <input type="email" placeholder="Ingrese su correo" name="correo" required />
          <i
            class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
      </div>

      <div class="registro-seccion">
        <h3>Nombre(s)</h3>
        <input id="nombre" type="text" placeholder="Ingrese su nombre" name="nombre" required />
        <i
          class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
      </div>

      <div class="registro-seccion">
        <h3>Contraseña</h3>
        <input
          id="password"
          type="password"
          placeholder="Ingrese su contraseña"
          name="password" required />
        <i
          class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
      </div>

      <div class="registro-seccion">
        <div>
          <h3>Apellido paterno</h3>
          <input
            id="apellido_paterno"
            type="text"
            placeholder="Ingrese su apellido"
            name="apellidoPaterno" required />
          <i
            class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
        </div>

        <div>
          <h3>Apellido materno</h3>
          <input
            id="correo"
            type="text"
            placeholder="Ingrese su apellido"
            name="apellidoMaterno" required />
          <i
            class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
        </div>
      </div>

      <div class="registro-seccion">
        <h3>Confirmar contraseña</h3>
        <input
          id="password_confirm"
          type="password"
          placeholder="Confirme su contraseña"
          name="passwordConfirm" required />
        <i
          class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
      </div>

      <div class="registro-seccion">
        <h3>Teléfono celular</h3>
        <input
          id="telefono"
          type="tel"
          placeholder="Ingrese su teléfono"
          name="telefono" required />
        <i
          class="fa-regular fa-circle-xmark fa-3x icon-error oculto-real"></i>
      </div>

      <div class="registro-seccion">
        <div>
          <input type="checkbox" id="" name="terminos" required />
        </div>
        <span>Aceptar términos y condiciones</span>

      </div>

      <div class="registro-seccion">
        <input type="submit" value="Registrar" name="enviar" />
        </form>
        <a href="/login">Volver</a>
      </div>
    </div>
  </div>
  <?php
  require __DIR__ . '/layout/footer.php';
  ?>
</body>

</html>