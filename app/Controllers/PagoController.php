<?php

namespace App\Controllers;

use App\Daos\PedidoDao;
use App\Daos\PagoDao;
use App\Daos\CarritoDao;

use App\Models\Pedido;
use App\Models\Pago;

class PagoController
{

    private $pedidoDao;
    private $pagoDao;
    private $carritoDao;


    public function __construct()
    {
        $this->pedidoDao = new PedidoDao();
        $this->pagoDao = new PagoDao();
        $this->carritoDao = new CarritoDao();
    }
    public function ShowPago()
    {
        require_once __DIR__ . '../../Views/facturacion.php';
    }

    public function RealizarPago()
    {
        // Verificar si el usuario está en sesión
        if (!isset($_SESSION['ID'])) {
            // Redirigir al login si no está en sesión
            header('Location: /login');
            exit();
        }

        try {
            // Crear el objeto Pago y establecer sus propiedades
            $pago = new Pago();
            $pago->setIdUsuario($_SESSION['ID']);
            $pago->setNombre($_POST['nombreTitular']);
            $pago->setApellidoPaterno($_POST['apellidoPaterno']);
            $pago->setApellidoMaterno($_POST['apellidoMaterno']);
            $pago->setCodigoPostal($_POST['codigoPostal']);
            $pago->setEstado($_POST['estado']);
            $pago->setMunicipio($_POST['municipio']);
            $pago->setCalle($_POST['calle']);
            $pago->setNumeroExterior($_POST['numExterior']);
            $pago->setNumeroInterior($_POST['numInterior']);
            $pago->setNumeroTarjeta($_POST['numTarjeta']);
            $pago->setCvc($_POST['cvc']);
            $pago->setMes($_POST['mes']);
            $pago->setAno($_POST['ano']);
            $pago->setIsActivo(1);

            // Crear el pago en la base de datos
            $pagoId = $this->pagoDao->create($pago);

            $articulos = $this->carritoDao->mostrarCarrito($_SESSION['ID']);
            $total = 0;
            $iva = 0;
            $subtotal = 0;

            foreach ($articulos as $articulo) {
                $importe = $articulo['CANTIDAD'] * $articulo['PRECIO'];
                $subtotal += $importe;
            }
            $iva = $subtotal * .16;
            $total = $subtotal + $iva;
            // Intentar crear el pedido y los detalles del pedido
            $NumPedido = $this->pedidoDao->create($pagoId, $_SESSION['ID'], $total, $iva, $subtotal);

            if ($NumPedido) {
                foreach ($articulos as $articulo) {
                    $importe = $articulo['CANTIDAD'] * $articulo['PRECIO'];
                    $Respuesta = $this->pedidoDao->createDetalle($_SESSION['ID'], $NumPedido, $articulo['ID_ARTICULO'], $articulo['CANTIDAD'], $importe);
                }

                if ($Respuesta) {
                    header('Location:/tienda?alert=Compra&categoria=2');
                    exit();
                    echo "Pedido y detalles del pedido creados exitosamente.";
                } else {
                    header('Location:/carrito?alert=Error');
                    exit();
                    echo "Error al crear los detalles del pedido.";
                }
            } else {
                header('Location:/?alert=Error');
                exit();
                echo "Error al crear el pedido.";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
