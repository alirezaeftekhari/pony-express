create database if not exists PonyExpress;

use PonyExpress;

create table if not exists Messages(
    id int auto_increment primary key,
    number varchar(11),
    text text,
    provider text,
    status enum('sent', 'failed'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table if not exists Users(
    id int auto_increment primary key,
    username varchar(60) unique,
    password text
);

insert into Users (username, password) values ('admin', md5('admin'));
