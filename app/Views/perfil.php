<?php
if (!isset($_SESSION))
    session_start();


// Nombre de la cookie
$cookie_name = "visit-perfil";

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
$show_intro = !isset($_COOKIE['visit-perfil']);


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

    <div class="user-profile-container">
        <section class="user-profile-info">
            <div class="user-avatar">
                <i class="fa-regular fa-circle-user fa-6x useri"></i>
            </div>
            <h2 class="user-name"><?php echo $usuario['NOMBRE']; ?></h2>
            <p class="user-role"><?php if ($usuario['ISADMIN']) {
                                        echo ("Administrador");
                                    } else {
                                        echo ("Usuario");
                                    } ?></p>
        </section>

        <section class="user-details-section">
            <h3 class="details-title">Detalles del Usuario</h3>
            <ul class="user-details-list">
                <li>
                    <span class="detail-label">Correo:</span> <?php echo $usuario['CORREO']; ?>
                </li>
                <li><span class="detail-label">Teléfono:</span><?php echo $usuario['TELEFONO']; ?></li>
                <li>
                    <span class="detail-label">Fecha de Registro:</span> <?php echo $usuario['FECHA_REGISTRO']; ?>
                </li>
            </ul>
        </section>

        <section class="user-actions-section">
            <a href="/Pedidos?id=<?php echo $usuario['ID']; ?>" class="action-button edit-button <?php echo $show_class ? 'mispedidosintro' : ''; ?>">Mis Pedidos</a>
            <a href="/EditarPerfil?id=<?php echo $usuario['ID']; ?>" class="action-button logout-button <?php echo $show_class ? 'editarperfilintro' : ''; ?>">Editar Información</a>
            <a href="/Logout" class="action-button delete-button <?php echo $show_class ? 'cerrarintro' : ''; ?>">Cerrar Sesion</a>
        </section>
    </div>


    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js"></script>

</body>

<?php if ($show_intro) : ?>
    <script>
        introJs().setOptions({
            steps: [{
                title: 'Pantalla de Usuario',
                intro: 'En esta pantalla puedes ver tu información de usuario, editarla, ver tus compras y cerrar sesión.'
            }, {
                element: document.querySelector('.mispedidosintro'),
                intro: 'Aquí puedes ver tus compras realizadas.'
            }, {
                element: document.querySelector('.editarperfilintro'),
                intro: 'Aquí puedes editar tu información de usuario.'
            }, {
                element: document.querySelector('.cerrarintro'),
                intro: 'Aquí puedes cerrar sesión.'
            }]
        }).start();
    </script>

<?php endif; ?>

</html>