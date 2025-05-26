<?php
if (!isset($_SESSION))
    session_start();


// Nombre de la cookie
$cookie_name = "visit-articulo";

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
$show_intro = !isset($_COOKIE['visit-articulo']);


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



    <div class="bady1">
        <div class="product-container">
            <div class="product-image-container">
                <a class="imagen-heart <?php echo $show_class ? 'corazonintro' : ''; ?>" href="/Favoritos?id_articulo=<?php echo $articulo['ID'];
                                                                                                                        if (isset($_GET['is_favorito']) && $_GET['is_favorito'] == 1) {
                                                                                                                            echo "&eliminar=1";
                                                                                                                        } else {
                                                                                                                            echo "&agregar=1";
                                                                                                                        } ?>"> <i class="<?php if (isset($_GET['is_favorito']) && $_GET['is_favorito'] == 1) echo "favorito-activo "; ?>fa-solid fa-heart fa-4x"></i> </a>
                <img
                    src="/app/Views/src/img/articulos/<?php echo $articulo['IMAGEN']; ?>"
                    alt="Imagen del producto" />
            </div>
            <div class="product-details">
                <p class="product-info">SKU: <?php
                                                echo $articulo['SKU']
                                                ?> | Marca: <?php
                                                            echo $articulo['MARCA_NOMBRE'];
                                                            ?></p>
                <h1><?php echo $articulo['NOMBRE']; ?></h1>
                <p class="product-stock">Stock: Disponibilidad</p>
                <p class="product-price-note">Precio sin IVA</p>
                <p class="product-price">$ <?php
                                            echo $articulo['PRECIO'];
                                            ?> MXN</p>
                <p class="product-quantity">Cantidad: 1</p>
                <form action="/articulo" method="GET" class="product-buttons">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($articulo['ID']); ?>">
                    <button name="compra" value="1" type="submit" class="product-buy-now <?php echo $show_class ? 'comprabotonintro' : ''; ?>">Comprar Ahora</button>
                    <button name="carrito" value="1" type="submit" class="product-add-to-cart <?php echo $show_class ? 'carritobotonintro' : ''; ?>">Agregar al carrito</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bady1">
        <div class="product-extra-info">
            <div class="product-description">
                <h2>Descripción del Producto</h2>
                <p>
                    <?php
                    echo $articulo['DESCRIPCION'];
                    ?>
                </p>
            </div>
        </div>
    </div>

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
    <script src="/app/Views/build/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js"></script>

</body>
<?php if ($show_intro) : ?>
    <script>
        introJs().setOptions({
            steps: [{
                title: 'Pantalla de artículo',
                intro: 'En esta pantalla puedes agregar un artículo a tu carrito o agregarlo a tus favoritos.'
            }, {
                element: document.querySelector('.corazonintro'),
                intro: 'Aquí puedes agregar o eliminar tu artículo de favoritos.'
            }, {
                element: document.querySelector('.comprabotonintro'),
                intro: 'Aquí puedes agregar un artículo al carrito y proceder directamente para pago.'
            }, {
                element: document.querySelector('.carritobotonintro'),
                intro: 'Aquí puedes aumentar la cantidad del artículo en el carrito.'
            }]
        }).start();
    </script>

<?php endif; ?>

</html>