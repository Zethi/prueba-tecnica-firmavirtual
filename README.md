# Prueba técnica FirmaVirtual

## Configuración

Dentro del archivo `.env` se puede configurar las credenciales y base de datos que utilizará la MariaDB, no se recomienda editar a menos que se vaya a cambiar en todos los lugares.

## Inicialización usando docker

1. Utilizar el comando `docker compose up` o `docker compose up -d` para abrirlo en segundo plano.
2. Leer el archivo `README` de la carpeta del Backend para entender como inicializar la base de datos.

los servicios se levantarán con los siguientes puertos:

- `3306` Para la MariaDB
- `3000` Para el Frontend
- `8000` Para el Backend

## Inicialización sin docker

Dentro de cada proyecto hay un archivo README explicando como compilar y levantar cada una de las aplicaciones.
