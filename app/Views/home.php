<?php
// Nombre de la cookie
$cookie_name = "visit";

// Duración de la cookie (1 año en este caso)
$cookie_time = time() + (365 * 24 * 60 * 60);

// Comprueba si la cookie ya existe
if (!isset($_COOKIE[$cookie_name])) {
  // Si la cookie no existe, la crea
  setcookie($cookie_name, "1", $cookie_time, "/");
  $show_class = true; // Mostrar la clase porque es la primera vez
} else {
  $show_class = false; // No mostrar la clase porque ya ha visitado antes
}; // Comprueba si la cookie ya existe 
$show_intro = !isset($_COOKIE['visit']);
?>

<!DOCTYPE html>
<html lang="es">

<?php
require __DIR__ . '/layout/head.php'
?>

<body>

  <?php
  require __DIR__ . '/layout/header.php'
  ?>

  <div class="dashboard">
    <i class="fa fa-arrow-left fa-6x" aria-hidden="true" onclick="prevSlide()"></i>
    <div class="carousel">
      <img id="carousel-image" src="/app/Views/src/img/Portada soluciones.png" alt="Carrusel">
    </div>
    <i class="fa fa-arrow-right fa-6x" aria-hidden="true" onclick="nextSlide()"></i>
  </div>

  <div class="dashboard-cards" id="first">
    <a href="/articulo?id=<?php echo $masVendido['ID'] ?>&is_favorito=0" class="dashboard-card <?php echo $show_class ? 'cardintro1' : ''; ?>">
      <h3 class="dashboard-card_title">Artículo más vendido</h3>

      <img
        class="dashboard-card_img"
        src="/app/Views/src/img/articulos/<?php echo $masVendido['IMAGEN']; ?>"
        alt="" />
    </a>
    <a href="" class="dashboard-card <?php echo $show_class ? 'cardintro2' : ''; ?>">
      <h3 class="dashboard-card_title">Artículo preferido</h3>
      <img
        class="dashboard-card_img"
        src="/app/Views/src/img/articulos/<?php echo $masFavorito['IMAGEN']; ?>"
        alt="" />
    </a>
    <a href="" class="dashboard-card <?php echo $show_class ? 'cardintro3' : ''; ?>">
      <h3 class="dashboard-card_title">Te podría interesar</h3>
      <img
        class="dashboard-card_img"
        src="/app/Views/src/img/articulos/<?php echo $menosFavorito['IMAGEN']; ?>"
        alt="" />
    </a>
  </div>

  <main class="principal main-content">
    <section class="soluciones">
      <h4 class="soluciones-title">Soluciones especializadas para</h4>
      <div class="soluciones-cards">
        <div class="soluciones-card">
          <img
            class="soluciones-card-imagen"
            src="/app/Views/src/img/limpieza-cocina.png"
            alt="" />
          <h5 class="soluciones-card-titulo">Cocinas</h5>
        </div>
        <div class="soluciones-card">
          <img
            class="soluciones-card-imagen"
            src="/app/Views/src/img/limpieza escuela.jpg"
            alt="" />
          <h5 class="soluciones-card-titulo">Escuelas</h5>
        </div>
        <div class="soluciones-card">
          <img
            class="soluciones-card-imagen"
            src="/app/Views/src/img/limpieza_hospital.jpg"
            alt="" />
          <h5 class="soluciones-card-titulo">Hospitales</h5>
        </div>
        <div class="soluciones-card">
          <img
            class="soluciones-card-imagen"
            src="/app/Views/src/img/limpieza  industria.webp"
            alt="" />
          <h5 class="soluciones-card-titulo">Industria</h5>
        </div>
        <div class="soluciones-card">
          <img
            class="soluciones-card-imagen"
            src="/app/Views/src/img/limpieza-supermercado.jpg"
            alt="" />
          <h5 class="soluciones-card-titulo">Supermercados</h5>
        </div>
        <div class="soluciones-card">
          <img
            class="soluciones-card-imagen"
            src="/app/Views/src/img/limpieza-oficina.png"
            alt="" />
          <h5 class="soluciones-card-titulo">Oficinas</h5>
        </div>
      </div>
    </section>
    <div class="separador-main"></div>
    <section class="logo-clientes">
      <h4 class="logo-clientes-titulo">Proveedores Oficiales de</h4>
      <div class="logo-clientes-img">
        <img src="/app/Views/src/img/ternium-logo.png" alt="" />
        <img src="/app/Views/src/img/tec-logo.jpg" alt="" />
        <img src="/app/Views/src/img/heb.png" alt="" />
      </div>
    </section>
  </main>
  <script src="/app/Views/build/js/dashboard.js"></script>
  <?php
  require __DIR__ . '/layout/footer.php';
  ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js"></script>

<?php if ($show_intro) : ?>
  <script>
    introJs().setOptions({
      steps: [{
          title: 'Bienvenido',
          intro: 'A ServiQuim Web, tu tienda en línea'
        }, {
          element: document.querySelector('.perfilintro'),
          intro: 'Aquí puedes ver tu perfil y pedidos'
        }, {
          element: document.querySelector('.carritointro'),
          intro: 'Aquí puedes ver los artículos que agregas al carrito'
        }, {
          element: document.querySelector('.favoritosintro'),
          intro: 'Aquí puedes ver los artículos que marcaste como favoritos'
        }, {
          element: document.querySelector('.tiendaintro'),
          intro: 'Aquí puedes ver y comprar nuestros artículos'
        }, {
          element: document.querySelector('.contactointro'),
          intro: 'Aquí puedes mandar un correo para contactar directamente con un vendedor'
        }, {
          element: document.querySelector('.sucursalintro'),
          intro: 'Aquí puedes ubicar nuestras distintas sucursales'
        }, {
          element: document.querySelector('.nosotrosintro'),
          intro: 'Aquí puedes conocer un poco más de nuestra trayectoria'
        },
        {
          element: document.querySelector('.cardintro1'),
          intro: 'Encuentra nuestro producto más comprado'
        },
        {
          element: document.querySelector('.cardintro2'),
          intro: 'Encuentra nuestro producto más valorado por la comunidad'
        },
        {
          element: document.querySelector('.cardintro3'),
          intro: 'Encuentra productos que creemos que podrían interesarte'
        },
        {
          element: document.querySelector('.logointro'),
          intro: 'Si te pierdes siempre puedes volver al inicio desde aqui.'
        }
      ]
    }).start();
  </script>
<?php endif; ?>

</html>