# CRUD Symfony CLI Application 
`by John <john@pluto.solutions>`

## Initial Setup
1. Make sure you are using php version 7.2+
2. git clone git@github.com:plutosolutions/symfonycli.git
3. cd symfonycli
4. composer install
5. Change database configuration at file symfonycli\cli-config.php
6. Change database configuration at file symfonycli\src\Manager\UserManager.php
7. Run this command to create database in MySQL
    * 7.1 vendor/bin/doctrine orm:schema-tool:update --force

## Google documentation
https://docs.google.com/document/d/1C7-uDyNF1ljru8qmE_VCfEnjkZZQkqFPV06Avz9Zi0Y/edit?usp=sharing

## Hello Test
* Run this command to ensure the app work property
    * php console.php hello John
    
## CREATE User Example
* Run this command to create a new user
    * php console.php user-create john@pluto.solutions HH98903#@%#$@
    
## READ User Example
* Run this command to read user info of user id#5
    * php console.php user-read 5

## UPDATE User Example
* Run this command to update user info of user id#5
    * php console.php user-update 5 update@update.com HH98903#@%#$@

## DELETE User Example
* Run this command to delete user user id#5
    * php console.php user-delete 5
