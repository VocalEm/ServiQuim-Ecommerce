<?php

namespace App\Controllers;

use App\Daos\DashboardDao;


class HomeController
{
    public function ShowHome()
    {
        $dashboardDao = new DashboardDao();
        $masVendido = $dashboardDao->articuloMasVendido();
        $masFavorito = $dashboardDao->articuloMasFavorito();
        $menosFavorito = $dashboardDao->articuloMenosFavorito();


        require __DIR__ . '../../Views/home.php';
    }
}
