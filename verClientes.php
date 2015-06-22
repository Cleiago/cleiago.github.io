<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<script src="./tablesorter/jquery.tablesorter.js"></script>
	<link rel="stylesheet" href="./tablesorter/themes/blue/custom_style.css">

	<title>Ver Clientes</title>
	

	<script type="text/javascript">
		$(document).ready(function(){
			$("table").tablesorter();

			$("#cpf").text('CPF');
			$("#nome").text('Nome');
			$("#dtnasc").text('Data de Nascimento');
			$("#ender").text('Endereço');
			$("#cidade").text('Cidade');
			$("#uf").text('UF');
			$("#tel1").text('Telefone Principal');
			$("#tel2").text('Telefone Secundário');
		})
	</script>

</head>
<body>
	<h3>Clientes</h3>
	<a href="index.php"><button>Home</button></a>
	<?php 
		if(isset($_SESSION["login"])){
		
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verClientes.php\">";
			exit();
		}
		
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		require_once 'extrafunc.php';

		$banco = conectadb($dbHostname, $dbUsername, $dbPassword);
		selectdb($banco, $dbDatabase);
	
		$query = "SELECT * FROM cliente";

		PrintTable(query($banco,$query));
	 ?>
</body>
</html>