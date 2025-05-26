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

    <div class="catalog-main-container">
        <!-- Menú de Categorías -->
        <aside class="catalog-sidebar">
            <?php
            foreach ($categorias as $categoria) {
            ?>
                <a href="/tienda?categoria=<?php echo $categoria['ID'] ?>" class="catalog-category-button <?php if ($categoria['ID'] == $_GET['categoria']) {
                                                                                                                echo "catalog-category-button-active";
                                                                                                            } ?>"><?php
                                                                                                                    echo $categoria['NOMBRE'];
                                                                                                                    ?></a>
            <?php
            }
            ?>
        </aside>

        <!-- Tarjetas de Productos -->
        <div class="catalog-products-container">
            <?php
            foreach ($articulos as $articulo):
                $esFavorito = false;
                foreach ($favoritos as $favorito) {
                    if ($articulo['ID'] == $favorito['ID']) {
                        $esFavorito = true;
                        break;
                    }
                }
            ?>
                <a href="/articulo?id=<?php echo ($articulo['ID']);
                                        if ($esFavorito) {
                                            echo "&is_favorito=" . 1;
                                        } else {
                                            echo "&is_favorito=" . 0;
                                        } ?>" class="catalog-product-card">
                    <img
                        src="/app/Views/src/img/articulos/<?php
                                                            echo htmlspecialchars($articulo['IMAGEN']);
                                                            ?>"
                        alt="Dispensador TORK"
                        class="catalog-product-image" />
                    <div class="catalog-product-details">
                        <h1 class="catalog-product-title"><?php
                                                            echo htmlspecialchars($articulo['NOMBRE']);
                                                            ?></h1>
                        <p class="catalog-product-price">$<?php
                                                            echo htmlspecialchars($articulo['PRECIO']);
                                                            ?></p>
                    </div>
                    <?php
                    if ($esFavorito) {
                    ?>
                        <button type="submit"
                            class="catalog-wishlist-button"
                            aria-label="Añadir a favoritos">
                            <i class="fa-solid fa-heart fa-2x"></i> </button>
                    <?php
                    }
                    ?>
                </a>
            <?php endforeach; ?>

        </div>
    </div>

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
    <script src="/app/Views/build/js/app.js">

    </script>
</body>

</html>