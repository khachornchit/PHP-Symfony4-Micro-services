# Symfony Microservices Application
`Author John <john@pluto.solutions>`

## Setup
1. Make sure you are using php 7.1+, composer, and MySQL 
2. git clone git@github.com:plutosolutions/SymfonyMicroservices.git
3. cd SymfonyMicroservices
4. composer install
5. Update mysql connection in .env file at DATABASE_URL
    * **Example**
    * DATABASE_URL=mysql://root:1234@127.0.0.1:3306/pluto-symfony-microservices
6. Run follow command 6.1-6.2 to create database and table in MySQL
    * 6.1 php bin/console doctrine:database:create
    * 6.2 php bin/console doctrine:migrations:migrate

## Command List
### Hello Test
    * php bin/console hello
    
### CREATE User Example
    * php bin/console user-create
    
### READ User Example
    * php console.php user-read

### UPDATE User Example
    * php bin/console user-update

### DELETE User Example
    * php bin/console user-delete
