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
			$(".videogame #estfisico, .livro #estfisico").text('Estado Físico');
			$("#vtitulo, #ltitulo").text('Título');
			$("#vgenero, #lgenero").text('Gênero');
			$("#vclasset, #lclasset").text('Classificação Etária');
			$("#vano, #lano").text('Ano de Publicação');
			$("#vvlvenda, #lvlvenda").text('Valor de Venda');
			$("#vvlaluga, #lvlaluga").text('Valor de Empréstimo');
			$("#isbn").text('ISBN');
			$("#vgid").text('Viedogame ID');
			$("#lautor").text('Autor');
			$("#leditora").text('Editora');
			$("#ledicao").text('Edição');
			$("#vdesenv").text('Desenvolvedor');
			$("#vconsole").text('Console');

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

	$query = "SELECT * FROM produto p NATURAL JOIN produtolivro NATURAL JOIN livro l WHERE codp NOT IN (SELECT codp from aluga UNION SELECT codp FROM compra) ORDER BY 1";
	$livro = query($banco,$query);

	$query = "SELECT * FROM produto p NATURAL JOIN produtovideogame NATURAL JOIN videogame v WHERE codp NOT IN (SELECT codp from aluga UNION SELECT codp FROM compra) ORDER BY 1";
	$videogame = query($banco,$query);
	?>

	<div class='livro'>
		<h4>Livros e HQ's</h4>
		<?php PrintTable($livro); ?>
	</div>
	<div class='videogame'>
		<h4>Videogames</h4>
		<?php PrintTable($videogame); ?>
	</div>
	
</body>
</html>
