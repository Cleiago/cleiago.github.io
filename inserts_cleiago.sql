-- INSERTIONS CLEIAGO --
-- formato data YYYY-MM-DD --

INSERT INTO cleiago.cliente VALUES
	(83125996490,'Gustavo Almeida Souza','1975-09-19','R. Odete Mimessi, 1484','São José dos Campos','SP','(12)8423-8948','(12)9845-2313'),
	(87615281610,'Lucas Melo Ribeiro','1979-10-27','R. Bezerra de Menezes, 1744','Toledo','PR','(45)8466-5261', NULL),
	(81715138678,'Douglas Santos Cunha','1970-05-28','Tv. do Paraíso, 1614','Macapá','AP','(96)96194-9310', NULL),
	(82840198339,'Anna Correia Dias','1976-02-10','R. do Alecrim, 159','Maceió','AL','(82)97927-8609','(89)99531-3568'),
	(63055484045,'Sofia Castro Cunha','1944-05-17','R. Guaíba, 1090', 'Varginha','MG','(35)3835-8063',NULL),
	(67548665865,'Fernanda Azevedo Souza','1985-08-20','R. João Agripino Fortes, 1624','Guaratinguetá','SP','(12)97779-8765','(12)98084-1977'),
	(40321174119,'Luiza Barbosa Azevedo','1989-07-31','R. Conquadra, 209','Ceilândia','DF','(61)4670-6871',NULL),
	(52984821203,'Julia Costa Rodrigues','1994-08-27','R. Antonio Carlos, 1600','Valinhos','SP','(19)7438-7613',NULL),
	(53028364832,'Breno Barros Castro','1990-11-27','R. Ibirama, 1058','Blumenau','SC','(47)9143-6158','(47)9532-8414')
	;

INSERT INTO cleiago.produto VALUES
	(1,'O Senhor dos Anéis: A Sociedade do Anel','Fantasia',16,2000,52.90,21.80,'Ótimo'),
	(2,'O Senhor dos Anéis: A Sociedade do Anel','Fantasia',16,2000,52.90,21.80,'Bom'),
	(3,'O Senhor dos Anéis: A Sociedade do Anel','Fantasia',16,2000,52.90,21.80,'Ótimo'),
	(4,'O Senhor dos Anéis: A Sociedade do Anel','Fantasia',16,2000,52.90,21.80,'Regular'),
	(5,'O Senhor dos Anéis: A Sociedade do Anel','Fantasia',16,2000,52.90,21.80,'Ótimo'),
	(6,'O Senhor dos Anéis: As Duas Torres','Fantasia',16,2002,52.90,21.80,'Bom'),
	(7,'O Senhor dos Anéis: As Duas Torres','Fantasia',16,2002,52.90,21.80,'Ótimo'),
	(8,'O Senhor dos Anéis: As Duas Torres','Fantasia',16,2002,52.90,21.80,'Bom'),
	(9,'O Senhor dos Anéis: As Duas Torres','Fantasia',16,2002,52.90,21.80,'Bom'),
	(10,'O Senhor dos Anéis: As Duas Torres','Fantasia',16,2002,52.90,21.80,'Ótimo'),
	(11,'O Senhor dos Anéis: O Retorno do Rei','Fantasia',16,2000,52.90,21.80,'Ótimo'),
	(12,'O Senhor dos Anéis: O Retorno do Rei','Fantasia',16,2000,52.90,21.80,'Regular'),
	(13,'O Senhor dos Anéis: O Retorno do Rei','Fantasia',16,2000,52.90,21.80,'Ótimo'),
	(14,'O Senhor dos Anéis: O Retorno do Rei','Fantasia',16,2000,52.90,21.80,'Bom'),
	(15,'O Senhor dos Anéis: O Retorno do Rei','Fantasia',16,2000,52.90,21.80,'Bom')
	;

INSERT INTO cleiago.livro VALUES
	(8533613377,1,'Jhon Ronald Reuel Tolkien'),
	(8533613377,2,'Jhon Ronald Reuel Tolkien'),
	(8533613377,3,'Jhon Ronald Reuel Tolkien'),
	(8533613377,4,'Jhon Ronald Reuel Tolkien'),
	(8533613377,5,'Jhon Ronald Reuel Tolkien'),
	(8533613385,6,'Jhon Ronald Reuel Tolkien'),
	(8533613385,7,'Jhon Ronald Reuel Tolkien'),
	(8533613385,8,'Jhon Ronald Reuel Tolkien'),
	(8533613385,9,'Jhon Ronald Reuel Tolkien'),
	(8533613385,10,'Jhon Ronald Reuel Tolkien'),
	(8533613393,11,'Jhon Ronald Reuel Tolkien'),
	(8533613393,12,'Jhon Ronald Reuel Tolkien'),
	(8533613393,13,'Jhon Ronald Reuel Tolkien'),
	(8533613393,14,'Jhon Ronald Reuel Tolkien'),
	(8533613393,15,'Jhon Ronald Reuel Tolkien')
	;

INSERT INTO cleiago.aluga VALUES
	(13,67548665865,'2015-05-20','2015-06-02'),
	(5,53028364832,'2015-04-24','2015-05-15')
	;

INSERT INTO cleiago.compra VALUES
	(8,82840198339,'2015-06-02'),
	(7,40321174119,'2015-05-28')
	;