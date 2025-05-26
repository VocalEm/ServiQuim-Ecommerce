<?php

namespace App\Clases;

class Router
{
    private $routes = [];
    // Añadir una nueva ruta 
    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = ['method' => $method, 'path' => $path, 'handler' => $handler];
    } // Manejar una solicitud 

    public function handleRequest($method, $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match('#^' . $route['path'] . '$#', $path, $matches)) {
                return call_user_func_array($route['handler'], array_slice($matches, 1));
            }
        } // Si no se encuentra la ruta, lanzar un error 404 
        http_response_code(404);
        echo '404 Not Found';
    }
}
