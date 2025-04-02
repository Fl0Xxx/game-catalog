
# Game Catalog

## Description
This is a web application for an online game catalog. The application includes an interface for adding, editing, deleting, and viewing a list of games. Users can filter and search games by genre, platform, and other parameters. Image uploads for game covers are also supported.

## Features
- CRUD operations for games (create, read, update, delete)
- Filtering games by genre, platform, and title
- Search by title
- Image uploads (cover images) for games

## Technical Requirements
- PHP >= 8.2.28
- Laravel >= 12.4.1
- MySQL >= 8.4.4
- Docker (for simplified deployment)

## Installation and Setup

### 1. Clone the repository
```bash
git clone https://github.com/Fl0Xxx/game-catalog.git
cd game-catalog
```

### 2. Create the `.env` file
Copy the example configuration for `.env`:
```bash
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
With Docker Compose, you can automatically build and start the project:
```bash
docker-compose up -d
```

#### 4.2. Access the Application
Once the containers are up, the application will be available at:
```
http://localhost:8000
```

### 5. Run Migrations
Once the containers are running, run the migrations to create the necessary database tables:
```bash
docker-compose exec app php artisan migrate
```

### 6. Install Dependencies
If you are not using Docker, install dependencies via Composer:
```bash
composer install
```

## Development

- To enter the app container, use the following command:
  ```bash
  docker-compose exec app bash
  ```

## Testing

To run tests, use:
```bash
php artisan test
```

## License
MIT License

## Docker Compose File

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
            - ./docker/xdebug.ini:/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
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
            XDEBUG_MODE: debug
            XDEBUG_CONFIG: "client_host=host.docker.internal log_level=0"
            XDEBUG_SESSION: PHPSTORM
        extra_hosts:
            - "host.docker.internal:host-gateway"
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

## Dockerfile

```dockerfile
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y     libpng-dev     libjpeg-dev     libfreetype6-dev     libzip-dev     zip     unzip     git     curl     iputils-ping     net-tools     && docker-php-ext-configure gd --with-freetype --with-jpeg     && docker-php-ext-install pdo pdo_mysql zip gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
```

## .env File

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:nOfKvOGceHOWDVR3aEg4wv6uOY3esFPwYm9klh4BFnQ=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=game_catalog
DB_USERNAME=root
DB_PASSWORD=root

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

SESSION_DRIVER=database
SESSION_LIFETIME=120

LOG_CHANNEL=stack
```

