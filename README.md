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

### 3. Configure the Database

Edit the database connection settings in the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=game_catalog
DB_USERNAME=root
DB_PASSWORD=root
```

### 4. Run the Project with Docker

#### 4.1. Build and Start Containers

Using Docker Compose:

```sh
docker-compose up -d
```

#### 4.2. Install Dependencies and Set Up Laravel

```sh
docker-compose exec app bash
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed --class=GamesSeeder
```

#### 4.3. Fix Permissions (if needed)

```sh
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage
```

### 5. Access the Application

Once the containers are running, open the application in your browser:

```
http://localhost:8000
```

## Docker Configuration

### `.env` file

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=game_catalog
DB_USERNAME=root
DB_PASSWORD=root
```

### `docker-compose.yml`

```yaml
services:
    app:
        build:
            context: .
            dockerfile: Dockerfile
        container_name: laravel_app
        restart: unless-stopped
        working_dir: /var/www
        volumes:
            - .:/var/www
        expose:
            - "9000"
            - "9003"
        depends_on:
            - db
        environment:
            APP_ENV: local
            APP_DEBUG: true
            DB_CONNECTION: mysql
            DB_HOST: db
            DB_PORT: 3306
            DB_DATABASE: game_catalog
            DB_USERNAME: root
            DB_PASSWORD: root
        networks:
            - laravel_network

    nginx:
        image: nginx:alpine
        container_name: laravel_nginx
        restart: unless-stopped
        ports:
            - "8000:80"
        volumes:
            - .:/var/www
            - ./docker/nginx.conf:/etc/nginx/conf.d/default.conf
        depends_on:
            - app
        networks:
            - laravel_network

    db:
        image: mysql:8
        container_name: laravel_db
        restart: unless-stopped
        environment:
            MYSQL_DATABASE: game_catalog
            MYSQL_ROOT_PASSWORD: root
            MYSQL_TCP_PORT: 3306
        ports:
            - "3307:3306"
        volumes:
            - dbdata:/var/lib/mysql
        networks:
            - laravel_network

    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        container_name: laravel_phpmyadmin
        restart: unless-stopped
        depends_on:
            - db
        ports:
            - "8080:80"
        environment:
            PMA_HOST: db
            MYSQL_ROOT_PASSWORD: root
        networks:
            - laravel_network

volumes:
    dbdata:

networks:
    laravel_network:
        driver: bridge
```

### `Dockerfile`

```dockerfile
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    iputils-ping \
    net-tools \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
```

## License

This project is open-source and available under the [MIT License](LICENSE).

