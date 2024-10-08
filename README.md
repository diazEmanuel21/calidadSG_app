# CalidadSG_app
# Informe de Documentación del Proyecto

## 1. Introducción

## Descripción del Proyecto

### Título del Proyecto: **Sistema de Consulta de Clima por Geolocalización**

### Objetivo del Proyecto

El objetivo principal del proyecto es desarrollar una aplicación web que permita a los usuarios consultar información meteorológica en tiempo real basada en su ubicación geográfica actual. La aplicación no solo proporcionará datos actuales del clima, sino que también almacenará un historial de consultas para cada usuario, permitiendo un análisis posterior de las condiciones meteorológicas.

### Descripción General

La aplicación web está diseñada para proporcionar a los usuarios información precisa sobre el clima utilizando datos obtenidos a través de la API de OpenWeather. La información presentada incluye la temperatura actual, la descripción del clima y la ciudad correspondiente. Los usuarios pueden acceder a esta funcionalidad a través de una interfaz intuitiva, y los datos de las consultas se almacenan en una base de datos para su posterior revisión.

### Funcionalidades Clave

1. **Consulta de Clima en Tiempo Real:**
   - **Geolocalización Automática:** Utiliza la geolocalización del navegador para determinar la ubicación actual del usuario.
   - **Consulta a la API de Clima:** Realiza solicitudes a la API de OpenWeather para obtener datos meteorológicos en tiempo real.
   - **Visualización de Datos:** Muestra la ciudad, temperatura, descripción del clima y la fecha/hora de la consulta en una tabla en la interfaz de usuario.

2. **Historial de Consultas:**
   - **Almacenamiento de Datos:** Guarda el historial de las consultas realizadas por cada usuario en la base de datos.
   - **Visualización del Historial:** Permite a los usuarios ver y revisar las consultas anteriores a través de una sección del dashboard.

3. **Interfaz de Usuario:**
   - **Página de Registro e Inicio de Sesión:** Permite a los usuarios crear una cuenta y acceder a la aplicación.
   - **Dashboard Personalizado:** Ofrece una vista general del clima actual y el historial de consultas.
   - **Diseño Responsive:** Asegura que la aplicación sea accesible y funcional en dispositivos móviles y de escritorio.

### Tecnologías Utilizadas

- **Backend:** PHP para la lógica del servidor y el manejo de solicitudes.
- **Base de Datos:** MySQL para el almacenamiento de datos de usuarios y el historial de clima.
- **Frontend:** HTML, CSS y JavaScript para la interfaz de usuario y la funcionalidad dinámica.
- **API de Clima:** OpenWeather para obtener datos meteorológicos en tiempo real.
- **Geolocalización:** Utiliza la API de geolocalización del navegador para determinar la ubicación del usuario.

### Beneficios del Proyecto

- **Acceso Rápido a Información Meteorológica:** Proporciona a los usuarios datos precisos sobre el clima en tiempo real basados en su ubicación.
- **Historial de Consultas:** Permite a los usuarios revisar su historial de consultas meteorológicas, lo que puede ser útil para análisis y planificación.
- **Interfaz Amigable:** Ofrece una experiencia de usuario intuitiva y accesible en diferentes dispositivos.

### Alcance del Proyecto

El proyecto se enfoca en la creación de una aplicación web que funcione en navegadores modernos y sea compatible con dispositivos móviles. La solución está diseñada para ser escalable y fácilmente mantenible, con una arquitectura que permite futuras extensiones y mejoras.


## 2. Casos de Uso

**Definición de Casos de Uso:**
- Descripción de los principales casos de uso del sistema.
  
**Ejemplo de Casos de Uso:**
1. **Caso de Uso: Registro de Usuario**
   - **Actor:** Usuario
   - **Descripción:** El usuario se registra en el sistema proporcionando información básica como nombre, correo electrónico y contraseña.
   - **Precondiciones:** El usuario no debe estar registrado previamente.
   - **Flujo Principal:**
     1. El usuario accede a la página de registro.
     2. Completa el formulario de registro.
     3. El sistema valida los datos.
     4. El sistema guarda la información del usuario y muestra un mensaje de confirmación.
   - **Postcondiciones:** El usuario está registrado y puede iniciar sesión.

