<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Cubet Techno Labs](https://cubettech.com)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[Many](https://www.many.co.uk)**
-   **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
-   **[DevSquad](https://devsquad.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[OP.GG](https://op.gg)**
-   **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
-   **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Configuración de extensiones mediante Sync vscode Settings

Ir a la opción de extensiones en vscode (Ctrl+Shift+X) e instalar la siguiente extensión:

```sh
Settings sync - Author Shan Khan
```

O ir al siguiente enlace: https://marketplace.visualstudio.com/items?itemName=Shan.code-settings-sync

Configurar la extensión con el siguiente comando:

```sh
Ctrl+Shift+P y buscar: Sync Advanced Options
```

Seleccionar la siguiente opción:

```sh
Sincronización: Abrir la configuración
```

Copiar y pegar el siguiente Gist ID:

```sh
a4d97ec6f136ba1504219dceb07005ec
```

Copia y pegar el siguiente Access token o Token de acceso:

```sh
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
```

Comprombar que las siguientes opciones esten seleccionadas:

```sh
Descarga Automática
Quitar Las Extensiones De...
Sincronización de extensiones
```

Descargar archivo de configuración de vscode con alguno de los siguientes comandos:

```sh
Ctrl+Shif+P y seleccionar Sync: Download settings or Shift+Alt+D
```

Comprobar que se han instalado las siguientes extensiones:

```sh
better-comments
code-settings-sync
debugger-for-chrome
EditorConfig
laravel-blade
LiveServer
material-theme
phpdoc-comment-vscode-plugin
prettier-vscode
sass-indented
svelte-vscode
vscode-blade-formatter
vscode-great-icons
vscode-yaml
vscodeintellicode
vsliveshare
```

# Configuración inicial del proyecto

Clonar el proyecto de SENNOVALAB. Aplicar los siguientes comandos:

```sh
git clone https://github.com/carincon93/sennovalab.git
cd sennovalab
```

Instalar las dependencias de composer

```sh
php artisan composer install
```

Configuración del ambiente de trabajo. Duplicar el archivo .env.example y cambiar el nombre por .env

```sh
.env.example -> .env
```

Ahora en el archivo .env copiar y pegar las siguientes líneas de configuración (Pegar en su respectivo bloque)

```sh
APP_NAME=SENNOVALAB
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost/
APP_TIMEZONE="America/Bogota"
MIX_ASSET_URL=
APP_LOCALE=es

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sennovalab
DB_USERNAME=root
DB_PASSWORD=
```

Generar la APP KEY

```sh
php artisan key:generate
```

Crear symlink de la carpeta de storage en public

```sh
php artisan storage:link
```

Debe crear una base de datos en MySQL llamada sennovalab. Luego realizar la migración de las tablas de bases de datos

```sh
php artisan migrate
```

Instalar las dependencias de NodeJS

```sh
npm install
```

Abrir la línea de comandos y ejecutar el siguiente comando para compilar los assets (Este comando se debe ejecutar siempre que se va a desarrollar)

```sh
npm run watch
```

En otra línea de comandos, ejecutar el siguiente comando para subir el servidor (Este comando se debe ejecutar siempre que se va a desarrollar)

```sh
php artisan serve
```

Por último abrir el navegador e ingresar a localhost:8000
