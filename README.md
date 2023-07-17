# test-backend-inosoft

## Install Docker First (Mandatory)
Just run docker compose up -d --build
## Go To Docker Shell Location
RUN composer install </br>
RUN composer required jenssegers/mongodb </br>
In case your Laravel version does NOT autoload the packages, add the service provider to config/app.php:
<code>Jenssegers\Mongodb\MongodbServiceProvider::class</code>
