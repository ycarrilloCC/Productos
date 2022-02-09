#1 Verificar si en la carpeta del proyecto Productos hay una carpeta llamada vendor si no está, puedes ejecutar en consola o en la terminal de windows en la ruta de tu proyecto de preferencia el comando: composer install

#2 configuramos nuestra base de datos ejemplo de configuración:

CONEXIÓN_DB=mysql DB_HOST_PG=127.0.0.1 DB_PORT=3306 DB_DATABASE=products DB_USERNAME=root
DB_PASSWORD= Nota: El nombre de la base de datos debe ser el mismo que se coloca en el archivo .env, en este caso son products.

*El nombre de la base de datos de estar creado en tu MySql.

Luego ejecutamos el siguiente comando para la creacion de tablas en la base de datos: php artisan migrate --seed

Credenciales:

'nombre de usuario' => administrator@sales.com 'contraseña' => administrator
