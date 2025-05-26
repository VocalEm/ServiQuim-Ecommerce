<?php

namespace App\Controllers;

use App\Daos\UsuarioDao;
use App\Models\Usuario;

class LoginController
{
    public function ShowLogin()
    {
        if (isset($_SESSION['ID'])) {
            header("Location:/perfil");
        } else {
            require_once __DIR__ . '../../Views/login.php';
        }
    }
    public function login()
    {
        $usuarioDao = new UsuarioDao();
        $usuario = new Usuario();
        $usuario->setCorreo($_POST['correo']);
        $usuario->setPassword($_POST['password']);

        $userId = $usuarioDao->login($usuario);
        if ($userId) { // Iniciar la sesión si aún no está iniciada 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['ID'] = $userId;

            if ($_POST['recordar']) {
                $cookie_name = "user_session";
                $cookie_value = $userId;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 segundos = 1 día
            }
            $this->ShowLogin();
            exit();
        } else {
            $this->ShowLogin();
        }
    }
}
