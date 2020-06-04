# Blog CMS

實作一簡易部落格文章後臺管理系統，具備使用者、文章、文章類別之基本CRUD功能。文章可留言亦可回覆留言。文章與使用者可擁有照片。使用者權限分級，僅Role為Administrator者可使用後台管理。

此Project目標為後端應用Laravel，前端沒有特別美化，重心放在Laravel的Model and Controller ，專注於Eloquent ORM之強大功能。

# Get it up and running.

```
# create a .env file
cp .env.example .env

# install composer dependencies
composer update

# install npm dependencies
npm install

# generate a key for your application
php artisan key:generate

# create a local MySQL database (make sure you have MySQL up and running)
mysql -u root

> create database csm_db;
> exit;

# add the database connection config to your .env file
DB_CONNECTION=mysql
DB_DATABASE=csm_db
DB_USERNAME=root
DB_PASSWORD=

# run the migration files to generate the schema
php artisan migrate

# run the seeder to create some roles
php artisan db:seeder

# run webpack and watch for changes
npm run watch

# run it on localhost
php artisan serve
```
