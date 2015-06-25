<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="mainCSS.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script src="./tablesorter/jquery.tablesorter.js"></script>
	<link rel="stylesheet" href="./tablesorter/themes/blue/custom_style.css">

	<title>Lista de  Produtos</title>

	<script type="text/javascript">
		$(document).ready(function(){
			$("table").tablesorter();

			$(".videogame #codp, .livro #codp").text('Código do Produto');
			$(".videogame #nome, .livro #nome").text('Título');
			$(".videogame #genero, .livro #genero").text('Gênero');
			$(".videogame #classet, .livro #classet").text('Classificação Etária');
			$(".videogame #ano, .livro #ano").text('Ano de Publicação');
			$(".videogame #vlvenda, .livro #vlvenda").text('Valor de Venda');
			$(".videogame #vlaluga, .livro #vlaluga").text('Valor de Empréstimo');
			$(".videogame #estfisico, .livro #estfisico").text('Estado Físico');
			$(".livro #isbn").text('ISBN');
			$(".livro #autor").text('Autor');
			$(".videogame #desenv").text('Desenvolvedor');
			$(".videogame #console").text('Console');

		});
	</script>

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
		<p class="black-text text-darken-3 lighten-3">Lista de Clientes:</p>
	<br>
	<?php 
	if(isset($_SESSION["login"])){
		
	}else{
		echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verProdutos.php\">";
		exit();
	}

	require_once 'fcnsdb.php';
	require_once 'logindb.php';
	require_once 'extrafunc.php';
	$banco = conectadb($dbHostname, $dbUsername, $dbPassword);
	selectdb($banco, $dbDatabase);

	$query = "SELECT p.*,l.isbn,l.autor FROM produto p JOIN livro l ON codp=produto_codp WHERE codp NOT IN (SELECT produto_codp from aluga UNION SELECT produto_codp FROM compra) ORDER BY 1";
	$livro = query($banco,$query);

	$query = "SELECT p.*,v.desenv,v.console FROM produto p JOIN videogame v ON codp=produto_codp WHERE codp NOT IN (SELECT produto_codp from aluga UNION SELECT produto_codp FROM compra) ORDER BY 1";
	$videogame = query($banco,$query);
	?>

	<div class='livro'>
		<h4>HQ's</h4>
		<?php PrintTable($livro); ?>
	</div>
	<div class='videogame'>
		<h4>Videogames</h4>
		<?php PrintTable($videogame); ?>
	</div>
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
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="JavaScript.js"></script>
</body>
</html>
