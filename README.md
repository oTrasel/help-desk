
# Laravel Help-desk

#### Create .env

```
  cp .env.example .env
```
#### Install vendor an dependences
```
  composer install
```
#### Create database
```
  docker-compose up -d
```
#### Configure database in .env
```
  All credentials is api-service
```
#### Run migrations
```
  php artisan migrate
```
#### Generate key
```
  php artisan key:generate
```
#### Start application
```
  php artisan serve
```