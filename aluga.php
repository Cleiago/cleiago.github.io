<!DOCTYPE html>
<html>
<head>
	<title>Emprestimo</title>
	<meta charset='UTF-8'>
	<?php 
		if(isset($_COOKIE["login"]) && isset($_COOKIE["pass"])){
			require_once 'fcnsdb.php';
			require_once 'logindb.php';
			$banco = conectadb($dbHostname, $dbUsername, $dbPassword);

			selectdb($banco, $dbDatabase);

			$login = $_COOKIE["login"];
			$senha = $_COOKIE["pass"];
			$query = "SELECT name FROM user WHERE login ='".$login."' AND password ='".$senha."'";
			$resultado = query($banco, $query);

			if(mysqli_num_rows($resultado)>0){

			}else{
				echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?user=".false."&url=cadClientes.php\">";
				exit;
			}
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=cadClientes.php\">";
		}
	?>
</head>
<body>
	<h3>Emprestimo</h3>
	<?php
		
	?>
	<form name="aluga" method="post">
		<p>
			<label for='pcodp'>Codigo do Produto:</label>
			<input type='text' name='pcodp' id='codp' required>
		</p>
		<p>
			<label for='ccpf'>CPF do Cliente:</label>
			<input type='text' id='ccpf' name='ccpf' size="11" maxlength="11" required pattern="\d{11}">
		</p>
		<p>
			<input type='submit' name='submit' value='Confirmar'>
		</p>
	</form>
</body>
</html>