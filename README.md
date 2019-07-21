# Plane CRUD App

## About

A simple application made in Symfony using an MySQL database. 
You can create pilots and planes. Let pilots fly with planes. 

This was made to understand Symfony4, Doctrine and Twig and enhance my own skills.

## Installation

```
git clone
composer install

create .env.local file with the Database URL, see .env for example
run php bin/console doctrine:database:create
run php bin/composer doctrine:migrations:migrate

run php bin/console server:run
go to localhost:8000
```
