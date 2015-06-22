<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<script src="./tablesorter/jquery.tablesorter.js"></script>
	<link rel="stylesheet" href="./tablesorter/themes/blue/custom_style.css">

	<title>Ver Produtos</title>
	<meta charset='UTF-8'>

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
<body>
	<h3>Produtos</h3>
	<a href="index.php"><button>Home</button></a>
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
		<h4>Livros</h4>
		<?php PrintTable($livro); ?>
	</div>
	<div class='videogame'>
		<h4>Videogames</h4>
		<?php PrintTable($videogame); ?>
	</div>
	
</body>
</html>
