<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $userModel = new User(); // Crear una instancia del modelo
        $users = $userModel->getAllUsers(); // Obtener todos los usuarios

        // Pasar los usuarios a la vista
        require_once __DIR__ . '/../Views/users.php';
    }
}

?>