<?php

namespace App\Controllers;

use App\Daos\UsuarioDao;

class FavoritosController
{
    public function ShowFavoritos()
    {
        // Verificar si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['ID'])) {
            // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de error
            header('Location: /login'); // Asegúrate de ajustar la URL a tu página de login
            exit();
        }

        $usuarioDao = new UsuarioDao();
        $favoritos = $usuarioDao->showFavoritos($_SESSION['ID']);
        require_once __DIR__ . '../../Views/Favoritos.php';
    }

    public function ShowUnFavoritos()
    {
        // Verificar si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['ID'])) {
            // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de error
            header('Location: /login'); // Asegúrate de ajustar la URL a tu página de login
            exit();
        }

        $usuarioDao = new UsuarioDao();
        $favoritos = $usuarioDao->showFavoritos($_SESSION['ID']);
        require_once __DIR__ . '../../Views/Favoritos.php';
    }


    public function AgregarFavorito()
    {
        $usuarioDao = new UsuarioDao();
        $favoritos = $usuarioDao->AgregarFavorito($_SESSION['ID'], $_GET['id_articulo']);
        if ($favoritos) {
            header('Location:/Favoritos');
            exit();
        }
        header('Location:/login');
        exit();
    }

    public function EliminarFavorito()
    {
        $usuarioDao = new UsuarioDao();
        $respuesta = $usuarioDao->EliminarFavorito($_SESSION['ID'], $_GET['id_articulo']);
        if ($respuesta) {
            header('Location:/Favoritos');
            exit; // Asegura que se detenga el script después de la redirección
        }
        header('Location:/');
        exit; // Asegura que se detenga el script después de la redirección
    }
}
