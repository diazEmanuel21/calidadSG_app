<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard & Historial de Clima</title>
    <link rel="stylesheet" href="/calidadSG_app/public/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            background-color: #333;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            padding: 20px;
            border-radius: 8px;
        }

        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content p {
            font-size: 18px;
            margin: 10px 0;
        }

        .logout-button {
            display: inline-block;
            padding: 10px 10px;
            color: #fff;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c0392b;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #007BFF;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .filter-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .filter-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 50%;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Dashboard -->
        <div class="header">
            <h1>Bienvenido, <?php echo htmlspecialchars($user['name']); ?>!</h1>
            <a href="/calidadSG_app/public/logout" class="logout-button">Cerrar sesión</a>
        </div>

        <!-- Formulario para consultar clima -->
        <div class="content">
            <h2>Consultar Clima</h2>
            <form method="POST" action="/calidadSG_app/public/consult-weather">
                <label for="city">Ingrese la ciudad:</label>
                <input type="text" id="city" name="city" placeholder="Ej: Bogotá" required>
                <button type="submit" class="logout-button">Consultar</button>
            </form>
        </div>

        <!-- Historial de Clima -->
        <h2>Historial de Clima</h2>
        <div class="filter-container">
            <input type="text" id="search" placeholder="Filtrar por ciudad..." onkeyup="filterTable()">
        </div>
        <table id="weather-history">
            <thead>
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
                        <td colspan="4">No hay historial de clima disponible.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Filtrar la tabla por ciudad
        function filterTable() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const tableRows = document.querySelectorAll('#weather-history tbody tr');

            tableRows.forEach(row => {
                const city = row.querySelector('td:first-child').textContent.toLowerCase();
                if (city.includes(searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>