
# Mini Reddit

 Mini Reddit Application Built w/ Laravel.

## Installation

Clone the project using SSH or HTTPS.

```bash
git@github.com:yuvraj-timalsina/mini-reddit.git
```
    
## Run Locally

Go to the Project Directory

```bash
cd mini-reddit
```

Create .env in root directory

```bash
cp .env.example .env
```

# Create and Configure the Database

```bash
sudo mysql -u <username> -p
create database mini_reddit;
```
Add Database credentials in .env

```bash
DB_DATABASE=mini_reddit
DB_USERNAME=<username>
DB_PASSWORD=<password>
```

# Install Dependencies

```bash
composer install
```

Generate Application Key

```bash
php artisan key:generate
```

Run the Database Migrations

```bash
php artisan migrate
```

# Run the Server

```bash
php artisan serve
  
http://127.0.0.1:8000
```

## Author

- [@yuvraj-timalsina](https://www.github.com/yuvraj-timalsina)
