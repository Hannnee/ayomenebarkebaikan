### Requirements

- Laravel 10.0
- PHP 8.1
- Database Mysql
- Template Dashlite V3.1.1 Licence Bootstrap 5
- Blade Template
- Javascript Jquery

### Features

- Login
- Logout
- Forgot password
- Theme mode
- Permissions   | list | detail
- Roles         | list | create | detail | delete
- Users         | list | create | update | detail | delete
- Customers     | list | create | update | detail | delete
- Items         | list | create | update | detail | delete
- Orders        | list | create | detail | delete
- Dashboard

### Design

- Repository pattern
- Form request 
- Route model binding
- Traits Uuid
- Seeder data
- Permission base access
- Soft delete

### Pull request

- Clone from github (public repository)
- git clone https://github.com/Hannnee/ayomenebarkebaikan.git

### Setup project

- Setting database .env
- composer install | composer update
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan serve

### Login account

- super admin || email : superadmin@gmail.com / password : 12345678
- staff || email : staff@gmail.com / password : 12345678
