#Plane CRUD App

##Installation

```
git clone
composer install

create .env.local file with the Database URL, see .env for example
run php bin/console doctrine:database:create
run php bin/composer doctrine:migrations:migrate

run php bin/console server:run
go to localhost:8000
```