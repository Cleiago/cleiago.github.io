CREATE DATABASE IF NOT EXISTS Cleiago
	DEFAULT CHARACTER SET utf8;

CREATE TABLE Cleiago.User (
	id_user int NOT NULL AUTO_INCREMENT,
	name varchar(30) NOT NULL,
	login varchar(15) NOT NULL,
	email varchar(45) NOT NULL,
	password varchar(15) NOT NULL,
	type varchar(15) NOT NULL,
	CONSTRAINT user_pk PRIMARY KEY (id_user)
	);

CREATE TABLE Cleiago.Cliente (
	cpf bigint NOT NULL,
	nome varchar(30) NOT NULL,
	dtnasc date NOT NULL,
	ender varchar(50) NOT NULL,
	cidade varchar (30) NOT NULL,
	uf varchar(3) NOT NULL,
	tel1 varchar(15) NOT NULL,
	tel2 varchar(15),
	CONSTRAINT cliente_pk PRIMARY KEY (cpf)
	);

CREATE TABLE Cleiago.Produto (
	codp integer NOT NULL AUTO_INCREMENT,
	nome varchar(70) NOT NULL,
	genero varchar(20) NOT NULL,
	classet integer NOT NULL,
	ano smallint NOT NULL,
	vlvenda real NOT NULL,
	vlaluga real NOT NULL,
	estfisico varchar(10) NOT NULL,
	CONSTRAINT produto_pk PRIMARY KEY (codp)
	);

CREATE TABLE Cleiago.Hq (
	isbn bigint NOT NULL,
	produto_codp integer NOT NULL,
	autor varchar(30) NOT NULL,
	CONSTRAINT hq_pk PRIMARY KEY (isbn, produto_codp),
	CONSTRAINT hq_produto_fk FOREIGN KEY (produto_codp) REFERENCES Cleiago.Produto(codp)
	);

CREATE TABLE Cleiago.Videogame (
	desenv varchar(20) NOT NULL,
	produto_codp integer NOT NULL,
	console varchar(20) NOT NULL,
	CONSTRAINT videogame_pk PRIMARY KEY (desenv, produto_codp),
	CONSTRAINT videogame_produto_fk FOREIGN KEY (produto_codp) REFERENCES Cleiago.Produto(codp)
	);

CREATE TABLE Cleiago.Aluga (
	produto_codp integer NOT NULL,
	cliente_cpf bigint NOT NULL,
	dtaluga date NOT NULL,
	dtdev date,
	CONSTRAINT aluga_pk PRIMARY KEY (produto_codp, cliente_cpf, dtaluga),
	CONSTRAINT aluga_produto_fk FOREIGN KEY (produto_codp) REFERENCES Cleiago.Produto(codp),
	constraint aluga_cliente_fk FOREIGN KEY (cliente_cpf) REFERENCES Cleiago.Cliente(cpf)
	);

CREATE TABLE Cleiago.Compra (
	produto_codp integer NOT NULL,
	cliente_cpf bigint NOT NULL,
	dtcompra date NOT NULL,
	CONSTRAINT compra_pk PRIMARY KEY (produto_codp, cliente_cpf, dtcompra),
	CONSTRAINT compra_produto_fk FOREIGN KEY (produto_codp) REFERENCES Cleiago.Produto(codp),
	constraint compra_cliente_fk FOREIGN KEY (cliente_cpf) REFERENCES Cleiago.Cliente(cpf)
	);