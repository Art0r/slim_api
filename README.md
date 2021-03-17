## slim_api
API usando o slim framework

### composer install
### iniciar servidor: php -S localhost:8080 -t src src/index.php

#### Query para resetar/criar o banco de dados
drop database dbphp;

create schema dbphp;
use dbphp;

create table users (
	id int not null primary key auto_increment,
    name varchar(32) not null,
    email varchar(32) not null
);

INSERT INTO users (name, email) VALUES ("Arthur", "arthur@gmail.com");
INSERT INTO users (name, email) VALUES ("Lucas", "lucas@gmail.com");
INSERT INTO users (name, email) VALUES ("Simone", "simone@gmail.com");

SELECT * FROM users;