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
	<?php 
		if(isset($_SESSION["login"])){
			require_once 'fcnsdb.php';
			require_once 'logindb.php';
			require_once 'extrafunc.php';

			$banco = conectadb($dbHostname, $dbUsername, $dbPassword);
			selectdb($banco, $dbDatabase);
		
			$query = "SELECT * FROM Cliente";
			PullValues(query($banco,$query));
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verClientes.php\">";
		}
	 ?>
</body>
</html>