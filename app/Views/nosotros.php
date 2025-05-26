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

    <section class="hero-section">
        <div class="container">
            <h1>DESDE 1988</h1>
            <h2>Nuestra Historia</h2>
            <p>Desde 1988, somos fabricantes y distribuidores de productos químicos, accesorios y equipos para programas profesionales de limpieza.</p>
            <p>Nuestro objetivo es desarrollar las mejores soluciones para el mercado institucional e industrial.</p>
        </div>
    </section>

    <section class="commitment-section">
        <div class="container">
            <h2>COMPROMISO</h2>
            <p>Apoyamos a nuestros clientes en el diseño, implementación y monitoreo de sus programas de limpieza e higiene para lograr el resultado más óptimo a sus necesidades específicas y su presupuesto.</p>
        </div>
    </section>

    <section class="services-section">
        <div class="container">
            <div class="service">
                <h3>Análisis de la situación actual</h3>
            </div>
            <div class="service">
                <h3>Capacitación e implementación de nuevos sistemas de higiene</h3>
            </div>
            <div class="service">
                <h3>Monitoreo y auditoría</h3>
            </div>
            <div class="service">
                <h3>Desarrollo de procedimientos y materiales de apoyo</h3>
            </div>
            <div class="service">
                <h3>Servicio Técnico</h3>
            </div>
        </div>
    </section>
    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
</body>

</html>