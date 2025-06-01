Requirements:

PHP 8.4.4 or higher
Composer
Node.js & npm (for frontend assets)
MySQL database

1. Installation:

git clone https://github.com/Nascent01/ecommerce.git
cd ecommerce

2. Install PHP dependencies:

composer install

3. Install Node.js dependencies:

npm install

4. Create environment file and configure your database settings

5. Generate application key:

php artisan key:generate

6. Run initial command - php artisan command:initial-command

This will insert all the necessary data into the database.

7. Build frontend assets:

npm run build

8. You can find the admin user credentials in the DatabaseSeeder class, after loging in you will have access to the admin dashboard.