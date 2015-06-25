<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Produtos</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="mainCSS.css ">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>     
	
	<script type="text/javascript">
		function changeFields(){
			if(document.getElementById('lv').checked){
				document.getElementById('lvFields').style.display='block';
				document.getElementById('vgFields').style.display='none';
				
				document.getElementById('isbn').required = true;
				document.getElementById('autor').required = true;
				document.getElementById('desenvolv').required = false;
				document.getElementById('console').required = false;
			}else if(document.getElementById('vg').checked){
				document.getElementById('vgFields').style.display='block';
				document.getElementById('lvFields').style.display='none';

				document.getElementById('desenvolv').required = true;
				document.getElementById('console').required = true;
				document.getElementById('isbn').required = false;
				document.getElementById('autor').required = false;
			}
		}

		function formatclass (classet) {
			if (!classet.id) { return classet.text; }
			var $classet = $(
				'<span><img src="./images/class' + classet.element.value + '.png" class="img-flag" /></spam>'
			);
			return $classet;
		};

		$(document).ready(function() {
			$('#estfisico').select2();

			$("#classet").select2({
				templateResult: formatclass
			});

			$(document).on("focus", ".select2", function () {
				$(this).prev().select2('open');
			});
		})
	</script>
	<style type="text/css">
		img{
			height: 30px;
			width: 30px;
		}
	</style>

</head>
<body>
	<h3>Cadastro de Novo Produto</h3>
	<a href="index.php"><button>Home</button></a>
	<?php 
	if(isset($_SESSION["login"])){
		
	}else{
		echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=cadProdutos.php\">";
	}
		
	if(isset($_POST['submit'])){
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		$banco = conectadb($dbHostname,$dbUsername,$dbPassword);

		selectdb($banco,$dbDatabase);

		//produto
		$titulo 		= ucwords(strtolower($_POST['titulo']));
		$genero 	= ucwords(strtolower($_POST['genero']));
		$classet 	= $_POST['classet'];
		$ano 		= $_POST['ano'];
		$vlvenda	= $_POST['vlvenda'];
		$vlaluga	= $_POST['vlaluga'];
		$estfisico	= $_POST['estfisico'];
		
		$query = "INSERT INTO produto(nome,genero,classet,ano,vlvenda,vlaluga,estfisico) VALUES ('$titulo','$genero','$classet','$ano','$vlvenda','$vlaluga','$estfisico')";
		$resultado = query($banco, $query);
		
		//livro
		if ($_POST['tipo'] == 'lv'){
			$isbn 	= $_POST['isbn'];
			$autor 	= $_POST['autor'];

			$query 	= "SELECT max(codp) FROM produto";
			$resultado = query($banco, $query);
			$codp 	= mysqli_fetch_row($resultado)[0];

			$query 	= "INSERT INTO livro VALUES ('$isbn','$codp','$autor')";
			$resultado = query($banco, $query);
		}
		//videogame
		else if ($_POST['tipo'] == 'vg'){
			$desenv 	= $_POST['desenv'];
			$console 	= $_POST['console'];

			$query 	= "SELECT max(codp) FROM produto";
			$resultado = query($banco, $query);
			$codp 	= mysqli_fetch_row($resultado)[0];

			$query 	= "INSERT INTO videogame VALUES ('$desenv','$codp','$console')";
			$resultado = query($banco, $query);
		}
	}
	?>
	
	<form name='cadastro' method='post' accept-charset="utf-8">
		<p>
			<label for='titulo'>Título:</label>
			<input type='text' id='titulo' name='titulo' size='70' maxlength='70' required>
		</p>
		<p>
			<label for='genero'>Gênero:</label>
			<input type='text' id='genero' name='genero' size='20' maxlength='20' required>
		</p>
		<p>
			<label for='classet'>Classificação Etária:</label>
			<select id='classet' name='classet' required>
				<option value='0'>Livre</option>
				<option value='10'>Proibido para menores de 10 anos.</option>
				<option value='12'>Proibido para menores de 12 anos.</option>
				<option value='14'>Proibido para menores de 14 anos.</option>
				<option value='16'>Proibido para menores de 16 anos.</option>
				<option value='18'>Proibido para menores de 18 anos.</option>
			</select>
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
				<option disabled selected>Selecione...</option>
				<option value='Otimo'>Ótimo</option>
				<option value='Bom'>Bom</option>
				<option value='Regular'>Regular</option>
				<option value='Ruim'>Ruim</option>
				<option value='Pessimo'>Péssimo</option>
			</select>
		</p>
		<p>
			<label for='tipo'>Tipo:</label>
			<label>
				<input type='radio' name='tipo' id='lv' value='lv' onclick='changeFields()' required>HQ
			</label>
			<label>
				<input type='radio' name='tipo' id='vg' value='vg' onclick='changeFields()' required>Videogame
			</label>
		</p>
		<div id='lvFields' style='display:none'>
		<p>
			<label for='isbn'>ISBN:</label>
			<input type='text' class='lv' id='isbn' name='isbn'>
		</p>
		<p>
			<label for='autor'>Autor:</label>
			<input type='text' class='lv' id='autor' name='autor' size='30' maxlength='30'>
		</p>
		</div>
		<div id='vgFields' style='display:none'>
		<p>
			<label for='desenv'>Desenvolvedor:</label>
			<input type='text' class='vg' id='desenv' name='desenv' size='20' maxlength='20'>
		</p>
		<p>
			<label for='console'>Console:</label>
			<input type='text' class='vg' id='console' name='console' size='20' maxlength='20'>
		</p>
		</div>
		<input type='submit' name='submit' value='Cadastrar'>
	</form>

	<?php 
	if(isset($_POST['submit'])){
		require_once 'extrafunc.php';
		if($resultado){
			echo "<p>Produto Cadastrado!</p>";
			if ($_POST['tipo']=='lv'){
				$query = "SELECT produto.*,autor,isbn FROM produto JOIN livro ON codp=produto_codp WHERE codp=(SELECT max(codp) FROM produto)";
			} else if ($_POST['tipo']=='vg'){
				$query = "SELECT produto.*,desenv,console FROM produto JOIN videogame ON codp=produto_codp WHERE codp=(SELECT max(codp) FROM produto)";
			}
			PrintTable(query($banco,$query));
		}
	}
	?>

</body>
</html>