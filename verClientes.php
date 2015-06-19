<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ver Clientes</title>
	<meta charset='UTF-8'>
	<?php 
	?>
</head>
<body>
	<h3>Clientes</h3>
	<a href="index.php"><button>Home</button></a>
	<?php 
		if(isset($_SESSION["login"])){
			require_once 'fcnsdb.php';
			require_once 'logindb.php';
			require_once 'extrafunc.php';

			$banco = conectadb($dbHostname, $dbUsername, $dbPassword);
			selectdb($banco, $dbDatabase);
		
			$query = "SELECT * FROM cliente";
			PrintTable(query($banco,$query));
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verClientes.php\">";
		}
	 ?>
</body>
</html>