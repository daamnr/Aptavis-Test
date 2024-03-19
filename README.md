# Laravel 11 - Sports League Application

## Description

This project is created for test in Aptvis as a Web Developer. The Football Standings App is a mini web application designed to manage and display football standings for various teams. It provides three main functionalities:

- Club Data Input: Users can input club data including club name and city. The app ensures data integrity by preventing duplicates and includes form validation.

- Score Input: Users can input match scores between two clubs. The app calculates points based on match outcomes (win, tie, or loss) and updates the standings accordingly. Users can input scores individually or in multiple inputs with form validation.

- View Standings: The app displays the current standings of teams, including matches played, matches won, matches tied, matches lost, goals scored, goals conceded, and points earned. Standings are automatically updated based on the scores input by users.

This app is built using Laravel PHP framework and Filament admin panel. It provides a user-friendly interface for managing football standings efficiently.

## Screenshots

<p align="center">
    Dashboard <br>
    <img src="https://raw.githubusercontent.com/daamnr/Aptavis-Test/main/public/assets/demos/dashboard.png">
</p>

<p align="center">
    Games <br>
    <img src="https://raw.githubusercontent.com/daamnr/Aptavis-Test/main/public/assets/demos/games.png">
</p>

<p align="center">
    Teams <br>
    <img src="https://raw.githubusercontent.com/daamnr/Aptavis-Test/main/public/assets/demos/teams.png">
</p>


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
