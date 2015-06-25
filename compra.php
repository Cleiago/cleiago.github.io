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
	<title>Compra</title>
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
	<h2 class='header'>Compra</h2>
	
	<?php 
		if(isset($_SESSION["login"])){

		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=compra.php\">";
			exit;
		}

		require_once 'extrafunc.php';

		require_once 'logindb.php';
		require_once 'fcnsdb.php';
		$banco = conectadb($dbHostname,$dbUsername,$dbPassword);
		selectdb($banco,$dbDatabase);
		
		$query = "SELECT codp FROM produto WHERE codp NOT IN (SELECT codp FROM aluga WHERE dtdev IS NULL UNION SELECT codp FROM compra)";
		$productOptions = query($banco,$query);
		$query = "SELECT cpf FROM cliente";
		$clientOptions = query($banco,$query);

		if(isset($_POST['submit'])){
		
			$pcodp	  = $_POST['pcodp'];
			$ccpf	  = $_POST['ccpf'];
			$dtcompra = date('Y-m-d',time());

			$query = "INSERT INTO compra VALUES ('$pcodp','$ccpf','$dtcompra')";
			$resultado = query($banco,$query);
			
			$query = "SELECT codp FROM produto WHERE codp NOT IN (SELECT codp FROM aluga WHERE dtdev IS NULL UNION SELECT codp FROM compra)";
			$productOptions = query($banco,$query);

		}
	?>
	
	<form name='compra' method='post' action='compra.php' accept-charset="utf-8">
		<p>
			<label class="black-text text-darken-2" for='pcodp'>Codigo do Produto:</label>
			<select name='pcodp' id='pcodp' style='width: 150px' required>";
			<?php SelectValues($productOptions); ?>
			</select>
		</p>
		<p>
			<label class="black-text text-darken-2" for='ccpf'>CPF do Cliente:</label>
			<select name='ccpf' id='ccpf' style='width: 150px' required>";
				<?php SelectValues($clientOptions); ?>
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
				echo "<p>Operação Concluída!</p>";
				$query = "SELECT * FROM compra WHERE codp='$pcodp' AND cpf='$ccpf' AND dtcompra='$dtcompra'";
				PrintTable(query($banco,$query));
			}
		}
	?>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#pcodp").select2();
			$("#ccpf").select2();

			$(document).on("focus", ".select2", function () {
				$(this).prev().select2('open');
			});

			$("#codp").text('Código do Produto');
			$("#cpf").text('CPF do Cliente');
			$("#dtcompra").text('Data da Compra');
			
		});
	</script>
</body>
</html>