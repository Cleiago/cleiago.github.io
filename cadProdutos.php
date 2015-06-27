<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Produtos</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="mainCSS.css ">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>    
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<script type="text/javascript">

		function changeFields(){
			if($('#lvcheck').is(":checked")) {
				$('.vginput').attr("required",false);
				$('.vgFields').hide();
				
				$('.lvFields').show();
				$('.lvinput').attr("required",true);
			}else if($('#vgcheck').is(":checked")){
				$('.lvinput').attr("required",false);
				$('.lvFields').hide();

				$('.vgFields').show();
				$('.vginput').attr("required",true);
			}
		};

		function formatclass (classet) {
			if (!classet.id) { return classet.text; }
			var $classet = $(
				'<span><img src="./images/class' + classet.element.value + '.png" class="img" /></spam>'
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
	<div class="bg-transparent container">
	<h2 class='header'>Cadastro de Novo Produto</h2>

	<form name='cadastro' method='post' accept-charset="utf-8">
		<p>
			<label class="black-text text-darken-2" for='tipo'>Tipo:</label>
			<input class='with-gap ' type='radio' name='tipo' id='lvcheck' value='lv' onclick='changeFields()' required>
			<label class="black-text text-darken-2" for='lvcheck'>Livro / HQ</label>

			<input class='with-gap' type='radio' name='tipo' id='vgcheck' value='vg' onclick='changeFields()' required>
			<label class="black-text text-darken-2" for='vgcheck'>Videogame</label>
		</p>
		<div class='lvFields' style='display:none'>
			<p>
				<label class="black-text text-darken-2" for='isbn'>ISBN:</label>
				<input class="black-text text-darken-2" type='text' class='lv' id='isbn' name='isbn'>
			</p>
		</div>
		<div class='vgFields' style='display:none'>
			<p>
				<label class="black-text text-darken-2" for='vgid'>Videogame ID:</label>
				<input type='text' class='vginput' id='vgid' name='vgid'>
			</p>
		</div>
		<p>
			<label class= "black-text text-darken-2" for='titulo'>Título:</label>
			<input class= "black-text text-darken-2" type='text' id='titulo' name='titulo' size='70' maxlength='70' required>
		</p>
		<div class='lvFields' style='display:none'>
			<p>
				<label class="black-text text-darken-2" for='autor'>Autor:</label>
				<input class="black-text text-darken-2" type='text' class='lv' id='autor' name='autor' size='30' maxlength='30'>
			</p>
		</div>
		<div class='vgFields' style='display:none'>
			<p>
				<label class="black-text text-darken-2" for='desenv'>Desenvolvedor:</label>
				<input class="black-text text-darken-2" type='text' class='vg' id='desenv' name='desenv' size='20' maxlength='20'>
			</p>
		</div>
		<p>
			<label class= "black-text text-darken-2" for='genero'>Gênero:</label>
			<input class= "black-text text-darken-2" type='text' id='genero' name='genero' size='20' maxlength='20' required>
		</p>
		<div class="black-text text-darken-2 input-field col s6">
			<!--<label for='classet'>Classificação Etária:</label>-->
			
				<select id='classet' name='classet' required class="js-example-responsive" style="width: 50%">
					<option disabled selected>Classificação Etária</option>
					<option value='0'>Livre</option>
					<option value='10'>Proibido para menores de 10 anos.</option>
					<option value='12'>Proibido para menores de 12 anos.</option>
					<option value='14'>Proibido para menores de 14 anos.</option>
					<option value='16'>Proibido para menores de 16 anos.</option>
					<option value='18'>Proibido para menores de 18 anos.</option>
				</select>
			
		</div>
		<p>
			<label class= "black-text text-darken-2" for='ano'>Ano de Publicação:</label>
			<input class= "black-text text-darken-2" type='text' id='ano' name='ano' required>
		</p>
		<div class='lvFields' style='display:none'>
			<p>
				<label class="black-text text-darken-2" for='editora'>Editora:</label>
				<input type='text' id='editora' name='editora' size='30' maxlength='30'>
			</p>
			<p>
				<label class="black-text text-darken-2" for='edicao'>Edição:</label>
				<input type='text' id='edicao' name='edicao'>
			</p>
		</div>
		<div class='vgFields' style='display:none'>
			<p>
				<label class="black-text text-darken-2" for='console'>Console:</label>
				<input class="black-text text-darken-2" type='text' class='vg' id='console' name='console' size='20' maxlength='20'>
			</p>
		</div>
		<p>
			<label class= "black-text text-darken-2" for='vlvenda'>Valor para Venda:</label>
			<input class= "black-text text-darken-2" type='text' id='vlvenda' name='vlvenda' required>
		</p>
		<p>
			<label class= "black-text text-darken-2" for='vlaluga'>Valor para Empréstimo:</label>
			<input class= "black-text text-darken-2" type='text' id='vlaluga' name='vlaluga' required>
		</p>
		<div class="black-text text-darken-2 input-field col s6">
			<!--<label for='estfisico'>Qualidade do produto:</label>-->
			<select id='estfisico' name='estfisico' required class="select-custom">
				<option disabled selected>Qualidade do Produto</option>
				<option value='Otimo'>Ótimo</option>
				<option value='Bom'>Bom</option>
				<option value='Regular'>Regular</option>
				<option value='Ruim'>Ruim</option>
				<option value='Pessimo'>Péssimo</option>
			</select>
		</p>
		<button class="red lighten-2 btn waves-effect waves-light" type="submit" name="submit" value="cadastrar">Submit
   			<i class="mdi-content-send right"></i>
  		</button>
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