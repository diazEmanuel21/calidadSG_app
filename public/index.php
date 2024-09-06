<?php

// Autoload de clases usando Composer o una implementación manual
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Controlador de usuarios
use App\Controllers\UserController;

// Instanciar el controlador y ejecutar el método index
$controller = new UserController();
$controller->index();


?>