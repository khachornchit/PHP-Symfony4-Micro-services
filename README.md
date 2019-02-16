# PHP Symfony 4.2 Micro-services Application Development
`Develop PHP Symfony Micro-services Application using PHP Symfony 4.2 framework to develop full functionality of CRUD by using Entity, Repository, Doctrine, ORM, MySQL, etc.`

##### Contact Info
* Author : Pluto Solutions <hi@pluto.solutions>
* Web : http://pluto.solutions
 
#### Setup
1. Make sure you are using php 7.1+, composer, and MySQL 
2. git clone git@bitbucket.org:plutosolutions/php-symfony4-microservices.git
3. cd SymfonyMicroservices
4. composer install
5. Update mysql connection in .env file at DATABASE_URL
    * DATABASE_URL=mysql://root:1234@127.0.0.1:3306/pluto-symfony-microservices
6. Run follow command 6.1-6.2 to create database and table in MySQL
    * 6.1 php bin/console doctrine:database:create
    * 6.2 php bin/console doctrine:migrations:migrate

#### Command List
##### Hello
    * php bin/console hello
    
##### CREATE
    * php bin/console user-create
    
##### READ
    * php console.php user-read

##### UPDATE
    * php bin/console user-update

##### DELETE
    * php bin/console user-delete
