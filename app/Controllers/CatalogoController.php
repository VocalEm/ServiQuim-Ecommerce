<?php

namespace App\Controllers;

use App\Daos\ArticuloDao;
use App\Daos\CategoriaDao;
use App\Daos\UsuarioDao;


class CatalogoController
{
    public function ShowCatalogo()
    {
        // Iniciar la sesión si aún no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $articuloDao = new ArticuloDao();
        $categoriasDao = new CategoriaDao();
        $usuarioDao = new UsuarioDao();

        $IdCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : 2;

        if ($IdCategoria == 2) {
            $articulos = $articuloDao->index(); // Muestra todos los artículos por defecto
        } else {
            $articulos = $articuloDao->indexByCategoria($IdCategoria); // Muestra los artículos por categoría
        }

        $categorias = $categoriasDao->index(); // Muestra todas las categorías

        // Solo intentar obtener favoritos si el usuario ha iniciado sesión
        if (isset($_SESSION['ID'])) {
            $favoritos = $usuarioDao->showFavoritos($_SESSION['ID']);
        } else {
            $favoritos = []; // Si no hay sesión, asignar un array vacío o manejar de otra forma
        }

        require_once __DIR__ . '../../Views/catalogo.php';
    }
}
