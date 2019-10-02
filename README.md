# Micro-services Application with PHP Symfony 4
This project demonstrate on how to develop microservices application with CRUD method using PHP Symfony 4.2 framework and PHP version 7.2.10, under docker container environment.

So, make sure you have installed docker and docker-compose ready on your environment. Then, you can follow the setup guide step by step.

## Stack
* PHP 7.2, Symfony 4.2
* MySQL
* docker/docker-compose
 
## Setup Guide
* git clone https://github.com/Khachornchit/PHP-Symfony4-Micro-services.git
* cd PHP-Symfony4-Micro-services
* docker-compose build
* docker-compose up -d
* docker-compose exec php bash
	* cd microservices
	* composer install
	* php bin/console doctrine:database:create
	* php bin/console doctrine:migrations:migrate
* phpMyAdmin http://localhost:4033
	* It will created schema microservice in MySQL automatically 
	
## Micro-services CRUD
* CREATE	
	* php bin/console user:create
		* enter username : [Your name]
		* enter password : Test1234$ 
* READ	
	* php console.php user:read
* UPDATE
	* php bin/console user:update
* DELETE	
	* php bin/console user:delete