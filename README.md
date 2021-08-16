
## Installation

#### Clone the Repo:
```
$ git clone https://github.com/anis7849/shopping-store.git
```
#### Install Dependencies

```
$ cd laravel-api-boilerplate.git
$ composer install
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```
Run `php artisan key:generate` and `php artisan jwt:secret` and `php artisan storage:link`
Run `php artisan config:cache && php artisan config:clear && php artisan route:clear`

#### Migrate and Seed the Database
```
$ php artisan migrate
```

#### Find postman collection in root folder 