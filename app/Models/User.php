<?php

namespace App\Models;

use PDO;
use PDOException;

class User
{
    private $db;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        try {
            $this->db = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']}",
                $config['user'],
                $config['password']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Registrar un nuevo usuario
    public function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
        ]);
    }

   // Verificar las credenciales del usuario
   public function authenticate($email, $password)
   {
       $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
       /* 
        El uso de bindParam asegura que el valor del email sea tratado como un parámetro 
        en lugar de parte de la consulta SQL
       */
       $stmt->bindParam(':email', $email, PDO::PARAM_STR);
       $stmt->execute();
       $user = $stmt->fetch(PDO::FETCH_ASSOC);

       if ($user && password_verify($password, $user['password'])) {
           return $user;
       }
       return false;
   }

    // Obtener un usuario por ID
    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para verificar si el usuario ya existe
    public function userExists($email)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
}

?>