<?php
if (!isset($_SESSION))
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php
require __DIR__ . '/layout/head.php'
?>

<body>
  <?php
  require __DIR__ . '/layout/header.php'
  ?>

  <div class="purchase-history-container">
    <h2 class="purchase-history-title">Historial de Compras</h2>

    <!-- Primera compra con múltiples productos -->
    <?php

    if ($BloquesPedidos === false) {
      echo "<p>Error al obtener los datos de los pedidos.</p>";
    } elseif (empty($BloquesPedidos)) {
      echo "<p>No hay pedidos para mostrar.</p>";
    } else {
      foreach ($BloquesPedidos as $bloque) {
    ?>
        <div class="purchase-history-card">
          <div class="purchase-item-header">
            <p class="purchase-item-date">Fecha de compra: <?php
                                                            echo $bloque['header']['FECHA'];
                                                            ?></p>
            <div class="purchase-item-separator"></div>
          </div>

          <div class="purchase-item-products">
            <!-- Producto 1 --><?php
                                foreach ($bloque['detalle'] as $detalle) {

                                ?>
              <div class="purchase-product">
                <div class="purchase-item-image">
                  <img src="/app/Views/src/img/articulos/<?php
                                                          echo htmlspecialchars($detalle['IMAGEN']);
                                                          ?>" alt=" Imagen del producto 1" />
                </div>
                <div class="purchase-product-details">
                  <p class="purchase-item-sku">Sku: <?php
                                                    echo htmlspecialchars($detalle['SKU']);
                                                    ?>"</p>
                  <h3 class="purchase-item-name"><?php
                                                  echo htmlspecialchars($detalle['NOMBRE']);
                                                  ?>"</h3>
                  <p class="purchase-item-price">Precio unitario: <span class="bold-text">$<?php
                                                                                            echo htmlspecialchars($detalle['PRECIO']);
                                                                                            ?> MXN</span></p>
                  <p class="purchase-item-total">Importe: <span class="bold-text">$<?php
                                                                                    echo htmlspecialchars($detalle['IMPORTE']);
                                                                                    ?> MXN</span></p>
                  <p class="purchase-item-quantity">Cantidad comprada: <?php
                                                                        echo htmlspecialchars($detalle['CANTIDAD']);
                                                                        ?></p>
                </div>
              </div>
            <?php
                                }
            ?>
          </div>

          <!-- Subtotal, IVA, Envío y Total -->
          <div class="purchase-summary">
            <div class="purchase-summary-separator"></div>
            <p class="summary-item">
              <span class="summary-label bold-text">Subtotal:</span>
              <span class="summary-value green-text">$<?php
                                                      echo $bloque['header']['SUBTOTAL'];
                                                      ?> MXN</span>
            </p>
            <p class="summary-item">
              <span class="summary-label bold-text">IVA:</span>
              <span class="summary-value green-text">$<?php
                                                      echo $bloque['header']['IVA'];
                                                      ?> MXN</span>
            </p>
            <p class="summary-item">
              <span class="summary-label bold-text">Envío:</span>
              <span class="summary-value green-text">$200.00 MXN</span>
            </p>
            <div class="purchase-summary-separator small"></div>
            <p class="summary-total">
              <span class="summary-label bold-text">Total:</span>
              <span class="summary-value blue-text">$<?php
                                                      $total = $bloque['header']['TOTAL'] + 200;
                                                      echo number_format($total, 2);
                                                      ?> MXN</span>
            </p>
          </div>

        </div>
    <?php
      }
    }
    ?>
  </div>

  <?php
  require __DIR__ . '/layout/footer.php';
  ?>
</body>

</html>