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

    <div class="contact-page">
        <!-- Cabecera -->
        <header class="contact-header">
            <h1>¿Cómo podemos ayudarte?</h1>
            <p>Estamos aquí para resolver tus dudas y escuchar tus comentarios.</p>
        </header>

        <!-- Contenido Principal -->
        <main class="contact-content">
            <!-- Columna Izquierda: Información de Contacto -->
            <section class="contact-details">
                <div class="info-box">
                    <h2>📞 Atención Telefónica</h2>
                    <p>Llámanos al:</p>
                    <ul>
                        <li>+52 123 456 7890</li>
                        <li>+52 987 654 3210</li>
                    </ul>
                </div>
                <div class="info-box">

                </div>

            </section>

            <!-- Columna Derecha: Formulario -->
            <section class="contact-form-section">
                <h2>Envíanos tu mensaje</h2>
                <form class="contact-form">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Tu nombre completo..." required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Tu correo electrónico..." required>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone" name="phone" placeholder="Tu teléfono...">
                    </div>
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder="Asunto del mensaje..." required>
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Escribe tu mensaje aquí..." rows="6" required></textarea>
                    </div>
                    <button type="submit" class="contact-submit-button">Enviar Mensaje</button>
                </form>
            </section>
        </main>
    </div>

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
</body>

</html>