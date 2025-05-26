<?php
// public/index.php 
use App\Clases\Router;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegistroController;
use App\Controllers\NosotrosController;
use App\Controllers\CatalogoController;
use App\Controllers\CarritoController;
use App\Controllers\PerfilController;
use App\Controllers\ArticuloController;
use App\Controllers\PagoController;
use App\Controllers\HistorialController;
use App\Controllers\FavoritosController;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Clases/router.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // Restaurar sesión basada en la cookie 
if (isset($_COOKIE['user_session'])) {
    $_SESSION['ID'] = $_COOKIE['user_session'];
}


$router = new Router(); // Definir las rutas  
$router->addRoute('GET', '/', function () { //muestra la pantalla home
    $HomeController = new HomeController();
    $HomeController->ShowHome();
});

$router->addRoute('GET', '/login', function () { //muestra la pantalla de login
    if (isset($_SESSION['ID'])) {
        $PerfilController = new PerfilController();
        $PerfilController->ShowPerfil();
    } else {
        $LoginController = new LoginController();
        $LoginController->ShowLogin();
    }
});

$router->addRoute('POST', '/login', function () { //Inicia el proceso de login
    $LoginController = new LoginController();
    $LoginController->login();
});

$router->addRoute('GET', '/registro', function () { //muestra el registro
    $RegistroController = new RegistroController();
    $RegistroController->ShowRegistro();
});

$router->addRoute('POST', '/registro', function () { //muestra el registro
    $RegistroController = new RegistroController();
    $RegistroController->registro();
});

$router->addRoute('GET', '/nosotros', function () { //muestra la pantalla de nosotros
    $NosotrosController = new NosotrosController();
    $NosotrosController->ShowNosotros();
});

$router->addRoute('GET', '/sucursales', function () { //muestra la pantalla de nosotros
    $NosotrosController = new NosotrosController();
    $NosotrosController->ShowSucursales();
});

$router->addRoute('GET', '/contacto', function () { //muestra la pantalla de nosotros
    $NosotrosController = new NosotrosController();
    $NosotrosController->ShowContactanos();
});

$router->addRoute('GET', '/tienda', function () { //muestra la pantalla de nosotros
    $CatalogoController = new CatalogoController();
    $CatalogoController->ShowCatalogo();
});

$router->addRoute('GET', '/articulo', function () { //muestra la pantalla de nosotros
    $ArticuloController = new ArticuloController();
    $ArticuloController->ShowArticulo();
});

$router->addRoute('GET', '/carrito', function () { //muestra la pantalla de nosotros
    $CarritoController = new CarritoController();
    $CarritoController->ShowCarrito();
});

$router->addRoute('GET', '/facturacion', function () { //muestra la pantalla de nosotros
    $PagoController = new PagoController();
    $PagoController->ShowPago();
});

$router->addRoute('POST', '/facturacion', function () { //muestra la pantalla de nosotros
    $PagoController = new PagoController();
    $PagoController->RealizarPago();
});

$router->addRoute('GET', '/perfil', function () { //muestra la pantalla de nosotros
    if (isset($_SESSION['ID'])) {
        $PerfilController = new PerfilController();
        $PerfilController->ShowPerfil();
    } else {
        $LoginController = new LoginController();
        $LoginController->ShowLogin();
    }
});

$router->addRoute('GET', '/Pedidos', function () { //muestra la pantalla de nosotros
    $PedidoController = new HistorialController();
    $PedidoController->ShowHistorialPedidos();
});

$router->addRoute('GET', '/EditarPerfil', function () { //muestra la pantalla de nosotros
    $PerfilController = new PerfilController();
    $PerfilController->ShowEditarPerfil();
});

$router->addRoute('GET', '/Logout', function () { //muestra la pantalla de nosotros
    $PerfilController = new PerfilController();
    $PerfilController->CerrarSesion();
});

$router->addRoute('POST', '/EditarPerfil', function () { //muestra la pantalla de nosotros
    $PerfilController = new PerfilController();
    $PerfilController->EditarUsuario();
});

$router->addRoute('GET', '/Favoritos', function () { //muestra la pantalla de nosotros
    $favoritosController = new FavoritosController();

    if (isset($_GET['eliminar'])) {
        if ($_GET['eliminar']) {
            $favoritosController->EliminarFavorito();
        }
    } else {
        if (isset($_GET['id_articulo'])) {
            $favoritosController->AgregarFavorito();
        } else {
            $favoritosController->ShowFavoritos();
        }
    }
});



$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->handleRequest($requestMethod, $requestUri);
