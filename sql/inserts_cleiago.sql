-- INSERTIONS CLEIAGO --
-- formato data YYYY-MM-DD --

INSERT INTO cleiago.cliente VALUES
	(83125996490,'Gustavo Almeida Souza','1975-09-19','R. Odete Mimessi, 1484','Sao Jose dos Campos','SP','(12)8423-8948','(12)9845-2313'),
	(87615281610,'Lucas Melo Ribeiro','1979-10-27','R. Bezerra de Menezes, 1744','Toledo','PR','(45)8466-5261', NULL),
	(81715138678,'Douglas Santos Cunha','1970-05-28','Tv. do Paraiso, 1614','Macapa','AP','(96)96194-9310', NULL),
	(82840198339,'Anna Correia Dias','1976-02-10','R. do Alecrim, 159','Maceio','AL','(82)97927-8609','(89)99531-3568'),
	(63055484045,'Sofia Castro Cunha','1944-05-17','R. Guaíba, 1090', 'Varginha','MG','(35)3835-8063',NULL),
	(67548665865,'Fernanda Azevedo Souza','1985-08-20','R. Joao Agripino Fortes, 1624','Guaratingueta','SP','(12)97779-8765','(12)98084-1977'),
	(40321174119,'Luiza Barbosa Azevedo','1989-07-31','R. Conquadra, 209','Ceilandia','DF','(61)4670-6871',NULL),
	(52984821203,'Julia Costa Rodrigues','1994-08-27','R. Antonio Carlos, 1600','Valinhos','SP','(19)7438-7613',NULL),
	(53028364832,'Breno Barros Castro','1990-11-27','R. Ibirama, 1058','Blumenau','SC','(47)9143-6158','(47)9532-8414')
	;

INSERT INTO cleiago.produto VALUES
	(1,'Otimo'),
	(2,'Bom'),
	(3,'Otimo'),
	(4,'Bom'),
	(5,'Bom'),
	(6,'Bom'),
	(7,'Otimo'),
	(8,'Otimo'),
	(9,'Bom'),
	(10,'Otimo'),
	(11,'Otimo'),
	(12,'Bom'),
	(13,'Bom'),
	(14,'Bom'),
	(15,'Bom'),
	(16,'Otimo'),
	(17,'Bom'),
	(18,'Otimo'),
	(19,'Otimo'),
	(20,'Bom'),
	(21,'Otimo'),
	(22,'Bom'),
	(23,'Otimo'),
	(24,'Otimo'),
	(25,'Otimo'),
	(26,'Bom'),
	(27,'Otimo'),
	(28,'Bom'),
	(29,'Bom'),
	(30,'Otimo'),
	(31,'Bom'),
	(32,'Otimo')
	;

INSERT INTO cleiago.livro VALUES
	(9788533613379,'O Senhor dos Aneis: A Sociedade do Anel','Jhon Ronald Reuel Tolkien','Ficcao',0,2000,'Martins Fontes',2,52.90,21.80),
	(9788533613386,'O Senhor dos Aneis: As Duas Torres','Jhon Ronald Reuel Tolkien','Ficcao',0,2002,'Martins Fontes',2,52.90,21.80),
	(9788533613393,'O Senhor dos Aneis: O Retorno do Rei','Jhon Ronald Reuel Tolkien','Ficcao',0,2000,'Martins Fontes',2,52.90,21.80),
	(9788578275778,'Mestre Gil de Ham','Jhon Ronald Reuel Tolkien','Ficcao',0,2012,'Martins Fontes',2,15.00,7.00),
	(9788533624429,'As Aventuras de Tom Bombadil','Jhon Ronald Reuel Tolkien','Ficcao',0,2008,'Martins Fontes',1,15.00,7.00),
	(9788578277765,'Roverandom','Jhon Ronald Reuel Tolkien','Ficcao',0,2013,'Martins Fontes',2,15.00,7.00)
	;

INSERT INTO cleiago.produtolivro VALUES
	(1,9788533613379),(2,9788533613379),(3,9788533613379),(4,9788533613379),(5,9788533613379),(6,9788533613386),(7,9788533613386),(8,9788533613386),
	(9,9788533613386),(10,9788533613386),(11,9788533613393),(12,9788533613393),(13,9788533613393),(14,9788533613393),(15,9788533613393),(16,9788578275778),
	(17,9788578275778),(18,9788578275778),(19,9788578275778),(20,9788578275778),(21,9788533624429),(22,9788533624429),(23,9788533624429),(24,9788533624429),
	(25,9788533624429),(26,9788578277765),(27,9788578277765),(28,9788578277765),(29,9788578277765),(30,9788578277765),(31,9788578277765),(32,9788578277765)
	;


INSERT INTO cleiago.aluga VALUES
	(13,67548665865,'2015-05-20','2015-06-02'),
	(5,53028364832,'2015-04-24','2015-05-15')
	;

INSERT INTO cleiago.compra VALUES
	(8,82840198339,'2015-06-02'),
	(7,40321174119,'2015-05-28')
	;

INSERT INTO cleiago.user VALUES
	(1,'tiago','tiago','tad','tiago@email.com','root'),
	(2,'cleiton','cleiton','cleiton','cleiton@email.com','root')
	;