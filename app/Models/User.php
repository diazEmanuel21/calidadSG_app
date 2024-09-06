<?php

namespace App\Models;

use PDO;
use PDOException;

class User
{
    private $db;

    public function __construct()
    {
        // Cargar configuración de la base de datos
        $config = require __DIR__ . '/../../config/database.php';

        try {
            $this->db = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']}", 
                $config['user'], 
                $config['password']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Método para obtener todos los usuarios
    public function getAllUsers()
    {
        $query = $this->db->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>