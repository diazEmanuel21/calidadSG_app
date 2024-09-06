<?php

namespace App\Controllers;

use App\Models\Weather;
use Exception;

class WeatherController
{
    private $weatherModel;

    public function __construct()
    {
        $this->weatherModel = new Weather();
    }

    // Método para manejar la solicitud de consulta de clima
    public function consultWeather()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $city = $_POST['city']; // Obtenemos la ciudad desde el formulario
            $userId = $_SESSION['user_id']; // Suponiendo que el ID del usuario está en la sesión
            $apiKey = 'd78a13512aa0cdd885cb571253434d35'; // Tu API key

            try {
                // Llamamos a la API para obtener los datos del clima
                $weatherData = $this->fetchWeather($city, $apiKey);

                if ($weatherData && isset($weatherData['main']['temp']) && isset($weatherData['weather'][0]['description'])) {
                    $temperature = $weatherData['main']['temp'];
                    $description = $weatherData['weather'][0]['description'];

                    // Guardamos los datos en la base de datos
                    $this->weatherModel->saveWeatherData($userId, $city, $temperature, $description);

                    // Redirigimos al dashboard o mostramos algún mensaje
                    header('Location: /calidadSG_app/public/dashboard');
                    exit();
                } else {
                    throw new Exception('Datos incompletos recibidos desde la API del clima.');
                }
            } catch (Exception $e) {
                echo "Error al obtener los datos del clima: " . $e->getMessage();
            }
        }
    }

    // Método para consultar la API de OpenWeather y obtener datos del clima
    private function fetchWeather($city, $apiKey)
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = file_get_contents($url);

        if ($response === FALSE) {
            throw new Exception("No se pudo conectar con la API del clima.");
        }

        $weatherData = json_decode($response, true);

        if (isset($weatherData['cod']) && $weatherData['cod'] != 200) {
            throw new Exception("Error de la API: " . $weatherData['message']);
        }

        return $weatherData;
    }

    // Método para mostrar el historial de clima en el dashboard
    public function showWeatherHistory($userId)
    {
        // Obtenemos el historial de clima desde el modelo
        $history = $this->weatherModel->getWeatherHistory($userId);

        // Pasamos los datos del historial a la vista
        require __DIR__ . '/../../Views/dashboard.php';
    }
}

?>
