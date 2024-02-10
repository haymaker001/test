# Documentación de HenriquezGO

## Introducción

HenriquezGO es un sistema web desarrollado con PHP y Laravel que permite gestionar viajes y reservaciones. Esta documentación proporciona información sobre la configuración del entorno, los requisitos mínimos del sistema y cómo desplegar la aplicación en un entorno de hosting compatible con cPanel.

## Requisitos mínimos del sistema

- PHP >= 7.4
- MySQL >= 5.7
- Composer
- Servidor web compatible (por ejemplo, Apache o Nginx)

## Configuración del archivo .env

El archivo `.env` es utilizado por Laravel para gestionar las variables de entorno. A continuación, se muestra un ejemplo de configuración básica:

```
APP_NAME=HenriquezGO
APP_ENV=local
APP_KEY=your-app-key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

Asegúrese de configurar las variables de entorno de acuerdo a su entorno de desarrollo o producción.

## Despliegue en cPanel

Para desplegar HenriquezGO en un entorno cPanel, siga estos pasos:

1. Comprima los archivos del proyecto en un archivo zip.

2. Acceda a su cuenta de cPanel y busque el Administrador de Archivos.

3. Suba el archivo zip a la carpeta pública de su dominio.

4. Extraiga los archivos del zip en la carpeta deseada (por ejemplo, `public_html`).

5. Cree una base de datos MySQL desde cPanel.

6. Importe la estructura de la base de datos utilizando una herramienta como phpMyAdmin o mediante la línea de comandos.

7. Configure el archivo `.env` con los detalles de la base de datos creada.

8. Abra un terminal dentro de la carpeta del proyecto y ejecute `composer install` para instalar las dependencias de PHP.

9. Ejecute `php artisan key:generate` para generar una nueva clave de aplicación.

10. Ejecute `php artisan migrate` para migrar las tablas de la base de datos.

11. Configura el archivo de configuración de Apache o Nginx para apuntar al directorio público de tu aplicación.

12. Acceda a su sitio web en el navegador y asegúrese de que todo funcione correctamente.

## Contribuciones

Las contribuciones son bienvenidas. Si encuentra algún problema o tiene alguna sugerencia, no dude en crear un problema o enviar una solicitud de extracción.

## Licencia

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT).