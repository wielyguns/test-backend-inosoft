# test-backend-inosoft

## Installation
### With Docker You Must

Just run </br>
<blockquote>docker compose up -d --build</blockquote>

### Install Dependencies
first do :
<blockquote>composer install</blockquote>
copy all env.example to .env (make if doesnt exist) </br>
and then run :</br>
<blockquote>php artisan jwt:secret</blockquote>
<blockquote>php artisan migrate:fresh --seed</blockquote>
