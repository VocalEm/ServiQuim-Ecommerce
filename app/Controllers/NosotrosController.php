<?php

namespace App\Controllers;


class NosotrosController
{
    public function ShowNosotros()
    {
        require_once __DIR__ . '../../Views/nosotros.php';
    }

    public function ShowContactanos()
    {
        require_once __DIR__ . '../../Views/contactanos.php';
    }

    public function ShowSucursales()
    {
        require_once __DIR__ . '../../Views/sucursales.php';
    }
}
