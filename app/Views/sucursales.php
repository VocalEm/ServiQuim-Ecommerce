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

    <!-- CUERPO DE LA PAGINA......................................................................................................... -->
    <div class="branch-container">
        <h1 class="branch-title">Nuestras Sucursales</h1>

        <!-- Sucursal 1 -->
        <div class="branch">
            <h2 class="branch-name">Sucursal 1</h2>
            <div class="branch-details">
                <p class="branch-address">
                    <span class="address-icon">📍</span>
                    Carr. Int. Guaymas Hermosillo Norte #2170 Local 6,
                    Colonia Buenos Aires, Parque Logístico Roca Fuerte,
                    <strong> Guaymas, Sonora, C.P. 85500</strong>
                </p>
                <p class="branch-phone">
                    <span class="phone-icon">📞</span>
                    <strong>(622) 165-1934</strong>
                </p>
            </div>
            <div class="map-container" data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14406.690249524883!2d-110.9302638!3d27.9437151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86ce91c73699e6db%3A0x5fa9e7d4c4aa3d61!2sParque%20Log%C3%ADstico%20Rocafuerte!5e0!3m2!1ses!2smx!4v1699808597123!5m2!1ses!2smx"></div>
        </div>

        <!-- Sucursal 2 -->
        <div class="branch">
            <h2 class="branch-name">Sucursal 2</h2>
            <div class="branch-details">
                <p class="branch-address">
                    <span class="address-icon">📍</span>
                    Sierra de los Arados #5221, Col. LA Cuesta, <br />
                    <strong>Ciudad Juárez, Chihuahua, C.P. 32650</strong>
                </p>
                <p class="branch-phone">
                    <span class="phone-icon">📞</span>
                    <strong>(656) 637-9526</strong>
                </p>
            </div>
            <div class="map-container" data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13135.953926230716!2d-106.42714474999999!3d31.6229164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75aa6f0f2a8d1%3A0x5b9e8e2d0f1e7b48!2sLa%20Cuesta%2C%20Ciudad%20Ju%C3%A1rez%2C%20Chih.!5e0!3m2!1ses!2smx!4v1699808758793!5m2!1ses!2smx"></div>
        </div>

        <!-- Sucursal 3 -->
        <div class="branch">
            <h2 class="branch-name">Sucursal 3</h2>
            <div class="branch-details">
                <p class="branch-address">
                    <span class="address-icon">📍</span>
                    Maguarichic #6510, Col. Parral, <br />
                    <strong>Chihuahua, Chihuahua, C.P. 31104</strong>
                </p>
                <p class="branch-phone">
                    <span class="phone-icon">📞</span>
                    <strong>(614) 417-1006</strong>
                </p>
            </div>
            <div class="map-container" data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11727.053071225543!2d-106.13091615!3d28.6475246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86ea4438bda85811%3A0xe0f66b9a176891c!2sCol.%20Parral%2C%20Chihuahua%2C%20Chih.!5e0!3m2!1ses!2smx!4v1699808899453!5m2!1ses!2smx"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mapContainers = document.querySelectorAll(".map-container");
            mapContainers.forEach(container => {
                const mapSrc = container.getAttribute("data-src");
                const iframe = document.createElement("iframe");
                iframe.src = mapSrc;
                iframe.allowFullscreen = true;
                iframe.loading = "lazy";
                iframe.referrerPolicy = "no-referrer-when-downgrade";
                container.appendChild(iframe);
            });
        });
    </script>

    <!-- FIN CUERPO DE LA PAGINA......................................................................................................... -->

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
</body>

</html>