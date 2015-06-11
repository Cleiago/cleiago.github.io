<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ver Produtos</title>
	<meta charset='UTF-8'>
</head>
<body>
	<?php 
	if(isset($_SESSION["login"])){
		
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		require_once 'extrafunc.php';
		$banco = conectadb($dbHostname, $dbUsername, $dbPassword);
		selectdb($banco, $dbDatabase);

		$query = "SELECT * FROM Produto LEFT JOIN Hq ON codp=produto_codp LEFT JOIN Videogame V ON codp=V.produto_codp ORDER BY codp";
		PullValues(query($banco,$query));

	}else{
		echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verProdutos.php\">";
	}
	?>
</body>
</html>