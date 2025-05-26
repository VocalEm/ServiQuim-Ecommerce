<?php

namespace App\Controllers;

use App\Daos\CarritoDao;
use App\Daos\UsuarioDao;


class CarritoController
{
    public function ShowCarrito()
    {
        $carritoDao = new CarritoDao();
        $usuarioDao = new UsuarioDao();
        $articulos = $carritoDao->mostrarCarrito($_SESSION['ID']);
        $favoritos = $usuarioDao->showFavoritos($_SESSION['ID']);
        if ($articulos) {
            $subTotal = $carritoDao->calculoPrecio($_SESSION['ID']);
        }


        // Iniciar la sesión si no está ya iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario está logueado
        if (!isset($_SESSION['ID'])) {
            header('Location:/login');
            exit();
        } else {
            if (isset($_GET['eliminar'])) {
                $resultado = $carritoDao->eliminar($_GET['id']);
                if ($resultado) {
                    header('Location:/carrito');
                    exit();
                } else {
                    $errores = "no se pudo eliminar";
                }
            } elseif (isset($_GET['agregar'])) {
                $resultado = $carritoDao->agregarCantidad($_GET['id']);
                if ($resultado) {
                    header('Location:/carrito');
                    exit();
                } else {
                    $errores = "no se pudo agregar";
                }
            } elseif (isset($_GET['quitar'])) {
                $resultado = $carritoDao->quitarCantidad($_GET['id']);
                if ($resultado) {
                    header('Location:/carrito');
                    exit();
                } else {
                    $errores = "no se pudo quitar";
                }
            }

            // Obtener los artículos del carrito y mostrar la vista
            require_once __DIR__ . '../../Views/carrito.php'; // Ajuste de la ruta
        }
    }
}
