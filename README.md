# test-backend-inosoft

## Installation
### With Docker You Must
Just run docker compose up -d --build
### Install Dependencies
first do :
<clipboard-copy>composer install<clipboard-copy> <br>
after that :
<clipboard-copy>php artisan jwt:secret</clipboard-copy>
## Go To Docker Shell Location
RUN composer install </br>
RUN composer required jenssegers/mongodb </br>
In case your Laravel version does NOT autoload the packages, add the service provider to config/app.php:
<clipboard-copy>Jenssegers\Mongodb\MongodbServiceProvider::class<clipboard-copy>
