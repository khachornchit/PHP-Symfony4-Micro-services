# Micro-services Application
Micro-services Application development using PHP Symfony 4.2 framework to create simpel CRUD.
 
## Setup Guide
1. mkdir -p ~/demo/php
2. cd ~/demo/php
3. git clone https://gitlab.com/khachornchit/php-symfony4-microservices.git
4. cd php-symfony4-microservices
5. docker-compose up -d
6. browse http://localhost:4033/
    * Expectation: See phpMyAdmin
7. Able to key in user name and password
    * Expectation: See microservices database in the phpMyAdmin
8. docker-compose exec php bash
    * php -version
        * Expectation: see PHP 7.2.10
    * ls
        * Expectation: see microservices folder
    * cd microservices
    * composer install
        * Expectation: compose installation succefully
    * php bin/console d:s:v
        * Expectation:
            * [OK] The mapping files are correct.
            * [OK] The database schema is in sync with the mapping files.

## Create Table
* php bin/console doctrine:migrations:migrate
    * It will create a table user in schema microservices

## Command Line
### Hello
    * php bin/console hello
    
### CREATE
    * php bin/console user:create
        * enter username : [Your name]
        * enter password : Test1234$ 
    
### READ
    * php console.php user:read

### UPDATE
    * php bin/console user:update

### DELETE
    * php bin/console user:delete