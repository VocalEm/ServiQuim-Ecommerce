<?php

namespace App\Controllers;

use App\Daos\UsuarioDao;
use App\Models\Usuario;

class RegistroController
{
    public function ShowRegistro()
    {
        require_once __DIR__ . '../../Views/registro.php';
    }

    public function registro()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();

            // Obtener datos del formulario
            $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
            $nombre = htmlspecialchars(trim($_POST['nombre']));
            $apellidoPaterno = htmlspecialchars(trim($_POST['apellidoPaterno']));
            $apellidoMaterno = htmlspecialchars(trim($_POST['apellidoMaterno']));
            $telefono = htmlspecialchars(trim($_POST['telefono']));
            $password = $_POST['password'];
            $passwordConfirm = $_POST['passwordConfirm'];
            $terminos = isset($_POST['terminos']) ? true : false;

            // Validar que todos los campos requeridos estén completos
            if (!$correo || !$nombre || !$apellidoPaterno || !$apellidoMaterno || !$telefono || !$terminos) {
                $_SESSION['error'] = "Por favor complete todos los campos requeridos";
                header('Location:/registro');
                exit();
            }

            // Validar que las contraseñas coincidan
            if ($password !== $passwordConfirm) {
                $_SESSION['error'] = "Las contraseñas no coinciden";
                header('Location:/registro');
                exit();
            }

            // Validar formato del teléfono (número de 10 dígitos)
            if (!preg_match('/^[0-9]{10}$/', $telefono)) {
                $_SESSION['error'] = "El teléfono debe tener 10 dígitos";
                header('Location:/registro');
                exit();
            }

            // Crear objeto Usuario con los datos sanitizados
            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setApellidoPaterno($apellidoPaterno);
            $usuario->setApellidoMaterno($apellidoMaterno);
            $usuario->setCorreo($correo);
            $usuario->setTelefono($telefono);
            $usuario->setPassword($password);

            // Guardar usuario en la base de datos
            $usuarioDao = new UsuarioDao();
            $respuesta = $usuarioDao->create($usuario);

            // Redirigir según el resultado
            if ($respuesta) {
                header('Location:/login');
            } else {
                $_SESSION['error'] = "Error al registrar el usuario. Intente de nuevo.";
                header('Location:/registro');
            }
            exit();
        }
    }
}
