<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Clientes</title>
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
	<h3>Cadastro de Novo Cliente</h3>
	<div>
		<?php 
			if(isset($_POST['submit'])){
				require_once 'fcnsdb.php';
				require_once 'logindb.php';
				$banco = conectadb($dbHostname,$dbUsername,$dbPassword);

				selectdb($banco,$dbDatabase);

				$cpf = $_POST['cpf'];
				$nome = ucwords(strtolower($_POST['nome']));
				$dtnasc = $_POST['dtnasc'];
				$ender = ucwords(strtolower($_POST['ender']));
				$cidade = ucwords(strtolower($_POST['cidade']));
				$uf = strtoupper($_POST['uf']);
				$tel1 = $_POST['tel1'];
				$tel2 = $_POST['tel2'];

				$query = "INSERT INTO Cliente VALUES ('$cpf','$nome','$dtnasc','$ender','$cidade','$uf','$tel1','$tel2')";
				//echo $query;
				
				$resultado = query($banco, $query);
			}
		 ?>
		<form name='cadastro' method="post">
			<p>
				<label for='cpf'>CPF: (apenas números)</label>
				<input type='text' id='cpf' name='cpf' size="11" maxlength="11" required pattern="\d{11}">
			</p>
			<p>
				<label for='nome'>Nome:</label>
				<input type='text' id='nome' name='nome' size='30' maxlength='30' required>
			</p>
			<p>
				<label for='dtnasc'>Data de Nascimento:</label>
				<input type='date' id='dtnasc' name='dtnasc' required>
			</p>
			<p>
				<label for='ender'>Endereço:</label>
				<input type='text' id='ender' name='ender' size='50' maxlength='50' required>
			</p>
			<p>
				<label for='cidade'>Cidade:</label>
				<input type='text' id='cidade' name='cidade' size='30' maxlength='30' required>
			</p>
			<p>
				<label for='uf'>Estado:</label>
				<input type='text' id='uf' name='uf' size='2' maxlength='2' oninput='toUpperCase(this)' required>
			</p>
			<p>
				<label for='tel1'>Telefone:</label>
				<input type='text' id='tel1' name='tel1' size='15' maxlength='15' required>
			</p>
			<p>
				<label for='tel2'>Telefone:</label>
				<input type='text' id='tel2' name='tel2' size='15' maxlength='15' onfocus='if(this.value=="")this.value=null'>
			</p>
			<input type='submit' name='submit' value='Cadastrar'>
		</form>
	</div>
	<?php 
		if(isset($_POST['submit'])){
			if($resultado){
				echo "<p>Cliente Cadastrado!</p>";
				$query = "SELECT * FROM Cliente WHERE cpf='$cpf'";
				PullValues(query($banco,$query));
			}
		}

		function PullValues($result){     
			if (@mysqli_num_rows($result) == 0){ 
				echo("<b>Query completed. No results returned.</b><br>"); 
			}else { 
				echo "<table border='1'> 
					<thead> 
					<tr>"; 
				for($i = 0;$i < mysqli_num_fields($result);$i++) 
				{ 
					echo "<th>" . mysqli_fetch_field($result)->name . "</th>"; 
				}
				echo "</tr> 
					</thead> 
					<tbody>"; 
				for ($i = 0; $i < mysqli_num_rows($result); $i++) 
				{ 
					echo "<tr>"; 
					$row = mysqli_fetch_row($result); 
					for($j = 0;$j < mysqli_num_fields($result);$j++)  
					{ 
						echo("<td>" . $row[$j] . "</td>"); 
					} 
					echo "</tr>"; 
				} 
				echo "</tbody> 
					</table>"; 
			}  //end else 
		}
	 ?>
</body>
</html>