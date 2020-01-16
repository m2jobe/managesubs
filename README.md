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


## Key notes

To check host domain activity in realtime I am using the package below: https://github.com/tintnaingwinn/email-checker

Typically active gmail emails will work. May take a while to register or give alert of invaid email.

Note from third party with repo.
```
Notice - That extracts the MX records from the email address and connect with the mail server to make sure the mail address accurately exist. So it may be slow loading time in local and some co-operate MX records take a long time.
```

Better methods to achieve this should be explored

Project starter kit based of Laravel-Vue SPA https://github.com/cretueusebiu/laravel-vue-spa

## Features

- Laravel 6.0
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Login, register, email verification and password reset
- Authentication with JWT
- Socialite integration
- Bootstrap 4 + Font Awesome 5
