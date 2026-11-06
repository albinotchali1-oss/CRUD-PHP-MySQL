create database cadastro;

use cadastro;

create table usuarios(
    id int auto_increment primary key,
    nome varchar(45) not null,
    email varchar(50) not null,
    senha varchar(50) not null,
    data_nasc date
);

