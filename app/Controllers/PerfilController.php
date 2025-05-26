<?php

namespace App\Controllers;

use App\Daos\UsuarioDao;
use App\Models\Usuario;

class PerfilController
{
    public function EditarUsuario()
    {
        $usuarioDao = new UsuarioDao();

        $usuario = new Usuario();

        $usuario->setNombre($_POST['nombre']);
        $usuario->setApellidoPaterno($_POST['apellidoPaterno']);
        $usuario->setApellidoMaterno($_POST['apellidoMaterno']);
        $usuario->setPassword($_POST['password']);
        $usuario->setTelefono($_POST['telefono']);

        $respuesta = $usuarioDao->editarUsuario($usuario);

        if ($respuesta) {
            header('Location:/perfil');
        } else {
            header('Location:/');
        }
    }

    function cerrarSesion()
    {
        // Iniciar la sesión si aún no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, también se debe destruir la cookie de sesión.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Destruir la cookie personalizada si existe
        if (isset($_COOKIE['user_session'])) {
            setcookie('user_session', '', time() - 42000, '/');
        }

        // Redirigir a la página de inicio o login después de cerrar sesión
        header('Location: /login');
        exit();
    }


    public function ShowEditarPerfil()
    {

        $usuarioDao = new UsuarioDao();
        $usuarioDefecto = $usuarioDao->perfil($_SESSION['ID']);
        require_once __DIR__ . '../../Views/editarPerfil.php';
    }

    public function ShowPerfil()
    {
        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->perfil($_SESSION['ID']);
        require_once __DIR__ . '../../Views/perfil.php';
    }
}
