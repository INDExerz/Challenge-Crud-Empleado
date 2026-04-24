# Proyecto CRUD de Empleados

## Descripción del proyecto

Este proyecto es una aplicación web de ejemplo para la gestión de empleados con un CRUD completo (Crear, Leer, Actualizar, Eliminar). Está construida con PHP y una arquitectura MVC sencilla, y utiliza una interfaz moderna con Bootstrap, DataTables y SweetAlert2.

La aplicación gestiona:
- Empleados
- Áreas de la empresa
- Roles de empleados
- Asignaciones de roles a empleados

## Estructura del proyecto

- `Config/` - Contiene la configuración de la conexión a la base de datos.
- `Controllers/` - Controladores para `Areas`, `Roles` y `Usuario`.
- `Models/` - Modelos para las entidades y el acceso a datos.
- `Views/` - Vista principal (`index.php`) y archivos JavaScript de la interfaz.
- `db/migration/` - Scripts SQL para crear tablas y cargar datos iniciales.

## Tecnologías usadas

- PHP
- HTML
- CSS
- Bootstrap
- JavaScript
- jQuery
- DataTables
- SweetAlert2
- MySQL

## Enfoque del proyecto

La aplicación está construida con una arquitectura sencilla inspirada en MVC:
- `Models/` encapsula la lógica de datos y consultas a la base de datos.
- `Controllers/` recibe las peticiones y controla las operaciones sobre los modelos.
- `Views/` muestra la interfaz y carga scripts de interacción.

La interfaz utiliza Bootstrap para estilos y modales, DataTables para la tabla de empleados, y SweetAlert2 para notificaciones y confirmaciones.

## Base de datos y tablas

La base de datos se llama `prueba_php` y contiene las siguientes tablas:

1. `areas`
   - `id` INT AUTO_INCREMENT PRIMARY KEY
   - `nombre` VARCHAR(255)

2. `empleados`
   - `id` INT AUTO_INCREMENT PRIMARY KEY
   - `nombre` VARCHAR(255)
   - `email` VARCHAR(255)
   - `sexo` CHAR(1) (`M` o `F`)
   - `area_id` INT (relación con `areas`)
   - `boletin` INT (1 = recibe boletín, 0 = no)
   - `descripcion` TEXT

3. `roles`
   - `id` INT AUTO_INCREMENT PRIMARY KEY
   - `nombre` VARCHAR(255)

4. `empleado_rol`
   - `empleado_id` INT (FK a `empleados`)
   - `rol_id` INT (FK a `roles`)

## Paso a paso para crear la base de datos

1. Abre phpMyAdmin o MySQL desde XAMPP.
2. Crea la base de datos con el nombre `prueba_php`.
3. Importa los archivos SQL en este orden:
   - `db/migration/001_create_areas.sql`
   - `db/migration/002_create_empleado.sql`
   - `db/migration/003_create_roles.sql`
   - `db/migration/004_create_empleado_rol.sql`
   - `db/migration/005_insert_areas.sql`
   - `db/migration/006_insert_roles.sql`

> Alternativa: ejecutar cada script con MySQL en la línea de comandos o en phpMyAdmin.

## Configuración de la conexión

El archivo de conexión se encuentra en `Config/conexion.php` y está configurado así:

- Host: `localhost`
- Usuario: `root`
- Contraseña: `` (vacío)
- Base de datos: `prueba_php`

Si tu entorno usa otro usuario o contraseña, actualiza esos valores en `Config/conexion.php`.

## Uso

1. Copia el proyecto dentro de `htdocs` de XAMPP.
2. Inicia Apache y MySQL desde el panel de XAMPP.
3. Accede a `http://localhost/Prueba_usuario/Views/` en tu navegador.
4. Usa el botón "Nuevo" para crear empleados.
5. Modifica o elimina empleados desde la tabla.

## Notas

- Los roles se cargan dinámicamente y se muestran como opciones en el formulario.
- El campo de área se relaciona con la tabla `areas`.
- La tabla principal usa DataTables para búsqueda y paginación.
- SweetAlert2 se utiliza para mostrar mensajes de confirmación y éxito.
