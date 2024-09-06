<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/calidadSG_app/public/css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Clima por Geolocalización</title>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="display-4 mb-4">Consulta del Clima por Geolocalización</h2>
                <p class="lead">Obtén información meteorológica actual según tu ubicación.</p>
            </div>
        </div>

        <!-- Tabla de clima -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table id="weather-table" class="table table-bordered table-hover table-striped">
                        <thead class="table-primary">
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
                </div>
            </div>
        </div>
    </div>

    <script>
        async function getWeather() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    const apiKey = 'd78a13512aa0cdd885cb571253434d35';

                    try {
                        const weatherResponse = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`);
                        const weatherData = await weatherResponse.json();

                        if (weatherData.cod === 200) {
                            const city = weatherData.name;
                            const temperature = weatherData.main.temp;
                            const description = weatherData.weather[0].description;
                            const date = new Date().toLocaleString();

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

        document.addEventListener('DOMContentLoaded', getWeather);
    </script>
    <script src="https://kit.fontawesome.com/6d80509662.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlRIKNXjl59+m6YZqLyZr+SO5B7zBcf1LU4bkR8nEGzZ3Dqq5qDIFGj59I1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGq6hJbLKP6mty5CYq6ir2COw8rK4y/2QpUJ0VCh1xPENZ5STof0sAi1qN" crossorigin="anonymous"></script>
</body>

</html>