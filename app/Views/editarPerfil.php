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

    <div class="edit-profile-container">
        <h2 class="edit-profile-title">Editar Información Personal</h2>
        <form action="/EditarPerfil" method="POST" class="edit-profile-form">
            <div class="form-group">
                <label for="edit-name">Nombre</label>
                <input
                    class="editarInput"
                    type="text"
                    id="edit-name"
                    name="nombre"
                    placeholder="Ingrese su nombre"
                    value="<?php echo $usuarioDefecto['NOMBRE']; ?>"
                    required />
            </div>

            <div class="form-group">
                <label for="edit-name">Apellido Paterno</label>
                <input
                    class="editarInput"
                    type="text"
                    id="edit-name"
                    name="apellidoPaterno"
                    placeholder=""
                    value="<?php echo $usuarioDefecto['APELLIDO_PATERNO']; ?>"
                    required />
            </div>

            <div class="form-group">
                <label for="edit-name">Apellido Materno</label>
                <input
                    class="editarInput"
                    type="text"
                    id="edit-name"
                    name="apellidoMaterno"
                    placeholder=""
                    value="<?php echo $usuarioDefecto['APELLIDO_MATERNO']; ?>"
                    required />
            </div>


            <div class="form-group">
                <label for="edit-phone">Teléfono</label>
                <input
                    class="editarInput"
                    type="tel"
                    id="edit-phone"
                    name="telefono"
                    placeholder=""
                    value="<?php echo $usuarioDefecto['TELEFONO']; ?>" />
            </div>

            <div class="form-group">
                <label for="edit-phone">Teléfono</label>
                <input
                    class="editarInput"
                    type="password"
                    id="edit-phone"
                    name="password"
                    placeholder=""
                    value="<?php echo $usuarioDefecto['PASSWORD']; ?>" />
            </div>

            <div class="form-buttons">
                <button type="submit" class="save-button">Guardar Cambios</button>
                <button
                    type="button"
                    class="cancel-button"
                    onclick="window.history.back()">
                    Cancelar
                </button>
            </div>
        </form>
    </div>

    <?php
    require __DIR__ . '/layout/footer.php';
    ?>
</body>

</html>