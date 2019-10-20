[![Build Status](https://travis-ci.org/Khachornchit/PHP-Symfony4-Micro-services.svg?branch=master)](https://travis-ci.org/Khachornchit/PHP-Symfony4-Micro-services)

# Microservices with PHP Symfony 4.2
This project is demonstrated on how to develop micro-services application with CRUD method using PHP Symfony 4.2 framework and PHP version 7.2.10, under docker container environment.

So, make sure you have installed docker and docker-compose ready on your environment. Then, you can follow the setup guide step by step.

## Technology Stack
* Linux
* Apache
* MySQL
* PHP 7.2, Symfony 4.2
* Docker
* Travis CI

## Pre-requires
* Install [Docker](https://www.docker.com/)

## Getting started
* Clone the repository
```
git clone https://github.com/Khachornchit/PHP-Symfony4-Micro-services.git
```
* Build the project
```
cd PHP-Symfony4-Micro-services
docker-compose build
docker-compose up -d
```
* Install dependencies
```
docker-compose exec php bash
cd PHP-Symfony4-Micro-services
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
exit
```

## phpMyAdmin 
* [phpMyAdmin](http://localhost:4033)
	
## CRUD
```
CREATE	
php bin/console user:create
- enter username : [Your name]
- enter password : SamplePassword1234$ 

READ	
- php console.php user:read

UPDATE
- php bin/console user:update

DELETE	
- php bin/console user:delete
```