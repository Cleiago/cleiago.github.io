<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ver Produtos</title>
	<meta charset='UTF-8'>
</head>
<body>
	<h3>sProdutos</h3>
	<a href="index.php"><button>Home</button></a>
	<?php 
	if(isset($_SESSION["login"])){
		
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		require_once 'extrafunc.php';
		$banco = conectadb($dbHostname, $dbUsername, $dbPassword);
		selectdb($banco, $dbDatabase);

		$query = "SELECT * FROM produto LEFT JOIN Hq ON codp=produto_codp LEFT JOIN videogame v ON codp=v.produto_codp WHERE codp NOT IN (SELECT produto_codp from aluga UNION SELECT produto_codp FROM compra) ORDER BY codp";
		PrintTable(query($banco,$query));

	}else{
		echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verProdutos.php\">";
	}
	?>
</body>
</html>