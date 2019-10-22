### Short URL Creator

1. Clone the repository git clone https://github.com/mes1901/short-url.git
2. cd short-url
3. composer install
4. cp .env.example .env
    - create database
    - set your db settings to .env file
5. php artisan key:generate
6. php artisan migrate
7. php artisan serve
