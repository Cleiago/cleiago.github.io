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
			if($('#lv').is(":checked")) {
				$('.vginput').attr("required",false);
				$('.vgFields').hide();
				
				$('.lvFields').show();
				$('.lvinput').attr("required",true);
			}else if(document.getElementById('vg').checked){
				$('.lvinput').attr("required",false);
				$('.lvFields').hide();

				$('.vgFields').show();
				$('.vginput').attr("required",true);
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
		$estfisico	= $_POST['estfisico'];
		
		$query = "INSERT INTO produto(estfisico) VALUES ('$estfisico')";
		$resultado = query($banco, $query);
		echo "produto";

		$query 	= "SELECT max(codp) FROM produto";
		$resultado = query($banco, $query);
		$codp 	= mysqli_fetch_row($resultado)[0];
		echo $codp;
		
		//livro
		if ($_POST['tipo'] == 'lv'){
			$isbn 		= $_POST['isbn'];
			$ltitulo 	= ucwords(strtolower($_POST['titulo']));
			$lautor 	= ucwords(strtolower($_POST['autor']));
			$lgenero 	= ucwords(strtolower($_POST['genero']));
			$lclasset 	= $_POST['classet'];
			$lano 		= $_POST['ano'];
			$leditora	= ucwords(strtolower($_POST['editora']));
			$ledicao	= $_POST['edicao'];
			$lvlvenda	= $_POST['vlvenda'];
			$lvlaluga	= $_POST['vlaluga'];

			$query 	= "INSERT INTO livro VALUES ('$isbn','$ltitulo','$lautor','$lgenero','$lclasset','$lano','$leditora','$ledicao','$lvlvenda','$lvlaluga')";
			$resultado = query($banco, $query);
			echo "livro";

			//produtolivro
			$query	= "INSERT INTO produtolivro VALUES ('$codp','$isbn')";
			$resultado = query($banco,$query);
			echo "produtolivro";
		}
		//videogame
		else if ($_POST['tipo'] == 'vg'){
			$vgid 		= $_POST['vgid'];
			$vtitulo 	= ucwords(strtolower($_POST['titulo']));
			$vdesenv 	= ucwords(strtolower($_POST['desenv']));
			$vgenero 	= ucwords(strtolower($_POST['genero']));
			$vclasset 	= $_POST['classet'];
			$vano 		= $_POST['ano'];
			$vconsole 	= ucwords(strtolower($_POST['console']));
			$vvlvenda	= $_POST['vlvenda'];
			$vvlaluga	= $_POST['vlaluga'];
			
			$query 	= "INSERT INTO videogame VALUES ('$vgid','$vtitulo','$vdesenv','$vgenero','$vclasset','$vano','$vconsole','$vvlvenda','$vvlaluga')";
			$resultado = query($banco, $query);
			echo "videogame";

			//produtovideogame
			$query 	= "INSERT INTO produtovideogame VALUES ('$codp','$vgid')";
			$resultado = query($banco,$query);
			echo "produtovideogame";
		}
	}
	?>
	
	<form name='cadastro' method='post' accept-charset="utf-8">
		<p>
			<label for='tipo'>Tipo:</label>
			<label>
				<input type='radio' name='tipo' id='lv' value='lv' onclick='changeFields()' required>HQ
			</label>
			<label>
				<input type='radio' name='tipo' id='vg' value='vg' onclick='changeFields()' required>Videogame
			</label>
		</p>
		<div class='lvFields' style='display:none'>
			<p>
				<label for='isbn'>ISBN:</label>
				<input type='text' class='lvinput' id='isbn' name='isbn'>
			</p>
		</div>
		<div class='vgFields' style='display:none'>
			<p>
				<label for='vgid'>Videogame ID:</label>
				<input type='text' class='vginput' id='vgid' name='vgid'>
			</p>
		</div>
		<p>
			<label for='titulo'>Título:</label>
			<input type='text' id='titulo' name='titulo' size='70' maxlength='70' required>
		</p>
		<div class='lvFields' style='display:none'>
			<p>
				<label for='autor'>Autor:</label>
				<input type='text' class='lvinput' id='autor' name='autor' size='30' maxlength='30'>
			</p>
		</div>
		<div class='vgFields' style='display:none'>
			<p>
				<label for='desenv'>Desenvolvedor:</label>
				<input type='text' class='vginput' id='desenv' name='desenv' size='20' maxlength='20'>
			</p>
		</div>
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
		<div class='lvfields' style='display:none'>
			<p>
				<label for='editora'>Editora:</label>
				<input type='text' id='editora' name='editora' size='30' maxlength='30'>
			</p>
			<p>
				<label for='edicao'>Edição:</label>
				<input type='text' id='edicao' name='edicao'>
			</p>
		</div>
		<div class='vgFields' style='display:none'>
			<p>
				<label for='console'>Console:</label>
				<input type='text' class='vginput' id='console' name='console' size='20' maxlength='20'>
			</p>
		</div>
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
		<input type='submit' name='submit' value='Cadastrar'>
	</form>

	<?php 
	if(isset($_POST['submit'])){
		require_once 'extrafunc.php';
		if($resultado){
			echo "<p>Produto Cadastrado!</p>";
			if ($_POST['tipo']=='lv'){
				$query = "SELECT * FROM produto p NATURAL JOIN produtolivro NATURAL JOIN livro l WHERE codp=(SELECT max(codp) FROM produto)";
			} else if ($_POST['tipo']=='vg'){
				$query = "SELECT * FROM produto p NATURAL JOIN produtovideogame NATURAL JOIN videogame v WHERE codp=(SELECT max(codp) FROM produto)";
			}
			PrintTable(query($banco,$query));
		}
	}
	?>

</body>
</html>