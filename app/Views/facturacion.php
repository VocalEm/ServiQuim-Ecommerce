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


    <div class="payment-container">
        <h1 class="payment-title">Proceso de Pago</h1>
        <form action="/facturacion" method="POST">
            <!-- Información de facturación -->
            <section class="billing-section">
                <h2 class="section-title">Información de Facturación</h2>
                <div class="formulario">
                    <div class="form-group">
                        <label for="nombre-titular">Nombre del Titular:</label>
                        <input
                            name="nombreTitular"
                            class="pagoInput"
                            type="text"
                            id="nombre-titular"
                            placeholder="Escribe tu nombre completo" />
                    </div>
                    <div class="form-group">
                        <label for="apellido-paterno">Apellido Paterno:</label>
                        <input
                            name="apellidoPaterno"
                            class="pagoInput"
                            type="text"
                            id="apellido-paterno"
                            placeholder="Escribe tu apellido paterno" />
                    </div>
                    <div class="form-group">
                        <label for="apellido-materno">Apellido Materno:</label>
                        <input
                            name="apellidoMaterno"
                            class="pagoInput"
                            type="text"
                            id="apellido-materno"
                            placeholder="Escribe tu apellido materno" />
                    </div>
                    <div class="form-group">
                        <label for="codigo-postal">Código Postal:</label>
                        <input
                            name="codigoPostal"
                            class="pagoInput"
                            type="text"
                            id="codigo-postal"
                            placeholder="Código postal" />
                    </div>
                    <div class="form-group">
                        <label for="calle">Calle:</label>
                        <input
                            name="calle"
                            class="pagoInput"
                            type="text"
                            id="calle"
                            placeholder="Nombre de la calle" />
                    </div>
                    <div class="form-group">
                        <label for="num-ext">Número Exterior:</label>
                        <input
                            name="numExterior"
                            class="pagoInput"
                            type="text"
                            id="num-ext"
                            placeholder="Número exterior" />
                    </div>
                    <div class="form-group">
                        <label for="num-int">Número Interior:</label>
                        <input
                            name="numInterior"
                            class="pagoInput"
                            type="text"
                            id="num-int"
                            placeholder="Número interior (opcional)" />
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input
                            name="estado"
                            class="pagoInput"
                            type="text"
                            id="estado"
                            placeholder="Estado" />
                    </div>
                    <div class="form-group">
                        <label for="municipio">Municipio:</label>
                        <input
                            name="municipio"
                            class="pagoInput"
                            type="text"
                            id="municipio"
                            placeholder="Municipio" />
                    </div>
                </div>
            </section>

            <!-- Línea de separación -->
            <hr class="section-divider" />

            <!-- Información de tarjeta -->
            <section class="card-section">
                <h2 class="section-title">Información de Tarjeta</h2>
                <div class="formulario">
                    <div class="form-group">
                        <label for="num-tarjeta">Número de Tarjeta:</label>
                        <input
                            name="numTarjeta"
                            class="pagoInput"
                            type="text"
                            id="num-tarjeta"
                            placeholder="XXXX-XXXX-XXXX-XXXX" />
                    </div>
                    <div class="form-group">
                        <label for="cvc">CVC:</label>
                        <input
                            name="cvc"
                            class="pagoInput"
                            type="text"
                            id="cvc"
                            placeholder="Código de seguridad" />
                    </div>
                    <div class="form-group">
                        <label for="mes">Mes:</label>
                        <input
                            name="mes"
                            class="pagoInput"
                            type="text"
                            id="mes"
                            placeholder="MM" />
                    </div>
                    <div class="form-group">
                        <label for="ano">Año:</label>
                        <input
                            name="ano"
                            class="pagoInput"
                            type="text"
                            id="ano"
                            placeholder="YYYY" />
                    </div>
                </div>
            </section>

            <!-- Botones -->
            <div class="button-group">
                <button type="submit" class="btn btn-green">Proceder a Pago</button>
                <a href="/carrito" class="btn btn-blue">Volver</a>
            </div>
        </form>
    </div>

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
</body>

</html>