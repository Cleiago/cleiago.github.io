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
		console.debug("oiiii")
		function changeFieldsHQ(){
				console.debug("oi");
				document.getElementById('lvFields').style.display='block';
				document.getElementById('vgFields').style.display='none';
				document.getElementById('isbn').required = true;
				document.getElementById('autor').required = true;
				document.getElementById('desenvolv').required = false;
				document.getElementById('console').required = false;
		}
		function changeFieldsVG(){
			console.debug("entreii")
				document.getElementById('vgFields').style.display='block';
				document.getElementById('lvFields').style.display='none';
				document.getElementById('desenvolv').required = true;
				document.getElementById('console').required = true;
				document.getElementById('isbn').required = false;
				document.getElementById('autor').required = false;
			}



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
		})
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

	<h3>Cadastro de Novo Produto</h3>

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
	<div class="bg-transparent container">

	<form name='cadastro' method='post' accept-charset="utf-8">
		<p>
			<label class= "black-text text-darken-2" for='titulo'>Título:</label>
			<input class= "black-text text-darken-2" type='text' id='titulo' name='titulo' size='70' maxlength='70' required>
		</p>
		<p>
			<label class= "black-text text-darken-2" for='genero'>Gênero:</label>
			<input class= "black-text text-darken-2" type='text' id='genero' name='genero' size='20' maxlength='20' required>
		</p>
		<div class="black-text text-darken-2 input-field col s6">
			<label for='classet'>Classificação Etária:</label>
			
				<select id='classet' name='classet' required class="select-custom">
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
			<input class= "black-text text-darken-2" type='year' id='ano' name='ano' required>
		</p>
		<p>
			<label class= "black-text text-darken-2" for='vlvenda'>Valor para Venda:</label>
			<input class= "black-text text-darken-2" type='text' id='vlvenda' name='vlvenda' required>
		</p>
		<p>
			<label class= "black-text text-darken-2" for='vlaluga'>Valor para Empréstimo:</label>
			<input class= "black-text text-darken-2" type='text' id='vlaluga' name='vlaluga' required>
		</p>
		<div class="black-text text-darken-2 input-field col s6">
			<label for='estfisico'>Qualidade do produto:</label>
			<select id='estfisico' name='estfisico' required class="select-custom">
				<option disabled selected>Selecione...</option>
				<option value='Otimo'>Ótimo</option>
				<option value='Bom'>Bom</option>
				<option value='Regular'>Regular</option>
				<option value='Ruim'>Ruim</option>
				<option value='Pessimo'>Péssimo</option>
			</select>
		</div>
		<p>
			<label class="black-text text-darken-2" for='tipo'>Tipo:</label>
			<label class="black-text text-darken-2">
				<a class="red lighten-2 waves-effect waves-teal btn"  name='tipo' id='lv' value='lv' onclick='changeFieldsHQ()' required>HQ</a>
			</label>
			<label class="black-text text-darken-2">
				<a class="red lighten-2 waves-effect waves-teal btn" name='tipo' id='vg' value='vg' onclick='changeFieldsVG()' required>Videogame</a>
			</label>
		</p>
		<div id='lvFields' class="hq">
			<p>
				<label class="black-text text-darken-2" for='isbn'>ISBN:</label>
				<input class="black-text text-darken-2" type='text' class='lv' id='isbn' name='isbn'>
			</p>
			<p>
				<label class="black-text text-darken-2" for='autor'>Autor:</label>
				<input class="black-text text-darken-2" type='text' class='lv' id='autor' name='autor' size='30' maxlength='30'>
			</p>
		</div>
		<div id='vgFields' class="vg" >
			<p>
				<label class="black-text text-darken-2" for='desenv'>Desenvolvedor:</label>
				<input class="black-text text-darken-2" type='text' class='vg' id='desenv' name='desenv' size='20' maxlength='20'>
			</p>
			<p>
				<label class="black-text text-darken-2" for='console'>Console:</label>
				<input class="black-text text-darken-2" type='text' class='vg' id='console' name='console' size='20' maxlength='20'>
			</p>
		</div>
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
				$query = "SELECT produto.*,autor,isbn FROM produto JOIN livro ON codp=produto_codp WHERE codp=(SELECT max(codp) FROM produto)";
			} else if ($_POST['tipo']=='vg'){
				$query = "SELECT produto.*,desenv,console FROM produto JOIN videogame ON codp=produto_codp WHERE codp=(SELECT max(codp) FROM produto)";
			}
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
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="JavaScript.js"></script>
    

</body>
</html>