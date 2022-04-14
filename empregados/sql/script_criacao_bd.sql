/**
 * Author:  marcosferreira
 * Created: 08/12/2019
 */
drop database if exists curso;

create database if not exists curso; 

use curso;

create table if not exists usuarios
(
	id int auto_increment primary key,
	usuario varchar(10) not null,
	senha varchar(10) not null,
	dtCadastro datetime default CURRENT_TIMESTAMP not null
);

create table if not exists empregados
(
	id int auto_increment primary key,
	nome varchar(100) not null,
	endereco varchar(255) not null,
	salario int(10) not null
);

insert into usuarios values (DEFAULT, 'teste', '1234', DEFAULT);
insert into empregados values (DEFAULT, 'Empregado Um', 'Rua dos Empregados, 1', 1000.00);
insert into empregados values (DEFAULT, 'Empregado Dois', 'Rua dos Empregados, 2', 2000.00);
insert into empregados values (DEFAULT, 'Empregado Tres', 'Rua dos Empregados, 3', 3000.00);
insert into empregados values (DEFAULT, 'Empregado Quatro', 'Rua dos Empregados, 4', 4000.00);

use curso;

select * from usuarios;
select * from empregados;
