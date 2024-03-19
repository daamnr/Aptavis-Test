# Laravel 11 - Sports League Application

## Screenshots

https://raw.githubusercontent.com/daamnr/Aptavis-Test/main/public/assets/demos/dashboard.png

https://raw.githubusercontent.com/daamnr/Aptavis-Test/main/public/assets/demos/games.png

https://raw.githubusercontent.com/daamnr/Aptavis-Test/main/public/assets/demos/teams.png


## Run Locally

Clone the project

```bash
$ git clone https://github.com/daamnr/Aptavis-Test.git your-project-name
```

Go to the project directory

```bash
$ cd your-project-name
```

Copy file `.env.example` and rename this file to `.env`

Edit your database configuration in `.env` file
```console
DB_CONNECTION=mysql
DB_HOST=YOUR_HOST
DB_PORT=YOUR_PORT
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

Install `composer` dependencies

```bash
$ composer install
```

Generate your application key using `php artisan` command below

```bash
$ php artisan key:generate
```

Run database migration using `php artisan` commad below

```bash
$ php artisan migrate
```

## Login

-   email = admin@example.com
-   password = 123
