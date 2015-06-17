<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<title>Devolução</title>
	<meta charset='UTF-8'>
</head>
<body>
	<h3>Devolução</h3>
	<a href="index.php"><button>Home</button></a>
	<?php 
		if(isset($_SESSION["login"])){

		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=aluga.php\">";
		}
		
		require_once 'extrafunc.php';
		
		require_once 'logindb.php';
		require_once 'fcnsdb.php';
		$banco = conectadb($dbHostname,$dbUsername,$dbPassword);
		selectdb($banco,$dbDatabase);
		
		$query = "SELECT produto_codp FROM aluga WHERE dtdev IS NULL GROUP BY 1";
		$productOptions = query($banco,$query);
		$query = "SELECT cliente_cpf FROM aluga WHERE dtdev IS NULL GROUP BY 1";
		$clientOptions = query($banco,$query);

		if(isset($_POST['submit'])){

			$pcodp	= $_POST['pcodp'];
			$ccpf	= $_POST['ccpf'];
			$dtdev	= date('Y-m-d',time());
			
			$query = "UPDATE aluga SET dtdev='$dtdev' WHERE produto_codp='$pcodp' AND cliente_cpf='$ccpf' AND dtdev IS NULL";
			$resultado = query($banco,$query);

			$query = "SELECT produto_codp FROM aluga WHERE dtdev IS NULL GROUP BY 1";
			$productOptions = query($banco,$query);
			$query = "SELECT cliente_cpf FROM aluga WHERE dtdev IS NULL GROUP BY 1";
			$clientOptions = query($banco,$query);
		}
	?>
	<form name='aluga' method='post'>
		<p>
			<label for='pcodp'>Codigo do Produto:</label>
			<select name='pcodp' id='pcodp' style='width: 150px' required>";
			<?php SelectValues($productOptions); ?>
			</select>
		</p>
		<p>
			<label for='ccpf'>CPF do Cliente:</label>
			<select name='ccpf' id='ccpf' style='width: 150px' required>";
				<?php SelectValues($clientOptions); ?>
			</select>
		</p>
		<p>
			<input type='submit' name='submit' value='Confirmar'>
		</p>
	</form>

	<?php 
		if(isset($_POST['submit'])){
			if($resultado){
				//echo "<p>Operação Concluída!</p>";
				$query = "SELECT * FROM aluga WHERE produto_codp='$pcodp' AND cliente_cpf='$ccpf' AND dtdev='$dtdev'";
				PrintTable(query($banco,$query));
			}
		}
	?>

	<script type="text/javascript">
		$(document).ready(function () {
			$("#pcodp").select2();
			$("#ccpf").select2();
		})
	</script>
</body>