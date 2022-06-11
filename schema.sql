create database if not exists PonyExpress;
use PonyExpress;

create table if not exists Messages(
    id int auto_increment primary key,
    number varchar(11),
    text text,
    provider text,
    status enum('sent', 'failed')
);
