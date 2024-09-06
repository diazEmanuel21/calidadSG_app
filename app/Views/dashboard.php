<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard & Historial de Clima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/calidadSG_app/public/css/custom.css">

</head>

<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="title-nav title-header">
            <h3>Weather APP</h3>
            <i class="fa-solid fa-cloud-bolt icon-weather"></i>
        </div>
        <a href="/calidadSG_app/public/logout" class="logout-button">
            <i class="fa-solid fa-right-to-bracket"></i>
        </a>
    </div>

    <!-- Vista del clima -->
    <section class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <!-- Incluir la vista del clima -->
                <?php include __DIR__ . '../../Views/weatherView.php'; ?>
            </div>

            <!-- Formulario de consulta del clima -->
            <div class="col-lg-6">
                <div class="card shadow-sm card-no-relative">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Consultar Clima</h2>
                        <form method="POST" action="/calidadSG_app/public/consult-weather">
                            <div class="mb-3">
                                <label for="city" class="form-label">Ingrese la ciudad:</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Ej: Bogotá" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Consultar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Historial de Clima -->
    <section class="container mt-5">
        <h2 class="mb-4">Historial de Clima</h2>

        <!-- Filtro de búsqueda -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Filtrar por ciudad..." onkeyup="filterTable()">
        </div>

        <!-- Tabla de historial -->
        <div class="table-responsive">
            <table id="weather-history" class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Ciudad</th>
                        <th>Temperatura (°C)</th>
                        <th>Descripción del Clima</th>
                        <th>Fecha y Hora de Consulta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($history) && is_array($history)) : ?>
                        <?php foreach ($history as $entry) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entry['city']); ?></td>
                                <td><?php echo htmlspecialchars($entry['temperature']); ?>°C</td>
                                <td><?php echo htmlspecialchars($entry['description']); ?></td>
                                <td><?php echo htmlspecialchars($entry['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay historial de clima disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function filterTable() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const tableRows = document.querySelectorAll('#weather-history tbody tr');

            tableRows.forEach(row => {
                const city = row.querySelector('td:first-child').textContent.toLowerCase();
                row.style.display = city.includes(searchInput) ? '' : 'none';
            });
        }
    </script>

    <script src="https://kit.fontawesome.com/6d80509662.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGq6hJbLKP6mty5CYq6ir2COw8rK4y/2QpUJ0VCh1xPENZ5STof0sAi1qN" crossorigin="anonymous"></script>
</body>

</html>