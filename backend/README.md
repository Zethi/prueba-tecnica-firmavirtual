## Configuración

Se debe crear una copia del archivo `.env.example` y llamarla `.env`, dentro de ella se deben rellenar de la,
base de datos que se utilizará en el proyecto.

## Inicialización

1. Ejecutar el comando `composer install` para descargar los paquetes.
2. Ejecutar el comando `php artisan key:generate` para generar el APP key.
3. Ejecutar el comando `php artisan serve`


## Inicializar base de datos

### Inicialización con Dump (Recomendada)

Utilizar el archivo database-dump.sql para crear las tablas y rellenarlas con todos los datos necesarios,
este dump se generó utilizando la versión 11.4 de MariaDB con el software `DBeaver`. 

### Inicialización con PHP (No recomandada por el alto tiempo de carga, Aprox. 3 hrs) 

1. Ejecutar el comando `php artisan migrate`
2. Ejecutar el comando `php artisan db:seed`




