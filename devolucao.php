<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<title>Devolução</title>
	<meta charset='UTF-8'>

	<script type="text/javascript">
		$(document).ready(function () {
			$(".pcodp").hide();
			$(".estfisico").hide();

			$("#pcodp").select2();
			$("#ccpf").select2();
			$("#estfisico").select2();

			$(document).on("focus", ".select2", function () {
				$(this).prev().select2('open');
			});

			$("#ccpf").change(function(){
				var cliente = $("#ccpf option:selected").text();
				$("#pcodp").load("getprod.php?ccpf="+cliente);
				$(".pcodp").show();
			});

			$("#pcodp").change(function() {
				$(".estfisico").show();
			})

		});
	</script>

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

			$pcodp		= $_POST['pcodp'];
			$ccpf		= $_POST['ccpf'];
			$dtdev		= date('Y-m-d',time());
			$estfisico 	= $_POST['estfisico'];

			
			$query = "UPDATE aluga SET dtdev='$dtdev' WHERE produto_codp='$pcodp' AND cliente_cpf='$ccpf' AND dtdev IS NULL";
			$resultado = query($banco,$query);
			$query = "UPDATE produto SET estfisico='$estfisico' WHERE codp='$pcodp'";
			$resultado = query($banco,$query);


			$query = "SELECT produto_codp FROM aluga WHERE dtdev IS NULL GROUP BY 1";
			$productOptions = query($banco,$query);
			$query = "SELECT cliente_cpf FROM aluga WHERE dtdev IS NULL GROUP BY 1";
			$clientOptions = query($banco,$query);
		}
	?>
	<form name='aluga' method='post'>
		<p>
			<label for='ccpf'>CPF do Cliente:</label>
			<select name='ccpf' id='ccpf' style='width: 150px' required>";
				<?php SelectValues($clientOptions); ?>
			</select>
		</p>
		<p class='pcodp'>
			<label for='pcodp'>Código do Produto:</label>
			<select name='pcodp' id='pcodp' style='width: 150px' required>";
				
			</select>
		</p>
		<p class="estfisico">
			<label for='estfisico'>Estado do produto:</label>
			<select id='estfisico' name='estfisico' required>
				<option disabled selected>... escolha ...</option>
				<option value='Ótimo'>Ótimo</option>
				<option value='Bom'>Bom</option>
				<option value='Regular'>Regular</option>
				<option value='Ruim'>Ruim</option>
				<option value='Péssimo'>Péssimo</option>
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
				$queryProd = "SELECT * FROM produto LEFT JOIN livro ON codp=produto_codp LEFT JOIN videogame v ON codp=v.produto_codp WHERE codp='$pcodp' ORDER BY codp";
				$queryAlug = "SELECT * FROM aluga WHERE produto_codp='$pcodp' AND cliente_cpf='$ccpf' AND dtdev='$dtdev'";
				PrintTable(query($banco,$queryAlug));
				PrintTable(query($banco,$queryProd));
			}
		}
	?>

</body>
</html>
