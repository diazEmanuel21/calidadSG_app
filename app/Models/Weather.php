<?php

namespace App\Models;

use PDO;

class Weather
{
    private $db;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        $this->db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function saveWeatherData($userId, $city, $temperature, $description)
    {
        $stmt = $this->db->prepare("
            INSERT INTO weather_data (user_id, city, temperature, description, created_at)
            VALUES (:user_id, :city, :temperature, :description, NOW())
        ");
        $stmt->execute([
            ':user_id' => $userId,
            ':city' => $city,
            ':temperature' => $temperature,
            ':description' => $description
        ]);
    }

    // Método para obtener el historial de clima de la base de datos
    public function getWeatherHistory($userId)
    {
        // Realiza una consulta a la base de datos para obtener el historial del usuario
        $stmt = $this->db->prepare("SELECT * FROM weather_data WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(); // Debería devolver un array con el historial
    }
}

?>