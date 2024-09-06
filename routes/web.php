<?php

session_start();

use App\Controllers\AuthController;
use App\Controllers\WeatherController;

$authController = new AuthController();
$weatherController = new WeatherController(); // Agregamos el controlador de clima

// Capturamos la ruta actual
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalizamos la ruta
$uri = trim($uri, '/');

// Definimos las rutas
switch ($uri) {
    case 'calidadSG_app/public':
        $authController->showLoginForm();
        break;

    case 'calidadSG_app/public/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;

    case 'calidadSG_app/public/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->showRegisterForm();
        }
        break;

    case 'calidadSG_app/public/dashboard':
        $authController->dashboard();
        $userId = $_SESSION['user_id'] ?? null; // Obtener el ID del usuario desde la sesión
        if ($userId) {
            $weatherController->showWeatherHistory($userId);
        } else {
            echo "Error: Usuario no autenticado.";
        }
        break;

    case 'calidadSG_app/public/logout':
        $authController->logout();
        break;

    case 'calidadSG_app/public/consult-weather':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $weatherController->consultWeather(); // Llamada al método del WeatherController
        } else {
            echo "Método no permitido"; // Manejo simple para métodos no permitidos
        }
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}

?>