<?php

namespace App\Controllers;

use App\Daos\PedidoDao;

class HistorialController
{

    public function ShowHistorialPedidos()
    {
        $pedidoDao = new PedidoDao();
        $BloquesPedidos = $pedidoDao->historialPedidos($_SESSION['ID']);

        require_once __DIR__ . '../../Views/Historial.php';
    }
}
