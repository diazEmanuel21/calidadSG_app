<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Mostrar formulario de login
    public function showLoginForm()
    {
        require_once __DIR__ . '/../Views/login.php';
    }

    // Manejar login
    public function login()
    {
        // Validar los datos de entrada
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['error'] = 'El email y la contraseña son obligatorios.';
            header('Location: /calidadSG_app/public/login');
            exit();
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if ($email === false) {
            $_SESSION['error'] = 'Formato de email inválido.';
            header('Location: /calidadSG_app/public/login');
            exit();
        }

        // Autenticar al usuario
        try {
            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                // $_SESSION['success'] = 'Bienvenido de nuevo, ' . htmlspecialchars($user['name']) . '!';
                header('Location: /calidadSG_app/public/dashboard');
            } else {
                $_SESSION['error'] = 'Credenciales incorrectas.';
                header('Location: /calidadSG_app/public/login');
            }
        } catch (\Exception $e) {
            // Manejar errores generales
            $_SESSION['error'] = 'Hubo un problema al procesar tu solicitud. Por favor, intenta nuevamente.';
            error_log($e->getMessage()); // Registrar el error en el log para depuración
            header('Location: /calidadSG_app/public/login');
        }

        exit();
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        require_once __DIR__ . '/../Views/register.php';
    }

    // Manejar registro

    public function register()
    {
        // Verificar si la solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /calidadSG_app/public/register');
            exit();
        }

        // Obtener y limpiar los datos del formulario
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Validar los datos del formulario
        $errors = [];

        if (empty($name)) {
            $errors[] = 'El nombre es obligatorio.';
        }

        if (empty($email)) {
            $errors[] = 'El correo electrónico es obligatorio.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El correo electrónico no es válido.';
        }

        if (empty($password)) {
            $errors[] = 'La contraseña es obligatoria.';
        } elseif (strlen($password) < 6) {
            $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
        }

        if (!empty($errors)) {
            // Mostrar errores de validación
            $_SESSION['errors'] = $errors;
            header('Location: /calidadSG_app/public/register');
            exit();
        }

        // Verificar si el usuario ya existe
        if ($this->userModel->userExists($email)) {
            $_SESSION['errors'] = ['El correo electrónico ya está registrado.'];
            header('Location: /calidadSG_app/public/register');
            exit();
        }

        // Registrar el nuevo usuario
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($this->userModel->register($name, $email, $hashedPassword)) {
            $_SESSION['success'] = 'Registro exitoso. Por favor, inicia sesión.';
            header('Location: /calidadSG_app/public/login');
            exit();
        } else {
            $_SESSION['errors'] = ['Error al registrar el usuario. Por favor, inténtelo de nuevo.'];
            header('Location: /calidadSG_app/public/register');
            exit();
        }
    }

    // Mostrar el dashboard (solo si está autenticado)
    public function dashboard()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /calidadSG_app/public/login');
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        // require_once __DIR__ . '/../Views/dashboard.php';
    }

    // Cerrar sesión
    public function logout()
    {
        // Eliminar todas las variables de sesión
        $_SESSION = [];

        // Si se utiliza una cookie de sesión, eliminarla
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir a la página de inicio de sesión con un mensaje de éxito
        $_SESSION['success'] = 'Has cerrado sesión correctamente.';
        header('Location: /calidadSG_app/public/login');
        exit(); // Asegúrate de que no se ejecute más código
    }

}
