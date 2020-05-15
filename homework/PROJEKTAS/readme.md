! Execute query in db before running project.

-------------------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS math_games;

USE math_games;

CREATE TABLE scores 
( 
id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
user_id int NOT NULL, 
score int NOT NULL
);

CREATE TABLE users
( 
id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
username varchar(255) NOT NULL, 
ip_address varchar(255) NOT NULL,
created timestamp DEFAULT CURRENT_TIMESTAMP
);

-------------------------------------------------------------------------

! Make sure to edit host credential in /config/Database.php class.