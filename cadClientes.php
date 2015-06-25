<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Clientes</title>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="mainCSS.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
</head>
<body class="fundo">

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

	<div class="container bg-transparent">
		<h2 class="header">CLEIAGO COMICS</h2>
		<p class="black-text text-darken-3 lighten-3">Cadastrar novo Cliente:</p>
		<?php 
		if(! isset($_SESSION["login"])){
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=cadClientes.php\">";
			exit();
		}
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

			$query = "INSERT INTO cliente VALUES ('$cpf','$nome','$dtnasc','$ender','$cidade','$uf','$tel1','$tel2')";
			//echo $query;
			
			$resultado = query($banco, $query);
		}
		?>

		<form name='cadastro' method='post' accept-charset="utf-8">
			<p>
				<label class= "black-text text-darken-2" for='cpf'>CPF: (apenas números)</label>
				<input type='text' id='cpf' name='cpf' size='11' maxlength='11' required pattern='\d{11}'>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='nome'>Nome:</label>
				<input type='text' id='nome' name='nome' size='30' maxlength='30' required>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='dtnasc'>Data de Nascimento:</label>
				<input type='date' id='dtnasc' name='dtnasc' required>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='ender'>Endereço:</label>
				<input type='text' id='ender' name='ender' size='50' maxlength='50' required>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='cidade'>Cidade:</label>
				<input type='text' id='cidade' name='cidade' size='30' maxlength='30' required>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='uf'>Estado:</label>
				<input type='text' id='uf' name='uf' size='2' maxlength='2' oninput='toUpperCase(this)' required>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='tel1'>Telefone:</label>
				<input type='text' id='tel1' name='tel1' size='15' maxlength='15' required>
			</p>
			<p>
				<label class= "black-text text-darken-2" for='tel2'>Telefone:</label>
				<input type='text' id='tel2' name='tel2' size='15' maxlength='15' onfocus='if(this.value=="")this.value=null'>
			</p>
			<button class="red lighten-2 btn waves-effect waves-light" type="submit" name="submit" value="Cadastrar">Submit
				<i class="mdi-content-send right"></i>
			</button>
		</form>

		<?php 
		if(isset($_POST['submit'])){
			require_once 'extrafunc.php';
			if($resultado){
				echo "<p>Cliente Cadastrado!</p>";
				$query = "SELECT * FROM cliente WHERE cpf='$cpf'";
				PrintTable(query($banco,$query));
			}
		}
		?>

	</div>
	<footer class="page-footer">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">CLEIAGO COMICS</h5>
				</div>
				<div class="col l4 offset-l2 s12">
					<ul>
						<li><a class="grey-text text-lighten-3" target="_blank" href="http://kombiweb.github.io">Quem somos?</a></li>
						<li><a class="grey-text text-lighten-3" target="_blank" href="http://www.google.com.br">Do que sobrevivemos?</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2014 Copyright Text
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="JavaScript.js"></script>

</body>
</html>