## Requirements

- **PHP**: 8.4.4 or higher
- **Composer**: Latest version
- **Node.js & npm**: For frontend asset compilation
- **MySQL**: Database server

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/Nascent01/ecommerce.git
cd ecommerce
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy the environment file
cp .env.example .env

# Configure your database settings in .env file
# Update the following variables:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_database_name
# DB_USERNAME=your_username
# DB_PASSWORD=your_password
```

### 4. Application Setup
```bash
# Generate application key
php artisan key:generate

# Run initial setup command (creates database tables and seeds data)
php artisan command:initial-command
```

### 5. Build Frontend Assets
```bash
npm run build
```

## 6. Getting Started
Admin user credentials can be found in the `DatabaseSeeder` class. After logging in with these credentials, you'll have access to the admin dashboard.
