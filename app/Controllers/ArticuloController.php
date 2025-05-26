<?php

namespace App\Controllers;

use App\Daos\ArticuloDao;
use App\Daos\CarritoDao;
use App\Daos\UsuarioDao;

class ArticuloController
{
    public function ShowArticulo()
    {
        $id = $_GET['id'];
        $articuloDao = new ArticuloDao();
        $carritoDao = new CarritoDao();
        $UsuarioDao = new UsuarioDao();

        $articulo = $articuloDao->byId($id);

        if (isset($_GET['compra'])) {
            if (!isset($_SESSION['ID'])) {
                header('Location:/login');
                exit();
            } else {
                $respuesta = $carritoDao->agregaArticuloExistente($articulo['ID']);
                if ($respuesta) {
                    $alerta = "Aumento la cantidad del articulo en el carrito";
                    header('Location:/carrito');
                    exit();
                } else {
                    $carritoDao->agregarCarrito($_SESSION['ID'], $id, 1);
                    $alerta = "Agregado al carrito";
                    header('Location:/carrito');
                    exit();
                }
            }
        } else if (isset($_GET['carrito'])) {
            if (!isset($_SESSION['ID'])) {
                header('Location:/login');
                exit();
            } else if (isset($_GET['carrito'])) {
                if (!isset($_SESSION['ID'])) {
                    header('Location:/login');
                    exit();
                } else {
                    $respuesta = $carritoDao->agregaArticuloExistente($articulo['ID']);
                    $isFavorito = (isset($_GET['is_favorito']) ? $_GET['is_favorito'] : 0);
                    if ($respuesta) {
                        $favorito = $UsuarioDao->showFavoritosById($_SESSION['ID'], $articulo['ID']);
                        $favoritoParam = ($favorito['ID'] == $articulo['ID']) ? 'is_favorito=1' : 'is_favorito=0';
                        header('Location:/articulo?id=' . $articulo['ID'] . '&alert=Agregar&' . $favoritoParam);
                        exit();
                    } else {
                        $carritoDao->agregarCarrito($_SESSION['ID'], $id, 1);
                        $favorito = $UsuarioDao->showFavoritosById($_SESSION['ID'], $articulo['ID']);
                        $favoritoParam = ($favorito['ID'] == $articulo['ID']) ? 'is_favorito=1' : 'is_favorito=0';
                        header('Location:/articulo?id=' . $articulo['ID'] . '&alert=Agregar&' . $favoritoParam);
                        exit();
                    }
                }
            }
        } else {

            require_once __DIR__ . '../../Views/articulo.php'; // Ajuste de ruta
        }
    }
}
