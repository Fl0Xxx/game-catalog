# Game Catalog

This is a web application for an online game catalog. The application includes an interface for adding, editing, deleting, and viewing a list of games.

## Features

- Full CRUD functionality for games
- Filtering and search capabilities
- Image upload for game covers
- Responsive design using Tailwind CSS or Bootstrap
- Docker setup for simplified deployment

## Tech Stack

- PHP >= 8.2.28
- Laravel >= 12.4.1
- MySQL >= 8.4.4

## Installation and Setup

### 1. Clone the repository

```sh
git clone https://github.com/Fl0Xxx/game-catalog.git
cd game-catalog
```

### 2. Create the `.env` file

Copy the example configuration:

```sh
cp .env.example .env
```

### 3. Run the Project with Docker

#### 3.1. Build and Start Containers

Using Docker Compose:

```sh
docker-compose up -d
```

#### 3.2. Install Dependencies and Set Up Laravel

```sh
docker-compose exec app bash
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed --class=GamesSeeder
```

#### 3.3. Fix Permissions (if needed)

```sh
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage
```

### 4. Access the Application

Once the containers are running, open the application in your browser:

```
http://localhost:8000
```

## License

This project is open-source and available under the [MIT License](LICENSE).

