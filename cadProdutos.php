<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Produtos</title>
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
				echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?user=".false."&url=cadProdutos.php\">";
				exit;
			}
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=cadProdutos.php\">";
		}
	?>
</head>
<body>
	<h3>Cadastro de Novo Produto</h3>
	<div>
		<?php 
			if(isset($_POST['submit'])){
				require_once 'fcnsdb.php';
				require_once 'logindb.php';
				$banco = conectadb($dbHostname,$dbUsername,$dbPassword);

				selectdb($banco,$dbDatabase);

				//produto
				$nome 		= ucwords(strtolower($_POST['nome']));
				$genero 	= ucwords(strtolower($_POST['genero']));
				$classet 	= $_POST['classet'];
				$ano 		= $_POST['ano'];
				$vlvenda	= $_POST['vlvenda'];
				$vlaluga	= $_POST['vlaluga'];
				$estfisico	= $_POST['estfisico'];
				
				$query = "INSERT INTO Produto(nome,genero,classet,ano,vlvenda,vlaluga,estfisico) VALUES ('$nome','$genero','$classet','$ano','$vlvenda','$vlaluga','$estfisico')";
				$resultado = query($banco, $query);
				
				//hq
				if ($_POST['tipo'] == 'hq'){
					$isbn 	= $_POST['isbn'];
					$autor 	= $_POST['autor'];

					$query 	= "SELECT max(codp) FROM Produto";
					$resultado = query($banco, $query);
					$codp 	= mysqli_fetch_row($resultado)[0];

					$query 	= "INSERT INTO Hq VALUES ('$isbn','$codp','$autor')";
					$resultado = query($banco, $query);
				}
				//videogame
				else if ($_POST['tipo'] == 'vg'){
					$desenv 	= $_POST['desenv'];
					$console 	= $_POST['console'];

					$query 	= "SELECT max(codp) FROM Produto";
					$resultado = query($banco, $query);
					$codp 	= mysqli_fetch_row($resultado)[0];

					$query 	= "INSERT INTO Videogame VALUES ('$desenv','$codp','$console')";
					$resultado = query($banco, $query);
				}
			}
		 ?>
		<form name='cadastro' method="post">
			<p>
				<label for='nome'>Nome:</label>
				<input type='text' id='nome' name='nome' size='70' maxlength='70' required>
			</p>
			<p>
				<label for='genero'>Gênero:</label>
				<input type='text' id='genero' name='genero' size='20' maxlength='20' required>
			</p>
			<p>
				<label for='classet'>Classificação etária:</label>
				<input type='text' id='classet' name='classet'required>
				<!--transformar em select-->
			</p>
			<p>
				<label for='ano'>Ano de Publicação:</label>
				<input type='year' id='ano' name='ano' required>
			</p>
			<p>
				<label for='vlvenda'>Valor para Venda:</label>
				<input type='text' id='vlvenda' name='vlvenda' required>
			</p>
			<p>
				<label for='vlaluga'>Valor para Empréstimo:</label>
				<input type='text' id='vlaluga' name='vlaluga' required>
			</p>
			<p>
				<label for='estfisico'>Qualidade do produto:</label>
				<select id='estfisico' name='estfisico' required>
					<option disabled selected>... escolha ...</option>
					<option value='otimo'>Ótimo</option>
					<option value='bom'>Bom</option>
					<option value='regular'>Regular</option>
					<option value='ruim'>Ruim</option>
					<option value='pessimo'>Péssimo</option>
				</select>
			</p>
			<p>
				<label for='tipo'>Tipo:</label>
				<label>
					<input type='radio' name='tipo' id='hq' value='hq' onclick='changeFields()' required>HQ
				</label>
				<label>
					<input type='radio' name='tipo' id='vg' value='vg' onclick='changeFields()' required>Video Game
				</label>
			</p>
			<div id='hqFields' style='display:none'>
			<p>
				<label for='isbn'>ISBN:</label>
				<input type='text' class='hq' id='isbn' name='isbn'>
			</p>
			<p>
				<label for='autor'>Autor:</label>
				<input type='text' class='hq' id='autor' name='autor' size='30' maxlength='30'>
			</p>
			</div>
			<div id='vgFields' style='display:none'>
			<p>
				<label for='desenv'>Desenvolvedora:</label>
				<input type='text' class='vg' id='desenv' name='desenv' size='20' maxlength='20'>
			</p>
			<p>
				<label for='console'>Console:</label>
				<input type='text' class='vg' id='console' name='console' size='20' maxlength='20'>
			</p>
			</div>
			<input type='submit' name='submit' value='Cadastrar'>
		</form>
	</div>
	<?php 
		if(isset($_POST['submit'])){
			if($resultado){
				echo "<p>Produto Cadastrado!</p>";
				if ($_POST['tipo']=='hq'){
					$query = "SELECT Produto.*,autor,isbn FROM Produto JOIN Hq ON codp=produto_codp WHERE codp=(SELECT max(codp) FROM Produto)";
				} else if ($_POST['tipo']=='vg'){
					$query = "SELECT Produto.*,desenv,console FROM Produto JOIN Videogame ON codp=produto_codp WHERE codp=(SELECT max(codp) FROM Produto)";
				}
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
	<script type="text/javascript">
		function changeFields(){
			if(document.getElementById('hq').checked){
				document.getElementById('hqFields').style.display='block';
				document.getElementById('vgFields').style.display='none';
				document.getElementById('isbn').required = true;
				document.getElementById('autor').required = true;
				document.getElementById('desenvolv').required = false;
				document.getElementById('console').required = false;
			}else if(document.getElementById('vg').checked){
				document.getElementById('vgFields').style.display='block';
				document.getElementById('hqFields').style.display='none';
				document.getElementById('desenvolv').required = true;
				document.getElementById('console').required = true;
				document.getElementById('isbn').required = false;
				document.getElementById('autor').required = false;
			}
		}
	</script>
</body>
</html>