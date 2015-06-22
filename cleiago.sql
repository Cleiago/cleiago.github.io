SET NAMES 'utf8';
CHARSET 'utf8';

CREATE DATABASE IF NOT EXISTS cleiago
	DEFAULT CHARACTER SET 'utf8';

CREATE TABLE cleiago.user (
	id_user int NOT NULL AUTO_INCREMENT,
	name varchar(30) NOT NULL,
	login varchar(15) NOT NULL,
	email varchar(45) NOT NULL,
	password varchar(15) NOT NULL,
	type varchar(15) NOT NULL,
	CONSTRAINT user_pk PRIMARY KEY (id_user)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.cliente (
	cpf bigint NOT NULL,
	nome varchar(30) NOT NULL,
	dtnasc date NOT NULL,
	ender varchar(50) NOT NULL,
	cidade varchar (30) NOT NULL,
	uf varchar(3) NOT NULL,
	tel1 varchar(15) NOT NULL,
	tel2 varchar(15),
	CONSTRAINT cliente_pk PRIMARY KEY (cpf)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.produto (
	codp integer NOT NULL AUTO_INCREMENT,
	nome varchar(70) NOT NULL,
	genero varchar(20) NOT NULL,
	classet integer NOT NULL,
	ano smallint NOT NULL,
	vlvenda real NOT NULL,
	vlaluga real NOT NULL,
	estfisico varchar(10) NOT NULL,
	CONSTRAINT produto_pk PRIMARY KEY (codp)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.livro (
	isbn bigint NOT NULL,
	produto_codp integer NOT NULL,
	autor varchar(30) NOT NULL,
	CONSTRAINT livro_pk PRIMARY KEY (isbn, produto_codp),
	CONSTRAINT livro_produto_fk FOREIGN KEY (produto_codp) REFERENCES cleiago.produto(codp)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.videogame (
	desenv varchar(20) NOT NULL,
	produto_codp integer NOT NULL,
	console varchar(20) NOT NULL,
	CONSTRAINT videogame_pk PRIMARY KEY (desenv, produto_codp),
	CONSTRAINT videogame_produto_fk FOREIGN KEY (produto_codp) REFERENCES cleiago.produto(codp)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.aluga (
	produto_codp integer NOT NULL,
	cliente_cpf bigint NOT NULL,
	dtaluga date NOT NULL,
	dtdev date,
	CONSTRAINT aluga_pk PRIMARY KEY (produto_codp, cliente_cpf, dtaluga),
	CONSTRAINT aluga_produto_fk FOREIGN KEY (produto_codp) REFERENCES cleiago.produto(codp),
	constraint aluga_cliente_fk FOREIGN KEY (cliente_cpf) REFERENCES cleiago.cliente(cpf)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.compra (
	produto_codp integer NOT NULL,
	cliente_cpf bigint NOT NULL,
	dtcompra date NOT NULL,
	CONSTRAINT compra_pk PRIMARY KEY (produto_codp, cliente_cpf, dtcompra),
	CONSTRAINT compra_produto_fk FOREIGN KEY (produto_codp) REFERENCES cleiago.produto(codp),
	constraint compra_cliente_fk FOREIGN KEY (cliente_cpf) REFERENCES cleiago.cliente(cpf)
	) DEFAULT CHARSET=utf8;

