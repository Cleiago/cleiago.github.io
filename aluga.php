<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Emprestimo</title>
	<meta charset='UTF-8'>
</head>
<body>
	<h3>Emprestimo</h3>
	<?php 
		if(isset($_SESSION["login"])){

			if(isset($_POST['submit'])){
				require_once 'logindb.php';
				require_once 'fcnsdb.php';
				
				$banco = conectadb($dbHostname,$dbUsername,$dbPassword);
				selectdb($banco,$dbDatabase);

				$pcodp	= $_POST['pcodp'];
				$ccpf	= $_POST['ccpf'];
				$dtaluga= date('Y-m-d',time());

				$query = "INSERT INTO Aluga VALUES ('$pcodp','$ccpf','$dtaluga','null')";
				$resultado = query($banco,$query);

			}
			echo "<form name='aluga' method='post'>
					<p>
						<label for='pcodp'>Codigo do Produto:</label>
						<input type='text' name='pcodp' id='pcodp' required>
					</p>
					<p>
						<label for='ccpf'>CPF do Cliente:</label>
						<input type='text' id='ccpf' name='ccpf' size='11' maxlength='11' required pattern='\d{11}'>
					</p>
					<p>
						<input type='submit' name='submit' value='Confirmar'>
					</p>
				</form>";

			if(isset($_POST['submit'])){
				require_once 'extrafunc.php';
				if($resultado){
					echo "<p>Operação Concluída!</p>";
					$query = "SELECT * FROM Aluga WHERE produto_codp='$pcodp' AND cliente_cpf='$ccpf' AND dtaluga='$dtaluga'";
					PullValues(query($banco,$query));
				}
			}
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=aluga.php\">";
		}
	?>
</body>
</html>