<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Clientes</title>
	<meta charset='UTF-8'>
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  	<link rel="stylesheet" href="mainCSS.css">
	<?php 
	?>
</head>

<body class="fundo">
  </div class="white container">
    <div class="white row container">
      <h2 class="header">CLEIAGO COMICS</h2>
      <p class="grey-text text-darken-3 lighten-3">Cadastrar novo Cliente:</p>

      <a href="index.php"><button>Home</button></a>s
=======
<body>
	<h3>Cadastro de Novo Cliente</h3>
	<a href="index.php"><button>Home</button></a>
		<?php 
		if(isset($_SESSION["login"])){
			
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=cadClientes.php\">";
			exit;
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

		<form name='cadastro' method='post'>
			<p>
				<label for='cpf'>CPF: (apenas números)</label>
				<input type='text' id='cpf' name='cpf' size='11' maxlength='11' required pattern='\d{11}'>
			</p>
			<p>
				<label for='nome'>Nome:</label>
				<input type='text' id='nome' name='nome' size='30' maxlength='30' required>
			</p>
			<p>
				<label for='dtnasc'>Data de Nascimento:</label>
				<input type='date' id='dtnasc' name='dtnasc' required>
			</p>
			<p>
				<label for='ender'>Endereço:</label>
				<input type='text' id='ender' name='ender' size='50' maxlength='50' required>
			</p>
			<p>
				<label for='cidade'>Cidade:</label>
				<input type='text' id='cidade' name='cidade' size='30' maxlength='30' required>
			</p>
			<p>
				<label for='uf'>Estado:</label>
				<input type='text' id='uf' name='uf' size='2' maxlength='2' oninput='toUpperCase(this)' required>
			</p>
			<p>
				<label for='tel1'>Telefone:</label>
				<input type='text' id='tel1' name='tel1' size='15' maxlength='15' required>
			</p>
			<p>
				<label for='tel2'>Telefone:</label>
				<input type='text' id='tel2' name='tel2' size='15' maxlength='15' onfocus='if(this.value=="")this.value=null'>
			</p>
			<input type='submit' name='submit' value='Cadastrar'>
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
  </div>
 

	 <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">CLEIAGO COMICS</h5>
              </div>
              <div class="col l4 offset-l2 s12">
                <ul>
                  <li><a class="grey-text text-lighten-3" target="_blank" href="kombiweb.github.io">Quem somos?</a></li>
                  <li><a class="grey-text text-lighten-3" target="_blank" href="www.google.com.br">Do que sobrevivemos?</a></li>
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