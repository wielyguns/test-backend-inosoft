# test-backend-inosoft

## Installation
### With Docker You Must
Just run </br>
<blockquote>docker compose up -d --build</blockquote>
### Install Dependencies
first do :
<clipboard>composer install<clipboard> <br>
after that :
<blockquote>php artisan jwt:secret</blockquote>
## Go To Docker Shell Location
RUN composer install </br>
RUN composer required jenssegers/mongodb </br>
In case your Laravel version does NOT autoload the packages, add the service provider to config/app.php:
<clipboard-copy>Jenssegers\Mongodb\MongodbServiceProvider::class<clipboard-copy>
