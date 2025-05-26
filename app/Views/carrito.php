<?php
if (!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php
require __DIR__ . '/layout/head.php'
?>

<body class="with-footer">
    <?php
    require __DIR__ . '/layout/header.php'
    ?>


    <!-- ESTE CÓDIGO ES PARA CREAR LA TARJETA DE UN PRODUCTO EN EL CARRITO -->
    <!-- SE DEBE HACER QUE POR CADA PRODUCTO DISTINTO EN EL CARRITO SE CREE UNO NUEVO CON LA INFORMACIÓN CORRESPONDIENTE -->
    <main>
        <div class="cart-page">

            <div class="cart-items">
                <?php
                foreach ($articulos as $articulo):
                    $esFavorito = false;
                    foreach ($favoritos as $favorito) {
                        if ($articulo['ID_ARTICULO'] == $favorito['ID']) {
                            $esFavorito = true;
                            break;
                        }
                    }
                ?>
                    <form class="cart-item">
                        <a href="/articulo?id=<?php echo $articulo['ID_ARTICULO'];
                                                if ($esFavorito) {
                                                    echo "&is_favorito=1";
                                                } else {
                                                    echo "&is_favorito=0";
                                                }
                                                ?>" class="product-image">
                            <img src="/app/Views/src/img/articulos/<?php echo $articulo['IMAGEN']; ?>" alt="Producto" />
                        </a>
                        <div class="product-info">
                            <p class="sku">Sku: <span><?php
                                                        echo $articulo['SKU'];
                                                        ?></span> Marca: <span><?php
                                                                                echo $articulo['MARCA'];
                                                                                ?></span></p>
                            <a href="/articulo?id=<?php echo $articulo['ID_ARTICULO']; ?>" class="product-name"><?php
                                                                                                                echo $articulo['NOMBRE'];
                                                                                                                ?></a>
                            <p class="price">Precio: <span>$<?php
                                                            echo $articulo['PRECIO'];
                                                            ?> MXN</span></p>
                            <p class="total-price">Importe: <span>$<?php
                                                                    $importe = $articulo['PRECIO'] * $articulo['CANTIDAD'];
                                                                    echo number_format($importe, 2);
                                                                    ?> MXN</span></p>
                            <div action="/carrito" method="GET" class="quantity-control">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($articulo['ID']); ?>">
                                <button name="quitar" type="submit" class="btn-quantity minus">-</button>
                                <input disabled type="number" value="<?php echo $articulo['CANTIDAD']; ?>" class="quantity" />
                                <button name="agregar" type="submit" class="btn-quantity plus">+</button>
                            </div>
                        </div>
                        <button name="eliminar" type="submit" class="btn delete-item"><i class="fa fa-trash"></i></button>
                    </form>
                <?php
                endforeach;
                ?>
            </div>


            <!-- FIN DE LA TARJETA DE PRODUCTO EN EL CARRITO-->

            <form action="/facturacion" class="cart-summary">
                <div class="cart-summary-contenedor">
                    <h3>Total a Pagar</h3>

                    <?php
                    foreach ($articulos as $articulo):
                    ?>
                        <p class="summary-total articulo">
                            <?php
                            echo $articulo['CANTIDAD'];
                            ?>x <?php
                                echo $articulo['NOMBRE'];
                                ?><span class="articulo-span"> $<?php $importe = $articulo['PRECIO'] * $articulo['CANTIDAD'];
                                                                echo number_format($importe, 2); ?> MXN</span>
                        </p>
                    <?php
                    endforeach;
                    ?>
                    <?php
                    if (isset($subTotal) && $subTotal != null) {
                        $envio = 200;
                        $iva = $subTotal * 0.16;
                        $total = $subTotal * 1.16 + $envio;
                    } else {
                        $subTotal = 0;
                        $iva = 0;
                        $total = 0;
                        $envio = 0;
                    }
                    ?>
                    <p class="summary-total subtotal">SubTotal: <span>$<?php echo number_format($subTotal, 2); ?> MXN</span></p>
                    <p class="summary-total">IVA: <span>$<?php echo number_format($iva, 2); ?> MXN</span></p>
                    <p class="summary-total">Envío: <span>$<?php echo number_format($envio, 2); ?> MXN</span></p>
                    <p class="summary-total total">
                        Total: <span class="total-span">$<?php echo number_format($total, 2); ?> MXN</span>
                    </p>
                </div>
                <?php
                if ($total == 0) { ?>
                    <a href="/carrito" type="submit" class="btn proceed-to-payment">Proceder a pago</a>
                <?php } else { ?>
                    <a href="/facturacion" type="submit" class="btn proceed-to-payment">Proceder a pago</a>
                <?php } ?>

            </form>
        </div>
        <!-- FIN DEL CUERPO DE LA PANTALLA-->
    </main>

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
    <script src="/app/Views/build/js/app.js">

    </script>
</body>

</html>