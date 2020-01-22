create database dbapp;
use dbapp;

create table usuario(
id int auto_increment primary key,
nomeusuario varchar(30) not null unique,
senha varchar(200) not null,
foto varchar(250) not null,
cpf varchar(15) not null,
nick varchar(20) not null,
email varchar(50) not null unique
)engine InnoDB;

create table jogo(
id int auto_increment primary key,
nomejogo varchar(50) not null,
foto varchar(250) not null,
plataforma varchar(30) not null
)engine InnoDB;

create table inscricao(
id int auto_increment primary key,
id_jogo int not null,
id_cadastro int not null,
id_torneio int not null
)engine InnoDB;

create table premio(
id int auto_increment primary key,
nome varchar(30) not null,
descricao varchar(50) not null,
foto varchar(250) not null
)engine InnoDB;

create table torneio(
id int auto_increment primary key,
data date not null,
hora time not null,
id_jogo int not null,
inscritos int not null,
id_premio int not null,
tempo time not null,
id_cadastro int not null 
)engine InnoDB;

create table ganhador(
id int auto_increment primary key,
id_torneio int not null,
data date not null,
hora time not null
)engine InnoDB;