2. **Caso de Uso: Consulta de Clima**
   - **Actor:** Usuario Autenticado
   - **Descripción:** El usuario consulta el clima actual basándose en su ubicación geográfica.
   - **Precondiciones:** El usuario debe estar autenticado y haber concedido permisos de geolocalización.
   - **Flujo Principal:**
     1. El usuario accede a la funcionalidad de consulta de clima.
     2. El sistema obtiene la ubicación del usuario.
     3. El sistema consulta la API del clima.
     4. El sistema muestra los resultados en una tabla.
   - **Postcondiciones:** El usuario visualiza los datos climáticos en la interfaz.

## 3. Diagrama Entidad-Relación (ERD)

**Diagrama ERD:**
- **Descripción:** Muestra las entidades principales y sus relaciones en la base de datos.
  
  ![Diagrama ERD](path_to_your_ERD_image)

**Definición de Entidades:**
1. **Usuario**
   - **Atributos:** id, nombre, correo electrónico, contraseña.
   - **Relaciones:** Puede tener múltiples registros en el historial de clima.

2. **Historial de Clima**
   - **Atributos:** id, usuario_id, ciudad, temperatura, descripción, fecha_hora.
   - **Relaciones:** Pertenece a un único usuario.

## 4. Definición de Entidades de la Base de Datos

**Definición de Tablas:**

1. **Tabla: Usuario**
   - **Campos:**
     - `id` (INT, PK, AUTO_INCREMENT)
     - `nombre` (VARCHAR(255))
     - `correo_electronico` (VARCHAR(255), UNIQUE)
     - `contraseña` (VARCHAR(255))
   - **Índices:** Índice en `correo_electronico` para búsquedas rápidas.

2. **Tabla: Historial de Clima**
   - **Campos:**
     - `id` (INT, PK, AUTO_INCREMENT)
     - `usuario_id` (INT, FK a Usuario.id)
     - `ciudad` (VARCHAR(255))
     - `temperatura` (FLOAT)
     - `descripcion` (VARCHAR(255))
     - `fecha_hora` (DATETIME)
   - **Índices:** Índice en `usuario_id` para búsquedas rápidas por usuario.

## 5. Diagrama de Clases

**Diagrama de Clases:**
- **Descripción:** Muestra las clases principales del sistema, sus atributos, métodos y relaciones.

  ![Diagrama de Clases](path_to_your_class_diagram_image)

**Ejemplo de Clases:**
1. **Clase: Usuario**
   - **Atributos:**
     - `id`
     - `nombre`
     - `correo_electronico`
     - `contraseña`
   - **Métodos:**
     - `registrar()`
     - `iniciarSesion()`
     - `actualizarPerfil()`

2. **Clase: HistorialClima**
   - **Atributos:**
     - `id`
     - `usuario_id`
     - `ciudad`
     - `temperatura`
     - `descripcion`
     - `fecha_hora`
   - **Métodos:**
     - `guardar()`
     - `obtenerHistorial()`

## 6. Análisis y Solución del Problema

**Problema:**
- Descripción del problema que el proyecto está tratando de resolver (e.g., proporcionar datos meteorológicos precisos y actuales a los usuarios).

**Análisis del Problema:**
- Detalle del análisis realizado para entender el problema y cómo se relaciona con los requisitos del usuario.

**Solución Propuesta:**
- Explicación de cómo el proyecto resuelve el problema, incluyendo:
  - **Arquitectura del Sistema:** Descripción de cómo los diferentes componentes del sistema interactúan.
  - **Tecnologías Utilizadas:** PHP para el backend, MySQL para la base de datos, y JavaScript para la funcionalidad del frontend.
  - **Implementación de Características:** Cómo se implementan características clave como la consulta de clima y el almacenamiento del historial.