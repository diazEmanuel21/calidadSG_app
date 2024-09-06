<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima por Geolocalización</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .button:active {
            background-color: #003d7a;
            transform: scale(0.95);
        }
    </style>
</head>

<body>
    <h1>Consulta del Clima por Geolocalización</h1>
    <!-- El botón ha sido eliminado ya que ya no es necesario -->
    <table id="weather-table">
        <thead>
            <tr>
                <th>Ciudad</th>
                <th>Temperatura (°C)</th>
                <th>Descripción del Clima</th>
                <th>Fecha y Hora de Consulta</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas se llenarán dinámicamente con JavaScript -->
        </tbody>
    </table>

    <script>
        async function getWeather() {
            // Verificar si el navegador soporta la geolocalización
            if (navigator.geolocation) {
                // Obtener la posición actual del usuario
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    // API Key de OpenWeather (reemplázala con tu propia clave)
                    const apiKey = 'd78a13512aa0cdd885cb571253434d35';

                    try {
                        // Obtener el clima basado en la ubicación
                        const weatherResponse = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`);
                        const weatherData = await weatherResponse.json();

                        if (weatherData.cod === 200) {
                            const city = weatherData.name;
                            const temperature = weatherData.main.temp;
                            const description = weatherData.weather[0].description;
                            const date = new Date().toLocaleString();

                            // Añadir la información a la tabla
                            const tableBody = document.querySelector('#weather-table tbody');
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${city}</td>
                                <td>${temperature}°C</td>
                                <td>${description}</td>
                                <td>${date}</td>
                            `;
                            tableBody.appendChild(row);
                        } else {
                            console.error("Error en la API del clima:", weatherData.message);
                        }
                    } catch (error) {
                        console.error("Error al obtener los datos del clima:", error);
                    }
                }, (error) => {
                    console.error("Error al obtener la geolocalización:", error);
                });
            } else {
                console.error("La geolocalización no está soportada por este navegador.");
            }
        }

        // Llamar a la función cuando se carga la página
        document.addEventListener('DOMContentLoaded', getWeather);
    </script>
</body>

</html>