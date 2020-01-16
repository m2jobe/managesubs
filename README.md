# managesubs

1) Clone the repo

2) Make file .env from copying .env.example - Edit .env and set your database connection details

3) Run the command for vendor packages
```
composer install && composer dump-autoload
```

4) When installed via git clone or download, run php artisan key:generate and php artisan jwt:secret (override existing key if any)

5) Run the following commands
```
php artisan migrate
```

```
npm install
```

## Usage

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```

Finally to serve the site

```
php artisan serve
```

## Accessing site / endpoints

#### Basic UI

To access the application, navigate to localhost:8000 first register an account then login.

Once logged in you can manage users

#### Endpoints

GET,POST,PUT,DELETE Endpoints are located at :
/api/subscribers and /api/fields

To retreive fields beloging to a subscriber:
/api/subscribers/{subscriber}/fields



Project starter kit based of Laravel-Vue SPA https://github.com/cretueusebiu/laravel-vue-spa

## Features

- Laravel 6.0
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Login, register, email verification and password reset
- Authentication with JWT
- Socialite integration
- Bootstrap 4 + Font Awesome 5
