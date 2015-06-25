<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="mainCSS.css ">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>    
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<title>Devolução</title>

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

			$("#codp, #codp").text('Código do Produto');
			$("#cpf").text('CPF do Cliente');
			$("#dtaluga").text('Data do Empréstimo');
			$("#dtdev").text('Data de Devolução');
			$("table #estfisico").text('Estado Físico');

		});
	</script>

</head>
<body class='fundo'>
	<nav>
		<div class="nav-wrapper">
			<a href="#" data-activates="mobile-sidenav" class="button-collapse"><i class="mdi-navigation-menu"></i><span class="controller controller-nav-mobile" id="btRB"></span></a>
			<a class="brand-logo right" href="./">CLEIAGO</a>
			<ul id="nav-mobile" class="light hide-on-med-and-down">
				<a class="red lighten-2 btn" href="logout.php">Logout</a>
				<a class="red lighten-2 btn" href="index.php">Home</a>
			</ul>
			<!--Mobile-->
			<ul id="mobile-sidenav" class="side-nav">
				<a class="white btn" href="logout.php">Logout</a>
				<a class="white btn" href="index.php">Home</a> 
			</ul>
		</div>
	</nav>
	<div class="bg-transparent container">
	<h2 class='header'>Devolução</h2>
	
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
		
		$query = "SELECT codp FROM aluga WHERE dtdev IS NULL GROUP BY 1";
		$productOptions = query($banco,$query);
		$query = "SELECT cpf FROM aluga WHERE dtdev IS NULL GROUP BY 1";
		$clientOptions = query($banco,$query);

		if(isset($_POST['submit'])){

			$pcodp		= $_POST['pcodp'];
			$ccpf		= $_POST['ccpf'];
			$dtdev		= date('Y-m-d',time());
			$estfisico 	= $_POST['estfisico'];

			
			$query = "UPDATE aluga SET dtdev='$dtdev' WHERE codp='$pcodp' AND cpf='$ccpf' AND dtdev IS NULL";
			$resultado = query($banco,$query);
			$query = "UPDATE produto SET estfisico='$estfisico' WHERE codp='$pcodp'";
			$resultado = query($banco,$query);


			$query = "SELECT codp FROM aluga WHERE dtdev IS NULL GROUP BY 1";
			$productOptions = query($banco,$query);
			$query = "SELECT cpf FROM aluga WHERE dtdev IS NULL GROUP BY 1";
			$clientOptions = query($banco,$query);
		}
	?>
	<form name='aluga' method='post' accept-charset="utf-8">
		<p>
			<label class="black-text text-darken-2" for='ccpf'>CPF do Cliente:</label>
			<select name='ccpf' id='ccpf' style='width: 150px' required>";
				<?php SelectValues($clientOptions); ?>
			</select>
		</p>
		<p class='pcodp'>
			<label class="black-text text-darken-2" for='pcodp'>Código do Produto:</label>
			<select name='pcodp' id='pcodp' style='width: 150px' required>";
				
			</select>
		</p>
		<p class="estfisico">
			<label class="black-text text-darken-2" for='estfisico'>Estado do produto:</label>
			<select id='estfisico' name='estfisico' required>
				<option disabled selected>Selecione...</option>
				<option value='Ótimo'>Ótimo</option>
				<option value='Bom'>Bom</option>
				<option value='Regular'>Regular</option>
				<option value='Ruim'>Ruim</option>
				<option value='Péssimo'>Péssimo</option>
			</select>
		</p>
		<p>
		<button class="red lighten-2 btn waves-effect waves-light" type="submit" name="submit" value="confirmar">Confirmar
   			<i class="mdi-content-send right"></i>
  		</button>
		</p>
	</form>

	<?php 
		if(isset($_POST['submit'])){
			if($resultado){
				//echo "<p>Operação Concluída!</p>";
				$queryProd = "SELECT * FROM produto WHERE codp='$pcodp' ORDER BY codp";
				$queryAlug = "SELECT * FROM aluga WHERE codp='$pcodp' AND cpf='$ccpf' AND dtdev='$dtdev'";
				PrintTable(query($banco,$queryAlug));
				PrintTable(query($banco,$queryProd));
			}
		}
	?>
	</div>
</body>
</html>
