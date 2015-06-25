SET NAMES 'utf8';
SET CHARSET 'utf8';

CREATE DATABASE IF NOT EXISTS cleiago
	DEFAULT CHARACTER SET 'utf8';

CREATE TABLE cleiago.user (
	id_user int NOT NULL AUTO_INCREMENT,
	name varchar(30) NOT NULL,
	login varchar(15) NOT NULL,
	password varchar(15) NOT NULL,
	email varchar(45) NOT NULL,
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
	estfisico varchar(10) NOT NULL,
	CONSTRAINT produto_pk PRIMARY KEY (codp)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.livro (
	isbn bigint NOT NULL,
	ltitulo varchar(70) NOT NULL,
	lautor varchar(30) NOT NULL,
	lgenero varchar(20) NOT NULL,
	lclasset integer NOT NULL,
	lano smallint NOT NULL,
	leditora varchar(30) NOT NULL,
	ledicao smallint NOT NULL,
	lvlvenda real NOT NULL,
	lvlaluga real NOT NULL,
	CONSTRAINT livro_pk PRIMARY KEY (isbn)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.videogame (
	vgid integer NOT NULL,
	vtitulo varchar(70) NOT NULL,
	vdesenv varchar(20) NOT NULL,
	vgenero varchar(20) NOT NULL,
	vclasset integer NOT NULL,
	vano smallint NOT NULL,
	vconsole varchar(20) NOT NULL,
	vvlvenda real NOT NULL,
	vvlaluga real NOT NULL,
	CONSTRAINT videogame_pk PRIMARY KEY (vgid)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.produtolivro (
	codp integer NOT NULL,
	isbn bigint NOT NULL,
	CONSTRAINT prod_livro_pk PRIMARY KEY (codp,isbn),
	CONSTRAINT prodlivro_produto_fk FOREIGN KEY	(codp) REFERENCES cleiago.produto(codp),
	CONSTRAINT prodlivro_livro_fk FOREIGN KEY (isbn) REFERENCES cleiago.livro(isbn)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.produtovideogame (
	codp integer NOT NULL,
	vgid integer NOT NULL,
	CONSTRAINT prod_videogame_pk PRIMARY KEY (codp,vgid),
	CONSTRAINT prodvideogame_produto_fk FOREIGN KEY	(codp) REFERENCES cleiago.produto(codp),
	CONSTRAINT prodvideogame_videogame_fk FOREIGN KEY (vgid) REFERENCES cleiago.videogame(vgid)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.aluga (
	codp integer NOT NULL,
	cpf bigint NOT NULL,
	dtaluga date NOT NULL,
	dtdev date,
	CONSTRAINT aluga_pk PRIMARY KEY (codp, cpf, dtaluga),
	CONSTRAINT aluga_produto_fk FOREIGN KEY (codp) REFERENCES cleiago.produto(codp),
	constraint aluga_cliente_fk FOREIGN KEY (cpf) REFERENCES cleiago.cliente(cpf)
	) DEFAULT CHARSET=utf8;

CREATE TABLE cleiago.compra (
	codp integer NOT NULL,
	cpf bigint NOT NULL,
	dtcompra date NOT NULL,
	CONSTRAINT compra_pk PRIMARY KEY (codp, cpf, dtcompra),
	CONSTRAINT compra_produto_fk FOREIGN KEY (codp) REFERENCES cleiago.produto(codp),
	constraint compra_cliente_fk FOREIGN KEY (cpf) REFERENCES cleiago.cliente(cpf)
	) DEFAULT CHARSET=utf8;

