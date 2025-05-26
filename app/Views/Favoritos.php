<?php
if (!isset($_SESSION))
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/layout/head.php'
?>

<body class="with-footer">
  <?php
  require __DIR__ . '/layout/header.php'
  ?>

  <main class="favorites-container main-content">
    <h2 class="section-title">Mis Productos Favoritos</h2>
    <div class="products-grid">
      <?php


      foreach ($favoritos as $favorito) {
      ?>
        <!-- Producto 1 -->
        <div class="product-card">
          <img
            src="/app/Views/src/img/articulos/<?php echo $favorito['IMAGEN']; ?>"
            alt="Producto 1"
            class="product-image-fav" />
          <h3 class="product-title"><?php
                                    echo $favorito['NOMBRE'];
                                    ?></h3>
          <p class="product-description">
            <?php
            echo $favorito['DESCRIPCION'];
            ?> </p>
          <a href="/articulo?id=<?php echo ($favorito['ID']); ?>&is_favorito=1" class="action-button-fav ">Ver Detalles</a>
        </div>
      <?php
      }
      ?>


    </div>
  </main>

  <?php
  require __DIR__ . '/layout/footer.php';
  ?>
</body>

</html>