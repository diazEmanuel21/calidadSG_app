<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/calidadSG_app/public/css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center">
                <h2 class="text-primary">Iniciar Sesión</h2>
                <p class="text-muted">Accede a tu cuenta</p>
            </div>

            <form action="/calidadSG_app/public/login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu correo" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>

            <div class="text-center mt-4">
                <p class="message">¿No tienes cuenta? <a href="/calidadSG_app/public/register" class="text-primary">Regístrate aquí</a></p>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/6d80509662.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>